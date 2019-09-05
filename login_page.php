<?php 
			session_start();
			//echo $_SESSION['name'];
			$host = "303.itpwebdev.com";
	 		$user = "aaupadhy_db_user";
	 		$pass = "Trojan@524";  
	 		$db = "aaupadhy_final_db";

 			$mysqli = new mysqli($host, $user, $pass, $db);
 			if($mysqli->connect_errno){
    			echo $mysqli->connect_error; 
    			exit();
 			}
 			else{
 				echo $_POST['username'] . " " . $_POST['password'];
 				$sql = "SELECT id,name from users
 					WHERE  username = '" .$_POST["username"]. "' AND password = '". $_POST['password'] . "'; ";
 				$results = $mysqli->query($sql);
				$user = $results->fetch_assoc();
				$size =sizeof($user); 
				echo $user['name'];
				if($size == 0){
				 	$error = "Invalid username or password"; 
				}
				else{
					//echo "here";
					$_SESSION['name'] = $user['name'];
					$_SESSION['userID'] = $user['id'];
					//echo "Session: " . $_SESSION['name'] . " " . $_SESSION['userID']; 
         			header("location: homePage.php");
				}
 			}
		?>
<!DOCTYPE html>
<html>
	<head>
		<style><?php include 'login_page.css'; ?></style>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<link href="https://fonts.googleapis.com/css?family=Wallpoet" rel="stylesheet">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    	<link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">
    	<link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
    	<link href="project.css" rel="stylesheet">

		<title>SportsLive</title>

		<script>
			console.log("title");
			$(document).ready(function(){
			  $("h1").hover(function(){
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
				<div class="login">
					<form id="loginForm" action="login_page.php" method="POST">
						<div class="inputRow">
							<label for="username">Username</label>
							<input id="username" type="text" name="username">
						</div>
						<div class="inputRow">
							<label for="passord">Password</label>
							<input id="password" type="password" name="password">
						</div>
						<div class="submitButton">
							<input  style="background-color:#07E2FC;" type="submit" name="submit">
						</div>
							<?php if(isset($error) && !empty($error)) : ?>
								<div class="errorMessage" style="display:block"><?php echo $error ?></div>
			 				<?php else :?>
			 					<div class="errorMessage"></div>
			            	<?php endif; ?>

						<div class="links">
							<a style="color:#07E2FC;" href="register.php">Register</a><br>
						</div>
					</form>
				</div>

			</div>
		</div>
		<script src="particles.js"></script>
		<script src="app.js"></script>
		<script>
			document.querySelector("#loginForm").onsubmit = function() {
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
    		return valid;
        }
		</script>
	</body>
</html>