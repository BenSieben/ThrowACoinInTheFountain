<?php
namespace cs174\hw5\views;
use cs174\hw5\views\elements\SelectGenerateElement;
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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
    <form id="change-language-form" method="post" action="?c=sessionchange&m=language">
<?php
        // render the select tags for language choice
        $language_change_element = new SelectGenerateElement('languages', 'language',
            'language', $data['language-selection-text']);
        echo($language_change_element->render($data));
?>
        <input type="submit" value="<?= $data['change-language-text'] ?>" />
    </form>
    <h2><?= $data['make-wish-text'] ?></h2>
    <h4><?= $data['customize-fountain-text'] ?></h4>
    <form id="modify-fountain-form" method="post" action="?c=sessionchange&m=fountain">
        <p><label for="name"><?= $data['your-name-text'] ?></label><input type="text"
                                                      id="name" size="20" name="name"
                                                      value="<?= $data['name'] ?>"></p>
<?php
        // render the select tags for the fountain customizations
        $fountain_color_element = new SelectGenerateElement('fountain-colors', 'fountain-color',
            'fountain-color', $data['fountain-color-text']);
        echo($fountain_color_element->render($data));
        $fountain_band_color_element = new SelectGenerateElement('fountain-band-colors', 'fountain-band-color',
            'fountain-band-color', $data['fountain-band-text']);
        echo($fountain_band_color_element->render($data));
        $fountain_water_color_element = new SelectGenerateElement('fountain-water-colors', 'fountain-water-color',
            'fountain-water-color', $data['fountain-water-text']);
        echo($fountain_water_color_element->render($data));
?>
        <p><input type="submit" value="<?= $data['change-fountain-text'] ?>" /></p>
    </form>
    <img src="<?= $data['temp-fountain-image-location'] ?>" alt="fountain" />
    <br />
    <h4><?= $data['submit-pdf-text'] ?></h4>
    <form id="purchase-stuff-form" method="post" action="?c=paysubmit">
        <input type="hidden" id="credit-token"  name="credit_token" value="" />
        <p><label for="card-number"><?= $data['card-number-text'] ?></label><input type="text"
                                                               id="card-number" size="20" data-stripe='number'
                                                               name="card-number" /></p>
        <p><label for="cvc"><?= $data['cvc-text'] ?></label><input type="text" id="cvc" size="4"
                                               data-stripe='cvc' name="cvc" /></p>
        <p><label for="exp-month"><?= $data['expiration-month-text'] ?></label><input type="text"
                                                                  id="exp-month" size="2" data-stripe='exp-month' name="exp-month" /></p>
        <p><label for="exp-year"><?= $data['expiration-year-text'] ?></label><input type="text"
                                                                id="exp-year" size="2" data-stripe='exp-year' name="exp-year" /></p>
        <p><input type="submit" id="purchase" name="Purchase" value="<?= $data['submit-wish-text'] . $data['stripe_charge_amount'] . '&cent;)!' ?>"></p>
    </form>
    <div id="clientErrorMessage"></div>
    <script type="text/javascript" src="./src/scripts/landingFormChecker.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        Stripe.setPublishableKey('<?= $data['stripe_publishable_key'] ?>');
    </script>
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
