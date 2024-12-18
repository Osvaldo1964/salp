var page;


function execDatatable(text) {

    /* Valido Tabla Administradores */
    if ($(".tableAdmins").length > 0) {

        var url = "ajax/data-admins.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_user" },
            { "data": "picture_user", "orderable": false, "search": false },
            { "data": "fullname_user" },
            { "data": "username_user" },
            { "data": "email_user" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "admins";
    }

    /* Valido Tabla Usuarios */
    if ($(".tableUsers").length > 0) {

        var url = "ajax/data-users.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_user" },
            { "data": "picture_user", "orderable": false, "search": false },
            { "data": "fullname_user" },
            { "data": "username_user" },
            { "data": "email_user" },
            { "data": "address_user" },
            { "data": "phone_user" }
        ];

        page = "users";
    }

    /* CONFIGURA DATATABLE PARA PQRs */

    /* Valido Tabla Cuadrillas*/
    if ($(".tableCrews").length > 0) {

        var url = "ajax/data-crews.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_crew" },
            { "data": "name_crew" },
            { "data": "driver_crew" },
            { "data": "tecno_crew" },
            { "data": "assist_crew" },
            { "data": "status_crew" },
            { "data": "date_created_crew" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "crews";
    }

    /* CONFIGURA DATATABLE PARA ELEMENTOS */

    /* Valido Tabla Potencias*/
    if ($(".tablePowers").length > 0) {

        var url = "ajax/data-powers.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_power" },
            { "data": "name_power" },
            { "data": "date_created_power" },
            { "data": "status_power" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "powers";
    }

    /* Valido Tabla Clases*/
    if ($(".tableClasses").length > 0) {

        var url = "ajax/data-classes.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_class" },
            { "data": "name_class" },
            { "data": "life_class" },
            { "data": "date_created_class" },
            { "data": "status_class" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "classes";
    }

    /* Valido Tabla Recursos*/
    if ($(".tableResources").length > 0) {

        var url = "ajax/data-resources.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_resource" },
            { "data": "name_resource" },
            { "data": "date_created_resource" },
            { "data": "status_resource" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "resources";
    }

    /* Valido Tabla Usos */
    if ($(".tableRouds").length > 0) {

        var url = "ajax/data-rouds.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_roud" },
            { "data": "code_roud" },
            { "data": "name_roud" },
            { "data": "date_created_roud" },
            { "data": "status_roud" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "rouds";
    }

    /* Valido Tabla Materiales */
    if ($(".tableMaterials").length > 0) {

        var url = "ajax/data-materials.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_material" },
            { "data": "name_material" },
            { "data": "date_created_material" },
            { "data": "status_material" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "materials";
    }

    /* Valido Tabla Tecnologías */
    if ($(".tableTechnologies").length > 0) {

        var url = "ajax/data-technologies.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_technology" },
            { "data": "name_technology" },
            { "data": "date_created_technology" },
            { "data": "status_technology" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "technologies";
    }

    /* Valido Tabla Transformadores */
    if ($(".tableTransformers").length > 0) {

        var url = "ajax/data-transformers.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_transformer" },
            { "data": "code_transformer" },
            { "data": "power_transformer" },
            { "data": "address_transformer" },
            { "data": "latitude_transformer" },
            { "data": "longitude_transformer" },
            { "data": "type_transformer" },
            { "data": "class_transformer" },
            { "data": "number_delivery" },
            { "data": "date_created_transformer" },
            { "data": "status_transformer" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "transformers";
    }

    /* Valido Tabla Transformadores */
    if ($(".tablePoles").length > 0) {

        var url = "ajax/data-poles.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_pole" },
            { "data": "code_pole" },
            { "data": "name_material" },
            { "data": "name_height" },
            { "data": "address_pole" },
            { "data": "latitude_pole" },
            { "data": "longitude_pole" },
            { "data": "cost_pole" },
            { "data": "number_delivery" },
            { "data": "date_created_pole" },
            { "data": "status_pole" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "poles";
    }

    /* Valido Tabla Elementos */
    if ($(".tableElements").length > 0) {

        var url = "ajax/data-elements.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_element" },
            { "data": "code_element" },
            { "data": "name_element" },
            { "data": "date_created_element" },
            { "data": "status_element" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "elements";
    }

    
    /* Valido Tabla Luminarias */
    if ($(".tableLuminaries").length > 0) {

        var url = "ajax/data-luminaries.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_luminary" },
            { "data": "code_luminary" },
            { "data": "name_technology" },
            { "data": "name_power" },
            { "data": "code_transformer" },
            { "data": "code_pole" },
            { "data": "number_delivery" },
            { "data": "date_created_luminary" },
            { "data": "status_luminary" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "luminaries";
    }

    /* FIN CONFIGURA DATATABLE PARA ELEMENTOS */

    /* CONFIGURAR DATOS PARA ACTAS */

    /* Valido Tabla Tipos de Actas */
    if ($(".tableTypedeliveries").length > 0) {

        var url = "ajax/data-typedeliveries.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_typedelivery" },
            { "data": "code_typedelivery" },
            { "data": "name_typedelivery" },
            { "data": "date_created_typedelivery" },
            { "data": "status_typedelivery" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "typedeliveries";
    }

    /* Valido Tabla Items de Actas */
    if ($(".tableItemdeliveries").length > 0) {

        var url = "ajax/data-itemdeliveries.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_itemdelivery" },
            { "data": "code_itemdelivery" },
            { "data": "name_typedelivery" },
            { "data": "name_itemdelivery" },
            { "data": "date_created_itemdelivery" },
            { "data": "status_itemdelivery" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "itemdeliveries";
    }

    /* Valido Tabla Actas */
    if ($(".tableDeliveries").length > 0) {

        var url = "ajax/data-deliveries.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_delivery" },
            { "data": "name_typedelivery" },
            { "data": "name_itemdelivery" },
            { "data": "number_delivery" },
            { "data": "name_resource" },
            { "data": "date_delivery" },
            { "data": "date_created_delivery" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "deliveries";
    }

    /* CONFIGURAR DATOS PARA ACTAS */

    /* Valido Tabla Cuadrillas*/
    if ($(".tableCrews").length > 0) {

        var url = "ajax/data-crews.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_crew" },
            { "data": "name_crew" },
            { "data": "driver_crew" },
            { "data": "tecno_crew" },
            { "data": "assist_crew" },
            { "data": "status_crew" },
            { "data": "date_created_crew" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "crews";
    }

    /* Valido Tabla Cuadrillas*/
    if ($(".tablePqrs").length > 0) {

        var url = "ajax/data-setpqrs.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_pqr" },
            { "data": "name_pqr" },
            { "data": "email_pqr" },
            { "data": "address_pqr" },
            { "data": "message_pqr" },
            { "data": "date_created_pqr" },
            { "data": "status_pqr" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "setpqrs";
    }

    /* FIN CONFIGURA DATATABLE PARA PQRs */

    /* Valido Tabla Marcas */
    if ($(".tableBrands").length > 0) {

        var url = "ajax/data-brands.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_brand" },
            { "data": "name_brand" },
            { "data": "date_created_brand" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "brands";
    }

     /* TABLAS PARA FACTURACION - RECAUDOS */

        /* Valido Tabla Estratos */
        if ($(".tableUses").length > 0) {

            var url = "ajax/data-uses.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")
    
            var columns = [
                { "data": "id_use" },
                { "data": "name_use" },
                { "data": "amount_use" },
                { "data": "minimal_use" },
                { "data": "actions", "orderable": false, "search": false }
            ];
    
            page = "uses";
        }

    /* Valido Tabla Costo Energia */
    if ($(".tableEnergies").length > 0) {

        var url = "ajax/data-energies.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_energy" },
            { "data": "name_lender" },
            { "data": "period_energy" },
            { "data": "bill_energy" },
            { "data": "amount_energy" },
            { "data": "fee_energy" },
            { "data": "total_energy" },
            { "data": "date_created_energy" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "energies";
    }

    /* FIN TABLAS PARA FACTURACION - RECAUDOS */

    /* Valido Tabla Sujetos */
    if ($(".tableSubjects").length > 0) {

        var url = "ajax/data-subjects.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_subject" },
            { "data": "typedoc_subject" },
            { "data": "numdoc_subject" },
            { "data": "fullname_subject" },
            { "data": "country_subject" },
            { "data": "city_subject" },
            { "data": "address_subject" },
            { "data": "email_subject" },
            { "data": "phone_subject" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "subjects";
    }

    /* Valido Tabla Títulos */
    if ($(".tableTitles").length > 0) {

        var url = "ajax/data-titles.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_title" },
            { "data": "number_title" },
            { "data": "date_title" },
            { "data": "type_title" },
            { "data": "fullname_subject" },
            { "data": "amount_title" },
            { "data": "interest_title" },
            { "data": "number_payorder" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "titles";
    }

    /* Valido Tabla Mandamientos */
    if ($(".tablePayorders").length > 0) {

        var url = "ajax/data-payorders.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_payorder", width: "10px" },
            { "data": "type_payorder", width: "10px" },
            { "data": "number_payorder", width: "10px" },
            { "data": "date_payorder", width: "30px" },
            { "data": "number_title", width: "10px" },
            { "data": "date_title", width: "10px" },
            { "data": "typedoc_subject", width: "10px" },
            { "data": "numdoc_subject", width: "10px" },
            { "data": "fullname_subject", width: "80px" },
            { "data": "email_subject", width: "80px" },
            {
                "data": "amount_payorder", width: "10px",
                render: function (data, type) {
                    var number = DataTable.render
                        .number(',', '.', 2, '$')
                        .display(data);

                    if (type === 'display') {
                        let color = 'green';
                        if (data < 1) {
                            color = 'red';
                        }
                        else if (data < 500000) {
                            color = 'orange';
                        }

                        return `<span style="color:${color}">${number}</span>`;
                    }

                    return number;
                }
            },
            {
                "data": "interest_payorder", width: "10px",
                render: function (data, type) {
                    var number = DataTable.render
                        .number(',', '.', 2, '$')
                        .display(data);

                    if (type === 'display') {
                        let color = 'green';
                        if (data < 1) {
                            color = 'red';
                        }
                        return `<span style="color:${color}">${number}</span>`;
                    }

                    return number;
                }
            },
            { "data": "status_payorder" },
            { "data": "date_created_payorder", width: 250 },
            { "data": "follow_payorder", width: 300 }
        ];

        page = "payorders";
    }

    /* Valido Tabla Diseño Documentos */
    if ($(".tableReports").length > 0) {

        var url = "ajax/data-reports.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user")

        var columns = [
            { "data": "id_report" },
            { "data": "title_report" },
            { "data": "name_report" },
            { "data": "actions", "orderable": false, "search": false }
        ];

        page = "reports";
    }

    var adminsTable = $("#adminsTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "aLengthMenu": [[5, 10, 50, 100], [5, 10, 50, 100]],
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "order": [[0, "desc"]],
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "columns": columns,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "buttons": [
            { extend: "copy", className: "btn-info" },
            { extend: "csv", className: "btn-info" },
            { extend: "excel", className: "btn-info" },
            { extend: "pdf", className: "btn-info", orientation: "landscape" },
            { extend: "print", className: "btn-info" },
            { extend: "colvis", className: "btn-info" }
        ],
        //{ extend: "colvis", className: "btn-info" }
        fnDrawCallback: function (oSettings) {
            if (oSettings.aoData.length == 0) {
                $('.dataTables_paginate').hide();
                $('.dataTables_info').hide();
            }
        }
    })

    if (text == "flat") {
        $("#adminsTable").on("draw.dt", function () {
            setTimeout(function () {
                adminsTable.buttons().container().appendTo('#adminsTable_wrapper .col-md-6:eq(0)');
            }, 100)
        })
    }
};

