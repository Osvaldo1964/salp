<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>
            <p>Formato Imprimible</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <?php
                if (empty($data['arrFacturas'])) {
                ?>
                    <p>Datos no encontrados</p>
                <?php } else {
                    $facturas = $data['arrFacturas'];
                ?>
                    <section id="sFacturas" class="invoice">
                        <div class="row mb-4">
                            <div class="wd33">
                                <img src="<?php echo $imagenBase64 ?>" alt="Logo">
                                <!--  <h2 class="page-header" style="width: 50px; height: 500px"><img src="<?= media(); ?>/site/images/icons/logo_icaruscol.jpg"></h2> -->
                            </div>
                            <div class="col-6">
                                <!-- <h5 class="text-right">Fecha: <?= $orden['fecPedido']; ?></h5> -->
                            </div>
                        </div>
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
                             <div class="col-4"><b>INFORME DE FACTURACION - RECAUDOS</b><br>
                                <b>Fecha de Impresión:</b> <?= date("Y-m-d"); ?><br>
                                <b>Período Inicial:</b> <?= $data['fechaInicial']; ?><br>
                                <b>Período Final:</b> <?= $data['fechaFinal']; ?><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Estrato</th>
                                            <th>Usuarios</th>
                                            <th>Facturado</th>
                                            <th>Recaudado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subtotal01 = 0;
                                        $subtotal02 = 0;
                                        $subtotal03 = 0;
                                        $total01 = 0;
                                        $total02 = 0;
                                        $total03 = 0;
                                        $grupo01 = '';
                                        if (count($facturas) > 0) {
                                            foreach ($facturas as $elemento) {
                                                if ($grupo01 == '' || $grupo01 != '' & $grupo01 != $elemento['perFactura']) {
                                                    if ($grupo01 != '') {
                                        ?>
                                                        <th colspan="1" class="text-right">Sub-Total: <?= $grupo01; ?> </th>
                                                        <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal01) ?></td>
                                                        <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal02) ?></td>
                                                        <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal03) ?></td>
                                                    <?php }
                                                    $grupo01 = $elemento['perFactura'];
                                                    $subtotal01 = 0;
                                                    $subtotal02 = 0;
                                                    $subtotal03 = 0;
                                                    ?>
                                                    <tr>
                                                        <th colspan="4" class="text-left"><?= $elemento['perFactura']; ?></th>
                                                    </tr>
                                                <?php }
                                                ?>
                                                <tr>
                                                    <td class="text-left"><?= $elemento['desEstrato']; ?></td>
                                                    <td class="text-right"><?= formatMoney($elemento['canFactura']); ?></td>
                                                    <td class="text-right"><?= SMONEY . formatMoney($elemento['facFactura']); ?></td>
                                                    <td class="text-right"><?= SMONEY . formatMoney($elemento['recFactura']); ?></td>
                                                    <!-- <td class="text-right"><?= SMONEY . formatMoney($elemento['totCosto']); ?></td> -->
                                                </tr>
                                        <?php
                                                $subtotal01 += $elemento['canFactura'];
                                                $subtotal02 += $elemento['facFactura'];
                                                $subtotal03 += $elemento['recFactura'];
                                                $total01 += $elemento['canFactura'];
                                                $total02 += $elemento['facFactura'];
                                                $total03 += $elemento['recFactura'];
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="1" class="text-right">Sub-Total: <?= $elemento['perFactura']; ?></th>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal01) ?></td>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal02) ?></td>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal03) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="1" class="text-right">Total:</th>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($total01) ?></td>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($total02) ?></td>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($total03) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sFacturas');"><i class="fa fa-print"></i> Imprimir</a></div>
                        </div>
                    </section>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
