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
        // make PDF link to go to actual pdf
        if(isset($_REQUEST['f'])) {
            $data['pdf_link'] = "?c=pdf&f=" . $_REQUEST['f'];
            $data['f'] = $_REQUEST['f'];
        }
        else {
            $data['pdf_link'] = "?c=pdf";
            $data['f'] = '';
        }

        // set up locale
        putenv('LC_ALL=en_US');
        setlocale(LC_ALL, 'en_US'); // say locale
        if(strcmp($_SESSION['language'], 'English') === 0) {
            bindtextdomain("messages_en-US", "./locale"); // say locale dir
            textdomain("messages_en-US"); // say .mo file
        }
        else if(strcmp($_SESSION['language'], '简体中文') === 0) {
            bindtextdomain("messages_zh-CN", "./locale"); // say locale dir
            textdomain("messages_zh-CN"); // say .mo file
        }

        // check for an email being submitted (i.e., send out an email)
        if(isset($_REQUEST['email']) && strcmp($_REQUEST['email'], '') !== 0) {
            $email = $_REQUEST['email'];
            if($this->sendPDFEmail($email)) {
                // entered email was valid
                $data['email_message'] = htmlentities(gettext("Successfully sent email to ") . "$email!");
            }
            else {
                // entered email was invalid
                $data['email_message'] = htmlentities(gettext("An error occurred when attempting to send an email to ") .
                    "$email; " . gettext("please make sure the entered email is valid"));
            }
        }

        // set up some text for the view
        $data['send-email-text'] = gettext('Send your wish out! (You can directly view your wish at ');
        $data['email-text'] = gettext('Email ');
        $data['here-text'] = gettext('here');
        $data['send-text'] = gettext('Send');
        $data['send-emails-title-text'] = gettext('Send Wish Emails');

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
            // add on to message link to the PDF if it is specified
            $message = Config::EMAIL_MESSAGE_START;
            if(isset($_REQUEST['f'])) {
                $message .= gettext("The wish is located at ") . Config::BASE_URL . "?c=pdf&f=" . $_REQUEST['f'];
            }
            else {
                $message .= gettext("There was an error in generating the wish PDF link.");
            }
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