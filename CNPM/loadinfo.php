<?php
	$img_id = $_POST['id'];
	require_once("connect.php");
	
	$sql = "select * from images where img_id = '$img_id' ";
    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $num_rows = mysqli_num_rows($result);
	while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
	{
	  $storedContentArray[]= $row['img_content'];
	  $storedPriceArray[]=$row['img_price'];
	  $storedLocationArray[]=$row['img_location'];
	}
	$output =  array('num'=>$num_rows,'content'=>&$storedContentArray,'price'=>&$storedPriceArray,'location'=>&$storedLocationArray);

	echo json_encode($output,JSON_FORCE_OBJECT);
?>