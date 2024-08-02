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
            $url = "cuadrillas?select=id_cuadrilla&linkTo=date_created_cuadrilla&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=estado_cuadrilla&inTo=1";
            
            //"cuadrillas?select=id_cuadrilla&linkTo=estado_cuadrilla&equalTo=1";

            $method = "GET";
            $fields = array();
            $response = CurlController::request($url, $method, $fields);
            //echo '<pre>'; print_r($response); echo '</pre>';exit;
            if ($response->status == 200) {
                $totalData = $response->total;
            } else {
                echo '{"data": []}';
                return;
            }

            /* Busqueda de datos*/
            $select = "id_cuadrilla,nombre_cuadrilla,conductor_cuadrilla,tecnico_cuadrilla,ayudante_cuadrilla";
            if (!empty($_POST['search']['value'])) {
                //if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {
                    $linkTo = ["nombre_cuadrilla", "conductor_cuadrilla", "tecnico_cuadrilla", "ayudante_cuadrilla"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);
                    foreach ($linkTo as $key => $value) {
                        $url = "cuadrillas?select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
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
                $select = "id_cuadrilla,nombre_cuadrilla,conductor_cuadrilla,tecnico_cuadrilla,ayudante_cuadrilla";
                $url = "cuadrillas?select=" . $select . "&linkTo=date_created_cuadrilla&between1=".$_GET["between1"]."&between2=".$_GET["between2"].
                        "&filterTo=estado_cuadrilla&inTo=1&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
                $data = CurlController::request($url, $method, $fields)->results;
                $recordsFiltered = $totalData;
            }

            /* Si no encuentro datos */ 
            if (empty($data)){
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

                if ($_GET["text"] == "flat"){
                    /* Variables de tipo texto normal */
                    /* 
                    $picture_product = $value->picture_product;
                    */ 
                    $acciones = "";
                    //"<a class='btn btn-warning btn-sm mr-1 rounded-circle'><i class='fas fa-pencil-alt'></i></a><a class='btn btn-danger btn-sm rounded-circle removeItem'><i class='fas fa-trash'></i></a>";
                }else{
                    /* Variables de tipo texto enriquecido Imagenes u otros */
                    /*
                    $picture_product = "<img src='".TemplateController::returnImg($value->id_user,$value->picture_user,
                                        $value->method_user)."' class='img-circle' style='width:70px'>";
                    */
                    $acciones = "<a class='btn btn-warning btn-sm mr-1 rounded-circle'><i class='fas fa-pencil-alt'></i></a><a class='btn btn-danger btn-sm rounded-circle removeItem'><i class='fas fa-trash'></i></a>";
                }
                $nombre_cuadrilla = $value->nombre_cuadrilla;
                $conductor_cuadrilla = $value->conductor_cuadrilla;
                $tecnico_cuadrilla = $value->tecnico_cuadrilla;
                $ayudante_cuadrilla = $value->ayudante_cuadrilla;

                $dataJson .= '{
                    "id_cuadrilla":"' . ($start + $key + 1) . '",
                    "nombre_cuadrilla":"' . $nombre_cuadrilla . '",
                    "conductor_cuadrilla":"' . $conductor_cuadrilla . '",
                    "tecnico_cuadrilla":"' . $tecnico_cuadrilla . '",
                    "ayudante_cuadrilla":"' . $ayudante_cuadrilla . '",
                    "acciones":"' . $acciones . '"
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
