$(document).ready(function () {
    $('.liketab li').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('.liketab li').removeClass('current');
        $('.tab-contentA').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    })

    var tabs = $.map($(".nav-tabs-scrollable .nav-tabs li"), function (item, index) {
        return { "index": index, "width": $(item).width(), "selected": $(item).hasClass("selected"), "scrollleft": $(item).scrollLeft(), "item": item }
    });

    var selectedIndex = 0
    var scrollto = 0;
    $.each(tabs, function (index, item) {
        if (!item.selected)
            scrollto += item.width;
        else {
            selectedIndex = item.index;
            return false;
        }
    })

    setTimeout(function () {
        $(".nav-tabs-scrollable").scroll();
        $(".nav-tabs-scrollable").scrollTo($(".nav-tabs-scrollable .nav-tabs li.selected"));
        $(".nav-mobile-overlay").hide();
    }, 1)

    var container = $('.nav-tabs-container');
    var scrollable = $('.nav-tabs-scrollable');

    scrollable.scroll(function () {
        var scrolling_left = scrollable.scrollLeft();
        var scroll_width = scrollable.width();
        var container_width = container.width();

        if (scrolling_left + scroll_width == container_width && tabs[0].selected)
            $(".nav-left-arrow").addClass("active");
        else
            $(".nav-left-arrow").removeClass("active");

        if (scrolling_left > container_width && tabs[tabs.length - 1].selected)
            $(".nav-right-arrow").addClass("active");
        else
            $(".nav-right-arrow").removeClass("active");
    });

    $(".nav-left-arrow").click(function () {
        var position = scrollable.scrollLeft();
        if (position - 125 > 0) {
            position -= 125;
            if (position - 125 > 0)
                position -= 125;
        }
        else
            position = 0;

        $(".nav-tabs-scrollable").scrollTo(position, 200);
    });

    $(".nav-right-arrow").click(function () {
        var position = scrollable.scrollLeft();
        if (position + 125 < container.width()) {
            position += 125;
            if (position + 125 < container.width())
                position += 125;
        }
        else
            position = scrollable[0].scrollWidth;

        $(".nav-tabs-scrollable").scrollTo(position, 200);
    });


});