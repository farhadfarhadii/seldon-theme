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

    if (!$_GET['session']){

        header('Location:' . get_home_url());
        return die();
    }

    // Stripe API endpoint
    $url = 'https://api.stripe.com/v1/invoices/' . 'in_' . $_GET['session'];

    // Set up auth

    $context = stream_context_create([
        "http" => [
            "header" => "Authorization: Bearer " . 'sk_test_kAGeVwDjBHAhEMYN8pfc0a8T'
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
    
    $confirmationMessage = get_field('order_confirmation_message');

?>

<?php get_header(); ?>

<main>
	<div class="container-fluid">
        <div>
            <h3>
                <?php echo (
                    $confirmationMessage['title'] ? 
                    $confirmationMessage['title'] : 
                    'Your Order Has Been Confirmed' ) 
                ?>
            </h3>
        </div>
        <div>
            <h4>
                Order No: <?php echo $_GET['session']; ?>
            </h4>
        </div>
        <div>
            <p>
                <?php echo (
                    $confirmationMessage['message'] ?
                    $confirmationMessage['message'] :
                    'Thank you for placing an order!'
                )?>
            </p>
        </div>
	</div>
</main>

<?php get_footer(); ?>
