function lisclick(t) {
    var a = $(t).text(),
        i = $(t).attr("data-value");
    isshow = !0,
        $(".measure input").val(a),
        $('input[name="housearea"]').val(i),
        $(".measurelist").hide()
}
function citylisclick(t) {
    "phone" == t && (t = $(".phonecitys").find("option:selected"));
    var a = $(t).text(),
        i = $(t).attr("data-value");
    isshow = !0,
        $(".measure2 input").val(a),
        $('input[name="city"]').val(i),
        $(".measurelist2").hide()
}
$(function () {
    function t(t) {
        var a = t.className.split(" ");
        for (var i in a) if ("hiring" == a[i]) return !0;
        return !1
    }
    function a() {
        return "placeholder" in document.createElement("input")
    }
    var i = $(".menu"),
        e = $(".nav"),
        o = $(".infor,.hiring"),
        n = $(".closebtn"),
        s = ["http://detail.ayibang.com/AYB_RCBJ.html?ayb_from=website", "http://detail.ayibang.com/AYB_JTCQBJ.html?ayb_from=website", "http://detail.ayibang.com/AYB_CBL.html?ayb_from=website", "http://detail.ayibang.com/AYB_SDBJ.html?ayb_from=website", "http://detail.ayibang.com/AYB_XJKH.html?ayb_from=website", "http://detail.ayibang.com/AYB_CFBY.html?ayb_from=website", "http://detail.ayibang.com/AYB_WSJBY.html?ayb_from=website", "http://detail.ayibang.com/AYB_SDCM.html?ayb_from=website", "http://detail.ayibang.com/AYB_DBDL.html?ayb_from=website", "http://detail.ayibang.com/AYB_PZSFBY.html?ayb_from=website", "http://detail.ayibang.com/AYB_CJQ.html?ayb_from=website", "http://detail.ayibang.com/AYB_JQJC.html?ayb_from=website", "http://detail.ayibang.com/AYB_CMA.html?ayb_from=website", "http://detail.ayibang.com/AYB_YYJQX.html?ayb_from=website", "http://detail.ayibang.com/AYB_XYJQX.html?ayb_from=website", "http://detail.ayibang.com/AYB_BXQX.html?ayb_from=website", "http://detail.ayibang.com/AYB_KTQX.html?ayb_from=website", "http://detail.ayibang.com/AYB_ZTQX.html?ayb_from=website", "http://detail.ayibang.com/AYB_DKXQX.html?ayb_from=website", "http://detail.ayibang.com/AYB_WBLQX.html?ayb_from=website", "http://detail.ayibang.com/AYB_XDGQX.html?ayb_from=website", "http://detail.ayibang.com/AYB_YSJQX.html?ayb_from=website", "http://detail.ayibang.com/AYB_YS.html?ayb_from=website", "http://detail.ayibang.com/AYB_YES.html?ayb_from=website", "http://detail.ayibang.com/AYB_BM.html?ayb_from=website", "http://detail.ayibang.com/AYB_LRPH.html?ayb_from=website", "http://detail.ayibang.com/AYB_ZDGBM.html?ayb_from=website", "http://detail.ayibang.com/AYB_JTCQZF.html?ayb_from=website", "http://detail.ayibang.com/AYB_BANJIA.html?ayb_from=website", "http://detail.ayibang.com/AYB_JTBJ.html?ayb_from=website", "http://detail.ayibang.com/AYB_GSBJ.html?ayb_from=website", "http://detail.ayibang.com/AYB_JJHX.html?ayb_from=website", "http://detail.ayibang.com/AYB_JJHX.html?ayb_from=website", "http://detail.ayibang.com/AYB_JJHX.html?ayb_from=website", "http://detail.ayibang.com/AYB_GDST.html?ayb_from=website", "http://detail.ayibang.com/AYB_KTJF.html?ayb_from=website", "http://detail.ayibang.com/AYB_KTWX.html?ayb_from=website", "http://detail.ayibang.com/AYB_HSC.html?ayb_from=website", "http://detail.ayibang.com/AYB_HMS.html?ayb_from=website", "http://detail.ayibang.com/AYB_XXFW.html?ayb_from=website", "http://detail.ayibang.com/AYB_XDT.html?ayb_from=website", "http://detail.ayibang.com/AYB_XCP.html?ayb_from=website", "http://detail.ayibang.com/AYB_XCL.html?ayb_from=website", "http://detail.ayibang.com/AYB_ETFZTHX.html?ayb_from=website", "http://detail.ayibang.com/AYB_SLTGH.html?ayb_from=website", "http://detail.ayibang.com/AYB_DJAZ.html?ayb_from=website", "http://detail.ayibang.com/AYB_MTWX.html?ayb_from=website", "http://activity.ayibang.com/2016/zhaopin/", "http://detail.ayibang.com/AYB_CRFW.html?ayb_from=website", "http://detail.ayibang.com/AYB_LRZJ.html?ayb_from=website", "http://detail.ayibang.com/AYB_LSKH.html?ayb_from=website", "http://detail.ayibang.com/AYB_YYJWX.html?ayb_from=website", "http://detail.ayibang.com/AYB_XYJWX.html?ayb_from=website", "http://detail.ayibang.com/AYB_BXWX.html?ayb_from=website", "http://detail.ayibang.com/AYB_RSQWX.html?ayb_from=website", "http://detail.ayibang.com/AYB_WBLWX.html?ayb_from=website", "http://detail.ayibang.com/AYB_JSQAZ.html?ayb_from=website", "http://detail.ayibang.com/AYB_JSQLXGH.html?ayb_from=website", "http://detail.ayibang.com/AYB_RSQQX.html?ayb_from=website", "http://detail.ayibang.com/AYB_QCCQ.html?ayb_from=website", "http://detail.ayibang.com/AYB_WSJHX.html?ayb_from=website", "http://detail.ayibang.com/AYB_HDB.html?ayb_from=website", "http://detail.ayibang.com/AYB_HDZ.html?ayb_from=website", "http://detail.ayibang.com/AYB_HBZ.html?ayb_from=website", "http://detail.ayibang.com/AYB_HQQ.html?ayb_from=website", "http://detail.ayibang.com/AYB_FSBL.html?ayb_from=website", "http://detail.ayibang.com/AYB_QMDMWX.html?ayb_from=website", "http://detail.ayibang.com/AYB_JJZX.html?ayb_from=website"],
        l = !0,
        m = $(".feedback"),
        b = $("#activityon"),
        h = $(".hiring");
    navigator.userAgent.indexOf("UCBrowser") > -1 && $(".uc").focus(function () {
        $(".enterbottom").removeClass("on"),
            $(".phoneline").removeClass("last")
    }),
        i.on("tap",
            function () {
                e.show(),
                    i.toggleClass("close"),
                    e.toggleClass("on"),
                    "menu close" == $(this).attr("class") ? (l = !0, document.addEventListener("touchmove",
                        function (t) {
                            l && (t.preventDefault(), t.stopPropagation())
                        })) : l = !1
            });
    var c = $(window).height();
    $(window).scroll(function () {
        var t = $(window).scrollTop();
        t > c ? ($(".tops").show(), $(".tops").click(function () {
            $(window).scrollTop(0)
        })) : $(".tops").hide()
    }),
        o.click(function () {
            t(this) && ($(this).addClass("on"), b.removeClass("on")),
                l = !0;
            var a = $(this).attr("data-val");
            39 == a && window.screen.width <= 750 && $("#phoneHtml").hide();
            $(window).width();
            $(".serviceurl").attr("src", s[a - 1]),
                $(".cengbox").show(),
                document.addEventListener("touchmove",
                    function (t) {
                        l && (t.preventDefault(), t.stopPropagation())
                    })
        }),
        n.click(function () {
            $("#phoneHtml").show(),
                $(".cengbox").hide(),
                $(".serviceurl").attr("src", ""),
                l = !1,
                $("html,body").removeClass("ovfHiden"),
                h.removeClass("on"),
                b.addClass("on")
        });
    var r = function () {
        $.ajax({
            type: "GET",
            url: "https://api-nanny.ayibang.com/v1/eConfig",
            success: function (t) {
                var a = t.acreage,
                    i = "";
                a.forEach(function (t) {
                    i += '<li onclick = "lisclick(this);" data-value="' + t.name + '" >' + t.name + "</li>"
                }),
                    $(".measurelist").html(i)
            },
            dataType: "json"
        })
    },
        d = function () {
            $.ajax({
                type: "GET",
                url: "https://api-nanny.ayibang.com/v1/eConfig",
                success: function (t) {
                    var a = t.acreage,
                        i = "";
                    a.forEach(function (t) {
                        i += '<option onclick = "lisclick(this);" value="' + t.name + '" >' + t.name + "</option>"
                    }),
                        $(".phonemesure").append(i)
                },
                dataType: "json"
            })
        },
        p = function () {
            $.ajax({
                type: "GET",
                url: "https://api-open-gate.ayibang.com/v1/order/intention/getCitysByScode?scode=AYB_QYCQBJ",
                success: function (t) {
                    $.each(t,
                        function (t, a) {
                            var i = '<li onclick = "citylisclick(this);  "data-value="' + a.value + '" >' + a.name + "</li>";
                            $(".citylist").append(i)
                        })
                },
                dataType: "json"
            })
        },
        y = function () {
            $.ajax({
                type: "GET",
                url: "https://api-open-gate.ayibang.com/v1/order/intention/getCitysByScode?scode=AYB_QYCQBJ",
                success: function (t) {
                    var a;
                    $.each(t,
                        function (t, i) {
                            a += '<option  onchange  = "citylisclick(this); "data-value="' + i.value + '" >' + i.name + "</option>"
                        }),
                        $(".phonecitys").append(a)
                },
                dataType: "json"
            })
        };
    p(),
        r(),
        d(),
        y(),
        $(".say").click(function () {
            m.show(),
                a() || $("[placeholder]").focus(function () {
                    var t = $(this);
                    t.val() == t.attr("placeholder") && (t.val(""), t.removeClass("placeholder"))
                }).blur(function () {
                    var t = $(this); ("" == t.val() || t.val() == t.attr("placeholder")) && (t.addClass("placeholder"), t.val(t.attr("placeholder")))
                }).blur()
        }),
        $(".leftlist p").click(function () {
            var t = $(this).index();
            $(this).addClass("on").siblings().removeClass("on"),
                $(".righttext div").eq(t).show().siblings().hide()
        }),
        $(".aboutnav li").click(function () {
            var t = $(this).index();
            $(this).addClass("on").siblings("ul li").removeClass("on"),
                $(".tabbox>div").eq(t).show().siblings().hide(),
                0 != t && $(window).width() <= 750 ? ($(".phonebanner").hide(), $(".tabbox>div").css("margin-top", "2.3rem")) : 0 == t && $(window).width() >= 750 && ($(".phonebanner").show(), $(".tabbox>div").css("margin-top", "0rem"))
        }),
        $(".phonemedia li").click(function () {
            var t = $(this).index();
            $(this).addClass("on").siblings().removeClass("on"),
                $(".mediabox>div").eq(t).show().siblings().hide()
        }),
        $(".postlist li").click(function () {
            var t = $(this).index();
            $(this).addClass("on").siblings().removeClass("on"),
                $(".postinfor").show(),
                $(".postinfor .infors").eq(t).show().siblings(".infors").hide(),
                $(".postinfor .infors").eq(t).is(":visible") && (l = !0, document.addEventListener("touchmove",
                    function (t) {
                        l && (t.preventDefault(), t.stopPropagation())
                    }))
        }),
        $(".abclose").click(function () {
            $(this).parents(".infors").hide(),
                $(".postinfor").hide(),
                l = !1
        }),
        $(window).resize(function () {
            $(window).width() >= 750 ? ($(".phonebanner").show(), $(".postinfor").css("display", "block"), $(".phonebanner").css("margin-top", "0rem"), $(".tabbox>div").css("margin-top", "0rem")) : $(window).width() <= 750 && ($(".phonebanner").hide(), $(".phonebanner").css("margin-top", "1.8rem"), $(".postinfor").css("display", "none"), $(".tabbox>div").css("margin-top", "2.3rem"))
        }),
        $(window).width() >= 750 ? ($(".phonebanner").show(), $(".postinfor").css("display", "block"), $(".phonebanner").css("margin-top", "0rem"), $(".tabbox>div").css("margin-top", "0rem")) : $(window).width() <= 750 && ($(".phonebanner").hide(), $(".phonebanner").css("margin-top", "1.8rem"), $(".postinfor").css("display", "none"), $(".tabbox>div").css("margin-top", "2.3rem"));
    var _ = location.hash,
        f = $(".tabbox>div"),
        g = $(".aboutnav li");
    "#history" == _ && (f.eq(1).show().siblings().hide(), g.eq(1).addClass("on").siblings().removeClass("on")),
        "#media" == _ && (f.eq(2).show().siblings().hide(), g.eq(2).addClass("on").siblings().removeClass("on")),
        "#addour" == _ && (f.eq(4).show().siblings().hide(), g.eq(4).addClass("on").siblings().removeClass("on"))
});