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
        if(isset($_REQUEST['c'])) {  // c is name of Controller to call
            if(strcmp($_REQUEST['c'], 'landing') === 0) {  // use LandingController
                $lc = new LandingController();
                $lc->callView();
            }
            else if(strcmp($_REQUEST['c'], 'paysubmit') === 0) {  // use PaySubmissionController
                $psc = new PaySubmissionController();
                $psc->handlePaymentForm();
            }
            else if(strcmp($_REQUEST['c'], 'email') === 0) {  // use SendEmailController
                $sec = new SendEmailController();
                $sec->setUpView();
            }
            else if(strcmp($_REQUEST['c'], 'pdf') === 0) {  // use PDFController
                $pdfc = new PDFController();
                $pdfc->setUpView();
            }
            else if(strcmp($_REQUEST['c'], 'sessionchange') === 0) {  // use SessionChange
                if(isset($_REQUEST['m'])) {
                    if(strcmp($_REQUEST['m'], 'language') === 0) {  // call handleLanguageChange
                        $scc = new SessionChangeController();
                        $scc->handleLanguageChange();
                    }
                    else if(strcmp($_REQUEST['m'], 'fountain') === 0) {  // call handleFountainChange
                        $scc = new SessionChangeController();
                        $scc->handleFountainChange();
                    }
                    else {  // if m is an unrecognized method, go back to landing page
                        header("Location: " . Config::BASE_URL . "?c=landing");
                    }
                }
                else {  // if m is not set for session change controller, send user back to landing page
                    header("Location: " . Config::BASE_URL . "?c=landing");
                }
            }
            else {  // default to LandingController if given bad class to use
                header("Location: " . Config::BASE_URL . "?c=landing");
            }
        }
        else {  // if $_REQUEST['c'] is not set, show default landing page
            header("Location: " . Config::BASE_URL . "?c=landing");
        }
    }
}
?>