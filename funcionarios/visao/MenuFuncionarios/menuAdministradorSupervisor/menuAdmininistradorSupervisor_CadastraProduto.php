<?php
$_SESSION['crfs'] = md5(time());
$id1 = $_SESSION['crfs'];
	$numero_login = $funcionario->getNumeroLogin();	
	$funcionarios = FuncionarioDAO::todos();	
	$pedidos = PedidoDAO::todos();
	$produtos = ProdutoDAO::todos();
	$atendimentos = AtendimentoDAO::todos();	
?>

		<script>
			function alterar(id,nome_id)
			{
				campo = document.getElementById(nome_id);
				campo.value = id;
				return confirm('Deseja alterar?');
			}
		</script>

		<div class="container-fluid">
			<div class="card mx-auto">
			  	<div class="card-header">
					<p>Cadastro de Produtos</p>
			  	</div>
			  	<div class="card-body">				
					<form action="controle/Cadastro/Produto/cadastrarProduto.php" method="post" class="form" enctype="multipart/form-data">
					<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
					<input type="hidden" name="crfs" value="<?=$id1?>">
						<div class="form-group">
							<label for="preco">Preço</label>
							<input type="text" name="preco" id="preco" class="form-control">
						</div>
						<div class="form-group">
							<label for="descricao">Descrição</label>
							<input type="text" name="descricao" id="descricao" class="form-control">
						</div>
						<div class="form-group">
							<label for="estoque">Estoque</label>
							<input type="number" name="estoque" id="estoque" class="form-control">
						</div>
						<div class="form-group">
							<label for="ativo">Ativo?</label>
							<select class="form-control" name="ativo" id="ativo" required>
								<option value="">---</option>
								<option value="1">Sim</option>
								<option value="2">Não</option>
							</select>
						</div>						
										<div class="form-group">
											<label for="nome">Nome do arquivo</label>
											<input type="text" name="nome" id="nome" class="form-control">
										</div>
										<div class="form-group">
											<label for="arquivo">Arquivo</label>
											<input type="file" name="arquivo" id="arquivo" accept=".png">
										</div>
						<button class="btn btn-success">Cadastrar</button>
						<input type="reset" value="Limpar" class="btn btn-info">
					</form>	  
				</div>
		   	</div>
		</div>
		<br>
		
						<?php if(isset($_SESSION["mensagemInseridoProduto"])){ ?>
						<div class="card-footer">
							<div class="alert alert-danger">
								<?=$mensagemInseridoProduto[$_SESSION["mensagemInseridoProduto"]]?>
							</div>
						</div>
						<?php 
							unset($_SESSION["mensagemInseridoProduto"]);
						} 
						?>
						<br>

		<div class="container">
		<table class="table table-bordered">
			<tr>
				<th>Excluir Produto</th>
				<th>Alterar Preço</th>
				<th>Alterar Descrição</th>
				<th>Alterar Ativo/Inativo</th>
				<th>Adicionar mais fotos</th>
				<th>ID</th>
				<th>Preço</th>	
				<th>Descrição</th>
				<th>Estoque</th>
				<th>Ativo</th>
				<th>Foto de Perfil</th>
				<th>Outras Fotos</th>
			</tr>
			<?php
				foreach($produtos as $f)
				{
			?>
			<tr>
				<td>
					<a href="controle/Exclusao/Produto/excluirProduto.php?id=<?=$f->getID();?>&numero_login_s=<?=$numero_login?>" onclick="return confirm('Deseja excluir?')">
						excluir
					</a>
				</td>
				<td>
					<a href="#" onclick="return alterar(<?=$f->getID();?>,'id1')" data-toggle="modal" data-target="#myModal1">
						alterar
					</a>
				</td>
				<td>
					<a href="#" onclick="return alterar(<?=$f->getID();?>,'id2')" data-toggle="modal" data-target="#myModal2">
						alterar
					</a>
				</td>
				<td>
					<a href="controle/Alteracao/Produto/alterarAtivoProduto.php?id=<?=$f->getID();?>&ativo=<?=$f->getAtivo();?>&numero_login_s=<?=$numero_login?>" onclick="return confirm('Deseja alterar?')">
						alterar
					</a>
				</td>
				<td>
					<a href="#" onclick="return alterar(<?=$f->getID();?>,'id3')" data-toggle="modal" data-target="#myModal3">
						adicionar foto
					</a>
				</td>
				<td><?=$f->getID();?></td>
				<td><?=$f->getPreco();?></td>
				<td><?=$f->getDescricao();?></td>
				<td><?=$f->getEstoque();?></td>
				<td>
					<?php
						if($f->getAtivo() == 1)
						{
							?>
							Ativo
							<?php
						}
						else if ($f->getAtivo() == 0)
						{
							?>
							Desativo
							<?php
						}
						?>
				</td>
				<?php
					$arquivos = ArquivoProdutoDAO::buscarPorProduto($f->getID());
					foreach($arquivos as $ar)
					{
						if($ar->getEndereco() == $f->getFoto())
						{							
				?>
				<td>
					<a class="nav-link" href="arquivos/<?=$ar->getEndereco()?>" target="_blank">
						<img src="arquivos/icones/<?=$ar->getIcone()?>">
					</a>
				</td>	
				<?php
						}
						else 
						{
				?>
				<td>
					<a class="nav-link" href="arquivos/<?=$ar->getEndereco()?>" target="_blank">
						<img src="arquivos/icones/<?=$ar->getIcone()?>">
					</a>
				</td>	
				<?php
				
						}
				?>				
				<?php
					}
				?>
			</tr>
			<?php
				}
			?>
		</table>

						<?php if(isset($_SESSION["mensagemAlteracaoProduto"])){ ?>
						<div class="card-footer">
							<div class="alert alert-danger">
								<?=$mensagemAlteracaoProduto[$_SESSION["mensagemAlteracaoProduto"]]?>
							</div>
						</div>
						<?php 
							unset($_SESSION["mensagemAlteracaoProduto"]);
						} 
						?>
						<br>

		</div>

		<div class="modal" id="myModal1">
		    <div class="modal-dialog">
				<div class="modal-content">

				  <div class="modal-header">
					<h4 class="modal-title">Alterar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  		<div class="modal-body">
							<div class="card-body">				
								<form action="controle/Alteracao/Produto/alterarPrecoProduto.php" method="post" class="form">
								<input type="hidden" name="crfs" value="<?=$id1?>">
								<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
									<input type="hidden" name="id" value="0" id="id1"> 
									<div class="form-group">
										<label>Digite o preço</label>
										<input type="text" name="preco" id="preco" class="form-control">
									</div>
									<button class="btn btn-success">Enviar</button>
								</form>
							</div>				
				  
			  			</div>
				</div>
			</div>
		</div>

		<div class="modal" id="myModal2">
		    <div class="modal-dialog">
				<div class="modal-content">

				  <div class="modal-header">
					<h4 class="modal-title">Alterar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  		<div class="modal-body">
							<div class="card-body">				
							<form action="controle/Alteracao/Produto/alterarDescricaoProduto.php" method="post" class="form">
							<input type="hidden" name="crfs" value="<?=$id1?>">
							<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
									<input type="hidden" name="id" value="0" id="id2"> 
									<div class="form-group">
										<label>Digite o descrição</label>
										<input type="text" name="descricao" id="descricao" class="form-control">
									</div>
									<button class="btn btn-success">Enviar</button>
								</form>
							</div>				
				  
			  			</div>
				</div>
			</div>
		</div>

		<div class="modal" id="myModal3">
		    <div class="modal-dialog">
				<div class="modal-content">

				  <div class="modal-header">
					<h4 class="modal-title">Alterar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  		<div class="modal-body">
							<div class="card-body">				
							
							<form action="controle/Cadastro/Produto/cadastrarArquivoProduto.php" method="post" class="form" enctype="multipart/form-data">		
							<input type="hidden" name="crfs" value="<?=$id1?>">
							<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 				
								<input type="hidden" name="id" value="0" id="id3"> 
										<div class="form-group">
											<label for="nome">Nome do arquivo</label>
											<input type="text" name="nome" id="nome" class="form-control">
										</div>
										<div class="form-group">
											<label for="arquivo">Arquivo</label>
											<input type="file" name="arquivo" id="arquivo" accept=".png">
										</div>
									<button class="btn btn-success">Cadastrar</button>
								<input type="reset" value="Limpar" class="btn btn-info">
							</form>	

							</div>								  
			  			</div>
				</div>
			</div>
		</div>