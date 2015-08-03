(function(window, document, undefined) {
  
  var prefixes = ['webkit', 'Moz', 'ms', 'O']; /* Vendor prefixes */
  var animations = {}; /* Animation rules keyed by their name */
  var useCssAnimations;

  /**
   * Utility function to create elements. If no tag name is given,
   * a DIV is created. Optionally properties can be passed.
   */
  function createEl(tag, prop) {
    var el = document.createElement(tag || 'div');
    var n;

    for(n in prop) {
      el[n] = prop[n];
    }
    return el;
  }

  /**
   * Appends children and returns the parent.
   */
  function ins(parent /* child1, child2, ...*/) {
    for (var i=1, n=arguments.length; i<n; i++) {
      parent.appendChild(arguments[i]);
    }
    return parent;
  }

  /**
   * Insert a new stylesheet to hold the @keyframe or VML rules.
   */
  var sheet = function() {
    var el = createEl('style');
    ins(document.getElementsByTagName('head')[0], el);
    return el.sheet || el.styleSheet;
  }();

  /**
   * Creates an opacity keyframe animation rule and returns its name.
   * Since most mobile Webkits have timing issues with animation-delay,
   * we create separate rules for each line/segment.
   */
  function addAnimation(alpha, trail, i, lines) {
    var name = ['opacity', trail, ~~(alpha*100), i, lines].join('-');
    var start = 0.01 + i/lines*100;
    var z = Math.max(1-(1-alpha)/trail*(100-start) , alpha);
    var prefix = useCssAnimations.substring(0, useCssAnimations.indexOf('Animation')).toLowerCase();
    var pre = prefix && '-'+prefix+'-' || '';

    if (!animations[name]) {
      sheet.insertRule(
        '@' + pre + 'keyframes ' + name + '{' +
        '0%{opacity:'+z+'}' +
        start + '%{opacity:'+ alpha + '}' +
        (start+0.01) + '%{opacity:1}' +
        (start+trail)%100 + '%{opacity:'+ alpha + '}' +
        '100%{opacity:'+ z + '}' +
        '}', 0);
      animations[name] = 1;
    }
    return name;
  }

  /**
   * Tries various vendor prefixes and returns the first supported property.
   **/
  function vendor(el, prop) {
    var s = el.style;
    var pp;
    var i;

    if(s[prop] !== undefined) return prop;
    prop = prop.charAt(0).toUpperCase() + prop.slice(1);
    for(i=0; i<prefixes.length; i++) {
      pp = prefixes[i]+prop;
      if(s[pp] !== undefined) return pp;
    }
  }

  /**
   * Sets multiple style properties at once.
   */
  function css(el, prop) {
    for (var n in prop) {
      el.style[vendor(el, n)||n] = prop[n];
    }
    return el;
  }

  /**
   * Fills in default values.
   */
  function merge(obj) {
    for (var i=1; i < arguments.length; i++) {
      var def = arguments[i];
      for (var n in def) {
        if (obj[n] === undefined) obj[n] = def[n];
      }
    }
    return obj;
  }

  /**
   * Returns the absolute page-offset of the given element.
   */
  function pos(el) {
    var o = {x:el.offsetLeft, y:el.offsetTop};
    while((el = el.offsetParent)) {
      o.x+=el.offsetLeft;
      o.y+=el.offsetTop;
    }
    return o;
  }

  var defaults = {
    lines: 12,            // The number of lines to draw
    length: 7,            // The length of each line
    width: 5,             // The line thickness
    radius: 10,           // The radius of the inner circle
    rotate: 0,            // rotation offset
    color: '#000',        // #rgb or #rrggbb
    speed: 1,             // Rounds per second
    trail: 100,           // Afterglow percentage
    opacity: 1/4,         // Opacity of the lines
    fps: 20,              // Frames per second when using setTimeout()
    zIndex: 2e9,          // Use a high z-index by default
    className: 'spinner', // CSS class to assign to the element
    top: 'auto',          // center vertically
    left: 'auto'          // center horizontally
  };

  /** The constructor */
  var Spinner = function Spinner(o) {
    if (!this.spin) return new Spinner(o);
    this.opts = merge(o || {}, Spinner.defaults, defaults);
  };

  Spinner.defaults = {};
  merge(Spinner.prototype, {
    spin: function(target) {
      this.stop();
      var self = this;
      var o = self.opts;
      var el = self.el = css(createEl(0, {className: o.className}), {position: 'relative', zIndex: o.zIndex});
      var mid = o.radius+o.length+o.width;
      var ep; // element position
      var tp; // target position

      if (target) {
        target.insertBefore(el, target.firstChild||null);
        tp = pos(target);
        ep = pos(el);
        css(el, {
          left: (o.left == 'auto' ? tp.x-ep.x + (target.offsetWidth >> 1) : o.left+mid) + 'px',
          top: (o.top == 'auto' ? tp.y-ep.y + (target.offsetHeight >> 1) : o.top+mid)  + 'px'
        });
      }

      el.setAttribute('aria-role', 'progressbar');
      self.lines(el, self.opts);

      if (!useCssAnimations) {
        // No CSS animation support, use setTimeout() instead
        var i = 0;
        var fps = o.fps;
        var f = fps/o.speed;
        var ostep = (1-o.opacity)/(f*o.trail / 100);
        var astep = f/o.lines;

        !function anim() {
          i++;
          for (var s=o.lines; s; s--) {
            var alpha = Math.max(1-(i+s*astep)%f * ostep, o.opacity);
            self.opacity(el, o.lines-s, alpha, o);
          }
          self.timeout = self.el && setTimeout(anim, ~~(1000/fps));
        }();
      }
      return self;
    },
    stop: function() {
      var el = this.el;
      if (el) {
        clearTimeout(this.timeout);
        if (el.parentNode) el.parentNode.removeChild(el);
        this.el = undefined;
      }
      return this;
    },
    lines: function(el, o) {
      var i = 0;
      var seg;

      function fill(color, shadow) {
        return css(createEl(), {
          position: 'absolute',
          width: (o.length+o.width) + 'px',
          height: o.width + 'px',
          background: color,
          boxShadow: shadow,
          transformOrigin: 'left',
          transform: 'rotate(' + ~~(360/o.lines*i+o.rotate) + 'deg) translate(' + o.radius+'px' +',0)',
          borderRadius: (o.width>>1) + 'px'
        });
      }
      for (; i < o.lines; i++) {
        seg = css(createEl(), {
          position: 'absolute',
          top: 1+~(o.width/2) + 'px',
          transform: o.hwaccel ? 'translate3d(0,0,0)' : '',
          opacity: o.opacity,
          animation: useCssAnimations && addAnimation(o.opacity, o.trail, i, o.lines) + ' ' + 1/o.speed + 's linear infinite'
        });
        if (o.shadow) ins(seg, css(fill('#000', '0 0 4px ' + '#000'), {top: 2+'px'}));
        ins(el, ins(seg, fill(o.color, '0 0 1px rgba(0,0,0,.1)')));
      }
      return el;
    },
    opacity: function(el, i, val) {
      if (i < el.childNodes.length) el.childNodes[i].style.opacity = val;
    }
  });

  /////////////////////////////////////////////////////////////////////////
  // VML rendering for IE
  /////////////////////////////////////////////////////////////////////////

  /**
   * Check and init VML support
   */
  !function() {

    function vml(tag, attr) {
      return createEl('<' + tag + ' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">', attr);
    }

    var s = css(createEl('group'), {behavior: 'url(#default#VML)'});

    if (!vendor(s, 'transform') && s.adj) {

      // VML support detected. Insert CSS rule ...
      sheet.addRule('.spin-vml', 'behavior:url(#default#VML)');

      Spinner.prototype.lines = function(el, o) {
        var r = o.length+o.width;
        var s = 2*r;

        function grp() {
          return css(vml('group', {coordsize: s +' '+s, coordorigin: -r +' '+-r}), {width: s, height: s});
        }

        var margin = -(o.width+o.length)*2+'px';
        var g = css(grp(), {position: 'absolute', top: margin, left: margin});

        var i;

        function seg(i, dx, filter) {
          ins(g,
            ins(css(grp(), {rotation: 360 / o.lines * i + 'deg', left: ~~dx}),
              ins(css(vml('roundrect', {arcsize: 1}), {
                  width: r,
                  height: o.width,
                  left: o.radius,
                  top: -o.width>>1,
                  filter: filter
                }),
                vml('fill', {color: o.color, opacity: o.opacity}),
                vml('stroke', {opacity: 0}) // transparent stroke to fix color bleeding upon opacity change
              )
            )
          );
        }

        if (o.shadow) {
          for (i = 1; i <= o.lines; i++) {
            seg(i, -2, 'progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)');
          }
        }
        for (i = 1; i <= o.lines; i++) seg(i);
        return ins(el, g);
      };
      Spinner.prototype.opacity = function(el, i, val, o) {
        var c = el.firstChild;
        o = o.shadow && o.lines || 0;
        if (c && i+o < c.childNodes.length) {
          c = c.childNodes[i+o]; c = c && c.firstChild; c = c && c.firstChild;
          if (c) c.opacity = val;
        }
      };
    }
    else {
      useCssAnimations = vendor(s, 'animation');
    }
  }();

  window.Spinner = Spinner;

})(window, document);

