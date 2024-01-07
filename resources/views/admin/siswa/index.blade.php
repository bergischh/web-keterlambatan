@extends('layouts.template')
@section('content')

    @if (Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif
    @if (Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif 

    <div class="judul">
        <h1>Data Siswa</h1>
        <p style="color: grey;">Home / <span>Data Siswa</span></p>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a class="btn btn-primary" href="{{ route('siswa.create') }}">Tambah Pengguna</a>
    </div>      
    <br>
    <div class="container text-center">
        <div class="row">
          <div class="col-sm">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($student->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $student->previousPageUrl() }}">&laquo;</a></li>
                    @endif
                    @if ($student->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $student->nextPageUrl() }}">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    @endif
                </ul>
            </nav>
            
          </div>
          <div class="col-sm">
            <form action="{{ route('siswa.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-outline-primary">Kembali</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    <br>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Rombel</th>
            <th>Rayon</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($student as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['nis'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item->rombel->rombel }}</td>
                <td>{{ $item->rayon->rayon }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('siswa.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                    <form action="{{ route('siswa.delete', $item['id']) }}" method="POST">
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
@endsection