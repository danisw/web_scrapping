<?php

// membuat array
$barang = ["Buku Tulis", "Penghapus", "Spidol"];

// menampilkan isi array dengan perulangan foreach
foreach($barang as $array){
    echo $array."\n";
}

/**$ulangi = 0;

while($ulangi < 3){
    echo "Ini adalah perulangan ke-".$ulangi."\n";
    $ulangi++;
}
**/



/*
$books = [
    "Panduan Belajar PHP untuk Pemula",
    "Membangun Aplikasi Web dengan PHP",
    "Tutorial PHP dan MySQL",
    "Membuat Chat Bot dengan PHP"
];

foreach($books as $data){
    echo $data."\n";
}

**/
/**$perasaanku = "Cinta";

$hasil = ($perasaanku == "Cinta") ?  "Ajak Nikah" : "Tinggalkan";

print $hasil;
**/

/*
$nilai_angga = 70;
switch($nilai_angga){
    case ($nilai_angga >= 90) :
        echo "Baik";
        break;
    case ($nilai_angga >= 60) && ($nilai_angga <= 70):
        echo "Hampir Baik";
        break;
    default:
        echo "Tidak Diketahui";
        break;
}
**/

/**if($nilai_angga >= 90){
    $predikat = "baik";
}else{
    $predikat = "Hampir Baik";
}
echo $predikat;
**/
?>