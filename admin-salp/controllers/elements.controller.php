<?php

class ElementsController
{
	/* Creacion de Elementos */
	public function create()
	{
		//echo '<pre>'; print_r($_POST); echo '</pre>';
		if (isset($_POST["name"])) {
			echo '<script>
				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");
			</script>';

			/* Validamos la sintaxis de los campos */
			if (
				preg_match('/[a-zA-Z0-9_]/', $_POST["classname"])

			) {

				$tecno = empty($_POST["tecno"]) ? null : $_POST["tecno"];
				$power = empty($_POST["power"]) ? null : $_POST["power"];
				$material = empty($_POST["material"]) ? null : $_POST["material"];
				$height = empty($_POST["height"]) ? null : $_POST["height"];

				/* Guardar Imagenes de la galeria*/
				$galleryElement = array();
				$count = 0;
				foreach (json_decode($_POST['galleryElement'], true) as $key => $value) {
					$count++;

					$image["tmp_name"] = $value["file"];
					$image["type"] = $value["type"];
					$image["mode"] = "base64";
					$folder = "img/elements";
					$path =  "/" . $_POST["code"];
					$width = $value["width"];
					$height = $value["height"];
					$name = mt_rand(10000, 99999);
					$saveImageGallery  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);
					array_push($galleryElement, $saveImageGallery);
				}

				/* Agrupamos la información */
				$data = array(
					"id_class_element" => $_POST["classname"],
					"code_element" => $_POST["code"],
					"name_element" => trim(strtoupper($_POST["name"])),
					"life_element" => $_POST["life"],
					"address_element" => trim(strtoupper($_POST["address"])),
					"id_minute_element" => $_POST["idActa"],
					"id_resource_element" => $_POST["resource"],
					"id_roud_element" => $_POST["roud"],
					"id_technology_element" => $tecno,
					"id_power_element" => $power,
					"id_material_element" => $material,
					"id_height_element" => $height,
					"altitud_element" => 0,
					"latitude_element" => $_POST["latitude"],
					"longitude_element" => $_POST["longitude"],
					"id_dispose_element" => null,
					"qty_element" => $_POST["qty"],
					"value_element" => $_POST["price"],
					"gallery_element" => json_encode($galleryElement),
					"status_element" => "Activo",
					"date_created_element" => date("Y-m-d")
				);

				$url = "elements?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
				$method = "POST";
				$fields = $data;
				$response = CurlController::request($url, $method, $fields);
				//echo '<pre>'; print_r($response); echo '</pre>';exit;
				/* Respuesta de la API */
				if ($response->status == 200) {
					echo '<script>
					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncSweetAlert("success", "Registro grabado correctamente", "/deliveries");
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

	/* Edición Elementos */
	public function edit($id)
	{
		if (isset($_POST["idElement"])) {
			echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Loading...", "");
				</script>';

			if ($id == $_POST["idElement"]) {
				$select = "id_element";
				$url = "elements?select=" . $select . "&linkTo=id_element&equalTo=" . $id;
				$method = "GET";
				$fields = array();
				$response = CurlController::request($url, $method, $fields);

				if ($response->status == 200) {
					/* Validamos la sintaxis de los campos */
					if (
						preg_match('/[a-zA-Z0-9_]/', $_POST["classname"])
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

								$folder = "img/elements";
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
								unlink("views/img/elements/" . $_POST["code"]);
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

						$tecno = empty($_POST["tecno"]) ? null : $_POST["tecno"];
						$power = empty($_POST["power"]) ? null : $_POST["power"];
						$material = empty($_POST["material"]) ? null : $_POST["material"];
						$height = empty($_POST["height"]) ? null : $_POST["height"];

						$data = "id_class_element=" . $_POST["classname"] .
							"&code_element=" . $_POST["code"] .
							"&name_element=" . trim(strtoupper($_POST["name"])) .
							"&life_element=" . $_POST["life"] .
							"&address_element=" . trim(strtoupper($_POST["address"])) .
							"&id_resource_element=" . $_POST["resource"] .
							"&id_roud_element=" . $_POST["roud"] .
							"&id_technology_element=" . $tecno .
							"&id_power_element=" . $power .
							"&id_material_element=" . $material .
							"&id_height_element=" . $height .
							"&altitud_element=" . 0 .
							"&latitude_element=" . $_POST["latitude"] .
							"&longitude_element=" . $_POST["longitude"] .
							"&id_dispose_element=" . null .
							"&qty_element=" . $_POST["qty"] .
							"&value_element=" . $_POST["price"] .
							"&gallery_element=" . json_encode($galleryElement) .
							"&status_element=" . "Activo";

						/* Solicitud a la API */
						$url = "elements?id=" . $id . "&nameId=id_element&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";

						$method = "PUT";
						$fields = $data;
						$response = CurlController::request($url, $method, $fields);

						/* Respuesta de la API */
						if ($response->status == 200) {
							echo '<script>
									fncFormatInputs();
									matPreloader("off");
									fncSweetAlert("close", "", "");
									fncSweetAlert("success", "Registro actualizado correctamente", "/elements");
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
