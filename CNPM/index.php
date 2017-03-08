<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<meta charset="utf-8">
<!-- css -->

<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/mycss.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jquery + bootstrap -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/jquery.barrating.js"></script>
<script src="js/examples.js"></script>

<script type="text/javascript">
   $(function() {
      $('#example-fontawesome-o').barrating({
        theme: 'fontawesome-stars'
      });
   });
</script>
<!-- font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" href="css/themes/fontawesome-stars.css">
<link rel="stylesheet" href="css/themes/css-stars.css">
<link rel="stylesheet" href="css/themes/bootstrap-stars.css">
<link rel="stylesheet" href="css/themes/fontawesome-stars-o.css">

<?php
	require_once("connect.php");
	session_start();
	if(!isset($_SESSION['user_id']))
    	header("Location: login.php");
	$id = $_SESSION['user_id'];

	$sql = "select * from user where user_id = '$id'";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	$user_name = $row['user_name'];

	$sql2 = "select * from user where user_id in (select user_following_id from follow where user_id ='$id')";
	$result2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
	$row2 = mysqli_fetch_assoc($result2);

	$sql3 = "SELECT * from images where user_id in (select user_following_id from follow where user_id ='$id') ";
	$result3 = mysqli_query($conn,$sql3) or die(mysqli_error($conn));
	$row3= mysqli_fetch_assoc($result3);


	$sql = "SELECT * from images where user_id in (select user_following_id from follow where user_id ='$id') ";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$num_rows = mysqli_num_rows($result);
	while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
	{
	  $storedNameArray[]= $row['img_name'];
	  $storedCaptionArray[]=$row['img_caption'];
	  $storedImageIDArray[]=$row['img_id'];

	}
?>

<?php
	if(isset($_POST["homebtn"]))
	{
	    header("location:index.php");
	}
?>

<title>CSGO Stats</title>

</head>

<body>

