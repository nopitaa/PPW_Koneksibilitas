# 📱 API Documentation - Mobile App

## Base URL
```
http://localhost:8000/api
```

## Authentication

API ini menggunakan **Laravel Sanctum** untuk token-based authentication. Setelah login/register, Anda akan menerima token yang harus disertakan di header setiap request yang memerlukan autentikasi.

### Header untuk Authenticated Requests
```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

---

## 🔓 Public Endpoints (Tidak Perlu Authentication)

### 1. Register User
**POST** `/api/register`

**Request Body:**
```json
{
    "email": "user@example.com",
    "nama_depan": "John",
    "nama_belakang": "Doe",
    "jenis_kelamin": "Laki-laki",
    "password": "Password123!"
}
```

**Response (201):**
```json
{
    "success": true,
    "message": "Registrasi berhasil",
    "token": "1|xxxxxxxxxxxxx",
    "user": {
        "id": 1,
        "email": "user@example.com",
        "nama_depan": "John",
        "nama_belakang": "Doe",
        "nama_lengkap": "John Doe",
        "jenis_kelamin": "Laki-laki"
    }
}
```

---

### 2. Login
**POST** `/api/login`

**Request Body:**
```json
{
    "email": "user@example.com",
    "password": "Password123!"
}
```

**Response (200):**
```json
{
    "success": true,
    "message": "Login berhasil",
    "token": "1|xxxxxxxxxxxxx",
    "user": {
        "id": 1,
        "email": "user@example.com",
        "nama_depan": "John",
        "nama_belakang": "Doe",
        "nama_lengkap": "John Doe",
        "jenis_kelamin": "Laki-laki"
    }
}
```

**Error Response (401):**
```json
{
    "success": false,
    "message": "Email atau password salah"
}
```

---

### 3. List Lowongan (Public)
**GET** `/api/lowongan`

**Query Parameters:**
- `search` (optional) - Search by posisi
- `kategori` (optional) - Filter by kategori pekerjaan
- `perusahaan_id` (optional) - Filter by perusahaan
- `per_page` (optional, default: 15) - Items per page

**Example:**
```
GET /api/lowongan?search=developer&kategori=IT&per_page=10
```

**Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "lowongan_id": 1,
            "posisi": "Web Developer",
            "kategori_pekerjaan": "IT",
            "persyaratan": "...",
            "perusahaan": {
                "perusahaan_id": 1,
                "nama_perusahaan": "PT Example",
                "alamat": "...",
                "email": "..."
            },
            "created_at": "2025-01-01 10:00:00",
            "approved_at": "2025-01-01 11:00:00"
        }
    ],
    "pagination": {
        "current_page": 1,
        "last_page": 5,
        "per_page": 15,
        "total": 75
    }
}
```

---

### 4. Detail Lowongan
**GET** `/api/lowongan/{id}`

**Response (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "posisi": "Web Developer",
        "kategori_pekerjaan": "IT",
        "persyaratan": "...",
        "perusahaan": {
            "id": 1,
            "nama": "PT Example",
            "alamat": "...",
            "email": "..."
        },
        "created_at": "2025-01-01 10:00:00",
        "approved_at": "2025-01-01 11:00:00"
    }
}
```

---

### 5. List Keterampilan
**GET** `/api/keterampilan`

**Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nama": "Web Development"
        },
        {
            "id": 2,
            "nama": "Mobile Development"
        }
    ]
}
```

---

## 🔒 Protected Endpoints (Perlu Authentication)

### 6. Get Current User
**GET** `/api/me`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "user": {
        "id": 1,
        "email": "user@example.com",
        "nama_depan": "John",
        "nama_belakang": "Doe",
        "nama_lengkap": "John Doe",
        "jenis_kelamin": "Laki-laki"
    }
}
```

---

### 7. Logout
**POST** `/api/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "message": "Logout berhasil"
}
```

---

### 8. Get Profile
**GET** `/api/profile`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "data": {
        "name": "John Doe",
        "subtitle": "Web Developer",
        "about": "Saya adalah seorang web developer...",
        "skills": ["PHP", "Laravel", "JavaScript"],
        "avatar_url": "http://localhost:8000/storage/profiles/avatar.jpg",
        "cv_url": "http://localhost:8000/storage/profiles/cv.pdf",
        "resume_url": "http://localhost:8000/storage/profiles/resume.pdf",
        "portfolio_url": "http://localhost:8000/storage/profiles/portfolio.zip"
    }
}
```

---

### 9. Update Profile
**PUT** `/api/profile`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "name": "John Doe Updated",
    "subtitle": "Senior Web Developer",
    "about": "Updated about me...",
    "skills": ["PHP", "Laravel", "JavaScript", "Vue.js"]
}
```

**Response (200):**
```json
{
    "success": true,
    "message": "Profile berhasil diperbarui",
    "data": {
        "name": "John Doe Updated",
        "subtitle": "Senior Web Developer",
        "about": "Updated about me...",
        "skills": ["PHP", "Laravel", "JavaScript", "Vue.js"]
    }
}
```

---

### 10. Upload Avatar
**POST** `/api/profile/avatar`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
avatar: [file] (image, max 2MB)
```

