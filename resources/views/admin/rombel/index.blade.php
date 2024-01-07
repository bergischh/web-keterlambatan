@extends('layouts.template')
@section('content')

    @if (Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif
    @if (Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif

    <div class="judul">
        <h1>Data Rombel</h1>
        <p style="color: grey;">Home / <span>Data Rombel</span></p>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a class="btn btn-primary" href="{{ route('rombel.create') }}">Tambah</a>
    </div>      
    <br>
    <div class="container text-center">
        <div class="row">
          <div class="col-sm">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($rombel->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $rombel->previousPageUrl() }}">&laquo;</a></li>
                    @endif
                    @if ($rombel->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $rombel->nextPageUrl() }}">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    @endif
                </ul>
            </nav>
            
          </div>
          <div class="col-sm">
            <form action="{{ route('rombel.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    <a href="{{ route('rombel.index') }}" class="btn btn-outline-primary">Kembali</a>
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
            <th>Rombel</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($rombel as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['rombel'] }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('rombel.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                    <form action="{{ route('rombel.delete', $item['id']) }}" method="POST">
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