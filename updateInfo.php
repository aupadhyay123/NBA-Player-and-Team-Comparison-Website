<?php 
		session_start();
		if(!isset($_SESSION['userID']) || empty($_SESSION['userID']) || !isset($_SESSION['name']) || empty($_SESSION['name'])){
			$error = "Must be logged in to change account info"; 
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
	 		$getUserInfo = "SELECT * FROM users where id=" . $_SESSION['userID'] . " AND name='" . $_SESSION['name']. "'; ";
	 		//echo $getUserInfo;
	 		//echo $getUserInfo;
	 		$userInfo = $mysqli->query($getUserInfo); 
	 		if(!$userInfo){
	 			echo $mysqli->error; 
	        	exit(); 
	 		}
			$userData = $userInfo->fetch_assoc();


			$username = $userData['username']; 
			$password = $userData['password']; 
			$name = $userData['name']; 

			if(isset($_POST['name']) && !empty($_POST['name'])){
				$name = $_POST['name']; 
			}
			if(isset($_POST['username']) && !empty($_POST['username'])){
				$username = $_POST['username']; 
			}
			if(isset($_POST['password']) && !empty($_POST['password'])){
				$password = $_POST['password']; 
			}

			$sql = "SELECT * from users
 					WHERE  username = '" .$username. "' AND id !=" . $_SESSION['userID'] .";";
 			//echo $sql; 
 			$checkUser = $mysqli->query($sql);
			$resultsArr = $checkUser->fetch_assoc();
			$size =sizeof($resultsArr); 
			if($size > 0){
				$error = "Username already taken."; 
			}
			else{
				
				$updateInfo = "UPDATE users SET username='". $username ."', password='".$password."', name='". $name . "' WHERE id=".$_SESSION['userID'].";";
				$updateUser = $mysqli->query($updateInfo); 
				if(!$updateUser){
					echo $mysqli->error;
					exit();
				}
	 			else{
		 			$_SESSION['name'] = $name;
					$mysqli->close(); 
		 		}
 			}
 				
			}
		
		?>
<!DOCTYPE html>
<html>
	<head>

		<style><?php include 'updateInfo.css'; ?></style>
		<style><?php include 'project.css'; ?></style>


		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<link href="https://fonts.googleapis.com/css?family=Wallpoet" rel="stylesheet">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    	<link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">
    	<link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    	<link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">



		<title>SportsLive</title>
		<script>
			$(document).ready(function(){
			  $(".title").hover(function(){
			    $(this).animate({letterSpacing:"+=20"});
			    },function(){
			    $(this).animate({letterSpacing:"-=20"});
			  });
			});	 
			function showInput(select){
				if(select.value == "username"){
					document.querySelector(".username").style.visibility = "visible";
				}
				if(select.value == "password"){
					document.querySelector(".password").style.visibility = "visible";
				}
				if(select.value == "name"){
					document.querySelector(".name").style.visibility = "visible";
				}
			}
			function signout(){
		 	window.location.href = "sign_out.php"; 
		 }
		function players(){
		 	window.location.href = "profileCreation.php"; 
		 }
		function teams(){
		 	window.location.href = "profileTeamCreation.php"; 
		 }
		function update(){
			console.log("here");
		 	window.location.href = "updateInfo.php"; 
		 }

		</script>


	</head>
	<body>
		<div class="wholePage">
			<div id="particles-js">
				<nav class="navbar navbar-light" style="background-color: #FF3A3A;">
				  <a class="navbar-brand" href="homePage.php" style="font-family:'Wallpoet', cursive;">SportsLive</a>
					<i class="fa fa-user-plus fa-info" data-toggle="tooltip" onclick="players();" title="Add Players!"></i>
					<i class="fas fa-users fa-info" data-toggle="tooltip" onclick="teams();" title="Add Teams!"></i>
					<i class="fas fa-user-edit fa-info" data-toggle="tooltip" onclick="update();" title="Update User Info"></i>
					<a class="navbar-brand" href="homePage.php" style="font-family:'Wallpoet', cursive;">Hello, <?php echo $_SESSION['name']; ?>!</a>
			 		<i class="fas fa-sign-out-alt" onclick="signout();"
			 			data-toggle="tooltip" title="Sign Out"></i>
				</nav>
				<div class="register">
					<h2>Update Profile Info</h2>
					<form id="updateForm" action="updateInfo.php" method="POST">
						<select class="form-control chooseUpdate" onchange="showInput(this);">
							<option value="username">Update Username</option>
							<option value="password">Update Password</option>
							<option value="name">Update Name</option>
						</select>

						<div class="inputRow username">
							<label for="username">Enter a Username</label>
							<input id="username" type="text" name="username">
						</div>
						<div class="inputRow password">
							<label for="password">Enter a Password</label>
							<input id="password" type="password" name="password">
						</div>
						<div class="inputRow name">
							<label for="name">Enter your name</label>
							<input id="name" type="text" name="name">
						</div>
						<div class="submitButton">
							<input  style="background-color:#07E2FC;font-family: 'Wallpoet', cursive;"type="submit" name="submit">
						</div>
							<?php if(isset($error) && !empty($error)) : ?>
						<div class="errorMessage" style="display:block"><?php echo $error ?>
						</div>
			 				<?php else :?>
			 			<div class="errorMessage"></div>
			            <?php endif; ?>			   
					</form>
				</div>
			</div>
		</div>


		<script src="particles.js"></script>
		<script src="app.js"></script>
		<script>
			document.querySelector("#updateForm").onsubmit = function() {
            	var valid = true;
            // check username not empty
    		if ( document.querySelector("#username").value.trim().length < 1 && document.querySelector("#password").value.trim().length < 1 && document.querySelector("#name").value.trim().length < 1) {
                valid = false;
                document.querySelector(".errorMessage").innerHTML = "No data entered."
                document.querySelector(".errorMessage").style.display = "block";
    		}
    		return valid;
        }
    	</script>

	</body>
</html>