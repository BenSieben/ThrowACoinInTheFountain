<?php
namespace cs174\hw5\views;
use cs174\hw5\views\elements\FountainImage;

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
</head>
<body>
    <h1>Throw-a-Coin-in-the-Fountain</h1>
<?php
        if(isset($data['errmsg'])) {
?>
    <div id="serverErrorMessage"><p><?= $data['errmsg'] ?></p></div>
<?php
        }
?>
    <label for="language">Language Selection</label>
    <select name="language" id="language">
        <option value="en" selected="selected">English</option>
        <option value="cn">Chinese (Simplified)</option>
    </select>
    <br />
    <h2>Make a New Wish!</h2>
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
        <p><label for="name">Your Name:</label><input type="text"
                id="name" size="20" name="name"></p>
        <p><label for="card-number">Card Number:</label><input type="text"
                                                               id="card-number" size="20" data-stripe='number'
                                                               name="card-number" /></p>
        <p><label for="cvc">CVC:</label><input type="text" id="cvc" size="4"
                                               data-stripe='cvc' name="cvc" /></p>
        <p><label for="exp-month">Expiration Month:</label><input type="text"
                                                                  id="exp-month" size="2" data-stripe='exp-month' name="exp-month" /></p>
        <p><label for="exp-year">Expiration Year:</label><input type="text"
                                                                id="exp-year" size="2" data-stripe='exp-year' name="exp-year" /></p>
        <p><input type="submit" id="purchase" name="Purchase" value="Submit your wish (for <?= $data['stripe_charge_amount'] ?>&cent;)!"></p>
    </form>
    <div id="clientErrorMessage"></div>
    <script type="text/javascript" src="./src/scripts/landingFormChecker.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"  ></script>
    <script>
        Stripe.setPublishableKey('<?= $data['stripe_publishable_key'] ?>');
    </script>
<?php
        $fi = new FountainImage();
        echo($fi->render($data));
?>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
</body>
</html>
<?php
    }
}
?>
