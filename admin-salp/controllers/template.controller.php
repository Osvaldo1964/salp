<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class TemplateController
{

    /* Ruta base del sistema */
    static public function path()
    {
        return "http://admin-salp.com/";
    }

    /* Traemos la vista principal */
    public function index()
    {
        include "views/template.php";
    }

    /* Ruta para las imagenes del sistema */
    static public function srcImg()
    {
        return "http://admin-salp.com/";
    }

    /* Devolver una imagen */
    static public function returnImg($id, $picture, $method)
    {
        if ($method == "direct") {
            if ($picture != null) {
                return TemplateController::srcImg() . "views/img/users/" . $id . "/" . $picture;
            } else {
                return TemplateController::srcImg() . "views/img/users/default/default.png";
            }
        } else {
            return $picture;
        }
    }

    /* Función para mayúscula inicial */

	static public function capitalize($value){
		$value = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
		return $value;
	}

	/* Función Limpiar HTML */	

	static public function htmlClean($code){
		$search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');
		$replace = array('>','<','\\1');
		$code = preg_replace($search, $replace, $code);
		$code = str_replace("> <", "><", $code);
		return $code;	
	}

    /* Devolver una imagen */
    static public function returnPdf($id, $picture, $method)
    {
        if ($method == "direct") {
            if ($picture != null) {
                return TemplateController::srcImg() . "views/img/users/" . $id . "/" . $picture;
            } else {
                return TemplateController::srcImg() . "views/img/users/default/default.png";
            }
        } else {
            return $picture;
        }
    }

    
	/* Función para enviar correos electrónicos */

	static public function sendEmail($name, $subject, $email, $message, $url){

		date_default_timezone_set("America/Bogota");
		$mail = new PHPMailer;
		$mail->CharSet = "UTF-8";
		$mail->isMail();
		$mail->setFrom("support@marketplace.com", "Marketplace Support");
		$mail->Subject = "Cordial saludo, ". "<br>" . $name." - ".$subject;
		$mail->addAddress($email);
		$mail->msgHTML(' 

			<div>
				Hi, '.$name.':
				<p>'.$message.'</p>
				<a href="'.$url.'">Click this link for more information</a>
				If you didn’t ask to verify this address, you can ignore this email.
				Gracias,
				El equipo de Jurisdiccion Coactiva
			</div>

		');

		$send = $mail->Send();

		if(!$send){
			return $mail->ErrorInfo;	
		}else{
			return "ok";
		}
	}

    /* Función para almacenar imágenes */

	static public function saveImage($image, $folder, $path, $width, $height, $name){

		if(isset($image["tmp_name"]) && !empty($image["tmp_name"])){ 

			/* Configuramos la ruta del directorio donde se guardará la imagen */

			$directory = strtolower("views/".$folder."/".$path);

			/* Preguntamos primero si no existe el directorio, para crearlo */

			if(!file_exists($directory)){
				mkdir($directory, 0755);
			}

			/* Eliminar todos los archivos que existan en ese directorio */

			if($folder != "img/products" && $folder != "img/stores"){
				$files = glob($directory."/*");
				foreach ($files as $file) {
					unlink($file);
				}
			}
			
			/* Capturar ancho y alto original de la imagen */
			list($lastWidth, $lastHeight) = getimagesize($image["tmp_name"]);

			/* De acuerdo al tipo de imagen aplicamos las funciones por defecto */

			if($image["type"] == "image/jpeg"){

				//definimos nombre del archivo
				$newName  = $name.'.jpg';

				//definimos el destino donde queremos guardar el archivo
				$folderPath = $directory.'/'.$newName;

				if(isset($image["mode"]) && $image["mode"] == "base64"){
					file_put_contents($folderPath, file_get_contents($image["tmp_name"]));
				}else{
					//Crear una copia de la imagen
					$start = imagecreatefromjpeg($image["tmp_name"]);

					//Instrucciones para aplicar a la imagen definitiva
					$end = imagecreatetruecolor($width, $height);
					imagecopyresized($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);
					imagejpeg($end, $folderPath);
				}
			}

			if($image["type"] == "image/png"){
				//definimos nombre del archivo
				$newName  = $name.'.png';

				//definimos el destino donde queremos guardar el archivo
				$folderPath = $directory.'/'.$newName;

				if(isset($image["mode"]) && $image["mode"] == "base64"){
					file_put_contents($folderPath, file_get_contents($image["tmp_name"]));
				}else{

					//Crear una copia de la imagen
					$start = imagecreatefrompng($image["tmp_name"]);

					//Instrucciones para aplicar a la imagen definitiva
					$end = imagecreatetruecolor($width, $height);

					imagealphablending($end, FALSE);			
					imagesavealpha($end, TRUE);	
					imagecopyresampled($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);
					imagepng($end, $folderPath);
				}
			}
			return $newName;
		}else{
			return "error";
		}
	}
}
