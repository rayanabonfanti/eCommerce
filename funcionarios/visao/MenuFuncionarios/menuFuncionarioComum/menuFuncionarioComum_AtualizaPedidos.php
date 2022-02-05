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
			function alterar(id){
				campo = document.getElementById('id');
				campo.value = id;
				return confirm('Deseja alterar?');
			}
		</script>

		
		<div class="container">
		<h3>Atualizar Pedidos</h3>
		<table class="table table-bordered">
			<tr>
				<th>ID</th>	
				<th>Status</th>
				<th>Forma de Pagamento</th>
				<th>CPF do Cliente</th>			
				<th>Atualizar status</th>	
			</tr>
			<?php
				foreach($pedidos as $p)
				{
			?>
			<tr>
				<td><?=$p->getID();?></td>
				<td><?=$p->getStatusAtualizacao();?></td>
				<td><?=$p->getFormaPagamento();?></td>
				<td><?=$p->getPedido_id_cliente();?></td>
				<td>
					<a href="#" onclick="return alterar(<?=$p->getID();?>)" data-toggle="modal" data-target="#myModal">
					alterar
					</a>
				</td>
			</tr>
			<?php
				}
			?>
		</table>
		
						<?php if(isset($_SESSION["mensagemAlteracaoStatusPedido"])){ ?>
						<div class="card-footer">
							<div class="alert alert-danger">
								<?=$mensagemAlteracaoStatusPedido[$_SESSION["mensagemAlteracaoStatusPedido"]]?>
							</div>
						</div>
						<?php 
							unset($_SESSION["mensagemAlteracaoStatusPedido"]);
						} 
						?>
		
		</div>

		<div class="modal" id="myModal">
		  <div class="modal-dialog">
				<div class="modal-content">

				  <div class="modal-header">
					<h4 class="modal-title">Alterar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  <div class="modal-body">
							<div class="card-body">				
							<form action="controle/Alteracao/Pedido/alterarStatusPedido.php" method="post" class="form">
							<input type="hidden" name="crfs" value="<?=$id1?>">
							<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
								<input type="hidden" name="id" value="0" id="id"> 
								<div class="form-group">
									<label>Status</label>
									<input type="text" name="status_atualizacao" id="status_atualizacao" class="form-control">
								</div>
								<button class="btn btn-success">Enviar</button>
								<input type="reset" value="Limpar" class="btn btn-info">
							</form>
						</div>				
				  </div>
			  </div>
		  </div>
		</div>
