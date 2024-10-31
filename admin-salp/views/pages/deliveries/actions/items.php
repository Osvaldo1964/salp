<?php

if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "*";
        $url = "relations?rel=deliveries,typedeliveries,itemdeliveries,resources&type=delivery,typedelivery,itemdelivery,resource&select=" . $select . "&linkTo=id_delivery&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);
        //echo '<pre>'; print_r($url); echo '</pre>';exit;

        if ($response->status == 200) {
            $deliveries = $response->results[0];
            //echo '<pre>'; print_r($details); echo '</pre>';
            //echo '<pre>'; print_r($deliveries); echo '</pre>';
        } else {
            echo '<script>
				window.location = "/deliveries";
				</script>';
        }
    } else {
        echo '<script>
				window.location = "/deliveries";
				</script>';
    }
}

?>

<div class="card card-dark card-outline col-md-12">
    <form id="formDetails">
        <input type="hidden" value="<?php echo $deliveries->id_delivery ?>" name="idDelivery">
        <div class="card-header">
            <!--             <?php
                                require_once "controllers/deliveries.controller.php";
                                $create = new DeliveriesController();
                                $create->edit($deliveries->id_delivery);
                                ?> -->
            <div class="col-md-12 offset-md-2">
                <div class="row">
                    <input type="text" class="col-md-3" name="typedelivery" value="<?php echo $deliveries->name_typedelivery ?>" disabled>
                    <input type="text" class="col-md-3 ml-2" name="itemdelivery" value="<?php echo $deliveries->name_itemdelivery ?>" disabled>
                    <input type="text" class="col-md-3 ml-2" name="number" value="<?php echo $deliveries->number_delivery ?>" disabled>
                </div>
                <div class="row mt-2">
                    <input type="text" class="col-md-3" name="datedelivery" value="<?php echo $deliveries->date_delivery ?>" disabled>
                    <input type="text" class="col-md-3 ml-2" name="resource" value="<?php echo $deliveries->name_resource ?>" disabled>
                </div>
            </div>
        </div>

        <div class="card-body col-md-12 d-flex justify-content-center">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTransformers">
                Adicionar Transformadores
            </button>
            <button type="button" class="btn btn-default ml-2" data-toggle="modal" data-target="#modalPoles">
                Adicionar Postes
            </button>
            <button type="button" class="btn btn-default ml-2" data-toggle="modal" data-target="#modalLuminaries">
                Adicionar Luminarias
            </button>

        </div>

        <!--         <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-1">
                    <a href="/deliveries" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-right">Save</button>
                </div>
            </div>
        </div>
 -->
    </form>
</div>

<div class="row" id="details" mt-2>
    <div class="col-md-12">
        <div class="row">
            <table id="details" class="table table-bordered table-striped text-sm">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Grupo</th>
                        <th>Código</th>
                        <th>Detalles</th>
                        <th>Dirección</th>
                        <th>Cantidad</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = "*";
                    $url = "relations?rel=viewinvs,deliveries&type=viewinv,delivery&select=*&linkTo=id_delivery_viewinv&equalTo=" . $security[0];
                    $method = "GET";
                    $fields = array();
                    $secuencia = 1;
                    $response = CurlController::request($url, $method, $fields);
                    //echo '<pre>'; print_r($url); echo '</pre>';exit;

                    if ($response->status == 200) {
                        $viewsinvs = $response->results;
                        foreach ($viewsinvs as $viewsinv) {
                    ?>
                            <tr>
                                <td class="text-left"><?= $secuencia; ?></td>
                                <td class="text-left"><?= $viewsinv->group_viewinv; ?></td>
                                <td class="text-left"><?= $viewsinv->code_viewinv; ?></td>
                                <td class="text-left"><?= $viewsinv->info_viewinv; ?></td>
                                <td class="text-left"><?= $viewsinv->address_viewinv; ?></td>
                                <td class="text-left"><?= $viewsinv->qty_viewinv; ?></td>
                                <td class="text-left"><?= $viewsinv->cost_viewinv; ?></td>
                            </tr>
                    <?php
                            $secuencia++;
                        }
                    } else {
                        echo '<script>
				                window.location = "/deliveries";
				                </script>';
                    }
                    ?>
                </tbody>
                <tfoot id="tfoot" style="display: none">
                    <tr>
                        <td colspan="5">
                            <span style="color: black; float: right;">TOTAL</span>
                        </td>
                        <td id="total" style="text-align: right">
                        </td>
                        <td>
                        </td>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTransformers">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Transformadores</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-dark card-outline">
                    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $deliveries->id_delivery ?>" name="idDelivery">
                        <div class="card-header">
                            <?php
                            require_once "controllers/transformers.controller.php";
                            $create = new TransformersController();
                            ?>
                            <div class="row col-md-12">
                                <!-- Izquierda -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <!-- Código Transformador -->
                                        <div class="form-group col-md-6">
                                            <label>Código</label>
                                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" id="codeT" name="codeT" onchange="validateRepeat(event,'t&n','transformers','code_transformer')" required>

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
                                            <select class="form-control select2" name="typeT" required>
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
                                            <select class="form-control select2" name="classT" required>
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
                                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="circuitT" required>

                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Dirección -->
                                        <div class="form-group col-md-12">
                                            <label>Dirección</label>
                                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="addressT" required>

                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Latitud -->
                                        <div class="form-group col-md-4">
                                            <label>Latiud</label>
                                            <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" name="latitudeT" required>

                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <!-- Longitud -->
                                        <div class="form-group col-md-4">
                                            <label>Longitud</label>
                                            <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" name="longitudeT" required>

                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <!-- Potencia del Transformador -->
                                            <label>Potencia</label>
                                            <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="powerT" required>

                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <!-- Precio del Transformador -->
                                            <label>Valor</label>
                                            <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="costT" required>

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
                                            <div id="divBarCodeT" style="display: flex; flex-direction:column; align-items:center;" class="textcenter">
                                                <div id="printCode">
                                                    <svg id="barcodeT"></svg>
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
                                                <textarea class="summernote" name="lifeT" required></textarea>

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
                        <!--                        <div class="card-footer">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-group submtit">
                                    <a href="/deliveries/items" class="btn btn-light border text-left">Regresar</a>
                                    <button type="submit" class="btn bg-dark float-right saveBtn">Grabar</button>
                                </div>
                            </div>
                        </div>
  -->
                        <div class="card-footer">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-group submtit">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary saveBtn">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--             <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary saveBtn">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modalPoles">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Postes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-dark card-outline">
                    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $deliveries->id_delivery ?>" name="idDelivery">
                        <div class="card-header">
                            <?php
                            require_once "controllers/poles.controller.php";
                            $create = new PolesController();
                            ?>

                            <div class="row">
                                <!-- Izquierda -->
                                <div class="col-md-6">
                                    <div class="row">
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
                                    <div class="dropzone mb-2">
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
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary saveBtn">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--             <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
 -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modalLuminaries">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Luminarias</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-dark card-outline">
                    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $deliveries->id_delivery ?>" name="idDelivery">
                    <input type="hidden" value="<?php echo $technologies->name_technology ?>" name="nameTecno">
                    <input type="hidden" value="<?php echo $power->name_power ?>" name="namePower">
                        <div class="card-header">
                            <?php
                            require_once "controllers/luminaries.controller.php";
                            $create = new LuminariesController();
                            ?>
                            <div class="row">
                                <!-- Izquierda -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <!-- Código Elemento -->
                                        <div class="form-group col-md-6">
                                            <label>Código</label>
                                            <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" id="codeL" name="codeL" onchange="validateRepeat(event,'t&n','luminaries','code_luminary')" required>

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
                                            <div id="divBarCodeL" style="display: flex; flex-direction:column; align-items:center;" class="textcenter">
                                                <div id="printCode">
                                                    <svg id="barcodeL"></svg>
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
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary saveBtn upTable">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--             <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
 -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal -->

