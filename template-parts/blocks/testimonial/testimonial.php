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
$id = 'testimonial-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// check if the repeater field has rows of data
if( have_rows('testimonials') ):

    // loop through the rows of data
    while ( have_rows('testimonials') ) : the_row();
        // Load values and assing defaults.
        $text = get_sub_field('testimonial') ?: 'Your testimonial here...';
        $author = get_sub_field('author') ?: 'Author name';

?>

<div id="<?php echo esc_attr($id); ?>">
    <blockquote class="testimonial-blockquote">
        <h2><?php echo $text; ?></h2>
        <div class="testimonial-author"><?php echo $author; ?></div>
    </blockquote>
</div>

<?php

    endwhile;

else :

    // no rows found

endif;


?>
