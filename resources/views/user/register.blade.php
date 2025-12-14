<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>

    body{
      background-color: #fafafa;
      font-family: 'Plus Jakarta Sans', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .card{
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

    .koneksibilitas{
      justify-items: center;
      margin-top:5%;
    }

    .p{
      font-weight: bold;
      text-align: center;
    }

    .form-control{
      margin: 0 auto;
      border-radius: 10px;
      font-size: 14px;
    }

    .form-check-label{
      font-size: 12px;
      flex-direction: column; /* Stacks items vertically first */
      flex-wrap: wrap;       /* Wraps items into new columns */
      max-height: 50px;
    }

    .form-check{
      font-size: 12px;
      color: #555;
      text-align: left;
      margin-bottom: 20px;
    }

    .btn-primary{
      background-color: #007bff;
      border: none;
      border-radius: 24px;
      width: 100%;
      padding: 10px;
      font-weight: 600;
      font-size: 14px;
    }

    .btn-outline-primary{
      border-radius: 24px;
      width: 100%;
      padding: 10px;
      font-weight: 600;
      font-size: 14px;
      margin-top: 8px;
    }

    .penyedia-kerja{
      font-size: 10px;
      margin-top: 5%;
    }
  </style>
</head>
<body>
  <div class="card"> {{-- css gonna identified by class name, so make sure i remember each class name --}}
    <img src="{{asset('assets/img/woman-wheelchair.png')}}" class="cardimg" alt="..." style="align-center">
    <div class="koneksibilitas">
      <a class="navbar-brand d-flex gap-2" id="koneksibilitas"href="/">
        <span class="text-primary fs-4">✦</span>
        <span class="brand">KONEKSIBILITAS</span>
      </a>
    </div>  

    <p class="p">Daftar Sebagai Pekerja</p>
    
    <div class="card-body">

      <form id="form"  action="{{ route('register.process') }}" method="POST">
        @csrf

         <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">@</span>
          <input type="text" class="form-control" name="email" placeholder="Email" aria-describedby="basic-addon1" required>
        </div>


        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"></path>
            </svg>
          </span>
          <input type="text" class="form-control" name="nama_depan" placeholder="Nama Depan" aria-describedby="basic-addon1" required>
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"></path>
            </svg>
          </span>
          <input type="text" class="form-control" name="nama_belakang" placeholder="Nama Belakang" aria-describedby="basic-addon1" required>
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gender-ambiguous" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1H11.5zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z"/>
            </svg>
          </span>
          <select class="form-select" name="jenis_kelamin" aria-label="Pilih Jenis Kelamin">
            <option selected disabled>Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"></path>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"></path>
            </svg>
          </span>
          <input type="text" class="form-control" name="password" placeholder="Password" aria-describedby="basic-addon1" required>
        </div>
      
        <div class= "form-check">
          <input type="checkbox" class="form-check-input" id="checkbox" required>
          <label class="form-check-label" for="exampleCheck1">Dengan lanjut, Anda setuju pada Ketentuan, Privasi, dan Cookie KoneksiBilitas</label>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
      </form>
      <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign In</a>

      <p class = "penyedia-kerja">Masuk sebagai Penyedia Kerja? <a href="{{ route('login-perusahaan') }}">Penyedia kerja</a></p>
    </div>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>