(function($) {
		$.fn.spin = function(opts, color) {
			var presets = {
			"tiny": { lines: 8, length: 2, width: 2, radius: 3 },
			"small": { lines: 8, length: 4, width: 3, radius: 5 },
			"large": { lines: 10, length: 8, width: 4, radius: 8 }
		};
		if (Spinner) {
			return this.each(function() {
			var $this = $(this),
			data = $this.data();

		if (data.spinner) {
			data.spinner.stop();
			delete data.spinner;
		}
		if (opts !== false) {
		if (typeof opts === "string") {
		if (opts in presets) {
		opts = presets[opts];
		} else {
		opts = {};
		}
		if (color) {
		opts.color = color;
		}
		}
		data.spinner = new Spinner($.extend({color: $this.css('color')}, opts)).spin(this);
		}
		});
		} else {
		throw "Spinner class not available.";
		}
		};
		$.jNotify = {
		defaults: {
			/** VARS - OPTIONS **/
			autoHide : true,				// Notify box auto-close after 'TimeShown' ms ?
			clickOverlay : false,			// if 'clickOverlay' = false, close the notice box on the overlay click ?
			MinWidth : 200,					// min-width CSS property
			TimeShown : 1500, 				// Box shown during 'TimeShown' ms
			ShowTimeEffect : 200, 			// duration of the Show Effect
			HideTimeEffect : 200, 			// duration of the Hide effect
			LongTrip : 15,					// in pixel, length of the move effect when show and hide
			HorizontalPosition : 'center', 	// left, center, right
			VerticalPosition : 'top',	 // top, center, bottom
			ShowOverlay : true,				// show overlay behind the notice ?
			ColorOverlay : '#000',			// color of the overlay
			OpacityOverlay : 0.3,			// opacity of the overlay
			
			/** METHODS - OPTIONS **/
			onClosed : null,
			onCompleted : null
		},

		/*****************/
		/** Init Method **/
		/*****************/
		init:function(msg, options, id) {
			opts = $.extend({}, $.jNotify.defaults, options);

			/** Box **/
			if($("#"+id).length == 0)
				$Div = $.jNotify._construct(id, msg);

			// Width of the Brower
			WidthDoc = parseInt($(window).width());
			HeightDoc = parseInt($(window).height());

			// Scroll Position
			ScrollTop = parseInt($(window).scrollTop());
			ScrollLeft = parseInt($(window).scrollLeft());

			// Position of the jNotify Box
			posTop = $.jNotify.vPos(opts.VerticalPosition);
			posLeft = $.jNotify.hPos(opts.HorizontalPosition);

			// Show the jNotify Box
			if(opts.ShowOverlay && $("#jOverlay").length == 0)
				$.jNotify._showOverlay($Div);

			$.jNotify._show(msg);
		},

		/*******************/
		/** Construct DOM **/
		/*******************/
		_construct:function(id, msg) {
			$Div = $('<div id="'+id+'"/>')
			.css({opacity : 0,minWidth : opts.MinWidth})
			.html(msg)
			.appendTo('body');
			return $Div;
		},

		/**********************/
		/** Postions Methods **/
		/**********************/
		vPos:function(pos) {
			switch(pos) {
				case 'top':
					var vPos = ScrollTop + parseInt($Div.outerHeight(true)/2);
					break;
				case 'center':
					var vPos = ScrollTop + (HeightDoc/2) - (parseInt($Div.outerHeight(true))/2);
					break;
				case 'bottom':
					var vPos = ScrollTop + HeightDoc - parseInt($Div.outerHeight(true));
					break;
			}
			return vPos;
		},

		hPos:function(pos) {
			switch(pos) {
				case 'left':
					var hPos = ScrollLeft;
					break;
				case 'center':
					var hPos = ScrollLeft + (WidthDoc/2) - (parseInt($Div.outerWidth(true))/2);
					break;
				case 'right':
					var hPos = ScrollLeft + WidthDoc - parseInt($Div.outerWidth(true));
					break;
			}
			return hPos;
		},

		/*********************/
		/** Show Div Method **/
		/*********************/
		_show:function(msg) {
			$Div
			.css({
				top: posTop,
				left : posLeft
			});
			switch (opts.VerticalPosition) {
				case 'top':
					$Div.animate({
						top: posTop + opts.LongTrip,
						opacity:1
					},opts.ShowTimeEffect,function(){
						if(opts.onCompleted) opts.onCompleted();
					});
					if(opts.autoHide)
						$.jNotify._close();
					else
						$Div.css('cursor','pointer').click(function(e){
							$.jNotify._close();
						});
					break;
				case 'center':
					$Div.animate({
						opacity:1
					},opts.ShowTimeEffect,function(){
						if(opts.onCompleted) opts.onCompleted();
					});
					if(opts.autoHide)
						$.jNotify._close();
					else
						$Div.css('cursor','pointer').click(function(e){
							$.jNotify._close();
						});
					break;
				case 'bottom' :
					$Div.animate({
						top: posTop - opts.LongTrip,
						opacity:1
					},opts.ShowTimeEffect,function(){
						if(opts.onCompleted) opts.onCompleted();
					});
					if(opts.autoHide)
						$.jNotify._close();
					else
						$Div.css('cursor','pointer').click(function(e){
							$.jNotify._close();
						});
					break;
			}
		},

		_showOverlay:function(el){
			var overlay = 
			$('<div id="jOverlay" />')
			.css({
				backgroundColor : opts.ColorOverlay,
				opacity: opts.OpacityOverlay
			})
			.appendTo('body')
			.show();

			if(opts.clickOverlay)
			overlay.click(function(e){
				e.preventDefault();
				opts.TimeShown = 0; // Thanks to Guillaume M.
				$.jNotify._close();
			});
		},


		_close:function(){
				switch (opts.VerticalPosition) {
					case 'top':
						if(!opts.autoHide)
							opts.TimeShown = 0;
						$Div.stop(true, true).delay(opts.TimeShown).animate({ // Tanks to Guillaume M.
							top: posTop-opts.LongTrip,
							opacity:0
						},opts.HideTimeEffect,function(){
							$(this).remove();
							if(opts.ShowOverlay && $("#jOverlay").length > 0)
								$("#jOverlay").remove();
								if(opts.onClosed) opts.onClosed();
						});
						break;
					case 'center':
						if(!opts.autoHide)
							opts.TimeShown = 0;
						$Div.stop(true, true).delay(opts.TimeShown).animate({ // Tanks to Guillaume M.
							opacity:0
						},opts.HideTimeEffect,function(){
							$(this).remove();
							if(opts.ShowOverlay && $("#jOverlay").length > 0)
								$("#jOverlay").remove();
								if(opts.onClosed) opts.onClosed();
						});
						break;
					case 'bottom' :
						if(!opts.autoHide)
							opts.TimeShown = 0;
						$Div.stop(true, true).delay(opts.TimeShown).animate({ // Tanks to Guillaume M.
							top: posTop+opts.LongTrip,
							opacity:0
						},opts.HideTimeEffect,function(){
							$(this).remove();
							if(opts.ShowOverlay && $("#jOverlay").length > 0)
								$("#jOverlay").remove();
								if(opts.onClosed) opts.onClosed();
						});
						break;
				}
		},

		_isReadable:function(id){
			if($('#'+id).length > 0)
				return false;
			else
				return true;
		}
	};

	/** Init method **/
	jNotify = function(msg,options) {
		if($.jNotify._isReadable('jNotify'))
			$.jNotify.init(msg,options,'jNotify');
	};

	jSuccess = function(msg,options) {
		if($.jNotify._isReadable('jSuccess'))
			$.jNotify.init(msg,options,'jSuccess');
	};

	jError = function(msg,options) {
		if($.jNotify._isReadable('jError'))
			$.jNotify.init(msg,options,'jError');
	};
    jNotify_on = function() {
		return !($.jNotify._isReadable('jError'));
			
	};
	$.ajaxSetup({
            cache: false,
            dataType: 'html',
            error: function(xhr, status, error) {
				if(xhr.responseText == ""){
					switch(status){
						case "error":
							ajax_error("Opps, Connection error. Either you are off line or the server is down. Check your connection and try again");
							break;
						case "abort":
							ajax_error("Opps, Connection Aborted. Please try again");
							break;
						case "timeout":
							ajax_error("Opps, Connection Time out. Please try again");
							break;
						default:
							ajax_error("Opps, Something is wrong. Please do try again or contact system admin");
					}
				}
                 else{ajax_error(xhr.responseText);}
            },
            timeout: 60000, // Timeout of 60 seconds
            type: 'POST'
           
    });
	
	
			
})(jQuery);
(function( $ ){

    $.fn.uncheckableRadio = function() {

        return this.each(function() {
            $(this).mousedown(function() {
                $(this).data('wasChecked', this.checked);
            });

            $(this).click(function() {
                if ($(this).data('wasChecked'))
                    this.checked = false;
            });
        });

    };

})( jQuery );

$(function(){
	//feature_detect();
  $("input[date='1']").datepicker({dateFormat: 'MM d yy',constrainInput: true, changeMonth: true,changeYear: true});
	  	$('#slide-submenu').on('click',function() {
			$(this).closest('.list-group').fadeOut('slide',function(){
			$('.mini-submenu').fadeIn();
			});
		});

		$('.mini-submenu').on('click',function(){
			$(this).next('.list-group').toggle('slide');
			$('.mini-submenu').hide();
		});
	   
});
var wb = null;
var wb_connected = false;
var Web_Socket = {
    func:null,
    socket:null,
    connect:function(host) {
            if ('WebSocket' in window) {
               this.socket = new WebSocket(host);
            } else if ('MozWebSocket' in window) {
                this.socket = new MozWebSocket(host);
            } else {
                ajax_error('Error: WebSocket is not supported by this browser.');
                return;
            }

            this.socket.onopen = function () {
                wb_connected = true;
                if(Web_Socket.func != null){
                    Web_Socket.func();
                    //this.func();
                }
            };

            this.socket.onclose = function () {
               wb_connected = false;
            };

            this.socket.onmessage = function (message) {
               //notify_success(message.data);
               var response = message.data;
               var msg = response.toString().split(";");
               //var span = $("<span></span>");
               if(msg[0] == "OK"){
                   //$(span).addClass("msg")
				   notify_success(msg[1]);
               }
               else {
					//$(span).addClass("error")
					ajax_error(msg[1]);
			   
			   }
               //$(span).html("scheduled message response " + msg[1]);
               //$("div.label_bar").append($(span));
               
            };
        
        
    },
    close:function(){
        this.socket.close();
    },
    initialize:function(cmd) {
            this.func = cmd;
			var paths = window.location.pathname.split( '/' );
			var url = paths.length == 2 ? (window.location.host + '/ResponseNotification.jsp') : (window.location.host + '/' + paths[1] + '/ResponseNotification.jsp');
            //alert(url);
			if (window.location.protocol == 'http:') {
                this.connect('ws://' + url );
            } else {
                this.connect('wss://' + url );
            }
            
    }
}
var upload_window = null;
function initialize(){
	$("li.leafmenu").click(function(event){
		if(!($(event.target).is("li.leafmenu"))) return;
		$(this).siblings("li.leafmenu").find(":first").hide("slow");							
		$(this).find(":first").toggle("slow");return false;
	});
	

}
function load_cnt(url,params,callback){
	hide_com_panel();
    if(url ==  '' ) return;
   	hide_overlay();
	show_waiting();  
    var d =  new Date();
	if(!params) params = {};
	params.tt = d;
	callback = typeof(callback) == 'undefined' ? set_cnt : callback ;
    $.post(url,params,callback,'html');
}

function change_cnt_view(elem,url,module){
	hide_com_panel();
	var menu = $(elem).parents('li.main_menu');
	load_cnt(url,{},function(responseText){
		set_cnt(responseText);
/* 		if ( $(menu).parents('.sidebar-navbar-collapse').length ){
			$(".sidebar-navbar-collapse .list-group a.list-group-item").removeClass("active");
			$(menu).addClass("active");			
		} */
		menu.siblings('li.main_menu').removeClass("active");
		menu.addClass("active");
	});
}
function load_module_menu(elem,url,params){
	var menu = $(elem);
	if(!params) params = {};
	load_cnt(url,params,function(responseText){
		hide_waiting();
		$("#inner_cnt").html(responseText).fadeIn("slow");	
		if ( $(menu).parents('#module_menus').length ){
			$("#module_menus li").removeClass("active");
			$(menu).parents('#module_menus li').addClass("active");			
		}
		

	});
}	
function load_cnt2(url,fm,callback){
	var params = $(fm).serialize();
	load_cnt(url,params,callback);
}

