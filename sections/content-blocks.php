<div class="row">
	<div class="col-xs-12">

		<?php 
		if (have_rows('content_blocks') ) :
			while (have_rows('content_blocks')) : the_row();

				$title = get_sub_field( 'title' );					
				$content = get_sub_field( 'content' );

				$bg_color = get_sub_field( 'bg_color' );
				$bg_bleed = get_sub_field( 'bg_bleed' );

				$content_class = "col-sm-12";

				$layout = get_sub_field( 'layout' );
				$z = "z-2";
				$title_position = "above";
				$gutter = false;

				if ($layout == "text") {
					$text_options = get_sub_field( 'text_options' );
					$content_position = $text_options['content_position'];
					$content_width = $text_options['content_width'];
					$title_position = $text_options['title_position'];
					$content_class = "col-sm-7";
					$title_class = "";
					$gutter = $text_options['gutter'];

					if ($title_position == "above") {
						switch ($content_width) {
							case "full":
								$content_class = "col-sm-11";
								if ($bg_bleed == "full") {
									$content_class = "col-sm-12 ph-0";
								}
								break;
							case "twothirds":
								$content_class = "col-sm-8";
								if ($content_position == "right") {
									$content_class = "col-sm-9 col-sm-offset-2";
								}
								break;
							case "half":
								$content_class = "col-sm-6";
								if ($content_position == "right") {
									$content_class = "col-sm-7 col-sm-offset-4";
								}
								break;
							case "onethird":
								$content_class = "col-sm-4";
								if ($content_position == "right") {
									$content_class = "col-sm-5 col-sm-offset-6";
								}
								break;
						}
					} else {
						if ($content_position == "left") {
							$title_class = "col-sm-4 col-sm-push-7";
							$content_class = "col-sm-5 col-sm-pull-4";
						} else {
							$title_class = "col-sm-4";
							$content_class = "col-sm-7";							
						}
					}
		
				} else if ($layout == "image") {
					// block has image 
					$image_options = get_sub_field( 'image_options' );
					$image = $image_options['image'];
					$image_url = $image['url'];
					$image_position = $image_options['position'];
					$content_class = "col-sm-7";
					switch ($image_position) {
						case "full" :
							$bg_bleed = "full";
							$z = "z-1";
							$content_class = "col-sm-11";
							break;
						case "left_contained" :
							$content_class = "col-sm-6";
							$image_class = "col-sm-4 ph-0";
							if ($bg_bleed == "left" || $bg_bleed == "full") {
								$image_class = "col-sm-6";		
							}
							break;
						case "left_flush" :
							$content_class = "col-sm-7 col-sm-offset-4";
							if ($bg_bleed == "left" || $bg_bleed == "full") {
								$content_class = "col-sm-6 col-sm-offset-5";
							}
							break;
						case "right_contained" :
							$content_class = "col-sm-5";
							break;
						case "right_flush" :
							$content_class = "col-sm-5";
							break;

					}

					$alt_text = $image_options['alt_text'];

				} else if ($layout == "aside") {
					// block has pullquote or aside
					$aside_options = get_sub_field( 'aside_options' );
					$aside_content = $aside_options['content'];
					$aside_citation = $aside_options['citation'];
					$aside_position = $aside_options['position'];
					$content_class = "col-sm-6";
					if ($aside_position == "left") {
						$content_class = "col-sm-6 col-sm-offset-5";
					} else {
						$content_class = "col-sm-5";
					}
				}

				$block_class = "pt-80 pv-100 mt--50";
				if ($gutter) {
					$block_class = "pt-30 pv-50 mt-10";
				} 
	
			?>
<div class="row pos-relative">

	<div class="<?php echo $block_class; ?> col-xs-12 <?php echo $z; ?> bleed_<?php echo $bg_bleed; ?> bg_<?php echo $bg_color; ?> content-block">
		<div class="row pos-relative maxout">

			<?php if ($layout == "image" && $image_position == "left_flush") { ?>
				<div class="img_flush_left match-height-block-content">
					<img src="<?php echo $image_url; ?>" />
				</div>
			<?php } ?>

			<div class="col-sm-11 col-sm-offset-1 match-height-block-content">
				<?php if ($layout == "aside") { ?>
					<div class="aside pos_<?php echo $aside_position; ?>">
						<div class="content">
							<?php echo $aside_content; ?>				
						</div>
						<cite class="color_<?php echo $bg_color; ?>"><?php echo $aside_citation; ?></cite>
					</div>
				<?php } ?>


				<div class="row">
					<?php if ($layout == "image" && $image_position == "full") { ?>
						<div class="col-sm-12 pb-60 ph-0">
							<img src="<?php echo $image_url; ?>" />
						</div>
					<?php } ?>

					<?php if ($layout == "image" && $image_position == "left_contained") { ?>
						<div class="<?php echo $image_class; ?>">
							<img src="<?php echo $image_url; ?>" />
						</div>
					<?php } ?>

					<?php if ($title_position == "beside"): ?>
						<div class="<?php echo $title_class; ?> content-block__content">
							<h3 class="mt-0"><?php echo $title; ?></h3>						
						</div>						
					<?php endif ?>

					<div class="content-block__content <?php echo $content_class; ?>">
						<?php if ($title_position == "above"): ?>
							<h3 class="mt-0"><?php echo $title; ?></h3>
						<?php endif ?>

						<?php echo $content; ?>
					</div>			

					<?php if ($layout == "image" && $image_position == "right_contained") { ?>
						<div class="col-sm-7 pr-0 ">
							<img src="<?php echo $image_url; ?>" />
						</div>
					<?php } ?>
					
				</div>				
			</div>
			<?php if ($layout == "image" && $image_position == "right_flush") { ?>
				<div class="col-sm-6 img_flush_right match-height-block-content">
					<img src="<?php echo $image_url; ?>" />
				</div>
			<?php } ?>

		</div>
	</div>					
</div>

			<?php 
			endwhile;
		endif; ?>

	</div>

</div>