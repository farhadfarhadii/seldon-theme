<?php 

    /**
     *
     * Template name: Process Payment
     * 
     * This template purely exists to handle the server
     * side processes for handling payment information
     * server side.
     * 
     * Afterwards, the server will either redirect the user
     * to an order confirmation, 
     *
     */

      /**
     * If Stripe has not been configured, cancel the checkout process.
     */

    include get_template_directory() . '/utils/live-check.php'; 

    $isError = false;

    if (!$_ENV["STRIPE"]){

        $path = realpath(dirname(__DIR__, 1) . '/' . 'stripe-settings.json');

    $file = fopen( $path , 'r');
    $_ENV['STRIPE'] = json_decode(fread($file, filesize( $path )), 'utf8');
    fclose($file);

    }

    if (!$_ENV['STRIPE']) $isError = true;

    /**
     * If running not on live, always use test keys.
     */

    $_ENV['LIVE'] = liveCheck();

    get_header();

    session_start();

    if (!isset($_SESSION)) {

        header('Location:' . get_home_url() . '/' . '500');
        return die();


    }

    $url = $_ENV['STRIPE'][($_ENV['live'] ? 'LIVE_URL' : 'DEV_URL')] . '/' . 'payment';

    $body = array(
        'first_name'            => $_SESSION['first_name'],
        'last_name'             => $_SESSION['last_name'],
        'email'                 => $_SESSION['email'],
        'address.line1'         => $_SESSION['address_line1'],
        'address.line2'         => $_SESSION['address_line2'],
        'address.city'          => $_SESSION['address_city'],
        'address.state'         => $_SESSION['address_state'],
        'address.country'       => $_SESSION['address_country'],
        'address.postal_code'   => $_SESSION['address_postal_code'],
        'payment_id'            => $_SESSION['payment_id'],
        'product_code'          => $_SESSION['product_code'],
        'price_code'            => $_SESSION['price_code']
    );

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'content' => http_build_query($body),
            'header' => 'Authorization: token ' . $_ENV['STRIPE'][($_ENV['live'] ? 'LIVE_ACCESS_TOKEN' : 'DEV_ACCESS_TOKEN')]
        ],
        'ssl' => array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
        )
        
    ]);

    try {

        $response = file_get_contents($url, false, $context);

    } catch (Exception $err) {

        header('Location:' . get_home_url() . '/' . '500');
        return die();

    }

    if ( $response === false ) {

        $error = error_get_last();

        $_SESSION['Error'] = $error['message'];
        header('Location:' . get_home_url() . '/' . 'checkout');
        return die();
    }

    if (!$response) {

        header('Location:' . get_home_url() . '/' . '500');
        return die();

    }

    $response = json_decode($response);

    // preg_match_all('/[A-Za-z0-9]+/', $response->latest_invoice->id, $matches);

    $id = str_replace('sub_','',$response->id);

    header('Location:' . get_home_url() . '/' . 'order-confirmation' . '?' . 'subscription' . '=' . $id);


?>