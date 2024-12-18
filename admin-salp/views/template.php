<?php
session_start();
/* Capturo la ruta de la URL */
//echo '<pre>'; print_r($_SERVER['REQUEST_URI']); echo '</pre>';
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

/* Limpio la URL de variables GET*/
foreach ($routesArray as $key => $value) {
  $value = explode("?", $value)[0];
  $routesArray[$key] = $value;
}
//echo '<pre>'; print_r($routesArray); echo '</pre>';exit;
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISTEMA DE ALUMBRADO PUBLICO</title>

  <!-- Traigo la ruta base -->
  <base href="<?php echo TemplateController::path(); ?>">

  <link rel="icon" href="views/assets/img/template/icono.ico">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="views/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="views/assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="views/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Material Preloader -->
  <link rel="stylesheet" href="views/assets/plugins/material-preloader/material-preloader.css">
  <!-- Notie Alert -->
  <link rel="stylesheet" href="views/assets/plugins/notie/notie.css">
  <!-- Linear Icons -->
  <link rel="stylesheet" href="views/assets/plugins/linearicons/linearicons.css">
  <!-- Tags Input -->
  <link rel="stylesheet" href="views/assets/plugins/tags-input/tags-input.css">
  <!-- summernote -->
  <link rel="stylesheet" href="views/assets/plugins/summernote/summernote-bs4.min.css">
  <!-- dropzone-->
  <link rel="stylesheet" href="views/assets/plugins/dropzone/dropzone.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="views/assets/plugins/adminlte/css/adminlte.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="views/assets/custom/template/template.css">

  <!-- jQuery -->
  <script src="views/assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="views/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="views/assets/plugins/adminlte/js/adminlte.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="views/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- Select2 -->
  <script src="views/assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- Material Preloader -->
  
  <!-- https://www.jqueryscript.net/loading/Google-Inbox-Style-Linear-Preloader-Plugin-with-jQuery-CSS3.html -->
  <script src="views/assets/plugins/material-preloader/material-preloader.js"></script>
    <!-- Notie Alert -->
  <!-- https://jaredreich.com/notie/ -->
  <!-- https://github.com/jaredreich/notie -->
  <script src="views/assets/plugins/notie/notie.min.js"></script>
  <!-- Sweet Alert -->
  <!-- https://sweetalert2.github.io/ -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- tags-inputs -->
  <script src="views/assets/plugins/tags-input/tags-input.js"></script>
  <!-- Summernote 
  https://github.com/summernote/summernote/-->
  <script src="views/assets/plugins/summernote/summernote-bs4.min.js"></script>

  <script src="views/assets/plugins/JsBarcode.all.min.js"></script>
  
  <!-- Dropzone
  https://docs.dropzone.dev/-->
  <script src="views/assets/plugins/dropzone/dropzone.js"></script>

  <?php if (!empty($routesArray[1]) && !isset($routesArray[2])) : ?>
    <?php if (
      $routesArray[1] == "settings" ||
      $routesArray[1] == "reports" ||
      $routesArray[1] == "admins" ||
      $routesArray[1] == "users" ||
      $routesArray[1] == "crews" ||
      $routesArray[1] == "pqrs" ||
      $routesArray[1] == "setpqrs" ||
      $routesArray[1] == "infpqrs" ||
      $routesArray[1] == "powers" ||
      $routesArray[1] == "classes" ||
      $routesArray[1] == "resources" ||
      $routesArray[1] == "rouds" ||
      $routesArray[1] == "materials" ||
      $routesArray[1] == "technologies" ||
      $routesArray[1] == "transformers" ||
      $routesArray[1] == "poles" ||
      $routesArray[1] == "luminaries" ||
      $routesArray[1] == "typedeliveries" ||
      $routesArray[1] == "itemdeliveries" ||
      $routesArray[1] == "deliveries" ||
      $routesArray[1] == "infinvval" ||
      $routesArray[1] == "inflinten" ||
      $routesArray[1] == "lenders" ||
      $routesArray[1] == "energies" ||
      $routesArray[1] == "uses" ||
      $routesArray[1] == "logout"
    ) : ?>

      <!-- DataTables  & Plugins -->
      <link rel="stylesheet" href="views/assets/plugins/daterangepicker/daterangepicker.css">
      <link rel="stylesheet" href="views/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="views/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="views/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

      <script src="views/assets/plugins/moment/moment.min.js"></script>
      <script src="views/assets/plugins/daterangepicker/daterangepicker.js"></script>
      <script src="views/assets/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="views/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="views/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="views/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="views/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="views/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="views/assets/plugins/jszip/jszip.min.js"></script>
      <script src="views/assets/plugins/pdfmake/pdfmake.min.js"></script>
      <script src="views/assets/plugins/pdfmake/vfs_fonts.js"></script>
      <script src="views/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="views/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="views/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <?php endif ?>
  <?php endif ?>

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <!-- Chart -->
  <script src="views/assets/plugins/chart/js/Chart.min.js"></script>
  <script src="views/assets/custom/alerts/alerts.js"></script>
</head>

<body class="hold-transition sidebar-mini text-sm accent-info">

  <?php
  if (!isset($_SESSION['user'])) {
    include "views/pages/login/login.php";
    echo '</body></head>';
    return;
  }
  ?>

  <?php if (isset($_SESSION['user'])) : ?>
    <!-- Site wrapper -->
    <div class="wrapper">

      <!-- Navbar -->
      <?php include "views/modules/navbar.php"; ?>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <?php include "views/modules/sidebar.php"; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <?php
        //echo '<pre>'; print_r($routesArray); echo '</pre>';

        foreach ($routesArray as $key => $value) {
          $value = explode("?", $value)[0];
          $routesArray[$key] = $value;
        }
        if (!empty($routesArray[1])) {
          if (
            $routesArray[1] == "settings" ||
            $routesArray[1] == "reports" ||
            $routesArray[1] == "admins" ||
            $routesArray[1] == "users" ||
            $routesArray[1] == "crews" ||
            $routesArray[1] == "pqrs" ||
            $routesArray[1] == "setpqrs" ||
            $routesArray[1] == "infpqrs" ||
            $routesArray[1] == "powers" ||
            $routesArray[1] == "classes" ||
            $routesArray[1] == "resources" ||
            $routesArray[1] == "rouds" ||
            $routesArray[1] == "materials" ||
            $routesArray[1] == "technologies" ||
            $routesArray[1] == "transformers" ||
            $routesArray[1] == "poles" ||
            $routesArray[1] == "luminaries" ||
            $routesArray[1] == "typedeliveries" ||
            $routesArray[1] == "itemdeliveries" ||
            $routesArray[1] == "deliveries" ||
            $routesArray[1] == "lenders" ||
            $routesArray[1] == "energies" ||
            $routesArray[1] == "infinvval" ||
            $routesArray[1] == "inflinten" ||
            $routesArray[1] == "uses" ||
            $routesArray[1] == "logout"
          ) {
            include "views/pages/" . $routesArray[1] . "/" . $routesArray[1] . ".php";
          } else {
            include "views/pages/404/404.php";
          }
        } else {
          include "views/pages/home/home.php";
        }
        ?>

        <!-- Content Header (Page header) -->
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <?php include "views/modules/footer.php"; ?>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

  <?php endif ?>

  <script src="views/assets/custom/forms/forms.js"></script>

</body>

</html>