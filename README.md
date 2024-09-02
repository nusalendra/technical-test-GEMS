Requirements :
1. PHP Version : > 8.2.22
2. Laravel Framework Version : > 11.9
3. NPM Version : 10.5.0
4. Node Version : 20.11.0

Langkah Instalasi :

1. Clone proyek dari repository.
2. Jalankan "composer install" untuk menginstal dependensi PHP.
3. Gunakan "npm install" dan "npm run dev" untuk menginstal dan mengkompilasi dependensi JavaScript.
4. Ubah nama file .env.example menjadi .env, lalu sesuaikan database.
5. Generate APP KEY dengan perintah "php artisan key:generate".
6. Jalankan server dengan perintah php artisan serve.
7. Gunakan "--seed" saat migrasi database agar data dapat masuk untuk login user dengan role Manajer

Alur Bisnis Aplikasi    :
1. Langkah pertama adalah login sebagai pengguna dengan peran Manajer menggunakan username "budierwandi" dan password "budierwandi." Setelah login, Manajer dapat menambahkan data posisi perusahaan.
2. Manajer kemudian dapat menambahkan data karyawan dengan mengisi informasi seperti nama, username, password, dan posisi karyawan tersebut. Setelah data karyawan berhasil ditambahkan, karyawan tersebut dapat melakukan login ke dalam sistem.
3. Karyawan memiliki opsi untuk mengajukan lembur dengan mengisi form yang mencakup tanggal lembur, jam mulai, jam selesai, durasi (yang dihitung secara otomatis dari jam mulai hingga jam selesai), pekerjaan yang dilakukan, serta mengunggah file gambar tanda tangan sebagai bukti pengajuan.
4. Manajer dapat melihat semua pengajuan lembur yang diajukan oleh karyawan, dan dapat memberikan keputusan dengan aksi "setuju" atau "tolak" terhadap pengajuan tersebut.
5. Jika pengajuan disetujui, Manajer wajib mengunggah file gambar tanda tangan. Sistem kemudian secara otomatis menghasilkan dokumen PDF (menggunakan dompdf) dan menyimpannya di penyimpanan.
6. Jika pengajuan ditolak, karyawan akan menerima notifikasi yang menginformasikan bahwa pengajuan lembur mereka ditolak.
7. Jika pengajuan disetujui, karyawan akan menerima notifikasi bahwa pengajuan mereka disetujui dan akan dapat mengunduh dokumen PDF yang telah dihasilkan. Dokumen tersebut berisi detail pengajuan lembur serta tanda tangan persetujuan dari kedua belah pihak.
8. Aplikasi juga menyediakan dashboard yang menampilkan beberapa chart, antara lain:
    - Chart pengajuan lembur berdasarkan status (Setuju, Tolak, Menunggu Persetujuan).
    - Chart durasi lembur berdasarkan karyawan
    - Chart pengajuan lembur per bulan

Database Design
![Uploading drawSQL-image-export-2024-09-02.png…]()
