<?php
//echo '<pre>'; print_r($_SESSION); echo '</pre>';exit;

$select = "*";
$url = "relations?rel=pqrs,crews&type=pqr,crew&select=" . $select . "&orderBy=date_created_pqr&orderMode=ASC";
$method = "GET";
$fields = array();
$response = CurlController::request($url, $method, $fields);
if ($response->status == 200) {
    $records = $response->total;
    $pqrs = $response->results[0];
    echo '<pre>';
    print_r($pqrs);
    echo '</pre>';
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
                if ($records = 0) {
                ?>
                    <p>Datos no encontrados</p>
                <?php } else {
                    $acta = $deliveries->id_delivery;
                    //dep($acta);
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
                            <div class="col-4"><b>Acta No. <?= $deliveries->id_delivery; ?></b><br>
                                <b>Fecha:</b> <?= $deliveries->date_delivery; ?><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped" style="font-size: 10px;">
                                    <thead>
                                        <tr>
                                            <th>Secuencia</th>
                                            <th>Fecha</th>
                                            <th>Reportada Por</th>
                                            <th>Asignada en</th>
                                            <th>Cuadrilla</th>
                                            <th>Resuelta en</th>
                                            <th>Horas Solución</th>
                                            <th>Observación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subtotal01 = 0;
                                        $total01 = 0;
                                        $grupo01 = '';
                                        if ($recelements > 0) {
                                            foreach ($pqrs as $elemento) {
                                                if ($grupo01 == '' || $grupo01 != '' & $grupo01 != $elemento->name_class) {
                                                    if ($grupo01 != '') {
                                        ?>
                                                        <th colspan="5" class="text-right">Sub-Total: <?= $grupo01; ?> </th>
                                                        <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal01) ?></td>
                                                    <?php }
                                                    $grupo01 = $elemento->name_class;
                                                    $subtotal01 = 0;
                                                    ?>
                                                    <tr>
                                                        <th colspan="6" class="text-left"><?= $elemento->name_class; ?></th>
                                                    </tr>
                                                <?php }
                                                ?>
                                                <tr>
                                                    <td class="text-left"><?= $elemento->code_element; ?></td>
                                                    <td class="text-left"><?= $elemento->name_element; ?></td>
                                                    <td class="text-left"><?= $elemento->id_class_element == 1 ? $elemento->name_technology : $elemento->name_material; ?></td>
                                                    <td class="text-left"><?= $elemento->id_class_element == 1 ? $elemento->name_power : $elemento->name_height; ?></td>
                                                    <td class="text-left"><?= $elemento->address_element; ?></td>
                                                    <td class="text-right"><?= SMONEY . formatMoney($elemento->value_element); ?></td>
                                                </tr>
                                        <?php
                                                $subtotal01 += $elemento->value_element;
                                                $total01 += $elemento->value_element;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" class="text-right">Sub-Total: <?= $elemento->name_class; ?></th>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal01) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="5" class="text-right">Total:</th>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($total01) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </section>
                    <div class="col-md-8 d-print-none offset-md-2 mt-2">
                        <a href="/deliveries" class="btn btn-light border text-left">Back</a>
                        <a class="btn btn-primary float-right" href="javascript:window.print('#sActa');"><i class="fa fa-print"></i> Imprimir</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>