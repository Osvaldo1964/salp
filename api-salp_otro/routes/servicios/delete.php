<?php
require_once "models/connection.php";
require_once "controllers/delete.controller.php";

if (isset($_GET["id"]) && isset($_GET["nameId"])) {

    $columns = array($_GET["nameId"]);
    /* Validamos la tabla y las columnas */
    if (empty(Connection::getColumnsData($table, $columns))) {
        $json = array(
            'status' => 400,
            'results' => "Error: Los campos no concuerdan con los de la tabla"
        );
        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

    /* Petición DELETE para usuarios autenticados */
    if (isset($_GET["token"])) {
        $tableToken = $_GET["table"] ?? "usuarios";
        $suffix = $_GET["sufix"] ?? "usuario";
        $validate = Connection::tokenValidate($_GET["token"], $tableToken, $suffix);
        /* Solicitamos al controlador para editar datos en cualquier tabla*/
        if ($validate == "ok") {
            /* Solicitamos al controlador para eliminar datos registros  en cualquier tabla*/
            $response = new DeleteController();
            $response->deleteData($table, $_GET["id"], $_GET["nameId"]);
        }
        if ($validate == "expirado"){
            $json = array(
                'status' => 303,
                'results' => "Error: El token de seguridad ha expirado"
            );
            echo json_encode($json, http_response_code($json["status"]));
            return;
        }
        if ($validate == "no autorizado"){
            $json = array(
                'status' => 400,
                'results' => "Error: El usuario no esta autorizado"
            );
            echo json_encode($json, http_response_code($json["status"]));
            return;
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
