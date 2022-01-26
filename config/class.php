<?php
// error_reporting(0);
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Y-m-d");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");
$datetimes_format = date('Y-m-d H:i:s');
$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");


class Database {
	// properti
	private $dbHost="localhost";
	private $dbUser="kostexcl_admin";
	private $dbPass="Wahyu2018Wahyu";
	private $dbName="kostexcl_kost";
	
	// method koneksi mysql
	function connectMySQL() {
		mysql_connect($this->dbHost, $this->dbUser, $this->dbPass) or die("Gagal Menyambung ke Database");
		mysql_select_db($this->dbName) or die ("Database Tidak Ditemukan di Server"); 
	}
	// method today
	function tanggal_sekarang(){
		$tgl_sekarang = date("Ymd");
		return $tgl_sekarang;
	}



	function ymd_to_dmy($str) {
    if(str_replace(array("-", "/"), "", $str) == "")
        return "";
    return substr($str, 8, 2)."-".substr($str, 5, 2)."-".substr($str, 0, 4);
}

function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = $this->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
}
function bln_db($bulan){
			$x = strlen($bulan);
			if($x == 1){
				$bulan = "0".$bulan;
			}
			return $bulan;		 
}	

function format_angka($angka) {
	$hasil = number_format($angka,0, ",",".");
	//$hasil = isset($hasil) ? $hasil : ''; 
	return $hasil;
}
function ClearKomaTitik($angka) {
	$hasil = str_replace(".", "", $angka);
	return $hasil;
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

	function listBulan($bulan){
		if ($bulan == 1) {
			return 
			'<option value=2>Februari</option>
			 <option value=3>Maret</option>
			 <option value=4>April</option>
			 <option value=5>Mei</option>
			 <option value=6>Juni</option>
			 <option value=7>Juli</option>
			 <option value=8>Agustus</option>
			 <option value=9>September</option>
			 <option value=10>Oktober</option>
			 <option value=11>November</option>
			 <option value=12>Desember</option>
			';
		}else if($bulan == 2){
			return 
			'<option value=3>Maret</option>
			 <option value=4>April</option>
			 <option value=5>Mei</option>
			 <option value=6>Juni</option>
			 <option value=7>Juli</option>
			 <option value=8>Agustus</option>
			 <option value=9>September</option>
			 <option value=10>Oktober</option>
			 <option value=11>November</option>
			 <option value=12>Desember</option>
			';
		}else if($bulan == 3){
			return 
			'<option value=4>April</option>
			 <option value=5>Mei</option>
			 <option value=6>Juni</option>
			 <option value=7>Juli</option>
			 <option value=8>Agustus</option>
			 <option value=9>September</option>
			 <option value=10>Oktober</option>
			 <option value=11>November</option>
			 <option value=12>Desember</option>
			';
		}else if($bulan == 4){
			return 
			'<option value=5>Mei</option>
			 <option value=6>Juni</option>
			 <option value=7>Juli</option>
			 <option value=8>Agustus</option>
			 <option value=9>September</option>
			 <option value=10>Oktober</option>
			 <option value=11>November</option>
			 <option value=12>Desember</option>
			';
		}else if($bulan == 5){
			return 
			'<option value=6>Juni</option>
			 <option value=7>Juli</option>
			 <option value=8>Agustus</option>
			 <option value=9>September</option>
			 <option value=10>Oktober</option>
			 <option value=11>November</option>
			 <option value=12>Desember</option>
			';
		}else if($bulan == 6){
			return 
			'<option value=7>Juli</option>
			 <option value=8>Agustus</option>
			 <option value=9>September</option>
			 <option value=10>Oktober</option>
			 <option value=11>November</option>
			 <option value=12>Desember</option>
			';
		}else if($bulan == 7){
			return 
			'<option value=8>Agustus</option>
			 <option value=9>September</option>
			 <option value=10>Oktober</option>
			 <option value=11>November</option>
			 <option value=12>Desember</option>
			';
		}else if($bulan == 8){
			return 
			'<option value=9>September</option>
			 <option value=10>Oktober</option>
			 <option value=11>November</option>
			 <option value=12>Desember</option>
			';
		}else if($bulan == 9){
			return 
			'<option value=10>Oktober</option>
			 <option value=11>November</option>
			 <option value=12>Desember</option>
			';
		}else if($bulan == 10){
			return 
			'<option value=11>November</option>
			 <option value=12>Desember</option>
			';
		}else if($bulan == 11){
			return 
			'<option value=12>Desember</option>';
		}
	}

	function get_tgl_msk($id_konsumen){
    $row=mysql_fetch_array(mysql_query("SELECT date_format(tanggal_masuk, '%d') tanggal_masuk FROM kamar where konsumen_aktif ='$id_konsumen'"));
		return $row['tanggal_masuk'];
	}

	function get_harga_kamar($kode_kamar){
    $row=mysql_fetch_array(mysql_query("SELECT harga_kamar FROM kamar where kode_kamar ='$kode_kamar'"));
		return $row['harga_kamar'];
	}
		//Buat kode otomatis
	 function buatkode($nomor_terakhir, $kunci, $jumlah_karakter = 0){
    $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
    $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
    $kode = $kunci . $nomor_baru_plus_nol;
    return $kode;}

    function get_kode_oto($field,$table,$kode) {
    //GET Kode Otomastis.........
      $query = "select max($field) as maksi from $table";
      $hasil = mysql_query($query);
      $data_oto  = mysql_fetch_array($hasil);
      $kode_suplier= $this->buatkode($data_oto['maksi'], $kode, 4);
      return $kode_suplier;
  }

  	//Fungsi terbilang
 	function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = $this->kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = $this->kekata($x/10)." puluh". $this->kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . $this->kekata($x - 100);
    } else if ($x <1000) {
        $temp = $this->kekata($x/100) . " ratus" . $this->kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . $this->kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = $this->kekata($x/1000) . " ribu" . $this->kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = $this->kekata($x/1000000) . " juta" . $this->kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = $this->kekata($x/1000000000) . " milyar" . $this->kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = $this->kekata($x/1000000000000) . " trilyun" . $this->kekata(fmod($x,1000000000000));
    }     
        return $temp;
}
 
