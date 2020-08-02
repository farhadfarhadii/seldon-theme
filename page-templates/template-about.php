<?php /* Template Name: About Us Page */ ?>
<?php
/**
 * The template for displaying the About Us page.
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

			

<?php if (have_rows('seldon_bios') ) : $i = 0; ?>
	<div class="row bios seldon z-2">
		<div class="col-xs-12 z-2 pt-100 bleed_right bg_midgrey">
			<div class="row">
				<div class="col-sm-11 col-sm-offset-1">
					
					<h2 class="mb-50">We are Seldon...</h2>
			
					<div class="row">
			
	<?php while (have_rows('seldon_bios')) : the_row();
		$i++;

		$image = get_sub_field( 'image' );
		$image_url = $image['url'];
		$name = get_sub_field( 'name' );
		$title = get_sub_field( 'title' );
		$bio = get_sub_field( 'bio' );

		$col_class = "col-sm-6 col-md-3";
		$bigheadslots_left = array(1,7,13,19);
		$bigheadslots_right = array(6,12,18,24);

		if (in_array($i, $bigheadslots_left)) {
			// $col_class = "col-sm-5 col-sm-offset-right-1";
			$col_class = "col-sm-6 col-md-5 col-md-offset-right-1";
		} else if (in_array($i, $bigheadslots_right)) {
			$col_class = "col-sm-6 col-md-5 col-md-offset-1";
		}
		?>

		<div class="<?php echo $col_class; ?> mb-50 match-height-bio-block">
			<img class="bio_image" alt="<?php echo $name; ?> Bio Picture" src="<?php echo $image_url; ?>" />
			<h3 class="bio_name"><?php echo $name; ?></h3>
			<span class="bio_title"><?php echo $title; ?></span>
			<p class="bio_text"><?php echo $bio; ?></p>
		</div>

	<?php endwhile; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>


<?php if (have_rows('advisors_bios') ) : ?>
	<div class="row bios advisors mt--15">
		<div class="col-xs-12 pt-100 mt--50 bleed_full bg_black">
			<div class="row maxout">
				<div class="col-sm-11 col-sm-offset-1">
					<h2 class="mb-50">Our board and advisors</h2>
					<div class="row">				
						<?php while (have_rows('advisors_bios')) : the_row();
							$image = get_sub_field( 'image' );
							$image_url = $image['url'];
							$name = get_sub_field( 'name' );
							$bio = get_sub_field( 'bio' );
							?>

							<div class="col-sm-6 col-md-3 pb-60 match-height-bio-block">
								<img class="bio_image" alt="<?php echo $name; ?> Bio Picture" src="<?php echo $image_url; ?>" />
								<h3 class="bio_name"><?php echo $name; ?></h3>
								<p class="bio_text"><?php echo $bio; ?></p>
							</div>

						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>


<?php if (have_rows('partners') ) : ?>
	<div class="row bios partners mt--15">
		<div class="col-xs-12 pt-100 pb-80 mt--50 bleed_full bg_black">
			<div class="row maxout">
				<div class="col-sm-11 col-sm-offset-1">


				<h2 class="mb-50">Investors and partners</h2>
				<div class="row">				
				<?php while (have_rows('partners')) : the_row();
					$d_image = get_sub_field( 'desktop_image' );
					$d_image_url = $d_image['url'];

					$t_image = get_sub_field( 'tablet_image' );
					$t_image_url = $t_image['url'];

					$m_image = get_sub_field( 'mobile_image' );
					$m_image_url = $m_image['url'];

					?>

					<div class="col-sm-12">
						<img class="show_desktop" alt="Partners and Investors Logos" src="<?php echo $d_image_url; ?>" />
						<img class="show_tablet" alt="Partners and Investors Logos" src="<?php echo $t_image_url; ?>" />
						<img class="show_mobile" alt="Partners and Investors Logos" src="<?php echo $m_image_url; ?>" />

					</div>

				<?php endwhile; ?>
				</div>

			</div>
		</div>
	</div>
<?php endif; ?>




		<?php endwhile; ?>
	</div>
</main>

<?php get_footer();
