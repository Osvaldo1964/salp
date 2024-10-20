<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
            <?php
            require_once "controllers/uses.controller.php";
            $create = new UsesController();
            //$create -> create();
            ?>

            <div class="col-md-8 offset-md-2">

                <!-- Descripción Estrato -->
                <div class="form-group mt-1">
                    <label>Descripción</label>
                    <input type="text" class="form-control" pattern="[A-Za-z0-9.-]" name="name" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group col-md-4">
                    <!-- Tarifa -->
                    <label>Valor</label>
                    <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="amount" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group col-md-4">
                    <!-- Valor Mínimo -->
                    <label>Valor</label>
                    <input type="text" class="form-control" pattern="^(0|[1-9]\d*)(\.\d+)?$" name="minimal" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

            </div>
            <?php
            require_once "controllers/uses.controller.php";
            $create = new UsesController();
            $create->create();
            ?>
        </div>

        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-1">
                    <a href="/uses" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-right">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>