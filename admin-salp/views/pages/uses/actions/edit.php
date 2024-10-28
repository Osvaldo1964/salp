<?php
if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "id_use,name_use,amount_use,minimal_use,status_use,date_created_use";
        $url = "uses?select=" . $select . "&linkTo=id_use&equalTo=" . $security[0];;
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);
        if ($response->status == 200) {
            $uses = $response->results[0];
        } else {
            echo '<script>
				window.location = "/uses";
				</script>';
        }
    } else {
        echo '<script>
				window.location = "/uses";
				</script>';
    }
}
?>
<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $uses->id_use ?>" name="idUse">
        <div class="card-header">
            <?php
            require_once "controllers/uses.controller.php";
            $create = new usesController();
            $create->edit($uses->id_use);
            ?>

            <div class="col-md-8 offset-md-2">

                <!-- Descripción Cuadrilla -->
                <div class="form-group mt-1">
                    <label>Descripción</label>
                    <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="name" value="<?php echo $uses->name_use ?>" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group col-md-4">
                    <!-- Tarifa -->
                    <label>Valor</label>
                    <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="amount" value="<?php echo $uses->amount_use ?>" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group col-md-4">
                    <!-- Valor Mínimo -->
                    <label>Valor</label>
                    <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="minimal" value="<?php echo $uses->minimal_use ?>" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>


            </div>
        </div>

        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-1">
                    <a href="/uses" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-right">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>