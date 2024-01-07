<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            margin-top: 120px;
            margin-bottom: 120px;
            margin-left: 400px;
            margin-right: 400px;
        }
    </style>
</head>
<body>
    <form action="{{ route('login.auth') }}" class="card p-5" method="post">
        @csrf
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        @if (Session::get('logout'))
            <div class="alert alert-primary">{{ Session::get('logout') }}</div>
        @endif
        @if (Session::get('canAccess'))
            <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
        @endif
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">LOGIN</button>
    </form>
</body>
</html>
   
