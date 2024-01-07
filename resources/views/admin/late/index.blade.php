@extends('layouts.template')
@section('content')

    @if (Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif
    @if (Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif

    <div class="judul">
        <h1>Data Keterlambatan</h1>
        <p style="color: grey;">Home / <span>Data Keterlambatan</span></p>
    </div>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a class="btn btn-primary" href="{{ route('late.create') }}">Tambah Pengguna</a>
        <a class="btn btn-info" href="{{ route('late.export-require') }}">Export Excel</a>
    </div>
    <br>
    <div class="container text-center">
        <div class="row">
          <div class="col-sm">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($late->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $late->previousPageUrl() }}">&laquo;</a></li>
                    @endif
                    @if ($late->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $late->nextPageUrl() }}">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    @endif
                </ul>
            </nav>
            
          </div>
          <div class="col-sm">
            <form action="{{ route('late.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    <a href="{{ route('late.index') }}" class="btn btn-outline-primary">Kembali</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('late.index') }}">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('late.recap') }}">Rekapitulasi Data</a>
        </li>
      </ul>
    <br>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Informasi</th>
            {{-- <th>Bukti</th> --}}
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($late as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>
                    {{ $item->student->nis }} <br>
                    {{ $item->student->name }}
                </td>
                <td>{{ $item['date_time_late'] }}</td>
                <td>{{ $item['information'] }}</td>
                {{-- <td>{{ asset('storage/photo-user'.$item->bukti) }}</td> --}}
                <td class="d-flex justify-content-center">
                    <a href="{{ route('late.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                    <form action="{{ route('late.delete', $item['id']) }}" method="POST">
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
