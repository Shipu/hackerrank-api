# HackerRank API
[![Latest Stable Version](https://poser.pugx.org/shipu/hackerrank-api/v/stable)](https://packagist.org/packages/shipu/hackerrank-api)
[![Latest Unstable Version](https://poser.pugx.org/shipu/hackerrank-api/v/unstable)](https://packagist.org/packages/shipu/hackerrank-api)
[![License](https://poser.pugx.org/shipu/hackerrank-api/license)](https://packagist.org/packages/shipu/hackerrank-api)

HackerRank Code Checker API. Extremely simple REST API. Supports more than a dozen languages. All powered by reliable HackerRank servers. You can use your own scoring system or build your own online judge. 

40+ programming languages support.

## Installation

Themevel is a Laravel package so you can install it via Composer. Run this command in your terminal from your project directory:

```sh
composer require shipu/hackerrank-api
```

Wait for a while, Composer will automatically install Themevel in your project.

## Laravel Configuration

When the download is complete, you have to call this package service in `config/app.php` config file. To do that, add this line in `app.php` in `providers` array:

```php
Shipu\HackerRank\HackerRankServiceProvider::class,
```

To use facade you have to add this line in `app.php` to the `aliases` array:

```php
'HackerRank' => Shipu\HackerRank\Facades\HackerRank::class,
```

Now run this command in your terminal to publish this package resources:

```
php artisan vendor:publish --provider="Shipu\HackerRank\HackerRankServiceProvider"
```

after publishing your config file then open `config/hackerrank.php` and add your hackerrank app key:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | HackerRank API KEY
    |--------------------------------------------------------------------------
    |
    | https://www.hackerrank.com/api/
    |
    */

    'api_key' => env('HACKERRANK_API_KEY', 'YOUR_HACKER_RANK_API_KEY'),
];
```

also you can add api key in `.env` :
```
 HACKERRANK_API_KEY = YOUR_HACKER_RANK_API_KEY
```

Thats it.

## API List

- languages()
- submission($lang, $source, $testcases = [ "1" ], $format = 'json', $wait = true, $callback_url = '')

## Usages

```php
use Shipu\HackerRank\HackerRank;

$config = [
            "api_key"     => 'hackerrank_app_key',
        ];
        
 
 $hackerRank = new HackerRank($config);
 
 $allLanguages = $hackerRank->checker()->languages();
 
 var_dump($allLanguages->data);
 ```


## For Laravel Usage
 
 ```php
 use Shipu\HackerRank\Facades\HackerRank;
 //..
 //..
 $allLanguages = HackerRank::checker()->languages();
 
 dd($allLanguages->data);
 ```
 
 ### Code Submission
 
 ```php
 use Shipu\HackerRank\Facades\HackerRank;
 //..
 //..
$response = HackerRank::checker()->submission('php', '<?php echo "It's Working"; ?>');

dd($response->data);
 ```
 
 ### Code Submission with TestCase

  ```php
  use Shipu\HackerRank\Facades\HackerRank;
  //..
  //..
  // Problem is returns the sum of two integers.
  // Problem link: https://www.hackerrank.com/challenges/solve-me-first
  // Submit code with two tescase example.
  
 $response = HackerRank::checker()->submission('php', '<?php
                 function solveMeFirst($a,$b){
                   return $a+$b;
                 }
                 $handle = fopen ("php://stdin","r");
                 $_a = fgets($handle);
                 $_b = fgets($handle);
                 $sum = solveMeFirst((int)$_a,(int)$_b);
                 print ($sum);
                 fclose($handle);
             ?>', 
             ["1\n2", "2\n3"]);
 
 // output array respectively as test cases
 dd($response->data->result->stdout);
  ```



## Support on Beerpay
Hey dude! Help me out for a couple of :beers:!

[![Beerpay](https://beerpay.io/Shipu/hackerrank-api/badge.svg?style=beer-square)](https://beerpay.io/Shipu/hackerrank-api)  [![Beerpay](https://beerpay.io/Shipu/hackerrank-api/make-wish.svg?style=flat-square)](https://beerpay.io/Shipu/hackerrank-api?focus=wish)