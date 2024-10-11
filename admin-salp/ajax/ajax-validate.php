<?php

require_once "../controllers/curl.controller.php";

class ValidateController
{
	public $data;
	public $table;
	public $suffix;
	public $line;
	public $item;
	public $muni;

	public function dataRepeat()
	{
		$url = $this->table . "?select=" . $this->suffix . "&linkTo=" . $this->suffix . "&equalTo=" . $this->data;
		$method = "GET";
		$fields = array();
		$response = CurlController::request($url, $method, $fields);

		if ($response->status == 200) {
		}
		echo $response->status;
	}

	public function selectLines()
	{
		$url = "brandlines?select=id_brandline,name_brandline,id_brand_brandline&linkTo=id_brand_brandline&equalTo=" . $this->line;
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

	public function selectMunis()
	{
		$url = "municipalities?select=id_municipality,name_municipality,id_department_municipality&linkTo=id_department_municipality&equalTo=" . $this->muni;
		$method = "GET";
		$fields = array();
		$munis = CurlController::request($url, $method, $fields)->results;
		$cadena = '<select name="munis" id="munis">';

		foreach ($munis as $key => $value) {
			$cadena .= "<option value=" . $value->id_municipality . ">" . $value->name_municipality . "</option>";
		}
		$cadena .= "</select>";
		//echo '<pre>'; print_r($cadena); echo '</pre>';
		echo $cadena;
	}

	public function selectItems()
	{
		$url = "itemdeliveries?select=id_itemdelivery,name_itemdelivery,id_typedelivery_itemdelivery&linkTo=id_typedelivery_itemdelivery&equalTo=" . $this->item;
		$method = "GET";
		$fields = array();
		$itemdeliveries = CurlController::request($url, $method, $fields)->results;
		//echo '<pre>'; print_r($url); echo '</pre>';
		$cadena = '<select name="itemdelivery" id="itemdelivery">';

		foreach ($itemdeliveries as $key => $value) {
			$cadena .= "<option value=" . $value->id_itemdelivery . ">" . $value->name_itemdelivery . "</option>";
		}
		$cadena .= "</select>";
		//echo '<pre>'; print_r($cadena); echo '</pre>';
		echo $cadena;
	}
}

if (isset($_POST["data"])) {
	$validate = new ValidateController();
	$validate->data = $_POST["data"];
	$validate->table = $_POST["table"];
	$validate->suffix = $_POST["suffix"];
	$validate->dataRepeat();
}

if (isset($_POST["brandline"])) {
	$validate = new ValidateController();
	$validate->line = $_POST["brandline"];
	$validate->selectLines();
}

if (isset($_POST["itemdelivery"])) {
	$validate = new ValidateController();
	$validate->item = $_POST["itemdelivery"];
	$validate->selectItems();
}

if(isset($_POST["munis"])){
	$validate = new ValidateController();
	$validate -> muni = $_POST["munis"];
	$validate -> selectMunis();
}