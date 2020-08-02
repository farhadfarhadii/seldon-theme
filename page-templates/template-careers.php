<?php /* Template Name: Careers Page */ ?>
<?php
/**
 * The template for displaying the Careers page.
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


<?php if (have_rows('careers') ) : ?>
	<div id="CareersListing" class="row mt--30 bg_lightgrey pb-80">
		<div class="col-sm-12 maxout">

			<div class="row">
				<div class="col-sm-11 col-sm-offset-1">
					
					<h2 class="mb-50 section-headline">Current vacancies</h2>
					<?php while (have_rows('careers')) : the_row();
						$position = get_sub_field( 'position' );
						$link = get_sub_field( 'link' );
						$description = get_sub_field( 'description' );
						?>

						<div class="row career-block bg_yellow mv-20">

							<div class="job-title col-sm-5 col-md-4 pos-relative match-height-career-block">
								<h3>							
								<a href="<?php echo $link; ?>" target="_blank"><?php echo $position; ?></a>
								</h3>

							</div>

							<div class="job-description col-sm-7 col-md-8 col-sm-pad-left-1 col-sm-pad-right-1 bg_black pv-60 match-height-career-block">
								<?php echo $description; ?>

								<a href="<?php echo $link; ?>" target="_blank" class="btn margin-top-20">Read More</a>

							</div>

						</div>

					<?php endwhile; ?>

				</div>			
			</div>
		</div>
	</div>
<?php endif; ?>

<?php 
	$video_url = get_field( 'video_url' );
	if ($video_url) { ?>
<div id="CareersVideo" class="row mt--15">
	<div class="col-xs-12 pt-100 pb-100 mt--30 bleed_full bg_black">
		<div class="row maxout">
			<div class="col-sm-11 col-sm-offset-1">

				<div class="embed-responsive embed-responsive-16by9">
				    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/d9qAjkAHtWI"></iframe>
				</div>

			</div>
		</div>
	</div>
	
</div>




<?php } ?>



		<?php endwhile; ?>
	</div>

</main>

<?php get_footer();
