<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
            <h4>Generación Manual de Mandamientos de Pago</h4>
        </div>
        <div class="card-body">
            <?php
            require_once "controllers/payorders.controller.php";
            $create = new PayordersController();
            //$create -> create();
            ?>

            <div class="col-md-8 offset-md-2">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="listClase">Clase </label>
                                <select class="form-control" data-live-search="true" id="listClase" name="listClase" disabled></select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Código </label>
                                <input class="form-control" id="txtcodElemento" name="txtcodElemento" type="text" placeholder="Código" disabled>
                                <br>
                            </div>
                            <div class="form-group col-md-6">
                                <div id="divBarCode" class="notblock textcenter">
                                    <div id="printCode">
                                        <svg id="barcode"></svg>
                                    </div>
                                    <button class="btn btn-success btn-sm" type="button" onClick="fntPrintBarcode('#printCode')"><i class="fas fa-print"></i> Imprimir</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Descripción</label>
                                <input type="text" class="form-control" id="txtdetElemento" name="txtdetElemento" disabled></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Dirección</label>
                                <input type="text" class="form-control" id="txtdirElemento" name="txtdirElemento" disabled></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Descripción Elemento</label>
                                <textarea class="form-control" id="txtdesElemento" name="txtdesElemento"></textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Latitud </label>
                                <input class="form-control" id="fltlatElemento" name="fltlatElemento" type="text" placeholder="" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Longitud </label>
                                <input class="form-control" id="fltlonElemento" name="fltlonElemento" type="text" placeholder="" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="listRecursos">Origen Recurso </label>
                                <select class="form-control" data-live-search="true" id="listRecursos" name="listRecursos" disabled></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="listUsos">Clase de Iluminación </label>
                                <select class="form-control" data-live-search="true" id="listUsos" name="listUsos" disabled></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2 notblock" id="divTecno">
                                <label for="listTecno">Tecnología</label>
                                <select class="form-control" data-live-search="true" id="listTecno" name="listTecno" disabled></select>
                            </div>
                            <div class="form-group col-md-2 notblock" id="divPotencia">
                                <label for="listPotencia">Potencia</label>
                                <select class="form-control" data-live-search="true" id="listPotencia" name="listPotencia" disabled></select>
                            </div>
                            <div class="form-group col-md-2 Material notblock" id="divMaterial">
                                <label for="listMaterial">Material</label>
                                <select class="form-control" data-live-search="true" id="listMaterial" name="listMaterial" disabled></select>
                            </div>
                            <div class="form-group col-md-2 notblock" id="divAltura">
                                <label for="listAltura">Altura</label>
                                <select class="form-control" data-live-search="true" id="listAltura" name="listAltura" disabled></select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Valor </label>
                                <input class="form-control" id="fltvalElemento" name="fltvalElemento" type="number" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="listestElemento">Estado</label>
                                <select class="form-control selectpicker" id="listestElemento" name="listestElemento">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 mt-4">
                                <button id="btnActionForm" class="btn btn-primary btn-md btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="form-group col-md-4 mt-4">
                                <button class="btn btn-danger btn-md btn-block" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tile-footer">
                    <div class="form-group col-md-12">
                        <div id="containerGallery">
                            <span>Agregar Fotos (440 x 545)</span>
                            <button class="btnAddImage btn btn-info btn-sm" type="button">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <hr>
                        <div id="containerImages">
                        </div>
                    </div>
                </div>

            </div>
            <?php
            require_once "controllers/payorders.controller.php";
            $create = new PayordersController();
            $create->create();
            ?>
        </div>

        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-1">
                    <a href="/payorders" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-right">Generar</button>
                </div>
            </div>
        </div>
    </form>
</div>