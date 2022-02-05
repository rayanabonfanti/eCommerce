<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");

$id_cliente = $_GET['id_cliente'];
$id_pedido = $_GET['id_pedido'];

PedidoDAO::excluirPedido($id_pedido,$id_cliente);
header("location: ../index.php?p=7");
?>
