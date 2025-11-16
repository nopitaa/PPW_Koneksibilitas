<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KONEKSIBILITAS | Login Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      width: 380px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      background: white;
    }
    .login-image {
      width: 100px;
      display: block;
      margin: 0 auto 10px auto;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-outline-primary {
      border-radius: 10px;
    }
  </style>
</head>
<body>

  <div class="login-card text-center">

    <!-- Gambar login -->
    <img src="{{ asset('login.png') }}" alt="Login Image" class="login-image">

    <!-- Judul -->
    <p class="fw-semibold mb-4">
        Masuk sebagai <span class="text-primary fw-bold">Admin</span>
    </p>

    <!-- FORM LOGIN -->
    <form method="POST" action="{{ route('admin.login.submit') }}">
      @csrf

      <div class="mb-3 input-group">
        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>

      <div class="mb-3 input-group">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>

      <div class="form-check text-start mb-3">
        <input class="form-check-input" type="checkbox" id="terms">
        <label class="form-check-label small" for="terms">
          Dengan lanjut, anda setuju pada ketentuan, privasi, dan cookie koneksibilitas
        </label>
      </div>

      <!-- Tombol Login -->
      <button type="submit" class="btn btn-primary w-100 mb-2 rounded-pill">
        Login
      </button>

    </form>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.js"></script>
</body>
</html>
