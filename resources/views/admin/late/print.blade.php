<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
  <a href="">Cetak (.pdf)</a>
    <center>
        <h1>SURAT PERNYATAAN</h1>
        <h1>TIDAK AKAN DATANG TERLAMBAT KE SEKOLAH</h1>
    </center>
    <div class="content">
        @foreach ($late as $item)
        <p>Yang bertanda tangan dibawah ini:</p>
        <p>NIS : {{ $item->student->nis }}</p>
        <p>Nama : {{ $item->student->name }}</p>
        <p>Rombel : {{ $item->student->rombel }}</p>
        <p>Rayon : {{ $item->student->rayon }}</p>
        <br><br><br><br>
        <p>Dengan ini menyatakan bahwa saya telah melakukan 
        pelanggaran tata tertib sekolah, yaitu terlambat datang 
        ke sekolah sebanyak <b>3 kali</b> yang mana hal tersebut termasuk 
        kedalam pelanggaran kedisiplinan. Saya berjanji tidak akan 
        terlambat datang ke sekolah lagi. Apabila saya terkambat 
        datang ke sekolah lagi saya siap diberi sanki yang sesuai 
        dengan peraturan sekolah.</p>
        <br><br>
        <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan</p>

        <div class="flex">
           
        </div>

        
<div class="container text-center">
    <div class="row justify-content-evenly">
        <div class="col-4">
            <p>Peserta Didik, </p>
            <br><br><br><br>
            <p>( {{ $item->student->name }} )</p>
        </div>

        <div class="col-4">
          <p>Bogor, {{ $item['date-time-late'] }}</p>
          <p>Orang Tua/Wali Peserta Didik,</p>
          <br><br><br><br>
          <p>(............)</p>
        </div>
      </div>
    <div class="row justify-content-evenly mt-7">
        <div class="col-4">
          <p>Pembimbing Siswa,</p>
          <br><br><br><br>
         <p>( {{$item->student->name }})</p>
        </div>

        <div class="col-4">
          <p>Kesiswaan,</p>
          <br><br><br><br>
          (............)
        </div>
      </div>
</div>

            
        @endforeach
    </div>
</body>
</html>