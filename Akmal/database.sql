CREATE DATABASE bimbel_db;
USE bimbel_db;

CREATE TABLE pendaftar (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100),
    email VARCHAR(100),
    paket VARCHAR(50),
    fasilitas TEXT,
    lokasi VARCHAR(50),
    metode_pembayaran VARCHAR(50),
    catatan TEXT,
    price1 INT(11),
    price2 INT(11),
    price3 INT(11),
    price4 INT(11),
    tax INT(11),
    taxes INT(11),
    total_biaya INT(11),
    tanggal_daftar DATETIME
);