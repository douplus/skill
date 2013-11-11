/*! jQuery slabtext plugin v2.1 MIT/GPL2 @freqdec */
;(function($){$.fn.slabText=function(options){var settings={fontRatio:0.78,forceNewCharCount:true,wrapAmpersand:true,headerBreakpoint:null,viewportBreakpoint:null,noResizeEvent:false,resizeThrottleTime:300,maxFontSize:999,postTweak:true,precision:3};$("body").addClass("slabtexted");return this.each(function(){if(options){$.extend(settings,options);}var $this=$(this),keepSpans=$("span.slabtext",$this).length,words=keepSpans?[]:String($.trim($this.text())).replace(/\s{2,}/g," ").split(" "),origFontSize=null,idealCharPerLine=null,fontRatio=settings.fontRatio,forceNewCharCount=settings.forceNewCharCount,headerBreakpoint=settings.headerBreakpoint,viewportBreakpoint=settings.viewportBreakpoint,postTweak=settings.postTweak,precision=settings.precision,resizeThrottleTime=settings.resizeThrottleTime,resizeThrottle=null,viewportWidth=$(window).width(),headLink=$this.find("a:first").attr("href")||$this.attr("href"),linkTitle=headLink?$this.find("a:first").attr("title"):"";var grabPixelFontSize=function(){var dummy=jQuery('<div style="display:none;font-size:1em;margin:0;padding:0;height:auto;line-height:1;border:0;">&nbsp;</div>').appendTo($this),emH=dummy.height();dummy.remove();return emH;};var resizeSlabs=function resizeSlabs(){var parentWidth=$this.width(),fs;$this.removeClass("slabtextdone slabtextinactive");if(viewportBreakpoint&&viewportBreakpoint>viewportWidth||headerBreakpoint&&headerBreakpoint>parentWidth){$this.addClass("slabtextinactive");return;}fs=grabPixelFontSize();if(!keepSpans&&(forceNewCharCount||fs!=origFontSize)){origFontSize=fs;var newCharPerLine=Math.min(60,Math.floor(parentWidth/(origFontSize*fontRatio))),wordIndex=0,lineText=[],counter=0,preText="",postText="",finalText="",preDiff,postDiff;if(newCharPerLine!=idealCharPerLine){idealCharPerLine=newCharPerLine;while(wordIndex<words.length){postText="";while(postText.length<idealCharPerLine){preText=postText;postText+=words[wordIndex]+" ";if(++wordIndex>=words.length){break;}}preDiff=idealCharPerLine-preText.length;postDiff=postText.length-idealCharPerLine;if((preDiff<postDiff)&&(preText.length>2)){finalText=preText;wordIndex--;}else{finalText=postText;}lineText.push('<span class="slabtext">'+$.trim(settings.wrapAmpersand?finalText.replace("&",'<span class="amp">&amp;</span>'):finalText)+"</span>");}$this.html(lineText.join(" "));if(headLink){$this.wrapInner('<a href="'+headLink+'" '+(linkTitle?'title="'+linkTitle+'" ':"")+"/>");}}}else{origFontSize=fs;}$("span.slabtext",$this).each(function(){var $span=$(this),innerText=$span.text(),wordSpacing=innerText.split(" ").length>1,diff,ratio,fontSize;if(postTweak){$span.css({"word-spacing":0,"letter-spacing":0});}ratio=parentWidth/$span.width();fontSize=parseFloat(this.style.fontSize)||origFontSize;$span.css("font-size",Math.min((fontSize*ratio).toFixed(precision),settings.maxFontSize)+"px");diff=!!postTweak?parentWidth-$span.width():false;if(diff){$span.css((wordSpacing?"word":"letter")+"-spacing",(diff/(wordSpacing?innerText.split(" ").length-1:innerText.length)).toFixed(precision)+"px");}});$this.addClass("slabtextdone");};resizeSlabs();if(!settings.noResizeEvent){$(window).resize(function(){if($(window).width()==viewportWidth){return;}viewportWidth=$(window).width();clearTimeout(resizeThrottle);resizeThrottle=setTimeout(resizeSlabs,resizeThrottleTime);});}});};})(jQuery);
/**
 * Copyright (c) 2007-2012 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * @author Ariel Flesler
 * @version 1.4.3
 */
