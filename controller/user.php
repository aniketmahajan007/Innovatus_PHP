<?php
if (!isset($_GET['requesting']) OR $_GET['requesting'] < 1 OR $_GET['requesting'] > 2) {
    header('Status: 400');
    exit();
}
header("Content-Type: application/json");
switch ((int)$_GET['requesting']) {
    case 1:
        require('../model/testimonial.php');
        break;
    case 2:
        require('../model/testimonial_list.php');
        break;
    default:
        header('Status: 400');
        break;
}
