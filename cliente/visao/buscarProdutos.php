<?php
$produtos = NULL;
if(isset($_POST["pesquisa"])){
	$pesquisa = $_POST["pesquisa"];
	$produtos = ProdutoDAO::buscarPorNome($pesquisa);
}else{
	$produtos = ProdutoDAO::todos();
}
//echo "<p>".$cliente->getId()."</p>";
?>		
	<div class="row">	
		<div class="jumbotron text-center">
			<p>Produtos Encontrados</p>
		</div>
		<table>
			<tr>
				<th>foto Produto</th>
				<th>Descricação</th>
				<th>Valor</th>
				<th>Ações</th>
			</tr>
	<?php
		if($produtos!=NULL) {
			foreach($produtos as $p) {
	?>	
				<tr>
					<td>foto do produto </td>
					<td><?=$p->getDescricao();?></td>
					<td><?=$p->getPreco();?></td>
					<td><?=$p->getEstoque();?></td>
					<td>
						<?php 
						if($cliente!= null){ ?>
						<a href="controle/adicionarItemCarrinho.php?id_produto=<?=$p->getId()?>&id_cliente=<?=$cliente->getId()?>">
							Adicionar ao carrinho
						</a>
						<a href="controle/comprar.php?id_Carrinho=<?=$p->getId()?>&id_cliente=<?=$cliente->getId()?>">
							Comprar
						</a>
						<?php }else{ ?>  
							<a href="visao/loginFace.php" onclick="return confirm('necessário login?')"> Adicionar ao carrinho  </a>
						<?php }?>
					</td>				
				</tr>	
				
			<?php }
			?>
	
	</table>
	<?php
		}else{
			echo"busca vazia volte index";
			$_SESSION['mensagens'] = 5;			
			//header("location: ../index.php?");
			}
		
	?>	
	<a class="nav-link" href="?p=4">voltar</a>
	</div>
	
	
