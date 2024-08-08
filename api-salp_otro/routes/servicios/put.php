<?php
//echo '<pre>'; print_r($value); echo '</pre>';

require_once "models/connection.php";
require_once "controllers/put.controller.php";

if (isset($_GET["id"]) && isset($_GET["nameId"])) {
    /* Capturo los datos del formulario*/
    $data = array();
    parse_str(file_get_contents('php://input'), $data);

    /* Separo las columnas en un arreglo  */
    $columns = array();
    foreach (array_keys($data) as $key => $value) {
        array_push($columns, $value);
    }
    array_push($columns, $_GET["nameId"]);
    $columns = array_unique($columns);

    /* Validamos la tabla y las columnas */
    if (empty(Connection::getColumnsData($table, $columns))) {
        $json = array(
            'status' => 400,
            'results' => "Error: Los campos no concuerdan con los de la tabla"
        );
        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

    /* Petición POST para usuarios autenticados */
    if (isset($_GET["token"])) {
        /* Peticion PUT par usuarios no autenticados*/
        if ($_GET["token"] == "no" && isset($_GET["except"])) {
            /* Validamos la tabla y las columnas */
            $columns = array($_GET["except"]);
            if (empty(Connection::getColumnsData($table, $columns))) {
                $json = array(
                    'status' => 400,
                    'results' => "Error: Los campos no concuerdan con los de la tabla"
                );
                echo json_encode($json, http_response_code($json["status"]));
                return;
            }
            /* Solicitamos al controlador para la creacion de datos en cualquier tabla*/
            $response = new PutController();
            $response->putData($table, $data, $_GET["id"], $_GET["nameId"]);
        } else {
            /* Peticion PUT par usuarios autenticados*/
            $tableToken = $_GET["table"] ?? "usuarios";
            $suffix = $_GET["sufix"] ?? "usuario";
            $validate = Connection::tokenValidate($_GET["token"], $tableToken, $suffix);
            /* Solicitamos al controlador para editar datos en cualquier tabla*/
            if ($validate == "ok") {
                $response = new PutController();
                $response->putData($table, $data, $_GET["id"], $_GET["nameId"]);
            }
            if ($validate == "expirado") {
                $json = array(
                    'status' => 303,
                    'results' => "Error: El token de seguridad ha expirado"
                );
                echo json_encode($json, http_response_code($json["status"]));
                return;
            }
            if ($validate == "no autorizado") {
                $json = array(
                    'status' => 400,
                    'results' => "Error: El usuario no esta autorizado"
                );
                echo json_encode($json, http_response_code($json["status"]));
                return;
            }
        }
    } else {
        /* Error cuando no se envia el token*/
        $json = array(
            'status' => 400,
            'results' => "Error: Se requiere autorización"
        );
        echo json_encode($json, http_response_code($json["status"]));
        return;
    }
}
