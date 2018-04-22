<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Logged in</title>
		<meta name="description" content="">
		<meta name="author" content="LocalNIC">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="stylesheet" type="text/css" href="style.css" media="screen">
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<script>
  function about()
  {
   s="ABC Zone is an educational website aimed at providing an online platform for students to learn variety of subjects from teachers from well known colleges.";
   alert(s);  
  }
  function enq()
  {
   s="\nWrite to the developer at sourabhjajoria@gmail.com";
   alert(s);
  }
		function upload()
		{
		var loading = document.getElementById ("hide");
		loading.style.visibility = "visible";
		loading.style.display = "block";
		loading = document.getElementById ("rep");
		loading.style.display = "none";

		}
		function assignment()
		{
			 var width =  550;
             var height = 410;
             var left = parseInt((screen.availWidth/2) - (width/2));
             var top = parseInt((screen.availHeight/2) - (height/2))-50;
             var windowFeatures = "width=" + width + ",height=" + height + ",status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
            var person = prompt("1. Add MCQs\n2.Add Problem\nPlease enter your choice", "");
            if (person != null) 
            {
   			 if(person==1)
   			  window.open("temp.php","Upload Assignment",windowFeatures);
		     else if(person==2)
		      window.open("assign.php","Upload Assignment",windowFeatures);
		    }
		}
		function check()
		{
			window.open("check.php","Checking Assignment");
		}
		function reply()
		{
   			 var width =  600;
             var height = 410;
             var left = parseInt((screen.availWidth/2) - (width/2));
             var top = parseInt((screen.availHeight/2) - (height/2))-50;
             var windowFeatures = "width=" + width + ",height=" + height + ",status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;

			window.open("ans.php","Doubts",windowFeatures);
		}
		function update()
		{
			var v=document.getElementById("type");
			var d=document.getElementById("depd");
			d.value=v.value;
		}
	</script>
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
          $u=$_SESSION['login'];
          $c=$_POST['cat']; 
          $n=$_POST['title'];
		  $t=$_POST['tn'];
		  $c=strtolower($c);
          $tar="videos/".$c.'/';
          $n=strtolower($n);
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
            <div style="width:12%;height:60px; float:left; margin-left: 5%;" class='black-one'>
            <div style='float:left;'><img src="images/main.jpg" width="100%" height="60px"/></div>
            <div style="clear:both"></div>
            </div>
            <div style="width:70%;float:left; text-align:right" class='red-one'>
            <div id="ls" style="margin:auto;">
            	<nav>
					<li>
					<a href="http://localhost/project1/main.php"> Home </a></li>
					<li>
					<a onclick="enq();"> Contact </a></li>
					<li>
					<a onclick="about();"> About ABC </a></li>
			 </nav>
            </div>
            <div style="clear:both"></div>
            </div>
            <div style="width:10%;float:right;" class='yellow-one'>
            <div style='float:right;text-align:right;'>
            <form action="logout.php">
            <button id="log" type="submit">Log Out</button>
            </form>
            </div>
            <div style="clear:both"></div>
             </div>
             <div style="clear:both"></div>
             </div>
			</header>
			<article>
				<div id="tri">
				  <div id="rep">
                   <button id="upl" onClick="upload();">Add Lecture</button>
                  </div id="rep">
                  <div id="hide">
                  	 <form action="teacher.php" method="post" enctype="multipart/form-data">
                       Teacher's Name&nbsp;<input type="text" name="tn" /></br>
                       Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="depd" name="cat" placeholder="Create new" />
            OR <select id="type" onchange="update();">
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
            $result = mysql_query("SELECT distinct category from entry ;");
			echo '<option selected="selected">Select existing</option>';
            while ($row = mysql_fetch_array($result)) 
            {
               echo '<option value="'.$row{'category'}.'">'.$row{'category'}.'</option>';
			}                  
           ?>
            </select></br>
                       Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title" /></br>
                       File&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="vid" /></br>
                     <input id="logn" type="submit" value="Upload" /> 
                   </form>	
                  </div id="hide">
			      <button id="upl" onclick="assignment();">Add Assignment</button>
			      </div id="tri">
			      <div id="tri">
			      <button id="upl" onclick="check();" >Check Assignments</button>
			       <button id="upl" onclick="reply();" >Doubts Corner</button>
			    </div id="tri">
			</article>
			<footer>
				<p>
					&copy; Copyright  by LocalNIC
				</p>
			</footer>
		</div>
	</body>
</html>
