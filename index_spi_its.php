<?php
require 'vendor/autoload.php';

use Goutte\Client;

$client = new Client();

$crawler = $client->request('GET','https://www.its.ac.id/admission/sarjana/sm/#biaya-pendidikan');

//$html = file_get_contents('https://books.toscrape.com/');
//echo $html;

//echo $crawler->filterXPath('//title')->text();

global $data;
$file = fopen("data_spi_its.csv","a");
$data = $crawler->filter('div.table-responsive')->each(function ($node) use ($file) {

    $arr_data = $node->filter('table')->filter('tr')->each(function ($tr, $i) {
        return $tr->filter('td')->each(function ($td, $i) {
            return trim($td->text());
        });
    });
    //var_dump($arr_data);
    return $arr_data;
});


//hilangkan data/array yang null/kosong
foreach($data as $dt){
    $filtered_data = array_filter($dt);
    //var_dump($filtered_data);
}

//var_dump($filtered_data);

//tambahkan judul
$title = ["Fakultas","Jurusan","spi","spa_2","spa_3","spa_3","spa_4","spa_5","spa_6"];
    array_unshift($filtered_data, $title);
//var_dump($filtered_data);


//ambil nilai tiap array
$file = fopen("data_spi.csv","a");

foreach($filtered_data as $data2){
    //var_dump($data2); 
        // kalo 7 pake departemen, kalo 8 pake fakultas juga
        if( count($data2) == 7 ){
            $fakultas  = 'x';
            $prodi  = $data2[0];
            $spi  = $data2[1];
            $spa_2  = $data2[2];
            $spa_3  = $data2[3];
            $spa_4  = $data2[4];
            $spa_5  = $data2[5];
            $spa_6 = $data2[6];
            fputcsv($file, [$fakultas, $prodi, $spi, $spa_2, $spa_3, $spa_4, $spa_5, $spa_6]);
    
        }else if (count($data2) == 8){
            
            $fakultas  = $data2[0];
            $prodi  = $data2[1];
            $spi  = $data2[2];
            $spa_2  = $data2[3];
            $spa_3  = $data2[4];
            $spa_4  = $data2[5];
            $spa_5  = $data2[6];
            $spa_6 = $data2[7];
            fputcsv($file, [$fakultas, $prodi, $spi, $spa_2, $spa_3, $spa_4, $spa_5, $spa_6]);
        }
        
}
    
    //ke Csv
    //var_dump ($data2);
    //fputcsv($file, [$fakultas, $prodi, $spi, $spa_2, $spa_3, $spa_4, $spa_5, $spa_6]);

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