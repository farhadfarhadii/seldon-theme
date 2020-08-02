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
require get_template_directory() . '/system/classes/seo/theme-seo.php';