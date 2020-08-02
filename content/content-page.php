<?php
/**
 *
 * @package tgs_wp
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<div class="entry-content-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tg-wp-starter' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php edit_post_link( __( 'Edit', 'tg-wp-starter' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article>
