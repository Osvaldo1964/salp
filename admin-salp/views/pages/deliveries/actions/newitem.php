<?php
//echo '<pre>'; print_r($routesArray); echo '</pre>';
if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    //echo '<pre>'; print_r($security); echo '</pre>';
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "*";
        $url = "deliveries?select=id_delivery,number_delivery,date_delivery&linkTo=id_delivery&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);
        //echo '<pre>'; print_r($response); echo '</pre>';
        if ($response->status == 200) {
            $deliveries = $response->results[0];
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
        <div class="card-header">
            <?php
            require_once "controllers/deliveries.controller.php";
            $create = new DeliveriesController();
            //$create -> create();
            ?>

            <div class="col-md-10 offset-md-2">
                <div class="row">
                    <!-- Número del Acta -->
                    <div class="form-group col-md-4">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                Acta :
                            </span>
                            <input type="text" class="form-control" name="number" value="<?php echo $deliveries->number_delivery ?>">
                        </div>

                    </div>

                    <!-- Fecha del Acta -->
                    <div class="form-group col-md-4">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                Fecha :
                            </span>
                            <input type="date" class="form-control" name="datedelivery" value="<?php echo $deliveries->date_delivery ?>">
                        </div>

                    </div>
                </div>
            </div>
            <?php
            require_once "controllers/deliveries.controller.php";
            $create = new DeliveriesController();
            $create->create();
            ?>
        </div>

        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group">
                    <a href="/deliveries" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-right">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>