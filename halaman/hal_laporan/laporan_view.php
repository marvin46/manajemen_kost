<?php
session_start();
include_once '../../config/class.php';
$db = new Database();
$user= new User();
$transaksi= new Transaksi();
$kamar= new kamar();
$pengeluaran= new pengeluaran();
$konsumen= new Konsumen();
// koneksi ke MySQL via method
$db->connectMySQL();
?>
<html>
<head>
<title>LAPORAN <?php echo $_POST['berdasar'] ?></title>
<link rel="icon" href="https://yourdomain.com/favicon.png"/>
<style type="text/css">
body,td,td { 
  font-family: Courier New, Courier, monospace;
}
body{
  
  font-size:12px;
  color:#333;
  background-position:top;
  background-color:#fff;
}
.table-list {
  clear: both;
  border-collapse: collapse;
  margin: 0px 0px 10px 0px;
  background:#fff;
  width:80%;
}

.table-list td {
  color: #333;
  font-size:14px;
  border-color: #fff;
  border-collapse: collapse;
  vertical-align: center;
  border:1px #CCCCCC solid;
}

.table-list th {
  color: #333;
  font-size:18px;
  border-color: #fff;
  border-collapse: collapse;
  vertical-align: center;
  border:1px #CCCCCC solid;
   text-align: center;
}
-->
</style>
</head>
<body>
<center>
<h2> LAPORAN <?php echo $_POST['berdasar'] ?> </h2>

<?php 

