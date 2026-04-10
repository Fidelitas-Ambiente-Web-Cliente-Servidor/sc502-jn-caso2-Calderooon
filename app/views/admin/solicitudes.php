<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Solicitudes pendientes</title>

    <link rel="stylesheet" href="public/css/style.css">

    <script src="public/js/jquery-4.0.0.min.js"></script>
    <script src="public/js/solicitud.js"></script>

</head>

<body>

    <nav class="nav">
        <div>
            <a href="index.php?page=talleres">Talleres</a>
            <a href="index.php?page=admin">Gestionar Solicitudes</a>
        </div>
        <div>
            <span>
                Admin: <?= htmlspecialchars($_SESSION['nombre'] ?? $_SESSION['user'] ?? 'Administrador') ?>
            </span>
            <button id="btnLogout" class="btn-logout">Cerrar sesión</button>
        </div>
    </nav>

    <main>

        <h2>Solicitudes pendientes de aprobación</h2>

        <div class="table-container">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Taller</th>
                        <th>Solicitante</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="tablaSolicitudes">
                    <tr>
                        <td colspan="6">Cargando solicitudes...</td>
                    </tr>
                </tbody>

            </table>

        </div>

    </main>

    <div id="mensaje"></div>

    <script>
        $("#btnLogout").click(function () {
            $.post("index.php", { option: "logout" }, function () {
                window.location.href = "index.php?page=login";
            });
        });
    </script>

</body>
</html>