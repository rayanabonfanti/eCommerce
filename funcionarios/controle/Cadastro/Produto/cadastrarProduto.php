<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	limparPost();
	validarFormulario();
	

	if($_POST["ativo"] == 1)
	{
		$ativo = 1;
	}
	else if ($_POST["ativo"] == 2)
	{
		$ativo = 0;
	}

	$preco = $_POST["preco"];
	$descricao = $_POST["descricao"];
	$estoque = $_POST["estoque"];
	

$tmp_name = $_FILES['arquivo']['tmp_name'];
$nome = $_FILES['arquivo']['name'];
$nome = time() . $nome;

$foto = $nome;
$produto = new Produto($preco, $descricao, $estoque,$ativo,$foto);

if($preco == 0 || $descricao == null || $estoque == 0 || $_POST["ativo"] == 0)
{
	$_SESSION['mensagemInseridoProduto'] = 0;	
}
else
{
	move_uploaded_file($tmp_name,"../../../arquivos/$nome");
	$ar = new Arquivo($_POST['nome'],$nome);
	$salvou = ArquivoProdutoDAO::salvarArquivoCadastrarProduto($ar,$produto);
	//obter extensao
	$partes = explode(".",$nome);
	$extensao = $partes[sizeof($partes)-1];
	//criar icone
	switch($extensao){
		case "png":
			$imagem = imagecreatefrompng("../../../arquivos/$nome");
			break;
		case "jpg":
			$imagem = imagecreatefromjpeg("../../../arquivos/$nome");
			break;
		case "jpeg":
			$imagem = imagecreatefromjpeg("../../../arquivos/$nome");
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
	imagejpeg($nova_imagem,"../../../arquivos/icones/".$nome.".jpg");
	if(!$salvou)
	{
		unlink("../../../arquivos/$nome");
		unlink("../../../arquivos/icones/".$nome.".jpg");
		$_SESSION['mensagemInseridoProduto'] = 0;	
	}
	else
	{
		$_SESSION['mensagemInseridoProduto'] = 1;	
	}	
}

	$numero_login_s = $_POST['numero_login_s'];
	$func = FuncionarioDAO::buscaFuncionario($numero_login_s);
	
	if($func == null)
	{
		header("location: ../../../index.php");
	}
	if($func->getNivelHierarquico()=="Administrador_Basico")
	{
		header("location: ../../../index.php?p=1");
	}
	else if($func->getNivelHierarquico()=="Administrador_Supervisor")
	{
		header("location: ../../../index.php?p=1");
	}
	else if($func->getNivelHierarquico()=="Funcionario_Comum")
	{
		header("location: ../../../index.php?p=0");
	}
?>
