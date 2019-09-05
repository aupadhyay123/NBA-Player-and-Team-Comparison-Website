
$(document).ready(function () {
    $("#fd-form").submit(function (event) {
        $(this).find(":submit").attr("disabled", "disabled");
    });

    $(".icon-bar, .overlay, .cross").click(function () {
        $("body").toggleClass("highlight");
    });

    $(window).resize(function () {
        $(".subnav-box").removeAttr("style");
        $(".nav-item").removeClass("expanded");
    })

    $('.header .nav-item .nav-link').click(function () {
        if ($(window).width() < 1200) {
            var item = $(this).parents(".nav-item");
            var subnav = $(item).find(".subnav-box");

            if (subnav.length) {
                if ($(item).hasClass("expanded")) {
                    $(subnav).slideUp(400, function () {
                        $(item).removeClass("expanded");
                    });
                }
                else {
                    $(item).addClass("expanded");
                    $(subnav).slideDown(400);
                }
                return false;
            }
            else
                $(item).addClass("expanded");
         }
    });

    setTimeout(function () {
        $("body").css("background-color", "transparent");
    }, 100)
});



//Footer fixed	
$(window).bind("load", function () {
    var footerHeight = 0,
        footerTop = 0,
        $footer = $(".footer");
    positionFooter();
    function positionFooter() {
        footerHeight = $footer.height();
        footerTop = ($(window).scrollTop() + $(window).height() - footerHeight) + "px";
        if (($(document.body).height() + footerHeight) < $(window).height()) {
            $footer.css({
                position: "fixed",
                bottom: "0px",
                left: "0",
                right: "0"
            })
        } else {
            $footer.css({
                position: "relative",
                display: "block"
            })
        }
    }
    $(window)
        .scroll(positionFooter)
        .resize(positionFooter)

});

function RoundNumber(value, precision) {
    var multiplier = Math.pow(10, precision || 0);
    return Math.round(value * multiplier) / multiplier;
}

// https://tc39.github.io/ecma262/#sec-array.prototype.findIndex
if (!Array.prototype.findIndex) {
    Object.defineProperty(Array.prototype, 'findIndex', {
        value: function (predicate) {
            // 1. Let O be ? ToObject(this value).
            if (this == null) {
                throw new TypeError('"this" is null or not defined');
            }

            var o = Object(this);

            // 2. Let len be ? ToLength(? Get(O, "length")).
            var len = o.length >>> 0;

            // 3. If IsCallable(predicate) is false, throw a TypeError exception.
            if (typeof predicate !== 'function') {
                throw new TypeError('predicate must be a function');
            }

            // 4. If thisArg was supplied, let T be thisArg; else let T be undefined.
            var thisArg = arguments[1];

            // 5. Let k be 0.
            var k = 0;

            // 6. Repeat, while k < len
            while (k < len) {
                // a. Let Pk be ! ToString(k).
                // b. Let kValue be ? Get(O, Pk).
                // c. Let testResult be ToBoolean(? Call(predicate, T, « kValue, k, O »)).
                // d. If testResult is true, return k.
                var kValue = o[k];
                if (predicate.call(thisArg, kValue, k, o)) {
                    return k;
                }
                // e. Increase k by 1.
                k++;
            }

            // 7. Return -1.
            return -1;
        }
    });
}

var FormatDecimal = function (value, places) {
    value = Number(value).toFixed(places);
    if (value < 1 && value >= 0) {
        value = ('' + value).replace(/^[0.]/, "");
        value = (value + '000').slice(0, places + 1);
    }
    return value;
}