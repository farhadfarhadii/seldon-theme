<?php /* Template Name: Products/Solutions Detail Page */ ?>
<?php
/**
 * The template for displaying detail page for Products or Solutions.
 *
 * @package tgs_wp
 */

get_header(); ?>

<main>

	<div class="container-fluid">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('sections/page-hero'); ?>

			<?php get_template_part('sections/audience-toggle'); ?>

			<?php get_template_part('sections/intro-block'); ?>
				
			<?php get_template_part('sections/subproduct-blocks'); ?>

			<?php get_template_part('sections/benefits-blocks'); ?>

			<?php get_template_part('sections/content-blocks'); ?>

			<?php get_template_part('sections/pricing-blocks'); ?>

			<?php get_template_part('sections/form-blocks'); ?>

			<?php get_template_part('sections/cta-bar'); ?>

		<?php endwhile; ?>
	
	</div>

</main>

<?php get_footer();
