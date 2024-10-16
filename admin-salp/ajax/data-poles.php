<?php

require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";

class DatatableController
{

    public function data()
    {
        //echo '<pre>'; print_r($_POST); echo '</pre>';exit;
        if (!empty($_POST)) {

            /* Capturando y organizando las variables POST de DT */
            $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables 
            $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)
            $orderBy = $_POST['columns'][$orderByColumnIndex]["data"]; //Obtener el nombre de la columna de clasificación de su índice
            $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC
            $start  = $_POST["start"]; //Indicador de primer registro de paginación.
            $length = $_POST['length']; //Indicador de la longitud de la paginación.

            /* El total de registros de la data */
            $url = "poles?select=id_pole&linkTo=date_created_pole&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&filterTo=status_pole&inTo='Activo'";
            $method = "GET";
            $fields = array();
            $response = CurlController::request($url, $method, $fields);
            //echo '<pre>'; print_r($url); echo '</pre>';exit;
            if ($response->status == 200) {
                $totalData = $response->total;
            } else {
                echo '{"data": []}';
                return;
            }

            /* Búsqueda de datos */
            $select = "*";

            if (!empty($_POST['search']['value'])) {
                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {
                    $linkTo = ["number_delivery","code_pole","detail_pole","name_material","name_height"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {
                        $url = "relations?rel=poles,deliveries,materials,heights&type=pole,delivery,material,height&select=" . $select . "&linkTo=" .
                            $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" .
                            $length;
                        $data = CurlController::request($url, $method, $fields)->results;
                        if ($data  == "Not Found") {
                            $data = array();
                            $recordsFiltered = count($data);
                        } else {
                            $data = $data;
                            $recordsFiltered = count($data);
                            break;
                        }
                    }
                } else {
                    echo '{"data": []}';
                    return;
                }
            } else {

                /* Seleccionar datos */
                $url = "relations?rel=poles,deliveries,materials,heights&type=pole,delivery,material,height&select=" . $select .
                 "&linkTo=date_created_pole&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] .
                 "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
                //echo '<pre>'; print_r($url); echo '</pre>';exit;
                $data = CurlController::request($url, $method, $fields)->results;
                $recordsFiltered = $totalData;
            }

            /* Cuando la data viene vacía */
            if (empty($data)) {
                echo '{"data": []}';
                return;
            }

            /* Construimos el dato JSON a regresar */
            $dataJson = '{
            	"Draw": ' . intval($draw) . ',
            	"recordsTotal": ' . $totalData . ',
            	"recordsFiltered": ' . $recordsFiltered . ',
            	"data": [';

            /* Recorremos la data */
            //echo '<pre>'; print_r($data); echo '</pre>';
            foreach ($data as $key => $value) {
                if ($_GET["text"] == "flat") {
                    $status_pole = $value->status_pole;
                    //$follow_payorder = "";
                } else {
                    //echo '<pre>'; print_r($value->follow_payorder); echo '</pre>';exit;
                    if ($value->status_pole != "Activo") {
                        $status_pole = "<span class='badge badge-danger p-2'>" . $value->status_pole . "</span>";
                    } else {
                        $status_pole = "<span class='badge badge-success p-2'>" . $value->status_pole . "</span>";
                    }
                    $actions = "<a href='/poles/edit/" . base64_encode($value->id_pole . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-1 rounded-circle'>
			            		<i class='fas fa-pencil-alt'></i>
			            		</a>
			            		<a class='btn btn-danger btn-sm rounded-circle removeItem' idItem='" . base64_encode($value->id_pole . "~" . $_GET["token"]) . "' table='poles' suffix='pole' deleteFile='no' page='poles'>
			            		<i class='fas fa-trash'></i>
			            		</a>";
                    $actions = TemplateController::htmlClean($actions);
                }

                $code_pole = $value->code_pole;
                $name_material = $value->name_material;
                $name_height = $value->name_height;
                $detail_pole = $value->detail_pole;
				$address_pole = $value->address_pole;
				$latitude_pole = $value->latitude_pole;
				$longitude_pole = $value->longitude_pole;
				$cost_pole = $value->cost_pole;
                $number_delivery = $value->number_delivery;
				$status_pole = $value->status_pole;
                $date_created_pole = $value->date_created_pole;

                $dataJson .= '{ 
            		"id_pole":"' . ($start + $key + 1) . '",
					"code_pole":"' . $code_pole . '",
                    "name_material":"' . $name_material . '",
                    "name_height":"' . $name_height . '",
                    "detail_pole":"' . $detail_pole . '",
					"address_pole":"' . $address_pole . '",
					"latitude_pole":"' . $latitude_pole . '",
					"longitude_pole":"' . $longitude_pole . '",
					"cost_pole":"' . $cost_pole . '",
                    "number_delivery":"' . $number_delivery . '",
                    "status_pole":"' . $status_pole . '",
                    "date_created_pole":"' . $date_created_pole . '",
                    "actions":"' . $actions . '"
            	},';
            }
            $dataJson = substr($dataJson, 0, -1); // este substr quita el último caracter de la cadena, que es una coma, para impedir que rompa la tabla
            $dataJson .= ']}';
            echo $dataJson;
        }
    }
}

/* Activar función DataTable */
$data = new DatatableController();
$data->data();
