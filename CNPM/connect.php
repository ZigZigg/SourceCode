<?php 
	$sv_username = "root";
    $sv_password = "";
    $sv_host = "localhost";
    $sv_db = "cnpmz";
    $conn=mysqli_connect($sv_host,$sv_username,$sv_password,$sv_db) or die("Không thể kết nối đến database");
    mysqli_set_charset($conn,'utf8');
?>
