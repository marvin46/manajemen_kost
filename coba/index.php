<?php
include "koneksi.php";
require_once("phpmailer/class.phpmailer.php");
require_once("phpmailer/class.smtp.php");

if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error().'call Marvin Priyatno';
}

function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
	
/* kueri lama ambil dari transaksi
SELECT
	DISTINCT(transaksi.kode_kamar),
	transaksi.id_konsumen,
	kamar.tanggal_masuk,
	kamar.harga_kamar,
	konsumen.nama_konsumen,
	konsumen.hp,
	DATE_ADD( kamar.tanggal_masuk, INTERVAL 1 MONTH ) AS jatuh_tempo
FROM
	transaksi
	INNER JOIN konsumen ON konsumen.id_konsumen = transaksi.id_konsumen 
	INNER JOIN kamar  ON kamar.konsumen_aktif = transaksi.id_konsumen
WHERE
	konsumen.`status` = 'aktif' 
	AND transaksi.id_konsumen NOT IN (
	SELECT DISTINCT
		( id_konsumen ) 
	FROM
		transaksi 
	WHERE
		bulan = DATE_FORMAT( CURDATE( ), '%m' ) 
		AND tahun = DATE_FORMAT( CURDATE( ), '%Y' ) 
	) #only not payed yet konsumen
	
	AND SUBSTR( DATE_ADD( kamar.tanggal_masuk, INTERVAL + 1 MONTH ), 9, 2 ) = DATE_FORMAT( DATE_ADD( CURDATE( ), INTERVAL + 2 DAY ), '%d' )
*/

	$date_today = date("d");
	$query  	= "SELECT
						DISTINCT(kamar.kode_kamar),
						kamar.konsumen_aktif,
						kamar.tanggal_masuk,
						kamar.harga_kamar,
						konsumen.nama_konsumen,
						konsumen.hp,
						DATE_ADD( kamar.tanggal_masuk, INTERVAL 1 MONTH ) AS jatuh_tempo 
					FROM
						kamar
						LEFT JOIN konsumen ON konsumen.id_konsumen = kamar.konsumen_aktif
						LEFT JOIN transaksi ON kamar.konsumen_aktif = transaksi.id_konsumen 
						
					WHERE
						konsumen.`status` = 'aktif' 
					#AND 
						#transaksi.id_konsumen NOT IN (SELECT DISTINCT(id_konsumen) FROM transaksi WHERE bulan = DATE_FORMAT( CURDATE( ), '%m' ) and tahun = DATE_FORMAT( CURDATE( ), '%Y' )) #only not payed yet konsumen
					AND 
						SUBSTR( DATE_ADD( kamar.tanggal_masuk, INTERVAL + 1 MONTH ), 9, 2 ) = DATE_FORMAT( DATE_ADD( CURDATE(), INTERVAL + 2 DAY ), '%d' )";

	$data = mysqli_query($koneksi, $query) or die (mysqli_error());

		if($data->num_rows > 0){
		    $laporan='';
	 		// if(getBulan(date('m')) !== 'Desember'){
	 			$laporan.="<h4><b>List Nama Konsumen jatuh tempo ". date('d', strtotime('2 days'))."-".getBulan(date('m'))."-". date('Y')." (2 Hari Lagi)</b></h4>";
	 		// }else{
	 		// 	if (date('d', strtotime('2 days')) == '01' || date('d', strtotime('2 days')) == '02') {
	 		// 		$laporan.="<h4><b>List Nama Konsumen jatuh tempo ". date('d', strtotime('2 days'))."-".getBulan(date('m'))."-". date('Y', strtotime('+1 year'))." (2 Hari Lagi)</b></h4>";
	 		// 	}
	 		// }

		    $laporan .="<br/>";
			$laporan .="<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">";
			$laporan .="<tr style=\"color: blue;\">";
			$laporan .="<td>Kamar</td><td>Nama</td><td>Hp</td><td>periode</td><td>Tagihan</td>";
			$laporan .="</tr>";

			while($row=mysqli_fetch_object($data)){
				// $my_apikey = "TRIAL123456789"; 
				// $destination = "628123456789";
				// $message = "Hai ".$row->nama_konsumen." Taghian kost anda akan jatuh tempo 2 hari lagi ". date('d', strtotime('2 days'))."-".getBulan(date('m'))."-". date('Y'); 
				// $api_url = "http://thirdpartyapiwadomain.com/send_message.php"; 
				// $api_url .= "?apikey=". urlencode ($my_apikey);
				// $api_url .= "&number=". urlencode ($destination );
				// $api_url .= "&text=". urlencode ($message); 
				// $my_result_object = json_decode(file_get_contents($api_url, false)); 
				$laporan .="<tr>";
				$laporan .="<td>$row->kode_kamar</td>";
				$laporan .="<td>$row->nama_konsumen</td>";
				$laporan .="<td>$row->hp</td>";
				if (getBulan(date('m')) !== 'Desember') {
					$laporan .="<td>".substr($row->tanggal_masuk, 8,2) ." ". getBulan(date('m')) ." - ".  substr($row->jatuh_tempo, 8,2) ." ". getBulan(date('m', strtotime('+1 months'))) ." ". date('Y')."</td>";
				}else{
					$laporan .="<td>".substr($row->tanggal_masuk, 8,2) ." Desember ".date('Y')." - ". substr($row->jatuh_tempo, 8,2) ." Januari ". date('Y', strtotime('+1 year'))."</td>";
				}
				$laporan .="<td>Rp. ".number_format($row->harga_kamar,0, ',','.')."</td>";
				$laporan .="</tr>";
			}

			$laporan .="</table>";
			$laporan .="<br/>";
			$laporan .="<h5>*Abaikan email ini jika customer sudah membayar tagihan</h5>";
	    
	    	$sendmail = new PHPMailer();
	    	$sendmail->IsSMTP();
			$sendmail->SMTPAuth   = true;                  // enable SMTP authentication
			$sendmail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$sendmail->Host       = "mail.yourdomain.com";      // sets GMAIL as the SMTP server
			$sendmail->Port       = 465;                   // set the SMTP port
			$sendmail->Username   = "admin@yourdomain.com";  // GMAIL username
			$sendmail->Password   = "yourpassword";            // GMAIL password

		    $sendmail->From       = "admin@yourdomain.com";
			$sendmail->FromName   = "Admin Kost";
			$sendmail->Subject    = "Reminder";
			$sendmail->AltBody    = "Daftar konsumen"; //Text Body
			$sendmail->WordWrap   = 50; // set word wrap

			$sendmail->MsgHTML($laporan);

			$sendmail->AddReplyTo("admin@yourdomain.com","Admin Kost");


			$sendmail->AddAddress("to@gmail.com","to name");
			$sendmail->AddBCC("bcc@gmail.com");
			$sendmail->AddCC("cc@gmail.com");
			$sendmail->IsHTML(true); // send as HTML

			if(!$sendmail->Send()) {
				$now = date('d-m-Y H:i:s');
				$myfile = fopen("log_gagal_email.txt", "w") or error_log("fail open txt for : ".$row->nama_konsumen);
				$txt = "\n Gagal kirim email reminder";
				$txt .= "\n nama : ".$row->nama_konsumen;
				$txt .= "\n error_info : ".$sendmail->ErrorInfo;
				$txt .= "\n time: ".$now;
				fwrite($myfile, $txt);
				fclose($myfile);
				error_log("Gagal kirim email reminder ".$row->nama_konsumen." - ".$sendmail->ErrorInfo, 0);
			} else {
				echo "Message has been sent ".$data->num_rows;
			}
		}
    
    
    	

    
?>