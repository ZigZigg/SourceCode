<?php
	require_once("connect.php");
    $img_id = $_POST['imgid'];
	$sql = "DELETE FROM images WHERE img_id='$img_id'";
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $sql = "DELETE FROM comment WHERE img_id='$img_id'";
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
?>