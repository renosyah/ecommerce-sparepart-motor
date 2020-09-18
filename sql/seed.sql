-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2020 at 03:31 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14896738_demo_db`
--

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customer_id`, `product_id`, `quantity`, `price`, `sub_total`) VALUES(2, 1, 13, 1, 2500000, 2500000);
INSERT INTO `cart` (`id`, `customer_id`, `product_id`, `quantity`, `price`, `sub_total`) VALUES(3, 1, 12, 1, 3000000, 3000000);
INSERT INTO `cart` (`id`, `customer_id`, `product_id`, `quantity`, `price`, `sub_total`) VALUES(4, 1, 22, 1, 150000, 150000);
INSERT INTO `cart` (`id`, `customer_id`, `product_id`, `quantity`, `price`, `sub_total`) VALUES(5, 1, 24, 1, 180000, 180000);

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image_url`) VALUES(1, 'Tanki Bensin', 'http://app-demo-api.000webhostapp.com/img/category/gas.png');
INSERT INTO `category` (`id`, `name`, `image_url`) VALUES(2, 'Lampu', 'http://app-demo-api.000webhostapp.com/img/category/lamp.png');
INSERT INTO `category` (`id`, `name`, `image_url`) VALUES(3, 'Slebor', 'http://app-demo-api.000webhostapp.com/img/category/ride.png');
INSERT INTO `category` (`id`, `name`, `image_url`) VALUES(4, 'Suspensi', 'http://app-demo-api.000webhostapp.com/img/category/suspension.png');
INSERT INTO `category` (`id`, `name`, `image_url`) VALUES(5, 'Roda', 'http://app-demo-api.000webhostapp.com/img/category/tire.png');
INSERT INTO `category` (`id`, `name`, `image_url`) VALUES(6, 'Jock', 'http://app-demo-api.000webhostapp.com/img/category/ride.png');

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `username`, `email`, `password`) VALUES(1, 'ipul', 'ipul', 'ipul@gmail.com', '123');
INSERT INTO `customer` (`id`, `name`, `username`, `email`, `password`) VALUES(2, 'ipul 2', 'ipul 2', 'ipul@gmail.com', '123');

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(1, 1, 'tengki cb K2', 2000000, 'http://app-demo-api.000webhostapp.com/img/product/qczpW5g384.jpeg', 10, 5, 'tengki cb k2 kondisi kaleng, ori second layak pakai no minus ');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(2, 1, 'tengki cb glatik', 2500000, 'http://app-demo-api.000webhostapp.com/img/product/zpK0eDKXYm.jpeg', 10, 5, 'tengki cb glatik kondisi  bagus, repaint, ori second');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(3, 1, 'tengki cb k1', 3000000, 'http://app-demo-api.000webhostapp.com/img/product/JK8Lq6MZbh.jpeg', 10, 5, 'tengki cb k1, kondisi ori second repaint');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(4, 1, 'tegki cb k3', 2000000, 'http://app-demo-api.000webhostapp.com/img/product/VnGeqwXlag.jpeg', 10, 5, 'tengki cb k3, kondisi ori second repaint');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(5, 1, 'tengki kudus', 900000, 'http://app-demo-api.000webhostapp.com/img/product/ManJD233ZX.png', 10, 5, 'tengki kudusan, ori baru repro');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(6, 3, 'slebor blk cb 125 s.e', 5000000, 'http://app-demo-api.000webhostapp.com/img/product/IUMhxZmnbK.jpeg', 10, 5, 'slebor blk cb 125 s.e, kondisi ori second masih bagus tidak keropos.  set stop lamp belakang dan riting kanan kiri');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(7, 3, 'slebor belakang cb 100', 3000000, 'http://app-demo-api.000webhostapp.com/img/product/SkAiA2g7Hf.jpeg', 10, 5, 'slebor belakang cb 100. Kondisi masih sangat bagus,ori second');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(8, 3, 'slebor belakang trestar 518', 700000, 'http://app-demo-api.000webhostapp.com/img/product/SkAiA2g7Hf.jpeg', 10, 5, 'slebor belakang trestar 518, kodisi bagus masih utuh, ori repro');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(9, 3, 'slebor belakang trestar 518', 1500000, 'http://app-demo-api.000webhostapp.com/img/product/2qntoscHCP.jpeg', 10, 5, 'slebor belakang import. Kondisi bagus. Drat baut masih utuh,tidak keropos, ori import');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(10, 3, 'slebor belakang cb 125', 4000000, 'http://app-demo-api.000webhostapp.com/img/product/zBIgmSgSy8.jpeg', 10, 5, 'slebor belakang cb 125, kondisi ori second, layak pakai');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(11, 2, 'batok lampu L2G', 500000, 'http://app-demo-api.000webhostapp.com/img/product/bHcP0nPEwW.jpeg', 10, 5, 'batok lampu L2G kaleng, kondisi baru repro');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(12, 2, 'batok lampu YL', 3000000, 'http://app-demo-api.000webhostapp.com/img/product/cjRSY6LLJt.jpeg', 10, 5, 'batok lampu YL merah, kondisi ori second,cat masih ori lis lampu dan batok tidak keropos');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(13, 2, 'batok lampu jute', 2500000, 'http://app-demo-api.000webhostapp.com/img/product/G2taYS5b9z.jpeg', 10, 5, 'batok lampu jute merah, kondisi barang ori baru');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(14, 2, 'batok lampu YL', 500000, 'http://app-demo-api.000webhostapp.com/img/product/yHImqGijkR.jpeg', 10, 5, 'batok lampu Yl, kondisi ori repro baru warna merah tua set dilengkapi dengan spidometer.');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(15, 2, 'batok lampu jute', 2000000, 'http://app-demo-api.000webhostapp.com/img/product/DJiza9kvMU.jpeg', 10, 5, 'batok lampu jute biru dengan kondisi barang normal tidak ada minus, ori second');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(16, 4, 'shock depan cb 100', 3000000, 'http://app-demo-api.000webhostapp.com/img/product/jnTAjJrFhb.jpeg', 10, 5, 'shock depan cb 100 warna hitanm ori dengan kondisi barang ori second  masih bagus');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(17, 4, 'shock depan cb 100', 3400000, 'http://app-demo-api.000webhostapp.com/img/product/0UrAQd8e8A.jpeg', 10, 5, 'shok depan cb 100 warna merah asli,kondisi ori second, set dengan mata kucing dan tromol belakang no minus');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(18, 4, 'shock depan cb 125 s.e', 3000000, 'http://app-demo-api.000webhostapp.com/img/product/JmiAj4eGHs.jpeg', 10, 5, 'shok depan cb 125 s.e kondisi ori second');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(19, 4, 'shock depan cb 125', 3000000, 'http://app-demo-api.000webhostapp.com/img/product/JmiAj4eGHs.jpeg', 10, 5, 'shock depan cb 125 lengkap dengan mata kucing, kondisi ori second');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(20, 6, 'jok cb benik', 200000, 'http://app-demo-api.000webhostapp.com/img/product/ROfnDAweCv.jpeg', 10, 5, 'jok bagus, busa kualitas bahan no 1, tampak bawah udah plus pangkon jok, jok tebal dan rapi');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(21, 6, 'jok cb dream new', 200000, 'http://app-demo-api.000webhostapp.com/img/product/c9d6vHmEj1.jpeg', 10, 5, 'jok tebal,krakap bagus tampak dibawah besi.');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(22, 6, 'jok', 150000, 'http://app-demo-api.000webhostapp.com/img/product/wtcsGpnmIQ.jpeg', 10, 5, 'jok tebal,krakap bagus tampak dibawah besi.');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(23, 6, 'jok cb', 200000, 'http://app-demo-api.000webhostapp.com/img/product/kk2Wl4gDm9.jpeg', 10, 5, 'jok anti gembos busa pres, motif x');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(24, 6, 'jok', 180000, 'http://app-demo-api.000webhostapp.com/img/product/cJwfrxjHAV.jpeg', 10, 5, 'jok anti gembos dengan motif polos');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(25, 5, 'tromol', 700000, 'http://app-demo-api.000webhostapp.com/img/product/1zsqU69fuc.jpeg', 10, 5, 'tromol depan sstwo, bahan besi kuat, ori second');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(26, 5, 'tromol', 300000, 'http://app-demo-api.000webhostapp.com/img/product/AyBky3TmTB.jpeg', 10, 5, 'tromol depan sstwo, bahan besi kuat, ori second');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(27, 5, 'tromol depan', 250000, 'http://app-demo-api.000webhostapp.com/img/product/H9e0PyMvZ5.jpeg', 10, 5, 'bahan besi tebal dan kuat,ori second');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(28, 5, 'tromol belakang', 350000, 'http://app-demo-api.000webhostapp.com/img/product/a5D1RXMr3R.jpeg', 10, 5, 'bahan besi kuat, lengkap dengan tuas pengungkit, ori second');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image_url`, `stock`, `rating`, `detail`) VALUES(29, 5, 'tromol belakang', 300000, 'http://app-demo-api.000webhostapp.com/img/product/mK3eBbCwOl.jpeg', 10, 5, 'bahan besi kuat, lengkap dengan tuas pengungkit, ori second');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`) VALUES(1, 'ipul admin', 'ipuladmin', '123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
