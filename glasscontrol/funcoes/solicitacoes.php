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

$enviar_email = true;

/**
 * CADASTRAR
 */
if ($_GET['funcao'] === "novo" && $permSolicitacao == true && isset($_SESSION['loginSysLG'])) {

    // Dados do formulário
    $setor = strtolower(strip_tags(trim($_POST['setor'])));
    $assunto = textoMaiusc(strip_tags(trim($_POST['assunto'])));
    $descricao = textoMaiusc(strip_tags(trim($_POST['descricao'])));
    $prioridade = strip_tags(trim($_POST['prioridade']));
    $ticket = strip_tags(trim($_POST['ticket']));

    /* *** */

    $codigo = sha1(time());

    $sql = "INSERT INTO gc_solicitacoes (codigo, usuario, setor, assunto, descricao, prioridade, ticket) VALUES ('$codigo', '$idUsuario', '$setor', '$assunto', '$descricao', '$prioridade', '$ticket')";

    $cad = mysqli_query ($conn, $sql) or die (mysqli_error($conn));

    /* *** */

    /**
     * ENVIAR OS ARQUIVOS
     */

    // Captura o ID do chamado aberto
    $con_id = mysqli_query ($conn, "SELECT id FROM gc_solicitacoes WHERE codigo='$codigo'") or die (mysqli_error($conn));
    $d_id = mysqli_fetch_array($con_id);

    $solicitacao_id = $d_id['id'];

    // Pasta de destino dos arquivos
    $pasta = "../arquivos/";

    // Arquivos permitidos
    $permitidos = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pps', 'ppsx', 'pdf', 'txt'];

    // Captura os dados dos arquivos enviados
    $arquivo = $_FILES['arquivos'];

    // Conta a quantidade de arquivo enviado
    $conta = count(array_filter($arquivo['name']));

    for ($i = 0; $i < $conta; $i++) {
        $nome = $arquivo['name'][$i];
        $tmp = $arquivo['tmp_name'][$i];

        // Verifica a extensão do arquivo
        $extensao = strtolower(end(explode(".", $nome)));

        if (in_array($extensao, $permitidos)) {

            // Renomeia os arquivos
            $novo_nome = nId($solicitacao_id) . "_" . rand(1000,9999) . "." . $extensao;

            if (move_uploaded_file($tmp, $pasta . $novo_nome)) {

                // Salva as informações dos arquivos no banco de dados
                $anexo = mysqli_query ($conn, "INSERT INTO gc_solicitacoes_anexos (id_solicitacao, usuario, anexo) VALUES ('$solicitacao_id', '$idUsuario', '$novo_nome')") or die (mysqli_error($conn));

            }

        }

    }

    /* *** */

    // Lido
    $id_solicitacao = idSolicitacaoCod($codigo);
    marcarLido($id_solicitacao, $idUsuario);

    /* *** */

    if ($enviar_email) {
        // Informações para o E-mail
        $n_id = nID($id_solicitacao);
        $nome_requerente = nomeUsuarioId($idUsuario);
        $solicitacao = nl2br($descricao);

        /* ********************************************************************************************
        ENVIANDO E-MAIL
        ******************************************************************************************** */
        // Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
        require_once("../../phpmailer/PHPMailerAutoload.php");

        // Inicia a classe PHPMailer
        $mail = new PHPMailer();

        // Configuração do E-mail
        require_once("config_email.php");

        // Define os destinatário(s)
        /**
         * GlassControl
         */
        $con_emails = mysqli_query($conn, "SELECT nome, email FROM gc_usuarios WHERE tipo='G'") or die (mysqli_error($conn));
        while ($d_emails = mysqli_fetch_array($con_emails)) {
            $mail->AddAddress($d_emails['email'], $d_emails['nome']);
        }
        /**
         * Admin
         */
        $con_emails_admin = mysqli_query($conn, "SELECT nome, email FROM gc_usuarios WHERE tipo='A'") or die (mysqli_error($conn));
        while ($d_emails_admin = mysqli_fetch_array($con_emails_admin)) {
            $mail->AddCC($d_emails_admin['email'], $d_emails_admin['nome']); // Cópia
        }
        //$mail->AddBCC('bruno.berlanda@lindevidros.com.br'); // Cópia Oculta

        // Define os dados técnicos da Mensagem
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
        $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

        // Define a mensagem (Texto e Assunto)
        $mail->Subject = "Linde Vidros - Nova Solicitação"; // Assunto da mensagem
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
				<td colspan='2'><img src='http://www.lindevidros.com.br/email/glasscontrol/img05.png'></td>
			</tr>
			
			<tr>
				<td colspan='2'><img src='http://www.lindevidros.com.br/email/glasscontrol/img06.png'></td>
			</tr>
					
			<tr>
				<td width='150' valign='top'><img src='http://www.lindevidros.com.br/email/glasscontrol/img07.png'></td>
				<td width='450' style='padding-left: 10px; text-align: left;'><font face='Verdana' size='2' color='#555555'><b>$n_id</b></font></td>
			</tr>
			<tr>
				<td width='150' valign='top'><img src='http://www.lindevidros.com.br/email/glasscontrol/img08.png'></td>
				<td width='450' style='padding-left: 10px; text-align: left;'><font face='Verdana' size='1' color='#555555'>$nome_requerente</font></td>
			</tr>
			<tr>
				<td width='150' valign='top'><img src='http://www.lindevidros.com.br/email/glasscontrol/img09.png'></td>
				<td width='450' style='padding-left: 10px; text-align: justify;'><font face='Verdana' size='1' color='#555555'>$solicitacao</font></td>
			</tr>
			
			<tr>
				<td colspan='2' align='center' style='padding: 15px 0;'><a href='http://www.lindevidros.com.br/glasscontrol'><img src='http://www.lindevidros.com.br/email/glasscontrol/img10.png'></a></td>
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
    }

    /* *** */

    header ('Location: ../solicitacoes-nova.php?msgSucesso=Solicitação cadastrada com sucesso.');

}

