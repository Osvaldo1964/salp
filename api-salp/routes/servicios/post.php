<?php
//echo '<pre>'; print_r($linkToArray); echo '</pre';

require_once "models/connection.php";
require_once "controllers/post.controller.php";

if (isset($_POST)) {

    /* Separo las columnas en un arreglo  */
    $columns = array();
    foreach (array_keys($_POST) as $key => $value) {
        array_push($columns, $value);
    }

    /* Validamos la tabla y las columnas */
    if (empty(Connection::getColumnsData($table, $columns))) {
        $json = array(
            'status' => 400,
            'results' => "Error: Los campos no concuerdan con los de la tabla"
        );
        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

    $response = new PostController();

    /* Petición POST para el registro de usuarios */
    if (isset($_GET["register"]) && $_GET["register"] == true) {
        $sufix = $_GET["sufix"] ?? "user";
        $response->postRegister($table, $_POST, $sufix);

        /* Petición POST para el login de usuarios */
    } else if (isset($_GET["login"]) && $_GET["login"] == true) {
        $sufix = $_GET["sufix"] ?? "user";
        $response->postLogin($table, $_POST, $sufix);
    } else {
        /* Petición POST para usuarios autenticados */
        if (isset($_GET["token"])) {
            /* Peticion POST par usuarios no autenticados*/
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
                $response->postData($table, $_POST);
            } else {
                /* Peticion POST par usuarios autenticados*/
                $tableToken = $_GET["table"] ?? "usuarios";
                $suffix = $_GET["sufix"] ?? "usuario";
                $validate = Connection::tokenValidate($_GET["token"], $tableToken, $suffix);
                if ($validate == "ok") {
                    /* Solicitamos al controlador para la creacion de datos en cualquier tabla*/
                    $response->postData($table, $_POST);
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
            $json = array(
                'status' => 400,
                'results' => "Error: Se requiere autorización"
            );
            echo json_encode($json, http_response_code($json["status"]));
            return;
        }
    }
}
