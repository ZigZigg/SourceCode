
<?php
	$user_name = $_POST['name'];
	require_once("connect.php");
	
	$sql = "select * from images where img_caption like '%{$user_name}%'";
    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $num_rows = mysqli_num_rows($result);
	while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
	{
	  $storedUserNameArray[]= $row['img_caption'];
	}
	$output =  array('num'=>$num_rows,'username'=>&$storedUserNameArray);

	echo json_encode($output,JSON_FORCE_OBJECT);
?>