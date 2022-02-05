<?php
$itens = CarrinhoDAO::buscarPorIdCliente($cliente->getId()); 
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
							<td>
								<a href="controle/adicionarItemCarrinho.php?id_produto=<?=$p->getId()?>&id_cliente=<?=$cliente->getId()?>">
									<button class="btn btn-info">+</button>  
								</a>			
							</td>
							<td>
								<a href="controle/DecrementarItemCarrinho.php?id_produto=<?=$p->getId()?>&id_cliente=<?=$cliente->getId()?>">
									<button class="btn btn-info">-</button>  
								</a>			
							</td>
						<?php
							$total = $total + ($p->getPreco() * $i->getQuantidade());
						?>
							<td>					
								<a href="controle/excluirItemCarrinho.php?id=<?=$p->getId()?>&idCliente=<?=$i->getIdCliente()?>" onclick="return confirm('Deseja excluir?')">
									Excluir item
								</a>					
							</td>
					</tr>	
				<?php 		
				} ?>
			
		</table>

			<a> Total = <?=$total?></a>
			
			<a href="index.php?p=8">Comprar</a>
			<a href="?p=4">Voltar as Compras</a>
	</div>	
</div>	