<script>
    let items_acta = [];
    let total = 0.00;

    function addDetail() {
        ind_item = items_acta.length + 1;
        name_item = $('#detail').val();
        unit_item = $('#unit').val();
        qty_item = $('#quantity').val();
        prc_item = $('#price').val();
        amo_item = $('#amount').val();

        var aux = {};
        aux['index'] = ind_item;
        aux['name'] = name_item;
        aux['unit'] = name_item;
        aux['quantity'] = qty_item;
        aux['price'] = prc_item;
        aux['amount'] = qty_item * prc_item;

        items_acta.push(aux);
        //subtotal = formato_moneda.format(subtotal);


        $('.dataTables_empty').parent('tr').html('');
        $('#details tbody').append(`<tr>
                            <td>${ind_item}</td>
							<td>${name_item}</td>
							<td>${unit_item}</td>
							<td><input type="number" min="1.00" onblur='addTotal("${name_item}", ${qty_item}, this)' value="${qty_item}" /></td>
							<td><input type="number" min="1.00" onblur='addTotal("${name_item}", this)' value="${prc_item}" /></td>
							<td style="text-align: right">${amo_item}</td>
							<td>
								<button class="btn btn-danger btn_borrar" onclick="borrar(this)">
									<i class="fa fa-trash"></i>
								</button>
							</td>
							</tr>`);
        calcular_total();
    };

    function addTotal() {
        qty_item = $('#quantity').val();
        prc_item = $('#price').val();
        tot_item = qty_item * prc_item;
        $('#amount').val(tot_item);
    };

    function calcular_total() {
        total = 0.00;
        //console.log(items_acta);
        for (var i = 0; i <= items_acta.length - 1; i++) {
            total += (items_acta[i]['quantity'] * items_acta[i]['price'])
        }

        $('#total').text(total);

        if (items_acta.length > 0) {
            $('#tfoot').slideDown();
        } else {
            $('#tfoot').hide();
        }
    }

    /* Funcion de Codigo de Barras */
    if (document.querySelector("#codeT")) {
        let inputCodigo = document.querySelector("#codeT");
        inputCodigo.onkeyup = function() {
            if (inputCodigo.value.length >= 5) {
                document.querySelector("#divBarCodeT").classList.remove("notblock");
                fntBarcodeT();
                document.querySelector(".btnPrint").classList.remove("d-none");
            } else {
                document.querySelector("#divBarCodeT").classList.add("notblock");
            }
        }
    }

    function fntBarcodeT(e) {
        let codigo = document.querySelector("#codeT").value;
        JsBarcode("#barcodeT", codigo);
    }

    $(".upTable").click(function() {
        let ndelivery = $('#idDelivery').val();
        var data = new FormData();
        data.append("idDelivery", ndelivery);

        $.ajax({
            url: "ajax/ajax-validate.php",
            method: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                alert('asasas');
                console.log(response);
            }
        })

    })

    /* Funcion de Codigo de Barras */
    if (document.querySelector("#codeL")) {
        let inputCodigo = document.querySelector("#codeL");
        inputCodigo.onkeyup = function() {
            if (inputCodigo.value.length >= 5) {
                document.querySelector("#divBarCodeL").classList.remove("notblock");
                fntBarcodeL();
                document.querySelector(".btnPrint").classList.remove("d-none");
            } else {
                document.querySelector("#divBarCodeL").classList.add("notblock");
            }
        }
    }

    function fntBarcodeL(e) {
        let codigo = document.querySelector("#codeL").value;
        JsBarcode("#barcodeL", codigo);
    }
</script>