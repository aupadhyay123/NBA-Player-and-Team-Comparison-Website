			function ajax(id){
				var apiLink = "https://api.sportsdata.io/v3/nba/stats/json/PlayerSeasonStatsByPlayer/";
				var year = "2019/";
				var key = "?key=43ede547936d4ef988ae4ad9ed4c7616"; 
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
		  		player.className ="p-2 col-6 player";
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
		  		btn.className = "btn btn-danger"; 
		  		btn.innerHTML = "Delete"; 
		  		btn.value = response.PlayerID; 
		  		player.appendChild(btn); 
		  		row.appendChild(player); 
		
		  	return false; 
		}
		function ajaxTeam(id){
				var apiLink = "https://api.sportsdata.io/v3/nba/scores/json/TeamSeasonStats/";
				var year = "2019";
				var key = "?key=43ede547936d4ef988ae4ad9ed4c7616"; 
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

			//let resultsShown = response.length;
			//console.log(resultsShown);
				var row = document.querySelector(".teamRow"); 
		// let totalResults = response.total_results; 
	  	
		  		let team = document.createElement("div");
		  		team.className ="p-2 col-6 team";
		  		let teamImg = document.createElement("div");

		  		team.appendChild(playerImg);
		  		let tImg = document.createElement("img");
		  		teamImg.appendChild(tImg);
		  		var name = response.Name;

		  		tImg.src = "Team Photos/" + name +  ".png";
		  		console.log(tImg.src) ;
		  		tImg.onerror = function(){
		  			pImg.src = "error.jpg";
		  		}


		  		var teamData = document.createElement("div"); 
		  		teamData.className = "teamData"; 
		  		team.appendChild(teamData); 

		  		var nameP = document.createElement("h2"); 
		  		nameP.innerHTML = response.Name; 
		  		playerData.appendChild(nameP);
		  		var record = document.createElement("h2"); 
		  		record.innerHTML = response.Wins + " - " + response.Losses; 

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
		  		possessions.innerHTML = "Posessions"; 
		  		headerRow.appendChild(possessions); 

		  		var fgP = document.createElement("th"); 
		  		fgP.innerHTML = "FG%"; 
		  		headerRow.appendChild(fgP); 

		  		var threePointMade = document.createElement("th"); 
		  		freeThrow.innerHTML = "3Ppg";
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
		  		seasonP.innerHTML = response.Season; 
		  		rowP.appendChild(seasonP); 

		  		var possessionsp = document.createElement("td"); 
		  		possessionsp.innerHTML = response.Posessions; 
		  		rowP.appendChild(possessionsp); 

		  		var fgPercent = document.createElement("td"); 

		  		fgPercent.innerHTML = response.FieldGoalsPercentage + "%"; 
		  		rowP.appendChild(fgPercent);

		  		var threePoints = document.createElement("td"); 
		  		var x = response.ThreePointersMade; 
		  		var rxy = parseInt(x, 10); 
		  		var rpg = rxy/82;  
		  		rx = rpg.toFixed(1);
		  		threePoints.innerHTML = rx + "pg"; 
		  		rowP.appendChild(threePoints); 

		  		var threePointP = document.createElement("td"); 
		  		threePointP.innerHTML = response.ThreePointersPercentage + "%"; 
		  		rowP.appendChild(threePointP); 

		  		var freeThrowP = document.createElement("td"); 
		  		freeThrowP.innerHTML = response.FreeThrowsPercentage + "%";
		  		rowP.appendChild(freeThrowP); 

		  		var reboundsP = document.createElement("td");
		  		var reboundsx = response.Rebounds; 
		  		var r = parseInt(reboundsx, 10); 
		  		var rpg = r/82;  
		  		rpg = rpg.toFixed(1);
		  		reboundsP.innerHTML = rpg;  
		  		rowP.appendChild(reboundsP); 

		  		var assistsP = document.createElement("td"); 
		  		var assistsx = response.Assists; 
		  		var a = parseInt(assistsx, 10); 
		  		var apg = a/82;  
				apg = apg.toFixed(1);
		  		assistsP.innerHTML = apg; 
		  		rowP.appendChild(assistsP); 

		  		var stealsP = document.createElement("td"); 
		  		var stealsx = response.Steals; 
		  		var s = parseInt(stealsx, 10); 
		  		var spg = s/82;  
		  		spg = spg.toFixed(1);
		  		stealsP.innerHTML = spg; 
		  		rowP.appendChild(stealsP); 

		  		var blocksP = document.createElement("td"); 
		  		var blocksx = response.BlockedShots; 
		  		var b = parseInt(blocksx, 10); 
		  		var bpg = b/82;  
				bpg = bpg.toFixed(1);
		  		blocksP.innerHTML = bpg; 
		  		rowP.appendChild(blocksP); 

		  		var points = document.createElement("td"); 
		  		var pointsx = response.Points; 
		  		var p = parseInt(pointsx, 10); 
		  		var ppg = p/82; 
		  		ppg = ppg.toFixed(1);
		  		points.innerHTML = ppg; 
		  		rowP.appendChild(points); 


		  		player.appendChild(playerData); 
		  		var btn = document.createElement("button"); 
		  		btn.className = "btn btn-danger"; 
		  		btn.innerHTML = "Delete"; 
		  		btn.value = response.PlayerID; 
		  		player.appendChild(btn); 
		  		row.appendChild(player); 
		
		  	return false; 
		}
		