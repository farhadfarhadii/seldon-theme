<?php
/**
 * The template for displaying search forms in tgs_wp
 *
 * @package tgs_wp
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>">
    <div class="input-group">
		<label>Search</label>
		<input type="search" class="form-control search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'tg-wp-starter' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'label', 'tg-wp-starter' ); ?>">
		<span class="input-group-btn">
			<input type="submit" class="search-submit button" value="<?php echo esc_attr_x( 'Search', 'submit button', 'tg-wp-starter' ); ?>">
		</span>
    </div>
</form>