function custom_search_rep(elem_id,url,offset,c_param){
	show_waiting();
	var params = c_param;
	params += "&s_offset="+offset;
	var elem = $("#"+elem_id);
	$.post(url,params,function(responseText){
		hide_waiting();
			$(elem).html(responseText).fadeIn("slow");		
			//$(".listing").removeClass("listing_in_view");
						
	},'html'); 
}

function load_cnt3(elem_id,url,params){
	hide_com_panel();
    if(url ==  '' ) return;
	var elem = $("#"+elem_id);  
    var d =  new Date();
	if(!params) params = {};
	params.tt = d;
	show_waiting();
	$.post(url,params,function(responseText){
		hide_waiting();
		$(elem).html(responseText).fadeIn("slow");								
		},'html');
}
function set_cnt(text){
   // ajax_error(text);
	hide_waiting();
	hide_waiting();
	$("#cnt").html(text);
}
function load_modal_dialog(elem){
	var rel = $(elem).attr('rel');
	var overlay = $("<div></div>");
	var modal = $("<div></div>");
	$(overlay).addClass("overlay");
	$(overlay).css("width", $(window).width());
	$(overlay).css("height", $(window).height());	
	$(modal).addClass("dialog");
	$(modal).css("width", $("#"+rel).width());
	var m_h = $("#"+rel).height() ;
	$(modal).html($("#"+rel).html());
	var left = ($(window).width() - $(modal).width())/2
	$(modal).css("left",left );
	var top = $(window).height() < m_h ? 10 : ($(window).height() - m_h)/2;
	var top2 = $(window).height() * 0.2;
	top = top < top2 ? top : top2;
	$(modal).css("top",top );
	$("body").prepend($(overlay));
	$(overlay).show();
	$("body").append($(modal));
	
}

function load_ajax_modal_dialog(url,params,elem){
	//var overlay = $("<div></div>");
	var modal = $("<div id='modal_sap_dialog'></div>");
	//$(overlay).addClass("overlay");
	//$(overlay).css("width", $(window).width());
	//$(overlay).css("height", $(window).height());
	//$(modal).addClass("loading");
	//$("body").prepend($(overlay));
	//$(overlay).show();
	
	show_waiting();
	$.post( url,params, function(responseText,status,xhr){
			if(xhr.status == 200){
				hide_waiting();
				//$(modal).removeClass("loading");
				$(modal).addClass("modal fade");
				$(modal).html(responseText);
				//$("body").append($(modal));
				//notify_success(responseText);
				var left = ($(window).width() - $(modal).width())/2
				//$(modal).css("left",left );
				var top = ($(window).height() - $(modal).height())/2
				var top2 = $(window).height() * .2;
				top = top < top2 ? top : top2;
				//$(modal).css("top",top2 );
				$(modal).on('hidden.bs.modal', function (e) {
					$("#modal_sap_dialog").remove();
				});
				$("body").append($(modal));
				$(modal).modal();
				
			}
		});
	
	
}

function load_modal_dialog2(responseText){
	hide_waiting();
	var overlay = $("<div></div>");
	var modal = $("<div></div>");
	$(overlay).addClass("overlay");
	$(overlay).css("width", $(window).width());
	$(overlay).css("height", $(window).height());
	$("body").prepend($(overlay));
	$(overlay).show();
	$(modal).addClass("dialog");
	$(modal).html(responseText);
	$("body").append($(modal));
	var left = ($(window).width() - $(modal).width())/2
	$(modal).css("left",left );
	var top = ($(window).height() - $(modal).height())/2
	var top2 = $(window).height() * .2;
	top = top < top2 ? top : top2;
	$(modal).css("top",top );
				
}

function change_page(responseText,query){	
		
        var d =  new Date();
        var url = responseText;
		if(query){url = responseText + "&t=" + encodeURIComponent(d.toString()); }
		else { url = responseText + "?t=" + encodeURIComponent(d.toString()); }
       show_waiting();
        window.location.replace(url);  

}

function show_waiting(){
		if($("#modal_sap_dialog").length > 0) 
			$("#modal_sap_dialog").spin();
		else{
			$("#container").spin();
		}
}

function hide_overlay(){	
	$('#modal_sap_dialog').modal('hide');
}
function hide_waiting(){
	if($("#modal_sap_dialog").length > 0) 
		$("#modal_sap_dialog").spin(false);
	else{
		$("#container").spin(false);
	}	
}
var notification_handler = {
		msg:''	
		
}
function ajax_error(responseText){
	hide_waiting();	
		hide_waiting();
		notification_handler.msg = responseText;
        //hide_overlay();
        if(jNotify_on()) $.jNotify._close();
		jError(	notification_handler.msg,
				{
					autoHide : false,
					clickOverlay : true,
					MinWidth : 250,
					TimeShown : 3000,
					ShowTimeEffect : 200,
					HideTimeEffect : 200,
					LongTrip : 20,
					HorizontalPosition : 'center',
					VerticalPosition : 'top',
					ShowOverlay : true,
					ColorOverlay : '#000',
					OpacityOverlay : 0.3,
					onClosed : function(){},
					onCompleted : function(){}
				}
	);
}
function notify_success(responseText){
	hide_waiting();		
        notification_handler.msg = responseText;
        hide_overlay();
        if(jNotify_on()) $.jNotify._close();
		jSuccess(	notification_handler.msg,
				{
					autoHide : false,
					clickOverlay : true,
					MinWidth : 250,
					TimeShown : 3000,
					ShowTimeEffect : 200,
					HideTimeEffect : 200,
					LongTrip : 20,
					HorizontalPosition : 'center',
					VerticalPosition : 'top',
					ShowOverlay : true,
					ColorOverlay : '#000',
					OpacityOverlay : 0.3,
					onClosed : function(){},
					onCompleted : function(){}
				}
	);
}

