<?php
if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "id_energy,id_lender_energy,id_lender,name_lender,period_energy,bill_energy,amount_energy,fee_energy,total_energy,status_energy,date_created_energy";
        $url = "relations?rel=energies,lenders&type=energy,lender&select=" . $select . "&linkTo=id_energy&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);
        //echo '<pre>'; print_r($url); echo '</pre>';exit;
        if ($response->status == 200) {
            $energies = $response->results[0];
        } else {
            echo '<script>
				window.location = "/energies";
				</script>';
        }
    } else {
        echo '<script>
				window.location = "/energies";
				</script>';
    }
}
?>

<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $energies->id_energy ?>" name="idEnergy">
        <div class="card-header">
            <?php
            require_once "controllers/energies.controller.php";
            $create = new EnergiesController();
            $create->edit($energies->id_energy);
            ?>

            <div class="col-md-8 offset-md-2">
                <div class="form-row">
                    <!-- Operador de Red -->
                    <div class="form-group col-md-4">
                        <label>Operador</label>
                        <?php
                        $url = "lenders?select=id_lender,name_lender";
                        $method = "GET";
                        $fields = array();
                        $lenders = CurlController::request($url, $method, $fields)->results;
                        ?>

                        <div class="form-group">
                            <select class="form-control select2" name="lender" style="width:100%" required>
                                <?php foreach ($lenders as $key => $value) : ?>
                                    <?php if ($value->id_lender == $energies->id_lender_energy) : ?>
                                        <option value="<?php echo $energies->id_lender_energy ?>" selected><?php echo $energies->name_lender ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $value->id_lender ?>"><?php echo $value->name_lender ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>No. Factura</label>
                        <input type="text" class="form-control" pattern="^[A-Za-z0-9]+$" name="bill" onchange="validateRepeat(event,'t&n','energies','bill_energy')" value="<?php echo $energies->bill_energy ?>" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Período (AAAAMM)</label>
                        <input type="text" class="form-control" pattern="^[0-9]+$" name="period" onchange="validateRepeat(event,'t&n','energies','period_energy')" value="<?php echo $energies->period_energy ?>" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Consumo -->
                    <div class="form-group col-md-4">
                        <label>Consumo Kws</label>
                        <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" id="amount" name="amount" onblur="fntCalculo();" value="<?php echo formatMoney($energies->amount_energy) ?>" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <!-- Tarifa $ -->
                    <div class="form-group col-md-4">
                        <label>Valor Tarifa</label>
                        <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" id="fee" name="fee" onblur="fntCalculo();" value="<?php echo formatMoney($energies->fee_energy) ?>" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Total -->
                    <div class="form-group col-md-4">
                        <label>Total</label>
                        <input type="text" class="form-control" id="total" name="total" value="<?php echo formatMoney($energies->total_energy) ?>">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-1">
                    <a href="/energies" class="btn btn-light border text-left">Regresar</a>
                    <button type="submit" class="btn bg-dark float-right">Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function fntCalculo(){
        var cantidad = document.getElementById('amount').value;
        newcant = cantidad.replace(/,/g, '');
        var costo = document.getElementById('fee').value;
        newcosto = costo.replace(/,/g, '');
        document.getElementById('total').value = Intl.NumberFormat("en-US").format(newcant * newcosto);
    }
</script>