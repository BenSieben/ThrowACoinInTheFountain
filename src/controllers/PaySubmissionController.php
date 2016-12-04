<?php
namespace cs174\hw5\controllers;
use cs174\hw5\configs\Config;

/**
 * Class PaySubmissionController
 * @package cs174\hw5\controllers
 *
 * Handles when payment information
 * is submitted by user, determining
 * to accept or reject the user's payment
 * information
 */
class PaySubmissionController extends Controller{

    /**
     * Handles form submitted through landing
     * page by analyzing $_REQUEST variable
     * values and then responding based on
     * those values
     */
    public function handlePaymentForm() {
        $paySuccess = $this->tryPayment();
        if($paySuccess === true) {
            // TODO set up PDF file in database because purchase was successful
            // send user to send email view
            header("Location: " . Config::BASE_URL . "?c=email");
        }
        else {
            // send user back to landing page with error message
            header("Location: " . Config::BASE_URL . "?c=landing&errmsg=" . urlencode($paySuccess));
        }
    }

    /**
     * Tries to submit payment information to Stripe, using the generated credit_token
     * @return bool|string true on payment success, or else an error
     * message from Stripe is given (if no error message, empty string
     * given back)
     */
    private function tryPayment() {
        $message = "";
        $token = $_REQUEST['credit_token'];
        $success = $this->charge(Config::STRIPE_CHARGE_AMOUNT, $token, $message);
        unset($_REQUEST['credit_token']);
        if ($success) {
            //echo "\$" . (Config::STRIPE_CHARGE_AMOUNT / 100.0) . " charged!";
            return true;
        } else {
            return "\$" . (Config::STRIPE_CHARGE_AMOUNT / 100.0) . " charge did not go through! (token = \"" . $message . "\")";
        }
    }

    /**
     * Attempts to charge the user based on payment
     * information passed on landing page
     * @param $amount int how much to charge the user with (in cents)
     * @param $token String generated token by Stripe to use to try to charge
     * @param $message String which gets set to error message given back by Stripe in case of error
     * @return bool true if payment worked, false if payment failed
     */
    private function charge($amount, $token, &$message)
    {
        $charge = [
            "amount" => $amount,
            "currency" => Config::STRIPE_CHARGE_CURRENCY,
            "source" => $token,
            "description" => Config::STRIPE_CHARGE_DESCRIPTION
        ];
        $response = $this->getPage(Config::STRIPE_CHARGE_URL, http_build_query($charge),
            Config::STRIPE_SECRET_KEY . ":");
        $credit_info = json_decode($response, true);
        if (!empty($credit_info['message'])) {
            $message = $credit_info['message'];
        }
        return isset($credit_info['status']) && $credit_info['status'] == 'succeeded';
    }

    /**
     * Sends a curl request out to given site with specified data / password
     * @param $site String website to make curl request to
     * @param null $post_data any post data to send (if needed)
     * @param null $user_password any user password to use (if needed)
     * @return mixed response from curl request execution
     */
    private function getPage($site, $post_data = null, $user_password = null)
    {
        $agent = curl_init();
        curl_setopt($agent, CURLOPT_USERAGENT, Config::CURL_USERAGENT);
        curl_setopt($agent, CURLOPT_URL, $site);
        curl_setopt($agent, CURLOPT_AUTOREFERER, true);
        curl_setopt($agent, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($agent, CURLOPT_NOSIGNAL, true);
        curl_setopt($agent, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($agent, CURLOPT_FAILONERROR, true);
        curl_setopt($agent, CURLOPT_TIMEOUT, Config::CURL_TIMEOUT);
        curl_setopt($agent, CURLOPT_CONNECTTIMEOUT, Config::CURL_TIMEOUT);
        //make lighttpd happier
        curl_setopt($agent, CURLOPT_HTTPHEADER, ['Expect:']);
        if ($post_data != null) {
            curl_setopt($agent, CURLOPT_POST, true);
            curl_setopt($agent, CURLOPT_POSTFIELDS, $post_data);
        } else {
            curl_setopt($agent, CURLOPT_HTTPGET, true);
        }
        if($user_password != null) {
            curl_setopt($agent, CURLOPT_FAILONERROR, false);
            curl_setopt($agent, CURLOPT_USERPWD, $user_password);
            curl_setopt($agent, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($agent, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        }
        $response = curl_exec($agent);
        curl_close($agent);
        return $response;
    }
}
?>