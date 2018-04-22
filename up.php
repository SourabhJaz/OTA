<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Upload new Video</title>
		<meta name="description" content="">
		<meta name="author" content="LocalNIC">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		<?php
		 session_start(); 
		 echo "Hello ".$_SESSION['login'];
		 if(isset($_POST['cat'])&&isset($_POST['title'])&&isset($_SESSION['state']))
		 {
          $username = "root";
          $password = "1234";
          $hostname = "localhost"; 
          //127.0.0.1
          //connection to the database
          $dbhandle = mysql_connect($hostname, $username,$password)
          or die("Unable to connect to MySQL");
          $selected = mysql_select_db("videodata",$dbhandle)
          or die("Error linking to data");
          echo "</br>";
          if ($_FILES['vid']['size'] > 9000000)
          {
         	echo '<script> alert("File too large!!") ; window.close();</script>';
			return;
          } 
          $u=$_SESSION['login'];
          $c=$_POST['cat']; 
          $n=$_POST['title'];
		  $t=$_POST['tn'];
          $tar="videos/".$c.'/';
          $n=strtolower($n);
		  $c=strtolower($c);
          $tn=strtolower($t);
          if (!is_dir($tar)) 
          {
            mkdir($tar, 0777, true);
          }

          $filename=$_FILES['vid']['name'];
          $ext=end(explode(".", $filename));
          $file=$tar.$n.".".$ext;

          $uploadOk = 1;

          if (file_exists($file)) 
          {
            echo '<script> alert("Sorry, file already exists.") ; window.close();</script>';
            $uploadOk = 0;
          }
          if ($uploadOk == 0) 
          {
            echo '<script> alert("Sorry, file not uploaded.") ; window.close();</script>';
	        return;
          }
          else 
          {
           $result="insert into entry (category,path,user,vname,name) values ('$c','$file','$u','$n','$t');";
           if (move_uploaded_file($_FILES['vid']['tmp_name'], $file)&&mysql_query($result,$dbhandle)) 
           {
           	   echo '<script> alert("The file has been uploaded.") ; window.close();</script>';
	       } 
		   else if (!mysql_query($result,$dbhandle))
           {
               die('Error: ' . mysql_error());
           }  
           else 
           {
           echo '<script> alert("Sorry, there was an error uploading your file!") ;  window.close();</script>';
           }
          }
          mysql_close($dbhandle);
         }
         ?>
	</head>

	<body>
		<div>
			<header>
			<div class="header" style="width:90%">
            <div style="width:18%;float:left; margin-left: 5%;" class='black-one'>
            <div style='float:left;'><img src="images/main.jpg" width="70px" height="40px"/></div>
            <div style="clear:both"></div>
            </div>
            <div style="width:70%;float:left; margin-top:2%; text-align:right" class='red-one'>
            <div style="margin:2px auto;">
            	<nav>
					<li>
					<a href="http://localhost/project1/main.php">| Home |</a></li>
					<li>
					<a href="/contact">| Contact |</a></li>
					<li>
					<a href="/contact">| About ABC |</a></li>
			 </nav>
            </div>
            <div style="clear:both"></div>
            </header>            
			
			
			
			
			
			


			<div>
            <form action="up.php" method="post" enctype="multipart/form-data">
            Teacher's Name:<input type="text" name="tn" /></br>
            Category:<input type="text" name="cat" /></br>
            Name:<input type="text" name="title" />
            File:<input type="file" name="vid" /></br>
            <input type="submit" value="Upload" /> 
            </form>
			</div>

			<footer>
				<p>
					&copy; Copyright  by LocalNIC
				</p>
			</footer>
		</div>
	</body>
</html>
