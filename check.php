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
	echo "Hello ".$u.","."</br>";
	if(isset($_POST['asval']))
    {
	 $naam=$_POST['asval'];
	 header("Content-Type: application/octet-stream");
     header("Content-Disposition: attachment; filename=download.txt");
     readfile('$naam'); 
    }
	if(isset($_POST['fname'])&&isset($_POST['day']))
	{
		    $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("formdata",$dbhandle)
               or die("Error linking to data");
			$u=$_SESSION['login'];
			$result=mysql_query("SELECT * from teacher where user = '$u';");
			$row=mysql_fetch_array($result);
			$mento=$row{'ename'};
			$f=$_POST['fname'];
			$d=$_POST['day'];
			
		  $tar="result/";
          $a=strtolower($f);
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
            echo '<script> alert("Sorry, file already exists.") ;</script>';
            $uploadOk = 0;
            return;
          }
          if ($uploadOk == 0) 
          {
            echo '<script> alert("Sorry, file not uploaded.") ;</script>';
	        return;
          }
          else 
          {
           $result="insert into result(mentor,fname,dated) values('$mento','$f','$d');";
          if (move_uploaded_file($_FILES['ass']['tmp_name'], $file)&&mysql_query($result,$dbhandle)) 
           {
           	   echo '<script> alert("The file has been uploaded.") ;</script>';

	       } 
		   else if (!mysql_query($result,$dbhandle))
           {
               die('Error: ' . mysql_error());
           }  
           else 
           {
            echo '<script> alert("Sorry, there was an error uploading your file!") ;</script>';
           }
          }
          mysql_close($dbhandle);
	}
?>
<script>
	function change()
	{
		var loading = document.getElementById ("hide");
		loading.style.visibility = "visible";
		loading.style.display = "block";
	} 
</script>
</head>
<body>
	<header>
			 <h3>Help your students</h3>
			 <nav>
					<li>
					<a href="/">Home</a></li>
					<li>
					<a href="/contact">Contact</a></li>
			 </nav>
	</header>
	<section>
		<div id="real">
		<table style="width:80%; center; background:#FFFFFF; color: black; margin:auto" border="1">
		<tr><td><b>USER</b></td><td><b>CATEGORY</b></td><td><b>TOPIC</b></td><td><b>FILE</b></td></tr>
		  <?php
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
			$u=$_SESSION['login'];
            $result = mysql_query("SELECT * from solution where mentor = '$u';");
            while ($row = mysql_fetch_array($result)) 
            {
             echo '<tr>';
			 echo '<td>'.$row{'user'}.'</td><td>'.$row{'category'}.'</td><td>'.$row{'topic'}.'</td><td><form action="check.php" method="post"><input id="qstn" type="submit" name="asval" value="'.strtoupper($row{'aname'}).'"></form></td>';	
			 echo '</tr>';
          	} 
			mysql_close($dbhandle);
	      ?>
		</table>
		</div id="real">
<h3>		
<script language="JavaScript1.2">
var message="UPLOAD RESULTS"
var neonbasecolor="grey"
var neontextcolor="white"
var flashspeed=150  
var n=0
if (document.all||document.getElementById){
document.write('')
for (m=0;m<message.length;m++)
document.write('<span id="neonlight'+m+'">'+message.charAt(m)+'</span>')
document.write('')
}
else
document.write(message)

function crossref(number){
var crossobj=document.all? eval("document.all.neonlight"+number) : document.getElementById("neonlight"+number)
return crossobj
}

function neon(){

//Change all letters to base color
if (n==0){
for (m=0;m<message.length;m++)
//eval("document.all.neonlight"+m).style.color=neonbasecolor
crossref(m).style.color=neonbasecolor
}
crossref(n).style.color=neontextcolor

if (n<message.length-1)
n++
else{
n=0
clearInterval(flashing)
setTimeout("beginneon()",1500)
return
}
}

function beginneon(){
if (document.all||document.getElementById)
flashing=setInterval("neon()",flashspeed)
}
beginneon()
</script>
</h3>
		<div id="act">
		 <form action="check.php" method="post" enctype="multipart/form-data">
		 Filename</br><input type="text" name="fname"></br>
		 Date</br><input type="date" name="day" /></br></br>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;File:<input type="file" name="ass" /></br>
		 <input type="submit" id="cont2" value="Submit">
		 </form>
		 </div>
	</section>
	<footer>
				<p>
					&copy; Copyright  by LocalNIC
				</p>
    </footer>
</body>