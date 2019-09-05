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
 			if(!isset($_SESSION['name']) || empty($_SESSION['name']) || !isset($_SESSION['userID']) || empty($_SESSION['userID'])){
 				//$login = false; 
 				//echo "im here"; 
 				//header("location: login_page.php"); 
 			}
 			else{
 				$sql = "SELECT users.id,playerID from users
 						inner join players on users.id = players.id
 						WHERE  users.id = " . $_SESSION['userID'] . ";";
 				//echo $sql; 
 				$results = $mysqli->query($sql);
 				if(!$results){
 					echo "Error finding players"; 
 					exit();
 				}
 				$sql1 = "SELECT users.id,teamID from users
 						inner join teams on users.id = teams.id
 						WHERE  users.id = " . $_SESSION['userID'] . ";";
				//$players = $results->fetch_assoc();
				//echo sizeof($players);

                $teams = $mysqli->query($sql1);      
                 if(!$teams){
 					echo "Error finding players"; 
 					exit();
 				}
				if($size == 0){
				 	$error = "Haven't added any players"; 
				}
 			}
		?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Meta Tags -->
		<link href="https://fonts.googleapis.com/css?family=Wallpoet" rel="stylesheet">

		<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">

		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<!--  -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<style><?php include 'homePage.css'; ?></style>



		<title>SportsLive</title>
		<script>

			function ajax(id){
				var apiLink = "https://api.sportsdata.io/v3/nba/stats/json/PlayerSeasonStatsByPlayer/";
				var year = "2019/";
				var key = "?key=8c3a8be09fc6448a94f34f91488de450"; 
				apiLink = apiLink + year + id + key;  
				console.log(apiLink);
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
			
			//let resultsShown = response.length;
			//console.log(resultsShown);
			var row = document.querySelector(".playerRow"); 
		// let totalResults = response.total_results; 
	  	
		  		let player = document.createElement("div");
		  		player.className ="p-2 col-sm-12 col-lg-6 col-md-8 player";
		  		let playerImg = document.createElement("div");
		  		player.appendChild(playerImg);
		  		let pImg = document.createElement("img");
		  		playerImg.appendChild(pImg);
		  		var name = response.Name;



		  		pImg.src = "Player Photos/" + name +  ".png";
		  		console.log(pImg.src) ;
		  		pImg.onerror = function(){
		  			pImg.src = "error.jpg";
		  		}


		  		var playerData = document.createElement("div"); 
		  		playerData.className = "playerData"; 
		  		player.appendChild(playerData); 

		  		var nameP = document.createElement("h2"); 
		  		nameP.innerHTML = response.Name; 

		  		playerData.appendChild(nameP);

		  		var table = document.createElement("table"); 
		  		table.className = "table table-primary table-hover table-bordered";
		  		playerData.appendChild(table);

		  		var header = document.createElement("thead");
		  		header.className = "thead thead-dark";  
		  		var headerRow = document.createElement("tr"); 
		  		header.appendChild(headerRow); 
		  		table.appendChild(header); 

		  		var season = document.createElement("th"); 
		  		season.innerHTML = "Season"; 
		  		headerRow.appendChild(season); 

		  		var gamesPlayed = document.createElement("th"); 
		  		gamesPlayed.innerHTML = "GP"; 
		  		headerRow.appendChild(gamesPlayed); 

		  		var minutesPerGame = document.createElement("th"); 
		  		minutesPerGame.innerHTML = "MPG"; 
		  		headerRow.appendChild(minutesPerGame); 

		  		var fgP = document.createElement("th"); 
		  		fgP.innerHTML = "FG%"; 
		  		headerRow.appendChild(fgP); 

		  		var threePoint = document.createElement("th"); 
		  		threePoint.innerHTML = "3PT%"; 
		  		headerRow.appendChild(threePoint); 

		  		var freeThrow = document.createElement("th"); 
		  		freeThrow.innerHTML = "FT%";
		  		headerRow.appendChild(freeThrow); 

		  		var rebounds = document.createElement("th"); 
		  		rebounds.innerHTML = "RPG";  
		  		headerRow.appendChild(rebounds); 

		  		var assists = document.createElement("th"); 
		  		assists.innerHTML = "APG"; 
		  		headerRow.appendChild(assists); 

		  		var steals = document.createElement("th"); 
		  		steals.innerHTML = "SPG"; 
		  		headerRow.appendChild(steals); 

		  		var blocks = document.createElement("th"); 
		  		blocks.innerHTML = "BPG"; 
		  		headerRow.appendChild(blocks); 

		  		var points = document.createElement("th"); 
		  		points.innerHTML = "PPG"; 
		  		headerRow.appendChild(points); 
		  		var tbody = document.createElement("tbody"); 
		  		tbody.className = ".table-striped";
		  		var rowP = document.createElement("tr"); 
		  		tbody.appendChild(rowP); 
		  		table.appendChild(rowP); 

		  		var seasonP = document.createElement("td"); 
		  		seasonP.innerHTML = response.Season; 
		  		rowP.appendChild(seasonP); 

		  		var gamesPlayedP = document.createElement("td"); 
		  		gamesPlayedP.innerHTML = response.Games; 
		  		rowP.appendChild(gamesPlayedP); 

		  		var minutesPerGameP = document.createElement("td"); 
		  		var minutes = response.Minutes;
		  		var games = response.Games;

				var integer = parseInt(minutes, 10);
				var gamesNum = parseInt(games,10);

				var mpg = integer/gamesNum; 
				mpg = mpg.toFixed(1);

		  		minutesPerGameP.innerHTML = mpg; 
		  		rowP.appendChild(minutesPerGameP);

		  		var fgP = document.createElement("td"); 
		  		fgP.innerHTML = response.FieldGoalsPercentage + "%"; 
		  		rowP.appendChild(fgP); 

		  		var threePointP = document.createElement("td"); 
		  		threePointP.innerHTML = response.ThreePointersPercentage + "%"; 
		  		rowP.appendChild(threePointP); 

		  		var freeThrowP = document.createElement("td"); 
		  		freeThrowP.innerHTML = response.FreeThrowsPercentage + "%";
		  		rowP.appendChild(freeThrowP); 

		  		var reboundsP = document.createElement("td");
		  		var reboundsx = response.Rebounds; 
		  		var r = parseInt(reboundsx, 10); 
		  		var rpg = r/gamesNum;  
		  		rpg = rpg.toFixed(1);
		  		reboundsP.innerHTML = rpg;  
		  		rowP.appendChild(reboundsP); 

		  		var assistsP = document.createElement("td"); 
		  		var assistsx = response.Assists; 
		  		var a = parseInt(assistsx, 10); 
		  		var apg = a/gamesNum;  
				apg = apg.toFixed(1);
		  		assistsP.innerHTML = apg; 
		  		rowP.appendChild(assistsP); 

		  		var stealsP = document.createElement("td"); 
		  		var stealsx = response.Steals; 
		  		var s = parseInt(stealsx, 10); 
		  		var spg = s/gamesNum;  
		  		spg = spg.toFixed(1);
		  		stealsP.innerHTML = spg; 
		  		rowP.appendChild(stealsP); 

		  		var blocksP = document.createElement("td"); 
		  		var blocksx = response.BlockedShots; 
		  		var b = parseInt(blocksx, 10); 
		  		var bpg = b/gamesNum;  
				bpg = bpg.toFixed(1);
		  		blocksP.innerHTML = bpg; 
		  		rowP.appendChild(blocksP); 

		  		var points = document.createElement("td"); 
		  		var pointsx = response.Points; 
		  		var p = parseInt(pointsx, 10); 
		  		var ppg = p/gamesNum; 
		  		ppg = ppg.toFixed(1);
		  		points.innerHTML = ppg; 
		  		rowP.appendChild(points); 


		  		player.appendChild(playerData); 
		  		var btn = document.createElement("button"); 
		  		btn.className = "btn btn-danger playerDelete"; 
		  		btn.innerHTML = "Delete"; 
		  		btn.value = response.PlayerID; 
		  		btn.setAttribute("onclick","deletePlayer(this);");
		  		player.appendChild(btn); 
		  		row.appendChild(player); 
		
		  	return false; 
		}

		function ajaxTeam(id){
				var apiLink = "https://api.sportsdata.io/v3/nba/scores/json/TeamSeasonStats/";
				var year = "2019";
				var key = "?key=8c3a8be09fc6448a94f34f91488de450"; 
				apiLink = apiLink + year + key;  
				console.log(apiLink);
				let xhr = new XMLHttpRequest();
				xhr.open("GET", apiLink);
				xhr.send();
				xhr.onreadystatechange = function() {
					if(this.readyState == this.DONE) {
						//recieved some kind of response
						if(xhr.status == 200) {
							let responseObj = JSON.parse(xhr.responseText);
							console.log(xhr.responseText);
							displayTeams(id, responseObj);
						} else {
							// got a reponse, but it's an error
							console.log("Error!!");
							console.log(xhr.status);
						}
					}
			}
			return false;
		}
		function displayTeams(id, response){

		var row = document.querySelector(".teamRow"); 
		// let totalResults = response.total_results; 
	  	for(var i = 0; i < response.length; i++){
	  		console.log(response[i].teamID + " yo nig " + id);
	  		if(response[i].TeamID != id){
	  			continue;
	  		}
	  		let team = document.createElement("div");
		  		team.className ="p-2 col-lg-7 col-md-12 col-sm-12 team";
		  		let teamImg = document.createElement("div");

		  		team.appendChild(teamImg);
		  		let tImg = document.createElement("img");
		  		teamImg.appendChild(tImg);
		  		var name = response[i].Name;
		  		console.log(name);
		  		tImg.src = "Team Photos/" + name +  ".png";
		  		console.log(tImg.src) ;
		  		tImg.onerror = function(){
		  			tImg.src = "error.jpg";
		  		}


		  		var teamData = document.createElement("div"); 
		  		teamData.className = "teamData"; 
		  		team.appendChild(teamData); 

		  		var nameP = document.createElement("h2"); 
		  		nameP.innerHTML = response[i].Name; 
		  		teamData.appendChild(nameP);
		  		var record = document.createElement("h2"); 
		  		record.innerHTML = response[i].Wins + " - " + response[i].Losses; 

		  		var table = document.createElement("table"); 
		  		table.className = "table table-primary table-hover table-bordered";
		  		teamData.appendChild(table);

		  		var header = document.createElement("thead");
		  		header.className = "thead thead-dark";  
		  		var headerRow = document.createElement("tr"); 
		  		header.appendChild(headerRow); 
		  		table.appendChild(header); 

		  		var season = document.createElement("th"); 
		  		season.innerHTML = "Season"; 
		  		headerRow.appendChild(season); 

		  		var possessions = document.createElement("th"); 
		  		possessions.innerHTML = "Possessions"; 
		  		headerRow.appendChild(possessions); 

		  		var fgx = document.createElement("th"); 
		  		fgx.innerHTML = "FG%"; 
		  		headerRow.appendChild(fgx); 

		  		var threePointMade = document.createElement("th"); 
		  		threePointMade.innerHTML = "3Ppg";
		  		headerRow.appendChild(threePointMade); 

		  		var threePoint = document.createElement("th"); 
		  		threePoint.innerHTML = "3PT%"; 
		  		headerRow.appendChild(threePoint); 

		  		var freeThrow = document.createElement("th"); 
		  		freeThrow.innerHTML = "FT%";
		  		headerRow.appendChild(freeThrow); 

		  		var rebounds = document.createElement("th"); 
		  		rebounds.innerHTML = "RPG";  
		  		headerRow.appendChild(rebounds); 

		  		var assists = document.createElement("th"); 
		  		assists.innerHTML = "APG"; 
		  		headerRow.appendChild(assists); 

		  		var steals = document.createElement("th"); 
		  		steals.innerHTML = "SPG"; 
		  		headerRow.appendChild(steals); 

		  		var blocks = document.createElement("th"); 
		  		blocks.innerHTML = "BPG"; 
		  		headerRow.appendChild(blocks); 

		  		var points = document.createElement("th"); 
		  		points.innerHTML = "PPG"; 
		  		headerRow.appendChild(points); 

		  		var tbody = document.createElement("tbody"); 
		  		tbody.className = ".table-striped";

		  		var rowP = document.createElement("tr"); 
		  		tbody.appendChild(rowP); 
		  		table.appendChild(rowP); 

		  		var seasonP = document.createElement("td"); 
		  		seasonP.innerHTML = response[i].Season; 
		  		rowP.appendChild(seasonP); 

		  		var possessionsp = document.createElement("td"); 
		  		possessionsp.innerHTML = response[i].Possessions; 
		  		rowP.appendChild(possessionsp); 

		  		var fgPercent = document.createElement("td"); 
		  		fgPercent.innerHTML = response[i].FieldGoalsPercentage + "%"; 
		  		rowP.appendChild(fgPercent);

		  		var threePoints = document.createElement("td"); 
		  		var x = response[i].ThreePointersMade; 
		  		var rxy = parseInt(x, 10); 
		  		var rpg = rxy/82;  
		  		rx = rpg.toFixed(1);
		  		threePoints.innerHTML = rx; 
		  		rowP.appendChild(threePoints); 

		  		var threePointP = document.createElement("td"); 
		  		threePointP.innerHTML = response[i].ThreePointersPercentage + "%"; 
		  		rowP.appendChild(threePointP); 

		  		var freeThrowP = document.createElement("td"); 
		  		freeThrowP.innerHTML = response[i].FreeThrowsPercentage + "%";
		  		rowP.appendChild(freeThrowP); 

		  		var reboundsP = document.createElement("td");
		  		var reboundsx = response[i].Rebounds; 
		  		var r = parseInt(reboundsx, 10); 
		  		var rpg = r/82;  
		  		rpg = rpg.toFixed(1);
		  		reboundsP.innerHTML = rpg;  
		  		rowP.appendChild(reboundsP); 

		  		var assistsP = document.createElement("td"); 
		  		var assistsx = response[i].Assists; 
		  		var a = parseInt(assistsx, 10); 
		  		var apg = a/82;  
				apg = apg.toFixed(1);
		  		assistsP.innerHTML = apg; 
		  		rowP.appendChild(assistsP); 

		  		var stealsP = document.createElement("td"); 
		  		var stealsx = response[i].Steals; 
		  		var s = parseInt(stealsx, 10); 
		  		var spg = s/82;  
		  		spg = spg.toFixed(1);
		  		stealsP.innerHTML = spg; 
		  		rowP.appendChild(stealsP); 

		  		var blocksP = document.createElement("td"); 
		  		var blocksx = response[i].BlockedShots; 
		  		var b = parseInt(blocksx, 10); 
		  		var bpg = b/82;  
				bpg = bpg.toFixed(1);
		  		blocksP.innerHTML = bpg; 
		  		rowP.appendChild(blocksP); 

		  		var points = document.createElement("td"); 
		  		var pointsx = response[i].Points; 
		  		var p = parseInt(pointsx, 10); 
		  		var ppg = p/82; 
		  		ppg = ppg.toFixed(1);
		  		points.innerHTML = ppg; 
		  		rowP.appendChild(points); 


		  		team.appendChild(teamData); 
		  		var btn = document.createElement("button"); 
		  		btn.className = "btn btn-danger teamDelete"; 
		  		btn.innerHTML = "Delete"; 
		  		btn.value = response[i].TeamID; 
		  		console.log("btn value:" + btn.value);
		  		btn.setAttribute("onclick","deleteTeam(this);");

		  		team.appendChild(btn); 
		  		row.appendChild(team); 
		
	  	}
		  		
		  	return false; 
		}
		function deletePlayer(btn){
			console.log("here");
			var playerID = btn.value; 
			var apiSend = "deletePlayer.php?playerID=" + playerID; 
			//console.log(apiSend);
			//window.location.href = apiSend;
			let xhr = new XMLHttpRequest();
				xhr.open("GET", apiSend);
				xhr.send();
				xhr.onreadystatechange = function() {
					if(this.readyState == this.DONE) {
						//recieved some kind of response
						if(xhr.status == 200) {
							//let responseObj = JSON.parse(xhr.responseText);
							console.log("deleted");
							//console.log(xhr.responseText);
							//displayTeams(id, responseObj);
						} else {
							// got a reponse, but it's an error
							console.log("Error!!");
							console.log(xhr.status);
						}
					}
			}
			location.reload();
		}
		function deleteTeam(btn){
			console.log("here");
			var teamID = btn.value; 
			var apiLink = "deleteTeam.php?teamID=" + teamID; 
			//window.location.href = apiLink;
			let xhr = new XMLHttpRequest();
				xhr.open("GET", apiLink);
				xhr.send();
				xhr.onreadystatechange = function() {
					if(this.readyState == this.DONE) {
						//recieved some kind of response
						if(xhr.status == 200) {
							//let responseObj = JSON.parse(xhr.responseText);
							console.log("deleted");
							//console.log(xhr.responseText);
							//displayTeams(id, responseObj);
						} else {
							// got a reponse, but it's an error
							console.log("Error!!");
							console.log(xhr.status);
						}
					}
			}
			location.reload();
		}
		function validate(){

			<?php 
			if(!isset($_SESSION['name']) || empty($_SESSION['name']) || !isset($_SESSION['userID']) || empty($_SESSION['userID'])){
				return false; 
 				//header("location: login_page.php"); 
 			}
			?>
			return true; 
		}
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
			console.log("here");
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
				<div class="d-flex flex-row wrap playerRow">
					 <?php while($row = $results->fetch_assoc() ) : ?>
					 		<script>console.log("hello");ajax(<?php echo $row['playerID'];?>)</script>
                        <?php endwhile;?>
				</div>
				<div class="d-flex flex-row wrap teamRow">
					 <?php while($col = $teams->fetch_assoc() ) : ?>
					 		<script>ajaxTeam(<?php echo $col['teamID'];?>)</script>
                        <?php endwhile;?>
				</div>
		</div>
	</body>
</html>