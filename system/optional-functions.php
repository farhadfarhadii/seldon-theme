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

function console_log($output) {
    $js_code = '<script>console.log(' . json_encode($output, JSON_HEX_TAG) . ');</script>';
    echo $js_code;
}


// https://artisansweb.net/load-wordpress-post-ajax/#:~:text=Load%20WordPress%20Posts%20with%20Ajax%20on%20Load%20More%20Button,below%20code%20in%20the%20functions.
function research_scripts() {
    // Register the script
    wp_register_script( 'custom-script', get_stylesheet_directory_uri(). '/includes/js/load-more.js', array('jquery'), false, true );
 
    // Localize the script with new data
    $script_data_array = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'security' => wp_create_nonce( 'load_more_posts' ),
        'foo' => 'bar'
    );
    wp_localize_script( 'custom-script', 'research', $script_data_array );
 
    // Enqueued script with localized data.
    wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'research_scripts' );

add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');


// load more research landing page results
function load_posts_by_ajax_callback($data) {
    check_ajax_referer('load_more_posts', 'security');
    $excludePostsStr = $_POST['excludePosts'];
    $excludePosts = explode(',', $excludePostsStr);
    $catName = $_POST['catName'];
    $excludeIds = [];
    for ($i = 0; $i < count($excludePosts); $i++) {
        $excludeIds[] = intval($excludePosts[$i]);
    }
    $isResearchLP = count($excludeIds) > 0; // only Research LP has values to exclude from results

    $postTypesStr = $_POST['postTypes'];
    $postTypes = explode(',', $postTypesStr);

    global $paged;
    $paged = $_POST['page'];

    $args = array(
        'post_type' => $postTypes,
        'post_status' => 'publish',
        'post__not_in' => $excludeIds,
        'posts_per_page' => 9,
        'paged' => $paged,
        'orderby' => 'post_date', 
        'order' => 'DESC'        
    );

    if ($isResearchLP) {
        $args['meta_query'] = array(
            array(
             'key' => 'include_in_research_publications',
             'value' => '1',
             'compare' => '=='
            )
        );

        if ($catName) {
            $args['category_name'] = $catName;
        }
    }

    $loop = new WP_Query( $args );
    
    if ( $loop->have_posts() ) : ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post(); 
            get_template_part('elements/research-summary-block-ajax');
            ?>
        <?php endwhile; ?>
        <?php
    endif;
 
    wp_die();
}

/**
 * prevent CPT resarch publications and LP from appearing in blog search results
 *
 */
function set_search_criteria( $query ) {

    $post_type = $_GET['posttype'];
    if (!is_admin() && $query->is_search && $post_type == 'research' ) {
        // search only CPT research (publications)
        $query->set( 'post_type', 'research' );
    } else if (!is_admin() && $query->is_search) {
        // search only blog
        $query->set( 'post_type', 'post' );
    }
}
add_action( 'pre_get_posts', 'set_search_criteria' );

/**
 * Extend WordPress search to include custom fields
 * https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/
 */
/**
 * Join posts and postmeta tables
 * https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 * https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicate search results
 * https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );







