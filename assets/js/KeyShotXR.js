var p = !0, t = null, u = !1;
window.keyshotXR = function (keyshot_id, w, G, Y, wa, D, xa, ya, za, Aa, Ba, L, M, Z, $, Ca, aa, Da, ba, Ea, ca, Fa, Ga, Ha, Ia, r, Ja) {
	function P(a, f, b) {
		a.removeEventListener ? a.removeEventListener(f, b, u) : a.detachEvent && (a.detachEvent("on" + f, a[ "e" + f + b ]), a[ "e" + f + b ] = t)
	}

	function k(a, f, b) {
		a.addEventListener ? a.addEventListener(f, b, u) : a.attachEvent && (a[ "e" + f + b ] = b, a.attachEvent("on" + f, function () {
			a[ "e" + f + b ]()
		}))
	}

	function Q() {
		return /\bEdge\b/i.test(navigator.userAgent)
	}

	function da() {
		var a = u;
		-1 != navigator.platform.toString().indexOf("Win") && -1 !=
		navigator.appVersion.indexOf("MSIE") && (a = p);
		return a
	}

	function Ka() {
		var a = document.getElementById(keyshot_id),
			f = a.requestFullScreen || a.webkitRequestFullScreen || a.mozRequestFullScreen || a.msRequestFullScreen;
		"undefined" != typeof f && f && f.call(a)
	}

	function ea(d) {
		this_this.aa = u;
		d.pointerId in this_this.t && delete this_this.t[ d.pointerId ];
		fa(d)
	}

	function ga(d) {
		this_this.aa = u;
		d.pointerId in this_this.t && delete this_this.t[ d.pointerId ];
		ha(d)
	}

	function ia(d) {
		this_this.aa && (this_this.t[ d.pointerId ] = [ d.pageX, d.pageY ], ja(d))
	}

	function ka(d) {
		d.target.Ta && d.target.Ta(d.pointerId);
		this_this.aa = p;
		this_this.t[ d.pointerId ] =
			[ d.pageX, d.pageY ];
		la(d)
	}

	function ma() {
		this_this.i ? (setTimeout(function () {
			this_this.v(u)
		}, 20), setTimeout(function () {
			this_this.v(p)
		}, 120)) : (setTimeout(function () {
			this_this.v(p)
		}, 20), setTimeout(function () {
			this_this.v(u)
		}, 120))
	}

	function H() {
		var a = { x: 0, y: 0 }, f = s;
		if (f.offsetParent) {
			do a.x += f.offsetLeft, a.y += f.offsetTop; while (f = f.offsetParent)
		}
		return a
	}

	function na() {
		var d = c.g;
		c.g = 1;
		d != c.g && this_this.T(this_this.w() * d / c.g);
		// backbuffer.setAttribute("width", B.width);
		this_this.i ? (backbuffer.removeAttribute("height"),/* backbuffer.style.width = "100%",*/ backbuffer.style[ N ] = "scale(" + c.n + ")", backbuffer.style.height = "auto", s.style[ "background-color" ] =
			this_this.backgroundColor, document.body.style[ "background-color" ] = this_this.backgroundColor) : (backbuffer.setAttribute("height", B.height), backbuffer.style[ N ] = "translate(" + -B.width / 2 + "px," + -B.height / 2 + "px) scale(" + c.g + ") translate(" + 0.5 * C.width / c.g + "px," + 0.5 * C.height / c.g + "px) translate(" + c.k + "px," + c.l + "px) scale(" + c.n + ")", backbuffer.style[ "max-width" ] = "", backbuffer.style.width = "", backbuffer.style.height = "", s.style[ "background-color" ] = this_this.backgroundColor)
	}

	function I() {
		this_this.Ua(this_this.keyshot_element.offsetWidth, this_this.keyshot_element.offsetHeight)
	}

	function oa(a, f) {
		q.start.x = a;
		q.start.y = f;
		q.a.x = a;
		q.a.y =
			f;
		i.a.x = a;
		i.a.y = f
	}

	function pa(a, f) {
		q.b.x = a - q.a.x;
		q.b.y = f - q.a.y;
		q.n.x = a;
		q.n.y = f;
		q.a.x = a;
		q.a.y = f
	}

	function F(d) {
		d || (d = window.event);
		var f = 0;
		d.keyCode ? f = d.keyCode : d.which && (f = d.which);
		1 == f ? j.d |= 1 : 1 < f && (j.d |= 2);
		this_this.wa(d);
		d.preventDefault ? d.preventDefault() : d.returnValue = u
	}

	function J(d) {
		d || (d = window.event);
		var f = H();
		this_this.cursor.x = d.pageX - f.x + m.left;
		this_this.cursor.y = d.pageY - f.y + m.top;
		d.preventDefault ? d.preventDefault() : d.returnValue = u;
		0 < j.d && (1 == j.d ? pa(d.pageX, d.pageY) : 2 == j.d ? (d = this_this.cursor.y - E.start.y, f = this_this.w(), this_this.T(c.u *
			Math.exp(d / 200)), d = this_this.w(), c.k += parseFloat(this_this.e * f - this_this.e * d), c.l += parseFloat(this_this.f * f - this_this.f * d)) : 3 == j.d && (f = this_this.cursor.x - E.start.x, d = this_this.cursor.y - E.start.y, c.k += parseFloat((f - c.m.x) / c.g), c.l += parseFloat((d - c.m.y) / c.g), c.m.x = f, c.m.y = d))
	}

	function O(d) {
		d || (d = window.event);
		var f = 0;
		d.keyCode ? f = d.keyCode : d.which && (f = d.which);
		1 == f ? j.d &= -2 : 1 < f && (j.d &= -3);
		this_this.wa(d);
		d.preventDefault ? d.preventDefault() : d.returnValue = u
	}

	function R(d) {
		this_this.ab && (d = d ? d : window.event, this_this.Ha(0 < (d.detail ? -1 * d.detail : d.wheelDelta / 40) ? 1 : -1), qa(d))
	}

	function la(d) {
		d ||
		(d = window.event);
		var f = ra(d), b = H();
		this_this.cursor.x = f[ 0 ].pageX - b.x + m.left;
		this_this.cursor.y = f[ 0 ].pageY - b.y + m.top;
		if (1 == f.length && f[ 0 ]) if (j.start.x = f[ 0 ].pageX, j.start.y = f[ 0 ].pageY, j.a.x = f[ 0 ].pageX, j.a.y = f[ 0 ].pageY, this_this.qa = f[ 0 ].target, this_this.qa == this_this.r) j.d = 1, oa(f[ 0 ].pageX, f[ 0 ].pageY); else for (var e = this_this.qa; e && e != this_this.r;) {
			if (e.onclick) e.onclick();
			e = e.parentNode
		}
		if (2 == f.length && f[ 0 ] && f[ 1 ]) {
			j.d = 3;
			j.ca.x = f[ 0 ].pageX - b.x + m.left;
			j.ca.y = f[ 0 ].pageY - b.y + m.top;
			j.da.x = f[ 1 ].pageX - b.x + m.left;
			j.da.y = f[ 1 ].pageY - b.y + m.top;
			var e = f[ 0 ].pageX - f[ 1 ].pageX,
				g = f[ 0 ].pageY - f[ 1 ].pageY, i = (f[ 0 ].pageX - b.x + m.left + (f[ 1 ].pageX - b.x + m.left)) / 2,
				f = (f[ 0 ].pageY - b.y + m.top + (f[ 1 ].pageY - b.y + m.top)) / 2;
			c.pa = u;
			c.Va = Math.sqrt(e * e + g * g);
			c.u = this_this.w();
			this_this.e = parseFloat(i - 0.5 * C.width);
			this_this.f = parseFloat(f - 0.5 * C.height);
			this_this.e *= parseFloat(this_this.R);
			this_this.f *= parseFloat(this_this.R);
			this_this.e -= parseFloat(c.k);
			this_this.f -= parseFloat(c.l);
			this_this.e /= parseFloat(c.u);
			this_this.f /= parseFloat(c.u)
		}
		d.preventDefault()
	}

	function ja(d) {
		d || (d = window.event);
		var b = ra(d), e = H();
		this_this.cursor.x = b[ 0 ].pageX - e.x + m.left;
		this_this.cursor.y = b[ 0 ].pageY - e.y + m.top;
		1 == b.length &&
		b[ 0 ] && (j.a.x = b[ 0 ].pageX, j.a.y = b[ 0 ].pageY, 0 <= j.d && pa(j.a.x, j.a.y));
		if (2 == b.length && b[ 0 ] && b[ 1 ]) {
			var h = this_this.w(), g = b[ 0 ].pageX - b[ 1 ].pageX, i = b[ 0 ].pageY - b[ 1 ].pageY;
			this_this.T(c.u / c.Va * Math.sqrt(g * g + i * i));
			g = this_this.w();
			i = this_this.f * h - this_this.f * g;
			c.k += this_this.e * h - this_this.e * g;
			c.l += i;
			h = (this_this.cursor.x + b[ 1 ].pageX - e.x + m.left) / 2 - (j.ca.x + j.da.x) / 2;
			b = (this_this.cursor.y + b[ 1 ].pageY - e.y + m.top) / 2 - (j.ca.y + j.da.y) / 2;
			c.pa == u && (c.m.x = h, c.m.y = b, c.pa = p);
			c.k += (h - c.m.x) / c.g;
			c.l += (b - c.m.y) / c.g;
			c.m.x = h;
			c.m.y = b
		}
		d.preventDefault()
	}

	function ra(d) {
		if (!da() && !Q()) return d.touches;
		d =
			[];
		for (id in this_this.t) {
			var b = this_this.t[ id ], e = {};
			e.pageX = b[ 0 ];
			e.pageY = b[ 1 ];
			e.target = this_this.r;
			e.preventDefault = function () {
			};
			d.push(e)
		}
		return d
	}

	function ha(d) {
		d.preventDefault();
		this_this.qa = t;
		j.d = 0;
		var b = (new Date).getTime(), e = b - (S || b + 1);
		clearTimeout(T);
		500 > e && 0 < e || (S = b, T = setTimeout(function () {
			clearTimeout(T)
		}, 500, [ d ]));
		S = b
	}

	function fa(a) {
		a.preventDefault();
		j.d = 0
	}

	function U() {
		La(U);
		this_this.W == this_this.Z && (1 == j.d ? 0.01 < i.L ? (i.b.x = 0.4 * (q.a.x - i.a.x), i.b.y = 0.4 * (q.a.y - i.a.y), i.a.x += i.b.x, i.a.y += i.b.y, this_this.na(i.b.x, i.b.y)) : (this_this.na(q.b.x, q.b.y), q.b.x =
			0, q.b.y = 0) : 0.01 < i.L && (i.b.x *= i.L, i.b.y *= i.L, 0.055 > i.b.x * i.b.x + i.b.y * i.b.y && (i.b.x = 0, i.b.y = 0, q.b.x = 0, q.b.y = 0, q.a.x = i.a.x, q.a.y = i.a.y), (0 != i.b.x || 0 != i.b.y) && this_this.na(i.b.x, i.b.y)));
		this_this.Ca();
		var d = 0;
		if (-1 == this_this.ha) {
			for (var b = 1, b = 0; b < this_this.G.length; b++) {
				var c = this_this.C[ b ];
				if (0 == this_this.z[ c ] && this_this.G[ b ].complete) {
					this_this.F[ c ] = this_this.z[ c ];
					this_this.z[ c ] = -1;
					if (this_this.W == this_this.Z) {
						var h = this_this.G.length + this_this.Aa;
						h > e.q && (h = e.q);
						if (h -= d) for (var g = 0; g < h; g++) this_this.ga()
					}
					e.J = p;
					0 == b && this_this.Ca()
				}
				-1 != this_this.F[ c ] && d++
			}
			b = parseFloat(d / e.q);
			this_this.Sa(b);
			d == e.q && (this_this.ha = 0, this_this.Ra())
		}
	}

	function sa(a) {
		keycode =
			(a ? a : window.event).keyCode;
		switch (keycode) {
			case 13:
				ma(), qa(a)
		}
	}

	function qa(a) {
		a = a ? a : window.event;
		a.preventDefault() ? a.preventDefault() : a.returnValue = u
	}

	var A = "/", K = window.location.href, ta = K.lastIndexOf("/");
	0 <= ta && (A = K.substr(0, ta + 1));
	var V = K = u;
	Ja && (document.body.style.width = window.innerWidth + "px", document.body.style.height = window.innerHeight + "px");
	this.ab = Z != $;
	this.aa = u;
	this.t = [];
	this.ja = u;
	this.Ca = function () {
		if (e.J) {
			if (this_this.ja) return;
			e.J = u;
			var d = parseInt(e.K * e.c + e.I);
			// build backbuffer
			let dElement = this_this.D[ d ];
			// console.log("dElement: ", dElement);
			if (-1 != this_this.F[ d ] && (W_backbuffer.setAttribute("src",
				dElement), W_backbuffer.complete || (this_this.ja = p), void 0 !== r)) if (d = this_this.ia[ d ], !d && void 0 == r[ d ]) {
				if (document.getElementById("xr_hotspot")) {
					var b = document.getElementById("xr_hotspot");
					document.body.removeChild(b)
				}
			} else document.getElementById("xr_hotspot") && (b = document.getElementById("xr_hotspot"), document.body.removeChild(b)), b = document.createElement("div"), b.innerHTML = r[ d ].text, b.id = "xr_hotspot", b.style.position = "absolute", b.style.left = r[ d ].position.x + "px", b.style.top = r[ d ].position.y + "px", b.style.color = "#000000", void 0 !==
			r[ d ].options && (r[ d ].options.fontSize && (b.style.fontSize = r[ d ].options.fontSize), r[ d ].options.Ia && (b.style.color = r[ d ].options.Ia), r[ d ].options.bgColor && (b.style.backgroundColor = r[ d ].options.bgColor), r[ d ].options.link && (b.href = r[ d ].options.link), r[ d ].options.height && (b.style.height = r[ d ].options.height), r[ d ].options.width && (b.style.width = r[ d ].options.width), r[ d ].options.textAlign && (b.style.textAlign = r[ d ].options.textAlign)), document.body.appendChild(b)
		}
		if (c.n != c.a || c.k != c.xa || c.l != c.ya) c.a = c.n, c.xa = c.k,
			c.ya = c.l, na()
	};
	this.eb = function (b) {
		for (var f = -1E3, c = b, h = parseFloat(parseInt(b % e.c)), g = parseFloat(parseInt(b / e.c)), h = h / e.c, h = h * 2 * Math.PI, g = g / e.j, g = g * Math.PI, b = Math.sin(h), h = Math.cos(h), g = Math.cos(g), i = Math.sqrt(b * b + h * h + g * g), b = b / i, h = h / i, g = g / i, i = 0; i < this_this.G.length; i++) {
			var j = this_this.C[ i ];
			if (-1 != this_this.F[ j ]) {
				var k = this_this.Ea[ j ].Za, k = b * k.x + h * k.y + g * k.$a;
				f < k && (f = k, c = j)
			}
		}
		return c
	};
	this.ga = function () {
		if (this_this.oa < e.q) {
			var b = new Image, f = this_this.C[ this_this.oa ];
			this_this.z[ f ] = 0;
			b.src = this_this.D[ f ];
			this_this.G.push(b);
			var c = parseInt(f % e.c), h = parseInt(f / e.c), c = c / e.c, c = c *
					2 * Math.PI, h = h / e.j, h = h * Math.PI, b = Math.sin(c), c = Math.cos(c), h = Math.cos(h),
				g = Math.sqrt(b * b + c * c + h * h);
			this_this.Ea[ f ] = { Za: { x: b / g, y: c / g, $a: h / g } };
			this_this.oa++
		}
	};
	this.Ga = function () {
		for (var b = e.ra, f = e.sa, c = 2, h = parseFloat(e.c / c), g = parseFloat(e.j / c), i = e.q, j = 0, k = 0, m = 0, n = 0, l = 0; this_this.P < i;) {
			var q = parseInt(b % e.c), s = parseInt(f % e.j), l = parseInt(s * e.c + q);
			this_this.D[ l ] || (this_this.C[ this_this.P ] = l, this_this.P++, this_this.D[ l ] = this_this.va(q, s), void 0 !== r && r[ s + "_" + q ] && (this_this.ia[ l ] = s + "_" + q));
			0 == j && (b += h, k++);
			1 == j && (f += g, m++);
			n++;
			if (n >= c) if (n = 0, 0 == j) j = 1, k = 0; else if (1 == j && (b += h, k++, k >= c / 2)) {
				c *=
					2;
				b = e.ra;
				f = e.sa;
				h = parseFloat(e.c / c);
				g = parseFloat(e.j / c);
				if (1 > h && 1 > g) {
					for (b = 0; b < i; b++) f = parseInt(b % e.c), c = parseInt(b / e.c), l = parseInt(c * e.c + f), this_this.D[ l ] || (this_this.C[ this_this.P ] = l, this_this.P++, this_this.D[ l ] = this_this.va(f, c), void 0 !== r && r[ c + "_" + f ] && (this_this.ia[ l ] = c + "_" + f));
					break
				}
				j = m = k = 0
			}
		}
	};
	this.va = function (b, f) {
		return A + this_this.s + "/" + parseInt(f) + "_" + parseInt(b) + "." + Ea
	};
	this.na = function (b, f) {
		var b = b * (1 < e.c ? this_this.Xa : 0), f = f * (1 < e.j ? this_this.Ya : 0), c = Math.sqrt(b * b + f * f);
		if (1E-4 < c && (e.ea += b, e.fa += f, e.A += c, 1 < e.A)) {
			var c = parseInt(e.A), h = Math.atan2(e.ea, e.fa);
			e.A -= c;
			e.ea =
				0;
			e.fa = 0;
			0 > h && (h += 2 * Math.PI);
			h += Math.PI / 8;
			h = parseInt(h / (Math.PI / 4));
			0 > h && (h += 8);
			h %= 8;
			if (0 != x[ h ]) {
				if (Ha) var g = e.I, g = g - c * x[ h ]; else g = e.I, g += c * x[ h ];
				if (e.Da) {
					for (; 0 > g;) g += e.c;
					for (; g >= e.c;) g -= e.c
				} else g >= e.c && (g = e.c - 1), 0 > g && (g = 0);
				e.I != g && (e.I = g, e.J = p)
			}
			if (0 != y[ h ]) {
				Ia ? (g = e.K, g -= c * y[ h ]) : (g = e.K, g += c * y[ h ]);
				if (e.Fa) {
					for (; 0 > g;) g += e.j;
					for (; g >= e.j;) g -= e.j
				} else g >= e.j && (g = e.j - 1), 0 > g && (g = 0);
				e.K != g && (e.K = g, e.J = p)
			}
		}
	};
	this.Wa = function () {
		this_this.v(!this_this.i);
		this_this.i ? this_this.H.setAttribute("src", A + this_this.s + "/files/GoFullScreenIcon.png") : this_this.H.setAttribute("src",
			A + this_this.s + "/files/GoFixedSizeIcon.png")
	};
	this.v = function (b) {
		this_this.i = b;
		this_this.i ? (v.style.position = "relative", v.style.left = "0px", v.style.top = "0px", document.body.style.overflow = "") : (v.style.position = "absolute", b = H(), v.style.left = window.pageXOffset - b.x + m.left + "px", v.style.top = window.pageYOffset - b.y + m.top + "px", document.body.style.overflow = "hidden");
		document.body.style.margin = "0";
		document.body.style.padding = "0";
		I()
	};
	this.Ka = function () {
		var b = new Image;
		b.src = this_this.O.src;
		this_this.G[ this_this.Y ] = b;
		b = this_this.C[ this_this.Y ];
		this_this.F[ b ] = this_this.z[ b ];
		this_this.z[ b ] = -1;
		this_this.Y++;
		e.J = p;
		this_this.Y == e.q && (this_this.ha = 0, this_this.La())
	};
	var T, S = t;
	this.wa = function (b) {
		var f = H();
		this_this.cursor.x = b.pageX - f.x + m.left;
		this_this.cursor.y = b.pageY - f.y + m.top;
		1 == j.d ? oa(b.pageX, b.pageY) : 2 == j.d ? (E.start.x = this_this.cursor.x, E.start.y = this_this.cursor.y, c.u = this_this.w(), this_this.e = this_this.cursor.x - 0.5 * C.width, this_this.f = this_this.cursor.y - 0.5 * C.height, this_this.e *= this_this.R, this_this.f *= this_this.R, this_this.e -= c.k, this_this.f -= c.l, this_this.e /= c.u, this_this.f /= c.u) : 3 == j.d && (E.start.x = this_this.cursor.x, E.start.y = this_this.cursor.y, c.m.x = 0, c.m.y = 0)
	};
	this.Ha = function (b) {
		this_this.T(c.n * Math.exp(-b / 50))
	};
	this.w = function () {
		return c.n
	};
	this.T = function (a) {
		a > c.la / c.g &&
		(a = c.la / c.g);
		a < c.ma / c.g && (a = c.ma / c.g);
		c.n = a
	};
	this.cb = function (a, b, c, e) {
		m.left = a;
		m.top = b;
		m.right = c;
		m.bottom = e;
		I()
	};
	this.Ua = function (b, c) {
		this_this.i || (b = window.innerWidth, c = window.innerHeight);
		var e = b - m.left - m.right, h = c - m.top - m.bottom;
		C.width = e;
		C.height = h;
		s.style.width = e + "px";
		this_this.i && window.innerHeight < B.height && (h = window.innerHeight);
		s.style.height = h + "px";
		s.style.left = m.left + "px";
		s.style.top = m.top + "px";
		na();
		this_this.i && window.innerHeight < B.height && (c = window.innerHeight);
		this_this.keyshot_element.style.height = c + "px";
		this_this.i && (b = backbuffer.clientWidth,
			c = Math.min(backbuffer.clientHeight, window.innerHeight));
		n.style.width = b + "px";
		n.style.height = c + "px";
		n.Ba && n.Ba(b, c);
		ba && (this_this.N.style.height = window.innerHeight + "px", this_this.N.style.width = window.innerWidth + "px")
	};
	this.U = function (a) {
		k(a, "mousedown", F);
		k(a, "mousemove", J);
		k(a, "mouseup", O)
	};
	this.ba = function (a) {
		P(a, "mousedown", F);
		P(a, "mousemove", J);
		P(a, "mouseup", O)
	};
	this.Ra = function () {
		this_this.p && (this_this.p.style.visibility = "hidden", this_this.ba(this_this.p), this_this.ba(this_this.Q), this_this.ba(this_this.o))
	};
	this.La = function () {
		this_this.B.style.visibility = "hidden";
		this_this.ba(this_this.B)
	};
	var La = window.requestAnimationFrame ||
		window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (a) {
			window.setTimeout(a, 10)
		};
	this.ua = function () {
		this_this.p = document.createElement("div");
		this_this.U(this_this.p);
		this_this.p.V = function () {
			this.parentNode && (this.style.left = "16px", this.style.top = "16px")
		};
		style_string = "position:absolute;";
		style_string += "left: 0px;";
		style_string += "top:  0px;";
		style_string += "width: 80px;";
		style_string += "height: 80px;";
		style_string += z + "transform-origin: 50% 50%;";
		style_string += "visibility: inherit;";
		this_this.p.setAttribute("style", style_string);
		this_this.Q = document.createElement("div");
		this_this.U(this_this.Q);
		style_string = "position:absolute;";
		style_string += "left: 0px;";
		style_string += "top:  29px;";
		style_string += "width: 80px;";
		style_string += "height: 80px;";
		style_string += z + "transform-origin: 50% 50%;";
		style_string += "opacity: 1.0;";
		style_string += "visibility: inherit;";
		style_string += "border: 0px solid #000000;";
		style_string += "color: #ffffff;";
		style_string += "text-align: left;";
		style_string += "white-space: nowrap;";
		style_string += "padding: 0px 0px 0px 0px;";
		style_string += "overflow: hidden;";
		this_this.Q.setAttribute("style", style_string);
		this_this.o = document.createElement("div");
		this_this.U(this_this.o);
		this_this.o.$ = { Na: 0, Oa: 0, ka: 0, Pa: 1, Qa: 1, gb: 1 };
		style_string = "position:absolute;";
		style_string += "left: 0px;";
		style_string += "top:  0px;";
		style_string += "width: 80px;";
		style_string += "height: 80px;";
		style_string += z + "transform-origin: 50% 50%;";
		style_string += "opacity: 1.0;";
		style_string += "visibility: inherit;";
		style_string += "border: 0px solid #000000;";
		style_string += "color: #ffffff;";
		style_string += "text-align: left;";
		style_string += "white-space: nowrap;";
		style_string += "padding: 0px 0px 0px 0px;";
		style_string += "overflow: hidden;";
		var d = Fa;
		"" == d && (d = "ks_logo.png");
		this_this.o.setAttribute("style", style_string);
		this_this.o.innerHTML = '<img src="' + A + this_this.s + "/files/" + d + '"></img>';
		this_this.p.appendChild(this_this.o);
		this_this.p.appendChild(this_this.Q);
		n.appendChild(this_this.p);
		this_this.v(this_this.i);
		setTimeout(function () {
			this_this.v(this_this.i)
		}, 10)
	};
	this.Sa =
		function (b) {
			if (this_this.p) {
				this_this.Q.innerHTML = "<center>" + parseInt(100 * b) + "</center>";
				this_this.o.$.ka += 2.1;
				b = "";
				if (this_this.o.$) var c = this_this.o.$,
					b = b + ("translate(" + c.Na + "px," + c.Oa + "px) rotate(" + c.ka + "deg) scale(" + c.Pa + "," + c.Qa + ") ");
				this_this.o.style[ N ] = b + "scale(1.0,1.0)"
			}
		};
	this.ta = function () {
		V = p;
		U()
	};
	this.za = function () {
		k(window, "resize", I);
		Ga && k(n, "dblclick", Ka);
		if (da()) if (k(window, "mousewheel", R), k(window, "keydown", sa), /Tablet PC/i.test(navigator.userAgent) && window.bb) {
			var b = new MSGesture;
			b.target = this_this.keyshot_element;
			this_this.keyshot_element.Ja = b;
			this_this.keyshot_element.Ja.pointerType = t;
			this_this.keyshot_element.hb =
				[];
			k(this_this.keyshot_element, "MSPointerDown", ka);
			k(this_this.keyshot_element, "MSPointerMove", ia);
			k(this_this.keyshot_element, "MSPointerUp", ga);
			k(this_this.keyshot_element, "MSPointerCancel", ea)
		} else k(n, "mousedown", F), k(backbuffer, "mousedown", F), k(n, "mousemove", J), k(backbuffer, "mousemove", J), k(document, "mouseup", O); else n.addEventListener && (k(document, "mouseup", O), k(n, "mousewheel", R), k(document, "keydown", sa), k(n, "mousedown", F), k(backbuffer, "mousedown", F), k(n, "mousemove", J), k(n, "touchstart", la), k(n, "touchmove", ja), k(n, "touchcancel", fa), k(n, "touchend", ha), k(n, "DOMMouseScroll", R), k(window, "orientationchange", ma),
		Q() && (b = function (a, b) {
			"touch" == b.pointerType && a(b)
		}, k(n, "pointerdown", b.bind(t, ka)), k(n, "pointermove", b.bind(t, ia)), k(n, "pointerup", b.bind(t, ga)), k(n, "pointercancel", b.bind(t, ea))))
	};
	if (document.createElement("canvas").getContext) {
		var this_this = this, v = this_this.h = t, s = t, W_backbuffer = t, n = t, backbuffer = t;
		this_this.i = aa;
		this_this.s = w;
		this_this.fb = u;
		this_this.Z = u;
		this_this.W = ba;
		this_this.ib = 0;
		this_this.P = 0;
		this_this.Xa = parseFloat(Aa);
		this_this.Ya = parseFloat(Ba);
		this_this.Aa = 1;
		this_this.Y = 0;
		this_this.ha = -1;
		var m = { left: 0, top: 0, right: 0, bottom: 0 },
			e = { I: 0, K: 0, c: 1, j: 1, ra: 0, sa: 0, A: 0, ea: 0, fa: 0, J: u, q: 0, Da: p, Fa: u };
		L || (L = 0);
		M || (M = 0);
		e.ra = L;
		e.sa =
			M;
		e.I = L;
		e.K = M;
		e.c = D;
		e.j = xa;
		e.Da = ya;
		e.Fa = za;
		e.q = e.c * e.j;
		var B = { width: 0, height: 0 };
		B.width = G;
		B.height = Y;
		var z = "", N = "transform", C = { x: 640, y: 480 },
			c = { n: 1, u: 1, a: -1, k: 0, l: 0, xa: -1, ya: -1, g: 1, ma: 1, la: 1, m: { x: 0, y: 0 }, pa: u };
		c.ma = parseFloat(Z);
		c.la = parseFloat($);
		var q = { start: { x: 0, y: 0 }, a: { x: 0, y: 0 }, Ma: { x: 0, y: 0 }, n: { x: 0, y: 0 }, b: { x: 0, y: 0 } },
			E = { start: { x: 0, y: 0 } }, j = {
				d: 0,
				start: { x: 0, y: 0 },
				a: { x: 0, y: 0 },
				Ma: { x: 0, y: 0 },
				n: { x: 0, y: 0 },
				b: { x: 0, y: 0 },
				ca: { x: 0, y: 0 },
				da: { x: 0, y: 0 }
			}, i = { a: { x: 0, y: 0 }, b: { x: 0, y: 0 }, L: 0.96 };
		i.L = Ca;
		this_this.cursor = { x: 0, y: 0 };
		var x =
			[], y = [];
		x[ 0 ] = 0;
		y[ 0 ] = 1;
		x[ 1 ] = 1;
		y[ 1 ] = 1;
		x[ 2 ] = 1;
		y[ 2 ] = 0;
		x[ 3 ] = 1;
		y[ 3 ] = -1;
		x[ 4 ] = 0;
		y[ 4 ] = -1;
		x[ 5 ] = -1;
		y[ 5 ] = -1;
		x[ 6 ] = -1;
		y[ 6 ] = 0;
		x[ 7 ] = -1;
		y[ 7 ] = 1;
		this_this.e = 0;
		this_this.f = 0;
		this_this.oa = 0;
		this_this.G = [];
		this_this.C = [];
		this_this.z = [];
		this_this.F = [];
		this_this.Ea = [];
		for (w = 0; w < e.q; w++) this_this.z[ w ] = -1, this_this.F[ w ] = -1;
		this_this.D = [];
		this_this.ia = [];
		w = [ "Webkit", "Moz", "0", "ms", "Ms" ];
		for (D = 0; D < w.length; D++) "undefined" != typeof document.documentElement.style[ w[ D ] + "Transform" ] && (z = "-" + w[ D ].toLowerCase() + "-", N = w[ D ] + "Transform");
		var style_string = "";
		this_this.keyshot_element = document.getElementById(keyshot_id);
		style_string = "width: " + G + "px;";
		style_string += "height: " + Y + "px;";
		style_string += "max-width: 100%;";
		this_this.keyshot_element.setAttribute("style", style_string);
		v = document.createElement("div");
		v.setAttribute("id", "viewwindow");
		style_string = "top:  0px;";
		style_string += "left: 0px;";
		style_string += "position: relative;";
		v.setAttribute("style", style_string);
		this_this.keyshot_element.appendChild(v);
		s = document.createElement("div");
		s.setAttribute("id", "turntable");
		style_string = "top:  0px;";
		style_string += "left: 0px;";
		style_string += "overflow: hidden;";
		style_string += "position:absolute;";
		style_string += z + "user-select: none;";
		s.setAttribute("style", style_string);
		v.appendChild(s);
		backbuffer = document.createElement("img");
		backbuffer.setAttribute("id", "backbuffer");
		style_string = "top:  0px;";
		style_string += "left: 0px;";
		style_string += "position:absolute;";
		style_string += z + "user-select: none;";
		backbuffer.setAttribute("style", style_string);
		s.appendChild(backbuffer);
		W_backbuffer = backbuffer;
		G = function () {
			this_this.ja = u
		};
		backbuffer.addEventListener("load", G, u);
		backbuffer.addEventListener("error", G, u);
		if (this_this.i) {
			var ua = function () {
				I();
				backbuffer.removeEventListener("load", ua, u)
			};
			backbuffer.addEventListener("load", ua, u)
		}
		n = document.createElement("div");
		this_this.r = n;
		style_string = "top:  0px;";
		style_string += "left: 0px;";
		style_string += "width:  100px;";
		style_string += "height: 100px;";
		style_string += "overflow: hidden;";
		style_string += "position:absolute;";
		style_string += "z-index: 522;";
		style_string += z + "user-select: none;";
		Q() && (style_string += "touch-action: none;");
		n.setAttribute("style", style_string);
		v.appendChild(n);
		n.Ba = function (a, b) {
			var c = [];
			for (c.push(this); 0 < c.length;) {
				var e = c.pop();
				e.V && e.V(a, b);
				if (e.hasChildNodes()) for (var g = 0; g < e.childNodes.length; g++) c.push(e.childNodes[ g ])
			}
		};
		this.B = document.createElement("div");
		style_string = "position:absolute;";
		style_string += "left: 0px;";
		style_string += "top:  0px;";
		style_string += "width: 256px;";
		style_string += "height: 256px;";
		style_string += "opacity: 0.0;";
		style_string += z + "transform-origin: 50% 50%;";
		style_string += "visibility: inherit;";
		style_string += "display: none";
		this.B.setAttribute("style", style_string);
		this.O = document.createElement("img");
		this.O.setAttribute("width", 256);
		this.O.setAttribute("height", 256);
		this.O.onload = function () {
			this_this.Ka()
		};
		this_this.U(this.B);
		this.B.appendChild(this.O);
		n.appendChild(this.B);
		this.backgroundColor = s.style.backgroundColor = wa;
		Da && (this_this.S = document.createElement("div"), style_string = "position:absolute;", style_string += "width: 38px;", style_string += "height: 32px;", style_string += z + "transform-origin: 50% 50%;", style_string += "visibility: inherit;", style_string += "cursor: pointer;", this_this.S.setAttribute("style", style_string), this_this.H = document.createElement("img"), this_this.i ? this_this.H.setAttribute("src", A + this_this.s + "/files/GoFullScreenIcon.png") :
			this_this.H.setAttribute("src", A + this_this.s + "/files/GoFixedSizeIcon.png"), this_this.H.setAttribute("style", "position: absolute;top: 0px;left: 0px;width: 38px;height: 32px;"), this_this.S.appendChild(this_this.H), this_this.S.V = function (a, b) {
			this.style.left = a - 38 + "px";
			this.style.top = b - 32 + "px"
		}, this_this.S.onclick = function () {
			this_this.Wa()
		}, this_this.r.appendChild(this_this.S));
		if (this_this.W) {
			/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && (K = p);
			this_this.M = document.createElement("div");
			style_string = "position:absolute;";
			style_string += "width: 92px;";
			style_string += "height: 92px;";
			style_string += z +
				"transform-origin: 50% 50%;";
			style_string += "visibility: inherit;";
			style_string += "cursor: pointer;";
			this_this.M.setAttribute("style", style_string);
			this_this.X = document.createElement("img");
			K ? this_this.X.setAttribute("src", A + this_this.s + "/files/xr_hand.gif") : this_this.X.setAttribute("src", A + this_this.s + "/files/xr_cursor.gif");
			this_this.X.setAttribute("style", "position: absolute;top: 0px;left: 0px;width: 92px;height: 92px;");
			this_this.M.appendChild(this_this.X);
			this_this.M.V = function (a, b) {
				this.style.left = 0.5 * a - 46 + "px";
				this.style.top = 0.5 * b - 46 + "px"
			};
			this_this.N = document.createElement("div");
			style_string = "position:absolute;";
			style_string += z + "transform-origin: 50% 50%;";
			style_string += " width: " + window.innerWidth + "px;";
			style_string += " height: " + window.innerHeight + "px;";
			style_string += " background-color: #ccc;";
			style_string += " opacity: .7";
			this_this.N.setAttribute("style", style_string);
			this_this.r.appendChild(this_this.N);
			var va = function () {
				this_this.M.style.visibility = "hidden";
				this_this.N.style.visibility = "hidden";
				ca && this_this.ua();
				this_this.Z = p;
				for (var b = 0; b < this_this.Aa; b++) this_this.ga();
				this_this.ta()
			};
			this_this.r.onmousedown = function (a) {
				V || va();
				a.preventDefault()
			};
			this_this.r.ontouchstart = function (a) {
				V || va();
				a.preventDefault()
			};
			this_this.r.appendChild(this_this.M);
			this_this.za()
		} else this_this.W = p, this_this.Z = p, ca && this_this.ua(), this_this.za(), this_this.ta();
		this_this.v(aa);
		this_this.R =
			1 / c.g;
		this_this.T(this_this.R);
		this.Ga();
		this_this.ga();
		setTimeout(function () {
			U()
		}, 10);
		setTimeout(function () {
			I()
		}, 15)
	} else alert("Your browser must support HTML5 to show KeyShotXR")
};
