# PHP-SE-CRAWLER
 PHP-SE-CRAWLER
==========================



PHP-SE-CRAWLER is php crawler tool for the search engine such as google,bing give you the ability to get output for title description link and ranking 

Install
-------

Install the latest version using composer or the preferable to clone the repo or download the lastet release and.
```bash
$ composer install
```

```bash
$ composer require ali.rmaity/php-se-crawler -- not stable
```

This package can be found on [packagist] and is best loaded using [composer](http://getcomposer.org/). We support php 7.2, 7.3, and 7.4.

Basic Usage
-----
```php
// Assuming you installed from  github repo 
require_once '../load-env.php';
require_once '../src/astroMethods.php';
use src\astroMethods;
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


