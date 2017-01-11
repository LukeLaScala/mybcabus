  }
}

function turn(){

    if(!addedCityLabel){

      appendColumn();


      var elementExists = document.getElementById("game-leaderboard");
      var numplayers = elementExists.querySelectorAll('.leaderboard-name').length;
      var leaderboard = document.getElementById('game-leaderboard');

      for (var i = 0; i < numplayers; i ++){
        players.push(leaderboard.rows[i + 1].children[1 + inTeamGame].classList[1]);
      }

      for (var i = 0; i < numplayers; i++) {
        data[players[i]] = new Array();
        last[players[i]] = new Array();
        last[players[i]] = new Array();
        cities[players[i]] = new Array();
      }

      addedCityLabel = true;
    }

    var leaderboard = document.getElementById('game-leaderboard');
    var elementExists = document.getElementById("game-leaderboard");
    var numplayers = elementExists.querySelectorAll('.leaderboard-name').length;


    for(var j = 0; j < numplayers; j++){
      var playerColor = players[j];
      if (typeof last == 'undefined' || last.length < 1) {
        last[playerColor].push(getPlayerArmy(playerColor));
      }

      else {
        inc = parseInt(getPlayerArmy(playerColor)) - parseInt(last[playerColor][last[playerColor].length - 1]);
        last[playerColor].push(getPlayerArmy(playerColor));
        if (inc > 0){
          data[playerColor].push(inc);
        }

        if (inc > 0 && data[playerColor].length > 7){
          guess_cities = mode(data[playerColor].slice(data[playerColor].length - 6));



          cities[playerColor].push(guess_cities);
        }
      }

      if (!(typeof cities[playerColor] == 'undefined' || cities[playerColor].length < 1)) {
        setPlayerCities(playerColor, cities[playerColor][cities[playerColor].length - 1] - 1);

    }
  }
}

turnInterval = setInterval(function() {

  if (inGame()){
    if (playingTeamGame()){
      inTeamGame = 1;
    }
    turn();
  } else {
    addedCityLabel = false
  }
}, 500);Lukes-MacBook-Pro:chrome-extension-generals luklas$ vim manifest.json
Lukes-MacBook-Pro:chrome-extension-generals luklas$ cd ~/Documents/github/
.DS_Store                  temp/
chrome-extension-generals/
Lukes-MacBook-Pro:chrome-extension-generals luklas$ cd ~/Documents/github/chrome-extension-generals/
Lukes-MacBook-Pro:chrome-extension-generals luklas$ cd ..
Lukes-MacBook-Pro:github luklas$ ls
chrome-extension-generals	temp
Lukes-MacBook-Pro:github luklas$ cd ..
Lukes-MacBook-Pro:Documents luklas$ ls
ABCTF				National Honor Society
AP Micro			Nick
American Literature		Scans
CS				Science
CTF				Snow Warriors
Chemistry			Untitled.rkt
Clubs attendance.numbers	Untitled.rkt~
DE				Workspace2
Flask-HelloWorldBot		World_of_Tanks
Francais			advent-of-code-2016
History				botty
IlLSNOW				fb-messenger-bot
Math				flasktutorial
Melani Printing			github
My Documents			match-that-hatch
My Movie 1.mp4			microblog
My Pictures			testing
My Videos			ultimate-tic-tac-toe
Lukes-MacBook-Pro:Documents luklas$ cd ultimate-tic-tac-toe/
Lukes-MacBook-Pro:ultimate-tic-tac-toe luklas$ git add -A
Lukes-MacBook-Pro:ultimate-tic-tac-toe luklas$ git commit -m "Added back button"
[master 0541bbb] Added back button
 2 files changed, 1 deletion(-)
 rewrite Ultimate Tic Tac Toe.xcworkspace/xcuserdata/luklas.xcuserdatad/UserInterfaceState.xcuserstate (79%)
Lukes-MacBook-Pro:ultimate-tic-tac-toe luklas$ git push
Counting objects: 27, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (26/26), done.
Writing objects: 100% (27/27), 37.19 KiB | 0 bytes/s, done.
Total 27 (delta 13), reused 0 (delta 0)
remote: Resolving deltas: 100% (13/13), completed with 7 local objects.
To https://github.com/LiamRahav/ultimate-tic-tac-toe
   bd65b3a..0541bbb  master -> master
