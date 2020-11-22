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
                            <ul class="order-review--tally">
                                <li>
                                    <p class="checkout--item-name"><?php echo $response->name; ?> - <?php echo $response->nickname; ?></p>
                                </li>
                                <li>
                                    <div>
                                        <p class="order-review--subtext">Sub Total</p>
                                        <p style="text-align:right"><?php echo $currency . number_format($response->amount / 100, 2); ?></p>
                                    </li>
                                <?php if ($appliedTaxes): ?>
                                    <li>
                                        <p class="order-review--subtext">Taxes</p>
                                        <ul>
                                            <?php foreach($appliedTaxes as $appliedTax): ?>
                                                <li>
                                                    <div style="display:flex; justify-content:space-between">
                                                        <p style="font-size:16px"><?php echo $appliedTax->display_name; ?></p> <p style="font-size:16px"><?php echo $currency . number_format($response->amount * $appliedTax->percentage / 10000, 2); ?></p>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <div>
                                        <p class="order-review--subtext">Grand Total</p>
                                        <p class="checkout--item-amount" style="text-align:right"><?php echo $currency . number_format($grandTotal / 100, 2); ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <p class="checkout--vat">Reoccurs monthly.</p>
                                    </div>
                                </li>
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
                    <p><?php echo $_POST['address_state']; ?></p>
                    <p><?php echo $_POST['address_postal_code']; ?></p>
                    <p><?php echo $_POST['address_country'] ;?></p>
                    <p>
                        Card: <?php echo $paymentMethod->card->brand; ?> ending in <?php echo $paymentMethod->card->last4; ?>
                    </p>            
                    <div style="padding-top:24px">
                        <legend></legend>
                        <form class="review-form" id="form" action="<?php echo get_home_url() . '/' . 'process-payment' ?>" method="post">
                            <div class="order--checkbox">
                                <input required type="checkbox" /><span>I have read the <a href="">terms and conditions.</a></span>
                            </div>
                            <div class="order--disclaimer">
                                <p>By clicking on the confirm order button, you hereby accept that you are authorized to perform this transaction with the selected payment method.</p>
                            </div>
                            <div class="order-submit">
                                <input class="button" type="submit" value="Confirm Order">
                            </div>
                        </form>
                    </div>
                </div> 
            </div>