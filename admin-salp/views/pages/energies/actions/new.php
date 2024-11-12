<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
            <?php
            require_once "controllers/energies.controller.php";
            $create = new EnergiesController();
            //$create -> create();
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
                                <option value="">Seleccione Operador</option>
                                <?php foreach ($lenders as $key => $value) : ?>
                                    <option value="<?php echo $value->id_lender ?>"><?php echo $value->name_lender ?></option>
                                <?php endforeach ?>
                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>No. Factura</label>
                        <input type="text" class="form-control" pattern="^[A-Za-z0-9]+$" name="bill" onchange="validateRepeat(event,'t&n','energies','bill_energy')" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Período (AAAAMM)</label>
                        <input type="text" class="form-control" pattern="^[0-9]+$" name="period" onchange="validateRepeat(event,'t&n','energies','period_energy')" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
                
                <div class="form-row">
                    <!-- Consumo -->
                    <div class="form-group col-md-4">
                        <label>Consumo Kws</label>
                        <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" id="amount" name="amount" onblur="fntCalculo();" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <!-- Tarifa $ -->
                    <div class="form-group col-md-4">
                        <label>Valor Tarifa</label>
                        <input type="text" class="form-control" pattern="^-?[0-9]*\.?[0-9]+$" id="fee" name="fee" onblur="fntCalculo();" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Total -->
                    <div class="form-group col-md-4">
                        <label>Total</label>
                        <input type="text" class="form-control" id="total" name="total">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                </div>
            </div>
            <?php
            require_once "controllers/energies.controller.php";
            $create = new EnergiesController();
            $create->create();
            ?>
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
        var costo = document.getElementById('fee').value;
        document.getElementById('total').value = Intl.NumberFormat("en-US").format(cantidad * costo);
    }
</script>