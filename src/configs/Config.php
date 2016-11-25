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
    //const BASE_URL = "http://192.168.2.131/hw4";  // H
    //const BASE_URL = "http://10.250.22.186/hw4";  // S
    const BASE_URL = "http://192.168.0.102/hw5";  // LA

    // Database connection constants
    const DB_HOST = "127.0.0.1"; // host for the database
    const DB_USERNAME = "root"; // username for user connecting to database
    const DB_PASSWORD = ""; // password for user connecting to database
    const DB_DATABASE = "PasteChart"; // name of database schema to use for all the website data
    const DB_PORT = "3307"; // port that database is on (note how this is NOT default port 3306!)

}
?>