<?php
require_once(__DIR__ . '/../bootstrap.php');

use App\Controllers\AuthController;

$authController = new AuthController();
$result = $authController->logout();

if ($result['success']) {
    redirect('../html/sign-in.php');
}
?>
