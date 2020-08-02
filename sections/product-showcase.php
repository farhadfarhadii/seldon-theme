<?php if (have_rows('showcase')) : 
	$i = 0;
	?>

<div class="row maxout mb-80">
	<div class="col-sm-12">
		
		<div class="row pt-50 pb-0">
			<div class="col-sm-11 col-sm-offset-1">
				<h3 class="showcase-header">Products</h3>
			</div>
		</div>

		<?php while (have_rows('showcase')) : the_row();
			$i++;

			if ($i == 1) {
				$left_col_class = "col-sm-7 col-sm-push-5 col-md-6 col-md-push-6 primary first-product";
				$right_col_class = "col-sm-5 col-sm-pull-7 col-md-6 col-md-pull-6 first-product";
				$info_col_class = "product-info";
			} else {
				$left_col_class = "col-sm-5 col-md-4 col-lg-3";
				$right_col_class = "col-sm-7 col-md-8 col-lg-9";
				$info_col_class = "";			
			}
			
			$info_bg = $i == 1 ? "bg_white" : "";

			$title = get_sub_field( 'title' );
			$text = get_sub_field( 'text' );
			$button_text = get_sub_field( 'cta_button_text' );
			$link = get_sub_field( 'cta_button_link' );
			$image = get_sub_field( 'image' );
			$image_url = $image['url'];
			?>

			<div class="showcase row mv-15 <?php echo $info_bg; ?>">
				<div class="col-sm-11 col-sm-offset-1">
					<div class="row">					
						<div class="match-height-showcase product-image clickable <?php echo $left_col_class; ?>" style="<?php echo $i == 1 ? "background-image: url(" . $image_url . "); background-size: cover; background-position: center center" : ""; ?>">
							<img src="<?php echo $image_url; ?>" class="<?php echo $i == 1 ? "hide_desktop" : ""; ?>" />
 							<a href="<?php echo $link; ?>" class="sr-only"><?php the_sub_field('title'); ?></a>

						</div>
						<div class="match-height-showcase <?php echo $right_col_class; ?>">
							<div class="<?php echo $info_col_class; ?>">
								
								<h3><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h3>
								<p><?php echo $text; ?></p>
								<?php if ($i == 1) : ?>
									<a href="<?php echo $link; ?>" role="button" class="btn" ><?php echo $button_text; ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php endwhile; ?>

	</div>
</div>

<?php endif; ?>