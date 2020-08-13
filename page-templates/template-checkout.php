<?php /* Template Name: Checkout Page */
    /**
     * The template for displaying a checkout page.
     *
     */

    function cmp($a, $b) {
        return strcmp($a->name, $b->name);
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

    if ((!$_POST['product_code'] && $_POST['product_code'] != 0) || (!$_POST['price_code'] && $_POST['price_code'] != 0)){

        // TODO: Log this issue.

        header('Location:' . get_home_url() . '/' . '500');
        return die();
    }

    // Get a list of countries
    $url = 'https://api.printful.com/countries';


    // Retrieve the list of countries

    try {

        $countries = json_decode(file_get_contents($url, false, $context))->result;

    } catch (Exception $err) {
        // TODO: Maybe we might want to log unsuccessful attempts.

    }

    if ($countries){
        usort($countries, "cmp");
    }

    // Get product information from the back-end

    $serverEndpoint = 'localhost'

?>

<style>
    #card {
        line-height: 1.5rem;
        background-color: #f8f8f8;
        border-radius: 0;
        border: solid 1px #b8b8b8;
    }
</style>

<main>
	<div class="container-fluid checkout-container justify-content-between">
        <?php  get_template_part( 'sections/page-hero' ); ?>
        <div class="row maxout mb-80 pt-50 col-sm-6">
            <fieldset>
            <legend><h6>Itinary</h6></legend>
            </fieldset>
        </div>
        <div class="row maxout mb-80 pt-50 col-sm-6">
            <form class="checkout-form" id="form" action="/payment" method="post">
                <fieldset>
                <legend><h6>Billing Details</h6></legend>
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
                <input name="address.postal_code" type="text" placeholder="Zip/Postal Code">
                <div id="card"></div>
                </fieldset>
                <fieldset>
                    <div class="checkbox">
                        <input required type="checkbox" /><div>I have read the <a href="">terms and conditions.</a></div>
                    </div>
                    <div class="checkbox">
                        <input required checked type="checkbox" /><div>I would like to sign to sign up for the newsletter.</div>
                    </div>
                    
                </fieldset>
                <div class="checkout-submit">
                    <button>Submit Order</button>
                </div>
            </form>
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
                stateInput.setAttribute('required', true)
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
                        option.setAttribute('selected', true)
                    }
                    option.innerText = state.name
                    stateInput.appendChild(option)
                }

            } else {
                while(stateInput.firstChild) stateInput.removeChild(stateInput.firstChild)
                stateInput.setAttribute('required', false)
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

        function serialize( data ){

            return `first_name=` + 
            `${data.first_name.value.replace(/\s/g,'+')}` + 
            `&last_name=${data.last_name.value.replace(/\s/g,'+')}` + 
            `&email="${data.email.value.replace('@','%40')}"` + 
            `&address.line1="${data['address.line1'].value.replace(/\s/g, '+')}"` + 
            `&address.line2="${data['address.line2'].value.replace(/\s/g, '+')}"` + 
            `&address.city=${data['address.city'].value}` + 
            `&address.postal_code=${data['address.postal_code'].value.replace(/\s/g, '+')}` +
            `&address.country=${data['address.country'].value}` + 
            `&product_code=${data.product_code.value}` +
            `&price_code=${data.price_code.value}`

        }

        async function _submit(event){
            

            event.preventDefault()
            
            // Get the data

            const form = document.getElementById('form')

            let paymentMethodId

            const paymentMethodObj = {
                type: 'card',
                card
            }
                
            try {

                paymentInfo = await stripe.createPaymentMethod( paymentMethodObj )

            } catch(err){

                return console.error(err)
            }

            const body = `${serialize( form.elements )}&payment_id=${paymentInfo.paymentMethod.id}` ,

            options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-url-encoded'
                },
                body
            }
            
            let response
            try {

                response = await fetch( '/payment', options )

            } catch(err){

                return console.error(err)
            }

            if (response.status === 200) console.log(await response.json())



        }
</script>
<?php get_footer(); ?>
