<?php

class LuminariesController
{
	/* Creacion de Luminarias */
	public function create()
	{
		//echo '<pre>'; print_r($_POST); echo '</pre>';exit;
		if (isset($_POST["codeL"])) {
			echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Loading...", "");
			</script>';

			/* Validamos la sintaxis de los campos */
			if (
				preg_match('/[a-zA-Z0-9_]/', $_POST["codeL"])
			) {
				/* Guardar Imagenes de la galeria*/
				$galleryElement = array();
				foreach (json_decode($_POST['galleryElement'], true) as $key => $value) {
					$image["tmp_name"] = $value["file"];
					$image["type"] = $value["type"];
					$image["mode"] = "base64";
					$folder = "img/luminaries";
					$path =  "/" . strtolower($_POST["codeL"]);
					$width = $value["width"];
					$height = $value["height"];
					$name = strtolower($_POST["codeL"]) . "-" . mt_rand(1000000, 9999999);
					$saveImageGallery  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);
					array_push($galleryElement, $saveImageGallery);
				}

				$idDoc = $_POST["idDelivery"];
				/* Agrupamos la información */
				$data = array(
					"id_delivery_luminary" => $_POST["idDelivery"],
					"code_luminary" => $_POST["codeL"],
					"id_technology_luminary" => $_POST["technology"],
					"id_power_luminary" => $_POST["power"],
					"id_pole_luminary" => $_POST["pole"],
					"id_transformer_luminary" => $_POST["transformer"],
					"id_roud_luminary" => $_POST["roud"],
					"address_luminary" => trim(strtoupper($_POST["address"])),
					"latitude_luminary" => $_POST["latitude"],
					"longitude_luminary" => $_POST["longitude"],
					"cost_luminary" => $_POST["cost"],
					"life_luminary" => $_POST["life"],
					"gallery_luminary" => json_encode($galleryElement),
					"status_luminary" => "Activo",
					"date_created_luminary" => date("Y-m-d")
				);

				$url = "luminaries?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
				$method = "POST";
				$fields = $data;
				$response = CurlController::request($url, $method, $fields);

				/* Busco tecnologia */
				$url = "technologies?select=id_technology,name_technology&linkTo=id_technology&equalTo=".$_POST["technology"];
				$method = "GET";
				$fields = "";
				$response = CurlController::request($url, $method, $fields);
				$technologies = $response->results[0];
				//echo '<pre>'; print_r($technologies); echo '</pre>';
				/* Busco potencia */
				$url = "powers?select=id_power,name_power&linkTo=id_power&equalTo=".$_POST["power"];
				$response = CurlController::request($url, $method, $fields);
				$powers = $response->results[0];
				//echo '<pre>'; print_r($powers); echo '</pre>';exit;
				

				//echo '<pre>'; print_r($response); echo '</pre>';exit;
				/* Respuesta de la API */
				if ($response->status == 200) {
					$data2 = array(
						"id_delivery_viewinv" => $_POST["idDelivery"],
						"group_viewinv" => "LUMINARIAS",
						"code_viewinv" => $_POST["codeL"],
						"info_viewinv" => $technologies->name_technology . " " . $powers->name_power,
						"address_viewinv" => trim(strtoupper($_POST["address"])),
						"qty_viewinv" => 1,
						"cost_viewinv" => $_POST["cost"],
						"date_created_viewinv" => date("Y-m-d")
					);
					$url = "viewinvs?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
					$method = "POST";
					$fields = $data2;
					$response = CurlController::request($url, $method, $fields);

					$codigo = $_POST["idDelivery"];
					//echo '<pre>'; print_r($codigo); echo '</pre>';

					echo `<script>
					fncFormatInputs();
					matPreloader('off');
					fncSweetAlert("close", "", "");
					fncSweetAlert("success", "Registro grabado correctamente", "/deliveries/items/" . idDel );
				</script>`;
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

	/* Edición Luminarias */
	public function edit($id)
	{
		if (isset($_POST["idLuminary"])) {
			echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Loading...", "");
				</script>';

			if ($id == $_POST["idLuminary"]) {
				$select = "id_luminary";
				$url = "luminaries?select=" . $select . "&linkTo=id_luminary&equalTo=" . $id;
				$method = "GET";
				$fields = array();
				$response = CurlController::request($url, $method, $fields);

				if ($response->status == 200) {
					/* Validamos la sintaxis de los campos */
					if (
						preg_match('/[a-zA-Z0-9_]/', $_POST["code"])
					) {

						/* Guardar imágenes galería */
						$galleryElement = array();
						$count = 0;
						$count2 = 0;

						if (!empty($_POST['galleryElement'])) {
							foreach (json_decode($_POST['galleryElement'], true) as $key => $value) {
								$count++;

								$image["tmp_name"] = $value["file"];
								$image["type"] = $value["type"];
								$image["mode"] = "base64";

								$folder = "img/elements";
								$path =  "/" . strtolower($_POST["code"]);
								$width = $value["width"];
								$height = $value["height"];
								$name = strtolower($_POST["code"]) . "-" . mt_rand(1000000, 9999999);

								$saveImageGallery  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);
								array_push($galleryElement, $saveImageGallery);

								if (count($galleryElement) == $count) {
									if (!empty($_POST['galleryElementOld'])) {
										foreach (json_decode($_POST['galleryElementOld'], true) as $key => $value) {
											$count2++;
											array_push($galleryElement, $value);
										}
									}
								}
							}
						} else {
							if (!empty($_POST['galleryElementOld'])) {
								$count2 = 0;
								foreach (json_decode($_POST['galleryElementOld'], true) as $key => $value) {
									$count2++;
									array_push($galleryElement, $value);
								}
							}
						}

						/*  Eliminamos archivos basura del servidor */
						if (!empty($_POST['deleteGalleryElement'])) {
							foreach (json_decode($_POST['deleteGalleryElement'], true) as $key => $value) {
								unlink("views/img/luminaries/" . strtolower($_POST["code"])) . "/" . $value;
							}
						}

						/* Validamos que no venga la galería vacía */
						if (count($galleryElement) == 0) {
							echo '<script>
								fncFormatInputs();
								fncNotie(3, "The gallery cannot be empty");
								</script>';
							return;
						}

						$data = "id_delivery_luminary=" . $_POST["delivery"] .
							"&code_luminary=" . $_POST["code"] .
							"&id_technology_luminary=" . $_POST["technology"] .
							"&id_power_luminary=" . $_POST["power"] .
							"&id_pole_luminary=" . $_POST["pole"] .
							"&id_transformer_luminary=" . $_POST["transformer"] .
							"&id_roud_luminary=" . $_POST["roud"] .
							"&address_luminary=" . trim(strtoupper($_POST["address"])) .
							"&latitude_luminary=" . $_POST["latitude"] .
							"&longitude_luminary=" . $_POST["longitude"] .
							"&cost_luminary=" . $_POST["cost"] .
							"&life_luminary=" . $_POST["life"] .
							"&gallery_luminary=" . json_encode($galleryElement) .
							"&status_luminary=" . "Activo";

						/* Solicitud a la API */
						$url = "luminaries?id=" . $id . "&nameId=id_luminary&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";

						$method = "PUT";
						$fields = $data;
						$response = CurlController::request($url, $method, $fields);

						/* Respuesta de la API */
						if ($response->status == 200) {
							echo '<script>
									fncFormatInputs();
									matPreloader("off");
									fncSweetAlert("close", "", "");
									fncSweetAlert("success", "Registro actualizado correctamente", "/luminaries");
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
