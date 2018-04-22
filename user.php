<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>user</title>
		<meta name="description" content="">
		<meta name="author" content="LocalNIC">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css" media="screen">
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<?php

if(isset($_POST["name"])&&$_POST["usr"]&&$_POST["pass"]&&$_POST["coll"]&&$_POST["des"])
{
 $n=$_POST["name"];
 $u=$_POST["usr"];
 $p=$_POST["pass"];
 $c=$_POST["coll"];
 $d=$_POST["des"];
 $username = "root";
 $password = "1234";
 $hostname = "localhost"; 
//127.0.0.1
//connection to the database
$n=strtolower($n);
$c=strtolower($c);
//$p=md5($p);
 $dbhandle = mysql_connect($hostname, $username,$password)  
 or die("Unable to connect to MySQL");
 $selected = mysql_select_db("formdata",$dbhandle)
  or die("Error linking to data");

 if(strcmp($d,"teacher")==0)
 {
  $result ="insert into teacher (user,pswd,ename,college) values ('$u','$p','$n','$c');";
 }
 else 
 {
  $result ="insert into student (user,pswd,ename,college) values ('$u','$p','$n','$c');";	
 }
 if (!mysql_query($result,$dbhandle))
 {
  die('Error: ' . mysql_error());
 }
 else
 {
  echo '<script> alert("Account created successfully \nThank you for choosing ABC Zone."); </script>';
  			//echo '<script> location.reload(); </script>';
  //echo "<script>window.open('user.html');window.close();</script>";
 }
//header('Location: signin.php');
mysql_close($dbhandle);
}
?>
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
</script>
	</head>

	<body>
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
            </header>
            <section>
            <div id="register">
             <p><b>NEW USER</b></p>
             <form action="user.php" method="post">
             	Name</br><input type="text" name="name" /></br>
            	Account type</br> 
            	<select name="des">
                      <option value="teacher">Teacher</option>
                      <option value="student">Student</option>
                 </select></br>
             	College</br><input type="text" name="coll" /></br>
             	Username</br><input type="text" name="usr" /></br>
             	Password</br><input type="password" name="pass" /></br>
             	<button id="logn" type="submit"><b>Sign up</b></button> 
             </form> 
			</div id="register">
			<div id="sigin">
			<p><b>MEMBER LOGIN</b></p>
			<form action="signin.php" method="post">
				Username</br><input type="text" name="usr" /></br>
             	Account type</br><select name="type">
                      <option value="teacher">Teacher</option>
                      <option value="student">Student</option>
                 </select></br>
             	Password</br><input type="password" name="pass" /></br>
             	<button id="logn" type="submit"><b>Log in</b></button>
            </form> 
			</div id="sigin">
            </section>
			<footer>
				<p>
					&copy; Copyright  by LocalNIC
				</p>
			</footer>
		</div>
	</body>
</html>
