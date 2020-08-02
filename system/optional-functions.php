<?php

/**
 * Add meta title support
 */
function tgs_wp_theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'tgs_wp_theme_slug_setup' );


/**
 * Customize WP login screen
 */
function tgs_wp_custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/includes/css/custom-login-styles.css" />';
}
add_action('login_head', 'tgs_wp_custom_login');
function tgs_wp_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'tgs_wp_login_logo_url' );

function tgs_wp_login_logo_url_title() {
	return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'tgs_wp_login_logo_url_title' );


/**
* Add pagination
* Call in your theme with <?php pagination(); ?>
*/
if ( ! function_exists( 'tgs_wp_pagination' ) ) {
	function tgs_wp_pagination() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'prev_text'          => __('&lsaquo; Previous'),
			'next_text'          => __('Next &rsaquo;')
		) );
	}
}


/**
* Add page slug to body class
*/
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// get a page id from the slug
function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}

//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

// Changes Gravity Forms Ajax Spinner (next, back, submit) to a transparent image
// this allows you to target the css and create a pure css spinner like the one used below in the style.css file of this gist.
add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
function spinner_url( $image_src, $form ) {
    return  'data:includes/image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'; // relative to your theme images folder

}

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
       global $post;
    //return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
       return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// for custom search form
add_theme_support( 'html5', array( 'search-form' ) );

/*

CUSTOM GUTENBERG BLOCKS WITH ACF

// EJY register acf block types instead of flexible content???

function register_acf_block_types() {

    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'testimonial',
        'title'             => __('SELDON Testimonial'),
        'description'       => __('A custom testimonial block.'),
    	'render_template'   => get_template_directory() . '/template-parts/blocks/testimonial/testimonial.php',
	    'enqueue_style'     => get_template_directory_uri() . '/includes/css/blockStyles.css',
        'category'          => 'seldon',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'testimonial', 'quote' )
    ));
    acf_register_block_type(array(
        'name'              => 'benefits',
        'title'             => __('SELDON Benefits'),
        'description'       => __('A custom benefits block.'),
    	'render_template'   => get_template_directory() . '/template-parts/blocks/benefits/benefits.php',
	    'enqueue_style'     => get_template_directory_uri() . '/includes/css/blockStyles.css',
        'category'          => 'seldon',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'benefits' )
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}

add_filter( 'block_categories', function( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'seldon',
                'title' => 'Seldon Content Blocks',
            ),
        )
    );
}, 10, 2 );

*/

