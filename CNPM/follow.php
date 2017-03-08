<?php
    require_once("connect.php");
    $user_id = $_POST['id'];
    $user_following_id = $_POST['following_id'];
    $sql = "insert into follow values(null,'$user_id','$user_following_id')";
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
?>