<?php
    $user_name = $_POST['name'];
    $comment=$_POST['comment'];
    $img_id=$_POST['id'];
    require_once("connect.php");
    if($comment!="")
    {
        $sql = "INSERT INTO comment (num, img_id, user_name, comment) VALUES (NULL, '$img_id', '$user_name', '$comment')";
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    }
?>