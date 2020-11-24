<?php /* Template Name: Solutions Landing Page */ ?>
<?php
/**
 * The template for displaying landing page for Solutions
 *
 * @package tgs_wp
 */

/** 
 * Start a session here. This will be used to track the user
 * through the checkout process, and help the user return
 * to the previous page should they cancel at the checkout.
*/ 

session_destroy();

get_header(); ?>

<main>
	<div class="container-fluid">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'sections/page-hero' ); ?>

			<?php get_template_part('sections/audience-toggle'); ?>	

			<?php get_template_part('sections/intro-block'); ?>				

			<?php get_template_part('sections/benefits-blocks'); ?>				

			<?php if (have_rows('roles_section')) : 
				$i = 0;
				?>

<div class="row maxout mb-80 pt-100 mt--50 bg_lightgrey">
	<div id="SolutionsRoles" class="col-sm-12">

		<div class="row">
			<div class="maxout z-1 col-sm-11 col-sm-offset-1">
				<div class="row">
					<?php 
					$role_section = get_field( 'roles_section' );
					$title = $role_section['title']; 
					?>
					<div class="col-md-3 match-height-roles">
						<h3 class="mt-0">
							<?php echo $title; ?>
						</h3>
					</div>

					<?php while (have_rows('roles_section')) : the_row(); ?>
						<?php if (have_rows('role')) :
							while (have_rows('role')) : the_row();
								$title = get_sub_field( 'title' );
								$text = get_sub_field( 'role_text' );
								$link = get_sub_field( 'link' );
						 		?>

								<div class="col-md-3 role-block match-height-roles pb-50">
										
									<strong><?php echo $title; ?></strong><br>
									<?php echo $text; ?>
									<?php /* not for Phase 1 Jun 10 ?>
									<a role="button" class="btn mt-30" href="<?php echo $link; ?>">Read more</a>
									*/ ?>

								</div>
							<?php endwhile; ?>
						<?php endif; ?>

					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</div>

			<?php endif; ?>

			<?php get_template_part('sections/content-blocks'); ?>

			<?php get_template_part('sections/pricing-blocks'); ?>

		<?php endwhile; // end of the loop. ?>
	</div>
</main>

<?php get_footer();
