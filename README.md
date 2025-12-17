# SANAPATI - Sistem Akuntabilitas dan Navigasi Kinerja Siber-Sandi Terintegrasi

Website "Pohon Kinerja BSSN 2025–2029" dengan treeview interaktif, drill-down detail Program/Kegiatan, dan indikator kinerja.

## Fitur Utama

- **Pohon Kinerja Interaktif**: Visualisasi hierarki UO -> Int.O -> Imm.O -> Sasaran (SS/SP/SK).
- **Detail Drill-down**: Panel informasi lengkap mencakup Indikator Kinerja (IKSS/IKP/IKK) dan Unit Penanggung Jawab.
- **Pencarian & Filter**: Cari node berdasarkan nama/indikator dan filter berdasarkan Unit Kerja.
- **Backend Laravel**: API modern untuk menyajikan data tree terstruktur.
- **Frontend Modern**: Antarmuka Responsif dengan Tailwind CSS dan Alpine.js.

## Cara Menjalankan

### Prasyarat
- PHP 8.2+
- Composer
- Node.js & NPM
- Database (MySQL/MariaDB/SQLite)

### Instalasi

1. **Clone & Install Dependencies**
   ```bash
   composer install
   npm install
   ```

2. **Konfigurasi Database**
   Salin `.env.example` ke `.env` dan atur koneksi database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Migrasi & Seeding Data**
   Jalankan migrasi dan seeder untuk mengisi data pohon kinerja (sumber: `storage/app/tree/tree.json`).
   ```bash
   php artisan migrate --seed --class=PerformanceTreeSeeder
   ```
   *Catatan: Jika ingin memperbarui data, edit `python/generate_tree_dummy.py`, jalankan script python tersebut untuk update `tree.json`, lalu jalankan seeder ulang.*

4. **Jalankan Aplikasi**
   Jalankan server pengembangan Laravel dan Vite.
   ```bash
   php artisan serve
   npm run dev
   ```

5. **Akses Website**
   Buka browser dan kunjungi: [http://127.0.0.1:8000/pohon-kinerja](http://127.0.0.1:8000/pohon-kinerja)

## Struktur Data & Update

- **Source of Truth**: `python/generate_tree_dummy.py` (Script generator data).
- **JSON Data**: `storage/app/tree/tree.json` (Output generator, dibaca oleh Seeder).
- **Database Schema**:
  - `performance_nodes`: Tabel hierarki utama (UO, Int.O, SS, SP, dll).
  - `performance_indicators`: Indikator kinerja terkait (IKp, IKK, dll).
  - `units`: Unit kerja (D1, D2, dll).

Jika ada perubahan pada PDF/Dokumen Pohon Kinerja:
1. Update logika di `python/generate_tree_dummy.py`.
2. Generate JSON baru: `python python/generate_tree_dummy.py`.
3. Seed ulang database: `php artisan db:seed --class=PerformanceTreeSeeder`.

## API Endpoints

- `GET /api/pohon-kinerja`: Mendapatkan seluruh pohon kinerja (nested).
- `GET /api/pohon-kinerja/{code}`: Detail node spesifik.
- `GET /api/pohon-kinerja/search?q={query}`: Pencarian node.