function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim($this->kekata($x));
    } else {
        $hasil = trim($this->kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}

function get_laporan_gabungan($bulan,$tahun){
	$where = $tahun.'-'.$bulan;
	$data = mysql_query("SELECT id_transaksi,kode_kamar,id_konsumen,total FROM transaksi WHERE tanggal_bayar like '$where%'");
	$data2 = mysql_query("SELECT id_pengeluaran,nama_pengeluaran,jumlah FROM pengeluaran WHERE tanggal like '$where%'");

	while($d=mysql_fetch_array($data)){
		$result[]=$d;
	}

	while($f=mysql_fetch_array($data2)){
		$result2[]=$f;
	}

	$output = array_merge($result,$result2);
	return $output;
}

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

//End Fungsi terbilang

}

class User {
// Proses Login
	function cek_login($username, $password) {
		$password = md5($password);
		$result = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'");
		$user_data = mysql_fetch_array($result);
		$no_rows = mysql_num_rows($result);
		if ($no_rows == 1) {
			$_SESSION['login'] = TRUE;
			$_SESSION['id']    = $user_data['id_users'];
			$_SESSION['level'] = $user_data['level'];
			$_SESSION['nik']   = $user_data['nik'];
			return TRUE;
		}
		else {
		  return FALSE;
		}
	}

	
	 
	// Ambil Sesi 
	function get_sesi() {
		$session = isset($_SESSION['login']) ? $_SESSION['login'] : ''; 
		return $session;
	}


	// Logout 
	function user_logout() {
		$_SESSION['login'] = FALSE;
		session_destroy();
	}

	// ambil nama
	function ambilNama($id)
	{
		$query = mysql_query("SELECT * FROM users WHERE id_users='$id'");
		$row = mysql_fetch_array($query);
		echo $row['nama_users'];
	}

	// cek Nik
	function cekNik($nik)
	{
	// Cek NIK
		
		$result=mysql_query("SELECT nik FROM users WHERE nik='$nik'");
		$found=mysql_num_rows($result);
		return $found;
	
	}

		// cek nama
	function CekNama($kode){
		$result=mysql_query("SELECT * FROM users where nik ='$kode'");
		$found=mysql_num_rows($result);
	if($found>0){
    $row=mysql_fetch_array($result);{
	echo $row['nama_users'];
	}
 	}else{echo "";}
	}

	// tampilkan data dari tabel users 
	function tampil_data(){
		$data=mysql_query("SELECT * FROM users");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}


	// tampilkan data dari tabel users tertentu
	function tampil_data_based_on_nik($nik){
		$data=mysql_query("SELECT * FROM users WHERE nik='$nik'");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}

	// proses input data user
	function input_user($nik,$nama_users,$username,$pwd,$level){
		mysql_query("INSERT INTO users (nik,nama_users,username,password,level) VALUES ('$nik','$nama_users','$username','$pwd','$level')");
	}

