@extends('layouts.template')

@section('content')
<div class="judul">
    <h1>Tambah Data Rayon</h1>
    <p style="color: grey;">Home / Data Rayon / <span>Tambah Data Rayon</span></p>
</div>
    <div class="container mt-3">
        <form action="{{ route('rayon.store') }}" class="card m-auto p-5" method="POST">
            @csrf

            @if ($errors->any())
                <ul class="alert alert-danger p-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            @if(Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @endif
            <div class="mb-3 row">
                <label for="rayon" class="col-sm-2 col-form-label">Rayon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="rayon" name="rayon">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="user_id" class="col-sm-2 col-form-label">Pebimbing Siswa</label>
                <div class="col-sm-10">
                    <select name="user_id" id="user_id" class="form-select">
                         <option selected hidden disabled>Pilih</option>
                         @foreach ($user as $item)  
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                         @endforeach
                    </select>
                </div>
            <button type="submit" class="btn btn-block btn-lg btn-primary">Tambah Data</button>
        </form>
    </div>
@endsection