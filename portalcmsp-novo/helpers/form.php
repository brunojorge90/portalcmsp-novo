<?php
require('./wp-includes/class-phpmailer.php');

function is_post() {
	return $_SERVER['REQUEST_METHOD'] === "POST";
}


function flash_message($type, $message){
	global $response;

	if($type == "success")
	{
		$response = "<div class='success'><h2 style='text-align:center;'>{$message}</h2></div><style>.contact-form {display:none;}</style>";
		echo $response;
		return;
	}
	$response = "<div class='error'>{$message}</div>";
	echo $response;
}

/*
function cmsp_send_mail($to, $subject, $body, $from, $contact_name) {
	$headers = "From: ".$contact_name." <".$from.">\r\n".
		"MIME-Version: 1.0" . "\r\n" .
		"Content-type: text/html; charset=UTF-8" . "\r\n";
	wp_mail($to, $subject, $body, $headers);
}

function cmsp_send_mail($to, $subject, $body, $from, $contact_name) {
	$headers = "From: ".$contact_name." <".$from.">\r\n".
		"MIME-Version: 1.0" . "\r\n" .
		"Content-type: text/html; charset=UTF-8" . "\r\n";
	$mail = new PHPMailer(true);
	$mail->IsHTML(true);
	$mail->CharSet = "UTF-8";
	$mail->AddAddress($to, '');
	$mail->AddReplyTo($from, '');
	$mail->Subject = $subject;
	$mail->MsgHTML($body);
	$mail->Send();
}
*/

function cmsp_send_mail($to, $subject, $body, $from, $contact_name) {
	$mail = new PHPMailer(true);

	// SMTP server params
	$mail->Mailer = 'smtp';
	$mail->SMTPSecure = 'tls'; // Choose SSL or TLS, if necessary for your server
	$mail->SMTPAuth = true; // Force it to use Username and Password to authenticate
	$mail->Host = 'smtp.office365.com';
	$mail->Port = 587;
	$mail->Username = 'smtp.website@saopaulo.sp.leg.br';
	$mail->Password = 'smTp4camAra0529';
	$mail->From = 'smtp.website@saopaulo.sp.leg.br';
	$mail->FromName = 'CMSP';

	// message params
	$mail->IsHTML(true);
	$mail->CharSet = "UTF-8";
	$mail->AddAddress($to, '');
	$mail->AddReplyTo($from, '');
	$mail->Subject = $subject;
	$mail->MsgHTML($body);
	$mail->Send();
}