var validateElement = {
	stripWhitespace : function(str,c){if(typeof(c) == 'undefined'){c='';} return str.replace(/\s+/g,c);},
        indicate_error:function(element,message){
                
                $(element).removeClass("input_all_normal");
                $(element).addClass("input_all_error");
                $(element).attr("title",message);
                
        },
        make_normal:function(element){
            
                $(element).removeClass("input_all_error");
		$(element).addClass("input_all_normal");
                $(element).attr("title", "");
            
        },
        isValidName:function(element){
                $(element).val(this.stripWhitespace($(element).val(),' '));
                var p = /^(([a-zA-Z]{2,}\.)\s)?([a-zA-Z]{3,})\s(([a-zA-Z]+)?\s)?([a-zA-Z]{3,})\s?$/g;
                var isValid =  $(element).val().match(p);
		if(isValid){ 
				
                    this.make_normal(element)
				
                }
		else {
				
                       this.indicate_error(element,"Invalid name format")         
				
		
                }
		   return isValid;
            
        },
        isValidAddress:function(element){
                
                $(element).val(this.stripWhitespace($(element).val(),' '));
                var p = /^((\w+)\s){5,}$/g;
                var isValid =  $(element).val().match(p);
		if(isValid){ 
				
                    this.make_normal(element)
				
                }
		else {
				
                       this.indicate_error(element,"Invalid address, addree too short")         
				
		
                }
		   return isValid;
        },
	isValidEmail:function(element){
		var p = /^([a-zA-Z0-9_\-\.]+)@((\ [[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}| [0-9]{1,3})(\]?)$/;
		var isValid =  p.test($(element).val());
		if(isValid){ 
				
                    this.make_normal(element);
				
                }
		else {
				
                       this.indicate_error(element,"Invalid email address format");         
				
		
                }
		   return isValid;
		  
	},	
	isValidMoney:function(element){
		var p = /^([0-9]+)(\.[0-9]{1,2})?$/;
		var isValid =  p.test($(element).val());
		if(isValid){ 
				
                    this.make_normal(element);
				
                }
		else {
				
                       this.indicate_error(element,"Invalid money format");         
				
		
                }
		   return isValid;
		  
	},
	isValidRange:function(element){
		//var val = parseInt(element.value);
		var isValid =  (parseFloat(element.minval) <= parseFloat(element.value)) && (parseFloat(element.value) <= parseFloat(element.maxval));
		//alert(isValid);
		if(isValid){ 
				
                    this.make_normal(element);
				
                }
		else {
				
                       this.indicate_error(element,"The value is out of acceptable range. The value must be between " + element.minval + " and " + element.maxval);         
				
		
                }
		   return isValid;
		  
	},
	isValidPhone:function(element){
		var p = /^\+?\d+$/;
		var isValid =  p.test($(element).val());
		if(isValid){ 
				
                    this.make_normal(element);
				
                }
		else {
				
                       this.indicate_error(element,"Invalid phone format");         
				
		
                }
		   return isValid;
		  
	},
	isValidTime:function(element){
		var p = /^(([0-9]|[0][0-9]|[1][0-2]):([0-5][0-9])\s([Aa][Mm]|[Pp][Mm]))$/;
		var isValid =  p.test($(element).val());
		if(isValid){ 
				
                    this.make_normal(element);
				
                }
		else {
				
                       this.indicate_error(element,"Invalid time format ");         
				
		
                }
		   return isValid;
		  
	},	
	isValidDate:function(element){
		var p = /^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/;
		var isValid =  p.test($(element).val());
		if(isValid){ 
				var parts = $(element).val().split("-");

				if( (parts[1] == "02") && (parts[2] == "30" || parts[2] == "31")){
					this.indicate_error(element,"Invalid date format");
					isValid = false;
				}				
				else if( (parts[1] == "04" || parts[1] == "06" || parts[1] == "09" || parts[1] == "11") && (parts[2] == "31")){
					this.indicate_error(element,"Invalid date format");
					isValid = false;
				}
                else{this.make_normal(element);}
				
        }
		else {
				
                       this.indicate_error(element,"Invalid date format ");         
				
		
                }
		   return isValid;
		  
	},
	isValid:function(element){
		var isValid = true;
		var $element = $(element);
		var id = $element.attr('id');
		var name = $element.attr('name');
		var value = $element.val();
				
		// <input> uses type attribute as written in tag
		// <textarea> has intrinsic type of 'textarea'
		// <select> has intrinsic type of 'select-one' or 'select-multiple'
		var type = $element[0].type.toLowerCase();
		switch(type){
			case 'text':
			case 'textarea':
			case 'password':
			if ( this.stripWhitespace(value,'').length == 0 ){isValid = false;}
			break;
			case 'select-one':
			case 'select-multiple':
			if( !value ){isValid = false;}
			break;
			case 'checkbox':
			case 'radio':
			if( $('input[name="'+ name +'"]:checked').length == 0 ){isValid = false;};
			break;
		} 
		if ( type == 'checkbox' || type == 'radio' ) {
			$('input[name="' + name + '"]').each(function(){});
		} else {
			if(isValid){ 
				
                             this.make_normal(element)
				
                        }
                        else {
				
                             this.indicate_error(element,"This field should not be empty")         
				
		
                        }
			
		}
		// after initial validation, allow elements to re-validate on change
		$element
		
		return isValid;
	},
        further_validation:function(element){
            
            if(element.isemail){
                    element.valid_input = this.isValidEmail(element);
                }  

            if(element.isname){
                  element.valid_input = this.isValidName(element);
                  
                }  
            
           if(element.isadress){
                  element.valid_input = this.isValidAddress(element);
                  
           }            
		   if(element.ismoney){
                  element.valid_input = this.isValidMoney(element);
                  
           }  		   
		   if(element.islimited){
                  element.valid_input = this.isValidRange(element);
				  
                  
           }  
		   if(element.isphone){
                  element.valid_input = this.isValidPhone(element);
                  
           }		   
		   if(element.istime){
                  element.valid_input = this.isValidTime(element);
                  
           } 
		   if(element.isdate){
                  element.valid_input = this.isValidDate(element);
                  
           }  
           
            
            
        },
        validate:function(element){
            
            if(element.not_required){
                if(this.stripWhitespace($(element).val(),'').length == 0){;
                    element.valid_input = true;
                    this.make_normal(element);
                }
                else {element.valid_input = true; this.further_validation(element);
                }

            }
            if(element.isrequired){
                element.valid_input = this.isValid(element)
                if(element.valid_input)
                    this.further_validation(element);
                
            }    
            
            var $element = $(element);
            $element
		.unbind('change.validate')
		.bind('change.validate',function(){
                    if(validateElement.validate(this))
                        if(this.frm.validated(this.frm))
                            $("#error_msg",$(element.frm)).fadeOut("slow");
                            
                    }
                
                );
              
              if(!element.valid_input)
                 $("#error_msg",$(element.frm)).html("Please correct errors in the highlighted boxs<br>Place Mouse over the field to view error description ").fadeIn("slow");
            
             return element.valid_input;          
        }
}

function add_validation(form,cmd,custom_validate,inoverlay){
	//notify_success($(fm).attr('name'));
	
	var fm = form;
	var fmm = form.get(0);
	$("input[numonly='1']").bind('keydown',function(event){
		// the keycode for the key pressed
		var keyCode = event.which;
		// 48-57 Standard Keyboard Numbers
		var isStandard = (keyCode > 47 && keyCode < 58);
		// 96-105 Extended Keyboard Numbers (aka Keypad)
		var isExtended = (keyCode > 95 && keyCode < 106);
		// 8 Backspace, 46 Forward Delete
		// 37 Left Arrow, 38 Up Arrow, 39 Right Arrow, 40 Down Arrow
		var validKeyCodes = ',8,37,38,39,40,46,';
		var isOther = ( validKeyCodes.indexOf(',' + keyCode + ',') > -1 );
		if ( isStandard || isExtended || isOther ){
		return true;
		} else {
		return false;
		}
	}).bind('blur',function(){
		// regular expression that matches everything that is not a number
		var pattern = new RegExp('[^0-9]+', 'g');
		var $input = $(this);
		var value = $input.val();
		// clean the value using the regular expression
		value = value.replace(pattern, '');
		$input.val( value )
	});
	
	
	$("input[date='1']").datepicker({dateFormat: 'yy-mm-dd',constrainInput: true, changeMonth: true,changeYear: true,yearRange: "1900:2090" });
	//$("input[date='1']").glDatePicker({showAlways:false});
	$("input[time='1']").datetimepicker({
		timeOnly:true,
		controlType: 'select',
		timeFormat: 'hh:mm tt'
	});
	$("button[name='back']").bind('click',function(event){
	
		var url = $("#backurl").val();
		var dataToSend = $(fm).serialize();
		//notify_success(dataToSend);
		var typeOfDataToReceive = 'html';
		$.post( url, dataToSend, set_cnt, typeOfDataToReceive );
	});
	$("input[type='file']").bind('click',function(event){
		event.preventDefault();
		var cod = $(this).position();
		var url = $("#" + $(this).attr('id') + "_link").val();
		uploadwindow(url,cod.top,cod.left);
	});
	
	$(fm).submit(function(event){
				
               //notify_success("ggss");              // we want to submit the form using Ajax (prevent page refresh)
				event.preventDefault();
				var isErrorFree = true;
                                

                    this.init_elems(this); 
					//notify_success(Object.keys(this.elem));					
                    if(this.validated(this) == false){
                             
                         isErrorFree = true;
                         $.each(this.elem,function(){
                                    
							 if ( validateElement.validate(this) == false ){
											isErrorFree = false;
							 }
                                  
                         });
						 if(isErrorFree){
						
							if(custom_validate){
									
									isErrorFree = custom_validate($(this));
							}
							
						 }
						 if(isErrorFree){this.do_submit(this);}
					}			
					else{
								
						if(custom_validate){
								
									isErrorFree = custom_validate($(this));
						}
							
						if(isErrorFree){this.do_submit(this);}
				
				}
				return false;
                                
			}); // close .submit()
			        fmm.elem =  {};
                                            
	//var getForm = function(){return fmm;}
	fmm.clear_init_elems = function(form_this,delete_required){
		form_this.elem = {};
		//notify_success(Object.keys(form_this.elem));
		if(delete_required){
				$('input, select, textarea',$(form_this)).each(function(){delete this.isrequired});
		}
		form_this.init_elems(form_this);
	}
	fmm.init_elems = function(form_this){
		//notify_success("called");
	 // iterate through required form elements and check to see if they are valid
	$('input.required, select.required, textarea.required',$(form_this)).each(function(){
	   // notify_success($(this).attr("name"));
		this.isrequired = true;
		this.valid_input = false;
		this.frm = form_this;
		form_this.elem[$(this).attr("name")] = this;
		

	});
	$("input[email='1']",$(form_this)).each(function(){
			this.isemail = true;
			this.valid_input = false;
			this.frm = form_this;
			
			form_this.elem[$(this).attr("name")] = this;

	});                                        
	$("input[phone='1']",$(form_this)).each(function(){
			this.isphone = true;
			this.valid_input = false;
			this.frm = form_this;
			
			form_this.elem[$(this).attr("name")] = this;

	});
	$("input[personname='1']",$(form_this)).each(function(){
			this.isname = true;
			this.valid_input = false;
			this.frm = form_this;
			
			form_this.elem[$(this).attr("name")] = this;

	});
	$("input[adressbox='1'],texarea[adressbox='1']",$(form_this)).each(function(){
			this.isadress = true;
			this.valid_input = false;
			this.frm = form_this;
			
			form_this.elem[$(this).attr("name")] = this;

	});                                        
	$("input[money='1']",$(form_this)).each(function(){
			this.ismoney = true;
			this.valid_input = false;
			this.frm = form_this;			
			form_this.elem[$(this).attr("name")] = this;

	});
	$("input[limited='1']",$(form_this)).each(function(){
			this.islimited = true;
			this.valid_input = false;
			this.frm = form_this;
			this.maxval = $(this).attr("maxval");
			this.minval = $(this).attr("minval");
			form_this.elem[$(this).attr("name")] = this;

	});
	$("input[time='1']",$(form_this)).each(function(){
			this.istime = true;
			this.valid_input = false;
			this.frm = form_this;
			
			form_this.elem[$(this).attr("name")] = this;

	});										

	$("input[date='1']",$(form_this)).each(function(){
			this.isdate = true;
			this.valid_input = false;
			this.frm = form_this;
			
			form_this.elem[$(this).attr("name")] = this;

	});
	$("input:not(input[type='hidden'],input[type='file'],input[type='submit'],input[type='reset'],input.required),select:not(select.required),textarea:not(textarea.required)",$(this)).each(function(){
			this.not_required = true;
			this.valid_input = false;
			this.frm = form_this;
			form_this.elem[$(this).attr("name")] = this;
			
	  });
	  //$(".required",$(form_this)).prev("label").addClass("required_label");
	  $(".required",$(form_this)).each(function(index, element){
				$('label[for="' + element.id + '"]').addClass("required_label");
	  });
	}
	fmm.validated = function(form_this){
			isErrorFree = true;
			$.each(form_this.elem,function(){
					if (!this.valid_input){
						isErrorFree = false;
					};						
			});
			return isErrorFree;

	};
	
	fmm.do_submit = function(form_this){
		//notify_success('called');
			$("#error_msg",form_this).fadeOut("slow");                                    
			cmd = typeof(cmd) == 'undefined' ? set_cnt : cmd ;
			var $this = $(this);
			// grab the url from the form element
			var url = $this.attr('action');
			// prepare the form data to send
			var dataToSend = $this.serialize();
			
			var typeOfDataToReceive = 'html';
			//var hideoverlay = typeof(inoverlay) == 'undefined'? true : false;
			//if(hideoverlay){hide_overlay(); show_waiting();}
			 show_waiting();
			
			$.post( url, dataToSend,function(responseText){
				//$('input, select, textarea',$this).not(':button, :submit, :reset, :hidden').val('').removeAttr('checked');
				hide_overlay();
				if(!($this.hasClass("dont_reset"))){
					$this[0].reset();
					$('input.required, select.required, textarea.required',$this).each(function(){
						// notify_success($(this).attr("name"));
						
						this.valid_input = false;
							  

					});
					//notify_success("dd");
					isErrorFree = false;
				}
				cmd(responseText);
			} , typeOfDataToReceive );
						
    };
	//notify_success(fmm);

			/* $(".required",fm).prev("label").addClass("required_label"); */
			$(".required",fm).each(function(index, element){
				$('label[for="' + element.id + '"]').addClass("required_label");

			});
}

function logout(url){
    
    $.post( url, {} ,change_page, 'html' );
    
}

function ajax_success_page_change(responseText){
	var msg = responseText.toString().split(";");
    if(msg[0] == "OK"){
		var d =  new Date();
        var url = msg[1] + "?t=" + encodeURIComponent(d.toString());
       show_waiting();
        window.location.replace(url);

	}
    else{
		ajax_error(msg[1]);
	}
}
 

function is_picture_file(name,bt_id){
	
	var type = name.slice(name.lastIndexOf('.'));
	if(jQuery.inArray(type,[".jpg",".png",".gif"])){
		notify_success("file not image. only .jpg, .png and .gif is allowed");
		$("#"+bt_id).attr("disabled", 1);
	}
	else{$("#"+bt_id).removeAttr("disabled");}
}


function login_callback(responseText){
    hide_waiting();
	//alert(responseText);
    var msg = responseText.toString().split(";");
    if(msg[0] == "OK"){
        change_page(msg[1]);
    }
    else{$("#error_msg").html(msg[1]).fadeIn("slow");}
}

function change_password_callback(responseText){
	hide_overlay();
        hide_waiting();
	notify_success("Password Changed");	
	change_page("index.jsp");
}

function confirm_password(fm){ 
    
    var result = false;
	var p1 = $("#user_password").val();
	var p2 = $("#user_password2").val();
	if(p1 == '' || p2 == '') return result;
    if( p1 == p2 ) 
        result = true;
    else{
        ajax_error("Password do not match");        
    }
    return result;
    
}
function change_page(responseText,query){	
		
        var d =  new Date();
        var url = responseText;
		if(query){url = responseText + "&t=" + encodeURIComponent(d.toString()); }
		else { url = responseText + "?t=" + encodeURIComponent(d.toString()); }
       //show_waiting();
        window.location.replace(url);  

}



function show_com_panel(m_id){
	var d = $("<div></div>");
	var e = $("<span><img src='images/email.png' /> Email</span>");
	var s = $("<span><img src='images/phone.png' /> SMS</span>");
	$(s).bind('click',function(e){show_modal_dialog('send_message_form.jsp',{mem_id:m_id})});
	$(e).bind('click',function(e){show_modal_dialog('send_email_form.jsp',{mem_id:m_id})});
	$(d).addClass("com_panel");
	$(d).css({left: (viewportSize.getWidth()/2 - 100)});
	$(d).append($(e));
	$(d).append($(s));
	$("body").append($(d));

}

function hide_com_panel(){
	$(".com_panel").remove();
}

function new_user_callback(responseText){
	load_list_view("sys_setup/list_users_editable.jsp",{});
}

function save_new_user(fname,uname,pcode){
var prevs = "";
           $("[rel='privilege']").each(function(){
        
                    if($(this).prop('checked')){
                        prevs += $(this).val() + ",";
                    }      
             });
			 if(prevs == "") {
             ajax_error("Please Select Privileges");
             return;
        }
	    show_waiting();
        $.post("add_user.sv",{previls:prevs,fullname:fname,username:uname,password:pcode},new_user_callback,"html");
}
function update_user_privileges(uid){
		   notify_success(uid);
		   var prevs = "";
           $("[rel='privilege']").each(function(){
        
                    if($(this).prop('checked')){
                        prevs += $(this).val() + ",";
                    }      
             });
			 if(prevs == "") {
             ajax_error("Please Select Privileges");
             return;
        }
	    show_waiting();
        $.post("update_user.sv",{prevs:prevs,userid:uid},new_user_callback,"html");
}
function update_user(uid,status,uname){
		var act = status;
		
		if(act == 3){
			if(confirm("Are you sure you want to reset User password ?\n Pres Ok to delete")){
				$.post("refresh_user.jsp",{user_name:uid,user_id:uname},new_user_callback,"html");
			}	
		}		
		else if(act == 2){
			if(confirm("Are you sure you want to delete User ?\n Pres Ok to delete")){
				$.post("delete_user.sv",{user_id:uid},new_user_callback,"html");
			}	
		}
		else{
			$.post("update_user.jsp",{user_id:uid,status:act},new_user_callback,"html");
		}

        
}

function load_list_view(url,param){
	notify_success(url);
    /*show_waiting();
    $.post( url, param, function(responseText){
       hide_waiting();
        $(".list_view").html(responseText).fadeIn("slow");
    }, 'html' );*/
}

function indicate_transact(cl,url,param){
	//notify_success(url);
    //show_waiting();
	var elem_class = cl;
    $.post( url, param, function(responseText){
       //hide_waiting();        
		var valid = responseText.trim();
		
		$("a."+elem_class+" span.badge").remove();
		if( 0 < parseInt(valid)){
			var s = $("<span class='badge badge-important animated bounceIn'></span>");
			$(s).html(valid);
			$("a."+elem_class).append($(s));
		}

    }, 'html' );
}

function _transact(l,t,u,i,c,msg,get_note){


	if(confirm(msg + " Press Ok to Continue, Cancel to Stop")){
	
		var type = t;
		var vurl = u;
		var cl = c;
		var url = l;
		if(get_note){
			show_prompt("Reason For Rejection",function(msg){
				if(msg == ""){
					ajax_error("Enter reason for rejection");
					return;
				}
				msg = msg.replace(/(\r?\n)+/g, '<br />');
				
				$.post( url, {t_type:type,id:i,note:msg}, function(responseText){
					hide_overlay();        
					load_cnt('list_dirty_transacts.jsp',{t_type:type,v_url:vurl});
					indicate_transact(c+"_dirty_transaction","load_dirty.jsp",{t_type:type});
					indicate_transact(c+"_reject_transaction","load_rejected.jsp",{t_type:type});
				}, 'html' );
			
			});
			return;
		}
		$.post( url, {t_type:type,id:i}, function(responseText){
		   hide_overlay();        
			load_cnt('list_dirty_transacts.jsp',{t_type:type,v_url:vurl});
			indicate_transact(c+"_dirty_transaction","load_dirty.jsp",{t_type:type});

		}, 'html' );
	}
	//return false;
}

function show_prompt(text,callback){
var modal = $("<div class='modal-dialog'></div>");
var modal_content = $("<div class='modal-content'> </div>");
var modal_body = $("<div class='modal-body'></div>");
var modal_footer = $("<div class='modal-footer'><button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button></div>");
var ok_button = $("<button type='button' class='btn btn-primary'> <span class='glyphicon glyphicon-ok'> OK</span></button>");
var row = $("<div class='row'></div>");
var col = $("<div class='col-md-12'></div>");
var input = $("<textarea id='input_feild' class='form-control' rows='5' ></textarea>");        
var title= $("<h4 class='modal-title' id='myModalLabel'></h4>");
var header = $("<div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button></div>");
	$(title).html(text);
	$(ok_button).bind("click",function(e){
		var msg = $(input).val().trim();

			callback(msg);
			hide_overlay(); 
		
	
	})
	$(col).append($(input));
	$(row).append($(col));
	$(modal_body).append($(row));
	$(modal_footer).append($(ok_button));
	$(header).append($(title));
	$(modal_content).append($(header));
	$(modal_content).append($(modal_body));
	$(modal_content).append($(modal_footer));
	$(modal).append($(modal_content));
	//notify_success($(modal).html());
	var modal_dalog = $("<div id='modal_sap_dialog' class='modal fade'></div>");
	$(modal_dalog).on('hidden.bs.modal', function (e) {
					$("#modal_sap_dialog").remove();
				});
	$(modal_dalog).append($(modal));
	//notify_success($(modal_dalog).html());
	$("body").append($(modal_dalog));
	$(modal_dalog).modal();

}

function show_modal(tl,text){
var modal = $("<div class='modal-dialog'></div>");
var modal_content = $("<div class='modal-content'> </div>");
var modal_body = $("<div class='modal-body'></div>");
var modal_footer = $("<div class='modal-footer'><button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button></div>");
var ok_button = $("<button type='button' class='btn btn-primary'> <span class='glyphicon glyphicon-ok'> OK</span></button>");
var row = $("<div class='row'></div>");
var col = $("<div class='col-md-12'></div>");
var msg = $("<div></div>");        
var title= $("<h4 class='modal-title' id='myModalLabel'></h4>");
var header = $("<div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button></div>");
	$(title).html(tl);
	$(msg).html(text);
	$(ok_button);
	$(col).append($(msg));
	$(row).append($(col));
	$(modal_body).append($(row));
	//$(modal_footer).append($(ok_button));
	$(header).append($(title));
	$(modal_content).append($(header));
	$(modal_content).append($(modal_body));
	$(modal_content).append($(modal_footer));
	$(modal).append($(modal_content));
	//notify_success($(modal).html());
	var modal_dalog = $("<div id='modal_sap_dialog' class='modal fade'></div>");
	$(modal_dalog).on('hidden.bs.modal', function (e) {
					$("#modal_sap_dialog").remove();
				});
	$(modal_dalog).append($(modal));
	//notify_success($(modal_dalog).html());
	$("body").append($(modal_dalog));
	$(modal_dalog).modal();

}
function register_selectall_action(rel,f1,f2){

    var $chkbxs = $("input[rel='"+rel+"']");
    var $selectall = $("#"+rel+"_selectall");
	if(typeof($($selectall).prop("id")) == 'undefined'){
		$selectall = $("input[rel='"+rel+"_selectall']");
	}
	
	var checked_f = f1;
	var unchecked_f = f2;
	var mem_id = rel;
    
    $selectall.unbind('change').bind('change',function(){
        if(this.checked){
            $chkbxs.prop('checked',true);
			if((typeof(checked_f) != 'undefined') && ($(".com_panel").length == 0)){checked_f(mem_id);}
						
		}	
        else{	
            $chkbxs.prop('checked',false);
			if(typeof(unchecked_f) != 'undefined'){unchecked_f();}
			}
    });
    //notify_success($chkbxs.length);
    $chkbxs.unbind('change').bind('change',function(){

        if(this.checked){
			if((typeof(checked_f) != 'undefined') && ($(".com_panel").length == 0)){checked_f(mem_id);}
            if($chkbxs.length == $chkbxs.filter(':checked').length){
               $selectall.prop('checked',true); 
			}
        }
        else{
			$selectall.prop('checked',false); 
			if($chkbxs.filter(':checked').length == 0){
              if(typeof(unchecked_f) != 'undefined'){unchecked_f();}
			}
			}
    });
    
}

function delete_(del_url,params,msg,view_url,view_params,callback,container){
	restore_(del_url,params, "delete this " +  msg,view_url,view_params,callback,container);
}
function restore_(del_url,params,msg,view_url,view_params,callback,container){
	if(confirm("Are you sure you want to " +  msg +" ?\n Pres Ok to delete")){
		/* var url = view_url; */
		var v_param = view_params;
		$.post( del_url,params, function(responseText){			
			if(typeof(container) == "undefined"){callback(view_url,v_param);}
			else{callback(container,view_url,v_param);}
		}, 'html' );
	}

}

function load_list_view(url,param){
	//notify_success(url);
    show_waiting();
    $.post( url, param, function(responseText){
       hide_waiting();
        $(".list_view").html(responseText).fadeIn("slow");
    }, 'html' );
}

var validate_value = {		
	stripWhitespace : function(str,c){
		if(typeof(c) == 'undefined'){c='';} 
		return [(str.replace(/\s+/g,c)),'Empty Value'];
	},
	isValidName:function(value){
			$(value).val(this.stripWhitespace(value,' '));
			var p = /^(([a-zA-Z]{2,}\.)\s)?([a-zA-Z]{3,})\s(([a-zA-Z]+)?\s)?([a-zA-Z]{3,})\s?$/g;
			return [(value.match(p)),'Invalid Name Format'];
	
		
	},
	isValidAddress:function(value){
			
		$(value).val(this.stripWhitespace(value,' '));
		var p = /^((\w+)\s){5,}$/g;
		return [(value.match(p)),'Invalid Address Format'];
	
	},
	isValidEmail:function(value){
		var p = /^([a-zA-Z0-9_\-\.]+)@((\ [[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}| [0-9]{1,3})(\]?)$/;
		return [(value.match(p)),'Invalid Email Format'];
		
		  
	},	
	isValidMoney:function(value){
		var p = /^([0-9]+)(\.[0-9]{1,2})?$/;
		return [(value.match(p)),'Invalid Money Format'];
		
		  
	},	
	isValidPhone:function(value){
		var p = /^\+?\d+$/;
		return [(value.match(p)),'Invalid Phone Number Format'];
		
		  
	},
	isValidTime:function(value){
		var p = /^(([0-9]|[0][0-9]|[1][0-2]):([0-5][0-9])\s([Aa][Mm]|[Pp][Mm]))$/;
		return [(value.match(p)),'Invalid Time Format'];
		
		  
	},	
	isValidDate:function(value){
		var p = /^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/;
		var isvalid =  p.test(value);
		if(isValid){ 
				var parts = value.split("-");

				if( (parts[1] == "02") && (parts[2] == "30" || parts[2] == "31")){
					
					isValid = false;
				}				
				else if( (parts[1] == "04" || parts[1] == "06" || parts[1] == "09" || parts[1] == "11") && (parts[2] == "31")){
					
					isValid = false;
				}
                
				
        }
		
		   return [isValid,'Invalid Date Format'];
		  
	}
}

var grid_pages = {
	max_page_view:0,
	total_records:0,
	total_pages:0,
	records_per_page:0,
	paginationid:'',
	next_grid_page:function(){
		$('#'+this.paginationid+' li.active').next(".page_button").find( "a" ).trigger('click');
		//alert($('#'+paginationid+' li.active').next(".page_button").length);
	},
	prev_grid_page:function(){
		$('#'+this.paginationid+' li.active').prev(".page_button").find( "a" ).trigger('click');
		//alert($('#'+paginationid+' li.active').prev(".page_button").length);
	},
	go_to:function(page_tag){
		
		var page_navs = $('#'+this.paginationid+' li.page_button');
		$(page_navs).removeClass('active');
		$(page_tag).parents('#'+this.paginationid+' li').addClass("active");
		var start_index = $(page_navs).index($(page_tag).parents('li.active')[0]);
		if(this.total_pages > this.max_page_view){
			var half_max_view = Math.floor(this.max_page_view / 2)
			
			if(((start_index + half_max_view) >= this.total_pages)){
				
				$(page_navs).slice((this.total_pages - this.max_page_view -1),this.total_pages).show();
				$(page_navs).slice(0,(this.total_pages - this.max_page_view - 1)).hide();	
				
			}
			else if((start_index - half_max_view) > 0){
				
				$(page_navs).slice((start_index - half_max_view), (start_index + half_max_view)).show();
				$(page_navs).slice(0,(start_index - half_max_view)).hide();
				$(page_navs).slice((start_index + half_max_view)).hide();
			}
			else{
				$(page_navs).slice(0, this.max_page_view).show();
				
				$(page_navs).slice((this.max_page_view + 1)).hide();
			}
			
			
		}
		var n = start_index  * this.records_per_page ;
		var p_rec_start = n + 1 ;
		var p_rec_end =  (n ) + ( n + this.records_per_page <= this.total_records ? this.records_per_page : this.total_records - n );
		var records_in_view = "Showing Records " + p_rec_start + " to " + p_rec_end + " of " + this.total_records;
		$("#records_in_view").html(records_in_view);
		
	},
	initialize_pages_nav:function(page_tag){
		this.total_pages = Math.ceil(this.total_records / this.records_per_page);
		//alert(this.total_pages);
		if(typeof(page_tag) == 'undefined'){	
			$('#'+this.paginationid+' li.page_button').hide().slice(0, this.max_page_view + 1).show();
		}
		else{this.go_to(page_tag);}
	}
}

function register_character_count(elem,size,notification_label){
	
	$(elem).focus(function(){
		var chars = $(elem).val().length;
		
		//if(chars > size){
		//	$(elem).val($(elem).val().substr(0,size));
		//	chars = size;
		//}
		var msgs = ((chars / size) | 0) + 1;
		$(notification_label).html(chars+ " /" + msgs );
	});
	
	$(elem).keyup(function(){
		var chars = $(elem).val().length;
		
		//if(chars > size){
		//	$(elem).val($(elem).val().substr(0,size));
		//	chars = size;
		//}
		var msgs = ((chars / size) | 0) + 1;
		$(notification_label).html(chars+ " /" + msgs );
	});
	
}


function update_email_acct_params(etype){
	if(etype == "smtp.gmail.com"){
		$("form#email_acct_form input[name='e_host']").val("smtp.gmail.com");
		$("form#email_acct_form input[name='e_port']").val("465");
		$("form#email_acct_form input[name='e_secure']").prop('checked',true);
		$("form#email_acct_form input[name='e_ty']").val('1');
	
	}	
	else if(etype == "smtp.mail.yahoo.com"){
		$("form#email_acct_form input[name='e_host']").val("smtp.mail.yahoo.com");
		$("form#email_acct_form input[name='e_port']").val("465");
		$("form#email_acct_form input[name='e_secure']").prop('checked',true);
		$("form#email_acct_form input[name='e_ty']").val('2');
	
	}	
	else if(etype == "plus.smtp.mail.yahoo.com"){
		$("form#email_acct_form input[name='e_host']").val("plus.smtp.mail.yahoo.com");
		$("form#email_acct_form input[name='e_port']").val("465");
		$("form#email_acct_form input[name='e_secure']").prop('checked',true);
		$("form#email_acct_form input[name='e_ty']").val('3');
	
	}
	else if(etype == "smtp.live.com"){
		$("form#email_acct_form input[name='e_host']").val("smtp.live.com");
		$("form#email_acct_form input[name='e_port']").val("587");
		$("form#email_acct_form input[name='e_secure']").prop('checked',true);
		$("form#email_acct_form input[name='e_ty']").val('4');
	
	}
	else if(etype == "custom"){
		$("form#email_acct_form input[name='e_host']").val("");
		$("form#email_acct_form input[name='e_port']").val("");
		$("form#email_acct_form input[name='e_secure']").prop('checked',false);
		$("form#email_acct_form input[name='e_ty']").val('5');
	
	}
	$("form#email_acct_form input[name='e_host']").trigger('change.validate');
	$("form#email_acct_form input[name='e_port']").trigger('change.validate');
	$("form#email_acct_form input[name='e_secure']").trigger('change.validate');

}

function load_gateway_acct(gid){
	if(gid == 0){$("#gwt_setup").html(""); return;}
	var g_name = $("select#sms_gateway option#rec_"+gid).attr("rel");
	var url = "gws/"+g_name + "_edit.jsp";
	show_waiting();
	$.post(url,{gwt_id:gid},function(responseText){
		hide_waiting();
			$("#gwt_setup").html(responseText).fadeIn("slow");		
			
						
	},'html'); 
}
function load_message_template(mid){
	if(mid == 0){
		arr['msg_body'].set_content("");
		$('input#subject').val("");
		return;
	}
	var m_name = $("select#message_template option#rec_"+mid).text();
	//var m_body = $("select#message_template option#rec_"+mid).attr("rel");
	var m_body = $("span#msg_template"+mid).html();
	//alert(m_body);
	arr['msg_body'].set_content(m_body);
	$('input#subject').val(m_name);
}
function load_message_template2(mid){
	if(mid == 0){
		//arr['msg_body'].set_content("");
		$('input#sender').val("");
		$('textarea#msg_body').val("");
		return;
	}
	var m_name = $("select#message_template option#rec_"+mid).text();
	//var m_body = $("select#message_template option#rec_"+mid).attr("rel");
	var m_body = $("span#msg_template"+mid).html();
	//alert(m_body);
	$('textarea#msg_body').val(m_body);
	//$('input#sender').val(m_name);
}

var colors = ["#fff","#3182bd","#6baed6","#9ecae1","#c6dbef","#e6550d","#fd8d3c","#fdae6b","#fdd0a2","#31a354","#74c476","#a1d99b","#c7e9c0","#756bb1","#9e9ac8","#bcbddc","#dadaeb","#636363","#969696","#bdbdbd","#d9d9d9"];
var	color_depth = [-.1, -.05, 0];
function sunburst(c_id,width,height,data){
	this.coloralternative = 0;
	this.width = width;
    this.height = this.width;
    this.radius = this.width / 2;
    this.x = d3.scale.linear().range([0, 2 * Math.PI]);
    this.y = d3.scale.pow().exponent(1.3).domain([0, 1]).range([0, this.radius]);
    this.padding = 5;
    this.duration = 1000;
	this.data = data;
	var s_instance = this;
	
	this.colour = function(a) {
		/*if (d.children) {
			// There is a maximum of two children!
			var colours = d.children.map(colour),
			a = d3.hsl(colours[0]),
			b = d3.hsl(colours[1]);
			// L*a*b* might be better here...
			return d3.hsl((a.h + b.h) / 2, a.s * 1.2, a.l / 1.2);
			}
		return d.colour || "#fff";*/
		
		
        var e = colors[ s_instance.coloralternative % 20];
		a.color = e;
		
        return s_instance.coloralternative++, e
		
	}

	this.click = function(d) {
		s_instance.path.transition()
		.duration(s_instance.duration)
		.attrTween("d", s_instance.arcTween(d));
		
		// Somewhat of a hack as we rely on arcTween updating the scales.
		s_instance.text.style("visibility", function(e) {
			return isParentOf(d, e) ? null : d3.select(this).style("visibility");
        })
		.transition()
        .duration(s_instance.duration)
        .attrTween("text-anchor", function(d) {
			return function() {
				return s_instance.x(d.x + d.dx / 2) > Math.PI ? "end" : "start";
			};
        })
        .attrTween("transform", function(d) {
			var multiline = (d.name || "").split(" ").length > 1;
			return function() {
				var angle = s_instance.x(d.x + d.dx / 2) * 180 / Math.PI - 90,
                rotate = angle + (multiline ? -.5 : 0);
				return "rotate(" + rotate + ")translate(" + (s_instance.y(d.y) + s_instance.padding) + ")rotate(" + (angle > 90 ? -180 : 0) + ")";
			};
        })
        .style("fill-opacity", function(e) { return isParentOf(d, e) ? 1 : 1e-6; })
        .each("end", function(e) {
			d3.select(this).style("visibility", isParentOf(d, e) ? null : "hidden");
        });
	}
	
	this.arcTween = function(d) {
		var my = maxY(d),
		xd = d3.interpolate(s_instance.x.domain(), [d.x, d.x + d.dx]),
		yd = d3.interpolate(s_instance.y.domain(), [d.y, my]),
		yr = d3.interpolate(s_instance.y.range(), [d.y ? 20 : 0, s_instance.radius]);
		return function(d) {
			return function(t) { s_instance.x.domain(xd(t)); s_instance.y.domain(yd(t)).range(yr(t)); return s_instance.arc(d); };
		};
	}

	this.div = d3.select("#"+c_id);

	this.div.select("img").remove();

    this.vis = this.div.append("svg")
    .attr("width", this.width + this.padding * 2)
    .attr("height", this.height + this.padding * 2)
	.append("g")
    .attr("transform", "translate(" + [this.radius + this.padding, this.radius + this.padding] + ")");

	this.div.append("p")
    .attr("id", "intro")
    .text("Click to zoom!");

	this.partition = d3.layout.partition()
    .sort(null)
    .value(function(d) { return d.depth  == 3 ? d.size + 4 : 5});

	this.arc = d3.svg.arc()
    .startAngle(function(d) { return Math.max(0, Math.min(2 * Math.PI, s_instance.x(d.x))); })
    .endAngle(function(d) { return Math.max(0, Math.min(2 * Math.PI, s_instance.x(d.x + d.dx))); })
    .innerRadius(function(d) { return Math.max(0, d.y ? s_instance.y(d.y) : d.y); })
    .outerRadius(function(d) { return Math.max(0, s_instance.y(d.y + d.dy)); });


   this.nodes = this.partition.nodes({children: this.data});

   this.path = this.vis.selectAll("path").data(this.nodes);
   this.path.enter().append("path")
      .attr("id", function(d, i) { return "path-" + i; })
      .attr("d", this.arc)
      .attr("fill-rule", "evenodd")
      .style("fill", this.colour)
      .style("stroke", colour_stroke)
      .on("click", this.click);

   this.text = this.vis.selectAll("text").data(this.nodes);
   this.textEnter = this.text.enter().append("text")
      .style("fill-opacity", 1)
      .style("fill", function(d) {
        return brightness(d3.rgb(d.color)) < 125 ? "#eee" : "#000";
      })
      .attr("text-anchor", function(d) {
        return s_instance.x(d.x + d.dx / 2) > Math.PI ? "end" : "start";
      })
      .attr("dy", ".2em")
      .attr("transform", function(d) {
        var multiline = (d.name || "").split(" ").length > 1,
            angle = s_instance.x(d.x + d.dx / 2) * 180 / Math.PI - 90,
            rotate = angle + (multiline ? -.5 : 0);
			//alert(s_instance.y(d.y));
        return "rotate(" + rotate + ")translate(" + (s_instance.y(d.y) + s_instance.padding) + ")rotate(" + (angle > 90 ? -180 : 0) + ")";
      })
      .on("click", this.click);
  this.textEnter.append("tspan")
      .attr("x", 0)
      .text(function(d) { return d.depth ? d.name.split(" ")[0] : ""; });
  this.textEnter.append("tspan")
      .attr("x", 0)
      .attr("dy", "1em")
      .text(function(d) { return d.depth ? d.name.split(" ")[1] || "" : ""; });
  this.textEnter.append("tspan")
      .attr("x", 0)
      .attr("dy", "1em")
      .text(function(d) { return d.depth ? d.size || "" : ""; });



}
function isParentOf(p, c) {
  if (p === c) return true;
  if (p.children) {
    return p.children.some(function(d) {
      return isParentOf(d, c);
    });
  }
  return false;
}


function colour_stroke(d){
	//return (d.children ? d : d.parent).color
	
}

// Interpolate the scales!


function maxY(d) {
  return d.children ? Math.max.apply(Math, d.children.map(maxY)) : d.y + d.dy;
}

function brightness(rgb) {
  return rgb.r * .299 + rgb.g * .587 + rgb.b * .114;
}


function initFullFormAjaxUpload() {

  var form = document.getElementById('form-id');
  form.onsubmit = function() {
    // FormData receives the whole form
    var formData = new FormData(form);

    // We send the data where the form wanted
    var action = form.getAttribute('action');

    // Code common to both variants
    sendXHRequest(formData, action);

    // Avoid normal form submission
    return false;
  }
}

// Once the FormData instance is ready and we know
// where to send the data, the code is the same
// for both variants of this technique
function sendXHRequest(formData, uri) {
  // Get an XMLHttpRequest instance
    var file = document.getElementById('imgfile');
  if(""==file.value){
		ajax_error("Please Select a file to upload ");
		return;
  }
  if(file.files[0].size > 1024 * 1024){
		ajax_error("This file is too large. Maximum size allowed is 1MB ");
		return;
  }
  
  
  var xhr = new XMLHttpRequest();

  // Set up events
  xhr.upload.addEventListener('loadstart', onloadstartHandler, false);
  xhr.upload.addEventListener('progress', onprogressHandler, false);
  xhr.upload.addEventListener('load', onloadHandler, false);
  xhr.upload.addEventListener('error', onerrorHandler, false);
  xhr.upload.addEventListener('abort', onabortHandler, false);
  xhr.addEventListener('readystatechange', onreadystatechangeHandler, false);
	//alert(uri);
  // Set up request
  xhr.open('POST', uri, true);

  // Fire!
  xhr.send(formData);
}

// Handle the start of the transmission
function onloadstartHandler(evt) {
  var div = document.getElementById('upload-status');
  div.innerHTML = 'Upload started!';
}

// Handle the end of the transmission
function onloadHandler(evt) {
  var div = document.getElementById('upload-status');
  div.innerHTML = 'Upload successful!';
}
function onabortHandler(evt) {
  var div = document.getElementById('upload-status');
  div.innerHTML = 'Upload cancelled!';
}
function onerrorHandler(evt) {
  var div = document.getElementById('upload-status');
  div.innerHTML = evt.target.responseText;
}

// Handle the progress
function onprogressHandler(evt) {
  var div = document.getElementById('progress');
  var percent = evt.loaded/evt.total*100;
  div.innerHTML = 'Progress: ' + percent + '%';
}

// Handle the response from the server
function onreadystatechangeHandler(evt) {
	//alert("called");
  try {
    
	$('#result').html(evt.target.responseText);
    
  }
  catch(e) {
    return;
  }
}
function change_picture(url,id){
		var d = new Date();
		var p = document.getElementById(id);
		url = url + "?"+ d.getTime();
		p.src = url;
$("#pic_uload").remove();		
		
}

function supportAjaxUploadWithProgress() {
  return supportFileAPI() && supportAjaxUploadProgressEvents() && supportFormData();

  // Is the File API supported?
  function supportFileAPI() {
    var fi = document.createElement('INPUT');
    fi.type = 'file';
    return 'files' in fi;
  };

  // Are progress events supported?
  function supportAjaxUploadProgressEvents() {
    var xhr = new XMLHttpRequest();
    return !! (xhr && ('upload' in xhr) && ('onprogress' in xhr.upload));
  };

  // Is FormData supported?
  function supportFormData() {
    return !! window.FormData;
  }
}

var com_seetings = {
	mems:''
}

function update_com_settings(ids){
	com_seetings.mems = ids;

}

function schedule_message(phones){
    if(wb_connected == false){
        wb = Web_Socket;
		var phns = phones
        wb.initialize(function(){
			schedule_message(phns)
		});
       
    }
    else {
		var person = 'person';
		if(com_seetings.mems != '') {person = com_seetings.mems}  
		
		var tt = $("#n_type").val();
		if(tt == 'email'){schedule_email('',phones);return;}
		
		var msg_bd = $("#msg_body").html();
		if(msg_bd == ""){ msg_bd = $("#msg_body").val();}
		if( msg_bd == "" || !(validate_value.stripWhitespace(msg_bd)[0]) )  {
             ajax_error("Please provide body of the message");
             return;
        }
		
		var date  = $("input[name='delay_time']").val();		        
        if(date == "") {
             ajax_error("Please provide delivery date/time");
             return;
        }
		
		if(typeof(phones) == 'undefined' || phones == "") {
			phones = "";
			$("[rel='"+person+"']").each(function(){
					
                    if($(this).prop('checked') & $(this).val() != ''){
                        phones += $(this).val() + ",";
                    }      
			});
		 }
		if(phones == "") {
             ajax_error("Cannot send message to empty address list");
             return;
        }

       // alert(phones);
	   var sender = $("#sender").val();
        show_waiting();
         
            
              var url = "ScheduleNotification.jsp";
             $.post(url,{msg:msg_bd,from:sender,to:phones,type:'sms',s_date:date},function(response){
               hide_waiting();
                var ms = response.toString().split(";");
                if(ms[0] == "OK"){
						notify_success(ms[1]);
						//close_modal_dialog();
						$("[rel='"+person+"']").prop('checked',false); 
						$("#"+person+"_selectall").prop('checked',false); 
						$("[rel='"+person+"_selectall']").prop('checked',false); 
						
					
				}
				else{ajax_error(ms[1]);}
             
            },"html");
        
    }
}
function schedule_email(message,emails){
    if(wb_connected == false){
        wb = Web_Socket;
		var ems = emails;
		var msg = message;
        wb.initialize(function(){
			schedule_email(msg,ems);
		});
       
    }
    else {
     var person = 'person';
		if(com_seetings.mems != '') {person = com_seetings.mems}  
		if(typeof(emails) == 'undefined' || emails == '') {
			emails = "";
			$("[rel='"+person+"']").each(function(){
					
                    if($(this).prop('checked') & $(this).prop('title') != ''){
                        emails += $(this).prop('title') + ",";
                    }      
			});
		 }
		 var msg_tt = $("#subject").val();
		 if(typeof(msg_tt) == 'undefined'){ msg_tt = $("#msg_title").html();}
         var msg_bd = message;
		 if(typeof(msg_bd) == 'undefined' || msg_bd == ""){ msg_bd = $("#msg_body").html();}
         //alert(msg_bd);		        
		 var date  = $("input[name='delay_time']").val();
        if(date == "") {
             ajax_error("Please provide the delivery time/date");
             return;
        }
		if(emails == "") {
             ajax_error("Cannot send email to empty address list");
             return;
        }        
		if( msg_tt == "" || !(validate_value.stripWhitespace(msg_tt)[0]) ){
             ajax_error("Please provide title of the message");
             return;
        }        
		if( msg_bd == "" || !(validate_value.stripWhitespace($("<div>"+msg_bd+"</div>").text())[0]) ) {
             ajax_error("Please provide body of the message");
             return;
        } 
		var formData = new FormData();
				formData.append("msg",msg_bd);
				formData.append("sbj",msg_tt);
				formData.append("to",emails);
				formData.append("type",'email');
				formData.append("s_date",date);
				$('#form-id input[type=file]').each(function(index){
					formData.append("attachment"+index,$(this)[0].files[0]);      
				})
				
			show_waiting();
				 var url = "ScheduleNotification.jsp";
				$.ajax({
				url: url,
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response){
               
					hide_waiting();
					var ms = response.toString().split(";");
					if(ms[0] == "OK"){
						notify_success(ms[1]);
						//close_modal_dialog();
						$("[rel='"+person+"']").prop('checked',false); 
						$("#"+person+"_selectall").prop('checked',false); 
						$("[rel='"+person+"_selectall']").prop('checked',false); 
						
					
					}
					else{ajax_error(ms[1]);}
					
				 
				}
			  })		
         

        
    }
}

function send_message(phones){
		var tt = $("#n_type").val();
		if(tt == 'email'){send_email('',phones);return;}
		
		var person = 'person';
		if(com_seetings.mems != '') {person = com_seetings.mems} 
		
		var msg_bd = $("#msg_body").html();
		if(msg_bd == ""){ msg_bd = $("#msg_body").val();}
		if( msg_bd == "" || !(validate_value.stripWhitespace(msg_bd)[0]) )  {
             ajax_error("Please provide body of the message");
             return;
        }
		
		if(typeof(phones) == 'undefined' || phones == '') {
			phones = "";
			$("[rel='"+person+"']").each(function(){
					
                    if($(this).prop('checked') & $(this).val() != ''){
                        phones += $(this).val() + ",";
                    }      
			});
		 }
		
        if(phones == "") {
             ajax_error("Cannot send message to empty address list");
             return;
        }         
        var sender = $("#sender").val();
      //alert(phones);
	  //var msg_tt = $("#msg_title").html();
        show_waiting();
         
            
              var url = "SendNotification.jsp";
             $.post(url,{msg:msg_bd,from:sender,to:phones,type:'sms'},function(response){
               hide_waiting();
                var ms = response.toString().split(";");
               if(ms[0] == "OK"){
						notify_success(ms[1]);
						//close_modal_dialog();
						$("[rel='"+person+"']").prop('checked',false); 
						$("#"+person+"_selectall").prop('checked',false); 
						$("[rel='"+person+"_selectall']").prop('checked',false); 
						
					
				}
				else{ajax_error(ms[1]);}
             
            },"html");
        
}
function send_email(msg_bd,emails){
		var person = 'person';
		if(com_seetings.mems != '') {person = com_seetings.mems} 
		
		 var msg_tt = $("#subject").val();
		 if(typeof(msg_tt) == 'undefined'){ msg_tt = $("#msg_title").html();}         
		 
		 if(typeof(msg_bd) == 'undefined' || msg_bd == ""){ msg_bd = $("#msg_body").html();}
         //alert(msg_bd);
		if( msg_tt == "" || !(validate_value.stripWhitespace(msg_tt)[0]) ){
             ajax_error("Please provide title of the message");
             return;
        }        
		if( msg_bd == "" || !(validate_value.stripWhitespace($("<div>"+msg_bd+"</div>").text())[0]) ) {
             ajax_error("Please provide body of the message");
             return;
        }
		if(typeof(emails) == 'undefined' || emails == '') {
			emails = "";
			$("[rel='"+person+"']").each(function(){
					
                    if($(this).prop('checked') & $(this).prop('title') != ''){
                        emails += $(this).prop('title') + ",";
                    }      
			});
		 }
        if(emails == "") {
             ajax_error("Cannot send email to empty address list");
             return;
        }        
		
        //alert(emails);
        //alert(msg_tt);
        show_waiting();
			
				var formData = new FormData();
				formData.append("msg",msg_bd);
				formData.append("sbj",msg_tt);
				formData.append("to",emails);
				formData.append("type",'email');
				$('#form-id input[type=file]').each(function(index){
					formData.append("attachment"+index,$(this)[0].files[0]);      
				})
				
				var url = "SendNotification.jsp";
				$.ajax({
				url: url,
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response){
               
					hide_waiting();
					var ms = response.toString().split(";");
					if(ms[0] == "OK"){
						notify_success(ms[1]);
						//close_modal_dialog();
						$("[rel='"+person+"']").prop('checked',false); 
						$("#"+person+"_selectall").prop('checked',false); 
						$("[rel='"+person+"_selectall']").prop('checked',false); 
						
					
					}
					else{ajax_error(ms[1]);}
				 
				}
			  });
				
            
              
            // $.post(url,{msg:msg_bd,sbj:msg_tt,to:emails,type:'email'},,"html"); 
			return false;
        
}

