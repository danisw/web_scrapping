<?php
require 'vendor/autoload.php';

use Goutte\Client;

$client = new Client();

$crawler = $client->request('GET','https://www.tokopedia.com/barekleathergoods/');

//$html = file_get_contents('https://books.toscrape.com/');
//echo $html;

//echo $crawler->filterXPath('//title')->text();

global $data;
$file = fopen("data_tokped.csv","a");
$crawler->filter('.css-1asz3by')->each(function ($node) use ($file) {
    $title = $node->filter('.pcv3__info-content.css-gwkf0u')->attr('title');
    $price = $node->filter('.prd_link-product-price.css-h66vau')->text();
    //$availability = $node->filter('.instock.availability')->text();
    
    echo $title.' = '.$price.PHP_EOL;
    //fputcsv($file, [$title, $price]);
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