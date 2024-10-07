<?php
if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "*";
        $url = "relations?rel=details,deliveries&type=detail,delivery&select=" . $select . "&linkTo=id_delivery_detail&equalTo=" . $security[0];;
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);
        //echo '<pre>'; print_r($url); echo '</pre>';exit;

        if ($response->status == 200) {
            $details = $response->results[0];
            $url = "relations?rel=deliveries,typedeliveries,itemdeliveries,resources&type=delivery,typedelivery,itemdelivery,resource&select=" . $select . "&linkTo=id_delivery&equalTo=" . $security[0];;
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url, $method, $fields);
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
            <?php
            require_once "controllers/deliveries.controller.php";
            $create = new DeliveriesController();
            $create->edit($deliveries->id_delivery);
            ?>
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

        <div class="card-body col-md-12">
            <div class="row col-md-10 mt-1">
                <!-- Descripción -->
                <div class="form-group col-md-3">
                    <label>Detalle</label>
                    <input type="text" class="form-control" pattern="[A-Za-z0-9]+([-])+([A-Za-z0-9]{1,}" id="detail" name="detail" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <!-- Unidad -->
                <div class="form-group col-md-1">
                    <label>Unidad</label>
                    <input type="text" class="form-control" pattern="[A-Za-z0-9]+([-])+([A-Za-z0-9]{1,}" id="unit" name="unit" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <!-- Cantidad -->
                <div class="form-group col-md-1">
                    <label>Cantidad</label>
                    <input type="text" class="form-control" pattern="[A-Za-z0-9]+([-])+([A-Za-z0-9]{1,}" id="quantity" name="quantity" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <!-- Valor Unitario -->
                <div class="form-group col-md-2">
                    <label>Vlr Unitario</label>
                    <input type="text" class="form-control" pattern="[A-Za-z0-9]+([-])+([A-Za-z0-9]{1,}" id="price" name="price" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <!-- Total -->
                <div class="form-group col-md-3">
                    <label>Total</label>
                    <input type="text" class="form-control" pattern="[A-Za-z0-9]+([-])+([A-Za-z0-9]{1,}" name="amount" disabled>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button type="button" class="btn btn-info pull-right" style="float: right; margin-right: 5px" onclick="addDetail()">
                    <i class="fa fa-plus"></i>
                    Agregar
                </button>
            </div>
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

<div class="row" mt-2>
    <div class="col-md-12">
        <div class="row">
            <table id="details" class="table table-bordered table-striped text-sm">
                <thead>
                    <tr>
                        <th>Detalle</th>
                        <th>Unidad</th>
                        <th>Cantidad</th>
                        <th>Vlr. Unitario</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    function addDetail() {
        name_item = $('#detail').val();
        unit_item = $('#unit').val();
        qty_item = $('#quantity').val();
        prc_item = $('#price').val();
        amo_item = $('#amount').val();


        var descuento = 0.00;
        existencia = 0;
        cantidad = 0;
        descuento = 0;
        var vlr_descuento = 0.00;


        $('.dataTables_empty').parent('tr').html('');
        $('#details tbody').append(`<tr>
							<td>${name_item}</td>
							<td>${unit_item}</td>
							<td><input type="number" min="1.00" onblur='editar_cantidad("${name_item}", ${qty_item}, this)' value="${qty_item}" /></td>
							<td><input type="number" min="1.00" onblur='cambiar_precio("${name_item}", this)' value="${prc_item}" /></td>
							<td style="text-align: right">${descuento}</td>
							<td>
								<button class="btn btn-danger btn_borrar" onclick="borrar(this)">
									<i class="fa fa-trash"></i>
								</button>
							</td>
							</tr>`);
    };
</script>