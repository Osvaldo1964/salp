<div class="card">
    <div class="card-header">
    </div>
    <!-- /.card-header -->
    <form action="/infpqrs/print">
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