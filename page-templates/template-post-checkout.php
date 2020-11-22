<?php /* Template Name: Post Checkout Page */
/**
 * The template for displaying a post checkout page.
 *
 * @package tgs_wp
 */
?>

<?php

    /**
     * Retrieve the checkout session to deduce if the page has genuinely
     * been reached by a session, whether the checkout was completed 
     * successfully, or whether the user istrying to spoof the page.
     * It would be great for metrics tracking to make sure users only
     * land on this page through genuine avenues, rather than have the
     * page be spoofed into loading.    
     */

    if (!$_GET['subscription']){

        header('Location:' . get_home_url());
        return die();
    }

    if (!$_ENV["STRIPE"]){

        $path = realpath(dirname(__DIR__, 1) . '/' . 'stripe-settings.json');

    $file = fopen( $path , 'r');
    $_ENV['STRIPE'] = json_decode(fread($file, filesize( $path )), 'utf8');
    fclose($file);
    }

    // Stripe API endpoint
    $url = 'https://api.stripe.com/v1/subscriptions/' . 'sub_' . $_GET['subscription'];

    // Set up auth

    $context = stream_context_create([
        'http' => [
            'header' => 'Authorization: Bearer ' . $_ENV['STRIPE'][($_ENV['live'] ? 'LIVE_ACCESS_TOKEN' : 'DEV_ACCESS_TOKEN')]
        ]
    ]);

    // Retrieve the invoice details
    try {

        $contents = json_decode(file_get_contents($url, false, $context));

    } catch (Exception $err) {
        // TODO: Maybe we might want to log unsuccessful attempts.

    }

    if (!$contents){
        header('Location: ' . get_home_url() . '/' . '500');
        return die();
    }

?>

<?php get_header(); ?>

