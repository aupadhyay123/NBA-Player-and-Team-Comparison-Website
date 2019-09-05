<?php 
		session_start();
		$host = "303.itpwebdev.com";
	 	$user = "aaupadhy_db_user";
	 	$pass = "Trojan@524";  
	 	$db = "aaupadhy_final_db";
 		$mysqli = new mysqli($host, $user, $pass, $db);
 		if($mysqli->connect_errno){
    		echo $mysqli->connect_error; 
    		exit();
 		}
 		if(!isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['password']) || empty($_POST['password']) || !isset($_POST['name']) || empty($_POST['name']) ){
 			}
 			else{
 				$sql = "SELECT id,name from users
 					WHERE  username = '" .$_POST["username"]. "';";
 				$check = $mysqli->query($sql);
				$resultsCheck = $check->fetch_assoc();
				$size =sizeof($resultsCheck); 
 				if($size == 0){
 					$sql1 = "INSERT INTO users(username, password, name)
 					VALUES(
					    '" . $_POST['username']. "'
					    ,'". $_POST['password'] .
					    "','". $_POST['name']."');";

 					$results = $mysqli->query($sql1);
 					if(!results){
	 					echo $mysqli->error; 
	        			exit(); 
 					}
	 				else{
	 					$sql2 = "SELECT id,name from users
	 					WHERE  username = '" .$_POST["username"]. "' AND password = '". $_POST['password'] . "'; ";
	 					 $user = $mysqli->query($sql2);
	 					 if(!$user){
	 						echo $mysqli->error; 
	        				exit(); 
	 					}

	 					 $userData = $user->fetch_assoc();
	 					 $_SESSION['name'] = $userData['name'];
						 $_SESSION['userID'] = $userData['id'];
						 $mysqli->close(); 
	 						header("location: profileCreation.php");
	 				}
 				}
 				else{
 					$error = "Username Already Taken.";
 				}

 				
 			}
		?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<link href="https://fonts.googleapis.com/css?family=Wallpoet" rel="stylesheet">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    	<link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">
    	<link href="register.css" rel="stylesheet">
		<link href="project.css" rel="stylesheet">
    	<link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">


		<title>SportsLive</title>
		<script>
			$(document).ready(function(){
			  $(".title").hover(function(){
			    $(this).animate({letterSpacing:"+=20"});
			    },function(){
			    $(this).animate({letterSpacing:"-=20"});
			  });
			});	 
		</script>

	</head>
	<body>
		<div class="wholePage">
			<div id="particles-js">
				<div class="titleRow">
					<h1 class="title">SportsLive</h1>
				</div>
				<div class="register">
					<form id="registerForm" action="register.php" method="POST">
						<div class="inputRow">
							<label for="username">Enter a Username</label>
							<input id="username" type="text" name="username">
						</div>
						<div class="inputRow">
							<label for="passqord">Enter a Password</label>
							<input id="password" type="password" name="password">
						</div>
						<div class="inputRow">
							<label for="name">Enter your name</label>
							<input id="name" type="text" name="name">
						</div>
						<div class="submitButton">
							<input  style="background-color:#07E2FC;font-family: 'Wallpoet', cursive;
"  type="submit" name="submit">
						</div>
							<?php if(isset($error) && !empty($error)) : ?>
								<div class="errorMessage" style="display:block"><?php echo $error ?></div>
			 				<?php else :?>
			 					<div class="errorMessage"></div>
			            	<?php endif; ?>			   
						<div class="links">
							<a style="color:#07E2FC;" href="login_page.php">Login</a><br>
						</div>
					</form>
				</div>

			</div>
		</div>
		<script src="particles.js"></script>
		<script src="app.js"></script>
		<script>
			document.querySelector("#registerForm").onsubmit = function() {
            	var valid = true;
            // check username not empty
    		if ( document.querySelector("#username").value.trim().length < 1 ) {
                valid = false;
                document.querySelector(".errorMessage").innerHTML = "Enter information into all fields."
                document.querySelector(".errorMessage").style.display = "block";

    		}
    		// Check that password not empty
    		if ( document.querySelector("#password").value.trim().length < 1 ) {
    			valid = false;
    			document.querySelector(".errorMessage").style. display = "block";
                document.querySelector(".errorMessage").innerHTML = "Enter information into all fields."
    		}
    		    		// Check that password not empty
    		if ( document.querySelector("#name").value.trim().length < 1 ) {
    			valid = false;
    			document.querySelector(".errorMessage").style. display = "block";
                document.querySelector(".errorMessage").innerHTML = "Enter information into all fields."
    		}
    		return valid;
        }
    	</script>

	</body>
</html>