;(function($){var h=$.scrollTo=function(a,b,c){$(window).scrollTo(a,b,c)};h.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:true};h.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(e,f,g){if(typeof f=='object'){g=f;f=0}if(typeof g=='function')g={onAfter:g};if(e=='max')e=9e9;g=$.extend({},h.defaults,g);f=f||g.duration;g.queue=g.queue&&g.axis.length>1;if(g.queue)f/=2;g.offset=both(g.offset);g.over=both(g.over);return this._scrollable().each(function(){if(!e)return;var d=this,$elem=$(d),targ=e,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}$.each(g.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=h.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(g.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=g.offset[pos]||0;if(g.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*g.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(g.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&g.queue){if(old!=attr[key])animate(g.onAfterFirst);delete attr[key]}});animate(g.onAfter);function animate(a){$elem.animate(attr,f,g.easing,a&&function(){a.call(this,e,g)})}}).end()};h.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);
/**
 * jQuery.LocalScroll - Animated scrolling navigation, using anchors.
 * Copyright (c) 2007-2009 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 3/11/2009
 * @author Ariel Flesler
 * @version 1.2.7
 **/
;(function($){var l=location.href.replace(/#.*/,'');var g=$.localScroll=function(a){$('body').localScroll(a)};g.defaults={duration:1e3,axis:'y',event:'click',stop:true,target:window,reset:true};g.hash=function(a){if(location.hash){a=$.extend({},g.defaults,a);a.hash=false;if(a.reset){var e=a.duration;delete a.duration;$(a.target).scrollTo(0,a);a.duration=e}i(0,location,a)}};$.fn.localScroll=function(b){b=$.extend({},g.defaults,b);return b.lazy?this.bind(b.event,function(a){var e=$([a.target,a.target.parentNode]).filter(d)[0];if(e)i(a,e,b)}):this.find('a,area').filter(d).bind(b.event,function(a){i(a,this,b)}).end().end();function d(){return!!this.href&&!!this.hash&&this.href.replace(this.hash,'')==l&&(!b.filter||$(this).is(b.filter))}};function i(a,e,b){var d=e.hash.slice(1),f=document.getElementById(d)||document.getElementsByName(d)[0];if(!f)return;if(a)a.preventDefault();var h=$(b.target);if(b.lock&&h.is(':animated')||b.onBefore&&b.onBefore.call(b,a,f,h)===false)return;if(b.stop)h.stop(true);if(b.hash){var j=f.id==d?'id':'name',k=$('<a> </a>').attr(j,d).css({position:'absolute',top:$(window).scrollTop(),left:$(window).scrollLeft()});f[j]='';$('body').prepend(k);location=e.hash;k.remove();f[j]=d}h.scrollTo(f,b).trigger('notify.serialScroll',[f])}})(jQuery);
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright 憍 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/
;jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,f,a,h,g){return jQuery.easing[jQuery.easing.def](e,f,a,h,g)},easeInQuad:function(e,f,a,h,g){return h*(f/=g)*f+a},easeOutQuad:function(e,f,a,h,g){return -h*(f/=g)*(f-2)+a},easeInOutQuad:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f+a}return -h/2*((--f)*(f-2)-1)+a},easeInCubic:function(e,f,a,h,g){return h*(f/=g)*f*f+a},easeOutCubic:function(e,f,a,h,g){return h*((f=f/g-1)*f*f+1)+a},easeInOutCubic:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f+a}return h/2*((f-=2)*f*f+2)+a},easeInQuart:function(e,f,a,h,g){return h*(f/=g)*f*f*f+a},easeOutQuart:function(e,f,a,h,g){return -h*((f=f/g-1)*f*f*f-1)+a},easeInOutQuart:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f+a}return -h/2*((f-=2)*f*f*f-2)+a},easeInQuint:function(e,f,a,h,g){return h*(f/=g)*f*f*f*f+a},easeOutQuint:function(e,f,a,h,g){return h*((f=f/g-1)*f*f*f*f+1)+a},easeInOutQuint:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f*f+a}return h/2*((f-=2)*f*f*f*f+2)+a},easeInSine:function(e,f,a,h,g){return -h*Math.cos(f/g*(Math.PI/2))+h+a},easeOutSine:function(e,f,a,h,g){return h*Math.sin(f/g*(Math.PI/2))+a},easeInOutSine:function(e,f,a,h,g){return -h/2*(Math.cos(Math.PI*f/g)-1)+a},easeInExpo:function(e,f,a,h,g){return(f==0)?a:h*Math.pow(2,10*(f/g-1))+a},easeOutExpo:function(e,f,a,h,g){return(f==g)?a+h:h*(-Math.pow(2,-10*f/g)+1)+a},easeInOutExpo:function(e,f,a,h,g){if(f==0){return a}if(f==g){return a+h}if((f/=g/2)<1){return h/2*Math.pow(2,10*(f-1))+a}return h/2*(-Math.pow(2,-10*--f)+2)+a},easeInCirc:function(e,f,a,h,g){return -h*(Math.sqrt(1-(f/=g)*f)-1)+a},easeOutCirc:function(e,f,a,h,g){return h*Math.sqrt(1-(f=f/g-1)*f)+a},easeInOutCirc:function(e,f,a,h,g){if((f/=g/2)<1){return -h/2*(Math.sqrt(1-f*f)-1)+a}return h/2*(Math.sqrt(1-(f-=2)*f)+1)+a},easeInElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return -(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e},easeOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return g*Math.pow(2,-10*h)*Math.sin((h*k-i)*(2*Math.PI)/j)+l+e},easeInOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k/2)==2){return e+l}if(!j){j=k*(0.3*1.5)}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}if(h<1){return -0.5*(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e}return g*Math.pow(2,-10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j)*0.5+l+e},easeInBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*(f/=h)*f*((g+1)*f-g)+a},easeOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*((f=f/h-1)*f*((g+1)*f+g)+1)+a},easeInOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}if((f/=h/2)<1){return i/2*(f*f*(((g*=(1.525))+1)*f-g))+a}return i/2*((f-=2)*f*(((g*=(1.525))+1)*f+g)+2)+a},easeInBounce:function(e,f,a,h,g){return h-jQuery.easing.easeOutBounce(e,g-f,0,h,g)+a},easeOutBounce:function(e,f,a,h,g){if((f/=g)<(1/2.75)){return h*(7.5625*f*f)+a}else{if(f<(2/2.75)){return h*(7.5625*(f-=(1.5/2.75))*f+0.75)+a}else{if(f<(2.5/2.75)){return h*(7.5625*(f-=(2.25/2.75))*f+0.9375)+a}else{return h*(7.5625*(f-=(2.625/2.75))*f+0.984375)+a}}}},easeInOutBounce:function(e,f,a,h,g){if(f<g/2){return jQuery.easing.easeInBounce(e,f*2,0,h,g)*0.5+a}return jQuery.easing.easeOutBounce(e,f*2-g,0,h,g)*0.5+h*0.5+a}});
/*
 * jQuery One Page Nav Plugin
 * http://github.com/davist11/jQuery-One-Page-Nav
 *
 * Copyright (c) 2010 Trevor Davis (http://trevordavis.net)
 * Dual licensed under the MIT and GPL licenses.
 * Uses the same license as jQuery, see:
 * http://jquery.org/license
 *
 * @version 2.2.0
 *
 * Example usage:
 * $('#nav').onePageNav({
 *   currentClass: 'current',
 *   changeHash: false,
 *   scrollSpeed: 750
 * });
 */
