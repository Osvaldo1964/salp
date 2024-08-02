<?php

class SubjectsController
{

	/* Creacion de Sujetos */
	public function create()
	{
		//echo '<pre>'; print_r($_POST); echo '</pre>';exit;

		if (isset($_POST["fullname-subject"])) {
			echo '<script>
				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");
			</script>';

			/* Validamos la sintaxis de los campos */
			if (
				preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["fullname-subject"]) &&
				preg_match('/^[A-Za-z0-9]{1,}$/', $_POST["numdoc-subject"]) &&
				preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email-subject"]) &&
				preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["city-subject"]) &&
				preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["address-subject"]) &&
				preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["phone-subject"])
			) {

				/* Agrupamos la información */
				$data = array(
					"typedoc_subject" => trim($_POST["typedoc-subject"]),
					"numdoc_subject" => trim($_POST["numdoc-subject"]),
					"fullname_subject" => trim(TemplateController::capitalize($_POST["fullname-subject"])),
					"country_subject" => trim(explode("_", $_POST["country-subject"])[0]),
					"city_subject" => trim(TemplateController::capitalize($_POST["city-subject"])),
					"address_subject" => trim(TemplateController::capitalize($_POST["address-subject"])),
					"email_subject" => trim(strtolower($_POST["email-subject"])),
					"phone_subject" =>  trim(explode("_", $_POST["country-subject"])[1] . "_" . $_POST["phone-subject"]),
					"date_created_subject" => date("Y-m-d")
				);

				$url = "subjects?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
				$method = "POST";
				$fields = $data;
				$response = CurlController::request($url, $method, $fields);

				/* Respuesta de la API */
				if ($response->status == 200) {
					echo '<script>
					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncSweetAlert("success", "Registro grabado correctamente", "/subjects");
				</script>';
				}
			} else {
				echo '<script>
					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncNotie(3, "Field syntax error");
				</script>';
			}
		}
	}

	/* Edición Sujetos */
	public function edit($id)
	{
		if (isset($_POST["idSubject"])) {
			echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Loading...", "");
				</script>';

			if ($id == $_POST["idSubject"]) {
				$select = "id_subject";
				$url = "subjects?select=" . $select . "&linkTo=id_subject&equalTo=" . $id;
				$method = "GET";
				$fields = array();
				$response = CurlController::request($url, $method, $fields);

				if ($response->status == 200) {
					/* Validamos la sintaxis de los campos */
					if (
						preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["numdoc"]) &&
						preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["fullname"]) &&
						preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["city"]) &&
						preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["address"]) &&
						preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"]) &&
						preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["phone"])
					) {

						/* Agrupamos la información */
						$data = "typedoc_subject=" . $_POST["typedoc"] . "&numdoc_subject=" . $_POST["numdoc"] .
							"&fullname_subject=" . trim(TemplateController::capitalize($_POST["fullname"])) .
							"&country_subject=" . trim(explode("_", $_POST["country"])[0]) . "&city_subject=" . trim(TemplateController::capitalize($_POST["city"])) .
							"&address_subject=" . trim(TemplateController::capitalize($_POST["address"])) . "&email_subject=" . trim(strtolower($_POST["email"])) .
							"&phone_subject=" . trim(explode("_", $_POST["country"])[1] . "_" . $_POST["phone"]);

						/* Solicitud a la API */
						$url = "subjects?id=" . $id . "&nameId=id_subject&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";

						$method = "PUT";
						$fields = $data;
						$response = CurlController::request($url, $method, $fields);

						/* Respuesta de la API */
						if ($response->status == 200) {
							echo '<script>
									fncFormatInputs();
									matPreloader("off");
									fncSweetAlert("close", "", "");
									fncSweetAlert("success", "Registro actualizado correctamente", "/subjects");
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

	/* Edición Sujetos */
	public function upload($id)
	{

		if (isset($_POST["idSubject"])) {
			// Cómo subir el archivo
			$upfilecc  = $_FILES["identificacion"];
			$upfilecb  = $_FILES["cert_banco"];

			/* Configuramos la ruta del directorio donde se guardarán los documentos */
			$directory = "views/img/subjects/" . $id;

			/* Preguntamos primero si no existe el directorio, para crearlo */
			if (!file_exists($directory)) {
				mkdir($directory, 0755);
			}

			move_uploaded_file($upfilecc["tmp_name"], $directory . '/cc_' . $id . '.pdf');
			move_uploaded_file($upfilecb["tmp_name"], $directory . '/cb_' . $id . '.pdf');
			// Redirigiendo hacia atrás
			echo '<script>
					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncSweetAlert("success", "Archivos Almacenados", "/subjects");
				</script>';
		}
	}
}
