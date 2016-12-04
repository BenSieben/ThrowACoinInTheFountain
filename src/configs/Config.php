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

    // Database connection constants
    const DB_HOST = "127.0.0.1"; // host for the database
    const DB_USERNAME = "root"; // username for user connecting to database
    const DB_PASSWORD = ""; // password for user connecting to database
    const DB_DATABASE = "Fountain"; // name of database schema to use for all the website data
    const DB_PORT = "3307"; // port that database is on (note how this is NOT default port 3306!)

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
    const EMAIL_SENDER_ADDRESS = "From: tacitf@tacitf.com";
    const EMAIL_MESSAGE_START = "You have been invited to look at a wish!\n\r\n\r";
    const EMAIL_TITLE = "A new wish! | Throw-a-Coin-in-the-Fountain";
}
?>