(function (e, t) {
    var n, r, i = typeof t,
        o = e.location,
        a = e.document,
        s = a.documentElement,
        l = e.jQuery,
        u = e.$,
        c = {},
        p = [],
        f = "1.10.2",
        d = p.concat,
        h = p.push,
        g = p.slice,
        m = p.indexOf,
        y = c.toString,
        v = c.hasOwnProperty,
        b = f.trim,
        x = function (e, t) {
            return new x.fn.init(e, t, r)
        },
        w = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        T = /\S+/g,
        C = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        N = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
        k = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
        E = /^[\],:{}\s]*$/,
        S = /(?:^|:|,)(?:\s*\[)+/g,
        A = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
        j = /"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g,
        D = /^-ms-/,
        L = /-([\da-z])/gi,
        H = function (e, t) {
            return t.toUpperCase()
        },
        q = function (e) {
            (a.addEventListener || "load" === e.type || "complete" === a.readyState) && (_(), x.ready())
        },
        _ = function () {
            a.addEventListener ? (a.removeEventListener("DOMContentLoaded", q, !1), e.removeEventListener("load", q, !1)) : (a.detachEvent("onreadystatechange", q), e.detachEvent("onload", q))
        };
    x.fn = x.prototype = {
        jquery: f,
        constructor: x,
        init: function (e, n, r) {
            var i, o;
            if (!e) {
                return this
            }
            if ("string" == typeof e) {
                if (i = "<" === e.charAt(0) && ">" === e.charAt(e.length - 1) && e.length >= 3 ? [null, e, null] : N.exec(e), !i || !i[1] && n) {
                    return !n || n.jquery ? (n || r).find(e) : this.constructor(n).find(e)
                }
                if (i[1]) {
                    if (n = n instanceof x ? n[0] : n, x.merge(this, x.parseHTML(i[1], n && n.nodeType ? n.ownerDocument || n : a, !0)), k.test(i[1]) && x.isPlainObject(n)) {
                        for (i in n) {
                            x.isFunction(this[i]) ? this[i](n[i]) : this.attr(i, n[i])
                        }
                    }
                    return this
                }
                if (o = a.getElementById(i[2]), o && o.parentNode) {
                    if (o.id !== i[2]) {
                        return r.find(e)
                    }
                    this.length = 1, this[0] = o
                }
                return this.context = a, this.selector = e, this
            }
            return e.nodeType ? (this.context = this[0] = e, this.length = 1, this) : x.isFunction(e) ? r.ready(e) : (e.selector !== t && (this.selector = e.selector, this.context = e.context), x.makeArray(e, this))
        },
        selector: "",
        length: 0,
        toArray: function () {
            return g.call(this)
        },
        get: function (e) {
            return null == e ? this.toArray() : 0 > e ? this[this.length + e] : this[e]
        },
        pushStack: function (e) {
            var t = x.merge(this.constructor(), e);
            return t.prevObject = this, t.context = this.context, t
        },
        each: function (e, t) {
            return x.each(this, e, t)
        },
        ready: function (e) {
            return x.ready.promise().done(e), this
        },
        slice: function () {
            return this.pushStack(g.apply(this, arguments))
        },
        first: function () {
            return this.eq(0)
        },
        last: function () {
            return this.eq(-1)
        },
        eq: function (e) {
            var t = this.length,
                n = +e + (0 > e ? t : 0);
            return this.pushStack(n >= 0 && t > n ? [this[n]] : [])
        },
        map: function (e) {
            return this.pushStack(x.map(this, function (t, n) {
                return e.call(t, n, t)
            }))
        },
        end: function () {
            return this.prevObject || this.constructor(null)
        },
        push: h,
        sort: [].sort,
        splice: [].splice
    }, x.fn.init.prototype = x.fn, x.extend = x.fn.extend = function () {
        var e, n, r, i, o, a, s = arguments[0] || {},
            l = 1,
            u = arguments.length,
            c = !1;
        for ("boolean" == typeof s && (c = s, s = arguments[1] || {}, l = 2), "object" == typeof s || x.isFunction(s) || (s = {}), u === l && (s = this, --l); u > l; l++) {
            if (null != (o = arguments[l])) {
                for (i in o) {
                    e = s[i], r = o[i], s !== r && (c && r && (x.isPlainObject(r) || (n = x.isArray(r))) ? (n ? (n = !1, a = e && x.isArray(e) ? e : []) : a = e && x.isPlainObject(e) ? e : {}, s[i] = x.extend(c, a, r)) : r !== t && (s[i] = r))
                }
            }
        }
        return s
    }, x.extend({
        expando: "jQuery" + (f + Math.random()).replace(/\D/g, ""),
        noConflict: function (t) {
            return e.$ === x && (e.$ = u), t && e.jQuery === x && (e.jQuery = l), x
        },
        isReady: !1,
        readyWait: 1,
        holdReady: function (e) {
            e ? x.readyWait++ : x.ready(!0)
        },
        ready: function (e) {
            if (e === !0 ? !--x.readyWait : !x.isReady) {
                if (!a.body) {
                    return setTimeout(x.ready)
                }
                x.isReady = !0, e !== !0 && --x.readyWait > 0 || (n.resolveWith(a, [x]), x.fn.trigger && x(a).trigger("ready").off("ready"))
            }
        },
        isFunction: function (e) {
            return "function" === x.type(e)
        },
        isArray: Array.isArray ||
        function (e) {
            return "array" === x.type(e)
        },
        isWindow: function (e) {
            return null != e && e == e.window
        },
        isNumeric: function (e) {
            return !isNaN(parseFloat(e)) && isFinite(e)
        },
        type: function (e) {
            return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? c[y.call(e)] || "object" : typeof e
        },
        isPlainObject: function (e) {
            var n;
            if (!e || "object" !== x.type(e) || e.nodeType || x.isWindow(e)) {
                return !1
            }
            try {
                if (e.constructor && !v.call(e, "constructor") && !v.call(e.constructor.prototype, "isPrototypeOf")) {
                    return !1
                }
            } catch (r) {
                return !1
            }
            if (x.support.ownLast) {
                for (n in e) {
                    return v.call(e, n)
                }
            }
            for (n in e) {}
            return n === t || v.call(e, n)
        },
        isEmptyObject: function (e) {
            var t;
            for (t in e) {
                return !1
            }
            return !0
        },
        error: function (e) {
            throw Error(e)
        },
        parseHTML: function (e, t, n) {
            if (!e || "string" != typeof e) {
                return null
            }
            "boolean" == typeof t && (n = t, t = !1), t = t || a;
            var r = k.exec(e),
                i = !n && [];
            return r ? [t.createElement(r[1])] : (r = x.buildFragment([e], t, i), i && x(i).remove(), x.merge([], r.childNodes))
        },
        parseJSON: function (n) {
            return e.JSON && e.JSON.parse ? e.JSON.parse(n) : null === n ? n : "string" == typeof n && (n = x.trim(n), n && E.test(n.replace(A, "@").replace(j, "]").replace(S, ""))) ? Function("return " + n)() : (x.error("Invalid JSON: " + n), t)
        },
        parseXML: function (n) {
            var r, i;
            if (!n || "string" != typeof n) {
                return null
            }
            try {
                e.DOMParser ? (i = new DOMParser, r = i.parseFromString(n, "text/xml")) : (r = new ActiveXObject("Microsoft.XMLDOM"), r.async = "false", r.loadXML(n))
            } catch (o) {
                r = t
            }
            return r && r.documentElement && !r.getElementsByTagName("parsererror").length || x.error("Invalid XML: " + n), r
        },
        noop: function () {},
        globalEval: function (t) {
            t && x.trim(t) && (e.execScript ||
            function (t) {
                e.eval.call(e, t)
            })(t)
        },
        camelCase: function (e) {
            return e.replace(D, "ms-").replace(L, H)
        },
        nodeName: function (e, t) {
            return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
        },
        each: function (e, t, n) {
            var r, i = 0,
                o = e.length,
                a = M(e);
            if (n) {
                if (a) {
                    for (; o > i; i++) {
                        if (r = t.apply(e[i], n), r === !1) {
                            break
                        }
                    }
                } else {
                    for (i in e) {
                        if (r = t.apply(e[i], n), r === !1) {
                            break
                        }
                    }
                }
            } else {
                if (a) {
                    for (; o > i; i++) {
                        if (r = t.call(e[i], i, e[i]), r === !1) {
                            break
                        }
                    }
                } else {
                    for (i in e) {
                        if (r = t.call(e[i], i, e[i]), r === !1) {
                            break
                        }
                    }
                }
            }
            return e
        },
        trim: b && !b.call("\ufeff\u00a0") ?
        function (e) {
            return null == e ? "" : b.call(e)
        } : function (e) {
            return null == e ? "" : (e + "").replace(C, "")
        },
        makeArray: function (e, t) {
            var n = t || [];
            return null != e && (M(Object(e)) ? x.merge(n, "string" == typeof e ? [e] : e) : h.call(n, e)), n
        },
        inArray: function (e, t, n) {
            var r;
            if (t) {
                if (m) {
                    return m.call(t, e, n)
                }
                for (r = t.length, n = n ? 0 > n ? Math.max(0, r + n) : n : 0; r > n; n++) {
                    if (n in t && t[n] === e) {
                        return n
                    }
                }
            }
            return -1
        },
        merge: function (e, n) {
            var r = n.length,
                i = e.length,
                o = 0;
            if ("number" == typeof r) {
                for (; r > o; o++) {
                    e[i++] = n[o]
                }
            } else {
                while (n[o] !== t) {
                    e[i++] = n[o++]
                }
            }
            return e.length = i, e
        },
        grep: function (e, t, n) {
            var r, i = [],
                o = 0,
                a = e.length;
            for (n = !! n; a > o; o++) {
                r = !! t(e[o], o), n !== r && i.push(e[o])
            }
            return i
        },
        map: function (e, t, n) {
            var r, i = 0,
                o = e.length,
                a = M(e),
                s = [];
            if (a) {
                for (; o > i; i++) {
                    r = t(e[i], i, n), null != r && (s[s.length] = r)
                }
            } else {
                for (i in e) {
                    r = t(e[i], i, n), null != r && (s[s.length] = r)
                }
            }
            return d.apply([], s)
        },
        guid: 1,
        proxy: function (e, n) {
            var r, i, o;
            return "string" == typeof n && (o = e[n], n = e, e = o), x.isFunction(e) ? (r = g.call(arguments, 2), i = function () {
                return e.apply(n || this, r.concat(g.call(arguments)))
            }, i.guid = e.guid = e.guid || x.guid++, i) : t
        },
        access: function (e, n, r, i, o, a, s) {
            var l = 0,
                u = e.length,
                c = null == r;
            if ("object" === x.type(r)) {
                o = !0;
                for (l in r) {
                    x.access(e, n, l, r[l], !0, a, s)
                }
            } else {
                if (i !== t && (o = !0, x.isFunction(i) || (s = !0), c && (s ? (n.call(e, i), n = null) : (c = n, n = function (e, t, n) {
                    return c.call(x(e), n)
                })), n)) {
                    for (; u > l; l++) {
                        n(e[l], r, s ? i : i.call(e[l], l, n(e[l], r)))
                    }
                }
            }
            return o ? e : c ? n.call(e) : u ? n(e[0], r) : a
        },
        now: function () {
            return (new Date).getTime()
        },
        swap: function (e, t, n, r) {
            var i, o, a = {};
            for (o in t) {
                a[o] = e.style[o], e.style[o] = t[o]
            }
            i = n.apply(e, r || []);
            for (o in t) {
                e.style[o] = a[o]
            }
            return i
        }
    }), x.ready.promise = function (t) {
        if (!n) {
            if (n = x.Deferred(), "complete" === a.readyState) {
                setTimeout(x.ready)
            } else {
                if (a.addEventListener) {
                    a.addEventListener("DOMContentLoaded", q, !1), e.addEventListener("load", q, !1)
                } else {
                    a.attachEvent("onreadystatechange", q), e.attachEvent("onload", q);
                    var r = !1;
                    try {
                        r = null == e.frameElement && a.documentElement
                    } catch (i) {}
                    r && r.doScroll &&
                    function o() {
                        if (!x.isReady) {
                            try {
                                r.doScroll("left")
                            } catch (e) {
                                return setTimeout(o, 50)
                            }
                            _(), x.ready()
                        }
                    }()
                }
            }
        }
        return n.promise(t)
    }, x.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (e, t) {
        c["[object " + t + "]"] = t.toLowerCase()
    });

    function M(e) {
        var t = e.length,
            n = x.type(e);
        return x.isWindow(e) ? !1 : 1 === e.nodeType && t ? !0 : "array" === n || "function" !== n && (0 === t || "number" == typeof t && t > 0 && t - 1 in e)
    }
    r = x(a), function (e, t) {
        var n, r, i, o, a, s, l, u, c, p, f, d, h, g, m, y, v, b = "sizzle" + -new Date,
            w = e.document,
            T = 0,
            C = 0,
            N = st(),
            k = st(),
            E = st(),
            S = !1,
            A = function (e, t) {
                return e === t ? (S = !0, 0) : 0
            },
            j = typeof t,
            D = 1 << 31,
            L = {}.hasOwnProperty,
            H = [],
            q = H.pop,
            _ = H.push,
            M = H.push,
            O = H.slice,
            F = H.indexOf ||
        function (e) {
            var t = 0,
                n = this.length;
            for (; n > t; t++) {
                if (this[t] === e) {
                    return t
                }
            }
            return -1
        }, B = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", P = "[\\x20\\t\\r\\n\\f]", R = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", W = R.replace("w", "w#"), $ = "\\[" + P + "*(" + R + ")" + P + "*(?:([*^$|!~]?=)" + P + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + W + ")|)|)" + P + "*\\]", I = ":(" + R + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + $.replace(3, 8) + ")*)|.*)\\)|)", z = RegExp("^" + P + "+|((?:^|[^\\\\])(?:\\\\.)*)" + P + "+$", "g"), X = RegExp("^" + P + "*," + P + "*"), U = RegExp("^" + P + "*([>+~]|" + P + ")" + P + "*"), V = RegExp(P + "*[+~]"), Y = RegExp("=" + P + "*([^\\]'\"]*)" + P + "*\\]", "g"), J = RegExp(I), G = RegExp("^" + W + "$"), Q = {
            ID: RegExp("^#(" + R + ")"),
            CLASS: RegExp("^\\.(" + R + ")"),
            TAG: RegExp("^(" + R.replace("w", "w*") + ")"),
            ATTR: RegExp("^" + $),
            PSEUDO: RegExp("^" + I),
            CHILD: RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + P + "*(even|odd|(([+-]|)(\\d*)n|)" + P + "*(?:([+-]|)" + P + "*(\\d+)|))" + P + "*\\)|)", "i"),
            bool: RegExp("^(?:" + B + ")$", "i"),
            needsContext: RegExp("^" + P + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + P + "*((?:-\\d)?\\d*)" + P + "*\\)|)(?=[^-]|$)", "i")
        }, K = /^[^{]+\{\s*\[native \w/, Z = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, et = /^(?:input|select|textarea|button)$/i, tt = /^h\d$/i, nt = /'|\\/g, rt = RegExp("\\\\([\\da-f]{1,6}" + P + "?|(" + P + ")|.)", "ig"), it = function (e, t, n) {
            var r = "0x" + t - 65536;
            return r !== r || n ? t : 0 > r ? String.fromCharCode(r + 65536) : String.fromCharCode(55296 | r >> 10, 56320 | 1023 & r)
        };
        try {
            M.apply(H = O.call(w.childNodes), w.childNodes), H[w.childNodes.length].nodeType
        } catch (ot) {
            M = {
                apply: H.length ?
                function (e, t) {
                    _.apply(e, O.call(t))
                } : function (e, t) {
                    var n = e.length,
                        r = 0;
                    while (e[n++] = t[r++]) {}
                    e.length = n - 1
                }
            }
        }

        function at(e, t, n, i) {
            var o, a, s, l, u, c, d, m, y, x;
            if ((t ? t.ownerDocument || t : w) !== f && p(t), t = t || f, n = n || [], !e || "string" != typeof e) {
                return n
            }
            if (1 !== (l = t.nodeType) && 9 !== l) {
                return []
            }
            if (h && !i) {
                if (o = Z.exec(e)) {
                    if (s = o[1]) {
                        if (9 === l) {
                            if (a = t.getElementById(s), !a || !a.parentNode) {
                                return n
                            }
                            if (a.id === s) {
                                return n.push(a), n
                            }
                        } else {
                            if (t.ownerDocument && (a = t.ownerDocument.getElementById(s)) && v(t, a) && a.id === s) {
                                return n.push(a), n
                            }
                        }
                    } else {
                        if (o[2]) {
                            return M.apply(n, t.getElementsByTagName(e)), n
                        }
                        if ((s = o[3]) && r.getElementsByClassName && t.getElementsByClassName) {
                            return M.apply(n, t.getElementsByClassName(s)), n
                        }
                    }
                }
                if (r.qsa && (!g || !g.test(e))) {
                    if (m = d = b, y = t, x = 9 === l && e, 1 === l && "object" !== t.nodeName.toLowerCase()) {
                        c = mt(e), (d = t.getAttribute("id")) ? m = d.replace(nt, "\\$&") : t.setAttribute("id", m), m = "[id='" + m + "'] ", u = c.length;
                        while (u--) {
                            c[u] = m + yt(c[u])
                        }
                        y = V.test(e) && t.parentNode || t, x = c.join(",")
                    }
                    if (x) {
                        try {
                            return M.apply(n, y.querySelectorAll(x)), n
                        } catch (T) {} finally {
                            d || t.removeAttribute("id")
                        }
                    }
                }
            }
            return kt(e.replace(z, "$1"), t, n, i)
        }

        function st() {
            var e = [];

            function t(n, r) {
                return e.push(n += " ") > o.cacheLength && delete t[e.shift()], t[n] = r
            }
            return t
        }

        function lt(e) {
            return e[b] = !0, e
        }

        function ut(e) {
            var t = f.createElement("div");
            try {
                return !!e(t)
            } catch (n) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t), t = null
            }
        }

        function ct(e, t) {
            var n = e.split("|"),
                r = e.length;
            while (r--) {
                o.attrHandle[n[r]] = t
            }
        }

        function pt(e, t) {
            var n = t && e,
                r = n && 1 === e.nodeType && 1 === t.nodeType && (~t.sourceIndex || D) - (~e.sourceIndex || D);
            if (r) {
                return r
            }
            if (n) {
                while (n = n.nextSibling) {
                    if (n === t) {
                        return -1
                    }
                }
            }
            return e ? 1 : -1
        }

        function ft(e) {
            return function (t) {
                var n = t.nodeName.toLowerCase();
                return "input" === n && t.type === e
            }
        }

        function dt(e) {
            return function (t) {
                var n = t.nodeName.toLowerCase();
                return ("input" === n || "button" === n) && t.type === e
            }
        }

        function ht(e) {
            return lt(function (t) {
                return t = +t, lt(function (n, r) {
                    var i, o = e([], n.length, t),
                        a = o.length;
                    while (a--) {
                        n[i = o[a]] && (n[i] = !(r[i] = n[i]))
                    }
                })
            })
        }
        s = at.isXML = function (e) {
            var t = e && (e.ownerDocument || e).documentElement;
            return t ? "HTML" !== t.nodeName : !1
        }, r = at.support = {}, p = at.setDocument = function (e) {
            var n = e ? e.ownerDocument || e : w,
                i = n.defaultView;
            return n !== f && 9 === n.nodeType && n.documentElement ? (f = n, d = n.documentElement, h = !s(n), i && i.attachEvent && i !== i.top && i.attachEvent("onbeforeunload", function () {
                p()
            }), r.attributes = ut(function (e) {
                return e.className = "i", !e.getAttribute("className")
            }), r.getElementsByTagName = ut(function (e) {
                return e.appendChild(n.createComment("")), !e.getElementsByTagName("*").length
            }), r.getElementsByClassName = ut(function (e) {
                return e.innerHTML = "<div class='a'></div><div class='a i'></div>", e.firstChild.className = "i", 2 === e.getElementsByClassName("i").length
            }), r.getById = ut(function (e) {
                return d.appendChild(e).id = b, !n.getElementsByName || !n.getElementsByName(b).length
            }), r.getById ? (o.find.ID = function (e, t) {
                if (typeof t.getElementById !== j && h) {
                    var n = t.getElementById(e);
                    return n && n.parentNode ? [n] : []
                }
            }, o.filter.ID = function (e) {
                var t = e.replace(rt, it);
                return function (e) {
                    return e.getAttribute("id") === t
                }
            }) : (delete o.find.ID, o.filter.ID = function (e) {
                var t = e.replace(rt, it);
                return function (e) {
                    var n = typeof e.getAttributeNode !== j && e.getAttributeNode("id");
                    return n && n.value === t
                }
            }), o.find.TAG = r.getElementsByTagName ?
            function (e, n) {
                return typeof n.getElementsByTagName !== j ? n.getElementsByTagName(e) : t
            } : function (e, t) {
                var n, r = [],
                    i = 0,
                    o = t.getElementsByTagName(e);
                if ("*" === e) {
                    while (n = o[i++]) {
                        1 === n.nodeType && r.push(n)
                    }
                    return r
                }
                return o
            }, o.find.CLASS = r.getElementsByClassName &&
            function (e, n) {
                return typeof n.getElementsByClassName !== j && h ? n.getElementsByClassName(e) : t
            }, m = [], g = [], (r.qsa = K.test(n.querySelectorAll)) && (ut(function (e) {
                e.innerHTML = "<select><option selected=''></option></select>", e.querySelectorAll("[selected]").length || g.push("\\[" + P + "*(?:value|" + B + ")"), e.querySelectorAll(":checked").length || g.push(":checked")
            }), ut(function (e) {
                var t = n.createElement("input");
                t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("t", ""), e.querySelectorAll("[t^='']").length && g.push("[*^$]=" + P + "*(?:''|\"\")"), e.querySelectorAll(":enabled").length || g.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), g.push(",.*:")
            })), (r.matchesSelector = K.test(y = d.webkitMatchesSelector || d.mozMatchesSelector || d.oMatchesSelector || d.msMatchesSelector)) && ut(function (e) {
                r.disconnectedMatch = y.call(e, "div"), y.call(e, "[s!='']:x"), m.push("!=", I)
            }), g = g.length && RegExp(g.join("|")), m = m.length && RegExp(m.join("|")), v = K.test(d.contains) || d.compareDocumentPosition ?
            function (e, t) {
                var n = 9 === e.nodeType ? e.documentElement : e,
                    r = t && t.parentNode;
                return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r)))
            } : function (e, t) {
                if (t) {
                    while (t = t.parentNode) {
                        if (t === e) {
                            return !0
                        }
                    }
                }
                return !1
            }, A = d.compareDocumentPosition ?
            function (e, t) {
                if (e === t) {
                    return S = !0, 0
                }
                var i = t.compareDocumentPosition && e.compareDocumentPosition && e.compareDocumentPosition(t);
                return i ? 1 & i || !r.sortDetached && t.compareDocumentPosition(e) === i ? e === n || v(w, e) ? -1 : t === n || v(w, t) ? 1 : c ? F.call(c, e) - F.call(c, t) : 0 : 4 & i ? -1 : 1 : e.compareDocumentPosition ? -1 : 1
            } : function (e, t) {
                var r, i = 0,
                    o = e.parentNode,
                    a = t.parentNode,
                    s = [e],
                    l = [t];
                if (e === t) {
                    return S = !0, 0
                }
                if (!o || !a) {
                    return e === n ? -1 : t === n ? 1 : o ? -1 : a ? 1 : c ? F.call(c, e) - F.call(c, t) : 0
                }
                if (o === a) {
                    return pt(e, t)
                }
                r = e;
                while (r = r.parentNode) {
                    s.unshift(r)
                }
                r = t;
                while (r = r.parentNode) {
                    l.unshift(r)
                }
                while (s[i] === l[i]) {
                    i++
                }
                return i ? pt(s[i], l[i]) : s[i] === w ? -1 : l[i] === w ? 1 : 0
            }, n) : f
        }, at.matches = function (e, t) {
            return at(e, null, null, t)
        }, at.matchesSelector = function (e, t) {
            if ((e.ownerDocument || e) !== f && p(e), t = t.replace(Y, "='$1']"), !(!r.matchesSelector || !h || m && m.test(t) || g && g.test(t))) {
                try {
                    var n = y.call(e, t);
                    if (n || r.disconnectedMatch || e.document && 11 !== e.document.nodeType) {
                        return n
                    }
                } catch (i) {}
            }
            return at(t, f, null, [e]).length > 0
        }, at.contains = function (e, t) {
            return (e.ownerDocument || e) !== f && p(e), v(e, t)
        }, at.attr = function (e, n) {
            (e.ownerDocument || e) !== f && p(e);
            var i = o.attrHandle[n.toLowerCase()],
                a = i && L.call(o.attrHandle, n.toLowerCase()) ? i(e, n, !h) : t;
            return a === t ? r.attributes || !h ? e.getAttribute(n) : (a = e.getAttributeNode(n)) && a.specified ? a.value : null : a
        }, at.error = function (e) {
            throw Error("Syntax error, unrecognized expression: " + e)
        }, at.uniqueSort = function (e) {
            var t, n = [],
                i = 0,
                o = 0;
            if (S = !r.detectDuplicates, c = !r.sortStable && e.slice(0), e.sort(A), S) {
                while (t = e[o++]) {
                    t === e[o] && (i = n.push(o))
                }
                while (i--) {
                    e.splice(n[i], 1)
                }
            }
            return e
        }, a = at.getText = function (e) {
            var t, n = "",
                r = 0,
                i = e.nodeType;
            if (i) {
                if (1 === i || 9 === i || 11 === i) {
                    if ("string" == typeof e.textContent) {
                        return e.textContent
                    }
                    for (e = e.firstChild; e; e = e.nextSibling) {
                        n += a(e)
                    }
                } else {
                    if (3 === i || 4 === i) {
                        return e.nodeValue
                    }
                }
            } else {
                for (; t = e[r]; r++) {
                    n += a(t)
                }
            }
            return n
        }, o = at.selectors = {
            cacheLength: 50,
            createPseudo: lt,
            match: Q,
            attrHandle: {},
            find: {},
            relative: {
                ">": {
                    dir: "parentNode",
                    first: !0
                },
                " ": {
                    dir: "parentNode"
                },
                "+": {
                    dir: "previousSibling",
                    first: !0
                },
                "~": {
                    dir: "previousSibling"
                }
            },
            preFilter: {
                ATTR: function (e) {
                    return e[1] = e[1].replace(rt, it), e[3] = (e[4] || e[5] || "").replace(rt, it), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                },
                CHILD: function (e) {
                    return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || at.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && at.error(e[0]), e
                },
                PSEUDO: function (e) {
                    var n, r = !e[5] && e[2];
                    return Q.CHILD.test(e[0]) ? null : (e[3] && e[4] !== t ? e[2] = e[4] : r && J.test(r) && (n = mt(r, !0)) && (n = r.indexOf(")", r.length - n) - r.length) && (e[0] = e[0].slice(0, n), e[2] = r.slice(0, n)), e.slice(0, 3))
                }
            },
            filter: {
                TAG: function (e) {
                    var t = e.replace(rt, it).toLowerCase();
                    return "*" === e ?
                    function () {
                        return !0
                    } : function (e) {
                        return e.nodeName && e.nodeName.toLowerCase() === t
                    }
                },
                CLASS: function (e) {
                    var t = N[e + " "];
                    return t || (t = RegExp("(^|" + P + ")" + e + "(" + P + "|$)")) && N(e, function (e) {
                        return t.test("string" == typeof e.className && e.className || typeof e.getAttribute !== j && e.getAttribute("class") || "")
                    })
                },
                ATTR: function (e, t, n) {
                    return function (r) {
                        var i = at.attr(r, e);
                        return null == i ? "!=" === t : t ? (i += "", "=" === t ? i === n : "!=" === t ? i !== n : "^=" === t ? n && 0 === i.indexOf(n) : "*=" === t ? n && i.indexOf(n) > -1 : "$=" === t ? n && i.slice(-n.length) === n : "~=" === t ? (" " + i + " ").indexOf(n) > -1 : "|=" === t ? i === n || i.slice(0, n.length + 1) === n + "-" : !1) : !0
                    }
                },
                CHILD: function (e, t, n, r, i) {
                    var o = "nth" !== e.slice(0, 3),
                        a = "last" !== e.slice(-4),
                        s = "of-type" === t;
                    return 1 === r && 0 === i ?
                    function (e) {
                        return !!e.parentNode
                    } : function (t, n, l) {
                        var u, c, p, f, d, h, g = o !== a ? "nextSibling" : "previousSibling",
                            m = t.parentNode,
                            y = s && t.nodeName.toLowerCase(),
                            v = !l && !s;
                        if (m) {
                            if (o) {
                                while (g) {
                                    p = t;
                                    while (p = p[g]) {
                                        if (s ? p.nodeName.toLowerCase() === y : 1 === p.nodeType) {
                                            return !1
                                        }
                                    }
                                    h = g = "only" === e && !h && "nextSibling"
                                }
                                return !0
                            }
                            if (h = [a ? m.firstChild : m.lastChild], a && v) {
                                c = m[b] || (m[b] = {}), u = c[e] || [], d = u[0] === T && u[1], f = u[0] === T && u[2], p = d && m.childNodes[d];
                                while (p = ++d && p && p[g] || (f = d = 0) || h.pop()) {
                                    if (1 === p.nodeType && ++f && p === t) {
                                        c[e] = [T, d, f];
                                        break
                                    }
                                }
                            } else {
                                if (v && (u = (t[b] || (t[b] = {}))[e]) && u[0] === T) {
                                    f = u[1]
                                } else {
                                    while (p = ++d && p && p[g] || (f = d = 0) || h.pop()) {
                                        if ((s ? p.nodeName.toLowerCase() === y : 1 === p.nodeType) && ++f && (v && ((p[b] || (p[b] = {}))[e] = [T, f]), p === t)) {
                                            break
                                        }
                                    }
                                }
                            }
                            return f -= i, f === r || 0 === f % r && f / r >= 0
                        }
                    }
                },
                PSEUDO: function (e, t) {
                    var n, r = o.pseudos[e] || o.setFilters[e.toLowerCase()] || at.error("unsupported pseudo: " + e);
                    return r[b] ? r(t) : r.length > 1 ? (n = [e, e, "", t], o.setFilters.hasOwnProperty(e.toLowerCase()) ? lt(function (e, n) {
                        var i, o = r(e, t),
                            a = o.length;
                        while (a--) {
                            i = F.call(e, o[a]), e[i] = !(n[i] = o[a])
                        }
                    }) : function (e) {
                        return r(e, 0, n)
                    }) : r
                }
            },
            pseudos: {
                not: lt(function (e) {
                    var t = [],
                        n = [],
                        r = l(e.replace(z, "$1"));
                    return r[b] ? lt(function (e, t, n, i) {
                        var o, a = r(e, null, i, []),
                            s = e.length;
                        while (s--) {
                            (o = a[s]) && (e[s] = !(t[s] = o))
                        }
                    }) : function (e, i, o) {
                        return t[0] = e, r(t, null, o, n), !n.pop()
                    }
                }),
                has: lt(function (e) {
                    return function (t) {
                        return at(e, t).length > 0
                    }
                }),
                contains: lt(function (e) {
                    return function (t) {
                        return (t.textContent || t.innerText || a(t)).indexOf(e) > -1
                    }
                }),
                lang: lt(function (e) {
                    return G.test(e || "") || at.error("unsupported lang: " + e), e = e.replace(rt, it).toLowerCase(), function (t) {
                        var n;
                        do {
                            if (n = h ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")) {
                                return n = n.toLowerCase(), n === e || 0 === n.indexOf(e + "-")
                            }
                        } while ((t = t.parentNode) && 1 === t.nodeType);
                        return !1
                    }
                }),
                target: function (t) {
                    var n = e.location && e.location.hash;
                    return n && n.slice(1) === t.id
                },
                root: function (e) {
                    return e === d
                },
                focus: function (e) {
                    return e === f.activeElement && (!f.hasFocus || f.hasFocus()) && !! (e.type || e.href || ~e.tabIndex)
                },
                enabled: function (e) {
                    return e.disabled === !1
                },
                disabled: function (e) {
                    return e.disabled === !0
                },
                checked: function (e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && !! e.checked || "option" === t && !! e.selected
                },
                selected: function (e) {
                    return e.parentNode && e.parentNode.selectedIndex, e.selected === !0
                },
                empty: function (e) {
                    for (e = e.firstChild; e; e = e.nextSibling) {
                        if (e.nodeName > "@" || 3 === e.nodeType || 4 === e.nodeType) {
                            return !1
                        }
                    }
                    return !0
                },
                parent: function (e) {
                    return !o.pseudos.empty(e)
                },
                header: function (e) {
                    return tt.test(e.nodeName)
                },
                input: function (e) {
                    return et.test(e.nodeName)
                },
                button: function (e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && "button" === e.type || "button" === t
                },
                text: function (e) {
                    var t;
                    return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || t.toLowerCase() === e.type)
                },
                first: ht(function () {
                    return [0]
                }),
                last: ht(function (e, t) {
                    return [t - 1]
                }),
                eq: ht(function (e, t, n) {
                    return [0 > n ? n + t : n]
                }),
                even: ht(function (e, t) {
                    var n = 0;
                    for (; t > n; n += 2) {
                        e.push(n)
                    }
                    return e
                }),
                odd: ht(function (e, t) {
                    var n = 1;
                    for (; t > n; n += 2) {
                        e.push(n)
                    }
                    return e
                }),
                lt: ht(function (e, t, n) {
                    var r = 0 > n ? n + t : n;
                    for (; --r >= 0;) {
                        e.push(r)
                    }
                    return e
                }),
                gt: ht(function (e, t, n) {
                    var r = 0 > n ? n + t : n;
                    for (; t > ++r;) {
                        e.push(r)
                    }
                    return e
                })
            }
        }, o.pseudos.nth = o.pseudos.eq;
        for (n in {
            radio: !0,
            checkbox: !0,
            file: !0,
            password: !0,
            image: !0
        }) {
            o.pseudos[n] = ft(n)
        }
        for (n in {
            submit: !0,
            reset: !0
        }) {
            o.pseudos[n] = dt(n)
        }

        function gt() {}
        gt.prototype = o.filters = o.pseudos, o.setFilters = new gt;

        function mt(e, t) {
            var n, r, i, a, s, l, u, c = k[e + " "];
            if (c) {
                return t ? 0 : c.slice(0)
            }
            s = e, l = [], u = o.preFilter;
            while (s) {
                (!n || (r = X.exec(s))) && (r && (s = s.slice(r[0].length) || s), l.push(i = [])), n = !1, (r = U.exec(s)) && (n = r.shift(), i.push({
                    value: n,
                    type: r[0].replace(z, " ")
                }), s = s.slice(n.length));
                for (a in o.filter) {
                    !(r = Q[a].exec(s)) || u[a] && !(r = u[a](r)) || (n = r.shift(), i.push({
                        value: n,
                        type: a,
                        matches: r
                    }), s = s.slice(n.length))
                }
                if (!n) {
                    break
                }
            }
            return t ? s.length : s ? at.error(e) : k(e, l).slice(0)
        }

        function yt(e) {
            var t = 0,
                n = e.length,
                r = "";
            for (; n > t; t++) {
                r += e[t].value
            }
            return r
        }

        function vt(e, t, n) {
            var r = t.dir,
                o = n && "parentNode" === r,
                a = C++;
            return t.first ?
            function (t, n, i) {
                while (t = t[r]) {
                    if (1 === t.nodeType || o) {
                        return e(t, n, i)
                    }
                }
            } : function (t, n, s) {
                var l, u, c, p = T + " " + a;
                if (s) {
                    while (t = t[r]) {
                        if ((1 === t.nodeType || o) && e(t, n, s)) {
                            return !0
                        }
                    }
                } else {
                    while (t = t[r]) {
                        if (1 === t.nodeType || o) {
                            if (c = t[b] || (t[b] = {}), (u = c[r]) && u[0] === p) {
                                if ((l = u[1]) === !0 || l === i) {
                                    return l === !0
                                }
                            } else {
                                if (u = c[r] = [p], u[1] = e(t, n, s) || i, u[1] === !0) {
                                    return !0
                                }
                            }
                        }
                    }
                }
            }
        }

        function bt(e) {
            return e.length > 1 ?
            function (t, n, r) {
                var i = e.length;
                while (i--) {
                    if (!e[i](t, n, r)) {
                        return !1
                    }
                }
                return !0
            } : e[0]
        }

        function xt(e, t, n, r, i) {
            var o, a = [],
                s = 0,
                l = e.length,
                u = null != t;
            for (; l > s; s++) {
                (o = e[s]) && (!n || n(o, r, i)) && (a.push(o), u && t.push(s))
            }
            return a
        }

        function wt(e, t, n, r, i, o) {
            return r && !r[b] && (r = wt(r)), i && !i[b] && (i = wt(i, o)), lt(function (o, a, s, l) {
                var u, c, p, f = [],
                    d = [],
                    h = a.length,
                    g = o || Nt(t || "*", s.nodeType ? [s] : s, []),
                    m = !e || !o && t ? g : xt(g, f, e, s, l),
                    y = n ? i || (o ? e : h || r) ? [] : a : m;
                if (n && n(m, y, s, l), r) {
                    u = xt(y, d), r(u, [], s, l), c = u.length;
                    while (c--) {
                        (p = u[c]) && (y[d[c]] = !(m[d[c]] = p))
                    }
                }
                if (o) {
                    if (i || e) {
                        if (i) {
                            u = [], c = y.length;
                            while (c--) {
                                (p = y[c]) && u.push(m[c] = p)
                            }
                            i(null, y = [], u, l)
                        }
                        c = y.length;
                        while (c--) {
                            (p = y[c]) && (u = i ? F.call(o, p) : f[c]) > -1 && (o[u] = !(a[u] = p))
                        }
                    }
                } else {
                    y = xt(y === a ? y.splice(h, y.length) : y), i ? i(null, a, y, l) : M.apply(a, y)
                }
            })
        }

        function Tt(e) {
            var t, n, r, i = e.length,
                a = o.relative[e[0].type],
                s = a || o.relative[" "],
                l = a ? 1 : 0,
                c = vt(function (e) {
                    return e === t
                }, s, !0),
                p = vt(function (e) {
                    return F.call(t, e) > -1
                }, s, !0),
                f = [function (e, n, r) {
                    return !a && (r || n !== u) || ((t = n).nodeType ? c(e, n, r) : p(e, n, r))
                }];
            for (; i > l; l++) {
                if (n = o.relative[e[l].type]) {
                    f = [vt(bt(f), n)]
                } else {
                    if (n = o.filter[e[l].type].apply(null, e[l].matches), n[b]) {
                        for (r = ++l; i > r; r++) {
                            if (o.relative[e[r].type]) {
                                break
                            }
                        }
                        return wt(l > 1 && bt(f), l > 1 && yt(e.slice(0, l - 1).concat({
                            value: " " === e[l - 2].type ? "*" : ""
                        })).replace(z, "$1"), n, r > l && Tt(e.slice(l, r)), i > r && Tt(e = e.slice(r)), i > r && yt(e))
                    }
                    f.push(n)
                }
            }
            return bt(f)
        }

        function Ct(e, t) {
            var n = 0,
                r = t.length > 0,
                a = e.length > 0,
                s = function (s, l, c, p, d) {
                    var h, g, m, y = [],
                        v = 0,
                        b = "0",
                        x = s && [],
                        w = null != d,
                        C = u,
                        N = s || a && o.find.TAG("*", d && l.parentNode || l),
                        k = T += null == C ? 1 : Math.random() || 0.1;
                    for (w && (u = l !== f && l, i = n); null != (h = N[b]); b++) {
                        if (a && h) {
                            g = 0;
                            while (m = e[g++]) {
                                if (m(h, l, c)) {
                                    p.push(h);
                                    break
                                }
                            }
                            w && (T = k, i = ++n)
                        }
                        r && ((h = !m && h) && v--, s && x.push(h))
                    }
                    if (v += b, r && b !== v) {
                        g = 0;
                        while (m = t[g++]) {
                            m(x, y, l, c)
                        }
                        if (s) {
                            if (v > 0) {
                                while (b--) {
                                    x[b] || y[b] || (y[b] = q.call(p))
                                }
                            }
                            y = xt(y)
                        }
                        M.apply(p, y), w && !s && y.length > 0 && v + t.length > 1 && at.uniqueSort(p)
                    }
                    return w && (T = k, u = C), x
                };
            return r ? lt(s) : s
        }
        l = at.compile = function (e, t) {
            var n, r = [],
                i = [],
                o = E[e + " "];
            if (!o) {
                t || (t = mt(e)), n = t.length;
                while (n--) {
                    o = Tt(t[n]), o[b] ? r.push(o) : i.push(o)
                }
                o = E(e, Ct(i, r))
            }
            return o
        };

        function Nt(e, t, n) {
            var r = 0,
                i = t.length;
            for (; i > r; r++) {
                at(e, t[r], n)
            }
            return n
        }

        function kt(e, t, n, i) {
            var a, s, u, c, p, f = mt(e);
            if (!i && 1 === f.length) {
                if (s = f[0] = f[0].slice(0), s.length > 2 && "ID" === (u = s[0]).type && r.getById && 9 === t.nodeType && h && o.relative[s[1].type]) {
                    if (t = (o.find.ID(u.matches[0].replace(rt, it), t) || [])[0], !t) {
                        return n
                    }
                    e = e.slice(s.shift().value.length)
                }
                a = Q.needsContext.test(e) ? 0 : s.length;
                while (a--) {
                    if (u = s[a], o.relative[c = u.type]) {
                        break
                    }
                    if ((p = o.find[c]) && (i = p(u.matches[0].replace(rt, it), V.test(s[0].type) && t.parentNode || t))) {
                        if (s.splice(a, 1), e = i.length && yt(s), !e) {
                            return M.apply(n, i), n
                        }
                        break
                    }
                }
            }
            return l(e, f)(i, t, !h, n, V.test(e)), n
        }
        r.sortStable = b.split("").sort(A).join("") === b, r.detectDuplicates = S, p(), r.sortDetached = ut(function (e) {
            return 1 & e.compareDocumentPosition(f.createElement("div"))
        }), ut(function (e) {
            return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
        }) || ct("type|href|height|width", function (e, n, r) {
            return r ? t : e.getAttribute(n, "type" === n.toLowerCase() ? 1 : 2)
        }), r.attributes && ut(function (e) {
            return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
        }) || ct("value", function (e, n, r) {
            return r || "input" !== e.nodeName.toLowerCase() ? t : e.defaultValue
        }), ut(function (e) {
            return null == e.getAttribute("disabled")
        }) || ct(B, function (e, n, r) {
            var i;
            return r ? t : (i = e.getAttributeNode(n)) && i.specified ? i.value : e[n] === !0 ? n.toLowerCase() : null
        }), x.find = at, x.expr = at.selectors, x.expr[":"] = x.expr.pseudos, x.unique = at.uniqueSort, x.text = at.getText, x.isXMLDoc = at.isXML, x.contains = at.contains
    }(e);
    var O = {};

    function F(e) {
        var t = O[e] = {};
        return x.each(e.match(T) || [], function (e, n) {
            t[n] = !0
        }), t
    }
    x.Callbacks = function (e) {
        e = "string" == typeof e ? O[e] || F(e) : x.extend({}, e);
        var n, r, i, o, a, s, l = [],
            u = !e.once && [],
            c = function (t) {
                for (r = e.memory && t, i = !0, a = s || 0, s = 0, o = l.length, n = !0; l && o > a; a++) {
                    if (l[a].apply(t[0], t[1]) === !1 && e.stopOnFalse) {
                        r = !1;
                        break
                    }
                }
                n = !1, l && (u ? u.length && c(u.shift()) : r ? l = [] : p.disable())
            },
            p = {
                add: function () {
                    if (l) {
                        var t = l.length;
                        (function i(t) {
                            x.each(t, function (t, n) {
                                var r = x.type(n);
                                "function" === r ? e.unique && p.has(n) || l.push(n) : n && n.length && "string" !== r && i(n)
                            })
                        })(arguments), n ? o = l.length : r && (s = t, c(r))
                    }
                    return this
                },
                remove: function () {
                    return l && x.each(arguments, function (e, t) {
                        var r;
                        while ((r = x.inArray(t, l, r)) > -1) {
                            l.splice(r, 1), n && (o >= r && o--, a >= r && a--)
                        }
                    }), this
                },
                has: function (e) {
                    return e ? x.inArray(e, l) > -1 : !(!l || !l.length)
                },
                empty: function () {
                    return l = [], o = 0, this
                },
                disable: function () {
                    return l = u = r = t, this
                },
                disabled: function () {
                    return !l
                },
                lock: function () {
                    return u = t, r || p.disable(), this
                },
                locked: function () {
                    return !u
                },
                fireWith: function (e, t) {
                    return !l || i && !u || (t = t || [], t = [e, t.slice ? t.slice() : t], n ? u.push(t) : c(t)), this
                },
                fire: function () {
                    return p.fireWith(this, arguments), this
                },
                fired: function () {
                    return !!i
                }
            };
        return p
    }, x.extend({
        Deferred: function (e) {
            var t = [
                ["resolve", "done", x.Callbacks("once memory"), "resolved"],
                ["reject", "fail", x.Callbacks("once memory"), "rejected"],
                ["notify", "progress", x.Callbacks("memory")]
            ],
                n = "pending",
                r = {
                    state: function () {
                        return n
                    },
                    always: function () {
                        return i.done(arguments).fail(arguments), this
                    },
                    then: function () {
                        var e = arguments;
                        return x.Deferred(function (n) {
                            x.each(t, function (t, o) {
                                var a = o[0],
                                    s = x.isFunction(e[t]) && e[t];
                                i[o[1]](function () {
                                    var e = s && s.apply(this, arguments);
                                    e && x.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[a + "With"](this === r ? n.promise() : this, s ? [e] : arguments)
                                })
                            }), e = null
                        }).promise()
                    },
                    promise: function (e) {
                        return null != e ? x.extend(e, r) : r
                    }
                },
                i = {};
            return r.pipe = r.then, x.each(t, function (e, o) {
                var a = o[2],
                    s = o[3];
                r[o[1]] = a.add, s && a.add(function () {
                    n = s
                }, t[1 ^ e][2].disable, t[2][2].lock), i[o[0]] = function () {
                    return i[o[0] + "With"](this === i ? r : this, arguments), this
                }, i[o[0] + "With"] = a.fireWith
            }), r.promise(i), e && e.call(i, i), i
        },
        when: function (e) {
            var t = 0,
                n = g.call(arguments),
                r = n.length,
                i = 1 !== r || e && x.isFunction(e.promise) ? r : 0,
                o = 1 === i ? e : x.Deferred(),
                a = function (e, t, n) {
                    return function (r) {
                        t[e] = this, n[e] = arguments.length > 1 ? g.call(arguments) : r, n === s ? o.notifyWith(t, n) : --i || o.resolveWith(t, n)
                    }
                },
                s, l, u;
            if (r > 1) {
                for (s = Array(r), l = Array(r), u = Array(r); r > t; t++) {
                    n[t] && x.isFunction(n[t].promise) ? n[t].promise().done(a(t, u, n)).fail(o.reject).progress(a(t, l, s)) : --i
                }
            }
            return i || o.resolveWith(u, n), o.promise()
        }
    }), x.support = function (t) {
        var n, r, o, s, l, u, c, p, f, d = a.createElement("div");
        if (d.setAttribute("className", "t"), d.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = d.getElementsByTagName("*") || [], r = d.getElementsByTagName("a")[0], !r || !r.style || !n.length) {
            return t
        }
        s = a.createElement("select"), u = s.appendChild(a.createElement("option")), o = d.getElementsByTagName("input")[0], r.style.cssText = "top:1px;float:left;opacity:.5", t.getSetAttribute = "t" !== d.className, t.leadingWhitespace = 3 === d.firstChild.nodeType, t.tbody = !d.getElementsByTagName("tbody").length, t.htmlSerialize = !! d.getElementsByTagName("link").length, t.style = /top/.test(r.getAttribute("style")), t.hrefNormalized = "/a" === r.getAttribute("href"), t.opacity = /^0.5/.test(r.style.opacity), t.cssFloat = !! r.style.cssFloat, t.checkOn = !! o.value, t.optSelected = u.selected, t.enctype = !! a.createElement("form").enctype, t.html5Clone = "<:nav></:nav>" !== a.createElement("nav").cloneNode(!0).outerHTML, t.inlineBlockNeedsLayout = !1, t.shrinkWrapBlocks = !1, t.pixelPosition = !1, t.deleteExpando = !0, t.noCloneEvent = !0, t.reliableMarginRight = !0, t.boxSizingReliable = !0, o.checked = !0, t.noCloneChecked = o.cloneNode(!0).checked, s.disabled = !0, t.optDisabled = !u.disabled;
        try {
            delete d.test
        } catch (h) {
            t.deleteExpando = !1
        }
        o = a.createElement("input"), o.setAttribute("value", ""), t.input = "" === o.getAttribute("value"), o.value = "t", o.setAttribute("type", "radio"), t.radioValue = "t" === o.value, o.setAttribute("checked", "t"), o.setAttribute("name", "t"), l = a.createDocumentFragment(), l.appendChild(o), t.appendChecked = o.checked, t.checkClone = l.cloneNode(!0).cloneNode(!0).lastChild.checked, d.attachEvent && (d.attachEvent("onclick", function () {
            t.noCloneEvent = !1
        }), d.cloneNode(!0).click());
        for (f in {
            submit: !0,
            change: !0,
            focusin: !0
        }) {
            d.setAttribute(c = "on" + f, "t"), t[f + "Bubbles"] = c in e || d.attributes[c].expando === !1
        }
        d.style.backgroundClip = "content-box", d.cloneNode(!0).style.backgroundClip = "", t.clearCloneStyle = "content-box" === d.style.backgroundClip;
        for (f in x(t)) {
            break
        }
        return t.ownLast = "0" !== f, x(function () {
            var n, r, o, s = "padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;",
                l = a.getElementsByTagName("body")[0];
            l && (n = a.createElement("div"), n.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", l.appendChild(n).appendChild(d), d.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", o = d.getElementsByTagName("td"), o[0].style.cssText = "padding:0;margin:0;border:0;display:none", p = 0 === o[0].offsetHeight, o[0].style.display = "", o[1].style.display = "none", t.reliableHiddenOffsets = p && 0 === o[0].offsetHeight, d.innerHTML = "", d.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", x.swap(l, null != l.style.zoom ? {
                zoom: 1
            } : {}, function () {
                t.boxSizing = 4 === d.offsetWidth
            }), e.getComputedStyle && (t.pixelPosition = "1%" !== (e.getComputedStyle(d, null) || {}).top, t.boxSizingReliable = "4px" === (e.getComputedStyle(d, null) || {
                width: "4px"
            }).width, r = d.appendChild(a.createElement("div")), r.style.cssText = d.style.cssText = s, r.style.marginRight = r.style.width = "0", d.style.width = "1px", t.reliableMarginRight = !parseFloat((e.getComputedStyle(r, null) || {}).marginRight)), typeof d.style.zoom !== i && (d.innerHTML = "", d.style.cssText = s + "width:1px;padding:1px;display:inline;zoom:1", t.inlineBlockNeedsLayout = 3 === d.offsetWidth, d.style.display = "block", d.innerHTML = "<div></div>", d.firstChild.style.width = "5px", t.shrinkWrapBlocks = 3 !== d.offsetWidth, t.inlineBlockNeedsLayout && (l.style.zoom = 1)), l.removeChild(n), n = d = o = r = null)
        }), n = s = l = u = r = o = null, t
    }({});
    var B = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
        P = /([A-Z])/g;

    function R(e, n, r, i) {
        if (x.acceptData(e)) {
            var o, a, s = x.expando,
                l = e.nodeType,
                u = l ? x.cache : e,
                c = l ? e[s] : e[s] && s;
            if (c && u[c] && (i || u[c].data) || r !== t || "string" != typeof n) {
                return c || (c = l ? e[s] = p.pop() || x.guid++ : s), u[c] || (u[c] = l ? {} : {
                    toJSON: x.noop
                }), ("object" == typeof n || "function" == typeof n) && (i ? u[c] = x.extend(u[c], n) : u[c].data = x.extend(u[c].data, n)), a = u[c], i || (a.data || (a.data = {}), a = a.data), r !== t && (a[x.camelCase(n)] = r), "string" == typeof n ? (o = a[n], null == o && (o = a[x.camelCase(n)])) : o = a, o
            }
        }
    }

    function W(e, t, n) {
        if (x.acceptData(e)) {
            var r, i, o = e.nodeType,
                a = o ? x.cache : e,
                s = o ? e[x.expando] : x.expando;
            if (a[s]) {
                if (t && (r = n ? a[s] : a[s].data)) {
                    x.isArray(t) ? t = t.concat(x.map(t, x.camelCase)) : t in r ? t = [t] : (t = x.camelCase(t), t = t in r ? [t] : t.split(" ")), i = t.length;
                    while (i--) {
                        delete r[t[i]]
                    }
                    if (n ? !I(r) : !x.isEmptyObject(r)) {
                        return
                    }
                }(n || (delete a[s].data, I(a[s]))) && (o ? x.cleanData([e], !0) : x.support.deleteExpando || a != a.window ? delete a[s] : a[s] = null)
            }
        }
    }
    x.extend({
        cache: {},
        noData: {
            applet: !0,
            embed: !0,
            object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        },
        hasData: function (e) {
            return e = e.nodeType ? x.cache[e[x.expando]] : e[x.expando], !! e && !I(e)
        },
        data: function (e, t, n) {
            return R(e, t, n)
        },
        removeData: function (e, t) {
            return W(e, t)
        },
        _data: function (e, t, n) {
            return R(e, t, n, !0)
        },
        _removeData: function (e, t) {
            return W(e, t, !0)
        },
        acceptData: function (e) {
            if (e.nodeType && 1 !== e.nodeType && 9 !== e.nodeType) {
                return !1
            }
            var t = e.nodeName && x.noData[e.nodeName.toLowerCase()];
            return !t || t !== !0 && e.getAttribute("classid") === t
        }
    }), x.fn.extend({
        data: function (e, n) {
            var r, i, o = null,
                a = 0,
                s = this[0];
            if (e === t) {
                if (this.length && (o = x.data(s), 1 === s.nodeType && !x._data(s, "parsedAttrs"))) {
                    for (r = s.attributes; r.length > a; a++) {
                        i = r[a].name, 0 === i.indexOf("data-") && (i = x.camelCase(i.slice(5)), $(s, i, o[i]))
                    }
                    x._data(s, "parsedAttrs", !0)
                }
                return o
            }
            return "object" == typeof e ? this.each(function () {
                x.data(this, e)
            }) : arguments.length > 1 ? this.each(function () {
                x.data(this, e, n)
            }) : s ? $(s, e, x.data(s, e)) : null
        },
        removeData: function (e) {
            return this.each(function () {
                x.removeData(this, e)
            })
        }
    });

    function $(e, n, r) {
        if (r === t && 1 === e.nodeType) {
            var i = "data-" + n.replace(P, "-$1").toLowerCase();
            if (r = e.getAttribute(i), "string" == typeof r) {
                try {
                    r = "true" === r ? !0 : "false" === r ? !1 : "null" === r ? null : +r + "" === r ? +r : B.test(r) ? x.parseJSON(r) : r
                } catch (o) {}
                x.data(e, n, r)
            } else {
                r = t
            }
        }
        return r
    }

    function I(e) {
        var t;
        for (t in e) {
            if (("data" !== t || !x.isEmptyObject(e[t])) && "toJSON" !== t) {
                return !1
            }
        }
        return !0
    }
    x.extend({
        queue: function (e, n, r) {
            var i;
            return e ? (n = (n || "fx") + "queue", i = x._data(e, n), r && (!i || x.isArray(r) ? i = x._data(e, n, x.makeArray(r)) : i.push(r)), i || []) : t
        },
        dequeue: function (e, t) {
            t = t || "fx";
            var n = x.queue(e, t),
                r = n.length,
                i = n.shift(),
                o = x._queueHooks(e, t),
                a = function () {
                    x.dequeue(e, t)
                };
            "inprogress" === i && (i = n.shift(), r--), i && ("fx" === t && n.unshift("inprogress"), delete o.stop, i.call(e, a, o)), !r && o && o.empty.fire()
        },
        _queueHooks: function (e, t) {
            var n = t + "queueHooks";
            return x._data(e, n) || x._data(e, n, {
                empty: x.Callbacks("once memory").add(function () {
                    x._removeData(e, t + "queue"), x._removeData(e, n)
                })
            })
        }
    }), x.fn.extend({
        queue: function (e, n) {
            var r = 2;
            return "string" != typeof e && (n = e, e = "fx", r--), r > arguments.length ? x.queue(this[0], e) : n === t ? this : this.each(function () {
                var t = x.queue(this, e, n);
                x._queueHooks(this, e), "fx" === e && "inprogress" !== t[0] && x.dequeue(this, e)
            })
        },
        dequeue: function (e) {
            return this.each(function () {
                x.dequeue(this, e)
            })
        },
        delay: function (e, t) {
            return e = x.fx ? x.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function (t, n) {
                var r = setTimeout(t, e);
                n.stop = function () {
                    clearTimeout(r)
                }
            })
        },
        clearQueue: function (e) {
            return this.queue(e || "fx", [])
        },
        promise: function (e, n) {
            var r, i = 1,
                o = x.Deferred(),
                a = this,
                s = this.length,
                l = function () {
                    --i || o.resolveWith(a, [a])
                };
            "string" != typeof e && (n = e, e = t), e = e || "fx";
            while (s--) {
                r = x._data(a[s], e + "queueHooks"), r && r.empty && (i++, r.empty.add(l))
            }
            return l(), o.promise(n)
        }
    });
    var z, X, U = /[\t\r\n\f]/g,
        V = /\r/g,
        Y = /^(?:input|select|textarea|button|object)$/i,
        J = /^(?:a|area)$/i,
        G = /^(?:checked|selected)$/i,
        Q = x.support.getSetAttribute,
        K = x.support.input;
    x.fn.extend({
        attr: function (e, t) {
            return x.access(this, x.attr, e, t, arguments.length > 1)
        },
        removeAttr: function (e) {
            return this.each(function () {
                x.removeAttr(this, e)
            })
        },
        prop: function (e, t) {
            return x.access(this, x.prop, e, t, arguments.length > 1)
        },
        removeProp: function (e) {
            return e = x.propFix[e] || e, this.each(function () {
                try {
                    this[e] = t, delete this[e]
                } catch (n) {}
            })
        },
        addClass: function (e) {
            var t, n, r, i, o, a = 0,
                s = this.length,
                l = "string" == typeof e && e;
            if (x.isFunction(e)) {
                return this.each(function (t) {
                    x(this).addClass(e.call(this, t, this.className))
                })
            }
            if (l) {
                for (t = (e || "").match(T) || []; s > a; a++) {
                    if (n = this[a], r = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(U, " ") : " ")) {
                        o = 0;
                        while (i = t[o++]) {
                            0 > r.indexOf(" " + i + " ") && (r += i + " ")
                        }
                        n.className = x.trim(r)
                    }
                }
            }
            return this
        },
        removeClass: function (e) {
            var t, n, r, i, o, a = 0,
                s = this.length,
                l = 0 === arguments.length || "string" == typeof e && e;
            if (x.isFunction(e)) {
                return this.each(function (t) {
                    x(this).removeClass(e.call(this, t, this.className))
                })
            }
            if (l) {
                for (t = (e || "").match(T) || []; s > a; a++) {
                    if (n = this[a], r = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(U, " ") : "")) {
                        o = 0;
                        while (i = t[o++]) {
                            while (r.indexOf(" " + i + " ") >= 0) {
                                r = r.replace(" " + i + " ", " ")
                            }
                        }
                        n.className = e ? x.trim(r) : ""
                    }
                }
            }
            return this
        },
        toggleClass: function (e, t) {
            var n = typeof e;
            return "boolean" == typeof t && "string" === n ? t ? this.addClass(e) : this.removeClass(e) : x.isFunction(e) ? this.each(function (n) {
                x(this).toggleClass(e.call(this, n, this.className, t), t)
            }) : this.each(function () {
                if ("string" === n) {
                    var t, r = 0,
                        o = x(this),
                        a = e.match(T) || [];
                    while (t = a[r++]) {
                        o.hasClass(t) ? o.removeClass(t) : o.addClass(t)
                    }
                } else {
                    (n === i || "boolean" === n) && (this.className && x._data(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : x._data(this, "__className__") || "")
                }
            })
        },
        hasClass: function (e) {
            var t = " " + e + " ",
                n = 0,
                r = this.length;
            for (; r > n; n++) {
                if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(U, " ").indexOf(t) >= 0) {
                    return !0
                }
            }
            return !1
        },
        val: function (e) {
            var n, r, i, o = this[0];
            if (arguments.length) {
                return i = x.isFunction(e), this.each(function (n) {
                    var o;
                    1 === this.nodeType && (o = i ? e.call(this, n, x(this).val()) : e, null == o ? o = "" : "number" == typeof o ? o += "" : x.isArray(o) && (o = x.map(o, function (e) {
                        return null == e ? "" : e + ""
                    })), r = x.valHooks[this.type] || x.valHooks[this.nodeName.toLowerCase()], r && "set" in r && r.set(this, o, "value") !== t || (this.value = o))
                })
            }
            if (o) {
                return r = x.valHooks[o.type] || x.valHooks[o.nodeName.toLowerCase()], r && "get" in r && (n = r.get(o, "value")) !== t ? n : (n = o.value, "string" == typeof n ? n.replace(V, "") : null == n ? "" : n)
            }
        }
    }), x.extend({
        valHooks: {
            option: {
                get: function (e) {
                    var t = x.find.attr(e, "value");
                    return null != t ? t : e.text
                }
            },
            select: {
                get: function (e) {
                    var t, n, r = e.options,
                        i = e.selectedIndex,
                        o = "select-one" === e.type || 0 > i,
                        a = o ? null : [],
                        s = o ? i + 1 : r.length,
                        l = 0 > i ? s : o ? i : 0;
                    for (; s > l; l++) {
                        if (n = r[l], !(!n.selected && l !== i || (x.support.optDisabled ? n.disabled : null !== n.getAttribute("disabled")) || n.parentNode.disabled && x.nodeName(n.parentNode, "optgroup"))) {
                            if (t = x(n).val(), o) {
                                return t
                            }
                            a.push(t)
                        }
                    }
                    return a
                },
                set: function (e, t) {
                    var n, r, i = e.options,
                        o = x.makeArray(t),
                        a = i.length;
                    while (a--) {
                        r = i[a], (r.selected = x.inArray(x(r).val(), o) >= 0) && (n = !0)
                    }
                    return n || (e.selectedIndex = -1), o
                }
            }
        },
        attr: function (e, n, r) {
            var o, a, s = e.nodeType;
            if (e && 3 !== s && 8 !== s && 2 !== s) {
                return typeof e.getAttribute === i ? x.prop(e, n, r) : (1 === s && x.isXMLDoc(e) || (n = n.toLowerCase(), o = x.attrHooks[n] || (x.expr.match.bool.test(n) ? X : z)), r === t ? o && "get" in o && null !== (a = o.get(e, n)) ? a : (a = x.find.attr(e, n), null == a ? t : a) : null !== r ? o && "set" in o && (a = o.set(e, r, n)) !== t ? a : (e.setAttribute(n, r + ""), r) : (x.removeAttr(e, n), t))
            }
        },
        removeAttr: function (e, t) {
            var n, r, i = 0,
                o = t && t.match(T);
            if (o && 1 === e.nodeType) {
                while (n = o[i++]) {
                    r = x.propFix[n] || n, x.expr.match.bool.test(n) ? K && Q || !G.test(n) ? e[r] = !1 : e[x.camelCase("default-" + n)] = e[r] = !1 : x.attr(e, n, ""), e.removeAttribute(Q ? n : r)
                }
            }
        },
        attrHooks: {
            type: {
                set: function (e, t) {
                    if (!x.support.radioValue && "radio" === t && x.nodeName(e, "input")) {
                        var n = e.value;
                        return e.setAttribute("type", t), n && (e.value = n), t
                    }
                }
            }
        },
        propFix: {
            "for": "htmlFor",
            "class": "className"
        },
        prop: function (e, n, r) {
            var i, o, a, s = e.nodeType;
            if (e && 3 !== s && 8 !== s && 2 !== s) {
                return a = 1 !== s || !x.isXMLDoc(e), a && (n = x.propFix[n] || n, o = x.propHooks[n]), r !== t ? o && "set" in o && (i = o.set(e, r, n)) !== t ? i : e[n] = r : o && "get" in o && null !== (i = o.get(e, n)) ? i : e[n]
            }
        },
        propHooks: {
            tabIndex: {
                get: function (e) {
                    var t = x.find.attr(e, "tabindex");
                    return t ? parseInt(t, 10) : Y.test(e.nodeName) || J.test(e.nodeName) && e.href ? 0 : -1
                }
            }
        }
    }), X = {
        set: function (e, t, n) {
            return t === !1 ? x.removeAttr(e, n) : K && Q || !G.test(n) ? e.setAttribute(!Q && x.propFix[n] || n, n) : e[x.camelCase("default-" + n)] = e[n] = !0, n
        }
    }, x.each(x.expr.match.bool.source.match(/\w+/g), function (e, n) {
        var r = x.expr.attrHandle[n] || x.find.attr;
        x.expr.attrHandle[n] = K && Q || !G.test(n) ?
        function (e, n, i) {
            var o = x.expr.attrHandle[n],
                a = i ? t : (x.expr.attrHandle[n] = t) != r(e, n, i) ? n.toLowerCase() : null;
            return x.expr.attrHandle[n] = o, a
        } : function (e, n, r) {
            return r ? t : e[x.camelCase("default-" + n)] ? n.toLowerCase() : null
        }
    }), K && Q || (x.attrHooks.value = {
        set: function (e, n, r) {
            return x.nodeName(e, "input") ? (e.defaultValue = n, t) : z && z.set(e, n, r)
        }
    }), Q || (z = {
        set: function (e, n, r) {
            var i = e.getAttributeNode(r);
            return i || e.setAttributeNode(i = e.ownerDocument.createAttribute(r)), i.value = n += "", "value" === r || n === e.getAttribute(r) ? n : t
        }
    }, x.expr.attrHandle.id = x.expr.attrHandle.name = x.expr.attrHandle.coords = function (e, n, r) {
        var i;
        return r ? t : (i = e.getAttributeNode(n)) && "" !== i.value ? i.value : null
    }, x.valHooks.button = {
        get: function (e, n) {
            var r = e.getAttributeNode(n);
            return r && r.specified ? r.value : t
        },
        set: z.set
    }, x.attrHooks.contenteditable = {
        set: function (e, t, n) {
            z.set(e, "" === t ? !1 : t, n)
        }
    }, x.each(["width", "height"], function (e, n) {
        x.attrHooks[n] = {
            set: function (e, r) {
                return "" === r ? (e.setAttribute(n, "auto"), r) : t
            }
        }
    })), x.support.hrefNormalized || x.each(["href", "src"], function (e, t) {
        x.propHooks[t] = {
            get: function (e) {
                return e.getAttribute(t, 4)
            }
        }
    }), x.support.style || (x.attrHooks.style = {
        get: function (e) {
            return e.style.cssText || t
        },
        set: function (e, t) {
            return e.style.cssText = t + ""
        }
    }), x.support.optSelected || (x.propHooks.selected = {
        get: function (e) {
            var t = e.parentNode;
            return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null
        }
    }), x.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
        x.propFix[this.toLowerCase()] = this
    }), x.support.enctype || (x.propFix.enctype = "encoding"), x.each(["radio", "checkbox"], function () {
        x.valHooks[this] = {
            set: function (e, n) {
                return x.isArray(n) ? e.checked = x.inArray(x(e).val(), n) >= 0 : t
            }
        }, x.support.checkOn || (x.valHooks[this].get = function (e) {
            return null === e.getAttribute("value") ? "on" : e.value
        })
    });
    var Z = /^(?:input|select|textarea)$/i,
        et = /^key/,
        tt = /^(?:mouse|contextmenu)|click/,
        nt = /^(?:focusinfocus|focusoutblur)$/,
        rt = /^([^.]*)(?:\.(.+)|)$/;

    function it() {
        return !0
    }

    function ot() {
        return !1
    }

    function at() {
        try {
            return a.activeElement
        } catch (e) {}
    }
    x.event = {
        global: {},
        add: function (e, n, r, o, a) {
            var s, l, u, c, p, f, d, h, g, m, y, v = x._data(e);
            if (v) {
                r.handler && (c = r, r = c.handler, a = c.selector), r.guid || (r.guid = x.guid++), (l = v.events) || (l = v.events = {}), (f = v.handle) || (f = v.handle = function (e) {
                    return typeof x === i || e && x.event.triggered === e.type ? t : x.event.dispatch.apply(f.elem, arguments)
                }, f.elem = e), n = (n || "").match(T) || [""], u = n.length;
                while (u--) {
                    s = rt.exec(n[u]) || [], g = y = s[1], m = (s[2] || "").split(".").sort(), g && (p = x.event.special[g] || {}, g = (a ? p.delegateType : p.bindType) || g, p = x.event.special[g] || {}, d = x.extend({
                        type: g,
                        origType: y,
                        data: o,
                        handler: r,
                        guid: r.guid,
                        selector: a,
                        needsContext: a && x.expr.match.needsContext.test(a),
                        namespace: m.join(".")
                    }, c), (h = l[g]) || (h = l[g] = [], h.delegateCount = 0, p.setup && p.setup.call(e, o, m, f) !== !1 || (e.addEventListener ? e.addEventListener(g, f, !1) : e.attachEvent && e.attachEvent("on" + g, f))), p.add && (p.add.call(e, d), d.handler.guid || (d.handler.guid = r.guid)), a ? h.splice(h.delegateCount++, 0, d) : h.push(d), x.event.global[g] = !0)
                }
                e = null
            }
        },
        remove: function (e, t, n, r, i) {
            var o, a, s, l, u, c, p, f, d, h, g, m = x.hasData(e) && x._data(e);
            if (m && (c = m.events)) {
                t = (t || "").match(T) || [""], u = t.length;
                while (u--) {
                    if (s = rt.exec(t[u]) || [], d = g = s[1], h = (s[2] || "").split(".").sort(), d) {
                        p = x.event.special[d] || {}, d = (r ? p.delegateType : p.bindType) || d, f = c[d] || [], s = s[2] && RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), l = o = f.length;
                        while (o--) {
                            a = f[o], !i && g !== a.origType || n && n.guid !== a.guid || s && !s.test(a.namespace) || r && r !== a.selector && ("**" !== r || !a.selector) || (f.splice(o, 1), a.selector && f.delegateCount--, p.remove && p.remove.call(e, a))
                        }
                        l && !f.length && (p.teardown && p.teardown.call(e, h, m.handle) !== !1 || x.removeEvent(e, d, m.handle), delete c[d])
                    } else {
                        for (d in c) {
                            x.event.remove(e, d + t[u], n, r, !0)
                        }
                    }
                }
                x.isEmptyObject(c) && (delete m.handle, x._removeData(e, "events"))
            }
        },
        trigger: function (n, r, i, o) {
            var s, l, u, c, p, f, d, h = [i || a],
                g = v.call(n, "type") ? n.type : n,
                m = v.call(n, "namespace") ? n.namespace.split(".") : [];
            if (u = f = i = i || a, 3 !== i.nodeType && 8 !== i.nodeType && !nt.test(g + x.event.triggered) && (g.indexOf(".") >= 0 && (m = g.split("."), g = m.shift(), m.sort()), l = 0 > g.indexOf(":") && "on" + g, n = n[x.expando] ? n : new x.Event(g, "object" == typeof n && n), n.isTrigger = o ? 2 : 3, n.namespace = m.join("."), n.namespace_re = n.namespace ? RegExp("(^|\\.)" + m.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, n.result = t, n.target || (n.target = i), r = null == r ? [n] : x.makeArray(r, [n]), p = x.event.special[g] || {}, o || !p.trigger || p.trigger.apply(i, r) !== !1)) {
                if (!o && !p.noBubble && !x.isWindow(i)) {
                    for (c = p.delegateType || g, nt.test(c + g) || (u = u.parentNode); u; u = u.parentNode) {
                        h.push(u), f = u
                    }
                    f === (i.ownerDocument || a) && h.push(f.defaultView || f.parentWindow || e)
                }
                d = 0;
                while ((u = h[d++]) && !n.isPropagationStopped()) {
                    n.type = d > 1 ? c : p.bindType || g, s = (x._data(u, "events") || {})[n.type] && x._data(u, "handle"), s && s.apply(u, r), s = l && u[l], s && x.acceptData(u) && s.apply && s.apply(u, r) === !1 && n.preventDefault()
                }
                if (n.type = g, !o && !n.isDefaultPrevented() && (!p._default || p._default.apply(h.pop(), r) === !1) && x.acceptData(i) && l && i[g] && !x.isWindow(i)) {
                    f = i[l], f && (i[l] = null), x.event.triggered = g;
                    try {
                        i[g]()
                    } catch (y) {}
                    x.event.triggered = t, f && (i[l] = f)
                }
                return n.result
            }
        },
        dispatch: function (e) {
            e = x.event.fix(e);
            var n, r, i, o, a, s = [],
                l = g.call(arguments),
                u = (x._data(this, "events") || {})[e.type] || [],
                c = x.event.special[e.type] || {};
            if (l[0] = e, e.delegateTarget = this, !c.preDispatch || c.preDispatch.call(this, e) !== !1) {
                s = x.event.handlers.call(this, e, u), n = 0;
                while ((o = s[n++]) && !e.isPropagationStopped()) {
                    e.currentTarget = o.elem, a = 0;
                    while ((i = o.handlers[a++]) && !e.isImmediatePropagationStopped()) {
                        (!e.namespace_re || e.namespace_re.test(i.namespace)) && (e.handleObj = i, e.data = i.data, r = ((x.event.special[i.origType] || {}).handle || i.handler).apply(o.elem, l), r !== t && (e.result = r) === !1 && (e.preventDefault(), e.stopPropagation()))
                    }
                }
                return c.postDispatch && c.postDispatch.call(this, e), e.result
            }
        },
        handlers: function (e, n) {
            var r, i, o, a, s = [],
                l = n.delegateCount,
                u = e.target;
            if (l && u.nodeType && (!e.button || "click" !== e.type)) {
                for (; u != this; u = u.parentNode || this) {
                    if (1 === u.nodeType && (u.disabled !== !0 || "click" !== e.type)) {
                        for (o = [], a = 0; l > a; a++) {
                            i = n[a], r = i.selector + " ", o[r] === t && (o[r] = i.needsContext ? x(r, this).index(u) >= 0 : x.find(r, this, null, [u]).length), o[r] && o.push(i)
                        }
                        o.length && s.push({
                            elem: u,
                            handlers: o
                        })
                    }
                }
            }
            return n.length > l && s.push({
                elem: this,
                handlers: n.slice(l)
            }), s
        },
        fix: function (e) {
            if (e[x.expando]) {
                return e
            }
            var t, n, r, i = e.type,
                o = e,
                s = this.fixHooks[i];
            s || (this.fixHooks[i] = s = tt.test(i) ? this.mouseHooks : et.test(i) ? this.keyHooks : {}), r = s.props ? this.props.concat(s.props) : this.props, e = new x.Event(o), t = r.length;
            while (t--) {
                n = r[t], e[n] = o[n]
            }
            return e.target || (e.target = o.srcElement || a), 3 === e.target.nodeType && (e.target = e.target.parentNode), e.metaKey = !! e.metaKey, s.filter ? s.filter(e, o) : e
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "),
            filter: function (e, t) {
                return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode), e
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function (e, n) {
                var r, i, o, s = n.button,
                    l = n.fromElement;
                return null == e.pageX && null != n.clientX && (i = e.target.ownerDocument || a, o = i.documentElement, r = i.body, e.pageX = n.clientX + (o && o.scrollLeft || r && r.scrollLeft || 0) - (o && o.clientLeft || r && r.clientLeft || 0), e.pageY = n.clientY + (o && o.scrollTop || r && r.scrollTop || 0) - (o && o.clientTop || r && r.clientTop || 0)), !e.relatedTarget && l && (e.relatedTarget = l === e.target ? n.toElement : l), e.which || s === t || (e.which = 1 & s ? 1 : 2 & s ? 3 : 4 & s ? 2 : 0), e
            }
        },
        special: {
            load: {
                noBubble: !0
            },
            focus: {
                trigger: function () {
                    if (this !== at() && this.focus) {
                        try {
                            return this.focus(), !1
                        } catch (e) {}
                    }
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function () {
                    return this === at() && this.blur ? (this.blur(), !1) : t
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function () {
                    return x.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : t
                },
                _default: function (e) {
                    return x.nodeName(e.target, "a")
                }
            },
            beforeunload: {
                postDispatch: function (e) {
                    e.result !== t && (e.originalEvent.returnValue = e.result)
                }
            }
        },
        simulate: function (e, t, n, r) {
            var i = x.extend(new x.Event, n, {
                type: e,
                isSimulated: !0,
                originalEvent: {}
            });
            r ? x.event.trigger(i, null, t) : x.event.dispatch.call(t, i), i.isDefaultPrevented() && n.preventDefault()
        }
    }, x.removeEvent = a.removeEventListener ?
    function (e, t, n) {
        e.removeEventListener && e.removeEventListener(t, n, !1)
    } : function (e, t, n) {
        var r = "on" + t;
        e.detachEvent && (typeof e[r] === i && (e[r] = null), e.detachEvent(r, n))
    }, x.Event = function (e, n) {
        return this instanceof x.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || e.returnValue === !1 || e.getPreventDefault && e.getPreventDefault() ? it : ot) : this.type = e, n && x.extend(this, n), this.timeStamp = e && e.timeStamp || x.now(), this[x.expando] = !0, t) : new x.Event(e, n)
    }, x.Event.prototype = {
        isDefaultPrevented: ot,
        isPropagationStopped: ot,
        isImmediatePropagationStopped: ot,
        preventDefault: function () {
            var e = this.originalEvent;
            this.isDefaultPrevented = it, e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
        },
        stopPropagation: function () {
            var e = this.originalEvent;
            this.isPropagationStopped = it, e && (e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0)
        },
        stopImmediatePropagation: function () {
            this.isImmediatePropagationStopped = it, this.stopPropagation()
        }
    }, x.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout"
    }, function (e, t) {
        x.event.special[e] = {
            delegateType: t,
            bindType: t,
            handle: function (e) {
                var n, r = this,
                    i = e.relatedTarget,
                    o = e.handleObj;
                return (!i || i !== r && !x.contains(r, i)) && (e.type = o.origType, n = o.handler.apply(this, arguments), e.type = t), n
            }
        }
    }), x.support.submitBubbles || (x.event.special.submit = {
        setup: function () {
            return x.nodeName(this, "form") ? !1 : (x.event.add(this, "click._submit keypress._submit", function (e) {
                var n = e.target,
                    r = x.nodeName(n, "input") || x.nodeName(n, "button") ? n.form : t;
                r && !x._data(r, "submitBubbles") && (x.event.add(r, "submit._submit", function (e) {
                    e._submit_bubble = !0
                }), x._data(r, "submitBubbles", !0))
            }), t)
        },
        postDispatch: function (e) {
            e._submit_bubble && (delete e._submit_bubble, this.parentNode && !e.isTrigger && x.event.simulate("submit", this.parentNode, e, !0))
        },
        teardown: function () {
            return x.nodeName(this, "form") ? !1 : (x.event.remove(this, "._submit"), t)
        }
    }), x.support.changeBubbles || (x.event.special.change = {
        setup: function () {
            return Z.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (x.event.add(this, "propertychange._change", function (e) {
                "checked" === e.originalEvent.propertyName && (this._just_changed = !0)
            }), x.event.add(this, "click._change", function (e) {
                this._just_changed && !e.isTrigger && (this._just_changed = !1), x.event.simulate("change", this, e, !0)
            })), !1) : (x.event.add(this, "beforeactivate._change", function (e) {
                var t = e.target;
                Z.test(t.nodeName) && !x._data(t, "changeBubbles") && (x.event.add(t, "change._change", function (e) {
                    !this.parentNode || e.isSimulated || e.isTrigger || x.event.simulate("change", this.parentNode, e, !0)
                }), x._data(t, "changeBubbles", !0))
            }), t)
        },
        handle: function (e) {
            var n = e.target;
            return this !== n || e.isSimulated || e.isTrigger || "radio" !== n.type && "checkbox" !== n.type ? e.handleObj.handler.apply(this, arguments) : t
        },
        teardown: function () {
            return x.event.remove(this, "._change"), !Z.test(this.nodeName)
        }
    }), x.support.focusinBubbles || x.each({
        focus: "focusin",
        blur: "focusout"
    }, function (e, t) {
        var n = 0,
            r = function (e) {
                x.event.simulate(t, e.target, x.event.fix(e), !0)
            };
        x.event.special[t] = {
            setup: function () {
                0 === n++ && a.addEventListener(e, r, !0)
            },
            teardown: function () {
                0 === --n && a.removeEventListener(e, r, !0)
            }
        }
    }), x.fn.extend({
        on: function (e, n, r, i, o) {
            var a, s;
            if ("object" == typeof e) {
                "string" != typeof n && (r = r || n, n = t);
                for (a in e) {
                    this.on(a, n, r, e[a], o)
                }
                return this
            }
            if (null == r && null == i ? (i = n, r = n = t) : null == i && ("string" == typeof n ? (i = r, r = t) : (i = r, r = n, n = t)), i === !1) {
                i = ot
            } else {
                if (!i) {
                    return this
                }
            }
            return 1 === o && (s = i, i = function (e) {
                return x().off(e), s.apply(this, arguments)
            }, i.guid = s.guid || (s.guid = x.guid++)), this.each(function () {
                x.event.add(this, e, i, r, n)
            })
        },
        one: function (e, t, n, r) {
            return this.on(e, t, n, r, 1)
        },
        off: function (e, n, r) {
            var i, o;
            if (e && e.preventDefault && e.handleObj) {
                return i = e.handleObj, x(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this
            }
            if ("object" == typeof e) {
                for (o in e) {
                    this.off(o, n, e[o])
                }
                return this
            }
            return (n === !1 || "function" == typeof n) && (r = n, n = t), r === !1 && (r = ot), this.each(function () {
                x.event.remove(this, e, r, n)
            })
        },
        trigger: function (e, t) {
            return this.each(function () {
                x.event.trigger(e, t, this)
            })
        },
        triggerHandler: function (e, n) {
            var r = this[0];
            return r ? x.event.trigger(e, n, r, !0) : t
        }
    });
    var st = /^.[^:#\[\.,]*$/,
        lt = /^(?:parents|prev(?:Until|All))/,
        ut = x.expr.match.needsContext,
        ct = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };
    x.fn.extend({
        find: function (e) {
            var t, n = [],
                r = this,
                i = r.length;
            if ("string" != typeof e) {
                return this.pushStack(x(e).filter(function () {
                    for (t = 0; i > t; t++) {
                        if (x.contains(r[t], this)) {
                            return !0
                        }
                    }
                }))
            }
            for (t = 0; i > t; t++) {
                x.find(e, r[t], n)
            }
            return n = this.pushStack(i > 1 ? x.unique(n) : n), n.selector = this.selector ? this.selector + " " + e : e, n
        },
        has: function (e) {
            var t, n = x(e, this),
                r = n.length;
            return this.filter(function () {
                for (t = 0; r > t; t++) {
                    if (x.contains(this, n[t])) {
                        return !0
                    }
                }
            })
        },
        not: function (e) {
            return this.pushStack(ft(this, e || [], !0))
        },
        filter: function (e) {
            return this.pushStack(ft(this, e || [], !1))
        },
        is: function (e) {
            return !!ft(this, "string" == typeof e && ut.test(e) ? x(e) : e || [], !1).length
        },
        closest: function (e, t) {
            var n, r = 0,
                i = this.length,
                o = [],
                a = ut.test(e) || "string" != typeof e ? x(e, t || this.context) : 0;
            for (; i > r; r++) {
                for (n = this[r]; n && n !== t; n = n.parentNode) {
                    if (11 > n.nodeType && (a ? a.index(n) > -1 : 1 === n.nodeType && x.find.matchesSelector(n, e))) {
                        n = o.push(n);
                        break
                    }
                }
            }
            return this.pushStack(o.length > 1 ? x.unique(o) : o)
        },
        index: function (e) {
            return e ? "string" == typeof e ? x.inArray(this[0], x(e)) : x.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function (e, t) {
            var n = "string" == typeof e ? x(e, t) : x.makeArray(e && e.nodeType ? [e] : e),
                r = x.merge(this.get(), n);
            return this.pushStack(x.unique(r))
        },
        addBack: function (e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    });

    function pt(e, t) {
        do {
            e = e[t]
        } while (e && 1 !== e.nodeType);
        return e
    }
    x.each({
        parent: function (e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        },
        parents: function (e) {
            return x.dir(e, "parentNode")
        },
        parentsUntil: function (e, t, n) {
            return x.dir(e, "parentNode", n)
        },
        next: function (e) {
            return pt(e, "nextSibling")
        },
        prev: function (e) {
            return pt(e, "previousSibling")
        },
        nextAll: function (e) {
            return x.dir(e, "nextSibling")
        },
        prevAll: function (e) {
            return x.dir(e, "previousSibling")
        },
        nextUntil: function (e, t, n) {
            return x.dir(e, "nextSibling", n)
        },
        prevUntil: function (e, t, n) {
            return x.dir(e, "previousSibling", n)
        },
        siblings: function (e) {
            return x.sibling((e.parentNode || {}).firstChild, e)
        },
        children: function (e) {
            return x.sibling(e.firstChild)
        },
        contents: function (e) {
            return x.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : x.merge([], e.childNodes)
        }
    }, function (e, t) {
        x.fn[e] = function (n, r) {
            var i = x.map(this, t, n);
            return "Until" !== e.slice(-5) && (r = n), r && "string" == typeof r && (i = x.filter(r, i)), this.length > 1 && (ct[e] || (i = x.unique(i)), lt.test(e) && (i = i.reverse())), this.pushStack(i)
        }
    }), x.extend({
        filter: function (e, t, n) {
            var r = t[0];
            return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === r.nodeType ? x.find.matchesSelector(r, e) ? [r] : [] : x.find.matches(e, x.grep(t, function (e) {
                return 1 === e.nodeType
            }))
        },
        dir: function (e, n, r) {
            var i = [],
                o = e[n];
            while (o && 9 !== o.nodeType && (r === t || 1 !== o.nodeType || !x(o).is(r))) {
                1 === o.nodeType && i.push(o), o = o[n]
            }
            return i
        },
        sibling: function (e, t) {
            var n = [];
            for (; e; e = e.nextSibling) {
                1 === e.nodeType && e !== t && n.push(e)
            }
            return n
        }
    });

    function ft(e, t, n) {
        if (x.isFunction(t)) {
            return x.grep(e, function (e, r) {
                return !!t.call(e, r, e) !== n
            })
        }
        if (t.nodeType) {
            return x.grep(e, function (e) {
                return e === t !== n
            })
        }
        if ("string" == typeof t) {
            if (st.test(t)) {
                return x.filter(t, e, n)
            }
            t = x.filter(t, e)
        }
        return x.grep(e, function (e) {
            return x.inArray(e, t) >= 0 !== n
        })
    }

    function dt(e) {
        var t = ht.split("|"),
            n = e.createDocumentFragment();
        if (n.createElement) {
            while (t.length) {
                n.createElement(t.pop())
            }
        }
        return n
    }
    var ht = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
        gt = / jQuery\d+="(?:null|\d+)"/g,
        mt = RegExp("<(?:" + ht + ")[\\s/>]", "i"),
        yt = /^\s+/,
        vt = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
        bt = /<([\w:]+)/,
        xt = /<tbody/i,
        wt = /<|&#?\w+;/,
        Tt = /<(?:script|style|link)/i,
        Ct = /^(?:checkbox|radio)$/i,
        Nt = /checked\s*(?:[^=]|=\s*.checked.)/i,
        kt = /^$|\/(?:java|ecma)script/i,
        Et = /^true\/(.*)/,
        St = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
        At = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            area: [1, "<map>", "</map>"],
            param: [1, "<object>", "</object>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: x.support.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
        },
        jt = dt(a),
        Dt = jt.appendChild(a.createElement("div"));
    At.optgroup = At.option, At.tbody = At.tfoot = At.colgroup = At.caption = At.thead, At.th = At.td, x.fn.extend({
        text: function (e) {
            return x.access(this, function (e) {
                return e === t ? x.text(this) : this.empty().append((this[0] && this[0].ownerDocument || a).createTextNode(e))
            }, null, e, arguments.length)
        },
        append: function () {
            return this.domManip(arguments, function (e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = Lt(this, e);
                    t.appendChild(e)
                }
            })
        },
        prepend: function () {
            return this.domManip(arguments, function (e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = Lt(this, e);
                    t.insertBefore(e, t.firstChild)
                }
            })
        },
        before: function () {
            return this.domManip(arguments, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        },
        after: function () {
            return this.domManip(arguments, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        },
        remove: function (e, t) {
            var n, r = e ? x.filter(e, this) : this,
                i = 0;
            for (; null != (n = r[i]); i++) {
                t || 1 !== n.nodeType || x.cleanData(Ft(n)), n.parentNode && (t && x.contains(n.ownerDocument, n) && _t(Ft(n, "script")), n.parentNode.removeChild(n))
            }
            return this
        },
        empty: function () {
            var e, t = 0;
            for (; null != (e = this[t]); t++) {
                1 === e.nodeType && x.cleanData(Ft(e, !1));
                while (e.firstChild) {
                    e.removeChild(e.firstChild)
                }
                e.options && x.nodeName(e, "select") && (e.options.length = 0)
            }
            return this
        },
        clone: function (e, t) {
            return e = null == e ? !1 : e, t = null == t ? e : t, this.map(function () {
                return x.clone(this, e, t)
            })
        },
        html: function (e) {
            return x.access(this, function (e) {
                var n = this[0] || {},
                    r = 0,
                    i = this.length;
                if (e === t) {
                    return 1 === n.nodeType ? n.innerHTML.replace(gt, "") : t
                }
                if (!("string" != typeof e || Tt.test(e) || !x.support.htmlSerialize && mt.test(e) || !x.support.leadingWhitespace && yt.test(e) || At[(bt.exec(e) || ["", ""])[1].toLowerCase()])) {
                    e = e.replace(vt, "<$1></$2>");
                    try {
                        for (; i > r; r++) {
                            n = this[r] || {}, 1 === n.nodeType && (x.cleanData(Ft(n, !1)), n.innerHTML = e)
                        }
                        n = 0
                    } catch (o) {}
                }
                n && this.empty().append(e)
            }, null, e, arguments.length)
        },
        replaceWith: function () {
            var e = x.map(this, function (e) {
                return [e.nextSibling, e.parentNode]
            }),
                t = 0;
            return this.domManip(arguments, function (n) {
                var r = e[t++],
                    i = e[t++];
                i && (r && r.parentNode !== i && (r = this.nextSibling), x(this).remove(), i.insertBefore(n, r))
            }, !0), t ? this : this.remove()
        },
        detach: function (e) {
            return this.remove(e, !0)
        },
        domManip: function (e, t, n) {
            e = d.apply([], e);
            var r, i, o, a, s, l, u = 0,
                c = this.length,
                p = this,
                f = c - 1,
                h = e[0],
                g = x.isFunction(h);
            if (g || !(1 >= c || "string" != typeof h || x.support.checkClone) && Nt.test(h)) {
                return this.each(function (r) {
                    var i = p.eq(r);
                    g && (e[0] = h.call(this, r, i.html())), i.domManip(e, t, n)
                })
            }
            if (c && (l = x.buildFragment(e, this[0].ownerDocument, !1, !n && this), r = l.firstChild, 1 === l.childNodes.length && (l = r), r)) {
                for (a = x.map(Ft(l, "script"), Ht), o = a.length; c > u; u++) {
                    i = l, u !== f && (i = x.clone(i, !0, !0), o && x.merge(a, Ft(i, "script"))), t.call(this[u], i, u)
                }
                if (o) {
                    for (s = a[a.length - 1].ownerDocument, x.map(a, qt), u = 0; o > u; u++) {
                        i = a[u], kt.test(i.type || "") && !x._data(i, "globalEval") && x.contains(s, i) && (i.src ? x._evalUrl(i.src) : x.globalEval((i.text || i.textContent || i.innerHTML || "").replace(St, "")))
                    }
                }
                l = r = null
            }
            return this
        }
    });

    function Lt(e, t) {
        return x.nodeName(e, "table") && x.nodeName(1 === t.nodeType ? t : t.firstChild, "tr") ? e.getElementsByTagName("tbody")[0] || e.appendChild(e.ownerDocument.createElement("tbody")) : e
    }

    function Ht(e) {
        return e.type = (null !== x.find.attr(e, "type")) + "/" + e.type, e
    }

    function qt(e) {
        var t = Et.exec(e.type);
        return t ? e.type = t[1] : e.removeAttribute("type"), e
    }

    function _t(e, t) {
        var n, r = 0;
        for (; null != (n = e[r]); r++) {
            x._data(n, "globalEval", !t || x._data(t[r], "globalEval"))
        }
    }

    function Mt(e, t) {
        if (1 === t.nodeType && x.hasData(e)) {
            var n, r, i, o = x._data(e),
                a = x._data(t, o),
                s = o.events;
            if (s) {
                delete a.handle, a.events = {};
                for (n in s) {
                    for (r = 0, i = s[n].length; i > r; r++) {
                        x.event.add(t, n, s[n][r])
                    }
                }
            }
            a.data && (a.data = x.extend({}, a.data))
        }
    }

    function Ot(e, t) {
        var n, r, i;
        if (1 === t.nodeType) {
            if (n = t.nodeName.toLowerCase(), !x.support.noCloneEvent && t[x.expando]) {
                i = x._data(t);
                for (r in i.events) {
                    x.removeEvent(t, r, i.handle)
                }
                t.removeAttribute(x.expando)
            }
            "script" === n && t.text !== e.text ? (Ht(t).text = e.text, qt(t)) : "object" === n ? (t.parentNode && (t.outerHTML = e.outerHTML), x.support.html5Clone && e.innerHTML && !x.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : "input" === n && Ct.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : "option" === n ? t.defaultSelected = t.selected = e.defaultSelected : ("input" === n || "textarea" === n) && (t.defaultValue = e.defaultValue)
        }
    }
    x.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (e, t) {
        x.fn[e] = function (e) {
            var n, r = 0,
                i = [],
                o = x(e),
                a = o.length - 1;
            for (; a >= r; r++) {
                n = r === a ? this : this.clone(!0), x(o[r])[t](n), h.apply(i, n.get())
            }
            return this.pushStack(i)
        }
    });

    function Ft(e, n) {
        var r, o, a = 0,
            s = typeof e.getElementsByTagName !== i ? e.getElementsByTagName(n || "*") : typeof e.querySelectorAll !== i ? e.querySelectorAll(n || "*") : t;
        if (!s) {
            for (s = [], r = e.childNodes || e; null != (o = r[a]); a++) {
                !n || x.nodeName(o, n) ? s.push(o) : x.merge(s, Ft(o, n))
            }
        }
        return n === t || n && x.nodeName(e, n) ? x.merge([e], s) : s
    }

    function Bt(e) {
        Ct.test(e.type) && (e.defaultChecked = e.checked)
    }
    x.extend({
        clone: function (e, t, n) {
            var r, i, o, a, s, l = x.contains(e.ownerDocument, e);
            if (x.support.html5Clone || x.isXMLDoc(e) || !mt.test("<" + e.nodeName + ">") ? o = e.cloneNode(!0) : (Dt.innerHTML = e.outerHTML, Dt.removeChild(o = Dt.firstChild)), !(x.support.noCloneEvent && x.support.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || x.isXMLDoc(e))) {
                for (r = Ft(o), s = Ft(e), a = 0; null != (i = s[a]); ++a) {
                    r[a] && Ot(i, r[a])
                }
            }
            if (t) {
                if (n) {
                    for (s = s || Ft(e), r = r || Ft(o), a = 0; null != (i = s[a]); a++) {
                        Mt(i, r[a])
                    }
                } else {
                    Mt(e, o)
                }
            }
            return r = Ft(o, "script"), r.length > 0 && _t(r, !l && Ft(e, "script")), r = s = i = null, o
        },
        buildFragment: function (e, t, n, r) {
            var i, o, a, s, l, u, c, p = e.length,
                f = dt(t),
                d = [],
                h = 0;
            for (; p > h; h++) {
                if (o = e[h], o || 0 === o) {
                    if ("object" === x.type(o)) {
                        x.merge(d, o.nodeType ? [o] : o)
                    } else {
                        if (wt.test(o)) {
                            s = s || f.appendChild(t.createElement("div")), l = (bt.exec(o) || ["", ""])[1].toLowerCase(), c = At[l] || At._default, s.innerHTML = c[1] + o.replace(vt, "<$1></$2>") + c[2], i = c[0];
                            while (i--) {
                                s = s.lastChild
                            }
                            if (!x.support.leadingWhitespace && yt.test(o) && d.push(t.createTextNode(yt.exec(o)[0])), !x.support.tbody) {
                                o = "table" !== l || xt.test(o) ? "<table>" !== c[1] || xt.test(o) ? 0 : s : s.firstChild, i = o && o.childNodes.length;
                                while (i--) {
                                    x.nodeName(u = o.childNodes[i], "tbody") && !u.childNodes.length && o.removeChild(u)
                                }
                            }
                            x.merge(d, s.childNodes), s.textContent = "";
                            while (s.firstChild) {
                                s.removeChild(s.firstChild)
                            }
                            s = f.lastChild
                        } else {
                            d.push(t.createTextNode(o))
                        }
                    }
                }
            }
            s && f.removeChild(s), x.support.appendChecked || x.grep(Ft(d, "input"), Bt), h = 0;
            while (o = d[h++]) {
                if ((!r || -1 === x.inArray(o, r)) && (a = x.contains(o.ownerDocument, o), s = Ft(f.appendChild(o), "script"), a && _t(s), n)) {
                    i = 0;
                    while (o = s[i++]) {
                        kt.test(o.type || "") && n.push(o)
                    }
                }
            }
            return s = null, f
        },
        cleanData: function (e, t) {
            var n, r, o, a, s = 0,
                l = x.expando,
                u = x.cache,
                c = x.support.deleteExpando,
                f = x.event.special;
            for (; null != (n = e[s]); s++) {
                if ((t || x.acceptData(n)) && (o = n[l], a = o && u[o])) {
                    if (a.events) {
                        for (r in a.events) {
                            f[r] ? x.event.remove(n, r) : x.removeEvent(n, r, a.handle)
                        }
                    }
                    u[o] && (delete u[o], c ? delete n[l] : typeof n.removeAttribute !== i ? n.removeAttribute(l) : n[l] = null, p.push(o))
                }
            }
        },
        _evalUrl: function (e) {
            return x.ajax({
                url: e,
                type: "GET",
                dataType: "script",
                async: !1,
                global: !1,
                "throws": !0
            })
        }
    }), x.fn.extend({
        wrapAll: function (e) {
            if (x.isFunction(e)) {
                return this.each(function (t) {
                    x(this).wrapAll(e.call(this, t))
                })
            }
            if (this[0]) {
                var t = x(e, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                    var e = this;
                    while (e.firstChild && 1 === e.firstChild.nodeType) {
                        e = e.firstChild
                    }
                    return e
                }).append(this)
            }
            return this
        },
        wrapInner: function (e) {
            return x.isFunction(e) ? this.each(function (t) {
                x(this).wrapInner(e.call(this, t))
            }) : this.each(function () {
                var t = x(this),
                    n = t.contents();
                n.length ? n.wrapAll(e) : t.append(e)
            })
        },
        wrap: function (e) {
            var t = x.isFunction(e);
            return this.each(function (n) {
                x(this).wrapAll(t ? e.call(this, n) : e)
            })
        },
        unwrap: function () {
            return this.parent().each(function () {
                x.nodeName(this, "body") || x(this).replaceWith(this.childNodes)
            }).end()
        }
    });
    var Pt, Rt, Wt, $t = /alpha\([^)]*\)/i,
        It = /opacity\s*=\s*([^)]*)/,
        zt = /^(top|right|bottom|left)$/,
        Xt = /^(none|table(?!-c[ea]).+)/,
        Ut = /^margin/,
        Vt = RegExp("^(" + w + ")(.*)$", "i"),
        Yt = RegExp("^(" + w + ")(?!px)[a-z%]+$", "i"),
        Jt = RegExp("^([+-])=(" + w + ")", "i"),
        Gt = {
            BODY: "block"
        },
        Qt = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        Kt = {
            letterSpacing: 0,
            fontWeight: 400
        },
        Zt = ["Top", "Right", "Bottom", "Left"],
        en = ["Webkit", "O", "Moz", "ms"];

    function tn(e, t) {
        if (t in e) {
            return t
        }
        var n = t.charAt(0).toUpperCase() + t.slice(1),
            r = t,
            i = en.length;
        while (i--) {
            if (t = en[i] + n, t in e) {
                return t
            }
        }
        return r
    }

    function nn(e, t) {
        return e = t || e, "none" === x.css(e, "display") || !x.contains(e.ownerDocument, e)
    }

    function rn(e, t) {
        var n, r, i, o = [],
            a = 0,
            s = e.length;
        for (; s > a; a++) {
            r = e[a], r.style && (o[a] = x._data(r, "olddisplay"), n = r.style.display, t ? (o[a] || "none" !== n || (r.style.display = ""), "" === r.style.display && nn(r) && (o[a] = x._data(r, "olddisplay", ln(r.nodeName)))) : o[a] || (i = nn(r), (n && "none" !== n || !i) && x._data(r, "olddisplay", i ? n : x.css(r, "display"))))
        }
        for (a = 0; s > a; a++) {
            r = e[a], r.style && (t && "none" !== r.style.display && "" !== r.style.display || (r.style.display = t ? o[a] || "" : "none"))
        }
        return e
    }
    x.fn.extend({
        css: function (e, n) {
            return x.access(this, function (e, n, r) {
                var i, o, a = {},
                    s = 0;
                if (x.isArray(n)) {
                    for (o = Rt(e), i = n.length; i > s; s++) {
                        a[n[s]] = x.css(e, n[s], !1, o)
                    }
                    return a
                }
                return r !== t ? x.style(e, n, r) : x.css(e, n)
            }, e, n, arguments.length > 1)
        },
        show: function () {
            return rn(this, !0)
        },
        hide: function () {
            return rn(this)
        },
        toggle: function (e) {
            return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
                nn(this) ? x(this).show() : x(this).hide()
            })
        }
    }), x.extend({
        cssHooks: {
            opacity: {
                get: function (e, t) {
                    if (t) {
                        var n = Wt(e, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {
            "float": x.support.cssFloat ? "cssFloat" : "styleFloat"
        },
        style: function (e, n, r, i) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var o, a, s, l = x.camelCase(n),
                    u = e.style;
                if (n = x.cssProps[l] || (x.cssProps[l] = tn(u, l)), s = x.cssHooks[n] || x.cssHooks[l], r === t) {
                    return s && "get" in s && (o = s.get(e, !1, i)) !== t ? o : u[n]
                }
                if (a = typeof r, "string" === a && (o = Jt.exec(r)) && (r = (o[1] + 1) * o[2] + parseFloat(x.css(e, n)), a = "number"), !(null == r || "number" === a && isNaN(r) || ("number" !== a || x.cssNumber[l] || (r += "px"), x.support.clearCloneStyle || "" !== r || 0 !== n.indexOf("background") || (u[n] = "inherit"), s && "set" in s && (r = s.set(e, r, i)) === t))) {
                    try {
                        u[n] = r
                    } catch (c) {}
                }
            }
        },
        css: function (e, n, r, i) {
            var o, a, s, l = x.camelCase(n);
            return n = x.cssProps[l] || (x.cssProps[l] = tn(e.style, l)), s = x.cssHooks[n] || x.cssHooks[l], s && "get" in s && (a = s.get(e, !0, r)), a === t && (a = Wt(e, n, i)), "normal" === a && n in Kt && (a = Kt[n]), "" === r || r ? (o = parseFloat(a), r === !0 || x.isNumeric(o) ? o || 0 : a) : a
        }
    }), e.getComputedStyle ? (Rt = function (t) {
        return e.getComputedStyle(t, null)
    }, Wt = function (e, n, r) {
        var i, o, a, s = r || Rt(e),
            l = s ? s.getPropertyValue(n) || s[n] : t,
            u = e.style;
        return s && ("" !== l || x.contains(e.ownerDocument, e) || (l = x.style(e, n)), Yt.test(l) && Ut.test(n) && (i = u.width, o = u.minWidth, a = u.maxWidth, u.minWidth = u.maxWidth = u.width = l, l = s.width, u.width = i, u.minWidth = o, u.maxWidth = a)), l
    }) : a.documentElement.currentStyle && (Rt = function (e) {
        return e.currentStyle
    }, Wt = function (e, n, r) {
        var i, o, a, s = r || Rt(e),
            l = s ? s[n] : t,
            u = e.style;
        return null == l && u && u[n] && (l = u[n]), Yt.test(l) && !zt.test(n) && (i = u.left, o = e.runtimeStyle, a = o && o.left, a && (o.left = e.currentStyle.left), u.left = "fontSize" === n ? "1em" : l, l = u.pixelLeft + "px", u.left = i, a && (o.left = a)), "" === l ? "auto" : l
    });

    function on(e, t, n) {
        var r = Vt.exec(t);
        return r ? Math.max(0, r[1] - (n || 0)) + (r[2] || "px") : t
    }

    function an(e, t, n, r, i) {
        var o = n === (r ? "border" : "content") ? 4 : "width" === t ? 1 : 0,
            a = 0;
        for (; 4 > o; o += 2) {
            "margin" === n && (a += x.css(e, n + Zt[o], !0, i)), r ? ("content" === n && (a -= x.css(e, "padding" + Zt[o], !0, i)), "margin" !== n && (a -= x.css(e, "border" + Zt[o] + "Width", !0, i))) : (a += x.css(e, "padding" + Zt[o], !0, i), "padding" !== n && (a += x.css(e, "border" + Zt[o] + "Width", !0, i)))
        }
        return a
    }

    function sn(e, t, n) {
        var r = !0,
            i = "width" === t ? e.offsetWidth : e.offsetHeight,
            o = Rt(e),
            a = x.support.boxSizing && "border-box" === x.css(e, "boxSizing", !1, o);
        if (0 >= i || null == i) {
            if (i = Wt(e, t, o), (0 > i || null == i) && (i = e.style[t]), Yt.test(i)) {
                return i
            }
            r = a && (x.support.boxSizingReliable || i === e.style[t]), i = parseFloat(i) || 0
        }
        return i + an(e, t, n || (a ? "border" : "content"), r, o) + "px"
    }

    function ln(e) {
        var t = a,
            n = Gt[e];
        return n || (n = un(e, t), "none" !== n && n || (Pt = (Pt || x("<iframe frameborder='0' width='0' height='0'/>").css("cssText", "display:block !important")).appendTo(t.documentElement), t = (Pt[0].contentWindow || Pt[0].contentDocument).document, t.write("<!doctype html><html><body>"), t.close(), n = un(e, t), Pt.detach()), Gt[e] = n), n
    }

    function un(e, t) {
        var n = x(t.createElement(e)).appendTo(t.body),
            r = x.css(n[0], "display");
        return n.remove(), r
    }
    x.each(["height", "width"], function (e, n) {
        x.cssHooks[n] = {
            get: function (e, r, i) {
                return r ? 0 === e.offsetWidth && Xt.test(x.css(e, "display")) ? x.swap(e, Qt, function () {
                    return sn(e, n, i)
                }) : sn(e, n, i) : t
            },
            set: function (e, t, r) {
                var i = r && Rt(e);
                return on(e, t, r ? an(e, n, r, x.support.boxSizing && "border-box" === x.css(e, "boxSizing", !1, i), i) : 0)
            }
        }
    }), x.support.opacity || (x.cssHooks.opacity = {
        get: function (e, t) {
            return It.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? 0.01 * parseFloat(RegExp.$1) + "" : t ? "1" : ""
        },
        set: function (e, t) {
            var n = e.style,
                r = e.currentStyle,
                i = x.isNumeric(t) ? "alpha(opacity=" + 100 * t + ")" : "",
                o = r && r.filter || n.filter || "";
            n.zoom = 1, (t >= 1 || "" === t) && "" === x.trim(o.replace($t, "")) && n.removeAttribute && (n.removeAttribute("filter"), "" === t || r && !r.filter) || (n.filter = $t.test(o) ? o.replace($t, i) : o + " " + i)
        }
    }), x(function () {
        x.support.reliableMarginRight || (x.cssHooks.marginRight = {
            get: function (e, n) {
                return n ? x.swap(e, {
                    display: "inline-block"
                }, Wt, [e, "marginRight"]) : t
            }
        }), !x.support.pixelPosition && x.fn.position && x.each(["top", "left"], function (e, n) {
            x.cssHooks[n] = {
                get: function (e, r) {
                    return r ? (r = Wt(e, n), Yt.test(r) ? x(e).position()[n] + "px" : r) : t
                }
            }
        })
    }), x.expr && x.expr.filters && (x.expr.filters.hidden = function (e) {
        return 0 >= e.offsetWidth && 0 >= e.offsetHeight || !x.support.reliableHiddenOffsets && "none" === (e.style && e.style.display || x.css(e, "display"))
    }, x.expr.filters.visible = function (e) {
        return !x.expr.filters.hidden(e)
    }), x.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function (e, t) {
        x.cssHooks[e + t] = {
            expand: function (n) {
                var r = 0,
                    i = {},
                    o = "string" == typeof n ? n.split(" ") : [n];
                for (; 4 > r; r++) {
                    i[e + Zt[r] + t] = o[r] || o[r - 2] || o[0]
                }
                return i
            }
        }, Ut.test(e) || (x.cssHooks[e + t].set = on)
    });
    var cn = /%20/g,
        pn = /\[\]$/,
        fn = /\r?\n/g,
        dn = /^(?:submit|button|image|reset|file)$/i,
        hn = /^(?:input|select|textarea|keygen)/i;
    x.fn.extend({
        serialize: function () {
            return x.param(this.serializeArray())
        },
        serializeArray: function () {
            return this.map(function () {
                var e = x.prop(this, "elements");
                return e ? x.makeArray(e) : this
            }).filter(function () {
                var e = this.type;
                return this.name && !x(this).is(":disabled") && hn.test(this.nodeName) && !dn.test(e) && (this.checked || !Ct.test(e))
            }).map(function (e, t) {
                var n = x(this).val();
                return null == n ? null : x.isArray(n) ? x.map(n, function (e) {
                    return {
                        name: t.name,
                        value: e.replace(fn, "\r\n")
                    }
                }) : {
                    name: t.name,
                    value: n.replace(fn, "\r\n")
                }
            }).get()
        }
    }), x.param = function (e, n) {
        var r, i = [],
            o = function (e, t) {
                t = x.isFunction(t) ? t() : null == t ? "" : t, i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
            };
        if (n === t && (n = x.ajaxSettings && x.ajaxSettings.traditional), x.isArray(e) || e.jquery && !x.isPlainObject(e)) {
            x.each(e, function () {
                o(this.name, this.value)
            })
        } else {
            for (r in e) {
                gn(r, e[r], n, o)
            }
        }
        return i.join("&").replace(cn, "+")
    };

    function gn(e, t, n, r) {
        var i;
        if (x.isArray(t)) {
            x.each(t, function (t, i) {
                n || pn.test(e) ? r(e, i) : gn(e + "[" + ("object" == typeof i ? t : "") + "]", i, n, r)
            })
        } else {
            if (n || "object" !== x.type(t)) {
                r(e, t)
            } else {
                for (i in t) {
                    gn(e + "[" + i + "]", t[i], n, r)
                }
            }
        }
    }
    x.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (e, t) {
        x.fn[t] = function (e, n) {
            return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
        }
    }), x.fn.extend({
        hover: function (e, t) {
            return this.mouseenter(e).mouseleave(t || e)
        },
        bind: function (e, t, n) {
            return this.on(e, null, t, n)
        },
        unbind: function (e, t) {
            return this.off(e, null, t)
        },
        delegate: function (e, t, n, r) {
            return this.on(t, e, n, r)
        },
        undelegate: function (e, t, n) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
        }
    });
    var mn, yn, vn = x.now(),
        bn = /\?/,
        xn = /#.*$/,
        wn = /([?&])_=[^&]*/,
        Tn = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
        Cn = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
        Nn = /^(?:GET|HEAD)$/,
        kn = /^\/\//,
        En = /^([\w.+-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,
        Sn = x.fn.load,
        An = {},
        jn = {},
        Dn = "*/".concat("*");
    try {
        yn = o.href
    } catch (Ln) {
        yn = a.createElement("a"), yn.href = "", yn = yn.href
    }
    mn = En.exec(yn.toLowerCase()) || [];

    function Hn(e) {
        return function (t, n) {
            "string" != typeof t && (n = t, t = "*");
            var r, i = 0,
                o = t.toLowerCase().match(T) || [];
            if (x.isFunction(n)) {
                while (r = o[i++]) {
                    "+" === r[0] ? (r = r.slice(1) || "*", (e[r] = e[r] || []).unshift(n)) : (e[r] = e[r] || []).push(n)
                }
            }
        }
    }

    function qn(e, n, r, i) {
        var o = {},
            a = e === jn;

        function s(l) {
            var u;
            return o[l] = !0, x.each(e[l] || [], function (e, l) {
                var c = l(n, r, i);
                return "string" != typeof c || a || o[c] ? a ? !(u = c) : t : (n.dataTypes.unshift(c), s(c), !1)
            }), u
        }
        return s(n.dataTypes[0]) || !o["*"] && s("*")
    }

    function _n(e, n) {
        var r, i, o = x.ajaxSettings.flatOptions || {};
        for (i in n) {
            n[i] !== t && ((o[i] ? e : r || (r = {}))[i] = n[i])
        }
        return r && x.extend(!0, e, r), e
    }
    x.fn.load = function (e, n, r) {
        if ("string" != typeof e && Sn) {
            return Sn.apply(this, arguments)
        }
        var i, o, a, s = this,
            l = e.indexOf(" ");
        return l >= 0 && (i = e.slice(l, e.length), e = e.slice(0, l)), x.isFunction(n) ? (r = n, n = t) : n && "object" == typeof n && (a = "POST"), s.length > 0 && x.ajax({
            url: e,
            type: a,
            dataType: "html",
            data: n
        }).done(function (e) {
            o = arguments, s.html(i ? x("<div>").append(x.parseHTML(e)).find(i) : e)
        }).complete(r &&
        function (e, t) {
            s.each(r, o || [e.responseText, t, e])
        }), this
    }, x.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
        x.fn[t] = function (e) {
            return this.on(t, e)
        }
    }), x.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: yn,
            type: "GET",
            isLocal: Cn.test(mn[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Dn,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /xml/,
                html: /html/,
                json: /json/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": x.parseJSON,
                "text xml": x.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function (e, t) {
            return t ? _n(_n(e, x.ajaxSettings), t) : _n(x.ajaxSettings, e)
        },
        ajaxPrefilter: Hn(An),
        ajaxTransport: Hn(jn),
        ajax: function (e, n) {
            "object" == typeof e && (n = e, e = t), n = n || {};
            var r, i, o, a, s, l, u, c, p = x.ajaxSetup({}, n),
                f = p.context || p,
                d = p.context && (f.nodeType || f.jquery) ? x(f) : x.event,
                h = x.Deferred(),
                g = x.Callbacks("once memory"),
                m = p.statusCode || {},
                y = {},
                v = {},
                b = 0,
                w = "canceled",
                C = {
                    readyState: 0,
                    getResponseHeader: function (e) {
                        var t;
                        if (2 === b) {
                            if (!c) {
                                c = {};
                                while (t = Tn.exec(a)) {
                                    c[t[1].toLowerCase()] = t[2]
                                }
                            }
                            t = c[e.toLowerCase()]
                        }
                        return null == t ? null : t
                    },
                    getAllResponseHeaders: function () {
                        return 2 === b ? a : null
                    },
                    setRequestHeader: function (e, t) {
                        var n = e.toLowerCase();
                        return b || (e = v[n] = v[n] || e, y[e] = t), this
                    },
                    overrideMimeType: function (e) {
                        return b || (p.mimeType = e), this
                    },
                    statusCode: function (e) {
                        var t;
                        if (e) {
                            if (2 > b) {
                                for (t in e) {
                                    m[t] = [m[t], e[t]]
                                }
                            } else {
                                C.always(e[C.status])
                            }
                        }
                        return this
                    },
                    abort: function (e) {
                        var t = e || w;
                        return u && u.abort(t), k(0, t), this
                    }
                };
            if (h.promise(C).complete = g.add, C.success = C.done, C.error = C.fail, p.url = ((e || p.url || yn) + "").replace(xn, "").replace(kn, mn[1] + "//"), p.type = n.method || n.type || p.method || p.type, p.dataTypes = x.trim(p.dataType || "*").toLowerCase().match(T) || [""], null == p.crossDomain && (r = En.exec(p.url.toLowerCase()), p.crossDomain = !(!r || r[1] === mn[1] && r[2] === mn[2] && (r[3] || ("http:" === r[1] ? "80" : "443")) === (mn[3] || ("http:" === mn[1] ? "80" : "443")))), p.data && p.processData && "string" != typeof p.data && (p.data = x.param(p.data, p.traditional)), qn(An, p, n, C), 2 === b) {
                return C
            }
            l = p.global, l && 0 === x.active++ && x.event.trigger("ajaxStart"), p.type = p.type.toUpperCase(), p.hasContent = !Nn.test(p.type), o = p.url, p.hasContent || (p.data && (o = p.url += (bn.test(o) ? "&" : "?") + p.data, delete p.data), p.cache === !1 && (p.url = wn.test(o) ? o.replace(wn, "$1_=" + vn++) : o + (bn.test(o) ? "&" : "?") + "_=" + vn++)), p.ifModified && (x.lastModified[o] && C.setRequestHeader("If-Modified-Since", x.lastModified[o]), x.etag[o] && C.setRequestHeader("If-None-Match", x.etag[o])), (p.data && p.hasContent && p.contentType !== !1 || n.contentType) && C.setRequestHeader("Content-Type", p.contentType), C.setRequestHeader("Accept", p.dataTypes[0] && p.accepts[p.dataTypes[0]] ? p.accepts[p.dataTypes[0]] + ("*" !== p.dataTypes[0] ? ", " + Dn + "; q=0.01" : "") : p.accepts["*"]);
            for (i in p.headers) {
                C.setRequestHeader(i, p.headers[i])
            }
            if (p.beforeSend && (p.beforeSend.call(f, C, p) === !1 || 2 === b)) {
                return C.abort()
            }
            w = "abort";
            for (i in {
                success: 1,
                error: 1,
                complete: 1
            }) {
                C[i](p[i])
            }
            if (u = qn(jn, p, n, C)) {
                C.readyState = 1, l && d.trigger("ajaxSend", [C, p]), p.async && p.timeout > 0 && (s = setTimeout(function () {
                    C.abort("timeout")
                }, p.timeout));
                try {
                    b = 1, u.send(y, k)
                } catch (N) {
                    if (!(2 > b)) {
                        throw N
                    }
                    k(-1, N)
                }
            } else {
                k(-1, "No Transport")
            }

            function k(e, n, r, i) {
                var c, y, v, w, T, N = n;
                2 !== b && (b = 2, s && clearTimeout(s), u = t, a = i || "", C.readyState = e > 0 ? 4 : 0, c = e >= 200 && 300 > e || 304 === e, r && (w = Mn(p, C, r)), w = On(p, w, C, c), c ? (p.ifModified && (T = C.getResponseHeader("Last-Modified"), T && (x.lastModified[o] = T), T = C.getResponseHeader("etag"), T && (x.etag[o] = T)), 204 === e || "HEAD" === p.type ? N = "nocontent" : 304 === e ? N = "notmodified" : (N = w.state, y = w.data, v = w.error, c = !v)) : (v = N, (e || !N) && (N = "error", 0 > e && (e = 0))), C.status = e, C.statusText = (n || N) + "", c ? h.resolveWith(f, [y, N, C]) : h.rejectWith(f, [C, N, v]), C.statusCode(m), m = t, l && d.trigger(c ? "ajaxSuccess" : "ajaxError", [C, p, c ? y : v]), g.fireWith(f, [C, N]), l && (d.trigger("ajaxComplete", [C, p]), --x.active || x.event.trigger("ajaxStop")))
            }
            return C
        },
        getJSON: function (e, t, n) {
            return x.get(e, t, n, "json")
        },
        getScript: function (e, n) {
            return x.get(e, t, n, "script")
        }
    }), x.each(["get", "post"], function (e, n) {
        x[n] = function (e, r, i, o) {
            return x.isFunction(r) && (o = o || i, i = r, r = t), x.ajax({
                url: e,
                type: n,
                dataType: o,
                data: r,
                success: i
            })
        }
    });

    function Mn(e, n, r) {
        var i, o, a, s, l = e.contents,
            u = e.dataTypes;
        while ("*" === u[0]) {
            u.shift(), o === t && (o = e.mimeType || n.getResponseHeader("Content-Type"))
        }
        if (o) {
            for (s in l) {
                if (l[s] && l[s].test(o)) {
                    u.unshift(s);
                    break
                }
            }
        }
        if (u[0] in r) {
            a = u[0]
        } else {
            for (s in r) {
                if (!u[0] || e.converters[s + " " + u[0]]) {
                    a = s;
                    break
                }
                i || (i = s)
            }
            a = a || i
        }
        return a ? (a !== u[0] && u.unshift(a), r[a]) : t
    }

    function On(e, t, n, r) {
        var i, o, a, s, l, u = {},
            c = e.dataTypes.slice();
        if (c[1]) {
            for (a in e.converters) {
                u[a.toLowerCase()] = e.converters[a]
            }
        }
        o = c.shift();
        while (o) {
            if (e.responseFields[o] && (n[e.responseFields[o]] = t), !l && r && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = o, o = c.shift()) {
                if ("*" === o) {
                    o = l
                } else {
                    if ("*" !== l && l !== o) {
                        if (a = u[l + " " + o] || u["* " + o], !a) {


                            for (i in u) {
                                if (s = i.split(" "), s[1] === o && (a = u[l + " " + s[0]] || u["* " + s[0]])) {
                                    a === !0 ? a = u[i] : u[i] !== !0 && (o = s[0], c.unshift(s[1]));
                                    break
                                }
                            }
                        }
                        if (a !== !0) {
                            if (a && e["throws"]) {
                                t = a(t)
                            } else {
                                try {
                                    t = a(t)
                                } catch (p) {
                                    return {
                                        state: "parsererror",
                                        error: a ? p : "No conversion from " + l + " to " + o
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return {
            state: "success",
            data: t
        }
    }
    x.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /(?:java|ecma)script/
        },
        converters: {
            "text script": function (e) {
                return x.globalEval(e), e
            }
        }
    }), x.ajaxPrefilter("script", function (e) {
        e.cache === t && (e.cache = !1), e.crossDomain && (e.type = "GET", e.global = !1)
    }), x.ajaxTransport("script", function (e) {
        if (e.crossDomain) {
            var n, r = a.head || x("head")[0] || a.documentElement;
            return {
                send: function (t, i) {
                    n = a.createElement("script"), n.async = !0, e.scriptCharset && (n.charset = e.scriptCharset), n.src = e.url, n.onload = n.onreadystatechange = function (e, t) {
                        (t || !n.readyState || /loaded|complete/.test(n.readyState)) && (n.onload = n.onreadystatechange = null, n.parentNode && n.parentNode.removeChild(n), n = null, t || i(200, "success"))
                    }, r.insertBefore(n, r.firstChild)
                },
                abort: function () {
                    n && n.onload(t, !0)
                }
            }
        }
    });
    var Fn = [],
        Bn = /(=)\?(?=&|$)|\?\?/;
    x.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function () {
            var e = Fn.pop() || x.expando + "_" + vn++;
            return this[e] = !0, e
        }
    }), x.ajaxPrefilter("json jsonp", function (n, r, i) {
        var o, a, s, l = n.jsonp !== !1 && (Bn.test(n.url) ? "url" : "string" == typeof n.data && !(n.contentType || "").indexOf("application/x-www-form-urlencoded") && Bn.test(n.data) && "data");
        return l || "jsonp" === n.dataTypes[0] ? (o = n.jsonpCallback = x.isFunction(n.jsonpCallback) ? n.jsonpCallback() : n.jsonpCallback, l ? n[l] = n[l].replace(Bn, "$1" + o) : n.jsonp !== !1 && (n.url += (bn.test(n.url) ? "&" : "?") + n.jsonp + "=" + o), n.converters["script json"] = function () {
            return s || x.error(o + " was not called"), s[0]
        }, n.dataTypes[0] = "json", a = e[o], e[o] = function () {
            s = arguments
        }, i.always(function () {
            e[o] = a, n[o] && (n.jsonpCallback = r.jsonpCallback, Fn.push(o)), s && x.isFunction(a) && a(s[0]), s = a = t
        }), "script") : t
    });
    var Pn, Rn, Wn = 0,
        $n = e.ActiveXObject &&
    function () {
        var e;
        for (e in Pn) {
            Pn[e](t, !0)
        }
    };

    function In() {
        try {
            return new e.XMLHttpRequest
        } catch (t) {}
    }

    function zn() {
        try {
            return new e.ActiveXObject("Microsoft.XMLHTTP")
        } catch (t) {}
    }
    x.ajaxSettings.xhr = e.ActiveXObject ?
    function () {
        return !this.isLocal && In() || zn()
    } : In, Rn = x.ajaxSettings.xhr(), x.support.cors = !! Rn && "withCredentials" in Rn, Rn = x.support.ajax = !! Rn, Rn && x.ajaxTransport(function (n) {
        if (!n.crossDomain || x.support.cors) {
            var r;
            return {
                send: function (i, o) {
                    var a, s, l = n.xhr();
                    if (n.username ? l.open(n.type, n.url, n.async, n.username, n.password) : l.open(n.type, n.url, n.async), n.xhrFields) {
                        for (s in n.xhrFields) {
                            l[s] = n.xhrFields[s]
                        }
                    }
                    n.mimeType && l.overrideMimeType && l.overrideMimeType(n.mimeType), n.crossDomain || i["X-Requested-With"] || (i["X-Requested-With"] = "XMLHttpRequest");
                    try {
                        for (s in i) {
                            l.setRequestHeader(s, i[s])
                        }
                    } catch (u) {}
                    l.send(n.hasContent && n.data || null), r = function (e, i) {
                        var s, u, c, p;
                        try {
                            if (r && (i || 4 === l.readyState)) {
                                if (r = t, a && (l.onreadystatechange = x.noop, $n && delete Pn[a]), i) {
                                    4 !== l.readyState && l.abort()
                                } else {
                                    p = {}, s = l.status, u = l.getAllResponseHeaders(), "string" == typeof l.responseText && (p.text = l.responseText);
                                    try {
                                        c = l.statusText
                                    } catch (f) {
                                        c = ""
                                    }
                                    s || !n.isLocal || n.crossDomain ? 1223 === s && (s = 204) : s = p.text ? 200 : 404
                                }
                            }
                        } catch (d) {
                            i || o(-1, d)
                        }
                        p && o(s, c, p, u)
                    }, n.async ? 4 === l.readyState ? setTimeout(r) : (a = ++Wn, $n && (Pn || (Pn = {}, x(e).unload($n)), Pn[a] = r), l.onreadystatechange = r) : r()
                },
                abort: function () {
                    r && r(t, !0)
                }
            }
        }
    });
    var Xn, Un, Vn = /^(?:toggle|show|hide)$/,
        Yn = RegExp("^(?:([+-])=|)(" + w + ")([a-z%]*)$", "i"),
        Jn = /queueHooks$/,
        Gn = [nr],
        Qn = {
            "*": [function (e, t) {
                var n = this.createTween(e, t),
                    r = n.cur(),
                    i = Yn.exec(t),
                    o = i && i[3] || (x.cssNumber[e] ? "" : "px"),
                    a = (x.cssNumber[e] || "px" !== o && +r) && Yn.exec(x.css(n.elem, e)),
                    s = 1,
                    l = 20;
                if (a && a[3] !== o) {
                    o = o || a[3], i = i || [], a = +r || 1;
                    do {
                        s = s || ".5", a /= s, x.style(n.elem, e, a + o)
                    } while (s !== (s = n.cur() / r) && 1 !== s && --l)
                }
                return i && (a = n.start = +a || +r || 0, n.unit = o, n.end = i[1] ? a + (i[1] + 1) * i[2] : +i[2]), n
            }]
        };

    function Kn() {
        return setTimeout(function () {
            Xn = t
        }), Xn = x.now()
    }

    function Zn(e, t, n) {
        var r, i = (Qn[t] || []).concat(Qn["*"]),
            o = 0,
            a = i.length;
        for (; a > o; o++) {
            if (r = i[o].call(n, t, e)) {
                return r
            }
        }
    }

    function er(e, t, n) {
        var r, i, o = 0,
            a = Gn.length,
            s = x.Deferred().always(function () {
                delete l.elem
            }),
            l = function () {
                if (i) {
                    return !1
                }
                var t = Xn || Kn(),
                    n = Math.max(0, u.startTime + u.duration - t),
                    r = n / u.duration || 0,
                    o = 1 - r,
                    a = 0,
                    l = u.tweens.length;
                for (; l > a; a++) {
                    u.tweens[a].run(o)
                }
                return s.notifyWith(e, [u, o, n]), 1 > o && l ? n : (s.resolveWith(e, [u]), !1)
            },
            u = s.promise({
                elem: e,
                props: x.extend({}, t),
                opts: x.extend(!0, {
                    specialEasing: {}
                }, n),
                originalProperties: t,
                originalOptions: n,
                startTime: Xn || Kn(),
                duration: n.duration,
                tweens: [],
                createTween: function (t, n) {
                    var r = x.Tween(e, u.opts, t, n, u.opts.specialEasing[t] || u.opts.easing);
                    return u.tweens.push(r), r
                },
                stop: function (t) {
                    var n = 0,
                        r = t ? u.tweens.length : 0;
                    if (i) {
                        return this
                    }
                    for (i = !0; r > n; n++) {
                        u.tweens[n].run(1)
                    }
                    return t ? s.resolveWith(e, [u, t]) : s.rejectWith(e, [u, t]), this
                }
            }),
            c = u.props;
        for (tr(c, u.opts.specialEasing); a > o; o++) {
            if (r = Gn[o].call(u, e, c, u.opts)) {
                return r
            }
        }
        return x.map(c, Zn, u), x.isFunction(u.opts.start) && u.opts.start.call(e, u), x.fx.timer(x.extend(l, {
            elem: e,
            anim: u,
            queue: u.opts.queue
        })), u.progress(u.opts.progress).done(u.opts.done, u.opts.complete).fail(u.opts.fail).always(u.opts.always)
    }

    function tr(e, t) {
        var n, r, i, o, a;
        for (n in e) {
            if (r = x.camelCase(n), i = t[r], o = e[n], x.isArray(o) && (i = o[1], o = e[n] = o[0]), n !== r && (e[r] = o, delete e[n]), a = x.cssHooks[r], a && "expand" in a) {
                o = a.expand(o), delete e[r];
                for (n in o) {
                    n in e || (e[n] = o[n], t[n] = i)
                }
            } else {
                t[r] = i
            }
        }
    }
    x.Animation = x.extend(er, {
        tweener: function (e, t) {
            x.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");
            var n, r = 0,
                i = e.length;
            for (; i > r; r++) {
                n = e[r], Qn[n] = Qn[n] || [], Qn[n].unshift(t)
            }
        },
        prefilter: function (e, t) {
            t ? Gn.unshift(e) : Gn.push(e)
        }
    });

    function nr(e, t, n) {
        var r, i, o, a, s, l, u = this,
            c = {},
            p = e.style,
            f = e.nodeType && nn(e),
            d = x._data(e, "fxshow");
        n.queue || (s = x._queueHooks(e, "fx"), null == s.unqueued && (s.unqueued = 0, l = s.empty.fire, s.empty.fire = function () {
            s.unqueued || l()
        }), s.unqueued++, u.always(function () {
            u.always(function () {
                s.unqueued--, x.queue(e, "fx").length || s.empty.fire()
            })
        })), 1 === e.nodeType && ("height" in t || "width" in t) && (n.overflow = [p.overflow, p.overflowX, p.overflowY], "inline" === x.css(e, "display") && "none" === x.css(e, "float") && (x.support.inlineBlockNeedsLayout && "inline" !== ln(e.nodeName) ? p.zoom = 1 : p.display = "inline-block")), n.overflow && (p.overflow = "hidden", x.support.shrinkWrapBlocks || u.always(function () {
            p.overflow = n.overflow[0], p.overflowX = n.overflow[1], p.overflowY = n.overflow[2]
        }));
        for (r in t) {
            if (i = t[r], Vn.exec(i)) {
                if (delete t[r], o = o || "toggle" === i, i === (f ? "hide" : "show")) {
                    continue
                }
                c[r] = d && d[r] || x.style(e, r)
            }
        }
        if (!x.isEmptyObject(c)) {
            d ? "hidden" in d && (f = d.hidden) : d = x._data(e, "fxshow", {}), o && (d.hidden = !f), f ? x(e).show() : u.done(function () {
                x(e).hide()
            }), u.done(function () {
                var t;
                x._removeData(e, "fxshow");
                for (t in c) {
                    x.style(e, t, c[t])
                }
            });
            for (r in c) {
                a = Zn(f ? d[r] : 0, r, u), r in d || (d[r] = a.start, f && (a.end = a.start, a.start = "width" === r || "height" === r ? 1 : 0))
            }
        }
    }

    function rr(e, t, n, r, i) {
        return new rr.prototype.init(e, t, n, r, i)
    }
    x.Tween = rr, rr.prototype = {
        constructor: rr,
        init: function (e, t, n, r, i, o) {
            this.elem = e, this.prop = n, this.easing = i || "swing", this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = o || (x.cssNumber[n] ? "" : "px")
        },
        cur: function () {
            var e = rr.propHooks[this.prop];
            return e && e.get ? e.get(this) : rr.propHooks._default.get(this)
        },
        run: function (e) {
            var t, n = rr.propHooks[this.prop];
            return this.pos = t = this.options.duration ? x.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : rr.propHooks._default.set(this), this
        }
    }, rr.prototype.init.prototype = rr.prototype, rr.propHooks = {
        _default: {
            get: function (e) {
                var t;
                return null == e.elem[e.prop] || e.elem.style && null != e.elem.style[e.prop] ? (t = x.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0) : e.elem[e.prop]
            },
            set: function (e) {
                x.fx.step[e.prop] ? x.fx.step[e.prop](e) : e.elem.style && (null != e.elem.style[x.cssProps[e.prop]] || x.cssHooks[e.prop]) ? x.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now
            }
        }
    }, rr.propHooks.scrollTop = rr.propHooks.scrollLeft = {
        set: function (e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, x.each(["toggle", "show", "hide"], function (e, t) {
        var n = x.fn[t];
        x.fn[t] = function (e, r, i) {
            return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(ir(t, !0), e, r, i)
        }
    }), x.fn.extend({
        fadeTo: function (e, t, n, r) {
            return this.filter(nn).css("opacity", 0).show().end().animate({
                opacity: t
            }, e, n, r)
        },
        animate: function (e, t, n, r) {
            var i = x.isEmptyObject(e),
                o = x.speed(t, n, r),
                a = function () {
                    var t = er(this, x.extend({}, e), o);
                    (i || x._data(this, "finish")) && t.stop(!0)
                };
            return a.finish = a, i || o.queue === !1 ? this.each(a) : this.queue(o.queue, a)
        },
        stop: function (e, n, r) {
            var i = function (e) {
                    var t = e.stop;
                    delete e.stop, t(r)
                };
            return "string" != typeof e && (r = n, n = e, e = t), n && e !== !1 && this.queue(e || "fx", []), this.each(function () {
                var t = !0,
                    n = null != e && e + "queueHooks",
                    o = x.timers,
                    a = x._data(this);
                if (n) {
                    a[n] && a[n].stop && i(a[n])
                } else {
                    for (n in a) {
                        a[n] && a[n].stop && Jn.test(n) && i(a[n])
                    }
                }
                for (n = o.length; n--;) {
                    o[n].elem !== this || null != e && o[n].queue !== e || (o[n].anim.stop(r), t = !1, o.splice(n, 1))
                }(t || !r) && x.dequeue(this, e)
            })
        },
        finish: function (e) {
            return e !== !1 && (e = e || "fx"), this.each(function () {
                var t, n = x._data(this),
                    r = n[e + "queue"],
                    i = n[e + "queueHooks"],
                    o = x.timers,
                    a = r ? r.length : 0;
                for (n.finish = !0, x.queue(this, e, []), i && i.stop && i.stop.call(this, !0), t = o.length; t--;) {
                    o[t].elem === this && o[t].queue === e && (o[t].anim.stop(!0), o.splice(t, 1))
                }
                for (t = 0; a > t; t++) {
                    r[t] && r[t].finish && r[t].finish.call(this)
                }
                delete n.finish
            })
        }
    });

    function ir(e, t) {
        var n, r = {
            height: e
        },
            i = 0;
        for (t = t ? 1 : 0; 4 > i; i += 2 - t) {
            n = Zt[i], r["margin" + n] = r["padding" + n] = e
        }
        return t && (r.opacity = r.width = e), r
    }
    x.each({
        slideDown: ir("show"),
        slideUp: ir("hide"),
        slideToggle: ir("toggle"),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        },
        fadeToggle: {
            opacity: "toggle"
        }
    }, function (e, t) {
        x.fn[e] = function (e, n, r) {
            return this.animate(t, e, n, r)
        }
    }), x.speed = function (e, t, n) {
        var r = e && "object" == typeof e ? x.extend({}, e) : {
            complete: n || !n && t || x.isFunction(e) && e,
            duration: e,
            easing: n && t || t && !x.isFunction(t) && t
        };
        return r.duration = x.fx.off ? 0 : "number" == typeof r.duration ? r.duration : r.duration in x.fx.speeds ? x.fx.speeds[r.duration] : x.fx.speeds._default, (null == r.queue || r.queue === !0) && (r.queue = "fx"), r.old = r.complete, r.complete = function () {
            x.isFunction(r.old) && r.old.call(this), r.queue && x.dequeue(this, r.queue)
        }, r
    }, x.easing = {
        linear: function (e) {
            return e
        },
        swing: function (e) {
            return 0.5 - Math.cos(e * Math.PI) / 2
        }
    }, x.timers = [], x.fx = rr.prototype.init, x.fx.tick = function () {
        var e, n = x.timers,
            r = 0;
        for (Xn = x.now(); n.length > r; r++) {
            e = n[r], e() || n[r] !== e || n.splice(r--, 1)
        }
        n.length || x.fx.stop(), Xn = t
    }, x.fx.timer = function (e) {
        e() && x.timers.push(e) && x.fx.start()
    }, x.fx.interval = 13, x.fx.start = function () {
        Un || (Un = setInterval(x.fx.tick, x.fx.interval))
    }, x.fx.stop = function () {
        clearInterval(Un), Un = null
    }, x.fx.speeds = {
        slow: 600,
        fast: 200,
        _default: 400
    }, x.fx.step = {}, x.expr && x.expr.filters && (x.expr.filters.animated = function (e) {
        return x.grep(x.timers, function (t) {
            return e === t.elem
        }).length
    }), x.fn.offset = function (e) {
        if (arguments.length) {
            return e === t ? this : this.each(function (t) {
                x.offset.setOffset(this, e, t)
            })
        }
        var n, r, o = {
            top: 0,
            left: 0
        },
            a = this[0],
            s = a && a.ownerDocument;
        if (s) {
            return n = s.documentElement, x.contains(n, a) ? (typeof a.getBoundingClientRect !== i && (o = a.getBoundingClientRect()), r = or(s), {
                top: o.top + (r.pageYOffset || n.scrollTop) - (n.clientTop || 0),
                left: o.left + (r.pageXOffset || n.scrollLeft) - (n.clientLeft || 0)
            }) : o
        }
    }, x.offset = {
        setOffset: function (e, t, n) {
            var r = x.css(e, "position");
            "static" === r && (e.style.position = "relative");
            var i = x(e),
                o = i.offset(),
                a = x.css(e, "top"),
                s = x.css(e, "left"),
                l = ("absolute" === r || "fixed" === r) && x.inArray("auto", [a, s]) > -1,
                u = {},
                c = {},
                p, f;
            l ? (c = i.position(), p = c.top, f = c.left) : (p = parseFloat(a) || 0, f = parseFloat(s) || 0), x.isFunction(t) && (t = t.call(e, n, o)), null != t.top && (u.top = t.top - o.top + p), null != t.left && (u.left = t.left - o.left + f), "using" in t ? t.using.call(e, u) : i.css(u)
        }
    }, x.fn.extend({
        position: function () {
            if (this[0]) {
                var e, t, n = {
                    top: 0,
                    left: 0
                },
                    r = this[0];
                return "fixed" === x.css(r, "position") ? t = r.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), x.nodeName(e[0], "html") || (n = e.offset()), n.top += x.css(e[0], "borderTopWidth", !0), n.left += x.css(e[0], "borderLeftWidth", !0)), {
                    top: t.top - n.top - x.css(r, "marginTop", !0),
                    left: t.left - n.left - x.css(r, "marginLeft", !0)
                }
            }
        },
        offsetParent: function () {
            return this.map(function () {
                var e = this.offsetParent || s;
                while (e && !x.nodeName(e, "html") && "static" === x.css(e, "position")) {
                    e = e.offsetParent
                }
                return e || s
            })
        }
    }), x.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function (e, n) {
        var r = /Y/.test(n);
        x.fn[e] = function (i) {
            return x.access(this, function (e, i, o) {
                var a = or(e);
                return o === t ? a ? n in a ? a[n] : a.document.documentElement[i] : e[i] : (a ? a.scrollTo(r ? x(a).scrollLeft() : o, r ? o : x(a).scrollTop()) : e[i] = o, t)
            }, e, i, arguments.length, null)
        }
    });

    function or(e) {
        return x.isWindow(e) ? e : 9 === e.nodeType ? e.defaultView || e.parentWindow : !1
    }
    x.each({
        Height: "height",
        Width: "width"
    }, function (e, n) {
        x.each({
            padding: "inner" + e,
            content: n,
            "": "outer" + e
        }, function (r, i) {
            x.fn[i] = function (i, o) {
                var a = arguments.length && (r || "boolean" != typeof i),
                    s = r || (i === !0 || o === !0 ? "margin" : "border");
                return x.access(this, function (n, r, i) {
                    var o;
                    return x.isWindow(n) ? n.document.documentElement["client" + e] : 9 === n.nodeType ? (o = n.documentElement, Math.max(n.body["scroll" + e], o["scroll" + e], n.body["offset" + e], o["offset" + e], o["client" + e])) : i === t ? x.css(n, r, s) : x.style(n, r, i, s)
                }, n, a ? i : t, a, null)
            }
        })
    }), x.fn.size = function () {
        return this.length
    }, x.fn.andSelf = x.fn.addBack, "object" == typeof module && module && "object" == typeof module.exports ? module.exports = x : (e.jQuery = e.$ = x, "function" == typeof define && define.amd && define("jquery", [], function () {
        return x
    }))
})(window);
(function (h) {
    var o = "You don't have any notifications.";
    var b = function (aG, aH) {
            function aF(s) {
                return document.querySelectorAll ? document.querySelectorAll(s) : jQuery(s)
            }

            function aE() {
                var s = at - aC;

                aH.freeMode && (s = at - aC);
                aH.slidesPerView > aI.slides.length && (s = 0);
                0 > s && (s = 0);
                return s
            }

            function aB() {
                function u(x) {
                    var v = new Image;
                    v.onload = function () {
                        aI.imagesLoaded++;
                        if (aI.imagesLoaded == aI.imagesToLoad.length && (aI.reInit(), aH.onImagesReady)) {
                            aH.onImagesReady(aI)
                        }
                    };
                    v.src = x
                }
                aI.browser.ie10 ? (aI.h.addEventListener(aI.wrapper, aI.touchEvents.touchStart, ar, !1), aI.h.addEventListener(document, aI.touchEvents.touchMove, aq, !1), aI.h.addEventListener(document, aI.touchEvents.touchEnd, ap, !1)) : (aI.support.touch && (aI.h.addEventListener(aI.wrapper, "touchstart", ar, !1), aI.h.addEventListener(aI.wrapper, "touchmove", aq, !1), aI.h.addEventListener(aI.wrapper, "touchend", ap, !1)), aH.simulateTouch && (aI.h.addEventListener(aI.wrapper, "mousedown", ar, !1), aI.h.addEventListener(document, "mousemove", aq, !1), aI.h.addEventListener(document, "mouseup", ap, !1)));
                aH.autoResize && aI.h.addEventListener(window, "resize", aI.resizeFix, !1);
                ax();
                aI._wheelEvent = !1;
                if (aH.mousewheelControl) {
                    void 0 !== document.onmousewheel && (aI._wheelEvent = "mousewheel");
                    try {
                        WheelEvent("wheel"), aI._wheelEvent = "wheel"
                    } catch (t) {}
                    aI._wheelEvent || (aI._wheelEvent = "DOMMouseScroll");
                    aI._wheelEvent && aI.h.addEventListener(aI.container, aI._wheelEvent, ae, !1)
                }
                aH.keyboardControl && aI.h.addEventListener(document, "keydown", ad, !1);
                if (aH.updateOnImagesReady) {
                    document.querySelectorAll ? aI.imagesToLoad = aI.container.querySelectorAll("img") : window.jQuery && (aI.imagesToLoad = aF(aI.container).find("img"));
                    for (var s = 0; s < aI.imagesToLoad.length; s++) {
                        u(aI.imagesToLoad[s].getAttribute("src"))
                    }
                }
            }

            function ax() {
                if (aH.preventLinks) {
                    var t = [];
                    document.querySelectorAll ? t = aI.container.querySelectorAll("a") : window.jQuery && (t = aF(aI.container).find("a"));
                    for (var s = 0; s < t.length; s++) {
                        aI.h.addEventListener(t[s], "click", ac, !1)
                    }
                }
                if (aH.releaseFormElements) {
                    for (t = document.querySelectorAll ? aI.container.querySelectorAll("input, textarea, select") : aF(aI.container).find("input, textarea, select"), s = 0; s < t.length; s++) {
                        aI.h.addEventListener(t[s], aI.touchEvents.touchStart, ab, !0)
                    }
                }
                if (aH.onSlideClick) {
                    for (s = 0; s < aI.slides.length; s++) {
                        aI.h.addEventListener(aI.slides[s], "click", aa, !1)
                    }
                }
                if (aH.onSlideTouch) {
                    for (s = 0; s < aI.slides.length; s++) {
                        aI.h.addEventListener(aI.slides[s], aI.touchEvents.touchStart, Z, !1)
                    }
                }
            }

            function av() {
                if (aH.onSlideClick) {
                    for (var t = 0; t < aI.slides.length; t++) {
                        aI.h.removeEventListener(aI.slides[t], "click", aa, !1)
                    }
                }
                if (aH.onSlideTouch) {
                    for (t = 0; t < aI.slides.length; t++) {
                        aI.h.removeEventListener(aI.slides[t], aI.touchEvents.touchStart, Z, !1)
                    }
                }
                if (aH.releaseFormElements) {
                    for (var s = document.querySelectorAll ? aI.container.querySelectorAll("input, textarea, select") : aF(aI.container).find("input, textarea, select"), t = 0; t < s.length; t++) {
                        aI.h.removeEventListener(s[t], aI.touchEvents.touchStart, ab, !0)
                    }
                }
                if (aH.preventLinks) {
                    for (s = [], document.querySelectorAll ? s = aI.container.querySelectorAll("a") : window.jQuery && (s = aF(aI.container).find("a")), t = 0; t < s.length; t++) {
                        aI.h.removeEventListener(s[t], "click", ac, !1)
                    }
                }
            }

            function ad(B) {
                var C = B.keyCode || B.charCode;
                if (37 == C || 39 == C || 38 == C || 40 == C) {
                    for (var A = !1, z = aI.h.getOffset(aI.container), x = aI.h.windowScroll().left, y = aI.h.windowScroll().top, u = aI.h.windowWidth(), v = aI.h.windowHeight(), z = [
                        [z.left, z.top],
                        [z.left + aI.width, z.top],
                        [z.left, z.top + aI.height],
                        [z.left + aI.width, z.top + aI.height]
                    ], t = 0; t < z.length; t++) {
                        var s = z[t];
                        s[0] >= x && (s[0] <= x + u && s[1] >= y && s[1] <= y + v) && (A = !0)
                    }
                    if (!A) {
                        return
                    }
                }
                if (aD) {
                    if (37 == C || 39 == C) {
                        B.preventDefault ? B.preventDefault() : B.returnValue = !1
                    }
                    39 == C && aI.swipeNext();
                    37 == C && aI.swipePrev()
                } else {
                    if (38 == C || 40 == C) {
                        B.preventDefault ? B.preventDefault() : B.returnValue = !1
                    }
                    40 == C && aI.swipeNext();
                    38 == C && aI.swipePrev()
                }
            }

            function ae(u) {
                var t = aI._wheelEvent,
                    s;
                u.detail ? s = -u.detail : "mousewheel" == t ? s = u.wheelDelta : "DOMMouseScroll" == t ? s = -u.detail : "wheel" == t && (s = Math.abs(u.deltaX) > Math.abs(u.deltaY) ? -u.deltaX : -u.deltaY);
                aH.freeMode ? (aD ? aI.getWrapperTranslate("x") : aI.getWrapperTranslate("y"), aD ? (t = aI.getWrapperTranslate("x") + s, s = aI.getWrapperTranslate("y"), 0 < t && (t = 0), t < -aE() && (t = -aE())) : (t = aI.getWrapperTranslate("x"), s = aI.getWrapperTranslate("y") + s, 0 < s && (s = 0), s < -aE() && (s = -aE())), aI.setWrapperTransition(0), aI.setWrapperTranslate(t, s, 0), aD ? aI.updateActiveSlide(t) : aI.updateActiveSlide(s)) : 0 > s ? aI.swipeNext() : aI.swipePrev();
                aH.autoplay && aI.stopAutoplay();
                u.preventDefault ? u.preventDefault() : u.returnValue = !1;
                return !1
            }

            function Y(s) {
                for (var t = !1; !t;) {
                    -1 < s.className.indexOf(aH.slideClass) && (t = s), s = s.parentElement
                }
                return t
            }

            function aa(s) {
                aI.allowSlideClick && (s.target ? (aI.clickedSlide = this, aI.clickedSlideIndex = aI.slides.indexOf(this)) : (aI.clickedSlide = Y(s.srcElement), aI.clickedSlideIndex = aI.slides.indexOf(aI.clickedSlide)), aH.onSlideClick(aI))
            }

            function Z(s) {
                aI.clickedSlide = s.target ? this : Y(s.srcElement);
                aI.clickedSlideIndex = aI.slides.indexOf(aI.clickedSlide);
                aH.onSlideTouch(aI)
            }

            function ac(s) {
                if (!aI.allowLinks) {
                    return s.preventDefault ? s.preventDefault() : s.returnValue = !1, !1
                }
            }

            function ab(s) {
                s.stopPropagation ? s.stopPropagation() : s.returnValue = !1;
                return !1
            }

            function ar(u) {
                aH.preventLinks && (aI.allowLinks = !0);
                if (aI.isTouched || aH.onlyExternal) {
                    return !1
                }
                var t;
                if (t = aH.noSwiping) {
                    if (t = u.target || u.srcElement) {
                        t = u.target || u.srcElement;
                        var s = !1;
                        do {-1 < t.className.indexOf(aH.noSwipingClass) && (s = !0), t = t.parentElement
                        } while (!s && t.parentElement && -1 == t.className.indexOf(aH.wrapperClass));
                        !s && (-1 < t.className.indexOf(aH.wrapperClass) && -1 < t.className.indexOf(aH.noSwipingClass)) && (s = !0);
                        t = s
                    }
                }
                if (t) {
                    return !1
                }
                al = !1;
                aI.isTouched = !0;
                aw = "touchstart" == u.type;
                if (!aw || 1 == u.targetTouches.length) {
                    aH.loop && aI.fixLoop();
                    aI.callPlugins("onTouchStartBegin");
                    aw || (u.preventDefault ? u.preventDefault() : u.returnValue = !1);
                    t = aw ? u.targetTouches[0].pageX : u.pageX || u.clientX;
                    u = aw ? u.targetTouches[0].pageY : u.pageY || u.clientY;
                    aI.touches.startX = aI.touches.currentX = t;
                    aI.touches.startY = aI.touches.currentY = u;
                    aI.touches.start = aI.touches.current = aD ? t : u;
                    aI.setWrapperTransition(0);
                    aI.positions.start = aI.positions.current = aD ? aI.getWrapperTranslate("x") : aI.getWrapperTranslate("y");
                    aD ? aI.setWrapperTranslate(aI.positions.start, 0, 0) : aI.setWrapperTranslate(0, aI.positions.start, 0);
                    aI.times.start = (new Date).getTime();
                    au = void 0;
                    0 < aH.moveStartThreshold && (af = !1);
                    if (aH.onTouchStart) {
                        aH.onTouchStart(aI)
                    }
                    aI.callPlugins("onTouchStartEnd")
                }
            }

            function aq(u) {
                if (aI.isTouched && !aH.onlyExternal && (!aw || "mousemove" != u.type)) {
                    var t = aw ? u.targetTouches[0].pageX : u.pageX || u.clientX,
                        s = aw ? u.targetTouches[0].pageY : u.pageY || u.clientY;
                    "undefined" === typeof au && aD && (au = !! (au || Math.abs(s - aI.touches.startY) > Math.abs(t - aI.touches.startX)));
                    "undefined" !== typeof au || aD || (au = !! (au || Math.abs(s - aI.touches.startY) < Math.abs(t - aI.touches.startX)));
                    if (au) {
                        aI.isTouched = !1
                    } else {
                        if (u.assignedToSwiper) {
                            aI.isTouched = !1
                        } else {
                            if (u.assignedToSwiper = !0, aI.isMoved = !0, aH.preventLinks && (aI.allowLinks = !1), aH.onSlideClick && (aI.allowSlideClick = !1), aH.autoplay && aI.stopAutoplay(), !aw || 1 == u.touches.length) {
                                aI.callPlugins("onTouchMoveStart");
                                u.preventDefault ? u.preventDefault() : u.returnValue = !1;
                                aI.touches.current = aD ? t : s;
                                aI.positions.current = (aI.touches.current - aI.touches.start) * aH.touchRatio + aI.positions.start;
                                if (0 < aI.positions.current && aH.onResistanceBefore) {
                                    aH.onResistanceBefore(aI, aI.positions.current)
                                }
                                if (aI.positions.current < -aE() && aH.onResistanceAfter) {
                                    aH.onResistanceAfter(aI, Math.abs(aI.positions.current + aE()))
                                }
                                aH.resistance && "100%" != aH.resistance && (0 < aI.positions.current && (u = 1 - aI.positions.current / aC / 2, aI.positions.current = 0.5 > u ? aC / 2 : aI.positions.current * u), aI.positions.current < -aE() && (t = (aI.touches.current - aI.touches.start) * aH.touchRatio + (aE() + aI.positions.start), u = (aC + t) / aC, t = aI.positions.current - t * (1 - u) / 2, s = -aE() - aC / 2, aI.positions.current = t < s || 0 >= u ? s : t));
                                aH.resistance && "100%" == aH.resistance && (0 < aI.positions.current && (!aH.freeMode || aH.freeModeFluid) && (aI.positions.current = 0), aI.positions.current < -aE() && (!aH.freeMode || aH.freeModeFluid) && (aI.positions.current = -aE()));
                                if (aH.followFinger) {
                                    aH.moveStartThreshold ? Math.abs(aI.touches.current - aI.touches.start) > aH.moveStartThreshold || af ? (af = !0, aD ? aI.setWrapperTranslate(aI.positions.current, 0, 0) : aI.setWrapperTranslate(0, aI.positions.current, 0)) : aI.positions.current = aI.positions.start : aD ? aI.setWrapperTranslate(aI.positions.current, 0, 0) : aI.setWrapperTranslate(0, aI.positions.current, 0);
                                    (aH.freeMode || aH.watchActiveIndex) && aI.updateActiveSlide(aI.positions.current);
                                    aH.grabCursor && (aI.container.style.cursor = "move", aI.container.style.cursor = "grabbing", aI.container.style.cursor = "-moz-grabbin", aI.container.style.cursor = "-webkit-grabbing");
                                    an || (an = aI.touches.current);
                                    ak || (ak = (new Date).getTime());
                                    aI.velocity = (aI.touches.current - an) / ((new Date).getTime() - ak) / 2;
                                    2 > Math.abs(aI.touches.current - an) && (aI.velocity = 0);
                                    an = aI.touches.current;
                                    ak = (new Date).getTime();
                                    aI.callPlugins("onTouchMoveEnd");
                                    if (aH.onTouchMove) {
                                        aH.onTouchMove(aI)
                                    }
                                    return !1
                                }
                            }
                        }
                    }
                }
            }

            function ap(A) {
                au && aI.swipeReset();
                if (!aH.onlyExternal && aI.isTouched) {
                    aI.isTouched = !1;
                    aH.grabCursor && (aI.container.style.cursor = "move", aI.container.style.cursor = "grab", aI.container.style.cursor = "-moz-grab", aI.container.style.cursor = "-webkit-grab");
                    aI.positions.current || 0 === aI.positions.current || (aI.positions.current = aI.positions.start);
                    aH.followFinger && (aD ? aI.setWrapperTranslate(aI.positions.current, 0, 0) : aI.setWrapperTranslate(0, aI.positions.current, 0));
                    aI.times.end = (new Date).getTime();
                    aI.touches.diff = aI.touches.current - aI.touches.start;
                    aI.touches.abs = Math.abs(aI.touches.diff);
                    aI.positions.diff = aI.positions.current - aI.positions.start;
                    aI.positions.abs = Math.abs(aI.positions.diff);
                    var z = aI.positions.diff,
                        y = aI.positions.abs;
                    A = aI.times.end - aI.times.start;
                    5 > y && (300 > A && !1 == aI.allowLinks) && (aH.freeMode || 0 == y || aI.swipeReset(), aH.preventLinks && (aI.allowLinks = !0), aH.onSlideClick && (aI.allowSlideClick = !0));
                    setTimeout(function () {
                        aH.preventLinks && (aI.allowLinks = !0);
                        aH.onSlideClick && (aI.allowSlideClick = !0)
                    }, 100);
                    if (aI.isMoved) {
                        aI.isMoved = !1;
                        var x = aE();
                        if (0 < aI.positions.current) {
                            aI.swipeReset()
                        } else {
                            if (aI.positions.current < -x) {
                                aI.swipeReset()
                            } else {
                                if (aH.freeMode) {
                                    if (aH.freeModeFluid) {
                                        var y = 1000 * aH.momentumRatio,
                                            z = aI.positions.current + aI.velocity * y,
                                            u = !1,
                                            t, s = 20 * Math.abs(aI.velocity) * aH.momentumBounceRatio;
                                        z < -x && (aH.momentumBounce && aI.support.transitions ? (z + x < -s && (z = -x - s), t = -x, al = u = !0) : z = -x);
                                        0 < z && (aH.momentumBounce && aI.support.transitions ? (z > s && (z = s), t = 0, al = u = !0) : z = 0);
                                        0 != aI.velocity && (y = Math.abs((z - aI.positions.current) / aI.velocity));
                                        aD ? aI.setWrapperTranslate(z, 0, 0) : aI.setWrapperTranslate(0, z, 0);
                                        aI.setWrapperTransition(y);
                                        aH.momentumBounce && u && aI.wrapperTransitionEnd(function () {
                                            if (al) {
                                                if (aH.onMomentumBounce) {
                                                    aH.onMomentumBounce(aI)
                                                }
                                                aD ? aI.setWrapperTranslate(t, 0, 0) : aI.setWrapperTranslate(0, t, 0);
                                                aI.setWrapperTransition(300)
                                            }
                                        });
                                        aI.updateActiveSlide(z)
                                    }(!aH.freeModeFluid || 300 <= A) && aI.updateActiveSlide(aI.positions.current)
                                } else {
                                    am = 0 > z ? "toNext" : "toPrev";
                                    "toNext" == am && 300 >= A && (30 > y || !aH.shortSwipes ? aI.swipeReset() : aI.swipeNext(!0));
                                    "toPrev" == am && 300 >= A && (30 > y || !aH.shortSwipes ? aI.swipeReset() : aI.swipePrev(!0));
                                    x = 0;
                                    if ("auto" == aH.slidesPerView) {
                                        for (var z = Math.abs(aD ? aI.getWrapperTranslate("x") : aI.getWrapperTranslate("y")), v = u = 0; v < aI.slides.length; v++) {
                                            if (s = aD ? aI.slides[v].getWidth(!0) : aI.slides[v].getHeight(!0), u += s, u > z) {
                                                x = s;
                                                break
                                            }
                                        }
                                        x > aC && (x = aC)
                                    } else {
                                        x = aA * aH.slidesPerView
                                    }
                                    "toNext" == am && 300 < A && (y >= 0.5 * x ? aI.swipeNext(!0) : aI.swipeReset());
                                    "toPrev" == am && 300 < A && (y >= 0.5 * x ? aI.swipePrev(!0) : aI.swipeReset())
                                }
                            }
                        }
                        if (aH.onTouchEnd) {
                            aH.onTouchEnd(aI)
                        }
                        aI.callPlugins("onTouchEnd")
                    } else {
                        aI.isMoved = !1;
                        if (aH.onTouchEnd) {
                            aH.onTouchEnd(aI)
                        }
                        aI.callPlugins("onTouchEnd");
                        aI.swipeReset()
                    }
                }
            }

            function aj(B, A, z) {
                function y() {
                    x += t;
                    if (s = "toNext" == u ? x > B : x < B) {
                        aD ? aI.setWrapperTranslate(Math.round(x), 0) : aI.setWrapperTranslate(0, Math.round(x)), aI._DOMAnimating = !0, window.setTimeout(function () {
                            y()
                        }, 1000 / 60)
                    } else {
                        if (aH.onSlideChangeEnd) {
                            aH.onSlideChangeEnd(aI)
                        }
                        aD ? aI.setWrapperTranslate(B, 0) : aI.setWrapperTranslate(0, B);
                        aI._DOMAnimating = !1
                    }
                }
                if (aI.support.transitions || !aH.DOMAnimation) {
                    aD ? aI.setWrapperTranslate(B, 0, 0) : aI.setWrapperTranslate(0, B, 0);
                    var v = "to" == A && 0 <= z.speed ? z.speed : aH.speed;
                    aI.setWrapperTransition(v)
                } else {
                    var x = aD ? aI.getWrapperTranslate("x") : aI.getWrapperTranslate("y"),
                        v = "to" == A && 0 <= z.speed ? z.speed : aH.speed,
                        t = Math.ceil((B - x) / v * (1000 / 60)),
                        u = x > B ? "toNext" : "toPrev",
                        s = "toNext" == u ? x > B : x < B;
                    if (aI._DOMAnimating) {
                        return
                    }
                    y()
                }
                aI.updateActiveSlide(B);
                if (aH.onSlideNext && "next" == A) {
                    aH.onSlideNext(aI, B)
                }
                if (aH.onSlidePrev && "prev" == A) {
                    aH.onSlidePrev(aI, B)
                }
                if (aH.onSlideReset && "reset" == A) {
                    aH.onSlideReset(aI, B)
                }("next" == A || "prev" == A || "to" == A && !0 == z.runCallbacks) && w()
            }

            function w() {
                aI.callPlugins("onSlideChangeStart");
                if (aH.onSlideChangeStart) {
                    if (aH.queueStartCallbacks && aI.support.transitions) {
                        if (aI._queueStartCallbacks) {
                            return
                        }
                        aI._queueStartCallbacks = !0;
                        aH.onSlideChangeStart(aI);
                        aI.wrapperTransitionEnd(function () {
                            aI._queueStartCallbacks = !1
                        })
                    } else {
                        aH.onSlideChangeStart(aI)
                    }
                }
                aH.onSlideChangeEnd && (aI.support.transitions ? aH.queueEndCallbacks ? aI._queueEndCallbacks || (aI._queueEndCallbacks = !0, aI.wrapperTransitionEnd(aH.onSlideChangeEnd)) : aI.wrapperTransitionEnd(aH.onSlideChangeEnd) : aH.DOMAnimation || setTimeout(function () {
                    aH.onSlideChangeEnd(aI)
                }, 10))
            }

            function X() {
                for (var s = aI.paginationButtons, t = 0; t < s.length; t++) {
                    aI.h.removeEventListener(s[t], "click", F, !1)
                }
            }

            function F(s) {
                var v;
                s = s.target || s.srcElement;
                for (var u = aI.paginationButtons, t = 0; t < u.length; t++) {
                    s === u[t] && (v = t)
                }
                aI.swipeTo(v)
            }
            if (document.body.__defineGetter__ && HTMLElement) {
                var ay = HTMLElement.prototype;
                ay.__defineGetter__ && ay.__defineGetter__("outerHTML", function () {
                    return (new XMLSerializer).serializeToString(this)
                })
            }
            window.getComputedStyle || (window.getComputedStyle = function (t, s) {
                this.el = t;
                this.getPropertyValue = function (u) {
                    var v = /(\-([a-z]){1})/g;
                    "float" === u && (u = "styleFloat");
                    v.test(u) && (u = u.replace(v, function (y, x, z) {
                        return z.toUpperCase()
                    }));
                    return t.currentStyle[u] ? t.currentStyle[u] : null
                };
                return this
            });
            Array.prototype.indexOf || (Array.prototype.indexOf = function (t, s) {
                for (var v = s || 0, u = this.length; v < u; v++) {
                    if (this[v] === t) {
                        return v
                    }
                }
                return -1
            });
            if ((document.querySelectorAll || window.jQuery) && "undefined" !== typeof aG && (aG.nodeType || 0 !== aF(aG).length)) {
                var aI = this;
                aI.touches = {
                    start: 0,
                    startX: 0,
                    startY: 0,
                    current: 0,
                    currentX: 0,
                    currentY: 0,
                    diff: 0,
                    abs: 0
                };
                aI.positions = {
                    start: 0,
                    abs: 0,
                    diff: 0,
                    current: 0
                };
                aI.times = {
                    start: 0,
                    end: 0
                };
                aI.id = (new Date).getTime();
                aI.container = aG.nodeType ? aG : aF(aG)[0];
                aI.isTouched = !1;
                aI.isMoved = !1;
                aI.activeIndex = 0;
                aI.activeLoaderIndex = 0;
                aI.activeLoopIndex = 0;
                aI.previousIndex = null;
                aI.velocity = 0;
                aI.snapGrid = [];
                aI.slidesGrid = [];
                aI.imagesToLoad = [];
                aI.imagesLoaded = 0;
                aI.wrapperLeft = 0;
                aI.wrapperRight = 0;
                aI.wrapperTop = 0;
                aI.wrapperBottom = 0;
                var ai, aA, at, am, au, aC, ay = {
                    mode: "horizontal",
                    touchRatio: 1,
                    speed: 300,
                    freeMode: !1,
                    freeModeFluid: !1,
                    momentumRatio: 1,
                    momentumBounce: !0,
                    momentumBounceRatio: 1,
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    simulateTouch: !0,
                    followFinger: !0,
                    shortSwipes: !0,
                    moveStartThreshold: !1,
                    autoplay: !1,
                    onlyExternal: !1,
                    createPagination: !0,
                    pagination: !1,
                    paginationElement: "span",
                    paginationClickable: !1,
                    paginationAsRange: !0,
                    resistance: !0,
                    scrollContainer: !1,
                    preventLinks: !0,
                    noSwiping: !1,
                    noSwipingClass: "swiper-no-swiping",
                    initialSlide: 0,
                    keyboardControl: !1,
                    mousewheelControl: !1,
                    mousewheelDebounce: 600,
                    useCSS3Transforms: !0,
                    loop: !1,
                    loopAdditionalSlides: 0,
                    calculateHeight: !1,
                    updateOnImagesReady: !0,
                    releaseFormElements: !0,
                    watchActiveIndex: !1,

                    visibilityFullFit: !1,
                    offsetPxBefore: 0,
                    offsetPxAfter: 0,
                    offsetSlidesBefore: 0,
                    offsetSlidesAfter: 0,
                    centeredSlides: !1,
                    queueStartCallbacks: !1,
                    queueEndCallbacks: !1,
                    autoResize: !0,
                    resizeReInit: !1,
                    DOMAnimation: !0,
                    loader: {
                        slides: [],
                        slidesHTMLType: "inner",
                        surroundGroups: 1,
                        logic: "reload",
                        loadAllSlides: !1
                    },
                    slideElement: "div",
                    slideClass: "swiper-slide",
                    slideActiveClass: "swiper-slide-active",
                    slideVisibleClass: "swiper-slide-visible",
                    wrapperClass: "swiper-wrapper",
                    paginationElementClass: "swiper-pagination-switch",
                    paginationActiveClass: "swiper-active-switch",
                    paginationVisibleClass: "swiper-visible-switch"
                };
                aH = aH || {};
                for (var az in ay) {
                    if (az in aH && "object" === typeof aH[az]) {
                        for (var ao in ay[az]) {
                            ao in aH[az] || (aH[az][ao] = ay[az][ao])
                        }
                    } else {
                        az in aH || (aH[az] = ay[az])
                    }
                }
                aI.params = aH;
                aH.scrollContainer && (aH.freeMode = !0, aH.freeModeFluid = !0);
                aH.loop && (aH.resistance = "100%");
                var aD = "horizontal" === aH.mode;
                aI.touchEvents = {
                    touchStart: aI.support.touch || !aH.simulateTouch ? "touchstart" : aI.browser.ie10 ? "MSPointerDown" : "mousedown",
                    touchMove: aI.support.touch || !aH.simulateTouch ? "touchmove" : aI.browser.ie10 ? "MSPointerMove" : "mousemove",
                    touchEnd: aI.support.touch || !aH.simulateTouch ? "touchend" : aI.browser.ie10 ? "MSPointerUp" : "mouseup"
                };
                for (az = aI.container.childNodes.length - 1; 0 <= az; az--) {
                    if (aI.container.childNodes[az].className) {
                        for (ao = aI.container.childNodes[az].className.split(" "), ay = 0; ay < ao.length; ay++) {
                            ao[ay] === aH.wrapperClass && (ai = aI.container.childNodes[az])
                        }
                    }
                }
                aI.wrapper = ai;
                aI._extendSwiperSlide = function (s) {
                    s.append = function () {
                        aH.loop ? (s.insertAfter(aI.slides.length - aI.loopedSlides), aI.removeLoopedSlides(), aI.calcSlides(), aI.createLoop()) : aI.wrapper.appendChild(s);
                        aI.reInit();
                        return s
                    };
                    s.prepend = function () {
                        aH.loop ? (aI.wrapper.insertBefore(s, aI.slides[aI.loopedSlides]), aI.removeLoopedSlides(), aI.calcSlides(), aI.createLoop()) : aI.wrapper.insertBefore(s, aI.wrapper.firstChild);
                        aI.reInit();
                        return s
                    };
                    s.insertAfter = function (t) {
                        if ("undefined" === typeof t) {
                            return !1
                        }
                        aH.loop ? (t = aI.slides[t + 1 + aI.loopedSlides], aI.wrapper.insertBefore(s, t), aI.removeLoopedSlides(), aI.calcSlides(), aI.createLoop()) : (t = aI.slides[t + 1], aI.wrapper.insertBefore(s, t));
                        aI.reInit();
                        return s
                    };
                    s.clone = function () {
                        return aI._extendSwiperSlide(s.cloneNode(!0))
                    };
                    s.remove = function () {
                        aI.wrapper.removeChild(s);
                        aI.reInit()
                    };
                    s.html = function (t) {
                        if ("undefined" === typeof t) {
                            return s.innerHTML
                        }
                        s.innerHTML = t;
                        return s
                    };
                    s.index = function () {
                        for (var t, u = aI.slides.length - 1; 0 <= u; u--) {
                            s === aI.slides[u] && (t = u)
                        }
                        return t
                    };
                    s.isActive = function () {
                        return s.index() === aI.activeIndex ? !0 : !1
                    };
                    s.swiperSlideDataStorage || (s.swiperSlideDataStorage = {});
                    s.getData = function (t) {
                        return s.swiperSlideDataStorage[t]
                    };
                    s.setData = function (u, t) {
                        s.swiperSlideDataStorage[u] = t;
                        return s
                    };
                    s.data = function (u, t) {
                        return t ? (s.setAttribute("data-" + u, t), s) : s.getAttribute("data-" + u)
                    };
                    s.getWidth = function (t) {
                        return aI.h.getWidth(s, t)
                    };
                    s.getHeight = function (t) {
                        return aI.h.getHeight(s, t)
                    };
                    s.getOffset = function () {
                        return aI.h.getOffset(s)
                    };
                    return s
                };
                aI.calcSlides = function (x) {
                    var v = aI.slides ? aI.slides.length : !1;
                    aI.slides = [];
                    aI.displaySlides = [];
                    for (var u = 0; u < aI.wrapper.childNodes.length; u++) {
                        if (aI.wrapper.childNodes[u].className) {
                            for (var t = aI.wrapper.childNodes[u].className.split(" "), s = 0; s < t.length; s++) {
                                t[s] === aH.slideClass && aI.slides.push(aI.wrapper.childNodes[u])
                            }
                        }
                    }
                    for (u = aI.slides.length - 1; 0 <= u; u--) {
                        aI._extendSwiperSlide(aI.slides[u])
                    }
                    v && (v !== aI.slides.length || x) && (av(), ax(), aI.updateActiveSlide(), aH.createPagination && aI.params.pagination && aI.createPagination(), aI.callPlugins("numberOfSlidesChanged"))
                };
                aI.createSlide = function (u, t, s) {
                    t = t || aI.params.slideClass;
                    s = s || aH.slideElement;
                    s = document.createElement(s);
                    s.innerHTML = u || "";
                    s.className = t;
                    return aI._extendSwiperSlide(s)
                };
                aI.appendSlide = function (s, u, t) {
                    if (s) {
                        return s.nodeType ? aI._extendSwiperSlide(s).append() : aI.createSlide(s, u, t).append()
                    }
                };
                aI.prependSlide = function (s, u, t) {
                    if (s) {
                        return s.nodeType ? aI._extendSwiperSlide(s).prepend() : aI.createSlide(s, u, t).prepend()
                    }
                };
                aI.insertSlideAfter = function (s, v, u, t) {
                    return "undefined" === typeof s ? !1 : v.nodeType ? aI._extendSwiperSlide(v).insertAfter(s) : aI.createSlide(v, u, t).insertAfter(s)
                };
                aI.removeSlide = function (s) {
                    if (aI.slides[s]) {
                        if (aH.loop) {
                            if (!aI.slides[s + aI.loopedSlides]) {
                                return !1
                            }
                            aI.slides[s + aI.loopedSlides].remove();
                            aI.removeLoopedSlides();
                            aI.calcSlides();
                            aI.createLoop()
                        } else {
                            aI.slides[s].remove()
                        }
                        return !0
                    }
                    return !1
                };
                aI.removeLastSlide = function () {
                    return 0 < aI.slides.length ? (aH.loop ? (aI.slides[aI.slides.length - 1 - aI.loopedSlides].remove(), aI.removeLoopedSlides(), aI.calcSlides(), aI.createLoop()) : aI.slides[aI.slides.length - 1].remove(), !0) : !1
                };
                aI.removeAllSlides = function () {
                    for (var s = aI.slides.length - 1; 0 <= s; s--) {
                        aI.slides[s].remove()
                    }
                };
                aI.getSlide = function (s) {
                    return aI.slides[s]
                };
                aI.getLastSlide = function () {
                    return aI.slides[aI.slides.length - 1]
                };
                aI.getFirstSlide = function () {
                    return aI.slides[0]
                };
                aI.activeSlide = function () {
                    return aI.slides[aI.activeIndex]
                };
                var ah = [],
                    ag;
                for (ag in aI.plugins) {
                    aH[ag] && (az = aI.plugins[ag](aI, aH[ag])) && ah.push(az)
                }
                aI.callPlugins = function (t, s) {
                    s || (s = {});
                    for (var u = 0; u < ah.length; u++) {
                        if (t in ah[u]) {
                            ah[u][t](s)
                        }
                    }
                };
                aI.browser.ie10 && !aH.onlyExternal && (aD ? aI.wrapper.classList.add("swiper-wp8-horizontal") : aI.wrapper.classList.add("swiper-wp8-vertical"));
                aH.freeMode && (aI.container.className += " swiper-free-mode");
                aI.initialized = !1;
                aI.init = function (G, E) {
                    var D = aI.h.getWidth(aI.container),
                        C = aI.h.getHeight(aI.container);
                    if (D !== aI.width || C !== aI.height || G) {
                        aI.width = D;
                        aI.height = C;
                        aC = aD ? D : C;
                        D = aI.wrapper;
                        G && aI.calcSlides(E);
                        if ("auto" === aH.slidesPerView) {
                            var B = 0,
                                A = 0;
                            0 < aH.slidesOffset && (D.style.paddingLeft = "", D.style.paddingRight = "", D.style.paddingTop = "", D.style.paddingBottom = "");
                            D.style.width = "";
                            D.style.height = "";
                            0 < aH.offsetPxBefore && (aD ? aI.wrapperLeft = aH.offsetPxBefore : aI.wrapperTop = aH.offsetPxBefore);
                            0 < aH.offsetPxAfter && (aD ? aI.wrapperRight = aH.offsetPxAfter : aI.wrapperBottom = aH.offsetPxAfter);
                            aH.centeredSlides && (aD ? (aI.wrapperLeft = (aC - this.slides[0].getWidth(!0)) / 2, aI.wrapperRight = (aC - aI.slides[aI.slides.length - 1].getWidth(!0)) / 2) : (aI.wrapperTop = (aC - aI.slides[0].getHeight(!0)) / 2, aI.wrapperBottom = (aC - aI.slides[aI.slides.length - 1].getHeight(!0)) / 2));
                            aD ? (0 <= aI.wrapperLeft && (D.style.paddingLeft = aI.wrapperLeft + "px"), 0 <= aI.wrapperRight && (D.style.paddingRight = aI.wrapperRight + "px")) : (0 <= aI.wrapperTop && (D.style.paddingTop = aI.wrapperTop + "px"), 0 <= aI.wrapperBottom && (D.style.paddingBottom = aI.wrapperBottom + "px"));

                            var z = 0,
                                x = 0;
                            aI.snapGrid = [];
                            aI.slidesGrid = [];
                            for (var y = 0, v = 0; v < aI.slides.length; v++) {
                                var C = aI.slides[v].getWidth(!0),
                                    K = aI.slides[v].getHeight(!0);
                                aH.calculateHeight && (y = Math.max(y, K));
                                var J = aD ? C : K;
                                if (aH.centeredSlides) {
                                    var I = v === aI.slides.length - 1 ? 0 : aI.slides[v + 1].getWidth(!0),
                                        H = v === aI.slides.length - 1 ? 0 : aI.slides[v + 1].getHeight(!0),
                                        I = aD ? I : H;
                                    if (J > aC) {
                                        for (H = 0; H <= Math.floor(J / (aC + aI.wrapperLeft)); H++) {
                                            0 === H ? aI.snapGrid.push(z + aI.wrapperLeft) : aI.snapGrid.push(z + aI.wrapperLeft + aC * H)
                                        }
                                        aI.slidesGrid.push(z + aI.wrapperLeft)
                                    } else {
                                        aI.snapGrid.push(x), aI.slidesGrid.push(x)
                                    }
                                    x += J / 2 + I / 2
                                } else {
                                    if (J > aC) {
                                        for (H = 0; H <= Math.floor(J / aC); H++) {
                                            aI.snapGrid.push(z + aC * H)
                                        }
                                    } else {
                                        aI.snapGrid.push(z)
                                    }
                                    aI.slidesGrid.push(z)
                                }
                                z += J;
                                B += C;
                                A += K
                            }
                            aH.calculateHeight && (aI.height = y);
                            aD ? (at = B + aI.wrapperRight + aI.wrapperLeft, D.style.width = B + "px", D.style.height = aI.height + "px") : (at = A + aI.wrapperTop + aI.wrapperBottom, D.style.width = aI.width + "px", D.style.height = A + "px")
                        } else {
                            if (aH.scrollContainer) {
                                D.style.width = "", D.style.height = "", y = aI.slides[0].getWidth(!0), B = aI.slides[0].getHeight(!0), at = aD ? y : B, D.style.width = y + "px", D.style.height = B + "px", aA = aD ? y : B
                            } else {
                                if (aH.calculateHeight) {
                                    B = y = 0;
                                    aD || (aI.container.style.height = "");
                                    D.style.height = "";
                                    for (v = 0; v < aI.slides.length; v++) {
                                        aI.slides[v].style.height = "", y = Math.max(aI.slides[v].getHeight(!0), y), aD || (B += aI.slides[v].getHeight(!0))
                                    }
                                    K = y;
                                    aI.height = K;
                                    aD ? B = K : (aC = K, aI.container.style.height = aC + "px")
                                } else {
                                    K = aD ? aI.height : aI.height / aH.slidesPerView, B = aD ? aI.height : aI.slides.length * K
                                }
                                C = aD ? aI.width / aH.slidesPerView : aI.width;
                                y = aD ? aI.slides.length * C : aI.width;
                                aA = aD ? C : K;
                                0 < aH.offsetSlidesBefore && (aD ? aI.wrapperLeft = aA * aH.offsetSlidesBefore : aI.wrapperTop = aA * aH.offsetSlidesBefore);
                                0 < aH.offsetSlidesAfter && (aD ? aI.wrapperRight = aA * aH.offsetSlidesAfter : aI.wrapperBottom = aA * aH.offsetSlidesAfter);
                                0 < aH.offsetPxBefore && (aD ? aI.wrapperLeft = aH.offsetPxBefore : aI.wrapperTop = aH.offsetPxBefore);
                                0 < aH.offsetPxAfter && (aD ? aI.wrapperRight = aH.offsetPxAfter : aI.wrapperBottom = aH.offsetPxAfter);
                                aH.centeredSlides && (aD ? (aI.wrapperLeft = (aC - aA) / 2, aI.wrapperRight = (aC - aA) / 2) : (aI.wrapperTop = (aC - aA) / 2, aI.wrapperBottom = (aC - aA) / 2));
                                aD ? (0 < aI.wrapperLeft && (D.style.paddingLeft = aI.wrapperLeft + "px"), 0 < aI.wrapperRight && (D.style.paddingRight = aI.wrapperRight + "px")) : (0 < aI.wrapperTop && (D.style.paddingTop = aI.wrapperTop + "px"), 0 < aI.wrapperBottom && (D.style.paddingBottom = aI.wrapperBottom + "px"));
                                at = aD ? y + aI.wrapperRight + aI.wrapperLeft : B + aI.wrapperTop + aI.wrapperBottom;
                                D.style.width = y + "px";
                                D.style.height = B + "px";
                                z = 0;
                                aI.snapGrid = [];
                                aI.slidesGrid = [];
                                for (v = 0; v < aI.slides.length; v++) {
                                    aI.snapGrid.push(z), aI.slidesGrid.push(z), z += aA, aI.slides[v].style.width = C + "px", aI.slides[v].style.height = K + "px"
                                }
                            }
                        }
                        if (aI.initialized) {
                            if (aI.callPlugins("onInit"), aH.onFirstInit) {
                                aH.onInit(aI)
                            }
                        } else {
                            if (aI.callPlugins("onFirstInit"), aH.onFirstInit) {
                                aH.onFirstInit(aI)
                            }
                        }
                        aI.initialized = !0
                    }
                };
                aI.reInit = function (s) {
                    aI.init(!0, s)
                };
                aI.resizeFix = function (t) {
                    aI.callPlugins("beforeResizeFix");
                    aI.init(aH.resizeReInit || t);
                    if (!aH.freeMode) {
                        aH.loop ? aI.swipeTo(aI.activeLoopIndex, 0, !1) : aI.swipeTo(aI.activeIndex, 0, !1)
                    } else {
                        if ((aD ? aI.getWrapperTranslate("x") : aI.getWrapperTranslate("y")) < -aE()) {
                            t = aD ? -aE() : 0;
                            var s = aD ? 0 : -aE();
                            aI.setWrapperTransition(0);
                            aI.setWrapperTranslate(t, s, 0)
                        }
                    }
                    aI.callPlugins("afterResizeFix")
                };
                aI.destroy = function (s) {
                    aI.browser.ie10 ? (aI.h.removeEventListener(aI.wrapper, aI.touchEvents.touchStart, ar, !1), aI.h.removeEventListener(document, aI.touchEvents.touchMove, aq, !1), aI.h.removeEventListener(document, aI.touchEvents.touchEnd, ap, !1)) : (aI.support.touch && (aI.h.removeEventListener(aI.wrapper, "touchstart", ar, !1), aI.h.removeEventListener(aI.wrapper, "touchmove", aq, !1), aI.h.removeEventListener(aI.wrapper, "touchend", ap, !1)), aH.simulateTouch && (aI.h.removeEventListener(aI.wrapper, "mousedown", ar, !1), aI.h.removeEventListener(document, "mousemove", aq, !1), aI.h.removeEventListener(document, "mouseup", ap, !1)));
                    aH.autoResize && aI.h.removeEventListener(window, "resize", aI.resizeFix, !1);
                    av();
                    aH.paginationClickable && X();
                    aH.mousewheelControl && aI._wheelEvent && aI.h.removeEventListener(aI.container, aI._wheelEvent, ae, !1);
                    aH.keyboardControl && aI.h.removeEventListener(document, "keydown", ad, !1);
                    aH.autoplay && aI.stopAutoplay();
                    aI.callPlugins("onDestroy");
                    aI = null
                };
                aH.grabCursor && (aI.container.style.cursor = "move", aI.container.style.cursor = "grab", aI.container.style.cursor = "-moz-grab", aI.container.style.cursor = "-webkit-grab");
                aI.allowSlideClick = !0;
                aI.allowLinks = !0;
                var aw = !1,
                    af, al = !0,
                    an, ak;
                aI.swipeNext = function (u) {
                    !u && aH.loop && aI.fixLoop();
                    aI.callPlugins("onSwipeNext");
                    var t = u = aD ? aI.getWrapperTranslate("x") : aI.getWrapperTranslate("y");
                    if ("auto" == aH.slidesPerView) {
                        for (var s = 0; s < aI.snapGrid.length; s++) {
                            if (-u >= aI.snapGrid[s] && -u < aI.snapGrid[s + 1]) {
                                t = -aI.snapGrid[s + 1];
                                break
                            }
                        }
                    } else {
                        t = aA * aH.slidesPerGroup, t = -(Math.floor(Math.abs(u) / Math.floor(t)) * t + t)
                    }
                    t < -aE() && (t = -aE());
                    if (t == u) {
                        return !1
                    }
                    aj(t, "next");
                    return !0
                };
                aI.swipePrev = function (u) {
                    !u && aH.loop && aI.fixLoop();
                    !u && aH.autoplay && aI.stopAutoplay();
                    aI.callPlugins("onSwipePrev");
                    u = Math.ceil(aD ? aI.getWrapperTranslate("x") : aI.getWrapperTranslate("y"));
                    var t;
                    if ("auto" == aH.slidesPerView) {
                        t = 0;
                        for (var s = 1; s < aI.snapGrid.length; s++) {
                            if (-u == aI.snapGrid[s]) {
                                t = -aI.snapGrid[s - 1];
                                break
                            }
                            if (-u > aI.snapGrid[s] && -u < aI.snapGrid[s + 1]) {
                                t = -aI.snapGrid[s];
                                break
                            }
                        }
                    } else {
                        t = aA * aH.slidesPerGroup, t *= -(Math.ceil(-u / t) - 1)
                    }
                    0 < t && (t = 0);
                    if (t == u) {
                        return !1
                    }
                    aj(t, "prev");
                    return !0
                };
                aI.swipeReset = function () {
                    aI.callPlugins("onSwipeReset");
                    var u = aD ? aI.getWrapperTranslate("x") : aI.getWrapperTranslate("y"),
                        t = aA * aH.slidesPerGroup;
                    aE();
                    if ("auto" == aH.slidesPerView) {
                        for (var s = t = 0; s < aI.snapGrid.length; s++) {
                            if (-u === aI.snapGrid[s]) {
                                return
                            }
                            if (-u >= aI.snapGrid[s] && -u < aI.snapGrid[s + 1]) {
                                t = 0 < aI.positions.diff ? -aI.snapGrid[s + 1] : -aI.snapGrid[s];
                                break
                            }
                        } - u >= aI.snapGrid[aI.snapGrid.length - 1] && (t = -aI.snapGrid[aI.snapGrid.length - 1]);
                        u <= -aE() && (t = -aE())
                    } else {
                        t = 0 > u ? Math.round(u / t) * t : 0
                    }
                    aH.scrollContainer && (t = 0 > u ? u : 0);
                    t < -aE() && (t = -aE());
                    aH.scrollContainer && aC > aA && (t = 0);
                    if (t == u) {
                        return !1
                    }
                    aj(t, "reset");
                    return !0
                };
                aI.swipeTo = function (x, v, u) {
                    x = parseInt(x, 10);
                    aI.callPlugins("onSwipeTo", {
                        index: x,
                        speed: v
                    });
                    aH.loop && (x += aI.loopedSlides);
                    var t = aD ? aI.getWrapperTranslate("x") : aI.getWrapperTranslate("y");
                    if (!(x > aI.slides.length - 1 || 0 > x)) {
                        var s;
                        s = "auto" == aH.slidesPerView ? -aI.slidesGrid[x] : -x * aA;
                        s < -aE() && (s = -aE());
                        if (s == t) {
                            return !1
                        }
                        aj(s, "to", {
                            index: x,
                            speed: v,
                            runCallbacks: !1 === u ? !1 : !0
                        });
                        return !0
                    }
                };
                aI._queueStartCallbacks = !1;
                aI._queueEndCallbacks = !1;
                aI.updateActiveSlide = function (v) {
                    if (aI.initialized && 0 != aI.slides.length) {
                        aI.previousIndex = aI.activeIndex;
                        0 < v && (v = 0);
                        "undefined" == typeof v && (v = aD ? aI.getWrapperTranslate("x") : aI.getWrapperTranslate("y"));
                        if ("auto" == aH.slidesPerView) {
                            if (aI.activeIndex = aI.slidesGrid.indexOf(-v), 0 > aI.activeIndex) {
                                for (var u = 0; u < aI.slidesGrid.length - 1 && !(-v > aI.slidesGrid[u] && -v < aI.slidesGrid[u + 1]); u++) {}
                                var t = Math.abs(aI.slidesGrid[u] + v),
                                    s = Math.abs(aI.slidesGrid[u + 1] + v);
                                aI.activeIndex = t <= s ? u : u + 1
                            }
                        } else {
                            aI.activeIndex = aH.visibilityFullFit ? Math.ceil(-v / aA) : Math.round(-v / aA)
                        }
                        aI.activeIndex == aI.slides.length && (aI.activeIndex = aI.slides.length - 1);
                        0 > aI.activeIndex && (aI.activeIndex = 0);
                        if (aI.slides[aI.activeIndex]) {
                            aI.calcVisibleSlides(v);
                            t = RegExp("\\s*" + aH.slideActiveClass);
                            s = RegExp("\\s*" + aH.slideVisibleClass);
                            for (u = 0; u < aI.slides.length; u++) {
                                aI.slides[u].className = aI.slides[u].className.replace(t, "").replace(s, ""), 0 <= aI.visibleSlides.indexOf(aI.slides[u]) && (aI.slides[u].className += " " + aH.slideVisibleClass)
                            }
                            aI.slides[aI.activeIndex].className += " " + aH.slideActiveClass;
                            aH.loop ? (u = aI.loopedSlides, aI.activeLoopIndex = aI.activeIndex - u, aI.activeLoopIndex >= aI.slides.length - 2 * u && (aI.activeLoopIndex = aI.slides.length - 2 * u - aI.activeLoopIndex), 0 > aI.activeLoopIndex && (aI.activeLoopIndex = aI.slides.length - 2 * u + aI.activeLoopIndex)) : aI.activeLoopIndex = aI.activeIndex;
                            aH.pagination && aI.updatePagination(v)
                        }
                    }
                };
                aI.createPagination = function (v) {
                    aH.paginationClickable && aI.paginationButtons && X();
                    var u = "",
                        t = aI.slides.length;
                    aH.loop && (t -= 2 * aI.loopedSlides);
                    for (var s = 0; s < t; s++) {
                        u += "<" + aH.paginationElement + ' class="' + aH.paginationElementClass + '"></' + aH.paginationElement + ">"
                    }
                    aI.paginationContainer = aH.pagination.nodeType ? aH.pagination : aF(aH.pagination)[0];
                    aI.paginationContainer.innerHTML = u;
                    aI.paginationButtons = [];
                    document.querySelectorAll ? aI.paginationButtons = aI.paginationContainer.querySelectorAll("." + aH.paginationElementClass) : window.jQuery && (aI.paginationButtons = aF(aI.paginationContainer).find("." + aH.paginationElementClass));
                    v || aI.updatePagination();
                    aI.callPlugins("onCreatePagination");
                    if (aH.paginationClickable) {
                        for (v = aI.paginationButtons, u = 0; u < v.length; u++) {
                            aI.h.addEventListener(v[u], "click", F, !1)
                        }
                    }
                };
                aI.updatePagination = function (x) {
                    if (aH.pagination && !(1 > aI.slides.length)) {
                        if (document.querySelectorAll) {
                            var v = aI.paginationContainer.querySelectorAll("." + aH.paginationActiveClass)
                        } else {
                            window.jQuery && (v = aF(aI.paginationContainer).find("." + aH.paginationActiveClass))
                        }
                        if (v && (v = aI.paginationButtons, 0 != v.length)) {
                            for (var u = 0; u < v.length; u++) {
                                v[u].className = aH.paginationElementClass
                            }
                            var t = aH.loop ? aI.loopedSlides : 0;
                            if (aH.paginationAsRange) {
                                aI.visibleSlides || aI.calcVisibleSlides(x);
                                x = [];
                                for (u = 0; u < aI.visibleSlides.length; u++) {
                                    var s = aI.slides.indexOf(aI.visibleSlides[u]) - t;
                                    aH.loop && 0 > s && (s = aI.slides.length - 2 * aI.loopedSlides + s);
                                    aH.loop && s >= aI.slides.length - 2 * aI.loopedSlides && (s = aI.slides.length - 2 * aI.loopedSlides - s, s = Math.abs(s));
                                    x.push(s)
                                }
                                for (u = 0; u < x.length; u++) {
                                    v[x[u]] && (v[x[u]].className += " " + aH.paginationVisibleClass)
                                }
                                aH.loop ? v[aI.activeLoopIndex].className += " " + aH.paginationActiveClass : v[aI.activeIndex].className += " " + aH.paginationActiveClass
                            } else {
                                aH.loop ? v[aI.activeLoopIndex].className += " " + aH.paginationActiveClass + " " + aH.paginationVisibleClass : v[aI.activeIndex].className += " " + aH.paginationActiveClass + " " + aH.paginationVisibleClass
                            }
                        }
                    }
                };
                aI.calcVisibleSlides = function (z) {
                    var y = [],
                        x = 0,
                        v = 0,
                        u = 0;
                    aD && 0 < aI.wrapperLeft && (z += aI.wrapperLeft);
                    !aD && 0 < aI.wrapperTop && (z += aI.wrapperTop);
                    for (var t = 0; t < aI.slides.length; t++) {
                        var x = x + v,
                            v = "auto" == aH.slidesPerView ? aD ? aI.h.getWidth(aI.slides[t], !0) : aI.h.getHeight(aI.slides[t], !0) : aA,
                            u = x + v,
                            s = !1;
                        aH.visibilityFullFit ? (x >= -z && u <= -z + aC && (s = !0), x <= -z && u >= -z + aC && (s = !0)) : (u > -z && u <= -z + aC && (s = !0), x >= -z && x < -z + aC && (s = !0), x < -z && u > -z + aC && (s = !0));
                        s && y.push(aI.slides[t])
                    }
                    0 == y.length && (y = [aI.slides[aI.activeIndex]]);
                    aI.visibleSlides = y
                };
                aI.autoPlayIntervalId = void 0;
                aI.startAutoplay = function () {
                    if ("undefined" !== typeof aI.autoPlayIntervalId) {
                        return !1
                    }
                    aH.autoplay && !aH.loop && (aI.autoPlayIntervalId = setInterval(function () {
                        aI.swipeNext(!0) || aI.swipeTo(0)
                    }, aH.autoplay));
                    aH.autoplay && aH.loop && (aI.autoPlayIntervalId = setInterval(function () {
                        aI.swipeNext()
                    }, aH.autoplay));
                    aI.callPlugins("onAutoplayStart")
                };
                aI.stopAutoplay = function () {
                    aI.autoPlayIntervalId && clearInterval(aI.autoPlayIntervalId);
                    aI.autoPlayIntervalId = void 0;
                    aI.callPlugins("onAutoplayStop")
                };
                aI.loopCreated = !1;
                aI.removeLoopedSlides = function () {
                    if (aI.loopCreated) {
                        for (var s = 0; s < aI.slides.length; s++) {
                            !0 === aI.slides[s].getData("looped") && aI.wrapper.removeChild(aI.slides[s])
                        }
                    }
                };
                aI.createLoop = function () {
                    if (0 != aI.slides.length) {
                        aI.loopedSlides = aH.slidesPerView + aH.loopAdditionalSlides;
                        for (var u = "", t = "", s = 0; s < aI.loopedSlides; s++) {
                            u += aI.slides[s].outerHTML
                        }
                        for (s = aI.slides.length - aI.loopedSlides; s < aI.slides.length; s++) {
                            t += aI.slides[s].outerHTML
                        }
                        ai.innerHTML = t + ai.innerHTML + u;
                        aI.loopCreated = !0;
                        aI.calcSlides();
                        for (s = 0; s < aI.slides.length; s++) {
                            (s < aI.loopedSlides || s >= aI.slides.length - aI.loopedSlides) && aI.slides[s].setData("looped", !0)
                        }
                        aI.callPlugins("onCreateLoop")
                    }
                };
                aI.fixLoop = function () {
                    if (aI.activeIndex < aI.loopedSlides) {
                        var s = aI.slides.length - 3 * aI.loopedSlides + aI.activeIndex;
                        aI.swipeTo(s, 0, !1)
                    } else {
                        aI.activeIndex > aI.slides.length - 2 * aH.slidesPerView && (s = -aI.slides.length + aI.activeIndex + aI.loopedSlides, aI.swipeTo(s, 0, !1))
                    }
                };
                aI.loadSlides = function () {
                    var v = "";
                    aI.activeLoaderIndex = 0;
                    for (var u = aH.loader.slides, t = aH.loader.loadAllSlides ? u.length : aH.slidesPerView * (1 + aH.loader.surroundGroups), s = 0; s < t; s++) {
                        v = "outer" == aH.loader.slidesHTMLType ? v + u[s] : v + ("<" + aH.slideElement + ' class="' + aH.slideClass + '" data-swiperindex="' + s + '">' + u[s] + "</" + aH.slideElement + ">")
                    }
                    aI.wrapper.innerHTML = v;
                    aI.calcSlides(!0);
                    aH.loader.loadAllSlides || aI.wrapperTransitionEnd(aI.reloadSlides, !0)
                };
                aI.reloadSlides = function () {
                    var z = aH.loader.slides,
                        y = parseInt(aI.activeSlide().data("swiperindex"), 10);
                    if (!(0 > y || y > z.length - 1)) {
                        aI.activeLoaderIndex = y;
                        var x = Math.max(0, y - aH.slidesPerView * aH.loader.surroundGroups),
                            v = Math.min(y + aH.slidesPerView * (1 + aH.loader.surroundGroups) - 1, z.length - 1);
                        0 < y && (y = -aA * (y - x), aD ? aI.setWrapperTranslate(y, 0, 0) : aI.setWrapperTranslate(0, y, 0), aI.setWrapperTransition(0));
                        if ("reload" === aH.loader.logic) {
                            for (var u = aI.wrapper.innerHTML = "", y = x; y <= v; y++) {
                                u += "outer" == aH.loader.slidesHTMLType ? z[y] : "<" + aH.slideElement + ' class="' + aH.slideClass + '" data-swiperindex="' + y + '">' + z[y] + "</" + aH.slideElement + ">"
                            }
                            aI.wrapper.innerHTML = u
                        } else {
                            for (var u = 1000, t = 0, y = 0; y < aI.slides.length; y++) {
                                var s = aI.slides[y].data("swiperindex");
                                s < x || s > v ? aI.wrapper.removeChild(aI.slides[y]) : (u = Math.min(s, u), t = Math.max(s, t))
                            }
                            for (y = x; y <= v; y++) {
                                y < u && (x = document.createElement(aH.slideElement), x.className = aH.slideClass, x.setAttribute("data-swiperindex", y), x.innerHTML = z[y], aI.wrapper.insertBefore(x, aI.wrapper.firstChild)), y > t && (x = document.createElement(aH.slideElement), x.className = aH.slideClass, x.setAttribute("data-swiperindex", y), x.innerHTML = z[y], aI.wrapper.appendChild(x))
                            }
                        }
                        aI.reInit(!0)
                    }
                };
                aI.calcSlides();
                0 < aH.loader.slides.length && 0 == aI.slides.length && aI.loadSlides();
                aH.loop && aI.createLoop();
                aI.init();
                aB();
                aH.pagination && aH.createPagination && aI.createPagination(!0);
                aH.loop || 0 < aH.initialSlide ? aI.swipeTo(aH.initialSlide, 0, !1) : aI.updateActiveSlide(0);
                aH.autoplay && aI.startAutoplay()
            }
        };
    b.prototype = {
        plugins: {},
        wrapperTransitionEnd: function (z, s) {
            function y() {
                z(x);
                x.params.queueEndCallbacks && (x._queueEndCallbacks = !1);
                if (!s) {
                    for (var t = 0; t < w.length; t++) {
                        x.h.removeEventListener(A, w[t], y, !1)
                    }
                }
            }
            var x = this,
                A = x.wrapper,
                w = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"];
            if (z) {
                for (var u = 0; u < w.length; u++) {
                    x.h.addEventListener(A, w[u], y, !1)
                }
            }
        },
        getWrapperTranslate: function (v) {
            var s = this.wrapper,
                u, t, w = window.WebKitCSSMatrix ? new WebKitCSSMatrix(window.getComputedStyle(s, null).webkitTransform) : window.getComputedStyle(s, null).MozTransform || window.getComputedStyle(s, null).OTransform || window.getComputedStyle(s, null).MsTransform || window.getComputedStyle(s, null).msTransform || window.getComputedStyle(s, null).transform || window.getComputedStyle(s, null).getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,");
            u = w.toString().split(",");
            this.params.useCSS3Transforms ? ("x" == v && (t = 16 == u.length ? parseFloat(u[12]) : window.WebKitCSSMatrix ? w.m41 : parseFloat(u[4])), "y" == v && (t = 16 == u.length ? parseFloat(u[13]) : window.WebKitCSSMatrix ? w.m42 : parseFloat(u[5]))) : ("x" == v && (t = parseFloat(s.style.left, 10) || 0), "y" == v && (t = parseFloat(s.style.top, 10) || 0));
            return t || 0
        },
        setWrapperTranslate: function (v, s, u) {
            var t = this.wrapper.style;
            v = v || 0;
            s = s || 0;
            u = u || 0;
            this.params.useCSS3Transforms ? this.support.transforms3d ? t.webkitTransform = t.MsTransform = t.msTransform = t.MozTransform = t.OTransform = t.transform = "translate3d(" + v + "px, " + s + "px, " + u + "px)" : (t.webkitTransform = t.MsTransform = t.msTransform = t.MozTransform = t.OTransform = t.transform = "translate(" + v + "px, " + s + "px)", this.support.transforms || (t.left = v + "px", t.top = s + "px")) : (t.left = v + "px", t.top = s + "px");
            this.callPlugins("onSetWrapperTransform", {
                x: v,
                y: s,
                z: u
            })
        },
        setWrapperTransition: function (t) {
            var s = this.wrapper.style;
            s.webkitTransitionDuration = s.MsTransitionDuration = s.msTransitionDuration = s.MozTransitionDuration = s.OTransitionDuration = s.transitionDuration = t / 1000 + "s";
            this.callPlugins("onSetWrapperTransition", {
                duration: t
            })
        },
        h: {
            getWidth: function (v, s) {
                var u = window.getComputedStyle(v, null).getPropertyValue("width"),
                    t = parseFloat(u);
                if (isNaN(t) || 0 < u.indexOf("%")) {
                    t = v.offsetWidth - parseFloat(window.getComputedStyle(v, null).getPropertyValue("padding-left")) - parseFloat(window.getComputedStyle(v, null).getPropertyValue("padding-right"))
                }
                s && (t += parseFloat(window.getComputedStyle(v, null).getPropertyValue("padding-left")) + parseFloat(window.getComputedStyle(v, null).getPropertyValue("padding-right")));
                return t
            },
            getHeight: function (v, s) {
                if (s) {
                    return v.offsetHeight
                }
                var u = window.getComputedStyle(v, null).getPropertyValue("height"),
                    t = parseFloat(u);
                if (isNaN(t) || 0 < u.indexOf("%")) {
                    t = v.offsetHeight - parseFloat(window.getComputedStyle(v, null).getPropertyValue("padding-top")) - parseFloat(window.getComputedStyle(v, null).getPropertyValue("padding-bottom"))
                }
                s && (t += parseFloat(window.getComputedStyle(v, null).getPropertyValue("padding-top")) + parseFloat(window.getComputedStyle(v, null).getPropertyValue("padding-bottom")));
                return t
            },
            getOffset: function (v) {
                var s = v.getBoundingClientRect(),
                    u = document.body,
                    t = v.clientTop || u.clientTop || 0,
                    u = v.clientLeft || u.clientLeft || 0,
                    w = window.pageYOffset || v.scrollTop;
                v = window.pageXOffset || v.scrollLeft;
                document.documentElement && !window.pageYOffset && (w = document.documentElement.scrollTop, v = document.documentElement.scrollLeft);
                return {
                    top: s.top + w - t,
                    left: s.left + v - u
                }
            },
            windowWidth: function () {
                if (window.innerWidth) {
                    return window.innerWidth
                }
                if (document.documentElement && document.documentElement.clientWidth) {
                    return document.documentElement.clientWidth
                }
            },
            windowHeight: function () {
                if (window.innerHeight) {
                    return window.innerHeight
                }
                if (document.documentElement && document.documentElement.clientHeight) {
                    return document.documentElement.clientHeight
                }
            },
            windowScroll: function () {
                if ("undefined" != typeof pageYOffset) {
                    return {
                        left: window.pageXOffset,
                        top: window.pageYOffset
                    }
                }
                if (document.documentElement) {
                    return {
                        left: document.documentElement.scrollLeft,
                        top: document.documentElement.scrollTop
                    }
                }
            },
            addEventListener: function (v, s, u, t) {
                v.addEventListener ? v.addEventListener(s, u, t) : v.attachEvent && v.attachEvent("on" + s, u)
            },
            removeEventListener: function (v, s, u, t) {
                v.removeEventListener ? v.removeEventListener(s, u, t) : v.detachEvent && v.detachEvent("on" + s, u)
            }
        },
        setTransform: function (u, s) {
            var t = u.style;
            t.webkitTransform = t.MsTransform = t.msTransform = t.MozTransform = t.OTransform = t.transform = s
        },
        setTranslate: function (x, s) {
            var w = x.style,
                v = s.x || 0,
                y = s.y || 0,
                u = s.z || 0;
            w.webkitTransform = w.MsTransform = w.msTransform = w.MozTransform = w.OTransform = w.transform = this.support.transforms3d ? "translate3d(" + v + "px," + y + "px," + u + "px)" : "translate(" + v + "px," + y + "px)";
            this.support.transforms || (w.left = v + "px", w.top = y + "px")
        },
        setTransition: function (u, s) {
            var t = u.style;
            t.webkitTransitionDuration = t.MsTransitionDuration = t.msTransitionDuration = t.MozTransitionDuration = t.OTransitionDuration = t.transitionDuration = s + "ms"
        },
        support: {
            touch: window.Modernizr && !0 === Modernizr.touch ||
            function () {
                return !!("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch)
            }(),
            transforms3d: window.Modernizr && !0 === Modernizr.csstransforms3d ||
            function () {
                var s = document.createElement("div");
                return "webkitPerspective" in s.style || "MozPerspective" in s.style || "OPerspective" in s.style || "MsPerspective" in s.style || "perspective" in s.style
            }(),
            transforms: window.Modernizr && !0 === Modernizr.csstransforms ||
            function () {
                var s = document.createElement("div").style;
                return "transform" in s || "WebkitTransform" in s || "MozTransform" in s || "msTransform" in s || "MsTransform" in s || "OTransform" in s
            }(),
            transitions: window.Modernizr && !0 === Modernizr.csstransitions ||
            function () {
                var s = document.createElement("div").style;
                return "transition" in s || "WebkitTransition" in s || "MozTransition" in s || "msTransition" in s || "MsTransition" in s || "OTransition" in s
            }()
        },
        browser: {
            ie8: function () {
                var s = -1;
                "Microsoft Internet Explorer" == navigator.appName && null != /MSIE ([0-9]{1,}[.0-9]{0,})/.exec(navigator.userAgent) && (s = parseFloat(RegExp.$1));
                return -1 != s && 9 > s
            }(),
            ie10: window.navigator.msPointerEnabled
        }
    };
    (window.jQuery || window.Zepto) &&
    function (s) {
        s.fn.swiper = function (t) {
            t = new b(s(this)[0], t);
            s(this).data("swiper", t);
            return t
        }
    }(window.jQuery || window.Zepto);
    "undefined" !== typeof module && (module.exports = b);
    var r;
    var c = 0;
    var e = 0;
    var p = 0;
    var l = 0;
    var a = 0;
    h(window).on("resize", function () {
        if (a == 1) {} else {
            var s = window.innerHeight;
            s = (s * -1) - 18;
            h("#cnNotificationCenter").animate({
                top: s,
            }, 0)
        }
        q();
        d()
    });
    h(document).ready(function () {
        var s = window.innerHeight;
        s = (s * -1) - 18;
        var t = '<div id="cnNotificationCenter" style="top:' + s + 'px"><div align="center" class="cnFull"><div class="cnEmptySpace">' + o + '</div><div id="cnNotificationBody"><div class="swiper-containerCrystalNotification"><div class="swiper-wrapper"></div> </div> <div class="cnBottomBar">__________</div></div></div>';
        h("body").prepend(t);
        r = new b(".swiper-containerCrystalNotification", {
            mode: "vertical",
            loop: false,
            freeMode: true,
            freeModeFluid: true,
            slidesPerView: "auto",
            mousewheelControl: true,
        });
        c = 0;
        h(".cnBottomBar").bind("click", function () {
            k()
        });
        h("body").keyup(function (v) {
            if (v.keyCode == 27) {
                if (a == 1) {
                    a = 0;
                    var u = window.innerHeight;
                    u = (u * -1) - 18;
                    h("#cnNotificationCenter").animate({
                        top: u,
                    }, 550)
                }
            }
        })
    });
    h.CrystalNotification = function (u, y) {
        k();
        e += 1;
        u = h.extend({
            title: "Information",
            image: undefined,
            content: "",
            sound: true,
            panelbutton: true,
            closebutton: true,
            timeout: undefined,
            addtopanel: true,
        }, u);
        var s = "#CrystalNotification" + e;
        h(".cnLastOneContainer").slideUp(300, function () {
            h(".cnLastOneContainer:not(" + s + ")").remove()
        });
        var w = "cnCloseButton" + e;
        var v = "";
        v += '<div class="cnLastOneContainer" id="CrystalNotification' + e + '">';
        if (u.closebutton) {
            v += '<div class="cnNotiClose" id="cnCloseButton' + e + '" crystalnumber="' + e + '">';
            v += "X";
            v += "</div>"
        }
        v += '<div align="center">';
        v += '<div class="cnContainer">';
        v += '<div class="cnNotiImageContainer">';
        if (u.image != undefined) {
            v += '<img src="' + u.image + '" class="cnNotiImg">'
        }
        v += "</div>";
        v += '<div class="cnNotiContentContainer animated fadeIn">';
        v += '<span class="cnNotiTitulo">';
        v += u.title;
        v += "</span>";
        v += u.content;
        v += "</div>";
        if (u.panelbutton) {
            v += '<div class="cnParteBaja">';
            v += "__________";
            v += "</div>"
        }
        v += "</div>	";
        v += "</div>";
        v += "</div>";
        h("body").prepend(v);
        h(s).slideDown(300);
        q();
        if (u.sound === true) {
            if (f() == 0) {
                var x = document.createElement("audio");
                if (navigator.userAgent.match("Firefox/")) {
                    x.setAttribute("src", "static/sound/crystal.ogg")
                } else {
                    x.setAttribute("src", "static/sound/crystal.mp3")
                }
                h.get();
                x.addEventListener("load", function () {
                    x.play()
                }, true);
                x.pause();
                x.play()
            }
        }
        if (u.timeout != undefined) {
            setTimeout(function () {
                if (typeof y == "function") {
                    if (y) {
                        y()
                    }
                }
                h(s).slideUp(300, function () {
                    h(s).remove()
                })
            }, u.timeout)
        }
        var t = undefined;
        if (typeof y == "function") {
            t = y
        }
        if (u.addtopanel) {
            h.CrystalNotificationPanel({
                title: u.title,
                image: u.image,
                content: u.content,
            }, t)
        }
        if (u.closebutton) {
            h("#" + w).bind("click", function () {
                var A = h(this).attr("crystalnumber");
                var z = "#CrystalNotification" + A;
                h(z).slideUp(300);
                if (typeof y == "function") {
                    if (y) {
                        y(true)
                    }
                }
            })
        }
    };
    h.CrystalNotificationPanel = function (u, A) {
        if (u == undefined) {
            return
        }
        p += 1;
        h(".cnEmptySpace").fadeOut(200);
        u = h.extend({
            title: "Information",
            image: undefined,
            content: "",
        }, u);
        var z = "";
        var t = false;
        h(".cnTitleArray").each(function (C) {
            var B = h(this).html();
            if (u.title == B) {
                t = true;
                c = h(this).next().attr("tagid")
            }
        });
        if (!t) {
            c += 1;
            z += '<div class="cnItem animated fadeIn fast" tagid="' + c + '">';
            z += '<div class="cnItemImageContainer">';
            if (u.image != undefined) {
                z += '<img src="' + u.image + '" class="cnItemImage">'
            }
            z += "</div>";
            z += '<div class="cnItemTitleContainer">';
            z += '<span class="cnTitleArray">' + u.title + "</span>";
            z += '<span class="cnTitleClose" tagid="' + c + '">X</span>';
            z += "</div>";
            z += "</div>";
            var y = r.createSlide(z);
            y.prepend();
            z = "";
            z += '<div class="cnItemDescripcion animated fadeIn fast" ID="CrystalPanelItem' + p + '" tagid="' + c + '">';
            z += '<span class="cnItemTitleDescription">' + u.title + "</span>";
            z += u.content;
            z += "</div>";
            var y = r.createSlide(z);
            y.insertAfter(0)
        } else {
            for (i = 0; i < r.slides.length; i++) {
                var v = false;
                var s = h("<div>" + r.slides[i].html() + "</div>");
                if (s.find(".cnItem").length > 0) {
                    var x = s.find(".cnTitleArray").html();
                    if (x == u.title) {
                        var w = s.find(".cnItem");
                        z = "";
                        z += '<div class="cnItemDescripcion animated fadeIn fast" ID="CrystalPanelItem' + p + '" tagid="' + c + '">';
                        z += '<span class="cnItemTitleDescription">' + u.title + "</span>";
                        z += u.content;
                        z += "</div>";
                        var y = r.createSlide(z);
                        r.insertSlideAfter(i, y);
                        i = r.slides.length
                    }
                }
            }
        }
        h("#CrystalPanelItem" + p).bind("click", function () {
            if (typeof A == "function") {
                if (A) {
                    A()
                }
            }
        });
        d();
        r.reInit()
    };

    function n() {
        a = 1;
        j();
        var s = window.innerHeight;
        s = (s * -1) - 18;
        s = s * -1;
        h("#cnNotificationCenter").animate({
            top: 0,
        }, 750)
    }

    function j() {
        h(".cnLastOneContainer").slideUp(400, function () {
            h(this).remove()
        })
    }

    function k() {
        a = 0;
        var s = window.innerHeight;
        s = (s * -1) - 18;
        h("#cnNotificationCenter").animate({
            top: s,
        })
    }
    h(document).on("click", ".cnTitleClose", function () {
        var y = h(this).attr("tagid");
        var x = r.slides.length - 1;
        var w = "";
        for (var u = x; u >= 0; u--) {
            var v = false;
            var s = h("<div>" + r.slides[u].html() + "</div>");
            var t = s.find(".cnItemDescripcion").attr("tagid");
            t = s.find(".cnItem").attr("tagid");
            if (t == y) {
                w = s.find(".cnTitleArray").text();
                r.removeSlide(u)
            }
        }
        x = r.slides.length - 1;
        for (u = x; u >= 0; u--) {
            var v = false;
            var s = h("<div>" + r.slides[u].html() + "</div>");
            var t = s.find(".cnItemDescripcion").attr("tagid");
            var w = "";
            console.log(y + "   " + t + "  " + w);
            if (y == t) {
                r.removeSlide(u)
            }
        }
        r.swipeTo(0);
        r.reInit();
        if (r.slides.length == 0) {
            h(".cnEmptySpace").fadeIn(300)
        }
    });
    h(document).on("click", ".cnParteBaja", function () {
        n()
    });
    h.CrystalNuke = function () {
        r.removeAllSlides();
        r.reInit();
        h(".cnEmptySpace").fadeIn(300)
    };

    function g() {
        var u = -1;
        if (navigator.appName == "Microsoft Internet Explorer") {
            var s = navigator.userAgent;
            var t = new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");
            if (t.exec(s) != null) {
                u = parseFloat(RegExp.$1)
            }
        }
        return u
    }

    function m() {
        var t = "You're not using Windows Internet Explorer.";
        var s = g();
        if (s > -1) {
            if (s >= 8) {
                t = "You're using a recent copy of Windows Internet Explorer."
            } else {
                t = "You should upgrade your copy of Windows Internet Explorer."
            }
        }
        alert(t)
    }

    function f() {
        var t = "0";
        var s = g();
        if (s > -1) {
            if (s >= 9) {
                t = 0
            } else {
                t = 1
            }
        }
        return t
    }
    h.ShowNotificationPanel = function () {
        a = 1;
        j();
        d()
    };

    function q() {
        var u = window.innerWidth;
        if (u <= 546) {
            h(".cnContainer").css("width", "100%");
            h(".cnNotiImageContainer").css("width", "40px");
            var s = u - 43;
            var t = u - 100;
            h(".cnNotiContentContainer").css("width", t + "px");
            h(".cnNotiContentContainer").css("font-size", "12px");
            h(".cnNotiTitulo").css("font-size", "12px")
        } else {
            h(".cnNotiTitulo").css("font-size", "16px");
            h(".cnNotiContentContainer").css("font-size", "14px");
            h(".cnContainer").css("width", "500px");
            h(".cnNotiContentContainer").css("width", "440px");
            h(".cnNotiImageContainer").css("width", "55px")
        }
    }

    function d() {
        var u = window.innerWidth;
        var s = h(".cnEmptySpace").width();
        h(".cnEmptySpace").css("left", ((u - s) / 2) + "px");
        if (u <= 506) {
            var t = u - 60;
            var v = (u - 100) / 2;
            h(".cnBottomBar").css({
                position: "absolute",
                left: v + "px",
            });
            h(".cnItemDescripcion").css("font-size", "12px");
            h(".cnNotiContentContainer").css("font-size", "12px");
            h(".swiper-containerCrystalNotification").css("width", "100%");
            h(".cnItemTitleContainer").css("width", t + "px");
            h(".cnItemDescripcion").css("width", t + "px")
        } else {
            h(".cnBottomBar").css({
                position: "relative",
                left: "0px",
            });
            h(".cnItemDescripcion").css("font-size", "14px");
            h(".cnNotiContentContainer").css("font-size", "14px");
            h(".swiper-containerCrystalNotification").css("width", "500px");
            h(".cnItemTitleContainer").css("width", "440px");
            h(".cnItemDescripcion").css("width", "440px");
            h(".cnEmptySpace").css("left", "40%")
        }
    }
})(jQuery);

function ShowCrystalNotificationPanel() {
    $.ShowNotificationPanel();
    var a = window.innerHeight;
    a = (a * -1) - 18;
    a = a * -1;
    $("#cnNotificationCenter").animate({
        top: 0,
    }, 750)
}

function CloseCrystalNotificationPanel() {
    isOpen = 0;
    var a = window.innerHeight;
    a = (a * -1) - 18;
    $("#cnNotificationCenter").animate({
        top: a,
    }, 550)
}

function CloseAllCrystals() {
    $(".cnLastOneContainer").slideUp(300, function () {
        $(this).remove()
    })
}

function NukeAllTheNotifications() {
    $.CrystalNuke()
}; 
