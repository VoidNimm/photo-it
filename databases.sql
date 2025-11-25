-- ============================================
-- DATABASE PHOTO IT - SIMPLE PHOTOGRAPHER BOOKING
-- Struktur sederhana untuk pemula
-- ============================================

-- Hapus database jika sudah ada (opsional, hati-hati!)
-- DROP DATABASE IF EXISTS photo_it;
-- CREATE DATABASE photo_it;
-- USE photo_it;

-- ============================================
-- 1. TABEL USERS (untuk admin)
-- ============================================
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 1.1 TABEL SESSIONS (untuk session Laravel)
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
-- 1.2 TABEL CACHE (untuk cache Laravel)
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
-- 2. TABEL GALLERY_CATEGORIES (Kategori untuk Navbar)
-- ============================================
CREATE TABLE IF NOT EXISTS gallery_categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE COMMENT 'Nama kategori: City, Wedding, Portrait, dll',
    slug VARCHAR(100) NOT NULL UNIQUE COMMENT 'URL slug: city, wedding, portrait',
    display_order INT DEFAULT 0 COMMENT 'Urutan di navbar',
    is_active TINYINT(1) DEFAULT 1 COMMENT '1 = aktif',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 3. TABEL GALLERY_ITEMS (Foto Gallery)
-- ============================================
CREATE TABLE IF NOT EXISTS gallery_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NULL COMMENT 'ID kategori (opsional)',
    title VARCHAR(255) NOT NULL COMMENT 'Judul foto',
    image_path VARCHAR(255) NOT NULL COMMENT 'Path gambar: gallery/photo1.jpg',
    display_order INT DEFAULT 0 COMMENT 'Urutan tampil',
    is_featured TINYINT(1) DEFAULT 0 COMMENT '1 = tampil di homepage',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (category_id) REFERENCES gallery_categories(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 4. TABEL SERVICES (Layanan Fotografi)
-- ============================================
CREATE TABLE IF NOT EXISTS services (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(255) NOT NULL COMMENT 'Nama layanan: Wedding, Portrait, Event',
    description TEXT NULL COMMENT 'Deskripsi singkat',
    price DECIMAL(10,2) NULL COMMENT 'Harga',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 5. TABEL TESTIMONIALS (Testimoni Pelanggan)
-- ============================================
CREATE TABLE IF NOT EXISTS testimonials (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(255) NOT NULL COMMENT 'Nama pelanggan',
    client_title VARCHAR(255) NULL COMMENT 'Jabatan: CEO, Designer, dll',
    client_image VARCHAR(255) NULL COMMENT 'Path foto pelanggan',
    rating INT DEFAULT 5 COMMENT 'Rating 1-5',
    review_text TEXT NOT NULL COMMENT 'Isi testimoni',
    is_featured TINYINT(1) DEFAULT 0 COMMENT '1 = tampil di homepage',
    is_approved TINYINT(1) DEFAULT 0 COMMENT '1 = sudah disetujui',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 6. TABEL CONTACT_MESSAGES (Pesan dari Form)
-- ============================================
CREATE TABLE IF NOT EXISTS contact_messages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL COMMENT 'Nama pengirim',
    email VARCHAR(255) NOT NULL COMMENT 'Email pengirim',
    subject VARCHAR(255) NOT NULL COMMENT 'Subjek pesan',
    message TEXT NOT NULL COMMENT 'Isi pesan',
    phone VARCHAR(50) NULL COMMENT 'Nomor telepon',
    is_read TINYINT(1) DEFAULT 0 COMMENT '1 = sudah dibaca',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 7. TABEL BOOKINGS (Pemesanan/Booking)
-- ============================================
CREATE TABLE IF NOT EXISTS bookings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    booking_number VARCHAR(50) NOT NULL UNIQUE COMMENT 'Nomor booking: BK-2024-001',
    client_name VARCHAR(255) NOT NULL COMMENT 'Nama klien',
    client_email VARCHAR(255) NOT NULL COMMENT 'Email klien',
    client_phone VARCHAR(50) NOT NULL COMMENT 'Telepon klien',
    service_id BIGINT UNSIGNED NULL COMMENT 'ID layanan',
    event_date DATE NULL COMMENT 'Tanggal acara',
    location VARCHAR(255) NULL COMMENT 'Lokasi acara',
    notes TEXT NULL COMMENT 'Catatan',
    booking_status VARCHAR(50) DEFAULT 'pending' COMMENT 'pending, confirmed, completed, cancelled',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- DATA CONTOH (Sample Data)
-- ============================================

-- Insert contoh Kategori Gallery
INSERT INTO gallery_categories (category_name, slug, display_order, is_active) VALUES
('City', 'city', 1, 1),
('Wedding', 'wedding', 2, 1),
('Portrait', 'portrait', 3, 1),
('Event', 'event', 4, 1);

-- Insert contoh Layanan
INSERT INTO services (service_name, description, price) VALUES
('Wedding Photography', 'Foto pernikahan lengkap', 5000000),
('Portrait Photography', 'Foto portrait profesional', 1500000),
('Event Photography', 'Dokumentasi acara', 3000000),
('Product Photography', 'Foto produk', 2000000);

-- Insert contoh Gallery (dengan kategori)
INSERT INTO gallery_items (category_id, title, image_path, display_order, is_featured) VALUES
(1, 'City Photo 1', 'gallery/city1.jpg', 1, 1),
(1, 'City Photo 2', 'gallery/city2.jpg', 2, 1),
(2, 'Wedding Photo 1', 'gallery/wedding1.jpg', 3, 1),
(2, 'Wedding Photo 2', 'gallery/wedding2.jpg', 4, 0),
(3, 'Portrait Photo 1', 'gallery/portrait1.jpg', 5, 1),
(4, 'Event Photo 1', 'gallery/event1.jpg', 6, 0);

-- Insert contoh Testimoni
INSERT INTO testimonials (client_name, client_title, rating, review_text, is_featured, is_approved) VALUES
('Saul Goodman', 'CEO & Founder', 5, 'Hasil foto sangat memuaskan, profesional dan tepat waktu. Sangat direkomendasikan!', 1, 1),
('Sara Wilsson', 'Designer', 5, 'Pelayanan sangat baik, hasil foto sesuai ekspektasi. Terima kasih!', 1, 1),
('Jena Karlis', 'Store Owner', 5, 'Foto produk untuk toko saya sangat bagus, penjualan meningkat!', 1, 1);

-- ============================================
-- SELESAI
-- ============================================
-- Database sederhana untuk booking fotografer
-- 
-- Admin bisa:
-- 1. Menambah kategori gallery (muncul di navbar)
-- 2. Menambah foto gallery (untuk home & gallery page)
-- 3. Mengelola layanan (services)
-- 4. Mengelola testimoni
-- 5. Melihat pesan dari contact form
-- 6. Mengelola booking
-- ============================================
