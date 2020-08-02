<?php 
$id = get_the_ID();

if (is_front_page()) {
	$id = get_id_by_slug('tech');
}

$header_content = get_field('header_fields', $id);
$bg_color = $header_content['background_color'];
$text_bg_color = $header_content['text_background_color'];
?>

<div id="HomeAudienceToggleWrap" class="col-sm-6 match-height-home-cta pv-30 col-sm-pad-left-1 border_<?php echo $text_bg_color ? $text_bg_color : $bg_color; ?>">
	<div id="HomeAudienceToggle" class="pl-15">
		<p class="font-size-13"><strong>WHICH ARE YOU?</strong></p>
		<?php get_template_part('elements/audience-toggle'); ?>
		<p class="font-size-13">We speak your language</p>	
	</div>
</div>
