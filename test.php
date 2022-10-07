<?php
require_once 'load-env.php';
require_once 'api/astroMethods.php';
use api\astroMethods;
$client = new astroMethods();
$client->setEngine("google.ae");
try {
    $results = $client->search(["ferrari","cars"]);
    
    $results = new ArrayIterator($results);
    $results->asort();
    
    foreach ($results as $result) {
        echo implode(',',$result) . '<br><br>';
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}




