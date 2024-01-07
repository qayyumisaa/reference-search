CREATE DATABASE IF NOT EXISTS manuscripts_catalog;
USE manuscripts_catalog;

CREATE TABLE IF NOT EXISTS manuscripts_catalog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_rujukan VARCHAR(255),
    no_rujukan_lama VARCHAR(255),
    naskhah VARCHAR(50),
    ejaan VARCHAR(50),
    tajuk TEXT,
    halaman INT,
    penulis TEXT,
    sumber TEXT,
    nota TEXT,
    deskripsi TEXT
);
