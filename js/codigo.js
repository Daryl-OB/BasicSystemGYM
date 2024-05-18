$(document).ready(function () {

    function ActualizarContenidoServicio() {
        $.get("../controlador/ctr_actucont_serv.php",
            function (rpta) {
                $('#tablaServicios').html(rpta)
            }
        );
    }

    function ActualizarContenidoMetodo() {
        $.get("../controlador/ctr_actucont_met.php",
            function (rpta) {
                $('#tablaMetodos').html(rpta)
            }
        );
    }

    function ActualizarContenidoPromocion() {
        $.get("../controlador/ctr_actucont_prom.php",
            function (rpta) {
                $('#tablaPromociones').html(rpta)
            }
        );
    }

    function ActualizarContenidoCliente() {
        $.get("../controlador/ctr_actucont_cli.php",
            function (rpta) {
                $('#tablaClientes').html(rpta)
            }
        );
    }

    function ActualizarContenidoInscripcion() {
        $.get("../controlador/ctr_actucont_inscr.php",
            function (rpta) {
                $('#tablaInscripciones').html(rpta)
            }
        );
    }

    //MODAL REGISTRAR SERVICIO (FUNCIONA)
    $(".btn_registrar").click(function (e) {

        e.preventDefault(e);

        $("#btn_action").html("");
        $("#btn_action").html("<i class='fas fa-save'></i> Registrar Informacion");

        $("#txt_codserv").val("");
        $("#txt_nom").val("");
        $("#txt_descr").val("");

        $("#md_action .modal-title").text('Registrar Servicio');
        $("#md_action .modal-header").addClass("bg-primary");
        $("#md_action .modal-header").removeClass("bg-success");

        $("#frm_action #txt_tipo").val("");
        $("#frm_action #txt_tipo").val("r");

        $("#frm_action #btn_action").attr("name", "");
        $("#frm_action #btn_action").attr("name", "btn_registrar_serv");

        $("#md_action").modal("show");

        $("#frm_action").submit(function (e) {
            e.preventDefault(e);

            let codserv = $("#txt_codserv").val();
            let serv = $("#txt_nom").val();
            let descr = $("#txt_descr").val();
            let tipo = $("#txt_tipo").val();
            let btn = $("#btn_action").attr("name");

            $.ajax({
                type: "POST",
                url: "../controlador/ctr_grabar_serv.php",
                data: {
                    codserv: codserv,
                    nombre: serv,
                    descripcion: descr,
                    tipo: tipo,
                    btn_registrar_serv: btn
                },
                success: function () {
                    ActualizarContenidoServicio();
                    $("#md_action").modal("hide");
                }
            });
        });
    });

    //MODAL EDITAR SERVICIO (FUNCIONA)
    $(document).on("click", ".reg_servicio .btn_editar", function (e) {
        e.preventDefault(e);

        $("#btn_action").html("");
        $("#btn_action").html("<i class='fas fa-save'></i> Actualizar Informacion");

        $("#md_action .modal-title").text('Editar Servicio');
        $("#md_action .modal-header").addClass("bg-success");
        $("#md_action .modal-header").removeClass("bg-primary");

        $("#frm_action #txt_tipo").val("");
        $("#frm_action #txt_tipo").val("e");

        $("#frm_action #btn_action").attr("name", "");
        $("#frm_action #btn_action").attr("name", "btn_registrar_serv");

        let codserv = $(this).closest(".reg_servicio").children(".codserv").text();
        let serv = $(this).closest(".reg_servicio").children(".serv").text();
        let descr = $(this).closest(".reg_servicio").children(".descr").text();
        let tipo = $("#frm_action #txt_tipo").val();
        let btn = $("#frm_action #btn_action").attr("name");

        if (codserv != "") {
            $("#frm_action #txt_codserv").val(codserv);
            $("#frm_action #txt_nom").val(serv);
            $("#frm_action #txt_descr").val(descr);

            $("#md_action").modal("show");

            $("#frm_action").submit(function (e) {
                e.preventDefault(e);

                codserv = $("#frm_action #txt_codserv").val();
                serv = $("#frm_action #txt_nom").val();
                descr = $("#frm_action #txt_descr").val();
                tipo = $("#frm_action #txt_tipo").val();
                btn = $("#frm_action #btn_action").attr("name");

                $.ajax({
                    type: "POST",
                    url: "../controlador/ctr_grabar_serv.php",
                    data: {
                        codserv: codserv,
                        nombre: serv,
                        descripcion: descr,
                        tipo: tipo,
                        btn_registrar_serv: btn
                    },
                    success: function () {
                        ActualizarContenidoServicio();
                        $("#md_action").modal("hide");
                    }
                });
            });
        }
    });

    //MODAL BORRAR SERVICIO (FUNCIONA)
    $(document).on("click", ".reg_servicio .btn_borrar", function (e) {
        e.preventDefault(e);

        let codserv = $(this).closest(".reg_servicio").children(".codserv").text();
        let serv = $(this).closest(".reg_servicio").children(".serv").text();

        $("#md_borrar .lbl_codserv").text("Codigo: " + codserv);
        $("#md_borrar .lbl_serv").text("Servicio: " + serv);

        $("#md_borrar").modal("show");

        $("#md_borrar .btn_confirmar_borrar").off("click").on("click", function (e) {
            e.preventDefault(e);

            if (codserv != "") {
                $.ajax({
                    type: "GET",
                    url: "../controlador/ctr_borrar_serv.php",
                    data: {
                        codserv: codserv
                    },
                    success: function () {
                        ActualizarContenidoServicio();
                        $("#md_borrar").modal("hide");
                    }
                });
            }
        });
    });

    //MODAL MOSTRAR INFORMACION SERVICIO (FUNCIONA)
    $(document).on("click", ".reg_servicio .btn_mostrar", function (e) {
        e.preventDefault(e);

        let codserv = $(this).closest(".reg_servicio").children(".codserv").text();

        if (codserv != "") {
            $.ajax({
                type: "GET",
                url: "../controlador/ctr_mostrar_serv.php",
                data: {
                    codserv: codserv
                },
                success: function (rpta) {

                    let rp = JSON.parse(rpta);

                    $("#md_mostrar .codserv").text("");
                    $("#md_mostrar .serv").text("");
                    $("#md_mostrar .descr").text("");

                    $("#md_mostrar .codserv").text(rp.codigo_servicio);
                    $("#md_mostrar .serv").text(rp.nombre);
                    $("#md_mostrar .descr").text(rp.descripcion);

                    $("#md_mostrar").modal("show");
                }
            });
        }
    });

    //MODAL CONSULTAR SERVICIO (FUNCIONA)
    $("#frm_consultar_serv #txt_codserv").focusout(function (e) {

        e.preventDefault();
        // Capturar el valor ingresado en el cuadro de texto
        let codserv = $(this).val();

        if (codserv != "") {
            // Implementar la consulta por medio de AJAX para JQuery 
            $.ajax({
                url: "../controlador/ctr_consultar_serv.php",
                type: "POST",
                data: { codserv: codserv },
                success: function (rpta) {
                    let rp = JSON.parse(rpta);

                    if (rp) {
                        $(".serv").html(rp.nombre);
                        $(".descr").html(rp.descripcion);
                    } else {
                        $('#md_consulta .modal-body').html("<p>El codigo <b>" + codserv + "</b> no existe</p>");
                        $('#md_consulta').modal('show');
                        $("#txt_codserv").val("");

                        let vacio = "&nbsp;";

                        $(".serv").html(vacio);
                        $(".descr").html(vacio);

                        $("#txt_codserv").focus();
                    }
                }
            });
        }
    });

    //MODAL FILTRAR SERVICIO (FUNCIONA)
    $("#form_filtrar_serv").submit(function (e) {
        e.preventDefault();

        var valor = $("#txt_valor").val();

        if (valor != "") {
            $.post("../controlador/ctr_filtrar_serv.php",
                { valor: valor },
                function (rpta) {
                    $('#md_aviso .modal-header').removeClass('bg-danger');
                    $('#md_aviso .modal-header').addClass('bg-primary');

                    $('#md_aviso .modal-dialog').removeClass('modal-md');
                    $('#md_aviso .modal-dialog').addClass('modal-xl');

                    $('#md_aviso .modal-title').html('');
                    $('#md_aviso .modal-title').html('Servicios Filtrados');

                    $('#md_aviso .modal-body').html("<div id='tabla'></div>")

                    $("#tabla").html(rpta);

                    $('#md_aviso').modal('show');

                    $('#txt_valor').focus();
                }
            );
        } else {
            $('#md_aviso .modal-header').removeClass('bg-primary');
            $('#md_aviso .modal-header').addClass('bg-danger');

            $('#md_aviso .modal-dialog').removeClass('modal-xl');
            $('#md_aviso .modal-dialog').addClass('modal-md');

            $('#md_aviso .modal-title').html('');
            $('#md_aviso .modal-title').html('Advertencia');

            $("#tabla").html("");

            $('#md_aviso .modal-body').html("<p><b>No haz ingresado un dato para buscar...</b></p>")

            $('#md_aviso').modal('show');
            $("#txt_valor").focus();
        }
    });

    /*=======================================================================*/

    //MODAL REGISTRAR METODO (FUNCIONA)
    $(".btn_registrar").click(function (e) {

        e.preventDefault(e);

        $("#btn_action").html("");
        $("#btn_action").html("<i class='fas fa-save'></i> Registrar Informacion");

        $("#txt_codmet").val("");
        $("#txt_nom").val("");
        $("#txt_descr").val("");

        $("#md_action .modal-title").text('Registrar Metodo de Pago');
        $("#md_action .modal-header").addClass("bg-primary");
        $("#md_action .modal-header").removeClass("bg-success");

        $("#frm_action #txt_tipo").val("");
        $("#frm_action #txt_tipo").val("r");

        $("#frm_action #btn_action").attr("name", "");
        $("#frm_action #btn_action").attr("name", "btn_registrar_met");

        $("#md_action").modal("show");

        $("#frm_action").submit(function (e) {
            e.preventDefault(e);

            let codmet = $("#txt_codmet").val();
            let met = $("#txt_nom").val();
            let descr = $("#txt_descr").val();
            let tipo = $("#txt_tipo").val();
            let btn = $("#btn_action").attr("name");

            $.ajax({
                type: "POST",
                url: "../controlador/ctr_grabar_met.php",
                data: {
                    codmet: codmet,
                    nombre: met,
                    descripcion: descr,
                    tipo: tipo,
                    btn_registrar_met: btn
                },
                success: function () {
                    ActualizarContenidoMetodo();
                    $("#md_action").modal("hide");
                }
            });
        });
    });

    //MODAL EDITAR METODO (FUNCIONA)
    $(document).on("click", ".reg_metodo .btn_editar", function (e) {

        e.preventDefault(e);

        $("#btn_action").html("");
        $("#btn_action").html("<i class='fas fa-save'></i> Actualizar Informacion");

        $("#md_action .modal-title").text('Editar Servicio');
        $("#md_action .modal-header").addClass("bg-success");
        $("#md_action .modal-header").removeClass("bg-primary");

        $("#frm_action #txt_tipo").val("");
        $("#frm_action #txt_tipo").val("e");

        $("#frm_action #btn_action").attr("name", "");
        $("#frm_action #btn_action").attr("name", "btn_registrar_met");

        let codmet = $(this).closest(".reg_metodo").children(".codmet").text();
        let met = $(this).closest(".reg_metodo").children(".met").text();
        let descr = $(this).closest(".reg_metodo").children(".descr").text();
        let tipo = $("#frm_action #txt_tipo").val();
        let btn = $("#frm_action #btn_action").attr("name");

        if (codmet != "") {
            $("#frm_action #txt_codmet").val(codmet);
            $("#frm_action #txt_nom").val(met);
            $("#frm_action #txt_descr").val(descr);

            $("#md_action").modal("show");

            $("#frm_action").submit(function (e) {
                e.preventDefault(e);

                codmet = $("#frm_action #txt_codmet").val();
                met = $("#frm_action #txt_nom").val();
                descr = $("#frm_action #txt_descr").val();
                tipo = $("#frm_action #txt_tipo").val();
                btn = $("#frm_action #btn_action").attr("name");

                //alert(codmet + " " + met + " " + descr + " " + tipo + " " + btn);

                $.ajax({
                    type: "POST",
                    url: "../controlador/ctr_grabar_met.php",
                    data: {
                        codmet: codmet,
                        nombre: met,
                        descripcion: descr,
                        tipo: tipo,
                        btn_registrar_met: btn
                    },
                    success: function () {
                        ActualizarContenidoMetodo();
                        $("#md_action").modal("hide");
                    }
                });
            });
        }
    });

    //MODAL BORRAR METODO (FUNCIONA)
    $(document).on("click", ".reg_metodo .btn_borrar", function (e) {
        e.preventDefault(e);

        let codmet = $(this).closest(".reg_metodo").children(".codmet").text();
        let met = $(this).closest(".reg_metodo").children(".met").text();

        $("#md_borrar .lbl_codmet").text("Codigo: " + codmet);
        $("#md_borrar .lbl_met").text("Metodo de Pago: " + met);

        $("#md_borrar").modal("show");

        $("#md_borrar .btn_confirmar_borrar").off("click").on("click", function (e) {
            e.preventDefault(e);

            if (codmet != "") {
                $.ajax({
                    type: "GET",
                    url: "../controlador/ctr_borrar_met.php",
                    data: {
                        codmet: codmet
                    },
                    success: function () {
                        ActualizarContenidoMetodo();
                        $("#md_borrar").modal("hide");
                    }
                });
            }
        });
    });

    //MODAL MOSTRAR INFORMACION METODO (FUNCIONA)
    $(document).on("click", ".reg_metodo .btn_mostrar", function (e) {
        e.preventDefault(e);

        let codmet = $(this).closest(".reg_metodo").children(".codmet").text();

        if (codmet != "") {
            $.ajax({
                type: "GET",
                url: "../controlador/ctr_mostrar_met.php",
                data: {
                    codmet: codmet
                },
                success: function (rpta) {

                    let rp = JSON.parse(rpta);

                    $("#md_mostrar .codmet").text("");
                    $("#md_mostrar .met").text("");
                    $("#md_mostrar .descr").text("");

                    $("#md_mostrar .codmet").text(rp.codigo_metodo);
                    $("#md_mostrar .met").text(rp.nombre);
                    $("#md_mostrar .descr").text(rp.descripcion);

                    $("#md_mostrar").modal("show");
                }
            });
        }
    });

    //MODAL CONSULTAR METODO (FUNCIONA)
    $("#frm_consultar_met #txt_codmet").focusout(function (e) {

        e.preventDefault();
        // Capturar el valor ingresado en el cuadro de texto
        let codmet = $(this).val();

        if (codmet != "") {
            // Implementar la consulta por medio de AJAX para JQuery 
            $.ajax({
                url: "../controlador/ctr_consultar_met.php",
                type: "POST",
                data: { codmet: codmet },
                success: function (rpta) {
                    let rp = JSON.parse(rpta);

                    if (rp) {
                        $(".met").html(rp.nombre);
                        $(".descr").html(rp.descripcion);
                    } else {
                        $('#md_consulta .modal-body').html("<p>El codigo <b>" + codmet + "</b> no existe</p>");
                        $('#md_consulta').modal('show');
                        $("#txt_codmet").val("");

                        let vacio = "&nbsp;";

                        $(".met").html(vacio);
                        $(".descr").html(vacio);

                        $("#txt_codmet").focus();
                    }
                }
            });
        }
    });

    //MODAL FILTRAR METODO (FUNCIONA)
    $("#form_filtrar_met").submit(function (e) {
        e.preventDefault();

        var valor = $("#txt_valor").val();

        if (valor != "") {
            $.post("../controlador/ctr_filtrar_met.php",
                { valor: valor },
                function (rpta) {
                    $('#md_aviso .modal-header').removeClass('bg-danger');
                    $('#md_aviso .modal-header').addClass('bg-primary');

                    $('#md_aviso .modal-dialog').removeClass('modal-md');
                    $('#md_aviso .modal-dialog').addClass('modal-xl');

                    $('#md_aviso .modal-title').html('');
                    $('#md_aviso .modal-title').html('Metodos de Pago Filtrados');

                    $('#md_aviso .modal-body').html("<div id='tabla'></div>")

                    $("#tabla").html(rpta);

                    $('#md_aviso').modal('show');

                    $('#txt_valor').focus();
                });
        } else {
            $('#md_aviso .modal-header').removeClass('bg-primary');
            $('#md_aviso .modal-header').addClass('bg-danger');

            $('#md_aviso .modal-dialog').removeClass('modal-xl');
            $('#md_aviso .modal-dialog').addClass('modal-md');

            $('#md_aviso .modal-title').html('');
            $('#md_aviso .modal-title').html('Advertencia');

            $("#tabla").html("");

            $('#md_aviso .modal-body').html("<p><b>No haz ingresado un dato para buscar...</b></p>")

            $('#md_aviso').modal('show');
            $("#txt_valor").focus();
        }
    });

    /*=======================================================================*/

    //MODAL REGISTRAR PROMOCION (FUNCIONA)
    $(".btn_registrar").click(function (e) {

        e.preventDefault(e);

        $("#btn_action").html("");
        $("#btn_action").html("<i class='fas fa-save'></i> Registrar Informacion");

        $("#txt_codprom").val("");
        $("#txt_nom").val("");
        $("#txt_descr").val("");

        $("#md_action .modal-title").text('Registrar Promocion');
        $("#md_action .modal-header").addClass("bg-primary");
        $("#md_action .modal-header").removeClass("bg-success");

        $("#frm_action #txt_tipo").val("");
        $("#frm_action #txt_tipo").val("r");

        $("#frm_action #btn_action").attr("name", "");
        $("#frm_action #btn_action").attr("name", "btn_registrar_prom");

        $("#md_action").modal("show");

        $("#frm_action").submit(function (e) {
            e.preventDefault(e);

            let codprom = $("#txt_codprom").val();
            let prom = $("#txt_nom").val();
            let descr = $("#txt_descr").val();
            let tipo = $("#txt_tipo").val();
            let btn = $("#btn_action").attr("name");

            $.ajax({
                type: "POST",
                url: "../controlador/ctr_grabar_prom.php",
                data: {
                    codprom: codprom,
                    nombre: prom,
                    descripcion: descr,
                    tipo: tipo,
                    btn_registrar_prom: btn
                },
                success: function () {
                    ActualizarContenidoPromocion();
                    $("#md_action").modal("hide");
                }
            });
        });
    });

    //MODAL EDITAR PROMOCION (FUNCIONA)
    $(document).on("click", ".reg_promocion .btn_editar", function (e) {

        e.preventDefault(e);

        $("#btn_action").html("");
        $("#btn_action").html("<i class='fas fa-save'></i> Actualizar Informacion");

        $("#md_action .modal-title").text('Editar Promocion');
        $("#md_action .modal-header").addClass("bg-success");
        $("#md_action .modal-header").removeClass("bg-primary");

        $("#frm_action #txt_tipo").val("");
        $("#frm_action #txt_tipo").val("e");

        $("#frm_action #btn_action").attr("name", "");
        $("#frm_action #btn_action").attr("name", "btn_registrar_prom");

        let codprom = $(this).closest(".reg_promocion").children(".codprom").text();
        let prom = $(this).closest(".reg_promocion").children(".prom").text();
        let descr = $(this).closest(".reg_promocion").children(".descr").text();
        let tipo = $("#frm_action #txt_tipo").val();
        let btn = $("#frm_action #btn_action").attr("name");

        if (codprom != "") {
            $("#frm_action #txt_codprom").val(codprom);
            $("#frm_action #txt_nom").val(prom);
            $("#frm_action #txt_descr").val(descr);

            $("#md_action").modal("show");

            $("#frm_action").submit(function (e) {
                e.preventDefault(e);

                codprom = $("#frm_action #txt_codprom").val();
                prom = $("#frm_action #txt_nom").val();
                descr = $("#frm_action #txt_descr").val();
                tipo = $("#frm_action #txt_tipo").val();
                btn = $("#frm_action #btn_action").attr("name");

                //alert(codmet + " " + met + " " + descr + " " + tipo + " " + btn);

                $.ajax({
                    type: "POST",
                    url: "../controlador/ctr_grabar_prom.php",
                    data: {
                        codprom: codprom,
                        nombre: prom,
                        descripcion: descr,
                        tipo: tipo,
                        btn_registrar_prom: btn
                    },
                    success: function () {
                        ActualizarContenidoPromocion();
                        $("#md_action").modal("hide");
                    }
                });
            });
        }
    });

    //MODAL BORRAR PROMOCION (FUNCIONA)
    $(document).on("click", ".reg_promocion .btn_borrar", function (e) {
        e.preventDefault(e);

        let codprom = $(this).closest(".reg_promocion").children(".codprom").text();
        let prom = $(this).closest(".reg_promocion").children(".prom").text();

        $("#md_borrar .lbl_codprom").text("Codigo: " + codprom);
        $("#md_borrar .lbl_prom").text("Promocion: " + prom);

        $("#md_borrar").modal("show");

        $("#md_borrar .btn_confirmar_borrar").off("click").on("click", function (e) {
            e.preventDefault(e);

            if (codprom != "") {
                $.ajax({
                    type: "GET",
                    url: "../controlador/ctr_borrar_prom.php",
                    data: {
                        codprom: codprom
                    },
                    success: function () {
                        ActualizarContenidoPromocion();
                        $("#md_borrar").modal("hide");
                    }
                });
            }
        });
    });

    //MODAL MOSTRAR INFORMACION PROMOCION (FUNCIONA)
    $(document).on("click", ".reg_promocion .btn_mostrar", function (e) {
        e.preventDefault(e);

        let codprom = $(this).closest(".reg_promocion").children(".codprom").text();

        if (codprom != "") {
            $.ajax({
                type: "GET",
                url: "../controlador/ctr_mostrar_prom.php",
                data: {
                    codprom: codprom
                },
                success: function (rpta) {

                    let rp = JSON.parse(rpta);

                    $("#md_mostrar .codprom").text("");
                    $("#md_mostrar .prom").text("");
                    $("#md_mostrar .descr").text("");

                    $("#md_mostrar .codprom").text(rp.codigo_promocion);
                    $("#md_mostrar .prom").text(rp.nombre);
                    $("#md_mostrar .descr").text(rp.descripcion);

                    $("#md_mostrar").modal("show");
                }
            });
        }
    });

    //MODAL CONSULTAR PROMOCION
    $("#frm_consultar_prom #txt_codprom").focusout(function (e) {

        e.preventDefault();
        // Capturar el valor ingresado en el cuadro de texto
        let codprom = $(this).val();

        if (codprom != "") {
            // Implementar la consulta por medio de AJAX para JQuery 
            $.ajax({
                url: "../controlador/ctr_consultar_prom.php",
                type: "POST",
                data: { codprom: codprom },
                success: function (rpta) {
                    let rp = JSON.parse(rpta);

                    if (rp) {
                        $(".prom").html(rp.nombre);
                        $(".descr").html(rp.descripcion);
                    } else {
                        $('#md_consulta .modal-body').html("<p>El codigo <b>" + codprom + "</b> no existe</p>");
                        $('#md_consulta').modal('show');
                        $("#txt_codprom").val("");

                        let vacio = "&nbsp;";

                        $(".prom").html(vacio);
                        $(".descr").html(vacio);

                        $("#txt_codprom").focus();
                    }
                }
            });
        }
    });

    //MODAL FILTRAR PROMOCION
    $("#form_filtrar_prom").submit(function (e) {
        e.preventDefault();

        var valor = $("#txt_valor").val();

        if (valor != "") {
            $.post("../controlador/ctr_filtrar_prom.php",
                { valor: valor },
                function (rpta) {
                    $('#md_aviso .modal-header').removeClass('bg-danger');
                    $('#md_aviso .modal-header').addClass('bg-primary');

                    $('#md_aviso .modal-dialog').removeClass('modal-md');
                    $('#md_aviso .modal-dialog').addClass('modal-xl');

                    $('#md_aviso .modal-title').html('');
                    $('#md_aviso .modal-title').html('Promociones Filtradas');

                    $('#md_aviso .modal-body').html("<div id='tabla'></div>")

                    $("#tabla").html(rpta);

                    $('#md_aviso').modal('show');

                    $('#txt_valor').focus();
                });
        } else {
            $('#md_aviso .modal-header').removeClass('bg-primary');
            $('#md_aviso .modal-header').addClass('bg-danger');

            $('#md_aviso .modal-dialog').removeClass('modal-xl');
            $('#md_aviso .modal-dialog').addClass('modal-md');

            $('#md_aviso .modal-title').html('');
            $('#md_aviso .modal-title').html('Advertencia');

            $("#tabla").html("");

            $('#md_aviso .modal-body').html("<p><b>No haz ingresado un dato para buscar...</b></p>")

            $('#md_aviso').modal('show');
            $("#txt_valor").focus();
        }
    });

    /*=======================================================================*/

    //MODAL REGISTRAR CLIENTE (FUNCIONA)
    $(".btn_registrar").click(function (e) {

        e.preventDefault(e);

        $("#btn_action").html("");
        $("#btn_action").html("<i class='fas fa-save'></i> Registrar Informacion");

        $("#txt_codcli").val("");
        $("#txt_ident").val("");
        $("#txt_nom").val("");
        $("#txt_telef").val("");

        $("#md_action .modal-title").text('Registrar Cliente');
        $("#md_action .modal-header").addClass("bg-primary");
        $("#md_action .modal-header").removeClass("bg-success");

        $("#frm_action #txt_tipo").val("");
        $("#frm_action #txt_tipo").val("r");

        $("#frm_action #btn_action").attr("name", "");
        $("#frm_action #btn_action").attr("name", "btn_registrar_cli");

        $("#md_action").modal("show");

        $("#frm_action").submit(function (e) {
            e.preventDefault(e);

            let codcli = $("#txt_codcli").val();
            let ident = $("#txt_ident").val();
            let cli = $("#txt_nom").val();
            let telef = $("#txt_telef").val();
            let tipo = $("#txt_tipo").val();
            let btn = $("#btn_action").attr("name");

            $.ajax({
                type: "POST",
                url: "../controlador/ctr_grabar_cli.php",
                data: {
                    codcli: codcli,
                    identificacion: ident,
                    nombre: cli,
                    telefono: telef,
                    tipo: tipo,
                    btn_registrar_cli: btn
                },
                success: function () {
                    ActualizarContenidoCliente();
                    $("#md_action").modal("hide");
                }
            });
        });
    });

    //MODAL EDITAR CLIENTE (FUNCIONA)
    $(document).on("click", ".reg_cliente .btn_editar", function (e) {

        e.preventDefault(e);

        $("#btn_action").html("");
        $("#btn_action").html("<i class='fas fa-save'></i> Actualizar Informacion");

        $("#md_action .modal-title").text('Editar Cliente');
        $("#md_action .modal-header").addClass("bg-success");
        $("#md_action .modal-header").removeClass("bg-primary");

        $("#frm_action #txt_tipo").val("");
        $("#frm_action #txt_tipo").val("e");

        $("#frm_action #btn_action").attr("name", "");
        $("#frm_action #btn_action").attr("name", "btn_registrar_cli");

        let codcli = $(this).closest(".reg_cliente").children(".codcli").text();
        let ident = $(this).closest(".reg_cliente").children(".ident").text();
        let cli = $(this).closest(".reg_cliente").children(".cli").text();
        let telef = $(this).closest(".reg_cliente").children(".telef").text();
        let tipo = $("#frm_action #txt_tipo").val();
        let btn = $("#frm_action #btn_action").attr("name");

        if (codcli != "") {
            $("#frm_action #txt_codcli").val(codcli);
            $("#frm_action #txt_ident").val(ident);
            $("#frm_action #txt_nom").val(cli);
            $("#frm_action #txt_telef").val(telef);

            $("#md_action").modal("show");

            $("#frm_action").submit(function (e) {
                e.preventDefault(e);

                codcli = $("#frm_action #txt_codcli").val();
                ident = $("#frm_action #txt_ident").val();
                cli = $("#frm_action #txt_nom").val();
                telef = $("#frm_action #txt_telef").val();
                tipo = $("#frm_action #txt_tipo").val();
                btn = $("#frm_action #btn_action").attr("name");

                //alert(codmet + " " + met + " " + descr + " " + tipo + " " + btn);

                $.ajax({
                    type: "POST",
                    url: "../controlador/ctr_grabar_cli.php",
                    data: {
                        codcli: codcli,
                        identificacion: ident,
                        nombre: cli,
                        telefono: telef,
                        tipo: tipo,
                        btn_registrar_cli: btn
                    },
                    success: function () {
                        ActualizarContenidoCliente();
                        $("#md_action").modal("hide");
                    }
                });
            });
        }
    });

    //MODAL BORRAR CLIENTE (FUNCIONA)
    $(document).on("click", ".reg_cliente .btn_borrar", function (e) {
        e.preventDefault(e);

        let codcli = $(this).closest(".reg_cliente").children(".codcli").text();
        let cli = $(this).closest(".reg_cliente").children(".cli").text();

        $("#md_borrar .lbl_codcli").text("Codigo: " + codcli);
        $("#md_borrar .lbl_cli").text("Cliente: " + cli);

        $("#md_borrar").modal("show");

        $("#md_borrar .btn_confirmar_borrar").off("click").on("click", function (e) {
            e.preventDefault(e);

            if (codcli != "") {
                $.ajax({
                    type: "GET",
                    url: "../controlador/ctr_borrar_cli.php",
                    data: {
                        codcli: codcli
                    },
                    success: function () {
                        ActualizarContenidoCliente();
                        $("#md_borrar").modal("hide");
                    }
                });
            }
        });
    });

    //MODAL MOSTRAR INFORMACION CLIENTE (FUNCIONA)
    $(document).on("click", ".reg_cliente .btn_mostrar", function (e) {
        e.preventDefault(e);

        let codcli = $(this).closest(".reg_cliente").children(".codcli").text();

        if (codcli != "") {
            $.ajax({
                type: "GET",
                url: "../controlador/ctr_mostrar_cli.php",
                data: {
                    codcli: codcli
                },
                success: function (rpta) {

                    let rp = JSON.parse(rpta);

                    $("#md_mostrar .codcli").text("");
                    $("#md_mostrar .ident").text("");
                    $("#md_mostrar .cli").text("");
                    $("#md_mostrar .telef").text("");

                    $("#md_mostrar .codcli").text(rp.codigo_cliente);
                    $("#md_mostrar .ident").text(rp.identificacion);
                    $("#md_mostrar .cli").text(rp.nombre);
                    $("#md_mostrar .telef").text(rp.telefono);

                    $("#md_mostrar").modal("show");
                }
            });
        }
    });

    //MODAL CONSULTAR CLIENTE (FUNCIONA)
    $("#frm_consultar_cli #txt_codcli").focusout(function (e) {

        e.preventDefault();
        // Capturar el valor ingresado en el cuadro de texto
        let codcli = $(this).val();

        if (codcli != "") {
            // Implementar la consulta por medio de AJAX para JQuery 
            $.ajax({
                url: "../controlador/ctr_consultar_cli.php",
                type: "POST",
                data: { codcli: codcli },
                success: function (rpta) {
                    let rp = JSON.parse(rpta);

                    console.log(rp);

                    if (rp) {
                        $(".cli").html(rp.nombre);
                        $(".ident").html(rp.identificacion);
                        $(".telef").html(rp.telefono);
                    } else {
                        $('#md_consulta .modal-body').html("<p>El codigo <b>" + codcli + "</b> no existe</p>");
                        $('#md_consulta').modal('show');
                        $("#txt_codcli").val("");

                        let vacio = "&nbsp;";

                        $(".cli").html(vacio);
                        $(".ident").html(vacio);
                        $(".telef").html(vacio);

                        $("#txt_codcli").focus();
                    }
                }
            });
        }
    });

    //MODAL FILTRAR CLIENTE (FUNCIONA)
    $("#form_filtrar_cli").submit(function (e) {
        e.preventDefault();

        var valor = $("#txt_valor").val();

        if (valor != "") {
            $.post("../controlador/ctr_filtrar_cli.php",
                { valor: valor },
                function (rpta) {
                    $('#md_aviso .modal-header').removeClass('bg-danger');
                    $('#md_aviso .modal-header').addClass('bg-primary');

                    $('#md_aviso .modal-dialog').removeClass('modal-md');
                    $('#md_aviso .modal-dialog').addClass('modal-xl');

                    $('#md_aviso .modal-title').html('');
                    $('#md_aviso .modal-title').html('Clientes Filtrados');

                    $('#md_aviso .modal-body').html("<div id='tabla'></div>")

                    $("#tabla").html(rpta);

                    $('#md_aviso').modal('show');

                    $('#txt_valor').focus();
                });
        } else {
            $('#md_aviso .modal-header').removeClass('bg-primary');
            $('#md_aviso .modal-header').addClass('bg-danger');

            $('#md_aviso .modal-dialog').removeClass('modal-xl');
            $('#md_aviso .modal-dialog').addClass('modal-md');

            $('#md_aviso .modal-title').html('');
            $('#md_aviso .modal-title').html('Advertencia');

            $("#tabla").html("");

            $('#md_aviso .modal-body').html("<p><b>No haz ingresado un dato para buscar...</b></p>")

            $('#md_aviso').modal('show');
            $("#txt_valor").focus();
        }
    });

    /*=======================================================================*/

    //MODAL REGISTRAR INSCRIPCION (FUNCIONA)
    $(".btn_registrar").click(function (e) {

        e.preventDefault(e);

        $("#btn_action").html("");
        $("#btn_action").html("<i class='fas fa-save'></i> Registrar Informacion");

        $("#txt_codinscr").val("");
        $("#txt_numbol").val("");
        $("#cbo_cli").val("");
        $("#cbo_serv").val("");
        $("#cbo_prom").val("");
        $("#txt_emi").val("");
        $("#txt_cad").val("");
        $("#txt_prec").val("");
        $("#txt_pag").val("");
        $("#cbo_met").val("");
        $("#txt_deu").val("");
        $("#cbo_est").val("");

        $("#md_action .modal-title").text('Registrar Inscripcion');
        $("#md_action .modal-header").addClass("bg-primary");
        $("#md_action .modal-header").removeClass("bg-success");

        $("#frm_action #txt_tipo").val("");
        $("#frm_action #txt_tipo").val("r");

        $("#frm_action #btn_action").attr("name", "");
        $("#frm_action #btn_action").attr("name", "btn_registrar_inscr");

        if ($("#txt_codinscr").val() === "") {
            // Llamada AJAX para obtener los datos de los clientes
            $.ajax({
                url: "../controlador/ctr_obtener_cli.php",
                type: "GET",
                success: function (rpta) {
                    // Actualizar el select de clientes
                    let selectCliente = $("#cbo_cli");
                    selectCliente.empty();
                    let clientes = JSON.parse(rpta);
                    let option = $("<option></option>").attr("value", "").text("[Selecciona un cliente]");
                    selectCliente.append(option);
                    clientes.forEach(function (cliente) {
                        option = $("<option></option>")
                            .attr("value", cliente.codigo_cliente)
                            .text(cliente.nombre);
                        selectCliente.append(option);
                    });
                }
            });

            // Llamada AJAX para obtener los datos de los servicios
            $.ajax({
                url: "../controlador/ctr_obtener_serv.php",
                type: "GET",
                success: function (rpta) {
                    // Actualizar el select de servicios
                    let selectServicio = $("#cbo_serv");
                    selectServicio.empty();
                    let servicios = JSON.parse(rpta);
                    let option = $("<option></option>").attr("value", "").text("[Selecciona un servicio]");
                    selectServicio.append(option);
                    servicios.forEach(function (servicio) {
                        option = $("<option></option>")
                            .attr("value", servicio.codigo_servicio)
                            .text(servicio.nombre);
                        selectServicio.append(option);
                    });
                }
            });

            // Llamada AJAX para obtener los datos de las promociones
            $.ajax({
                url: "../controlador/ctr_obtener_prom.php",
                type: "GET",
                success: function (rpta) {
                    // Actualizar el select de promociones
                    let selectPromocion = $("#cbo_prom");
                    selectPromocion.empty();
                    let promociones = JSON.parse(rpta);
                    let option = $("<option></option>").attr("value", "").text("[Selecciona una promocion]");
                    selectPromocion.append(option);
                    promociones.forEach(function (promocion) {
                        option = $("<option></option>")
                            .attr("value", promocion.codigo_promocion)
                            .text(promocion.nombre);
                        selectPromocion.append(option);
                    });
                }
            });

            // Llamada AJAX para obtener los datos de las promociones
            $.ajax({
                url: "../controlador/ctr_obtener_met.php",
                type: "GET",
                success: function (rpta) {
                    // Actualizar el select de promociones
                    let selectMetodo = $("#cbo_met");
                    selectMetodo.empty();
                    let metodos = JSON.parse(rpta);
                    let option = $("<option></option>").attr("value", "").text("[Selecciona un metodo de pago]");
                    selectMetodo.append(option);
                    metodos.forEach(function (metodo) {
                        option = $("<option></option>")
                            .attr("value", metodo.codigo_metodo)
                            .text(metodo.nombre);
                        selectMetodo.append(option);
                    });
                }
            });

            //ABRIR EL MODAL REGISTRAR
            $("#md_action").modal("show");
        }


        $("#frm_action").submit(function (e) {
            e.preventDefault(e);

            let codinscr = $("#txt_codinscr").val();
            let numbol = $("#txt_numbol").val();
            let cli = $("#cbo_cli").val();
            let serv = $("#cbo_serv").val();
            let prom = $("#cbo_prom").val();
            let emi = $("#txt_emi").val();
            let cad = $("#txt_cad").val();
            let prec = $("#txt_prec").val();
            let pag = $("#txt_pag").val();
            let met = $("#cbo_met").val();
            let deu = $("#txt_deu").val();
            let est = $("#cbo_est").val();
            let tipo = $("#txt_tipo").val();
            let btn = $("#btn_action").attr("name");

            $.ajax({
                type: "POST",
                url: "../controlador/ctr_grabar_inscr.php",
                data: {
                    codinscr: codinscr,
                    numboleta: numbol,
                    cliente: cli,
                    servicio: serv,
                    promocion: prom,
                    emision: emi,
                    caducidad: cad,
                    precio: prec,
                    pago: pag,
                    metodo: met,
                    deuda: deu,
                    estado: est,
                    tipo: tipo,
                    btn_registrar_inscr: btn
                },
                success: function () {
                    ActualizarContenidoInscripcion();
                    $("#md_action").modal("hide");
                }
            });
        });
    });

    //MODAL EDITAR INSCRIPCION (FUNCIONA)
    $(document).on("click", ".reg_inscripcion .btn_editar", function (e) {

        e.preventDefault(e);

        $("#frm_action #txt_codinscr").val("");
        $("#frm_action #txt_numbol").val("");
        $("#frm_action #cbo_cli").val("");
        $("#frm_action #cbo_serv").val("");
        $("#frm_action #cbo_prom").val("");
        $("#frm_action #txt_emi").val("");
        $("#frm_action #txt_cad").val("");
        $("#frm_action #txt_prec").val("");
        $("#frm_action #txt_pag").val("");
        $("#frm_action #cbo_met").val("");
        $("#frm_action #txt_deu").val("");
        $("#frm_action #cbo_est").val("");

        $("#btn_action").html("");
        $("#btn_action").html("<i class='fas fa-save'></i> Actualizar Informacion");

        $("#md_action .modal-title").text('Editar Inscripcion');
        $("#md_action .modal-header").addClass("bg-success");
        $("#md_action .modal-header").removeClass("bg-primary");

        $("#frm_action #txt_tipo").val("");
        $("#frm_action #txt_tipo").val("e");

        $("#frm_action #btn_action").attr("name", "");
        $("#frm_action #btn_action").attr("name", "btn_registrar_inscr");

        let codinscr = $(this).closest(".reg_inscripcion").children(".codinscr").text();

        let tipo = $("#frm_action #txt_tipo").val();
        let btn = $("#frm_action #btn_action").attr("name");

        if (codinscr != "") {

            $.when(
                // Llamada AJAX para obtener los datos de los clientes
                $.ajax({
                    url: "../controlador/ctr_obtener_cli.php",
                    type: "GET",
                    success: function (rpta) {
                        // Actualizar el select de clientes
                        let selectCliente = $("#cbo_cli");
                        selectCliente.empty();
                        let clientes = JSON.parse(rpta);
                        clientes.forEach(function (cliente) {
                            let option = $("<option></option>")
                                .attr("value", cliente.codigo_cliente)
                                .text(cliente.nombre);
                            selectCliente.append(option);
                        });
                    }
                }),
                // Llamada AJAX para obtener los datos de los servicios
                $.ajax({
                    url: "../controlador/ctr_obtener_serv.php",
                    type: "GET",
                    success: function (rpta) {
                        // Actualizar el select de servicio
                        let selectServicio = $("#cbo_serv");
                        selectServicio.empty();
                        let servicios = JSON.parse(rpta);
                        servicios.forEach(function (servicio) {
                            let option = $("<option></option>")
                                .attr("value", servicio.codigo_servicio)
                                .text(servicio.nombre);
                            selectServicio.append(option);
                        });
                    }
                }),
                // Llamada AJAX para obtener los datos de los promociones
                $.ajax({
                    url: "../controlador/ctr_obtener_prom.php",
                    type: "GET",
                    success: function (rpta) {
                        // Actualizar el select de promocion
                        let selectPromocion = $("#cbo_prom");
                        selectPromocion.empty();
                        let promociones = JSON.parse(rpta);
                        promociones.forEach(function (promocion) {
                            let option = $("<option></option>")
                                .attr("value", promocion.codigo_promocion)
                                .text(promocion.nombre);
                            selectPromocion.append(option);
                        });
                    }
                }),
                // Llamada AJAX para obtener los datos de los metodos
                $.ajax({
                    url: "../controlador/ctr_obtener_met.php",
                    type: "GET",
                    success: function (rpta) {
                        // Actualizar el select de metodo
                        let selectMetodo = $("#cbo_met");
                        selectMetodo.empty();
                        let metodos = JSON.parse(rpta);
                        metodos.forEach(function (metodo) {
                            let option = $("<option></option>")
                                .attr("value", metodo.codigo_metodo)
                                .text(metodo.nombre);
                            selectMetodo.append(option);
                        });
                    }
                }),
            ).done(function () {
                // Llamada AJAX para obtener los datos de la inscripcion por codigo
                $.ajax({
                    url: "../controlador/ctr_buscar_inscr.php",
                    type: "POST",
                    data: {
                        codinscr: codinscr
                    },
                    success: function (rpta) {
                        let rp = JSON.parse(rpta);

                        $("#frm_action #txt_codinscr").val("");
                        $("#frm_action #txt_numbol").val("");
                        $("#frm_action #cbo_cli").val("");
                        $("#frm_action #cbo_serv").val("");
                        $("#frm_action #cbo_prom").val("");
                        $("#frm_action #txt_emi").val("");
                        $("#frm_action #txt_cad").val("");
                        $("#frm_action #txt_prec").val("");
                        $("#frm_action #txt_pag").val("");
                        $("#frm_action #cbo_met").val("");
                        $("#frm_action #txt_deu").val("");
                        $("#frm_action #cbo_est").val("");

                        $("#frm_action #txt_codinscr").val(rp.codigo_inscripcion);
                        $("#frm_action #txt_numbol").val(rp.numboleta);
                        $("#frm_action #cbo_cli").val(rp.inscripcion_codigo_cliente);
                        $("#frm_action #cbo_serv").val(rp.inscripcion_codigo_servicio);
                        $("#frm_action #cbo_prom").val(rp.inscripcion_codigo_promocion);
                        $("#frm_action #txt_emi").val(rp.emision);
                        $("#frm_action #txt_cad").val(rp.caducidad);
                        $("#frm_action #txt_prec").val(rp.precio);
                        $("#frm_action #txt_pag").val(rp.pago);
                        $("#frm_action #cbo_met").val(rp.inscripcion_codigo_metodo);
                        $("#frm_action #txt_deu").val(rp.deuda);
                        $("#frm_action #cbo_est").val(rp.estado);
                    }
                });

                $("#md_action").modal("show");

                $("#frm_action").submit(function (e) {
                    e.preventDefault(e);

                    codinscr = $("#frm_action #txt_codinscr").val();
                    let numbol = $("#frm_action #txt_numbol").val();
                    let cli = $("#frm_action #cbo_cli").val();
                    let serv = $("#frm_action #cbo_serv").val();
                    let prom = $("#frm_action #cbo_prom").val();
                    let emi = $("#frm_action #txt_emi").val();
                    let cad = $("#frm_action #txt_cad").val();
                    let prec = $("#frm_action #txt_prec").val();
                    let pag = $("#frm_action #txt_pag").val();
                    let met = $("#frm_action #cbo_met").val();
                    let deu = $("#frm_action #txt_deu").val();
                    let est = $("#frm_action #cbo_est").val();

                    tipo = $("#frm_action #txt_tipo").val();
                    btn = $("#frm_action #btn_action").attr("name");

                    $.ajax({
                        type: "POST",
                        url: "../controlador/ctr_grabar_inscr.php",
                        data: {
                            codinscr: codinscr,
                            numboleta: numbol,
                            cliente: cli,
                            servicio: serv,
                            promocion: prom,
                            emision: emi,
                            caducidad: cad,
                            precio: prec,
                            pago: pag,
                            metodo: met,
                            deuda: deu,
                            estado: est,
                            tipo: tipo,
                            btn_registrar_inscr: btn
                        },
                        success: function () {
                            ActualizarContenidoInscripcion();
                            $("#md_action").modal("hide");
                        }
                    });
                });
            });
        }
    });

    //MODAL BORRAR INSCRIPCION (FUNCIONA)
    $(document).on("click", ".reg_inscripcion .btn_borrar", function (e) {
        e.preventDefault(e);

        let codinscr = $(this).closest(".reg_inscripcion").children(".codinscr").text();
        let numbol = $(this).closest(".reg_inscripcion").children(".numbol").text();

        $("#md_borrar .lbl_codinscr").text("Codigo: " + codinscr);
        $("#md_borrar .lbl_inscr").text("N° Boleta: " + numbol);

        $("#md_borrar").modal("show");

        $("#md_borrar .btn_confirmar_borrar").off("click").on("click", function (e) {
            e.preventDefault(e);

            if (codinscr != "") {
                $.ajax({
                    type: "GET",
                    url: "../controlador/ctr_borrar_inscr.php",
                    data: {
                        codinscr: codinscr
                    },
                    success: function () {
                        ActualizarContenidoInscripcion();
                        $("#md_borrar").modal("hide");
                    }
                });
            }
        });
    });

    //MODAL MOSTRAR INFORMACION INSCRIPCION (FUNCIONA)
    $(document).on("click", ".reg_inscripcion .btn_mostrar", function (e) {
        e.preventDefault(e);

        let codinscr = $(this).closest(".reg_inscripcion").children(".codinscr").text();

        if (codinscr != "") {
            $.ajax({
                type: "POST",
                url: "../controlador/ctr_mostrar_inscr.php",
                data: {
                    codinscr: codinscr
                },
                success: function (rpta) {

                    let rp = JSON.parse(rpta);

                    console.log(rp);

                    $("#md_mostrar .codinscr").text("");
                    $("#md_mostrar .numbol").text("");
                    $("#md_mostrar .cli").text("");
                    $("#md_mostrar .serv").text("");
                    $("#md_mostrar .prom").text("");
                    $("#md_mostrar .emi").text("");
                    $("#md_mostrar .cad").text("");
                    $("#md_mostrar .dias_rest").text("");
                    $("#md_mostrar .prec").text("");
                    $("#md_mostrar .pag").text("");
                    $("#md_mostrar .met").text("");
                    $("#md_mostrar .deu").text("");
                    $("#md_mostrar .est").text("");

                    $("#md_mostrar .codinscr").text(rp.codigo_inscripcion);
                    $("#md_mostrar .numbol").text(rp.numboleta);
                    $("#md_mostrar .cli").text(rp.nombre_cliente);
                    $("#md_mostrar .serv").text(rp.nombre_servicio);
                    $("#md_mostrar .prom").text(rp.nombre_promocion);
                    $("#md_mostrar .emi").text(rp.emision);
                    $("#md_mostrar .cad").text(rp.caducidad);
                    $("#md_mostrar .dias_rest").text(rp.dias_restantes);
                    $("#md_mostrar .prec").text(rp.precio);
                    $("#md_mostrar .pag").text(rp.pago);
                    $("#md_mostrar .met").text(rp.nombre_metodo_pago);
                    $("#md_mostrar .deu").text(rp.deuda);
                    $("#md_mostrar .est").text(rp.estado);

                    $("#md_mostrar").modal("show");
                }
            });
        }
    });

    //MODAL CONSULTAR INSCRIPCION
    $("#frm_consultar_inscr #txt_codinscr").focusout(function (e) {

        e.preventDefault();
        // Capturar el valor ingresado en el cuadro de texto
        let codinscr = $(this).val();

        if (codinscr != "") {
            // Implementar la consulta por medio de AJAX para JQuery 
            $.ajax({
                url: "../controlador/ctr_consultar_inscr.php",
                type: "POST",
                data: { codinscr: codinscr },
                success: function (rpta) {
                    let rp = JSON.parse(rpta);

                    console.log(rp);

                    if (rp) {
                        $(".numbol").html(rp.numboleta);
                        $(".cli").html(rp.nombre_cliente);
                        $(".serv").html(rp.nombre_servicio);
                        $(".prom").html(rp.nombre_promocion);
                        $(".emi").html(rp.emision);
                        $(".cad").html(rp.caducidad);
                        $(".dias_rest").html(rp.dias_restantes);
                        $(".prec").html("S/. " + rp.precio);
                        $(".pag").html("S/. " + rp.pago);
                        $(".met").html(rp.nombre_metodo_pago);
                        $(".deu").html("S/. " + rp.deuda);

                        if (rp.estado == "Vigente") {
                            $(".est").html('<span class="badge rounded-pill bg-success text-white">' + rp.estado + '</span>')
                        } else if (rp.estado == "Próximo" || rp.estado == "Proximo") {
                            $(".est").html('<span class="badge rounded-pill bg-warning text-white">' + rp.estado + '</span>')
                        } else {
                            $(".est").html('<span class="badge rounded-pill bg-danger text-white">' + rp.estado + '</span>')
                        }

                    } else {
                        $('#md_consulta .modal-body').html("<p>El codigo <b>" + codinscr + "</b> no existe</p>");
                        $('#md_consulta').modal('show');
                        $("#txt_codinscr").val("");

                        let vacio = "&nbsp;";

                        $(".numbol").html(vacio);
                        $(".cli").html(vacio);
                        $(".serv").html(vacio);
                        $(".prom").html(vacio);
                        $(".emi").html(vacio);
                        $(".cad").html(vacio);
                        $(".dias_rest").html(vacio);
                        $(".prec").html(vacio);
                        $(".pag").html(vacio);
                        $(".met").html(vacio);
                        $(".deu").html(vacio);
                        $(".est").html(vacio);

                        $("#txt_codinscr").focus();
                    }
                }
            });
        }
    });

    //MODAL FILTRAR INSCRIPCION
    $("#form_filtrar_inscr").submit(function (e) {
        e.preventDefault();

        var valor = $("#txt_valor").val();

        if (valor != "") {
            $.post("../controlador/ctr_filtrar_inscr.php",
                { valor: valor },
                function (rpta) {
                    $('#md_aviso .modal-header').removeClass('bg-danger');
                    $('#md_aviso .modal-header').addClass('bg-primary');

                    $('#md_aviso .modal-dialog').removeClass('modal-md');
                    $('#md_aviso .modal-dialog').addClass('modal-xl');

                    $('#md_aviso .modal-title').html('');
                    $('#md_aviso .modal-title').html('Clientes Filtrados');

                    $('#md_aviso .modal-body').html("<div id='tabla'></div>")

                    $("#tabla").html(rpta);

                    $('#md_aviso').modal('show');

                    $('#txt_valor').focus();
                });
        } else {
            $('#md_aviso .modal-header').removeClass('bg-primary');
            $('#md_aviso .modal-header').addClass('bg-danger');

            $('#md_aviso .modal-dialog').removeClass('modal-xl');
            $('#md_aviso .modal-dialog').addClass('modal-md');

            $('#md_aviso .modal-title').html('');
            $('#md_aviso .modal-title').html('Advertencia');

            $("#tabla").html("");

            $('#md_aviso .modal-body').html("<p><b>No haz ingresado un dato para buscar...</b></p>")

            $('#md_aviso').modal('show');
            $("#txt_valor").focus();
        }
    });

});