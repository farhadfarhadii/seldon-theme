<?php
/**
 * Style and Script Enques
 *
 * @package tgs_wp
 */

/**
 * Enqueue styles
    $handle is simply the name of the stylesheet.
	$src is where it is located. The rest of the parameters are optional.
	$deps refers to whether or not this stylesheet is dependent on another stylesheet. If this is set, this stylesheet will not be loaded unless its dependent stylesheet is loaded first.
	$ver sets the version number.
	$media can specify which type of media to load this stylesheet in, such as 'all', 'screen', 'print' or 'handheld.'
 */
function tgs_wp_styles() {

	// load tgs_wp styles
	wp_enqueue_style( 'tgs_wp-style', get_stylesheet_uri() );

	// load slick slider css: http://kenwheeler.github.io/slick/
	wp_enqueue_style( 'tgs_wp-slick-style', get_template_directory_uri() . '/includes/slick/slick.css' );

	// load slick slider theme css: http://kenwheeler.github.io/slick/
	wp_enqueue_style( 'tgs_wp-slick-theme-style', get_template_directory_uri() . '/includes/slick/slick-theme.css' );

	// load theme styles, compiled from SASS, with file modification time as the version
	wp_enqueue_style( 'tgs_wp-theme-style', get_template_directory_uri() . '/includes/css/styles.min.css', false, filemtime( get_stylesheet_directory() . '/includes/css/styles.min.css' ) );

	// load Fancybox css
	//wp_enqueue_style( 'tgs_wp-fancybox-css', get_template_directory_uri() . '/includes/fancybox/jquery.fancybox.css' );

	// load animate css
	//wp_enqueue_style( 'tgs_wp-animate-style', get_template_directory_uri() . '/includes/css/animate.css');

	wp_enqueue_style( 'tgs_google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,400,900&display=swap', false );

}
add_action( 'wp_enqueue_scripts', 'tgs_wp_styles' );


/**
 * Enqueue scripts
 */
function tgs_wp_scripts() {

	//load modernizr js: https://modernizr.com/
	wp_enqueue_script( 'tgs_wp-modernizrjs', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array( 'jquery' ), false, true );

	// load bootstrap js
	wp_enqueue_script( 'tgs_wp-bootstrapjs', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), false, true  );

	// equalize/match heights: https://github.com/liabru/jquery-match-height
	wp_enqueue_script( 'tgs_wp-equalize', get_template_directory_uri() . '/includes/js/jquery.matchHeight-min.js', array( 'jquery' ), false, true );

	// load slick slider js: http://kenwheeler.github.io/slick/
	wp_enqueue_script( 'tgs_wp-slick-js', get_template_directory_uri().'/includes/slick/slick.min.js', array( 'jquery' ), false, true );

	// wp_enqueue_script( 'tgs_wp-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	// load wow js
	//wp_enqueue_script( 'tgs_wp-wowjs', get_template_directory_uri() . '/includes/js/wow.js', array('jquery') );

	// load fancybox js
	//wp_enqueue_script('tgs_wp-fancybox-js', get_template_directory_uri().'/includes/fancybox/jquery.fancybox.js', array('jquery') );

	// load fancybox helpers
	//wp_enqueue_script('tgs_wp-fancybox-media-js', get_template_directory_uri().'/includes/fancybox/jquery.fancybox.media.js', array('jquery') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// if ( is_singular() && wp_attachment_is_image() ) {
	// 	wp_enqueue_script( 'tgs_wp-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	// }

	// load vendor js
	wp_enqueue_script( 'tgs_wp-vendor-js', get_template_directory_uri().'/includes/js/vendor.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/includes/js/vendor.js' ), true );

	// load custom js
	wp_enqueue_script( 'tgs_wp-custom-js', get_template_directory_uri().'/includes/js/custom.js', array( 'jquery', 'tgs_wp-slick-js', 'tgs_wp-vendor-js' ), filemtime( get_stylesheet_directory() . '/includes/js/custom.js' ), true );


}
add_action( 'wp_enqueue_scripts', 'tgs_wp_scripts' );

/**
 * Move jQuery to the footer. 
 */
function tgs_wp_enqueue_scripts() {
    wp_scripts()->add_data( 'jquery', 'group', 1 );
    wp_scripts()->add_data( 'jquery-core', 'group', 1 );
    wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
}
add_action( 'wp_enqueue_scripts', 'tgs_wp_enqueue_scripts' );
