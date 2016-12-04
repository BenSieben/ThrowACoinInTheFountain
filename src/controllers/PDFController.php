<?php
namespace cs174\hw5\controllers;
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
     */
    public function setUpView() {
        $pdfv = new PDFView();
        $data = $this->setUpData();
        $pdfv->render($data);
    }

    /**
     * Sets up data based on things like $_REQUEST variables
     * for the PDF view to use
     * @return array String array of data to be used
     * in the PDF view
     */
    private function setUpData() {
        // TODO actually make data
        $data = [];
        return $data;
    }

}
?>