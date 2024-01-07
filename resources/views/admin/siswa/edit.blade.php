@extends('layouts.template')

@section('content')

<div class="judul">
    <h1>Edit Data Siswa</h1>
    <p style="color: grey;">Home / Data Siswa / <span>Edit Data Siswa</span></p>
</div>

    <form action="{{ route('siswa.update', $student['id']) }}" method="POST" class="card p-5">
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
            <label for="nis" class="col-sm-2 col-form-label">Nis :</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="nis" name="nis" value="{{ $student['nis'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" value="{{ $student['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombel_id" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <select name="rombel_id" id="rombel_id" class="form-select">
                    <option selected hidden disabled>Pilih</option>
                    @foreach ($rombel as $item)  
                       <option value="{{ $item->id }}">{{ $item->rombel }}</option>
                    @endforeach
               </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rayon_id" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
                <select name="rayon_id" id="rayon_id" class="form-select">
                    <option selected hidden disabled>Pilih</option>
                    @foreach ($rayon as $item)  
                       <option value="{{ $item->id }}">{{ $item->rayon }}</option>
                    @endforeach
               </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection