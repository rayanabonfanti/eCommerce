<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");

$id_produto = $_GET['id_produto'];
$id_cliente = $_GET['id_cliente'];

if($carrinho->getQuantidade() <= 1 ){
	CarrinhoDAO::excluirItemCarrinho($id_produto, $id_cliente);
	header("location: ../index.php?p=8");
}
	
CarrinhoDAO::alterarQuantidadeDecrementar($id_produto,$id_cliente);	
header("location: ../index.php?p=8");
?>
