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
        if(!is_array($data)) {
            $data = [];
        }

        $fountain_img = imagecreatetruecolor(500, 500);

        // Set up colors to use (based on $data)
        $fountain_color = imagecolorallocate($fountain_img, 255, 255, 255);  // white fountain by default
        if(isset($data['fountain_color']) && is_string($data['fountain_color']) && strcmp($data['fountain_color'], 'gray') === 0) {
            $fountain_color = imagecolorallocate($fountain_img, 200, 200, 200); // change fountain to gray
        }

        $band_color = imagecolorallocate($fountain_img, 226, 0, 0);  // red band by default
        if(isset($data['band_color']) && is_string($data['band_color']) && strcmp($data['band_color'], 'yellow') === 0) {
            $band_color = imagecolorallocate($fountain_img, 237, 237, 59); // change band to yellow
        }

        $water_color = imagecolorallocate($fountain_img, 0, 200, 226);  // blue water by default
        if(isset($data['water_color']) && is_string($data['band_color']) && strcmp($data['band_color'], 'yellow') === 0) {
            $water_color = imagecolorallocate($fountain_img, 8, 221, 165); // change band to turquoise
        }

        $text_color = imagecolorallocate($fountain_img, 255, 212, 174);
        $wish = "A wish for ";
        if(isset($data['wisher']) && is_string($data['wisher']) && strcmp(trim($data['wisher']), '') !== 0) {
            $wish .= trim($data['wisher']) . "!";
        }
        else {
            $wish .= "you!";
        }

        // Now draw the actual fountain
        // base of fountain
        imagefilledrectangle($fountain_img, 200, 225, 300, 375, $fountain_color);
        imagefilledrectangle($fountain_img, 210, 235, 290, 365, $band_color);
        imagefilledrectangle($fountain_img, 220, 245, 280, 355, $fountain_color);
        // middle of fountain
        imagefilledellipse($fountain_img, 250, 175, 200, 200, $fountain_color);
        imagefilledellipse($fountain_img, 250, 175, 180, 180, $band_color);
        imagefilledellipse($fountain_img, 250, 175, 160, 160, $fountain_color);
        // top of fountain
        imagefilledellipse($fountain_img, 250, 125, 300, 200, $fountain_color);
        imagefilledellipse($fountain_img, 250, 125, 275, 180, $band_color);
        imagefilledellipse($fountain_img, 250, 125, 250, 160, $fountain_color);
        imagefilledellipse($fountain_img, 250, 125, 240, 150, $water_color);
        imagestring($fountain_img, 5, 10, 480, $wish, $text_color);

        // get a output as png into a string, 0=not-lossy
        ob_start();
        imagepng($fountain_img, "./src/resources/fountain.png", 0);

        imagedestroy($fountain_img);

        return '    <img src="./src/resources/fountain.png" alt="fountain" style="position:relative; top:15px;" />';
    }
}
?>