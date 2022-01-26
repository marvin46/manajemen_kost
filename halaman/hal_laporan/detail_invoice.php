<?php
include_once '../../config/class.php';
$db= new Database();
$transaksi= new Transaksi();
$kamar= new kamar();
$konsumen= new Konsumen();
// koneksi ke MySQL via method
$db->connectMySQL();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice / Nota Kost</title>
    <link rel="stylesheet" href="halaman/hal_laporan/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <a href="http://yourdomain.com"> <img src="halaman/hal_laporan/logo.png"> </a>
        <div id="company" clhass="clearfix">
          <div>pondok jaya</div>
          <div>Lokasi Kost<br /> Jakarta</div>
          <div>08123465798</div>      
        </div>
      </div>
      <h1>KWITANSI</h1>
      
     <?php
      $id = base64_decode($_GET['id']);
      foreach($transaksi->edit_transaksi($id) as $d)
     ?>
    </header>
    <main>
      
      
       <table>
       <tr>
            <td>Nomor:</td>
            <td><b><?php echo $id;?></b></td>
          </tr> 
          <tr>
            <td>Telah terima dari :</td>
            <td><b><?php echo strtoupper($konsumen->GetNamaKonsumen($d['id_konsumen'])); ?> </b><br/>
            <?php echo $konsumen->GetHpKonsumen($d['id_konsumen']); ?><br/>
            <?php echo $konsumen->GetAlamatKonsumen($d['id_konsumen']); ?></td>
          </tr>
          <tr>
            <td>Untuk Pembayaran :</td>
            <td>Kost 
          <?php 
            if($d['bulan'] !== '12'){
              $tgl_masuk = $db->get_tgl_msk($d['id_konsumen']);
              if ($d['bulan'] == '2' &&  $tgl_masuk > 28) {
                $tgl_masuk = '28';
              }
              echo $tgl_masuk."-".$db->getBulan($d['bulan'])." s/d ".$db->get_tgl_msk($d['id_konsumen'])."-".$db->getBulan($d['bulan']+1)." $d[tahun], Kamar No ".substr($d['kode_kamar'], 3,2);
              if ($d['tambahan']) {
                echo " dan ".$d['tambahan']." : Rp. ".$db->format_angka($d['total']-$db->get_harga_kamar($d['kode_kamar']));
              }
            }else if ($d['bulan'] === '12'){
        $year = $d['tahun'] + 1;
              echo $db->get_tgl_msk($d['id_konsumen'])."-".$db->getBulan($d['bulan'])."- $d[tahun] s/d ".$db->get_tgl_msk($d['id_konsumen'])." - Januari ".$year.", Kamar No ".substr($d['kode_kamar'], 3,2); 
          ?>
          </td>
          <?php
            } 
          ?>
          </tr>
         
          <tr>
            <td>Uang Sejumlah:</td>
            <td><h2><i>Rp. <?php echo"".$db->format_angka($d['total']).""; ?></i></h2></td>
          </tr>
          <tr>
            <td>Terbilang :</td>
            <td><h2><i><?php echo strtoupper($db->terbilang($d['total'], $style=4)); ?> RUPIAH</i></h2></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
         
        </table>

<table border='0'>
  <tr>
    <th width='201' scope='col'><?php //echo"".$db->ymd_to_dmy(substr($d['tanggal_bayar'], 0,10)).""; ?></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'>Jakarta, <?php echo"".$db->ymd_to_dmy(substr($d['tanggal_bayar'], 0,10)).""; ?></th>
  </tr>
</table>
 
      
     
    </main>

   
    <!-- <footer>
      <i>Terima kasih atas kepercayaan dan kunjungan anda.</i>
    </footer> -->
  </body>
</html>