	// tampilkan data dari tabel users yang akan di edit 
	function edit_user($id){
		$data=mysql_query("SELECT * FROM users WHERE id_users='$id'");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	// proses update data user
	function update_user($id,$nik,$nama_users,$username,$pwd,$level){
		mysql_query("UPDATE users SET nik='$nik',nama_users='$nama_users',username='$username',password='$pwd',level='$level' WHERE id_users='$id'");
	}

	// proses delete data user
	function hapus_user($id){
		mysql_query("DELETE FROM users where id_users='$id'");
	}

	//cek jumlah users
	function total_users() {
		$result = mysql_query("SELECT * FROM users");
		$no_rows = mysql_num_rows($result);
		return $no_rows;
	}

}

//Public Class kamar
class kamar{
// tampilkan data dari tabel kamar 
	function tampil_data_kamar(){
		$data=mysql_query("SELECT * FROM kamar ORDER BY tanggal_masuk ASC");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}
	
	function tampil_data_kamar_laporan($bulan,$tahun){
		$data=mysql_query("SELECT kamar.* FROM kamar INNER JOIN konsumen ON konsumen.id_konsumen = kamar.konsumen_aktif WHERE konsumen.`status` = 'aktif'  ORDER BY kamar.tanggal_masuk ASC");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}
	

	function tampil_data_kamar_bayar($bulan,$tahun){
		function dateFormat($date, $format = 'd F Y'){
	    	$newFormat = date($format,  strtotime($date));
	    	return $newFormat;
		}
		$Tanggal1		= dateFormat($tahun."-".$bulan."-01","Y-m-d");
		$Max_Month 		= dateFormat($Tanggal1,"t");
		$Tanggal2		= dateFormat($tahun."-".$bulan."-".$Max_Month,"Y-m-d");
		$data=mysql_query("SELECT kamar.* FROM kamar INNER JOIN konsumen ON konsumen.id_konsumen = kamar.konsumen_aktif WHERE konsumen.`status` = 'aktif'  AND kamar.tanggal_masuk <= '$Tanggal2' ORDER BY kamar.tanggal_masuk ASC");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}

	function buatkodetr($nomor_terakhir, $kunci, $jumlah_karakter = 0){
	    $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
	    $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
	    $kode = $kunci . $nomor_baru_plus_nol;
	    return $kode;
	}

    function get_kode_ototr($field,$table,$kode) {
    //GET Kode Otomastis.........
      $query = "select max($field) as maksi from $table";
      $hasil = mysql_query($query);
      $data_oto  = mysql_fetch_array($hasil);
      $kode_suplier= $this->buatkodetr($data_oto['maksi'], $kode, 4);
      return $kode_suplier;
	}
// proses input data kamar
	function input_kamar($kode_kamar,$nama_kamar,$harga_kamar,$konsumen_aktif,$konsumen_aktif2,$tanggal_masuk){
		
		$id_transaksi = $this->get_kode_ototr('id_transaksi','transaksi','T');
		$bulan = substr($tanggal_masuk, 5,2);
		$tahun = substr($tanggal_masuk, 0,4);

		if ($bulan== '01') {
			$bulan = '1';
		}else if ($bulan== '02') {
			$bulan = '2';
		}else if ($bulan== '03') {
			$bulan = '3';
		}else if ($bulan== '04') {
			$bulan = '4';
		}else if ($bulan== '05') {
			$bulan = '5';
		}else if ($bulan== '06') {
			$bulan = '6';
		}else if ($bulan== '07') {
			$bulan = '7';
		}else if ($bulan== '08') {
			$bulan = '8';
		}else if ($bulan== '09') {
			$bulan = '9';
		}

		// $inputkamar = mysql_query("INSERT INTO kamar (kode_kamar,nama_kamar,harga_kamar,konsumen_aktif,tanggal_masuk,langsungbayar,carabayar) VALUES ('$kode_kamar','$nama_kamar','$harga_kamar','$konsumen_aktif','$tanggal_masuk','$langsungbayar','$carabayar')");
		$inputkamar = mysql_query("INSERT INTO kamar (kode_kamar,nama_kamar,harga_kamar,konsumen_aktif,konsumen_aktif2,tanggal_masuk) VALUES ('$kode_kamar','$nama_kamar','$harga_kamar','$konsumen_aktif','$konsumen_aktif2','$tanggal_masuk')");
		// if ($inputkamar) {
			
		// 	$inputtr = mysql_query("INSERT INTO transaksi (id_transaksi,kode_kamar,id_konsumen,total,tanggal_bayar,bulan,tahun,status) VALUES ('$id_transaksi','$kode_kamar','$konsumen_aktif','$harga_kamar','$tanggal_masuk','$bulan','$tahun','Bayar')");
		// 	if ($inputtr) {
					
		// 	}else{
		// 		echo "gagal input tr , segera hubungi marvin";
		// 		redirect('localhost/pondokcahyaning');
		// 		//echo mysql_errno();
		// 		//echo mysql_error();
		// 		//var_dump($inputtr);
		// 		//die();
		// 	}
		// }
	}

