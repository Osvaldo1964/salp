<?php

/* Busco Transformadores */
$select = "id_transformer,code_transformer,number_delivery,power_transformer,address_transformer,cost_transformer,status_transformer,date_created_transformer";
$url = "relations?rel=transformers,deliveries&type=transformer,delivery&select=" . $select . "&filterTo=status_transformer&inTo='Activo'&orderBy=power_transformer&orderMode=ASC";
$method = "GET";
$fields = array();
$transformers = CurlController::request($url, $method, $fields);
$tottrans = $transformers->total;
$transformers = $transformers->results;
//echo '<pre>'; print_r($transformers); echo '</pre>';

/* Busco Postes */
$select = "id_pole,code_pole,number_delivery,name_material,name_height,address_pole,cost_pole,date_created_pole,status_pole";
$url = "relations?rel=poles,deliveries,materials,heights&type=pole,delivery,material,height&select=" . $select . "&filterTo=status_pole&inTo='Activo'&orderBy=name_material,name_height&orderMode=ASC";
$method = "GET";
$fields = array();
$poles = CurlController::request($url, $method, $fields);
$totpole = $poles->total;
$poles = $poles->results;
//echo '<pre>'; print_r($poles); echo '</pre>';

/* Busco Luminarias */
$select = "id_luminary,code_luminary,number_delivery,name_technology,name_power,address_luminary,cost_luminary,date_created_luminary,status_luminary";
$url = "relations?rel=luminaries,deliveries,technologies,powers,rouds,transformers,poles&type=luminary,delivery,technology,power,roud,transformer,pole&select=" . $select . "&filterTo=status_luminary&inTo='Activo'&orderBy=name_technology,name_power&orderMode=ASC";
$method = "GET";
$fields = array();
$luminaries = CurlController::request($url, $method, $fields);
$totlum = $luminaries->total;
$luminaries = $luminaries->results;
//echo '<pre>'; print_r($luminaries); echo '</pre>';

