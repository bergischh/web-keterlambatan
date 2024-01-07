@extends('layouts.template')

@section('content')
<div class="judul">
    <h1>Data Rayon</h1>
    <p style="color: grey;">Home / <span>Data Rayon</span></p>
</div>
    <div class="container mt-3">
        @if (Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
        @endif
        @if (Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
        @endif
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a class="btn btn-primary" href="{{ route('rayon.create') }}">Tambah Data</a>
        </div>      
        <br>
        <div class="container text-center">
            <div class="row">
              <div class="col-sm">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        @if ($rayon->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $rayon->previousPageUrl() }}">&laquo;</a></li>
                        @endif
                        @if ($rayon->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $rayon->nextPageUrl() }}">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </nav>
                
              </div>
              <div class="col-sm">
                <form action="{{ route('rayon.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search..." name="search">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        <a href="{{ route('rayon.index') }}" class="btn btn-outline-primary">Kembali</a>
                    </div>
                </form>
              </div>
            </div>
          </div>
        <br>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">No </th>
                <th>Rayon</th>
                <th>Pebimbing Siswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rayon as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->rayon }}</td>
                    <td>
                        {{ $item->user->name }}
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('rayon.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <form action="{{ route('rayon.delete', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Hapus
                            </button>
                        </form>     
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection