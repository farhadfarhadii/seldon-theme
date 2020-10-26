<?php /* Template Name: Checkout Page */
    /**
     * The template for displaying a checkout page.
     *
     */

    include get_template_directory() . '/utils/live-check.php';

    /** The user should have started a session from the solutions
    * page. If not, the user needs to be redirected to the home
    * page.
    */

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

    session_start();
    if (!isset($_SESSION['HTTP_REFERER'])){

        header('Location:' . get_home_url() );
        return die();
    }

    function cmp($a, $b) {
        return strcmp($a->name, $b->name);
    }

    function currencySymbol($currency){

        switch($currency){
            default: return '$';
            case 'gbp': return '£';
            case 'eur': return '€';
        }
    }

    get_header();

    /**
     * Create a checkout session by obtaining the data from
     * the post request.  
     */

    /**
     * Has the product code and price code been sent to the page?
     * If not, something went wrong and we should let the user know.
     * 
    */ 

    if ( ($_POST['product_code'] == null || $_POST['price_code']  == null) && ($_SESSION['product_code'] == null || $_SESSION['price_code']  == null) ){

        // TODO: Log this issue.

        header('Location:' . get_home_url() . '/' . '500');
        return die();
    }

    // Keep product and price as a session cookie to retrieve later.
    if (!isset($_SESSION['product_code'])) $_SESSION['product_code'] = $_POST['product_code'];
    if (!isset($_SESSION['price_code'])) $_SESSION['price_code'] = $_POST['price_code'];

    // Get a list of countries
    $url = 'https://api.printful.com/countries';


    // Retrieve the list of countries

    try {

        $countries = json_decode(file_get_contents($url))->result;

    } catch (Exception $err) {
        // An error has occured and we need to abandon the checkout flow.
        // TODO: Report error.

        header('Location:' . get_home_url() . '/' . '500');
        return die();

    }

        

    if ($countries){
        usort($countries, "cmp");
    } else {
        // The request failed. Abandon Checkout.
        $isError = true;
    }

    // Get product information from the back-end

    $serverEndpoint = $_ENV['STRIPE']['url'] . '/' . 'products' . '/' . $_SESSION['product_code'] . '?' . 'price_code' . '=' . $_SESSION['price_code'];

    // Set up auth

    $context = stream_context_create([
        "http" => [
            "header" => "Authorization: token " . $_ENV['STRIPE']['ACCESS_TOKEN']
        ],
        "ssl" => array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        )
    ]);

    try {
        $response = json_decode(file_get_contents($serverEndpoint, false, $context));

    } catch (Exception $err) {

        // TODO: Log this issue.

        header('Location:' . get_home_url() . '/' . '500');
        return die();
    }

    if (!$response) {
        // The request failed. Abandon Checkout.
        $isError = true;
    }

    /** Pre-fetch the product image. This will be converted
     * to base64 and preloaded in the website request.
    */ 

    $productImg = base64_encode(file_get_contents($response->image));

?>

<main>
	<div class="container-fluid checkout-container justify-content-between">
        <div class="col-md-11 col-md-offset-1 pt-50">
            <div>
                <a href="<?php echo $_SESSION['HTTP_REFERER']; ?>" alt="Cancel">
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
        <div class="col-md-11 col-md-offset-1 pb-80">
            <?php 
                if (!$isError) include_once(get_template_directory() . '/' . 'sections/checkout-form.php');
                else include_once(get_template_directory() . '/' . 'sections/checkout-down.php');
            ?>
        </div>  
	</div>
</main>
<?php if (!$isError): ?>
    <script defer>
        let componentState = {
            country: '',
            state: ''
        }, countries
        const stripe = Stripe('<?php echo $_ENV['LIVE'] ? $_ENV['STRIPE']['API_PUBLIC_KEY_LIVE'] : $_ENV['STRIPE']['API_PUBLIC_KEY_TEST']; ?>'),
            elementOptions = {
                fonts: [{
                    family: "Monosten Light",
                    src: 'url(https://www.seldon.io/wp-content/themes/seldon/includes/fonts/Monosten-Light.otf)'
                }],
            },
            elements = stripe.elements( elementOptions ),
            style = {
                base: {
                    fontSize: '16px',
                    fontFamily: 'Monosten Light',
                    fontWeight: '300',
                }
            },
            stateInput = document.getElementById('state-checkout'),
            countryInput = document.getElementById('country-checkout'),
            handleResponse = async data => { 
                countries = (await data.json()).result
            
            },
            toggleState = ({ target }) => {
                let country = countries.find( country => country.code === target.value )
                if (country && country.states){
                    if (componentState.country !== country.code){
                        while(stateInput.firstChild) stateInput.removeChild(stateInput.firstChild)
                    }
                    stateInput.setAttribute('required')
                    if (stateInput.classList.contains('hide-field')) stateInput.classList.remove('hide-field')
                    country.states.sort(( a, b) => a.name > b.name)

                    let option = document.createElement('option')
                        option.setAttribute('value', '')
                        option.innerText = 'State*'
                        stateInput.appendChild(option)
                        
                    for (let state of country.states){
                        let option = document.createElement('option')
                        option.setAttribute('value', state.code)
                        if (state.code === componentState.state ){ 
                            option.setAttribute('selected')
                        }
                        option.innerText = state.name
                        stateInput.appendChild(option)
                    }

                } else {
                    while(stateInput.firstChild) stateInput.removeChild(stateInput.firstChild)
                    stateInput.removeAttribute('required')
                    stateInput.classList.add('hide-field')
                }

                componentState.country = country.code
            },
            handleStateChange = ({ target }) => componentState.state = target.value,
            onCountryChange = ({ target }) => {
                if (target.dataset.taxCode){

                } else {
                    
                }
            }

        fetch('https://cors-anywhere.herokuapp.com/https://api.printful.com/countries')
        .then( data => handleResponse(data) )


        countryInput.addEventListener('change', toggleState )

        stateInput.addEventListener('change', handleStateChange )

        card = elements.create('card', { style, hidePostalCode: true })
        card.mount('#card')

        document.getElementById('form').addEventListener('submit', _submit )

        document.getElementById('country-checkout').addEventListener('change', onCountryChange )

        async function _submit(event){
            
            // Get the data

            const form = document.getElementById('form')

            let paymentMethodId

            const paymentMethodObj = {
                type: 'card',
                card
            }

            let paymentInfo
                
            try {

                paymentInfo = await stripe.createPaymentMethod( paymentMethodObj )

            } catch(err){

                return console.error(err)
            }

            const po = document.createElement('input')
            po.setAttribute('hidden', true)
            po.setAttribute('required', true)
            po.setAttribute('name', 'payment_id')
            po.setAttribute('value', paymentInfo.paymentMethod.id)
            form.appendChild(po)

            form.submit()
        }
    </script>
<?php endif; get_footer(); ?>
