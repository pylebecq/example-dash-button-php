<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="bg-grey-lighter">
<div class="container mt-12">
    @yield('content')
</div>
</body>
</html>
