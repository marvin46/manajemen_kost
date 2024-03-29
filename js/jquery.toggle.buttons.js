(function($) {
    /*
     jQuery Toggles v2.0.4
    Copyright 2013 Simon Tabor - MIT License
    https://github.com/simontabor/jquery-toggles / http://simontabor.com/labs/toggles
    */
    $.fn.toggles = function(d) {
        function p(e, b, f, c) { var r = e.toggleClass("active").hasClass("active"); if (c !== r) { var d = e.find(".toggle-inner").css(w);
                e.find(".toggle-off").toggleClass("active");
                e.find(".toggle-on").toggleClass("active");
                a.checkbox.prop("checked", r); if (!k) { var l = r ? 0 : -b + f;
                    d.css("margin-left", l);
                    setTimeout(function() { d.css(x);
                        d.css("margin-left", l) }, a.animate) } } } d = d || {};
        var a = $.extend({
                drag: !0,
                click: !0,
                text: { on: "ON", off: "OFF" },
                on: !1,
                animate: 250,
                transition: "ease-in-out",
                checkbox: null,
                clicker: null,
                width: 50,
                height: 20,
                type: "compact"
            }, d),
            k = "select" == a.type;
        a.checkbox = $(a.checkbox);
        a.clicker && (a.clicker = $(a.clicker));
        d = "margin-left " + a.animate + "ms " + a.transition;
        var w = { "-webkit-transition": d, "-moz-transition": d, transition: d },
            x = { "-webkit-transition": "", "-moz-transition": "", transition: "" };
        return this.each(function() {
            var e = $(this),
                b = e.height(),
                f = e.width();
            if (!b || !f) e.height(b = a.height), e.width(f = a.width);
            var c = $('<div class="toggle-slide">'),
                d = $('<div class="toggle-inner">'),
                t = $('<div class="toggle-on">'),
                l = $('<div class="toggle-off">'),
                h = $('<div class="toggle-blob">'),
                m = b / 2,
                s = f - m;
            t.css({ height: b, width: s, textAlign: "center", textIndent: k ? "" : -m, lineHeight: b + "px" }).html(a.text.on);
            l.css({ height: b, width: s, marginLeft: k ? "" : -m, textAlign: "center", textIndent: k ? "" : m, lineHeight: b + "px" }).html(a.text.off).addClass("active");
            h.css({ height: b, width: b, marginLeft: -m });
            d.css({ width: 2 * f - b, marginLeft: k ? 0 : -f + b });
            k && (c.addClass("toggle-select"), e.css("width", 2 * s), h.hide());
            e.html(c.html(d.append(t, h, l)));
            c.on("toggle", function(a,
                d) { a && a.stopPropagation();
                p(c, f, b);
                e.trigger("toggle", !d) });
            e.on("toggleOn", function() { p(c, f, b, !1) });
            e.on("toggleOff", function() { p(c, f, b, !0) });
            a.on && p(c, f, b);
            if (a.click && (!a.clicker || !a.clicker.has(e).length)) e.on("click", function(b) {
                (b.target != h[0] || !a.drag) && c.trigger("toggle", c.hasClass("active")) });
            if (a.clicker) a.clicker.on("click", function(b) {
                (b.target != h[0] || !a.drag) && c.trigger("toggle", c.hasClass("active")) });
            if (a.drag && !k) {
                var g, u = (f - b) / 4,
                    v = function(k) {
                        e.off("mousemove");
                        c.off("mouseleave");
                        h.off("mouseup");
                        var q = c.hasClass("active");
                        !g && a.click && "mouseleave" !== k.type ? c.trigger("toggle", q) : q ? g < -u ? c.trigger("toggle", q) : d.animate({ marginLeft: 0 }, a.animate / 2) : g > u ? c.trigger("toggle", q) : d.animate({ marginLeft: -f + b }, a.animate / 2)
                    },
                    n = -f + b;
                h.on("mousedown", function(a) {
                    g = 0;
                    h.off("mouseup");
                    c.off("mouseleave");
                    var b = a.pageX;
                    e.on("mousemove", h, function(a) { g = a.pageX - b;
                        c.hasClass("active") ? (a = g, 0 < g && (a = 0), g < n && (a = n)) : (a = g + n, 0 > g && (a = n), g > -n && (a = 0));
                        d.css("margin-left", a) });
                    h.on("mouseup", v);
                    c.on("mouseleave",
                        v)
                })
            }
        })
    };
})(jQuery);