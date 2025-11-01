# PPW_Koneksibilitas
Tugas Besar Matakuliah Web untuk projek koneksibilitas (aplikasi pencari kerja disabilitas)
## 🧭 Panduan Alur Kerja Kolaborasi
Agar kerja sama tetap rapi dan lancar, ikuti aturan berikut saat mengunggah atau memperbarui kode di repository ini.

## 📢!!WAJIB DI BACA!!📢

## ‼️Impelementasi menggunakan‼️ 
1. HTML -> Kerangka
2. CSS -> Styling
3. Bootstrap/Tailwind -> Framework CSS
4. JS -> Bahasa pemrog agar web interaktif
5. JQuery -> Library dari JS

###  🤝 1️ Clone & Update Repository
### Sebelum CLONE Koneksibilitas wajib
1. **Pastikan sudah ada web server (Laragon/Herd/XAMPP)**
2. **Pastikan sudah ada COMPOSER**

1. Bagi yg menggunakan XAMPP Folder Project **WAJIB DIDALAM C:Xampp/htdocs**
2. Create a new folder
3. In path on the top type "CMD"
4. Di cmd type **"git clone https://github.com/nopitaa/PPW_Koneksibilitas"**
5. Tunggu sampai finish, kemudian buka didalam VS CODE
6. Di vs code buka new terminal **pastikan route nya sudah sampai file laravel kalian ya gengs**
7. Kemudian di terminal kita perlu setting up ENV nya dimana wajib dimiliki sama project laravel type **"copy .env.example .env"**
8. Lanjut type **"php artisan key:generate"** di terminal vs code, gunanya untuk generate key, karna setiap project laravel itu punya keynya masing" dan itu **wajib dimiliki**
9. Udah deh selesai tinggal start projectnya dengan type **"php artisan serve"**
10. Note : karna belum ada DB nya jadi kita setting itu soon aja deh, yg penting FE udah selesai. Jadi nnti waktu kalian bikin FE itu kalian data statis ya gengs
Hehe semoga berhasill, semoga sih ngga ada yg kelewat yaa


### 📂 2. Gunakan Branch Masing-Masing
- Jangan langsung push ke `main`.  
- Buat branch baru dengan format:  nama-aksi-page (ex: Nopi-upoad-login_admin)
- Source buat push ke branch masing masing "git push origin Nopi-upload-login_admin"
- KALAU CONFLICT HATI HATI YA, PILIH CODINGAN YG PALING TEPAT!! Tapi kalau bingung bisa tanya PIC aja gapapa (Nana/Novita) untuk menyelesaikan conflictnya
- Setelah push di BRANCH masing" wajib langsung mergenya ke main, biar semua bisa langsung pull

  
### ✍️ 3. Gunakan Commit Message yang Jelas
Gunakan deskripsi format yang jelas agar bisa dipahami ada update terakhir contohnya:
- feat: tambah halaman profil bagian sidebar 
- fix: perbaiki bug pada form login
- update: ubah tampilan dashboard

### ✅ 4. Cek dan Tes Sebelum Push
Pastikan:
- Kode tidak error.  
- Fitur berjalan sesuai harapan.  
- Tidak mengubah bagian lain tanpa izin.
- Kalau emang urgent ada yang harus di ubah konfirmasi dlu ke org terkait
- Kalau ada konflik, langsung chat ke grup.  


