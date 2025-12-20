<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KONEKSIBILITAS | Login</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .btn-primary {
      background-color: #007bff;
      border: none;
      padding: 10px;
      font-weight: 600;
    }

    .password-toggle {
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="login-card text-center">

  <img src="{{ asset('login.png') }}" class="login-image" alt="Login">

  <div class="title">
    Masuk sebagai <span>Admin</span>
  </div>

  {{-- ALERT ERROR --}}
  <div id="alertTerms" class="alert alert-danger d-none">
    Silakan centang persetujuan terlebih dahulu sebelum login.
  </div>

  {{-- VALIDASI BACKEND --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      {{ $errors->first() }}
    </div>
  @endif

  <form method="POST" action="{{ route('admin.login') }}">
    @csrf

    <!-- Email -->
    <div class="mb-3 input-group">
      <span class="input-group-text">
        <i class="bi bi-at"></i>
      </span>
      <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>

    <!-- Password -->
    <div class="mb-3 input-group">
      <span class="input-group-text">
        <i class="bi bi-lock"></i>
      </span>
      <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
      <span class="input-group-text password-toggle" onclick="togglePassword()">
        <i id="eyeIcon" class="bi bi-eye"></i>
      </span>
    </div>

    <!-- Checkbox -->
    <div class="form-check text-start mb-3">
      <input class="form-check-input" type="checkbox" id="terms" name="terms">
      <label class="form-check-label" for="terms">
        Dengan lanjut, anda setuju pada ketentuan, privasi, dan cookie koneksibilitas
      </label>
    </div>

    <!-- Button -->
    <button type="submit" id="loginBtn"
      class="btn btn-primary w-100 rounded-pill mb-2" disabled>
      Login
    </button>

  </form>
</div>

<script>
  const terms = document.getElementById('terms');
  const loginBtn = document.getElementById('loginBtn');
  const alertTerms = document.getElementById('alertTerms');

  terms.addEventListener('change', function () {
    loginBtn.disabled = !this.checked;
    if (this.checked) {
      alertTerms.classList.add('d-none');
    }
  });

  document.querySelector('form').addEventListener('submit', function (e) {
    if (!terms.checked) {
      e.preventDefault();
      alertTerms.classList.remove('d-none');
    }
  });

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
