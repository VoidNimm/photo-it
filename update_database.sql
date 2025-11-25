-- ============================================
-- UPDATE DATABASE PHOTO IT
-- File ini untuk update database yang sudah ada
-- Jalankan file ini jika database sudah dibuat sebelumnya
-- ============================================

-- Pastikan menggunakan database yang benar
-- USE photo_it;

-- ============================================
-- 1. BUAT TABEL SESSIONS (jika belum ada)
-- ============================================
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX sessions_user_id_index (user_id),
    INDEX sessions_last_activity_index (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 1.1 BUAT TABEL CACHE (jika belum ada)
-- ============================================
CREATE TABLE IF NOT EXISTS cache (
    `key` VARCHAR(255) NOT NULL PRIMARY KEY,
    value MEDIUMTEXT NOT NULL,
    expiration INT NOT NULL,
    INDEX cache_expiration_index (expiration)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cache_locks (
    `key` VARCHAR(255) NOT NULL PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INT NOT NULL,
    INDEX cache_locks_expiration_index (expiration)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 2. BUAT TABEL GALLERY_CATEGORIES (jika belum ada)
-- ============================================
CREATE TABLE IF NOT EXISTS gallery_categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE COMMENT 'Nama kategori, contoh: City, Wedding, Portrait',
    slug VARCHAR(100) NOT NULL UNIQUE COMMENT 'URL slug, contoh: city, wedding, portrait',
    description TEXT NULL COMMENT 'Deskripsi kategori',
    display_order INT DEFAULT 0 COMMENT 'Urutan tampil di navbar',
    is_active TINYINT(1) DEFAULT 1 COMMENT '1 = aktif ditampilkan di navbar',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 3. TAMBAHKAN KOLOM category_id KE gallery_items
-- ============================================
-- Cek apakah kolom sudah ada, jika belum tambahkan
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'gallery_items' 
    AND COLUMN_NAME = 'category_id'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE gallery_items ADD COLUMN category_id BIGINT UNSIGNED NULL COMMENT ''ID kategori (opsional, bisa null)'' AFTER id',
    'SELECT ''Kolom category_id sudah ada'' AS message'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- ============================================
-- 4. TAMBAHKAN FOREIGN KEY (jika belum ada)
-- ============================================
-- Hapus foreign key lama jika ada (untuk menghindari error)
SET @fk_name = (
    SELECT CONSTRAINT_NAME 
    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'gallery_items' 
    AND COLUMN_NAME = 'category_id' 
    AND REFERENCED_TABLE_NAME = 'gallery_categories'
    LIMIT 1
);

SET @sql = IF(@fk_name IS NOT NULL, 
    CONCAT('ALTER TABLE gallery_items DROP FOREIGN KEY ', @fk_name),
    'SELECT 1'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Tambahkan foreign key baru
ALTER TABLE gallery_items 
ADD FOREIGN KEY (category_id) REFERENCES gallery_categories(id) ON DELETE SET NULL;

-- ============================================
-- 5. INSERT DATA CONTOH KATEGORI (jika belum ada)
-- ============================================
-- Hanya insert jika kategori belum ada
INSERT IGNORE INTO gallery_categories (category_name, slug, description, display_order, is_active) VALUES
('City', 'city', 'Foto-foto kota dan urban', 1, 1),
('Wedding', 'wedding', 'Foto pernikahan', 2, 1),
('Portrait', 'portrait', 'Foto portrait', 3, 1),
('Event', 'event', 'Dokumentasi acara', 4, 1);

-- ============================================
-- SELESAI
-- ============================================
-- Setelah menjalankan file ini:
-- 1. Tabel gallery_categories sudah dibuat
-- 2. Kolom category_id sudah ditambahkan ke gallery_items
-- 3. Foreign key sudah dibuat
-- 4. Data contoh kategori sudah diinsert
-- 
-- Sekarang admin bisa:
-- - Menambah kategori baru di admin panel
-- - Menambah foto dan memilih kategori
-- ============================================

