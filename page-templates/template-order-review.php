<?php 
    /**
     * Template name: Order Review Page
     * 
     * A template for rewiewing payment and order information
     * during a checkout session.
     */


    // Include utilities
    include get_template_directory() . '/utils/currency-code-converter.php';
    include get_template_directory() . '/utils/live-check.php';

    get_header();

    /**
     * If Stripe has not been configured, cancel the checkout process.
     */

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


    function _checkJurisdiction( $obj, $jurisdiction ){
        return strToLower($obj->jurisdiction) === strToLower($jurisdiction); 
    }

    function getTaxes( $data, $jurisdiction ){

        return array_filter($data, function($data) use ($jurisdiction){
            return strToLower($data->jurisdiction) === strToLower($jurisdiction); 
        });

    }

    get_header();
    session_start();

    $_SESSION['Error'] = false;

    if(!$_POST['payment_id']){

        $isError = true;
    }

    foreach($_POST as $param => $value){

        $_SESSION[$param] = $value;
    }


    /** 
     * If the product code and price code are not present in the session,
     * the user has directly landed on this page and should be returned
     * to the home page.
    */

    if (!isset($_SESSION['product_code']) || !isset($_SESSION['price_code'])){

        $isError = true;
    }

    /** 
     * Use the paymentMethod details to calculate the grand total. This will
     * included any taxes that should be applied. This data is retrieved
     * directly from stripe rather than through the checkout process, so
     * that the data cannot be tampered with on the client side.
    */

    $paymentMethodURL = 'https://api.stripe.com/v1/payment_methods/' . $_POST['payment_id'];
    $token = $_ENV['LIVE'] ? $_ENV['STRIPE']['API_SECRET_KEY_LIVE'] : $_ENV['STRIPE']['API_PRIVATE_KEY_TEST'];

    $context = stream_context_create([
        "http" => [
            "header" => "Authorization: Bearer " . $token
        ]
    ]);

    try {

        $paymentMethod = json_decode(file_get_contents($paymentMethodURL, false, $context));

    } catch (Exception $err){

        // TODO: Log this issue.

        $isError = true;
    }

    if (!$paymentMethod) $isError = true; 

    // Get product information from the back-end

   $serverEndpoint = $_ENV['STRIPE'][($_ENV['LIVE'] ? 'LIVE_URL' : 'DEV_URL')] . '/' . 'products' . '/' . $_SESSION['product_code'] . '?' . 'price_code' . '=' . $_SESSION['price_code'];

    $serverContext = stream_context_create([
        "http" => [
            "header" => "Authorization: token " . $_ENV['STRIPE'][($_ENV['LIVE'] ? 'LIVE_ACCESS_TOKEN' : 'DEV_ACCESS_TOKEN')]
        ],
        "ssl" => array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        )
    ]);


    try {
        $response = json_decode(file_get_contents($serverEndpoint, false, $serverContext));

    } catch (Exception $err) {

        // TODO: Log this issue.

        header('Location:' . get_home_url() . '/' . '500');
        return die();
    }

    if (!$response) $isError = true;
    else {
        /** Pre-fetch the product image. This will be converted
         * to base64 and preloaded in the website request.
        */ 

        $productImg = base64_encode(file_get_contents($response->image));
    }


    // Retrieve taxes information

    $taxesURL = 'https://api.stripe.com/v1/tax_rates';


    try {

        $taxes = json_decode(file_get_contents($taxesURL, false, $context));

    } catch(Exception $err) {

        //TODO
    }

    if ($taxes && count($taxes->data)) $appliedTaxes = getTaxes($taxes->data, $paymentMethod->card->country );

    if (count($appliedTaxes) > 0 && $response){
 
        $taxesSum = 0;

        foreach($appliedTaxes as $appliedTax){

            $taxesSum += $appliedTax->percentage;

        }
        $grandTotal = $response->amount * ( 1 + $taxesSum / 100 );

    } else {
        $grandTotal = $response->amount;
    }

    $currency = currencySymbol($response->currency);

?>

<main>
	<div class="container-fluid checkout-container justify-content-between">
        <div class="col-md-11 col-md-offset-1 pt-50">
        <div>
            <a href="<?php echo get_site_url() . '/' . 'checkout'; ?>" alt="Cancel">
            <svg version="1.1" class="checkout--icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 18 18" style="enable-background:new 0 0 18 18;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill:none;}
                </style>
                <path class="st0" d="M0,0h18v18H0V0z"/>
                <path d="M9,3l1.1,1.1L5.9,8.3H15v1.5H5.9l4.2,4.2L9,15L3,9L9,3z"/>
            </svg>
            </a>
        </div>
            <h3><?php echo get_the_title(); ?></h3>
        </div>
        <div class="pt-30 pv-50 mt-10 col-xs-12 z-2 bleed_none content-block">
            <?php if ($isError) include_once(get_template_directory() . '/' . 'sections/checkout-down.php');
            else include_once(get_template_directory() . '/' . 'sections/order-review-section.php');?> 
        </div>  
	</div>
</main>

