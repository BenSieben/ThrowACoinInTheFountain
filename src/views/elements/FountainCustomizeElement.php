<?php
namespace cs174\hw5\views\elements;
use cs174\hw5\views\helpers\SelectHelper;

/**
 * Class FountainCustomizeElement
 * @package cs174\hw5\views\elements
 *
 * Element which draws a select tag with options
 * based on input data (also a label for the select tag)
 * in a paragraph tag
 */
class FountainCustomizeElement extends Element{

    // fields for which indexes in data to look for data to make options for
    //   and which option should be the default
    private $options;
    private $default_option;

    // fields for what to put as select tag's name and ID, and what
    //   text to use to label the select tag
    private $select_name;
    private $select_text;

    /**
     * Constructs a new FountainCustomizeElement
     * @param $options String index in $data to find array of options to render
     * @param $default_option String index in $data to find default option
     * @param $select_name String the name / id to give to the select tag
     * @param $select_text String the text to place as a label for the select tag
     */
    public function __construct($options, $default_option, $select_name, $select_text) {
        $this->options = $options;
        $this->default_option = $default_option;
        $this->select_name = $select_name;
        $this->select_text = $select_text;
    }

    /**
     * Renders a HTML select tag for given data
     * @param Array $data names to give to select, options to
     * list, and default option
     * @return String HTML code for rendering the various selects
     */
    public function render($data) {
        $html = "        <p><label for=\"" . $this->select_name . "\">" . $this->select_text . "</label>\n";
        $html .= "            <select name=\"" . $this->select_name . "\" id=\"" . $this->select_name . "\">\n";
        // use a SelectHelper to loop through options and print out their information
        $sh = new SelectHelper();
        $sh_data = [];
        $sh_data['options'] = $data[$this->options];
        $sh_data['selected'] = $data[$this->default_option];
        $html .= $sh->render($sh_data);
        $html .= "            </select>\n        </p>\n";
        return $html;
    }

}
?>