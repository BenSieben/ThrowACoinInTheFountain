<?php
namespace cs174\hw5\views\helpers;

/**
 * Class SelectHelper
 * @package cs174\hw5\views\helpers
 *
 * Iterates through given data
 * and can also select a specific option
 * to generate a collection of HTML option tags
 */
class SelectHelper extends Helper {

    /**
     * Generates a HTML select tag
     * @param Array $data should contain indexes:
     *          ['options'] = array of options to render
     *          ['selected'] = which option to select
     * @return String HTML code for select tag
     */
    public function render($data) {
        if(!isset($data) || !is_array($data) ||
            !isset($data['options']) || !is_array($data['options']) ||
            !isset($data['selected']) || !is_string($data['selected'])) {
            return '';  // give back empty string if not given good $data
        }
        $html = "";
        foreach($data['options'] as $option) {
            if(strcmp($option, $data['selected']) === 0) {  // mark this option as selected
                $html .= "                <option value=\"$option\" selected=\"selected\">$option</option>\n";
            }
            else {  // make this a non-selected (regular) option
                $html .= "                <option value=\"$option\">$option</option>\n";
            }
        }
        return $html;
    }

}
?>