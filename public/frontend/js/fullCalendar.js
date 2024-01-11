(function(t) {
    "function" == typeof define && define.amd ? define(["jquery", "moment"], t) : t(jQuery, moment)
})(function(t, e) {
    function n(t, e) {
        return e.longDateFormat("LT").replace(":mm", "(:mm)").replace(/(\Wmm)$/, "($1)").replace(/\s*a$/i, "t")
    }

    function i(t, e) {
        var n = e.longDateFormat("L");
        return n = n.replace(/^Y+[^\w\s]*|[^\w\s]*Y+$/g, ""), t.isRTL ? n += " ddd" : n = "ddd " + n, n
    }

    function r(t) {
        s(Fe, t)
    }

    function s(e) {
        function n(n, i) {
            t.isPlainObject(i) && t.isPlainObject(e[n]) && !o(n) ? e[n] = s({}, e[n], i) : void 0 !== i && (e[n] = i)
        }
        for (var i = 1; arguments.length > i; i++) t.each(arguments[i], n);
        return e
    }

    function o(t) {
        return /(Time|Duration)$/.test(t)
    }

    function l(n, i) {
        function r(t) {
            var n = e.localeData || e.langData;
            return n.call(e, t) || n.call(e, "en")
        }

        function o(t) {
            ne ? u() && (p(), f(t)) : l()
        }

        function l() {
            ie = K.theme ? "ui" : "fc", n.addClass("fc"), K.isRTL ? n.addClass("fc-rtl") : n.addClass("fc-ltr"), K.theme ? n.addClass("ui-widget") : n.addClass("fc-unthemed"), ne = t("<div class='fc-view-container'/>").prependTo(n), te = new a(q, K), ee = te.render(), ee && n.prepend(ee), h(K.defaultView), K.handleWindowResize && (oe = _(v, K.windowResizeDelay), t(window).resize(oe))
        }

        function d() {
            re && re.destroy(), te.destroy(), ne.remove(), n.removeClass("fc fc-ltr fc-rtl fc-unthemed ui-widget"), t(window).unbind("resize", oe)
        }

        function u() {
            return n.is(":visible")
        }

        function h(t) {
            f(0, t)
        }

        function f(e, n) {
            ue++, re && n && re.name !== n && (te.deactivateButton(re.name), B(), re.start && re.destroy(), re.el.remove(), re = null), !re && n && (re = new Ge[n](q), re.el = t("<div class='fc-view fc-" + n + "-view' />").appendTo(ne), te.activateButton(n)), re && (e && (le = re.incrementDate(le, e)), re.start && !e && le.isWithin(re.intervalStart, re.intervalEnd) || u() && (B(), re.start && re.destroy(), re.render(le), I(), C(), H(), b())), I(), ue--
        }

        function g(t) {
            return u() ? (t && m(), ue++, re.updateSize(!0), ue--, !0) : void 0
        }

        function p() {
            u() && m()
        }

        function m() {
            se = "number" == typeof K.contentHeight ? K.contentHeight : "number" == typeof K.height ? K.height - (ee ? ee.outerHeight(!0) : 0) : Math.round(ne.width() / Math.max(K.aspectRatio, .5))
        }

        function v(t) {
            !ue && t.target === window && re.start && g(!0) && re.trigger("windowResize", de)
        }

        function y() {
            S(), E()
        }

        function w() {
            u() && (B(), re.destroyEvents(), re.renderEvents(he), I())
        }

        function S() {
            B(), re.destroyEvents(), I()
        }

        function b() {
            !K.lazyFetching || ae(re.start, re.end) ? E() : w()
        }

        function E() {
            ce(re.start, re.end)
        }

        function D(t) {
            he = t, w()
        }

        function T() {
            w()
        }

        function C() {
            te.updateTitle(re.title)
        }

        function H() {
            var t = q.getNow();
            t.isWithin(re.intervalStart, re.intervalEnd) ? te.disableButton("today") : te.enableButton("today")
        }

        function x(t, e) {
            t = q.moment(t), e = e ? q.moment(e) : t.hasTime() ? t.clone().add(q.defaultTimedEventDuration) : t.clone().add(q.defaultAllDayEventDuration), re.select(t, e)
        }

        function M() {
            re && re.unselect()
        }

        function R() {
            f(-1)
        }

        function P() {
            f(1)
        }

        function F() {
            le.add(-1, "years"), f()
        }

        function z() {
            le.add(1, "years"), f()
        }

        function G() {
            le = q.getNow(), f()
        }

        function N(t) {
            le = q.moment(t), f()
        }

        function A(t) {
            le.add(e.duration(t)), f()
        }

        function Y(t, e) {
            var n, i;
            e && void 0 !== Ge[e] || (e = e || "day", n = te.getViewsWithButtons().join(" "), i = n.match(RegExp("\\w+" + L(e))), i || (i = n.match(/\w+Day/)), e = i ? i[0] : "agendaDay"), le = t, h(e)
        }

        function V() {
            return le.clone()
        }

        function B() {
            ne.css({
                width: "100%",
                height: ne.height(),
                overflow: "hidden"
            })
        }

        function I() {
            ne.css({
                width: "",
                height: "",
                overflow: ""
            })
        }

        function Z() {
            return q
        }

        function j() {
            return re
        }

        function X(t, e) {
            return void 0 === e ? K[t] : (("height" == t || "contentHeight" == t || "aspectRatio" == t) && (K[t] = e, g(!0)), void 0)
        }

        function $(t, e) {
            return K[t] ? K[t].apply(e || de, Array.prototype.slice.call(arguments, 2)) : void 0
        }
        var q = this;
        i = i || {};
        var U, K = s({}, Fe, i);
        U = K.lang in Le ? Le[K.lang] : Le[Fe.lang], U && (K = s({}, Fe, U, i)), K.isRTL && (K = s({}, Fe, ze, U || {}, i)), q.options = K, q.render = o, q.destroy = d, q.refetchEvents = y, q.reportEvents = D, q.reportEventChange = T, q.rerenderEvents = w, q.changeView = h, q.select = x, q.unselect = M, q.prev = R, q.next = P, q.prevYear = F, q.nextYear = z, q.today = G, q.gotoDate = N, q.incrementDate = A, q.zoomTo = Y, q.getDate = V, q.getCalendar = Z, q.getView = j, q.option = X, q.trigger = $;
        var Q = k(r(K.lang));
        if (K.monthNames && (Q._months = K.monthNames), K.monthNamesShort && (Q._monthsShort = K.monthNamesShort), K.dayNames && (Q._weekdays = K.dayNames), K.dayNamesShort && (Q._weekdaysShort = K.dayNamesShort), null != K.firstDay) {
            var J = k(Q._week);
            J.dow = K.firstDay, Q._week = J
        }
        q.defaultAllDayEventDuration = e.duration(K.defaultAllDayEventDuration), q.defaultTimedEventDuration = e.duration(K.defaultTimedEventDuration), q.moment = function() {
            var t;
            return "local" === K.timezone ? (t = _e.moment.apply(null, arguments), t.hasTime() && t.local()) : t = "UTC" === K.timezone ? _e.moment.utc.apply(null, arguments) : _e.moment.parseZone.apply(null, arguments), "_locale" in t ? t._locale = Q : t._lang = Q, t
        }, q.getIsAmbigTimezone = function() {
            return "local" !== K.timezone && "UTC" !== K.timezone
        }, q.rezoneDate = function(t) {
            return q.moment(t.toArray())
        }, q.getNow = function() {
            var t = K.now;
            return "function" == typeof t && (t = t()), q.moment(t)
        }, q.calculateWeekNumber = function(t) {
            var e = K.weekNumberCalculation;
            return "function" == typeof e ? e(t) : "local" === e ? t.week() : "ISO" === e.toUpperCase() ? t.isoWeek() : void 0
        }, q.getEventEnd = function(t) {
            return t.end ? t.end.clone() : q.getDefaultEventEnd(t.allDay, t.start)
        }, q.getDefaultEventEnd = function(t, e) {
            var n = e.clone();
            return t ? n.stripTime().add(q.defaultAllDayEventDuration) : n.add(q.defaultTimedEventDuration), q.getIsAmbigTimezone() && n.stripZone(), n
        }, q.formatRange = function(t, e, n) {
            return "function" == typeof n && (n = n.call(q, K, Q)), W(t, e, n, null, K.isRTL)
        }, q.formatDate = function(t, e) {
            return "function" == typeof e && (e = e.call(q, K, Q)), O(t, e)
        }, c.call(q, K);
        var te, ee, ne, ie, re, se, oe, le, ae = q.isFetchNeeded,
            ce = q.fetchEvents,
            de = n[0],
            ue = 0,
            he = [];
        le = null != K.defaultDate ? q.moment(K.defaultDate) : q.getNow(), q.getSuggestedViewHeight = function() {
            return void 0 === se && p(), se
        }, q.isHeightAuto = function() {
            return "auto" === K.contentHeight || "auto" === K.height
        }
    }

    function a(e, n) {
        function i() {
            var e = n.header;
            return f = n.theme ? "ui" : "fc", e ? g = t("<div class='fc-toolbar'/>").append(s("left")).append(s("right")).append(s("center")).append('<div class="fc-clear"/>') : void 0
        }

        function r() {
            g.remove()
        }

        function s(i) {
            var r = t('<div class="fc-' + i + '"/>'),
                s = n.header[i];
            return s && t.each(s.split(" "), function() {
                var i, s = t(),
                    o = !0;
                t.each(this.split(","), function(i, r) {
                    var l, a, c, d, u, h, g, m;
                    "title" == r ? (s = s.add(t("<h2>&nbsp;</h2>")), o = !1) : (e[r] ? l = function() {
                        e[r]()
                    } : Ge[r] && (l = function() {
                        e.changeView(r)
                    }, p.push(r)), l && (a = T(n.themeButtonIcons, r), c = T(n.buttonIcons, r), d = T(n.defaultButtonText, r), u = T(n.buttonText, r), h = u ? P(u) : a && n.theme ? "<span class='ui-icon ui-icon-" + a + "'></span>" : c && !n.theme ? "<span class='fc-icon fc-icon-" + c + "'></span>" : P(d || r), g = ["fc-" + r + "-button", f + "-button", f + "-state-default"], m = t('<button type="button" class="' + g.join(" ") + '">' + h + "</button>").click(function() {
                        m.hasClass(f + "-state-disabled") || (l(), (m.hasClass(f + "-state-active") || m.hasClass(f + "-state-disabled")) && m.removeClass(f + "-state-hover"))
                    }).mousedown(function() {
                        m.not("." + f + "-state-active").not("." + f + "-state-disabled").addClass(f + "-state-down")
                    }).mouseup(function() {
                        m.removeClass(f + "-state-down")
                    }).hover(function() {
                        m.not("." + f + "-state-active").not("." + f + "-state-disabled").addClass(f + "-state-hover")
                    }, function() {
                        m.removeClass(f + "-state-hover").removeClass(f + "-state-down")
                    }), s = s.add(m)))
                }), o && s.first().addClass(f + "-corner-left").end().last().addClass(f + "-corner-right").end(), s.length > 1 ? (i = t("<div/>"), o && i.addClass("fc-button-group"), i.append(s), r.append(i)) : r.append(s)
            }), r
        }

        function o(t) {
            g.find("h2").text(t)
        }

        function l(t) {
            g.find(".fc-" + t + "-button").addClass(f + "-state-active")
        }

        function a(t) {
            g.find(".fc-" + t + "-button").removeClass(f + "-state-active")
        }

        function c(t) {
            g.find(".fc-" + t + "-button").attr("disabled", "disabled").addClass(f + "-state-disabled")
        }

        function d(t) {
            g.find(".fc-" + t + "-button").removeAttr("disabled").removeClass(f + "-state-disabled")
        }

        function u() {
            return p
        }
        var h = this;
        h.render = i, h.destroy = r, h.updateTitle = o, h.activateButton = l, h.deactivateButton = a, h.disableButton = c, h.enableButton = d, h.getViewsWithButtons = u;
        var f, g = t(),
            p = []
    }

    function c(n) {
        function i(t, e) {
            return !A || t.clone().stripZone() < A.clone().stripZone() || e.clone().stripZone() > Y.clone().stripZone()
        }

        function r(t, e) {
            A = t, Y = e, q = [];
            var n = ++j,
                i = Z.length;
            X = i;
            for (var r = 0; i > r; r++) s(Z[r], n)
        }

        function s(e, n) {
            o(e, function(i) {
                var r, s, o, l = t.isArray(e.events);
                if (n == j) {
                    if (i)
                        for (r = 0; i.length > r; r++) s = i[r], o = l ? s : S(s, e), o && q.push.apply(q, E(o));
                    X--, X || B(q)
                }
            })
        }

        function o(e, i) {
            var r, s, l = _e.sourceFetchers;
            for (r = 0; l.length > r; r++) {
                if (s = l[r].call(N, e, A.clone(), Y.clone(), n.timezone, i), s === !0) return;
                if ("object" == typeof s) return o(s, i), void 0
            }
            var a = e.events;
            if (a) t.isFunction(a) ? (y(), a.call(N, A.clone(), Y.clone(), n.timezone, function(t) {
                i(t), w()
            })) : t.isArray(a) ? i(a) : i();
            else {
                var c = e.url;
                if (c) {
                    var d, u = e.success,
                        h = e.error,
                        f = e.complete;
                    d = t.isFunction(e.data) ? e.data() : e.data;
                    var g = t.extend({}, d || {}),
                        p = R(e.startParam, n.startParam),
                        m = R(e.endParam, n.endParam),
                        v = R(e.timezoneParam, n.timezoneParam);
                    p && (g[p] = A.format()), m && (g[m] = Y.format()), n.timezone && "local" != n.timezone && (g[v] = n.timezone), y(), t.ajax(t.extend({}, Ne, e, {
                        data: g,
                        success: function(e) {
                            e = e || [];
                            var n = M(u, this, arguments);
                            t.isArray(n) && (e = n), i(e)
                        },
                        error: function() {
                            M(h, this, arguments), i()
                        },
                        complete: function() {
                            M(f, this, arguments), w()
                        }
                    }))
                } else i()
            }
        }

        function l(t) {
            var e = a(t);
            e && (Z.push(e), X++, s(e, j))
        }

        function a(e) {
            var n, i, r = _e.sourceNormalizers;
            if (t.isFunction(e) || t.isArray(e) ? n = {
                    events: e
                } : "string" == typeof e ? n = {
                    url: e
                } : "object" == typeof e && (n = t.extend({}, e)), n) {
                for (n.className ? "string" == typeof n.className && (n.className = n.className.split(/\s+/)) : n.className = [], t.isArray(n.events) && (n.origArray = n.events, n.events = t.map(n.events, function(t) {
                        return S(t, n)
                    })), i = 0; r.length > i; i++) r[i].call(N, n);
                return n
            }
        }

        function c(e) {
            Z = t.grep(Z, function(t) {
                return !u(t, e)
            }), q = t.grep(q, function(t) {
                return !u(t.source, e)
            }), B(q)
        }

        function u(t, e) {
            return t && e && h(t) == h(e)
        }

        function h(t) {
            return ("object" == typeof t ? t.origArray || t.googleCalendarId || t.url || t.events : null) || t
        }

        function f(t) {
            t.start = N.moment(t.start), t.end && (t.end = N.moment(t.end)), D(t), g(t), B(q)
        }

        function g(t) {
            var e, n, i, r;
            for (e = 0; q.length > e; e++)
                if (n = q[e], n._id == t._id && n !== t)
                    for (i = 0; U.length > i; i++) r = U[i], void 0 !== t[r] && (n[r] = t[r])
        }

        function p(t, e) {
            var n, i, r, s = S(t);
            if (s) {
                for (n = E(s), i = 0; n.length > i; i++) r = n[i], r.source || (e && (W.events.push(r), r.source = W), q.push(r));
                return B(q), n
            }
            return []
        }

        function m(e) {
            var n, i;
            for (null == e ? e = function() {
                    return !0
                } : t.isFunction(e) || (n = e + "", e = function(t) {
                    return t._id == n
                }), q = t.grep(q, e, !0), i = 0; Z.length > i; i++) t.isArray(Z[i].events) && (Z[i].events = t.grep(Z[i].events, e, !0));
            B(q)
        }

        function v(e) {
            return t.isFunction(e) ? t.grep(q, e) : null != e ? (e += "", t.grep(q, function(t) {
                return t._id == e
            })) : q
        }

        function y() {
            $++ || V("loading", null, !0, O())
        }

        function w() {
            --$ || V("loading", null, !1, O())
        }

        function S(i, r) {
            var s, o, l, a, c = {};
            if (n.eventDataTransform && (i = n.eventDataTransform(i)), r && r.eventDataTransform && (i = r.eventDataTransform(i)), t.extend(c, i), r && (c.source = r), c._id = i._id || (void 0 === i.id ? "_fc" + Ae++ : i.id + ""), c.className = i.className ? "string" == typeof i.className ? i.className.split(/\s+/) : i.className : [], s = i.start || i.date, o = i.end, x(s) && (s = e.duration(s)), x(o) && (o = e.duration(o)), i.dow || e.isDuration(s) || e.isDuration(o)) c.start = s ? e.duration(s) : null, c.end = o ? e.duration(o) : null, c._recurring = !0;
            else {
                if (s && (s = N.moment(s), !s.isValid())) return !1;
                o && (o = N.moment(o), o.isValid() || (o = null)), l = i.allDay, void 0 === l && (a = R(r ? r.allDayDefault : void 0, n.allDayDefault), l = void 0 !== a ? a : !(s.hasTime() || o && o.hasTime())), b(s, o, l, c)
            }
            return c
        }

        function b(t, e, i, r) {
            i ? (t.hasTime() && t.stripTime(), e && e.hasTime() && e.stripTime()) : (t.hasTime() || (t = N.rezoneDate(t)), e && !e.hasTime() && (e = N.rezoneDate(e))), e && t >= e && (e = null), r.allDay = i, r.start = t, r.end = e || null, n.forceEventDuration && !r.end && (r.end = I(r)), d(r)
        }

        function E(e, n, i) {
            var r, s, o, l, a, c, d, u, h, f = [];
            if (n = n || A, i = i || Y, e)
                if (e._recurring) {
                    if (s = e.dow)
                        for (r = {}, o = 0; s.length > o; o++) r[s[o]] = !0;
                    for (l = n.clone().stripTime(); l.isBefore(i);)(!r || r[l.day()]) && (a = e.start, c = e.end, d = l.clone(), u = null, a && (d = d.time(a)), c && (u = l.clone().time(c)), h = t.extend({}, e), b(d, u, !a && !c, h), f.push(h)), l.add(1, "days")
                } else f.push(e);
            return f
        }

        function D(t, e, n) {
            var i, r, s, o, l = t._allDay,
                a = t._start,
                c = t._end,
                d = !1;
            return e || n || (e = t.start, n = t.end), i = t.allDay != l ? t.allDay : !(e || n).hasTime(), i && (e && (e = e.clone().stripTime()), n && (n = n.clone().stripTime())), e && (r = i ? C(e, a.clone().stripTime()) : C(e, a)), i != l ? d = !0 : n && (s = C(n || N.getDefaultEventEnd(i, e || a), e || a).subtract(C(c || N.getDefaultEventEnd(l, a), a))), o = T(v(t._id), d, i, r, s), {
                dateDelta: r,
                durationDelta: s,
                undo: o
            }
        }

        function T(e, i, r, s, o) {
            var l = N.getIsAmbigTimezone(),
                a = [];
            return t.each(e, function(t, e) {
                    var c = e._allDay,
                        u = e._start,
                        h = e._end,
                        f = null != r ? r : c,
                        g = u.clone(),
                        p = !i && h ? h.clone() : null;
                    f ? (g.stripTime(), p && p.stripTime()) : (g.hasTime() || (g = N.rezoneDate(g)), p && !p.hasTime() && (p = N.rezoneDate(p))), p || !n.forceEventDuration && !+o || (p = N.getDefaultEventEnd(f, g)), g.add(s), p && p.add(s).add(o), l && (+s || +o) && (g.stripZone(), p && p.stripZone()), e.allDay = f, e.start = g, e.end = p, d(e), a.push(function() {
                        e.allDay = c, e.start = u, e.end = h, d(e)
                    })
                }),
                function() {
                    for (var t = 0; a.length > t; t++) a[t]()
                }
        }

        function H() {
            var e, i = n.businessHours,
                r = {
                    className: "fc-nonbusiness",
                    start: "09:00",
                    end: "17:00",
                    dow: [1, 2, 3, 4, 5],
                    rendering: "inverse-background"
                },
                s = N.getView();
            return i && (e = "object" == typeof i ? t.extend({}, r, i) : r), e ? E(S(e), s.start, s.end) : []
        }

        function k(t, e, i) {
            var r = t.source || {},
                s = R(t.constraint, r.constraint, n.eventConstraint),
                o = R(t.overlap, r.overlap, n.eventOverlap);
            return L(e, i, s, o, t)
        }

        function P(t, e) {
            return L(t, e, n.selectConstraint, n.selectOverlap)
        }

        function F(t, e, n) {
            var i;
            return n && (i = E(S(n))[0]) ? k(i, t, e) : P(t, e)
        }

        function L(t, e, n, i, r) {
            var s, o, l, a, c;
            if (t = t.clone().stripZone(), e = e.clone().stripZone(), null != n) {
                for (s = z(n), o = !1, l = 0; s.length > l; l++)
                    if (_(s[l], t, e)) {
                        o = !0;
                        break
                    } if (!o) return !1
            }
            for (l = 0; q.length > l; l++)
                if (a = q[l], (!r || r._id !== a._id) && G(a, t, e)) {
                    if (i === !1) return !1;
                    if ("function" == typeof i && !i(a, r)) return !1;
                    if (r) {
                        if (c = R(a.overlap, (a.source || {}).overlap), c === !1) return !1;
                        if ("function" == typeof c && !c(r, a)) return !1
                    }
                } return !0
        }

        function z(t) {
            return "businessHours" === t ? H() : "object" == typeof t ? E(S(t)) : v(t)
        }

        function _(t, e, n) {
            var i = t.start.clone().stripZone(),
                r = N.getEventEnd(t).stripZone();
            return e >= i && r >= n
        }

        function G(t, e, n) {
            var i = t.start.clone().stripZone(),
                r = N.getEventEnd(t).stripZone();
            return r > e && n > i
        }
        var N = this;
        N.isFetchNeeded = i, N.fetchEvents = r, N.addEventSource = l, N.removeEventSource = c, N.updateEvent = f, N.renderEvent = p, N.removeEvents = m, N.clientEvents = v, N.mutateEvent = D;
        var A, Y, V = N.trigger,
            O = N.getView,
            B = N.reportEvents,
            I = N.getEventEnd,
            W = {
                events: []
            },
            Z = [W],
            j = 0,
            X = 0,
            $ = 0,
            q = [];
        t.each((n.events ? [n.events] : []).concat(n.eventSources || []), function(t, e) {
            var n = a(e);
            n && Z.push(n)
        });
        var U = ["title", "url", "allDay", "className", "editable", "color", "backgroundColor", "borderColor", "textColor"];
        N.getBusinessHoursEvents = H, N.isEventAllowedInRange = k, N.isSelectionAllowedInRange = P, N.isExternalDragAllowedInRange = F
    }

    function d(t) {
        t._allDay = t.allDay, t._start = t.start.clone(), t._end = t.end ? t.end.clone() : null
    }

    function u(t, e) {
        e.left && t.css({
            "border-left-width": 1,
            "margin-left": e.left - 1
        }), e.right && t.css({
            "border-right-width": 1,
            "margin-right": e.right - 1
        })
    }

    function h(t) {
        t.css({
            "margin-left": "",
            "margin-right": "",
            "border-left-width": "",
            "border-right-width": ""
        })
    }

    function f() {
        t("body").addClass("fc-not-allowed")
    }

    function g() {
        t("body").removeClass("fc-not-allowed")
    }

    function p(e, n, i) {
        var r = Math.floor(n / e.length),
            s = Math.floor(n - r * (e.length - 1)),
            o = [],
            l = [],
            a = [],
            c = 0;
        m(e), e.each(function(n, i) {
            var d = n === e.length - 1 ? s : r,
                u = t(i).outerHeight(!0);
            d > u ? (o.push(i), l.push(u), a.push(t(i).height())) : c += u
        }), i && (n -= c, r = Math.floor(n / o.length), s = Math.floor(n - r * (o.length - 1))), t(o).each(function(e, n) {
            var i = e === o.length - 1 ? s : r,
                c = l[e],
                d = a[e],
                u = i - (c - d);
            i > c && t(n).height(u)
        })
    }

    function m(t) {
        t.height("")
    }

    function v(e) {
        var n = 0;
        return e.find("> *").each(function(e, i) {
            var r = t(i).outerWidth();
            r > n && (n = r)
        }), n++, e.width(n), n
    }

    function y(t, e) {
        return t.height(e).addClass("fc-scroller"), t[0].scrollHeight - 1 > t[0].clientHeight ? !0 : (w(t), !1)
    }

    function w(t) {
        t.height("").removeClass("fc-scroller")
    }

    function S(e) {
        var n = e.css("position"),
            i = e.parents().filter(function() {
                var e = t(this);
                return /(auto|scroll)/.test(e.css("overflow") + e.css("overflow-y") + e.css("overflow-x"))
            }).eq(0);
        return "fixed" !== n && i.length ? i : t(e[0].ownerDocument || document)
    }

    function b(t) {
        var e = t.offset().left,
            n = e + t.width(),
            i = t.children(),
            r = i.offset().left,
            s = r + i.outerWidth();
        return {
            left: r - e,
            right: n - s
        }
    }

    function E(t) {
        return 1 == t.which && !t.ctrlKey
    }

    function D(t, e, n, i) {
        var r, s, o, l;
        return e > n && i > t ? (t >= n ? (r = t.clone(), o = !0) : (r = n.clone(), o = !1), i >= e ? (s = e.clone(), l = !0) : (s = i.clone(), l = !1), {
            start: r,
            end: s,
            isStart: o,
            isEnd: l
        }) : void 0
    }

    function T(t, e) {
        if (t = t || {}, void 0 !== t[e]) return t[e];
        for (var n, i = e.split(/(?=[A-Z])/), r = i.length - 1; r >= 0; r--)
            if (n = t[i[r].toLowerCase()], void 0 !== n) return n;
        return t["default"]
    }

    function C(t, n) {
        return e.duration({
            days: t.clone().stripTime().diff(n.clone().stripTime(), "days"),
            ms: t.time() - n.time()
        })
    }

    function H(t) {
        return "[object Date]" === Object.prototype.toString.call(t) || t instanceof Date
    }

    function x(t) {
        return /^\d+\:\d+(?:\:\d+\.?(?:\d{3})?)?$/.test(t)
    }

    function k(t) {
        var e = function() {};
        return e.prototype = t, new e
    }

    function M(e, n, i) {
        if (t.isFunction(e) && (e = [e]), e) {
            var r, s;
            for (r = 0; e.length > r; r++) s = e[r].apply(n, i) || s;
            return s
        }
    }

    function R() {
        for (var t = 0; arguments.length > t; t++)
            if (void 0 !== arguments[t]) return arguments[t]
    }

    function P(t) {
        return (t + "").replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, "&#039;").replace(/"/g, "&quot;").replace(/\n/g, "<br />")
    }

    function F(t) {
        return t.replace(/&.*?;/g, "")
    }

    function L(t) {
        return t.charAt(0).toUpperCase() + t.slice(1)
    }

    function z(t, e) {
        return t - e
    }

    function _(t, e) {
        var n, i, r, s, o = function() {
            var l = +new Date - s;
            e > l && l > 0 ? n = setTimeout(o, e - l) : (n = null, t.apply(r, i), n || (r = i = null))
        };
        return function() {
            r = this, i = arguments, s = +new Date, n || (n = setTimeout(o, e))
        }
    }

    function G(n, i, r) {
        var s, o, l, a, c = n[0],
            d = 1 == n.length && "string" == typeof c;
        return e.isMoment(c) ? (a = e.apply(null, n), A(c, a)) : H(c) || void 0 === c ? a = e.apply(null, n) : (s = !1, o = !1, d ? Ie.test(c) ? (c += "-01", n = [c], s = !0, o = !0) : (l = We.exec(c)) && (s = !l[5], o = !0) : t.isArray(c) && (o = !0), a = i ? e.utc.apply(e, n) : e.apply(null, n), s ? (a._ambigTime = !0, a._ambigZone = !0) : r && (o ? a._ambigZone = !0 : d && a.zone(c))), a._fullCalendar = !0, a
    }

    function N(t, e) {
        var n, i = [],
            r = !1,
            s = !1;
        for (n = 0; t.length > n; n++) i.push(_e.moment.parseZone(t[n])), r = r || i[n]._ambigTime, s = s || i[n]._ambigZone;
        for (n = 0; i.length > n; n++) r && !e ? i[n].stripTime() : s && i[n].stripZone();
        return i
    }

    function A(t, e) {
        t._ambigTime ? e._ambigTime = !0 : e._ambigTime && (e._ambigTime = !1), t._ambigZone ? e._ambigZone = !0 : e._ambigZone && (e._ambigZone = !1)
    }

    function Y(t, e) {
        t.year(e[0] || 0).month(e[1] || 0).date(e[2] || 0).hours(e[3] || 0).minutes(e[4] || 0).seconds(e[5] || 0).milliseconds(e[6] || 0)
    }

    function V(t, e) {
        return je.format.call(t, e)
    }

    function O(t, e) {
        return B(t, X(e))
    }

    function B(t, e) {
        var n, i = "";
        for (n = 0; e.length > n; n++) i += I(t, e[n]);
        return i
    }

    function I(t, e) {
        var n, i;
        return "string" == typeof e ? e : (n = e.token) ? Xe[n] ? Xe[n](t) : V(t, n) : e.maybe && (i = B(t, e.maybe), i.match(/[1-9]/)) ? i : ""
    }

    function W(t, e, n, i, r) {
        var s;
        return t = _e.moment.parseZone(t), e = _e.moment.parseZone(e), s = (t.localeData || t.lang).call(t), n = s.longDateFormat(n) || n, i = i || " - ", Z(t, e, X(n), i, r)
    }

    function Z(t, e, n, i, r) {
        var s, o, l, a, c = "",
            d = "",
            u = "",
            h = "",
            f = "";
        for (o = 0; n.length > o && (s = j(t, e, n[o]), s !== !1); o++) c += s;
        for (l = n.length - 1; l > o && (s = j(t, e, n[l]), s !== !1); l--) d = s + d;
        for (a = o; l >= a; a++) u += I(t, n[a]), h += I(e, n[a]);
        return (u || h) && (f = r ? h + i + u : u + i + h), c + f + d
    }

    function j(t, e, n) {
        var i, r;
        return "string" == typeof n ? n : (i = n.token) && (r = $e[i.charAt(0)], r && t.isSame(e, r)) ? V(t, i) : !1
    }

    function X(t) {
        return t in qe ? qe[t] : qe[t] = $(t)
    }

    function $(t) {
        for (var e, n = [], i = /\[([^\]]*)\]|\(([^\)]*)\)|(LT|(\w)\4*o?)|([^\w\[\(]+)/g; e = i.exec(t);) e[1] ? n.push(e[1]) : e[2] ? n.push({
            maybe: $(e[2])
        }) : e[3] ? n.push({
            token: e[3]
        }) : e[5] && n.push(e[5]);
        return n
    }

    function q(t) {
        this.options = t || {}
    }

    function U(t) {
        this.grid = t
    }

    function K(t) {
        this.coordMaps = t
    }

    function Q(t, e) {
        this.coordMap = t, this.options = e || {}
    }

    function J(t, e) {
        return t || e ? t && e ? t.grid === e.grid && t.row === e.row && t.col === e.col : !1 : !0
    }

    function te(e, n) {
        this.options = n = n || {}, this.sourceEl = e, this.parentEl = n.parentEl ? t(n.parentEl) : e.parent()
    }

    function ee(t) {
        this.view = t
    }

    function ne(t) {
        ee.call(this, t), this.coordMap = new U(this), this.elsByFill = {}
    }

    function ie(t) {
        var e = se(t);
        return "background" === e || "inverse-background" === e
    }

    function re(t) {
        return "inverse-background" === se(t)
    }

    function se(t) {
        return R((t.source || {}).rendering, t.rendering)
    }

    function oe(t) {
        var e, n, i = {};
        for (e = 0; t.length > e; e++) n = t[e], (i[n._id] || (i[n._id] = [])).push(n);
        return i
    }

    function le(t, e) {
        return t.eventStartMS - e.eventStartMS
    }

    function ae(t, e) {
        return t.eventStartMS - e.eventStartMS || e.eventDurationMS - t.eventDurationMS || e.event.allDay - t.event.allDay || (t.event.title || "").localeCompare(e.event.title)
    }

    function ce(t) {
        ne.call(this, t)
    }

    function de(t, e) {
        var n, i;
        for (n = 0; e.length > n; n++)
            if (i = e[n], i.leftCol <= t.rightCol && i.rightCol >= t.leftCol) return !0;
        return !1
    }

    function ue(t, e) {
        return t.leftCol - e.leftCol
    }

    function he(t) {
        ne.call(this, t)
    }

    function fe(t) {
        var e, n, i;
        if (t.sort(ae), e = ge(t), pe(e), n = e[0]) {
            for (i = 0; n.length > i; i++) me(n[i]);
            for (i = 0; n.length > i; i++) ve(n[i], 0, 0)
        }
    }

    function ge(t) {
        var e, n, i, r = [];
        for (e = 0; t.length > e; e++) {
            for (n = t[e], i = 0; r.length > i && ye(n, r[i]).length; i++);
            n.level = i, (r[i] || (r[i] = [])).push(n)
        }
        return r
    }

    function pe(t) {
        var e, n, i, r, s;
        for (e = 0; t.length > e; e++)
            for (n = t[e], i = 0; n.length > i; i++)
                for (r = n[i], r.forwardSegs = [], s = e + 1; t.length > s; s++) ye(r, t[s], r.forwardSegs)
    }

    function me(t) {
        var e, n, i = t.forwardSegs,
            r = 0;
        if (void 0 === t.forwardPressure) {
            for (e = 0; i.length > e; e++) n = i[e], me(n), r = Math.max(r, 1 + n.forwardPressure);
            t.forwardPressure = r
        }
    }

    function ve(t, e, n) {
        var i, r = t.forwardSegs;
        if (void 0 === t.forwardCoord)
            for (r.length ? (r.sort(Se), ve(r[0], e + 1, n), t.forwardCoord = r[0].backwardCoord) : t.forwardCoord = 1, t.backwardCoord = t.forwardCoord - (t.forwardCoord - n) / (e + 1), i = 0; r.length > i; i++) ve(r[i], 0, t.forwardCoord)
    }

    function ye(t, e, n) {
        n = n || [];
        for (var i = 0; e.length > i; i++) we(t, e[i]) && n.push(e[i]);
        return n
    }

    function we(t, e) {
        return t.bottom > e.top && t.top < e.bottom
    }

    function Se(t, e) {
        return e.forwardPressure - t.forwardPressure || (t.backwardCoord || 0) - (e.backwardCoord || 0) || ae(t, e)
    }

    function be(n) {
        function i(e) {
            var n = x[e];
            return t.isPlainObject(n) && !o(e) ? T(n, C.name) : n
        }

        function r(t, e) {
            return n.trigger.apply(n, [t, e || C].concat(Array.prototype.slice.call(arguments, 2), [C]))
        }

        function s(t) {
            var e = t.source || {};
            return R(t.startEditable, e.startEditable, i("eventStartEditable"), t.editable, e.editable, i("editable"))
        }

        function l(t) {
            var e = t.source || {};
            return R(t.durationEditable, e.durationEditable, i("eventDurationEditable"), t.editable, e.editable, i("editable"))
        }

        function a(t, e, i, s) {
            var o = n.mutateEvent(e, i, null);
            r("eventDrop", t, e, o.dateDelta, function() {
                o.undo(), H()
            }, s, {}), H()
        }

        function c(t, e, i, s) {
            var o = n.mutateEvent(e, null, i);
            r("eventResize", t, e, o.durationDelta, function() {
                o.undo(), H()
            }, s, {}), H()
        }

        function d(t) {
            return e.isMoment(t) && (t = t.day()), F[t]
        }

        function u() {
            return M
        }

        function h(t, e, n) {
            var i = t.clone();
            for (e = e || 1; F[(i.day() + (n ? e : 0) + 7) % 7];) i.add(e, "days");
            return i
        }

        function f() {
            var t = g.apply(null, arguments),
                e = p(t),
                n = m(e);
            return n
        }

        function g(t, e) {
            var n = C.colCnt,
                i = G ? -1 : 1,
                r = G ? n - 1 : 0;
            "object" == typeof t && (e = t.col, t = t.row);
            var s = t * n + (e * i + r);
            return s
        }

        function p(t) {
            var e = C.start.day();
            return t += L[e], 7 * Math.floor(t / M) + _[(t % M + M) % M] - e
        }

        function m(t) {
            return C.start.clone().add(t, "days")
        }

        function v(t) {
            var e = y(t),
                n = w(e),
                i = S(n);
            return i
        }

        function y(t) {
            return t.clone().stripTime().diff(C.start, "days")
        }

        function w(t) {
            var e = C.start.day();
            return t += e, Math.floor(t / 7) * M + L[(t % 7 + 7) % 7] - L[e]
        }

        function S(t) {
            var e = C.colCnt,
                n = G ? -1 : 1,
                i = G ? e - 1 : 0,
                r = Math.floor(t / e),
                s = (t % e + e) % e * n + i;
            return {
                row: r,
                col: s
            }
        }

        function b(t, e) {
            for (var n = C.rowCnt, i = C.colCnt, r = [], s = E(t, e), o = y(s.start), l = y(s.end), a = w(o), c = w(l) - 1, d = 0; n > d; d++) {
                var u = d * i,
                    h = u + i - 1,
                    f = Math.max(a, u),
                    g = Math.min(c, h);
                if (g >= f) {
                    var m = S(f),
                        v = S(g),
                        b = [m.col, v.col].sort(z),
                        D = p(f) == o,
                        T = p(g) + 1 == l;
                    r.push({
                        row: d,
                        leftCol: b[0],
                        rightCol: b[1],
                        isStart: D,
                        isEnd: T
                    })
                }
            }
            return r
        }

        function E(t, e) {
            var n, i, r = t.clone().stripTime();
            return e && (n = e.clone().stripTime(), i = +e.time(), i && i >= k && n.add(1, "days")), (!e || r >= n) && (n = r.clone().add(1, "days")), {
                start: r,
                end: n
            }
        }

        function D(t) {
            var e = E(t.start, t.end);
            return e.end.diff(e.start, "days") > 1
        }
        var C = this;
        C.calendar = n, C.opt = i, C.trigger = r, C.isEventDraggable = s, C.isEventResizable = l, C.eventDrop = a, C.eventResize = c;
        var H = n.reportEventChange,
            x = n.options,
            k = e.duration(x.nextDayThreshold);
        C.init(), C.getEventTimeText = function(t, e) {
            var r, s;
            return "object" == typeof t && "object" == typeof e ? (r = t, s = e, e = arguments[2]) : (r = t.start, s = t.end), e = e || i("timeFormat"), s && i("displayEventEnd") ? n.formatRange(r, s, e) : n.formatDate(r, e)
        }, C.isHiddenDay = d, C.skipHiddenDays = h, C.getCellsPerWeek = u, C.dateToCell = v, C.dateToDayOffset = y, C.dayOffsetToCellOffset = w, C.cellOffsetToCell = S, C.cellToDate = f, C.cellToCellOffset = g, C.cellOffsetToDayOffset = p, C.dayOffsetToDate = m, C.rangeToSegments = b, C.isMultiDayEvent = D;
        var M, P = i("hiddenDays") || [],
            F = [],
            L = [],
            _ = [],
            G = i("isRTL");
        (function() {
            i("weekends") === !1 && P.push(0, 6);
            for (var e = 0, n = 0; 7 > e; e++) L[e] = n, F[e] = -1 != t.inArray(e, P), F[e] || (_[n] = e, n++);
            if (M = n, !M) throw "invalid hiddenDays"
        })()
    }

    function Ee(n) {
        var i, r, s, o, l = _e.dataAttrPrefix;
        return l && (l += "-"), i = n.data(l + "event") || null, i && (i = "object" == typeof i ? t.extend({}, i) : {}, r = i.start, null == r && (r = i.time), s = i.duration, o = i.stick, delete i.start, delete i.time, delete i.duration, delete i.stick), null == r && (r = n.data(l + "start")), null == r && (r = n.data(l + "time")), null == s && (s = n.data(l + "duration")), null == o && (o = n.data(l + "stick")), r = null != r ? e.duration(r) : null, s = null != s ? e.duration(s) : null, o = Boolean(o), {
            eventProps: i,
            startTime: r,
            duration: s,
            stick: o
        }
    }

    function De(t) {
        be.call(this, t), this.dayGrid = new ce(this), this.coordMap = this.dayGrid.coordMap
    }

    function Te(t) {
        De.call(this, t)
    }

    function Ce(t) {
        De.call(this, t)
    }

    function He(t) {
        De.call(this, t)
    }

    function xe(t, e) {
        return e.longDateFormat("LT").replace(":mm", "(:mm)").replace(/(\Wmm)$/, "($1)").replace(/\s*a$/i, "a")
    }

    function ke(t, e) {
        return e.longDateFormat("LT").replace(/\s*a$/i, "")
    }

    function Me(t) {
        be.call(this, t), this.timeGrid = new he(this), this.opt("allDaySlot") ? (this.dayGrid = new ce(this), this.coordMap = new K([this.dayGrid.coordMap, this.timeGrid.coordMap])) : this.coordMap = this.timeGrid.coordMap
    }

    function Re(t) {
        Me.call(this, t)
    }

    function Pe(t) {
        Me.call(this, t)
    }
    var Fe = {
            lang: "en",
            defaultTimedEventDuration: "02:00:00",
            defaultAllDayEventDuration: {
                days: 1
            },
            forceEventDuration: !1,
            nextDayThreshold: "09:00:00",
            defaultView: "month",
            aspectRatio: 1.35,
            header: {
                left: "title",
                center: "",
                right: "today prev,next"
            },
            weekends: !0,
            weekNumbers: !1,
            weekNumberTitle: "W",
            weekNumberCalculation: "local",
            lazyFetching: !0,
            startParam: "start",
            endParam: "end",
            timezoneParam: "timezone",
            timezone: !1,
            titleFormat: {
                month: "MMMM YYYY",
                week: "ll",
                day: "LL"
            },
            columnFormat: {
                month: "ddd",
                week: i,
                day: "dddd"
            },
            timeFormat: {
                "default": n
            },
            displayEventEnd: {
                month: !1,
                basicWeek: !1,
                "default": !0
            },
            isRTL: !1,
            defaultButtonText: {
                prev: "prev",
                next: "next",
                prevYear: "prev year",
                nextYear: "next year",
                today: "today",
                month: "month",
                week: "week",
                day: "day"
            },
            buttonIcons: {
                prev: "left-single-arrow",
                next: "right-single-arrow",
                prevYear: "left-double-arrow",
                nextYear: "right-double-arrow"
            },
            theme: !1,
            themeButtonIcons: {
                prev: "circle-triangle-w",
                next: "circle-triangle-e",
                prevYear: "seek-prev",
                nextYear: "seek-next"
            },
            dragOpacity: .75,
            dragRevertDuration: 500,
            dragScroll: !0,
            unselectAuto: !0,
            dropAccept: "*",
            eventLimit: !1,
            eventLimitText: "more",
            eventLimitClick: "popover",
            dayPopoverFormat: "LL",
            handleWindowResize: !0,
            windowResizeDelay: 200
        },
        Le = {
            en: {
                columnFormat: {
                    week: "ddd M/D"
                },
                dayPopoverFormat: "dddd, MMMM D"
            }
        },
        ze = {
            header: {
                left: "next,prev today",
                center: "",
                right: "title"
            },
            buttonIcons: {
                prev: "right-single-arrow",
                next: "left-single-arrow",
                prevYear: "right-double-arrow",
                nextYear: "left-double-arrow"
            },
            themeButtonIcons: {
                prev: "circle-triangle-e",
                next: "circle-triangle-w",
                nextYear: "seek-prev",
                prevYear: "seek-next"
            }
        },
        _e = t.fullCalendar = {
            version: "2.2.3"
        },
        Ge = _e.views = {};
    t.fn.fullCalendar = function(e) {
        var n = Array.prototype.slice.call(arguments, 1),
            i = this;
        return this.each(function(r, s) {
            var o, a = t(s),
                c = a.data("fullCalendar");
            "string" == typeof e ? c && t.isFunction(c[e]) && (o = c[e].apply(c, n), r || (i = o), "destroy" === e && a.removeData("fullCalendar")) : c || (c = new l(a, e), a.data("fullCalendar", c), c.render())
        }), i
    }, _e.langs = Le, _e.datepickerLang = function(e, n, i) {
        var r = Le[e];
        r || (r = Le[e] = {}), s(r, {
            isRTL: i.isRTL,
            weekNumberTitle: i.weekHeader,
            titleFormat: {
                month: i.showMonthAfterYear ? "YYYY[" + i.yearSuffix + "] MMMM" : "MMMM YYYY[" + i.yearSuffix + "]"
            },
            defaultButtonText: {
                prev: F(i.prevText),
                next: F(i.nextText),
                today: F(i.currentText)
            }
        }), t.datepicker && (t.datepicker.regional[n] = t.datepicker.regional[e] = i, t.datepicker.regional.en = t.datepicker.regional[""], t.datepicker.setDefaults(i))
    }, _e.lang = function(t, e) {
        var n;
        e && (n = Le[t], n || (n = Le[t] = {}), s(n, e || {})), Fe.lang = t
    }, _e.sourceNormalizers = [], _e.sourceFetchers = [];
    var Ne = {
            dataType: "json",
            cache: !1
        },
        Ae = 1,
        Ye = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"];
    _e.applyAll = M;
    var Ve, Oe, Be, Ie = /^\s*\d{4}-\d\d$/,
        We = /^\s*\d{4}-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?)?$/,
        Ze = e.fn,
        je = t.extend({}, Ze);
    _e.moment = function() {
        return G(arguments)
    }, _e.moment.utc = function() {
        var t = G(arguments, !0);
        return t.hasTime() && t.utc(), t
    }, _e.moment.parseZone = function() {
        return G(arguments, !0, !0)
    }, Ze.clone = function() {
        var t = je.clone.apply(this, arguments);
        return A(this, t), this._fullCalendar && (t._fullCalendar = !0), t
    }, Ze.time = function(t) {
        if (!this._fullCalendar) return je.time.apply(this, arguments);
        if (null == t) return e.duration({
            hours: this.hours(),
            minutes: this.minutes(),
            seconds: this.seconds(),
            milliseconds: this.milliseconds()
        });
        this._ambigTime = !1, e.isDuration(t) || e.isMoment(t) || (t = e.duration(t));
        var n = 0;
        return e.isDuration(t) && (n = 24 * Math.floor(t.asDays())), this.hours(n + t.hours()).minutes(t.minutes()).seconds(t.seconds()).milliseconds(t.milliseconds())
    }, Ze.stripTime = function() {
        var t = this.toArray();
        return this.utc(), Oe(this, t.slice(0, 3)), this._ambigTime = !0, this._ambigZone = !0, this
    }, Ze.hasTime = function() {
        return !this._ambigTime
    }, Ze.stripZone = function() {
        var t = this.toArray(),
            e = this._ambigTime;
        return this.utc(), Oe(this, t), e && (this._ambigTime = !0), this._ambigZone = !0, this
    }, Ze.hasZone = function() {
        return !this._ambigZone
    }, Ze.zone = function(t) {
        return null != t && (this._ambigTime = !1, this._ambigZone = !1), je.zone.apply(this, arguments)
    }, Ze.local = function() {
        var t = this.toArray(),
            e = this._ambigZone;
        return je.local.apply(this, arguments), e && Be(this, t), this
    }, Ze.format = function() {
        return this._fullCalendar && arguments[0] ? O(this, arguments[0]) : this._ambigTime ? V(this, "YYYY-MM-DD") : this._ambigZone ? V(this, "YYYY-MM-DD[T]HH:mm:ss") : je.format.apply(this, arguments)
    }, Ze.toISOString = function() {
        return this._ambigTime ? V(this, "YYYY-MM-DD") : this._ambigZone ? V(this, "YYYY-MM-DD[T]HH:mm:ss") : je.toISOString.apply(this, arguments)
    }, Ze.isWithin = function(t, e) {
        var n = N([this, t, e]);
        return n[0] >= n[1] && n[0] < n[2]
    }, Ze.isSame = function(t, e) {
        var n;
        return this._fullCalendar ? e ? (n = N([this, t], !0), je.isSame.call(n[0], n[1], e)) : (t = _e.moment.parseZone(t), je.isSame.call(this, t) && Boolean(this._ambigTime) === Boolean(t._ambigTime) && Boolean(this._ambigZone) === Boolean(t._ambigZone)) : je.isSame.apply(this, arguments)
    }, t.each(["isBefore", "isAfter"], function(t, e) {
        Ze[e] = function(t, n) {
            var i;
            return this._fullCalendar ? (i = N([this, t]), je[e].call(i[0], i[1], n)) : je[e].apply(this, arguments)
        }
    }), Ve = "_d" in e() && "updateOffset" in e, Oe = Ve ? function(t, n) {
        t._d.setTime(Date.UTC.apply(Date, n)), e.updateOffset(t, !1)
    } : Y, Be = Ve ? function(t, n) {
        t._d.setTime(+new Date(n[0] || 0, n[1] || 0, n[2] || 0, n[3] || 0, n[4] || 0, n[5] || 0, n[6] || 0)), e.updateOffset(t, !1)
    } : Y;
    var Xe = {
        t: function(t) {
            return V(t, "a").charAt(0)
        },
        T: function(t) {
            return V(t, "A").charAt(0)
        }
    };
    _e.formatRange = W;
    var $e = {
            Y: "year",
            M: "month",
            D: "day",
            d: "day",
            A: "second",
            a: "second",
            T: "second",
            t: "second",
            H: "second",
            h: "second",
            m: "second",
            s: "second"
        },
        qe = {};
    q.prototype = {
        isHidden: !0,
        options: null,
        el: null,
        documentMousedownProxy: null,
        margin: 10,
        show: function() {
            this.isHidden && (this.el || this.render(), this.el.show(), this.position(), this.isHidden = !1, this.trigger("show"))
        },
        hide: function() {
            this.isHidden || (this.el.hide(), this.isHidden = !0, this.trigger("hide"))
        },
        render: function() {
            var e = this,
                n = this.options;
            this.el = t('<div class="fc-popover"/>').addClass(n.className || "").css({
                top: 0,
                left: 0
            }).append(n.content).appendTo(n.parentEl), this.el.on("click", ".fc-close", function() {
                e.hide()
            }), n.autoHide && t(document).on("mousedown", this.documentMousedownProxy = t.proxy(this, "documentMousedown"))
        },
        documentMousedown: function(e) {
            this.el && !t(e.target).closest(this.el).length && this.hide()
        },
        destroy: function() {
            this.hide(), this.el && (this.el.remove(), this.el = null), t(document).off("mousedown", this.documentMousedownProxy)
        },
        position: function() {
            var e, n, i, r, s, o = this.options,
                l = this.el.offsetParent().offset(),
                a = this.el.outerWidth(),
                c = this.el.outerHeight(),
                d = t(window),
                u = S(this.el);
            r = o.top || 0, s = void 0 !== o.left ? o.left : void 0 !== o.right ? o.right - a : 0, u.is(window) || u.is(document) ? (u = d, e = 0, n = 0) : (i = u.offset(), e = i.top, n = i.left), e += d.scrollTop(), n += d.scrollLeft(), o.viewportConstrain !== !1 && (r = Math.min(r, e + u.outerHeight() - c - this.margin), r = Math.max(r, e + this.margin), s = Math.min(s, n + u.outerWidth() - a - this.margin), s = Math.max(s, n + this.margin)), this.el.css({
                top: r - l.top,
                left: s - l.left
            })
        },
        trigger: function(t) {
            this.options[t] && this.options[t].apply(this, Array.prototype.slice.call(arguments, 1))
        }
    }, U.prototype = {
        grid: null,
        rows: null,
        cols: null,
        containerEl: null,
        minX: null,
        maxX: null,
        minY: null,
        maxY: null,
        build: function() {
            this.grid.buildCoords(this.rows = [], this.cols = []), this.computeBounds()
        },
        getCell: function(t, e) {
            var n, i = null,
                r = this.rows,
                s = this.cols,
                o = -1,
                l = -1;
            if (this.inBounds(t, e)) {
                for (n = 0; r.length > n; n++)
                    if (e >= r[n][0] && r[n][1] > e) {
                        o = n;
                        break
                    } for (n = 0; s.length > n; n++)
                    if (t >= s[n][0] && s[n][1] > t) {
                        l = n;
                        break
                    } o >= 0 && l >= 0 && (i = {
                    row: o,
                    col: l
                }, i.grid = this.grid, i.date = this.grid.getCellDate(i))
            }
            return i
        },
        computeBounds: function() {
            var t;
            this.containerEl && (t = this.containerEl.offset(), this.minX = t.left, this.maxX = t.left + this.containerEl.outerWidth(), this.minY = t.top, this.maxY = t.top + this.containerEl.outerHeight())
        },
        inBounds: function(t, e) {
            return this.containerEl ? t >= this.minX && this.maxX > t && e >= this.minY && this.maxY > e : !0
        }
    }, K.prototype = {
        coordMaps: null,
        build: function() {
            var t, e = this.coordMaps;
            for (t = 0; e.length > t; t++) e[t].build()
        },
        getCell: function(t, e) {
            var n, i = this.coordMaps,
                r = null;
            for (n = 0; i.length > n && !r; n++) r = i[n].getCell(t, e);
            return r
        }
    }, Q.prototype = {
        coordMap: null,
        options: null,
        isListening: !1,
        isDragging: !1,
        origCell: null,
        origDate: null,
        cell: null,
        date: null,
        mouseX0: null,
        mouseY0: null,
        mousemoveProxy: null,
        mouseupProxy: null,
        scrollEl: null,
        scrollBounds: null,
        scrollTopVel: null,
        scrollLeftVel: null,
        scrollIntervalId: null,
        scrollHandlerProxy: null,
        scrollSensitivity: 30,
        scrollSpeed: 200,
        scrollIntervalMs: 50,
        mousedown: function(t) {
            E(t) && (t.preventDefault(), this.startListening(t), this.options.distance || this.startDrag(t))
        },
        startListening: function(e) {
            var n, i;
            this.isListening || (e && this.options.scroll && (n = S(t(e.target)), n.is(window) || n.is(document) || (this.scrollEl = n, this.scrollHandlerProxy = _(t.proxy(this, "scrollHandler"), 100), this.scrollEl.on("scroll", this.scrollHandlerProxy))), this.computeCoords(), e && (i = this.getCell(e), this.origCell = i, this.origDate = i ? i.date : null, this.mouseX0 = e.pageX, this.mouseY0 = e.pageY), t(document).on("mousemove", this.mousemoveProxy = t.proxy(this, "mousemove")).on("mouseup", this.mouseupProxy = t.proxy(this, "mouseup")).on("selectstart", this.preventDefault), this.isListening = !0, this.trigger("listenStart", e))
        },
        computeCoords: function() {
            this.coordMap.build(), this.computeScrollBounds()
        },
        mousemove: function(t) {
            var e, n;
            this.isDragging || (e = this.options.distance || 1, n = Math.pow(t.pageX - this.mouseX0, 2) + Math.pow(t.pageY - this.mouseY0, 2), n >= e * e && this.startDrag(t)), this.isDragging && this.drag(t)
        },
        startDrag: function(t) {
            var e;
            this.isListening || this.startListening(), this.isDragging || (this.isDragging = !0, this.trigger("dragStart", t), e = this.getCell(t), e && this.cellOver(e, !0))
        },
        drag: function(t) {
            var e;
            this.isDragging && (e = this.getCell(t), J(e, this.cell) || (this.cell && this.cellOut(), e && this.cellOver(e)), this.dragScroll(t))
        },
        cellOver: function(t) {
            this.cell = t, this.date = t.date, this.trigger("cellOver", t, t.date)
        },
        cellOut: function() {
            this.cell && (this.trigger("cellOut", this.cell), this.cell = null, this.date = null)
        },
        mouseup: function(t) {
            this.stopDrag(t), this.stopListening(t)
        },
        stopDrag: function(t) {
            this.isDragging && (this.stopScrolling(), this.trigger("dragStop", t), this.isDragging = !1)
        },
        stopListening: function(e) {
            this.isListening && (this.scrollEl && (this.scrollEl.off("scroll", this.scrollHandlerProxy), this.scrollHandlerProxy = null), t(document).off("mousemove", this.mousemoveProxy).off("mouseup", this.mouseupProxy).off("selectstart", this.preventDefault), this.mousemoveProxy = null, this.mouseupProxy = null, this.isListening = !1, this.trigger("listenStop", e), this.origCell = this.cell = null, this.origDate = this.date = null)
        },
        getCell: function(t) {
            return this.coordMap.getCell(t.pageX, t.pageY)
        },
        trigger: function(t) {
            this.options[t] && this.options[t].apply(this, Array.prototype.slice.call(arguments, 1))
        },
        preventDefault: function(t) {
            t.preventDefault()
        },
        computeScrollBounds: function() {
            var t, e = this.scrollEl;
            e && (t = e.offset(), this.scrollBounds = {
                top: t.top,
                left: t.left,
                bottom: t.top + e.outerHeight(),
                right: t.left + e.outerWidth()
            })
        },
        dragScroll: function(t) {
            var e, n, i, r, s = this.scrollSensitivity,
                o = this.scrollBounds,
                l = 0,
                a = 0;
            o && (e = (s - (t.pageY - o.top)) / s, n = (s - (o.bottom - t.pageY)) / s, i = (s - (t.pageX - o.left)) / s, r = (s - (o.right - t.pageX)) / s, e >= 0 && 1 >= e ? l = -1 * e * this.scrollSpeed : n >= 0 && 1 >= n && (l = n * this.scrollSpeed), i >= 0 && 1 >= i ? a = -1 * i * this.scrollSpeed : r >= 0 && 1 >= r && (a = r * this.scrollSpeed)), this.setScrollVel(l, a)
        },
        setScrollVel: function(e, n) {
            this.scrollTopVel = e, this.scrollLeftVel = n, this.constrainScrollVel(), !this.scrollTopVel && !this.scrollLeftVel || this.scrollIntervalId || (this.scrollIntervalId = setInterval(t.proxy(this, "scrollIntervalFunc"), this.scrollIntervalMs))
        },
        constrainScrollVel: function() {
            var t = this.scrollEl;
            0 > this.scrollTopVel ? 0 >= t.scrollTop() && (this.scrollTopVel = 0) : this.scrollTopVel > 0 && t.scrollTop() + t[0].clientHeight >= t[0].scrollHeight && (this.scrollTopVel = 0), 0 > this.scrollLeftVel ? 0 >= t.scrollLeft() && (this.scrollLeftVel = 0) : this.scrollLeftVel > 0 && t.scrollLeft() + t[0].clientWidth >= t[0].scrollWidth && (this.scrollLeftVel = 0)
        },
        scrollIntervalFunc: function() {
            var t = this.scrollEl,
                e = this.scrollIntervalMs / 1e3;
            this.scrollTopVel && t.scrollTop(t.scrollTop() + this.scrollTopVel * e), this.scrollLeftVel && t.scrollLeft(t.scrollLeft() + this.scrollLeftVel * e), this.constrainScrollVel(), this.scrollTopVel || this.scrollLeftVel || this.stopScrolling()
        },
        stopScrolling: function() {
            this.scrollIntervalId && (clearInterval(this.scrollIntervalId), this.scrollIntervalId = null, this.computeCoords())
        },
        scrollHandler: function() {
            this.scrollIntervalId || this.computeCoords()
        }
    }, te.prototype = {
        options: null,
        sourceEl: null,
        el: null,
        parentEl: null,
        top0: null,
        left0: null,
        mouseY0: null,
        mouseX0: null,
        topDelta: null,
        leftDelta: null,
        mousemoveProxy: null,
        isFollowing: !1,
        isHidden: !1,
        isAnimating: !1,
        start: function(e) {
            this.isFollowing || (this.isFollowing = !0, this.mouseY0 = e.pageY, this.mouseX0 = e.pageX, this.topDelta = 0, this.leftDelta = 0, this.isHidden || this.updatePosition(), t(document).on("mousemove", this.mousemoveProxy = t.proxy(this, "mousemove")))
        },
        stop: function(e, n) {
            function i() {
                this.isAnimating = !1, r.destroyEl(), this.top0 = this.left0 = null, n && n()
            }
            var r = this,
                s = this.options.revertDuration;
            this.isFollowing && !this.isAnimating && (this.isFollowing = !1, t(document).off("mousemove", this.mousemoveProxy), e && s && !this.isHidden ? (this.isAnimating = !0, this.el.animate({
                top: this.top0,
                left: this.left0
            }, {
                duration: s,
                complete: i
            })) : i())
        },
        getEl: function() {
            var t = this.el;
            return t || (this.sourceEl.width(), t = this.el = this.sourceEl.clone().css({
                position: "absolute",
                visibility: "",
                display: this.isHidden ? "none" : "",
                margin: 0,
                right: "auto",
                bottom: "auto",
                width: this.sourceEl.width(),
                height: this.sourceEl.height(),
                opacity: this.options.opacity || "",
                zIndex: this.options.zIndex
            }).appendTo(this.parentEl)), t
        },
        destroyEl: function() {
            this.el && (this.el.remove(), this.el = null)
        },
        updatePosition: function() {
            var t, e;
            this.getEl(), null === this.top0 && (this.sourceEl.width(), t = this.sourceEl.offset(), e = this.el.offsetParent().offset(), this.top0 = t.top - e.top, this.left0 = t.left - e.left), this.el.css({
                top: this.top0 + this.topDelta,
                left: this.left0 + this.leftDelta
            })
        },
        mousemove: function(t) {
            this.topDelta = t.pageY - this.mouseY0, this.leftDelta = t.pageX - this.mouseX0, this.isHidden || this.updatePosition()
        },
        hide: function() {
            this.isHidden || (this.isHidden = !0, this.el && this.el.hide())
        },
        show: function() {
            this.isHidden && (this.isHidden = !1, this.updatePosition(), this.getEl().show())
        }
    }, ee.prototype = {
        view: null,
        cellHtml: "<td/>",
        rowHtml: function(t, e) {
            var n, i, r = this.view,
                s = this.getHtmlRenderer("cell", t),
                o = "";
            for (e = e || 0, n = 0; r.colCnt > n; n++) i = r.cellToDate(e, n), o += s(e, n, i);
            return o = this.bookendCells(o, t, e), "<tr>" + o + "</tr>"
        },
        bookendCells: function(t, e, n) {
            var i = this.view,
                r = this.getHtmlRenderer("intro", e)(n || 0),
                s = this.getHtmlRenderer("outro", e)(n || 0),
                o = i.opt("isRTL"),
                l = o ? s : r,
                a = o ? r : s;
            return "string" == typeof t ? l + t + a : t.prepend(l).append(a)
        },
        getHtmlRenderer: function(t, e) {
            var n, i, r, s, o = this.view;
            return n = t + "Html", e && (i = e + L(t) + "Html"), i && (s = o[i]) ? r = o : i && (s = this[i]) ? r = this : (s = o[n]) ? r = o : (s = this[n]) && (r = this), "function" == typeof s ? function() {
                return s.apply(r, arguments) || ""
            } : function() {
                return s || ""
            }
        }
    }, ne.prototype = k(ee.prototype), t.extend(ne.prototype, {
        el: null,
        coordMap: null,
        cellDuration: null,
        elsByFill: null,
        render: function() {
            this.bindHandlers()
        },
        destroy: function() {},
        buildCoords: function() {},
        getCellDate: function() {},
        getCellDayEl: function() {},
        rangeToSegs: function() {},
        bindHandlers: function() {
            var e = this;
            this.el.on("mousedown", function(n) {
                t(n.target).is(".fc-event-container *, .fc-more") || t(n.target).closest(".fc-popover").length || e.dayMousedown(n)
            }), this.bindSegHandlers()
        },
        dayMousedown: function(t) {
            var e, n, i, r = this,
                s = this.view,
                o = s.calendar,
                l = s.opt("selectable"),
                a = null,
                c = new Q(this.coordMap, {
                    scroll: s.opt("dragScroll"),
                    dragStart: function() {
                        s.unselect()
                    },
                    cellOver: function(t, s) {
                        c.origDate && (i = r.getCellDayEl(t), a = [s, c.origDate].sort(z), e = a[0], n = a[1].clone().add(r.cellDuration), l && (o.isSelectionAllowedInRange(e, n) ? r.renderSelection(e, n) : (a = null, f())))
                    },
                    cellOut: function() {
                        a = null, r.destroySelection(), g()
                    },
                    listenStop: function(t) {
                        a && (a[0].isSame(a[1]) && s.trigger("dayClick", i[0], e, t), l && s.reportSelection(e, n, t)), g()
                    }
                });
            c.mousedown(t)
        },
        renderDrag: function() {},
        destroyDrag: function() {},
        renderResize: function() {},
        destroyResize: function() {},
        renderRangeHelper: function(t, e, n) {
            var i, r = this.view;
            !e && r.opt("forceEventDuration") && (e = r.calendar.getDefaultEventEnd(!t.hasTime(), t)), i = n ? k(n.event) : {}, i.start = t, i.end = e, i.allDay = !(t.hasTime() || e && e.hasTime()), i.className = (i.className || []).concat("fc-helper"), n || (i.editable = !1), this.renderHelper(i, n)
        },
        renderHelper: function() {},
        destroyHelper: function() {},
        renderSelection: function(t, e) {
            this.renderHighlight(t, e)
        },
        destroySelection: function() {
            this.destroyHighlight()
        },
        renderHighlight: function(t, e) {
            this.renderFill("highlight", this.rangeToSegs(t, e))
        },
        destroyHighlight: function() {
            this.destroyFill("highlight")
        },
        highlightSegClasses: function() {
            return ["fc-highlight"]
        },
        renderFill: function() {},
        destroyFill: function(t) {
            var e = this.elsByFill[t];
            e && (e.remove(), delete this.elsByFill[t])
        },
        renderFillSegEls: function(e, n) {
            var i, r = this,
                s = this[e + "SegEl"],
                o = "",
                l = [];
            if (n.length) {
                for (i = 0; n.length > i; i++) o += this.fillSegHtml(e, n[i]);
                t(o).each(function(e, i) {
                    var o = n[e],
                        a = t(i);
                    s && (a = s.call(r, o, a)), a && (a = t(a), a.is(r.fillSegTag) && (o.el = a, l.push(o)))
                })
            }
            return l
        },
        fillSegTag: "div",
        fillSegHtml: function(t, e) {
            var n = this[t + "SegClasses"],
                i = this[t + "SegStyles"],
                r = n ? n.call(this, e) : [],
                s = i ? i.call(this, e) : "";
            return "<" + this.fillSegTag + (r.length ? ' class="' + r.join(" ") + '"' : "") + (s ? ' style="' + s + '"' : "") + " />"
        },
        headHtml: function() {
            return '<div class="fc-row ' + this.view.widgetHeaderClass + '">' + "<table>" + "<thead>" + this.rowHtml("head") + "</thead>" + "</table>" + "</div>"
        },
        headCellHtml: function(t, e, n) {
            var i = this.view,
                r = i.calendar,
                s = i.opt("columnFormat");
            return '<th class="fc-day-header ' + i.widgetHeaderClass + " fc-" + Ye[n.day()] + '">' + P(r.formatDate(n, s)) + "</th>"
        },
        bgCellHtml: function(t, e, n) {
            var i = this.view,
                r = this.getDayClasses(n);
            return r.unshift("fc-day", i.widgetContentClass), '<td class="' + r.join(" ") + '" data-date="' + n.format() + '"></td>'
        },
        getDayClasses: function(t) {
            var e = this.view,
                n = e.calendar.getNow().stripTime(),
                i = ["fc-" + Ye[t.day()]];
            return "month" === e.name && t.month() != e.intervalStart.month() && i.push("fc-other-month"), t.isSame(n, "day") ? i.push("fc-today", e.highlightStateClass) : n > t ? i.push("fc-past") : i.push("fc-future"), i
        }
    }), t.extend(ne.prototype, {
        mousedOverSeg: null,
        isDraggingSeg: !1,
        isResizingSeg: !1,
        segs: null,
        renderEvents: function(t) {
            var e, n, i = this.eventsToSegs(t),
                r = [],
                s = [];
            for (e = 0; i.length > e; e++) n = i[e], ie(n.event) ? r.push(n) : s.push(n);
            r = this.renderBgSegs(r) || r, s = this.renderFgSegs(s) || s, this.segs = r.concat(s)
        },
        destroyEvents: function() {
            this.triggerSegMouseout(), this.destroyFgSegs(), this.destroyBgSegs(), this.segs = null
        },
        getSegs: function() {
            return this.segs || []
        },
        renderFgSegs: function() {},
        destroyFgSegs: function() {},
        renderFgSegEls: function(e, n) {
            var i, r = this.view,
                s = "",
                o = [];
            if (e.length) {
                for (i = 0; e.length > i; i++) s += this.fgSegHtml(e[i], n);
                t(s).each(function(n, i) {
                    var s = e[n],
                        l = r.resolveEventEl(s.event, t(i));
                    l && (l.data("fc-seg", s), s.el = l, o.push(s))
                })
            }
            return o
        },
        fgSegHtml: function() {},
        renderBgSegs: function(t) {
            return this.renderFill("bgEvent", t)
        },
        destroyBgSegs: function() {
            this.destroyFill("bgEvent")
        },
        bgEventSegEl: function(t, e) {
            return this.view.resolveEventEl(t.event, e)
        },
        bgEventSegClasses: function(t) {
            var e = t.event,
                n = e.source || {};
            return ["fc-bgevent"].concat(e.className, n.className || [])
        },
        bgEventSegStyles: function(t) {
            var e = this.view,
                n = t.event,
                i = n.source || {},
                r = n.color,
                s = i.color,
                o = e.opt("eventColor"),
                l = n.backgroundColor || r || i.backgroundColor || s || e.opt("eventBackgroundColor") || o;
            return l ? "background-color:" + l : ""
        },
        businessHoursSegClasses: function() {
            return ["fc-nonbusiness", "fc-bgevent"]
        },
        bindSegHandlers: function() {
            var e = this,
                n = this.view;
            t.each({
                mouseenter: function(t, n) {
                    e.triggerSegMouseover(t, n)
                },
                mouseleave: function(t, n) {
                    e.triggerSegMouseout(t, n)
                },
                click: function(t, e) {
                    return n.trigger("eventClick", this, t.event, e)
                },
                mousedown: function(i, r) {
                    t(r.target).is(".fc-resizer") && n.isEventResizable(i.event) ? e.segResizeMousedown(i, r) : n.isEventDraggable(i.event) && e.segDragMousedown(i, r)
                }
            }, function(n, i) {
                e.el.on(n, ".fc-event-container > *", function(n) {
                    var r = t(this).data("fc-seg");
                    return !r || e.isDraggingSeg || e.isResizingSeg ? void 0 : i.call(this, r, n)
                })
            })
        },
        triggerSegMouseover: function(t, e) {
            this.mousedOverSeg || (this.mousedOverSeg = t, this.view.trigger("eventMouseover", t.el[0], t.event, e))
        },
        triggerSegMouseout: function(t, e) {
            e = e || {}, this.mousedOverSeg && (t = t || this.mousedOverSeg, this.mousedOverSeg = null, this.view.trigger("eventMouseout", t.el[0], t.event, e))
        },
        segDragMousedown: function(t, e) {
            var n, i, r = this,
                s = this.view,
                o = s.calendar,
                l = t.el,
                a = t.event,
                c = new te(t.el, {
                    parentEl: s.el,
                    opacity: s.opt("dragOpacity"),
                    revertDuration: s.opt("dragRevertDuration"),
                    zIndex: 2
                }),
                d = new Q(s.coordMap, {
                    distance: 5,
                    scroll: s.opt("dragScroll"),
                    listenStart: function(t) {
                        c.hide(), c.start(t)
                    },
                    dragStart: function(e) {
                        r.triggerSegMouseout(t, e), r.isDraggingSeg = !0, s.hideEvent(a), s.trigger("eventDragStart", l[0], a, e, {})
                    },
                    cellOver: function(e, l) {
                        var u = t.cellDate || d.origDate,
                            h = r.computeDraggedEventDates(t, u, l);
                        n = h.start, i = h.end, o.isEventAllowedInRange(a, n, h.visibleEnd) ? s.renderDrag(n, i, t) ? c.hide() : c.show() : (n = null, c.show(), f())
                    },
                    cellOut: function() {
                        n = null, s.destroyDrag(), c.show(), g()
                    },
                    dragStop: function(t) {
                        var e = n && !n.isSame(a.start);
                        c.stop(!e, function() {
                            r.isDraggingSeg = !1, s.destroyDrag(), s.showEvent(a), s.trigger("eventDragStop", l[0], a, t, {}), e && s.eventDrop(l[0], a, n, t)
                        }), g()
                    },
                    listenStop: function() {
                        c.stop()
                    }
                });
            d.mousedown(e)
        },
        computeDraggedEventDates: function(t, e, n) {
            var i, r, s, o, l, a = this.view,
                c = t.event,
                d = c.start,
                u = a.calendar.getEventEnd(c);
            return n.hasTime() === e.hasTime() ? (i = C(n, e), r = d.clone().add(i), s = null === c.end ? null : u.clone().add(i), o = c.allDay) : (r = n, s = null, o = !n.hasTime()), l = s || a.calendar.getDefaultEventEnd(o, r), {
                start: r,
                end: s,
                visibleEnd: l
            }
        },
        segResizeMousedown: function(t, e) {
            function n() {
                r.destroyResize(), s.showEvent(a)
            }
            var i, r = this,
                s = this.view,
                o = s.calendar,
                l = t.el,
                a = t.event,
                c = a.start,
                d = s.calendar.getEventEnd(a),
                u = null;
            i = new Q(this.coordMap, {
                distance: 5,
                scroll: s.opt("dragScroll"),
                dragStart: function(e) {
                    r.triggerSegMouseout(t, e), r.isResizingSeg = !0, s.trigger("eventResizeStart", l[0], a, e, {})
                },
                cellOver: function(e, i) {
                    i.isBefore(c) && (i = c), u = i.clone().add(r.cellDuration), o.isEventAllowedInRange(a, c, u) ? u.isSame(d) ? (u = null, n()) : (r.renderResize(c, u, t), s.hideEvent(a)) : (u = null, n(), f())
                },
                cellOut: function() {
                    u = null, n(), g()
                },
                dragStop: function(t) {
                    r.isResizingSeg = !1, n(), g(), s.trigger("eventResizeStop", l[0], a, t, {}), u && s.eventResize(l[0], a, u, t)
                }
            }), i.mousedown(e)
        },
        getSegClasses: function(t, e, n) {
            var i = t.event,
                r = ["fc-event", t.isStart ? "fc-start" : "fc-not-start", t.isEnd ? "fc-end" : "fc-not-end"].concat(i.className, i.source ? i.source.className : []);
            return e && r.push("fc-draggable"), n && r.push("fc-resizable"), r
        },
        getEventSkinCss: function(t) {
            var e = this.view,
                n = t.source || {},
                i = t.color,
                r = n.color,
                s = e.opt("eventColor"),
                o = t.backgroundColor || i || n.backgroundColor || r || e.opt("eventBackgroundColor") || s,
                l = t.borderColor || i || n.borderColor || r || e.opt("eventBorderColor") || s,
                a = t.textColor || n.textColor || e.opt("eventTextColor"),
                c = [];
            return o && c.push("background-color:" + o), l && c.push("border-color:" + l), a && c.push("color:" + a), c.join(";")
        },
        eventsToSegs: function(t, e) {
            var n, i = this.eventsToRanges(t),
                r = [];
            for (n = 0; i.length > n; n++) r.push.apply(r, this.eventRangeToSegs(i[n], e));
            return r
        },
        eventsToRanges: function(e) {
            var n = this,
                i = oe(e),
                r = [];
            return t.each(i, function(t, e) {
                e.length && r.push.apply(r, re(e[0]) ? n.eventsToInverseRanges(e) : n.eventsToNormalRanges(e))
            }), r
        },
        eventsToNormalRanges: function(t) {
            var e, n, i, r, s = this.view.calendar,
                o = [];
            for (e = 0; t.length > e; e++) n = t[e], i = n.start.clone().stripZone(), r = s.getEventEnd(n).stripZone(), o.push({
                event: n,
                start: i,
                end: r,
                eventStartMS: +i,
                eventDurationMS: r - i
            });
            return o
        },
        eventsToInverseRanges: function(t) {
            var e, n, i = this.view,
                r = i.start.clone().stripZone(),
                s = i.end.clone().stripZone(),
                o = this.eventsToNormalRanges(t),
                l = [],
                a = t[0],
                c = r;
            for (o.sort(le), e = 0; o.length > e; e++) n = o[e], n.start > c && l.push({
                event: a,
                start: c,
                end: n.start
            }), c = n.end;
            return s > c && l.push({
                event: a,
                start: c,
                end: s
            }), l
        },
        eventRangeToSegs: function(t, e) {
            var n, i, r;
            for (n = e ? e(t.start, t.end) : this.rangeToSegs(t.start, t.end), i = 0; n.length > i; i++) r = n[i], r.event = t.event, r.eventStartMS = t.eventStartMS, r.eventDurationMS = t.eventDurationMS;
            return n
        }
    }), ce.prototype = k(ne.prototype), t.extend(ce.prototype, {
        numbersVisible: !1,
        cellDuration: e.duration({
            days: 1
        }),
        bottomCoordPadding: 0,
        rowEls: null,
        dayEls: null,
        helperEls: null,
        render: function(e) {
            var n, i = this.view,
                r = "";
            for (n = 0; i.rowCnt > n; n++) r += this.dayRowHtml(n, e);
            this.el.html(r), this.rowEls = this.el.find(".fc-row"), this.dayEls = this.el.find(".fc-day"), this.dayEls.each(function(e, n) {
                var r = i.cellToDate(Math.floor(e / i.colCnt), e % i.colCnt);
                i.trigger("dayRender", null, r, t(n))
            }), ne.prototype.render.call(this)
        },
        destroy: function() {
            this.destroySegPopover()
        },
        dayRowHtml: function(t, e) {
            var n = this.view,
                i = ["fc-row", "fc-week", n.widgetContentClass];
            return e && i.push("fc-rigid"), '<div class="' + i.join(" ") + '">' + '<div class="fc-bg">' + "<table>" + this.rowHtml("day", t) + "</table>" + "</div>" + '<div class="fc-content-skeleton">' + "<table>" + (this.numbersVisible ? "<thead>" + this.rowHtml("number", t) + "</thead>" : "") + "</table>" + "</div>" + "</div>"
        },
        dayCellHtml: function(t, e, n) {
            return this.bgCellHtml(t, e, n)
        },
        buildCoords: function(e, n) {
            var i, r, s, o = this.view.colCnt;
            this.dayEls.slice(0, o).each(function(e, o) {
                i = t(o), r = i.offset().left, e && (s[1] = r), s = [r], n[e] = s
            }), s[1] = r + i.outerWidth(), this.rowEls.each(function(n, o) {
                i = t(o), r = i.offset().top, n && (s[1] = r), s = [r], e[n] = s
            }), s[1] = r + i.outerHeight() + this.bottomCoordPadding
        },
        getCellDate: function(t) {
            return this.view.cellToDate(t)
        },
        getCellDayEl: function(t) {
            return this.dayEls.eq(t.row * this.view.colCnt + t.col)
        },
        rangeToSegs: function(t, e) {
            return this.view.rangeToSegments(t, e)
        },
        renderDrag: function(t, e, n) {
            var i;
            return this.renderHighlight(t, e || this.view.calendar.getDefaultEventEnd(!0, t)), n && !n.el.closest(this.el).length ? (this.renderRangeHelper(t, e, n), i = this.view.opt("dragOpacity"), void 0 !== i && this.helperEls.css("opacity", i), !0) : void 0
        },
        destroyDrag: function() {
            this.destroyHighlight(), this.destroyHelper()
        },
        renderResize: function(t, e, n) {
            this.renderHighlight(t, e), this.renderRangeHelper(t, e, n)
        },
        destroyResize: function() {
            this.destroyHighlight(), this.destroyHelper()
        },
        renderHelper: function(e, n) {
            var i, r = [],
                s = this.eventsToSegs([e]);
            s = this.renderFgSegEls(s), i = this.renderSegRows(s), this.rowEls.each(function(e, s) {
                var o, l = t(s),
                    a = t('<div class="fc-helper-skeleton"><table/></div>');
                o = n && n.row === e ? n.el.position().top : l.find(".fc-content-skeleton tbody").position().top, a.css("top", o).find("table").append(i[e].tbodyEl), l.append(a), r.push(a[0])
            }), this.helperEls = t(r)
        },
        destroyHelper: function() {
            this.helperEls && (this.helperEls.remove(), this.helperEls = null)
        },
        fillSegTag: "td",
        renderFill: function(e, n) {
            var i, r, s, o = [];
            for (n = this.renderFillSegEls(e, n), i = 0; n.length > i; i++) r = n[i], s = this.renderFillRow(e, r), this.rowEls.eq(r.row).append(s), o.push(s[0]);
            return this.elsByFill[e] = t(o), n
        },
        renderFillRow: function(e, n) {
            var i, r, s = this.view.colCnt,
                o = n.leftCol,
                l = n.rightCol + 1;
            return i = t('<div class="fc-' + e.toLowerCase() + '-skeleton">' + "<table><tr/></table>" + "</div>"), r = i.find("tr"), o > 0 && r.append('<td colspan="' + o + '"/>'), r.append(n.el.attr("colspan", l - o)), s > l && r.append('<td colspan="' + (s - l) + '"/>'), this.bookendCells(r, e), i
        }
    }), t.extend(ce.prototype, {
        rowStructs: null,
        destroyEvents: function() {
            this.destroySegPopover(), ne.prototype.destroyEvents.apply(this, arguments)
        },
        getSegs: function() {
            return ne.prototype.getSegs.call(this).concat(this.popoverSegs || [])
        },
        renderBgSegs: function(e) {
            var n = t.grep(e, function(t) {
                return t.event.allDay
            });
            return ne.prototype.renderBgSegs.call(this, n)
        },
        renderFgSegs: function(e) {
            var n;
            return e = this.renderFgSegEls(e), n = this.rowStructs = this.renderSegRows(e), this.rowEls.each(function(e, i) {
                t(i).find(".fc-content-skeleton > table").append(n[e].tbodyEl)
            }), e
        },
        destroyFgSegs: function() {
            for (var t, e = this.rowStructs || []; t = e.pop();) t.tbodyEl.remove();
            this.rowStructs = null
        },
        renderSegRows: function(t) {
            var e, n, i = [];
            for (e = this.groupSegRows(t), n = 0; e.length > n; n++) i.push(this.renderSegRow(n, e[n]));
            return i
        },
        fgSegHtml: function(t, e) {
            var n, i = this.view,
                r = i.opt("isRTL"),
                s = t.event,
                o = i.isEventDraggable(s),
                l = !e && s.allDay && t.isEnd && i.isEventResizable(s),
                a = this.getSegClasses(t, o, l),
                c = this.getEventSkinCss(s),
                d = "";
            return a.unshift("fc-day-grid-event"), !s.allDay && t.isStart && (d = '<span class="fc-time">' + P(i.getEventTimeText(s)) + "</span>"), n = '<span class="fc-title">' + (P(s.title || "") || "&nbsp;") + "</span>", '<a class="' + a.join(" ") + '"' + (s.url ? ' href="' + P(s.url) + '"' : "") + (c ? ' style="' + c + '"' : "") + ">" + '<div class="fc-content">' + (r ? n + " " + d : d + " " + n) + "</div>" + (l ? '<div class="fc-resizer"/>' : "") + "</a>"
        },
        renderSegRow: function(e, n) {
            function i(e) {
                for (; e > o;) d = (y[r - 1] || [])[o], d ? d.attr("rowspan", parseInt(d.attr("rowspan") || 1, 10) + 1) : (d = t("<td/>"), l.append(d)), v[r][o] = d, y[r][o] = d, o++
            }
            var r, s, o, l, a, c, d, u = this.view,
                h = u.colCnt,
                f = this.buildSegLevels(n),
                g = Math.max(1, f.length),
                p = t("<tbody/>"),
                m = [],
                v = [],
                y = [];
            for (r = 0; g > r; r++) {
                if (s = f[r], o = 0, l = t("<tr/>"), m.push([]), v.push([]), y.push([]), s)
                    for (a = 0; s.length > a; a++) {
                        for (c = s[a], i(c.leftCol), d = t('<td class="fc-event-container"/>').append(c.el), c.leftCol != c.rightCol ? d.attr("colspan", c.rightCol - c.leftCol + 1) : y[r][o] = d; c.rightCol >= o;) v[r][o] = d, m[r][o] = c, o++;
                        l.append(d)
                    }
                i(h), this.bookendCells(l, "eventSkeleton"), p.append(l)
            }
            return {
                row: e,
                tbodyEl: p,
                cellMatrix: v,
                segMatrix: m,
                segLevels: f,
                segs: n
            }
        },
        buildSegLevels: function(t) {
            var e, n, i, r = [];
            for (t.sort(ae), e = 0; t.length > e; e++) {
                for (n = t[e], i = 0; r.length > i && de(n, r[i]); i++);
                n.level = i, (r[i] || (r[i] = [])).push(n)
            }
            for (i = 0; r.length > i; i++) r[i].sort(ue);
            return r
        },
        groupSegRows: function(t) {
            var e, n = this.view,
                i = [];
            for (e = 0; n.rowCnt > e; e++) i.push([]);
            for (e = 0; t.length > e; e++) i[t[e].row].push(t[e]);
            return i
        }
    }), t.extend(ce.prototype, {
        segPopover: null,
        popoverSegs: null,
        destroySegPopover: function() {
            this.segPopover && this.segPopover.hide()
        },
        limitRows: function(t) {
            var e, n, i = this.rowStructs || [];
            for (e = 0; i.length > e; e++) this.unlimitRow(e), n = t ? "number" == typeof t ? t : this.computeRowLevelLimit(e) : !1, n !== !1 && this.limitRow(e, n)
        },
        computeRowLevelLimit: function(t) {
            var e, n, i = this.rowEls.eq(t),
                r = i.height(),
                s = this.rowStructs[t].tbodyEl.children();
            for (e = 0; s.length > e; e++)
                if (n = s.eq(e).removeClass("fc-limited"), n.position().top + n.outerHeight() > r) return e;
            return !1
        },
        limitRow: function(e, n) {
            function i(i) {
                for (; i > T;) r = {
                    row: e,
                    col: T
                }, d = S.getCellSegs(r, n), d.length && (f = o[n - 1][T], w = S.renderMoreLink(r, d), y = t("<div/>").append(w), f.append(y), D.push(y[0])), T++
            }
            var r, s, o, l, a, c, d, u, h, f, g, p, m, v, y, w, S = this,
                b = this.view,
                E = this.rowStructs[e],
                D = [],
                T = 0;
            if (n && E.segLevels.length > n) {
                for (s = E.segLevels[n - 1], o = E.cellMatrix, l = E.tbodyEl.children().slice(n).addClass("fc-limited").get(), a = 0; s.length > a; a++) {
                    for (c = s[a], i(c.leftCol), h = [], u = 0; c.rightCol >= T;) r = {
                        row: e,
                        col: T
                    }, d = this.getCellSegs(r, n), h.push(d), u += d.length, T++;
                    if (u) {
                        for (f = o[n - 1][c.leftCol], g = f.attr("rowspan") || 1, p = [], m = 0; h.length > m; m++) v = t('<td class="fc-more-cell"/>').attr("rowspan", g), d = h[m], r = {
                            row: e,
                            col: c.leftCol + m
                        }, w = this.renderMoreLink(r, [c].concat(d)), y = t("<div/>").append(w), v.append(y), p.push(v[0]), D.push(v[0]);
                        f.addClass("fc-limited").after(t(p)), l.push(f[0])
                    }
                }
                i(b.colCnt), E.moreEls = t(D), E.limitedEls = t(l)
            }
        },
        unlimitRow: function(t) {
            var e = this.rowStructs[t];
            e.moreEls && (e.moreEls.remove(), e.moreEls = null), e.limitedEls && (e.limitedEls.removeClass("fc-limited"), e.limitedEls = null)
        },
        renderMoreLink: function(e, n) {
            var i = this,
                r = this.view;
            return t('<a class="fc-more"/>').text(this.getMoreLinkText(n.length)).on("click", function(s) {
                var o = r.opt("eventLimitClick"),
                    l = r.cellToDate(e),
                    a = t(this),
                    c = i.getCellDayEl(e),
                    d = i.getCellSegs(e),
                    u = i.resliceDaySegs(d, l),
                    h = i.resliceDaySegs(n, l);
                "function" == typeof o && (o = r.trigger("eventLimitClick", null, {
                    date: l,
                    dayEl: c,
                    moreEl: a,
                    segs: u,
                    hiddenSegs: h
                }, s)), "popover" === o ? i.showSegPopover(l, e, a, u) : "string" == typeof o && r.calendar.zoomTo(l, o)
            })
        },
        showSegPopover: function(t, e, n, i) {
            var r, s, o = this,
                l = this.view,
                a = n.parent();
            r = 1 == l.rowCnt ? this.view.el : this.rowEls.eq(e.row), s = {
                className: "fc-more-popover",
                content: this.renderSegPopoverContent(t, i),
                parentEl: this.el,
                top: r.offset().top,
                autoHide: !0,
                viewportConstrain: l.opt("popoverViewportConstrain"),
                hide: function() {
                    o.segPopover.destroy(), o.segPopover = null, o.popoverSegs = null
                }
            }, l.opt("isRTL") ? s.right = a.offset().left + a.outerWidth() + 1 : s.left = a.offset().left - 1, this.segPopover = new q(s), this.segPopover.show()
        },
        renderSegPopoverContent: function(e, n) {
            var i, r = this.view,
                s = r.opt("theme"),
                o = e.format(r.opt("dayPopoverFormat")),
                l = t('<div class="fc-header ' + r.widgetHeaderClass + '">' + '<span class="fc-close ' + (s ? "ui-icon ui-icon-closethick" : "fc-icon fc-icon-x") + '"></span>' + '<span class="fc-title">' + P(o) + "</span>" + '<div class="fc-clear"/>' + "</div>" + '<div class="fc-body ' + r.widgetContentClass + '">' + '<div class="fc-event-container"></div>' + "</div>"),
                a = l.find(".fc-event-container");
            for (n = this.renderFgSegEls(n, !0), this.popoverSegs = n, i = 0; n.length > i; i++) n[i].cellDate = e, a.append(n[i].el);
            return l
        },
        resliceDaySegs: function(e, n) {
            var i = t.map(e, function(t) {
                    return t.event
                }),
                r = n.clone().stripTime(),
                s = r.clone().add(1, "days");
            return this.eventsToSegs(i, function(t, e) {
                var n = D(t, e, r, s);
                return n ? [n] : []
            })
        },
        getMoreLinkText: function(t) {
            var e = this.view,
                n = e.opt("eventLimitText");
            return "function" == typeof n ? n(t) : "+" + t + " " + n
        },
        getCellSegs: function(t, e) {
            for (var n, i = this.rowStructs[t.row].segMatrix, r = e || 0, s = []; i.length > r;) n = i[r][t.col], n && s.push(n), r++;
            return s
        }
    }), he.prototype = k(ne.prototype), t.extend(he.prototype, {
        slotDuration: null,
        snapDuration: null,
        minTime: null,
        maxTime: null,
        dayEls: null,
        slatEls: null,
        slatTops: null,
        helperEl: null,
        businessHourSegs: null,
        render: function() {
            this.processOptions(), this.el.html(this.renderHtml()), this.dayEls = this.el.find(".fc-day"), this.slatEls = this.el.find(".fc-slats tr"), this.computeSlatTops(), this.renderBusinessHours(), ne.prototype.render.call(this)
        },
        renderBusinessHours: function() {
            var t = this.view.calendar.getBusinessHoursEvents();
            this.businessHourSegs = this.renderFill("businessHours", this.eventsToSegs(t), "bgevent")
        },
        renderHtml: function() {
            return '<div class="fc-bg"><table>' + this.rowHtml("slotBg") + "</table>" + "</div>" + '<div class="fc-slats">' + "<table>" + this.slatRowHtml() + "</table>" + "</div>"
        },
        slotBgCellHtml: function(t, e, n) {
            return this.bgCellHtml(t, e, n)
        },
        slatRowHtml: function() {
            for (var t, n, i, r = this.view, s = r.calendar, o = r.opt("isRTL"), l = "", a = 0 === this.slotDuration.asMinutes() % 15, c = e.duration(+this.minTime); this.maxTime > c;) t = r.start.clone().time(c), n = t.minutes(), i = '<td class="fc-axis fc-time ' + r.widgetContentClass + '" ' + r.axisStyleAttr() + ">" + (a && n ? "" : "<span>" + P(s.formatDate(t, r.opt("axisFormat"))) + "</span>") + "</td>", l += "<tr " + (n ? 'class="fc-minor"' : "") + ">" + (o ? "" : i) + '<td class="' + r.widgetContentClass + '"/>' + (o ? i : "") + "</tr>", c.add(this.slotDuration);
            return l
        },
        processOptions: function() {
            var t = this.view,
                n = t.opt("slotDuration"),
                i = t.opt("snapDuration");
            n = e.duration(n), i = i ? e.duration(i) : n, this.slotDuration = n, this.snapDuration = i, this.cellDuration = i, this.minTime = e.duration(t.opt("minTime")), this.maxTime = e.duration(t.opt("maxTime"))
        },
        rangeToSegs: function(t, e) {
            var n, i, r, s, o, l = this.view,
                a = [];
            for (t = t.clone().stripZone(), e = e.clone().stripZone(), i = 0; l.colCnt > i; i++) r = l.cellToDate(0, i), s = r.clone().time(this.minTime), o = r.clone().time(this.maxTime), n = D(t, e, s, o), n && (n.col = i, a.push(n));
            return a
        },
        resize: function() {
            this.computeSlatTops(), this.updateSegVerticals()
        },
        buildCoords: function(n, i) {
            var r, s, o = this.view.colCnt,
                l = this.el.offset().top,
                a = e.duration(+this.minTime),
                c = null;
            for (this.dayEls.slice(0, o).each(function(e, n) {
                    r = t(n), s = r.offset().left, c && (c[1] = s), c = [s], i[e] = c
                }), c[1] = s + r.outerWidth(), c = null; this.maxTime > a;) s = l + this.computeTimeTop(a), c && (c[1] = s), c = [s], n.push(c), a.add(this.snapDuration);
            c[1] = l + this.computeTimeTop(a)
        },
        getCellDate: function(t) {
            var e = this.view,
                n = e.calendar;
            return n.rezoneDate(e.cellToDate(0, t.col).time(this.minTime + this.snapDuration * t.row))
        },
        getCellDayEl: function(t) {
            return this.dayEls.eq(t.col)
        },
        computeDateTop: function(t, n) {
            return this.computeTimeTop(e.duration(t.clone().stripZone() - n.clone().stripTime()))
        },
        computeTimeTop: function(t) {
            var e, n, i, r, s = (t - this.minTime) / this.slotDuration;
            return s = Math.max(0, s), s = Math.min(this.slatEls.length, s), e = Math.floor(s), n = s - e, i = this.slatTops[e], n ? (r = this.slatTops[e + 1], i + (r - i) * n) : i
        },
        computeSlatTops: function() {
            var e, n = [];
            this.slatEls.each(function(i, r) {
                e = t(r).position().top, n.push(e)
            }), n.push(e + this.slatEls.last().outerHeight()), this.slatTops = n
        },
        renderDrag: function(t, e, n) {
            var i;
            return n ? (this.renderRangeHelper(t, e, n), i = this.view.opt("dragOpacity"), void 0 !== i && this.helperEl.css("opacity", i), !0) : (this.renderHighlight(t, e || this.view.calendar.getDefaultEventEnd(!1, t)), void 0)
        },
        destroyDrag: function() {
            this.destroyHelper(), this.destroyHighlight()
        },
        renderResize: function(t, e, n) {
            this.renderRangeHelper(t, e, n)
        },
        destroyResize: function() {
            this.destroyHelper()
        },
        renderHelper: function(e, n) {
            var i, r, s, o, l = this.eventsToSegs([e]);
            for (l = this.renderFgSegEls(l), i = this.renderSegTable(l), r = 0; l.length > r; r++) s = l[r], n && n.col === s.col && (o = n.el, s.el.css({
                left: o.css("left"),
                right: o.css("right"),
                "margin-left": o.css("margin-left"),
                "margin-right": o.css("margin-right")
            }));
            this.helperEl = t('<div class="fc-helper-skeleton"/>').append(i).appendTo(this.el)
        },
        destroyHelper: function() {
            this.helperEl && (this.helperEl.remove(), this.helperEl = null)
        },
        renderSelection: function(t, e) {
            this.view.opt("selectHelper") ? this.renderRangeHelper(t, e) : this.renderHighlight(t, e)
        },
        destroySelection: function() {
            this.destroyHelper(), this.destroyHighlight()
        },
        renderFill: function(e, n, i) {
            var r, s, o, l, a, c, d, u, h, f, g = this.view;
            if (n.length) {
                for (n = this.renderFillSegEls(e, n), r = this.groupSegCols(n), i = i || e.toLowerCase(), s = t('<div class="fc-' + i + '-skeleton">' + "<table><tr/></table>" + "</div>"), o = s.find("tr"), l = 0; r.length > l; l++)
                    if (a = r[l], c = t("<td/>").appendTo(o), a.length)
                        for (d = t('<div class="fc-' + i + '-container"/>').appendTo(c), u = g.cellToDate(0, l), h = 0; a.length > h; h++) f = a[h], d.append(f.el.css({
                            top: this.computeDateTop(f.start, u),
                            bottom: -this.computeDateTop(f.end, u)
                        }));
                this.bookendCells(o, e), this.el.append(s), this.elsByFill[e] = s
            }
            return n
        }
    }), t.extend(he.prototype, {
        eventSkeletonEl: null,
        renderFgSegs: function(e) {
            return e = this.renderFgSegEls(e), this.el.append(this.eventSkeletonEl = t('<div class="fc-content-skeleton"/>').append(this.renderSegTable(e))), e
        },
        destroyFgSegs: function() {
            this.eventSkeletonEl && (this.eventSkeletonEl.remove(), this.eventSkeletonEl = null)
        },
        renderSegTable: function(e) {
            var n, i, r, s, o, l, a = t("<table><tr/></table>"),
                c = a.find("tr");
            for (n = this.groupSegCols(e), this.computeSegVerticals(e), s = 0; n.length > s; s++) {
                for (o = n[s], fe(o), l = t('<div class="fc-event-container"/>'), i = 0; o.length > i; i++) r = o[i], r.el.css(this.generateSegPositionCss(r)), 30 > r.bottom - r.top && r.el.addClass("fc-short"), l.append(r.el);
                c.append(t("<td/>").append(l))
            }
            return this.bookendCells(c, "eventSkeleton"), a
        },
        updateSegVerticals: function() {
            var t, e = (this.segs || []).concat(this.businessHourSegs || []);
            for (this.computeSegVerticals(e), t = 0; e.length > t; t++) e[t].el.css(this.generateSegVerticalCss(e[t]))
        },
        computeSegVerticals: function(t) {
            var e, n;
            for (e = 0; t.length > e; e++) n = t[e], n.top = this.computeDateTop(n.start, n.start), n.bottom = this.computeDateTop(n.end, n.start)
        },
        fgSegHtml: function(t, e) {
            var n, i, r, s = this.view,
                o = t.event,
                l = s.isEventDraggable(o),
                a = !e && t.isEnd && s.isEventResizable(o),
                c = this.getSegClasses(t, l, a),
                d = this.getEventSkinCss(o);
            return c.unshift("fc-time-grid-event"), s.isMultiDayEvent(o) ? (t.isStart || t.isEnd) && (n = s.getEventTimeText(t.start, t.end), i = s.getEventTimeText(t.start, t.end, "LT"), r = s.getEventTimeText(t.start, null)) : (n = s.getEventTimeText(o), i = s.getEventTimeText(o, "LT"), r = s.getEventTimeText(o.start, null)), '<a class="' + c.join(" ") + '"' + (o.url ? ' href="' + P(o.url) + '"' : "") + (d ? ' style="' + d + '"' : "") + ">" + '<div class="fc-content">' + (n ? '<div class="fc-time" data-start="' + P(r) + '"' + ' data-full="' + P(i) + '"' + ">" + "<span>" + P(n) + "</span>" + "</div>" : "") + (o.title ? '<div class="fc-title">' + P(o.title) + "</div>" : "") + "</div>" + '<div class="fc-bg"/>' + (a ? '<div class="fc-resizer"/>' : "") + "</a>"
        },
        generateSegPositionCss: function(t) {
            var e, n, i = this.view,
                r = i.opt("isRTL"),
                s = i.opt("slotEventOverlap"),
                o = t.backwardCoord,
                l = t.forwardCoord,
                a = this.generateSegVerticalCss(t);
            return s && (l = Math.min(1, o + 2 * (l - o))), r ? (e = 1 - l, n = o) : (e = o, n = 1 - l), a.zIndex = t.level + 1, a.left = 100 * e + "%", a.right = 100 * n + "%", s && t.forwardPressure && (a[r ? "marginLeft" : "marginRight"] = 20), a
        },
        generateSegVerticalCss: function(t) {
            return {
                top: t.top,
                bottom: -t.bottom
            }
        },
        groupSegCols: function(t) {
            var e, n = this.view,
                i = [];
            for (e = 0; n.colCnt > e; e++) i.push([]);
            for (e = 0; t.length > e; e++) i[t[e].col].push(t[e]);
            return i
        }
    }), be.prototype = {
        calendar: null,
        coordMap: null,
        el: null,
        start: null,
        end: null,
        intervalStart: null,
        intervalEnd: null,
        rowCnt: null,
        colCnt: null,
        isSelected: !1,
        scrollerEl: null,
        scrollTop: null,
        widgetHeaderClass: null,
        widgetContentClass: null,
        highlightStateClass: null,
        documentMousedownProxy: null,
        documentDragStartProxy: null,
        init: function() {
            var e = this.opt("theme") ? "ui" : "fc";
            this.widgetHeaderClass = e + "-widget-header", this.widgetContentClass = e + "-widget-content", this.highlightStateClass = e + "-state-highlight", this.documentMousedownProxy = t.proxy(this, "documentMousedown"), this.documentDragStartProxy = t.proxy(this, "documentDragStart")
        },
        render: function() {
            this.updateSize(), this.trigger("viewRender", this, this, this.el), t(document).on("mousedown", this.documentMousedownProxy).on("dragstart", this.documentDragStartProxy)
        },
        destroy: function() {
            this.unselect(), this.trigger("viewDestroy", this, this, this.el), this.destroyEvents(), this.el.empty(), t(document).off("mousedown", this.documentMousedownProxy).off("dragstart", this.documentDragStartProxy)
        },
        incrementDate: function() {},
        updateSize: function(t) {
            t && this.recordScroll(), this.updateHeight(), this.updateWidth()
        },
        updateWidth: function() {},
        updateHeight: function() {
            var t = this.calendar;
            this.setHeight(t.getSuggestedViewHeight(), t.isHeightAuto())
        },
        setHeight: function() {},
        computeScrollerHeight: function(t) {
            var e, n = this.el.add(this.scrollerEl);
            return n.css({
                position: "relative",
                left: -1
            }), e = this.el.outerHeight() - this.scrollerEl.height(), n.css({
                position: "",
                left: ""
            }), t - e
        },
        recordScroll: function() {
            this.scrollerEl && (this.scrollTop = this.scrollerEl.scrollTop())
        },
        restoreScroll: function() {
            null !== this.scrollTop && this.scrollerEl.scrollTop(this.scrollTop)
        },
        renderEvents: function() {
            this.segEach(function(t) {
                this.trigger("eventAfterRender", t.event, t.event, t.el)
            }), this.trigger("eventAfterAllRender")
        },
        destroyEvents: function() {
            this.segEach(function(t) {
                this.trigger("eventDestroy", t.event, t.event, t.el)
            })
        },
        resolveEventEl: function(e, n) {
            var i = this.trigger("eventRender", e, e, n);
            return i === !1 ? n = null : i && i !== !0 && (n = t(i)), n
        },
        showEvent: function(t) {
            this.segEach(function(t) {
                t.el.css("visibility", "")
            }, t)
        },
        hideEvent: function(t) {
            this.segEach(function(t) {
                t.el.css("visibility", "hidden")
            }, t)
        },
        segEach: function(t, e) {
            var n, i = this.getSegs();
            for (n = 0; i.length > n; n++) e && i[n].event._id !== e._id || t.call(this, i[n])
        },
        getSegs: function() {},
        renderDrag: function() {},
        destroyDrag: function() {},
        documentDragStart: function(e) {
            var n, i, r, s, o, l = this,
                a = this.calendar,
                c = null,
                d = null,
                u = null;
            this.opt("droppable") && (n = t(e.target), i = this.opt("dropAccept"), (t.isFunction(i) ? i.call(n[0], n) : n.is(i)) && (r = Ee(n), s = r.eventProps, o = new Q(this.coordMap, {
                cellOver: function(e, n) {
                    c = n, d = r.duration ? c.clone().add(r.duration) : null, u = d || a.getDefaultEventEnd(!c.hasTime(), c), s && t.extend(s, {
                        start: c,
                        end: d
                    }), a.isExternalDragAllowedInRange(c, u, s) ? l.renderDrag(c, u) : (c = null, f())
                },
                cellOut: function() {
                    c = null, l.destroyDrag(), g()
                }
            }), t(document).one("dragstop", function(t, e) {
                var i;
                l.destroyDrag(), g(), c && (r.startTime && !c.hasTime() && c.time(r.startTime), l.trigger("drop", n[0], c, t, e), s && (i = a.renderEvent(s, r.stick), l.trigger("eventReceive", null, i[0])))
            }), o.startDrag(e)))
        },
        select: function(t, e, n) {
            this.unselect(n), this.renderSelection(t, e), this.reportSelection(t, e, n)
        },
        renderSelection: function() {},
        reportSelection: function(t, e, n) {
            this.isSelected = !0, this.trigger("select", null, t, e, n)
        },
        unselect: function(t) {
            this.isSelected && (this.isSelected = !1, this.destroySelection(), this.trigger("unselect", null, t))
        },
        destroySelection: function() {},
        documentMousedown: function(e) {
            var n;
            this.isSelected && this.opt("unselectAuto") && E(e) && (n = this.opt("unselectCancel"), n && t(e.target).closest(n).length || this.unselect(e))
        }
    }, _e.dataAttrPrefix = "", De.prototype = k(be.prototype), t.extend(De.prototype, {
        dayGrid: null,
        dayNumbersVisible: !1,
        weekNumbersVisible: !1,
        weekNumberWidth: null,
        headRowEl: null,
        render: function(t, e, n) {
            this.rowCnt = t, this.colCnt = e, this.dayNumbersVisible = n, this.weekNumbersVisible = this.opt("weekNumbers"), this.dayGrid.numbersVisible = this.dayNumbersVisible || this.weekNumbersVisible, this.el.addClass("fc-basic-view").html(this.renderHtml()), this.headRowEl = this.el.find("thead .fc-row"), this.scrollerEl = this.el.find(".fc-day-grid-container"), this.dayGrid.coordMap.containerEl = this.scrollerEl, this.dayGrid.el = this.el.find(".fc-day-grid"), this.dayGrid.render(this.hasRigidRows()), be.prototype.render.call(this)
        },
        destroy: function() {
            this.dayGrid.destroy(), be.prototype.destroy.call(this)
        },
        renderHtml: function() {
            return '<table><thead><tr><td class="' + this.widgetHeaderClass + '">' + this.dayGrid.headHtml() + "</td>" + "</tr>" + "</thead>" + "<tbody>" + "<tr>" + '<td class="' + this.widgetContentClass + '">' + '<div class="fc-day-grid-container">' + '<div class="fc-day-grid"/>' + "</div>" + "</td>" + "</tr>" + "</tbody>" + "</table>"
        },
        headIntroHtml: function() {
            return this.weekNumbersVisible ? '<th class="fc-week-number ' + this.widgetHeaderClass + '" ' + this.weekNumberStyleAttr() + ">" + "<span>" + P(this.opt("weekNumberTitle")) + "</span>" + "</th>" : void 0
        },
        numberIntroHtml: function(t) {
            return this.weekNumbersVisible ? '<td class="fc-week-number" ' + this.weekNumberStyleAttr() + ">" + "<span>" + this.calendar.calculateWeekNumber(this.cellToDate(t, 0)) + "</span>" + "</td>" : void 0
        },
        dayIntroHtml: function() {
            return this.weekNumbersVisible ? '<td class="fc-week-number ' + this.widgetContentClass + '" ' + this.weekNumberStyleAttr() + "></td>" : void 0
        },
        introHtml: function() {
            return this.weekNumbersVisible ? '<td class="fc-week-number" ' + this.weekNumberStyleAttr() + "></td>" : void 0
        },
        numberCellHtml: function(t, e, n) {
            var i;
            return this.dayNumbersVisible ? (i = this.dayGrid.getDayClasses(n), i.unshift("fc-day-number"), '<td class="' + i.join(" ") + '" data-date="' + n.format() + '">' + n.date() + "</td>") : "<td/>"
        },
        weekNumberStyleAttr: function() {
            return null !== this.weekNumberWidth ? 'style="width:' + this.weekNumberWidth + 'px"' : ""
        },
        hasRigidRows: function() {
            var t = this.opt("eventLimit");
            return t && "number" != typeof t
        },
        updateWidth: function() {
            this.weekNumbersVisible && (this.weekNumberWidth = v(this.el.find(".fc-week-number")))
        },
        setHeight: function(t, e) {
            var n, i = this.opt("eventLimit");
            w(this.scrollerEl), h(this.headRowEl), this.dayGrid.destroySegPopover(), i && "number" == typeof i && this.dayGrid.limitRows(i), n = this.computeScrollerHeight(t), this.setGridHeight(n, e), i && "number" != typeof i && this.dayGrid.limitRows(i), !e && y(this.scrollerEl, n) && (u(this.headRowEl, b(this.scrollerEl)), n = this.computeScrollerHeight(t), this.scrollerEl.height(n), this.restoreScroll())
        },
        setGridHeight: function(t, e) {
            e ? m(this.dayGrid.rowEls) : p(this.dayGrid.rowEls, t, !0)
        },
        renderEvents: function(t) {
            this.dayGrid.renderEvents(t), this.updateHeight(), be.prototype.renderEvents.call(this, t)
        },
        getSegs: function() {
            return this.dayGrid.getSegs()
        },
        destroyEvents: function() {
            be.prototype.destroyEvents.call(this), this.recordScroll(), this.dayGrid.destroyEvents()
        },
        renderDrag: function(t, e, n) {
            return this.dayGrid.renderDrag(t, e, n)
        },
        destroyDrag: function() {
            this.dayGrid.destroyDrag()
        },
        renderSelection: function(t, e) {
            this.dayGrid.renderSelection(t, e)
        },
        destroySelection: function() {
            this.dayGrid.destroySelection()
        }
    }), r({
        fixedWeekCount: !0
    }), Ge.month = Te, Te.prototype = k(De.prototype), t.extend(Te.prototype, {
        name: "month",
        incrementDate: function(t, e) {
            return t.clone().stripTime().add(e, "months").startOf("month")
        },
        render: function(t) {
            var e;
            this.intervalStart = t.clone().stripTime().startOf("month"), this.intervalEnd = this.intervalStart.clone().add(1, "months"), this.start = this.intervalStart.clone(), this.start = this.skipHiddenDays(this.start), this.start.startOf("week"), this.start = this.skipHiddenDays(this.start), this.end = this.intervalEnd.clone(), this.end = this.skipHiddenDays(this.end, -1, !0), this.end.add((7 - this.end.weekday()) % 7, "days"), this.end = this.skipHiddenDays(this.end, -1, !0), e = Math.ceil(this.end.diff(this.start, "weeks", !0)), this.isFixedWeeks() && (this.end.add(6 - e, "weeks"), e = 6), this.title = this.calendar.formatDate(this.intervalStart, this.opt("titleFormat")), De.prototype.render.call(this, e, this.getCellsPerWeek(), !0)
        },
        setGridHeight: function(t, e) {
            e = e || "variable" === this.opt("weekMode"), e && (t *= this.rowCnt / 6), p(this.dayGrid.rowEls, t, !e)
        },
        isFixedWeeks: function() {
            var t = this.opt("weekMode");
            return t ? "fixed" === t : this.opt("fixedWeekCount")
        }
    }), Ge.basicWeek = Ce, Ce.prototype = k(De.prototype), t.extend(Ce.prototype, {
        name: "basicWeek",
        incrementDate: function(t, e) {
            return t.clone().stripTime().add(e, "weeks").startOf("week")
        },
        render: function(t) {
            this.intervalStart = t.clone().stripTime().startOf("week"), this.intervalEnd = this.intervalStart.clone().add(1, "weeks"), this.start = this.skipHiddenDays(this.intervalStart), this.end = this.skipHiddenDays(this.intervalEnd, -1, !0), this.title = this.calendar.formatRange(this.start, this.end.clone().subtract(1), this.opt("titleFormat"), " — "), De.prototype.render.call(this, 1, this.getCellsPerWeek(), !1)
        }
    }), Ge.basicDay = He, He.prototype = k(De.prototype), t.extend(He.prototype, {
        name: "basicDay",
        incrementDate: function(t, e) {
            var n = t.clone().stripTime().add(e, "days");
            return n = this.skipHiddenDays(n, 0 > e ? -1 : 1)
        },
        render: function(t) {
            this.start = this.intervalStart = t.clone().stripTime(), this.end = this.intervalEnd = this.start.clone().add(1, "days"), this.title = this.calendar.formatDate(this.start, this.opt("titleFormat")), De.prototype.render.call(this, 1, 1, !1)
        }
    }), r({
        allDaySlot: !0,
        allDayText: "all-day",
        scrollTime: "06:00:00",
        slotDuration: "00:30:00",
        axisFormat: xe,
        timeFormat: {
            agenda: ke
        },
        minTime: "00:00:00",
        maxTime: "24:00:00",
        slotEventOverlap: !0
    });
    var Ue = 5;
    Me.prototype = k(be.prototype), t.extend(Me.prototype, {
        timeGrid: null,
        dayGrid: null,
        axisWidth: null,
        noScrollRowEls: null,
        bottomRuleEl: null,
        bottomRuleHeight: null,
        render: function(e) {
            this.rowCnt = 1, this.colCnt = e, this.el.addClass("fc-agenda-view").html(this.renderHtml()), this.scrollerEl = this.el.find(".fc-time-grid-container"), this.timeGrid.coordMap.containerEl = this.scrollerEl, this.timeGrid.el = this.el.find(".fc-time-grid"), this.timeGrid.render(), this.bottomRuleEl = t('<hr class="' + this.widgetHeaderClass + '"/>').appendTo(this.timeGrid.el), this.dayGrid && (this.dayGrid.el = this.el.find(".fc-day-grid"), this.dayGrid.render(), this.dayGrid.bottomCoordPadding = this.dayGrid.el.next("hr").outerHeight()), this.noScrollRowEls = this.el.find(".fc-row:not(.fc-scroller *)"), be.prototype.render.call(this), this.resetScroll()
        },
        destroy: function() {
            this.timeGrid.destroy(), this.dayGrid && this.dayGrid.destroy(), be.prototype.destroy.call(this)
        },
        renderHtml: function() {
            return '<table><thead><tr><td class="' + this.widgetHeaderClass + '">' + this.timeGrid.headHtml() + "</td>" + "</tr>" + "</thead>" + "<tbody>" + "<tr>" + '<td class="' + this.widgetContentClass + '">' + (this.dayGrid ? '<div class="fc-day-grid"/><hr class="' + this.widgetHeaderClass + '"/>' : "") + '<div class="fc-time-grid-container">' + '<div class="fc-time-grid"/>' + "</div>" + "</td>" + "</tr>" + "</tbody>" + "</table>"
        },
        headIntroHtml: function() {
            var t, e, n, i;
            return this.opt("weekNumbers") ? (t = this.cellToDate(0, 0), e = this.calendar.calculateWeekNumber(t), n = this.opt("weekNumberTitle"), i = this.opt("isRTL") ? e + n : n + e, '<th class="fc-axis fc-week-number ' + this.widgetHeaderClass + '" ' + this.axisStyleAttr() + ">" + "<span>" + P(i) + "</span>" + "</th>") : '<th class="fc-axis ' + this.widgetHeaderClass + '" ' + this.axisStyleAttr() + "></th>"
        },
        dayIntroHtml: function() {
            return '<td class="fc-axis ' + this.widgetContentClass + '" ' + this.axisStyleAttr() + ">" + "<span>" + (this.opt("allDayHtml") || P(this.opt("allDayText"))) + "</span>" + "</td>"
        },
        slotBgIntroHtml: function() {
            return '<td class="fc-axis ' + this.widgetContentClass + '" ' + this.axisStyleAttr() + "></td>"
        },
        introHtml: function() {
            return '<td class="fc-axis" ' + this.axisStyleAttr() + "></td>"
        },
        axisStyleAttr: function() {
            return null !== this.axisWidth ? 'style="width:' + this.axisWidth + 'px"' : ""
        },
        updateSize: function(t) {
            t && this.timeGrid.resize(), be.prototype.updateSize.call(this, t)
        },
        updateWidth: function() {
            this.axisWidth = v(this.el.find(".fc-axis"))
        },
        setHeight: function(t, e) {
            var n, i;
            null === this.bottomRuleHeight && (this.bottomRuleHeight = this.bottomRuleEl.outerHeight()), this.bottomRuleEl.hide(), this.scrollerEl.css("overflow", ""), w(this.scrollerEl), h(this.noScrollRowEls), this.dayGrid && (this.dayGrid.destroySegPopover(), n = this.opt("eventLimit"), n && "number" != typeof n && (n = Ue), n && this.dayGrid.limitRows(n)), e || (i = this.computeScrollerHeight(t), y(this.scrollerEl, i) ? (u(this.noScrollRowEls, b(this.scrollerEl)), i = this.computeScrollerHeight(t), this.scrollerEl.height(i), this.restoreScroll()) : (this.scrollerEl.height(i).css("overflow", "hidden"), this.bottomRuleEl.show()))
        },
        resetScroll: function() {
            function t() {
                n.scrollerEl.scrollTop(r)
            }
            var n = this,
                i = e.duration(this.opt("scrollTime")),
                r = this.timeGrid.computeTimeTop(i);
            r = Math.ceil(r), r && r++, t(), setTimeout(t, 0)
        },
        renderEvents: function(t) {
            var e, n, i = [],
                r = [],
                s = [];
            for (n = 0; t.length > n; n++) t[n].allDay ? i.push(t[n]) : r.push(t[n]);
            e = this.timeGrid.renderEvents(r), this.dayGrid && (s = this.dayGrid.renderEvents(i)), this.updateHeight(), be.prototype.renderEvents.call(this, t)
        },
        getSegs: function() {
            return this.timeGrid.getSegs().concat(this.dayGrid ? this.dayGrid.getSegs() : [])
        },
        destroyEvents: function() {
            be.prototype.destroyEvents.call(this), this.recordScroll(), this.timeGrid.destroyEvents(), this.dayGrid && this.dayGrid.destroyEvents()
        },
        renderDrag: function(t, e, n) {
            return t.hasTime() ? this.timeGrid.renderDrag(t, e, n) : this.dayGrid ? this.dayGrid.renderDrag(t, e, n) : void 0
        },
        destroyDrag: function() {
            this.timeGrid.destroyDrag(), this.dayGrid && this.dayGrid.destroyDrag()
        },
        renderSelection: function(t, e) {
            t.hasTime() || e.hasTime() ? this.timeGrid.renderSelection(t, e) : this.dayGrid && this.dayGrid.renderSelection(t, e)
        },
        destroySelection: function() {
            this.timeGrid.destroySelection(), this.dayGrid && this.dayGrid.destroySelection()
        }
    }), Ge.agendaWeek = Re, Re.prototype = k(Me.prototype), t.extend(Re.prototype, {
        name: "agendaWeek",
        incrementDate: function(t, e) {
            return t.clone().stripTime().add(e, "weeks").startOf("week")
        },
        render: function(t) {
            this.intervalStart = t.clone().stripTime().startOf("week"), this.intervalEnd = this.intervalStart.clone().add(1, "weeks"), this.start = this.skipHiddenDays(this.intervalStart), this.end = this.skipHiddenDays(this.intervalEnd, -1, !0), this.title = this.calendar.formatRange(this.start, this.end.clone().subtract(1), this.opt("titleFormat"), " — "), Me.prototype.render.call(this, this.getCellsPerWeek())
        }
    }), Ge.agendaDay = Pe, Pe.prototype = k(Me.prototype), t.extend(Pe.prototype, {
        name: "agendaDay",
        incrementDate: function(t, e) {
            var n = t.clone().stripTime().add(e, "days");
            return n = this.skipHiddenDays(n, 0 > e ? -1 : 1)
        },
        render: function(t) {
            this.start = this.intervalStart = t.clone().stripTime(), this.end = this.intervalEnd = this.start.clone().add(1, "days"), this.title = this.calendar.formatDate(this.start, this.opt("titleFormat")), Me.prototype.render.call(this, 1)
        }
    })
});