/**
 * RESPOSTA
 */
if ($_GET['funcao'] === "resposta" && isset($_SESSION['loginSysLG'])) {

    $codigo = $_GET['c'];

    // Dados do formulário
    $descricao = textoMaiusc(strip_tags(trim($_POST['descricao'])));

    /* *** */

    // Prazo de entrega
    if ($_POST['prazo'] !== "" && isset($_POST['prazo'])) {

        $prazo = strip_tags(trim($_POST['prazo']));

        $sql_prazo = "UPDATE gc_solicitacoes SET prazo='$prazo', status='D' WHERE codigo='$codigo'";

        $atu_prazo = mysqli_query ($conn, $sql_prazo) or die (mysqli_error($conn));

    }

    // Solicitação para Teste/Aprovação
    if (isset($_POST['teste'])) {

        $sql_teste = "UPDATE gc_solicitacoes SET status='A' WHERE codigo='$codigo'";

        $atu_teste = mysqli_query ($conn, $sql_teste) or die (mysqli_error($conn));

    }

    $id_solicitacao = idSolicitacaoCod($codigo);

    // Cadastra a nova mensagem
    $sql1 = "INSERT INTO gc_solicitacoes_msgs (id_solicitacao, usuario, descricao) VALUES ('$id_solicitacao', '$idUsuario', '$descricao')";
    // Limpa os registros de lidos
    $sql2 = "DELETE FROM gc_lidas WHERE id_solicitacao='$id_solicitacao'";

    $cad = mysqli_query ($conn, $sql1) or die (mysqli_error($conn));
    $lid = mysqli_query ($conn, $sql2) or die (mysqli_error($conn));

    /* *** */

    /**
     * ENVIAR OS ARQUIVOS
     */

    // Captura o ID da mensagem
    $con_id_msg = mysqli_query ($conn, "SELECT id FROM gc_solicitacoes_msgs WHERE id_solicitacao='$id_solicitacao' AND usuario='$idUsuario' AND descricao='$descricao'") or die (mysqli_error($conn));
    $d_id_msg = mysqli_fetch_array($con_id_msg);

    $msg_id = $d_id_msg['id'];

    // Pasta de destino dos arquivos
    $pasta = "../arquivos/";

    // Arquivos permitidos
    $permitidos = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pps', 'ppsx', 'pdf', 'txt'];

    // Captura os dados dos arquivos enviados
    $arquivo = $_FILES['arquivos'];

    // Conta a quantidade de arquivo enviado
    $conta = count(array_filter($arquivo['name']));

    for ($i = 0; $i < $conta; $i++) {
        $nome = $arquivo['name'][$i];
        $tmp = $arquivo['tmp_name'][$i];

        // Verifica a extensão do arquivo
        $extensao = strtolower(end(explode(".", $nome)));

        if (in_array($extensao, $permitidos)) {

            // Renomeia os arquivos
            $novo_nome = nId($id_solicitacao) . "_" . rand(1000, 9999) . "." . $extensao;

            if (move_uploaded_file($tmp, $pasta . $novo_nome)) {

                // Salva as informações dos arquivos no banco de dados
                $anexo = mysqli_query($conn, "INSERT INTO gc_solicitacoes_anexos (id_solicitacao, id_mensagem, usuario, anexo) VALUES ('$id_solicitacao', '$msg_id', '$idUsuario', '$novo_nome')") or die (mysqli_error($conn));

            }

        }

    }

    /* *** */

    if ($enviar_email) {
        // Informações para o E-mail
        $n_id = nID($id_solicitacao);
        $usuario_resposta = nomeUsuarioId($idUsuario);
        $nome_requerente = nomeRequerenteId($id_solicitacao);
        $email_requerente = emailRequerenteId($id_solicitacao);
        $desc_solicitacao = descSolicitacaoId($id_solicitacao);
        $resposta = nl2br($descricao);

        /* ********************************************************************************************
        ENVIANDO E-MAIL
        ******************************************************************************************** */
        // Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
        require_once("../../phpmailer/PHPMailerAutoload.php");

        // Inicia a classe PHPMailer
        $mail = new PHPMailer();

        // Configuração do E-mail
        require_once("config_email.php");

        // Define os destinatário(s)
        /**
         * Requerente
         */
        $mail->AddAddress($email_requerente, $nome_requerente);
        /**
         * Admin e GlassControl
         */
        $con_emails_admin = mysqli_query($conn, "SELECT nome, email FROM gc_usuarios WHERE tipo IN ('A','G')") or die (mysqli_error($conn));
        while ($d_emails_admin = mysqli_fetch_array($con_emails_admin)) {
            $mail->AddCC($d_emails_admin['email'], $d_emails_admin['nome']); // Cópia
        }
        //$mail->AddBCC('bruno.berlanda@lindevidros.com.br'); // Cópia Oculta

        // Define os dados técnicos da Mensagem
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
        $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

        // Define a mensagem (Texto e Assunto)
        $mail->Subject = "Linde Vidros - Solicitação Respondida"; // Assunto da mensagem
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
				<td colspan='2'><img src='http://www.lindevidros.com.br/email/glasscontrol/img11.png'></td>
			</tr>
			
			<tr>
				<td colspan='2'><img src='http://www.lindevidros.com.br/email/glasscontrol/img12.png'></td>
			</tr>
					
			<tr>
				<td width='150' valign='top'><img src='http://www.lindevidros.com.br/email/glasscontrol/img13.png'></td>
				<td width='450' style='padding-left: 10px; text-align: left;'><font face='Verdana' size='2' color='#555555'><b>$n_id</b></font></td>
			</tr>
			<tr>
				<td width='150' valign='top'><img src='http://www.lindevidros.com.br/email/glasscontrol/img14.png'></td>
				<td width='450' style='padding-left: 10px; text-align: justify;'><font face='Verdana' size='1' color='#999999'>$desc_solicitacao</font></td>
			</tr>
			<tr>
				<td width='150' valign='top'><img src='http://www.lindevidros.com.br/email/glasscontrol/img17.png'></td>
				<td width='450' style='padding-left: 10px; text-align: justify;'><font face='Verdana' size='1' color='#555555'>$usuario_resposta</font></td>
			</tr>
			<tr>
				<td width='150' valign='top'><img src='http://www.lindevidros.com.br/email/glasscontrol/img15.png'></td>
				<td width='450' style='padding-left: 10px; text-align: justify;'><font face='Verdana' size='1' color='#555555'><b>$resposta</b></font></td>
			</tr>
			
			<tr>
				<td colspan='2' align='center' style='padding: 15px 0;'><a href='http://www.lindevidros.com.br/glasscontrol'><img src='http://www.lindevidros.com.br/email/glasscontrol/img16.png'></a></td>
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
    }

    /* *** */

    header ('Location: ../solicitacoes-ver.php?c='.$codigo.'&msgSucesso=Resposta enviada com sucesso.');

}

