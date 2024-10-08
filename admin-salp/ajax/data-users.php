<?php

require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";

class DatatableController{

	public function data(){
		//echo '<pre>'; print_r($_POST); echo '</pre>';exit;
		if(!empty($_POST)){

			/* Capturando y organizando las variables POST de DT */
			
			$draw = $_POST["draw"];//Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables 
			$orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)
			$orderBy = $_POST['columns'][$orderByColumnIndex]["data"];//Obtener el nombre de la columna de clasificación de su índice
			$orderType = $_POST['order'][0]['dir'];// Obtener el orden ASC o DESC
			$start  = $_POST["start"];//Indicador de primer registro de paginación.
            $length = $_POST['length'];//Indicador de la longitud de la paginación.

            /* El total de registros de la data */
            
            $url = "users?select=id_user&linkTo=date_created_user&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=id_rol_user&inTo='Usuarios'";
			//echo '<pre>'; print_r($url); echo '</pre>';exit;
			$method = "GET";
			$fields = array();
			$response = CurlController::request($url,$method,$fields);  
			//echo '<pre>'; print_r($response); echo '</pre>';
			if($response->status == 200){	
				$totalData = $response->total;
			}else{
				echo '{"data": []}';
                return;
			}	

			/* Búsqueda de datos */	

            $select = "id_user,picture_user,fullname_user,username_user,email_user,address_user,phone_user,date_created_user,method_user";

            if(!empty($_POST['search']['value'])){
            	if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){
	            	$linkTo = ["fullname_user","username_user","email_user","country_user","city_user","date_created_user"];
	            	$search = str_replace(" ","_",$_POST['search']['value']);
	            	foreach ($linkTo as $key => $value) {
	            		$url = "users?select=".$select."&linkTo=".$value.",id_rol_user&search=".$search.",Usuarios&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
	            		$data = CurlController::request($url,$method,$fields)->results;
	            		if($data  == "Not Found"){
	            			$data = array();
	            			$recordsFiltered = count($data);
	            		}else{
	            			$data = $data;
	            			$recordsFiltered = count($data);
	            			break;
	            		}
	            	}
            	}else{
        			echo '{"data": []}';
                	return;
            	}
            }else{

	            /* Seleccionar datos */

	            $url = "users?select=".$select."&linkTo=date_created_user&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=id_rol_user&inTo='Usuarios'&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
				//echo '<pre>'; print_r($url); echo '</pre>';exit;
	            $data = CurlController::request($url,$method,$fields)->results;
				//echo '<pre>'; print_r($data); echo '</pre>';exit;
	            $recordsFiltered = $totalData;
            }  

            /* Cuando la data viene vacía */

            if(empty($data)){
            	echo '{"data": []}';
            	return;
            }

            /* Construimos el dato JSON a regresar */

            $dataJson = '{
            	"Draw": '.intval($draw).',
            	"recordsTotal": '.$totalData.',
            	"recordsFiltered": '.$recordsFiltered.',
            	"data": [';

            /* Recorremos la data */	

            foreach ($data as $key => $value) {
            	if($_GET["text"] == "flat"){
	            	$picture_user = $value->picture_user;
	            	//$actions = "";
            	}else{
            	    $picture_user = "<img src='".TemplateController::returnImg($value->id_user,$value->picture_user,$value->method_user)."' class='img-circle' style='width:70px'>";
					//echo '<pre>'; print_r($picture_user); echo '</pre>';exit;
/*             		$actions = "<a href='/admins/edit/".base64_encode($value->id_user."~".$_GET["token"])."' class='btn btn-warning btn-sm mr-1 rounded-circle'>
			            		<i class='fas fa-pencil-alt'></i>
			            		</a>
			            		<a class='btn btn-danger btn-sm rounded-circle removeItem' idItem='".base64_encode($value->id_user."~".$_GET["token"])."' table='users' suffix='user' deleteFile='users/".$value->id_user."/".$value->picture_user."' page='admins'>
			            		<i class='fas fa-trash'></i>
			            		</a>";
			        $actions = TemplateController::htmlClean($actions); */
					//echo '<pre>'; print_r($actions); echo '</pre>';exit;
            	}	

            	$fullname_user = $value->fullname_user;
            	$username_user = $value->username_user;	
            	$email_user = $value->email_user;
				$address_user = $value->address_user;
				$phone_user = $value->phone_user;

            	$dataJson.='{ 
            		"id_user":"'.($start+$key+1).'",
            		"picture_user":"'.$picture_user.'",
            		"fullname_user":"'.$fullname_user.'",
            		"username_user":"'.$username_user.'",
            		"email_user":"'.$email_user.'",
            		"address_user":"'.$address_user.'",
					"phone_user":"'.$phone_user.'"
            	},';

            }
            $dataJson = substr($dataJson,0,-1); // este substr quita el último caracter de la cadena, que es una coma, para impedir que rompa la tabla
            $dataJson .= ']}';
            echo $dataJson;
		}
	}
}

/* Activar función DataTable */ 

$data = new DatatableController();
$data -> data();
