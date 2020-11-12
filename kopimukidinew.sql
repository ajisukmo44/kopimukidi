/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.14-MariaDB : Database - db_kopimukidi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_kopimukidi` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_kopimukidi`;

/*Table structure for table `tb_bahanbaku` */

DROP TABLE IF EXISTS `tb_bahanbaku`;

CREATE TABLE `tb_bahanbaku` (
  `id_bahanbaku` int(15) NOT NULL AUTO_INCREMENT,
  `nama_bahanbaku` varchar(225) NOT NULL,
  `stok_bahanbaku` int(50) NOT NULL,
  PRIMARY KEY (`id_bahanbaku`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_bahanbaku` */

insert  into `tb_bahanbaku`(`id_bahanbaku`,`nama_bahanbaku`,`stok_bahanbaku`) values 
(1,'Biji Kopi Arabika',125),
(2,'Biji Kopi Robusta',95);

/*Table structure for table `tb_detail_pemesanan` */

DROP TABLE IF EXISTS `tb_detail_pemesanan`;

CREATE TABLE `tb_detail_pemesanan` (
  `id_pemesanan` varchar(15) NOT NULL,
  `id_produk` int(15) NOT NULL,
  `harga` int(50) NOT NULL,
  `jumlah_produk` int(15) NOT NULL,
  KEY `FK_tb_detail_pemesanan` (`id_pemesanan`),
  KEY `FK_tb_detail_pemesanan1` (`id_produk`),
  CONSTRAINT `FK_tb_detail_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `tb_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_detail_pemesanan1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_detail_pemesanan` */

insert  into `tb_detail_pemesanan`(`id_pemesanan`,`id_produk`,`harga`,`jumlah_produk`) values 
('PSN-001',4,50000,1),
('PSN-001',2,45000,1);

/*Table structure for table `tb_kategori` */

DROP TABLE IF EXISTS `tb_kategori`;

CREATE TABLE `tb_kategori` (
  `id_kategori` int(15) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(225) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`id_kategori`,`nama_kategori`) values 
(1,'Kopi Mukidi'),
(2,'Kopi Lamsi'),
(3,'Kopi Jowo'),
(4,'Biji Kopi ');

/*Table structure for table `tb_pelanggan` */

DROP TABLE IF EXISTS `tb_pelanggan`;

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(15) NOT NULL AUTO_INCREMENT,
  `username` varchar(125) NOT NULL,
  `password` varchar(225) NOT NULL,
  `nama_pelanggan` varchar(200) NOT NULL,
  `email` varchar(125) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `status_pelanggan` int(15) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pelanggan` */

insert  into `tb_pelanggan`(`id_pelanggan`,`username`,`password`,`nama_pelanggan`,`email`,`no_hp`,`alamat`,`status_pelanggan`) values 
(1,'fauzan','e10adc3949ba59abbe56e057f20f883e','Fauzan','fauzan11@gmail.com','085627271624','Blok B67 NO.35 Lambang Jaya, Bekasi',1),
(2,'raindo','e10adc3949ba59abbe56e057f20f883e','Raindo','raindo44@gmail.com','0865322563321','Jl Kayu Manis 1 baru no24 Matraman, Jakarta Timur',1),
(3,'yohanes','e10adc3949ba59abbe56e057f20f883e','yohanes supriyanto','yohanes2@gmail.com','085713096098','jl.tlogo no.2, kec.jatibarang kec.mijen semarang',1),
(4,'wahyu','e10adc3949ba59abbe56e057f20f883e','wahyu purnama','wahyu77@gmail.com','08222687750','jl gowangan kidul No.27 A sosromeduren,  yogyakarta',1),
(5,'uri','e10adc3949ba59abbe56e057f20f883e','uri rizki','uririzki1@gmail.com','085642373626','tonjong sokawera kec.tonong kab.brebes Jawa tengah',1),
(6,'lia','e10adc3949ba59abbe56e057f20f883e','lia amel','liaamel76@gmail.com','0874322233566','jl.bumiayu no 11, brebes, jawa tengah',1);

/*Table structure for table `tb_pembayaran` */

DROP TABLE IF EXISTS `tb_pembayaran`;

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(15) NOT NULL AUTO_INCREMENT,
  `id_pemesanan` varchar(15) NOT NULL,
  `nama_pengirim` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `total_pembayaran` int(25) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `batas_pembayaran` datetime DEFAULT NULL,
  `status_pembayaran` int(15) NOT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `FK_tb_pembayaran` (`id_pemesanan`),
  CONSTRAINT `FK_tb_pembayaran` FOREIGN KEY (`id_pemesanan`) REFERENCES `tb_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pembayaran` */

insert  into `tb_pembayaran`(`id_pembayaran`,`id_pemesanan`,`nama_pengirim`,`metode_pembayaran`,`total_pembayaran`,`tanggal_pembayaran`,`batas_pembayaran`,`status_pembayaran`) values 
(53,'PSN-001','Fauzan','Payment Gateway QRIS',114000,'2020-11-10','2020-11-11 09:48:36',2);

/*Table structure for table `tb_pembelian_bahanbaku` */

DROP TABLE IF EXISTS `tb_pembelian_bahanbaku`;

CREATE TABLE `tb_pembelian_bahanbaku` (
  `id_pembelian` varchar(15) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `id_bahanbaku` int(15) DEFAULT NULL,
  `id_petani` int(15) DEFAULT NULL,
  `jumlah` int(15) DEFAULT NULL,
  `total_harga` int(50) DEFAULT NULL,
  `nota_pembelian` text DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `FK_tb_pembelian_bahanbaku` (`id_petani`),
  KEY `FK_tb_pembelian_bahanbaku1` (`id_bahanbaku`),
  KEY `FK_tb_pembelian_bahanbaku4` (`nota_pembelian`(768)),
  CONSTRAINT `FK_tb_pembelian_bahanbaku` FOREIGN KEY (`id_petani`) REFERENCES `tb_petani` (`id_petani`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_pembelian_bahanbaku1` FOREIGN KEY (`id_bahanbaku`) REFERENCES `tb_bahanbaku` (`id_bahanbaku`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pembelian_bahanbaku` */

insert  into `tb_pembelian_bahanbaku`(`id_pembelian`,`tanggal_pembelian`,`id_bahanbaku`,`id_petani`,`jumlah`,`total_harga`,`nota_pembelian`) values 
('PMB-001','2020-10-22',1,1,10,2000000,'409-IMG-20201015-WA0024.jpg'),
('PMB-002','2020-10-22',2,1,20,2000000,'49-IMG-20201015-WA0024.jpg');

/*Table structure for table `tb_pemesanan` */

DROP TABLE IF EXISTS `tb_pemesanan`;

CREATE TABLE `tb_pemesanan` (
  `id_pemesanan` varchar(15) NOT NULL,
  `tanggal_checkout` date NOT NULL,
  `id_pelanggan` int(15) NOT NULL,
  `total_berat` int(15) NOT NULL,
  `kurir` varchar(225) NOT NULL,
  `ongkir` int(25) NOT NULL,
  `total_bayar` int(25) NOT NULL,
  `status_pemesanan` int(15) NOT NULL,
  `link_pembayaran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pemesanan`),
  KEY `FK_tb_pemesanan` (`id_pelanggan`),
  CONSTRAINT `FK_tb_pemesanan` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pemesanan` */

insert  into `tb_pemesanan`(`id_pemesanan`,`tanggal_checkout`,`id_pelanggan`,`total_berat`,`kurir`,`ongkir`,`total_bayar`,`status_pemesanan`,`link_pembayaran`) values 
('PSN-001','2020-11-10',1,500,'JNE - OKE',19000,114000,5,'https://my.ipaymu.com/payment/0B19C535-D87C-486F-BA6A-3BA17C56CCD8');

/*Table structure for table `tb_pengiriman` */

DROP TABLE IF EXISTS `tb_pengiriman`;

CREATE TABLE `tb_pengiriman` (
  `id_pengiriman` int(15) NOT NULL AUTO_INCREMENT,
  `tanggal_kirim` date DEFAULT NULL,
  `id_pemesanan` varchar(15) NOT NULL,
  `no_resi` varchar(125) NOT NULL,
  `nama_pengirim` varchar(225) NOT NULL,
  PRIMARY KEY (`id_pengiriman`),
  KEY `FK_tb_pengiriman` (`id_pemesanan`),
  CONSTRAINT `FK_tb_pengiriman` FOREIGN KEY (`id_pemesanan`) REFERENCES `tb_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pengiriman` */

insert  into `tb_pengiriman`(`id_pengiriman`,`tanggal_kirim`,`id_pemesanan`,`no_resi`,`nama_pengirim`) values 
(21,'2020-11-10','PSN-001','JNE0282836366','Velly');

/*Table structure for table `tb_petani` */

DROP TABLE IF EXISTS `tb_petani`;

CREATE TABLE `tb_petani` (
  `id_petani` int(15) NOT NULL AUTO_INCREMENT,
  `nama_petani` varchar(225) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bergabung` date NOT NULL,
  PRIMARY KEY (`id_petani`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_petani` */

insert  into `tb_petani`(`id_petani`,`nama_petani`,`no_hp`,`alamat`,`username`,`password`,`bergabung`) values 
(1,'Paidi','082147210077','Petarangan, Temanggung','petani','$2y$10$HtUTwkriZAhyAQEZGuuSmeR/QdEhlrqUFw..72tikwCARcVMOrg2C','2019-07-01'),
(2,'Sukadi','08282727272','Temanggung','petani2','$2y$10$eDb/xIBvtRdGJp/KegJS1uioOQcJ/0bv7msHwiDTElG4SI5KhEGJe','2019-08-07'),
(3,'Tuyadi','087765910637','Gadurejo, Temanggung','petani3','$2y$10$rmKpuNt7NpMnW1ttLp/1iut0Lff0tRz.Gpi8HV/MB4eE7D8IVJXMe','2019-06-04');

/*Table structure for table `tb_produk` */

DROP TABLE IF EXISTS `tb_produk`;

CREATE TABLE `tb_produk` (
  `id_produk` int(15) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(225) NOT NULL,
  `id_kategori` int(15) NOT NULL,
  `berat` int(15) NOT NULL,
  `harga` int(50) NOT NULL,
  `stok` int(15) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto_produk` text NOT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `FK_tb_produk` (`id_kategori`),
  CONSTRAINT `FK_tb_produk` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_produk` */

insert  into `tb_produk`(`id_produk`,`nama_produk`,`id_kategori`,`berat`,`harga`,`stok`,`deskripsi`,`foto_produk`) values 
(1,'Kopi Mukidi Spesial Blend',1,250,50000,119,'Kopi Bubuk Mukidi Spesial Blend  Lereng Gunung Sumbing Kemasan 250 Gram                         ','320-special blend.jpg'),
(2,'Kopi Jowo Robusta',3,250,45000,133,'Kopi Bubuk Jowo Robusta  Lereng Gunung Sumbing Kemasan 250 Gram                         ','735-kopi jowo robusta.jpg'),
(3,'Kopi Lamsi',2,250,50000,200,'Kopi Bubuk Lamsi Lereng Gunung SumbingKemasan 250 Gram                         ','510-lamsi.jpg'),
(4,'Kopi Mukidi Robusta',1,250,50000,86,'Kopi Bubuk Mukidi Jowo Robusta  Lereng Gunung Sumbing Kemasan 250 Gram                         ','422-robusta.jpg'),
(23,'Kopi Mukidi Arabika',1,250,45000,100,'Kopi Bubuk  Mukidi Arabika  Lereng Gunung Sumbing Kemasan 250 Gram                         ','792-arabika.jpg');

/*Table structure for table `tb_produksi` */

DROP TABLE IF EXISTS `tb_produksi`;

CREATE TABLE `tb_produksi` (
  `id_produksi` varchar(15) NOT NULL,
  `tanggal_produksi` date DEFAULT NULL,
  `id_produk` int(15) NOT NULL,
  `id_bahanbaku` int(15) NOT NULL,
  `jumlah_bahanbaku` int(50) NOT NULL,
  `jumlah_stok_baru` int(50) DEFAULT NULL,
  `status_produksi` int(15) NOT NULL,
  PRIMARY KEY (`id_produksi`),
  KEY `FK_tb_update_stok` (`id_produk`),
  KEY `FK_tb_update_stok1` (`id_bahanbaku`),
  CONSTRAINT `FK_tb_update_stok` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tb_update_stok1` FOREIGN KEY (`id_bahanbaku`) REFERENCES `tb_bahanbaku` (`id_bahanbaku`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_produksi` */

insert  into `tb_produksi`(`id_produksi`,`tanggal_produksi`,`id_produk`,`id_bahanbaku`,`jumlah_bahanbaku`,`jumlah_stok_baru`,`status_produksi`) values 
('PRD-02','2020-10-15',23,1,20,64,3),
('PRD-03','2020-10-22',2,2,20,64,3),
('PRD-04','2020-10-22',3,1,20,64,3);

/*Table structure for table `tb_riwayat_status` */

DROP TABLE IF EXISTS `tb_riwayat_status`;

CREATE TABLE `tb_riwayat_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_code` varchar(15) NOT NULL,
  `status` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_riwayat_status` */

insert  into `tb_riwayat_status`(`id`,`status_code`,`status`,`waktu`) values 
(105,'PRD-02',1,'2020-10-15 20:32:43'),
(106,'PRD-02',2,'2020-10-15 20:35:57'),
(107,'PRD-02',3,'2020-10-15 20:51:47'),
(159,'PRD-03',1,'2020-10-22 08:20:00'),
(160,'PRD-03',2,'2020-10-22 08:20:45'),
(161,'PRD-03',3,'2020-10-22 08:20:56'),
(167,'PRD-04',1,'2020-10-22 11:00:57'),
(168,'PRD-04',2,'2020-10-22 11:01:37'),
(169,'PRD-04',3,'2020-10-22 11:02:03'),
(243,'PSN-001',1,'2020-11-10 09:48:14'),
(244,'PSN-001',1,'2020-11-10 09:48:14'),
(245,'PSN-001',2,'2020-11-10 09:49:26'),
(246,'PSN-001',3,'2020-11-10 09:49:54'),
(247,'PSN-001',4,'2020-11-10 09:50:14'),
(248,'PSN-001',5,'2020-11-10 09:50:23');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id_user` int(15) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(225) NOT NULL,
  `jabatan` varchar(125) NOT NULL,
  `username` varchar(125) NOT NULL,
  `password` varchar(225) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id_user`,`nama_user`,`jabatan`,`username`,`password`) values 
(1,'Velly','Admin','admin','$2y$10$F7lTJlNU5yptFCecoLqW3uglonj3Jiv2nkw4AUWWX3zQekTtHWM46'),
(2,'Diaz','Bagian-Produksi','produksi','$2y$10$rAUYAYuaBgye8DLgfFyoQ.6LAB1aDI2BR9wA9uf8J8xQdLLMzPjU6'),
(3,'Mukidi','Pemilik','pemilik','$2y$10$pxgZbb75zf1baEcxXxUwruB0.Tt0K8h2N4yj/8rJQX4Sx6/MFgr82');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
