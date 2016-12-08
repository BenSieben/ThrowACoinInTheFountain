<?php
namespace cs174\hw5\controllers;
use cs174\hw5\configs\Config;
use cs174\hw5\models\FountainImageModel;
use cs174\hw5\views\PDFView;

/**
 * Class PDFController
 * @package cs174\hw5\controllers
 *
 * Controller which helps set up
 * view for viewing PDFs created
 * by users
 */
class PDFController extends Controller {

    /**
     * Sets up, then renders the PDF view
     * (if given a valid filename)
     */
    public function setUpView() {
        if(isset($_REQUEST['f']) && is_string($_REQUEST['f'])) {
            // check for valid f (filename)
            $fim = new FountainImageModel();
            if($fim->permanentFountainExists($_REQUEST['f'])) {
                // the filename is good so set up the PDF for rendering
                $pdfv = new PDFView();
                $data = $this->setUpData();
                $pdfv->render($data);
            }
            else {
                // the filename is bad (send user back to landing page)
                $_SESSION['errmsg'] = gettext("Error! Specified fountain name was invalid!");
                header("Location: " . Config::BASE_URL . "?c=landing");
            }
        }
        else {
            // if filename is not set, send user back to landing page with error message
            $_SESSION['errmsg'] = gettext("Error! No fountain specified for wish PDF!");
            header("Location: " . Config::BASE_URL . "?c=landing");
        }
    }

    /**
     * Sets up data based on things like $_REQUEST variables
     * for the PDF view to use
     * @return array String array of data to be used
     * in the PDF view
     */
    private function setUpData() {
        // add some image data for the PDFView to use
        $data = [];
        $data['fountain-image'] = Config::FOUNTAIN_PERMANENT_IMAGE_FOLDER . $_REQUEST['f'] . '.png';
        $data['logo-image'] = Config::LOGO_IMAGE_FULL_PATH;
        $data['thanks-for-wish-text'] = 'Thanks for your wish!';
        return $data;
    }

}
?>