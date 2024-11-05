<?php

class PolesController
{
	/* Creacion de Postes */
	public function create()
	{
		if (isset($_POST["code"])) {
			echo '<script>
				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");
			</script>';

			/* Validamos la sintaxis de los campos */
			if (
				preg_match('/[a-zA-Z0-9_]/', $_POST["code"])
			) {

				/* Guardar Imagenes de la galeria*/
				$galleryElement = array();
				foreach (json_decode($_POST['galleryElement'], true) as $key => $value) {
					$image["tmp_name"] = $value["file"];
					$image["type"] = $value["type"];
					$image["mode"] = "base64";
					$folder = "img/poles";
					$path =  "/" . strtolower($_POST["code"]);
					$width = $value["width"];
					$height = $value["height"];
					$name = strtolower($_POST["code"]) . "-" . mt_rand(10000000, 99999999);
					$saveImageGallery  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);
					array_push($galleryElement, $saveImageGallery);
				}

				/* Agrupamos la información */
				$data = array(
					"id_delivery_pole" => $_POST["delivery"],
					"code_pole" => $_POST["code"],
					"id_material_pole" => $_POST["material"],
					"id_height_pole" => $_POST["height"],
					"detail_pole" => $_POST["detail"],
					"address_pole" => trim(strtoupper($_POST["address"])),
					"latitude_pole" => $_POST["latitude"],
					"longitude_pole" => $_POST["longitude"],
					"life_pole" => $_POST["life"],
					"gallery_pole" => json_encode($galleryElement),
					"cost_pole" => $_POST["cost"],
					"status_pole" => 'Activo',
					"date_created_pole" => date("Y-m-d")
				);

				$url = "poles?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
				$method = "POST";
				$fields = $data;
				$response = CurlController::request($url, $method, $fields);
				//echo '<pre>'; print_r($fields); echo '</pre>';exit;

				/* Busco Materiales */
				$url = "materials?select=id_material,name_material&linkTo=id_material&equalTo=" . $_POST["material"];
				$method = "GET";
				$fields = "";
				$response = CurlController::request($url, $method, $fields);
				$materials = $response->results[0];

				/* Busco Alturas */
				$url = "heights?select=id_height,name_height&linkTo=id_height&equalTo=" . $_POST["height"];
				$response = CurlController::request($url, $method, $fields);
				$heights = $response->results[0];
				//echo '<pre>'; print_r($powers); echo '</pre>';exit;


				/* Respuesta de la API */
				if ($response->status == 200) {
					$data2 = array(
						"id_delivery_viewinv" => $_POST["idDelivery"],
						"group_viewinv" => "POSTES",
						"code_viewinv" => $_POST["code"],
						"info_viewinv" => $materials->name_material . " " . $heights->name_height,
						"address_viewinv" => trim(strtoupper($_POST["address"])),
						"qty_viewinv" => 1,
						"cost_viewinv" => $_POST["cost"],
						"date_created_viewinv" => date("Y-m-d")
					);
					$url = "viewinvs?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
					$method = "POST";
					$fields = $data2;
					$response = CurlController::request($url, $method, $fields);

					$codigo = base64_encode($_POST["idDelivery"]);

					echo '<script>
					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncSweetAlert("success", "Registro Creado correctamente", "/deliveries/items/' . $codigo . '");
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

	/* Edición Postes */
	public function edit($id)
	{
		//echo '<pre>'; print_r($_POST); echo '</pre>';exit;
		if (isset($_POST["idPole"])) {
			echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Loading...", "");
				</script>';

			if ($id == $_POST["idPole"]) {
				$select = "id_pole";
				$url = "poles?select=" . $select . "&linkTo=id_pole&equalTo=" . $id;
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

								$folder = "img/poles";
								$path =  "/" . strtolower($_POST["code"]);
								$width = $value["width"];
								$height = $value["height"];
								$name = strtolower($_POST["code"]) . "-" . mt_rand(10000000, 99999999);

								$saveImageGallery  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);
								array_push($galleryElement, $saveImageGallery);

								if (count($galleryElement) == $count) {
									if (!empty($_POST['galleryElementOld'])) {
										foreach (json_decode($_POST['galleryElementOld'], true) as $key => $value) {
											$count2++;
											array_push($galleryElement, $value);
										}
										if (count(json_decode($_POST['galleryElementOld'], true)) == $count2) {
										}
									} else {
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
								if (count(json_decode($_POST['galleryElementOld'], true)) == $count2) {
									$continueEdit = true;
								}
							}
						}

						/*  Eliminamos archivos basura del servidor */
						if (!empty($_POST['deleteGalleryElement'])) {
							foreach (json_decode($_POST['deleteGalleryElement'], true) as $key => $value) {
								unlink("views/img/poles/" . strtolower($_POST["code"]) . "/" . $value);
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

						$data = "id_delivery_pole=" . $_POST["delivery"] .
							"&code_pole=" . $_POST["code"] .
							"&id_material_pole=" . $_POST["material"] .
							"&id_height_pole=" . $_POST["height"] .
							"&detail_pole=" . $_POST["detail"] .
							"&address_pole=" . trim(strtoupper($_POST["address"])) .
							"&latitude_pole=" . $_POST["latitude"] .
							"&longitude_pole=" . $_POST["longitude"] .
							"&life_pole=" . $_POST["life"] .
							"&gallery_pole=" . json_encode($galleryElement) .
							"&cost_pole=" . $_POST["cost"] .
							"&date_updated_pole=" . date("Y-m-d");

						/* Solicitud a la API */
						$url = "poles?id=" . $id . "&nameId=id_pole&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";

						$method = "PUT";
						$fields = $data;
						$response = CurlController::request($url, $method, $fields);
						//echo '<pre>'; print_r($response); echo '</pre>';exit;
						/* Respuesta de la API */
						if ($response->status == 200) {
							echo '<script>
									fncFormatInputs();
									matPreloader("off");
									fncSweetAlert("close", "", "");
									fncSweetAlert("success", "Registro actualizado correctamente", "/poles");
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
