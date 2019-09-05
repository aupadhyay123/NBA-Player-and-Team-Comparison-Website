<?php 
	session_start();

	if(!isset($_SESSION['name']) && empty($_SESSION['name']) && !isset($_SESSION['userID']) && 
		empty($_SESSION['userID']) ){

		header("location: login_page.php");
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">


		<style><?php include 'profileCreation.css'; ?></style>
		<meta charset="utf-8">

    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Wallpoet" rel="stylesheet">


		<title>SportsLive</title>
		<script type="text/javascript">
					   $(document).ready(function(){
		       $('[data-toggle="tooltip"]').tooltip();   
		   });
		 function signout(){
		 	window.location.href = "sign_out.php"; 
		 }
		 	function update(){
		 	window.location.href = "updateInfo.php"; 
		 }
		function players(){
		 	window.location.href = "profileCreation.php"; 
		 }
		function teams(){
		 	window.location.href = "profileTeamCreation.php"; 
		 }

		</script>

	</head>
	<body>
		<nav class="navbar navbar-light" style="background-color: #FF3A3A;">
			  <a class="navbar-brand" href="homePage.php" style="font-family:'Wallpoet', cursive;"
">SportsLive</a>
				<i class="fa fa-user-plus fa-info" data-toggle="tooltip" onclick="players();" title="Add Players!"></i>
				<i class="fas fa-users fa-info" data-toggle="tooltip" onclick="teams();"title="Add Teams!"></i>
				<i class="fas fa-user-edit fa-info" data-toggle="tooltip" onclick="update();"title="Update User Info"></i>
				<a class="navbar-brand" href="homePage.php" style="font-family:'Wallpoet', cursive;"
">Hello, <?php echo $_SESSION['name']; ?>! </a>


			 	<i class="fas fa-sign-out-alt" href="sign_out.php" onclick="signout();"
			 	data-toggle="tooltip" title="Sign Out"></i>
		</nav>

		<div class="container col-12 wholePage">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1>Select Your Favorite Players!</h1>
				</div>

			</div>

			<div class="row teamRow">
				<div class="col-sm-12 col-md-12 col-lg-6 selectTeam">
					<form id="team">
					<label for="teams">Select a Team</label>
					<select name="teams" id="teams">
						<option value="null">Select a Team</option>
						<option value="SA">San Antonio Spurs</option>
						<option value="GS">Golden State Warriors</option>
						<option value="HOU">Houston Rockets</option>
						<option value="LAL">Los Angeles Lakers</option>
						<option value="UTA">Utah Jazz</option>
						<option value="CHA">Charlotte Hornets</option>
						<option value="LAC">Los Angeles Clippers</option>
						<option value="MIL">Milwaukee Bucks</option>
						<option value="TOR">Toronto Raptors</option>
						<option value="BOS">Boston Celtics</option>
						<option value="PHI">Philadelphia 76ers</option>
						<option value="NY">New York Knicks</option>
						<option value="OKC">Oklahoma City Thunder</option>
						<option value="BKN">Brooklyn Nets</option>
						<option value="CLE">Cleveland Cavaliers</option>
						<option value="IND">Indiana Pacers</option>
						<option value="DET">Detroit Pistons</option>
						<option value="CHI">Chicago Bulls</option>
						<option value="MIA">Miami Heat</option>
						<option value="WAS">Washington Wizards</option>
						<option value="ORL">Orlando Magic</option>
						<option value="ATL">Atlanta Hawks</option>
						<option value="POR">Portland TrailBlazers</option>
						<option value="MIN">Minnesota Timberwolves</option>
						<option value="DEN">Denver Nuggets</option>
						<option value="SAC">Sacramento Kings</option>
						<option value="PHO">Phoenix Suns</option>
						<option value="DAL">Dallas Mavericks</option>
						<option value="MEM">Memphis Grizzlies</option>
					</select>
					<input type="submit" style="display:inline-block;" name="submit">
				</form>
				</div>
			</div>
			<div class="row justify-content-around buttonRow">
				<div class="col-lg-2 col-md-2 col-sm-1 redirectBtn">
					<button class="btn btn-danger redirect">Add Some Teams!</button>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-1">
					<button class="btn btn-success homeBtn">Take me Home.</button>
				</div>
			</div>
			<div class="d-flex flex-container flex-row wrap playerRow"></div> 
		</div>
		<script type="text/javascript">

			var count = 0; 
			var apiLink = "https://api.sportsdata.io/v3/nba/stats/json/Players/";
			var key = "8c3a8be09fc6448a94f34f91488de450"; 
			document.querySelector("#team").onsubmit = function(){
				if(document.querySelector("#teams").value == "null"){
					return false; 
				}
				var team = document.querySelector("#teams").value; 
				console.log(team); 
				var apiSend = apiLink + team + "?key=" + key; 
				ajax(apiSend);
				return false; 

			}
			function ajax(apiLink) {
				let xhr = new XMLHttpRequest();
				xhr.open("GET", apiLink);
				xhr.send();
				xhr.onreadystatechange = function() {
					if(this.readyState == this.DONE) {
						//recieved some kind of response
						if(xhr.status == 200) {
							let responseObj = JSON.parse(xhr.responseText);
							console.log(xhr.responseText);
							displayResults(responseObj);
						} else {
							// got a reponse, but it's an error
							console.log("Error!!");
							console.log(xhr.status);
						}
					}
			}
			return false;
		}
		function displayResults(response){
			let resultsShown = response.length;
			console.log(resultsShown);

			while(document.querySelector(".playerRow").hasChildNodes()) {
				document.querySelector(".playerRow").removeChild(document.querySelector(".playerRow").lastChild);
			}
			var row = document.querySelector(".playerRow"); 
		// let totalResults = response.total_results; 

		  	for(var i = 0; i < resultsShown; i++){
		  		let player = document.createElement("div");
		  		var name = response[i].YahooName; 
		  		var firstName = response[i].FirstName; 
		  		var lastName = response[i].LastName; 

		  		//console.log(name); 
		  		//main div to hold all of players data
		  		player.className ="p-2 col-lg-3 col-md-5 col-sm-10 player";
		  		let playerImg = document.createElement("div");

		  		player.appendChild(playerImg);
		  		let pImg = document.createElement("img");
		  		playerImg.appendChild(pImg);

		  		pImg.src = "Player Photos/" + firstName + " " + lastName + ".png";

		  		pImg.onerror = function(){
		  			pImg.src = "error.jpg";
		  		}


		  		var playerData = document.createElement("div"); 
		  		playerData.className = "playerData"; 
		  		player.appendChild(playerData); 

		  		let playerName = document.createElement("h2");
		  		playerName.innerHTML = name; 
		  		playerData.appendChild(playerName);

		  		let playerPosition = document.createElement("h3"); 
		  		playerPosition.innerHTML = response[i].Position; 
		  		playerData.appendChild(playerPosition); 

		  		let playerHeight = document.createElement("h4"); 
		  		playerHeight.innerHTML = response[i].Height + " inches"; 
		  		playerData.appendChild(playerHeight); 

		  		let playerWeight = document.createElement("h4"); 
		  		playerWeight.innerHTML = response[i].Weight + " lbs. " ; 
		  		playerData.appendChild(playerWeight);

		  		let playerExperience = document.createElement("h4"); 
		  		playerExperience.innerHTML = response[i].Experience + " years"; 
		  		playerData.appendChild(playerExperience); 

		  		let addBtn = document.createElement("button"); 
		  		addBtn.className = "btn btn-primary addButton"; 
		  		addBtn.value = response[i].PlayerID; 
		  		addBtn.setAttribute("onclick","ajaxAdd(this);");
		  		console.log(addBtn.value);
		  		addBtn.innerHTML = "Add"; 
		  		playerData.appendChild(addBtn); 
		  		player.appendChild(playerData); 
		  		row.appendChild(player); 
		  	}
		  	return false; 
		}
		function checkCount(){
			if(count >= 1){
				document.querySelector(".redirect").style.display = "inline-block"; 
				document.querySelector(".homeBtn").style.display = "inline-block"; 
			}
			else{
				document.querySelector(".redirect").style.display = "none";
				document.querySelector(".homeBtn").style.display = "inline-block"; 
			}
		}
		document.querySelector(".redirect").onclick = function(){
			window.location.href = "profileTeamCreation.php";
		}
		document.querySelector(".homeBtn").onclick = function(){
			window.location.href = "homePage.php";
		}
		function ajaxAdd(btn){
			if(btn.className == "btn btn-danger"){
				alert("Already Added");
				return false; 
			}
			checkCount();
			btn.className = "btn btn-danger"; 
			btn.innerHTML = "Added";  
			var sendLink = "addPlayer.php?playerID=" + btn.value; 
			//window.location.href = sendLink;
			//count++; 
			let xhr = new XMLHttpRequest();
			console.log(sendLink);
			xhr.open("GET", sendLink);
			xhr.send();
			xhr.onreadystatechange = function() {
				if(this.readyState == this.DONE) {
						//recieved some kind of response
					if(xhr.status == 200) {
						console.log("added");
						count++; 
						 
					} else {
							// got a reponse, but it's an error
						console.log("Error!!");
						console.log(xhr.status);
					}
				}
			}
			return false;
		}
		</script>
	</body>
</html>