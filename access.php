<?php
$username = "root";
$password = "1234";
$hostname = "localhost"; 
//127.0.0.1
//connection to the database
$dbhandle = mysql_connect($hostname, $username,$password)
  or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";
$selected = mysql_select_db("formdata",$dbhandle)
  or die("Could not select examples");
$result = mysql_query("SELECT * from student");
//fetch tha data from the database
while ($row = mysql_fetch_array($result)) 
{
   echo "ID:".$row{'id'}." User:".$row{'user'}."<br>";
}
mysql_close($dbhandle);
?>