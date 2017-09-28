( function( $ ) {
	"use strict";

	var win = $( window ),
		doc = $( document );

	/**
	 * debouncing function from John Hann
	 * http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
	 */
	var debounce = function (func, threshold, execAsap) {
		var timeout;

		return function debounced () {
			var obj = this, args = arguments;
			function delayed () {
				if (!execAsap)
					func.apply(obj, args);
				timeout = null;
			};

			if (timeout)
				clearTimeout(timeout);
			else if (execAsap)
				func.apply(obj, args);

			timeout = setTimeout(delayed, threshold || 100);
		};
	};

	/**
	 * Register smartresize plugin
	 */
	$.fn['smartresize'] = function(fn){
		return fn ? this.bind('resize', debounce(fn)) : this.trigger('smartresize');
	};

	/**
	 * This function will be called every time when browser
	 * is scrolling
	 */
	var updateContentPosition = function() {
		var container = this,
			content = $( '.entry-content', this );

		var winScrollTop = win.scrollTop(),
			winScrollBottom = win.scrollTop() + win.height();

		var containerOffset = container.offset(),
			contentOffset = content.offset();

		containerOffset.bottom = containerOffset.top + container.height();
		contentOffset.bottom = contentOffset.top + content.height();

		// Add more scroll offset
		if ( $( '#wpadminbar' ).length > 0 ) winScrollTop += $( '#wpadminbar' ).height();
		if ( $( '#masthead-sticky' ).length > 0 ) winScrollTop += $( '#masthead-sticky' ).height();

		// Initial layout style
		container.css( 'position', 'relative' );
		content.css( 'position', 'relative' );

		// Stick content to top
		if ( content.height() < win.height() ) {
			var top = winScrollTop - containerOffset.top,
				maxTop = container.height() - content.height();

			if ( top > maxTop )
				top = container.height() - content.height();
			else if ( top < 0 )
				top = 0;

			content.css( 'top', top );
		}

		// Stick content to bottom
		else {
			if ( winScrollBottom > contentOffset.bottom && winScrollBottom < containerOffset.bottom )
				content.css( 'top', winScrollBottom - containerOffset.top - content.height() );
			else if ( winScrollTop < contentOffset.top && winScrollTop > containerOffset.top )
				content.css( 'top', winScrollTop - containerOffset.top );
			else if ( winScrollBottom > containerOffset.bottom )
				content.css( 'top', container.height() - content.height() );
			else if ( winScrollTop < containerOffset.top )
				content.css( 'top', 0 );
		}
	};

	$( function() {
		$( '.portfolio-container' ).each( function() {
			var container = $( this );

			// Initialize FitVids
			if ( $.fn.fitVids ) {
				$( '.entry-cover .video-item' ).fitVids();
			}
			
			/**
			 * Portfolio single
			 */
			if ( container.hasClass( 'portfolio-single' ) ) {
				var coverContainer = $( '.entry-cover', container );

				if ( coverContainer.hasClass( 'cover-slider' ) ) {
					// Initialize FlexSlider
					$( '.flexslider', coverContainer ).each( function() {
						$( this ).flexslider( {
							animation: $( this ).attr( 'data-animation-mode' ) || 'slide',
							slideshowSpeed: 5000,
							animationLoop: true,
							controlNav: true,
							directionNav: true,
							slideshow: true,
							smoothHeight: true,
							pauseOnAction: true,
							pauseOnHover: true,
							video: true
						} );
					} );
				}

				if ( coverContainer.hasClass( 'cover-grid' ) ) {
					var mediaGrid = $( '.media-grid' ).imagesLoaded( function() {
						mediaGrid.masonry( {
							itemSelector: 'li'
						} );
					} );
				}

				/**
				 * Content sticky
				 */
				if ( container.hasClass( 'portfolio-content-sticky' ) ) {
					$( window ).on( 'load', updateContentPosition.bind( container ) );
					$( window ).on( 'scroll', updateContentPosition.bind( container ) );
					$( window ).on( 'resize', updateContentPosition.bind( container ) );
				}

				return;
			}

			var gridColumns = 2;

			if ( container.hasClass( 'portfolio-three-columns' ) ) gridColumns = 3;
			if ( container.hasClass( 'portfolio-four-columns' ) )  gridColumns = 4;
			if ( container.hasClass( 'portfolio-five-columns' ) )  gridColumns = 5;

			if ( container.hasClass( 'portfolio-carousel' ) ) {
				var entriesWrapper = $( '.entries-wrapper', container )
					.addClass( 'owl-carousel' )
					.imagesLoaded( function() {
						entriesWrapper.owlCarousel( {
							items: gridColumns,
							navigation: true,
							autoPlay: true,
							stopOnHover: true,
							itemsDesktop : [1199, gridColumns],
							itemsDesktopSmall : [979, 3],
							itemsTablet : [768, 2],
							scrollPerPage: true,
							slideSpeed: 800,
							autoHeight : true,
							responsiveBaseWidth: entriesWrapper
						} );
					} );

				return;
			}

			var filter        = $( '.portfolio-filters', container );
			var resizeColumns = function() {
				var extraWidth = $( '.portfolio-entries', container ).width() % gridColumns,
					columnWidth = Math.floor( $( '.portfolio-entries', container ).width()/gridColumns );

				$( '.portfolio', gridContainer ).css( 'width', columnWidth + extraWidth );
				
				container.css( 'overflow', 'hidden' );
				gridContainer.css( 'width', $( '.portfolio-entries', container ).width() + 10 );
			};

			var gridContainer = $( '.entries-wrapper', container ).imagesLoaded( function() {
				resizeColumns();
				
				gridContainer.isotope( {
					itemSelector: '.portfolio',
					effect: 'fadeScale'
				} );

				win.smartresize( function() {
					resizeColumns();
					gridContainer.isotope( 'layout' );
				} );
			} );

			gridContainer.on( 'content-appended', function( e, data ) {
				data.items.imagesLoaded( function() {
					resizeColumns();
					data.items.css( 'visibility', 'visible' );
					gridContainer.isotope( 'appended', data.items );
				} );
			} );

			/**
			 * Initialize portfolio filters
			 */
			if ( filter.length > 0 ) {
				$( 'a', filter ).on( 'click', function( e ) {
					e.preventDefault();

					$( '.active', filter ).removeClass( 'active' );
					$( this ).parent().addClass( 'active' );

					gridContainer.isotope( {
						filter: $( this ).parent().attr( 'data-filter' )
					} );
				} );
			}
		} );
	} );
} ).call( this, jQuery );