/* function update_status(param,status,url,callback,title){
		var act = status;
		
		if(act == 2){
			if(confirm("Are you sure you want to delete "+title+"?\n Pres Ok to delete")){
				$.post(url,param,callback,"html");
			}	
		}
		else{
			$.post("billing/update_billable_service_status.jsp",param,load_billable_services,"html");
		}
        
} */

function print_section(elem){
		var section_to_print = $(elem).parents("section");
		/* var other_sections = $("section").not(section_to_print);
		var other_columns = section_to_print.parents("div[class|=col]").siblings("div[class|=col]");
		alert(other_columns.length);
		other_sections.addClass("no_print");
		other_columns.addClass("no_print");
		window.print();
		other_sections.removeClass("no_print");
		other_columns.removeClass("no_print"); */
		$("div.print_block").html(section_to_print.html());
		$("#main").addClass("no_print");
		window.print();
		$("#main").removeClass("no_print");
		$("div.print_block").html("");
}

function show_edit_form(link){
		var tr = $(link).parents("tr");
		tr.addClass("hidden");
		var t_next = tr.next("tr.hidden");
		$("input.form-control",t_next).addClass("required");
		t_next.removeClass("hidden").addClass("dirty");
		//edit_count++;
		//alert(tr.siblings(".dirty").length);
		if(tr.siblings(".dirty").length == 1){
			$("tr.save_bt_row", tr.parents("table")).removeClass("hidden");
			$("tr.total", tr.parents("table")).addClass("hidden");
		}
		
}	
function hide_edit_form(link){
		var tr = $(link).parents("tr");
		tr.addClass("hidden").removeClass("dirty");;
		t_prev = tr.prev("tr.hidden");
		t_prev.removeClass("hidden");
		$("input.form-control",tr).each(function(){
			$(this).removeClass("required");
			this.value = "";
		});
		
		//edit_count--;
		if(tr.siblings(".dirty").length == 0){
			$("tr.total", tr.parents("table")).removeClass("hidden");
			$("tr.save_bt_row", tr.parents("table")).addClass("hidden");
		}
		var fm = tr.parents("form").get(0);
			fm.clear_init_elems(fm,true);
}
function strike_out(link){
		var tr = $(link).parents("tr");
		var t_next = tr.next("tr.hidden");
		if(tr.hasClass("strikeout")){
			tr.removeClass("strikeout text-danger");			
			$("i[class^='ti-']",$(link).prev("a")).show();
			t_next.data("action",t_next.data("oldAction"));
			//edit_count--;
			//alert(edit_count);
			t_next.removeClass("dirty");
			if(tr.siblings(".dirty").length == 0){
				$("tr.total", tr.parents("table")).removeClass("hidden");
				$("tr.save_bt_row", tr.parents("table")).addClass("hidden");
			}
			
		}
		else{
			var warning = $("input[name='strike_out_warning']",$(link).parents("form")).val();
			if(confirm(warning)){
				tr.addClass("strikeout text-danger");
				$("i",tr.prev("a")).hide();
				$("i[class^='ti-']",$(link).prev("a")).hide();
				//t_next.oldAction = t_next.data("action");
				t_next.data("oldAction",t_next.data("action"));
				t_next.data("action","remove");
				t_next.addClass("dirty");
				//edit_count++;
				if(tr.siblings(".dirty").length == 1){
					
					$("tr.save_bt_row", tr.parents("table")).removeClass("hidden");
					$("tr.total", tr.parents("table")).addClass("hidden");
				}
			}
			
			
		}
			
}

