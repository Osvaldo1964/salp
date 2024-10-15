let latitude;
let longitude;

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

    if (document.querySelector(".btnAddImage")) {
      let btnAddImage = document.querySelector(".btnAddImage");
      btnAddImage.onclick = function (e) {
          let key = Date.now();
          let newElement = document.createElement("div");
          newElement.id = "div" + key;
          newElement.innerHTML = `
          <div class="prevImage"></div>
          <input type="file" name="foto" id="img${key}" class="inputUploadfile">
          <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload"></i></label>
          <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
          document.querySelector("#containerImages").appendChild(newElement);
          document.querySelector("#div" + key + " .btnUploadfile").click();
          fntInputFile();
      }
  }
  }, false);
})();

/* Función para validar datos repetidos */
function validateRepeat(event, type, table, suffix) {
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

/* Patrones de formatos para campos en los inputs

  -> Solo numeros positivos con decimales -> "^(0|[1-9]\d*)(\.\d+)?$"
  -> Numeros negativos o positivos con decimales -> "^-?[0-9]*\.?[0-9]+$"
  -> Letras y numeros con punto y guion para direcciones -> [A-Za-z0-9.-]+

*/


/* Validar Lineas */
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

/* Validar Items Actas */
function validateItemsJS() {
  let ntypedelivery = $('#typedelivery').val();
  var data = new FormData();
  data.append("itemdelivery", ntypedelivery);
  
  $.ajax({
    url: "ajax/ajax-validate.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {
      $("#itemdelivery").html(response);
    }
  })
}

/* Validar Municipios */
function validateMunisJS() {
  let nbrand = $('#dpto').val();
  var data = new FormData();
  data.append("munis", nbrand);

  $.ajax({
    url: "ajax/ajax-validate.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {
      $("#munis").html(response);
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

  var archivo = this.files[0]
  console.log(archivo);
  /* VALIDAMOS EL FORMATO SEA PDF */

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

/* Plugin Summernote */
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

/*=============================================
DropZone
=============================================*/

Dropzone.autoDiscover = false;
var arrayFiles = [];
var countArrayFiles = 0;

if ($("[name='galleryElementOld']").length > 0 && $("[name='galleryElementOld']").val() != ""){
  var arrayFilesOld = JSON.parse($("[name='galleryElementOld']").val());
  var arrayFiles = JSON.parse($("[name='galleryElementOld']").val());
}

$(".dropzone").dropzone({
  url: "/",
  addRemoveLinks: true,
  acceptedFiles: "image/jpeg, image/png",
  maxFilesize: 2,
  maxFiles: 4,
  init: function () {
    this.on("addedfile", function (file) {
      countArrayFiles++;
      setTimeout(function () {
        arrayFiles.push({
          "file": file.dataURL,
          "type": file.type,
          "width": file.width,
          "height": file.height
        })
        $("[name='galleryElement']").val(JSON.stringify(arrayFiles));
      }, 100 * countArrayFiles);
    })

    this.on("removedfile", function (file) {
      console.log("file", file);
      countArrayFiles++;
      setTimeout(function () {
        var index = arrayFiles.indexOf({
          "file": file.dataURL,
          "type": file.type,
          "width": file.width,
          "height": file.height
        })

        arrayFiles.splice(index, 1);
        $("[name='galleryElement']").val(JSON.stringify(arrayFiles));
      }, 100 * countArrayFiles);

    })

    var myDropzone = this;
    $(".saveBtn").click(function () {
      if (arrayFiles.length >= 1) {
        $(this).attr("type","submit");
        myDropzone.processQueue();
      } else {
        $(this).attr("type","button");
        fncSweetAlert("error", "The gallery cannot be empty", null)
      }
    })
  }
})

/* Edición de Galería */

if ($("[name='galleryElementOld']").length > 0 && $("[name='galleryElementOld']").val() != "") {
  var arrayFilesOld = JSON.parse($("[name='galleryElementOld']").val());
}

var arrayFilesDelete = Array();

function removeGallery(elem) {
  $(elem).parent().remove();
  var index = arrayFilesOld.indexOf($(elem).attr("remove"));
  arrayFilesOld.splice(index, 1);
  console.log("arrayFilesOld", arrayFilesOld);
  $("[name='galleryElementOld']").val(JSON.stringify(arrayFilesOld));
  arrayFilesDelete.push($(elem).attr("remove"));
  $("[name='deleteGalleryElement']").val(JSON.stringify(arrayFilesDelete));
}

/* Funcion de Codigo de Barras */
if (document.querySelector("#code")) {
  let inputCodigo = document.querySelector("#code");
  inputCodigo.onkeyup = function () {
    if (inputCodigo.value.length >= 5) {
      document.querySelector("#divBarCode").classList.remove("notblock");
      fntBarcode();
      document.querySelector(".btnPrint").classList.remove("d-none");
    } else {
      document.querySelector("#divBarCode").classList.add("notblock");
    }
  }
}

/* Funcion para activar o desactivar atributos de elementos*/
function activeBlocks() {
  var selectElement = document.getElementById('classname');
  var selectedValue = selectElement.value;
  if (selectedValue == 1) {
    document.querySelector("#divTecno").classList.remove("notblock");
    document.querySelector("#divPotencia").classList.remove("notblock");
    document.querySelector("#divMaterial").classList.add("notblock");
    document.querySelector("#divAltura").classList.add("notblock");
  }
  if (selectedValue == 2) {
    document.querySelector("#divTecno").classList.add("notblock");
    document.querySelector("#divPotencia").classList.add("notblock");
    document.querySelector("#divMaterial").classList.remove("notblock");
    document.querySelector("#divAltura").classList.remove("notblock");
  }
  if (selectedValue == 3) { }
}

function fntBarcode(e) {
  let codigo = document.querySelector("#code").value;
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

function Actmap(){
  let addressmap = document.querySelector("#address").value;
  addressmap = addressmap + ', Santa Marta, Colombia';

  //console.log(addressmap);
  var data = new FormData();
  data.append("addressmap", addressmap);
 
  $.ajax({
    url: "controllers/pqrs.controller.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function(response) {
      console.log(response);
      data = JSON.parse(response);
      console.log(data['latitud']);
      latitude = data['latitud'];
      longitude = data['longitud'];
      initMap();
    }
  })


}

async function initMap() {
  // Variables para ubicarte en santa marta
  if(latitude === undefined || longitude === undefined)
    {
        latitude = 11.2084292;
        longitude = -74.2237886;
    }

  // Por si tiene la ubicación activada en el teléfono o navegador, las pilla de ahí y se las asigna
  if (typeof window.latitude !== 'undefined' && typeof window.longitude !== 'undefined') {

    this.latitude = window.latitude;
    this.longitude = window.longitude;
  }

  const position = { lat: latitude, lng: longitude };

  // Importas googlemaps
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  // Te ubica la dirección y te la pone en un zoom que te ambienta que tienes al rededor
  const map = new Map(document.getElementById("map"), {
    zoom: 16,
    center: position,
    mapId: "DEMO_MAP_ID",
  });

  // Te pone el mondaquito ese para que sepas exactamente donde estás
  const marker = new AdvancedMarkerElement({
    map: map,
    position: position,
    title: "Santa Marta",
  });
}