if ($totlum > 0) {
    /*  Variables Generales*/
    $type = $_GET["typerepo"];

    $ctrucap = '';
    $ucaps = array();
    $grouped = array();
    $count = 1;

    /* Agrupo Luminarias */
    if ($totlum + $tottrans + $totpole > 0) {
        foreach ($luminaries as $luminary) {
            $ucaps[$count]['group'] = "LUMINARIAS";
            $ucaps[$count]['code'] = $luminary->code_luminary;
            $ucaps[$count]['info'] = $luminary->name_technology . " " . $luminary->name_power;
            $ucaps[$count]['address'] = $luminary->address_luminary;
            $ucaps[$count]['qty'] = 1;
            $ucaps[$count]['cost'] = $luminary->cost_luminary;
            $count++;
        }
    }

    /* Agrupo Postes */
    if ($totpole > 0) {
        foreach ($poles as $pole) {
            $ucaps[$count]['group'] = "POSTES";
            $ucaps[$count]['code'] = $pole->code_pole;
            $ucaps[$count]['info'] = $pole->name_material . " " . $pole->name_height;
            $ucaps[$count]['address'] = $pole->address_pole;
            $ucaps[$count]['qty'] = 1;
            $ucaps[$count]['cost'] = $pole->cost_pole;
            $count++;
        }
    }

    /* Agrupo Transformadores */
    if ($tottrans > 0) {
        foreach ($transformers as $transformer) {
            $ucaps[$count]['group'] = "TRANSFORMADORES";
            $ucaps[$count]['code'] = $transformer->code_transformer;
            $ucaps[$count]['info'] = $transformer->power_transformer . " KWh";
            $ucaps[$count]['address'] = $transformer->address_transformer;
            $ucaps[$count]['qty'] = 1;
            $ucaps[$count]['cost'] = $transformer->cost_transformer;
            $count++;
        }
    }


    /* Si el reporte es resumido agrupo luminarias por info */
    if ($type == "Resumido") {
        $y = 1;
        for ($i = 1; $i <= count($ucaps); $i++) {
            if ($ctrucap == "") {
                $ctrucap = $ucaps[$i]["info"];
                $grouped[$y]["group"] = $ucaps[$i]["group"];
                $grouped[$y]["info"] = $ucaps[$i]["info"];
                $grouped[$y]["qty"] = 1;
                $grouped[$y]["cost"] = $ucaps[$i]["cost"];
                $y++;
                $same = $y;
            } else {
                if ($ctrucap == $ucaps[$i]["info"]) {
                    $grouped[$same]["qty"] = $grouped[$same]["qty"] + $ucaps[$i]["qty"];
                    $grouped[$same]["cost"] = $grouped[$same]["cost"] + $ucaps[$i]["cost"];
                } else {
                    $ctrucap = $ucaps[$i]["info"];
                    $grouped[$y]["group"] = $ucaps[$i]["group"];
                    $grouped[$y]["info"] = $ucaps[$i]["info"];
                    $grouped[$y]["qty"] = 1;
                    $grouped[$y]["cost"] = $ucaps[$i]["cost"];
                    $same = $y;
                    $y++;
                }
            }
        }
    }

    //echo '<pre>'; print_r($ucaps); echo '</pre>';
    //echo '<pre>'; print_r($grouped); echo '</pre>';
} else {
    echo '<script>
				window.location = "/";
				</script>';
}
?>
<main class="app-content">
    <div class="app-title">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <?php
                //echo '<pre>'; print_r($totrec); echo '</pre>';
                if ($type == "Resumido") {
                ?>
                    <section id="sActa" class="invoice">
                        <div class="row mb-4 ml-2">
                            <div class="wd33">
                                <img src="<?php echo TemplateController::srcImg() ?>views/assets/img/global_logo.png" style="width:250px" alt="User Image">
                            </div>
                        </div>
                        <div class="row invoice-info col-md-12" style="font-size: 10px;">
                            <div class="col-4 ml-2">
                                <address><strong><?= NOMBRE_EMPRESA; ?></strong><br>
                                    <?= DIRECCION; ?><br>
                                    <?= TELEMPRESA; ?><br>
                                    <?= EMAIL_EMPRESA; ?><br>
                                    <?= WEB_EMPRESA; ?><br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped" style="font-size: 10px;">
                                    <thead>
                                        <tr>
                                            <th>Detalle</th>
                                            <th class="text-right">Cantidad</th>
                                            <th class="text-right">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //echo '<pre>'; print_r($totrec); echo '</pre>';
                                        $subtotal01 = 0;
                                        $total01 = 0;
                                        $grupo01 = '';
                                        //echo '<pre>'; print_r(count($pqrs)); echo '</pre>';
                                        if (count($grouped) > 0) {
                                            for ($i = 1; $i <= count($grouped); $i++) {
                                                //echo '<pre>'; print_r($ctrdate); echo '</pre>';
                                                if ($grupo01 == '') {
                                                    $grupo01 = $grouped[$i]["group"];
                                                    $subtotal01 = 0;
                                        ?>
                                                    <tr>
                                                        <th colspan="3" class="text-left"><?= $grupo01; ?></th>
                                                    </tr>
                                                    <?php } else {
                                                    if ($grupo01 != $grouped[$i]["group"]) {
                                                    ?>
                                                        <tr>
                                                            <th colspan="2" class="text-right">Sub-Total <?= $grupo01; ?> :</th>
                                                            <td class="text-right"><?= formatMoney($subtotal01) ?></td>
                                                        </tr>
                                                        <?php
                                                        $subtotal01 = 0;
                                                        $grupo01 = $grouped[$i]["group"];
                                                        ?>
                                                        <tr>
                                                            <th colspan="3" class="text-left"><?= $grupo01; ?></th>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td class="text-left"><?= $grouped[$i]["info"]; ?></td>
                                                    <td class="text-right"><?= formatMoney($grouped[$i]["qty"]); ?></td>
                                                    <td class="text-right"><?= formatMoney($grouped[$i]["cost"]); ?></td>
                                                </tr>
                                        <?php
                                                $subtotal01 = $subtotal01 + $grouped[$i]["cost"];
                                                $total01 = $total01 + $grouped[$i]["cost"];
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-right">Sub-Total <?= $grupo01; ?> :</th>
                                            <td class="text-right"><?= formatMoney($subtotal01) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-right">Total :</th>
                                            <td class="text-right"><?= formatMoney($total01) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </section>
                    <div class="col-md-8 d-print-none offset-md-2 mt-2">
                        <a href="/infinvval" class="btn btn-light border text-left">Back</a>
                        <a class="btn btn-primary float-right" href="javascript:window.print('#sActa');"><i class="fa fa-print"></i> Imprimir</a>
                    </div>
                <?php } else {
                ?>
                    <section id="sActa" class="invoice">
                        <div class="row mb-4 ml-2">
                            <div class="wd33">
                                <img src="<?php echo TemplateController::srcImg() ?>views/assets/img/global_logo.png" style="width:250px" alt="User Image">
                            </div>
                        </div>
                        <div class="row invoice-info col-md-12" style="font-size: 10px;">
                            <div class="col-4 ml-2">
                                <address><strong><?= NOMBRE_EMPRESA; ?></strong><br>
                                    <?= DIRECCION; ?><br>
                                    <?= TELEMPRESA; ?><br>
                                    <?= EMAIL_EMPRESA; ?><br>
                                    <?= WEB_EMPRESA; ?><br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped" style="font-size: 10px;">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Detalle</th>
                                            <th>Dirección</th>
                                            <th>Cantidad</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //echo '<pre>'; print_r($totrec); echo '</pre>';
                                        $subtotal01 = 0;
                                        $total01 = 0;
                                        $grupo01 = '';
                                        //echo '<pre>'; print_r(count($pqrs)); echo '</pre>';
                                        if (count($ucaps) > 0) {
                                            for ($i = 1; $i <= count($ucaps); $i++) {
                                                //echo '<pre>'; print_r($ctrdate); echo '</pre>';
                                                if ($grupo01 == '') {
                                                    $grupo01 = $ucaps[$i]["group"];
                                                    $subtotal01 = 0;
                                        ?>
                                                    <tr>
                                                        <th colspan="5" class="text-left"><?= $grupo01; ?></th>
                                                    </tr>
                                                    <?php } else {
                                                    if ($grupo01 != $ucaps[$i]["group"]) {
                                                    ?>
                                                        <tr>
                                                            <th colspan="4" class="text-right">Sub-Total <?= $grupo01; ?> :</th>
                                                            <td class="text-right"><?= formatMoney($subtotal01) ?></td>
                                                        </tr>
                                                        <?php
                                                        $subtotal01 = 0;
                                                        $grupo01 = $ucaps[$i]["group"];
                                                        ?>
                                                        <tr>
                                                            <th colspan="5" class="text-left"><?= $grupo01; ?></th>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td class="text-left"><?= $ucaps[$i]["code"]; ?></td>
                                                    <td class="text-left"><?= $ucaps[$i]["info"]; ?></td>
                                                    <td class="text-left"><?= substr($ucaps[$i]["address"], 0, 20); ?></td>
                                                    <td class="text-right"><?= formatMoney($ucaps[$i]["qty"]); ?></td>
                                                    <td class="text-right"><?= formatMoney($ucaps[$i]["cost"]); ?></td>
                                                </tr>
                                        <?php
                                                $subtotal01 = $subtotal01 + $ucaps[$i]["cost"];
                                                $total01 = $total01 + $ucaps[$i]["cost"];
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-right">Sub-Total <?= $grupo01; ?> :</th>
                                            <td class="text-right"><?= formatMoney($subtotal01) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-right">Total :</th>
                                            <td class="text-right"><?= formatMoney($total01) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </section>
                    <div class="col-md-8 d-print-none offset-md-2 mt-2">
                        <a href="/infinvval" class="btn btn-light border text-left">Back</a>
                        <a class="btn btn-primary float-right" href="javascript:window.print('#sActa');"><i class="fa fa-print"></i> Imprimir</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>