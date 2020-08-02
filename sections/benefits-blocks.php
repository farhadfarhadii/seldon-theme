<?php if (have_rows('benefits') ) : 
	$count = count(get_field('benefits'));
	$col_class = $count == 3 || $count == 5? 'col-sm-4' : 'col-sm-6';
	?>
	<section class="row maxout">
		<div class="col-sm-11 col-sm-offset-1 z-3 mt--50">
			<div class="row pt-50 bg_white benefits">	

				<?php while (have_rows('benefits')) : the_row();

					$image = get_sub_field('image');
					$title = get_sub_field('title'); 
					$text = get_sub_field('text');

					?>
					<div class="match-height-benefits-blocks block <?php echo $col_class; ?>">
						<?php if ($image): ?>
							<div class="benefits-icon-wrapper">
								<img src="<?php echo $image['url']; ?>" class="svg-convert" />
							</div>

						<?php endif; ?>
						<h4><?php echo $title; ?></h4>
						<p>
							<?php echo $text; ?>
						</p>							
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; ?>