<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");

$pagamento = $_GET['pagamento'];
$id_cliente = $_GET['id_cliente'];
$status_atualizacao = "aguardando";

$id_ultimo_pedido = PedidoDAO::maxIdPedidoCliente($id_cliente);

$ultimoPedido = PedidoDAO::buscarPorId($id_ultimo_pedido);

if($ultimoPedido != null){
	if($ultimoPedido->getStatusAtualizacao() != "aguardando"){	
		$pedido = New Pedido($status_atualizacao,$pagamento,$id_cliente);
		PedidoDAO::cadastrarPedido($pedido);
		$id_ultimo_pedido = PedidoDAO::maxIdPedidoCliente($id_cliente);
	}
}else{
	$pedido = New Pedido($status_atualizacao,$pagamento,$id_cliente);
	PedidoDAO::cadastrarPedido($pedido);
	$id_ultimo_pedido = PedidoDAO::maxIdPedidoCliente($id_cliente);
	
}
									
header("location: ../index.php?p=9&id_ultimo_pedido=$id_ultimo_pedido");
?>
