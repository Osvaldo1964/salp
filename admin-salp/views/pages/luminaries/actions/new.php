<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
            <?php
            require_once "controllers/luminaries.controller.php";
            $create = new LuminariesController();
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

                        <!-- Código Elemento -->
                        <div class="form-group col-md-6">
                            <label>Código</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" id="code" name="code" onchange="validateRepeat(event,'t&n','luminaries','code_luminary')" required>

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
                                    <option value="">Seleccione la Tecnologia</option>
                                    <?php foreach ($technologies as $key => $value) : ?>
                                        <option value="<?php echo $value->id_technology ?>"><?php echo $value->name_technology ?></option>
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
                                    <option value="">Seleccione Una Potencia</option>
                                    <?php foreach ($powers as $key => $value) : ?>
                                        <option value="<?php echo $value->id_power ?>"><?php echo $value->name_power ?></option>
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
                                    <option value="">Seleccione el Transformador</option>
                                    <?php foreach ($transformers as $key => $value) : ?>
                                        <option value="<?php echo $value->id_transformer ?>"><?php echo $value->code_transformer ?></option>
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
                                <select class="form-control select2" id="power" name="pole" style="width:100%">
                                    <option value="">Seleccione Un Poste/Estructura</option>
                                    <?php foreach ($poles as $key => $value) : ?>
                                        <option value="<?php echo $value->id_pole ?>"><?php echo $value->code_pole ?></option>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Seleccion Tipos de Vias -->
                        <div class="form-group col-md-4">
                            <label>Tipos de Vias</label>
                            <?php
                            $url = "rouds?select=id_roud,name_roud";
                            $method = "GET";
                            $fields = array();
                            $rouds = CurlController::request($url, $method, $fields)->results;
                            ?>

                            <div class="form-group">
                                <select class="form-control select2" name="roud" style="width:100%" required>
                                    <option value="">Seleccione Un Tipo de Via</option>
                                    <?php foreach ($rouds as $key => $value) : ?>
                                        <option value="<?php echo $value->id_roud ?>"><?php echo $value->name_roud ?></option>
                                    <?php endforeach ?>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <!-- Dirección -->
                        <div class="form-group col-md-8">
                            <label>Dirección</label>
                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]+" name="address" required>

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
                        <div class="form-group col-md-4">
                            <!-- Precio del Elemento -->
                            <label>Precio Luminaria</label>
                            <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="cost" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <!-- Galeria de Imagenes -->
                    <label>Galeria de Imagenes del Elemento</label>
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
                            <!-- Hoja de Vida del Elemento -->
                            <div class="form-group mt-2">
                                <label>Hoja de Vida de la Luminaria</label>
                                <textarea class="summernote" name="life" required></textarea>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require_once "controllers/luminaries.controller.php";
            $create = new LuminariesController();
            $create->create();
            ?>
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
</div>

<script>
    function fntCalculo(){
        document.getElementById('total').val() = document.getElementById('amount').val() * document.getElementById('fee').val() ;
    }
</script>