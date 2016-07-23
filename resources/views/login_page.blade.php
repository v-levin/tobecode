<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#message").delay(3000).fadeTo(2000, 0);
        });
    </script>

</head>
<style>
    body {
        padding: 5em;
    }
</style>

<body>

<form action="{{ action('UsersController@welcome') }}" method="post">
    <div class="col-md-4"></div>
    <div class="col-md-4">

        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username" value="{{ Input::old('username') }}">
            @if ($errors->has('username')) <p class="alert alert-danger">{{ $errors->first('username') }}</p> @endif
            @if ($errors->has('wrongUsr')) <p class="alert alert-danger">{{ $errors->first('wrongUsr') }}</p> @endif
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            @if ($errors->has('password')) <p class="alert alert-danger">{{ $errors->first('password') }}</p> @endif
            @if ($errors->has('wrongPass')) <p class="alert alert-danger">{{ $errors->first('wrongPass') }}</p> @endif
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
        <a class="btn btn-default btn pull-right" href="/registration" role="button">Sign up now</a>

    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
</body>
</html>
