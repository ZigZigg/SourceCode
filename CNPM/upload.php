<?php

require_once("connect.php");
session_start();
$user_id = $_SESSION["user_id"];
$img_caption = $_POST['imgcaption'];
$img_content = $_POST['imgcontent'];
$img_price = $_POST['imgprice'];
$img_location = $_POST['imglocation'];


if($_FILES['file']['name'] != NULL)
{ // Đã chọn file
           // Tiến hành code upload file
           if($_FILES['file']['type'] == "image/jpeg"
            || $_FILES['file']['type'] == "image/png"
            || $_FILES['file']['type'] == "image/gif"){
              // là file ảnh
              // Tiến hành code upload
              if($_FILES['file']['size'] > 2099152){
                  echo "File không được lớn hơn 10mb";
              }else{
                  // file hợp lệ, tiến hành upload
                  $path = "images/"; // ảnh upload sẽ được lưu vào thư mục data
                  $tmp_name = $_FILES['file']['tmp_name'];
                  $name = $_FILES['file']['name'];
                  $type = $_FILES['file']['type']; 
                  $size = $_FILES['file']['size']; 
                  // Upload file
                  move_uploaded_file($tmp_name,$path.$name);
                  $sql = "insert into images values(null,'$user_id','$name','$img_caption','$img_content','$img_price','$img_location')";
                  mysqli_set_charset($conn,'utf8');
                  mysqli_query($conn,$sql) or die(mysqli_error($conn));
                  echo "Upload thành công";
              }
            }else{
              // không phải file ảnh
              echo "Kiểu file không hợp lệ";
            }
      }else{
           echo "Vui lòng chọn file";
      }
?>