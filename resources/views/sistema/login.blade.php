<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>

<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center">
            <div class="col-md-5 align-self-center">
                <form method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="mb-3">
                        <label for="txtUsuario" class="form-label">Email</label>
                        <input type="email" class="form-control" id="txtUsuario" name="txtUsuario">
                    </div>
                    <div class="mb-3">
                        <label for="txtClave" class="form-label">Clave</label>
                        <input type="password" class="form-control" id="txtClave" name="txtClave">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('sistema.signin') }}">¿No tenés cuenta? Registrate.</a>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    $(window).on('load', function() {
        $('body').height($(window).height());
    });

    $(window).on('resize', function() {
        $('body').height($(window).height());
    });
</script>

</html>
