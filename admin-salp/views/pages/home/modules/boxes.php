<?php 

/*=============================================
total de titulos
=============================================*/

$url = "titles?select=id_title";
$method = "GET";
$fields = array();
$titles = CurlController::request($url,$method,$fields); 

if($titles->status == 200){ 
  $titles = $titles->total;
}else{
  $titles = 0;
} 

/*=============================================
total de Deudores
=============================================*/
$url = "subjects?select=id_subject";
$subjects = CurlController::request($url,$method,$fields);

if($subjects->status == 200){ 
  $subjects = $subjects->total;
}else{
  $subjects = 0;
}  

/*=============================================
total de Mandamientos
=============================================*/ 

$url = "payorders?select=id_payorder";
$payorders = CurlController::request($url,$method,$fields); 

if($payorders->status == 200){ 
  $payorders = $payorders->total;
}else{
  $payorders = 0;
} 

/*=============================================
total de usuarios
=============================================*/
$url = "users?select=id_user";
$users = CurlController::request($url,$method,$fields);  

if($users->status == 200){ 
  $users = $users->total;
}else{
  $users = 0;
} 
?>


<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-alt"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Títulos</span>
        <span class="info-box-number">
          <?php echo $titles ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-check"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Deudores</span>
        <span class="info-box-number"><?php echo $subjects ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-signature"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Mandamientos</span>
        <span class="info-box-number"><?php echo $payorders ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Users</span>
        <span class="info-box-number"><?php echo $users ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>