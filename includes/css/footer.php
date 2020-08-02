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


<!-- Begin Mailchimp Signup Form -->
<div id="mc_embed_signup">
	<form action="https://seldon.us9.list-manage.com/subscribe/post?u=e8f5fd788bf02dbd61b5b3d2f&amp;id=b9f17aafbb" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	    <div id="mc_embed_signup_scroll" style="width:100%;">
		
			<div class="mc-field-group">
				<label for="mce-EMAIL" class="sr-only">Email Address</label>
				<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
				<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
			</div>

			<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
		    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_e8f5fd788bf02dbd61b5b3d2f_b9f17aafbb" tabindex="-1" value=""></div>
	    </div>   
	</form>
	<div id="mce-responses" class="clear mt-10">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div> 
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='COMPANY';ftypes[3]='text';fnames[4]='SIGNUP';ftypes[4]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->



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
