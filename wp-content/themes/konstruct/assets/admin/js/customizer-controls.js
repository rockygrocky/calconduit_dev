(function($) {
	"use strict";

	var api = wp.customize,
		doc = $( document ),
		win = $( window );

	/**
	 * This function will be used to update the
	 * state of the options control
	 *
	 * @return  void
	 */
	var refreshState = function() {
		// Site frontpage options
		$.opControlVisible( [
				'static_frontpage',
				'posts_page'
			],
			api.instance( 'show_on_front' ).get() == 'page'
		);
		
		// Logo options
		$.opControlVisible( [
				'logo_src',
				'logo_size',
				'logo_margin',
				'logo_sticky_src'
			],
			api.instance( 'logo_image' ).get()
		);
		
		// Topbar options
		$.opControlVisible( [
				'topbar_bgcolor',
				'topbar_textcolor',
				'topbar_content',
				'topbar_social_links_enabled'
			],
			api.instance( 'topbar_enabled' ).get()
		);

		// Header Sticky
		$.opControlVisible( ['header_stick_dark_style'], api.instance( 'header_sticky' ).get() );

		// Page callout
		$.opControlVisible( [
				'page_callout_content',
				'page_callout_button_text',
				'page_callout_button_link'
			],
			api.instance( 'page_callout_enabled' ).get()
		);

		// Footer Widgets
		$.opControlVisible( [
				'footer_widgets_layout',
				'footer_widgets_background',
				'footer_widgets_textcolor'
			],
			api.instance( 'footer_widgets_enabled' ).get()
		);

		// Layout
		$.opControlVisible( ['boxed_background'], api.instance( 'layout_mode' ).get() == 'layout-boxed' );
		$.opControlVisible( ['sidebar_default'], api.instance( 'sidebar_layout' ).get() != 'no-sidebar' );
		$.opControlVisible( [
				'pagetitle_background',
				'pagetitle_textcolor',
				'breadcrumb_enabled'
			],
			api.instance( 'pagetitle_enabled' ).get()
		);

		$.opControlVisible( [
				'breadcrumb_prefix',
				'breadcrumb_separator'
			],
			api.instance( 'breadcrumb_enabled' ).get() &&
			api.instance( 'pagetitle_enabled' ).get()
		);

		// Blog
		$.opControlVisible( ['blog_page_title'], api.instance( 'blog_page_title_enabled' ).get() );
		$.opControlVisible( [
			'blog_archive_post_excepts_length',
			'blog_archive_post_excepts_striphtml'
			],
			api.instance( 'blog_archive_post_excepts' ).get()
		);
		$.opControlVisible( ['blog_archive_readmore_text'], api.instance( 'blog_archive_readmore' ).get() );
		$.opControlVisible( ['blog_related_posts_style', 'blog_related_posts_count'], api.instance( 'blog_related_box_enabled' ).get() );
		$.opControlVisible( ['blog_related_posts_columns'],
			api.instance( 'blog_related_posts_style' ).get() != 'list' &&
			api.instance( 'blog_related_box_enabled' ).get()
		);

		// Grid
		$.opControlVisible( ['blog_grid_columns'], ['grid', 'masonry'].indexOf( api.instance( 'blog_archive_layout' ).get() ) >= 0 );
		$.opControlVisible( ['blog_archive_sidebar'], api.instance( 'blog_archive_sidebar_layout' ).get() != 'no-sidebar' );
		$.opControlVisible( ['blog_single_sidebar'], api.instance( 'blog_single_sidebar_layout' ).get() != 'no-sidebar' );
		$.opControlVisible( ['blog_post_navigator_sticky'], api.instance( 'blog_post_navigator_enabled' ).get() );

		// Portfolio
		$.opControlVisible( ['portfolio_archive_sidebar'], api.instance( 'portfolio_archive_sidebar_layout' ).get() != 'no-sidebar' );
		$.opControlVisible( ['portfolio_single_sidebar'], api.instance( 'portfolio_single_sidebar_layout' ).get() != 'no-sidebar' );
		$.opControlVisible( [
				'portfolio_related_style',
				'portfolio_related_posts_count',
				'portfolio_related_columns_count'
			],
			api.instance( 'portfolio_related_box_enabled' ).get()
		);

		// Under Construction
		$.opControlVisible( ['under_construction_page_id', 'under_construction_allowed'], api.instance( 'under_construction_enabled' ).get() );
	};

	// Implement the DOMReady event
	$(function() {
		// Register change event for all options
		api.bind( 'change', refreshState );
		win.on( 'load', refreshState );

		// Handle message event to update customize settings
		// $( window ).on( 'message', function( event ) {
		// 	event = event.originalEvent;

		// 	try {
		// 		var message = JSON.parse( event.data );
		// 		if ( message.id == 'customizeSettings' ) {
		// 			_customizeSettings = message.settings;
		// 			_customizeSettings['current'] = api.instance( 'blog_page_title' ).previewer.previewUrl();
		// 		}
		// 		else if ( message.id == 'ready' ) {
		// 			$( '.accordion-section.loading' ).removeClass( 'loading' );
		// 		}
		// 	}
		// 	catch( exception ) {}
		// } );

		// $( '.accordion-section .accordion-section-title' ).on( 'click', toggleSection );
	});
}).call(this, jQuery);
