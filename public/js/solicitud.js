$(function () {

    cargarSolicitudes();

    function cargarSolicitudes() {
        $.ajax({
            url: "index.php?option=solicitudes_json",
            method: "GET",
            dataType: "json",
            success: function (data) {

                let html = "";

                data.forEach(s => {

                    html += `
                        <tr>
                            <td>${s.usuario}</td>
                            <td>${s.taller}</td>
                            <td>${s.fecha_solicitud}</td>
                            <td>${s.estado}</td>
                            <td>
                                <button class="btnAprobar" data-id="${s.id}">
                                    Aprobar
                                </button>

                                <button class="btnRechazar" data-id="${s.id}">
                                    Rechazar
                                </button>
                            </td>
                        </tr>
                    `;
                });

                $("#tablaSolicitudes").html(html);
            }
        });
    }

    $(document).on("click", ".btnAprobar", function () {

        let id = $(this).data("id");

        $.ajax({
            url: "index.php",
            method: "POST",
            data: {
                option: "aprobar",
                id: id
            },
            success: function (res) {
                alert("Solicitud aprobada");
                cargarSolicitudes();
            }
        });
    });

    $(document).on("click", ".btnRechazar", function () {

        let id = $(this).data("id");

        $.ajax({
            url: "index.php",
            method: "POST",
            data: {
                option: "rechazar",
                id: id
            },
            success: function (res) {
                alert("Solicitud rechazada");
                cargarSolicitudes();
            }
        });
    });

});