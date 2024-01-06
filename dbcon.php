<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('phpmyadminbics-sel-firebase-adminsdk-ga17m-77e37fbee1.json')
    ->withDatabaseUri('https://phpmyadminbics-sel-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();
?>