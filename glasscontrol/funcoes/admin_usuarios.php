<?php
/**
 * Created by PhpStorm.
 * User: Bruno Berlanda
 * Date: 24/09/2020
 * Time: 15:41
 */

require_once ("_conexao.php");

require_once ("_login_confirmacao.php");

require_once ("../includes/usuario_logado.php");

require_once ("_funcoes_geral.php");

/**
 * CADASTRAR
 */
if ($_GET['funcao'] === "cadastrar" && $tipoUsuario === "A" && isset($_SESSION['loginSysLG'])) {

    // Dados do formulário
    $nome = textoMaiusc(strip_tags(trim($_POST['nome'])));
    $usuario = strtolower(strip_tags(trim($_POST['usuario'])));
    $email = strtolower(strip_tags(trim($_POST['email'])));
    $tipo = strip_tags(trim($_POST['tipo']));
    $senha = strip_tags(trim($_POST['senha']));

    $senha_sha = sha1($senha);

    /* *** */

    $consulta = mysqli_query ($conn, "SELECT id FROM gc_usuarios WHERE usuario='$usuario'")or die (mysqli_error($conn));

    if (mysqli_num_rows($consulta) > 0) {
        header ('Location: ../cadastro-usuarios.php?msgErro=Usuário já cadastrado.');
    }
    else {
        $codigo = sha1(time());

        $sql = "INSERT INTO gc_usuarios (codigo, nome, usuario, senha, email, tipo) VALUES ('$codigo', '$nome', '$usuario', '$senha_sha', '$email', '$tipo')";

        $cad = mysqli_query ($conn, $sql) or die (mysqli_error($conn));

        /* *** */

        // Marca como LIDO todas as solicitações já abertas até o momento do cadastro
        $seleciona_solicitacoes = mysqli_query ($conn, "SELECT id FROM gc_solicitacoes") or die (mysqli_error($conn));
        while ($d_solicitacoes = mysqli_fetch_array($seleciona_solicitacoes)) {

            $solic_id = $d_solicitacoes['id'];

            $user_id = idUsuarioCod($codigo);

            $ler = mysqli_query ($conn, "INSERT INTO gc_lidas (usuario, id_solicitacao) VALUES ('$user_id', '$solic_id')") or die (mysqli_error($conn));

        }

        /* *** */

        /* ********************************************************************************************
        ENVIANDO E-MAIL
        ******************************************************************************************** */
        // Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
        require_once ("../../phpmailer/PHPMailerAutoload.php");

        // Inicia a classe PHPMailer
        $mail = new PHPMailer();

        // Configuração do E-mail
        require_once ("config_email.php");

        // Define os destinatário(s)
        $mail->AddAddress($email);
        //$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
        $con_emails_admin = mysqli_query ($conn, "SELECT nome, email FROM gc_usuarios WHERE tipo='A'") or die (mysqli_error($conn));
        while ($d_emails_admin = mysqli_fetch_array ($con_emails_admin)) {
            $mail->AddBCC($d_emails_admin['email'], $d_emails_admin['nome']); // Cópia Oculta
        }
        //$mail->AddBCC('bruno.berlanda@lindevidros.com.br'); // Cópia Oculta

        // Define os dados técnicos da Mensagem
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
        $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

        // Define a mensagem (Texto e Assunto)
        $mail->Subject  = "Login para acesso ao sistema"; // Assunto da mensagem
        $mail->Body = "
		<html>
		<head>
		</head>
		<body>
		
		<table border='0' width='600' cellspacing='1'>
			<tr>
				<td colspan='2' align='center'><img src='http://www.lindevidros.com.br/email/logo.png'></td>
			</tr>
		  
			<tr>
				<td colspan='2'><img src='http://www.lindevidros.com.br/email/glasscontrol/img01.png'></td>
			</tr>
			
			<tr>
				<td colspan='2'><img src='http://www.lindevidros.com.br/email/glasscontrol/img02.png'></td>
			</tr>
					
			<tr>
				<td width='200'><img src='http://www.lindevidros.com.br/email/glasscontrol/img03.png'></td>
				<td width='400' style='padding-left: 10px; text-align: left;'><font face='Verdana' size='2' color='#555555'><b>$senha</b></font></td>
			</tr>
			
			<tr>
				<td colspan='2' align='center' style='padding: 15px 0;'><a href='http://www.lindevidros.com.br/glasscontrol'><img src='http://www.lindevidros.com.br/email/glasscontrol/img04.png'></a></td>
			</tr>
		</table>
		
		</body>
		</html>
		";
        $mail->AltBody = "";

        // Define os anexos (opcional)
        //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

        // Envia o e-mail
        $enviado = $mail->Send();

        // Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();

        /* *** */

        header ('Location: ../cadastro-usuarios.php?msgSucesso=Usuário cadastrado com sucesso.');
    }

}

/**
 * EDITAR
 */
if ($_GET['funcao'] === "editar" && $tipoUsuario === "A" && isset($_SESSION['loginSysLG'])) {

    $id = $_GET['i'];

    // Dados do formulário
    $nome = textoMaiusc(strip_tags(trim($_POST['nome'])));
    $email = strtolower(strip_tags(trim($_POST['email'])));
    $tipo = strip_tags(trim($_POST['tipo']));

    $senha = strip_tags(trim($_POST['senha']));


    /* *** */

    if ($senha == "") {

        $sql = "UPDATE gc_usuarios SET nome='$nome', email='$email', tipo='$tipo' WHERE id='$id'";

    }
    else {

        $senha_nova = sha1($senha);

        $sql = "UPDATE gc_usuarios SET nome='$nome', senha='$senha_nova', email='$email', tipo='$tipo', senha_padrao='S' WHERE id='$id'";

    }

    $atu = mysqli_query ($conn, $sql) or die (mysqli_error($conn));

    header ('Location: ../cadastro-usuarios.php?msgSucesso=Usuário alterado com sucesso.');

}

/**
 * EXCLUIR
 */
if ($_GET['funcao'] === "excluir" && $tipoUsuario === "A" && isset($_SESSION['loginSysLG'])) {

    $id = $_GET['i'];

    $sql = "UPDATE gc_usuarios SET ativo='N' WHERE id='$id'";

    $cad = mysqli_query ($conn, $sql) or die (mysqli_error($conn));

    header ('Location: ../cadastro-usuarios.php?msgSucesso=Usuário excluído com sucesso.');

}