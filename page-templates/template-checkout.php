<?php /* Template Name: Checkout Page */
    /**
     * The template for displaying a checkout page.
     *
     */

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
     * If not, something went wrong and we should let the user know.(
    */ 

    if ($_POST['product_code'] == null || $_POST['price_code']  == null ){

        // TODO: Log this issue.

        header('Location:' . get_home_url() . '/' . '500');
        return die();
    }

    // Get a list of countries
    $url = 'https://api.printful.com/countries';


    // Retrieve the list of countries

    try {

        $countries = json_decode(file_get_contents($url))->result;

    } catch (Exception $err) {
        // TODO: Maybe we might want to log unsuccessful attempts.

    }

    if ($countries){
        usort($countries, "cmp");
    }

    // Get product information from the back-end

    $serverEndpoint = 'http://localhost:8080/products' . '/' . $_POST['product_code'] . '?' . 'price_code' . '=' . $_POST['price_code'];

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
                            <p class="checkout--item-name"><?php echo $response->name; ?> - <?php echo $response->nickname ?></p>
                            <img class="checkout--product-image" src="data:image/png;base64,<?php echo $productImg ?>" alt="Product picture"/>
                            <div>
                                <p class="checkout--grand-total">Grand Total</p>
                                <div class="checkout--price-container">
                                    <p class="checkout--item-amount">
                                    <?php echo currencySymbol($response->currency) ?><?php echo number_format($response->amount / 100, 2 ) ?>
                                    </p>
                                    <?php if ($response->interval): ?><p class="checkout--interval">/<?php echo $response->interval . ($response->interval_count === 1 ? '' : 's'); endif; ?>
                                </div>
                                <p class="checkout--vat">Excluding VAT</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-sm-80 pt-sm-80 col-sm-6 animated animatedFadeIn fadeInDown">
                    <form class="checkout-form" id="form" action="./checkout/review" method="post">
                        <legend class="visible-xs pt-50 w-sm-50"><h6>Billing Details</h6></legend>
                        <p class="h4">All fields marked with (*) are required.</p>
                        <input class="mb-4" readonly name="product_code" type="hidden" value="<?php echo $_POST['product_code'] ?>">
                        <input readonly name="price_code" type="hidden" value="<?php echo $_POST['price_code'] ?>">
                        <input readonly name="customer_id" type="hidden" value="<?php echo $_SESSION['customer_id'] ?>">
                        <input required name="first_name" type="text" placeholder="First Name*">
                        <input required name="last_name" type="text" placeholder="Last Name*">
                        <input required name="email" type="email" placeholder="Email*">
                        <input required name="address.line1" type="text" placeholder="Address Line 1*">
                        <input name="address.line2" type="text" placeholder="Address Line 2">
                        <input required name="address.city" type="text" placeholder="Town/City/Region*">
                        <select required id="country-checkout" class="dropdown-checkout" name="address.country">
                            <option value="">Country*</option>
                            <?php foreach($countries as $country): ?>     
                                <option value="<?php echo $country->code; ?>"><?php echo $country->name; ?></option>    
                            <?php endforeach ?>
                        </select>
                        <select id="state-checkout" class="dropdown-checkout hide-field" name="address.state">
                        </select> 
                        <input name="address.postal_code" type="text" placeholder="Zip/Postal Code*">
                        <div id="card"></div>
                    </form>
                    <div class="checkout-submit mt-80">
                        <button type="submit" form="form">Review Order</button>
                    </div>
                </div> 
            </div> 
        </div>  
	</div>
</main>
<script defer>
let componentState = {
    country: '',
    state: ''
}
    let countries
    const stripe = Stripe('pk_test_zR1r4UWZmpVNsVPL1pGnoBaB'),
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
        handleStateChange = ({ target }) => componentState.state = target.value

        fetch('https://cors-anywhere.herokuapp.com/https://api.printful.com/countries')
        .then( data => handleResponse(data) )


        countryInput.addEventListener('change', toggleState )

        stateInput.addEventListener('change', handleStateChange )

        card = elements.create('card', { style, hidePostalCode: true })
        card.mount('#card')

        document.getElementById('form').addEventListener('submit', _submit )

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
<?php get_footer(); ?>
