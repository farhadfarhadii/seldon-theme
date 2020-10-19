<?php /* Template Name: Careers Page */ ?>
<?php
/**
 * The template for displaying the Careers page.
 *
 * @package tgs_wp
 */

get_header(); ?>

<?php


	function makeAbstract($data){

		$parsed = html_entity_decode($data, ENT_QUOTES, 'utf-8');

		$parsed = str_replace(array("\n","\r\n","\r"),'', $parsed);

		preg_match('/<div>(?!&nbsp;|<\/div>).*<\/div><p>&nbsp;<\/p>/', $parsed, $matches);

		return $matches[0];
		
	}

	// Get a list of job vaccanies from greenhouse.
    $url = 'https://boards-api.greenhouse.io/v1/boards/seldon/jobs?content=true';

    try {
		$contents = json_decode(file_get_contents($url));
    } catch(Exception $err) {
		// echo the error server side for debugging.
        echo $err->getMessage();
    }
?>

<main>
	<div class="container-fluid">

		<?php get_template_part( 'sections/page-hero' ); ?>

		<?php get_template_part('sections/intro-block'); ?>		

		<?php get_template_part('sections/content-blocks'); ?>
	
		<div id="CareersListing" class="row mt--30 bg_lightgrey pb-80">
			<div class="col-sm-12 maxout">
				<div class="row">
					<div class="col-sm-11 col-sm-offset-1">
						<?php if($contents && $contents->meta->total !== 0 ):?>
							<h2 class="mb-50 section-headline">Current vacancies</h2>
						<?php endif; ?>
						<?php if ($contents && $contents->meta->total !== 0 ):?>
							<?php foreach ($contents->jobs as $job):?>
								<div class="row career-block bg_yellow mv-20">
									<div class="job-title col-sm-5 col-md-4 pos-relative match-height-career-block">
										<h3>							
										<a href="<?php echo $job->absolute_url ?>" target="_blank"><?php echo $job->title ?></a>
										</h3>
									</div>
									<div class="job-description col-sm-7 col-md-8 col-sm-pad-left-1 col-sm-pad-right-1 bg_black pv-60 match-height-career-block">
										<?php echo makeAbstract($job->content); ?>
										<div>
											<a href="<?php echo $job->absolute_url ?>" target="_blank" class="btn margin-top-20">Read More</a>
										</div>
									</div>
								</div>
						<?php endforeach; endif; ?>					
					</div>
				</div>
			</div>
		</div>
		<?php 
			$video_url = get_field( 'video_url' );
			if ($video_url):
		?>
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
		<?php endif; ?>
	</div>
</main>

<?php get_footer();
