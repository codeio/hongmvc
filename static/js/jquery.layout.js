var currentMenu = null;
var jl = $.support.leadingWhitespace ? 54 : 56;

function requestMenu(url) {
    $.ajax({
        type: "GET",
        url: url,
        beforeSend: function () {
            loadingShow('左边菜单努力加载中...');
        },
        success: function (result) {
            loadingHide();
            $("#menu").html(result);
            currentMenu = $("#menu a:eq(0)");
            if (currentMenu.length > 0) {
                currentMenu.parent().addClass("current");
                var firstUrl = currentMenu.attr("href");
                requestFrame(firstUrl);
            }
        }
    });
}

function loadingShow($str) {
    $("#loading_content").html($str);
    $("#loading").show();
}

function loadingHide() {
    $("#loading").hide();
}

function requestFrame(url) {
    loadingShow('框架内容努力加载中...');
    if (url.indexOf("?") == -1) {
        $("#rightMain").attr({ "src": url + "?rnd=" + Math.floor(Math.random() * 100000) });
    } else {
        $("#rightMain").attr({ "src": url + "&rnd=" + Math.floor(Math.random() * 100000) });
    }
}

function getBodySize(name) {
    return window["inner" + name] ||
        document.compatMode === "CSS1Compat" && document.documentElement["client" + name] || document.body["client" + name];
}

function rSize() {
    var width = $(document).width();
    var height = $(document).height();

    if (width < 1000) {
        $("#header").css({ "width": "1000px" });
        $("#container").css({ "width": "1000px" });
    } else {
        $("#header").css({ "width": "100%" });
        $("#container").css({ "width": "100%" });
    }

    $("#rightMain").height(height - jl);
    $("#loading").height(height - jl);
    $("#scroll").height(height - jl);
}

$(function () {
    rSize();
    $(window).resize(function () {
        rSize();
    });

    $("#scroll").bind("mousewheel", function (event, delta) {
        var top = $("#menu").position().top;
        var height = $(document).height();
        var menuHiehgt = $("#menu").height() + 100;

        if (delta > 0) {
            if (top < 0) {
                top += 20;
            }
        } else {
            if (Math.abs(top) + height < menuHiehgt) {
                top -= 20;
            }
        }

        $("#menu").css({ "top": top + "px" });
    });

    $("#menu").on("click", "a", function () {
        var url = $(this).attr("href");
        if (url) {
            if (currentMenu != null) {
                currentMenu.removeClass("current");
            }
            $(this).addClass("current");
            currentMenu = $(this);
            requestFrame(url);
        }
        return false;
    });

    $("#rightMain").load(function () {
        loadingHide();
    });

    $("#nav a").bind("click", function () {
        var url = $(this).attr("href");
        if (url) {
            $("#nav a").removeClass("current");
            $(this).addClass("current");
            requestMenu(url);
        }
        return false;
    });
});