<?php
/**
 * @package tgs_wp
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>

	<header>
		<h1 class="page-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php tgs_wp_posted_on(); ?>
			<?php get_template_part( 'elements/post', 'categories' ); ?>
		</div>
	</header>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php 
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tg-wp-starter' ),
				'after'  => '</div>',
			) ); 
			
		?>
	</div>
	<footer class="entry-meta">
		<?php
			// translators: used between list items, there is a space after the comma 
			$category_list = get_the_category_list( __( ', ', 'tg-wp-starter' ) );

			// translators: used between list items, there is a space after the comma 
			$tag_list = get_the_tag_list( '', __( ', ', 'tg-wp-starter' ) );

			if ( ! tgs_wp_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' !== $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'tg-wp-starter' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'tg-wp-starter' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' !== $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'tg-wp-starter' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'tg-wp-starter' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

	</footer>
	<?php  edit_post_link( __( 'Edit', 'tg-wp-starter' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>


</article>
