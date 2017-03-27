<?php

$jsonHtml = json_decode(file_get_contents("https://sheets.googleapis.com/v4/spreadsheets/1S5v7kTbSiqV8GottWVi5tzpqLdTrEgWEY4ND4zvyV3o/values:batchGet?ranges=A%3AA&ranges=B%3AB&ranges=C%3AC&ranges=D%3AD&key=AIzaSyDwH-ws7le4K2YbeJ-IOVv200LFuTVuOtU"));
//Temp Sheet $jsonHtml = json_decode(file_get_contents("https://sheets.googleapis.com/v4/spreadsheets/1tJllDysWV5Xn9C7MKlVDttPXp2jXuQCYLP3jbf4FW28/values:batchGet?ranges=A%3AA&ranges=B%3AB&ranges=C%3AC&ranges=D%3AD&key=AIzaSyDwH-ws7le4K2YbeJ-IOVv200LFuTVuOtU"));

$not_arrived_message = "";

$locations = array();
$names = array();
$len = count($jsonHtml->valueRanges[0]->values);
for($i = 1; $i<$len; $i++) {
    array_push($names,$jsonHtml->valueRanges[0]->values[$i][0]);
}
$len = count($jsonHtml->valueRanges[2]->values);
for($i = 1; $i<$len; $i++) {
    array_push($names,$jsonHtml->valueRanges[2]->values[$i][0]);
}
$len = count($jsonHtml->valueRanges[0]->values);
for($i = 1; $i<$len; $i++) {
    array_push($locations,isset($jsonHtml->valueRanges[1]->values[$i][0]) ? $jsonHtml->valueRanges[1]->values[$i][0] : $not_arrived_message);
}
$len = count($jsonHtml->valueRanges[2]->values);
for($i = 1; $i<$len; $i++) {
    array_push($locations,isset($jsonHtml->valueRanges[3]->values[$i][0]) ? $jsonHtml->valueRanges[3]->values[$i][0] : $not_arrived_message);
}

$names = array_map('trim',$names);
$locations = array_map('trim',$locations);

$maxrows = count($locations) > count($names) ? count($locations) : count($names);

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <script>
        function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                location.reload();
        }
    </script>
    <!-- Meta Tags/Site Setup -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <link rel="icon" href="favicon.ico?" type="image/x-icon">

    <title>BCA Bus</title>
    
    <!-- CSS/JQuery/ScrollTo/Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.scrollto/2.1.2/jquery.scrollTo.min.js"></script>
    <script src="bcabus.js"></script>
    </head>
    <body class="blue lighten-5">
    <a id="top"></a>
        
    <!-- Outer Wrapper -->
    <head>
    <!-- Search -->
    <nav class="search-nav blue">
    <div class="nav-wrapper">
        <form>
            <div class="input-field">
            <input class="left-align" id="search" type="search" placeholder="Search for towns here..." autocomplete="off">
            <label for="search"><i class="material-icons">search</i></label>
            </div>
        </form>
    </div>
    </nav>
    </head>
    <!-- Town Display -->
    <main>
        <?php if(!isset($_COOKIE['madeby']) and rand(0,1) == 1) { ?>
        <div class="madeBy blue lighten-3 white-text center-align">Sorry for the downtime yesterday - Luke LaScala<i onclick='setCookie("madeby", "none", 1000);' class="closeMadeBy material-icons secondary-content">close</i></div>
        <?php } else if(!isset($_COOKIE['madeby'])) { ?>
	<div class="madeBy blue lighten-3 white-text center-align">Sorry for the downtime yesterday - Luke LaScala<i onclick='setCookie("madeby", "none", 1000);' class="closeMadeBy material-icons secondary-content">close</i></div>
	<?php } ?>
        <div class="row" style="padding-top: 2%">

            <div class="col l8 offset-l2 m6 offset-m3 s12">
                <!-- Favorite Town -->
                <?php if(isset($_COOKIE['favorite']) and in_array($_COOKIE['favorite'], $names)) { ?>
                    <ul style="display: none" class="collection favoriteList">
                        <li class="collection-item favoriteItem"><i onclick='setCookie("favorite", "none", -1);' style="font-size: 3rem; color: gold; cursor: pointer" class="starIcon material-icons secondary-content">star</i><h4 class="favoriteTown"><?php echo($_COOKIE['favorite']); ?></h4><h5 class="favoriteLocation"><?php echo(ucfirst($locations[array_search($_COOKIE['favorite'], $names)])); ?></h5>
                        </li>
                    </ul>
                <?php } ?>
                <!-- Town List -->
                <ul class="townList collection with-header">
                    <li class="collection-header townList-header valign-wrapper"><h2>Town List</h2></li>
                    <?php for($i = 0; $i<$maxrows; $i++){ ?>
                    <li id="<?php echo(strtolower($names[$i])) ?>" class="collection-item townItem row"><p class="col l8 m8 s8"><span><?php echo($names[$i]); ?></span></p><span class="locationAlign col l4 m4 s4 right-align"><?php echo(ucfirst($locations[$i])); ?>&nbsp;&nbsp;<i onclick="setCookie('favorite', '<?php echo($names[$i]); ?>', 1000);" style="color: grey; cursor: pointer" class="starIcon1 material-icons secondary-content">star</i></span></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="fixed-action-btn">
    <a class="btn-floating btn-large red" onclick="document.location.reload(true)">
      <i class="large material-icons">replay</i>
    </a>
  </div>

    </main>
    <!-- Footer -->
    <footer class="valign page-footer blue darken-2 light-blue-text text-lighten-5 center-align">
        <div style="padding-bottom: 5%"><h3>BCA Bus</h3><h6>Find your bus from anywhere.</h6></div>
        </footer>
    </body>
         <style>
        #sitewrap {
        }
        ::-webkit-input-placeholder {
        color: white;
        }
        :-moz-placeholder { /* Firefox 18- */
           color: white;
        }
        ::-moz-placeholder {  /* Firefox 19+ */
           color: white;
        }
        :-ms-input-placeholder {
           color: white;
        }
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .closeMadeBy {
            padding-right: 1%;
            color: white;
            font-size: 1.5rem;
            transition: color 0.5s ease;
        }
        .closeMadeBy:hover {
            color: black;
        }
        .email {
            border-bottom: 1px solid white;
            color: white;
        }
        .madeBy {
            width: 100%;
            padding: 1% 0;
        }
        main {
            flex: 1 0 auto;
        }
        @media only screen and (max-width: 768px) { /* Mobile */
            .locationAlign {
                margin-top: 5%;
            }
            .starIcon1 {
                margin-top: -3%;
            }
        }
        @media only screen and (min-width: 768px) { /* Desktop */
            .locationAlign {
                margin-top: 2%;
            }
            .starIcon1 {
                margin-top: -1%;
            }
        }
    </style>
</html>
