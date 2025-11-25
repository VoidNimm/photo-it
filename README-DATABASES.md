# 📦 PhotoFolio Database Package - README

## 🎯 Ringkasan Paket Database

Paket database ini dirancang khusus untuk website portfolio fotografi **PhotoFolio** Anda. Semua table, kolom, dan relasi telah disesuaikan dengan konten dan fitur yang ada di website Anda berdasarkan analisis mendalam terhadap setiap halaman HTML.

---

## 📂 File-File yang Disertakan

### 1. **database.sql** (MySQL/MariaDB)

File database utama untuk MySQL dan MariaDB.

**Isi:**

- 13 tabel utama dengan struktur lengkap
- Sample data sesuai konten website Anda
- Indexes untuk optimasi query
- Views untuk reporting
- Stored procedures untuk operasi umum
- Foreign keys dan constraints

**Penggunaan:**

```bash
mysql -u root -p < database.sql
```

---

### 2. **database_postgresql.sql** (PostgreSQL)

File database alternatif untuk PostgreSQL dengan fitur advanced.

**Isi:**

- Struktur yang sama dengan versi MySQL
- Menggunakan PostgreSQL-specific features (ENUM types, Functions)
- Better support untuk complex queries
- Advanced indexing strategies

**Penggunaan:**

```bash
psql -U postgres -d postgres -f database_postgresql.sql
```

---

### 3. **DATABASE_DOCUMENTATION.md**

Dokumentasi lengkap tentang struktur database.

**Isi:**

- Penjelasan detail untuk setiap tabel
- Daftar kolom dan tipe data
- Entity Relationship Diagram (ERD)
- Sample queries
- Stored procedures documentation
- Security best practices
- Tips untuk troubleshooting

---

### 4. **QUERY_EXAMPLES.md**

Panduan lengkap dengan contoh-contoh SQL query dan integrasi backend.

**Isi:**

- SQL Query Examples untuk setiap tabel
- PHP/Backend integration code
- REST API Endpoints
- Transaction & Error Handling
- Security tips

---

## 🏗️ Struktur Database (13 Tabel)

```
┌─────────────────────────────────────────────────────┐
│  USERS                                              │
│  Profil fotografer/owner website                    │
└─────────────────────────────────────────────────────┘
         ↓
┌─────────────────────────────────────────────────────┐
│  GALLERY_CATEGORIES          SETTINGS               │
│  Kategori galeri             Konfigurasi website    │
└─────────────────────────────────────────────────────┘
         ↓
┌─────────────────────────────────────────────────────┐
│  GALLERY_ITEMS                                      │
│  Foto-foto di galeri                                │
└─────────────────────────────────────────────────────┘
         ↓                    ↓
    ┌────────────┐    ┌──────────────┐
    │ ALBUMS     │    │ ALBUM_ITEMS  │
    │ Koleksi    │    │ (Junction)   │
    └────────────┘    └──────────────┘

┌─────────────────────────────────────────────────────┐
│  SERVICES                    PRICING                │
│  Layanan fotografi          Detail harga            │
└─────────────────────────────────────────────────────┘
         ↓
┌─────────────────────────────────────────────────────┐
│  BOOKINGS                                           │
│  Pemesanan dari klien                               │
└─────────────────────────────────────────────────────┘
         ↓
┌─────────────────────────────────────────────────────┐
│  TRANSACTIONS                                       │
│  Log pembayaran                                     │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  TESTIMONIALS                                       │
│  Review & rating klien                              │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  CONTACT_MESSAGES                                   │
│  Pesan dari contact form                            │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  VISITORS                                           │
│  Analytics & tracking pengunjung                    │
└─────────────────────────────────────────────────────┘
```

---

## 📊 Data yang Sesuai dengan Website

### Gallery Categories (Dari Menu Dropdown)

- ✅ Nature (Alam)
- ✅ People (Orang)
- ✅ Architecture (Arsitektur)
- ✅ Animals (Hewan)
- ✅ Sports (Olahraga)
- ✅ Travel (Perjalanan)

### Services & Pricing (Dari Halaman Services)

