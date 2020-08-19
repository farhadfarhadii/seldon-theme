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

    get_header();

    session_start();

    if (!isset($_SESSION)) {

        header('Location:' . get_home_url() . '/' . '500');
        return die();


    }

    $url = 'http://localhost:8080/payment';

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
        "http" => [
            'method' => 'POST',
            'content' => http_build_query($body) 
        ]
    ]);

    try {

        $response = json_decode(file_get_contents($url, false, $context));

    } catch (Exception $err) {

        header('Location:' . get_home_url() . '/' . '500');
        return die();

    }

    if (!$response) {

        header('Location:' . get_home_url() . '/' . '500');
        return die();

    }

    preg_match_all('/[A-Za-z0-9]+/', $response->latest_invoice->id, $matches);

    header('Location:' . get_home_url() . '/' . 'order-confirmation' . '?' . 'session' . '=' . $matches[0][1]);


?>