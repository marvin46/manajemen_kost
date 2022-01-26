<?php
$db= new database();
$trans= new Transaksi();
$kamar= new kamar();
$konsumen= new Konsumen();
$user= new User();
$bulan = date('m');
if($bulan < 10){
   $bulan = substr(date('m'),1,1);
}
$tahun = date('Y');
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://yourdomain.com/home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> </div>
  </div>
  <div class="container-fluid">
  
  <!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
      <?php if ($_SESSION['level'] =='admin'){ ?>
        <li class="bg_lb span2"> <a href="https://yourdomain.com/kamar"> <i class="icon-home"></i> <span class="label label-important"><?php echo $kamar->total_kamar(); ?></span>Kamar Kosong</a> </li>

        <li class="bg_ly span2"> <a href="https://yourdomain.com/konsumen"> <i class="icon-group"></i><span class="label label-success"><?php echo $konsumen->total_konsumen(); ?></span>Total Tamu</a> </li>
        <li class="bg_lg span2"> <a href="https://yourdomain.com/transaksi"> <i class="icon-book"></i> <span class="label label-info"><?php echo $trans->Get_bayar_this_month($bulan,$tahun); ?></span>Trx Bln Ini</a> </li>

        <li class="bg_lr span2"> <a href="https://yourdomain.com/users"> <i class="icon-user"></i><span class="label label-warning"><?php echo $user->total_users(); ?></span>Total User</a> </li>
        
        <li class="bg_ls span3"> <a href="https://yourdomain.com/laporan"> <i class="icon-copy"></i>Laporan</a> </li>
         <?php } else {?>

          <li class="bg_lb span2"> <a href="https://yourdomain.com/home"> <i class="icon icon-th-large"></i>Home</a></li>

          <li class="bg_lg span2"> <a href="https://yourdomain.com/transaksi"> <i class="icon-book"></i> <span class="label label-info"><?php echo $trans->Get_bayar_this_month($bulan,$tahun); ?></span>Trx Bln Ini</a> </li>
          
           <?php }?>
      </ul>
    </div>
<!--End-Action boxes-->    
        <div class="widget-box collapsible">

          <div class="widget-title"> 
            <a data-toggle="collapse" href="#collapseOne"> <span class="icon"><i class="icon-arrow-right"></i></span>
              <h5>WELCOME</h5>
            </a> 
          </div>
          <div id="collapseOne" class="collapse">
            <div class="widget-content"> SELAMAT DATANG DI APLIKASI MANAJEMEN KOS pondok jaya </div>
          </div>
          
          <div class="widget-title"> 
            <a data-toggle="collapse" href="#collapseTwo"> <span class="icon"><i class="icon-arrow-right"></i></span>
              <h5>BENEFIT / KEUNTUNGAN ?</h5>
            </a> 
          </div>
          <div id="collapseTwo" class="collapse">
            <div class="widget-content"> BENEEFIT ATAU KEUNTUNGAN MENGGUNAKAN APLIKASI INI<br/>

              1. Meningkatkan pelayanan dengan cepat dan efisien.<br/>
              2. Mempermudah pengontrolan data.<br/>
              3. Mempermudah proses pengumpulan data dan langsung menjadi laporan yang akurat.<br/>
              4. Menyediakan laporan tepat pada waktunya.<br/>
              5. Mempercepat proses pengambilan keputusan.<br/>
              6. Menghemat tenaga kerja dan waktu.<br/>
              7. Meningkatkan pelayanan perusahaan yang lebih professional.<br/>
              8. Bisa mengecek penyewaan dimana pun kapan pun.<br/>

            </div>
          </div>
          
          <div class="widget-title"> 
            <a data-toggle="collapse" href="#collapseThree"> <span class="icon"><i class="icon-arrow-right"></i></span>
              <h5>PERATURAN ?</h5>
            </a> 
          </div>
          <div id="collapseThree" class="collapse">
            <div class="widget-content"> PERATURAN MENGGUNAKAN APLIKASI INI : <br/>

              1. Silahkan login sebelum Menggunakan aplikasi<br/>
              2. Hanya Admin yang dapat merubah data Kamar, Penghuni, dan User<br/>
              3. User biasa hanya bisa membuat transaksi penagihan kepada penghuni<br/>
              4. Jangan lupa LOGOUT setelah selesai menggunakan aplikasi<br/>
              5. Apabila lupa logout maka sistem akan menghapus sessi login otomatis<br/>

            </div>
          </div>

          <div class="widget-title"> 
            <a data-toggle="collapse" href="#collapseFour"> <span class="icon"><i class="icon-arrow-right"></i></span>
              <h5>BUTUH BANTUAN ?</h5>
            </a> 
          </div>
          <div id="collapseFour" class="collapse">
            <div class="widget-content"> Silahkan hubungi Marvin Priyatno melalui 
              <a href='zalfinm@gmail.com' target="_blank"><img src="https://demo.yourdomain.com/img/icons/16/mail.png" /> <b><u>zalfinm@gmail.com </u></b></a> atau <a href="https://api.whatsapp.com/send?phone=6281219955960&amp;text=Halo....."><img src="https://demo.yourdomain.com/img/icons/16/wa.png" /> <b><u> 0812-1995-5960 </u></b></a> 
            </div>
          </div>
        </div>    
    </div>   
  </div>
</div>


