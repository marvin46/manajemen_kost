<?php
//error_reporting(0);
session_start();
include_once 'config/class.php';

$db = new Database();

// koneksi ke MySQL via method
$db->connectMySQL();

$user = new User();
if (!$user->get_sesi()){
  header("location:index.php");
} else {
  $iduser = $_SESSION['id'];
}
if ($_GET['page'] == 'logout'){
  $user->user_logout();
  header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Kost Exclusive Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="https://yourdomain.com/favicon.png"/>
<link rel="stylesheet" href="https://yourdomain.com/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://yourdomain.com/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="https://yourdomain.com/css/uniform.css" />
<link rel="stylesheet" href="https://yourdomain.com/css/select2.css" />
<link rel="stylesheet" href="https://yourdomain.com/css/matrix-style.css" />
<link rel="stylesheet" href="https://yourdomain.com/css/matrix-media.css" />
<link href="https://yourdomain.com/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://yourdomain.com/css/datepicker.css" />
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">pondok jaya Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $user->ambilNama($iduser); ?></span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="https://yourdomain.com/detail-user-<?php echo $_SESSION['nik'];?>" target="_blank"><i class="icon-qrcode"></i> ID Card</a></li>
        <li><a href="https://yourdomain.com/logout"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    
  </ul>
</div>



<!--sidebar-menu-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i>Forms</a>
  <ul>
<?php
/*if the session is admin.*/ 
if ($_SESSION['level'] =='admin'){
//===========home===========//
    if ($_GET['page'] == 'home'){
      echo"<li class='active'><a href='https://yourdomain.com/home'><i class='icon icon-th-large'></i> <span>Home</span></a> </li>";
    }
    else {
      echo"<li><a href='https://yourdomain.com/home'><i class='icon icon-th-large'></i> <span>Home</span></a> </li>";
    }
    //===========user===========//
    if ($_GET['page'] == 'users'){
      echo"<li class='active'><a href='https://yourdomain.com/users'><i class='icon icon-user'></i> <span>Users</span></a> </li>";
    }
    else{
      echo"<li><a href='https://yourdomain.com/users'><i class='icon icon-user'></i> <span>Users</span></a> </li>";
    }

     //===========harga===========//
    if ($_GET['page'] == 'harga'){
      echo"<li class='active'><a href='https://yourdomain.com/harga'><i class='icon icon-money'></i> <span>harga</span></a> </li>";
    }
    else{
      echo"<li><a href='https://yourdomain.com/harga'><i class='icon icon-money'></i> <span>harga</span></a> </li>";
    }

    //===========kamar===========//
    if ($_GET['page'] == 'kamar'){
      echo"<li class='active'><a href='https://yourdomain.com/kamar'><i class='icon icon-home'></i> <span>kamar</span></a> </li>";
    }
    else{
      echo"<li><a href='https://yourdomain.com/kamar'><i class='icon icon-home'></i> <span>kamar</span></a> </li>";
    }

    //===========konsumen===========//
    if ($_GET['page'] == 'konsumen'){
      echo"<li class='active'><a href='https://yourdomain.com/konsumen'><i class='icon icon-group'></i> <span>Konsumen/Penghuni</span></a> </li>";
    }
    else{
      echo"<li><a href='https://yourdomain.com/konsumen'><i class='icon icon-group'></i> <span>Konsumen/Penghuni</span></a> </li>";
    }

    //===========transaksi===========//
    if ($_GET['page'] == 'transaksi'){
      echo"<li class='active'><a href='https://yourdomain.com/transaksi'><i class='icon icon-linkedin'></i> <span>Transaksi Pembayaran</span></a> </li>";
    }
    else{
      echo"<li><a href='https://yourdomain.com/transaksi'><i class='icon icon-linkedin'></i> <span>Transaksi Pembayaran</span></a> </li>";
    }

    if ($_GET['page'] == 'pengeluaran'){
      echo"<li class='active'><a href='https://yourdomain.com/pengeluaran'><i class='icon icon-cut'></i> <span>Pengeluaran</span></a> </li>";
    }
    else{
      echo"<li><a href='https://yourdomain.com/pengeluaran'><i class='icon icon-cut'></i> <span>Pengeluaran</span></a> </li>";
    }


    //===========laporan===========//
    if ($_GET['page'] == 'laporan'){
      echo"<li class='active'><a href='https://yourdomain.com/laporan'><i class='icon icon-copy'></i> <span>Laporan</span></a> </li>";
    }
    else{
      echo"<li><a href='https://yourdomain.com/laporan'><i class='icon icon-copy'></i> <span>Laporan</span></a> </li>";
    }

}

/*if the session is user.*/ 
else {

    //===========home===========//
    if ($_GET['page'] == 'home'){
      echo"<li class='active'><a href='https://yourdomain.com/home'><i class='icon icon-th-large'></i> <span>Home</span></a> </li>";
    }
    else {
      echo"<li><a href='http://yourdomain.com/home'><i class='icon icon-th-large'></i> <span>Home</span></a> </li>";
    }

    //===========transaksi===========//
    if ($_GET['page'] == 'transaksi'){
      echo"<li class='active'><a href='https://yourdomain.com/transaksi'><i class='icon icon-book'></i> <span>Transaksi Pembayaran</span></a> </li>";
    }
    else{
      echo"<li><a href='http://yourdomain.com/transaksi'><i class='icon icon-book'></i> <span>Transaksi Pembayaran</span></a> </li>";
    }
} /*end the session is user.*/ 
?>

  </ul>
</div>
<?php include "isi.php";?>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; <a href="http://yourdomain.com">www.yourdomain.com</a> </div>
</div>
<!--end-Footer-part-->
<script type="text/javascript">
  function tambahkonsumen() {
    var pindah = window.open('https://yourdomain.com/tambah-konsumen','_blank');
    pindah.focus();
  }

</script>
<script src="https://yourdomain.com/js/jquery.min.js"></script> 
<script src="https://yourdomain.com/js/jquery.ui.custom.js"></script> 
<script src="https://yourdomain.com/js/bootstrap.min.js"></script> 
<script src="https://yourdomain.com/js/jquery.uniform.js"></script> 
<script src="https://yourdomain.com/js/select2.min.js"></script> 
<script src="https://yourdomain.com/js/jquery.dataTables.min.js"></script> 
<script src="https://yourdomain.com/js/matrix.js"></script>
<script src="https://yourdomain.com/js/matrix.tables.js"></script>


<script src="https://yourdomain.com/js/jquery.validate.js"></script> 
<script src="https://yourdomain.com/js/jquery.maskedinput.js"></script> 
<script src="https://yourdomain.com/js/jquery.toggle.buttons.js"></script> 
<script src="https://yourdomain.com/js/jquery.sparkline.js"></script> 
<script src="https://yourdomain.com/js/matrix.form_validation.js"></script>
<script src="https://yourdomain.com/js/bootstrap-colorpicker.js"></script> 
<script src="https://yourdomain.com/js/bootstrap-datepicker.js"></script> 
<script src="https://yourdomain.com/js/matrix.form_common.js"></script> 







</body>
</html>
