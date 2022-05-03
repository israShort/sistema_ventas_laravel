<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
</head>

<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center">
            <div class="col-md-6 align-self-center">
                @if (isset($msg))
                    <div id="msg"></div>
                    <script>
                        msgShow(`{{ $msg['msg'] }}`, `{{ $msg['status'] }}`);
                    </script>
                @endif
                <form method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="txtNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="txtApellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="txtApellido" name="txtApellido">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="txtMail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="txtMail" name="txtMail">
                    </div>
                    <div class="mb-3">
                        <label for="txtClave" class="form-label">Clave</label>
                        <div class="input-group">
                            <input type="password" class="form-control " id="txtClave" name="txtClave"
                                aria-label="Clave" aria-describedby="view-password">
                            <span class="input-group-text" id="view-password"><i class="bi bi-eye-fill"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="txtClaveR" class="form-label">Repetir clave</label>
                        <div class="input-group">
                            <input type="password" class="form-control " id="txtClaveR" name="txtClaveR"
                                aria-label="Repetir clave" aria-describedby="view-password1">
                            <span class="input-group-text" id="view-password1"><i class="bi bi-eye-fill"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                    <a href="{{ route('sistema.login') }}">¿Tenés cuenta? Inicia sesión.</a>
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
