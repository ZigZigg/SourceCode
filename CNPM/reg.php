<?php
require_once("connect.php");

        $username = $_POST["regname"];
        $password = $_POST["regpass"];
        $repassword = $_POST["reregpass"];
        $regmail = $_POST["regmail"];

        $sql = "select * from user where user_name = '$username'";
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($result);
        if($row!=0)
        {
            echo "Tên tài khoản đã tồn tại";
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');          
            
        }            
        else
        {   
            if($password != $repassword)
            {
                echo "Mật khẩu không trùng nhau";
                header('HTTP/1.1 500 Internal Server Booboo');
                header('Content-Type: application/json; charset=UTF-8');  
            }
            else
            {
                if (!filter_var($regmail, FILTER_VALIDATE_EMAIL))
                {
                  echo "Email không hợp lệ";
                  header('HTTP/1.1 500 Internal Server Booboo');
                  header('Content-Type: application/json; charset=UTF-8');  
                }        
                else
                {
                    $sql = "insert into user (user_id,user_name,user_password) values(null,'$username','$password')";
                    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

                    $sql = "select * from user where user_name = '$username'";
                    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                    $row = mysqli_fetch_assoc($result);
                    $id = $row["user_id"];
                    $_SESSION['user_id']  = $id;
                    echo "Đăng ký thành công";  
                }
            }
        }
    
?>