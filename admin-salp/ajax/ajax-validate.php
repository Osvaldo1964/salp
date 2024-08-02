<?php

require_once "../controllers/curl.controller.php";

class ValidateController{
	public $data;
	public $table;
	public $suffix;
	public $line;

	public function dataRepeat(){
		$url = $this->table."?select=".$this->suffix."&linkTo=".$this->suffix."&equalTo=".$this->data;
		$method = "GET";
		$fields = array();
		$response = CurlController::request($url, $method, $fields);

		if ($response->status == 200){
			
		}
		echo $response->status;
	}

	public function selectLines(){
		$url = "brandlines?select=id_brandline,name_brandline,id_brand_brandline&linkTo=id_brand_brandline&equalTo=".$this->line;
		$method = "GET";
		$fields = array();
		$brandlines = CurlController::request($url, $method, $fields)->results;
		//echo '<pre>'; print_r($brandlines); echo '</pre>';
		$cadena = '<select name="brandline" id="brandline">';

		foreach ($brandlines as $key => $value) {
			$cadena .= "<option value=" . $value->id_brandline . ">" . $value->name_brandline . "</option>";
		}
		$cadena .= "</select>";
		//echo '<pre>'; print_r($cadena); echo '</pre>';
		echo $cadena;
		
		
	}
}

if(isset($_POST["data"])){
	$validate = new ValidateController();
	$validate -> data = $_POST["data"];
	$validate -> table = $_POST["table"];
	$validate -> suffix = $_POST["suffix"];
	$validate -> dataRepeat();
}

if(isset($_POST["brandline"])){
	$validate = new ValidateController();
	$validate -> line = $_POST["brandline"];
	$validate -> selectLines();
}