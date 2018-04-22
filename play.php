<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css" media="screen">
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Watch Lecture</title>
		<meta name="description" content="">
		<meta name="author" content="LocalNIC">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<script>
	function upload()
		{
		var loading = document.getElementById ("nhide");
		loading.style.visibility = "visible";
		loading.style.display = "block";
		loading = document.getElementById ("answ");
		loading.style.visibility = "visible";
		loading.style.display = "none";
		}
</script>
<?php
session_start();
$_SESSION['ck']=0;
$_SESSION['mcq']=0;
           
           $src=$_SESSION['vid'];
	       $use=$_SESSION['login'];
	       $username = "root";
           $password = "1234";
           $hostname = "localhost"; 
           $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
           $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
		   $comm=mysql_query("select count(*) as same from attendance where vid='$src' and user='$use';");
		   $data=mysql_fetch_array($comm);
           $_SESSION['mcq']=intval($data{'same'});
		   
if(isset($_POST['q1'])&&isset($_POST['q2'])&&isset($_POST['q3'])&&isset($_POST['q4']))
{
	$correct=0;
	$s1=$_POST['q1'];
	$s2=$_POST['q2'];
	$s3=$_POST['q3'];
	$s4=$_POST['q4'];
	$c=explode(',',$_SESSION['right']);
	$c1=$c[0];
	$c2=$c[1];
	$c3=$c[2];
	$c4=$c[3];
	 if($s1==$c1)
	     $correct=$correct+1;
     if($s2==$c2)
	     $correct=$correct+1;
     if($s3==$c3)
	     $correct=$correct+1;	    
	  if($s4==$c4)
	     $correct=$correct+1; 
	echo 'Your Score : '.$correct.'/4';
	if($correct>=2)
	{
	       $src=$_SESSION['vid'];
	       $use=$_SESSION['login'];
	       $_SESSION['ck']=1;
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
			$comm=mysql_query("select count(*) as same from attendance where vid='$src' and user='$use';");
			$data=mysql_fetch_array($comm);
			$_SESSION['flag']=intval($data{'same'});
			$c=$_SESSION['flag'];
			if($c==0)
			{
			 $comm=mysql_query("select * from entry where vid='$src';");
	         $data=mysql_fetch_array($comm);
			 $c=$data{'category'};
		    	$comm="insert into attendance(user,lecid,vid) values('$use','$c','$src');";
			 if (!mysql_query($comm,$dbhandle))
             {
              die('Error: ' . mysql_error());
             }
			 else 
			 {
			  echo '<script> alert("Yay!! You got attendance for this lecture"); </script>'	; 
			 }
			}
	}
    else 
	{
			  echo '<script> alert("You need to answer atleast 2 MCQs correctly."); </script>'	; 
	}		
}
if(isset($_POST['asval']))
{
	$naam=$_POST['asval'];
	$path="http://localhost/project1/assignment/".$naam.".txt";
	header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=download.txt");
    readfile('$path');
}
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
             echo '<script> alert("Sorry, file already exists.") ;</script>';
            $uploadOk = 0;
          }
          if ($uploadOk == 0) 
          {
            echo '<script> alert("Sorry, file not uploaded.") ;</script>';
	        return;
          }
          else 
          {
           $result="insert into solution (user,aname,category,topic,mentor) values ('$u','$a','$cat','$topic','$set');";
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
if(isset($_POST['txt'])&&isset($_POST['talk']))
{
	        $src=$_SESSION['vid'];
	        $use=$_SESSION['login'];
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
			$txt=$_POST['txt'];
			$comm="insert into comm(user,vid,comment) values('$use','$src','$txt');";
			if (!mysql_query($comm,$dbhandle))
             {
              die('Error: ' . mysql_error());
             }
			 mysql_close($dbhandle);
}
if(isset($_POST['Q1'])&&isset($_POST['ask']))
{
	        $src=$_SESSION['vid'];
	        $use=$_SESSION['login'];
			$lec=$_SESSION['lec'];
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
			$txt=$_POST['Q1'];
			$comm="insert into problem(usr,vid,problem,lec) values('$use','$src','$txt','$lec');";
			if (!mysql_query($comm,$dbhandle))
             {
              die('Error: ' . mysql_error());
             }
			else
		    {
		    	echo '<script> alert("Your doubt has been succesfully submit to the teacher.")</script>';
		    }
			 mysql_close($dbhandle);
}
if(isset($_POST['del']))
		 {
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
			$c=$_POST['del'];
			$comm="delete from comm where cid='$c';";
			if (!mysql_query($comm,$dbhandle))
            {
              die('Error: ' . mysql_error());
            }
			else
		    {
		    			 	echo '<script> alert("Comment deleted!"); </script>';
		    }
			 mysql_close($dbhandle);
		 }
?>
    </head>
    <section id="finale">
    	NOTE : 
    	<script language="JavaScript1.2">

var message=" ANSWER ATLEAST TWO MCQs CORRECTLY TO GET ATTENDANCE."
var neonbasecolor="grey"
var neontextcolor="green"
var flashspeed=100  
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
setTimeout("beginneon()",2000)
return
}
}

