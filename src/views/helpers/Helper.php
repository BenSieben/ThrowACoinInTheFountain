<?php
namespace cs174\hw5\views\helpers;

/**
 * Class Helper
 * @package cs174\hw5\helpers
 *
 * Helpers can be used in Views for
 * looping through some data to output
 * in HTML
 */
abstract class Helper {

    /**
     * Renders the helper
     * @param $data Array of data to read in to change how the helper draws
     * @return String HTML code of whatever data is supposed to be output
     */
    public abstract function render($data);
}
?>