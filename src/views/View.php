<?php
namespace cs174\hw5\views;

/**
 * Class View
 * @package cs174\hw5\views
 *
 * Abstract superclass for any class
 * used as the View for the Throw-a-Coin-in-the-Fountain
 * website
 */
abstract class View {

    /**
     * Should render a HTML page, taking into account $data to
     * fill in certain parts of the web page
     * @param $data Array<String> data to show on the web page
     */
    public abstract function render($data);
}
?>