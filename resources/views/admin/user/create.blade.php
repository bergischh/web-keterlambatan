@extends('layouts.template')
@section('content')

<div class="judul">
    <h1>Tambah Data User</h1>
    <p style="color: grey;">Home / Data User / <span>Tambah Data User</span></p>
</div>
    <form action="{{ route('user.store') }}" method="POST" class="card p-5">
        @csrf
        {{-- @csrf harus ada jika memakai method POST untuk kepentingan security website  --}}

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
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Tipe Pengguna :</label>
            <div class="col-sm-10">
                <select name="role" id="role" class="form-select">
                    <option selected disable hidden>Pilih</option>
                    <option value="administrator">administrator</option>
                    <option value="pembimbingsiswa">pebimbing-siswa</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password :</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection
