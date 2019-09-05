<?php
   session_start();
   echo $_SESSION['name'] . " ". $_SESSION['userID'];

   session_unset();
   //session_unset('userID');
   if(!isset($_SESSION['name']) || !isset($_SESSION['userID'])){
   		header("location: login_page.php");
   }
?>