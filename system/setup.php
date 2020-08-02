<?php
/**
 * Setup
 *
 * @package tgs_wp
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750; /* pixels */
}

if ( ! function_exists( 'tgs_wp_setup' ) ) {
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function tgs_wp_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	add_theme_support( 'custom-background', apply_filters( 'tgs_wp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	$header_defaults = array(
	    'default-image'          => '',
	    'random-default'         => false,
	    'width'                  => 0,
	    'height'                 => 0,
	    'flex-height'            => false,
	    'flex-width'             => false,
	    'default-text-color'     => '',
	    'header-text'            => true,
	    'uploads'                => true,
	    'wp-head-callback'       => '',
	    'admin-head-callback'    => '',
	    'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $header_defaults );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on tgs_wp, use a find and replace
	 * to change 'tg-wp-starter' to the name of your theme in all the template files
	 * Follow the docs - https://developer.wordpress.org/themes/functionality/internationalization/
	*/
	load_theme_textdomain( 'tg-wp-starter', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header Menu', 'tg-wp-starter' )
	) );

}
} // tgs_wp_setup
add_action( 'after_setup_theme', 'tgs_wp_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function tgs_wp_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'tg-wp-starter' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'tgs_wp_widgets_init' );

/**
 * Set a global value of template name.
 *
 * @param String $template_include_path
 */
add_filter( 'template_include', 'tgs_wp_var_template_include', PHP_INT_MAX );
function tgs_wp_var_template_include( $template_include_path ){
    $GLOBALS['current_theme_template'] =  strip_tags( basename( $template_include_path ) );
    return $template_include_path;
}

/**
 * Return and/or echo the current theme template.
 *
 * @param boolean $echo Whether to echo the template name.
 * @return string Template name.
 */
if ( current_user_can( 'manage_options' ) ) {
	add_action( 'display_template',  'tgs_wp_get_current_template', 10, 1 );
} 
function tgs_wp_get_current_template( $echo = true ) {
    if ( ! isset( $GLOBALS['current_theme_template'] ) ) {
		$template = basename( get_page_template() );
	} else {
		$template = $GLOBALS['current_theme_template'];
	}
    if ( true === $echo ) {
		echo esc_html( strip_tags( $template ) );
	}
    return esc_html( strip_tags( $template ) );
}

/**
 * Standard This is without the async or defer attribute and is the standard behavior for your browser.
 * Deferred This delays the execution of the script until the HTML parser has finished.
 * Asynchronous This executes when the script is ready and doesn't disrupt HTML parsing.
 *
 * @param String $tag 		Tag for the enqueued script.
 * @param String $handle 	The script's registered handle.
 * @return String $tag		Tag for the enqueued script.
 */
add_filter( 'script_loader_tag', 'tgs_wp_add_async_attribute', 10, 2 ); 
function tgs_wp_add_async_attribute( $tag, $handle ) {
   // Add script handles to the arrays below
   $scripts_to_async = array(); // Handles - comma sep list of handles.
   $scripts_to_defer = array(); // Handles - comma sep list of handles.
   
   // Scripts to Async
   if ( is_array( $scripts_to_async ) && ! empty( $scripts_to_async ) ) {
	   foreach( $scripts_to_async as $async_script ) {
		  if ( $async_script === $handle ) {
			 return str_replace(' src', ' async="async" src', $tag );
		  }
	   }
   }
   // Scripts to Defer
   if ( is_array( $scripts_to_defer ) && ! empty( $scripts_to_defer ) ) {
	   foreach( $scripts_to_defer as $defer_script) {
		  if ( $defer_script === $handle ) {
			 return str_replace(' src', ' defer="defer" src', $tag );
		  }
	   }
   }
   return $tag;
}

/**
 * SEE ALL SCRIPTS AND STYLES DISPLAYED IN FOOTER
 * DEVELOPMENT ONLY
 */
if ( current_user_can( 'manage_options' ) ) {
	//add_action( 'wp_footer', 'tgs_wp_display_wp_script_order', PHP_INT_MAX );
} 
function tgs_wp_display_wp_script_order() {
	if ( current_user_can( 'manage_options' ) ) {
		global $wp_scripts;
		global $wp_styles;
		//echo '<!-- ';
		if( isset( $wp_styles->registered ) ) {
			echo "<br />STYLES<br />Total Registered Styles: " . count( $wp_styles->registered ) . "<br />";
			foreach( $wp_styles->registered as $array ){
				echo "<br />".$array->src;
			}
		}
		if( isset( $wp_scripts->registered ) ) {
			echo "<br /><br />SCRIPTS<br />Total Registered Scripts: " . count( $wp_scripts->registered ) . "<br />";
			foreach( $wp_scripts->registered as $handle => $script_object ) {
				echo '<br /><div class="col5 floatleft">['.$handle.']</div><div class="col2 floatleft">'.$script_object->src.'</div><div class="clearDiv"></div>';
				var_dump($script_object);
				echo "<br />";
			}
		}
		//echo ' -->';
	}
}