	// tampilkan data dari tabel kamar yang akan di edit 
	function edit_kamar($id){
		$data=mysql_query("SELECT * FROM kamar WHERE kode_kamar='$id'");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	// Combo data kamar
	function combokamar(){
		$data=mysql_query("SELECT * FROM kamar  ORDER BY nama_kamar");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	function comboHargaKamar(){
		$data=mysql_query("SELECT * FROM hargakamar ORDER BY idHargaKamar");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}


	// proses update data kamar
	function update_kamar($id,$nama_kamar,$harga_kamar,$konsumen_aktif,$konsumen_aktif2,$tanggal_masuk){
		mysql_query("UPDATE kamar SET nama_kamar='$nama_kamar',harga_kamar='$harga_kamar',konsumen_aktif='$konsumen_aktif',konsumen_aktif2='$konsumen_aktif2',tanggal_masuk='$tanggal_masuk' WHERE kode_kamar='$id'");
	}

	// proses delete data kamar
	function hapus_kamar($id){
		mysql_query("DELETE FROM kamar where kode_kamar='$id'");
	}
	
	// proses delete data kamar
	function hapus_transaksi($id){
		mysql_query("DELETE FROM transaksi where kode_kamar='$id'");
	}

	// cek nama
	function GetNamakamar($id){
    $row=mysql_fetch_array(mysql_query("SELECT * FROM kamar where kode_kamar ='$id'"));
		echo $row['nama_kamar'];
	}
	
		// ambil nama
	function Get_Konsumen_aktif_On_Data_Kamar($id)
	{
		$query = mysql_query("SELECT * FROM kamar WHERE kode_kamar='$id'");
		$row = mysql_fetch_array($query);
		$konsumen=$row['konsumen_aktif'];
		return $konsumen;
	}
	function Get_Konsumen2_aktif_On_Data_Kamar($id)
	{
		$query = mysql_query("SELECT konsumen_aktif2 FROM kamar WHERE kode_kamar='$id'");
		$row = mysql_fetch_array($query);
		$konsumen=$row['konsumen_aktif2'];
		return $konsumen;
	}
	
			// ambil nama
	function Get_Harga_Kamar($id)
	{
		$query = mysql_query("SELECT * FROM kamar WHERE kode_kamar='$id'");
		$row = mysql_fetch_array($query);
		$harga=$row['harga_kamar'];
		return $harga;
	}

	//cek jumlah kamar
	function total_kamar() {
		$result = mysql_query("SELECT * FROM kamar WHERE konsumen_aktif = '0' OR konsumen_aktif IS NULL ");
		$no_rows = mysql_num_rows($result);
		return $no_rows;
	}

}

//Public Class pengeluaran
class pengeluaran{
// tampilkan data dari tabel pengeluaran 
	function tampil_data_pengeluaran(){
		$data=mysql_query("SELECT * FROM pengeluaran");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}

	function tampil_data_pengeluaran_tahunan($tahun){
		$data=mysql_query("SELECT * FROM pengeluaran WHERE tanggal LIKE '$tahun%' ORDER BY tanggal ASC");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}

	function tampil_data_pengeluaran_bulanan($tahun,$bulan){
		$data=mysql_query("SELECT * FROM pengeluaran WHERE tanggal LIKE '$tahun".'-'."$bulan%' ORDER BY tanggal ASC");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}

	function sum_All_Pengeluaran($tahun){
		$zz=mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS TotalUang FROM pengeluaran WHERE tanggal LIKE '$tahun%' "));
		$dataku=$zz['TotalUang'];
		return $dataku;
	}

	function sum_Pengeluaran_Bulanan($tahun,$bulan){
		$zz=mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS TotalUang FROM pengeluaran WHERE tanggal  LIKE '$tahun-$bulan%' "));
		$dataku=$zz['TotalUang'];
		return $dataku;
	}
// proses input data pengeluaran
	function input_pengeluaran($id_pengeluaran,$nama_pengeluaran,$jumlah,$tanggal){
		mysql_query("INSERT INTO pengeluaran (id_pengeluaran,nama_pengeluaran,jumlah,tanggal) VALUES ('$id_pengeluaran','$nama_pengeluaran','$jumlah','$tanggal')");
	}

	// tampilkan data dari tabel pengeluaran yang akan di edit 
	function edit_pengeluaran($id){
		$data=mysql_query("SELECT * FROM pengeluaran WHERE id_pengeluaran='$id'");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	// Combo data pengeluaran
	function combopengeluaran(){
		$data=mysql_query("SELECT * FROM pengeluaran  ORDER BY nama_pengeluaran");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}


	// proses update data pengeluaran
	function update_pengeluaran($id,$nama_pengeluaran,$jumlah,$tanggal){
		mysql_query("UPDATE pengeluaran SET nama_pengeluaran='$nama_pengeluaran',jumlah='$jumlah',tanggal='$tanggal' WHERE id_pengeluaran='$id'");
	}

	// proses delete data pengeluaran
	function hapus_pengeluaran($id){
		mysql_query("DELETE FROM pengeluaran where id_pengeluaran='$id'");
	}
	
	// // proses delete data kamar
	// function hapus_transaksi($id){
	// 	mysql_query("DELETE FROM pengeluaran where id_pengeluaran='$id'");
	// }

	// cek nama
	function GetNamapengeluaran($id){
    $row=mysql_fetch_array(mysql_query("SELECT * FROM pengeluaran where id_pengeluaran ='$id'"));
	echo $row['nama_pengeluaran'];
	}
	
		// ambil nama
	/*function Get_Konsumen_aktif_On_Data_Kamar($id)
	{
		$query = mysql_query("SELECT * FROM kamar WHERE kode_kamar='$id'");
		$row = mysql_fetch_array($query);
		$konsumen=$row['konsumen_aktif'];
		return $konsumen;
	}
	
			// ambil nama
	function Get_Harga_Kamar($id)
	{
		$query = mysql_query("SELECT * FROM kamar WHERE kode_kamar='$id'");
		$row = mysql_fetch_array($query);
		$harga=$row['harga_kamar'];
		return $harga;
	}*/

	//cek jumlah pengeluaran
	//function total_kamar() {
		//$result = mysql_query("SELECT * FROM kamar WHERE konsumen_aktif <> '0'");
		//$no_rows = mysql_num_rows($result);
		//return $no_rows;
	//}

}

//Public Class konsumen
class konsumen{
// tampilkan data dari tabel konsumen 
	function tampil_data(){
		$data=mysql_query("SELECT * FROM  konsumen");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}
// proses input data konsumen
	function input_konsumen($id_konsumen,$nama_konsumen,$nik,$tempatlahir,$tgllahir,$jekel,$agama,$pekerjaan,$statuskawin,$namaistri,$anak1,$anak2,$anak3,$anak4,$alamat_konsumen,$hp,$status){
		mysql_query("INSERT INTO konsumen (id_konsumen,nama_konsumen,nik,tempatlahir,tgllahir,jekel,agama,pekerjaan,statuskawin,namaistri,anak1,anak2,anak3,anak4,alamat_konsumen,hp,status) VALUES ('$id_konsumen','$nama_konsumen','$nik','$tempatlahir','$tgllahir','$jekel','$agama','$pekerjaan','$statuskawin','$namaistri','$anak1','$anak2','$anak3','$anak4','$alamat_konsumen','$hp','$status')");
	}

	// tampilkan data dari tabel konsumen yang akan di edit 
	function edit_konsumen($id){
		$data=mysql_query("SELECT * FROM konsumen WHERE id_konsumen='$id'");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	// Combo data konsumen
	function comboKonsumen(){
		$data=mysql_query("SELECT * FROM konsumen WHERE status='aktif' ORDER BY nama_konsumen");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	function comboKonsumenTambah(){
		$data=mysql_query("SELECT * FROM konsumen WHERE status='aktif' AND id_konsumen NOT IN (SELECT konsumen_aktif FROM kamar UNION ALL SELECT konsumen_aktif2 FROM kamar WHERE konsumen_aktif2 != '0') ORDER BY nama_konsumen");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	function countKomsumenKosong() {
		$result = mysql_query("SELECT * FROM konsumen WHERE status='aktif' AND id_konsumen NOT IN (SELECT konsumen_aktif FROM kamar)");
		$no_rows = mysql_num_rows($result);
		return $no_rows;
	}


	// proses update data konsumen id_konsumen,nama_konsumen,nik,tempatlahir,tgllahir,jekel,agama,pekerjaan,statuskawin,namaistri,anak1,anak2,anak3,anak4,tanggal_masuk,alamat_konsumen,hp,tanggal_keluar,status
	function update_konsumen($id_konsumen,$nama_konsumen,$nik,$tempatlahir,$tgllahir,$jekel,$agama,$pekerjaan,$statuskawin,$namaistri,$anak1,$anak2,$anak3,$anak4,$alamat_konsumen,$hp,$tglkeluar,$status){
		mysql_query("UPDATE konsumen SET nama_konsumen='$nama_konsumen',nik='$nik',tempatlahir='$tempatlahir',tgllahir='$tgllahir',agama='$agama',pekerjaan='$pekerjaan',statuskawin='$statuskawin',namaistri='$namaistri',anak1='$anak1',anak2='$anak2',anak3='$anak3',anak4='$anak4',alamat_konsumen='$alamat_konsumen',hp='$hp',tanggal_keluar='$tglkeluar',status='$status' WHERE id_konsumen='$id_konsumen'");
		
	}

	// proses delete data konsumen
	function hapus_konsumen($id){
		mysql_query("DELETE FROM konsumen where id_konsumen='$id'");
	}

	// cek nama
	function GetNamaKonsumen($id){
	    $row=mysql_fetch_array(mysql_query("SELECT * FROM konsumen where id_konsumen ='$id'"));
		$nama=$row['nama_konsumen'];
		return $nama;
	}

	function GetNamaKonsumenAktif($id){
	    $row=mysql_fetch_array(mysql_query("SELECT * FROM konsumen where status ='aktif'"));
		$nama=$row['nama_konsumen'];
		return $nama;
	}

		// cek Alamat
	function GetAlamatKonsumen($id){
    $row=mysql_fetch_array(mysql_query("SELECT * FROM konsumen where id_konsumen ='$id'"));
	echo $row['alamat_konsumen'];
	}

		// cek Alamat
	function GetHpKonsumen($id){
    $row=mysql_fetch_array(mysql_query("SELECT * FROM konsumen where id_konsumen ='$id'"));
	echo $row['hp'];
	}
	
	// cek id konsumen on transaksi
	function GetNamaKonsumenOnTransaksi($id){
    $row=mysql_fetch_array(mysql_query("SELECT * FROM transaksi where id_transaksi ='$id'"));
	$nama=$this->GetNamaKonsumen($row['id_konsumen']);
	if ($this->GetNamaKonsumen($row['id_konsumen2'])) {
		$nama = $nama ." dan ".$this->GetNamaKonsumen($row['id_konsumen2']);
	}
	return $nama;
	}

	//cek jumlah kamar
	function total_konsumen() {
		$result = mysql_query("SELECT * FROM konsumen WHERE Status = 'aktif' ");
		$no_rows = mysql_num_rows($result);
		return $no_rows;
	}

	function get_warga_bulanan($tahun,$bulan){
		$tgl = $tahun.'-'.$bulan;
		$data=mysql_query("SELECT a.nama_konsumen, a.nik, a.jekel, CONCAT(a.tempatlahir,'/',a.tgllahir)as ttl, a.alamat_konsumen, a.pekerjaan, b.nama_kamar FROM `konsumen` a
INNER JOIN kamar b ON a.id_konsumen = b.konsumen_aktif 
WHERE a.tanggal_keluar IS NULL
AND a.`status` = 'aktif'
AND date_format(b.tanggal_masuk,'%Y-%m') <= '$tgl'
OR a.tanggal_keluar = ''
AND a.`status` = 'aktif'
AND date_format(b.tanggal_masuk,'%Y-%m') <= '$tgl'
UNION ALL
SELECT a.nama_konsumen, a.nik, a.jekel, CONCAT(a.tempatlahir,'/',a.tgllahir)as ttl, a.alamat_konsumen, a.pekerjaan, c.nama_kamar FROM `konsumen` a
INNER JOIN kamar c ON a.id_konsumen = c.konsumen_aktif2 
WHERE a.tanggal_keluar IS NULL
AND a.`status` = 'aktif'
AND date_format(c.tanggal_masuk,'%Y-%m') <= '$tgl'
OR a.tanggal_keluar = ''
AND a.`status` = 'aktif'
AND date_format(c.tanggal_masuk,'%Y-%m') <= '$tgl'

ORDER BY nama_kamar ASC");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}



}


//Public Class transaksi
class Transaksi{
	
	function get_kode_oto($field,$table,$kode) {
    //GET Kode Otomastis.........
      $query = "select max($field) as maksi from $table";
      $hasil = mysql_query($query);
      $data_oto  = mysql_fetch_array($hasil);
      $kode_suplier= $this->buatkode($data_oto['maksi'], $kode, 4);
      return $kode_suplier;
  	}
  	
  	function buatkode($nomor_terakhir, $kunci, $jumlah_karakter = 0){
	    $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
	    $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
	    $kode = $kunci . $nomor_baru_plus_nol;
	    return $kode;
	}

	function getJatuhTempo($tanggal_masuk){	
		$DateTemp 	= date($tanggal_masuk);
		$Date		= date_create($DateTemp);
		date_add($Date,date_interval_create_from_date_string("30 days"));
		$JatuhTempo = date_format($Date,"Y-m-d");
		return $JatuhTempo;
	
	}

	//get laporan transaksi bulanan
	function get_transaksi_bulanan($bulan,$tahun) {

		$data = mysql_query("SELECT * FROM transaksi WHERE bulan='$bulan' AND tahun='$tahun' ORDER BY kode_kamar ASC");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}

	// proses input data transaksi
	function input_transaksi($id_transaksi,$kode_kamar,$id_konsumen,$id_konsumen2,$total,$tambahan,$tanggal_bayar,$bulan,$tahun){
		mysql_query("INSERT INTO transaksi (id_transaksi,kode_kamar,id_konsumen,id_konsumen2,total,tambahan,tanggal_bayar,bulan,tahun) VALUES ('$id_transaksi','$kode_kamar','$id_konsumen','$id_konsumen2','$total','$tambahan','$tanggal_bayar','$bulan','$tahun')");
	}

	function input_transaksi_2($id_transaksi,$kode_kamar,$id_konsumen,$total,$tanggal_bayar,$bulan1,$bulan2,$tahun){
		$c = 12;
		if($bulan1 < $bulan2){ // jika bulan 1 < bulan 2 maka tahun sama
			for ($i=$bulan1; $i <= $bulan2 ; $i++) {
				$id_transaksi = $this->get_kode_oto('id_transaksi','transaksi','TR');
				mysql_query("INSERT INTO transaksi (id_transaksi,kode_kamar,id_konsumen,total,tanggal_bayar,bulan,tahun) VALUES ('$id_transaksi','$kode_kamar','$id_konsumen','$total','$tanggal_bayar','$i','$tahun')");
			}
		}else{ // jika bulan 1 > atau = bulan 2 maka input lanjut ke tahun berikutnya +1 tahun
			for ($i=$bulan1; $i <= $c ; $i++) {
				if($i == 12){
					$id_transaksi = $this->get_kode_oto('id_transaksi','transaksi','TR');
					mysql_query("INSERT INTO transaksi (id_transaksi,kode_kamar,id_konsumen,total,tanggal_bayar,bulan,tahun) VALUES ('$id_transaksi','$kode_kamar','$id_konsumen','$total','$tanggal_bayar','$i','$tahun')");
					$tahun = $tahun+1;
					$c = $bulan2;
					$i = 1;
		 		} 
					$id_transaksi = $this->get_kode_oto('id_transaksi','transaksi','TR');
					mysql_query("INSERT INTO transaksi (id_transaksi,kode_kamar,id_konsumen,total,tanggal_bayar,bulan,tahun) VALUES ('$id_transaksi','$kode_kamar','$id_konsumen','$total','$tanggal_bayar','$i','$tahun')");
			}
		}
	}

	//cek jumlah Transaksi Open
	function Get_status_bayar($kamar,$bulan,$tahun) {
		$result = mysql_query("SELECT * FROM transaksi WHERE kode_kamar='$kamar' AND bulan='$bulan' AND tahun='$tahun'");
		$total = mysql_num_rows($result);
		return $total;
	}
	
	//cek no Transaksi pembayaran
	function Get_No_Bayar($kamar,$bulan,$tahun) {
		$result = mysql_query("SELECT * FROM transaksi WHERE kode_kamar='$kamar' AND bulan='$bulan' AND tahun='$tahun'");
		$x = mysql_fetch_array($result);
		$hasil=$x['id_transaksi'];
		return $hasil;
	}

	//cek no Transaksi pembayaran
	function Get_data_field($kamar,$bulan,$tahun,$table) {
		$result = mysql_query("SELECT * FROM transaksi WHERE kode_kamar='$kamar' AND bulan='$bulan' AND tahun='$tahun'");
		$x = mysql_fetch_array($result);
		$hasil=$x[$table];
		return $hasil;
	}
		
	
	// proses delete data konsumen
	function hapus_transaksi($id){
		mysql_query("DELETE FROM transaksi where id_transaksi='$id'");
	}
	
	// tampilkan data dari tabel transaksi yang akan di edit 
	function edit_transaksi($id){
		$data=mysql_query("SELECT * FROM transaksi WHERE id_transaksi='$id'");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	//Summ data
	function sum_All_Transaksi($tahun){
		$zz=mysql_fetch_array(mysql_query("SELECT SUM(total) AS TotalUang FROM transaksi WHERE tanggal_bayar LIKE '$tahun%' "));
		$dataku=$zz['TotalUang'];
		return $dataku;
	}

	//Summ data
	function sum_by_month_Transaksi($bulan,$tahun){
		$zz=mysql_fetch_array(mysql_query("SELECT SUM(total) AS TotalUang FROM transaksi WHERE bulan='$bulan' AND tahun='$tahun'"));
		$dataku=$zz['TotalUang'];
		return $dataku;
	}

	//Total yang sudah bayar
	function Get_bayar_this_month($bulan,$tahun) {
		$result = mysql_query("SELECT * FROM transaksi WHERE bulan='$bulan' AND tahun='$tahun'");
		$total = mysql_num_rows($result);
		return $total;
	}

	function GetBulan($bulan){
	    if ($bulan == 1) {
	    	$bulan = "Januari";
	    	return $bulan;
	    }else if ($bulan == 2) {
	    	$bulan = "Februari";
	    	return $bulan;
	    }else if ($bulan == 3) {
	    	$bulan = "Maret";
	    	return $bulan;
	    }else if ($bulan == 4) {
	    	$bulan = "April";
	    	return $bulan;
	    }else if ($bulan == 5) {
	    	$bulan = "Mei";
	    	return $bulan;
	    }else if ($bulan == 6) {
	    	$bulan = "Juni";
	    	return $bulan;
	    }else if ($bulan == 7) {
	    	$bulan = "Juli";
	    	return $bulan;
	    }else if ($bulan == 8) {
	    	$bulan = "Agustus";
	    	return $bulan;
	    }else if ($bulan == 9) {
	    	$bulan = "September";
	    	return $bulan;
	    }else if ($bulan == 10) {
	    	$bulan = "Oktober";
	    	return $bulan;
	    }else if ($bulan == 11) {
	    	$bulan = "November";
	    	return $bulan;
	    }else if ($bulan == 12) {
	    	$bulan = "Desember";
	    	return $bulan;
	    }
	}
	
	
	
}

class Harga{
// tampilkan data dari tabel kamahargar 
	function tampil_data_harga(){
		$data=mysql_query("SELECT * FROM hargakamar order by lantaiKamar");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}

	function input_harga($nama,$harga_kamar){
		mysql_query("INSERT INTO hargakamar (lantaiKamar,hargaKamar) VALUES ('$nama','$harga_kamar')");
	}

	// tampilkan data dari tabel harga yang akan di edit 
	function edit_harga($id){
		$data=mysql_query("SELECT * FROM hargakamar WHERE idHargakamar='$id'");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	// proses update data harga
	function update_harga($id,$nama_kamar,$harga_kamar){
		mysql_query("UPDATE hargakamar SET lantaiKamar='$nama_kamar',hargaKamar='$harga_kamar' WHERE idHargakamar=$id");
	}

}


class QRGenerator { 

    protected $size; 
    protected $data; 
    protected $encoding; 
    protected $errorCorrectionLevel; 
    protected $marginInRows; 
    protected $debug; 

    public function __construct($data='http://www.phpgang.com',$size='300',$encoding='UTF-8',$errorCorrectionLevel='L',$marginInRows=4,$debug=false) { 

        $this->data=urlencode($data); 
        $this->size=($size>100 && $size<800)? $size : 100; 
        $this->encoding=($encoding == 'Shift_JIS' || $encoding == 'ISO-8859-1' || $encoding == 'UTF-8') ? $encoding : 'UTF-8'; 
        $this->errorCorrectionLevel=($errorCorrectionLevel == 'L' || $errorCorrectionLevel == 'M' || $errorCorrectionLevel == 'Q' || $errorCorrectionLevel == 'H') ?  $errorCorrectionLevel : 'L';
        $this->marginInRows=($marginInRows>0 && $marginInRows<10) ? $marginInRows:4; 
        $this->debug = ($debug==true)? true:false;     
    }
public function generate(){ 

        $QRLink = "https://chart.googleapis.com/chart?cht=qr&chs=".$this->size."x".$this->size.                            "&chl=" . $this->data .  
                   "&choe=" . $this->encoding . 
                   "&chld=" . $this->errorCorrectionLevel . "|" . $this->marginInRows; 
        if ($this->debug) echo   $QRLink;          
        return $QRLink; 
    }

  }
