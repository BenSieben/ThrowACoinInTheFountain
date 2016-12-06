<?php
namespace cs174\hw5\views\elements;

/**
 * Class FountainImage
 * @package cs174\hw5\elements
 *
 * Element which uses PHP to draw a fountain
 * image and then places HTML code that
 * uses the fountain image as its source
 */
class FountainImage extends Element{

    /**
     * Generates a fountain image
     * @param Array $data customizations to use on the fountain
     * @return String HTML code to render the generated fountain image
     */
    public function render($data) {
        // Trying a simple fountain image
        // TODO make the fountain, instead of captcha text
        $md5 = md5(microtime() * mktime());

        $captcha_string = substr($md5,0,5);

        $fountain_img = imagecreatetruecolor(500, 500);

        $fountain_color = imagecolorallocate($fountain_img, 233, 239, 239);

        imagefilledellipse($fountain_img, 250, 250, 100, 50, $fountain_color);

        // get a output as png into a string, 100=not-lossy
        ob_start();
        imagepng($fountain_img, "./src/resources/fountain.png", 100);

        imagedestroy($fountain_img);

        return '    <img src="./src/resources/fountain.png" alt="fountain" style="position:relative; top:15px;" />';
    }
}
?>