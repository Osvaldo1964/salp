<?php
if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "*";
        $url = "relations?rel=poles,deliveries,materials,heights&type=pole,delivery,material,height&select=" . $select . "&linkTo=id_pole&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);
        //echo '<pre>'; print_r($response); echo '</pre>';exit;
        if ($response->status == 200) {
            $poles = $response->results[0];
        } else {
            echo '<script>
				window.location = "/poles";
				</script>';
        }
    } else {
        echo '<script>
				window.location = "/poles";
				</script>';
    }
}
?>

<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $poles->id_pole ?>" name="idPole">
        <div class="card-header">
            <?php
            require_once "controllers/poles.controller.php";
            $create = new PolesController();
            $create->edit($poles->id_pole);
            ?>

            <div class="row">
                <!-- Izquierda -->
                <div class="col-md-6">
                    <div class="row">
                        <!-- Seleccionar Acta de Ingreso -->
                        <div class="form-group col-md-6">
                            <label>No. Acta</label>
                            <?php
                            $url = "deliveries?select=id_delivery,number_delivery";
                            $method = "GET";
                            $fields = array();
                            $deliveries = CurlController::request($url, $method, $fields)->results;
                            ?>

                            <div class="form-group">
                                <select class="form-control select2" name="delivery" style="width:100%" required>
                                    <?php foreach ($deliveries as $key => $value) : ?>
                                        <?php if ($value->id_delivery == $poles->id_delivery_pole) : ?>
                                            <option value="<?php echo $poles->id_delivery_pole ?>" selected><?php echo $poles->number_delivery ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $value->id_delivery ?>"><?php echo $value->number_delivery ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <!-- Código Elemento -->
                        <div class="form-group col-md-6">
                            <label>Código</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" id="code" name="code" onchange="validateRepeat(event,'t&n','poles','code_pole')" value="<?php echo $poles->code_pole ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Seleccion Material -->
                        <div class="form-group col-md-4">
                            <label>Materiales</label>
                            <?php
                            $url = "materials?select=id_material,name_material";
                            $method = "GET";
                            $fields = array();
                            $materials = CurlController::request($url, $method, $fields)->results;
                            ?>

                            <div class="form-group">
                                <select class="form-control select2" id="material" name="material" style="width:100%">
                                    <?php foreach ($materials as $key => $value) : ?>
                                        <?php if ($value->id_material == $poles->id_material_pole) : ?>
                                            <option value="<?php echo $poles->id_material_pole ?>" selected><?php echo $poles->name_material ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $value->id_material ?>"><?php echo $value->name_material ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <!-- Seleccion altura -->
                        <div class="form-group col-md-4">
                            <label>Alturas</label>
                            <?php
                            $url = "heights?select=id_height,name_height";
                            $method = "GET";
                            $fields = array();
                            $heights = CurlController::request($url, $method, $fields)->results;
                            ?>

                            <div class="form-group">
                                <select class="form-control select2" id="height" name="height" style="width:100%">
                                    <?php foreach ($heights as $key => $value) : ?>
                                        <?php if ($value->id_height == $poles->id_height_pole) : ?>
                                            <option value="<?php echo $poles->id_height_pole ?>" selected><?php echo $poles->name_height ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $value->id_height ?>"><?php echo $value->name_height ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Detalles -->
                        <div class="form-group col-md-12">
                            <label>Detalles</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="detail" value="<?php echo $poles->detail_pole ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <!-- Dirección -->
                        <div class="form-group col-md-12">
                            <label>Dirección</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="address" value="<?php echo $poles->address_pole ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Latitud -->
                        <div class="form-group col-md-4">
                            <label>Latiud</label>
                            <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" name="latitude" value="<?php echo $poles->latitude_pole ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <!-- Longitud -->
                        <div class="form-group col-md-4">
                            <label>Longitud</label>
                            <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" name="longitude" value="<?php echo $poles->longitude_pole ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <!-- Precio del Poste -->
                            <label>Precio Elemento</label>
                            <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="cost" value="<?php echo $poles->cost_pole ?>">

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <!-- Galeria de Imagenes -->
                    <label>Galeria de Imagenes del Poste</label>
                    <div class="dropzone">
                        <?php foreach (json_decode($poles->gallery_pole, true) as $value) : ?>
                            <div class="dz-preview dz-file-preview">
                                <div class="dz-image">
                                    <img class="img-fluid" src="<?php echo TemplateController::srcImg() ?>views/img/poles/<?php echo $poles->code_pole ?>/<?= $value ?>" width="100%">
                                </div>
                                <a class="dz-remove" data-dz-remove remove="<?= $value ?>" onclick="removeGallery(this)">Eliminar archivo</a>
                            </div>
                        <?php endforeach ?>
                        <div class="dz-message">
                        </div>

                    </div>
                    <input type="hidden" name="galleryElementOld" value='<?= $poles->gallery_pole ?>'>
                    <input type="hidden" name="galleryElement">
                    <input type="hidden" name="deleteGalleryElement">
                </div>
                <!-- Derecha -->
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <!-- Muestro Código de Barras -->
                        <div class="form-group col-md-12">
                            <div id="divBarCode" style="display: flex; flex-direction:column; align-items:center;">
                                <div id="printCode">
                                    <svg id="barcode"></svg>
                                </div>
                                <button class="btn btn-success btn-sm" type="button" onClick="fntPrintBarcode('#printCode')"><i class="fas fa-print"></i> Imprimir</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <!-- Hoja de Vida del Poste -->
                            <div class="form-group mt-2">
                                <label>Hoja de Vida del Poste</label>
                                <textarea class="summernote" name="life" value="<?php echo $poles->life_poles ?>">
                                <?php echo html_entity_decode($poles->life_pole) ?>
                                </textarea>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group submtit">
                    <a href="/poles" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-right saveBtn">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>