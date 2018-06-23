﻿diffview = {
    buildView: function (b) {
        function y(a, b) {
            var c = document.createElement(a);
            c.className = b;
            return c
        }

        function p(a, b) {
            var c = document.createElement(a);
            c.appendChild(document.createTextNode(b));
            return c
        }

        function k(a, b, c) {
            a = document.createElement(a);
            a.className = b;
            a.innerHTML = c;
            return a
        }

        function z(a, b, c, d, e) {
            if (b < c)return a.appendChild(p("th", (b + 1).toString())), a.appendChild(k("td", e, d[b].replace(/\t/g, "    "))), b + 1;
            a.appendChild(document.createElement("th"));
            a.appendChild(y("td", "empty"));
            return b
        }

        function q(a, b, c, d, e) {
            a.appendChild(p("th", null == b ? "" : (b + 1).toString()));
            a.appendChild(p("th", null == c ? "" : (c + 1).toString()));
            a.appendChild(k("td", e, d[null != b ? b : c].replace(/\t/g, "    ")))
        }

        var h = b.baseTextLines, m = b.newTextLines, r = b.opcodes, l = b.baseTextName ? b.baseTextName : "Base Text", c = b.newTextName ? b.newTextName : "New Text", w = b.contextSize;
        b = 0 == b.viewType || 1 == b.viewType ? b.viewType : 0;
        if (null == h)throw"Cannot build diff view; baseTextLines is not defined.";
        if (null == m)throw"Cannot build diff view; newTextLines is not defined.";
        if (!r)throw"Canno build diff view; opcodes is not defined.";
        var n = document.createElement("thead"), a = document.createElement("tr");
        n.appendChild(a);
        b ? (a.appendChild(document.createElement("th")), a.appendChild(document.createElement("th")), a.appendChild(k("th", "texttitle", l + " vs. " + c))) : (a.appendChild(document.createElement("th")), a.appendChild(k("th", "texttitle", l)), a.appendChild(document.createElement("th")), a.appendChild(k("th", "texttitle", c)));
        for (var n = [n], l = [], g, c = 0; c < r.length; c++) {
            code = r[c];
            change =
                code[0];
            for (var e = code[1], t = code[2], f = code[3], u = code[4], A = Math.max(t - e, u - f), v = [], x = [], d = 0; d < A; d++) {
                if (w && 1 < r.length && (0 < c && d == w || 0 == c && 0 == d) && "equal" == change && (g = A - (0 == c ? 1 : 2) * w, 1 < g))if (v.push(a = document.createElement("tr")), e += g, f += g, d += g - 1, a.appendChild(p("th", "...")), b || a.appendChild(k("td", "skip", "")), a.appendChild(p("th", "...")), a.appendChild(k("td", "skip", "")), c + 1 == r.length)break; else continue;
                v.push(a = document.createElement("tr"));
                b ? "insert" == change ? q(a, null, f++, m, change) : "replace" == change ?
                    (x.push(g = document.createElement("tr")), e < t && q(a, e++, null, h, "delete"), f < u && q(g, null, f++, m, "insert")) : "delete" == change ? q(a, e++, null, h, change) : q(a, e++, f++, h, change) : (g = diffString2(e < t ? h[e] : "", f < u ? m[f] : ""), e < t && (h[e] = g.o), f < u && (m[f] = g.n), e = z(a, e, t, h, "replace" == change ? "delete" : change), f = z(a, f, u, m, "replace" == change ? "insert" : change))
            }
            for (d = 0; d < v.length; d++)l.push(v[d]);
            for (d = 0; d < x.length; d++)l.push(x[d])
        }
        h = "combined \x3ca href\x3d'http://snowtide.com/jsdifflib'\x3ejsdifflib\x3c/a\x3e and John Resig's \x3ca href\x3d'http://ejohn.org/projects/javascript-diff-algorithm/'\x3ediff\x3c/a\x3e by \x3ca href\x3d'http://richardbondi.net'\x3eRichard Bondi\x3c/a\x3e";
        l.push(a = k("th", "author", h));
        a.setAttribute("colspan", b ? 3 : 4);
        n.push(a = document.createElement("tbody"));
        for (c in l)a.appendChild(l[c]);
        a = y("table", "diff" + (b ? " inlinediff" : ""));
        for (c in n)a.appendChild(n[c]);
        return a
    }
};