<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen">
		<meta charset="utf-8">
		<script>
		    function playVid()
		    {
		     /*var width =  800;
             var height = 500;
             var left = parseInt((screen.availWidth/2) - (width/2));
             var top = parseInt((screen.availHeight/2) - (height/2))-50;
             var windowFeatures = "width=" + width + ",height=" + height + ",status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
             */
			 window.open("play.php","Upload Video"/*,windowFeatures*/); 
			}
			/*function do()
			{
				var $vid = $('video','#container');
                var $msg = $('#custom-message'); 
                $msg.css({
                  top:$vid.offset().top + (($vid.height()/2) - ($msg.height()/2)),
                  left:$vid.offset().left + (($vid.width()/2) - ($msg.width()/2))
                });​
			}*/
		</script>	
		<?php
		 session_start();
		 echo "Hello ".$_SESSION['login'];
		 if(isset($_POST['chuz']))
		 {
		 	echo '<script> playVid(); </script>';
			$arr= explode(",",$_POST['chuz']);
			$_SESSION['vid']=$arr[0];
			$_SESSION['lec']=$arr[1];
		 }
		?>	
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
					<a href="http://localhost/project1/student.php"> Go Back </a>
					</li>
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
            <div style="width:10%;float:right;" class='yellow-one'>
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
		<h4><b>CLICK ON LECTURE TO WATCH</b></h4>
		<table border=1 frame=void rules=rows style="width:95%;text-align:center; background:#FFFFFF; color: black; margin:2%;">
		<?php
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
			$u=$_POST["chup"];
            $result = mysql_query("SELECT * from entry where category = '$u' ;");
            while ($row = mysql_fetch_array($result)) 
            {
              echo '<tr>';
              echo '<td>Teacher : '.strtoupper($row{'name'})."</br>".'Video Name : '.strtoupper($row{'vname'})."</br></td>";
			  echo '<td><video id="cont2" poster="images/img.png" type="video/mp4" src="'.$row{'path'}.'" width="360" height="280"></video>'."</br>";
			  echo '<form action="playlist.php" method="post"><input type="hidden" name="chup" value="'.$u.'"> <button name="chuz" type="submit" id="logn" value="'.$row{'vid'}.','.$row{'user'}.'">Play Video</button></form>'."</p></td>";
          	  echo '</tr>';
			} 
			mysql_close($dbhandle);
	    ?>
	    </table>
    </article>
    <footer>
				<p>
					&copy; Copyright  by LocalNIC
				</p>
    </footer>
</body>
</html>