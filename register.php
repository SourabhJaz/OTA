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
if(isset($_POST["name"])&&$_POST["usr"]&&$_POST["pass"]&&$_POST["coll"]&&$_POST["des"])
{
 $n=$_POST["name"];
 $u=$_POST["usr"];
 $p=$_POST["pass"];
 $c=$_POST["coll"];
 $d=$_POST["des"];
 
 $n=strtolower($n);
 $u=strtolower($u);
 $p=strtolower($p);
 $c=strtolower($c);
 
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
  echo "Account created successfully \n";
  echo "Thank you for choosing ABC Zone.";
  //echo "<script>window.open('user.html');window.close();</script>";
 }
//header('Location: signin.php');
}
else 
{
 echo "Fields left empty!!";	
}
mysql_close($dbhandle);
?>