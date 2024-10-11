<?php
//echo '<pre>'; print_r($_GET); echo '</pre>';

/* Verifico Horas Disponibilidad Todal*/
$select = "id_element,id_class_element";
$url = "relations?rel=elements,classes,technologies,powers&type=element,class,technology,power&select=" . $select . "&linkTo=id_class_element&equalTo=" . 1;
$method = "GET";
$fields = array();
$elements = CurlController::request($url,$method,$fields);
//echo '<pre>'; print_r($elements); echo '</pre>';

if($elements->status == 200){ 
  $elements = $elements->total;
  $disponibles = $elements * 12 * 30;
  //echo '<pre>'; print_r($disponibles); echo '</pre>';
}else{
  $elements = 0;
}  
/* */
/* Selecciono las PQRs en el rango de fechas */
$select = "*";
$url = "relations?rel=pqrs,crews&type=pqr,crew&select=" . $select . "&linkTo=DATE(date_pqr)&between1=" . $_GET['begindate'] . "&between2=" . $_GET['enddate']; 
//echo '<pre>'; print_r($url); echo '</pre>';
$pqrs = CurlController::request($url,$method,$fields);
//echo '<pre>'; print_r($pqrs); echo '</pre>';exit;
if ($pqrs->status == 200) {
    $totrec = $pqrs->total;
    $pqrs = $pqrs->results;
    //echo '<pre>'; print_r($totrec); echo '</pre>';
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
                if ($totrec = 0) {
                ?>
                    <p>Datos no encontrados</p>
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
                                            <th>Secuencia</th>
                                            <th>Reportada Por</th>
                                            <th>Reporte</th>
                                            <th>Dirección</th>
                                            <th>Asignada en</th>
                                            <th>Cuadrilla</th>
                                            <th>Resuelta en</th>
                                            <th>Horas Solución</th>
                                            <th>Observación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //echo '<pre>'; print_r($totrec); echo '</pre>';
                                        $subtotal01 = 0;
                                        $total01 = 0;
                                        $grupo01 = '';
                                        $secuencia = 1;
                                        $indiceid = 0;
                                        $totrec = count($pqrs);
                                        //echo '<pre>'; print_r(count($pqrs)); echo '</pre>';
                                        if ($totrec > 0) {
                                            foreach ($pqrs as $pqr) {
                                                    $inidate = new DateTime($pqr->date_pqr);
                                                    $enddate = new DateTime($pqr->datesolved_pqr);
                                                    $diferencia = $inidate->diff($enddate);
                                                    $horas = ($diferencia->days * 24) + $diferencia->h + ($diferencia->i / 60);
                                                    $indiceid = $indiceid + $horas;
                                                    $ctrdate = $inidate->format('Y-m-d'); // Formato: Año-Mes-Día
                                                    //echo '<pre>'; print_r($ctrdate); echo '</pre>';
                                                    if ($grupo01 == '') {
                                                        $grupo01 = $ctrdate;
                                                        $subtotal01 = 0;
    
                                        ?>
                                                    <tr>
                                                        <th colspan="6" class="text-left"><?= $grupo01; ?></th>
                                                    </tr>
                                                    <?php }else {
                                                        if ($grupo01 != $ctrdate) {
                                                    ?>
                                                        <tr>
                                                            <th colspan="7" class="text-right">Sub-Total Pqrs del dia : <?= $grupo01; ?></th>
                                                            <td class="text-right"><?= formatMoney($subtotal01) ?></td>
                                                        </tr>
                                                    <?php
                                                            $subtotal01 = 0;
                                                            $grupo01 = $ctrdate;
                                                    ?>
                                                        <tr>
                                                            <th colspan="6" class="text-left"><?= $grupo01; ?></th>
                                                        </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                <tr>
                                                    <td class="text-left"><?= $secuencia; ?></td>
                                                    <td class="text-left"><?= $pqr->name_pqr; ?></td>
                                                    <td class="text-left"><?= substr($pqr->message_pqr,0,20); ?></td>
                                                    <td class="text-left"><?= $pqr->address_pqr; ?></td>
                                                    <td class="text-left"><?= $pqr->dateasign_pqr; ?></td>
                                                    <td class="text-left"><?= $pqr->name_crew; ?></td>
                                                    <td class="text-left"><?= $pqr->datesolved_pqr; ?></td>
                                                    <td class="text-right"><?= formatMoney($horas); ?></td>
                                                </tr>
                                        <?php
                                                $secuencia++;
                                                $subtotal01++;
                                                $total01++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="7" class="text-right">Sub-Total Pqrs del dia : <?= $grupo01; ?></th>
                                            <td class="text-right"><?= formatMoney($subtotal01) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-right">Total:</th>
                                            <td class="text-right"><?= formatMoney($total01) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-right">Tiempo no dosponible:</th>
                                            <td class="text-right"><?= formatMoney($indiceid) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-right">Total Disponibilidad:</th>
                                            <td class="text-right"><?= formatMoney($indiceid) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-right">Indice ID:</th>
                                            <td class="text-right"><?= formatMoney($indiceid/$disponibles) ?></td>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </section>
                    <div class="col-md-8 d-print-none offset-md-2 mt-2">
                        <a href="/infpqrs" class="btn btn-light border text-left">Back</a>
                        <a class="btn btn-primary float-right" href="javascript:window.print('#sActa');"><i class="fa fa-print"></i> Imprimir</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>