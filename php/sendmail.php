<?php
	include ("../Desktop/connect_server/connect_server.php");
	require_once "../vendor/autoload.php";

	$id_art 		= $_POST['sus_idArt'];
	$fullname 		= $_POST['sus_fullname'];
	$email 			= $_POST['sus_email'];
	$phone 			= $_POST['sus_numberphone'];
	$message 		= $_POST['sus_message'];
	$title_art 		= $_POST['sus_article'];

	//PHPMailer Object
	$mail = new PHPMailer;

	//From email address and name
	$mail->From = $email;
	$mail->FromName = $fullname;

	//To address and name
	$mail->addAddress("jersonmartinezsm@gmail.com", "Jerson Martínez");
	// $mail->addAddress("jersonmartinezsm@gmail.com"); //Recipient name is optional

	//Address to which recipient will reply, aquí debería ir el del cliente suscrito.
	$mail->addReplyTo("sidemasterdelfuturo@gmail.com", "Responder");

	//CC and BCC optional.
	// $mail->addCC("cc@example.com");
	// $mail->addBCC("bcc@example.com");

	//Send HTML or Plain Text email
	$mail->isHTML(true);

	$mail->Subject = $title_art;
	$mail->Body = $message;
	$mail->AltBody = "Mi número de teléfono es: ".$phone;

	$Q = "INSERT INTO sus_message (id, fullname, email, phone, message, id_art, title_art) VALUES ('','".$fullname."','".$email."','".$phone."','".$message."','".$id_art."','".$title_art."');";
	
	if(!$mail->send()){
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		if ($Conexion->query($Q)){
	    	echo "OK";
		} else {
			echo "Fail";
		}
	}

?>