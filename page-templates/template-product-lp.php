<?php /* Template Name: Products Landing Page */ ?>
<?php
/**
 * The template for displaying landing page for Products
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

			<?php get_template_part('sections/benefits-blocks'); ?>				

			<?php get_template_part('sections/product-showcase'); ?>

			<?php get_template_part('sections/content-blocks'); ?>

			<?php get_template_part('sections/pricing-blocks'); ?>

		<?php endwhile; // end of the loop. ?>
	</div>
</main>

<?php get_footer();
