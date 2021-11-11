<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <header>@yield('cabecera')</header>
    <main>
        @yield('cuerpo')
        @section('fin_cuerpo')
        @show
    </main>
    <footer>@yield('pie')</footer>
    @yield('js')
</body>
</html>