<?php
$security = $routesArray[3];
$select = "*";
$url = "relations?rel=pqrs,crews&type=pqr,crew&select=" . $select . "&linkTo=id_pqr&equalTo=" . $security;
$method = "GET";
$fields = array();
$response = CurlController::request($url, $method, $fields);
$assign = $response->results[0];
/* echo '<pre>';
print_r($assign);
echo '</pre>'; */
?>



<div class="card card-dark card-outline" id="sAssign">
    <div class="card-header">
        <img src="<?php echo TemplateController::srcImg() ?>views/assets/img/global_logo.png" style="width:250px" alt="User Image">
    </div>
    <div class="card-body">
        <div class="row invoice-info">
            <div class="col-4">
                <address><strong><?= NOMBRE_EMPRESA; ?></strong><br>
                    <?= DIRECCION; ?><br>
                    <?= TELEMPRESA; ?><br>
                    <?= EMAIL_EMPRESA; ?><br>
                    <?= WEB_EMPRESA; ?><br>
                </address>
            </div>
            <div class="col-4">
            </div>
            <div class="col-4"><b>Asignacion No. <?= $assign->id_pqr; ?></b><br>
                <b>Fecha:</b> <?= $assign->dateasign_pqr; ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código UCAP</th>
                            <th>Descripción</th>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>_______________________________</td>
                            <td>_______________________________</td>
                            <td>_______________________________</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="1" class="text-left">Nombre Conductor: </th>
                            <td colspan="2" class="text-left"><?= $assign->driver_crew; ?></td>
                        </tr>
                        <tr>
                            <th colspan="1" class="text-left">Nombre Técnico: </th>
                            <td colspan="2" class="text-left"><?= $assign->tecno_crew; ?></td>
                        </tr>
                        <tr>
                            <th colspan="1" class="text-left">Nombre Ayudante: </th>
                            <td colspan="2" class="text-left"><?= $assign->assist_crew; ?></td>
                        </tr>
                        <tr>
                            <th colspan="1" class="text-left">Fecha Reparación: </th>
                            <td colspan="2" class="text-left">_________________________</td>
                        </tr>
                        <tr>
                            <th colspan="1" class="text-left">Observaciones: </th>
                            <td colspan="2" class="text-left">__________________________________</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="col-md-8 offset-md-2">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sActa');"><i class="fa fa-print"></i> Imprimir</a></div>
            </div>
        </div>
    </div>
    </form>
</div>