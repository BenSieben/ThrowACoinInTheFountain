<?php
namespace cs174\hw5\controllers;
use cs174\hw5\configs\Config;
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
        if(isset($_REQUEST['errmsg']) && strcmp($_REQUEST['errmsg'], "") !== 0) {
            $data['errmsg'] = htmlentities(urldecode($_REQUEST['errmsg']));
        }
        return $data;
    }
}
?>