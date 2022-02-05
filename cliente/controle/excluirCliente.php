<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
$id = $_POST['id'];
$erro = UsuarioDAO::excluirPorId($id);
if($erro){
   $msg = 4;
}
else{
	$msg= 5;
}
header("location: sair.php");
?>
