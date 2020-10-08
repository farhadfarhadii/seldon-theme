<?php
	global $loop;
	global $colClass;
	global $removePosts;
	
	if ( $loop->have_posts() ) {
		$count = 0;
		while ( $loop->have_posts() ) {
			$count++;
			$loop->the_post(); 
			
			$imgUrl = get_the_post_thumbnail_url();
			$postId = get_the_id();
			$removePosts[] = $postId;
			$postType = get_post_type();

			$postTypeDesc = "";
			$authorList = "";

			$catOpenSource = get_category_by_slug('open-source');
			$catIdOpenSource = $catOpenSource->term_id;

			if ($postType == "post") {
				$postTypeList = wp_get_post_categories($postId);
				$postTypeDesc = "Blog";
				if (in_array($catIdOpenSource, $postTypeList)) {
					$postTypeDesc = "Open Source";
				}
			} else {
				$postTypeDesc = "Publication";
				$authorList = getAuthorList($postId);
			}

			?>					
				<div class="col-xs-12 col-sm-6 <?php echo $colClass; ?> col_<?php echo $count; ?>">
					<div class="research-pub-summary-wrap" style="background: #fff;">
						<a href="<?php the_permalink(); ?>">	
							<div class="post-image-wrap" style="background-image: url(<?php echo $imgUrl; ?>)">
							</div>
						</a>
						<div class="pub-summary p-15">
							<div class="pub-categories">
								<?php echo $postTypeDesc; ?>
							</div>

							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</div>

						<div class="by-line">
							<?php if ($postType == "post") { ?>
								<div class="post-author-date">
		 							<?php tgs_wp_posted_on(); ?>								
								</div>
							<?php } else { // is Research Publication CPT ?>

								<dl class="pub-authors">
									<?php 
										global $authorCount;
										if ($authorCount > 0) { ?>
										<dt>Author<?php echo $authorCount > 1 ? "s" : ""; ?>:</dt>
										<dd><?php echo $authorList; ?></dd>
									<?php } ?>

									<dt>DOP:</dt>
									<dd><?php echo date('F j, Y', strtotime(get_field( 'date_of_publication' ))); ?></dd>

								</dl>
								 							
							<?php } ?>
						</div>									
					</div>
				</div>		

	<?php		
		} // end while
	} // end if

wp_reset_postdata();