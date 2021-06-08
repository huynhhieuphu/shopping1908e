<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('test/css/bootstrap.min.css')}}">
    @stack('stylesheet')
</head>
<body>
<div class="container-fluid">
    {{-- load header view --}}
    @include('test/partials/header_view')

    {{-- load narbar view --}}
    @include('test/partials/navbar_view')

    <div class="row">
        <div class="col">
            <main style="min-height: 500px">
                {{-- load các nội dung các layout con vào đây --}}
                @yield('content')
            </main>
        </div>
    </div>

    {{-- load footer view --}}
    @include('test/partials/footer_view')
</div>
<script src="{{asset('test/js /jquery-3.5.1.slim.min.js')}}"></script>
@stack('scriptCode')
</body>
</html>
