<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
limparPost();
validarFormulario();

$numero_login_funcionario_arquivo = $_POST['numero_login'];
$tmp_name = $_FILES['arquivo']['tmp_name'];
$nome = $_FILES['arquivo']['name'];
$nome = time() . $nome;

if($_FILES['arquivo']['name'] == null || empty($tmp_name) || empty($nome) || $_FILES['arquivo']['tmp_name'] == null)
{
	$_SESSION['mensagemInserirArquivoFuncionario'] = 0;
}
else
{
	move_uploaded_file($tmp_name,"../../arquivos/$nome");
	$ar = new Arquivo($_POST['nome'],$nome);
	$salvou = ArquivoDAO::salvarArquivoFuncionario($ar,$numero_login_funcionario_arquivo);
	//obter extensao
	$partes = explode(".",$nome);
	$extensao = $partes[sizeof($partes)-1];
	//criar icone
	switch($extensao){
		case "png":
			$imagem = imagecreatefrompng("../../arquivos/$nome");
			break;
		case "jpg":
			$imagem = imagecreatefromjpeg("../../arquivos/$nome");
			break;
		case "jpeg":
			$imagem = imagecreatefromjpeg("../../arquivos/$nome");
			break;
			
	}
	$w_antigo = imagesx($imagem);
	$h_antiga = imagesy($imagem);
	$max = 50;
	$escala = max($w_antigo/$max,$h_antiga/$max);
	$w_novo = $w_antigo/$escala;
	$h_novo = $h_antiga/$escala;
	$nova_imagem = imagecreatetruecolor($w_novo,$h_novo);
	imagecopyresampled($nova_imagem, $imagem, 0, 0, 0, 0, $w_novo, $h_novo, $w_antigo, $h_antiga);
	imagejpeg($nova_imagem,"../../arquivos/icones/".$nome.".jpg");
	if(!$salvou){
		unlink("../../arquivos/$nome");
		$_SESSION['mensagemInserirArquivoFuncionario'] = 0;
	}
	else{
		$_SESSION['mensagemInserirArquivoFuncionario'] = 1;
	}
}		

	$numero_login_s = $_POST['numero_login_s'];
	$func = FuncionarioDAO::buscaFuncionario($numero_login_s);
	
	if($func == null)
	{
		header("location: ../../index.php");
	}
	if($func->getNivelHierarquico()=="Administrador_Basico")
	{
		header("location: ../../index.php?p=5");
	}
	else if($func->getNivelHierarquico()=="Administrador_RH")
	{
		header("location: ../../index.php?p=2");
	}
	else if($func->getNivelHierarquico()=="Administrador_Supervisor")
	{
		header("location: ../../index.php?p=5");
	}
	else
	{
		header("location: ../../index.php?p=4");
	}
?>
