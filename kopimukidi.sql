/*
SQLyog Ultimate v8.4 
MySQL - 5.5.5-10.4.11-MariaDB : Database - kopimukidi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kopimukidi` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `kopimukidi`;

/*Table structure for table `tb_bahanbaku` */

DROP TABLE IF EXISTS `tb_bahanbaku`;

CREATE TABLE `tb_bahanbaku` (
  `id_bahanbaku` int(15) NOT NULL AUTO_INCREMENT,
  `nama_bahanbaku` varchar(225) NOT NULL,
  `stok_bahanbaku` int(50) NOT NULL,
  PRIMARY KEY (`id_bahanbaku`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_bahanbaku` */

insert  into `tb_bahanbaku`(`id_bahanbaku`,`nama_bahanbaku`,`stok_bahanbaku`) values (1,'Biji Kopi Arabika',19),(2,'Biji Kopi Robusta',30);

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

insert  into `tb_detail_pemesanan`(`id_pemesanan`,`id_produk`,`harga`,`jumlah_produk`) values ('PSN-001',4,55000,2),('PSN-002',2,50000,1),('PSN-002',1,55000,2),('PSN-003',4,55000,3),('PSN-004',2,50000,2),('PSN-013',1,55000,2),('PSN-014',4,55000,2),('PSN-015',1,55000,2),('PSN-016',2,50000,2);

/*Table structure for table `tb_kategori` */

DROP TABLE IF EXISTS `tb_kategori`;

CREATE TABLE `tb_kategori` (
  `id_kategori` int(15) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(225) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`id_kategori`,`nama_kategori`) values (1,'Kopi Mukidi'),(2,'Kopi Lamsi'),(3,'Kopi Jowo'),(4,'Biji Kopi ');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pelanggan` */

insert  into `tb_pelanggan`(`id_pelanggan`,`username`,`password`,`nama_pelanggan`,`email`,`no_hp`,`alamat`,`status_pelanggan`) values (1,'fauzan','e10adc3949ba59abbe56e057f20f883e','Fauzan','fauzan11@gmail.com','085627271624','Blok B67 NO.35 Lambang Jaya, Bekasi',1),(2,'raindo','e10adc3949ba59abbe56e057f20f883e','Raindo','raindo44@gmail.com','0865322563321','Jl Kayu Manis 1 baru no24 Matraman, Jakarta Timur',1),(3,'yohanes','e10adc3949ba59abbe56e057f20f883e','yohanes supriyanto','yohanes2@gmail.com','085713096098','jl.tlogo no.2, kec.jatibarang kec.mijen semarang',1),(4,'wahyu','e10adc3949ba59abbe56e057f20f883e','wahyu purnama','wahyu77@gmail.com','08222687750','jl gowangan kidul No.27 A sosromeduren,  yogyakarta',1),(5,'uririzki','e10adc3949ba59abbe56e057f20f883e','uri rizki amalia','uririzki@gmail.com','08373746646','jl.gajah 43, bumiayu,  brebes, jawatengah',1),(7,'jisuk','fcea920f7412b5da7be0cf42b8c93759','aji sukmo','ajisuk31@gmail.com','082147210076','sleman yogyakarta',1);

/*Table structure for table `tb_pembayaran` */

DROP TABLE IF EXISTS `tb_pembayaran`;

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(15) NOT NULL AUTO_INCREMENT,
  `id_pemesanan` varchar(15) NOT NULL,
  `nama_rekening` varchar(225) NOT NULL,
  `nama_bank` varchar(225) NOT NULL,
  `jumlah_transfer` int(25) NOT NULL,
  `bukti_transfer` text NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `status_pembayaran` int(15) NOT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `FK_tb_pembayaran` (`id_pemesanan`),
  CONSTRAINT `FK_tb_pembayaran` FOREIGN KEY (`id_pemesanan`) REFERENCES `tb_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pembayaran` */

insert  into `tb_pembayaran`(`id_pembayaran`,`id_pemesanan`,`nama_rekening`,`nama_bank`,`jumlah_transfer`,`bukti_transfer`,`tanggal_transfer`,`status_pembayaran`) values (1,'PSN-001 ','Fauzan','BNI',129000,'1065836616_Bukti-TRF.jpg','2020-08-17',2),(2,'PSN-002 ','raindo','BCA',128000,'781436958_buktitransfer1.jpg','2020-08-18',2),(3,'PSN-003 ','Yohanes','BNI',180000,'804432939_Bukti-TRF.jpg','2020-08-20',2),(4,'PSN-004 ','uri','BNI',120000,'649191347_buktitransfer4.jpg','2020-08-20',2);

/*Table structure for table `tb_pembelian_bahanbaku` */

DROP TABLE IF EXISTS `tb_pembelian_bahanbaku`;

CREATE TABLE `tb_pembelian_bahanbaku` (
  `id_pembelian` varchar(15) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `id_bahanbaku` int(15) DEFAULT NULL,
  `id_petani` int(15) DEFAULT NULL,
  `jumlah` int(15) DEFAULT NULL,
  `total_harga` int(50) DEFAULT NULL,
  `status_pembelian` int(15) DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `FK_tb_pembelian_bahanbaku` (`id_petani`),
  KEY `FK_tb_pembelian_bahanbaku1` (`id_bahanbaku`),
  KEY `FK_tb_pembelian_bahanbaku4` (`status_pembelian`),
  CONSTRAINT `FK_tb_pembelian_bahanbaku` FOREIGN KEY (`id_petani`) REFERENCES `tb_petani` (`id_petani`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_pembelian_bahanbaku1` FOREIGN KEY (`id_bahanbaku`) REFERENCES `tb_bahanbaku` (`id_bahanbaku`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pembelian_bahanbaku` */

insert  into `tb_pembelian_bahanbaku`(`id_pembelian`,`tanggal_pembelian`,`id_bahanbaku`,`id_petani`,`jumlah`,`total_harga`,`status_pembelian`) values ('PMB-01','2020-09-13',1,1,1,545000,5);

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
  PRIMARY KEY (`id_pemesanan`),
  KEY `FK_tb_pemesanan` (`id_pelanggan`),
  CONSTRAINT `FK_tb_pemesanan` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pemesanan` */

insert  into `tb_pemesanan`(`id_pemesanan`,`tanggal_checkout`,`id_pelanggan`,`total_berat`,`kurir`,`ongkir`,`total_bayar`,`status_pemesanan`) values ('PSN-001','2020-08-17',1,500,'JNE - OKE',19000,129000,5),('PSN-002','2020-08-18',2,750,'JNE - REG',21000,181000,5),('PSN-003','2020-08-20',3,750,'JNE - REG',15000,180000,5),('PSN-004','2020-08-20',5,500,'JNE - REG',20000,120000,5),('PSN-012','2020-08-27',7,500,'JNE - REG',15000,125000,3),('PSN-013','2020-08-28',7,500,'JNE - REG',15000,125000,5),('PSN-014','2020-08-28',7,500,'Pos Indonesia - Express Next Day Barang',17000,127000,1),('PSN-015','2020-08-31',7,500,'JNE - REG',15000,125000,1),('PSN-016','2020-09-13',5,500,'Pos Indonesia - Express Next Day Barang',18000,118000,5);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pengiriman` */

insert  into `tb_pengiriman`(`id_pengiriman`,`tanggal_kirim`,`id_pemesanan`,`no_resi`,`nama_pengirim`) values (1,'2020-08-21','PSN-001','JNE-02633553','mukidi'),(2,'2020-08-21','PSN-002','JNE-02633554','mukidi'),(3,'2020-08-21','PSN-004','JNE-02633557','mukidi'),(4,'2020-08-20','PSN-003','JNE-02633559','mukidi'),(5,'2020-09-15','PSN-016','JNT-02633553','sss');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_petani` */

insert  into `tb_petani`(`id_petani`,`nama_petani`,`no_hp`,`alamat`,`username`,`password`,`bergabung`) values (1,'Heru Susilo','082147210077','Petarangan, RT 4/07 Temanggung','petani','$2y$10$ws6YQ92xtT1wvxpZL.WJHeDNFkjhT2TKkNqdSS6OypOf.AGpQphuG','2020-04-01'),(8,'Budi','08338747477','temanggung','budi','$2y$10$T33vCJyQQebM5TXJGX9UA.KV0jkouRdjm0.iZ.i4X0rdXy3LFOOL6','2020-08-08');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_produk` */

insert  into `tb_produk`(`id_produk`,`nama_produk`,`id_kategori`,`berat`,`harga`,`stok`,`deskripsi`,`foto_produk`) values (1,'Kopi Mukidi Spesial Blend',1,250,55000,16,'Kopi Mukidi Spesial Blend\r\nKopi Bubuk Mukidi Kemasan 250 Gram  \r\nKopi khas negeri tembakau Temanggung                            ','19-kopimukidi.jpg'),(2,'Kopi Jowo Arabica',3,250,50000,126,'Kopi Bubuk Mukidi \r\nJenis Arabica\r\nKemasan 250 Gram                            ','870-arabica.jpg'),(3,'Kopi Lamsi',2,250,65000,66,'Kopi Bubuk Lamsi \r\nLereng Gunung Sumbing\r\nKemasan 250 Gram                         ','670-Kopi Lamsi.jpg'),(4,'Kopi Mukidi Robusta',1,250,55000,42,'Kopi Mukidi Robusta\r\nPerpaduan biji-biji kopi single origin akan menghasilkan seduhan kopi dengan rasa yang unik dan berbeda                        ','463-Kopi Arabusta.jpg');

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

insert  into `tb_produksi`(`id_produksi`,`tanggal_produksi`,`id_produk`,`id_bahanbaku`,`jumlah_bahanbaku`,`jumlah_stok_baru`,`status_produksi`) values ('PRD-01','2020-09-13',2,1,4,67,3);

/*Table structure for table `tb_riwayat_status` */

DROP TABLE IF EXISTS `tb_riwayat_status`;

CREATE TABLE `tb_riwayat_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_code` varchar(15) NOT NULL,
  `status` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_riwayat_status` */

insert  into `tb_riwayat_status`(`id`,`status_code`,`status`,`waktu`) values (4,'PMB-01',1,'2020-09-06 18:55:47'),(5,'PMB-01',2,'2020-09-06 19:04:41'),(6,'PMB-01',3,'2020-09-06 19:11:59'),(7,'PMB-01',4,'2020-09-06 19:13:50'),(8,'PMB-01',5,'2020-09-06 19:13:50'),(18,'PRD-01',1,'2020-09-13 14:04:43'),(19,'PRD-01',2,'2020-09-13 14:08:53'),(21,'PRD-01',3,'2020-09-13 14:11:13'),(22,'PRD-01',2,'2020-09-13 14:13:05'),(23,'PRD-01',3,'2020-09-13 14:13:52'),(24,'PSN-016',1,'2020-09-13 15:21:06'),(25,'PSN-016',1,'2020-09-13 15:24:42'),(26,'PSN-016',1,'2020-09-13 15:25:28'),(27,'PSN-016',5,'2020-09-13 15:26:39'),(28,'PSN-016',4,'2020-09-14 09:11:59'),(29,'PSN-016',5,'2020-09-18 06:24:16');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id_user` int(15) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(225) NOT NULL,
  `jabatan` varchar(125) NOT NULL,
  `username` varchar(125) NOT NULL,
  `password` varchar(225) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id_user`,`nama_user`,`jabatan`,`username`,`password`) values (1,'Uri Rizki','Admin','admin','$2y$10$F7lTJlNU5yptFCecoLqW3uglonj3Jiv2nkw4AUWWX3zQekTtHWM46'),(2,'Reza ','Bagian-Produksi','produksi','$2y$10$rAUYAYuaBgye8DLgfFyoQ.6LAB1aDI2BR9wA9uf8J8xQdLLMzPjU6'),(3,'Mukidi','Pemilik','pemilik','$2y$10$pxgZbb75zf1baEcxXxUwruB0.Tt0K8h2N4yj/8rJQX4Sx6/MFgr82');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