/**
 * TICKET
 */
if ($_GET['funcao'] === "ticket" && $tipoUsuario === "A" && isset($_SESSION['loginSysLG'])) {

    $codigo = $_GET['c'];

    // Dados do formulário
    $ticket = strip_tags(trim($_POST['ticket']));

    /* *** */

    $sql = "UPDATE gc_solicitacoes SET ticket='$ticket' WHERE codigo='$codigo'";

    $atu = mysqli_query ($conn, $sql) or die (mysqli_error($conn));

    header ('Location: ../solicitacoes-ver.php?c='.$codigo.'&msgSucesso=Ticket atualizado com sucesso.');

}

/**
 * ALTERAR PRAZO
 */
if ($_GET['funcao'] === "alterar_prazo" && isset($_SESSION['loginSysLG'])) {

    $codigo = $_GET['c'];

    // Dados do formulário
    $prazo = strip_tags(trim($_POST['prazo']));
    $motivo = textoMaiusc(strip_tags(trim($_POST['motivo'])));

    /* *** */

    $id_solicitacao = idSolicitacaoCod($codigo);
    $prazo_atual = prazoAtual($id_solicitacao);

    /* *** */

    if ($prazo < date("Y-m-d")) {

        header ('Location: ../solicitacoes-ver.php?c='.$codigo.'&msgErro=Você não pode selecionar uma data menor que a data atual.');

    } elseif ($prazo == $prazo_atual) {

        header ('Location: ../solicitacoes-ver.php?c='.$codigo.'&msgErro=Selecione uma data diferente do prazo atual.');

    } else {

        // Cadastra o novo prazo
        $sql1 = "INSERT INTO gc_solicitacoes_prazos (id_solicitacao, usuario, prazo_anterior, prazo_novo, motivo) VALUES ('$id_solicitacao', '$idUsuario', '$prazo_atual', '$prazo', '$motivo')";
        // Atualiza a solicitação com o novo prazo
        $sql2 = "UPDATE gc_solicitacoes SET prazo='$prazo' WHERE id='$id_solicitacao'";
        // Limpa os registros de lidos
        $sql3 = "DELETE FROM gc_lidas WHERE id_solicitacao='$id_solicitacao'";

        $cad = mysqli_query ($conn, $sql1) or die (mysqli_error($conn));
        $atu = mysqli_query ($conn, $sql2) or die (mysqli_error($conn));
        $exc = mysqli_query ($conn, $sql3) or die (mysqli_error($conn));

        header ('Location: ../solicitacoes-ver.php?c='.$codigo.'&msgSucesso=Prazo atualizado com sucesso.');

    }

}

