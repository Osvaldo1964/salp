<?php
//$security = explode("~", base64_decode($routesArray[3]));
//echo '<pre>'; print_r($security); echo '</pre>';exit;
?>
<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
            <?php
            require_once "controllers/poles.controller.php";
            $create = new PolesController();
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
                                    <!-- onchange="activeBlocks()" -->
                                    <option value="">Seleccione Acta de Ingreso</option>
                                    <?php foreach ($deliveries as $key => $value) : ?>
                                        <option value="<?php echo $value->id_delivery ?>"><?php echo $value->number_delivery ?></option>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <!-- Código Poste -->
                        <div class="form-group col-md-6">
                            <label>Código</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" id="code" name="code" onchange="validateRepeat(event,'t&n','poles','code_pole')" required>

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
                                    <option value="">Seleccione un Material</option>
                                    <?php foreach ($materials as $key => $value) : ?>
                                        <option value="<?php echo $value->id_material ?>"><?php echo $value->name_material ?></option>
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
                                    <option value="">Seleccione una Altura</option>
                                    <?php foreach ($heights as $key => $value) : ?>
                                        <option value="<?php echo $value->id_height ?>"><?php echo $value->name_height ?></option>
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
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="detail" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <!-- Dirección -->
                        <div class="form-group col-md-12">
                            <label>Dirección</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="address" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Latitud -->
                        <div class="form-group col-md-4">
                            <label>Latiud</label>
                            <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" name="latitude" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <!-- Longitud -->
                        <div class="form-group col-md-4">
                            <label>Longitud</label>
                            <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" name="longitude" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <!-- Precio del Transformador -->
                            <label>Valor</label>
                            <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="cost" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <!-- Galeria de Imagenes -->
                    <label>Galeria de Imagenes del Poste</label>
                    <div class="dropzone mb-3">
                        <div class="dz-message">
                            Arrastre aqui las imagenes. Maximo 500px x 500px
                        </div>
                    </div>
                    <input type="hidden" name="galleryElement">
                </div>
                <!-- Derecha -->
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <!-- Muestro Código de Barras -->
                        <div class="form-group col-md-12 textcenter">
                            <div id="divBarCode" style="display: flex; flex-direction:column; align-items:center;" class="textcenter">
                                <div id="printCode">
                                    <svg id="barcode"></svg>
                                </div>
                                <button class="btn btn-success btn-sm d-none btnPrint" type="button" onClick="fntPrintBarcode('#printCode')"><i class="fas fa-print"></i> Imprimir</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <!-- Hoja de Vida del Poste -->
                            <div class="form-group mt-2">
                                <label>Hoja de Vida del Poste</label>
                                <textarea class="summernote" name="life" required></textarea>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require_once "controllers/poles.controller.php";
            $create = new PolesController();
            $create->create();
            ?>
        </div>
        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group submtit">
                    <a href="/poles" class="btn btn-light border text-left">Regresar</a>
                    <button type="submit" class="btn bg-dark float-right saveBtn">Grabar</button>
                </div>
            </div>
        </div>
    </form>
</div>