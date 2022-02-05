<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
$email = $_POST['email'];
$senha = $_POST['senha'];
$cliente= UsuarioDAO::autenticar($email,$senha);

if($cliente!=NULL){
	$_SESSION['cliente'] = serialize($cliente);
	header("location: ../index.php?p=4");

}else{
	$_SESSION['mensagens'] = 0;	
	header("location: ../visao/loginFace.php");
}	

?>
