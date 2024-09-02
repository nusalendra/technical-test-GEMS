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
1. Langkah pertama adalah melakukan login sebagai pengguna dengan peran Manajer menggunakan username "budierwandi" dan password "budierwandi," kemudian menambahkan data posisi perusahaan.
2. Tambah data karyawan dengan mengisikan name, username, password, dan posisi karyawan tersebut. Selesai menambahkan, maka karyawan dapat login.
3. Karyawan dapat melakukan pengajuan lembur dengan mengisikan tanggal lembur, jam mulai, jam selesai, durasi (secara otomatis dihitung dari jam mulai - jam selesai), pekerjaan, dan saat mengajukan lembur diwajibkan mengupload file image tanda tangan.
4. Manajer dapat melihat pengajuan lembur karyawan sekaligus memberikan aksi "setuju" atau "tolak" pengajuan tersebut.
5. Apabila pengajuan disetujui, maka Manajer diwajibkan untuk upload file image tanda tangan dan sistem secara otomatis generate pdf (menggunakan dompdf) dan menyimpan di storage.
6. Dan apabila pengajuan ditolak, maka Karyawan akan mendapatkan notifikasi pesan bahwa pengajuan ditolak.
7. Kembali pada pengajuan disetujui oleh Manajer, maka menerima notifikasi pesan bahwa pengajuan disetujui dan karyawan mampu mengunduh dokumen pdf yang sudah di generate sebelumnya yang di dalamnya terdapat data pengajuan lembur dan persetujuan tanda tangan dari kedua belah pihak.
8. Terdapat dashboard yang menampilkan chart diantaranya : 
    - Chart pengajuan lembur berdasarkan status (Setuju, Tolak, Menunggu Persetujuan).
    - Chart durasi lembur berdasarkan karyawan
    - Chart pengajuan lembur per bulan
