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
			function responder(id){
				campo = document.getElementById('id');
				campo.value = id;
				return confirm('Deseja responder?');
			}
		</script>
		<div class="container">
		<h3>Responde Atendimentos</h3>
		<table class="table table-bordered">
			<tr>
				<th>Responder</th>		
				<th>ID</th>	
				<th>CPF do Cliente</th>
				<th>ID do Pedido</th>
				<th>Número Login do Funcionário</th>
				<th>Pergunta</th>
				<th>Resposta</th>
			</tr>
			<?php
				foreach($atendimentos as $f)
				{
			?>
			<tr>
				<td>
				<a href="#" onclick="return responder(<?=$f->getID();?>)" data-toggle="modal" data-target="#myModal">
					responder
					</a>
				</td>	
				<td><?=$f->getID();?></td>	
				<td><?=$f->getCpf_cliente_login();?></td>
				<td><?=$f->getId_pedido();?></td>
				<td><?=$f->getNumero_login_funcionario();?></td>
				<td><?=$f->getPergunta();?></td>
				<td><?=$f->getResposta();?></td>
			</tr>
			<?php
				}
			?>
		</table>
		
						<?php if(isset($_SESSION["mensagemRespondeAtendimento"])){ ?>
						<div class="card-footer">
							<div class="alert alert-danger">
								<?=$mensagemRespondeAtendimento[$_SESSION["mensagemRespondeAtendimento"]]?>
							</div>
						</div>
						<?php 
							unset($_SESSION["mensagemRespondeAtendimento"]);
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
							<form action="controle/Alteracao/Atendimento/respondeAtendimento.php" method="post" class="form">
							<input type="hidden" name="crfs" value="<?=$id1?>">
							<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
								<input type="hidden" name="id" value="0" id="id"> 
								<input type="hidden" name="numero_login" value="<?=$numero_login?>" id="numero_login"> 
								<div class="form-group">
									<label>Resposta</label>
									<input type="text" name="resposta" id="resposta" class="form-control">
								</div>
								<button class="btn btn-success">Enviar</button>
								<input type="reset" value="Limpar" class="btn btn-info">
							</form>
						</div>				
				  </div>
			  </div>
		  </div>		  
		</div>