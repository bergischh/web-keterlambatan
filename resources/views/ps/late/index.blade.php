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
    <br>
    <a class="btn btn-info" href="{{ route('late.export-require') }}">Export Excel</a>
    <br><br>
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
            <form action="{{ route('ps.late.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    <a href="{{ route('ps.late.index') }}" class="btn btn-outline-primary">Kembali</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('ps.late.index') }}">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('ps.late.recap') }}">Rekapitulasi Data</a>
        </li>
      </ul>
    <br>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Informasi</th>
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
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
