<?php
session_start;
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
if($cliente->getNivel() != "cliente") ){
	header("location: ../index.php?");
 }
$clientes = clientesDAO::todos();
foreach($clientes as $c){
	echo $c . "\n";
}
header("location: ../index.php");
?>
