
CREATE DATABASE IF NOT EXISTS product_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE product_db;


CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO products (name, price, quantity) VALUES 
('Laptop Gaming Asus', 18500000, 10),
('Bàn phím cơ RGB', 1250000, 25),
('Chuột không dây Logitech', 450000, 50),
('Màn hình UltraWide 29 inch', 5200000, 8),
('Tai nghe chụp tai chống ồn', 1800000, 15);