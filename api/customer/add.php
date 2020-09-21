<?php 

header("Content-Type: application/json; charset=UTF-8");
include_once "../handler.php";

// menggabungkan kode dari file kota.php
// yg mana model kota dibutuhkan
// untuk query
include("../../model/customer.php");

// menggabungkan kode dari file db.php
// yg mana db digunakan untuk memanggil koneksi
// ke database
include("../../model/db.php");


// fungsi yg akan dipanggil untuk
// menghandle request yg dikirim client
$data = handle_request();

$usr = new customer();
$usr->set($data);
$result = $usr->one_by_email(get_connection(include("../config.php")));
if ($result->data != null){
    $result->data = null;
    $result->error = "email already exist!";
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}

$result = $usr->add(get_connection(include("../config.php")));
if ($result->data != "ok"){
    $result->data = null;
    $result->error = "failed add to db!";
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}

$return_result = $usr->one_by_email(get_connection(include("../config.php")));
 
echo json_encode($return_result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>