/**
 * ALTERAR PRIORIDADE
 */
if ($_GET['funcao'] === "prioridade" && isset($_SESSION['loginSysLG'])) {

    $codigo = $_GET['c'];

    $id_solicitacao = idSolicitacaoCod($codigo);

    // Dados do formulário
    $prioridade = strip_tags(trim($_POST['prioridade']));

    // Dados atuais
    $prioridade_atual = $_POST['prioridade_atual'];

    /* *** */

    $sql_atu = "UPDATE gc_solicitacoes SET prioridade='$prioridade' WHERE codigo='$codigo'";

    $atu = mysqli_query ($conn, $sql_atu) or die (mysqli_error($conn));

    if ($prioridade !== $prioridade_atual) {

        $sql_cad = "INSERT INTO gc_solicitacoes_prioridades (id_solicitacao, usuario, prioridade_anterior, prioridade_novo) VALUES ('$id_solicitacao', '$idUsuario', '$prioridade_atual', '$prioridade')";

        $cad = mysqli_query($conn, $sql_cad) or die (mysqli_error($conn));

    }

    header ('Location: ../solicitacoes-ver.php?c='.$codigo.'&msgSucesso=Prioridade atualizada com sucesso.');

}

/**
 * ALTERAR STATUS
 */
if ($_GET['funcao'] === "status" && $tipoUsuario === "A" && isset($_SESSION['loginSysLG'])) {

    $codigo = $_GET['c'];

    $id_solicitacao = idSolicitacaoCod($codigo);

    // Dados do formulário
    $status = strip_tags(trim($_POST['status']));

    // Dados atuais
    $status_atual = $_POST['status_atual'];

    /* *** */

    $sql_atu = "UPDATE gc_solicitacoes SET status='$status' WHERE codigo='$codigo'";

    $atu = mysqli_query ($conn, $sql_atu) or die (mysqli_error($conn));

    if ($status !== $status_atual) {

        $sql_cad = "INSERT INTO gc_solicitacoes_status (id_solicitacao, usuario, status_anterior, status_novo) VALUES ('$id_solicitacao', '$idUsuario', '$status_atual', '$status')";

        $cad = mysqli_query($conn, $sql_cad) or die (mysqli_error($conn));

    }

    header ('Location: ../solicitacoes-ver.php?c='.$codigo.'&msgSucesso=Status atualizado com sucesso.');

}