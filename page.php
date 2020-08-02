<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package tgs_wp
 */

get_header(); ?>

<main>
	<div class="container-fluid">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'sections/page-hero' ); ?>

			<?php get_template_part('sections/intro-block'); ?>		

			<?php get_template_part('sections/content-blocks'); ?>

			<div class="row bg_lightgrey pv-100">
				<div class="col-xs-12 maxout">
					<div class="row">
						<div class="col-sm-11 col-sm-offset-1">
							<?php the_content(); ?>						
						</div>						
					</div>					
				</div>			
			</div>


		<?php endwhile; ?>
	</div>

</main>

<?php get_footer();