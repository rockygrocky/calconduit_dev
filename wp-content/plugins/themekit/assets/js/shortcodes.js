(function(s){"use strict";var n=function(s,n,a){var e;return function(){function o(){a||s.apply(t,i),e=null}var t=this,i=arguments;e?clearTimeout(e):a&&s.apply(t,i),e=setTimeout(o,n||100)}};s.fn.smartresize=function(s){return s?this.bind("resize",n(s)):this.trigger("smartresize")}}).call(this,jQuery),function(s){"use strict";s(document),s(window);s(function(){s(".testimonial-slider").each(function(){try{var n=JSON.parse("{ "+s(this).attr("data-config")+" }");s(this).flexslider({selector:".slides > .testimonial",smoothHeight:!0,animation:"slide",animationLoop:"yes"==n.loop,slideshowSpeed:n.speed,controlNav:"yes"!=n.hide_control,directionNav:"yes"!=n.hide_buttons,direction:n.mode,slideshow:"yes"==n.autoplay,itemWidth:300,minItems:n.slides_per_view,maxItems:n.slides_per_view})}catch(a){}}),s.fn.counterUp&&s.fn.waypoint&&s(".counter .counter-value").each(function(){var n=s(this),a=parseInt("0"+n.attr("data-duration"));n.counterUp({time:a})}),s.fn.countdown&&s(".countdown").each(function(){var n=[],a=s(this).attr("data-hidden").split(","),e={year:'<span class="years"><span class="number">%-Y</span> %!Y:'+_countdownLocalize.year+","+_countdownLocalize.year+"s;</span>",month:'<span class="months"><span class="number">%-m</span> %!m:'+_countdownLocalize.month+","+_countdownLocalize.month+"s;</span>",week:'<span class="weeks"><span class="number">%-w</span> %!w:'+_countdownLocalize.week+","+_countdownLocalize.week+"s;</span>",day:'<span class="days"><span class="number">%-d</span> %!d:'+_countdownLocalize.day+","+_countdownLocalize.day+"s;</span>",hour:'<span class="hours"><span class="number">%-H</span> %!H:'+_countdownLocalize.hour+","+_countdownLocalize.hour+"s;</span>",minute:'<span class="minutes"><span class="number">%-M</span> %!M:'+_countdownLocalize.minute+","+_countdownLocalize.minute+"s;</span>",second:'<span class="seconds"><span class="number">%-S</span> %!S:'+_countdownLocalize.second+","+_countdownLocalize.second+"s;</span>"};-1!=a.indexOf("week")&&(e.day='<span class="days"><span class="number">%-D</span> %!D:'+_countdownLocalize.day+","+_countdownLocalize.day+"s;</span>"),s.map(e,function(s,e){-1==a.indexOf(e)&&n.push(s)}),s(this).countdown(s(this).attr("data-time"),function(a){s(this).html(a.strftime(n.join(" ")))})}),s(".blog-shortcode.blog-carousel").each(function(){var n=s(this),a=1;n.hasClass("blog-two-columns")&&(a=2),n.hasClass("blog-three-columns")&&(a=3),n.hasClass("blog-four-columns")&&(a=4),n.hasClass("blog-five-columns")&&(a=5);var e=s(".entries-wrapper",n).addClass("owl-carousel").imagesLoaded(function(){e.owlCarousel({items:a,navigation:!0,autoPlay:!0,stopOnHover:!0,itemsDesktop:[1199,a],itemsDesktopSmall:[979,3],itemsTablet:[768,2],scrollPerPage:!0,slideSpeed:800,autoHeight:!0,responsiveBaseWidth:e})})}),s(".elements-carousel").each(function(){try{var n=s(this),a=JSON.parse(n.attr("data-config"));n.imagesLoaded(function(){s(".elements-carousel-wrap",n).owlCarousel(a)})}catch(e){}})})}.call(this,jQuery);