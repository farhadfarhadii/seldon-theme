<?php 

$homeId = get_option( 'page_on_front' );
if (have_rows('partner_logos', $homeId)) : ?>

<div id="PartnersHome" class="row mt-40 mb-25">
	<div class="col-xs-12 maxout">
		<div class="row">
			
	<?php while (have_rows('partner_logos', $homeId)) : the_row(); 

		$d_image = get_sub_field( 'desktop_image' );
		$d_image_url = $d_image['url'];

		$t_image = get_sub_field( 'tablet_image' );
		$t_image_url = $t_image['url'];

		$m_image = get_sub_field( 'mobile_image' );
		$m_image_url = $m_image['url'];

		?>

		<div class="col-sm-11 col-sm-offset-1">
			<p class="font-size-13 color_darkgrey666">Proudly working with</p>

			<img class="desktop" alt="Partners and Investors Logos" src="<?php echo $d_image_url; ?>" />
			<img class="tablet" alt="Partners and Investors Logos" src="<?php echo $t_image_url; ?>" />
			<img class="mobile" alt="Partners and Investors Logos" src="<?php echo $m_image_url; ?>" />

		</div>


	<?php endwhile; ?>
		</div>
	</div>				
</div>

<?php endif; ?>		
