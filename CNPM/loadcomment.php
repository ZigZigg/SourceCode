<?php
	$img_id = $_POST['id'];
	require_once("connect.php");
	
	$sql = "select * from comment where img_id = '$img_id' ";
    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $num_rows = mysqli_num_rows($result);
	while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
	{
	  $storedUserNameArray[]= $row['user_name'];
	  $storedCommentArray[]=$row['comment'];
	}
	$output =  array('num'=>$num_rows,'username'=>&$storedUserNameArray,'comment'=>&$storedCommentArray);

	echo json_encode($output,JSON_FORCE_OBJECT);
?>