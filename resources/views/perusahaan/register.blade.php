<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Perusahaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            background-color: #fafafa;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 24px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            width: 30%;
            padding: 40px 30px;
            text-align: center;
            height: fit-content;
            margin: auto;
            margin-top: 1%;
        }

        .cardimg {
            height: 125.76px;
            width: 56px;
            padding-top: 10px;
            margin: auto;
        }

        .koneksibilitas {
            justify-items: center;
            margin-top: 5%;
        }

        .p {
            font-weight: bold;
            text-align: center;
        }

        .form-control {
            margin: 0 auto;
            border-radius: 10px;
            font-size: 14px;
        }

        .form-check-label {
            font-size: 12px;
        }

        .form-check {
            font-size: 12px;
            color: #555;
            text-align: left;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 24px;
            width: 100%;
            padding: 10px;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-outline-primary {
            border-radius: 24px;
            width: 100%;
            padding: 10px;
            font-weight: 600;
            font-size: 14px;
            margin-top: 8px;
        }

        .penyedia-kerja {
            font-size: 10px;
            margin-top: 5%;
        }
    </style>
</head>

<body>
    <div class="card">
        <img src="{{ asset('assets/img/woman-wheelchair.png') }}" class="cardimg">

        <div class="koneksibilitas">
            <a class="navbar-brand d-flex gap-2" href="/">
                <span class="text-primary fs-4">✦</span>
                <span class="brand">KONEKSIBILITAS</span>
            </a>
        </div>

        <p class="p">Daftar Sebagai Penyedia Kerja</p>

        <div class="card-body">
            <form action="{{ route('register-perusahaan.process') }}" method="POST">
                @csrf

                <!-- EMAIL (SAMA PERSIS) -->
                <div class="input-group mb-3">
                    <span class="input-group-text">@</span>
                    <input type="email" class="form-control" name="email" placeholder="Email Perusahaan" required>
                </div>

                <!-- NAMA PERUSAHAAN (PAKAI ICON PERSON SAMA) -->
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4" />
                        </svg>
                    </span>
                    <input type="text" class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan"
                        required>
                </div>

                <!-- ALAMAT (PAKAI STYLE INPUT BIASA) -->
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person">
                            <path d="M8 8a3 3 0 1 0 0-6" />
                        </svg>
                    </span>
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat Perusahaan" required>
                </div>

                <!-- NPWP -->
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person">
                            <path d="M8 8a3 3 0 1 0 0-6" />
                        </svg>
                    </span>
                    <input type="text" class="form-control" name="nomor_npwp" placeholder="Nomor NPWP" required>
                </div>

                <!-- PASSWORD (ICON SAMA) -->
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-eye">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5" />
                        </svg>
                    </span>
                    <input type="password" class="form-control" name="password" placeholder="Password" required
                        autocomplete="new-password">
                </div>

                <!-- KONFIRMASI -->
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-eye">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5" />
                        </svg>
                    </span>
                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="Konfirmasi Password" required autocomplete="new-password">
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" required>
                    <label class="form-check-label">
                        Dengan lanjut, Anda setuju pada Ketentuan, Privasi, dan Cookie KoneksiBilitas
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>

            <a href="{{ route('login-perusahaan') }}" class="btn btn-outline-primary">Sign In</a>

            <p class="penyedia-kerja">
                Daftar sebagai pencari kerja?
                <a href="{{ route('register') }}">Pencari kerja</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if ($errors->any())
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += '{{ $error }}<br>';
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Periksa Inputan Anda',
                html: errorMessages
            });
        @endif
    </script>

</body>

</html>
