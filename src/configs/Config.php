<?php
namespace cs174\hw5\configs;

/**
 * Class Config
 * @package cs174\hw5\configs
 *
 * Contains constants needed for the Throw-a-Coin-in-the-Fountain
 * website. Change these as necessary based on the server's and
 * database's configuration
 */
class Config {

    // Constant for the full URL to where the index.php file is (leave out /index.php)
    const BASE_URL = "http://192.168.2.131/hw5";  // H
    //const BASE_URL = "http://10.250.22.186/hw5";  // S
    //const BASE_URL = "http://192.168.2.113/hw5";  // H-L

    // Stripe constants
    const STRIPE_SECRET_KEY = "sk_test_Db7T5Pdsy6H5TBSS1CLgBhoI";
    const STRIPE_PUBLISHABLE_KEY = "pk_test_Tcw44PoVIq6JU0oKGvW04egZ";
    const STRIPE_CHARGE_AMOUNT = 50;  // charge amount is in cents (minimum is 50 cents due to Stripe's own rules!)
    const STRIPE_CHARGE_URL = "https://api.stripe.com/v1/charges";
    const STRIPE_CHARGE_CURRENCY = "usd";
    const STRIPE_CHARGE_DESCRIPTION = "Made a wish at the fountain!";

    // curl constants (for submitting payment token to Stripe)
    const CURL_USERAGENT = "Throw-a-Coin-in-the-Fountain";
    const CURL_TIMEOUT = 20;

    // Emailing constants (for sending out link to wish PDF)
    const EMAIL_ADDITIONAL_HEADERS = "From: tacitf@tacitf.com";
    const EMAIL_MESSAGE_START = "You have been invited to look at a wish!\n\n";
    const EMAIL_TITLE = "A new wish! | Throw-a-Coin-in-the-Fountain";

    // Fountain customization constants (for customizing the fountain appearance)
    const FOUNTAIN_COLORS = ['White', 'Gray'];
    const FOUNTAIN_DEFAULT_COLOR = 'White';
    const FOUNTAIN_BAND_COLORS = ['Red', 'Yellow'];
    const FOUNTAIN_BAND_DEFAULT_COLOR = 'Red';
    const FOUNTAIN_WATER_COLORS = ['Blue', 'Turquoise'];
    const FOUNTAIN_WATER_DEFAULT_COLOR = 'Blue';

    // Fountain image files constants (where things are saved)
    //   (all directories are with respect to root directory of project)
    const FOUNTAIN_TEMPORARY_IMAGE_FOLDER = "./src/resources/";
    const FOUNTAIN_TEMPORARY_IMAGE_FILENAME = "tempfountain.png";
    const FOUNTAIN_PERMANENT_IMAGE_FOLDER = "./src/resources/";
    const FOUNTAIN_ERROR_IMAGE_FOLDER = "./src/resources/";
    const FOUNTAIN_ERROR_IMAGE_FILENAME = "fountainerror.png";

    // Some extra constants for wish PDFs
    const LOGO_IMAGE_FULL_PATH = "./src/resources/favicon_full.png";

    // Language change constants
    const LANGUAGES = ['English', '简体中文'];
    const LANGUAGE_DEFAULT = 'English';
}
?>