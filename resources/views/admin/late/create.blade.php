@extends('layouts.template')
@section('content')

<div class="judul">
    <h1>Tambah Data Keterlambatan</h1>
    <p style="color: grey;">Home / Data Keterlambatan / <span>Tambah Data Keterlambatan</span></p>
</div>
    <form action="{{ route('late.store') }}" method="POST" class="card p-5" enctype="multipart/form-data">
        @csrf
        @if (Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }}</div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        <div class="mb-3 row">
            <label for="siswa_id" class="col-sm-2 col-form-label">Siswa :</label>
            <div class="col-sm-10">
                <select name="siswa_id" id="siswa_id" class="form-select">
                    <option selected hidden disabled>Pilih</option>
                    @foreach ($student as $item)  
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
               </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-label">Tanggal :</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" name="date_time_late" id="date_time_late">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label">Keterangan Keterlambatan :</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="information" name="information">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label">Bukti :</label>
            <div class="col-sm-10">
            <input type="file" class="form-control" id="bukti" name="bukti">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection