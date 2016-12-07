<?php
namespace cs174\hw5\models;
use cs174\hw5\configs\Config as Config;

/**
 * Class Model
 * @package cs174\hw5\models
 *
 * Superclass for any class used
 * as the Model for the Throw-a-Coin-in-the-Fountain
 * website
 */
class Model {

    /**
     * Creates and returns a database connection for the Throw-a-Coin-in-the-Fountain website
     * (unused for this project because a database is not technically needed)
     * @return \mysqli the database connection (based on settings in Config.php)
     */
    protected function getDatabaseConnection() {
        return new \mysqli(Config::DB_HOST, Config::DB_USERNAME, Config::DB_PASSWORD, Config::DB_DATABASE, Config::DB_PORT);
    }
}
?>