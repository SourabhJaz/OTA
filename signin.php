<?php
$username = "root";
$password = "1234";
$hostname = "localhost"; 
//127.0.0.1
//connection to the database
$dbhandle = mysql_connect($hostname, $username,$password)
  or die("Unable to connect to MySQL");
$selected = mysql_select_db("formdata",$dbhandle)
  or die("Error linking to data");
$u=$_POST["usr"];
$p=$_POST["pass"];
$a=$_POST["type"];
$ses=false;
//$p=md5($p);
if(strcmp($a,'teacher')!=0 && strcmp($a,'student')!=0)
{
	echo "Incorrect Account Type!!";
    return;
}
$result=mysql_query("select pswd from $a where user='$u' and pswd='$p' ;");
while ($row = mysql_fetch_array($result)) 
{
   $ses=true;
}
if($ses==true)
{
 	session_start();
	$_SESSION['state']=true;
    $_SESSION['login']= $u; 
    $_SESSION['type']= $a;
 	if(strcmp($a,'teacher')==0)
    {
	   header('Location: teacher.php');
	}
	else 
	{
	    header('Location: student.php');
	}
}
else 
{
 echo '<script> alert("Incorrect username,password or account type!!") ;</script>';
 echo "<script>setTimeout(\"location.href ='user.php';\");</script>";
}
mysql_close($dbhandle);
?>