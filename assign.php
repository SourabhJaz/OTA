<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen">
		<meta charset="utf-8">				
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
		    $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
		 if(isset($_POST['aname']))
		 {
          echo "</br>";
          $u=$_SESSION['login'];
          $a=$_POST['aname']; 
		  $v=$_POST['butt'];
          $tar="assignment/";
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
            return;
          }
          if ($uploadOk == 0) 
          {
            echo '<script> alert("Sorry, file not uploaded.") ; window.close();</script>';
	        return;
          }
          else 
          {
           $result="insert into link (path,user,aname,vid) values ('$file','$u','$a','$v');";
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
            echo '<script> alert("Sorry, there was an error uploading your file!") ;window.close(); </script>';
			
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
            <div style="width:28%;float:left; margin-left: 5%;" class='black-one'>
            <div style='float:left;'><img src="images/main.jpg" width="100%" height="60px"/></div>
            <div style="clear:both"></div>
			</header>
            <article>
            <form id="frm" action="assign.php" method="post" enctype="multipart/form-data">
            Assignment name:<input type="text" name="aname" /></br>
            Assignment File:&nbsp;&nbsp;<input type="file" name="ass" /></br>
			<?php
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
			$u=$_SESSION['login'];
			echo '<h2>Choose a Lecture :</h2>';
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
            $result = mysql_query("SELECT * from entry where user='$u' ;");
            while ($row = mysql_fetch_array($result)) 
            {
               echo '<input type="submit" id="ashol" name="butt" value="'.$row{'vid'}.'">'.' '.strtoupper($row{'category'}).'->'.strtoupper($row{'vname'})."</br>";
			} 
	        ?>
	        </form>
	        </article>
			<footer>
				<p>
					&copy; Copyright  by LocalNIC
				</p>
			</footer>
		</div>
	</body>
</html>
