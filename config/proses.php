<?php
session_start();
include_once 'class.php';

// instance objek db dan user
$user = new User();
$db = new Database();
// instance objek harga
$harga = new Harga();
// instance objek kamar
$kamar = new kamar();
// instance objek Transaksi
$transaksi = new Transaksi();
// instance objek konsumen
$konsumen = new Konsumen();
// instance objek pengeluaran
$pengeluaran = new pengeluaran();
// koneksi ke MySQL via method
$db->connectMySQL();



$page = $_GET['page'];
// ############################################ MODULE USER ############################################################
// ## USER-LOGIN
if($page == "login"){

if($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $db->anti_injection($_POST['username']);
$pass     = $db->anti_injection($_POST['password']);
// pastikan username dan password adalah berupa huruf atau angka.
  $login=$user->cek_login($username, $pass);
  if($login || !ctype_alnum($username) OR !ctype_alnum($pass)) {
    // login sukses, arahkan ke file master.php
    header("location:../home/");
  }
  else {
  // login gagal, beri peringatan dan kembali ke file index.php
header("location:../login_error.php"); 
  }
}
}

// ## USER-INPUT
elseif($page == "input-user"){
$nik = trim(htmlspecialchars($_POST['nik']));
$nama_users = trim(htmlspecialchars($_POST['nama_users']));
$username   = trim(htmlspecialchars($_POST['username']));
$level      = trim(htmlspecialchars($_POST['level']));
$password   = md5($_POST['pwd']);
$user->input_user($nik,$nama_users,$username,$password,$level );
header("location:../users");
}

// ## USER-UPDATE
elseif($page == "update-user"){
$id_users 	= trim(htmlspecialchars($_POST['id_users']));
$nik 		= trim(htmlspecialchars($_POST['nik']));
$nama_users = trim(htmlspecialchars($_POST['nama_users']));
$username   = trim(htmlspecialchars($_POST['username']));
$level      = trim(htmlspecialchars($_POST['level']));
$password   = md5($_POST['pwd']);
$user->update_user($id_users,$nik,$nama_users,$username,$password,$level);
header("location:../users");
}

// ## USER-DELETE
elseif($page == "hapus-user"){
$user->hapus_user($_GET['id']);
 	header("location:../users");
}
// ############################################ END MODULE USER ############################################################

// ##################################### MODULE HARGA ##################################################
// ## HARGA-INPUT
elseif($page == "input-harga"){
$nama = trim(htmlspecialchars($_POST['nama_kamar']));
$harga_kamar = trim(htmlspecialchars($_POST['harga_kamar']));
$harga->input_harga($nama,$harga_kamar);
header("location:../harga");
}

// ## kamar-UPDATE
elseif($page == "update-harga"){
$id 	 = trim(htmlspecialchars($_POST['id_harga']));
$nama_kamar  = trim(htmlspecialchars($_POST['nama_kamar']));
$harga_kamar = trim(htmlspecialchars( str_replace(".","",$_POST['harga_kamar']) ));

$harga->update_harga($id,$nama_kamar,$harga_kamar);
header("location:../harga");
}

// ##################################### END MODULE HARGA ##################################################

// ############################################ MODULE KAMAR ############################################################
// ## kamar-INPUT
elseif($page == "input-kamar"){
$hargaKamar 	= $db->ClearKomaTitik($_POST['harga_kamar']);	
$kode_kamar 	= trim(htmlspecialchars($_POST['kode_kamar']));
$nama_kamar  	= trim(htmlspecialchars($_POST['nama_kamar']));
$harga_kamar 	= trim(htmlspecialchars($hargaKamar));
$konsumen_aktif = trim(htmlspecialchars($_POST['konsumen_aktif']));
$konsumen_aktif2 = trim(htmlspecialchars($_POST['konsumen_aktif2']));
$tanggal_masuk 	= trim(htmlspecialchars($_POST['tanggal_masuk']));
// $langsungbayar 	= trim(htmlspecialchars($_POST['langsungbayar']));
// $carabayar 		= trim(htmlspecialchars($_POST['carabayar']));
// $kamar->input_kamar($kode_kamar,$nama_kamar,$harga_kamar,$konsumen_aktif,$tanggal_masuk,$langsungbayar,$carabayar);
$kamar->input_kamar($kode_kamar,$nama_kamar,$harga_kamar,$konsumen_aktif,$konsumen_aktif2,$tanggal_masuk);
header("location:../kamar");
}