function beginneon(){
if (document.all||document.getElementById)
flashing=setInterval("neon()",flashspeed)
}
beginneon()
</script>
</section>
	<body>
	<article id="screen">
	 <?php
            $src=$_SESSION['vid'];
	        $use=$_SESSION['login'];
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
			echo '<div id="masti">';
			$result = mysql_query("SELECT * from entry where vid = '$src' ;");
			if($row = mysql_fetch_array($result))
            {
		    	echo '<video id="lecture" src="'.$row{'path'}.'" height="100%" width="100%" controls></video>';
			}
			echo '</div id="masti">';
			
			echo '<div id="teach">';
			 echo '<h3>ASSIGNMENTS : </h3>';
			 echo "MCQs :"."</br><div id='mcq'>";
			 $result = mysql_query("SELECT * from question where vid = '$src' ;");
			 if(mysql_num_rows($result)!=0&&$_SESSION['mcq']==0)
			 {
			 echo '<form action="play.php" method="post">';
	         $inc=1;
			 $cor='';
			 while($row = mysql_fetch_array($result))
			 {
			 	echo "</br>".$inc.'. '.$row{'qstn'}."</br>";
				$o=$row{'options'};
				$arr=explode(',', $o);
				echo "".'<input type="radio" name="q'.$inc.'" value="c1">'.$arr[0]." ";
			    echo '<input type="radio" name="q'.$inc.'" value="c2">'.$arr[1]." ";
				echo '<input type="radio" name="q'.$inc.'" value="c3">'.$arr[2]."</br>";
				$inc=$inc+1;
				if($cor=='')
				 $cor=$row{'correct'};
				else
				 $cor=$cor.','.$row{'correct'};
			 }
			 $_SESSION['right']=$cor;
			 echo '</br><input type="submit" value="Check Result" />';
			 echo "</form></br>";
			 }
elseif (mysql_num_rows($result)==0) 
{
			 	echo '<div id="impact"><strong>NO MCQs FOR THIS LECTURE.</strong></div></br>';	
				$_SESSION['mcq']=1;
}
             else
			 {
			 	echo '<div id="impact"><strong>YOU HAVE SUCCESFULLY COMPLETED THE MCQs.</strong></div></br>';
			 }
			echo "</div id='mcq'>";
			if($_SESSION['ck']==0&&$_SESSION['mcq']==0)
			{
				echo '<h4><img src="images/lock.jpg" height="4%" width="4%"/> Problems can be accessed only when you get through the MCQs.</h4>';
			}
			else 
			{
			$result = mysql_query("SELECT * from link where vid = '$src' ;");
			echo 'PROBLEMS:&nbsp; ';
			if(mysql_num_rows($result)!=0)
			{
			 while($row = mysql_fetch_array($result))
			 {
			 	echo '<form action="play.php" method="post"><input id="qstn" type="submit" name="asval" value="'.$row{'aname'}.'"></form>';
			     echo '<button id="answ" onClick="upload();">Submit Solution</button>';		    
			     echo '<div id="nhide">';
			     echo '<form action="sub.php" method="post" enctype="multipart/form-data">';
                 echo 'Solution name <input type="text" name="fname" />'."</br>";
                 echo 'Choose File<input type="file" name="ass" />'."</br>".'<input type="submit" value="Upload" /></form>';
			     echo '</div id="nhide">';
			 }
			}
            else
			 {
			 	echo '<div id="impact"><strong>NO PROBLEMS FOR THIS LECTURE.</strong></div>';
			 }
			}
			echo '</div id="teach">';
			echo '<div id="combox">';
			  	 	echo "</br>".'<form action="play.php" id="usrform" method="post"><textarea rows="2" cols="30" placeholder="Add your comment here..." name="txt" form="usrform"></textarea>'."\t".'<input type="submit" name="talk" value="POST"></form>';
            $result = mysql_query("SELECT * from comm where vid = '$src' ;");
		
			echo '&nbsp;&nbsp;&nbsp;<b>COMMENTS</b> : </div>';
            echo '<div id="combox">';
			  	 	echo "</br>".'<form action="play.php" id="usrform1" method="post"><textarea rows="2" cols="30" placeholder="Ask your doubts here..." name="Q1" form="usrform1"></textarea>'."\t".'<input type="submit" name="ask" value="ASK"></form>';
            $result = mysql_query("SELECT * from comm where vid = '$src' ;");
		
			echo '&nbsp;&nbsp;&nbsp;<b>DOUBTS</b> : </div><div id="acty"><table border=1 frame=void rules=rows>';
			while($row = mysql_fetch_array($result))
            {
            	 echo '<tr>';
		    	 echo "<td><font color='blue'>".$row{'user'}."</font></td><td>".$row{'comment'};
		    	 if($row{'user'}==$use)
  				  echo '<form action="play.php" method="post"> <button name="del" type="submit" value="'.$row{'cid'}.'">Delete</button></form>';
		    	 echo "</td>";
			     echo '</tr>';
			}           
			echo '</table>'; 
            echo '</div>';
			
			echo '<div id="acty">';
			$result = mysql_query("SELECT * from problem where vid = '$src' ;");
			while($row = mysql_fetch_array($result))
            {
		    	 echo "<font color='blue'>".$row{'usr'}."</font>  ".$row{'problem'};
		    	 if($row{'answer'}!=NULL)
  				  echo "</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='green'>".$row{'lec'}."</font> : ".$row{'answer'};
			     echo '</br></br>';
			}           
            echo '</div>';
     ?>	
	</article>
	<footer>
				<p>
					&copy; Copyright  by LocalNIC
				</p>
	</footer>
	</body>
</html>