| Layanan                | Harga | Durasi   |
| ---------------------- | ----- | -------- |
| Portrait Photography   | $160  | 1-2 jam  |
| Fashion Photography    | $300  | 3-4 jam  |
| Sports Photography     | $200  | 2-3 jam  |
| Still Life Photography | $120  | 1 jam    |
| Wedding Photography    | $500  | 8-10 jam |
| Photojournalism        | $200  | 4-6 jam  |

### Testimonials (Dari Halaman About/Services)

- ✅ Saul Goodman (CEO & Founder) - 5 stars
- ✅ Sara Wilsson (Designer) - 5 stars
- ✅ Jena Karlis (Store Owner) - 5 stars
- ✅ Matt Brandon (Freelancer) - 5 stars
- ✅ John Larson (Entrepreneur) - 5 stars

### Contact Form Fields (Dari Halaman Contact)

- ✅ Name
- ✅ Email
- ✅ Subject
- ✅ Message
- ✅ Phone (Optional)

### Photographer Profile (Dari Halaman About)

- ✅ Nama: Jenny Wilson
- ✅ Email: jenny@photofolio.com
- ✅ Phone: +1 (555) 123-4567
- ✅ Kota: New York, USA
- ✅ Birthday: 1 May 1995
- ✅ Degree: Master
- ✅ Freelance: Available

---

## 🚀 Quick Start Guide

### Langkah 1: Pilih Database Engine

- **MySQL/MariaDB**: Gunakan `database.sql`
- **PostgreSQL**: Gunakan `database_postgresql.sql`

### Langkah 2: Import Database

#### MySQL:

```bash
mysql -u root -p photofolio_db < database.sql
```

#### PostgreSQL:

```bash
psql -U postgres -f database_postgresql.sql
```

### Langkah 3: Buat Database User (Opsional tapi Recommended)

#### MySQL:

```sql
CREATE USER 'photofolio_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON photofolio_db.* TO 'photofolio_user'@'localhost';
FLUSH PRIVILEGES;
```

#### PostgreSQL:

```sql
CREATE USER photofolio_user WITH PASSWORD 'strong_password';
GRANT ALL PRIVILEGES ON DATABASE photofolio_db TO photofolio_user;
```

### Langkah 4: Verify Database

```sql
SHOW TABLES;  -- atau \dt di PostgreSQL
SELECT * FROM users;
SELECT * FROM services;
SELECT * FROM testimonials;
```

---

## 💻 Integrasi dengan Backend

### PHP MySQLi

```php
<?php
$mysqli = new mysqli("localhost", "photofolio_user", "strong_password", "photofolio_db");

// Get featured gallery
$result = $mysqli->query("SELECT * FROM gallery_items WHERE is_featured = TRUE");
$gallery = $result->fetch_all(MYSQLI_ASSOC);
?>
```

### PHP PDO

```php
<?php
$pdo = new PDO(
    "mysql:host=localhost;dbname=photofolio_db",
    "photofolio_user",
    "strong_password"
);

$stmt = $pdo->query("SELECT * FROM services WHERE id = ?");
$stmt->execute([1]);
$service = $stmt->fetch(PDO::FETCH_ASSOC);
?>
```

### Node.js

```javascript
const mysql = require("mysql");
const connection = mysql.createConnection({
  host: "localhost",
  user: "photofolio_user",
  password: "strong_password",
  database: "photofolio_db",
});

connection.query("SELECT * FROM gallery_items", (err, results) => {
  if (err) throw err;
  console.log(results);
});
```

---

## 🔍 Useful Queries

### Dashboard Statistics

```sql
-- Total gallery items
SELECT COUNT(*) as total_gallery FROM gallery_items;

-- Gallery by category
SELECT gc.category_name, COUNT(gi.id) as count
FROM gallery_categories gc
LEFT JOIN gallery_items gi ON gc.id = gi.category_id
GROUP BY gc.id;

-- Recent bookings
SELECT * FROM bookings ORDER BY created_at DESC LIMIT 10;

-- Total revenue
SELECT SUM(price) as total_revenue FROM transactions
WHERE transaction_status = 'Completed';

-- Unread messages
SELECT COUNT(*) as unread FROM contact_messages WHERE is_read = FALSE;
```

