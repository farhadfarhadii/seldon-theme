<?php 
	$pageId = is_front_page() ? get_id_by_slug('tech') : get_the_ID();
?>

<section class="showcase desktop home row">
	<div class="col-xs-12 maxout mt--45">
		<div class="row">
			<div class="col-xs-11 col-sm-offset-1">
				<h2 id="ProductShowcaseTitle" class="mt-0 mb-15">Products</h2>
			</div>
			<div class="col-xs-12">
				
				<div class="row">
					
				<?php if( have_rows('showcase', $pageId) ): ?>

					<div id="ProductShowcase" class="tab-content col-xs-12">

					<?php 
					$count = 0;
					while( have_rows('showcase', $pageId) ): the_row(); 
						$count++;
						$link_url = get_sub_field("cta_button_link");
						?>
						
						<div class="tab-pane row <?php echo $count == 1 ? 'active' : ''; ?>" id="ShowcaseItem<?php echo $count ?>">
							<div class="col-sm-5 col-sm-offset-1 info match-height-showcase pr-30 clickable">
								<h3 class="mt-0"><a href="<?php echo $link_url; ?>"><?php the_sub_field('title'); ?></a></h3>
								<p>
									<?php the_sub_field('text'); ?>	
								</p>
								<a class="btn mt-20" href="<?php echo $link_url; ?>">
									<?php the_sub_field("cta_button_text"); ?>
								</a>

							</div>
							<?php 
							$image = get_sub_field("image");
							$imageUrl = $image['url'];
							?>
							<div class="clickable col-sm-6 image match-height-showcase" style="background-image: url(<?php echo $imageUrl; ?>);">
								<a href="<?php echo $link_url; ?>" class="sr-only"><?php the_sub_field('title'); ?></a>
							</div>
						</div>
					<?php endwhile; ?>

					</div>

					<ul class="nav nav-pills nav-justified">	
					<?php 
					$count = 0;
					while( have_rows('showcase', $pageId) ): the_row(); 
						$count++;
						?>
						<li class="<?php echo $count == 1 ? "active" : ""; ?>">
							<a href="#ShowcaseItem<?php echo $count ?>" data-toggle="tab"><?php the_sub_field('title'); ?></a>
						</li>
					<?php endwhile; ?>
					</ul>


				<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="showcase tablet home row">

	<div class="col-xs-12 maxout mt--45">
		<div class="row">
			<div class="col-xs-11 col-sm-offset-1">
			<h2 id="ProductShowcaseTitle" class="mt-0 mb-15">Products</h2>

			</div>
			<div class="col-xs-12">
				
				<div class="row">
					
				<?php if( have_rows('showcase', $pageId) ): ?>

					<div id="ProductShowcase" class="col-xs-12">

					<?php 
					while( have_rows('showcase', $pageId) ): the_row(); 
						$link_url = get_sub_field("cta_button_link");
						?>
						
						<div class="row">
							<?php 
							$image = get_sub_field("image");
							$imageUrl = $image['url'];
							?>
							<div class="col-xs-12 image" style="background-image: url(<?php echo $imageUrl; ?>);">
							</div>

							<div class="col-xs-12 info clickable">
								<h3 class="mt-0"><a href="<?php echo $link_url; ?>"><?php the_sub_field('title'); ?></a></h3>
								<p>
									<?php the_sub_field('text'); ?>	
								</p>
								<a class="btn mt-20" href="<?php echo $link_url; ?>">
									<?php the_sub_field("cta_button_text"); ?>
								</a>

							</div>
						</div>
					<?php endwhile; ?>

					</div>

				<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</section>


