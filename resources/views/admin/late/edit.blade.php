@extends('layouts.template')

@section('content')
<div class="judul">
    <h1>Edit Data Keterlambatan</h1>
    <p style="color: grey;">Home / Data Keterlambatan / <span>Edit Data Keterlambatan</span></p>
</div>
    <form action="{{ route('late.update', $late->id) }}" method="POST" class="card p-5" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
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
            <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late" value="{{ $late['date_time_late'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label">Informasi :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="information" id="information" value="{{ $late['information'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label">Bukti :</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="bukti" id="bukti" value="{{ $late['bukti'] }}">
            </div>
            @if ($late->bukti)
            <img id="bukti" src="{{ asset('storage/' .$late['bukti']) }}" alt="Bukti Gambar" style="margin-top: 2rem; margin-left: 9.5rem; width: 200px; border-radius: 5px;" >
            @endif

        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection