document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");
    $("#inputAsistentes").select2();

    var calendar = new FullCalendar.Calendar(calendarEl, {
        selectable: true,
        longPressDelay: 1,
        locale: "es",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay",
        },

        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,

        // CUANDO SE SELECCIONA UN EVENTO
        select: function (start, end) {
            action_form = "registrar";

            Utils.resetearFormulario(frmRegistrarReunion, ["#inputAsistentes"]);
            document
                .querySelectorAll(".show-validation-message")
                .forEach((item) => (item.innerHTML = ""));

            toggleDisabledInputLinkZoom();
            toggleDisabledInputOtraOficina();

            document.querySelector(".modal-title").innerHTML =
                "REGISTRAR REUNION";
            action_form = "registrar";
            btnEliminar.style.display = "none";

            formGroupInputEstado.style.display = "none";
            inputEstado.disabled = true;

            // leemos las fechas de inicio de evento y hoy
            var check = moment(start.start).format("YYYY-MM-DD");
            var hoy = moment(new Date()).format("YYYY-MM-DD");

            // $('#inputAsistentes').val(null).trigger("change");

            // si el inicio de evento ocurre hoy o en el futuro mostramos el modal
            if (check >= hoy) {
                // jQuery.noConflict();
                $("#citamodal").modal("show");

                inputFecha.value = check;
                calendar.unselect();
            }
            // si no, mostramos una alerta de error
            else {
                Swal.fire({
                    position: "top-center",
                    icon: "info",
                    title: "¡No se pueden crear eventos en el pasado!",
                    showConfirmButton: false,
                    timer: 1500,
                });

                calendar.unselect();
            }
        },

        // CLICK EN UN EVENTO
        eventClick: function (arg) {
            //if (confirm('¿Está seguro(a) que desea eliminar esta reunión?')) {
            // arg.event.remove()
            //}

            Utils.resetearFormulario(frmRegistrarReunion, ["#inputAsistentes"]);
            document
                .querySelectorAll(".show-validation-message")
                .forEach((item) => (item.innerHTML = ""));

            console.log(arg.event.extendedProps);

            btnEliminar.style.display = "inline-block";
            document.querySelector(".modal-title").innerHTML = "EDITAR REUNION";
            action_form = "editar";

            formGroupInputEstado.style.display = "block";
            inputEstado.disabled = false;

            inputId.value = arg.event.extendedProps.id;
            inputTitulo.value = arg.event.extendedProps.titulo;
            inputDescripcion.value = arg.event.extendedProps.descripcion;
            inputFecha.value = Utils.getDateForDateInput(
                arg.event.extendedProps.fecha
            );
            inputHoraInicio.value =
                arg.event.extendedProps.hora_inicio.split(":")[0] +
                ":" +
                arg.event.extendedProps.hora_inicio.split(":")[1];
            inputHoraFin.value =
                arg.event.extendedProps.hora_fin.split(":")[0] +
                ":" +
                arg.event.extendedProps.hora_fin.split(":")[1];

            $("#inputTipoReunion").val(arg.event.extendedProps.tipo);

            toggleDisabledInputLinkZoom();

            if (arg.event.extendedProps.tipo !== "presencial") {
                inputLinkZoom.value = arg.event.extendedProps.link;
            }

            if (arg.event.extendedProps.empresa_id != null) {
                $("#inputOficina").val(arg.event.extendedProps.empresa_id);
            }

            toggleDisabledInputOtraOficina();

            if ($("#inputOficina").find(":selected").val() === "") {
                inputOtraOficina.value = arg.event.extendedProps.otra_oficina;
            }

            $("#inputAsistentes")
                .val(arg.event.extendedProps.asistentes.map((item) => item.id))
                .trigger("change");

            $("#inputEstado").val(arg.event.extendedProps.estado);

            // jQuery.noConflict();
            $("#citamodal").modal("show");
        },
        editable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        eventSources: [
            {
                url: "cita/getForFullCalendar", // use the `url` property
                // extraParams: {
                //   _token: token_,

                // },
                extraParams: function () {
                    // a function that returns an object
                    return {
                        _token: token_,
                        estado: $("#inputFiltroEstado").val(),
                    };
                },
                failure: function () {
                    alert("Ocurrio un error al conectarse con el servidor!");
                },
            },
        ],
        eventSourceSuccess: function (content, xhr) {
            console.log(content);
            return content.data.map((res) => {
                return {
                    id: res.id,
                    start: res.fecha_inicio,
                    end: res.fecha_fin,
                    title: res.titulo,
                    backgroundColor:
                        res.estado === "pendiente"
                            ? "blue"
                            : res.estado === "concluida"
                            ? "green"
                            : res.estado === "cancelada"
                            ? "red"
                            : "",
                    extendedProps: {
                        id: res.id,
                        titulo: res.titulo,
                        descripcion: res.descripcion,
                        fecha: res.fecha,
                        fecha_inicio: res.fecha_inicio,
                        fecha_fin: res.fecha_fin,
                        hora_inicio: res.hora_inicio,
                        hora_fin: res.hora_fin,
                        tipo: res.tipo,
                        link: res.link,
                        empresa_id: res.empresa_id,
                        descripcion_empresa: res.descripcion_empresa,
                        otra_oficina: res.otra_oficina,
                        estado: res.estado,
                        asistentes: res.asistentes,
                    },
                };
            });
        },
    });

    calendar.render();

    let action_form = "registrar";

    function toggleDisabledInputLinkZoom() {
        if ($("#inputTipoReunion").find(":selected").val() === "presencial") {
            inputLinkZoom.disabled = true;
            inputLinkZoom.value = "";
        } else {
            inputLinkZoom.disabled = false;
        }
    }

    function toggleDisabledInputOtraOficina() {
        if ($("#inputOficina").find(":selected").val() === "") {
            inputOtraOficina.disabled = false;
        } else {
            inputOtraOficina.disabled = true;
            inputOtraOficina.value = "";
        }
    }

    inputTipoReunion.addEventListener("change", function (e) {
        toggleDisabledInputLinkZoom();
    });

    inputOficina.addEventListener("change", function (e) {
        toggleDisabledInputOtraOficina();
    });

    frmRegistrarReunion.addEventListener("submit", function (e) {
        e.preventDefault();

        let dataArray = $("#frmRegistrarReunion").serializeArray();
        dataArray.push({
            name: "_token",
            value: token_,
        });

        if (action_form === "registrar") {
            $.ajax({
                method: "POST",
                url: "cita",
                data: dataArray,
                success: function (Response) {
                    console.log(Response);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Datos guardados correctamente",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    calendar.refetchEvents();
                    Utils.resetearFormulario(frmRegistrarReunion, [
                        "#inputAsistentes",
                    ]);
                    $("#citamodal").modal("hide");
                },
                error: (response) => {
                    console.log(response.responseJSON.messages);
                    Utils.showValidationMessages(
                        response.responseJSON.messages
                    );
                },
            });
        } else {
            $.ajax({
                method: "PUT",
                url: `cita/${inputId.value}`,
                data: dataArray,
                success: function (Response) {
                    console.log(Response);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Datos actualizados correctamente",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    calendar.refetchEvents();
                    Utils.resetearFormulario(frmRegistrarReunion, [
                        "#inputAsistentes",
                    ]);
                    $("#inputAsistentes").val(null).trigger("change");
                    $("#citamodal").modal("hide");
                },
                error: (response) => {
                    console.log(response);
                    Utils.showValidationMessages(
                        response.responseJSON.messages
                    );
                },
            });
        }
    });

    btnEliminar.addEventListener("click", function (e) {
        e.preventDefault();
        Swal.fire({
            title: "¿Estás seguro(a)?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(inputId.value);

                let dataArray = {
                    _token: token_,
                };

                $.ajax({
                    method: "DELETE",
                    url: `cita/${inputId.value}`,
                    data: dataArray,
                    success: function (Response) {
                        console.log(Response);
                        $("#citamodal").modal("hide");
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Datos Eliminados correctamente",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        calendar.refetchEvents();
                    },
                    error: (response) => {
                        console.log(response);
                    },
                });
            }
        });
    });

    inputFiltroEstado.addEventListener("change", (e) => {
        calendar.refetchEvents();
    });
});