<main>
	<div class="container-fluid">
        <div class="post-checkout--section">
            <h2 class="post-checkout--item">
                <?php
                    if (get_field('title')) : the_field('title');
                    else: echo 'Thank You!'; endif;
                ?>
            </h2>
            <div class="post-checkout--item">
                <svg class="post-checkout--image" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 56 56" style="enable-background:new 0 0 56 56;" xml:space="preserve">
                    <style type="text/css">
                        .st0{fill-opacity:7.909606e-02;}
                        .st1{fill:#EFCA62;fill-opacity:0.7569;}
                        .st2{fill:#AD0001;}
                        .st3{fill:#DD0011;}
                        .st4{opacity:0.2;}
                        .st5{fill:#FFFFFF;}
                        .st6{opacity:0.2;fill:#FFFFFF;}
                        .st7{fill:#009ABD;}
                    </style>
                    <g id="svg2" inkscape:version="0.92.4 (5da689c313, 2019-01-14)" sodipodi:docname="shopping-bag.svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg">
                        
                            <sodipodi:namedview  bordercolor="#666666" borderopacity="1" gridtolerance="10" guidetolerance="10" id="namedview4" inkscape:current-layer="g10" inkscape:cx="175.53825" inkscape:cy="164.26991" inkscape:pageopacity="0" inkscape:pageshadow="2" inkscape:window-height="1699" inkscape:window-maximized="1" inkscape:window-width="2736" inkscape:window-x="-13" inkscape:window-y="-13" inkscape:zoom="1.5733334" objecttolerance="10" pagecolor="#ffffff" showgrid="false">
                            </sodipodi:namedview>
                        <g id="layer3" inkscape:groupmode="layer" inkscape:label="shadow 1">
                            <ellipse id="path875" class="st0" cx="28.3" cy="42.7" rx="20.4" ry="5.4"/>
                        </g>
                        <g id="g10" transform="matrix(1.3333333,0,0,-1.3333333,0,600)" inkscape:groupmode="layer" inkscape:label="ink_ext_XXXXXX">
                            <g id="layer1" inkscape:groupmode="layer" inkscape:label="shadow">
                            </g>
                            <g id="g12" transform="matrix(0.1,0,0,0.1,-0.89273424,0)">
                                
                                    <path id="path1088" inkscape:flatsided="false" inkscape:randomized="0" inkscape:rounded="0" inkscape:transform-center-x="-1.5545616" inkscape:transform-center-y="2.4179498" sodipodi:arg1="1.4481277" sodipodi:arg2="2.0764462" sodipodi:cx="3501.9292" sodipodi:cy="-3512.9192" sodipodi:r1="308.34824" sodipodi:r2="154.17412" sodipodi:sides="5" sodipodi:type="star" class="st1" d="
                                    M336.7,4388.8l-10.1,15.4l-18.4,0.4l11.5,14.4l-5.3,17.6l17.2-6.5l15.1,10.5l-0.9-18.4l14.7-11.2l-17.8-4.9L336.7,4388.8z"/>
                                
                                    <path id="path1090" inkscape:flatsided="false" inkscape:randomized="0" inkscape:rounded="0" inkscape:transform-center-x="1.368906" inkscape:transform-center-y="0.37000755" sodipodi:arg1="-1.9513027" sodipodi:arg2="-1.3229842" sodipodi:cx="3577.3894" sodipodi:cy="-2670.2859" sodipodi:r1="135.45441" sodipodi:r2="67.727203" sodipodi:sides="5" sodipodi:type="star" class="st1" d="
                                    M335.6,4351.9l6-5.4l7.9,1.9l-3.3-7.4l4.2-6.9l-8.1,0.8l-5.3-6.2l-1.7,7.9l-7.5,3.1l7,4.1L335.6,4351.9z"/>
                                
                                    <path id="path1088-0" inkscape:flatsided="false" inkscape:randomized="0" inkscape:rounded="0" inkscape:transform-center-x="1.5545483" inkscape:transform-center-y="2.4179726" sodipodi:arg1="1.4481277" sodipodi:arg2="2.0764462" sodipodi:cx="-1015.9256" sodipodi:cy="-3533.9192" sodipodi:r1="308.34824" sodipodi:r2="154.17412" sodipodi:sides="5" sodipodi:type="star" class="st1" d="
                                    M106.2,4390.7l10.1,15.4l18.4,0.4l-11.5,14.4l5.3,17.6l-17.2-6.5l-15.1,10.5l0.9-18.4L82.3,4413l17.8-4.9L106.2,4390.7z"/>
                                
                                    <path id="path1090-8" inkscape:flatsided="false" inkscape:randomized="0" inkscape:rounded="0" inkscape:transform-center-x="-1.3689323" inkscape:transform-center-y="0.37000755" sodipodi:arg1="-1.9513027" sodipodi:arg2="-1.3229842" sodipodi:cx="-940.46515" sodipodi:cy="-2691.2859" sodipodi:r1="135.45441" sodipodi:r2="67.727203" sodipodi:sides="5" sodipodi:type="star" class="st1" d="
                                    M107.3,4353.8l-6-5.4l-7.9,1.9l3.3-7.4l-4.2-6.9l8.1,0.8l5.3-6.2l1.7,7.9l7.5,3.1l-7,4.1L107.3,4353.8z"/>
                            </g>
                        </g>
                        <g id="layer4" inkscape:groupmode="layer" inkscape:label="bag-crease">
                        </g>
                    </g>
                    <g id="Layer_2">
                        <polygon class="st2" points="43.1,22.8 28.3,25.8 28.4,45.4 41.3,42.9 	"/>
                        <polygon class="st3" points="28.3,25.8 13.3,23 15.1,43.1 28.4,45.4 	"/>
                        <polygon class="st3" points="43.1,22.8 28.2,25.8 13.3,23 28.3,20 	"/>
                        <g class="st4">
                            <polygon class="st5" points="32.9,30.3 33.4,31.6 34.5,31.6 33.7,32.9 33.9,34.4 32.9,33.8 31.9,34.7 32.1,33.1 31.3,32.2 
                                32.4,31.8 		"/>
                            <polygon class="st5" points="39.9,33.8 40.5,35.1 41.5,35.1 40.8,36.3 41,37.8 40,37.3 39,38.2 39.2,36.6 38.4,35.7 39.5,35.3 		
                                "/>
                            <polygon class="st5" points="35.2,25.2 35.7,26.5 36.8,26.5 36,27.7 36.2,29.2 35.2,28.7 34.3,29.6 34.4,28 33.6,27.1 34.7,26.7 
                                        "/>
                            <polygon class="st5" points="30.5,26.1 31,27.4 32.1,27.4 31.3,28.6 31.5,30.1 30.5,29.6 29.6,30.5 29.7,28.9 28.9,28 30,27.5 		
                                "/>
                            <polygon class="st5" points="37.7,29.4 38.2,30.7 39.3,30.7 38.5,31.9 38.7,33.4 37.7,32.9 36.8,33.8 36.9,32.2 36.1,31.3 
                                37.2,30.8 		"/>
                            <polygon class="st5" points="30.4,35.6 30.9,36.9 32,36.9 31.2,38.2 31.5,39.7 30.5,39.1 29.5,40.1 29.7,38.5 28.9,37.5 
                                29.9,37.1 		"/>
                            <polygon class="st5" points="37.6,39 38.1,40.3 39.2,40.3 38.4,41.6 38.6,43.1 37.7,42.5 36.7,43.4 36.9,41.8 36,40.9 37.1,40.5 
                                        "/>
                            <polygon class="st5" points="32.8,40 33.3,41.3 34.4,41.3 33.7,42.5 33.9,44 32.9,43.5 31.9,44.4 32.1,42.8 31.3,41.9 32.4,41.4 
                                        "/>
                            <polygon class="st5" points="40,24.1 40.5,25.4 41.6,25.5 40.8,26.7 41.1,28.2 40.1,27.7 39.1,28.6 39.3,27 38.5,26 39.5,25.6 		
                                "/>
                        </g>
                        <g class="st4">
                            <polygon class="st5" points="23.7,30.4 23.2,31.7 22.1,31.7 22.9,33 22.7,34.5 23.6,33.9 24.6,34.8 24.5,33.3 25.3,32.3 
                                24.2,31.9 		"/>
                            <polygon class="st5" points="16.6,33.9 16.1,35.2 15,35.2 15.8,36.4 15.6,37.9 16.6,37.4 17.5,38.3 17.4,36.7 18.2,35.8 
                                17.1,35.4 		"/>
                            <polygon class="st5" points="21.4,25.3 20.9,26.6 19.8,26.6 20.6,27.8 20.4,29.3 21.3,28.8 22.3,29.7 22.1,28.1 23,27.2 
                                21.9,26.8 		"/>
                            <polygon class="st5" points="26.1,26.2 25.6,27.5 24.5,27.5 25.2,28.7 25,30.2 26,29.7 27,30.6 26.8,29 27.6,28.1 26.5,27.7 		"/>
                            <polygon class="st5" points="18.9,29.5 18.4,30.8 17.3,30.8 18.1,32 17.8,33.5 18.8,33 19.8,33.9 19.6,32.3 20.4,31.4 19.4,31 		
                                "/>
                            <polygon class="st5" points="26.1,35.7 25.6,37 24.5,37.1 25.3,38.3 25.1,39.8 26.1,39.2 27.1,40.2 26.9,38.6 27.7,37.6 
                                26.6,37.2 		"/>
                            <polygon class="st5" points="19,39.1 18.4,40.4 17.4,40.4 18.1,41.7 17.9,43.2 18.9,42.6 19.9,43.5 19.7,42 20.5,41 19.4,40.6 		
                                "/>
                            <polygon class="st5" points="23.7,40.1 23.2,41.4 22.1,41.4 22.9,42.6 22.7,44.1 23.7,43.6 24.6,44.5 24.5,42.9 25.3,42 
                                24.2,41.5 		"/>
                            <polygon class="st5" points="16.6,24.2 16,25.5 14.9,25.6 15.7,26.8 15.5,28.3 16.5,27.8 17.5,28.7 17.3,27.1 18.1,26.2 17,25.7 
                                        "/>
                        </g>
                        <g class="st4">
                            <polygon class="st5" points="29.3,23.5 30.3,23.7 31.5,23.4 31.2,23.9 32.1,24.3 30.8,24.4 30.3,24.9 29.7,24.4 28.5,24.4 
                                29.4,24 		"/>
                            <polygon class="st5" points="35.8,22.2 36.9,22.4 38,22.1 37.8,22.6 38.6,23 37.4,23.1 36.8,23.6 36.3,23.1 35.1,23.1 36,22.7 		
                                "/>
                        </g>
                        <g class="st4">
                            <polygon class="st5" points="19.7,21.7 20.7,21.9 21.9,21.6 21.6,22.1 22.5,22.5 21.3,22.6 20.7,23.1 20.2,22.6 18.9,22.6 
                                19.8,22.2 		"/>
                            <polygon class="st5" points="26.2,20.4 27.3,20.6 28.4,20.3 28.2,20.8 29,21.2 27.8,21.3 27.2,21.8 26.7,21.3 25.5,21.3 
                                26.4,20.9 		"/>
                        </g>
                        <g>
                            <polygon class="st6" points="24.1,23.5 25.2,23.7 26.3,23.4 26.1,23.9 27,24.3 25.7,24.4 25.1,24.9 24.6,24.4 23.4,24.4 24.3,24 
                                        "/>
                            <polygon class="st5" points="30.7,22.2 31.8,22.4 32.9,22.1 32.6,22.6 33.5,23 32.3,23.1 31.7,23.6 31.2,23.1 29.9,23.1 
                                30.8,22.7 		"/>
                        </g>
                        <path class="st7" d="M28.4,21.6l0.7,0.2c-0.3,0-0.6-0.1-0.9-0.1L28.4,21.6z"/>
                        <path class="st7" d="M33.1,20.7c-0.5,0.1-0.9,0.1-0.9,0c0,0,0,0,0,0l0.5-0.1L33.1,20.7z"/>
                        <path class="st7" d="M28.4,21.6l-0.2,0c0,0,0,0,0,0c0,0,0,0,0.1,0c0.2,0,0.5,0.1,0.9,0.1L28.4,21.6z"/>
                        <path class="st7" d="M38,19.6c0.5-0.4,0.7-0.6,0.8-0.8c0.2-0.2,0.8-1,0.8-2.1c0-0.6-0.3-1.1-0.5-1.3c-0.1-0.2-0.2-0.4-0.5-0.6
                            c-0.3-0.2-0.5-0.3-0.9-0.5c-0.2-0.1-0.5-0.2-0.8-0.3c-0.3-0.1-0.9-0.2-1.6-0.2c-1.2,0.1-2.1,0.7-2.6,1c-0.7,0.5-1.1,1-1.5,1.4
                            c-0.3,0.3-0.6,0.7-1,1.3c-1,1.5-1.5,3-1.9,4c0,0,0,0,0,0l0.2,0l0.7,0.2c-0.3,0-0.6-0.1-0.9-0.1c0,0,0,0-0.1,0c0,0,0,0,0,0l0,0
                            c0-0.1-0.1-0.4-0.3-0.9c-0.4-0.8-0.5-1.2-0.9-1.8c-0.6-1-0.9-1.5-1.3-2.1c-0.6-0.8-1.7-2.1-3.5-2.6c-0.8-0.2-1.4-0.2-1.5-0.2
                            c-0.8,0-1.5,0.3-1.9,0.5c-0.5,0.2-0.7,0.3-1,0.6c-0.6,0.5-0.9,1.3-0.9,2.1c0,1.5,1.4,2.4,2,2.8c0.5,0.3,0.9,0.5,1.6,0.8
                            c0.3,0.1,0.7,0.3,1.2,0.5l-1.9,0.4l4.4,0.9l-5.9,1.3l0.5,19.9l4.5,0.7l-0.8-20l5.7-1.2l6.2,1.3l-1,19.9l4.4-0.9l0.9-19.8l-6.2-1.4
                            l4.7-1l-2.1-0.4c0.2-0.1,0.4-0.1,0.5-0.2C36.9,20.5,38,19.6,38,19.6z M20.7,17.1c0,0-0.5-0.5-0.8-1.4c0-0.1-0.1-0.2,0-0.2
                            c0.3,0,1.6-0.1,2.8,0.5c0.2,0.1,0.6,0.3,1.1,0.8c1.4,1.3,1.9,3.3,1.9,3.3s-0.1,0-0.3-0.1c-1.2-0.4-0.9-0.3-1.3-0.5
                            c-0.4-0.2-0.8-0.4-1.3-0.7c-0.2-0.1-0.5-0.3-0.9-0.6C21.7,18.1,21.2,17.7,20.7,17.1z M35.1,20.1c-0.5,0.2-0.8,0.3-1.5,0.5
                            c-0.2,0.1-0.4,0.1-0.6,0.1h0c-0.5,0.1-0.9,0.1-0.9,0c0,0,0,0,0,0c0-0.1,0-0.3,0.5-1c0.5-0.7,0.7-1.2,1.3-1.7
                            c0.3-0.3,0.8-0.8,1.5-1.1c0.1,0,0.4-0.2,0.9-0.3c0.4-0.1,0.6-0.1,0.8,0c0.3,0.2,0.3,0.9,0.2,1.4C37,19.1,36,19.6,35.1,20.1z"/>
                        <path class="st7" d="M29.2,21.8c-0.3,0-0.6-0.1-0.9-0.1c0,0,0,0-0.1,0c0,0,0,0,0,0l0.2,0L29.2,21.8z"/>
                    </g>
                </svg>
            </div>

            <h4 class="post-checkout--item">
                Subcription ID: <?php echo $_GET['session']; ?>
            </h4>

            <div class="post-checkout--item post-checkout--item--message">
                <div>
                    <?php if (get_field('order_confirmation_message')) : the_field('order_confirmation_message');
                        
                    else: echo 'Thank you for placing an order'; endif; ?>
                </div>
            </div>

        </div>
	</div>
</main>

<?php get_footer(); ?>
