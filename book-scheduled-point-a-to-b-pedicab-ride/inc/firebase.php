<?php
require __DIR__.'../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'../path/to/serviceAccountKey.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://pedalcappp-default-rtdb.firebaseio.com')
    ->create();

$database = $firebase->getDatabase();
