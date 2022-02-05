<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");

$id_produto = $_GET['id_produto'];
$id_cliente = $_GET['id_cliente'];
$carrinho = CarrinhoDAO::verificarCarrinho($id_produto, $id_cliente);

if($carrinho == null)
{
	
	$quantidade = 1;
	CarrinhoDAO::adicionarItem($id_produto,$id_cliente, $quantidade);
	header("location: ../index.php?p=6");
}
else
{	
	CarrinhoDAO::alterarQuantidade($id_produto,$id_cliente);
}

header("location: ../index.php?p=7");
?>
