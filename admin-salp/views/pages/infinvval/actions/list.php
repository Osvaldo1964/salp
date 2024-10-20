<div class="card">
    <div class="card-header">
    </div>
    <!-- /.card-header -->
    <form action="/infinvval/print">
        <div class="card-body">
            <div class="col-md-6 offset-md-2">
                <!-- Fecha Inicial  -->
                <div class="form-group col-md-6 mt-2 mb-1">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            Desde :
                        </span>
                        <input type="date" class="form-control" id="begindate" name="begindate">
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
                        <input type="date" class="form-control" id="enddate" name="enddate">
                    </div>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <!-- Tipo de Reporte -->
                <div class="form-group mt-1">
                    <label>Tipo de Reporte</label>
                    <?php
                    $typerepo = file_get_contents("views/assets/json/typerepo.json");
                    $typerepo = json_decode($typerepo, true);
                    ?>
                    <select class="form-control select2" name="typerepo" required>
                        <option value>Tipo de Reporte</option>
                        <?php foreach ($typerepo as $key => $value) : ?>
                            <option value="<?php echo $value["name"] ?>"><?php echo $value["name"] ?></option>
                        <?php endforeach ?>
                    </select>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

            </div>
        </div>
        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-1">
                    <a href="/" class="btn btn-light border text-left">Regresar</a>
                    <button type="submit" class="btn bg-dark float-right">Imprimir</button>
                </div>
            </div>
        </div>
    </form>
    <!-- /.card-body -->
</div>