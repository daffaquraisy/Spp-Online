## SPP Online
Di sini saya akan membuat Aplikasi berbasis web untuk pembayaran SPP secara online yang memudahkan si user agar bisa melakukan pembayaran dimanapun dan kapanpun. K0204017900347

## Tools
- VS Code (IDE)
- Web Server (XAMPP)
- LARAVEL (PHP)
- Internet

## Alur Aplikasi
Siswa akan register akun baru, login, dan akan langsung di arah kan ke halaman pembayaran, siswa akan di minta memasukan nama dan nominal untuk melakukan pembayaran, payment gateway yang di gunakan untuk melakukan transaksi dengan Midtrans memungkinkan kita untuk menampilkan Pop Up portal pembayaran pada halaman web kita, dan akan diurus secara otomatis untuk pembayarannya oleh midtrans.

## Fitur
- Mangement User (ADMIN, PETUGAS)
  
Admin dan Petugas bisa dengan leluasa mengubah, menambahkan, bahkan menghapus akun users.

- Management Kelas (ADMIN, PETUGAS)
  
Untuk menambahkan kelas apa saja yang ada di sekolah tersebut.

- Management Siswa (ADMIN, PETUGAS)
  
Untuk nambahkan siswa mana saja yang mempunyai tagihan SPP di tahun tersebut dengan nominal nya.

- Management SPP (ADMIN, PETUGAS)

Membuat informasi harga untuk spp di setiap tahun nya.

- Pembayaran (ADMIN, SISWA, PETUGAS)
  
Pembayaran siswa bisa membayar dimana saja dengan menggunakan layanan pembayaran yang tersedia seperti Gopay, BCA, Mandiri, Alfamart, Indomart, Visa, Master Card dll.

- Generate Laporan (ADMIN, PETUGAS)
  
Merekap semua histori pembayaran dalam bentuk file excel.

## Penggunaan Aplikasi
```
- composer install
- php artisan db:seed --class=AdministratorSeeder / bisa import menggunakan file sql yang tersedia.
- php artisan serve
  ```