if($_POST['berdasar'] == "Semua Data Transaksi"){
  echo"<h3>TAHUN $_POST[tahunan]</h3>";
  echo"<table class='table-list'>
          <thead>
            <tr>
              <th style=\"color:#FFF; background-color:#DC143C;\" width='5%'>No</th>
              <th style=\"color:#FFF; background-color:#DC143C;\">Kode Kamar</th>
              <th style=\"color:#FFF; background-color:#DC143C;\">Tagihan Bulan</th>
              <th style=\"color:#FFF; background-color:#DC143C;\">Nomer Kamar</th>
				      <th style=\"color:#FFF; background-color:#DC143C;\">Konsumen/Penghuni Aktif</th>
              <th style=\"color:#FFF; background-color:#DC143C;\">Tanggal Bayar</th>
              <th style=\"color:#FFF; background-color:#DC143C;\">Total</th>
				      <th style=\"color:#FFF; background-color:#DC143C;\">Status</th>
            </tr>
          </thead>
          <tbody>";
            
  $jumlah = 13;
  for($i=1; $i<$jumlah; $i++){
    $arr=$kamar->tampil_data_kamar_laporan(12,$_POST['tahunan']);
    foreach($arr ? $arr : [] as $d):
      if (substr($d['tanggal_masuk'],5,2) <= $i) {
	      if ($kamar->Get_Konsumen2_aktif_On_Data_Kamar($d['kode_kamar'])) {
	        $konsumen2 = $konsumen->GetNamaKonsumen($kamar->Get_Konsumen2_aktif_On_Data_Kamar($d['kode_kamar']));
	        $konsumen2 = " dan ".$konsumen2;
	      }else{
	        $konsumen2 = "";
	      }
	      echo"
	            <tr>
	              <td rowspan=''><center>$i</center></td>
	              <td><center>$d[kode_kamar]</center></td>
	              <td><center>".$db->getBulan($i)."</center></td>
	              <td><center>&nbsp;$d[nama_kamar]</center></td>";
	      if($transaksi->Get_status_bayar($d['kode_kamar'],$i,$_POST['tahunan'])>0){
	        echo"
	              <td>&nbsp;".$konsumen->GetNamaKonsumenOnTransaksi($transaksi->Get_No_Bayar($d['kode_kamar'],$i,$_POST['tahunan']))."</td>";
	      }else{ 
	        echo" <td>&nbsp;".$konsumen->GetNamaKonsumen($d['konsumen_aktif']).$konsumen2."</td>"; 
	      }
	      echo"   <td><center>";
	      if($transaksi->Get_status_bayar($d['kode_kamar'],$i,$_POST['tahunan'])>0){
	        echo"".$transaksi->Get_data_field($d['kode_kamar'],$i,$_POST['tahunan'],'tanggal_bayar')."";
	      }else{
	        echo"-";
	      }
	      echo"   </center></td>";

	      echo"   <td><center>";
	      if($transaksi->Get_status_bayar($d['kode_kamar'],$i,$_POST['tahunan'])>0){
	        echo"".$db->format_angka($transaksi->Get_data_field($d['kode_kamar'],$i,$_POST['tahunan'],'total'))."";
	      }else{
	        echo"-";
	      }
	      echo"   </center></td>";
	      echo"   <td><center>";
	      if($transaksi->Get_status_bayar($d['kode_kamar'],$i,$_POST['tahunan'])>0){
	        echo"Sudah Bayar";
	      }else{
	        echo"Belum Bayar";
	      }
	      echo"   </center></td>";
	      echo"</tr>";
	  	  }
      endforeach;
  } //end for  
  echo" <tr>
          <th style=\"color:#FFF; background-color:#DC143C;\" colspan='6'>Grand Total</th>
          <th style=\"color:#FFF; background-color:#DC143C;\" colspan='2'>Rp. ".$db->format_angka($transaksi->sum_All_Transaksi($_POST['tahunan']))."</th>
        </tr>
      </tbody>
    </table>";

}else if($_POST['berdasar'] == "Bulan Transaksi"){
            
            echo"<h3>BULAN ".strtoupper($db->getBulan($_POST['bulan']))." $_POST[tahun]</h3>";
            echo"<table class='table-list'>
              <thead>
                <tr>
                  <th style=\"color:#FFF; background-color:#DC143C;\" width='5%'>No</th>
                  <th style=\"color:#FFF; background-color:#DC143C;\">Kode Kamar</th>
                  <th style=\"color:#FFF; background-color:#DC143C;\">Nomer Kamar</th>
                  <th style=\"color:#FFF; background-color:#DC143C;\">Konsumen/Penghuni Aktif</th>
                  <th style=\"color:#FFF; background-color:#DC143C;\">Tanggal Bayar</th>
                  <th style=\"color:#FFF; background-color:#DC143C;\">Total</th>
                  <th style=\"color:#FFF; background-color:#DC143C;\">Status</th>
                </tr>
              </thead>
             <tbody>";
              $no=1;
              $arr=$kamar->tampil_data_kamar_laporan($_POST['bulan'],$_POST['tahunan']);
              foreach($arr ? $arr : [] as $d):
            if (substr($d['tanggal_masuk'],0,4) <= $_POST['tahun'] && substr($d['tanggal_masuk'],5,2) <= $_POST['bulan']) {
               if ($kamar->Get_Konsumen2_aktif_On_Data_Kamar($d['kode_kamar'])) {
                 $konsumen2 = $konsumen->GetNamaKonsumen($kamar->Get_Konsumen2_aktif_On_Data_Kamar($d['kode_kamar']));
                 $konsumen2 = " dan ".$konsumen2;
               }else{
                 $konsumen2 = "";
               }
               echo"<tr class='odd gradeA'>
                 <td><center>$no</center></td>
                 <td><center>$d[kode_kamar]</center></td>
                 <td><center>$d[nama_kamar]</center></td>";
	          if($transaksi->Get_status_bayar($d['kode_kamar'],$_POST['bulan'],$_POST['tahun'])>0){
	            echo" <td>".$konsumen->GetNamaKonsumenOnTransaksi($transaksi->Get_No_Bayar($d['kode_kamar'],$_POST['bulan'],$_POST['tahun']))."</td>";
	          }else {
	            echo" <td>".$konsumen->GetNamaKonsumen($d['konsumen_aktif']).$konsumen2."</td>";
	          }

	          echo"   <td><center>";

	          if($transaksi->Get_status_bayar($d['kode_kamar'],$_POST['bulan'],$_POST['tahun'])>0){
	            echo"".$transaksi->Get_data_field($d['kode_kamar'],$_POST['bulan'],$_POST['tahun'],'tanggal_bayar')."";
	          }else{
	            echo"-";
	          }

	          echo"   </center></td>";

	          echo"   <td><center>";
	          if($transaksi->Get_status_bayar($d['kode_kamar'],$_POST['bulan'],$_POST['tahun'])>0){
	            echo"".$db->format_angka($transaksi->Get_data_field($d['kode_kamar'],$_POST['bulan'],$_POST['tahun'],'total'))."";
	          }else{
	            echo"-";
	          }
	          
	          echo"   </center></td>";

	          echo"   <td><center>";

	          if($transaksi->Get_status_bayar($d['kode_kamar'],$_POST['bulan'],$_POST['tahun'])>0){
	            echo"Sudah Bayar";
	          }else{
	            echo"Belum Bayar";
	          }

	          echo"   </center></td>
	                </tr>";
	          $no++;
            }
	          endforeach;     
          echo" <tr>
                  <th style=\"color:#FFF; background-color:#DC143C;\" colspan='5'>Grand Total</th>
                  <th style=\"color:#FFF; background-color:#DC143C;\" colspan='2'>Rp. ".$db->format_angka($transaksi->sum_by_month_Transaksi($_POST['bulan'],$_POST['tahun']))."</th>
                </tr></tbody>
            </table>";

}else if($_POST['berdasar'] == "Semua Data Pengeluaran"){
  echo"<h3>TAHUN $_POST[tahun_pengeluaran]</h3>";
  echo"<table class='table-list'>
          <thead>
            <tr>
              <th style=\"color:#FFF; background-color:#DC143C;\" width='5%'>No</th>
              <th style=\"color:#FFF; background-color:#DC143C;\">Kode Pengeluaran</th>
              <th style=\"color:#FFF; background-color:#DC143C;\">Tanggal</th>
              <th style=\"color:#FFF; background-color:#DC143C;\">Keterangan</th>
              <th style=\"color:#FFF; background-color:#DC143C;\">Jumlah</th>
            </tr>";
  $arr=$pengeluaran->tampil_data_pengeluaran_tahunan($_POST['tahun_pengeluaran']);
  if($arr){
          $i = 1;  
          foreach($arr ? $arr : [] as $d):
          echo"
          <tr>
            <td rowspan=''><center>$i</center></td>
            <td><center>$d[id_pengeluaran]</center></td>
            <td><center>".$db->tgl_indo($d['tanggal'])."</center></td>
            <td><center>&nbsp;$d[nama_pengeluaran]</center></td>
            <td align='right'>".$db->format_angka($d['jumlah'])."</td>";
          $i++;
          endforeach;
  }else{
    echo "<tr><td colspan='5'><center><b>BELUM ADA DATA TAHUN $_POST[tahun_pengeluaran] </b></center></td></tr>";
  }        
          echo"
          <tr>
            <th style=\"color:#FFF; background-color:#DC143C;\" colspan='4'>Grand Total</th>
            <th style=\"color:#FFF; background-color:#DC143C;\">Rp. ".$db->format_angka($pengeluaran->sum_All_Pengeluaran($_POST['tahun_pengeluaran']))."</th>
          </tr>
        </tbody>
      </table>";
}else if($_POST['berdasar'] == "Bulan Pengeluaran"){
      echo"<h3>BULAN ".strtoupper($db->getBulan($_POST['bulan_pengeluaran']))." $_POST[tahun_pengeluaranbulanan]</h3>";
      echo"<table class='table-list'>
            <thead>
              <tr>
                <th style=\"color:#FFF; background-color:#DC143C;\" width='5%'>No</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Kode Pengeluaran</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Tanggal</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Keterangan</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Jumlah</th>
              </tr>
            </thead>
            <tbody>";
            
      $arr=$pengeluaran->tampil_data_pengeluaran_bulanan($_POST['tahun_pengeluaranbulanan'],$db->bln_db($_POST['bulan_pengeluaran']));
      if($arr){
        $i = 1;  
      foreach($arr ? $arr : [] as $d):
        echo"
              <tr>
                <td rowspan=''><center>$i</center></td>
                <td><center>$d[id_pengeluaran]</center></td>
                <td><center>".$db->tgl_indo($d['tanggal'])."</center></td>
                <td><center>&nbsp;$d[nama_pengeluaran]</center></td>
                <td align='right'>".$db->format_angka($d['jumlah'])."</td>";
        $i++;
      endforeach;
      }else{
            echo "<tr><td colspan='7'><center><b>BELUM ADA DATA BULAN ".$db->getBulan($_POST['bulan_pengeluaran'])." $_POST[tahun_pengeluaranbulanan]</b></center></td></tr>";
      }
      echo"
          <tr>
            <th style=\"color:#FFF; background-color:#DC143C;\" colspan='4'>Grand Total</th>
            <th style=\"color:#FFF; background-color:#DC143C;\">Rp. ".$db->format_angka($pengeluaran->sum_Pengeluaran_Bulanan($_POST['tahun_pengeluaranbulanan'],$db->bln_db($_POST['bulan_pengeluaran'])))."</th>
          </tr>
        </tbody>
      </table>";
 
}else if($_POST['berdasar'] == "Bulan Warga"){
      echo"<h3>LAPORAN WARGA KOST pondok jaya </h3>";
      echo"<h3>BULAN ".strtoupper($db->getBulan($_POST['bulan_warga']))." $_POST[tahun_wargabulanan]</h3>";
      echo"<table class='table-list'>
            <thead>
              <tr>
                <th style=\"color:#FFF; background-color:#DC143C;\" width='5%'>No</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Nama</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">NIK</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Jekel</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">TGL Lahir</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Alamat</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Pekerjaan</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">No. Kamar</th>
              </tr>
            </thead>
            <tbody>";
            
      $arr=$konsumen->get_warga_bulanan($_POST['tahun_wargabulanan'],$db->bln_db($_POST['bulan_warga']));
      if($arr){
        $i = 1;  
      foreach($arr ? $arr : [] as $d):
        if ($d['jekel'] == 'l') {
          $jekel = 'LAKI_LAKI';
        }else{
          $jekel = 'PEREMPUAN';
        }
        echo"
              <tr>
                <td rowspan=''><center>$i</center></td>
                <td>".strtoupper($d['nama_konsumen'])."</td>
                <td>$d[nik]</td>
                <td>$jekel</td>
                <td><center>$d[ttl]</center></td>
                <td>".strtoupper($d[alamat_konsumen])."</td>
                <td>".strtoupper($d[pekerjaan])."</td>
                <td><center><b>#$d[nama_kamar]</b></center></td>";
        $i++;
      endforeach;
        echo "
              <tr style=\"color:#FFF; background-color:f4e242;\">
                <td></td>
                <td>Firman Maulana</td>
                <td>3174071901001000</td>
                <td>LAKI-LAKI</td>
                <td>Jakarta/19-01-2000</td>
                <td>Jl. H. Salm RT 012/002 GANDARIA UTARA, KEB.BARU</td>
                <td>PENJAGA KOST</td>
                <td></td>
              </tr>
                ";
      }else{
            echo "<tr><td colspan='7'><center><b>BELUM ADA DATA BULAN ".$db->getBulan($_POST['bulan_warga'])." $_POST[tahun_wargabulanan]</b></center></td></tr>";
      }
      echo"
        </tbody>
      </table>";

}else if($_POST['berdasar'] == "Bulan Gabungan"){
      echo"<h3>LAPORAN PEMASUKAN DAN PENGELUARAN</h3>";
      echo"<h3>BULAN ".strtoupper($db->getBulan($_POST['bulan_gabungan']))." $_POST[tahun_gabungan]</h3>";
      echo"<table class='table-list'>
            <thead>
              <tr>
                <th style=\"color:#FFF; background-color:#DC143C;\" width='5%'>#</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Tanggal</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">No Kamar</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Konsumen</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">RP</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Tanggal</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">Keterangan</th>
                <th style=\"color:#FFF; background-color:#DC143C;\">RP</th>
              </tr>
            </thead>
            <tbody>";
            
      $in = $transaksi->get_transaksi_bulanan($_POST['bulan_gabungan'],$_POST['tahun_gabunganbulanan']);
      $out = $pengeluaran->tampil_data_pengeluaran_bulanan($_POST['tahun_gabunganbulanan'],$db->bln_db($_POST['bulan_gabungan']));
      $total_in = count($in);
      $total_out = count($out);
      echo "in : ".$total_in." out : ".$total_out;
      $x = 0;
      $i = 1;
      // foreach data yang lebih banyak
      // jika total in > total out
      if ($total_in > $total_out) {
          foreach ($in ? $in : [] as $value) {
            echo "<tr>";
              echo "<td><center>".$i."</center></td>";
              echo "<td align='center'>".$value['tanggal_bayar']."</td>";
              echo "<td align='center'>".substr($value['kode_kamar'],3,4)."</td>";
              echo "<td>".$konsumen->GetNamaKonsumen($value['id_konsumen'])."</td>";
              echo "<td align='right'>".number_format($value['total'],0, ",",".")."</td>";
              if ($x < $total_out && $total_out > 0) {
                echo "<td align='center'>".$out[$x]['tanggal']."</td>" ;
                echo "<td>".$out[$x]['nama_pengeluaran']."</td>";
                echo "<td align='right'>".number_format($out[$x]['jumlah'],0, ",",".")."</td>";
              }else{
                echo"<td></td>  <td></td>  <td></td>";
              }
            echo "</tr>";
            $x++;
            $i++;
          }
          // jika total in < total out
      } else if ($total_in < $total_out){
          foreach ($out ? $out : [] as $value) {
            echo "<tr>";
              echo "<td><center>".$i."</center></td>";
              if ($x <= $total_in && $total_in > 0) {
                echo "<td align='center'>".$in[$x]['tanggal_bayar']."</td>";
                echo "<td align='center'>".substr($in[$x]['kode_kamar'],3,4)."</td>";
                echo "<td>".$konsumen->GetNamaKonsumen($in[$x]['id_konsumen'])."</td>";
                echo "<td align='right'>".number_format($in[$x]['total'],0, ",",".")."</td>";
              }else{
                echo"<td></td>  <td></td>  <td></td> <td></td>";
              }
              echo "<td align='center'>".$value['tanggal']."</td>" ;
              echo "<td>".$value['nama_pengeluaran']."</td>";
              echo "<td align='right'>".number_format($value['jumlah'],0, ",",".")."</td>";
            echo "</tr>";
            $x++;
            $i++;
          }
          // jika total sama
      } else if ($total_in == $total_out){
        // jika 22 nya punya hasil data array
          if(isset($in[$x]['tanggal_bayar']) && isset($out[$x]['tanggal'])) {
            foreach ($in ? $in : [] as $value) {
              echo "<tr>";
                echo "<td><center>".$i."</center></td>";
                echo "<td align='center'>".$value['tanggal_bayar']."</td>";
                echo "<td align='center'>".substr($value['kode_kamar'],3,4)."</td>";
                echo "<td>".$konsumen->GetNamaKonsumen($value['id_konsumen'])."</td>";
                echo "<td align='right'>".number_format($value['total'],0, ",",".")."</td>";
                echo "<td align='center'>".$out[$x]['tanggal']."</td>" ;
                echo "<td>".$out[$x]['nama_pengeluaran']."</td>";
                echo "<td align='right'>".number_format($out[$x]['jumlah'],0, ",",".")."</td>";
              echo "</tr>";
              $x++;
              $i++;
            }
            // jika hanya ada pemasukan
          }else if ( isset($in[$x]['tanggal_bayar']) && !isset($out[$x]['tanggal']) ) {
            foreach ($in ? $in : [] as $value) {
              echo "<tr>";
                echo "<td><center>".$i."</center></td>";
                echo "<td align='center'>".$value['tanggal_bayar']."</td>";
                echo "<td align='center'>".substr($value['kode_kamar'],3,4)."</td>";
                echo "<td>".$konsumen->GetNamaKonsumen($value['id_konsumen'])."</td>";
                echo "<td align='right'>".number_format($value['total'],0, ",",".")."</td>";
                echo"<td></td>  <td></td>  <td></td>";
              echo "</tr>";
              $x++;
              $i++;
            }
            // jika hanya ada pengeluaran
          }else if ( !isset($in[$x]['tanggal_bayar']) && isset($out[$x]['tanggal']) ) {
            foreach ($out ? $out : [] as $value) {
              echo "<tr>";
                echo "<td><center>".$i."</center></td>";
                echo"<td></td>  <td></td>  <td></td> <td></td>";
                echo "<td align='center'>".$value['tanggal']."</td>";
                echo "<td>".$value['nama_pengeluaran']."</td>";
                echo "<td align='right'>".number_format($value['jumlah'],0, ",",".")."</td>";
              echo "</tr>";
              $x++;
              $i++;
            }
            // jika kedua nya  array null
          }else if ( !isset($in[$x]['tanggal_bayar']) && !isset($out[$x]['tanggal']) ) {
            foreach ($out ? $out : [] as $value) {
              echo "<tr><td colspan='7'>";
              echo "BELUM ADA DATA BULAN ".$db->getBulan($_POST['bulan_gabungan'])." ".$_POST['tahun_gabunganbulanan'];
              echo "</td></tr>";
            }
          }
      }
    $sum_in = $transaksi->sum_by_month_Transaksi($_POST['bulan_gabungan'],$_POST['tahun_gabunganbulanan']);
    $sum_out= $pengeluaran->sum_Pengeluaran_Bulanan($_POST['tahun_gabunganbulanan'],$db->bln_db($_POST['bulan_gabungan']));
    $sum_all= $sum_in - $sum_out;
      echo "<tr bgcolor='#ffff33'>";
      echo    "<td colspan='4' align='right'><b>Total IN</b></td>";
      echo    "<td><b>Rp. ".$db->format_angka($sum_in)."</b></td>"; 
      echo    "<td colspan='2'align='right'><b>Total OUT</b></td>";
      echo    "<td><b>Rp. ".$db->format_angka($sum_out)."</b></td>";
      echo "</tr>";

      echo "<tr bgcolor='#33ffff'>";
      echo    "<td colspan='6' align='right'><b>Sisa Saldo</b></td>";
      echo    "<td colspan='2'><b> Rp. ".$db->format_angka($sum_all)." </b></td>";
      echo "</tr>
        </tbody>
      </table>";
}

?>
</body>
</html>