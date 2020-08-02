<?php
/**
 * The template for displaying all pages.
 *
 * @package tgs_wp
 */

get_header(); ?>

<main>
	<div class="container-fluid">

	<?php if ( have_posts() ) { 

		$techId = get_id_by_slug('tech');
		get_template_part( 'sections/page-hero' );

		?>

		<section class="row">
			<div class="col-xs-12 maxout">
				<div class="row">

					<?php get_template_part('elements/audience-toggle-home'); ?>

					<?php $cta_block = get_field('intro_cta', $techId); ?>			
					<div id="HomeCTABlock" class="col-sm-5 match-height-home-cta">
						<h2 class="mt-0 mb-20"><?php echo $cta_block['title'] ?></h2>
						<?php echo $cta_block['text'] ?>	
						<a class="btn mt-20" href="<?php echo $cta_block['button_link']; ?>">
							<?php echo $cta_block['button_text'] ?>
						</a>
					</div>
				</div>
			</div>

		</section>
		<?php get_template_part('sections/product-showcase-tabs'); ?>

		<?php get_template_part('sections/home-partners'); ?>


		<?php } ?>

	</div>
</main>
<?php get_footer();
