<?php
namespace cs174\hw5\controllers;
use cs174\hw5\configs\Config;
use cs174\hw5\views\SendEmailView;

/**
 * Class SendEmailController
 * @package cs174\hw5\controllers
 *
 * Sets up the send email view with
 * appropriate data
 */
class SendEmailController extends Controller {

    /**
     * Sets up, and then renders the Email view
     */
    public function setUpView() {
        $sev = new SendEmailView();
        $data = $this->setUpEmailViewData();
        $sev->render($data);
    }

    /**
     * Determines from variables like $_REQUEST data to
     * pass along to the Email view
     * @return array data that is important for
     * the Email view
     */
    private function setUpEmailViewData() {
        $data = [];
        $data['base_url'] = Config::BASE_URL;
        return $data;
    }

}
?>