<?php 
    /**
     * Template name: Order Review Page
     * 
     * A template for rewiewing payment and order information
     * during a checkout session.
     */


    // Include utilities
    include get_template_directory() . '/utils/currency-code-converter.php';



    function _checkJurisdiction( $obj, $jurisdiction ){
        return strToLower($obj->jurisdiction) === strToLower($jurisdiction); 
    }

    function getTaxes( $data, $jurisdiction ){

        return array_filter($data, function($data) use ($jurisdiction){
            return strToLower($obj->jurisdiction) === strToLower($jurisdiction); 
        });

    }

    session_start();

    if(!$_POST['payment_id']){

        header('Location:' . get_home_url());
        return die();

    }
    session_start();

    /** 
     * If the product code and price code are not present in the session,
     * the user has directly landed on this page and should be returned
     * to the home page.
    */

    if (!isset($_SESSION['product_code']) || !isset($_SESSION['price_code'])){

        header('Location:' . get_home_url());
        return die();
    }

    foreach($_POST as $param => $value){

        $_SESSION[$param] = $value;
    }

    $_SESSION;

    /** 
     * Use the paymentMethod details to calculate the grand total. This will
     * included any taxes that should be applied. This data is retrieved
     * directly from stripe rather than through the checkout process, so
     * that the data cannot be tampered with on the client side.
    */

    $paymentMethodURL = 'https://api.stripe.com/v1/payment_methods/' . $_POST['payment_id'];

    $context = stream_context_create([
        "http" => [
            "header" => "Authorization: Bearer " . 'sk_test_kAGeVwDjBHAhEMYN8pfc0a8T'
        ]
    ]);

    try {

        $paymentMethod = json_decode(file_get_contents($paymentMethodURL, false, $context));

    } catch (Exception $err){

        // TODO: Log this issue.

        header('Location:' . get_home_url() . '/' . '500');
        return die();
    }

    // Get product information from the back-end

    $serverEndpoint = 'http://localhost:8080/products' . '/' . $_SESSION['product_code'] . '?' . 'price_code' . '=' . $_SESSION['price_code'];

    try {
        $response = json_decode(file_get_contents($serverEndpoint));

    } catch (Exception $err) {

        // TODO: Log this issue.

        header('Location:' . get_home_url() . '/' . '500');
        return die();
    }

    /** Pre-fetch the product image. This will be converted
     * to base64 and preloaded in the website request.
    */ 

    $productImg = base64_encode(file_get_contents($response->image));


    // Retrieve taxes information

    $taxesURL = 'https://api.stripe.com/v1/tax_rates';


    try {

        $taxes = json_decode(file_get_contents($taxesURL, false, $context));

    } catch(Exception $err) {

        //TODO
    }

    if ($taxes && count($taxes->data)) $appliedTaxes = getTaxes($taxes->data, $paymentMethod->card->jurisdiction );

    if (count($appliedTaxes) > 0){
 
        $taxesSum = 0;

        foreach($appliedTaxes as $appliedTax){

            $taxesSum += $appliedTax->percentage;

        }
        $grandTotal = $response->amount * ( 1 + $taxesSum / 100 );

    }

    /** Pre-fetch the product image. This will be converted
     * to base64 and preloaded in the website request.
    */ 

    $productImg = base64_encode(file_get_contents($response->image));

    get_header();

?>

<main>
	<div class="container-fluid checkout-container justify-content-between">
        <div class="col-md-11 col-md-offset-1 pt-50">
            <h3><?php echo get_the_title(); ?></h3>
        </div>
        <div class="col-md-11 col-md-offset-1 pb-80">
            <div class="container-fluid visible-sm visible-md visible-lg">
                <div class="col-sm-6">
                <legend><h6>Itinary</h6></legend>
                </div>
                <div class="col-sm-6">
                <legend><h6>Billing Details</h6></legend>
                </div>
            </div>
            <div class="checkout--layout">
                <div class="mb-sm-80 pt-sm-50 col-sm-6 animated animatedFadeIn fadeInUp checkout-section">
                    <legend class="visible-xs pt-50"><h6>Itinary</h6></legend>
                    <div>
                        <div class="checkout--product">
                            <!-- <p class="checkout--item-name"></p>
                            <img class="checkout--product-image" src="data:image/png;base64,<?php echo $productImg ?>" alt="Product picture"/>
                            <div>
                                <p class="checkout--grand-total">Grand Total</p>
                                <p class="checkout--item-amount"><?php //echo currencySymbol($response->currency) ?><?php //echo number_format($grandTotal / 100, 2 ) ?>
                            </div> -->
                            <ul>
                                <li><?php echo number_format($response->amount / 100, 2); ?></li>
                                <li>
                                    <p>Taxes:</p>
                                    <ul>
                                        <?php foreach($appliedTaxes as $appliedTax): ?>
                                            <li>
                                                <div>
                                                    <span><?php echo $appliedTax->display_name; ?></span> - <span><?php echo number_format($response->amount * $appliedTax->percentage / 10000, 2); ?> (<?php echo $appliedTax->percentage; ?>%)</span>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li>
                                    <div>
                                        <span>Grand Total</span> - <span><?php echo number_format($grandTotal / 100, 2); ?></span>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mb-sm-80 pt-sm-80 col-sm-6 animated animatedFadeIn fadeInDown">
                    <legend class="visible-xs pt-50 w-sm-50"><h6>Billing Details</h6></legend>
                    <p><?php echo $_POST['first_name']; ?></p>
                    <p><?php echo $_POST['last_name']; ?></p>
                    <p><?php echo $_POST['email']; ?></p>
                    <p><?php echo $_POST['address_line1']; ?></p>
                    <p><?php echo $_POST['address_line2']; ?></p>
                    <p><?php echo $_POST['address_city']; ?></p>
                    <p><?php echo $_POST['address_postal_code']; ?></p>
                    <p><?php echo $_POST['address_state']; ?></p>
                    <p><?php echo $_POST['address_country'] ;?></p>
                    <p>
                        Card: <?php echo $paymentMethod->card->brand; ?> ending in <?php echo $paymentMethod->card->last4; ?>
                    </p>            
                    <div style="padding-top:24px">
                        <legend><h6></h6></legend>
                        <form class="review-form" id="form" action="<?php echo get_home_url() . '/' . 'process-payment' ?>" method="post">
                            <div class="order--checkbox">
                                <input required type="checkbox" /><span>I have read the <a href="">terms and conditions.</a></span>
                            </div>
                            <div class="order--checkbox">
                                <input required checked type="checkbox" /><span>I would like to sign to sign up for the newsletter.</span>
                            </div>
                            <div class="order-submit">
                                <input class="button" type="submit" value="Confirm Order">
                            </div>
                        </form>
                    </div>
                </div> 
            </div> 
        </div>  
	</div>
</main>

