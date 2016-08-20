var _openIframe = function (event, param) {
    var url = param.url;
    var title = param.title;
    var width = param.width;
    var height = param.height;
    var margin = param.margin;

    var headLine = $("h1").html();

    var modalBox = $("<div>").addClass("modals").attr("id", "modalBox");
    var modalInner = $("<div>").attr("id", "modalInner").css({ "width": width, "height": height, "margin": margin });
    var a = $("<a href='#' class='modalClose'><i class='fa fa-times'></i></a>")
    var p = $("<p>").html(headLine + " [ " + title + " ] ").attr("id", "modalFirst");
    var iframe = $("<iframe>").attr("src", url).css({ "width": "100%", "height": "100%", "frameborder": "0", "scrolling": "none" });

    var element = modalBox.append(modalInner.append(p.append(a)).append(iframe).fadeIn(500));

    var dummyText = $('<input type="text" />');
    $("body").append(dummyText);

    iframe.on("load", param, event);

    $("body").append(element);

    dummyText.focus();
    dummyText.remove();

    //モダルウィンドウ閉じ制御
    element.on("click", ".modalClose", function () {
        $(".modals").fadeOut("fast", function () {
            $(this).remove();
        });

        return false;
    });

    return false;
}

$(".frameClose").on("click", function () {
    $('.modals', parent.document).fadeOut();
    $('#modalFirst', top.document).find('a').css('display', 'block');
    return false;
});

$(".frameCloseToTop").on("click", function () {
    var ToURL = $(this).attr("href");
    $(".modals", parent.document).fadeOut();
    window.parent.location.href = ToURL;

    return false;
});

function previewDesignPopUp(url) {
    var pop = window.open(url, "t_pop", "width=800,height=800,scrollbars=no");
    pop.focus();
}

