<?php
namespace cs174\hw5\controllers;
use cs174\hw5\configs\Config as Config;

/**
 * Class Controller
 * @package cs174\hw5\controllers
 *
 * Superclass for any class used
 * as a Controller for the Throw-a-Coin-in-the-Fountain
 * website
 */
class Controller {

    /**
     * This function will look at the current
     * values in PHP super globals such as $_REQUEST
     * to determine which Controller subclass to call
     * to handle the forms
     */
    public function processForms() {
        // TODO add more logic to the process form for different controllers
        header("Location: " . Config::BASE_URL);
    }
}
?>