<!-- !PAGE CONTENT! -->
<div class="" style="overflow: hidden;margin: auto;max-width: 1800px" >

  <!-- Header -->
   
    <div class="container" style="border-bottom: 1px; border-bottom-style: solid;">

		<!-- Main button-->
		    <form id="random" method="post" autocomplete="off">

				<button class="btn btn-info btn-lg" name="homebtn"><img src="icons/home.png"></button>
  		        <input id="searchbox" name="searchbox" type="text" style="width: 250px;height: 30px;border-radius: 15px;" placeholder="Tìm kiếm">
			    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" name="uploadbtn"><img src="icons/mini_upload_icon.png"></button>
			    <button class="btn btn-info btn-lg" name="userbtn" id="userbtn"><img src="icons/mini_user_icon.png"></button>

		    </form>

	    <!-- Modal -->
	        <div class="modal fade" id="myModal" role="dialog">
	            <div class="modal-dialog">
	            
	              <!-- Modal content-->
	                <div class="modal-content">

	                  <form id="upload" role="form" method="post" enctype="multipart/form-data">

	                    <div class="modal-header">
	                      <button type="button" class="close" data-dismiss="modal">&times;</button>
	                      <h4 class="modal-title">Upload your image</h4>
	                    </div>

	                    <div class="modal-body">

	                        <div id="imageuploadedornot" style="display: none">
	                          <img src="#" id ="blankImg">
	                        </div>

	                        <div class="form-group" id="caption01" style="margin-top: 15px;display: none; ">
	                        
	                          <input style="width: 40%;" type="text" id="imgcaption" name="imgcaption" placeholder="Tên món ăn..." value="">
	                          <h3>Nội dung</h3>
	                          <textarea cols="50" rows="20" name="imgcontent"></textarea>
	                          <br>
	                          <input style="width: 40%;" type="text" id="imgprice" name="imgprice" placeholder="Giá tiền..." value=""><br/><br/>
	                          
	                          <input style="width: 40%;" type="text" id="imglocation" name="imglocation" placeholder="Địa điểm..." value="">
	                        <div class="col col-fullwidth">
					            <div class="star-ratings">
					              <p>It can be used to display fractional star ratings.</p>
					              <div class="stars stars-example-fontawesome-o">
					                <select id="example-fontawesome-o" name="rating" data-current-rating="0" autocomplete="off">
					                  <option value=""></option>
					                  <option value="1">1</option>
					                  <option value="2">2</option>
					                  <option value="3">3</option>
					                  <option value="4">4</option>
					                  <option value="5">5</option>
					                </select>
					                <span class="title current-rating">
					                  Current rating: <span class="value"></span>
					                </span>
					                <span class="title your-rating hidden">
					                  Your rating: <span class="value"></span>&nbsp;
					                  <a href="#" class="clear-rating"><i class="fa fa-times-circle"></i></a>
					                </span>
					              </div>
					            </div>
					          </div>	                          

	                        </div>

	                        <div class="form-group" style="margin-top: 10px;">
	                             <label for="myfile">File Upload</label>
	                             <input type="file" id="file" name="file">
	                        </div>

	                    </div>

	                    <div class="modal-footer">
	                      <button id="sendbtn" class="btn btn-default" style="background-color: green;">Upload</button>
	                      <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                    </div>
	                    
	                  </form>   
	                </div>
	            </div>
	        </div>
		<!-- User modal-->
			<div id="test" style="display: none;position: absolute;-webkit-box-align: center;align-items: center;margin: auto;z-index: 1;">
			   	 <div class="list-group">
				    <button id="user01" name="user01" class="list-group-item" style="text-align: center;">Trang cá nhân</button>
				    <button id="logout01" name="logout01" class="list-group-item" style="text-align: center;">Đăng xuất</button>
				  </div>
			</div>
 		</div>
 		
	<!-- Username title and bio -->
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">WebSiteName</a>
		    </div>
		    <ul class="nav navbar-nav">
		      <li class="active"><a href="#">Home</a></li>
		      <li><a href="#">Page 1</a></li>
		      <li><a href="#">Page 2</a></li>
		    </ul>
		    <form class="navbar-form navbar-left">
		      <div class="input-group">
		        <input type="text" class="form-control" placeholder="Search">
		        <div class="input-group-btn">
		          <button class="btn btn-default" type="submit">
		            <i class="glyphicon glyphicon-search"></i>
		          </button>
		          
		        </div>
		      </div>
		    </form>
		  </div>
		</nav>
	  <header class="w3-panel w3-padding-128 w3-center w3-opacity">
	    <h1 class="w3-xlarge"><b>Name of website +logo </b></h1>
	  </header>

	<!-- Image list -->

	  <div class="w3-row-padding" id="myGrid" style="margin-bottom:128px;text-align: center;">
      <?php
        for ($i=0; $i < $num_rows ; $i++)
        { 
          ?>
          <div>
              <h2><?php echo $storedCaptionArray[$i]; ?></h2>
              <img class="" src="images/<?php echo $storedNameArray[$i];?>" style="width:30%;" name="<?php echo $storedImageIDArray[$i];?>" onclick="onClick(this)" alt="<?php echo $storedCaptionArray[$i];?>">
           </div>
          <?php
        }
      ?>
	  </div>

	<!-- Search modal-->
	      <div id="sb" style="border-radius: 15px;display: none;width: 250px;position: absolute;-webkit-box-align: center;align-items: center;margin: auto;z-index: 1;">
	          <div id="sbctn" style="" class="list-group">
	          </div>
	      </div>

	<!-- Modal for full size images on click-->
	  <div id="modal01" class="w3-modal" style="background-color: black;">
	    <span id="closebtn" class="w3-closebtn w3-text-white w3-opacity w3-hover-opacity-off w3-xxlarge w3-container w3-display-topright">×</span>
	    <div id="container" style="overflow:hidden; max-width: 1400px; max-height: 900px; margin:auto;">
	      <div id="imgcontainer" class="" style="float:left;position: relative;height: 500px;background-color: white">

	        <img id="img01" style="width: 600px;height: 100%;float: left;border-radius: 10px;">   
	        <div style="width: 400px;height: 100%; float: left; padding-left: 20px;" >
	        	<h1 id="caption"></h1>
	        	<br>
	        	<span style="color: #afafb2">Gía tiền:</span><p id="price"></p>
	        	<span style="color: #afafb2">Địa chỉ:</span><p id="location"></p>
	        	<h3>Đánh giá</h3>
	        	<p id="content"></p>

	        </div>
  
	      </div>
	      <div id="cmtctn" style="width: 350px;background-color: white; float: left;position: relative;border-left: 1px solid gray">
	        <div id="cmtctn02" style="float: none; margin-left: 10px;word-wrap: break-word;overflow-y:auto;">
	            <!-- chứa comment -->
	        </div>

	        <div style="overflow: hidden; float: none; margin-left: 10px;margin-top: 50px;position: absolute;left:10px;bottom:10px;">
	            <input id="cmt" type="text" placeholder="Viết cảm nghĩ của bạn" style="width: 250px;">
	            <button id="cmtbtn">Đăng</button>
	        </div>
	      </div>
	    </div>


	  </div>

