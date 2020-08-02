<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package tgs_wp
 */

get_header(); ?>

	<div class="main-content">

		<div class="container">
			<div class="row">
				<div id="content" class="main-content-inner col-sm-12 col-md-8">

					<?php // Add the class "panel" below here to wrap the content-padder in Bootstrap style ;). ?>
					<section class="content-padder error-404 not-found">

						<header>
							<h2 class="page-title"><?php _e( 'Oops! Something went wrong here.', 'tg-wp-starter' ); ?></h2>
						</header><!-- .page-header -->

						<div class="page-content">

							<p><?php _e( 'Nothing could be found at this location. Maybe try a search?', 'tg-wp-starter' ); ?></p>

							<?php get_search_form(); ?>

						</div><!-- .page-content -->

					</section><!-- .content-padder -->

				</div>

				<?php get_sidebar(); ?>
			</div>
		</div>

	</div>

<?php get_footer();
