<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/style.css">
    <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- For-Mobile-Apps-and-Meta-Tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Simple Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //For-Mobile-Apps-and-Meta-Tags -->

    <?php
    session_start();
    require_once("connect.php");

    if(isset($_POST["btn"]))
    {
        $username = $_POST["name"];
        $password = $_POST["pass"];
        $sql = "select * from user where user_name = '$username' and user_password ='$password'";
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($result);
        $id = $row["user_id"];
        $_SESSION['user_id']  = $id;
        //$id=$_SESSION['user_id'];
        $count = mysqli_num_rows($result);
        if($count ==1)
        {     
            //header("location:profile.php?id=$id");
            header("Location: index.php");
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Sai tài khoản hoặc mật khẩu");';
            echo '</script>';
        }
    }

    
    ?>

    </head>
<style type="text/css">

label[id="reglb"]
{
    text-decoration: none;
}

label[id="reglb"]:hover
{
    text-decoration: underline;
}

</style>
    <body bgcolor="whitesmoke">
        
    <meta charset="utf-8">
    <div class="container w3">
        <h2 id="h2text">Đăng nhập</h2>
        <form action="" method="post" id="login">
            <div class="username">
                <span class="username">Username:</span>
                <input type="text" name="name" class="name" placeholder="" required="">
                <div class="clear"></div>
            </div>

            <div class="password-agileits">
                <span class="username">Password:</span>
                <input type="password" name="pass" class="password" placeholder="" required="">
                <div class="clear"></div>
            </div>

            <div style="width: 100%;">
                <input type="submit" name="btn" class="login" value="Đăng nhập">
            </div>
            <div style="margin-top: 20px;">
                <label>Bạn không có tài khoản?</label> <label id="reglb" style="color: blue">Đăng ký !</label>
            </div>
            <div class="clear"></div>
        </form>


        <form action="" method="post" style="display:none" id="reg">
            <div class="username">
                <span class="username">Username:</span>
                <input type="text" name="regname" class="name" placeholder="" required="">
                <div class="clear"></div>
            </div>

            <div class="password-agileits">
                <span class="username">Password:</span>
                <input type="password" name="regpass" class="name" placeholder="" required="">
                <div class="clear"></div>
            </div>

            <div class="password-agileits">
                <span class="username">Confirm pass:</span>
                <input type="password" name="reregpass" class="name" placeholder="" required="">
                <div class="clear"></div>
            </div>

            <div class="password-agileits">
                <span class="username">Email</span>
                <input type="text" name="regmail" class="name" placeholder="" required="">
                <div class="clear"></div>
            </div>

            <div style="width: 50%;margin-left: 25%">
                <input type="submit" name="regbtn" class="login" value="Đăng ký">
            </div>

            <div style="margin-top: 20px;">
                <label>Bạn đã có tài khoản?</label> <label id="loglb" style="color: blue">Đăng nhập !</label>
            </div>
            <div class="clear"></div>
        </form>

    </div>
<script type="text/javascript">
    $('#reglb').click(function()
    {
        $('#h2text').text("Đăng ký");
        $('form#login').hide(500);
        $('form#reg').show(500);
    });

    $('#loglb').click(function()
    {
        $('#h2text').text("Đăng nhập");
        $('form#login').show(500);
        $('form#reg').hide(500);
    });

    $('form#reg').submit(function(event)
    {
        event.preventDefault();
        var form_data = new FormData($(this)[0]);            
        $.ajax(
        {
                  url: 'reg.php', // point to server-side PHP script 
                  dataType: 'text',  // what to expect back from the PHP script, if anything
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form_data,                         
                  type: 'post',
                  error: function(request, status, error)
                  {
                    alert(request.responseText);
                  },
                  failure: function(request, status, error)
                  {
                    alert(request.responseText);
                  },
                  success: function(php_script_response)
                  {
                    alert(php_script_response);
                    location.reload();
                  }
         });
    });

</script>        
    </body>
</html>