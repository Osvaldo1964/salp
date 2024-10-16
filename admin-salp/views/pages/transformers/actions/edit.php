<?php
if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "*";
        $url = "relations?rel=transformers,deliveries&type=transformer,delivery&select=" . $select . "&linkTo=id_transformer&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);
        //echo '<pre>'; print_r($response); echo '</pre>';exit;
        if ($response->status == 200) {
            $transformers = $response->results[0];
        } else {
            echo '<script>
				window.location = "/transformers";
				</script>';
        }
    } else {
        echo '<script>
				window.location = "/transformers";
				</script>';
    }
}
?>

<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $transformers->id_transformer ?>" name="idTransformer">
        <div class="card-header">
            <?php
            require_once "controllers/transformers.controller.php";
            $create = new TransformersController();
            $create->edit($transformers->id_transformer);
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
                                        <?php if ($value->id_delivery == $deliveries->id_delivery_transformer) : ?>
                                            <option value="<?php echo $deliveries->id_delivery_transformer ?>" selected><?php echo $elements->number_delivery ?></option>
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
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" id="code" name="code" onchange="validateRepeat(event,'t&n','transformers','code_transformer')" value="<?php echo $transformers->code_transformer ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Tipo Transformador -->
                        <div class="form-group col-md-4">
                            <label>Tipo Transformador</label>
                            <?php
                            $typetransformers = file_get_contents("views/assets/json/typetransformers.json");
                            $typetransformers = json_decode($typetransformers, true);
                            ?>
                            <select class="form-control select2" name="type" required>
                                <?php foreach ($typetransformers as $key => $value) : ?>
                                    <?php if ($value['name'] == $typetransformers->type_transformer) : ?>
                                        <option value="<?php echo $typetransformers->type_transformer ?>" selected><?php echo $typetransformers->type_transformer ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $value["name"]; ?>"><?php echo $value["name"] ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <!-- Clase Transformador -->
                        <div class="form-group col-md-4">
                            <label>Clase Transformador</label>
                            <?php
                            $classtransformers = file_get_contents("views/assets/json/classtransformers.json");
                            $classtransformers = json_decode($classtransformers, true);
                            ?>
                            <select class="form-control select2" name="class" required>
                                <?php foreach ($classtransformers as $key => $value) : ?>
                                    <?php if ($value['name'] == $classtransformers->class_transformer) : ?>
                                        <option value="<?php echo $classtransformers->class_transformer ?>" selected><?php echo $classtransformers->class_transformer ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $value["name"]; ?>"><?php echo $value["name"] ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <!-- Circuito de Alimentación -->
                        <div class="form-group col-md-4">
                            <label>Circuito Alimentación</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="circuit" value="<?php echo $transformers->circuit_transformer ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Dirección -->
                        <div class="form-group col-md-12">
                            <label>Dirección</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="address" value="<?php echo $transformers->address_transformer ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Latitud -->
                        <div class="form-group col-md-4">
                            <label>Latiud</label>
                            <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" name="latitude" value="<?php echo $transformers->latitude_transformer ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <!-- Longitud -->
                        <div class="form-group col-md-4">
                            <label>Longitud</label>
                            <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" name="longitude" value="<?php echo $transformers->longitude_transformer ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <!-- Potencia del Transformador -->
                            <label>Potencia</label>
                            <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="power" value="<?php echo $transformers->power_transformer ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <div class="form-group col-md-4">
                            <!-- Precio del Elemento -->
                            <label>Precio Elemento</label>
                            <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="cost" value="<?php echo $transformers->cost_transformer ?>">

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <!-- Galeria de Imagenes -->
                    <label>Galeria de Imagenes del Transformador</label>
                    <div class="dropzone">
                        <?php foreach (json_decode($transformers->gallery_transformer, true) as $value) : ?>
                            <div class="dz-preview dz-file-preview">
                                <div class="dz-image">
                                    <img class="img-fluid" src="<?php echo TemplateController::srcImg() ?>views/img/transformers/<?php echo $transformers->code_transformer ?>/<?= $value ?>" width="100%">
                                </div>
                                <a class="dz-remove" data-dz-remove remove="<?= $value ?>" onclick="removeGallery(this)">Eliminar archivo</a>
                            </div>
                        <?php endforeach ?>
                        <div class="dz-message">
                        </div>

                    </div>
                    <input type="hidden" name="galleryElementOld" value='<?= $transformers->gallery_transformer ?>'>
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
                            <!-- Hoja de Vida del Elemento -->
                            <div class="form-group mt-2">
                                <label>Hoja de Vida del Transformador</label>
                                <textarea class="summernote" name="life" value="<?php echo $transformers->life_transformer ?>">
                                <?php echo html_entity_decode($transformers->life_transformer) ?>
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
                    <a href="/transformers" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-right saveBtn">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>