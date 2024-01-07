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
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 0 auto;
        }
        .card {
            width: 18rem;
            margin-bottom: 20px;
            border: none;
            border: 1px solid #ddd; 
            border-radius: 8px; 
            padding: 15px; 
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); 
            transition: 0.3s; 
        }
        .card-body {
            text-align: left;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .card-text {
            margin-bottom: 0.5rem;
        }
        .card-image {
            width: 100%;
            border-radius: 5px;
        }
        .card-title {
            color: rgb(34, 34, 114);
        }
    </style>
</head>
<body class="bg-light">
    <div class="judul">
        <h1>Detail Data Keterlambatan</h1>
        <p style="color: grey;">Home / Data Keterlambatan / <span>Detail Data Keterlambatan</span></p>
    </div><br>
    <div class="container">
        <div class="card-container">
            @php $no = 1; @endphp
            @foreach ($late as $item)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Keterlambatan ke-{{ $no++ }}</h5>
                    <p class="card-text"><b>{{ $item->date_time_late }}</b></p>
                    <p style="color: blue">{{ $item->information }}</p>
                    <img class="card-image" src="{{ asset('storage/' . $item->bukti) }}" alt="Bukti Gambar">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
@endsection
