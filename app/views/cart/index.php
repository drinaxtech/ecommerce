<?php $this->setSiteTitle('Checkout'); ?>
<?php $this->start('head'); ?>

<style>
label.border-danger {
    display: none !important;
}
</style>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<main class="mt-5 pt-4">
    <div class="container wow fadeIn">

        <!-- Heading -->
        <h2 class="my-5 h2 text-center">Checkout</h2>

        <!--Grid row-->
        <div class="row">

            <!--Grid column-->
            <div class="col-md-8 mb-4">

                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <form id="checkout" class="card-body">

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6 mb-2">

                                <!--firstName-->
                                <div class="md-form ">
                                    <input type="text" id="name" name="name" class="form-control" required>
                                    <label for="name" class="">Name</label>
                                </div>

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6 mb-2">

                                <!--lastName-->
                                <div class="md-form">
                                    <input type="text" id="surname" name="surname" class="form-control" required>
                                    <label for="lastName" class="">Surname</label>
                                </div>

                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->


                        <!--email-->
                        <div class="md-form mb-5">
                            <input type="text" id="email" name="email" class="form-control" placeholder="youremail@example.com" required>
                            <label for="email" class="">Email</label>
                        </div>

                        <!--address-->
                        <div class="md-form mb-5">
                            <input type="text" id="address" name="address" class="form-control" placeholder="1234 Main St" required>
                            <label for="address" class="">Address</label>
                        </div>


                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-lg-4 col-md-12 mb-4">

                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" required>

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-lg-4 col-md-6 mb-4">

                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-lg-4 col-md-6 mb-4">

                                <label for="zip">Zip Code</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="" required>

                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <hr>

                        
                        <div class="row">
                            <div id="checkoutButton" class="col-md-12 mb-3">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                            </div>
                            <div id="paypalButtons" class="col-md-12 mb-3" style="display: none">
                                <div style="position: sticky;bottom: 0" id="smart-button-container">
                                    <div style="text-align: center;">
                                        <div id="paypal-button-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        

                    </form>

                </div>
                <!--/.Card-->

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 mb-4">

                <!-- Heading -->
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill"><?php echo $totalQuantity; ?></span>
                </h4>

                <!-- Cart -->
                <ul class="list-group mb-3 z-depth-1">

                    <?php
                    $totalAmount = 0;
                    foreach ($products as $product) :
                        $totalAmount += floatval($product['productAmount']);
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo ucfirst($product['productName']); ?></h6>
                                <small class="text-muted">Quantity: <?php echo $product['productQuantity']; ?></small>
                            </div>
                            <span class="text-muted">$<?php echo number_format($product['productAmount'], 2); ?></span>
                        </li>
                    <?php endforeach; ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$<?php echo number_format($totalAmount, 2); ?></strong>
                    </li>
                </ul>
                <!-- Cart -->


            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </div>
</main>


<?php $this->end(); ?>

<?php $this->start('footer'); ?>
<script src="<?php echo BASE_URL; ?>assets/js/jquery.validate.min.js"></script>
<script>
    const BASE_URL = "<?php echo BASE_URL; ?>";
    $('#checkout').validate({
    errorClass: "text-danger border-danger",
    submitHandler: function(form) {
        let data = new FormData(form);
        $.ajax({
            url: BASE_URL + "cart/save_order",
            data: serializeData(data),
            type: 'POST',
            success: function(data) {
                $( "#checkoutButton" ).hide();
                $( "#paypalButtons" ).fadeIn( "slow", function() {
                    $( "#paypalButtons" ).show();
                    
                });
            }
        });
    }
});

function serializeData(data) {
    let obj = {};
    for (let [key, value] of data) {
        if (obj[key] !== undefined) {
            if (!Array.isArray(obj[key])) {
                obj[key] = [obj[key]];
            }
            obj[key].push(value);
        } else {
            obj[key] = value;
        }
    }
    return obj;
}

</script>


<?php $this->end(); ?>



<script src="https://www.paypal.com/sdk/js?client-id=ASPFBYA8SOQYfEuBhse3HXEUuYJ7r13I08UpQwS9Kd0sJRaldOAJw9MlJ66Io47rxW5jKw1j6sP5D_k5&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'vertical',
                label: 'paypal',

            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        "description": "test itedm",
                        "amount": {
                            "currency_code": "USD",
                            "value": 6
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    // Full available details
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                    // Show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';

                    // Or go to another URL:  actions.redirect('thank_you.html');

                });
            },

            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container');
    }
    initPayPalButton();
</script>