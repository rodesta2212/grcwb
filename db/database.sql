/*
MySQL Backup
Source Server Version: 5.1.31
Source Database: grace
Date: 6/26/2023 23:14:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `jadwal_rinci_pelatihan`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_rinci_pelatihan`;
CREATE TABLE `jadwal_rinci_pelatihan` (
  `id_jadwal_rinci_pelatihan` varchar(255) NOT NULL DEFAULT '',
  `id_peserta` varchar(255) DEFAULT NULL,
  `id_pelatihan` varchar(255) DEFAULT NULL,
  `id_program` varchar(255) DEFAULT NULL,
  `status_pelatihan` enum('mendaftar','pelatihan','lulus','tidak lulus') DEFAULT NULL,
  `status_pembayaran` enum('menunggu pembayaran','menunggu konfirmasi','terkonfirmasi') DEFAULT NULL,
  `file_pembayaran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal_rinci_pelatihan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `pelatihan`
-- ----------------------------
DROP TABLE IF EXISTS `pelatihan`;
CREATE TABLE `pelatihan` (
  `id_pelatihan` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pelatihan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `peserta`
-- ----------------------------
DROP TABLE IF EXISTS `peserta`;
CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('perempuan','laki') DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_peserta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `program`
-- ----------------------------
DROP TABLE IF EXISTS `program`;
CREATE TABLE `program` (
  `id_program` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `biaya` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `senin` enum('YES','NOT') DEFAULT NULL,
  `selasa` enum('YES','NOT') DEFAULT NULL,
  `rabu` enum('YES','NOT') DEFAULT NULL,
  `kamis` enum('YES','NOT') DEFAULT NULL,
  `jumat` enum('YES','NOT') DEFAULT NULL,
  `sabtu` enum('YES','NOT') DEFAULT NULL,
  `minggu` enum('YES','NOT') DEFAULT NULL,
  PRIMARY KEY (`id_program`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL DEFAULT '0',
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role` enum('admin','peserta') DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `jadwal_rinci_pelatihan` VALUES ('1','1','1','1','lulus','terkonfirmasi','Bukti-pembayaran-semnas-rahayu.png'), ('2','2','2','2','pelatihan','terkonfirmasi','Bukti-pembayaran-semnas-rahayu.png'), ('3','4','1','3','lulus','terkonfirmasi','Bukti-pembayaran-semnas-rahayu.png'), ('4','4','2','1','pelatihan','terkonfirmasi','Bukti-pembayaran-semnas-rahayu.png'), ('5','2','3','2','mendaftar','menunggu pembayaran','');
INSERT INTO `pelatihan` VALUES ('1','Digital Marketing','Pelatihan ini akan menekankan dalam hal : Membuat Logo, Poster, Banner, Denah, dan Editing foto dengan software CorelDRAW dan Adobe Photoshop. Optimalisasi Google My Business dan Google Ads, membuat Landing Page, serta Optimalisasi Seo dan Copywriting\r\n','2023-06-26','2023-07-29','digital_marketing.png'), ('2','Information Technology (IT)','Computer network, Backend menggunakan Go, Pemrograman Android dengan flutter dan kotlin, Internet of Things sensor, Pemanfaatan teknik pengolahan Citra untuk pengenalan wajah face recognition, Pemrograman dengan laravel, dan Content management system CMS\r\n','2023-06-26','2023-07-21','IT.png'), ('3','Penulisan Karya Ilmiah','Pengolahan data statistik untuk analisis menggunakan SPSS, Pengolahan data statistik untuk analisis menggunakan LPS, Penulisan referensi menggunakan mendeley, Trik trik penggunaan microsoft Office untuk penulisan tugas akhir, dan Otomatisasi perkantoran menggunakan Microsoft Office','2023-06-29','2023-07-08','karya_ilmiah.png');
INSERT INTO `peserta` VALUES ('1','2','Nabilah Ayu','1999-11-11','Snapinsta.app_290793122_565767998574883_7198262141571780536_n_1024.jpg','nabilah@mail.com','82173613738','perempuan','Jln. Raya Jakarta Pusat No. 48'), ('2','3','Ghea Indrawari','1998-03-10','Snapinsta.app_338163735_203913592262729_8853849670993971303_n_1024.jpg','ghea@mail.com','82162373213','perempuan','Jln. Raya Singkawang No.17'), ('3','4','Jefri Nichol','1999-01-15','Snapinsta.app_340165421_760792492264710_1540565217492731050_n_1024.jpg','jefri@mail.com','87321234129','laki','Jln. Raya Jakarta Barat No. 88'), ('4','5','Vanka Thalia','2000-11-21','Snapinsta.app_315143523_1411021519706945_4286531765180078801_n_1024.jpg','vanka@mail.com','82312314374','perempuan','Jln. Jakarta Raya No. 66');
INSERT INTO `program` VALUES ('1','Private Class','Private Class adalah Program pelatihan wabi dimana satu peserta dibimbing oleh seorang tutor. Program Private Class mengutamakan kualitas pembelajaran face to face yang memiliki bounding yang kuat antara tutor dan peserta','09:00:00','11:00:00','750000','private_class.png','YES','YES','YES','YES','YES','NOT','NOT'), ('2','Night Class','Kelas malam hari','19:00:00','21:00:00','500000','night_class.png','YES','YES','YES','YES','YES','NOT','NOT'), ('3','Weekend Class','Kelas hari sabtu dan minggu','08:00:00','13:00:00','500000','weekend_class.png','NOT','NOT','NOT','NOT','NOT','YES','YES');
INSERT INTO `user` VALUES ('1','admin','admin','admin'), ('2','nabilah','nabilah','peserta'), ('3','ghea','ghea','peserta'), ('4','jefri','jefri','peserta'), ('5','vanka','vanka','peserta');