execDatatable("html");

/* Funcion para Activar Botones de Reporte */
function reportActive(event) {
    if (event.target.checked) {
        $("#adminsTable").dataTable().fnClearTable();
        $("#adminsTable").dataTable().fnDestroy();
        setTimeout(function () {
            execDatatable("flat");
        }, 100)
    } else {
        $("#adminsTable").dataTable().fnClearTable();
        $("#adminsTable").dataTable().fnDestroy();
        setTimeout(function () {
            execDatatable("html");
        }, 100)
    }
}

/* Boton para rangos de fechas */
$('#daterange-btn').daterangepicker(
    {
        "locale": {
            "format": "YYYY-MM-DD",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Rango Personalizado",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
            'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Ultimo mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Este Año': [moment().startOf('year'), moment().endOf('year')],
            'Último Año': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        },
        startDate: moment($("#between1").val()),
        endDate: moment($("#between2").val())
    },
    function (start, end) {
        //$('#reportrange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
        //window.location = "/cuadrillas";
        window.location = page + "?start=" + start.format('YYYY-MM-DD') + "&end=" + end.format('YYYY-MM-DD');
    },
)

/* Eliminar registro */

$(document).on("click", ".removeItem", function () {

    var idItem = $(this).attr("idItem");
    var table = $(this).attr("table");
    var suffix = $(this).attr("suffix");
    var deleteFile = $(this).attr("deleteFile");
    var page = $(this).attr("page");

    fncSweetAlert("confirm", "Esta seguro de borrar este registro?", "").then(resp => {
        if (resp) {
            var data = new FormData();
            data.append("idItem", idItem);
            data.append("table", table);
            data.append("suffix", suffix);
            data.append("token", localStorage.getItem("token_user"));
            data.append("deleteFile", deleteFile);

            $.ajax({
                url: "ajax/ajax-delete.php",
                method: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    //console.log(response);
                    if (response == 200) {
                        fncSweetAlert(
                            "success",
                            "El registro fue eliminado",
                            "/" + page
                        );
                    } else if (response == "no delete") {
                        fncSweetAlert(
                            "error",
                            "El registro tiene datos relacionados",
                            "/" + page
                        );
                    } else {
                        fncNotie(3, "Error al eliminar el registro");
                    }
                }
            })
        }
    })
})


