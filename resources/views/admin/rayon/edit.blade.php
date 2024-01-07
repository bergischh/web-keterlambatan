@extends('layouts.template')

@section('content')
<div class="judul">
    <h1>Edit Data Rayon</h1>
    <p style="color: grey;">Home / Data Rayon / <span>Edit Data Rayon</span></p>
</div>
    <form action="{{ route('rayon.update', $rayon['id']) }}" method="POST" class="card p-5">
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
            <label for="rayon" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="rayon" id="rayon" value="{{ $rayon['rayon'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">Pebimbing Siswa :</label>
            <div class="col-sm-10">
                <select name="user_id" id="user_id" class="form-select">
                    <option selected hidden disabled>Pilih</option>
                    @foreach ($user as $item)  
                       <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
               </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection