<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");

$id = $_GET['id'];
$idCliente = $_GET['idCliente'];
CarrinhoDAO::excluirItemCarrinho($id,$idCliente);
header("location: ../index.php?p=7");
?>
