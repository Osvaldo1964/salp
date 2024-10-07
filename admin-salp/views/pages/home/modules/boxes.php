<?php 

/*=============================================
total de titulos
=============================================*/

$url = "pqrs?select=id_pqr";
$method = "GET";
$fields = array();
$pqrs = CurlController::request($url,$method,$fields); 

if($pqrs->status == 200){ 
  $pqrs = $pqrs->total;
}else{
  $pqrs = 0;
} 

/*=============================================
total de Luminarias
=============================================*/
$select = "id_element,id_class_element,id_technology_element,id_technology,name_technology,id_power_element,id_power,name_power";
$url = "relations?rel=elements,classes,technologies,powers&type=element,class,technology,power&select=" . $select . "&linkTo=id_class_element&equalTo=" . 1;
//"relations?select=id_subject";
$elements = CurlController::request($url,$method,$fields);
//echo '<pre>'; print_r($url); echo '</pre>';exit;

if($elements->status == 200){ 
  $elements = $elements->total;
}else{
  $elements = 0;
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
        <span class="info-box-text">PQRs</span>
        <span class="info-box-number">
          <?php echo $pqrs ?>
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
        <span class="info-box-text">Luminarias</span>
        <span class="info-box-number"><?php echo $elements ?></span>
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