$(function () {

    cargarTalleres();

    function cargarTalleres() {
        $.ajax({
            url: "index.php?option=talleres_json",
            method: "GET",
            dataType: "json",
            success: function (data) {

                let html = "";

                data.forEach(t => {

                    html += `
                        <div class="card">
                            <h3>${t.nombre}</h3>
                            <p>${t.descripcion}</p>
                            <p><strong>Cupo disponible:</strong> ${t.cupo_disponible}</p>

                            <button class="btnSolicitar" data-id="${t.id}">
                                Solicitar
                            </button>
                        </div>
                    `;
                });

                $("#contenedorTalleres").html(html);
            }
        });
    }

   
    $(document).on("click", ".btnSolicitar", function () {

        let taller_id = $(this).data("id");

        $.ajax({
            url: "index.php",
            method: "POST",
            data: {
                option: "solicitar",
                taller_id: taller_id
            },
            success: function (respuesta) {

                alert("Solicitud enviada");

                // recargar talleres
                cargarTalleres();
            }
        });

    });

});