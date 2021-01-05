<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and <header> section
 *
 * @package tgs_wp
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MKZC66');</script>
<!-- End Google Tag Manager -->
	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- If Site Icon isn't set in customizer -->
<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
	<!-- Icons & Favicons -->
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<link href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-touch.png" rel="apple-touch-icon" />
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<![endif]-->
	<meta name="msapplication-TileColor" content="#f01d4f">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png">
	<meta name="theme-color" content="#121212">
<?php } ?>

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://www.seldon.io/">
	<meta property="og:title" content="Machine Learning Deployment For Enterprise">
	<meta property="og:description" content="Take your machine learning projects from proof to production.">
	<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/includes/images/seldon-social-media-card.jpg">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="https://www.seldon.io/">
	<meta property="twitter:title" content="Machine Learning Deployment For Enterprise">
	<meta property="twitter:description" content="Take your machine learning projects from proof to production.">
	<meta property="twitter:image" content="<?php echo get_template_directory_uri(); ?>/includes/images/seldon-social-media-card.jpg">


	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php gravity_form_enqueue_scripts( 1, true ); ?>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MKZC66"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
	<?php //do_action( 'display_template', true ); ?>
	<?php do_action( 'before' ); ?>

	<header id="masthead" class="site-header container-fluid" role="banner">
		<div class="row">
			<div class="col-sm-12 maxout">
				<div class="row">
					<div class="col-md-11 col-md-offset-1">
						
<nav class="navbar navbar-default">
	
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu-container" aria-expanded="false">
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>									
				<span class="sr-only">Toggle navigation</span>	
			</button>		      
			<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="navbar-brand"><img src="<?php echo get_template_directory_uri(); ?>/includes/images/seldon-logo-mono.svg" alt="Seldon Logo" /></a>

		</div>

		<?php wp_nav_menu(
			array(
				'theme_location' 	=> 'primary',
				'depth'             => 2,
				'container'         => 'div',
				'container_class'   => 'collapse navbar-collapse',
				'container_id'		=> 'main-menu-container',
				'menu_class' 		=> 'nav navbar-nav',
				'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
				'menu_id'			=> 'main-menu',
				'walker' 			=> new wp_bootstrap_navwalker()
			)
		); ?>
</nav>
					</div>				
				</div>
				
			</div>	
		</div>

	</header>


<div id="modalDemoRequest" class="modal">
	<div class="modalWrap">
		<div class="modalHeader">
			<a href="#" class="modal-close" data-dismiss="modal"><img class="svg svg-convert" src="<?php echo get_template_directory_uri(); ?>/includes/images/modal-close.svg" alt="menu" /></a>
			<h3>Get in touch</h3>
		</div>
		<div class="modalBody">
			<?php
			gravity_form(1, false, false, false, '', true, 1);
			?>
		</div>
	</div>
</div>



<div id="modalEmailThanks" class="modal">
	<div class="modalWrap">
		<div class="modalHeader">
			<a href="#" class="modal-close" data-dismiss="modal"><img class="svg" src="<?php echo get_template_directory_uri(); ?>/includes/images/modal-close.svg" alt="menu" /></a>
			<h3>Thanks!</h3>
		</div>
		<div class="modalBody">
			<div id="thanksText">	
				<p>Thanks for signing up! We will get in touch with you shortly.</p>
			</div>
		</div>
	</div>
</div>

<noscript>
	<img src="https://ws.zoominfo.com/pixel/OVSuZMgZbh8jUkpXEBVl" width="1" height="1" style="display: none;" />
</noscript>



