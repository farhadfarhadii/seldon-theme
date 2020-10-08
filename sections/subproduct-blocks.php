<?php if (have_rows('sub-products')) : ?>
	<section class="row maxout">
		<div class="col-sm-11 col-sm-offset-1 z-3 mt--50 mb--100">
			<div class="row sub-product-section">	

				<?php while (have_rows('sub-products')) : the_row();

					$name = get_sub_field('sub-product_name');
					$logo = get_sub_field('logo_graphic'); 
					$intro = get_sub_field( 'intro_text' );
					$whitePaperLink = get_sub_field('white_paper_link');
					$techDocsLink = get_sub_field('tech_docs_link');
					$hiliteColor = get_sub_field('hilite_color') ? get_sub_field('hilite_color') : "teal";

					?>
					<div class="col-sm-6 benefits">
						<div class="bg_white sub-product-wrap">
							
							<img src="<?php echo $logo['url']; ?>" alt="<?php echo $name; ?>" class="logo mb-30 svg-convert" />
							<p class="mv-30">
								<?php echo $intro; ?>
							</p>
							<a href="<?php echo $whitePaperLink; ?>" target="_blank" class="mv-15 btn btn_<?php echo $hiliteColor; ?>">Latest White Paper</a>
							<?php 
							
							if (have_rows('benefits')) :
								while (have_rows('benefits')) : the_row();
									$icon = get_sub_field( 'icon' );
									$text = get_sub_field( 'text' );
									?>
									<div class="mt-50">								
										<?php if ($icon): ?>
											<div class="benefits-icon-wrapper">
												<img src="<?php echo $icon['url']; ?>" class="fill_<?php echo $hiliteColor; ?> svg-convert" />
											</div>
										<?php endif; ?>
										<p class="mv-15">
											<?php echo $text; ?>
										</p>
									</div>
								<?php 
								endwhile;
							endif;	
							
							?>

							<a href="<?php echo $techDocsLink; ?>" target="_blank" class="mv-30 btn btn_<?php echo $hiliteColor; ?>">Tech Docs</a>
						</div>

					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; ?>