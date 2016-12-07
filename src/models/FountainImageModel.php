<?php
namespace cs174\hw5\models;
use cs174\hw5\configs\Config;

/**
 * Class FountainImageModel
 * @package cs174\hw5\models
 *
 * The FountainImageModel creates
 * temporary fountains for users to
 * see their customizations, permanent
 * fountains for when the user pays
 * to create a PDF, and can retrieve
 * these permanently stored fountains
 */
class FountainImageModel extends Model {

    /**
     * Generates the temporary fountain image for the landing page
     * when the user is customizing their fountain
     * @param Array $data customizations to use on the fountain
     * @return boolean true on successful image creation, false otherwise
     */
    public function createTemporaryFountain($data) {
        return $this->createFountain($data, Config::FOUNTAIN_TEMPORARY_IMAGE_FOLDER, Config::FOUNTAIN_TEMPORARY_IMAGE_FILENAME);
    }

    /**
     * Generates a permanent fountain image for the wish PDF for
     * when the user has purchased a PDF
     * @param Array $data customizations to use on the fountain
     * @return boolean true on successful image creation, false otherwise
     */
    public function createPermanentFountain($data) {
        $filename = $this->generatePermanentFountainFilename($data);
        if(strcmp($filename, '') !== 0) {  // if a filename was generated, return result of creating the permanent fountain
            return $this->createFountain($data, Config::FOUNTAIN_PERMANENT_IMAGE_FOLDER, $filename . '.png'); // add .png to file name
        }
        return false;
    }

    /**
     * Generates a permanent fountain file name based
     * on given $data
     * @param $data Array of data information to pull fountain
     *      customization details from (these are used to generate file name)
     * @return string the filename to give to the given fountain, or else empty string if bad data is used
     */
    public function generatePermanentFountainFilename($data) {
        if(isset($data['fountain-color']) && is_string($data['fountain-color']) && strcmp($data['fountain-color'], '') !== 0 &&
            isset($data['fountain-band-color']) && is_string($data['fountain-band-color']) && strcmp($data['fountain-band-color'], '') !== 0 &&
            isset($data['fountain-water-color']) && is_string($data['fountain-water-color']) && strcmp($data['fountain-water-color'], '') !== 0) {
            // make sure the required customizations are specified
            //  if $data is properly configured, use md5 hash of a combination of all these
            //   properties (+ name if name is specified) to generate an identifying filename
            $filename = '';
            if(isset($data['name']) && is_string($data['name']) && strcmp($data['name'], '') !== 0) {
                $filename = md5($data['fountain-color'] . $data['fountain-band-color'] .
                    $data['fountain-water-color'] . $data['name']);
            }
            else {
                $filename = md5($data['fountain-color'] . $data['fountain-band-color'] .
                    $data['fountain-water-color']);
            }
            return $filename;
        }
        return '';
    }

    /**
     * Draws a new fountain and saves the fountain at a specific location
     * @param $data Array of customization data for the fountain
     * @param $location String path to use when saving the image
     * @param $filename String name to use as filename of fountain image
     * @return boolean true on successful image creation; false otherwise
     */
    private function createFountain($data, $location, $filename) {
        if(!is_array($data)) {
            $data = [];
        }

        // create a 500px x 500px image to draw on
        $fountain_img = imagecreatetruecolor(500, 500);

        // Set up colors to use (based on $data)
        $fountain_color = imagecolorallocate($fountain_img, 255, 255, 255);  // white fountain by default
        if(isset($data['fountain-color']) && is_string($data['fountain-color']) &&
            strcmp($data['fountain-color'], 'Gray') === 0) {
            $fountain_color = imagecolorallocate($fountain_img, 200, 200, 200); // change fountain to gray
        }

        $band_color = imagecolorallocate($fountain_img, 226, 0, 0);  // red band by default
        if(isset($data['fountain-band-color']) && is_string($data['fountain-band-color']) &&
            strcmp($data['fountain-band-color'], 'Yellow') === 0) {
            $band_color = imagecolorallocate($fountain_img, 237, 237, 59); // change band to yellow
        }

        $water_color = imagecolorallocate($fountain_img, 0, 200, 226);  // blue water by default
        if(isset($data['fountain-water-color']) && is_string($data['fountain-water-color']) &&
            strcmp($data['fountain-water-color'], 'Turquoise') === 0) {
            $water_color = imagecolorallocate($fountain_img, 8, 221, 165); // change water to turquoise
        }

        $text_color = imagecolorallocate($fountain_img, 255, 212, 174);
        $wish = "A wish fountain for ";
        if(isset($data['name']) && is_string($data['name']) && strcmp(trim($data['name']), '') !== 0) {
            $wish .= trim($data['name']) . "!";
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
        // only save the image when given a valid directory and file name
        if(is_dir($location)) {
            // check that the file name is considered valid (we assume .png extension)
            if($this->isGoodFileName($filename, '.png')) {
                imagepng($fountain_img, $location . $filename, 0);
                imagedestroy($fountain_img);
                return true;
            }
        }
        // if not given valid directory or filename, do not save file and return false
        imagedestroy($fountain_img);
        return false;
    }

    /**
     * Determines if the given filename and file extension create a
     * "valid" file name (here we only allow alphanumeric characters and .-_ characters)
     * @param $filename String name of the file (the FULL name, which includes extension
     * @param $file_extension String extension to check filename against
     * @return bool true if filename is valid and matches file extension; false otherwise
     */
    private function isGoodFileName($filename, $file_extension) {
        // in this function, we choose to determine that a valid filename ends in ".png"
        //   and only contains alphanumeric characters and some special characters like .-_
        if(strrpos($filename, $file_extension) === strlen($filename) - strlen($file_extension)) {
            $filtered_filename = preg_replace("/[^a-zA-Z0-9-_\.]/", '', $filename);
            if(strcmp($filename, $filtered_filename) === 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if a given permanent fountain exists or not, by giving a filename to look for
     * @param $filename String filename of the permanent fountain image to search for
     * @return true if the file exists; false otherwise
     */
    public function permanentFountainExists($filename) {
        // use the Config's permanent fountain directory and the filename
        //   to verify if the given permanent fountain exists or not
        return is_file(Config::FOUNTAIN_PERMANENT_IMAGE_FOLDER . $filename . '.png');
    }

}
?>