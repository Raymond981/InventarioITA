<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
 
    <title>Importar base de datos</title>
    
    <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-weight: 100;
        height: 100vh;
        margin: 0;
        padding: 5%
    }
</style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">
            Impotar archivos
        </h2>
 
 
<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    Elije archivo Archivo : <input type="file" name="file" class="form-control">
 
    <input type="submit" class="btn btn-primary btn-lg" style="margin-top: 3%">
</form>
 
</div>
</body>
</html>