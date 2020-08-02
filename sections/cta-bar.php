<?php if (have_rows('cta_bar') ) : ?>

	<div class="row maxout">
<!--<div class="col-sm-11 col-sm-offset-1 mv-20"> -->
	<div class="col-sm-12 bleed_none mv-20">
			
	<?php while (have_rows('cta_bar')) : the_row();
		$cta_bar = get_field( 'cta_bar' );
		$has_cta = $cta_bar['has_cta_bar'];
		if ($has_cta) { 
			$text = $cta_bar['cta_text'];
			$demo_request = $cta_bar['demo_request'];
			$link = $cta_bar['link'];
			?>
			<div class="row">
				<div class="col-xs-12 pv-50 text-center cta_bar">
					<?php if (!$demo_request) { ?>
					<a href="<?php echo $link; ?>"><?php echo $text; ?></a>
				<?php } else { ?>
					<a role="button" data-toggle="modal" data-target="#modalDemoRequest"><?php echo $text; ?></a>
				<?php } ?>

				</div>
			</div>
		<?php } ?>

	<?php endwhile; ?>

		</div>
	</div>


<?php endif; ?>
