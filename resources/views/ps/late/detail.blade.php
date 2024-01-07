@extends('layouts.template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        span {
            color: blue
        }
        img {
            width: 180px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="page-heading">
        <h3>Detail Keterlambatan Siswa</h3>
    </div>
    <div class="container text-center">
        <div class="row">
            @php $no = 1; @endphp
            @foreach ($late as $item)
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Keterlambatan ke-{{ $no++ }}</h5>
                        <p class="card-text"><b>{{ $item->date_time_late }}</b></p>
                        <p><span>{{ $item->information }}</span></p>
                        <img id="bukti" src="{{ asset('storage/' .$item->bukti) }}" alt="Bukti Gambar">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>

@endsection
