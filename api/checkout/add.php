<?php 

header("Content-Type: application/json; charset=UTF-8");
include_once "../handler.php";

// menggabungkan kode dari file kota.php
// yg mana model kota dibutuhkan
// untuk query
include("../../model/checkout.php");

// menggabungkan kode dari file db.php
// yg mana db digunakan untuk memanggil koneksi
// ke database
include("../../model/db.php");

// menggabungkan kode dari file generator.php
// yg mana db digunakan untuk memanggil fungsi
// utilisasi
include("../../util/generator.php");

// fungsi yg akan dipanggil untuk
// menghandle request yg dikirim client
$data = handle_request();

$usr = new checkout();
$usr->set($data);
$ref_id = generate_random_string(10);
$result = $usr->add(get_connection(include("../config.php")),$ref_id);

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>