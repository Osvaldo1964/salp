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
            <a href="/" class="btn btn-light border text-left btn-sm">Back</a>
            <a href="/infpqrs/print" class="btn bg-info btn-sm float-right">Imprimir</a>
            <!-- <a class="btn bg-info btn-sm" href="/infpqrs/print">Imprimir</a> -->
        </h3>
        <div class="card-tools">
        </div>
    </div>
    <!-- /.card-header -->
    <form action="">
        <div class="card-body">
            <div class="col-md-6 offset-md-2">
                <!-- Fecha Inicial  -->
                <div class="form-group col-md-6 mt-2 mb-1">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            Desde :
                        </span>
                        <input type="date" class="form-control" name="begindate">
                    </div>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <!-- Fecha Final -->
                <div class="form-group col-md-6 mt-2 mb-1">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            Hasta :
                        </span>
                        <input type="date" class="form-control" name="enddate">
                    </div>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

            </div>
        </div>
    </form>
    <!-- /.card-body -->
</div>