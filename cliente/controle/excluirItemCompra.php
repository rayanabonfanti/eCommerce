<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
$id = $_GET['id'];
$idCliente = $_GET['idCliente'];
CompraItensDAO::excluirItemCompra($id, $idCliente);
header("location: ../index.php?p=8");
?>
