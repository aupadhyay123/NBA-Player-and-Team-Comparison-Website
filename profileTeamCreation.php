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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">

		<style><?php include 'profileTeamCreation.css'; ?></style>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    	<link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

		<link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Wallpoet" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Teko" rel="stylesheet">


		<title>SportsLive</title>
		<script type="text/javascript">
					   $(document).ready(function(){
		       $('[data-toggle="tooltip"]').tooltip();   
		   });
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
		 	window.location.href = "updateInfo.php"; 
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
					<h1>Select Your Favorite Team!</h1>
				</div>
			</div>
			<div class="row justify-content-around redirectBtn">
				<div class="col-lg-2 col-md-2 col-sm-1 btnCol">
				<button class="btn btn-primary redirect">Add Players</button></div>
				<div class="col-lg-2 col-md-2 col-sm-1 btnCol">
				<button class="btn btn-success homeBtn">Nah,I'm good.</button></div>

			</div>
			<div class="d-flex flex-container teamRow"></div> 
		</div>
		<script type="text/javascript">
			var count = 0; 
			var key = "8c3a8be09fc6448a94f34f91488de450"; 
			var apiLink = "https://api.sportsdata.io/v3/nba/scores/json/Standings/2019?key=" + key;
			window.onload = function (){
				ajax(apiLink); 
			};
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

			while(document.querySelector(".teamRow").hasChildNodes()) {
				document.querySelector(".teamRow").removeChild(document.querySelector(".teamRow").lastChild);
			}
			var row = document.querySelector(".teamRow"); 
		// let totalResults = response.total_results; 

		  	for(var i = 0; i < resultsShown; i++){
		  		let team = document.createElement("div");
		  		var name = response[i].City + " " + response[i].Name; 


		  		//console.log(name); 
		  		//main div to hold all of players data
		  		team.className ="p-2 col-lg-3 col-md-5 col-sm-10 team";
		  		let teamImg = document.createElement("div");

		  		team.appendChild(teamImg);
		  		let tImg = document.createElement("img");
		  		teamImg.appendChild(tImg);

		  		tImg.src = "Team Photos/" + name + ".png";

		  		tImg.onerror = function(){
		  			tImg.src = "error.jpg";
		  		}


		  		var teamData = document.createElement("div"); 
		  		teamData.className = "teamData"; 
		  		team.appendChild(teamData); 

		  		let teamName = document.createElement("h2");
		  		teamName.innerHTML = name; 
		  		teamData.appendChild(teamName);

		  		let teamWins = document.createElement("h3"); 
		  		teamWins.innerHTML = response[i].Wins + " - " + response[i].Losses; 
		  		teamData.appendChild(teamWins); 

		  		let teamConference = document.createElement("h4"); 
		  		teamConference.innerHTML =  response[i].Conference; 
		  		if(response[i].Conference == "Eastern"){
		  			teamConference.style.color = "green"; 
		  		}else{
		  			teamConference.style.color = "red"; 
		  		}

		  		teamData.appendChild(teamConference); 

		  		let gamesBack = document.createElement("h4"); 
		  		gamesBack.innerHTML = response[i].GamesBack + " games behind. " ; 
		  		teamData.appendChild(gamesBack);


		  		let lastTen = document.createElement("h4"); 
		  		lastTen.innerHTML = "Last 10: " + response[i].LastTenWins + " - " + response[i].LastTenLosses;
		  		teamData.appendChild(lastTen); 

		  		let addBtn = document.createElement("button"); 
		  		addBtn.className = "btn btn-primary addButton"; 
		  		addBtn.value = response[i].TeamID; 
		  		addBtn.setAttribute("onclick","ajaxAdd(this);");
		  		console.log(addBtn.value);
		  		addBtn.innerHTML = "Add"; 
		  		teamData.appendChild(addBtn); 
		  		team.appendChild(teamData); 
		  		row.appendChild(team); 
		  	}
		  	return false; 
		}

		document.querySelector(".redirect").onclick = function(){
			window.location.href = "profileCreation.php";
		}
		document.querySelector(".homeBtn").onclick = function(){
			window.location.href = "homePage.php";
		}
		function checkCount(){
			if(count >= 1){
				document.querySelector(".redirect").style.display = "inline-block"; 
				document.querySelector(".homeBtn").style.display = "inline-block"; 
			}
			else{
				document.querySelector(".redirect").style.display = "none"; 
			}
		}
		function ajaxAdd(btn){
			if(btn.className == "btn btn-danger"){
				alert("Already Added");
				return false; 
			}
			checkCount();
			btn.className = "btn btn-danger"; 
			btn.innerHTML = "Added";  
			console.log(btn.value);
			var sendLink = "addTeam.php?teamID=" + btn.value; 
			//window.location.href = sendLink;
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