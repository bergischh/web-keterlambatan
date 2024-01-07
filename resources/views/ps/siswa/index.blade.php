@extends('layouts.template')
@section('content')

    @if (Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif
    @if (Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    <br>
    <div class="judul">
        <h1>Data Siswa</h1>
        <p style="color: grey;">Home / <span>Data Siswa</span></p>
    </div>
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
            <form action="{{ route('ps.siswa.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    <a href="{{ route('ps.siswa.index') }}" class="btn btn-outline-primary">Kembali</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    <br>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Rombel</th>
            <th>Rayon</th>
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
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
