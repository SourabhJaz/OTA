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
		 if(isset($_POST['q1'])&&isset($_POST['q2'])&&isset($_POST['q3'])&&isset($_POST['q4']))
		 {
          $u=$_SESSION['login'];
		  $v=$_POST['butt'];
		  $q1=$_POST['q1'];
		   $o1=$_POST['q1o1']; $o2=$_POST['q1o2']; $o3=$_POST['q1o3'];
		  $c=$_POST['q1c1'];
		  $o=$o1.','.$o2.','.$o3;
		  $result="insert into question (user,vid,qstn,options,correct) values ('$u','$v','$q1','$o','$c');";
          if (!mysql_query($result,$dbhandle))
          {
               die('Error: ' . mysql_error());
          }  
		  $q2=$_POST['q2'];
		   $o1=$_POST['q2o1']; $o2=$_POST['q2o2']; $o3=$_POST['q2o3'];
		  $c=$_POST['q2c1'];
		  $o=$o1.','.$o2.','.$o3;
		  $result="insert into question (user,vid,qstn,options,correct) values ('$u','$v','$q2','$o','$c');";
          if (!mysql_query($result,$dbhandle))
          {
               die('Error: ' . mysql_error());
          }  
		  $q3=$_POST['q3'];
		   $o1=$_POST['q3o1']; $o2=$_POST['q3o2']; $o3=$_POST['q3o3'];
		  $c=$_POST['q3c1'];
		  $o=$o1.','.$o2.','.$o3;
		  $result="insert into question (user,vid,qstn,options,correct) values ('$u','$v','$q3','$o','$c');";
          if (!mysql_query($result,$dbhandle))
          {
               die('Error: ' . mysql_error());
          }  
		  $q4=$_POST['q4'];
		   $o1=$_POST['q4o1']; $o2=$_POST['q4o2']; $o3=$_POST['q4o3'];
		  $c=$_POST['q4c1'];
		  $o=$o1.','.$o2.','.$o3;
		  $result="insert into question (user,vid,qstn,options,correct) values ('$u','$v','$q4','$o','$c');";
          if (!mysql_query($result,$dbhandle))
          {
               die('Error: ' . mysql_error());
          }  
          else 
          {
            echo '<script> alert("MCQs Uploaded"); window.close();</script>';
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
            <form id="frm" action="temp.php" method="post" enctype="multipart/form-data">
            Q1.<textarea rows="1" cols="50" name="q1" form="frm" placeholder="Enter the question here.."></textarea></br>
             <input type="text" name="q1o1" placeholder="Enter the options here.." /><input type="radio" name="q1c1" value="c1"><input type="text" name="q1o2" /><input type="radio" name="q1c1" value="c2" checked><input type="text" name="q1o3" /><input type="radio" name="q1c1" value="c3"></br>
            </br>Q2.<textarea rows="1" cols="50" name="q2" form="frm"></textarea></br>
             <input type="text" name="q2o1" /><input type="radio" name="q2c1" value="c1"><input type="text" name="q2o2" /><input type="radio" name="q2c1" value="c2" checked><input type="text" name="q2o3" /><input type="radio" name="q2c1" value="c3"></br>
            </br>Q3.<textarea rows="1" cols="50" name="q3" form="frm"></textarea></br>
             <input type="text" name="q3o1" /><input type="radio" name="q3c1" value="c1"><input type="text" name="q3o2" /><input type="radio" name="q3c1" value="c2" checked><input type="text" name="q3o3" /><input type="radio" name="q3c1" value="c3"></br>
            </br>Q4.<textarea rows="1" cols="50" name="q4" form="frm"></textarea></br>
             <input type="text" name="q4o1" /><input type="radio" name="q4c1" value="c1"><input type="text" name="q4o2" /><input type="radio" name="q4c1" value="c2" checked><input type="text" name="q4o3" /><input type="radio" name="q4c1" value="c3"></br>            
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
            $result = mysql_query("SELECT vid,category,vname from entry where user='$u' and vid not in (select vid from question) ;");
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
