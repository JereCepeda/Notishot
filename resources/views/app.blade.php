<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" >
    <link rel="preconnect" href="https://fonts.bunny.net">
    <style>
        .p-5 { padding: 3rem!important; margin-right: auto; margin-left: auto; max-width: max-content; }
    </style>
    
</head>
<body>
    <div class="header">
        @include('layout/header')
        @include('layout/navbar')
        @yield('content')
        @include('layout/footer')
    </div>
</body>
</html>
