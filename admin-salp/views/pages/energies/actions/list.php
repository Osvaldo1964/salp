<?php
if (isset($_GET["start"]) && isset($_GET["end"])) {
    $between1 = $_GET["start"];
    $between2 = $_GET["end"];
} else {
    //$between1 = date("Y-m-d", strtotime("-29 day", strtotime(date("Y-m-d"))));
    $between1 = date("1900-01-01");
    $between2 = date("Y-m-d");
}
?>
<input type="hidden" id="between1" value="<?= $between1 ?>">
<input type="hidden" id="between2" value="<?= $between2 ?>">

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a class="btn bg-info btn-sm" href="/energies/new">Nuevo Registro</a>
            <a class="btn bg-info btn-sm" href="/energies/upload">Carga por Lotes</a>
        </h3>
        <div class="card-tools">
            <div class="d-flex">
                <div class="d-flex mr-2 text-sm">
                    <span class="mr-2">Imprimir</span>
                    <input type="checkbox" name="impr" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-size="mini" data-handle-width="70" onchange="reportActive(event)">
                </div>
                <div class="input-group">
                    <button type="button" class="btn float-right" data-size="mini" data-handle-width="70" id="daterange-btn">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <?php if ($between1 < "2000") {
                            echo "Start";
                        } else {
                            echo $between1;
                        } ?> - <?= $between2 ?>
                        <i class="fas fa-caret-down ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="adminsTable" class="table table-bordered table-striped tableEnergies">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Generador</th>
                    <th>Período</th>
                    <th>No. Factura</th>
                    <th>Consumo KWs</th>
                    <th>Tarifa Pesos</th>
                    <th>Total Factura</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tfoot>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<script src="views/assets/custom/datatable/datatable.js"></script>