<?php

require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";
//echo '<pre>'; print_r($_POST); echo '</pre>';

class DatatableController
{
    public function data()
    {
        if (!empty($_POST)) {
            //echo '<pre>'; print_r($_POST); echo '</pre>';exit;
            /* Capturando y Organizando variables POST */

            $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables 
            $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)
            $orderBy = $_POST['columns'][$orderByColumnIndex]["data"]; //Obtener el nombre de la columna de clasificación de su índice
            $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC
            $start  = $_POST["start"]; //Indicador de primer registro de paginación.
            $length = $_POST['length']; //Indicador de la longitud de la paginación.

            /* Total de registros de la data */
            $url = "uses?select=id_use&linkTo=date_created_use&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&filterTo=status_use&inTo='Activo'";

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

            /* Busqueda de datos*/
            $select = "id_use,name_use,amount_use,minimal_use,date_created_use";
            if (!empty($_POST['search']['value'])) {
                //if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {
                $linkTo = ["name_use", "amount_use", "minimal_use"];
                $search = str_replace(" ", "_", $_POST['search']['value']);
                foreach ($linkTo as $key => $value) {
                    $url = "uses?select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
                    $data = CurlController::request($url, $method, $fields)->results;
                    if ($data == "Not Found") {
                        $data = array();
                        $recordsFiltered = count($data);
                    } else {
                        $data = $data;
                        $recordsFiltered = count($data);
                        break;
                    }
                }
                //}
            } else {
                /* Seleccionar los datos */
                $select = "id_use,name_use,amount_use,minimal_use,status_use,date_created_use";
                $url = "uses?select=" . $select . "&linkTo=date_created_use&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] .
                    "&filterTo=status_use&inTo='Activo'&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
                $data = CurlController::request($url, $method, $fields)->results;
                $recordsFiltered = $totalData;
            }

            /* Si no encuentro datos */
            if (empty($data)) {
                echo '{"data": []}';
                return;
            }

            /* Construyo el dato en JSON */
            //echo '<pre>'; print_r($data); echo '</pre>';exit;
            $dataJson = '{
                "Draw":' . intval($draw) . ',
                "recordsTotal":' . $totalData . ',
                "recordsFiltered":' . $recordsFiltered . ',
                "data":[';

            foreach ($data as $key => $value) {

                if ($_GET["text"] == "flat") {
                    /* Variables de tipo texto normal */
                    $status_use = $value->status_use;
                    $actions = "";
                } else {
                    if ($value->status_use != "Activo") {
                        $status_use = "<span class='badge badge-danger p-2'>" . $value->status_use . "</span>";
                    } else {
                        $status_use = "<span class='badge badge-success p-2'>" . $value->status_use . "</span>";
                    }
                    $actions = "<a href='/uses/edit/" . base64_encode($value->id_use . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mr-1 rounded-circle'>
					<i class='fas fa-pencil-alt'></i>
					</a>
					<a class='btn btn-danger btn-sm rounded-circle removeItem' idItem='" . base64_encode($value->id_use . "~" . $_GET["token"]) . "' table='uses' suffix='use' deleteFile='no' page='uses'>
					<i class='fas fa-trash'></i>
					</a>";
                    $actions = TemplateController::htmlClean($actions);
                }
                $name_use = $value->name_use;
                $amount_use = $value->amount_use;
                $minimal_use = $value->minimal_use;
                $date_created_use = $value->date_created_use;

                $dataJson .= '{
                    "id_use":"' . ($start + $key + 1) . '",
                    "name_use":"' . $name_use . '",
                    "amount_use":"' . $amount_use . '",
                    "minimal_use":"' . $minimal_use . '",
                    "date_created_use":"' . $date_created_use . '",
                    "status_use":"' . $status_use . '",
                    "actions":"' . $actions . '"
                },';
            }
            $dataJson = substr($dataJson, 0, -1);
            $dataJson .=  ']}';
            echo $dataJson;
        }
    }
}

/* Activar la funcion Datatable */
$data = new DataTableController();
$data->data();
