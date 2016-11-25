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
    <form action="" method="POST">
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?= $data['stripe_test_key'] ?>"
            data-amount="<?= $data['stripe_charge_amount'] ?>"
            data-name="Throw-a-Coin-in-the-Fountain"
            data-description="Make a PDF for your wish!"
            data-image="./src/resources/favicon_full.png"
            data-locale="auto"
            data-label="Pay Here!"
            data-email="example@test.com">
        </script>
    </form>
</body>
</html>
<?php
    }
}
?>