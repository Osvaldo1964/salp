<?php

class CrewsController
{

    /* Creacion de Marcas */
    public function create()
    {
        //echo '<pre>'; print_r($_POST); echo '</pre>';return;
        if (isset($_POST["name"])) {
            echo '<script>
				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");
			</script>';

            /* Validamos la sintaxis de los campos */
            if (
                preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST["name"]) &&
                preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST["driver"]) &&
                preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST["tecno"]) &&
                preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST["assist"])
            ) {

                /* Agrupamos la información */
                $data = array(
                    "name_crew" => trim(strtoupper($_POST["name"])),
                    "driver_crew" => trim(strtoupper($_POST["driver"])),
                    "tecno_crew" => trim(strtoupper($_POST["tecno"])),
                    "assist_crew" => trim(strtoupper($_POST["assist"])),
                    "date_created_crew" => date("Y-m-d")
                );

                $url = "crews?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
                $method = "POST";
                $fields = $data;
                $response = CurlController::request($url, $method, $fields);

                /* Respuesta de la API */
                if ($response->status == 200) {
                    echo '<script>
					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncSweetAlert("success", "Registro grabado correctamente", "/crews");
				</script>';
                }
            } else {
                echo '<script>
					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncNotie(3, "Error de sintaxys en los campos");
				</script>';
            }
        }
    }

    public function pqrs()
    {
        if ($_POST) {
            $nombre = ucwords(strtolower(strClean($_POST['nombrePqr'])));
            $email  = strtolower(strClean($_POST['emailPqr']));
            $direccion  = strtolower(strClean($_POST['direccionPqr']));
            $mensaje  = strClean($_POST['mensajePqr']);
            $coordenadas = $this->getGeocodeData($direccion);
            $latitud = $coordenadas[0];
            $longitud = $coordenadas[1];
            $newdireccion = $coordenadas[2];
            $userContact = $this->setPqr($nombre, $email, $direccion, $mensaje, $latitud, $longitud, $newdireccion);
            if ($userContact > 0) {
                $arrResponse = array('status' => true, 'lat' => $latitud, 'lon' => $longitud, 'msg' => "Su mensaje fue enviado correctamente.");
            } else {
                $arrResponse = array('status' => false, 'msg' => "No es posible enviar el mensaje.");
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    function getGeocodeData($address)
    {
        $address = urlencode($address);
        $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyDDTJ5uq4WEhP4noQ6DKM7aFVUYwGabdu8";
        $geocodeResponseData = file_get_contents($googleMapUrl);
        $responseData = json_decode($geocodeResponseData, true);
        if ($responseData['status'] == 'OK') {
            $latitude = isset($responseData['results'][0]['geometry']['location']['lat']) ? $responseData['results'][0]['geometry']['location']['lat'] : "";
            $longitude = isset($responseData['results'][0]['geometry']['location']['lng']) ? $responseData['results'][0]['geometry']['location']['lng'] : "";
            $formattedAddress = isset($responseData['results'][0]['formatted_address']) ? $responseData['results'][0]['formatted_address'] : "";
            if ($latitude && $longitude && $formattedAddress) {
                $geocodeData = array();
                array_push($geocodeData, $latitude, $longitude, $formattedAddress);
                return $geocodeData;
            } else {
                return false;
            }
        } else {
            echo "ERROR: {$responseData['status']}";
            return false;
        }
    }
}
