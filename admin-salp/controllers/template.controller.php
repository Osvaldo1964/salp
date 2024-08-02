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

}
