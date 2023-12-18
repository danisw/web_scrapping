<?php
require 'vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

$client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));

$crawler = $client->request('GET','https://sidata-ptn-snpmb.bppp.kemdikbud.go.id/ptn_sb.php?ptn=382&prodi=382001&jenis=0');

//$html = file_get_contents('https://sidata-ptn-snpmb.bppp.kemdikbud.go.id/ptn_sb.php?ptn=382&prodi=382001&jenis=0');
//echo $html;

//echo $crawler->filterXPath('//title')->text();
$judul = $crawler->filter('.panel-title > b')->text(); //ekstrak nama halaman yg merupakan prodi
echo $judul;
$GLOBALS['arr_td']= array($judul);

/**$crawler->filter('table')->each(function($node) {
    print_r($node->text());
    exit();
  });
  **/
 //$arr_td = array($judul); //array menampung td 
 $crawler->filter('tr')->each(function($node) {
    $node->filter('td')->each(function($nested_node) {
        $text = $nested_node->text();
        
        //echo $text ."\n";
      if(strlen($text) < 1){
        $text_cek = "\n kosong";
      }else{
        $text_cek = "\n".$nested_node->text();
      }
      //echo $text_cek;
      array_push($GLOBALS['arr_td'], $text_cek);
      
     });
     
    //$node->filter('th')->each(function($nested_node_2){
    //    echo $nested_node_2->text() ."\n";
    //});
  });

var_dump($arr_td);
// polanya tetep, ambil dulu id daya tampung trs idnya ditambah 4 untuk ambil child array daya tampung, masukin array baru
//gitu juga sama peminat berdasarkan SMTA, ambil id arraynya tambahin 4 
//baru id array ini di loop diambil jd array baru trs di stored ke db

//$file = fopen("data_ltmpt.csv","a");
/**$crawler->filter('table tr')->each(function ($node) use ($file) {
    $title = $node->filter('thead > tr')->attr('th');
    //$price = $node->filter('.price_color')->text();
    //echo $title.'='.$price.PHP_EOL;
    fputcsv($file, [$title]);
});
fclose($file);
**/