Lukes-MacBook-Pro:ultimate-tic-tac-toe luklas$ git add -A
Lukes-MacBook-Pro:ultimate-tic-tac-toe luklas$ git commit -m "Added functional back button"
[master a055bac] Added functional back button
 2 files changed, 32 insertions(+)
 rewrite Ultimate Tic Tac Toe.xcworkspace/xcuserdata/luklas.xcuserdatad/UserInterfaceState.xcuserstate (60%)
Lukes-MacBook-Pro:ultimate-tic-tac-toe luklas$ git push
Counting objects: 8, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (8/8), done.
Writing objects: 100% (8/8), 11.37 KiB | 0 bytes/s, done.
Total 8 (delta 4), reused 0 (delta 0)
remote: Resolving deltas: 100% (4/4), completed with 4 local objects.
To https://github.com/LiamRahav/ultimate-tic-tac-toe
   0541bbb..a055bac  master -> master
Lukes-MacBook-Pro:ultimate-tic-tac-toe luklas$ ssh root@159.203.129.55
root@159.203.129.55's password:
Permission denied, please try again.
root@159.203.129.55's password:
Welcome to Ubuntu 14.04.4 LTS (GNU/Linux 4.4.0-31-generic x86_64)

 * Documentation:  https://help.ubuntu.com/

  System information as of Tue Dec 20 09:21:07 EST 2016

▽
$(document).ready(function() {
    $favoriteList = $(".favoriteList");
    $madeBy = $(".madeBy");
    $closeMsg = $(".closeMadeBy");

    function getCookie(name) {
        var dc = document.cookie;
        var prefix = name + "=";
        var begin = dc.indexOf("; " + prefix);
        if (begin == -1) {
            begin = dc.indexOf(prefix);
            if (begin != 0) return null;
        }
        else
        {
            begin += 2;
            var end = document.cookie.indexOf(";", begin);
            if (end == -1) {
            end = dc.length;
            }
        }
        return decodeURI(dc.substring(begin + prefix.length, end));
    }
    var favCookie = getCookie("favorite");
"bcabus.js" [noeol][dos] 49L, 1505C                           1,1           Top
    }
    var favCookie = getCookie("favorite");
    if (favCookie == null) {
        Materialize.toast("Click the star to set a favorite town",6000);
    }
    var closeCookie = getCookie("madeby");
    $closeMsg.click(function() {
        $madeBy.slideUp(100);
    })

    //Works by #id of the list element
    $search = $("input[type='search']");
    $townItem = $(".townItem");
    $townHeader = $(".townList-header");
    $search.keyup(function() {
        $town = $search.val().toLowerCase();
        if ($town !== "") {
            $townItem.not("[id*='" + $town + "']").hide(100);
            $(".collection-item[id*='" + $town + "']").show(100);
            $townHeader.hide(100);
        }
        else {
            $townItem.show(100);
            $townHeader.show(100);
                                                              23,5          88%
$(document).ready(function() {
    $favoriteList = $(".favoriteList");
    $madeBy = $(".madeBy");
    $closeMsg = $(".closeMadeBy");

    function getCookie(name) {
        var dc = document.cookie;
        var prefix = name + "=";
        var begin = dc.indexOf("; " + prefix);
        if (begin == -1) {
            begin = dc.indexOf(prefix);
            if (begin != 0) return null;
        }
        else
        {
            begin += 2;
            var end = document.cookie.indexOf(";", begin);
            if (end == -1) {
            end = dc.length;
            }
        }
        return decodeURI(dc.substring(begin + prefix.length, end));
    }
    var favCookie = getCookie("favorite");
                                                              1,1           Top
    }
    var favCookie = getCookie("favorite");
    if (favCookie == null) {
        Materialize.toast("Click the star to set a favorite town",6000);
    }
    var closeCookie = getCookie("madeby");
    $closeMsg.click(function() {
        $madeBy.slideUp(100);
    })

    //Works by #id of the list element
    $search = $("input[type='search']");
    $townItem = $(".townItem");
    $townHeader = $(".townList-header");
    $search.keyup(function() {
        $town = $search.val().toLowerCase();
        if ($town !== "") {
            $townItem.not("[id*='" + $town + "']").hide(100);
            $(".collection-item[id*='" + $town + "']").show(100);
            $townHeader.hide(100);
        }
        else {
            $townItem.show(100);
            $townHeader.show(100);
                                                              23,5          88%
})
