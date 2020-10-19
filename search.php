<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package tgs_wp
 */

get_header(); ?>

<?php

// store the post type from the URL string
$post_type = $_GET['posttype'];

// check to see if there was a post type in the
// URL string and if a results template for that
// post type actually exists
if ( isset( $post_type ) && locate_template( 'search-' . $post_type . '.php' ) ) {

  // if so, load that template
  get_template_part( 'search', $post_type );
  
  // and then exit out
  exit;
}

?>

<div class="main-content">

	<div class="container-fluid">
		
		<div class="row sidebar-wrap">
			<div class="col-xs-12 maxout">
				<div class="row">
					<?php get_sidebar(); ?>						
				</div>
			</div>
		</div>	

		<div class="row maxout pt-40">
			<div id="content" class="main-content-inner col-xs-12">
				<div class="row maxout">
				 	<div class="col-sm-11 col-sm-offset-1">

						<?php if ( have_posts() ) { ?>
							<div class="row">						
								<header class="mb-30 col-xs-12">
									<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'tg-wp-starter' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
								</header><!-- .page-header -->
							</div>

							<div class="row post-listing">
								<?php // start the loop. ?>
								<?php while ( have_posts() ) : the_post(); ?>

									<?php get_template_part( 'content/content', 'search' ); ?>

								<?php endwhile; ?>

							</div>

							<?php get_template_part( 'elements/loadmore-button', '' ); ?>

						<?php } else { ?>
							<div class="row">							
								<div class="mb-30 col-xs-12">
									<?php get_template_part( 'content/no-results', '' ); ?>
								</div>
							</div>

						<?php } // end of loop. ?>
					</div>
				</div>

			</div>

		</div>
	</div>

</div>

<?php get_footer();
