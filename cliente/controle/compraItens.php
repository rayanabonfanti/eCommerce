<?php
$id_cliente = $_GET['id_cliente'];
$itens = CarrinhoDAO::buscarPorIdCliente($id_cliente); 

foreach($itens as $i) {
	CompraItensDAO::adicionarItemCompra($i->getIdProduto(),$id_pedido, $i->getQuantidade());
}	
header("location: ../index.php?p=9");
?>
