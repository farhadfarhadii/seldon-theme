<?php if (have_rows('pricing_blocks') ) : ?>

	<div class="row maxout">
<!--<div class="col-sm-11 col-sm-offset-1 mv-20"> -->
	<div class="col-sm-12 bleed_none mv-20 bg_black">
		<div class="row pricing-blocks-wrap">
		
			<?php while (have_rows('pricing_blocks')) : the_row(); 
				$planName = get_sub_field( 'pricing_plan_name' );
				
				?>
				<div class="col-md-6">
					<div class="pricing-block bg_<?php echo get_sub_field( 'bg_color' ); ?>">
						<h3 class="pricing-header rule_<?php echo get_sub_field( 'hilite_color' ); ?>">
							<?php echo $planName; ?>						
						</h3>
						<?php echo get_sub_field('description'); ?>

						<?php if (get_sub_field( 'price' )): ?>						
							<div class="block-bottom-content">
								<span class="price">
									&pound;<?php echo get_sub_field( 'price' ); ?>
								</span>
								<span class="price-note">
									<?php echo get_sub_field( 'price_desc' ); ?>
								</span>
							</div>
						<?php endif ?>

						<?php if (get_sub_field( 'include_request_demo_button' )): ?>
							<div class="block-bottom-content">
								<a role="button" class="btn btn_black" data-toggle="modal" data-target="#modalDemoRequest">Request Demo</a>					
							</div>

						<?php endif ?>
					</div>
				</div>
				

			<?php endwhile; ?>
			</div>		

		</div>
	</div>
<?php /*
<a role="button" data-toggle="modal" data-target="#modalDemoRequest"><?php echo $text; ?></a>
*/
?>


<?php endif; ?>
