<?php
if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "*";
        $url = "relations?rel=luminaries,deliveries,technologies,powers,rouds,transformers,poles&type=luminary,delivery,technology,power,roud,transformer,pole&select=" . $select . "&linkTo=id_luminary&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);

        if ($response->status == 200) {
            $luminaries = $response->results[0];
        } else {
            echo '<script>
				window.location = "/luminaries";
				</script>';
        }
    } else {
        echo '<script>
				window.location = "/luminaries";
				</script>';
    }
}
?>

<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $luminaries->id_luminary ?>" name="idLuminary">
        <div class="card-header">
            <?php
            require_once "controllers/luminaries.controller.php";
            $create = new LuminariesController();
            $create->edit($luminaries->id_luminary);
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
                                        <?php if ($value->id_delivery == $luminaries->id_delivery_luminary) : ?>
                                            <option value="<?php echo $luminaries->id_delivery_luminary ?>" selected><?php echo $luminaries->number_delivery ?></option>
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
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" id="code" name="code" onchange="validateRepeat(event,'t&n','luminaries','code_luminary')" value="<?php echo $luminaries->code_luminary ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Seleccion Tecnologia -->
                        <div class="form-group col-md-4">
                            <label>Tecnologias</label>
                            <?php
                            $url = "technologies?select=id_technology,name_technology";
                            $method = "GET";
                            $fields = array();
                            $technologies = CurlController::request($url, $method, $fields)->results;
                            ?>

                            <div class="form-group">
                                <select class="form-control select2" name="technology" style="width:100%">
                                    <?php foreach ($technologies as $key => $value) : ?>
                                        <?php if ($value->id_technology == $luminaries->id_technology_luminary) : ?>
                                            <option value="<?php echo $luminaries->id_technology_luminary ?>" selected><?php echo $luminaries->name_technology ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $value->id_technology ?>"><?php echo $value->name_technology ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <!-- Seleccion Potencia -->
                        <div class="form-group col-md-4">
                            <label>Potencias</label>
                            <?php
                            $url = "powers?select=id_power,name_power";
                            $method = "GET";
                            $fields = array();
                            $powers = CurlController::request($url, $method, $fields)->results;
                            ?>

                            <div class="form-group">
                                <select class="form-control select2" id="power" name="power" style="width:100%">
                                    <?php foreach ($powers as $key => $value) : ?>
                                        <?php if ($value->id_power == $luminaries->id_power_luminary) : ?>
                                            <option value="<?php echo $luminaries->id_power_luminary ?>" selected><?php echo $luminaries->name_power ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $value->id_power ?>"><?php echo $value->name_power ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Seleccion Transformador -->
                        <div class="form-group col-md-4">
                            <label>Transformador</label>
                            <?php
                            $url = "transformers?select=id_transformer,code_transformer";
                            $method = "GET";
                            $fields = array();
                            $transformers = CurlController::request($url, $method, $fields)->results;
                            ?>

                            <div class="form-group">
                                <select class="form-control select2" name="transformer" style="width:100%">
                                <?php foreach ($transformers as $key => $value) : ?>
                                        <?php if ($value->id_transformer == $luminaries->id_transformer_luminary) : ?>
                                            <option value="<?php echo $luminaries->id_transformer_luminary ?>" selected><?php echo $luminaries->code_transformer ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $value->id_transformer ?>"><?php echo $value->code_transformer ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <!-- Seleccion Poste -->
                        <div class="form-group col-md-4">
                            <label>Poste - Estructura</label>
                            <?php
                            $url = "poles?select=id_pole,code_pole";
                            $method = "GET";
                            $fields = array();
                            $poles = CurlController::request($url, $method, $fields)->results;
                            ?>

                            <div class="form-group">
                                <select class="form-control select2" name="pole" style="width:100%">
                                <?php foreach ($poles as $key => $value) : ?>
                                        <?php if ($value->id_pole == $luminaries->id_pole_luminary) : ?>
                                            <option value="<?php echo $luminaries->id_pole_luminary ?>" selected><?php echo $luminaries->code_pole ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $value->id_pole ?>"><?php echo $value->code_pole ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Seleccion Tipos de Vias -->
                        <div class="form-group col-md-6">
                            <label>Tipos de Vias</label>
                            <?php
                            $url = "rouds?select=id_roud,name_roud";
                            $method = "GET";
                            $fields = array();
                            $rouds = CurlController::request($url, $method, $fields)->results;
                            ?>

                            <div class="form-group">
                                <select class="form-control select2" name="roud" style="width:100%" required>
                                    <?php foreach ($rouds as $key => $value) : ?>
                                        <?php if ($value->id_roud == $luminaries->id_roud_luminary) : ?>
                                            <option value="<?php echo $luminaries->id_roud_luminary ?>" selected><?php echo $luminaries->name_roud ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $value->id_roud ?>"><?php echo $value->name_roud ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="form-group col-md-12">
                            <label>Dirección</label>
                            <input type="text" class="form-control" pattern='[a-zA-Z0-9_ ]{1,}' name="address" value="<?php echo $luminaries->address_luminary ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Latitud -->
                        <div class="form-group col-md-4">
                            <label>Latiud</label>
                            <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" name="latitude" value="<?php echo $luminaries->latitude_luminary ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <!-- Longitud -->
                        <div class="form-group col-md-4">
                            <label>Longitud</label>
                            <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" name="longitude" value="<?php echo $luminaries->longitude_luminary ?>" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <!-- Precio del Elemento -->
                            <label>Precio Luminaria</label>
                            <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="cost" value="<?php echo $luminaries->cost_luminary ?>">

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <!-- Galeria de Imagenes -->
                    <label>Galeria de Imagenes del Elemento</label>
                    <div class="dropzone mb-3">
                        <?php foreach (json_decode($luminaries->gallery_luminary, true) as $value): ?>
                            <div class="dz-preview dz-file-preview">
                                <div class="dz-image">
                                    <img src="views/img/luminaries/<?= strtolower($luminaries->code_luminary) ?>/<?= $value ?>" width="100%">
                                </div>
                                <a class="dz-remove" data-dz-remove remove="<?= $value ?>" onclick="removeGallery(this)">Eliminar archivo</a>
                            </div>
                        <?php endforeach ?>
                        <div class="dz-message">
                        </div>

                    </div>
                    <input type="hidden" name="galleryElementOld" value='<?= $luminaries->gallery_luminary ?>'>
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
                                <label>Hoja de Vida de la Luminaria</label>
                                <textarea class="summernote" name="life" value="<?php echo $luminaries->life_luminary ?>">
                                <?php echo html_entity_decode($luminaries->life_luminary) ?>
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
                    <a href="/luminaries" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-right saveBtn">Save</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            console.log("DOM fully loaded and parsed");
            activeBlocks();
            document.querySelector("#divBarCode").classList.remove("notblock");
            fntBarcode();
        });
    </script>
</div>