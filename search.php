<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package tgs_wp
 */

get_header(); ?>

	<div class="main-content">

		<div class="container-fluid">
			
			<div class="row maxout pt-40">
				<div id="content" class="main-content-inner col-md-7 col-md-offset-1 match-height">

					<?php if ( have_posts() ) { ?>

						<header class="mb-30">
							<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'tg-wp-starter' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
						</header><!-- .page-header -->

						<?php // start the loop. ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content/content', 'search' ); ?>

						<?php endwhile; ?>

						<?php tgs_wp_content_nav( 'nav-below' ); ?>

					<?php } else { ?>

						<?php get_template_part( 'content/no-results', '' ); ?>

					<?php } // end of loop. ?>

				</div>
				<div class="col-md-1"></div>
				<?php get_sidebar(); ?>

			</div>
		</div>

	</div>

<?php get_footer();
