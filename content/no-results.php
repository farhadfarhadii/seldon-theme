<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tgs_wp
 */
?>

<section class="no-results not-found">
	<header>
		<h1 class="page-title"><?php _e( 'Nothing Found', 'tg-wp-starter' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'tg-wp-starter' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php } elseif ( is_search() ) { 
			$searchString = esc_attr( get_search_query() ); ?>
			<p><?php _e( 'Sorry, but nothing matched your search term: "' . $searchString . '"<br>Please try again with some different keywords.', 'tg-wp-starter' ); ?></p>
			<?php // get_search_form(); ?>

		<?php } else { ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tg-wp-starter' ); ?></p>
			<?php get_search_form(); ?>

		<?php } ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
