<?php
require 'vendor/autoload.php';

use Goutte\Client;

$client = new Client();

$crawler = $client->request('GET','https://www.its.ac.id/admission/sarjana/sm/#biaya-pendidikan');

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
    
// tugasnya menambahkan judul untuk tiap kolom di csv nya