// ## kamar-UPDATE
elseif($page == "update-kamar"){
$kode_kamar 	= trim(htmlspecialchars($_POST['kode_kamar']));
$nama_kamar  	= trim(htmlspecialchars($_POST['nama_kamar']));
$harga_kamar 	= trim(htmlspecialchars($_POST['harga_kamar']));
$konsumen_aktif = trim(htmlspecialchars($_POST['konsumen_aktif']));
$konsumen_aktif2 = trim(htmlspecialchars($_POST['konsumen_aktif2']));
$tanggal_masuk 	= trim(htmlspecialchars($_POST['tanggal_masuk']));
// $langsungbayar 	= trim(htmlspecialchars($_POST['langsungbayar']));
// $carabayar 		= trim(htmlspecialchars($_POST['carabayar']));

// $kamar->update_kamar($kode_kamar,$nama_kamar,$harga_kamar,$konsumen_aktif,$tanggal_masuk,$langsungbayar,$carabayar);
$kamar->update_kamar($kode_kamar,$nama_kamar,$harga_kamar,$konsumen_aktif,$konsumen_aktif2,$tanggal_masuk);
header("location:../kamar");
}

// ## kamar-DELETE
elseif($page == "hapus-kamar"){
$kamar->hapus_kamar($_GET['id']);
//$kamar->hapus_transaksi($_GET['id']);
header("location:kamar");
}

// ############################################ END MODULE KAMAR ############################################################

// ############################################ MODULE PENGELUARAN ##########################################################
// ## pengeluaran-INPUT
elseif($page == "input-pengeluaran"){
$id_pengeluaran 	= trim(htmlspecialchars($_POST['id_pengeluaran']));
$nama_pengeluaran  	= trim(htmlspecialchars($_POST['nama_pengeluaran']));
$jumlah 			= trim(htmlspecialchars(str_replace(".","",$_POST['jumlah'])));
$tanggal 			= trim(htmlspecialchars($_POST['tanggal']));
$pengeluaran->input_pengeluaran($id_pengeluaran,$nama_pengeluaran,$jumlah,$tanggal);
header("location:../pengeluaran");
}

// ## pengeluaran-UPDATE
elseif($page == "update-pengeluaran"){
$id_pengeluaran  	= trim(htmlspecialchars($_POST['id_pengeluaran']));
$nama_pengeluaran  	= trim(htmlspecialchars($_POST['nama_pengeluaran']));
$jumlah 			= trim(htmlspecialchars(str_replace(".","",$_POST['jumlah'])));
$tanggal 			= trim(htmlspecialchars($_POST['tanggal']));
$pengeluaran->update_pengeluaran($id_pengeluaran,$nama_pengeluaran,$jumlah,$tanggal);
header("location:../pengeluaran");
}

// ## pengeluaran-DELETE
elseif($page == "hapus-pengeluaran"){
$pengeluaran->hapus_pengeluaran($_GET['id']);
header("location:pengeluaran");
}
// ############################################ MODULE PENGELUARAN ##########################################################

// ############################################ MODULE KONSUMEN ############################################################
// ## konsumen-INPUT
elseif($page == "input-konsumen"){
$id_konsumen   		= trim(htmlspecialchars($_POST['id_konsumen']));
$nama_konsumen  	= trim(htmlspecialchars($_POST['nama_konsumen']));
$nik  				= trim(htmlspecialchars($_POST['nik']));
$tempatlahir  		= trim(htmlspecialchars($_POST['tempatlahir']));
$tgllahir  			= trim(htmlspecialchars($_POST['tgllahir']));
$jekel  			= trim(htmlspecialchars($_POST['jekel']));
$agama  			= trim(htmlspecialchars($_POST['agama']));
$pekerjaan  		= trim(htmlspecialchars($_POST['pekerjaan']));
$statuskawin  		= trim(htmlspecialchars($_POST['statusperkawinan']));
$namaistri  		= trim(htmlspecialchars($_POST['nama_istri']));
$anak1  			= trim(htmlspecialchars($_POST['anak1']));
$anak2  			= trim(htmlspecialchars($_POST['anak2']));
$anak3  			= trim(htmlspecialchars($_POST['anak3']));
$anak4  			= trim(htmlspecialchars($_POST['anak4']));
// $tanggalmasuk  		= trim(htmlspecialchars($_POST['tanggal_masuk']));
$alamat_konsumen  	= trim(htmlspecialchars($_POST['alamat_konsumen']));
$hp 				= trim(htmlspecialchars($_POST['hp']));
$status 			= trim(htmlspecialchars($_POST['status']));
$konsumen->input_konsumen($id_konsumen,$nama_konsumen,$nik,$tempatlahir,$tgllahir,$jekel,$agama,$pekerjaan,$statuskawin,$namaistri,$anak1,$anak2,$anak3,$anak4,$alamat_konsumen,$hp,$status);
header("location:../konsumen");
}

