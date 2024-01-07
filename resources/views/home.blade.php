@extends('layouts.template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .card {
            height: 120px;
        }
        span {
            color: rgb(85, 80, 80);
        }
    </style>
</head>
<body class="bg-light">
    <h1 style="margin-left: 1rem">Dashboard</h1>
    <p style="margin-left: 1rem; color: grey;">Home/ <span>Dashboard</span></p>
    <div class="container text-center">
        <div class="row row-cols-4">
          <div class="col-6">
            <div class="card" style="border: none;">
                <div class="card-body">
                    <h5 style="text-align: left">Peserta Didik</h5>
                    <div class="d-flex mb-3">
                        <div class="p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>
                        </div>
                        <div class="p-2"><h1>{{ App\models\Student::where('id', '!=', '')->count() }}</h1></div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col">
            <div class="card" style="border: none;">
                <div class="card-body">
                    <h5 style="text-align: left">Administrator</h5>
                    <div class="d-flex mb-3">
                        <div class="p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>
                        </div>
                        <div class="p-2"><h1>{{ App\models\User::where('role', 'administrator')->count() }}</h1></div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col">
            <div class="card" style="border: none;">
                <div class="card-body">
                    <h5 style="text-align: left">Pebimbing Siswa</h5>
                    <div class="d-flex mb-3">
                        <div class="p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>
                        </div>
                        <div class="p-2"><h1>{{ App\models\User::where('role', 'pembimbingsiswa')->count() }}</h1></div>
                    </div>
                </div>
              </div>
          </div>
          <div class="col-6 mt-3">
            <div class="card" style="border: none;">
                <div class="card-body">
                    <h5 style="text-align: left">Rombel</h5>
                    <div class="d-flex mb-3">
                        <div class="p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>
                        </div>
                        <div class="p-2"><h1>{{ App\models\Student::where('id', '!=', '')->count() }}</h1></div>
                    </div>
                </div>
              </div>
          </div>
          <div class="col-6 mt-3">
            <div class="card" style="border: none;">
                <div class="card-body">
                    <h5 style="text-align: left">Rayon</h5>
                    <div class="d-flex mb-3">
                        <div class="p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>
                        </div>
                        <div class="p-2"><h1>{{ App\models\Rayon::where('id', '!=', '')->count() }}</h1></div>
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
</body>
</html>
@endsection
