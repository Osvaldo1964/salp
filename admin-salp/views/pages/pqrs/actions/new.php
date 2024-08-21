<div class="card card-dark card-outline">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
            <?php
            require_once "controllers/pqrs.controller.php";
            $create = new PqrsController();
            ?>
            <div class="row">
                <!-- Izquierda -->
                <div class="col-md-4">
                    <div class="row">
                        <!-- Nombre  -->
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" class="form-control" pattern='[a-zA-Z0-9_ ]{1,}' name="name" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <!-- Correo electrónico -->
                        <div class="form-group col-md-12">
                            <label>Email</label>
                            <input type="email" class="form-control" pattern="[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" name="email" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <!-- Dirección -->
                        <div class="form-group col-md-12">
                            <label>Dirección</label>
                            <input type="text" class="form-control" pattern='[a-zA-Z0-9_ ]+[.]+[-]+[,]{1,}' onblur="seekAddress(address.value)" name="address" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <!-- Descripcion de la Falla -->
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" cols="65" rows="3" placeholder="Detalle ..." name="message"></textarea>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Derecha -->
                <div class="col-md-8">
                    <div id="map" style="height: 500px; width: 100%;"></div>

                </div>
            </div>
            <?php
            require_once "controllers/pqrs.controller.php";
            $create = new PqrsController();
            $create->create();
            ?>
        </div>
        <div class="card-footer">
            <div class="col-md-8 offset-md-2">
                <div class="form-group submtit">
                    <a href="/elements" class="btn btn-light border text-left">Back</a>
                    <button type="submit" class="btn bg-dark float-right saveBtn">Save</button>
                </div>
            </div>
        </div>
    </form>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDTJ5uq4WEhP4noQ6DKM7aFVUYwGabdu8&callback=initMap&libraries=geometry&loading=async">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            //initMap();
        });

        function seekAddress(Address) {
            alert(Address);
            $.ajax({
                url: "getaddress.php",
                success: function(result) {
                    coor = JSON.parse(result);

                    alert(coor);
                    //$("div").text(result);
                }
            })
        }

        function ActMap(latitude, longitude) {
            // Variables para ubicarte en santa marta
            //let latitude = 11.24323;
            //let longitude = -74.20496;

            // Por si tiene la ubicación activada en el teléfono o navegador, las pilla de ahí y se las asigna
            if (typeof window.latitude !== 'undefined' && typeof window.longitude !== 'undefined') {

                this.latitude = window.latitude;
                this.longitude = window.longitude;
            }

            const position = {
                lat: latitude,
                lng: longitude
            };

            // Importas googlemaps
            const {
                Map
            } = await google.maps.importLibrary("maps");
            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");

            // Te ubica la dirección y te la pone en un zoom que te ambienta que tienes al rededor
            const map = new Map(document.getElementById("map"), {
                zoom: 16,
                center: position,
                mapId: "DEMO_MAP_ID",
            });

            // Te pone el mondaquito ese para que sepas exactamente donde estás
            const marker = new AdvancedMarkerElement({
                map: map,
                position: position,
                title: "Santa Marta",
            });
    </script>

</div>