// ## konsumen-UPDATE
elseif($page == "update-konsumen"){
$id_konsumen   		= trim(htmlspecialchars($_POST['id_konsumen']));
$nama_konsumen  	= trim(htmlspecialchars($_POST['nama_konsumen']));
$nik  				= trim(htmlspecialchars($_POST['nik']));
$tempatlahir  		= trim(htmlspecialchars($_POST['tempatlahir']));
$tgllahir  			= trim(htmlspecialchars($_POST['tgllahir']));
$jekel  			= trim(htmlspecialchars($_POST['jekel']));
$agama  			= trim(htmlspecialchars($_POST['agama']));
$pekerjaan  		= trim(htmlspecialchars($_POST['pekerjaan']));
$statuskawin  		= trim(htmlspecialchars($_POST['statusperkawinan']));
$namaistri  		= trim(htmlspecialchars($_POST['nama_istri']));
$anak1  			= trim(htmlspecialchars($_POST['anak1']));
$anak2  			= trim(htmlspecialchars($_POST['anak2']));
$anak3  			= trim(htmlspecialchars($_POST['anak3']));
$anak4  			= trim(htmlspecialchars($_POST['anak4']));
// $tanggalmasuk  		= trim(htmlspecialchars($_POST['tanggal_masuk']));
$alamat_konsumen  	= trim(htmlspecialchars($_POST['alamat_konsumen']));
$hp 				= trim(htmlspecialchars($_POST['hp']));
$tanggalkeluar  	= trim(htmlspecialchars($_POST['tanggal_keluar']));
$status 			= trim(htmlspecialchars($_POST['status']));
$konsumen->update_konsumen($id_konsumen,$nama_konsumen,$nik,$tempatlahir,$tgllahir,$jekel,$agama,$pekerjaan,$statuskawin,$namaistri,$anak1,$anak2,$anak3,$anak4,$alamat_konsumen,$hp,$tanggalkeluar,$status);
header("location:../konsumen");
}

// ## konsumen-DELETE
elseif($page == "hapus-konsumen"){
$konsumen->hapus_konsumen($_GET['id']);
header("location:konsumen");
}
// ############################################ END MODULE KONSUMEN ############################################################

// ############################################ MODULE TRANSAKSI ############################################################
// ## TRANSAKSI-INPUT
elseif($page == "input-transaksi"){

$id_transaksi 	= trim(htmlspecialchars($_POST['id_transaksi']));
$kode_kamar 	= trim(htmlspecialchars($_POST['kode_kamar']));
$total 			= trim(htmlspecialchars(str_replace(".","",$_POST['total'])));
$tambahan 		= trim(htmlspecialchars($_POST['tambahan']));
$tanggal 		= trim(htmlspecialchars($_POST['tanggal']));
$id_konsumen 	= trim(htmlspecialchars($_POST['id_konsumen']));
$id_konsumen2 	= trim(htmlspecialchars($_POST['id_konsumen2']));
$bulan  		= trim(htmlspecialchars($_POST['bulan']));
$tahun  		= trim(htmlspecialchars($_POST['tahun']));
$transaksi->input_transaksi($id_transaksi,$kode_kamar,$id_konsumen,$id_konsumen2,$total,$tambahan,$tanggal,$bulan,$tahun);
$id 			= base64_encode($_POST['id_transaksi']);
header("location:../detail-invoice-".$id);
}

elseif($page == "input-transaksi-2"){
$id_transaksi 	= trim(htmlspecialchars($_POST['id_transaksi']));
$kode_kamar 	= trim(htmlspecialchars($_POST['kode_kamar']));
$total 			= trim(htmlspecialchars(str_replace(".","",$_POST['total2'])));
$tanggal 		= trim(htmlspecialchars($_POST['tanggal']));
$id_konsumen 	= trim(htmlspecialchars($_POST['id_konsumen']));
$bulan1  		= trim(htmlspecialchars($_POST['bulan1']));
$bulan2  		= trim(htmlspecialchars($_POST['bulan2']));
$tahun  		= trim(htmlspecialchars($_POST['tahun']));
$transaksi->input_transaksi_2($id_transaksi,$kode_kamar,$id_konsumen,$total,$tanggal,$bulan1,$bulan2,$tahun);
$id 			= base64_encode($_POST['id_transaksi']);
header("location:../detail-invoice-".$id);
}



// ## TRANSAKSI-UPDATE
elseif($page == "update-transaksi"){
$id_transaksi 	= trim(htmlspecialchars($_POST['id_transaksi']));
$kode_kamar  		= trim(htmlspecialchars($_POST['kode_kamar']));
$nama_konsumen  = trim(htmlspecialchars($_POST['nama_konsumen']));
$berat 			= trim(htmlspecialchars($_POST['berat']));
$harga 			= trim(htmlspecialchars($_POST['harga']));
$total 			= trim(htmlspecialchars($_POST['subtotaltxt']));
$transaksi->update_transaksi($id_transaksi,$kode_kamar,$nama_konsumen,$berat,$harga,$total);
header("location:../transaksi");
}

// ## TRANSAKSI-DELETE
elseif($page == "hapus-transaksi"){
$transaksi->hapus_transaksi(base64_decode($_GET['id']));
header("location:transaksi");
}
// ############################################ END MODULE TRANSAKSI ############################################################id_transaksi

?>