<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen">
		<meta charset="utf-8">
		<?php
	        session_start();
		    echo "Hello ".$_SESSION['login'];
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
            <div style="width:13%;height:60px; float:left; margin-left: 5%;" class='black-one'>
            <div style='float:left;'><img src="images/main.jpg" width="100%" height="60px"/></div>
            <div style="clear:both"></div>
            </div>
            <div style="width:50%;float:left; text-align:right" class='red-one'>
           <div id="ls" style="auto;">
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
	<article>
	<section id="st">
	<h3>CHOOSE A CATEGORY : </h3>
	<table style="width:85%; margin:8%; margin-top:-5px; color:#008000; text-align:justify; padding:1%" border="10">
	<tr style="text-align:center">
	<td>CLICK HERE TO WATCH</td><td>INFORMATION</td>
	</tr>
	<?php
	        //(<font color='red' size="3">* IMPLIES LOW ATTENDANCE</font>)
	        $use=$_SESSION['login'];
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
                echo "<tr>";
                echo '<td style="text-align:center">'.'<form action="playlist.php" method="post"><input type="submit" name="chup" id="fil" value="'.$row{'category'}.'"></form>'."</td>";
			    echo "<td>";
			    $temp=$row{'category'};
	            $data=mysql_query("SELECT distinct name from entry where category = '$temp';");
	            echo strtoupper($temp)."</br>";
	            echo 'Includes Lectures by Teacher(s) :';
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
	   	         echo "<font color='red'>".$p." / ".$total."</font>";
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
		        echo "</td>";
			    echo "</tr>";
			} 
	?>
	</table>
	</section id="st">
	</article>
	        <footer>
				<p>
					&copy; Copyright  by LocalNIC
				</p>
			</footer>
</body>
</html>