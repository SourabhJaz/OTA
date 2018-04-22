<?php
	
		 session_start(); 
		 unset($_SESSION['state']);
		 $_SESSION['state'] = false;
		 session_destroy();

         header("Location:main.php");
         exit();
?>