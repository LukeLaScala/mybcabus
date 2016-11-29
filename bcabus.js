$(document).ready(function() {
    $favoriteList = $(".favoriteList");
    
    //Display message if cookie does not exist
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
        var myCookie = getCookie("favorite");
        if (myCookie == null) {
            Materialize.toast("Click the star to set a favorite town",6000);
        }
        else {
            $favoriteList.show(100);
        }
    
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
            $favoriteList.hide(100);
        }
        else {
            $townItem.show(100);
            $townHeader.show(100);
            if (localStorage.getItem("favTown") !== null) { $favoriteList.show(100); };
        }
    })
})

