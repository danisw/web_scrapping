<?php
require 'vendor/autoload.php';

use Goutte\Client;

$client = new Client();

$crawler = $client->request('GET','https://books.toscrape.com/');

//$html = file_get_contents('https://books.toscrape.com/');
//echo $html;

//echo $crawler->filterXPath('//title')->text();

global $data;
$file = fopen("data.csv","a");
$crawler->filter('.product_pod')->each(function ($node) use ($file) {
    $title = $node->filter('h3 > a')->attr('title');
    $price = $node->filter('.price_color')->text();
    $availability = $node->filter('.instock.availability')->text();
    
    echo $title.' = '.$price.' = '.$availability.PHP_EOL;
    fputcsv($file, [$title, $price, $availability]);
});

/*
//Koneksi ke mySQL
$servername = "localhost";
$username = "user";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
**/

//Insert data ke mySQL
/**$row = 1;
if (($handle = fopen("data.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo " $num fields in line $row: \n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "\n";
        }
    }
    fclose($handle);
    
}
**/