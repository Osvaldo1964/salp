<?php

class TransformersController
{
	/* Creacion de Transformadores */
	public function create()
	{
		//echo '<pre>'; print_r($_POST); echo '</pre>';
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
				$count = 0;
				foreach (json_decode($_POST['galleryElement'], true) as $key => $value) {
					$count++;

					$image["tmp_name"] = $value["file"];
					$image["type"] = $value["type"];
					$image["mode"] = "base64";
					$folder = "img/transformers";
					$path =  "/" . $_POST["code"];
					$width = $value["width"];
					$height = $value["height"];
					$name = mt_rand(10000, 99999);
					$saveImageGallery  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);
					array_push($galleryElement, $saveImageGallery);
				}

				/* Agrupamos la información */
				$data = array(
					"id_delivery_transformer" => $_POST["delivery"],
					"code_transformer" => $_POST["code"],
					"power_transformer" => $_POST["power"],
					"address_transformer" => trim(strtoupper($_POST["address"])),
					"latitude_transformer" => $_POST["latitude"],
					"longitude_transformer" => $_POST["longitude"],
					"type_transformer" => $_POST["type"],
					"class_transformer" => $_POST["class"],
					"cost_transformer" => $_POST["cost"],
					"life_transformer" => $_POST["life"],
					"status_transformer" => 'Activo',
					"gallery_transformer" => json_encode($galleryElement),
					"date_created_transformer" => date("Y-m-d")
				);

				$url = "transformers?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
				$method = "POST";
				$fields = $data;
				$response = CurlController::request($url, $method, $fields);
				//echo '<pre>'; print_r($fields); echo '</pre>';exit;
				/* Respuesta de la API */
				if ($response->status == 200) {
					echo '<script>
					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncSweetAlert("success", "Registro grabado correctamente", "/transformers");
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

	/* Edición Transformadores */
	public function edit($id)
	{
		//echo '<pre>'; print_r($_POST); echo '</pre>';exit;
		if (isset($_POST["idTransformer"])) {
			echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Loading...", "");
				</script>';

			if ($id == $_POST["idTransformer"]) {
				$select = "id_transformer";
				$url = "transformers?select=" . $select . "&linkTo=id_transformer&equalTo=" . $id;
				$method = "GET";
				$fields = array();
				$response = CurlController::request($url, $method, $fields);
				//echo '<pre>'; print_r($response); echo '</pre>';exit;
				if ($response->status == 200) {
					/* Validamos la sintaxis de los campos */
					if (
						preg_match('/[a-zA-Z0-9_]/', $_POST["code"])
					) {

						/* Guardar imágenes galería */
						$galleryElement = array();
						$count = 0;
						$count2 = 0;
						$continueEdit = false;

						if (!empty($_POST['galleryElement'])) {
							foreach (json_decode($_POST['galleryElement'], true) as $key => $value) {
								$count++;

								$image["tmp_name"] = $value["file"];
								$image["type"] = $value["type"];
								$image["mode"] = "base64";

								$folder = "img/transformers";
								$path =  "/" . $_POST["code"];
								$width = $value["width"];
								$height = $value["height"];
								$name = mt_rand(10000, 99999);

								$saveImageGallery  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);
								array_push($galleryElement, $saveImageGallery);

								if (count($galleryElement) == $count) {
									if (!empty($_POST['galleryElementOld'])) {
										foreach (json_decode($_POST['galleryElementOld'], true) as $key => $value) {
											$count2++;
											array_push($galleryElement, $value);
										}
										if (count(json_decode($_POST['galleryElementOld'], true)) == $count2) {
											$continueEdit = true;
										}
									} else {
										$continueEdit = true;
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
								unlink("views/img/transformers/" . $_POST["code"] . "/" . $value);
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

						$data = "id_delivery_transformer=" . $_POST["delivery"] .
							"&code_transformer=" . $_POST["code"] .
							"&power_transformer=" . $_POST["power"] .
							"&address_transformer=" . trim(strtoupper($_POST["address"])) .
							"&latitude_transformer=" . $_POST["latitude"] .
							"&longitude_transformer=" . $_POST["longitude"] .
							"&type_transformer=" . $_POST["type"] .
							"&class_transformer=" . $_POST["class"] .
							"&cost_transformer=" . $_POST["cost"] .
							"&life_transformer=" . $_POST["life"] .
							"&gallery_transformer=" . json_encode($galleryElement) .
							"&date_updated_transformer=" . date("Y-m-d");


						/* Solicitud a la API */
						$url = "transformers?id=" . $id . "&nameId=id_transformer&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";

						$method = "PUT";
						$fields = $data;
						$response = CurlController::request($url, $method, $fields);

						/* Respuesta de la API */
						if ($response->status == 200) {
							echo '<script>
									fncFormatInputs();
									matPreloader("off");
									fncSweetAlert("close", "", "");
									fncSweetAlert("success", "Registro actualizado correctamente", "/transformers");
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

	function uploadImage(array $data, string $name)
	{
		$url_temp   =   $data['tmp_name'];
		$destino    =   'Assets/images/uploads/' . $name;
		$move       =   move_uploaded_file($url_temp, $destino);
		return $move;
	}

	//Eliminar un archivo
	function deleteFile(string $nombre)
	{
		unlink('Assets/images/uploads/' . $nombre);
	}
}
