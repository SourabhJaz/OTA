<?php
$username = "root";
$password = "1234";
$hostname = "localhost"; 
//127.0.0.1
//connection to the database
$dbhandle = mysql_connect($hostname, $username,$password)
  or die("Unable to connect to MySQL");
$selected = mysql_select_db("videodata",$dbhandle)
  or die("Error linking to data");

$u=$_SESSION['login'];
$c=$_POST['cat'];
$n=$_POST['title'];
$tar="videos/".$c.'/';
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
	$result="insert into entry (category,path,user,vname) values ('$c','$file','$u','$n');";
	
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
?>