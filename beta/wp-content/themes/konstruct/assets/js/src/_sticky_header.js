( function( $ ) {
	"use strict";

	var win = $( window );

	/**
	 * Header sticky module
	 */
	var _defaults = {
		offset: 0
	};

	function StickyHeader( element, options ) {
		this.element = $( element );
		this.opts    = $.extend( _defaults, options );

		this.create();
	};

	StickyHeader.prototype = {
		create: function() {
			this.stickyElement = this.element.clone();
			this.stickyElement.find( '.navigator-mobile, .brand .tagline' ).remove();
			this.stickyElement.attr( {
				'id': this.element.attr( 'id' ) + '-sticky',
				'class': 'header-sticky'
			} );
			this.element.after( this.stickyElement );

			// Bind scroll event
			win.on( 'scroll', this.update.bind( this ) );
			win.on( 'load', this.update.bind( this ) );
		},

		update: function(e) {
			if ( win.scrollTop() >= ( this.element.offset().top + this.element.height() - this.opts.offset ) )
				this.stickyElement.addClass( 'active' );
			else
				this.stickyElement.removeClass( 'active' );
		}
	};

	$.fn.stickyHeader = function( options ) {
		return this.each( function() {
			$( this ).data( '_stickyHeader', new StickyHeader( this, options ) );
		} );
	};

} ).call( this, jQuery );