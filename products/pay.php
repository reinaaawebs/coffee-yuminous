<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 

    if(!isset($_SERVER['HTTP_REFERER'])){
        // redirect them to your desired location
        header('location: http://localhost/coffee-blend');
        exit;
    }

    if(!isset($_SESSION['user_id'])) {
		header("location: ".APPURL."");
	}


?>


    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">Pay with PayPal</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL; ?>">Home</a></span> <span>Pay with PayPal</span></p>
            </div>
           
            </div>
            </div>

            
        </div>

        
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-12 ftco-animate text-center">
            
                
                <!-- PayPal Button Container with Bootstrap classes for centering -->
                <div class="d-flex justify-content-center align-items-center">
                <!-- Replace "test" with your own sandbox Business account app client ID -->
                <script src="https://www.paypal.com/sdk/js?client-id=AQjmMoAQMv2hoWFe5bA_2CBtS3uj-TQe5iE3EhsLWgzJf_S2TtIqhhwzz_R8Hz9xB-luci40FDtIUyVk&currency=USD"></script>
                
                <!-- PayPal button will render inside this container -->
                <div id="paypal-button-container" style="width: 80%; max-width: 500px;"></div>

                
                <script>
                    paypal.Buttons({
                    // Sets up the transaction when a payment button is clicked
                    createOrder: (data, actions) => {
                        return actions.order.create({
                        purchase_units: [{
                            amount: {
                            value: '<?php echo $_SESSION['total_price']; ?>' // Can also reference a variable or function
                            }
                        }]
                        });
                    },
                    // Finalize the transaction after payer approval
                    onApprove: (data, actions) => {
                        return actions.order.capture().then(function(orderData) {
                        window.location.href = 'delete-cart.php';
                        });
                    }
                    }).render('#paypal-button-container');
                </script>
                </div>
            </div>
            </div>
        </div>
    </section>
 <!-- .section -->

    

<?php require "../includes/footer.php"; ?>
    
          


