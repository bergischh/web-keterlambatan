@extends('layouts.template')

@section('content')

<div class="judul">
    <h1>Edit Data Rombel</h1>
    <p style="color: grey;">Home / Data Rombel / <span>Edit Data Rombel</span></p>
</div>

    <form action="{{ route('rombel.update', $rombel['id']) }}" method="POST" class="card p-5">
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
            <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="rombel" id="rombel" value="{{ $rombel['rombel'] }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection