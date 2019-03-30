<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Action {

	public static function enviarConfirmacaoDeCadastro($destinatario, $hash) {
		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    $mail->SMTPDebug = false; // desabilita a impressão do log de comunicação com o server
		    $mail->isSMTP();
		    $mail->SMTPOptions = array(
		    	'ssl' => array(
		    		'verify_peer' => false,
		    		'verify_peer_name' => false,
		    		'allow_self_signed' => true
		    	)
		    );
		    $mail->Host = 'smtp.gmail.com';
		    $mail->SMTPAuth = true;
		    $mail->Username = 'python.email.smtp.modules@gmail.com';
		    $mail->Password = 'testingPythonModules!';
		    $mail->SMTPSecure = 'tls';
		    $mail->Port = 587;

		    //Recipients
		    $mail->setFrom('python.email.smtp.modules@gmail.com', 'WebMail PHP');
		    $mail->addAddress($destinatario);

		    //Content
		    $mail->isHTML(true);
		    $mail->Subject = 'Confirmação de email';
		    $hashEncodedMail = md5($destinatario);
		    $mail->Body    = "
		    <h1>Email dinamicamente enviado!</h1>
		    <a href='http://localhost:8080/validar_email?confirmation=$hash&user=$hashEncodedMail'>Isto é um linnyker de ativação</a>

		    ";
		    $mail->AltBody = 'Use um cliente com HTML habilitado para ver o conteúdo desta mensagem.';

		    $mail->send();
		} catch (Exception $e) {
			echo '<pre>';
			print_r($e);
			echo '</pre>';
		}
	}


	public static function enviarRedefinicaoDeSenha($destinatario, $hash) {
		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    $mail->SMTPDebug = false; // desabilita a impressão do log de comunicação com o server
		    $mail->isSMTP();
		    $mail->SMTPOptions = array(
		    	'ssl' => array(
		    		'verify_peer' => false,
		    		'verify_peer_name' => false,
		    		'allow_self_signed' => true
		    	)
		    );
		    $mail->Host = 'smtp.gmail.com';
		    $mail->SMTPAuth = true;
		    $mail->Username = 'python.email.smtp.modules@gmail.com';
		    $mail->Password = 'testingPythonModules!';
		    $mail->SMTPSecure = 'tls';
		    $mail->Port = 587;

		    //Recipients
		    $mail->setFrom('python.email.smtp.modules@gmail.com', 'WebMail PHP');
		    $mail->addAddress($destinatario);

		    //Content
		    $mail->isHTML(true);
		    $mail->Subject = 'Confirmação de email';
		    $hashEncodedMail = md5($destinatario);
		    $mail->Body    = "
		    <h1>Email dinamicamente enviado!</h1>
		    <a href='http://localhost:8080/validar_email?confirmation=$hash&user=$hashEncodedMail'>Isto é um linnyker de ativação</a>

		    ";
		    $mail->AltBody = 'Use um cliente com HTML habilitado para ver o conteúdo desta mensagem.';

		    $mail->send();
		} catch (Exception $e) {
			echo '<pre>';
			print_r($e);
			echo '</pre>';
		}
	}

}


?>