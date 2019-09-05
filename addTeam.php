<?php
session_start(); 
echo $_GET["teamID"]; 
if(!isset($_GET['teamID']) || empty($_GET['teamID'])){
	$error = "Invalid Add";
    echo $error . ' in this bitch' ;
}
else{
    $host = "303.itpwebdev.com";
    $user = "aaupadhy_db_user";
    $pass = "Trojan@524";  
    $db = "aaupadhy_final_db";

     $mysqli = new mysqli($host, $user, $pass, $db);
     if($mysqli->connect_errno){
        echo $mysqli->connect_error; 
        exit();
     }
     $mysqli->set_charset('utf8');

    if(!isset($_SESSION['userID']) || empty($_SESSION['userID']) || !isset($_GET['teamID']) || empty($_GET['teamID'])  ){
    	$error = "Invalid Team";
        ?><script>console.log("fuck you"); </script><?php
    }
    else{
        $sql = "INSERT INTO teams(id,teamID) 
        VALUES(" . $_SESSION["userID"]. ",". $_GET["teamID"].");";
        $results = $mysqli->query($sql);
        echo $sql; 
           if(!$results){
               echo $mysqli->error; 
               exit(); 
           }
        $mysqli->close(); 
        //header("location: profileCreation.php");
    }

}
?>