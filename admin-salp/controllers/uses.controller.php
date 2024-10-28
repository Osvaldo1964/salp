<?php

class UsesController
{

	/* Creacion de Estratos */
	public function create()
	{
		//echo '<pre>'; print_r($_POST); echo '</pre>';return;
		if (isset($_POST["name"])) {
			echo '<script>
				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");
			</script>';

			/* Validamos la sintaxis de los campos */
			if (
				preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST["name"]) &&
				preg_match('/^(0|[1-9]\d*)(\.\d+)?$/', $_POST["amount"]) &&
				preg_match('/^(0|[1-9]\d*)(\.\d+)?$/', $_POST["minimal"])
			) {

				/* Agrupamos la información */
				$data = array(
					"name_use" => trim(strtoupper($_POST["name"])),
					"amount_use" => trim(strtoupper($_POST["amount"])),
					"minimal_use" => trim(strtoupper($_POST["minimal"])),
					"date_created_use" => date("Y-m-d")
				);

				$url = "uses?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
				$method = "POST";
				$fields = $data;
				$response = CurlController::request($url, $method, $fields);

				/* Respuesta de la API */
				if ($response->status == 200) {
					echo '<script>
					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncSweetAlert("success", "Registro grabado correctamente", "/uses");
				</script>';
				}
			} else {
				echo '<script>
					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncNotie(3, "Error de sintaxys en los campos");
				</script>';
			}
		}
	}

	/* Edición Estratos */
	public function edit($id)
	{
		if (isset($_POST["idUse"])) {
			echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Loading...", "");
				</script>';

			if ($id == $_POST["idUse"]) {
				$select = "id_use";
				$url = "uses?select=" . $select . "&linkTo=id_use&equalTo=" . $id;
				$method = "GET";
				$fields = array();
				$response = CurlController::request($url, $method, $fields);

				if ($response->status == 200) {
					/* Validamos la sintaxis de los campos */
					if (
						preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST["name"]) &&
                        preg_match('/^(0|[1-9]\d*)(\.\d+)?$/', $_POST["amount"]) &&
                        preg_match('/^(0|[1-9]\d*)(\.\d+)?$/', $_POST["minimal"])
					) {

						/* Agrupamos la información */
						$data = "name_use=" . trim(strtoupper($_POST["name"])) . 
								"&amount_use=" . trim(strtoupper($_POST["amount"])) . 
								"&minimal_use=" . trim(strtoupper($_POST["minimal"]));

						/* Solicitud a la API */
						$url = "uses?id=" . $id . "&nameId=id_use&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";

						$method = "PUT";
						$fields = $data;
						$response = CurlController::request($url, $method, $fields);

						/* Respuesta de la API */
						if ($response->status == 200) {
							echo '<script>
									fncFormatInputs();
									matPreloader("off");
									fncSweetAlert("close", "", "");
									fncSweetAlert("success", "Registro actualizado correctamente", "/uses");
							</script>';
						} else {
							echo '<script>
									fncFormatInputs();
									matPreloader("off");
									fncSweetAlert("close", "", "");
									fncNotie(3, "Error al editar el registro");
								</script>';
						}
					} else {
						echo '<script>
								fncFormatInputs();
								matPreloader("off");
								fncSweetAlert("close", "", "");
								fncNotie(3, "Error de sintaxys");
						</script>';
					}
				} else {
					echo '<script>
							fncFormatInputs();
							matPreloader("off");
							fncSweetAlert("close", "", "");
							fncNotie(3, "Error editing the registry");
						</script>';
				}
			} else {
				echo '<script>
						fncFormatInputs();
						matPreloader("off");
						fncSweetAlert("close", "", "");
						fncNotie(3, "Error editing the registry");
				</script>';
			}
		}
	}
}