/* Función para actualizar procesos*/

$(document).on("click", ".nextProcess", function () {

    /* Limpiamos la ventana modal */

    $(".orderBody").html("");

    var idPayorder = $(this).attr("idPayorder");
    var processPayorder = JSON.parse(atob($(this).attr("processPayorder")));
    //var email_subject = $(this).attr("idPayorder");
    var actual;

    /* Nombramos la ventana modal con el id de la orden */

    $(".modal-title span").html("Mandamiento ID No. " + idPayorder);

    /* Quitamos la opción de llenar el campo de recibido si no se ha enviado el producto */

    processPayorder.forEach((value, index) => {
        if (processPayorder[index].status == "pending") {
            actual = index;
        }
        processPayorder.splice(actual + 1, 6 - actual);
    })

    /* Información dinámica que aparecerá en la ventana modal */

    processPayorder.forEach((value, index) => {

        let date = "";
        let status = "";
        let comment = "";

        if (value.status == "ok") {

            date = `<div class="col-10 p-3 font-sm">
              <input type="date" class="form-control" value="`+ value.date + `" readonly>
          </div>`;

            status = `<div class="col-10 mt-1 p-3">
                <div class="text-uppercase">`+ value.status + `</div>
              </div>`;

            comment = `<div class="col-10 p-3">   
                <textarea class="form-control" readonly>`+ value.comment + `</textarea>
            </div>`;

        } else {

            date = `<div class="col-10 p-3">
              <input type="date" class="form-control" name="date" value="`+ value.date + `" required>
          </div>`;

            status = `<div class="col-10 mt-1 p-3">
                    <input type="hidden" name="stage" value="`+ value.stage + `">
                    <input type="hidden" name="processPayorder" value="`+ $(this).attr("processPayorder") + `">
                    <input type="hidden" name="idPayorder" value="`+ idPayorder + `">
                    <input type="hidden" name="clientPayorder" value="`+ $(this).attr("clientPayorder") + `">
                    <input type="hidden" name="emailPayorder" value="`+ $(this).attr("emailPayorder") + `">

                    <div class="custom-control custom-radio custom-control-inline">
                      <input 
                          id="status-pending" 
                          type="radio" 
                          class="custom-control-input" 
                          value="pending" 
                          name="status" 
                          checked>

                          <label  class="custom-control-label" for="status-pending">Pending</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                      <input 
                          id="status-ok" 
                          type="radio" 
                          class="custom-control-input" 
                          value="ok" 
                          name="status" 
                          >

                          <label  class="custom-control-label" for="status-ok">Ok</label>
                    </div>
        </div>`;

            comment = `<div class="col-10 p-3">   
                <textarea class="form-control" name="comment" required>`+ value.comment + `</textarea>
            </div>`;

        }

        $(".orderBody").append(`

       <div class="card-header text-uppercase">`+ value.stage + `</div> 
       <div class="card-body">
         
          <!-- Bloque Fecha -->
          <div class="form-row">
            <div class="col-2 text-right">
                <label class="p-3 lead">Date:</label>
            </div>
            `+ date + `
          </div>

          <!-- Bloque Status -->
          <div class="form-row">
            <div class="col-2 text-right">
                <label class="p-3 lead">Status:</label>
            </div>
            `+ status + `
          </div> 

          <!--=====================================
            Bloque Comentarios
          ======================================-->

          <div class="form-row">

            <div class="col-2 text-right">
                <label class="p-3 lead">Comment:</label>
            </div>
            `+ comment + `
          </div>
        </div>
    `)
    })
    $("#nextProcess").modal()
})

