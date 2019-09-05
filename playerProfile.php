
<!DOCTYPE html>
<html>
	<head>
		<!-- Meta Tags -->
		<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond" rel="stylesheet">
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<!--  -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

		<title>SportsLive</title>
		<style type="text/css">
			html,body{
				margin: 0;
				padding: 0;
			}
			.wholePage{
				background:linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url("nba_teams.jpg");
				width: 1500px;
				height:2000px;
			}
			body{ 
				margin:0;
			 	font:normal 75% Arial, Helvetica, sans-serif; 
			 	padding:0; 
			 	height:100vh;
			} 
			canvas{ 
				display: block; 
				vertical-align: bottom; 
			} 
			#particles-js{ 
				position:absolute; 
				width: 100%;
				height: 100%; 
				background-image: url(""); 
				background-repeat: no-repeat; 
				background-size: cover; 
				background-position: 50% 50%; 
			 }
			 .registerRow{
			 	position: absolute;
			 	width: 50%;
			 	top:15%;
			 	left:24%;
			 	background-color: rgba(10,10,10,0.5);
			 	text-align: center;
			 }
			 label{
			 	color:white;
			 	font-size:30px;
			 }
			 h1{
			 	color:red;
			 	font-size:100px;
			 	text-align: center;
			 }
			 .links{
			 	position: absolute;
			 	top:800%;
			 	left:30%;
			 	font-size: 40px;
			 }
			 img{
			 	width: 200px;
			 	height:200px;
			 }
			 .row{
			 	justify-content: center;
			 }
			 h2{
			 	font-size:50px;
			 	color:white;
			 }
			 .playerText{
			 	font-size: 30px;
			 	color: white;
			 }
			 table{
			 	color:white;
			 	font-size:30px;
			 }
			 .playerText{
			 	float:right;
			 }

		</style>
	</head>
	<body>
		<div class="container-fluid wholePage">
			<div class="row header">
				<a href="homePage.php"><h1>SportsLive</h1></a>
			</div>

				<div class="row justify-content-center">
 					<div class="col playerProfile">
 						<img src="kobe.jpg">
 						<div class="playerText">
 							Points per Game: 13.5 ppg
							<br>
							Assists per Game: 3 apg
							<br>
							Rebounds per Game: 13.5 rpg
							<br>
 						</div>
 					</div>
				</div>
				<div class="row playerStats">
					<table class="table table-hovered table-bordered">
						<thead>
							<td>Season</td>
							<td>Games Played</td>
							<td>Points</td>
							<td>Assists</td>
							<td>Rebounds</td>
						</thead>
						<tbody>
							<td>2018-2019</td>
							<td>78</td>
							<td>35.6 ppg </td>
							<td>12 apg </td>
							<td>8 rpg </td>
						</tbody>
					</table>
				</div>
				<div class="links">
					<a href="register.php">Login</a><br>
					<a href="homePage.php">Continue as a Guest</a>
				</div>
			</div>
		<script src="particles.js"></script>
		<script src="app.js"></script>

	</body>
</html>