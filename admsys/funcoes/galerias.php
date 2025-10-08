<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_galerias == "S") {
	
	$upload_dir = '../../imagens/galerias/';
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$titulo 	= strip_tags(trim($_POST['titulo']));
$descricao 	= strip_tags(trim($_POST['descricao']));

$ano = date("Y");
$path = $upload_dir . $ano . "/" . md5($titulo) . "/";

if (file_exists($path)) {
	header ('Location: ../galerias.php?msgErro=Já existe uma galeria com esse nome');
}
else {
	$dir_ano = $upload_dir . $ano;
	if (!file_exists($dir_ano)) {
		mkdir($dir_ano);
	}
	if (!file_exists($path)) {
		mkdir($path);
	}
		
	$cadastrando = mysqli_query($conexao, "INSERT INTO admin_galerias (usuario, titulo, descricao) VALUES ('$id_usuario', '$titulo', '$descricao')") or die (mysqli_error());

	header ('Location: ../galerias.php?msgSucesso=Galeria criada com sucesso. Clique em editar para fazer upload das fotos');
}

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

// Dados do formulário
$titulo 	= strip_tags(trim($_POST['titulo']));
$descricao 	= strip_tags(trim($_POST['descricao']));

$titulo_atual 	= strip_tags(trim($_POST['titulo_atual']));

// Consulta a data que foi criada a galeria
$consulta_galeria = mysqli_query($conexao, "SELECT data FROM admin_galerias WHERE id='$id'") or die (mysqli_error());
	$linha = mysqli_fetch_array ($consulta_galeria);
		$data = $linha['data'];
		
$ano = date('Y', strtotime($data));

// Criando o nome da pasta atual
$path_atual = $upload_dir . $ano . "/" . md5($titulo_atual) . "/";

// Criando o novo nome da pasta
$path = $upload_dir . $ano . "/" . md5($titulo) . "/";

// Renomeia a pasta
rename($path_atual, $path);

$editando = mysqli_query($conexao, "UPDATE admin_galerias SET titulo='$titulo', descricao='$descricao' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../galerias.php?editar='.$id.'&msgSucesso=Galeria alterada com sucesso');

}

/* ******************************************************************************************************************
ENVIAR FOTOS
****************************************************************************************************************** */
if ($_GET['funcao'] == "enviar_fotos") {

// Pegar as informações do álbum
$id_galeria = $_GET['id'];

$consulta_galeria = mysqli_query($conexao, "SELECT data, titulo FROM admin_galerias WHERE id='$id_galeria'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consulta_galeria);
		$data 	= $dados['data'];
		$titulo = $dados['titulo'];
					
$ano = date('Y', strtotime($data));

// Local para guardar as fotos
$pasta = $upload_dir . $ano . "/" .  md5($titulo) . "/";

/* ******************************************************************************
UPLOAD
****************************************************************************** */
if (isset($_POST['upload'])) {
	
	// Informações da Imagem
	$arquivo	= $_FILES['img'];
	$conta 		= count(array_filter($arquivo['name']));

	// Requisitos
	$permite = array('image/jpeg', 'image/jpg', 'image/png');
	$tamanho = 1024 * 1024 * 5;
	
	// Mensagens
	$msg = array();
	$errorMsg = array(
		1 => "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini",
		2 => "O arquivo excede o limite definido em MAX_FILE_SIZE no formulário HTML",
		3 => "O upload do arquivo foi feito parcialmente",
		4 => "Nenhum arquivo foi enviado"
	);
	
	if($conta <= 0) {
		header ('Location: ../galerias.php?editar='.$id_galeria.'&msgErro=Selecione pelo menos uma imagem');
	}
	else {
		for ($i=0; $i<$conta; $i++) {
			$name 	= $arquivo['name'][$i];
			$type 	= $arquivo['type'][$i];
			$size 	= $arquivo['size'][$i];
			$error 	= $arquivo['error'][$i];
			$tmp	= $arquivo['tmp_name'][$i];
			
			$extensao = @end(explode(".",$name));
			
			$novoNome = rand().".$extensao";
			
			if ($error != 0) {
				header ('Location: ../galerias.php?editar='.$id_galeria.'&msgErro='.$errorMsg[$error]);
			}
			else if (!in_array($type, $permite)) {
				header ('Location: ../galerias.php?editar='.$id_galeria.'&msgErro=Formato de imagem não suportada');
			}
			else if ($size > $tamanho) {
				header ('Location: ../galerias.php?editar='.$id_galeria.'&msgErro=Arquivo muito grande');
			}
			else {
				if (move_uploaded_file($tmp, $pasta . $novoNome)) {
					
					$cadastrando = mysqli_query($conexao, "INSERT INTO admin_galerias_fotos (id_galeria, foto) VALUES ('$id_galeria', '$novoNome')") or die (mysqli_error());
					
					header ('Location: ../galerias.php?editar='.$id_galeria.'&msgSucesso=Upload realizado com sucesso');
				}
				else {
					header ('Location: .../galerias.php?editar='.$id_galeria.'&msgErro=Ocorreu algum erro ao fazer o upload');
				}
			}
			
			foreach ($msg as $pop) {
				echo $pop."<br>";
			}
		}
	}
}

}

/* ******************************************************************************
EXCLUIR FOTOS
****************************************************************************** */
if ($_GET['funcao'] == "excluir_foto") {
	
$id_foto 	= $_GET['id_foto'];
$id_galeria = $_GET['id_galeria'];

// Consulta o nome da foto
$consulta_galeria = mysqli_query($conexao, "SELECT foto FROM admin_galerias_fotos WHERE id='$id_foto'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consulta_galeria);
		$foto = $dados['foto'];

// Pega o nome da galeria
$galeria = mysqli_query($conexao, "SELECT data, titulo FROM admin_galerias WHERE id='$id_galeria'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($galeria);
		$dataGaleria 	= $dados['data'];
		$tituloGaleria 	= $dados['titulo'];

$ano = date('Y', strtotime($dataGaleria));

// Local para guardar as fotos
$pasta = $upload_dir . $ano . "/" .  md5($tituloGaleria) . "/";
			
unlink ($pasta.$foto);

// Excluir a foto
$excluir = mysqli_query($conexao, "DELETE FROM admin_galerias_fotos WHERE id='$id_foto'") or die (mysqli_error());	

header ('Location: ../galerias.php?editar='.$id_galeria.'&msgSucesso=Foto excluída com sucesso');

}

/* ******************************************************************************
EXCLUIR GALERIA
****************************************************************************** */
if ($_GET['funcao'] == "excluir") {
	
$id = $_GET['id'];

// Função para apagar diretório e arquivos
function rmdir_r( $path )
{
	if (!is_dir($path)) {return false;}
	$stack = Array($path);
	while ($dir = array_pop($stack))
	{
		if (@rmdir($dir)) {continue;}
		$stack[] = $dir;
		$dh = opendir($dir);
		while (($child = readdir($dh)) !== false)
		{
			if ($child[0] == '.') {continue;}
			$child = $dir . DIRECTORY_SEPARATOR . $child;
			if (is_dir($child)) {$stack[] = $child;}
			else {unlink($child);}
		}
	}
return true;
}

$consulta_galeria = mysqli_query($conexao, "SELECT * FROM admin_galerias WHERE id='$id'") or die (mysqli_error());

while ($dados = mysqli_fetch_array($consulta_galeria))
{
	$data 	= $dados['data'];
	$titulo = $dados['titulo'];
	
	$ano = date('Y', strtotime($data));

	$apagar = $upload_dir . $ano .'/'. md5($titulo) .'/';

	if (rmdir_r($apagar) && mysqli_query($conexao, "DELETE FROM admin_galerias WHERE id='$id'"))
	{

		// Tirar os registros das fotos do mySQL
		$excluir = mysqli_query($conexao, "DELETE FROM admin_galerias_fotos WHERE id_galeria='$id'") or die (mysqli_error());

		header ('Location: ../galerias.php?msgSucesso=Galeria excluída com sucesso');
	}
}

}

/* ******************************************************************************
DESATIVAR GALERIA
****************************************************************************** */
if ($_GET['funcao'] == "desativar") {
	
	$id = $_GET['id'];
	
	$editando = mysqli_query($conexao, "UPDATE admin_galerias SET status='N' WHERE id='$id'") or die (mysqli_error());				

	header('Location: ../galerias.php?msgSucesso=Galeria ocultada com sucesso');
}

/* ******************************************************************************
ATIVAR GALERIA
****************************************************************************** */
if ($_GET['funcao'] == "ativar") {
	
	$id = $_GET['id'];
	
	$editando = mysqli_query($conexao, "UPDATE admin_galerias SET status='S' WHERE id='$id'") or die (mysqli_error());				

	header('Location: ../galerias.php?msgSucesso=Galeria reativada com sucesso');
}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}