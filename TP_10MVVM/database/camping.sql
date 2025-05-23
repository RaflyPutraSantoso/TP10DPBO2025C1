CREATE DATABASE IF NOT EXISTS camping_db;
USE camping_db;

CREATE TABLE jenis_alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_jenis VARCHAR(100) NOT NULL,
    deskripsi TEXT
);

CREATE TABLE supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    stok INT NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    jenis_id INT NOT NULL,
    supplier_id INT NOT NULL,
    FOREIGN KEY (jenis_id) REFERENCES jenis_alat(id),
    FOREIGN KEY (supplier_id) REFERENCES supplier(id)
);

-- Contoh data untuk jenis_alat
INSERT INTO jenis_alat (nama_jenis, deskripsi) VALUES 
('Tenda', 'Berbagai macam tenda camping'),
('Peralatan Masak', 'Peralatan memasak outdoor'),
('Penerangan', 'Alat penerangan untuk camping');

-- Contoh data untuk supplier
INSERT INTO supplier (nama, alamat, telepon, email) VALUES 
('Adventure Gear', 'Jl. Camping No. 123', '0812345678', 'info@adventuregear.com'),
('Outdoor Pro', 'Jl. Hiking No. 456', '0823456789', 'sales@outdoorpro.com');

-- Contoh data untuk alat
INSERT INTO alat (nama, stok, harga, jenis_id, supplier_id) VALUES 
('Tenda Dome 2 Orang', 10, 450000, 1, 1),
('Kompor Portable', 15, 250000, 2, 2),
('Lampu LED Camping', 20, 150000, 3, 1);