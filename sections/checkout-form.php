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
                <p class="checkout--item-name"><?php echo $response->name; ?> - <?php echo $response->nickname; ?></p>
                <img class="checkout--product-image" src="data:image/png;base64,<?php echo $productImg; ?>" alt="Product picture"/>
                <div>
                    <p class="checkout--sub-total">Sub Total</p>
                    <div class="checkout--price-container">
                        <p class="checkout--item-amount">
                        <?php echo currencySymbol($response->currency) ?><?php echo number_format($response->amount / 100, 2 ) ?>
                        </p>
                        <?php if ($response->interval): ?><p class="checkout--interval">/<?php echo $response->interval . ($response->interval_count === 1 ? '' : 's'); endif; ?>
                    </div>
                    <p class="checkout--vat">Excluding taxes.</p>
                </div>
                <?php if($response->trial_period_days): ?>
                    <ul class="checkout--list">
                        <li class="checkout--sub-total"><?php echo $response->trial_period_days ?> day trial included.</li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="mb-sm-80 pt-sm-80 col-sm-6 animated animatedFadeIn fadeInDown">
        <form class="checkout-form" id="form" action="<?php echo get_site_url() .'/' . 'checkout' . '/' . 'review'; ?>" method="post">
            <legend class="visible-xs pt-50 w-sm-50"><h6>Billing Details</h6></legend>
            <p class="h4">All fields marked with (*) are required.</p>
            <input required name="first_name" type="text" placeholder="First Name*" value="<?php echo $_SESSION['first_name'] ?>">
            <input required name="last_name" type="text" placeholder="Last Name*" value="<?php echo $_SESSION['last_name'] ?>">
            <input required name="email" type="email" placeholder="Email*" value="<?php echo $_SESSION['email'] ?>">
            <input required name="address.line1" type="text" placeholder="Address Line 1*" value="<?php echo $_SESSION['address_line1'] ?>">
            <input name="address.line2" type="text" placeholder="Address Line 2" value="<?php echo $_SESSION['address_line2'] ?>">
            <input required name="address.city" type="text" placeholder="Town/City/Region*" value="<?php echo $_SESSION['address_city'] ?>">
            <select required id="country-checkout" class="dropdown-checkout" name="address.country" value="<?php echo $_SESSION['address_country'] ?>">
                <option value="">Country*</option>
                <?php foreach($countries as $country): ?>     
                    <option value="<?php echo $country->code; ?>"><?php echo $country->name; ?></option>    
                <?php endforeach ?>
            </select>
            <select id="state-checkout" class="dropdown-checkout hide-field" name="address.state" value="<?php echo $_SESSION[address_state]; ?>">
            </select> 
            <input name="address.postal_code" type="text" placeholder="Zip/Postal Code*" value="<?php echo $_SESSION['address_postal_code'] ?>">
            <div id="card"></div>
        </form>
        <div class="checkout-submit mt-80">
            <button type="submit" form="form">Review Order</button>
        </div>
    </div> 
</div> 