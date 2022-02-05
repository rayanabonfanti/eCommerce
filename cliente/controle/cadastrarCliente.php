<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$cep = $_POST['cep'];
$foto_perfil = "";

$ender = new Endereco($rua, $numero, $cidade, $estado, $cep);

$cliente = new Cliente($cpf,$nome, $senha, $email, $foto_perfil, "cliente", $ender);

$erro = UsuarioDAO::cadastrar($cliente);

if($erro){
   $msgCadastro = 0;
}
else{
	$msgCadastro = 1;
}
echo $msgCadastro;
header("location: ../index.php?msgCadastro=$msgCadastro");
?>