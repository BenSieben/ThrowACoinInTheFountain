<?php
namespace cs174\hw5\controllers;
use cs174\hw5\configs\Config;

/**
 * Class SessionChangeController
 * @package cs174\hw5\controllers
 *
 * Controller which handles multiple cases of data
 * being sent in POST by adding these variables
 * into the user's session
 */
class SessionChangeController extends Controller {

    /**
     * Reacts to the changing of display language
     * on the landing page
     * (reading in data from $_REQUEST)
     */
    public function handleLanguageChange() {
        // TODO actually handle language change(?)
        if(isset($_REQUEST['language'])) {
            $_SESSION['language'] = $_REQUEST['language'];
        }
        // send user back to landing page with updated session variables
        header("Location: " . Config::BASE_URL . "?c=landing");
    }

    /**
     * Reacts to the changing of the fountain
     * options on the landing page
     * (reading in data from $_REQUEST)
     */
    public function handleFountainChange() {
        // TODO actually handle fountain changes(?)
        // examine fountain changes
        if(isset($_REQUEST['name'])) {
            $_SESSION['name'] = $_REQUEST['name'];
        }
        if(isset($_REQUEST['fountain-color'])) {
            $_SESSION['fountain-color'] = $_REQUEST['fountain-color'];
        }
        // examine fountain band color change
        if(isset($_REQUEST['fountain-band-color'])) {
            $_SESSION['fountain-band-color'] = $_REQUEST['fountain-band-color'];
        }
        // examine fountain water color change
        if(isset($_REQUEST['fountain-water-color'])) {
            $_SESSION['fountain-water-color'] = $_REQUEST['fountain-water-color'];
        }
        // send user back to landing page with updated session variables
        header("Location: " . Config::BASE_URL . "?c=landing");
        exit();
    }

}
?>