<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen">
		<meta charset="utf-8">
		<?php
	        session_start();
		    echo "Hello ".$_SESSION['login'];
		?>		
   </head>
<body>
	<header>
			<div class="header" style="width:90%">
            <div style="width:13%;height:60px; float:left; margin-left: 5%;" class='black-one'>
            <div style='float:left;'><img src="images/main.jpg" width="100%" height="60px"/></div>
            <div style="clear:both"></div>
            </div>
            <div style="width:50%;float:left; text-align:right" class='red-one'>
           <div id="ls" style="margin:10px auto;">
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
            <div style="width:15%;float:right;" class='yellow-one'>
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
	<section id="st">
	<h3>Choose a category (<font color='red' size="3">* IMPLIES LOW ATTENDANCE</font>): </h3>
	<div id="left">
	<?php
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
            $result = mysql_query("SELECT distinct category from entry");
            while ($row = mysql_fetch_array($result)) 
            {
                echo '<form action="playlist.php" method="post"><input type="submit" name="chup" id="fil" value="'.$row{'category'}.'"></form>';
			} 
			
	?>
	</div id="left">
	<div id="right">
     <?php
     $result = mysql_query("SELECT distinct category from entry");
     $use=$_SESSION['login'];
      while ($row = mysql_fetch_array($result)) 
      {
       $temp=$row{'category'};
	   $data=mysql_query("SELECT distinct name from entry where category = '$temp';");
	   echo strtoupper($temp)."</br>";
	   echo 'Includes Lecture by Teacher(s) :';
	   while ($nam = mysql_fetch_array($data)) 
       {
	   	echo ' '.$nam{'name'}.',';
	   }
	   $d=mysql_query("SELECT count(*) as c from entry where category = '$temp';");
	   $data=mysql_fetch_assoc($d);
	   $total=intval($data['c']);
	   echo "</br>".'Attendance : ';
	   $comm=mysql_query("SELECT count(*) as a from attendance where user = '$use' and lecid = '$temp';");
	   $data=mysql_fetch_array($comm);
	   $p=intval($data['a']);
	   if($p>0 && $p/$total < 0.4)
	   {
	   	echo "<font color='red'>".'*'.$p." / ".$total."</font>";
	   }
	   else if($p==0)
	   {
	   	echo " Not enrolled";
	   }
	   else if($p/$total>=1)
	   {
	   	echo " 100%";
	   }
	   else 
	   {
		 echo $p." / ".$total;   
	   }
	   echo "</br>"."</br>";
      } 
      mysql_close($dbhandle);
     ?>
	</div id="right">
	</section>
	        <footer>
				<p>
					&copy; Copyright  by LocalNIC
				</p>
			</footer>
</body>
</html>