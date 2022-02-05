<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");

//if($cliente->getNivel() != "cliente"){
	//header("location: ../index.php?");
 //}
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$email = $_POST["email"];
$senha = "";//$_POST["senha"];
$NIVEL = $_POST["nivel"];
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$cep = $_POST["cep"];
$foto_perfil = $_POST["foto_perfil"];
$id = $_POST["id"];



$ender = new Endereco($rua, $numero, $cidade, $estado,$cep,$id);
$cliente = new Cliente( $cpf, $nome, $senha, $email, $foto_perfil, $NIVEL, $ender, $id);
//var_dump($cliente);
if(UsuarioDAO::alterar($cliente)){
   session_start();
   $_SESSION['cliente'] = serialize($cliente);
}
header("location: ../index.php?p=2");

?>
