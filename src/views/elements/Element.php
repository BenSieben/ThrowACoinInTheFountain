<?php
namespace cs174\hw5\views\elements;

/**
 * Class Element
 * @package cs174\hw5\elements
 *
 * Base class for Element, which represents
 * a re-usable part of the view
 */
abstract class Element {

    /**
     * Renders the element
     * @param $data Array of data to read in to change how the element draws
     * @return String HTML code of the rendering
     */
    public abstract function render($data);
}
?>