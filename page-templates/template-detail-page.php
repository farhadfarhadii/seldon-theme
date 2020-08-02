<?php /* Template Name: Products/Solutions Detail Page */ ?>
<?php
/**
 * The template for displaying detail page for Products or Solutions.
 *
 * @package tgs_wp
 */

get_header(); ?>

<main>
	<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
		<div style="width:60%" class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<!--<h5 class="modal-title" id="workflowModalLabel">Workflow Example</h5>-->
					<button id="closeVideoModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<video id="modalVideo" controls style="position:relative;width:100%" src type="video/mp4">
					</video>
				</div>
			</div>
		</div>
	</div>

	
	<div class="container-fluid">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('sections/page-hero'); ?>

			<?php get_template_part('sections/audience-toggle'); ?>

			<?php get_template_part('sections/intro-block'); ?>
				
			<?php get_template_part('sections/benefits-blocks'); ?>

			<?php get_template_part('sections/content-blocks'); ?>

			<?php get_template_part('sections/cta-bar'); ?>

		<?php endwhile; ?>
	
	</div>

</main>

<script defer>
	var closeBtn = document.getElementById('closeVideoModal'), 
		modalVideo = document.getElementById('modalVideo')
	
	Object.values(document.getElementsByClassName('video-btn')).forEach(function(el){
		el.onclick = function(event){
			modalVideo.src = event.target.dataset.src
		}
	})
	
	closeBtn.onclick = function(event){
		modalVideo.pause()
	}
	
</script>

<?php get_footer();
