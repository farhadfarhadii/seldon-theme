<?php
/**
 * The Template for displaying all single posts.
 *
 * @package tgs_wp
 */

get_header(); ?>

	<div class="main-content">

		<div class="container-fluid">
			<div class="row maxout">
				<div id="content" class="main-content-inner col-md-7 col-md-offset-1 match-height">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content/content', 'single' ); ?>

						<?php  tgs_wp_content_nav( 'nav-below' ); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							// if ( comments_open() || '0' != get_comments_number() ) {
							// 	comments_template();
							// }
						?>

					<?php endwhile; ?>

				</div>
			</div>

			<div class="row sidebar-wrap">
				<div class="col-xs-12 maxout">
					<div class="row">
						<?php get_sidebar(); ?>						
					</div>
				</div>
			</div>	


		</div>

	</div>

<?php get_footer();
