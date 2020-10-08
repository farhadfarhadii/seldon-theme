<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package tgs_wp
 */

get_header(); ?>

<?php 
$filteredPostType = $_GET["type"];
?>

<main>
	<div class="container-fluid">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'sections/page-hero' ); ?>

			<?php get_template_part('sections/intro-block'); ?>		

			<?php get_template_part('sections/research-filter-search-bar'); ?>

	<div id="ResearchPublications" class="row maxout mt-30 pb-50">
		<div class="col-sm-11 col-sm-offset-1">

<?php 

function getAuthorList($postId) {
	global $authorCount;
	$authorCount = 0 ;
	if( have_rows('authors', $postId) ):
	    while ( have_rows('authors', $postId) ) : the_row();
	    	$authorCount++;
	    	if ($authorCount > 3) {
	    		$authorList .= " ET AL, ";
	    		break;
	    	}
	        $isWPAuthor = get_sub_field('author_is_WP_user');
	        if ($isWPAuthor) {
	        	$authorObj = get_sub_field('author_wp');
	        	// print_r($authorObj);
	        	$authorName = $authorObj["display_name"];
	        	$authorNickName = $authorObj["nickname"];
	        	$authorList .= "<a href='". esc_url( home_url() )."/author/".$authorNickName."'>" . $authorName . "</a>, ";

	        } else {
	        	$authorList .= get_sub_field( 'author_not_wp' ) . ", ";
	        }
	    endwhile;
	    $authorList = substr($authorList, 0, -2);

	else :
		$authorList = "";
	endif;

	return $authorList;
}

// get featured research item

$removePosts = array();

if (!$filteredPostType) { // ONLY SHOW THE FEATURED BLOCK ON THE LP WITHOUT FILTERS

	$featuredPubType = get_field( 'featured_publication_type' );

	if ($featuredPubType == "research_cpt") {
		$featuredPub = get_field( 'featured_publication' );
		$fPubDate = get_field('date_of_publication');
	} else {
		$featuredPub = get_field( 'featured_research_blog_post' );
		$fPubDate = $featuredPub->post_date; 
	}

	$featuredPostId = $featuredPub->ID;
	$fExcerpt = get_field('custom_excerpt' );

	$fImgUrl = get_the_post_thumbnail_url($featuredPostId,'full');
	$fTitle = $featuredPub->post_title;
	$fPermalink = get_permalink( $featuredPostId);

	$fAuthorList = getAuthorList($featuredPostId);

	$removePosts[] = $featuredPostId;

	?>


			<div id="ResearchLPFeaturedRow" class="row mb-30">
				<div id="FeaturedPublication" class="col-md-8 research-pub-top mh-outer">
					<div class="mh-inner research-pub-summary-wrap featured" style="background-color: #f0f0f0;">
						<a href="<?php echo $fPermalink; ?>">
							<div class="post-image-wrap" style="background-image: url(<?php echo $fImgUrl; ?>)">
								<div class="featured-research-badge">
									Featured Publication
								</div>
							</div>
						</a>
						<div class="article-summary-wrap" style="background-color: #f0f0f0;">
							<h1 class="page-title featured-research-title">
								<a href="<?php echo $fPermalink; ?>"><?php echo $fTitle ?></a>
							</h1>
							<p>						
								<?php echo $fExcerpt; ?>
							</p>
						</div>

						<div class="by-line">
							<?php if ($featuredPubType == "post") { ?>
								<div class="post-author-date">
		 							<?php tgs_wp_posted_on(); ?>								
								</div>
							<?php } ?>
							<?php if ($featuredPubType == "research_cpt") { ?>
							<dl class="pub-authors">
								<dt>Author<?php echo $authorCount > 1 ? "s" : ""; ?>:</dt>
								<dd><?php echo $fAuthorList; ?></dd>
								<dt>DOP:</dt>
								<dd><?php echo date('F j, Y', strtotime($fPubDate)); ?></dd>
							</dl>
							<?php } ?>
						</div>							

					</div>
				</div>


				<div id="TopTwoPublications" class="col-md-4 research-pub-top">
					<div class="row">
	<?php 
		
		$args = array(
			'post_type' => array('research','post'),
	   		'post__not_in' => $removePosts,
			'post_status' => 'publish',
			'posts_per_page' => 2,
			'meta_query' => array(
				array(
				 'key' => 'include_in_research_publications',
				 'value' => '1',
				 'compare' => '=='
				)
			),
			'orderby' => 'post_date', 
			'order' => 'DESC'
		);

		$loop = new WP_Query($args);
		$colClass = "col-md-12 pub-outer";

		get_template_part('elements/research-summary-block');	



	?>					

					</div>
				</div>
			</div> <!-- LP page 1 row -->
<?php 
}
?>
<style type="text/css">
	#TopTwoPublications .col_1 {
		margin-bottom: 30px;
	}
</style>

<?php 

wp_reset_query();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$postTypes = array('research','post');

switch ($filteredPostType) {
	case "Publications":
		$postTypes = array('research');
		$catName = '';
		break;

	case "OpenSource":
		$catName = "open-source";
		$postTypes = array('post');
		break;

	case 'Blog':
		$catName = "research";
		$postTypes = array('post');
		break;
}

$args = array(
	'post_type' => $postTypes,
	'post__not_in' => $removePosts,
	'post_status' => 'publish',
	'posts_per_page' => 9,
	'paged' => $paged,
    'category_name' => $catName,
	'meta_query' => array(
		array(
			'key' => 'include_in_research_publications',
			'value' => '1',
			'compare' => '=='
		)
	),
	'orderby' => 'post_date', 
	'order' => 'DESC'
);

$loop = new WP_Query($args);

$postCount = $loop->post_count; 


$colClass = "col-md-4 mh-outer2 mb-30 pub-outer";

?>

		<div class="row post-listing">
			<?php get_template_part('elements/research-summary-block'); ?>
		</div>

		<?php if ($postCount == 9) { // if only nine posts total, usser will see load more button, then it will disappear when no more posts are loaded... change?  ?>		
			<?php get_template_part( 'elements/loadmore-button' ); ?>
		<?php } ?>

<?php /* HIDDEN INPUTS FOR LOAD MORE JAVASCRIPT */ ?>
<input type="hidden" id="RemovedPosts" value="<?php echo implode(',', $removePosts); ?>" />			
<input type="hidden" id="PostTypes" value="<?php echo implode(',', $postTypes); ?>" />
<input type="hidden" id="CatName" value="<?php echo $catName; ?>" />

	</div>
</div>


		<?php endwhile; ?>
	</div>

</main>

<?php get_footer();