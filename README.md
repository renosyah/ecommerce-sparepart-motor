# Ecommerce Sparepart Motor (CORE API)

## Kebutuhan

- PHP 7
- MysqlDB or MariaDB


<br>
<br>


## Konfigurasi Database

- buka cmd lalu buka mysql console

```

c:\xampp\mysql\bin\mysql -u root -p

```

- buat database ecommerce_db;

```

create database ecommerce_db;
use ecommerce_db;

```

- copy dan paste isi file di \sql\schema.sql ke console

<br>
<br>

## Konfiguras PHP

- buka file api/config.php dan sesuaikan isinya dengan konfigurasi anda sendiri

```

<?php

return array(
    'host' => 'localhost',
    'port' => '3306',
    'name' => 'ecommerce_db',
    'username' => 'root',
    'password' => '',
);

?>

```

<br>
<br>

## Cara Menjalankan

- buka cmd di direktori ini lalu ketik

```

    php -S {YOUR_IP}:80

```

atau

```

    php -S localhost:80

```