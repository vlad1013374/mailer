<?php

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';




$name = $_POST['name'];
$email = $_POST['email'];
$text = $_POST['text'];


if(trim($name) != ''){
    $title = "Писмо от " . $name;
}

$body = $text;



$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки почты
    $mail->Host       = 'smtp.yandex.ru'; 
    $mail->Username   = 'info@dada.hhos.ru'; 
    $mail->Password   = 'mndjrjbpqfzeganm'; 
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('info@dada.hhos.ru', 'ДаДа'); 

    // Получатель письма
    $mail->addAddress($email); 
    

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверка отправления
if ($mail->send()){
    $result = "success";

    
} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}



echo json_encode(["result" => $result, "status" => $status]);


