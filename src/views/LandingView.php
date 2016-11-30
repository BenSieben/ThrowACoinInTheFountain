<?php
namespace cs174\hw5\views;

/**
 * Class LandingView
 * @package cs174\hw5\views
 *
 * View responsible for drawing the landing page
 * for the Throw-a-Coin-in-the-Fountain website
 */
class LandingView extends View{

    /**
     * Renders landing page, taking into account $data to
     * fill in certain parts of the page
     * @param $data Array<String> data to show on the web page
     */
    public function render($data) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Throw-a-Coin-in-the-Fountain</title>
    <link rel="icon" href="./src/resources/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./src/styles/stylesheet.css" />
    <script src="./src/scripts/stripeHelper.js"></script>
</head>
<body>
    <h1>Throw-a-Coin-in-the-Fountain</h1>
    <label for="language">Language Selection</label>
    <select name="language" id="language">
        <option value="en" selected="selected">English</option>
        <option value="cn">Chinese (Simplified)</option>
    </select>
    <br />
    <h3>Make a New Wish!</h3>
    <!--
    <form action="?c=paysubmit" method="get">
        <label for="name">Your name</label>
        <input type="text" name="name" id="name" />
        <br />
        <br />
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?= $data['stripe_publishable_key'] ?>"
            data-amount="<?= $data['stripe_charge_amount'] ?>"
            data-name="Throw-a-Coin-in-the-Fountain"
            data-description="Make a PDF for your wish!"
            data-image="./src/resources/favicon_full.png"
            data-locale="auto"
            data-label="Pay Here!"
            data-email="throwacoininthefountain@gmail.com">
        </script>
    </form>
    -->
    <form id="purchase-stuff-form" method="post" action="?c=paysubmit">
        <input type="hidden" id="credit-token"  name="credit_token" value="" />
        <p><label for="amount">Amount:</label><input type="text" id="amount"
                                                     size="2" name="amount" /></p>
        <p><label for="card-number">Card Number:</label><input type="text"
                                                               id="card-number" size="20" data-stripe='number'
                                                               name="card-number" /></p>
        <p><label for="cvc">CVC:</label><input type="text" id="cvc" size="4"
                                               data-stripe='cvc' name="cvc" /></p>
        <p><label for="exp-month">Expiration Month:</label><input type="text"
                                                                  id="exp-month" size="2" data-stripe='exp-month' name="exp-month" /></p>
        <p><label for="exp-year">Expiration Year:</label><input type="text"
                                                                id="exp-year" size="2" data-stripe='exp-year' name="exp-year" /></p>
        <p><input type="submit" id="purchase" name="Purchase" value="Submit your wish!"></p>
    </form>
    <script>
        function elt(id)
        {
            return document.getElementById(id);
        }
        elt('purchase').onclick =
            function(event) {
                var purchase_form = elt('purchase-stuff-form');
                elt('purchase').disabled = true; // prevent additional clicks
                Stripe.card.createToken(purchase_form, tokenResponseHandler);
                event.preventDefault(); //prevent form submitting till get all clear
            };
        function tokenResponseHandler(status, response)
        {
            var purchase_form = elt('purchase-stuff-form');
            if (response.error) {
                alert(response.error.message);
                elt('purchase').disabled = false;
            } else {
                elt('credit-token').value = response.id;
                purchase_form.submit();
            }
        }
    </script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"  ></script>
    <script>
        Stripe.setPublishableKey('<?= $data['stripe_publishable_key'] ?>');
    </script>
</body>
</html>
<?php
    }
}
?>