<?php
	require_once("connect.php");
    $user_id = $_POST['id'];
    $user_following_id = $_POST['following_id'];
	$sql = "DELETE FROM follow WHERE user_id='$user_id' and user_following_id='$user_following_id'";
	mysqli_set_charset($conn,'utf8');
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
?>