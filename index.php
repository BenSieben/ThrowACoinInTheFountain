<?php
namespace cs174\hw5;

// Require Composer's autoload file (to autoload classes)
require_once("vendor/autoload.php");

// start a new session for the user
session_start();

/**
 * All links for tbe Throw-a-Coin-in-the-Fountain
 * go through this index.php
 */

$controller = new \cs174\hw5\controllers\Controller();
$controller->processForms();

// end the session for the user (if uncommented) - useful for some debugging purposes
session_destroy();
?>