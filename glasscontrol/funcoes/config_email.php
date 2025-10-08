<?php
/**
 * Created by PhpStorm.
 * User: ti01
 * Date: 29/09/2020
 * Time: 17:18
 */

// Autenticação
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->Host = "gw.lindevidros.com.br"; // Seu endereço de host SMTP
$mail->SMTPAuth = true; // Define que será utilizada a autenticação -  Mantenha o valor "true"
$mail->Port = 587; // Porta de comunicação SMTP - Mantenha o valor "587"
$mail->SMTPSecure = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
$mail->SMTPAutoTLS = false; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
$mail->Username = 'linde@lindevidros.com.br'; // Conta de email existente e ativa em seu domínio
$mail->Password = 'ostec@linde'; // Senha da sua conta de email

// Dados do Remetente
$mail->Sender = "linde@lindevidros.com.br"; // Conta de email existente e ativa em seu domínio
$mail->From = "linde@lindevidros.com.br"; // Sua conta de email que será remetente da mensagem
$mail->FromName = "Sistema Linde/GlassControl"; // Nome da conta de email