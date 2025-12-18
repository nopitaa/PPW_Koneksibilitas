<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KONEKSIBILITAS | Login</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f5f7fa;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      width: 400px;
      border-radius: 20px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
      padding: 2.5rem 2rem;
      background: #fff;
    }

    .login-image {
      width: 180px;
      margin-bottom: 15px;
    }

    .brand-text {
      color: #007bff;
      font-weight: 700;
      font-size: 14px;
    }

    .title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 1.5rem;
    }

    .title span {
      color: #007bff;
    }

    .input-group-text {
      background-color: #f1f3f5;
      border-right: 0;
      border-radius: 10px 0 0 10px;
    }

    .form-control {
      border-left: 0;
      border-radius: 0 10px 10px 0;
      padding: 10px;
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #ced4da;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      padding: 10px;
      font-weight: 600;
    }

    .btn-outline-primary {
      border-radius: 999px;
      padding: 10px;
    }

    .form-check-label {
      font-size: 13px;
    }

    .password-toggle {
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="login-card text-center">

  <!-- Logo -->
  <img src="{{ asset('login.png') }}" class="login-image" alt="Login">

  <div class="title">
    Masuk sebagai <span>Admin</span>
  </div>

  <!-- Form -->
  <form>
    <!-- Email -->
    <div class="mb-3 input-group">
      <span class="input-group-text">
        <i class="bi bi-at"></i>
      </span>
      <input type="email" class="form-control" placeholder="Email">
    </div>

    <!-- Password -->
    <div class="mb-3 input-group">
      <span class="input-group-text">
        <i class="bi bi-lock"></i>
      </span>
      <input type="password" id="password" class="form-control" placeholder="Password">
      <span class="input-group-text password-toggle" onclick="togglePassword()">
        <i id="eyeIcon" class="bi bi-eye"></i>
      </span>
    </div>

    <!-- Checkbox -->
    <div class="form-check text-start mb-3">
      <input class="form-check-input" type="checkbox" id="terms">
      <label class="form-check-label" for="terms">
        Dengan lanjut, anda setuju pada ketentuan, privasi, dan cookie koneksibilitas
      </label>
    </div>

    <!-- Button -->
    <button type="button"
      onclick="window.location.href='{{ route('dashboard') }}'"
      class="btn btn-primary w-100 rounded-pill mb-2">
      Login
    </button>

  </form>
</div>

<script>
  function togglePassword() {
    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (password.type === 'password') {
      password.type = 'text';
      eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
      password.type = 'password';
      eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
    }
  }
</script>

</body>
</html>
