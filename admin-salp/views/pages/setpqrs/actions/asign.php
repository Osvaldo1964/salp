<?php
if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "*";
        $url = "relations?rel=pqrs,crews&type=pqr,crew&select=" .
            $select . "&linkTo=id_pqr&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);

        if ($response->status == 200) {
            $pqrs = $response->results[0];
        } else {
            echo '<script>
				window.location = "/setpqrs";
				</script>';
        }
    } else {
        echo '<script>
				window.location = "/setpqrs";
				</script>';
    }
}
?>

<div class="card card-dark card-outline col-md-4">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
            <h5>Asignación de Cuadrilla</h5>
            <?php
            require_once "controllers/pqrs.controller.php";
            $create = new PqrsController();
            $create->asign($pqrs->id_pqr);
            ?>
        </div>
        <div class="card-body">
            <!-- Numero de Pqr  -->
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>No. Pqr</label>
                    <input type="text" class="form-control" value="<?php echo $pqrs->id_pqr ?>" name="idPqr">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>

            <!-- Fecha de Asignación -->
            <div class="form-group col-md-6">
                <div class="input-group-append">
                    <span class="input-group-text">
                        Fecha :
                    </span>
                    <input type="date" class="form-control" name="dateasign">
                </div>

                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <!-- Cadrilla -->
            <div class="form-group col-md-6">
                <label>Cuadrilla</label>
                <?php
                $url = "crews?select=id_crew,name_crew";
                $method = "GET";
                $fields = array();
                $crews = CurlController::request($url, $method, $fields)->results;
                ?>

                <div class="form-group">
                    <select class="form-control select2" name="crew" style="width:100%" required>
                        <option value="">Seleccione Cuadrilla</option>
                        <?php foreach ($crews as $key => $value) : ?>
                            <option value="<?php echo $value->id_crew ?>"><?php echo $value->name_crew ?></option>
                        <?php endforeach ?>
                    </select>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group submtit">
                    <a href="/setpqrs" class="btn btn-light border text-center">Regresar</a>
                    <a href='/setpqrs/solved/' . <?php echo base64_encode($pqrs->id_pqr . "~" . '9kkd92kladlsdkd') ?>   class='btn btn-success btn-sm mr-1 rounded-circle' title='Imprimir'>
			            		</a>
                    <button type="submit" class="btn bg-dark float-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>