<?php
require 'vendor/autoload.php';

use PHPsecretroom\SecretRoom;

$responses = [
    'test' => 'ok',
];

$requestHandler = new SecretRoom($responses);
$requestHandler->handleRequest();
?>
