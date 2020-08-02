<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'benefits-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// check if the repeater field has rows of data
if( have_rows('benefits') ):

    // loop through the rows of data
    while ( have_rows('benefits') ) : the_row();
        // Load values and assing defaults.
        $title = get_sub_field('title') ?: 'Benefit Title';
        $text = get_sub_field('text') ?: 'Benefit description';

?>

<div id="<?php echo esc_attr($id); ?>">
    <div class="benefit">
        <h2><?php echo $title; ?></h2>
        <div><?php echo $text; ?></div>
    </div>
</div>

<?php

    endwhile;

else :

    // no rows found

endif;


?>
