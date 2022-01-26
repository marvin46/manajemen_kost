<?php
date_default_timezone_set('Asia/Jakarta');
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "kost_management";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
}   

$tanggal_hari_ini = date("d");
$jarak_reminder	  = 2;
$tanggal_reminder = $tanggal_hari_ini - $jarak_reminder;


$today = date("m-$tanggal_reminder");

$query  = "SELECT * FROM kamar WHERE tanggal_masuk LIKE '%$today%' ";

$result = mysqli_query($koneksi, $query);

$row = mysqli_fetch_array($result);

$cek = mysqli_num_rows($result);

?>