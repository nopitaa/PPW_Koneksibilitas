<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Lowongan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .container-lowongan {
            max-width: 700px;
            margin: 60px auto;
            background-color: white;
            position: relative;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 0 10px;
        }

        .back-icon, .save-icon {
            font-size: 24px;
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .judul-halaman {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            flex-grow: 1;
            margin: 0;
        }

        .card-lowongan {
            border: none;
            background: transparent;
        }

        .header-lowongan {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo-lowongan {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }

        .nama-posisi {
            font-size: 20px;
            font-weight: 600;
            line-height: 1.2;
        }

        .nama-perusahaan {
            color: #555;
            font-size: 16px;
        }

        .section-title {
            font-weight: 600;
            font-size: 18px;
            margin-top: 20px;
        }

        .persyaratan {
            white-space: pre-line;
            margin-top: 5px;
        }

        .btn-lamar {
            display: block;
            width: 250px;
            margin: 60px auto 0;
            background-color: #007bff;
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-lamar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container-lowongan">
        <div class="top-bar">
            <a href="#" class="back-icon"><i class="bi bi-arrow-left"></i></a>
            <h2 class="judul-halaman">Informasi Lowongan</h2>
            <i class="bi bi-bookmark save-icon" id="saveIcon"></i>
        </div>

        <div class="card-lowongan">
            <div class="header-lowongan">
                <img src="assets/logo.png" alt="Logo" class="logo-lowongan">
                <div>
                    <div class="nama-posisi">Admin Sosial Media</div>
                    <div class="nama-perusahaan">GlobalTrans Indo</div>
                </div>
            </div>

            <div class="section-title">Lowongan tersedia</div>
            <div>Customer Support Specialist</div>

            <div class="section-title mt-3">Persyaratan Lowongan</div>
            <div class="persyaratan">
                FreshGraduate atau memiliki pengalaman minimal 1th
                Siap bekerja dibawah tekanan
                Pelamar wajib melampirkan dokumen pendukung seperti CV dan Portofolio.
            </div>

            <button class="btn-lamar">Lamar Pekerjaan</button>
        </div>
    </div>

    <script>
        const saveIcon = document.getElementById('saveIcon');
        saveIcon.addEventListener('click', () => {
            saveIcon.classList.toggle('bi-bookmark');
            saveIcon.classList.toggle('bi-bookmark-fill');
        });
    </script>

</body>
</html>
