<?php
/**
 * The sidebar containing the main widget area
 *
 * @package tgs_wp
 */
?>

<div class="sidebar col-sm-11 col-sm-offset-1">

    <div class="row">
        
        <?php // do_action( 'before_sidebar' ); ?>
        <?php if ( ! dynamic_sidebar( 'sidebar' ) ) { ?>

            <aside id="search" class="widget widget_search col-sm-3">
                <?php get_search_form(); ?>
            </aside>

            <aside id="archives" class="widget widget_archive col-sm-9">
                <h3 class="widget-title"><?php _e( 'Archives', 'tg-wp-starter' ); ?></h3>
                <ul>
                    <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                </ul>
            </aside>

        <?php } ?>

    </div>

</div>