</div>
<!-- End Page Content -->

<!-- All event -->

<script>
	$(document).ready(function () 
	{
	// upload image
	      $('form#upload').submit(function(event)
	      {
	        event.preventDefault();
	        var file_data = $('#file').prop('files')[0];   
	        var rating = $('.value').text(); 	        
	        var form_data = new FormData($(this)[0]);           
	        form_data.append('file', file_data);
	        form_data.append('rating', rating);	                       
	        $.ajax({
	                  url: 'upload.php', // point to server-side PHP script 
	                  dataType: 'text',  // what to expect back from the PHP script, if anything
	                  cache: false,
	                  contentType: false,
	                  processData: false,
	                  data: form_data,                         
	                  type: 'post',
	                  success: function(php_script_response)
	                  {
	                    alert(php_script_response); // display response from the PHP script, if any
	                  }
	       });
	      $('#close').trigger( "click" );
	      });

	// click close button in modal picture gallery
	    $('#closebtn').click(function()
	    {
        $('#modal01').hide();
        $('#price').empty();
        $('#location').empty();
        $('#content').empty();
          $('#cmtctn02').empty();
	    });

	// trigger preview picture when upload
	    $("#file").change(function()
	    {
	      readURL(this);
	    });

	// press enter in comment box
	    $('#cmt').keypress(function(e)
	    {
	      if(e.which == 13) 
	      {
	        addCheckbox($('#cmt').val());
	      }
			$('#cmtctn02').scrollTop($('#cmtctn02').height());
	    });

	    $('body').on('click','a',function()
	    {
	      testAjax(this);
	    });

    // click Đăng button
      $('#cmtbtn').click(function()
      {
        addCheckbox($('#cmt').val());
        $('#cmtctn02').scrollTop($('#cmtctn02').height());
      });

	// search box key press
	      $('#searchbox').keyup(function(event)
	      {
	        event.preventDefault();
	        $('#sb').offset({ top: 0, left: 0});
	        $('#sb').hide();
	        $('#sbctn').empty();
	        var a = $('#searchbox').val();
	        $.ajax
	          ({
	              type: "POST",
	              data: {name:a},
	              url: "searchname.php",
	              dataType: 'json',
	              cache: false,
	              success: function(data)
	              {
	                var num=data.num;
	                var name=data.username;
	                for(var i=0;i<num;i++)
	                {
	                  var txt = name[i];
	                  var r = '<button class="list-group-item" style="text-align: center;">'+name[i]+'</button>';
	                  $('#sbctn').append(r);

	                }

	                
	              }
	          });

	                var p = $("#searchbox");
	                var offset = p.offset();
	                $("#sb").offset({ top: (offset.top+35), left: (offset.left)});
	                $('#sb').show();
	      });

	// when click on user name
	      $('#sbctn').on('click','button',function()
	      {

	        var a = $(this).text();
	        testAjax(a);
	      });

	// when click on user name
	      $('body').on('click','a',function()
	      {
	        testAjax(this.text);
	      });

	// back to login page when click logout
		$('#logout01').click(function()
		{
			logout();
		});

	// go to profile page
		$('#user01').click(function()
		{
			goprofile();
		});

	});

	// Modal Image Gallery When Click Image
	    function onClick(element) 
	    {
	      document.getElementById("img01").src = element.src;
	      document.getElementById("img01").name = element.name;
	      document.getElementById("modal01").style.display = "block";
	      var captionText = document.getElementById("caption");


	      captionText.innerHTML = element.alt;

	      $('#cmtctn').height($('#img01').height());
	      $('#cmtctn02').css('max-height', $('#img01').height()-50);
	      var img_id01 = element.name;
	      loadcomment(img_id01);
	      loadinfo(img_id01);
	      $('#cmt').focus();
	    }

	// load comment using ajax

	    function loadcomment(id)
	    {
	      $.ajax
	          ({
	              type: "POST",
	              data: {id:id},
	              url: "loadcomment.php",
	              dataType: 'json',
	              cache: false,
	              success: function(data)
	              {
	                var num=data.num;
	                var name=data.username;
	                var comment=data.comment;

	                for (var i = 0;i<num;i++)
	                {
	                  loadAllComment(name[i],comment[i]);
	                }
	              }
	          });
	    }
	// load info using ajax
	    function loadinfo(id)
	    {
	      $.ajax
	          ({
	              type: "POST",
	              data: {id:id},
	              url: "loadinfo.php",
	              dataType: 'json',
	              cache: false,
	              success: function(data)
	              {
	                var num=data.num;
	                var content=data.content;
	                var price=data.price;
	                var location=data.location;

	                for (var i = 0;i<num;i++)
	                {
	                  loadAllInfo(content[i],price[i],location[i]);
	                }
	              }
	          });
	    }	
	// preview uploaded picture
	    function readURL(input) 
	    {
	      if (input.files && input.files[0]) 
	      {
	        var reader = new FileReader();
	        reader.onload = function (e)
	        {
	          $('#blankImg').attr('src', e.target.result);
	          document.getElementById("imageuploadedornot").style.display = "block";
	          $('#caption01').show();
	        }
	          reader.readAsDataURL(input.files[0]);
	      }
	    }   

    // user button clicked
	    $('#userbtn').click(function(event)
	    {
	    	event.preventDefault();
	    	if(document.getElementById('test').style.display=='block')
	    	{

				$("#test").offset({ top: 0, left: 0});
	    		document.getElementById('test').style.display='none';
	    	}
	    	else
	    	{

	    		var p = $("#userbtn");
				var offset = p.offset();
				$("#test").offset({ top: (offset.top+50), left: (offset.left-70)});
	    		document.getElementById('test').style.display='block';
	    	}
	    });

	// update your comment chat
	      function addCheckbox(comment) 
	      {
	        if(comment!="")
	        {
	          var text='<a href=#><?php echo $user_name?><a/>';
	          var text01='<?php echo $user_name?>';
	          var text2=comment;
	          var text3=document.getElementById("img01").name;
	          $('#cmtctn02').append(text);
	          $('#cmtctn02').append("&nbsp;");
	          $('#cmtctn02').append("&nbsp;");
	          $('#cmtctn02').append(text2);
	          $('#cmtctn02').append("<br>");
	          $('#cmt').val("");
	          addComment(text01,text2,text3)
	        }
	        else
	        {
	          alert("Không được comment trống");
	        }
	      }  

	// add comment to dtb
	    function addComment(name,comment,id)
	    {
	      $.ajax
	        ({
	            type: "POST",
	            data: {name:name,comment:comment,id:id},
	            url: "addComment.php",
	            dataType: 'json',
	            cache: false,
	            success: function(data)
	            {
	            }
	        });
	    }
	// load comment
	    function loadAllComment(name,comment)
	    {
	        var text='<a href=#>'+name+'<a/>';
	        var text3 =comment;
	        $('#cmtctn02').append(text);
	        $('#cmtctn02').append("&nbsp;");
	        $('#cmtctn02').append("&nbsp;");
	        $('#cmtctn02').append(text3);
	        $('#cmtctn02').append("<br>"); 
	    } 

	    function loadAllInfo(content,price,location)
	    {
	        var text=content;
	        var text2=price;
	        var text3=location;

	        $('#content').append(text);
	        $('#price').append(text2);
	        $('#location').append(text3);

	    }
	// logout
		function logout()
	  	{
			$.ajax
		      ({
		          url: "logout.php",
		          success: function(data)
		          {
		            window.location = ("login.php");
		          }
		      });
	  	}
	// go profile
		function goprofile()
		{
			$.ajax
		      ({
		          url: "get_user_id2.php",
		          dataType: 'json',
		          cache: false,
		          success: function(data)
		          {
		            window.location = ('./profile.php?id='+data.first);
		          }
		      });
		}

	// ajax go to user profile when click user name
	  	function testAjax(test)
	  	{
	      $.ajax
	      ({
	          type: "POST",
	          data: {name:test},
	          url: "get_user_id.php",
	          dataType: 'json',
	          cache: false,
	          success: function(data)
	          {
	            window.location = ('./profile.php?id='+data.first);
	          }
	      });
	  	}

	/*
	//cach 2
	    function AtestAjax()
	    {
	      $.getJSON("get_user_id.php", function(data) 
	      {
	        alert("Value for 'a': " + data.first + "\nValue for 'b': " + data.last);
	      });
	    }

	*/

</script>

</body>
</html>