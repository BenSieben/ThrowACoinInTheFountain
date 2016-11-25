<?php
namespace cs174\hw5;

// Require Composer's autoload file (to autoload classes)
require_once("vendor/autoload.php");

/**
 * All links for tbe Throw-a-Coin-in-the-Fountain
 * go through this index.php
 */

$controller = new \cs174\hw5\controllers\Controller();
$controller->processForms();

?>