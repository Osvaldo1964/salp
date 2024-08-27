<?php
if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "*";
        $url = "relations?rel=details,deliveries&type=detail,delivery&select=" . $select . "&linkTo=id_delivery_detail&equalTo=" . $security[0];;
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);

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

<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
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
        <hr>
        <div class="card-boody">
            <div class="col-md-12">
                <div class="row">
                    <table id="details" class="table table-bordered table-striped text-sm">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Detalle</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>
                                <th>Vlr. Unitario</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-1">
                    <a href="/deliveries" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-right">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>