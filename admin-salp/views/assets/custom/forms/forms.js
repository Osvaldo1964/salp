/* Validacion de formularios */
(function () {
  'use strict';
  window.addEventListener('load', function () {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

/* Función para validar datos repetidos */
function validateRepeat(event, type, table, suffix) {
  console.log(event);return;
  var data = new FormData();
  data.append("data", event.target.value);
  data.append("table", table);
  data.append("suffix", suffix);

  $.ajax({
    url: "ajax/ajax-validate.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {
      if (response == 200) {
        event.target.value = "";
        $(event.target).parent().addClass("was-validated");
        $(event.target).parent().children(".invalid-feedback").html("El dato escrito ya existe en la base de datos");
      } else {
        validateJS(event, type);
      }
    }
  })
}


/* Funcion para validar formularios */
function validateJS(event, type) {
  var pattern;
  if (type == "text") pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/;
  if (type == "t&n") pattern = /^[A-Za-z0-9]+([-])+([A-Za-z0-9]){1,}$/;
  if (type == "email") pattern = /^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;
  if (type == "pass") pattern = /^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/;
  if (type == "regex") pattern = /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/;
  if (type == "phone") pattern = /^[-\\(\\)\\0-9 ]{1,}$/;
  if (!pattern.test(event.target.value)) {
    $(event.target).parent().addClass("was-validated");
    $(event.target).parent().children(".invalid-feedback").html("El campo esta mal escrito");
  }
}

function validateLinesJS() {
  let nbrand = $('#brand').val();
  var data = new FormData();
  data.append("brandline", nbrand);

  $.ajax({
    url: "ajax/ajax-validate.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {
        $("#brandline").html(response);
      }
  })
}

/* Funcion para validar imagenes */
function validateImageJS(event, input) {
  var image = event.target.files[0];
  if (image["type"] !== "image/png" && image["type"] !== "image/jpeg" && image["type"] !== "image/gif") {
    fncNotie(3, "La imagen debe ser de formato JPG, PNG or GIF ");
    return;
  } else if (image["size"] > 2000000) {
    fncNotie(3, "La Imagen debe pesar menos de 2MB");
    return;
  } else {
    var data = new FileReader();
    data.readAsDataURL(image);
    $(data).on("load", function (event) {
      var path = event.target.result;
      $("." + input).attr("src", path);
    })
  }
}

/* Funcion para validar pdfs */
function validatePdfJS(event, input) {
  //console.log(event);
  var archivo = this.files[0]
  console.log(archivo);
  /*=============================================
    VALIDAMOS EL FORMATO SEA PDF
    =============================================*/

  if (archivo['type'] != 'application/pdf') {
    $('.nuevoArchivo').val('')

    swal({
      title: 'Error al subir el archivo',
      text: '¡La archivo debe estar en formato PDF!',
      type: 'error',
      confirmButtonText: '¡Cerrar!',
    })
  }
  /// Añadir validación de tamaño aquí mediante un else if...
}

/* Funcion para recordar un Usuario */
function rememberMe(event) {
  if (event.target.checked) {
    localStorage.setItem("emailRemember", $('[name="loginEmail"]').val());
    localStorage.setItem("checkRemember", true);
  } else {
    localStorage.removeItem("emailRemember");
    localStorage.removeItem("checkRemember");
  }
}

/* Funcion para Capturar el Usuario desde localStorage */

$(document).ready(function () {
  if (localStorage.getItem("emailRemember") != null) {
    $('[name="loginEmail"]').val(localStorage.getItem("emailRemember"));
  }
  if (localStorage.getItem("checkRemember") != null) {
    $("#remember").prop("checked", true);
  }
})

/* Activar Bootstrap Switch */
$("input[data-bootstrap-switch]").each(function () {
  $(this).bootstrapSwitch('state', $(this).prop('checked'));
})


//Initialize Select2 Elements
$('.select2').select2({
  theme: 'bootstrap4'
})

/* Capturar código telefonico */
$(document).on("change", ".changeCountry", function () {
  //console.log("$(this.val()", $(this).val().split("_")[1]);
  $(".dialCode").html($(this).val().split("_")[1]);
})

/* Función para crear Url's */

function createUrl(event, name) {

  var value = event.target.value;
  value = value.toLowerCase();
  value = value.replace(/[#\\;\\$\\&\\%\\=\\(\\)\\:\\,\\.\\¿\\¡\\!\\?\\]/g, "");
  value = value.replace(/[ ]/g, "-");
  value = value.replace(/[á]/g, "a");
  value = value.replace(/[é]/g, "e");
  value = value.replace(/[í]/g, "i");
  value = value.replace(/[ó]/g, "o");
  value = value.replace(/[ú]/g, "u");
  value = value.replace(/[ñ]/g, "n");

  $('[name="' + name + '"]').val(value);
}

/* Tags Input */
if ($('.tags-input').length > 0) {

  $('.tags-input').tagsinput({
    maxTags: 10
  });

}


/*=============================================
Plugin Summernote
=============================================*/

$(".summernote").summernote({

  placeholder: '',
  tabsize: 2,
  height: 400,
  toolbar: [
    ['misc', ['codeview', 'undo', 'redo']],
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['para', ['style', 'ul', 'ol', 'paragraph', 'height']],
    ['insert', ['link', 'picture', 'hr']]
  ]

});

/* Formatear fecha */

function formDate(date) {
  var day = date.getDate();
  var month = date.getMonth();
  var year = date.getFullYear();

  return year + '-' + month + '-' + day;
}

/* Crear Proceso de seguimiento del Mandamiento */

function newPayOrder() {

  var moment = new Date();

  var processPayorder = [
    {
      "stage": "Apertura",
      "status": "ok",
      "comment": "Inicio del Proceso de Jurisdicción Coactiva",
      "result": "true",
      "date": formDate(moment)
    },
    {
      "stage": "Citación",
      "status": "pending",
      "comment": "Envío por correo de la Notificación de Apertura del Proceso",
      "result": "true",
      "date": formDate(moment)
    },
    {
      "stage": "Notificación",
      "status": "pending",
      "comment": "Notificación del Mandamiento por correo",
      "result": "true",
      "date": moment.setDate(moment.getDate() + 10)
    },
    {
      "stage": "Resultado Notificación",
      "status": "pending",
      "comment": "Se registra la guia de la Notificación y el Resultado de la misma.",
      "result": "true",
      "date": moment.setDate(moment.getDate() + 60)
    },
    {
      "stage": "Aviso",
      "status": "pending",
      "comment": "Si el resultado de la Notificación es negativo se genera Aviso via WEB.",
      "result": "true",
      "date": moment.setDate(moment.getDate() + 60)
    },
    {
      "stage": "Medidas Cautelares",
      "status": "pending",
      "comment": "Se generan medidas cautelares en contra del deudor.",
      "result": "true",
      "date": moment.setDate(moment.getDate() + 65)
    },
    {
      "stage": "Liquidación",
      "status": "pending",
      "comment": "Se termina el proceso por pago o por tiempos.",
      "result": "true",
      "date": moment.setDate(moment.getDate() + 1800)
    }
  ]
}

function fntBarcode(e) {
  let codigo = document.querySelector("#txtcodElemento").value;
  JsBarcode("#barcode", codigo);
}

function fntPrintBarcode(area) {
  let elemntArea = document.querySelector(area);
  let vprint = window.open(' ', 'popimpr', 'height=400, width=600');
  vprint.document.write(elemntArea.innerHTML);
  vprint.document.close();
  vprint.print();
  vprint.close();
}