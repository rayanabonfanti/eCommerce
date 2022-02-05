<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
$id_cliente = $_GET['id'];
$tmp_name = $_FILES['arquivo']['tmp_name'];
$nome = $_FILES['arquivo']['name'];
$nome = time() . $nome;
move_uploaded_file($tmp_name,"../arquivos/$nome");
$ar = new Arquivo($_POST['nome'],$nome);
$salvou = ArquivoClienteDAO::salvarArquivoCliente($ar,$id_cliente);

//obter extensao
$partes = explode(".",$nome);
$extensao = $partes[sizeof($partes)-1];
//criar icone
switch($extensao){
	case "png":
		$imagem = imagecreatefrompng("../arquivos/$nome");
		break;
	case "jpg":
		$imagem = imagecreatefromjpeg("../arquivos/$nome");
		break;
	case "jpeg":
		$imagem = imagecreatefromjpeg("../arquivos/$nome");
		break;
		
}
$w_antigo = imagesx($imagem);
$h_antiga = imagesy($imagem);
$max = 100;
$escala = max($w_antigo/$max,$h_antiga/$max);
$w_novo = $w_antigo/$escala;
$h_novo = $h_antiga/$escala;
$nova_imagem = imagecreatetruecolor($w_novo,$h_novo);
imagecopyresampled($nova_imagem, $imagem, 0, 0, 0, 0, $w_novo, $h_novo, $w_antigo, $h_antiga);
imagejpeg($nova_imagem,"../arquivos/icones/".$nome.".jpg");
if(!$salvou){
	unlink("../arquivos/$nome");
}

header("location: ../../index.php?p=5");
?>
