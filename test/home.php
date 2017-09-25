<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	if (!session_id()) {
    	session_start();
	}
	if(is_logged_in()){
		echo "<a href='controller.php?action=logout'>Logout</a>";
	} else {
		echo "<button onclick='window.location.href=\"controller.php?action=login\"' class='loginBtn loginBtn--facebook'>
  Login with Facebook
</button>";
	}

?>
<html>
	<head>
		<link rel="stylesheet" href="main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular-cookies.js"></script>
		<script>
			$.get("https://spreadsheets.google.com/feeds/list/1S5v7kTbSiqV8GottWVi5tzpqLdTrEgWEY4ND4zvyV3o/od6/public/values?alt=json", function(data, status) {
			    var locations = data.feed.entry;
			    var rowLength = locations.length;
			    var townsFirst = [];
			    var townsSecond = [];
			    for (var i = 0; i < rowLength; i++) {
			        if (locations[i].gsx$townsbuslocation.$t !== "") {
			            townsFirst.push({"name": locations[i].gsx$townsbuslocation.$t.trim()});
			            if (locations[i].hasOwnProperty('gsx$_cokwr')) {
			                townsFirst[i].location = locations[i].gsx$_cokwr.$t.toUpperCase().trim();
			            }
			            else { townsFirst[i].location = ""; }
			        }
			        if (locations[i].gsx$townsbuslocation_2.$t !== "") {
			            townsSecond.push({"name": locations[i].gsx$townsbuslocation_2.$t.trim()});
			            if (locations[i].hasOwnProperty('gsx$_cre1l')) {
			                townsSecond[i].location = locations[i].gsx$_cre1l.$t.toUpperCase().trim();
			            }
			            else { townsSecond[i].location = ""; }
			        }

			    }
			    towns = townsFirst.concat(townsSecond);
			    townNames = towns.map(function(e){return e.name});
				});
	</script>
	</head>
	<body>
		<form method="post" action="controller.php?action=subscribe">
			<select id="buses" name="town" required></select>
			<input id="phoneNumber" name="number" type="tel" required>
			<input type="submit" val="Submit" >
		</form>
		<script>
			$.get("https://spreadsheets.google.com/feeds/list/1S5v7kTbSiqV8GottWVi5tzpqLdTrEgWEY4ND4zvyV3o/od6/public/values?alt=json", function(data, status) {
			    var locations = data.feed.entry;
			    var rowLength = locations.length;
			    var townsFirst = [];
			    var townsSecond = [];
			    for (var i = 0; i < rowLength; i++) {
			        if (locations[i].gsx$townsbuslocation.$t !== "") {
			            townsFirst.push({"name": locations[i].gsx$townsbuslocation.$t.trim()});
			            if (locations[i].hasOwnProperty('gsx$_cokwr')) {
			                townsFirst[i].location = locations[i].gsx$_cokwr.$t.toUpperCase().trim();
			            }
			            else { townsFirst[i].location = ""; }
			        }
			        if (locations[i].gsx$townsbuslocation_2.$t !== "") {
			            townsSecond.push({"name": locations[i].gsx$townsbuslocation_2.$t.trim()});
			            if (locations[i].hasOwnProperty('gsx$_cre1l')) {
			                townsSecond[i].location = locations[i].gsx$_cre1l.$t.toUpperCase().trim();
			            }
			            else { townsSecond[i].location = ""; }
			        }

			    }
			    towns = townsFirst.concat(townsSecond);
			    townNames = towns.map(function(e){return e.name});
			    var sel = document.getElementById('buses');
				for(var i = 0; i < townNames.length; i++) {
				    var opt = document.createElement('option');
				    opt.innerHTML = townNames[i];
				    opt.value = townNames[i];
				    sel.appendChild(opt);
				}
				});
		</script>
<?php require_once('./config.php'); ?>

<form action="charge.php" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-description="Access for a year"
          data-amount="5000"
          data-locale="auto"></script>
</form>

	</body>
</html>

