<!DOCTYPE html>
<html>

<head>

    <title>Registro</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <script src="public/js/jquery-4.0.0.min.js"></script>
    <script src="public/js/register.js"></script>

</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card p-4 shadow" style="width: 350px;">

        <h2 class="text-center mb-3">Registro</h2>

        <form id="formRegister">

            <input
                class="form-control mb-2"
                name="username"
                id="username"
                placeholder="Usuario">

            <input
                type="password"
                class="form-control mb-2"
                name="password"
                id="password"
                placeholder="Contraseña">

            <button type="submit" class="btn btn-primary w-100">
                Registrarse
            </button>

        </form>

        <div id="mensaje" class="mt-3 text-center"></div>

    </div>

</body>

</html>