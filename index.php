<?php
/**
 * @package tgs_wp
 */

get_header(); ?>

<div class="main-content">

	<div class="container-fluid">

		<?php get_template_part( 'sections/page-hero' ); ?>
		
		<div class="row sidebar-wrap">
			<div class="col-xs-12 maxout">
				<div class="row">
					<?php get_sidebar(); ?>						
				</div>
			</div>
		</div>	

		<div class="row maxout pt-40">
			<div id="content" class="main-content-inner col-xs-12">

				 <div class="row maxout">
				 	<div class="col-sm-11 col-sm-offset-1">

						<?php if ( have_posts() ) { ?>		
							<div class="row post-listing">

							<?php while ( have_posts() ) : the_post(); ?>
	
								<?php // get_template_part( 'content/content', get_post_format() ); ?>
								<?php get_template_part( 'content/content', 'search' ); ?>

							<?php endwhile; ?>
							</div>

							<?php get_template_part( 'elements/loadmore-button' ); ?>

						<?php } else { ?>
							<div class="mb-30 col-xs-12">
								<?php get_template_part( 'content/no-results', '' ); ?>
							</div>

						<?php } ?>

						</div>					 		
				 	</div>


				</div>

			</div> <?php // end #content ?>


		</div>
	</div>

</div>

<?php get_footer();
