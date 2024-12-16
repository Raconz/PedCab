-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pedcabdb
DROP DATABASE IF EXISTS `pedcabdb`;
CREATE DATABASE IF NOT EXISTS `pedcabdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pedcabdb`;

-- Dumping structure for table pedcabdb.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pedcabdb.admin: ~0 rows (approximately)
DELETE FROM `admin`;
INSERT INTO `admin` (`id_admin`, `username`, `password`, `created_at`) VALUES
	(1, 'admin', '$2y$12$8gywAfMzFz4sqO./R.4bHe2JVGEhzC8WBanf2EZcezZPyD/bBwU.i', '2022-04-15');

-- Dumping structure for table pedcabdb.gejala
DROP TABLE IF EXISTS `gejala`;
CREATE TABLE IF NOT EXISTS `gejala` (
  `id_gejala` int NOT NULL AUTO_INCREMENT,
  `kode_gejala` varchar(30) DEFAULT NULL,
  `nama_gejala` varchar(200) DEFAULT NULL,
  `belief` float DEFAULT NULL,
  PRIMARY KEY (`id_gejala`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pedcabdb.gejala: ~10 rows (approximately)
DELETE FROM `gejala`;
INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`, `belief`) VALUES
	(1, 'G1', 'Daun menguning', 0.7),
	(2, 'G2', 'Layu mendadak', 0.9),
	(3, 'G3', 'Bercak coklat pada daun', 0.5),
	(4, 'G4', 'Akar busuk', 0.9),
	(5, 'G5', 'Buah rontok', 0.7),
	(6, 'G6', 'Buah berkerut atau cacat', 0.8),
	(7, 'G7', 'Batang busuk atau berlendir', 0.8),
	(8, 'G8', 'Pertumbuhan terhambat', 0.6),
	(9, 'G9', 'Jamur putih pada daun atau batang', 0.9),
	(10, 'G10', 'Daun menggulung', 0.9);

-- Dumping structure for table pedcabdb.penyakit
DROP TABLE IF EXISTS `penyakit`;
CREATE TABLE IF NOT EXISTS `penyakit` (
  `id_penyakit` int NOT NULL AUTO_INCREMENT,
  `kode_penyakit` varchar(30) DEFAULT NULL,
  `nama_penyakit` varchar(200) DEFAULT NULL,
  `deskripsi` text,
  `solusi` text,
  PRIMARY KEY (`id_penyakit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pedcabdb.penyakit: ~6 rows (approximately)
DELETE FROM `penyakit`;
INSERT INTO `penyakit` (`id_penyakit`, `kode_penyakit`, `nama_penyakit`, `deskripsi`, `solusi`) VALUES
	(1, 'P1', 'Layu Fusarium', 'Layu Fusarium menyebabkan gangguan pada sistem pembuluh tanaman, menghambat penyerapan air dan nutrisi. Gejala layu mendadak dengan akar yang membusuk menjadi ciri khasnya.', 'Obat Layu'),
	(2, 'P2', 'Antraknosa (Patek)', ' Penyakit ini sering menyerang buah cabai, terutama pada kondisi lembap. Bercak cokelat yang meluas hingga menyebabkan busuk menjadi indikasi khas.', 'Obat Patek'),
	(3, 'P3', 'Layu Bakteri', 'Layu bakteri mematikan tanaman dengan cepat, sering ditandai oleh eksudat bakteri pada batang yang dipotong.', 'Obat Layu Bakteri'),
	(4, 'P4', 'Busuk Buah', 'Penyakit ini menyerang buah langsung, terutama pada musim hujan atau kondisi lembap. Pencegahan melalui sanitasi lahan sangat penting.', 'Obat Busuk Buah'),
	(5, 'P5', 'Embun Tepung', 'Penyakit ini menyebabkan lapisan seperti bedak putih pada daun, mengurangi fotosintesis tanaman.', 'Obat Embun Tepung'),
	(6, 'P6', 'Virus Kuning', 'Virus ini sering menyebabkan daun terlihat belang kuning dan keriting. Pengendalian kutu kebul sangat penting untuk mencegah penyebarannya.', 'Obat Virus Kuning');

-- Dumping structure for table pedcabdb.relasi
DROP TABLE IF EXISTS `relasi`;
CREATE TABLE IF NOT EXISTS `relasi` (
  `id_relasi` int NOT NULL AUTO_INCREMENT,
  `id_penyakit` int DEFAULT NULL,
  `id_gejala` int DEFAULT NULL,
  PRIMARY KEY (`id_relasi`),
  KEY `fk_id_penyakit` (`id_penyakit`),
  KEY `fk_id_gejala` (`id_gejala`),
  CONSTRAINT `fk_id_gejala` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_penyakit` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pedcabdb.relasi: ~22 rows (approximately)
DELETE FROM `relasi`;
INSERT INTO `relasi` (`id_relasi`, `id_penyakit`, `id_gejala`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 1, 4),
	(4, 1, 9),
	(5, 2, 3),
	(6, 2, 5),
	(7, 2, 6),
	(8, 3, 1),
	(9, 3, 2),
	(10, 3, 4),
	(11, 3, 5),
	(12, 3, 7),
	(13, 4, 3),
	(14, 4, 5),
	(15, 4, 6),
	(16, 5, 3),
	(17, 5, 5),
	(18, 5, 8),
	(19, 5, 9),
	(20, 6, 1),
	(21, 6, 8),
	(22, 6, 10);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
