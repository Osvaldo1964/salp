<?php
//$security = explode("~", base64_decode($routesArray[3]));
//echo '<pre>'; print_r($security); echo '</pre>';exit;
?>
<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
            <?php
            require_once "controllers/transformers.controller.php";
            $create = new TransformersController();
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

                        <!-- Código Transformador -->
                        <div class="form-group col-md-6">
                            <label>Código</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" id="code" name="code" onchange="validateRepeat(event,'t&n','transformers','code_transformer')" required>

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
                                <option value>Tipo Transformador</option>
                                <?php foreach ($typetransformers as $key => $value) : ?>
                                    <option value="<?php echo $value["name"] ?>"><?php echo $value["name"] ?></option>
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
                                <option value>Clase Transformador</option>
                                <?php foreach ($classtransformers as $key => $value) : ?>
                                    <option value="<?php echo $value["name"] ?>"><?php echo $value["name"] ?></option>
                                <?php endforeach ?>
                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <!-- Circuito de Alimentación -->
                        <div class="form-group col-md-4">
                            <label>Circuito Alimentación</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="circuit" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
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
                            <!-- Potencia del Transformador -->
                            <label>Potencia</label>
                            <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="power" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <div class="form-group col-md-4">
                            <!-- Precio del Transformador -->
                            <label>Valor</label>
                            <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="cost" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <!-- Galeria de Imagenes -->
                    <label>Galeria de Imagenes del Transformador</label>
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
                            <!-- Hoja de Vida del transformero -->
                            <div class="form-group mt-2">
                                <label>Hoja de Vida del Transformador</label>
                                <textarea class="summernote" name="life" required></textarea>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require_once "controllers/transformers.controller.php";
            $create = new TransformersController();
            $create->create();
            ?>
        </div>
        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group submtit">
                    <a href="/transformers" class="btn btn-light border text-left">Regresar</a>
                    <button type="submit" class="btn bg-dark float-right saveBtn">Grabar</button>
                </div>
            </div>
        </div>
    </form>
</div>