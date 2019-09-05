<?php
session_start(); 
echo "hello bob";
echo $_GET["playerID"]; 
if(!isset($_GET['playerID']) || empty($_GET['playerID'])){
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

    if(!isset($_SESSION['userID']) || empty($_SESSION['userID']) || !isset($_GET['playerID']) || empty($_GET['playerID'])  ){
    	$error = "Invalid Player";
        ?><script>console.log("fuck you"); </script><?php
    }
    else{
        $sql = "DELETE FROM players 
                WHERE id=" . $_SESSION['userID'] . " AND playerID=" . $_GET['playerID']. ";";
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