var calendarView = {
	year:0,
	month_days:[31,28,31,30,31,30,31,31,30,31,30,31],	
	month_names:["January","February","March","April","May","June","July","August","September","October","November","December"],	
	weekDay:["Sun","Mon","Tues","Wed","Thu","Fri","Sat"],
	setYear:function(y){
		this.year = y;
		this.month_days[1] = this.year % 4 == 0 ? 29 : 28;
	},
	leapYear:function(year) {
		if (year % 4 == 0) 	return true 
		return false 
	},
	getTime:function() {
		// initialize time-related variables with current time settings
		var now = new Date()
		var hour = now.getHours()
		var minute = now.getMinutes()
		now = null
		var ampm = "" 
		// validate hour values and set value of ampm
		if (hour >= 12) {
		hour -= 12
		ampm = "PM"
		} else
		ampm = "AM"
		hour = (hour == 0) ? 12 : hour
		// add zero day to a one day minute
		if (minute < 10)
		minute = "0" + minute // do not parse this number!
		// return time string
		return hour + ":" + minute + " " + ampm
	},
	getDays:function(month, year) {
		return this.month_days[month]
	},
	getMonthName:function(month) {
		return this.month_names[month]
	},
	setCal:function(month, year,marked,hilite,container) {
		//alert(month + " : " + year + " : " + marked + " : " + hilite + " : " + container);
		if(!(marked instanceof Array) || !(hilite instanceof Array)){
			alert("invalid argument provided, expect an array");
			return;
		}
		var now = new Date();
		if(typeof year == "undefined"){
			this.setYear(now.getYear());
			if (this.year < 1000) this.year += 1900;
		}
		else{
			this.setYear(year);
		}
		if(typeof month == "undefined"){			
			month = now.getMonth();
		}
		else{
			month--;
		}
		var monthName = this.month_names[month];
		var date = now.getDate();
		var firstDayInstance = new Date(this.year, month, 1);
		var firstDay = firstDayInstance.getDay();
		var days = this.month_days[month];
		this.drawCal(firstDay + 1, days, date, monthName, this.year, marked, hilite, container);
	},
	drawCal:function(firstDay, lastDate, date, monthName, year, marked, hilite, container_id) {
		var text = "" ;	
		text += '<TABLE class="table table-bordered responsive no-m ">' ;
		text += '<TH COLSPAN=7 >' ;
		text += '<span class="text-info">' + monthName + ' ' + year + '</span>' ;
		text += '</TH>' ;
		var openCol = '<TD class="text-info">';
		var closeCol = '</TD>';
		text += '<TR>'
		for(var dayNum = 0; dayNum < 7; ++dayNum) {
			text += openCol + this.weekDay[dayNum] + closeCol 
		}
		text += '</TR>'
		var day = 1
		var curCell = 1
		var weeks = Math.ceil((lastDate + firstDay - 1) / 7);
		for (var row = 1; row <= weeks; ++row) {
			text += '<TR>'
			for (var col = 1; col <= 7; ++col) {
				if (day > lastDate){
					while(col <= 7){
						text += '<TD class=""></TD>';
						++col
					}
					break;
				}					
				if (curCell < firstDay) {
					text += '<TD class=""></TD>';
					curCell++
				} 
				else {
					if (hilite.indexOf(day) > -1) { 
						text += '<TD class="success"> ' +  day + '</TD>';
					} 					
					else if (marked.indexOf(day) > -1 ) { 
						text += '<TD class="warning"> ' +  day + '</TD>';
					} 
					else{
						text += '<TD >' + day + '</TD>';
					}				
					day++;
				}
			}
			text += '</TR>'
		}
		text += '</TABLE>'
		
		var container = $("#"+container_id), table = $(text);
		container.append(table);
	}
};