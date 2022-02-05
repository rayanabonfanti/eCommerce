<?php
$itens = CarrinhoDAO:: buscarPorIdCliente($cliente->getId()); 
$total = 0;

$p = null;
$valores = array();
$valores["cartao"] = 4;
$valores['pagamento'] = 2;
?>
<?php 
foreach($itens as $i) { 
	$p = ProdutoDAO::buscarPorId($i->getIdProduto());
	$total = $total + ($p->getPreco() * $i->getQuantidade());
} 
?>
<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-10" class="container-fluid">		
		<p>
			Pagamento à vista
		</p>
			<a> valor Total Compra = <?=$total?> Reais</a>						
			<a href="controle/cadastrarPedido.php?pagamento='Boleto'&id_cliente=<?=$cliente->getId()?>">
			<button class="btn btn-success">Gerar Boleto / finalizar</button></a>	
			
		<p>
			Pagamento Parcelado
		</p>
		<p>
			<label for="parcela">Parcelas</label>
			<input type="number" min="1" max="12" name="parcela" >
		</p>
		<p>valor da parcela = <?=$total?></p>
		<p>
			<input type="radio" name="cartao" id="Visa"
			value="1" required <?=($valores["cartao"]==1?"checked":"")?>>
			<label for="Visa">Visa</label>
		</p>
		<p>
			<input type="radio" name="cartao" id="MarterCard"
			value="2" <?=($valores["cartao"]==2?"checked":"")?>>
			<label for="MarterCard">MarterCard</label>
		</p>
		<p>
			<input type="radio" name="cartao" id="Maestro"
			 value="3" <?=($valores["cartao"]==3?"checked":"")?>>
			<label for="Maestro">Maestro</label>
		</p>
		<p>
			<input type="radio" name="cartao" id="ELO"
			value="4" <?=($valores["cartao"]==4?"checked":"")?>>
			<label for="ELO">ELO</label>
		</p>
		<p>
						
				<a href="controle/cadastrarPedido.php?pagamento='cartao'&id_cliente=<?=$cliente->getId()?>">
				<button class="btn btn-success">proximo</button></a>	
		
			<a href="?p=4" onclick="return confirm('Deseja Cancelar esta compra?')">cancelar</a><!-- matem os produtos no carrinho-->
		</p>
				
		
	</div>	
</div>	