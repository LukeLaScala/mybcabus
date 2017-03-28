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
            if (begin !== 0) return null;
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
    if (favCookie === null) {
        Materialize.toast("Click the star to set a favorite town",6000);
    }
    var closeCookie = getCookie("madeby");
    $closeMsg.click(function() {
        $madeBy.slideUp(100);
    })
})