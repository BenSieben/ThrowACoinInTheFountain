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
        // TODO fix PDF link to go to actual pdf!
        $data['pdf_link'] = "?c=pdf";

        // check for an email being submitted (i.e., send out an email)
        if(isset($_REQUEST['email']) && strcmp($_REQUEST['email'], '') !== 0) {
            $email = $_REQUEST['email'];
            if($this->sendPDFEmail($email)) {
                // entered email was valid
                $data['email_message'] = htmlentities("Successfully sent email to $email!");
            }
            else {
                // entered email was invalid
                $data['email_message'] = htmlentities("An error occurred when attempting to send an email to " .
                    "$email; please make sure the entered email is valid");
            }
        }
        return $data;
    }

    /**
     * Sends email with information about the PDF wish just made
     * to the parameter email
     * @param $email String email address to send email to
     * @return boolean true if email was successfully sent, false if it failed
     */
    private function sendPDFEmail($email) {
        if(is_string($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            // entered email is valid
            // TODO add on to message link to the PDF
            $message = Config::EMAIL_MESSAGE_START;
            // mail returns true on success email send; false otherwise
            return mail($email, Config::EMAIL_TITLE, $message, Config::EMAIL_ADDITIONAL_HEADERS);
        }
        else {
            // entered email is invalid
            return false;
        }
    }

}
?>