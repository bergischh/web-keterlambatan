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
            border: none;
        }
        h1 {
            font-size: 65px;
        }
        .icon-dash svg {
            margin-right: 30px;
        }
        p {
            text-align: left;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container text-center">
        <div class="row row-cols-4">
          <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: left">Peserta Didik Rayon  {{ App\Models\Rayon::where('user_id', Auth::user()->id)->pluck('rayon')->first(); }}</h5>
                    <div class="d-flex mb-3">
                        <div class="p-2 icon-dash">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                  </svg>
                            </i>
                        </div>
                        @php 
                        $userId = Auth::user()->id;
                        $student = optional(App\Models\Rayon::where('user_id', $userId)->first())->student()->with('rombel', 'rayon')->simplePaginate(10);
                      @endphp
                      <h1>{{ $student->count() }}</h1>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
                <div class="card-body">
                    @php 
                    $userId = Auth::user()->id;
                    $rayonName = App\Models\Rayon::where('user_id', $userId)->pluck('rayon')->first();
                    // Menghitung keterlambatan per hari
                    $keterlambatan = App\Models\Late::whereHas('student.rayon', function ($query) use ($rayonName) {
                        $query->where('rayon', $rayonName);
                    })
                    ->selectRaw('DATE(created_at) as tanggal_keterlambatan, COUNT(*) as jumlah_keterlambatan')
                    ->groupBy('tanggal_keterlambatan')
                    ->get();
                    @endphp
            
                    <h5 style="text-align: left">Keterlambatan Siswa Rayon {{ $rayonName }}</h5>
                    @foreach ($keterlambatan as $item)
                    @php
                            $tanggal = date_create($item->tanggal_keterlambatan);
                            $format = date_format($tanggal, 'd F Y');
                    @endphp
                        <p>{{ $format}}</p>
                    @endforeach
                    <div class="d-flex mb-3">
                        <div class="p-2 icon-dash">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                            </i>
                        </div>
                        @foreach ($keterlambatan as $item)
                        <H1>{{ $item->jumlah_keterlambatan }}</H1>
                        @endforeach
                    </div>
                </div>
            </div>            
          </div>
        </div>
    </div>
</body>
</html>
@endsection
