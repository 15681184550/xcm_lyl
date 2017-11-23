function Swipe(n, t) {
    "use strict";
    function e() {
        w = x.children, m = w.length, w.length < 2 && (t.continuous = !1), f.transitions && t.continuous && w.length < 3 && (x.appendChild(w[0].cloneNode(!0)), x.appendChild(x.children[1].cloneNode(!0)), w = x.children), p = new Array(w.length), E = n.getBoundingClientRect().width || n.offsetWidth, x.style.width = w.length * E + "px";
        for (var e = w.length; e--;) {
            var i = w[e];
            i.style.width = E + "px", i.setAttribute("data-index", e), f.transitions && (i.style.left = e * -E + "px", r(e, b > e ? -E : e > b ? E : 0, 0))
        }
        t.continuous && f.transitions && (r(s(b - 1), -E, 0), r(s(b + 1), E, 0)), f.transitions || (x.style.left = b * -E + "px"), n.style.visibility = "visible"
    }

    function i() {
        t.continuous ? a(b - 1) : b && a(b - 1)
    }

    function o() {
        t.continuous ? a(b + 1) : b < w.length - 1 && a(b + 1)
    }

    function s(n) {
        return (w.length + n % w.length) % w.length
    }

    function a(n, e) {
        if (b != n) {
            if (f.transitions) {
                var i = Math.abs(b - n) / (b - n);
                if (t.continuous) {
                    var o = i;
                    i = -p[s(n)] / E, i !== o && (n = -i * w.length + n)
                }
                for (var a = Math.abs(b - n) - 1; a--;)r(s((n > b ? n : b) - a - 1), E * i, 0);
                n = s(n), r(b, E * i, e || g), r(n, 0, e || g), t.continuous && r(s(n - i), -(E * i), 0)
            } else n = s(n), c(b * -E, n * -E, e || g);
            b = n, h(t.callback && t.callback(b, w[b]))
        }
    }

    function r(n, t, e) {
        u(n, t, e), p[n] = t
    }

    function u(n, t, e) {
        var i = w[n], o = i && i.style;
        o && (o.webkitTransitionDuration = o.MozTransitionDuration = o.msTransitionDuration = o.OTransitionDuration = o.transitionDuration = e + "ms", o.webkitTransform = "translate(" + t + "px,0)translateZ(0)", o.msTransform = o.MozTransform = o.OTransform = "translateX(" + t + "px)")
    }

    function c(n, e, i) {
        if (!i)return void(x.style.left = e + "px");
        var o = +new Date, s = setInterval(function () {
            var a = +new Date - o;
            return a > i ? (x.style.left = e + "px", T && d(), t.transitionEnd && t.transitionEnd.call(event, b, w[b]), void clearInterval(s)) : void(x.style.left = (e - n) * (Math.floor(a / i * 100) / 100) + n + "px")
        }, 4)
    }

    function d() {
        T = swipObjdelay || t.auto || 0, y = setTimeout(o, T)
    }

    function l() {
        T = t.auto > 0 ? t.auto : 0, clearTimeout(y)
    }

    var v = function () {
    }, h = function (n) {
        setTimeout(n || v, 0)
    }, f = {
        addEventListener: !!window.addEventListener,
        touch: "ontouchstart"in window || window.DocumentTouch && document instanceof DocumentTouch,
        transitions: function (n) {
            var t = ["transitionProperty", "WebkitTransition", "MozTransition", "OTransition", "msTransition"];
            for (var e in t)if (void 0 !== n.style[t[e]])return !0;
            return !1
        }(document.createElement("swipe"))
    };
    if (n) {
        var w, p, E, m, x = n.children[0];
        t = t || {};
        var b = parseInt(t.startSlide, 10) || 0, g = t.speed || 300;
        t.continuous = void 0 !== t.continuous ? t.continuous : !0;
        var y, T = t.auto || 0;
        window.swipeObj = {}, swipeObj.stop = l;
        var L, k = {}, D = {}, M = this, z = {
            handleEvent: function (n) {
                switch (n.type) {
                    case"touchstart":
                        this.start(n);
                        break;
                    case"touchmove":
                        this.move(n);
                        break;
                    case"touchend":
                        h(this.end(n)), t.touchEndCallBack && t.touchEndCallBack.call(M);
                        break;
                    case"webkitTransitionEnd":
                    case"msTransitionEnd":
                    case"oTransitionEnd":
                    case"otransitionend":
                    case"transitionend":
                        h(this.transitionEnd(n));
                        break;
                    case"resize":
                        h(e)
                }
                t.stopPropagation && n.stopPropagation()
            }, start: function (n) {
                var t = n.touches[0];
                k = {
                    x: t.pageX,
                    y: t.pageY,
                    time: +new Date
                }, L = void 0, D = {}, x.addEventListener("touchmove", this, !1), x.addEventListener("touchend", this, !1)
            }, move: function (n) {
                if (!(n.touches.length > 1 || n.scale && 1 !== n.scale)) {
                    t.disableScroll && n.preventDefault();
                    var e = n.touches[0];
                    D = {
                        x: e.pageX - k.x,
                        y: e.pageY - k.y
                    }, "undefined" == typeof L && (L = !!(L || Math.abs(D.x) < Math.abs(D.y))), L || (n.preventDefault(), l(), t.continuous ? (u(s(b - 1), D.x + p[s(b - 1)], 0), u(b, D.x + p[b], 0), u(s(b + 1), D.x + p[s(b + 1)], 0)) : (D.x = D.x / (!b && D.x > 0 || b == w.length - 1 && D.x < 0 ? Math.abs(D.x) / E + 1 : 1), u(b - 1, D.x + p[b - 1], 0), u(b, D.x + p[b], 0), u(b + 1, D.x + p[b + 1], 0)))
                }
            }, end: function (n) {
                var e = +new Date - k.time, i = Number(e) < 250 && Math.abs(D.x) > 20 || Math.abs(D.x) > E / 2, o = !b && D.x > 0 || b == w.length - 1 && D.x < 0;
                t.continuous && (o = !1);
                var a = D.x < 0;
                L || (i && !o ? (a ? (t.continuous ? (r(s(b - 1), -E, 0), r(s(b + 2), E, 0)) : r(b - 1, -E, 0), r(b, p[b] - E, g), r(s(b + 1), p[s(b + 1)] - E, g), b = s(b + 1)) : (t.continuous ? (r(s(b + 1), E, 0), r(s(b - 2), -E, 0)) : r(b + 1, E, 0), r(b, p[b] + E, g), r(s(b - 1), p[s(b - 1)] + E, g), b = s(b - 1)), t.callback && t.callback(b, w[b])) : t.continuous ? (r(s(b - 1), -E, g), r(b, 0, g), r(s(b + 1), E, g)) : (r(b - 1, -E, g), r(b, 0, g), r(b + 1, E, g))), x.removeEventListener("touchmove", z, !1), x.removeEventListener("touchend", z, !1)
            }, transitionEnd: function (n) {
                parseInt(n.target.getAttribute("data-index"), 10) == b && (T && d(), t.transitionEnd && t.transitionEnd.call(n, b, w[b]))
            }
        };
        return e(), T && d(), f.addEventListener ? (f.touch && x.addEventListener("touchstart", z, !1), f.transitions && (x.addEventListener("webkitTransitionEnd", z, !1), x.addEventListener("msTransitionEnd", z, !1), x.addEventListener("oTransitionEnd", z, !1), x.addEventListener("otransitionend", z, !1), x.addEventListener("transitionend", z, !1)), window.addEventListener("resize", z, !1)) : window.onresize = function () {
            e()
        }, {
            setup: function () {
                e()
            }, slide: function (n, t) {
                l(), a(n, t)
            }, prev: function () {
                l(), i()
            }, next: function () {
                l(), o()
            }, stop: function () {
                l()
            }, getPos: function () {
                return b
            }, getNumSlides: function () {
                return m
            }, kill: function () {
                l(), x.style.width = "", x.style.left = "";
                for (var n = w.length; n--;) {
                    var t = w[n];
                    t.style.width = "", t.style.left = "", f.transitions && u(n, 0, 0)
                }
                f.addEventListener ? (x.removeEventListener("touchstart", z, !1), x.removeEventListener("webkitTransitionEnd", z, !1), x.removeEventListener("msTransitionEnd", z, !1), x.removeEventListener("oTransitionEnd", z, !1), x.removeEventListener("otransitionend", z, !1), x.removeEventListener("transitionend", z, !1), window.removeEventListener("resize", z, !1)) : window.onresize = null
            }
        }
    }
}
(window.jQuery || window.Zepto) && !function (n) {
    n.fn.Swipe = function (t) {
        return this.each(function () {
            n(this).data("Swipe", new Swipe(n(this)[0], t))
        })
    }
}(window.jQuery || window.Zepto);

