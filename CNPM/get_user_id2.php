<?php 
	session_start();
    $user_id = $_SESSION['user_id']; 
	$output =  array('first'=>$user_id);
	echo json_encode($output,JSON_FORCE_OBJECT);
?>