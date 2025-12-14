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
      width: 360px;
      padding: 40px 30px;
      text-align: center;
      height: 93%;
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

    <p class="p">Masuk Sebagai Pekerja</p>
    
    <div class="card-body">

      <form id="form"  action="{{ route('home') }}">
        <div class="mb-3" >
          <input type="email" class="form-control" id="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="password" placeholder="Password" required>
        </div>

        <div class= "form-check">
          <input type="checkbox" class="form-check-input" id="checkbox" required>
          <label class="form-check-label" for="exampleCheck1">Dengan lanjut, Anda setuju pada Ketentuan, Privasi, dan Cookie KoneksiBilitas</label>
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
      </form>
      <a href="#" class="btn btn-outline-primary">Sign Up</a>

      <p class = "penyedia-kerja">Masuk sebagai Penyedia Kerja? <a href="{{ route('login-perusahaan') }}">Penyedia kerja</a></p>
    </div>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>