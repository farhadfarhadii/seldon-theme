<?php
/**
 * @package tgs_wp
 */

get_header(); ?>

	<div class="main-content">

		<div class="container-fluid">

			<?php get_template_part( 'sections/page-hero' ); ?>

			<div class="row maxout pt-40">
				<div id="content" class="main-content-inner col-md-7 col-md-offset-1 match-height">

		            <div id="search" class="top-search-widget widget widget_search">
		                <?php get_search_form(); ?>
		            </div>


					<?php if ( have_posts() ) { ?>		

							<?php while ( have_posts() ) : the_post(); ?>
	
								<?php // get_template_part( 'content/content', get_post_format() ); ?>
								<?php get_template_part( 'content/content', 'search' ); ?>

							<?php endwhile; ?>

				        <?php tgs_wp_pagination(); ?>

					<?php } else { ?>

						<?php get_template_part( 'content/no-results', '' ); ?>

					<?php } ?>
				</div>
				<div class="col-md-1"></div>
				<?php get_sidebar(); ?>
			</div>
		</div>

	</div>

<?php get_footer();
