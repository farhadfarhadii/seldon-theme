<?php
/**
 * tgs_wp functions and definitions
 *
 * @package tgs_wp
 */

/**
 * Setup
 */
require get_template_directory() . '/system/setup.php';

/**
 * Style and Script enqueues
 */
require get_template_directory() . '/system/enqueues.php';

/**
 * Custom template tags for this theme
 */
require get_template_directory() . '/system/template-tags.php';

/**
 * Customizer additions
 */
require get_template_directory() . '/system/customizer.php';

/**
 * Load custom WordPress nav walker
 */
require get_template_directory() . '/system/classes/bootstrap-wp-navwalker.php';

/**
 * Optional assorted functions
 */
require get_template_directory() . '/system/optional-functions.php';

/**
 * Optional Jetpack compatibility
 */
//require get_template_directory() . '/system/jetpack.php';

/**
 * Page Modifications.
 */
require get_template_directory() . '/system/cpts/pages.php'; // Page Modifications.
/**
 * Custom Post Types for this theme.
 */
 
/**
 * Theme Seo
 */
// require get_template_directory() . '/system/classes/seo/theme-seo.php';

function loadStripe(){

    wp_register_script('Stripe', 'https://js.stripe.com/v3/');

    if (is_page_template('page-templates/template-checkout.php')){
        wp_enqueue_script('Stripe');
    };
}

function loadZoomInfo(){

    wp_register_script('ZoomInfo', 'https://ws.zoominfo.com/pixel/OVSuZMgZbh8jUkpXEBVl');
    wp_enqueue_script('ZoomInfo');

}

add_action('wp_enqueue_scripts', 'loadStripe');
add_action('wp_enqueue_scripts', 'loadZoomInfo');