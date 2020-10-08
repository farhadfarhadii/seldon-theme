<?php if (have_rows('forms')) : ?>
	<section class="row maxout forms">

		<?php while (have_rows('forms')) : the_row();
			$image = get_sub_field('left-side_image');
			$imageUrl = $image["url"];
			$imageAlt = $image["caption"];

			$gformId = get_sub_field('gformId'); 
			$bg_color = get_sub_field( 'bg_color' );
			$block_style = get_sub_field( 'block_style' );
			
			if ($block_style == "flush-left") {
				$wrap_col_style = "col-sm-12";
				$form_col_style = "col-sm-11 col-sm-offset-1";
			} else if ($block_style == "margin-left") {
				$wrap_col_style = "col-sm-11 col-sm-offset-1";
				$form_col_style = "col-sm-12";
			}

			?>

			<div class="<?php echo $wrap_col_style; ?> z-3">
				<div class="row form-section bg_<?php echo $bg_color; ?>">	
					<div class="<?php echo $form_col_style; ?>">

						<div class="row">					
							<div class="col-xs-12 col-sm-4 col-sm-offset-1">
								<img src="<?php echo $imageUrl; ?>" alt="<?php echo $imageAlt; ?>">
							</div>
							<div class="col-xs-12 col-sm-4 col-sm-offset-2">
								<?php 
								gravity_form( $gformId, false, false, false, null, true );
								?>
							</div>
						</div>

					</div>

				</div>
			</div>
		<?php endwhile; ?>
	</section>
<?php endif; ?>