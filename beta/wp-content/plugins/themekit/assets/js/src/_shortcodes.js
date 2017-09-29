( function( $ ) {
	"use strict";

	var doc = $( document ),
		win = $( window );

	$( function() {
		// Testimonial Slider
		$( '.testimonial-slider' ).each( function() {
			try {
				var config = JSON.parse( '{ ' + $( this ).attr( 'data-config' ) + ' }' );

				$( this ).flexslider( {
					selector: '.slides > .testimonial',
					smoothHeight: true,
					animation: "slide",
					animationLoop: config.loop == 'yes',
					slideshowSpeed: config.speed,
					controlNav: config.hide_control != 'yes',
					directionNav: config.hide_buttons != 'yes',
					direction: config.mode,
					slideshow: config.autoplay == 'yes',
					itemWidth: 300,
					minItems: config.slides_per_view,
					maxItems: config.slides_per_view
				} );
			}
			catch( e ) {}
		} );

		// Counter up
		if ( $.fn.counterUp && $.fn.waypoint ) {
			$( '.counter .counter-value' ).each( function() {
				var elm      = $( this ),
					duration = parseInt( '0' + elm.attr( 'data-duration' ) );

				elm.counterUp( { time: duration } );
			} );
		}

		// Countdown
		if ( $.fn.countdown ) {
			$( '.countdown' ).each( function() {
				var format = [],
					parts = $( this ).attr( 'data-hidden' ).split( ',' ),
					config = {
						year: '<span class="years"><span class="number">%-Y</span> %!Y:' + _countdownLocalize['year'] + ',' + _countdownLocalize['year'] + 's;</span>',
						month: '<span class="months"><span class="number">%-m</span> %!m:' + _countdownLocalize['month'] + ',' + _countdownLocalize['month'] + 's;</span>',
						week: '<span class="weeks"><span class="number">%-w</span> %!w:' + _countdownLocalize['week'] + ',' + _countdownLocalize['week'] + 's;</span>',
						day: '<span class="days"><span class="number">%-d</span> %!d:' + _countdownLocalize['day'] + ',' + _countdownLocalize['day'] + 's;</span>',
						hour: '<span class="hours"><span class="number">%-H</span> %!H:' + _countdownLocalize['hour'] + ',' + _countdownLocalize['hour'] + 's;</span>',
						minute: '<span class="minutes"><span class="number">%-M</span> %!M:' + _countdownLocalize['minute'] + ',' + _countdownLocalize['minute'] + 's;</span>',
						second: '<span class="seconds"><span class="number">%-S</span> %!S:' + _countdownLocalize['second'] + ',' + _countdownLocalize['second'] + 's;</span>'
					};

				if ( parts.indexOf( 'week' ) != -1 ) {
					config.day = '<span class="days"><span class="number">%-D</span> %!D:' + _countdownLocalize['day'] + ',' + _countdownLocalize['day'] + 's;</span>';
				}

				$.map( config, function( value, key ) {
					if ( parts.indexOf( key ) == -1 )
						format.push( value );
				} );

				$( this ).countdown( $( this ).attr( 'data-time' ), function( evt ) {
					$(this).html( evt.strftime( format.join( ' ' ) ) );
				} )
			} );
		}

		// Post Carousel
		$( '.blog-shortcode.blog-carousel' ).each( function() {
			var container = $( this ),
				columns = 1;

			if ( container.hasClass( 'blog-two-columns' ) ) columns = 2;
			if ( container.hasClass( 'blog-three-columns' ) ) columns = 3;
			if ( container.hasClass( 'blog-four-columns' ) ) columns = 4;
			if ( container.hasClass( 'blog-five-columns' ) ) columns = 5;

			var entriesWrapper = $( '.entries-wrapper', container )
				.addClass( 'owl-carousel' )
				.imagesLoaded( function() {
					entriesWrapper.owlCarousel( {
						items: columns,
						navigation: true,
						autoPlay: true,
						stopOnHover: true,
						itemsDesktop : [1199, columns],
						itemsDesktopSmall : [979, 3],
						itemsTablet : [768, 2],
						scrollPerPage: true,
						slideSpeed: 800,
						autoHeight : true,
						responsiveBaseWidth: entriesWrapper
					} );
				} );
		} );

		// Elements Carousel
		$( '.elements-carousel' ).each( function() {
			try {
				var element = $( this );
				var config  = JSON.parse( element.attr( 'data-config' ) );

				element.imagesLoaded( function() {
					$( '.elements-carousel-wrap', element ).owlCarousel( config );
				} );
			}
			catch( e ) {}
		} );
	} );

} ).call( this, jQuery );