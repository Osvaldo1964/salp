<div class="card card-dark card-outline">
    <form id="Infpqr">
        <div class="card-header">
            <h4>Informe de PQRs por Fechas</h4>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-2">
                <!-- Fecha Inicial  -->
                <div class="form-group col-md-6 mt-2 mb-1">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            Desde :
                        </span>
                        <input type="begindate" class="form-control" name="datedelivery">
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
                        <input type="enddate" class="form-control" name="datedelivery">
                    </div>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

            </div>
        </div>

        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-1">
                    <a href="/" class="btn btn-light border text-left">Back</a>
                    <a href="/print" class="btn btn-light border text-left">Imprimir</a>
                    <!-- <button type="submit" class="btn bg-dark float-right">Save</button> -->
                </div>
            </div>
        </div>
    </form>
</div>