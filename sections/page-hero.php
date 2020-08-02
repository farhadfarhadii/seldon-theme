<?php 

$id = get_the_ID();

if (is_front_page()) {
	$id = get_id_by_slug('tech');
}

if (is_home()) { // the blog page
	$id = get_id_by_slug('blog');
}

$header_content = get_field('header_fields', $id);

$title = $header_content['title'];
$text = $header_content['text'];
$bg_image = $header_content['background_image'];
$bg_color = $header_content['background_color'];
$text_bg_color = $header_content['text_background_color'];

$has_cta = $header_content['has_header_cta'];
$image_type = $header_content['image_type'];
?>

<div id="PageHero" class="row bg_<?php echo $bg_color ? $bg_color : 'teal'; ?>">

	<div id="PageHeroWrap" class="col-xs-12 maxout <?php echo $image_type; ?>" style="background-image: url(<?php echo $bg_image['url']; ?>);"> 

		<div id="PageHeroTextWrap" class="row bg_<?php echo $title ? $text_bg_color ? $text_bg_color : $bg_color : ''; ?>"> 

			<div id="PageHeroTitle" class="col-sm-10 col-sm-offset-2">
				<h1 class="mt-0"><?php echo $title; ?></h1>
			</div>

			<div id="PageHeroBlurb" class="col-sm-10 col-sm-offset-2">		
				<?php echo $text; ?>

				<?php if ($has_cta) : 
					$cta_button = $header_content['cta_button'];
					$button_text = $cta_button['button_text'];
					$link = $cta_button['button_link'];

					?>
					<button onclick="window.href='<?php echo $link; ?>'">
						<?php echo $button_text; ?>
					</button>
				<?php endif; ?>		
			</div>

		</div>
	</div>

</div>

