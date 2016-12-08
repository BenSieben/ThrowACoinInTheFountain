<?php
namespace cs174\hw5\controllers;
use cs174\hw5\configs\Config;
use cs174\hw5\models\FountainImageModel;
use cs174\hw5\views\LandingView;

/**
 * Class LandingController
 * @package cs174\hw5\controllers
 *
 * Controller responsible for setting up the
 * landing View's needed data
 */
class LandingController extends Controller {

    /**
     * Calls the view on the
     */
    public function callView() {
        $lv = new LandingView();
        $lv->render($this->initializeData());
    }

    /**
     * Sets up an array of data to pass on to the view for rendering
     * @return array Array of data needed to render the landing view
     */
    private function initializeData() {
        $data = [];
        // Add Stripe information to the data
        $data['stripe_publishable_key'] = Config::STRIPE_PUBLISHABLE_KEY;
        $data['stripe_charge_amount'] = Config::STRIPE_CHARGE_AMOUNT;

        // Add error message (if applicable)
        if(isset($_SESSION['errmsg']) && strcmp($_SESSION['errmsg'], "") !== 0) {
            $data['errmsg'] = htmlentities($_SESSION['errmsg']);
            $_SESSION['errmsg'] = '';
        }

        // Check for language change
        $data['languages'] = Config::LANGUAGES;
        if(isset($_SESSION['language'])) {
            $data['language'] = $_SESSION['language'];
        }
        else {
            $data['language'] = Config::LANGUAGE_DEFAULT;
            $_SESSION['language'] = Config::LANGUAGE_DEFAULT;
        }

        // Check for fountain customizations
        if(isset($_SESSION['name'])) {
            $data['name'] = $_SESSION['name'];
        }
        else {
            $data['name'] = '';
            $_SESSION['name'] = '';
        }
        $data['fountain-colors'] = Config::FOUNTAIN_COLORS;
        if(isset($_SESSION['fountain-color'])) {
            $data['fountain-color'] = $_SESSION['fountain-color'];
        }
        else {
            $data['fountain-color'] = Config::FOUNTAIN_DEFAULT_COLOR;
            $_SESSION['fountain-color'] = Config::FOUNTAIN_DEFAULT_COLOR;
        }

        $data['fountain-band-colors'] = Config::FOUNTAIN_BAND_COLORS;
        if(isset($_SESSION['fountain-band-color'])) {
            $data['fountain-band-color'] = $_SESSION['fountain-band-color'];
        }
        else {
            $data['fountain-band-color'] = Config::FOUNTAIN_BAND_DEFAULT_COLOR;
            $_SESSION['fountain-band-color'] = Config::FOUNTAIN_BAND_DEFAULT_COLOR;
        }

        $data['fountain-water-colors'] = Config::FOUNTAIN_WATER_COLORS;
        if(isset($_SESSION['fountain-water-color'])) {
            $data['fountain-water-color'] = $_SESSION['fountain-water-color'];
        }
        else {
            $data['fountain-water-color'] = Config::FOUNTAIN_WATER_DEFAULT_COLOR;
            $_SESSION['fountain-water-color'] = Config::FOUNTAIN_WATER_DEFAULT_COLOR;
        }

        // submit fountain customization data to the FountainImageModel to produce temporary fountain image
        $fim = new FountainImageModel();
        if($fim->createTemporaryFountain($data)) {
            $data['temp-fountain-image-location'] = Config::FOUNTAIN_TEMPORARY_IMAGE_FOLDER . Config::FOUNTAIN_TEMPORARY_IMAGE_FILENAME;
        }
        else {  // if an error occurred making the temporary fountain image, use error image instead
            $data['temp-fountain-image-location'] = Config::FOUNTAIN_ERROR_IMAGE_FOLDER . Config::FOUNTAIN_ERROR_IMAGE_FILENAME;
        }

        // set up locale
        putenv('LC_ALL=en_US');
        setlocale(LC_ALL, 'en_US'); // say locale
        if(strcmp($data['language'], 'English') === 0) {
            bindtextdomain("messages_en-US", "./locale"); // say locale dir
            textdomain("messages_en-US"); // say .mo file
        }
        else if(strcmp($data['language'], '简体中文') === 0) {
            bindtextdomain("messages_zh-CN", "./locale"); // say locale dir
            textdomain("messages_zh-CN"); // say .mo file
        }

        // all the text displaying on the landing page (use gettext in case of language change)
        $data['language-selection-text'] = gettext('Language Selection');
        $data['change-language-text'] = gettext('Change Language');
        $data['make-wish-text'] = gettext('Make a New Wish!');
        $data['customize-fountain-text'] = gettext('Customize Your Fountain Here');
        $data['your-name-text'] = gettext('Your Name:');
        $data['fountain-color-text'] = gettext('Fountain Color:');
        $data['fountain-band-text'] = gettext('Fountain Band Color:');
        $data['fountain-water-text'] = gettext('Fountain Water Color:');
        $data['change-fountain-text'] = gettext('Change Fountain (Pictured Below)');
        $data['submit-pdf-text'] = gettext('Submit the Wish PDF Here');
        $data['card-number-text'] = gettext('Credit Card Number:');
        $data['cvc-text'] = gettext('CVC:');
        $data['expiration-month-text'] = gettext('Expiration Month:');
        $data['expiration-year-text'] = gettext('Expiration Year:');
        $data['submit-wish-text'] = gettext('Submit Your Wish (');

        return $data;
    }
}
?>