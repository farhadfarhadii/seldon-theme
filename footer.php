<?php
/**
 * The template for displaying the footer.
 *
 * @package tgs_wp
 */
?>
<?php 
$homeId = get_id_by_slug('home');

$footerFields = get_field('footer_content', $homeId);
$techdocs_text = $footerFields['techdocs_link_text'];
$techdocs_link = $footerFields['techdocs_link'];
$terms_text = $footerFields['terms_link_text'];
$terms_link = $footerFields['terms_page'];
$copyright_text = $footerFields['copyright'];

?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="row maxout">
			<div class="col-sm-11 col-sm-offset-1">
				
				<img class="logo" src="<?php echo get_template_directory_uri(); ?>/includes/images/seldon-s-footer.svg" alt="Seldon S Logo" />

				<div class="row">
					<div class="col-sm-6 col-md-3">
						<h4>Contact</h4>
						<p>
							<?php echo $footerFields['contact_content'] ?>
						</p>

						<p class="show_mobile show_tablet">
							<?php $email = $footerFields['contact_email'];
								if ($email && is_email($email)) { ?>
									E: <a href="mailto:<?php echo esc_html(antispambot($email)); ?>"><?php echo esc_html(antispambot($email)); ?></a>
							<?php }
							 ?>						
						</p>

					</div>

					<div class="col-sm-6 col-md-3">
						<h4>Connect</h4>
						<p>
							<?php echo $footerFields['connect_content'] ?>
						</p>
					</div>
					<div class="col-sm-12 col-md-6 pb-30">
						<h4>Newsletter</h4>
						<p>
							<?php echo $footerFields['newsletter_signup_blurb'] ?>
						</p>
						
						<?php gravity_form( 9, false, false, false, null, true, -1, true ); ?>
						
						<div class="show_mobile show_tablet mt-15 links-and-copyright">
							<a href="<?php echo $techdocs_link; ?>" class="mr-15" target="_blank"><?php echo $techdocs_text; ?></a>
							<a href="<?php echo $terms_link; ?>" class="mr-15"><?php echo $terms_text; ?></a>
							<span class="copyright_text color_darkgrey999 font-size-12">
								&copy; <?php echo current_time("Y") ?> <?php echo $copyright_text; ?>
							</span>						
						</div>

					</div>
				</div>
				<div class="row show_desktop">
					<div class="col-sm-6"> 
						<?php $email = $footerFields['contact_email'];
							if ($email && is_email($email)) { ?>
								E: <a href="mailto:<?php echo esc_html(antispambot($email)); ?>"><?php echo esc_html(antispambot($email)); ?></a>
						<?php }
						 ?>
					</div>
					<div class="col-sm-6 links-and-copyright">
						<a href="<?php echo $techdocs_link; ?>" class="mr-15" target="_blank"><?php echo $techdocs_text; ?></a>
						<a href="<?php echo $terms_link; ?>" class="mr-15"><?php echo $terms_text; ?></a>
						<span class="copyright_text color_darkgrey999 font-size-12">
							&copy; <?php echo current_time("Y") ?> <?php echo $copyright_text; ?>
						</span>
						
					</div>

				</div>
			</div>
		</div>
	</footer>

<?php
$cookiesFields = get_field('cookies_content', $homeId);
$cookies_title = $cookiesFields['cookies_title'];
$cookies_text = $cookiesFields['cookies_text'];
$cookies_button_text = $cookiesFields['acceptance_button_text'];
?>

<div id="CookiesNotice" class="container-fluid hide">
	<div class="row">
		<div class="col-sm-8">
			<h2><?php echo $cookies_title; ?></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<?php echo $cookies_text; ?>			
		</div>
		<div class="col-sm-4 cookies-button-wrapper">
			<button class="btn btn_black square_corners" onclick="consentToCookies();">
				<?php echo $cookies_button_text; ?>
			</button>
		</div>

	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
