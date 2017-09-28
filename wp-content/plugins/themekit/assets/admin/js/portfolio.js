( function( $ ) {
	"use strict";

	var win = $( window );
	var refreshState = function() {
		$.sparkyControlVisible( [
				'slider_animation',
				'slider_thumbnail',
				'slider_autoplay_video'
			],

			$( '[data-option="style"] input:checked' ).val() == 'slider'
		);

		$.sparkyControlVisible( ['grid_columns'],
			$( '[data-option="style"] input:checked' ).val() == 'grid'
		);

		$.sparkyControlVisible( ['content_sticky'],
			$( '[data-option="content_position"] input:checked' ).val() != 'fullwidth'
		);
	};

	$( function() {
		win.on( 'load', refreshState );
		$( 'form#post' ).on( 'change', refreshState );
	} );

} ).call( this, jQuery )