**Response (200):**
```json
{
    "success": true,
    "message": "Avatar berhasil diupload",
    "avatar_url": "http://localhost:8000/storage/profiles/avatar.jpg"
}
```

---

### 11. Upload CV
**POST** `/api/profile/cv`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
cv: [file] (pdf, doc, docx, max 2MB)
```

**Response (200):**
```json
{
    "success": true,
    "message": "CV berhasil diupload",
    "cv_url": "http://localhost:8000/storage/profiles/cv.pdf"
}
```

---

### 12. Get Profile Skills
**GET** `/api/profile/skills`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nama": "Web Development"
        }
    ]
}
```

---

### 13. Get My Lamaran
**GET** `/api/lamaran`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "lowongan": {
                "id": 1,
                "posisi": "Web Developer",
                "perusahaan": "PT Example"
            },
            "nama_lengkap": "John Doe",
            "email": "user@example.com",
            "status": "pending",
            "created_at": "2025-01-01 10:00:00"
        }
    ]
}
```

---

### 14. Get Detail Lamaran
**GET** `/api/lamaran/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "lowongan": {
            "id": 1,
            "posisi": "Web Developer",
            "kategori": "IT",
            "persyaratan": "...",
            "perusahaan": {
                "id": 1,
                "nama": "PT Example"
            }
        },
        "nama_lengkap": "John Doe",
        "jenis_kelamin": "Laki-laki",
        "nomor_hp": "081234567890",
        "alamat_lengkap": "...",
        "email": "user@example.com",
        "pendidikan": "S1",
        "nama_institusi": "Universitas Example",
        "jurusan": "Teknik Informatika",
        "th_start": 2018,
        "th_end": 2022,
        "alat_bantu": "Tidak ada",
        "cv_url": "http://localhost:8000/storage/lamaran/cv/cv.pdf",
        "resume_url": "http://localhost:8000/storage/lamaran/resume/resume.pdf",
        "portofolio_url": "http://localhost:8000/storage/lamaran/portofolio/portfolio.zip",
        "created_at": "2025-01-01 10:00:00"
    }
}
```

---

### 15. Create Lamaran
**POST** `/api/lamaran`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
lowongan_id: 1
nama_lengkap: John Doe
jenis_kelamin: Laki-laki
nomor_hp: 081234567890
alamat_lengkap: Jl. Example No. 123
email: user@example.com
pendidikan: S1
nama_institusi: Universitas Example
jurusan: Teknik Informatika
th_start: 2018
th_end: 2022
alat_bantu: Tidak ada
cv: [file] (pdf, doc, docx, max 2MB) - Required jika tidak ada di profile
resume: [file] (pdf, doc, docx, max 2MB) - Optional
portofolio: [file] (pdf, doc, docx, zip, max 5MB) - Optional
```

**Response (201):**
```json
{
    "success": true,
    "message": "Lamaran berhasil dikirim",
    "data": {
        "id": 1,
        "lowongan_id": 1
    }
}
```

---

### 16. Get User Keterampilan
**GET** `/api/user/keterampilan`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nama": "Web Development"
        }
    ]
}
```

---

### 17. Sync User Keterampilan
**POST** `/api/user/keterampilan`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "keterampilan_ids": [1, 2, 3]
}
```

**Response (200):**
```json
{
    "success": true,
    "message": "Keterampilan berhasil disinkronkan",
    "data": [
        {
            "id": 1,
            "nama": "Web Development"
        },
        {
            "id": 2,
            "nama": "Mobile Development"
        },
        {
            "id": 3,
            "nama": "UI/UX Design"
        }
    ]
}
```

---

## Error Responses

### 401 Unauthorized
```json
{
    "message": "Unauthenticated."
}
```

### 404 Not Found
```json
{
    "success": false,
    "message": "Resource tidak ditemukan"
}
```

### 422 Validation Error
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email field is required."
        ]
    }
}
```

---

## Catatan Penting

1. **Token Storage**: Simpan token dengan aman di mobile app (misalnya menggunakan secure storage)
2. **Token Expiry**: Token tidak memiliki expiry default, tapi bisa dikonfigurasi di `.env`
3. **File Upload**: Untuk upload file, gunakan `multipart/form-data` bukan `application/json`
4. **Base URL**: Ganti `http://localhost:8000` dengan URL production saat deploy
5. **Pagination**: Default pagination adalah 15 items per page
6. **CV Requirement**: CV wajib diupload saat lamaran jika tidak ada di profile

---

## Testing dengan Postman/Insomnia

1. **Register/Login** untuk mendapatkan token
2. Copy token dari response
3. Set header: `Authorization: Bearer {token}`
4. Test endpoint lainnya

---

