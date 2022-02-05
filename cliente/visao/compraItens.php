<?php
$itens = CarrinhoDAO::buscarPorIdCliente($cliente->getId());
$id_ultimo_pedido = $_GET['id_ultimo_pedido'];
if($id_ultimo_pedido==null or $id_ultimo_pedido == 0){
	echo "zero nulo";
}
$ultimoPedido = PedidoDAO::buscarPorId($id_ultimo_pedido);
if($ultimoPedido == null){
	
	echo "///// nulo";
}



$total = 0;
$p = null;
?>
<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-10" class="container-fluid">	
		<table>
			<tr>
				<th>quantidade</th>
				<th>decricao</th>
				<th>Valor</th>
			</tr>
				<?php foreach($itens as $i) { ?>
					<tr>
						<?php
							$p = ProdutoDAO::buscarPorId($i->getIdProduto());							
						?> 
							<td><?=$i->getQuantidade()?></td>
							<td><?=$p->getDescricao()?></td>
							<td><?=$p->getPreco()?></td>							
						<?php
							$total = $total + ($p->getPreco() * $i->getQuantidade());
						?>
							
					</tr>	
				<?php 		
				} ?>
			
		</table>

			<a> Total = <?=$total?></a>
		<table>		
			<tr>
				<th>status</th>
				<th>forma pagamento</th>
				<th>cpf cliente</th>
			</tr>				
				<tr>					
					<td><?=$ultimoPedido->getStatusAtualizacao()?> </td>
					<td><?=$ultimoPedido->getFormaPagamento()?> </td>
					<td><?=$cliente->getCpf()?> </td>	
				</tr>			
		</table>	
																					
			<a href="controle/finalizarCompraItens.php?id_cliente=<?=$cliente->getId()?>&id_pedido=<?=$ultimoPedido->getId()?>">finalizar Compra</a>
			<a href="controle/excluirPedido.php??id_cliente=<?=$cliente->getId()?>&id_pedido=<?=$ultimoPedido->getId()?>"  onclick="return confirm('Deseja Cancelar?')">cancelar Compra </a>
	</div>	
</div>	