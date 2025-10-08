<?php

$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->Port = '587'; // Porta de envio
$mail->Host = 'gw.lindevidros.com.br'; // Endereço do servidor SMTP
$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
$mail->Username = 'linde@lindevidros.com.br'; // Usuário do servidor SMTP
$mail->Password = 'ostec@linde'; // Senha do servidor SMTP