<!DOCTYPE html>
<html lang="en">
	<head>
		
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Intro_Page</title>
		<meta name="description" content="">
		<meta name="author" content="LocalNIC">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="stylesheet" type="text/css" href="style.css" media="screen">
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<?php
   session_start();
   	$u=$_SESSION['login'];
	$src=$_SESSION['vid'];
	echo "Hello ".$u."</br>";
	
    if(isset($_POST['fname']))
    {
	        $a=$_POST['fname'];
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
            $result=mysql_query("select * from entry where vid='$src';");
		  $row = mysql_fetch_array($result);
		  $cat=$row{'category'};
		  $set=$row{'user'};
		  $topic=$row{'vname'};
          $tar="solution/";
          $a=strtolower($a);
          if (!is_dir($tar)) 
          {
            mkdir($tar, 0777, true);
          }
          $filename=$_FILES['ass']['name'];
          $ext=end(explode(".", $filename));
          $file=$tar.$a.".".$ext;
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
           $result="insert into solution (user,aname,category,topic,mentor) values ('$u','$a','$cat','$topic','$set');";
           if (move_uploaded_file($_FILES['ass']['tmp_name'], $file)&&mysql_query($result,$dbhandle)) 
           {
           	   echo '<script> alert("The file has been uploaded.") ; window.close();</script>';
	       } 
		   else if (!mysql_query($result,$dbhandle))
           {
               die('Error: ' . mysql_error());
           }  
           else 
           {
            echo '<script> alert("Sorry, there was an error uploading your file!") ; window.close();</script>';
		   }
          }
          mysql_close($dbhandle);
   }
?>
 </head>
 <body>
 	<header>
	<div class="header" style="width:90%">
            <div style="width:28%;float:left; margin-left: 5%;" class='black-one'>
            <div style='float:left;'><img src="images/main.jpg" width="100%" height="50px"/></div>
            <div style="clear:both"></div>
            </div>
            <div style="width:50%;float:left; text-align:right" class='red-one'>
            <div id="ls" style="margin:10px auto;">
            	<nav>
					<li>
					<a href="http://localhost/project1/main.php"> Home </a></li>
					<li>
					<a href="/contact"> Contact </a></li>
					<li>
					<a href="/contact"> About ABC </a></li>
			 </nav>
            </div>
            <div style="clear:both"></div>
            </div>
	</header>
 	<article>
 	<div id="tri">
 	<form action="sub.php" method="post" enctype="multipart/form-data">
            Solution name:<input type="text" name="fname" /></br>
            Assignment File:<input type="file" name="ass" /></br>
            <input type="submit" value="Upload" />
     </form>
     </div>
    </article>
</body>
</html>
