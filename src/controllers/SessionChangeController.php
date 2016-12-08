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
     * (reading in data from $_POST)
     */
    public function handleLanguageChange() {
        if(isset($_POST['language'])) {
            $_SESSION['language'] = $_POST['language'];
        }
        // send user back to landing page with updated session variables
        header("Location: " . Config::BASE_URL . "?c=landing");
    }

    /**
     * Reacts to the changing of the fountain
     * options on the landing page
     * (reading in data from $_POST)
     */
    public function handleFountainChange() {
        // examine fountain changes
        if(isset($_POST['name'])) {
            // for the name, cut out non-alpha / non-punctuation characters
            $_SESSION['name'] = trim(preg_replace('/[^a-zA-Z\.\']/', '', $_POST['name']));
        }
        if(isset($_POST['fountain-color'])) {
            $_SESSION['fountain-color'] = $_POST['fountain-color'];
        }
        // examine fountain band color change
        if(isset($_POST['fountain-band-color'])) {
            $_SESSION['fountain-band-color'] = $_POST['fountain-band-color'];
        }
        // examine fountain water color change
        if(isset($_POST['fountain-water-color'])) {
            $_SESSION['fountain-water-color'] = $_POST['fountain-water-color'];
        }
        // send user back to landing page with updated session variables
        header("Location: " . Config::BASE_URL . "?c=landing");
        exit();
    }

}
?>