<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('test/css/bootstrap.min.css')}}">
</head>
<body>
{{--  comment blade template  --}}

<main>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
                <h1 class="text-center text-secondary">Login</h1>
                <form action="{{route('test.login')}}" method="post" class="border rounded p-3">
                    @csrf
                    {{-- @csrf để có token gửi lên - vì đây là method post --}}
                    <div class="form-group">
                        <label for="txtUserName">Username:</label>
                        <input type="text" name="txtUserName" id="txtUserName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtPassword">Password:</label>
                        <input type="password" name="txtPassword" id="txtPassword" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnLogin">Login</button>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="{{asset('test/js/jquery-3.5.1.slim.min.js')}}"></script>
</body>
</html>
