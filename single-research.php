<?php
/**
 * The Template for displaying all single posts.
 *
 * @package tgs_wp
 */

get_header(); ?>

<?php 
	$image = get_the_post_thumbnail_url();
?>

<div class="container-fluid">
	
	<div class="row">
		<div id="PageHero_Basic" class="col-xs-12 maxout" style="background-image: url(<?php echo $image; ?>);">

			<div class="research-title-wrap over-image hide-sm-down" class="row">
				<div class="col-sm-11 col-sm-offset-1">
					<div class="row">
						<div class="col-md-2 match-height">
							<span class="return-to-research-LP">
								&lt; <a href="<?php echo home_url( '/research/' ); ?>">Research home</a>	
							</span>
						</div>
						<div class="research-page-title col-md-9 col-md-offset-1 match-height">
							<div class="row">
								<div class="col-md-10 col-lg-9">
									<span class="pub-type">Publication</span>
									<h1><?php the_title(); ?></h1>							
								</div>							
							</div>
						</div>					
					</div>				
				</div>
			</div>

		</div>

	</div>

	<div class="row">

		<div class="research-title-wrap below-image hide-sm-up col-sm-12">
			<div class="row">
				<div class="research-page-title col-sm-11 col-sm-offset-1">
					<span class="pub-type">Publication</span>
					<h1><?php the_title(); ?></h1>
				</div>					
				<div class="col-sm-11 col-sm-offset-1">
					<span class="return-to-research-LP">
						&lt; <a href="<?php echo home_url( '/research/' ); ?>">Research home</a>	
					</span>
				</div>

			</div>				
		</div>



		<div id="ResearchContentWrap" class="col-xs-12 maxout">
			<div id="ResearchContent" class="row">
				<div class="col-sm-11 col-sm-offset-1">			

					<div class="row">
						

						<?php // begin main page content ?>
						<div id="content" class="main-content-inner col-sm-9 col-sm-push-3 col-md-push-2 col-md-offset-1">
							<?php while ( have_posts() ) : the_post(); ?>

								<div class="row">
									<div class="col-sm-11 col-md-9">
								
<?php if( have_rows('flex_content') ): ?>
    <?php while( have_rows('flex_content') ): the_row(); ?>
        <?php if( get_row_layout() == 'text_block' ): ?>
        	<div class="mb-40">
	            <?php the_sub_field('text'); ?>    		
        	</div>

        <?php elseif( get_row_layout() == 'image' ): 
            $image = get_sub_field('image');
            $caption = get_sub_field( 'caption' );
            ?>
            <figure>
                <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
                <figcaption><?php echo $caption; ?></figcaption>
            </figure>

        <?php elseif( get_row_layout() == 'pullquote' ): 
            $quote = get_sub_field('quote');
            $citation = get_sub_field( 'citation' );
			?>
			<blockquote>
				<p>
					<?php echo $quote; ?><span class="close-quote"></span>			
				</p>
				<footer><?php echo $citation; ?></footer>
			</blockquote>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>


									</div>

								</div>

								<?php 
								$hasSources = get_field('sources');
								if ($hasSources) {
								?>

								<div class="row">
									<div class="col-sm-11 col-md-9">
										<div id="PubSources">
											Sources: <?php the_field('sources'); ?>	
										</div>
									</div>
								</div>
							<?php } ?>
							<?php endwhile; ?>

						</div> <?php // end main content ?>


						<?php // research sidebar  ?>


						<div class="col-sm-3 col-sm-pull-9 col-md-2 col-md-pull-10 pub-sidebar">
							<div class="pub-author-list mb-30">						
<?php 
if( have_rows('authors') ):
	$authorCount = 0;
    while ( have_rows('authors') ) : the_row();
    	$authorCount++;
        $isWPAuthor = get_sub_field('author_is_WP_user');
        if ($isWPAuthor) {
        	$authorObj = get_sub_field('author_wp');
        	// print_r($authorObj);
        	$authorName = $authorObj["display_name"];
        	$authorNickName = $authorObj["nickname"];
        	$authorList .= "<a href='". esc_url( home_url() )."/author/".$authorNickName."'>" . $authorName . "</a><br /> ";

        } else {
        	$authorList .= get_sub_field( 'author_not_wp' ) . "<br />";
        }
    endwhile;

else :
	$authorList = "";
endif;

?>
								<span class="font-size-12">Author<?php echo $authorCount > 1 ? "s" : ""; ?>:</span><br />
								<?php echo $authorList; ?>

							</div>
							<div class="mb-30">
								<span class="font-size-12">Date of publication:</span><br />
<?php 
$pubDate = get_field('date_of_publication');
?>

								<?php echo date('F j, Y', strtotime($pubDate)); ?>
							</div>

							<div class="social-share mb-50">
								<?php 
									$subject = "Check out this research from Seldon";
									$title = get_the_title();
									$url = urlencode(get_the_permalink());
									$body = $title . "%0D" . $url;
								?>
								<span class="font-size-12">Share:</span><br />
<a href="http://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=Seldon" target="_blank"><i class="fa fa-linkedin-square"></i></a>
<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
<a href="mailto:?subject=<?php echo $subject; ?>&body=<?php echo $body; ?>"><i class="fa fa-envelope-o"></i></a>

							</div>

							<div class="buttons">
								<?php 
									$pubLink = get_field('link_to_publication_site');
									$downloadLink = get_field('document_for_downloading');
								?>
								<?php if ($pubLink) { ?>
									<a href="<?php echo $pubLink; ?>" target="_blank" class="btn icon icon-arrow-up-right">View Link</a><br />
								<?php } ?>
								<?php if ($downloadLink) { ?>
									<a href="<?php echo $downloadLink; ?>" target="_blank" class="btn icon icon-download">Download</a>
								<?php } ?>

							</div>

						</div> <?php // end sidebar ?>


						<div class="<?php echo $hasSources ? "no-rule" : ""; ?> col-sm-9 col-sm-push-3 col-md-push-2 col-md-offset-1">
								<div class="row">
									<div class="col-sm-11 col-md-9">
										<?php  tgs_wp_content_nav( 'nav-below' ); ?>

										<?php
											// If comments are open or we have at least one comment, load up the comment template
											// if ( comments_open() || '0' != get_comments_number() ) {
											// 	comments_template();
											// }
										?>

									</div>
								</div>							


						</div>

					</div>



				</div><!-- end offset 1 -->



			</div>
		</div>

	</div>

</div>

<?php get_footer();