---

## 📈 Database Management Tips

### 1. **Regular Backup**

```bash
# MySQL
mysqldump -u root -p photofolio_db > backup_$(date +%Y%m%d).sql

# PostgreSQL
pg_dump photofolio_db > backup_$(date +%Y%m%d).sql
```

### 2. **Monitor Performance**

```sql
-- Slow query log (MySQL)
SET GLOBAL slow_query_log = 'ON';
SET GLOBAL long_query_time = 2;
```

### 3. **Archive Old Data**

```sql
-- Archive old transactions
INSERT INTO transactions_archive
SELECT * FROM transactions
WHERE transaction_date < DATE_SUB(NOW(), INTERVAL 1 YEAR);

DELETE FROM transactions
WHERE transaction_date < DATE_SUB(NOW(), INTERVAL 1 YEAR);
```

### 4. **Maintenance**

```sql
-- MySQL optimization
OPTIMIZE TABLE gallery_items;
ANALYZE TABLE bookings;

-- PostgreSQL maintenance
VACUUM FULL;
REINDEX DATABASE photofolio_db;
```

---

## 🔒 Security Checklist

- [ ] Change default passwords
- [ ] Use strong passwords (minimum 12 characters)
- [ ] Enable SSL/TLS for database connections
- [ ] Implement prepared statements in code
- [ ] Regular backups
- [ ] Monitor database logs
- [ ] Restrict database access by IP
- [ ] Use least privilege principle for database users
- [ ] Enable database audit logging
- [ ] Keep database engine updated

---

## 🐛 Common Issues & Solutions

### Issue: Connection Refused

**Solution:**

- Verifikasi database server berjalan
- Check host dan port yang benar
- Verify credentials

### Issue: Foreign Key Constraint Failed

**Solution:**

- Pastikan parent record sudah ada
- Check data type consistency
- Verify FK reference

### Issue: Slow Queries

**Solution:**

- Analyze query dengan EXPLAIN
- Add appropriate indexes
- Check query optimization

---

## 📞 Support & Customization

File-file ini dapat dikustomisasi sesuai kebutuhan:

- Tambah kolom baru pada tabel
- Modifikasi constraints
- Tambah tabel tambahan
- Buat stored procedures khusus
- Implement sharding/partitioning

---

## 🎓 Learning Resources

- [MySQL Documentation](https://dev.mysql.com/doc/)
- [PostgreSQL Documentation](https://www.postgresql.org/docs/)
- [SQL Tutorial](https://www.w3schools.com/sql/)
- [Database Design Best Practices](https://en.wikipedia.org/wiki/Database_design)

---

## ✅ Checklist Setup Awal

- [ ] Download semua file SQL dan dokumentasi
- [ ] Pilih database engine (MySQL atau PostgreSQL)
- [ ] Import database schema
- [ ] Buat database user dengan proper permissions
- [ ] Test connections dari aplikasi
- [ ] Verify semua tabel dan data sample
- [ ] Setup backup routine
- [ ] Configure monitoring/logging
- [ ] Document database credentials securely
- [ ] Plan for scaling/optimization

---

## 📝 Version History

| Version | Date         | Changes                                               |
| ------- | ------------ | ----------------------------------------------------- |
| 1.0.0   | Nov 13, 2025 | Initial release - Full database schema for PhotoFolio |

---

## 📄 License & Attribution

Database schema ini dibuat khusus untuk website PhotoFolio berdasarkan analisis konten website.

**Template Website:** PhotoFolio Bootstrap Template
**Original Author:** BootstrapMade.com
**Database Creator:** AI Assistant
**Date:** November 13, 2025

---

## 🤝 Feedback & Improvements

Jika ada saran atau pertanyaan tentang database schema ini, silakan lakukan:

1. **Review dokumentasi** - Baca DATABASE_DOCUMENTATION.md
2. **Check examples** - Lihat QUERY_EXAMPLES.md
3. **Test queries** - Run beberapa query di bagian query examples
4. **Customize** - Sesuaikan dengan kebutuhan spesifik Anda

---

**Last Updated: November 13, 2025**

**Happy coding! 🚀**
