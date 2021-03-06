<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package tgs_wp
 */

get_header(); ?>

	<div class="main-content">

		<div class="container-fluid">
			
			<?php get_template_part('sections/research-filter-search-bar'); ?>

			<div class="row maxout pt-40">
				<div id="content" class="main-content-inner col-xs-12">
 					<div class="row maxout">
					 	<div class="col-sm-11 col-sm-offset-1">
							<?php if ( have_posts() ) { ?>
								<div class="row">
									<header class="mb-30 col-xs-12">
										<h2 class="page-title"><?php printf( __( 'Research Publication Search Results for: %s', 'tg-wp-starter' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
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
