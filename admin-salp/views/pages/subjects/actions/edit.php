<?php
if (isset($routesArray[3])) {
    $security = explode("~", base64_decode($routesArray[3]));
    if ($security[1] == $_SESSION["user"]->token_user) {
        $select = "id_subject,typedoc_subject,numdoc_subject,fullname_subject,country_subject,city_subject,address_subject,email_subject,phone_subject";
        $url = "subjects?select=" . $select . "&linkTo=id_subject&equalTo=" . $security[0];;
        $method = "GET";
        $fields = array();
        $response = CurlController::request($url, $method, $fields);

        if ($response->status == 200) {
            $subjects = $response->results[0];
        } else {
            echo '<script>
				window.location = "/subjects";
				</script>';
        }
    } else {
        echo '<script>
				window.location = "/subjects";
				</script>';
    }
}
?>
<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $subjects->id_subject ?>" name="idSubject">
        <div class="card-header">
            <?php
            require_once "controllers/subjects.controller.php";
            $create = new SubjectsController();
            $create->edit($subjects->id_subject);
            ?>

            <div class="col-md-8 offset-md-2">
                <!--=====================================
                Tipo Documento
                ======================================-->

                <div class="form-group mt-1">
                    <label>Tipo Documento</label>
                    <?php
                    $typedocs = file_get_contents("views/assets/json/typedocs.json");
                    $typedocs = json_decode($typedocs, true);
                    ?>
                    <select class="form-control select2" name="typedoc" required>
                        <?php foreach ($typedocs as $key => $value) : ?>
                            <?php if ($value["name"] == $subjects->typedoc_subject) : ?>
                                <option value="<?php echo $subjects->typedoc_subject ?>" selected><?php echo $subjects->typedoc_subject ?></option>
                            <?php else : ?>
                                <option value="<?php echo $value["name"] ?>"><?php echo $value["name"] ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <!--=====================================
                Número Documento
                ======================================-->

                <div class="form-group mt-1">
                    <label>Número Documento</label>
                    <input type="text" class="form-control" pattern='[-\\(\\)\\0-9 ]{1,}' name="numdoc" value="<?php echo $subjects->numdoc_subject ?>" required>


                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <!--=====================================
                Nombre y apellido
                ======================================-->
                <div class="form-group mt-1">
                    <label>Nombres</label>
                    <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateJS(event,'text')" name="fullname" value="<?php echo $subjects->fullname_subject ?>" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-row">
                    <!-- País -->
                    <div class="form-group col-md-6">
                        <label>País</label>
                        <?php
                        $countries = file_get_contents("views/assets/json/countries.json");
                        $countries = json_decode($countries, true);
                        ?>
                        <select class="form-control select2 changeCountry" name="country" required>
                            <option value="<?php echo $subjects->country_subject ?>_<?php echo explode("_", $subjects->phone_subject)[0] ?>"><?php echo $subjects->country_subject ?></option>
                            <?php foreach ($countries as $key => $value) : ?>
                                <option value="<?php echo $value["name"] ?>_<?php echo $value["dial_code"] ?>"><?php echo $value["name"] ?></option>
                            <?php endforeach ?>
                        </select>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Ciudad -->
                    <div class="form-group col-md-6 ">
                        <label>Ciudad</label>
                        <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateJS(event,'text')" name="city" value="<?php echo $subjects->city_subject ?>" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>

                <!--=====================================
                Dirección
                ======================================-->

                <div class="form-group mt-1">
                    <label>Dirección</label>
                    <input type="text" class="form-control" pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}' onchange="validateJS(event,'regex')" name="address" value="<?php echo $subjects->address_subject ?>" required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>


                <div class="form-row">
                    <!-- Correo electrónico -->
                    <div class="form-group col-md-8 mt-1">
                        <label>Email</label>
                        <input type="email" class="form-control" pattern="[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" name="email" value="<?php echo $subjects->email_subject ?>" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Teléfono -->
                    <div class="form-group col-md-4 mt-1 mb-1">
                        <label>Teléfono</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text dialCode"><?php echo explode("_", $subjects->phone_subject)[0] ?></span>
                            </div>
                            <input type="text" class="form-control" pattern="[-\\(\\)\\0-9 ]{1,}" onchange="validateJS(event,'phone')" name="phone" value="<?php echo $subjects->phone_subject ? explode("_", $subjects->phone_subject)[1] : null ?>" required>
                        </div>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group mt-1">
                    <a href="/subjects" class="btn btn-light border text-left">Regresar</a>
                    <button type="submit" class="btn bg-dark float-right">Actualizar</button>
                </div>
            </div>
        </div>
    </form>
</div>