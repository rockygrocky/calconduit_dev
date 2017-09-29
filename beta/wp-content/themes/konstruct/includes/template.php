<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();


if ( ! function_exists( 'konstruct_post_title' ) ) {
	/**
	 * Display the post title
	 * 
	 * @return  void
	 */
	function konstruct_post_title() {
		$post_link = apply_filters( 'the_permalink', get_permalink() );

		if ( get_post_format() == 'link' ) {
			$post_options = get_post_meta( get_the_ID(), '_post_options', true );

			if ( isset( $post_options['post_link'] ) && filter_var( $post_options['post_link'], FILTER_VALIDATE_URL ) )
				$post_link = $post_options['post_link'];
		}

		if ( is_singular() ) {
			if ( op_option( 'blog_page_title_enabled' ) == false ) {
				printf( '<h2 class="entry-title" itemprop="headline">%s</h2>', get_the_title() );
			}
		}
		else {
			printf( '<h2 class="entry-title" itemprop="headline"><a href="%s" itemprop="url">%s</a></h2>',
				esc_url( $post_link ),
				get_the_title()
			);
		}
	}
}


if ( ! function_exists( 'konstruct_post_meta' ) ) {
	/**
	 * Display the post meta
	 * 
	 * @return  void
	 */
	function konstruct_post_meta() {
		if ( ! op_option( 'blog_archive_show_post_meta' ) )
			return;
		
		?>
		
			<div class="entry-meta">
				<span><?php _e( 'Posted By', 'konstruct' ) ?></span>
				<span class="entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" class="entry-author-link" itemprop="url" rel="author">
						<span class="entry-author-name" itemprop="name"><?php echo get_the_author() ?></span>
					</a>
				</span>
				<span>in</span>
				<span class="entry-categories">
					<?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'konstruct' ) ); ?>
				</span>
				<time class="entry-time" itemprop="datePublished" datetime="2014-07-07T07:45:47+00:00">
					<?php echo esc_html( get_the_date() ) ?>
				</time>

				<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<?php if ( in_array( op_option( 'blog_archive_layout' ), array( 'grid', 'masonry' ) ) && ! is_single() ): ?>

						<span class="entry-comments-link">
							<?php comments_popup_link( '0', '1', '%' ); ?>
						</span>

					<?php else: ?>
						
						<span class="entry-comments-link">
							<?php comments_popup_link( __( '0 comment', 'konstruct' ), __( '1 Comment', 'konstruct' ), __( '% Comments', 'konstruct' ) ); ?>
						</span>

					<?php endif ?>
				<?php endif ?>
				
				<?php edit_post_link( __( '(Edit)', 'konstruct' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php
	}
}


if ( ! function_exists( 'konstruct_post_content' ) ) {
	/**
	 * Display the post content
	 * 
	 * @return  void
	 */
	function konstruct_post_content() {
		if ( ! is_single() && current_post_type_is( 'post' ) ) {
			$content = get_the_content( false, false );
			$auto_post_excerpts = op_option( 'blog_archive_post_excepts' );
			$post_excerpts_length = op_option( 'blog_archive_post_excepts_length' );

			if ( $auto_post_excerpts && mb_strlen( $content ) > $post_excerpts_length ) {
				$content = trim( strip_tags( $content ) );
				$content = mb_substr( $content, 0, $post_excerpts_length );
				$content.= '...';

				echo $content;
			}
			else {
				the_content( false );
			}

			if ( op_option( 'blog_archive_readmore' ) ) {
				printf( '<div class="readmore"><a href="%s" class="more-link">%s</a></div>', get_permalink(), op_option( 'blog_archive_readmore_text' ) );
			}
		}
		else {
			the_content( false );
		}
	}
}
