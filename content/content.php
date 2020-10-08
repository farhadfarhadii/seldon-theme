<?php
/**
 * @package tgs_wp
 */
?>

<article class="col-sm-6 col-md-4 article-wrap match-height" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-summary-content-wrap">
	
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<div class="post-image-wrap" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">		
			</div>
		</a>

		<div class="article-summary-wrap">
				
			<header>
				<?php if ( 'post' === get_post_type() ) { ?>
					<div class="entry-meta mt-0 mb-20">
						<?php get_template_part( 'elements/post', 'categories' ); ?>

					</div><!-- .entry-meta -->
				<?php } ?>

				<?php 
				$foo = get_field( 'include_in_research_publications' );
				?>

				<h1 class="page-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			</header><!-- .entry-header -->


			<div class="post-author-date">
				<?php // the_excerpt(); ?>
		<!-- 		<a class="btn mt-20 mb-50"  href="<?php //the_permalink(); ?>">Read Article</a>
		 --> 	
		 		<?php tgs_wp_posted_on(); ?>

			</div><!-- .entry-summary -->

			<?php /* if ( is_search() || is_archive() ) { 
			// Only display Excerpts for Search and Archive Pages ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			<?php } else { ?>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'tg-wp-starter' ) ); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'tg-wp-starter' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
			<?php } */ ?>

			<?php /* no meta data yet 
			<footer class="entry-meta">
				<?php if ( 'post' === get_post_type() ) { // Hide category and tag text for pages on Search ?>
					<?php
						// translators: used between list items, there is a space after the comma
						$categories_list = get_the_category_list( __( ', ', 'tg-wp-starter' ) );
						if ( $categories_list && tgs_wp_categorized_blog() ) {
					?>
					<span class="cat-links">
						<?php printf( __( 'Posted in %1$s', 'tg-wp-starter' ), $categories_list ); ?>
					</span>
					<?php } // End if categories ?>

					<?php
						// translators: used between list items, there is a space after the comma 
						$tags_list = get_the_tag_list( '', __( ', ', 'tg-wp-starter' ) );
						if ( $tags_list ) {
					?>
					<span class="tags-links">
						<?php printf( __( 'Tagged %1$s', 'tg-wp-starter' ), $tags_list ); ?>
					</span>
					<?php } // End if $tags_list ?>
				<?php } // End if 'post' === get_post_type() ?>

				<?php if ( ! post_password_required() && ( comments_open() || '0' !== get_comments_number() ) ) { ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'tg-wp-starter' ), __( '1 Comment', 'tg-wp-starter' ), __( '% Comments', 'tg-wp-starter' ) ); ?></span>
				<?php } ?>

				<?php edit_post_link( __( 'Edit', 'tg-wp-starter' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-meta -->
			*/ ?>
		</div>
	</div>

</article><!-- #post-## -->


