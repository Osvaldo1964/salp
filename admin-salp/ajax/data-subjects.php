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
            $url = "subjects?select=id_subject&linkTo=date_created_subject&between1=".$_GET["between1"]."&between2=".$_GET["between2"];
			$method = "GET";
			$fields = array();
			$response = CurlController::request($url,$method,$fields);  
			if($response->status == 200){	
				$totalData = $response->total;
			}else{
				echo '{"data": []}';
                return;
			}	

			/* Búsqueda de datos */	
            $select = "id_subject,typedoc_subject,numdoc_subject,fullname_subject,country_subject,city_subject,address_subject,email_subject,phone_subject";

            if(!empty($_POST['search']['value'])){
            	if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){
	            	$linkTo = ["numdoc_subject,fullname_subject","email_subject","country_subject","city_subject","date_created_subject"];
	            	$search = str_replace(" ","_",$_POST['search']['value']);
	            	foreach ($linkTo as $key => $value) {
	            		$url = "subjects?select=".$select."&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
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
	            $url = "subjects?select=".$select."&linkTo=date_created_subject&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
	            $data = CurlController::request($url,$method,$fields)->results;
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
	            	$actions = "";
            	}else{
            		$actions = "<a href='/subjects/edit/".base64_encode($value->id_subject."~".$_GET["token"])."' class='btn btn-warning btn-sm mr-1 rounded-circle'>
			            		<i class='fas fa-pencil-alt'></i>
			            		</a>
								<a href='/subjects/upload/".base64_encode($value->id_subject."~".$_GET["token"])."' class='btn btn-warning btn-sm mr-1 rounded-circle'>
			            		<i class='far fa-file-pdf'></i>
			            		</a>
			            		<a class='btn btn-danger btn-sm rounded-circle removeItem' idItem='".base64_encode($value->id_subject."~".$_GET["token"])."' table='subjects' suffix='subject' deleteFile='no' page='subjects'>
			            		<i class='fas fa-trash'></i>
			            		</a>";
			        $actions = TemplateController::htmlClean($actions);
            	}	

                $typedoc_subject = $value->typedoc_subject;
                $numdoc_subject = $value->numdoc_subject;
            	$fullname_subject = $value->fullname_subject;
                $country_subject = $value->country_subject;
                $city_subject = $value->city_subject;
                $address_subject = $value->address_subject;
            	$email_subject = $value->email_subject;
                $phone_subject = $value->phone_subject;

            	$dataJson.='{ 
            		"id_subject":"'.($start+$key+1).'",
                    "typedoc_subject":"'.$typedoc_subject.'",
            		"numdoc_subject":"'.$numdoc_subject.'",
            		"fullname_subject":"'.$fullname_subject.'",
            		"country_subject":"'.$country_subject.'",
                    "city_subject":"'.$city_subject.'",
                    "address_subject":"'.$address_subject.'",
            		"email_subject":"'.$email_subject.'",
                    "phone_subject":"'.$phone_subject.'",
            		"actions":"'.$actions.'"
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
