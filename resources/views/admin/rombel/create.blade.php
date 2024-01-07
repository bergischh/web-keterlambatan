@extends('layouts.template')
@section('content')

<div class="judul">
    <h1>Tambah Data Rombel</h1>
    <p style="color: grey;">Home / Data Rombel / <span>Tambah Data Rombel</span></p>
</div>

    <form action="{{ route('rombel.store') }}" method="POST" class="card p-5">
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
            <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="rombel" id="rombel">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection