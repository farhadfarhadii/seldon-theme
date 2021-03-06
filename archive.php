<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tgs_wp
 */

get_header(); ?>


	<div class="main-content">

		<div class="container-fluid">

			<div class="row maxout pt-40">
				<!-- <div id="content" class="main-content-inner col-md-7 col-md-offset-1 match-height"> -->
				<div id="content" class="main-content-inner col-xs-12">
					<div class="row maxout">
					 	<div class="col-sm-11 col-sm-offset-1">
							<div class="row">						
						<?php if ( have_posts() ) { ?>

							<header class="cmb-30 col-xs-12">
								<h1 class="page-title main-page-title">
									<?php
										if ( is_category() ) {
											single_cat_title();

										} elseif ( is_tag() ) {
											single_tag_title();

										} elseif ( is_author() ) {
											/* Queue the first post, that way we know
											 * what author we're dealing with (if that is the case).
											*/
											the_post();
											printf( __( 'Author: %s', 'tg-wp-starter' ), '<span class="vcard">' . get_the_author() . '</span>' );
											/* Since we called the_post() above, we need to
											 * rewind the loop back to the beginning that way
											 * we can run the loop properly, in full.
											 */
											rewind_posts();

										} elseif ( is_day() ) {
											printf( __( 'Day: %s', 'tg-wp-starter' ), '<span>' . get_the_date() . '</span>' );

										} elseif ( is_month() ) {
											printf( __( 'Month: %s', 'tg-wp-starter' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

										} elseif ( is_year() ) {
											printf( __( 'Year: %s', 'tg-wp-starter' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

										} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
											_e( 'Asides', 'tg-wp-starter' );

										} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
											_e( 'Images', 'tg-wp-starter');

										} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
											_e( 'Videos', 'tg-wp-starter' );

										} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
											_e( 'Quotes', 'tg-wp-starter' );
											
										} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
											_e( 'Links', 'tg-wp-starter' );
											
										} else {
											_e( 'Archives', 'tg-wp-starter' );
										}
									?>
								</h1>
								<?php
									// Show an optional term description.
									$term_description = term_description();
									if ( ! empty( $term_description ) ) {
										printf( '<div class="taxonomy-description">%s</div>', $term_description );
									}
								?>
							</header><!-- .page-header -->
						</div>
						<div class="row">
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>

								<?php
									/* Include the Post-Format-specific template for the content.
									 * If you want to overload this in a child theme then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'content/content', get_post_format() );
								?>

							<?php endwhile; ?>
							<div class="col-xs-12 mv-30">						
								<?php tgs_wp_content_nav( 'nav-below' ); ?>
							</div>

						<?php } else { ?>

							<?php get_template_part( 'content/no-results', '' ); ?>

						<?php } ?>

							</div>
						</div>

					</div>
					<!-- <div class="col-md-1"></div> -->
					<?php // get_sidebar(); ?>

				</div>

			</div>
		</div>

	</div>

<?php get_footer();
