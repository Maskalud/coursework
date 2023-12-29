<?php

    $name = $_POST['first_name'];
    $userEmail = $_POST['email'];
    $message = $_POST['text'];

    $emailadmin="kirillatmazhar@gmail.com";
    $tema="Форма обратной связи";
    $message="Имя пользователя: ".$name."\n";
    $message .="Email: ".$userEmail."\n";
    $message .="Сообщение: ".$userEmail."\n";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    mail($emailadmin, $tema, $message, $headers);

    echo "Письмо успешно отправлено!";


?>