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
        <a class="btn btn-secondary" href="{{ route('late.create') }}">Tambah Pengguna</a>
    </div>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('late.index') }}">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  active" href="{{ route('late.recap') }}">Rekapitulasi Data</a>
        </li>
      </ul>
    <br>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Jumlah Keterlambatan</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if ($late->count() > 0)
        @php $no = 1; @endphp
        @foreach ($late as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->student->nis }}</td>
                <td>{{ $item->student->name }}</td>
                <td>{{ $item->total_late}}</td>
                <td><a href="{{ route('late.recap.detail', ['siswa_id' => $item->siswa_id]) }}">Lihat</a><td>
                @if ($item->total_late >= 3)
                <td>
                    <a class="btn btn-primary" href="{{ route('late.recap.download', ['id' => $item->id]) }}">Cetak Surat Pernyataan</a>
                </td> 
                @endif
            </tr>
        @endforeach
    </tbody>
    {{ $late->links() }}
    @endif
</table>
@endsection
