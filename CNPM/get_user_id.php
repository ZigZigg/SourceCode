<?php 

	$user_name = $_POST['name'];
	require_once("connect.php");

	$sql = "select * from user where user_name = '$user_name' ";
                    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row["user_id"];

	$output =  array('first'=>$user_id);

	echo json_encode($output,JSON_FORCE_OBJECT);
?>