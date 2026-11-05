-- =====================================================
-- BarangTemu - MySQL Database Creation Script
-- =====================================================
-- Gunakan script ini di phpMyAdmin atau MySQL command line
-- untuk membuat database barangtemu
-- =====================================================

-- 1. Buat database baru
CREATE DATABASE IF NOT EXISTS barangtemu
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- 2. Gunakan database
USE barangtemu;

-- 3. Buat user khusus (opsional, untuk keamanan)
-- CREATE USER IF NOT EXISTS 'barangtemu_user'@'localhost' IDENTIFIED BY 'password123';
-- GRANT ALL PRIVILEGES ON barangtemu.* TO 'barangtemu_user'@'localhost';
-- FLUSH PRIVILEGES;

-- =====================================================
-- Database siap digunakan!
-- Jalankan: php artisan migrate:fresh --seed
-- =====================================================
