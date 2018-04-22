<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen">
		<meta charset="utf-8">				
		<title>Doubts</title>
		<meta name="description" content="">
		<meta name="author" content="LocalNIC">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<script>
	function upload()
		{
		var loading = document.getElementById ("hide");
		loading.style.visibility = "visible";
		loading.style.display = "block";
		loading = document.getElementById ("answ");
		loading.style.visibility = "visible";
		loading.style.display = "none";
		}
</script>
		<?php
	     session_start(); 
		 if(isset($_POST['txt'])&&isset($_POST['talk']))
         {
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
            $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
			$tx=$_POST['txt'];
			$pid=$_POST['talk'];
			$comm="update problem set answer = '$tx' where prid = '$pid'; ";
			if (!mysql_query($comm,$dbhandle))
             {
              die('Error: ' . mysql_error());
             }
            else
              echo '<script type="text/javascript"> alert("Reply submitted"); </script>';
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
            <article id="dbt">
            <h2>QUESTIONS</h2>
			<?php
	        $username = "root";
            $password = "1234";
            $hostname = "localhost"; 
			$u=$_SESSION['login'];
	        $dbhandle = mysql_connect($hostname, $username,$password)
               or die("Unable to connect to MySQL");
            $selected = mysql_select_db("videodata",$dbhandle)
               or die("Error linking to data");
            $result = mysql_query("SELECT * from problem inner join entry where problem.vid=entry.vid and problem.answer is NULL and lec='$u' ;");
			$count=1;
			echo '<table>';
            while ($row = mysql_fetch_array($result)) 
            {
               echo '<tr>';
               echo '<td>'.$count.". ".strtoupper($row{'category'}).'->'.strtoupper($row{'vname'})."</td><td>".$row{'usr'}.' : '.$row{'problem'}."</br>";
			   echo '<form action="ans.php" method="post" id="usform'.$count.'" enctype="multipart/form-data">';
                 echo '<textarea rows="1" cols="35" name="txt" form="usform'.$count.'"></textarea>'."\t".'<button type="submit" name="talk" value="'.$row{'prid'}.'">REPLY</button>';
               echo '</form></td>';
			   $count++;
			   echo '</tr>';
			}
			echo '</table>'; 
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
