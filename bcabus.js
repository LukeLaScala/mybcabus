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
})