;(function($, window, document, undefined){
	// our plugin constructor
	var OnePageNav = function(elem, options){
		this.elem = elem;
		this.$elem = $(elem);
		this.options = options;
		this.metadata = this.$elem.data('plugin-options');
		this.$nav = this.$elem.find('a');
		this.$win = $(window);
		this.sections = {};
		this.didScroll = false;
		this.$doc = $(document);
		this.docHeight = this.$doc.height();
	};
	// the plugin prototype
	OnePageNav.prototype = {
		defaults: {
			currentClass: 'current',
			changeHash: false,
			easing: 'swing',
			filter: '',
			scrollSpeed: 750,
			scrollOffset: 0,
			scrollThreshold: 0.5,
			begin: false,
			end: false,
			scrollChange: false
		},
		init: function() {
			var self = this;
			
			// Introduce defaults that can be extended either
			// globally or using an object literal.
			self.config = $.extend({}, self.defaults, self.options, self.metadata);
			
			//Filter any links out of the nav
			if(self.config.filter !== '') {
				self.$nav = self.$nav.filter(self.config.filter);
			}
			
			//Handle clicks on the nav
			self.$nav.on('click.onePageNav', $.proxy(self.handleClick, self));

			//Get the section positions
			self.getPositions();
			
			//Handle scroll changes
			self.bindInterval();
			
			//Update the positions on resize too
			self.$win.on('resize.onePageNav', $.proxy(self.getPositions, self));

			return this;
		},
		adjustNav: function(self, $parent) {
			self.$elem.find('.' + self.config.currentClass).removeClass(self.config.currentClass);
			$parent.addClass(self.config.currentClass);
		},
		bindInterval: function() {
			var self = this;
			var docHeight;
			self.$win.on('scroll.onePageNav', function() {
				self.didScroll = true;
			});	
			self.t = setInterval(function() {
				docHeight = self.$doc.height();
				
				//If it was scrolled
				if(self.didScroll) {
					self.didScroll = false;
					self.scrollChange();
				}
				
				//If the document height changes
				if(docHeight !== self.docHeight) {
					self.docHeight = docHeight;
					self.getPositions();
				}
			}, 250);
		},
		getHash: function($link) {
			return $link.attr('href').split('#')[1];
		},
		getPositions: function() {
			var self = this;
			var linkHref;
			var topPos;
			var $target;
			
			self.$nav.each(function() {
				linkHref = self.getHash($(this));
				$target = $('#' + linkHref);

				if($target.length) {
					topPos = $target.offset().top;
					self.sections[linkHref] = Math.round(topPos) - self.config.scrollOffset;
				}
			});
		},	
		getSection: function(windowPos) {
			var returnValue = null;
			var windowHeight = Math.round(this.$win.height() * this.config.scrollThreshold);

			for(var section in this.sections) {
				if((this.sections[section] - windowHeight) < windowPos) {
					returnValue = section;
				}
			}
			
			return returnValue;
		},
		handleClick: function(e) {
			var self = this;
			var $link = $(e.currentTarget);
			var $parent = $link.parent();
			var newLoc = '#' + self.getHash($link);		
			if(!$parent.hasClass(self.config.currentClass)) {
				//Start callback
				if(self.config.begin) {
					self.config.begin();
				}
				
				//Change the highlighted nav item
				self.adjustNav(self, $parent);
				
				//Removing the auto-adjust on scroll
				self.unbindInterval();
				
				//Scroll to the correct position
				$.scrollTo(newLoc, self.config.scrollSpeed, {
					axis: 'y',
					easing: self.config.easing,
					offset: {
						top: -self.config.scrollOffset
					},
					onAfter: function() {
						//Do we need to change the hash?
						if(self.config.changeHash) {
							window.location.hash = newLoc;
						}
						
						//Add the auto-adjust on scroll back in
						self.bindInterval();
						
						//End callback
						if(self.config.end) {
							self.config.end();
						}
					}
				});
			}
			e.preventDefault();
		},
		scrollChange: function() {
			var windowTop = this.$win.scrollTop();
			var position = this.getSection(windowTop);
			var $parent;
			
			//If the position is set
			if(position !== null) {
				$parent = this.$elem.find('a[href$="#' + position + '"]').parent();
				
				//If it's not already the current section
				if(!$parent.hasClass(this.config.currentClass)) {
					//Change the highlighted nav item
					this.adjustNav(this, $parent);
					
					//If there is a scrollChange callback
					if(this.config.scrollChange) {
						this.config.scrollChange($parent);
					}
				}
			}
		},	
		unbindInterval: function() {
			clearInterval(this.t);
			this.$win.unbind('scroll.onePageNav');
		}
	};
	OnePageNav.defaults = OnePageNav.prototype.defaults;
	$.fn.onePageNav = function(options) {
		return this.each(function() {
			new OnePageNav(this, options).init();
		});
	};
})( jQuery, window , document );
;(function($){
	$.fn.vAlign = function() {
		return this.each(function(i){
			var ah = $(this).height();
			var ph = $(this).parent().height();
			var mh = Math.ceil((ph-ah) / 2);
			$(this).css('padding-top', mh);
		});
	};
})(jQuery);
$(function(){
	function setHeight(){
		$('#home').css( 'height', $(window).height() );
		$('#home .vcenter').vAlign();
	}
	function setTopNav(){
		if( !window.matchMedia('(max-width: 767px)').matches ){  // 非 行動裝置
			$('#top-nav').removeAttr('style');
		}
	}
	setHeight();
	setTopNav();
	$(window).bind('resize',function(){
		setHeight();
		setTopNav();
	});
	$('#top-nav').onePageNav({
        currentClass: 'current',
        changeHash: false,
        scrollSpeed: 750,
        scrollOffset: 50,
        scrollThreshold: 0.5,
        filter: ':not(.external)',
        begin: function(){},
        end: function() {},
        scrollChange: function(){}
    });
	$('#nav-button').click(function(){
        $a = $('#top-nav');
        if( $a.is(':hidden') ){
            $a.slideDown('normal');
        }else{
            $a.slideUp();
        }
    });
	$('#sign-up_box_leave').click(function(){    // 離開註冊介面
		$('#sign-up_box').addClass('dom_hidden').children('section').addClass('dom_hidden');
		$('body').css( 'overflow', '');
	});
	$('#login_box_leave').click(function(){    // 離開登入介面
		$('#login_box').addClass('dom_hidden').children('section').addClass('dom_hidden');
		$('body').css( 'overflow', '');
	});
	$('#sign-up').click(function(){    // 點擊註冊按鈕
		document.getElementById('female').checked = true;
		document.getElementById('male').checked = false;
		document.getElementById('gender-one').checked = true;
		document.getElementById('gender-many').checked = false;
		$('body').css( 'overflow', 'hidden');
		$('#sign-up-summary').parent().addClass('dom_hidden');
		$('#sign-up-password').val('');
		$('#sign-up-password-again').val('');
		$('#sign-up_box').removeClass('dom_hidden').children('section').removeClass('dom_hidden');
	});
	$('#login').click(function(){    // 點擊登入按鈕
		$('body').css( 'overflow', 'hidden');
		$('#login-summary').parent().addClass('dom_hidden');
		$('#login-password').val('');
		if( $.cookie.get({ name: 'UserInfo' }) != null && localStorage.UserCV != null ){  // 已登入
			var obj = JSON.parse( localStorage.UserCV );
			$('#enter-summary > strong').text( obj.USERNAME );
			$('#enter-form').removeClass('dom_hidden');
			var a = JSON.stringify( { 'username': obj.USERNAME, 'userid': obj.USERID, 'email': obj.EMAIL } );
			$.cookie.set({ name: 'UserInfo', value: a, expires: '1', path: '/' });
			localStorage.setItem( 'UserInfo', a );
		}
		$('#login_box').removeClass('dom_hidden').children('section').removeClass('dom_hidden');
	});
	$('#enter-button').click(function(){    // 點擊 進入 Skill 按鈕
		$('#preloader').find('span').text('請稍後..').end().removeClass('dom_hidden');
		window.location.replace( '../index.html' );
	});
	$('#gender-one').change(function(){    // 個人名稱 radio
		document.getElementById('gender-many').checked = false;
		$('#female').parents('div.input-sex').removeClass('dom_hidden');
	});
	$('#gender-many').change(function(){    // 組織名稱 radio
		document.getElementById('gender-one').checked = false;
		$('#female').parents('div.input-sex').addClass('dom_hidden');
	});
	$('#female').change(function(){    // 男生 radio
		document.getElementById('male').checked = false;
	});
	$('#male').change(function(){    // 女生 radio
		document.getElementById('female').checked = false;
	});
	$('#login-button').click(function(){    // 點擊確定登入按鈕：判斷登入資訊
		$('#login-summary').html('');
		var a = $('#login-email').val();
		var b = $('#login-password').val();
		var c = true;
		
		if( a == '' ){
			$('#login-summary').append('<li><i class="icon-sign icon-sign-error"></i>請輸入電子信箱</li>');
			c = false;
		}
		if( b == '' ){
			$('#login-summary').append('<li><i class="icon-sign icon-sign-error"></i>請輸入密碼</li>');
			c = false;
		}
		if( c ){
			CheckLogin( a , b );
		}else{
			$('#login-summary').parent().removeClass('dom_hidden');
		}
		$('#login-password').val('');
	});
	$('#sign-up-button').click(function(){    // 點擊確定註冊按鈕：判斷註冊資訊
		$('#sign-up-summary').html('').parent().addClass('dom_hidden');
		var a = $('#sign-up-name').val().trim();
		var b = $('#sign-up-email').val().trim();
		var c = $('#sign-up-password').val();
		var d = $('#sign-up-password-again').val();
		var e = true;
		if( a == '' ){
			$('#sign-up-summary').append('<li><i class="icon-sign icon-sign-error"></i>未填寫名稱</li>');
			e = false;
		}else{
			if( a.length > 25 ){
				$('#sign-up-summary').append('<li><i class="icon-sign icon-sign-error"></i>名稱長度不應該超過 25 個字元</li>');
				e = false;
			}else{
				var bl = CheckName( a );
				if( !bl ){
					$('#sign-up-summary').append('<li><i class="icon-sign icon-sign-error"></i>名稱格式錯誤</li>');
					e = false;
				}
			}
		}
		if( b == '' ){
			$('#sign-up-summary').append('<li><i class="icon-sign icon-sign-error"></i>未填寫電子信箱</li>');
			e = false;
		}else{
			if( b.length > 50 ){
				$('#sign-up-summary').append('<li><i class="icon-sign icon-sign-error"></i>電子信箱長度不應該超過 50 個字元</li>');
				e = false;
			}else{
				var bl = CheckEmail( b );
				if( !bl ){
					$('#sign-up-summary').append('<li><i class="icon-sign icon-sign-error"></i>電子信箱格式錯誤</li>');
					e = false;
				}
			}
		}
		if( c == '' || c.length < 6 || c.length > 12 || d == '' || d.length < 6 || d.length > 12 ){
			$('#sign-up-summary').append('<li><i class="icon-sign icon-sign-error"></i>密碼長度應該是 6~12 位數</li>');
			e = false;
		}else{
			if( c !== d ){
				$('#sign-up-summary').append('<li><i class="icon-sign icon-sign-error"></i>確認密碼與密碼不相同</li>');
				e = false;
			}else{
				if( c.match(/\s/g) == null ){  // 判斷空白： \s
					var bl = CheckPassword( c );
					if( !bl ){
						$('#sign-up-summary').append('<li><i class="icon-sign icon-sign-error"></i>密碼格式錯誤</li>');
						e = false;
					}
				}else{
					$('#sign-up-summary').append('<li><i class="icon-sign icon-sign-error"></i>密碼不能含有空白字元</li>');
					e = false;
				}
			}
		}
		if( e ){
			SetCV( a, b, c );
		}else{
			$('#sign-up-summary').parent().removeClass('dom_hidden');
			$('#sign-up-password').val('');
			$('#sign-up-password-again').val('');
		}
	});
	$('#set-completed').click(function(){    // 點擊 開始使用 按鈕
		var a = $('#motto-area').val();
		var b = true;
		if( a == '' ){
			alert('未填寫內容。');
			b = false;
		}else{
			if( a.length > 50 ){
				alert('內容不可以超過 50 個字元。');
				b = false;
			}else{
				var bl = CheckTextarea( a );
				if( !bl ){
					alert('內容格式錯誤，含有未認可的特殊字元。');
					b = false;
				}
			}
		}
		if( b ){
			SetCompleted( a.trim() );
		}
	});
	$('#login-password').keydown(function(e){    // 按下 enter 登入
		if ($(this).is(':focus') && (e.keyCode == 13)) {
			$('#login-button').trigger('click');
		}
	 });
});
function SetTagsInput(){    // 設定技能標籤插件
	$('#tag-skill, #tag-need').tagsInput({
		'height': 'auto',
	    'width': '95%',
	    'interactive': true,
	    'defaultText': 'add a skill...',
	    'placeholderColor': '#cde69c'
	});
	$('#set_box_next').bind('click', function(){ SetSkillNext() });
}
function CheckStr( a ){    // 只能有 _ 和 - 能使用
    if( /^[^@\/\'\\\"#$%&\^\*\=\+\(\)\?\:\[\]\{\}\!\~\.\,]+$/.test( a ) ){
		if( a.match(/\\/g) == null ){  // 判斷反斜線： \ 
			return true;
		}else{
			return false;
		}
	}else{
        return false; 
	}
}
function CheckName( a ){    // 檢查名稱是否有符合格式
	if( CheckStr( a ) ){
		return true;
	}else{
		return false;
	}
}
function CheckEmail( a ){    // 檢查 Email 是否有符合格式
	if( /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/.test( a ) ){
		return true;
	}else{
		return false;      
	}
}
function CheckPassword( a ){    // 檢查密碼是否有符合格式
	if( CheckStr( a ) ){
		return true;
	}else{
		return false;
	}
}
function CheckTextarea( a ){    // 檢查 Textarea 是否有符合格式
    if( /^[^@\/\'\\\"#$%&\^\*\=\+\(\)\[\]\{\}]+$/.test( a ) ){
		if( a.match(/\\/g) == null ){  // 判斷反斜線： \ 
			return true;
		}else{
			return false;
		}
	}else{
        return false; 
	}
}
function SetCV( name, email, password ){    // 註冊成功：設定個人履歷
	if( document.getElementById('gender-one').checked ){  // 個人名稱
		var gender = CheckSex();
	}else{  // 組織名稱
		var gender = 0;
	}
	var temp = $.timestamp.get().split('_');
	$('#preloader').find('span').text('正在設定帳戶資訊').end().removeClass('dom_hidden');
	$.ajax({    // 設定 個人履歷
        url: '../php/set_cv.php',
        data: { userid: 'u_'+temp[0], name: name, email: email, password: password, gender: gender, join_time: temp[1].split(' ')[0] },
        type: 'POST',
        dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			alert( msg[1] );
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				SetTagsInput();
				$('#set_title_name').text( name );
				$('#sign-up_box').addClass('dom_hidden').children('section').addClass('dom_hidden');
				$('#set_box').removeClass('dom_hidden').children('section').removeClass('dom_hidden');
				sessionStorage.setItem( 'temp_SetUserId', 'u_'+temp[0] );
				sessionStorage.setItem( 'temp_SetUserName', name );
				var obj = { 'USERID': 'u_'+temp[0], 'USERNAME': name, 'EMAIL': email, 'password': password, 'GENDER': gender, 'JOIN_TIME': temp[1].split(' ')[0] };
				localStorage.setItem( 'UserCV', JSON.stringify( obj ) );
			}else if( msg[0] == 'error' ){
				$('#sign-up-password').val('');
				$('#sign-up-password-again').val('');
			}
        },
        error:function(xhr, ajaxOptions, thrownError){ 
            console.log(xhr.status); 
            console.log(thrownError);
			alert('資料格式正確，但是伺服器發生錯誤。');
        }
    });
	window.setTimeout(function(){
		$('#preloader span').text('正在發送認證信');
	}, 2500);
}
function CheckSex(){
	if( document.getElementById('female').checked ){  // 女生
		return 2;
	}else{  // 男生
		return 1;
	}
}
function SetSkillNext(){    // 設定帳號：下一步
	var $a = $('#tag-skill_tagsinput > span');
	var $b = $('#tag-need_tagsinput > span');
	if( parseInt( $b.length ) == 0 || parseInt( $a.length ) == 0 ){ return alert('請填寫技能欄位。'); }
	var str1 = '';
	var str2 = '';
	for( var i=0; i<$a.length; i++ ){
		var temp = $( $a[i] ).children('span').text().trim();
		if( CheckStr( temp ) ){
			str1 += ','+temp;
		}else{
			return alert('技能欄位只能是"中英文"、"數字"、"-"和"_"。');
		}
	}
	for( var i=0; i<$b.length; i++ ){
		var temp = $( $b[i] ).children('span').text().trim();
		if( CheckStr( temp ) ){
			str2 += ','+temp;
		}else{
			return alert('技能欄位只能是"中英文"、"數字"、"-"和"_"。');
		}
	}
	$.ajax({    // 設定 Skill & Need
        url: '../php/set_skill.php',
        data: { userid: sessionStorage.temp_SetUserId, skill: str1.substr(1), need: str2.substr(1) },
        type: 'POST',
        dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			if( msg[0] == 'success' ){
				$('#set-skill').addClass('dom_hidden');
				$('#set-need').addClass('dom_hidden');
				$('#set-motto').removeClass('dom_hidden');
				$('#set_box_next').addClass('dom_hidden');
				var obj = JSON.parse( localStorage.UserCV );
				obj['SKILL'] = str1.substr(1);
				obj['NEED'] = str2.substr(1);
				localStorage.setItem( 'UserCV', JSON.stringify( obj ) );
			}else if( msg[0] == 'error' ){
				alert( msg[1] );
			}
        },
        error:function(xhr, ajaxOptions, thrownError){ 
            console.log(xhr.status); 
            console.log(thrownError);
			alert('資料格式正確，但是伺服器發生錯誤。');
        }
    });
}
function SetCompleted( motto ){    // 設定 完成註冊
	$.ajax({    // 設定 Motto
        url: '../php/set_motto.php',
        data: { userid: sessionStorage.temp_SetUserId, motto: motto },
        type: 'POST',
        dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			if( msg[0] == 'success' ){
				var obj = JSON.parse( localStorage.UserCV );
				obj['MOTTO'] = motto;
				localStorage.setItem( 'UserCV', JSON.stringify( obj ) );
				var a = JSON.stringify( { 'username': sessionStorage.temp_SetUserName, 'userid': sessionStorage.temp_SetUserId, 'email': sessionStorage.temp_SetEmail } );
				$.cookie.set({ name: 'UserInfo', value: a, expires: '1', path: '/' });
				localStorage.setItem( 'UserInfo', a );
				alert( '完成註冊。' );
				window.location.replace( '../index.html' );
				$('#preloader').find('span').text('請稍後..').end().removeClass('dom_hidden');
			}else if( msg[0] == 'error' ){
				alert( msg[1] );
			}
        },
        error:function(xhr, ajaxOptions, thrownError){ 
            console.log(xhr.status); 
            console.log(thrownError);
			alert('資料格式正確，但是伺服器發生錯誤。');
        }
    });
}
function CheckLogin( email, passwd ){    // 設定 登入
	$('#preloader').find('span').text('登入中，請稍後..').end().removeClass('dom_hidden');
	$.ajax({    // 設定 Motto
		url: '../php/login.php',
		data: { email: email, passwd: passwd },
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@@');
			window.setTimeout(function(){
				$('#preloader').addClass('dom_hidden');
				if( msg[0] == 'success' ){
					var obj = JSON.parse( msg[5] );
					sessionStorage.setItem( 'temp_SetUserId', obj.USERID );
					sessionStorage.setItem( 'temp_SetUserName', obj.USERNAME );
					sessionStorage.setItem( 'temp_SetEmail', obj.EMAIL );
					localStorage.setItem( 'UserCV', msg[5] ); console.log( msg[5] );
					if( parseInt( msg[3] ) == 0 ){    // 尚未填寫技能
						SetTagsInput();
						alert( '歡迎~'+msg[1]+'，尚未填寫技能與名言。' );
						$('#set_title_name').text( msg[1] );
						$('#login_box').addClass('dom_hidden').children('section').addClass('dom_hidden');
						$('#set_box').removeClass('dom_hidden').children('section').removeClass('dom_hidden');
						return false;
					}
					if( parseInt( msg[4] ) == 0 ){    // 尚未填寫名言
						alert( '歡迎~'+msg[1]+'，尚未填寫名言。' );
						$('#set_title_name').text( msg[1] );
						$('#set_box_next').addClass('dom_hidden');
						$('#set-skill').addClass('dom_hidden');
						$('#set-need').addClass('dom_hidden');
						$('#set-motto').removeClass('dom_hidden');
						$('#set_box').removeClass('dom_hidden').children('section').removeClass('dom_hidden');
						return false;
					}
					var a = JSON.stringify( { 'username': msg[1], 'userid': msg[2], 'email': obj.EMAIL } );
					$.cookie.set({ name: 'UserInfo', value: a, expires: '1', path: '/' });
					localStorage.setItem( 'UserInfo', a );
					alert( '歡迎~'+msg[1]+'。' );
					window.location.replace( '../index.html' );
					$('#preloader').find('span').text('請稍後..').end().removeClass('dom_hidden');
				}else if( msg[0] == 'error' ){
					$('#login-summary').append('<li><i class="icon-sign icon-sign-error"></i>帳號密碼輸入錯誤</li>').parent().removeClass('dom_hidden');
					$('#sign-up-summary').parent().removeClass('dom_hidden');
					$('#login-password').val('');
				}
			}, 1000);
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
			alert('資料格式正確，但是伺服器發生錯誤。');
		}
	});
}