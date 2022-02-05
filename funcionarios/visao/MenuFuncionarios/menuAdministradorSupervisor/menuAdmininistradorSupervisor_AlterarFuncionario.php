<?php
$_SESSION['crfs'] = md5(time());
$id1 = $_SESSION['crfs'];
	$numero_login = $funcionario->getNumeroLogin();
	$funcionarios = FuncionarioDAO::todosExcetoEleMesmo($numero_login);
	$pedidos = PedidoDAO::todos();
	$produtos = ProdutoDAO::todos();
	$atendimentos = AtendimentoDAO::todos();
?>

		<script>
			function alterar(numero_login,nome_numero_login)
			{
				campo = document.getElementById(nome_numero_login);
				campo.value = numero_login;
				return confirm('Deseja alterar?');
			}
		</script>

		<div class="container">
		<h3>Alterar número do Funcionários</h3>
		<table class="table table-bordered">
			<tr>
				<th>Alterar Salário</th>
				<th>Alterar Número Login</th>
				<th>Alterar Cargo</th>
				<th>Alterar Nível</th>
				<th>Excluir Funcionário</th>
				<th>Número Login</th>
				<th>CPF</th>
				<th>Nome</th>
				<th>Email</th>
				<th>Nível Hierárquico</th>
				<th>Cargo</th>
				<th>Salário</th>	
			</tr>
			<?php
				foreach($funcionarios as $f)
				{
			?>
			<tr>
				<td>
					<a href="#" onclick="return alterar(<?=$f->getNumeroLogin();?>,'numero_login1')" data-toggle="modal" data-target="#myModal1">
						alterar
					</a>
				</td>
				<td>
					<a href="#" onclick="return alterar(<?=$f->getNumeroLogin();?>,'numero_login2')" data-toggle="modal" data-target="#myModal2">
						alterar
					</a>
				</td>
				<td>
					<a href="#" onclick="return alterar(<?=$f->getNumeroLogin();?>,'numero_login3')" data-toggle="modal" data-target="#myModal3">
						alterar
					</a>
				</td>
				<td>
					<a href="#" onclick="return alterar(<?=$f->getNumeroLogin();?>,'numero_login4')" data-toggle="modal" data-target="#myModal4">
						alterar
					</a>
				</td>		
				<td>
					<a href="controle/Exclusao/Funcionario/excluirFuncionario.php?numero_login=<?=$f->getNumeroLogin();?>&numero_login_s=<?=$numero_login?>" onclick="return confirm('Deseja excluir?')">
						excluir
					</a>
				</td>
				<td><?=$f->getNumeroLogin();?></td>
				<td><?=$f->getCpf();?></td>
				<td><?=$f->getNome();?></td>
				<td><?=$f->getEmail();?></td>
				<td><?=$f->getNivelHierarquico();?></td>
				<td><?=$f->getCargo();?></td>		
				<td><?=$f->getSalario();?></td>
			</tr>
			<?php
				}
			?>
		</table>

						<?php if(isset($_SESSION["mensagemAlteracaoFuncionario"])){ ?>
						<div class="card-footer">
							<div class="alert alert-danger">
								<?=$mensagemAlteracaoFuncionario[$_SESSION["mensagemAlteracaoFuncionario"]]?>
							</div>
						</div>
						<?php 
							unset($_SESSION["mensagemAlteracaoFuncionario"]);
						} 
						?>

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
								<form action="controle/Alteracao/Funcionario/alterarSalario.php" method="post" class="form">
								<input type="hidden" name="crfs" value="<?=$id1?>">
								<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
									<input type="hidden" name="numero_login" value="0" id="numero_login1"> 
									<div class="form-group">
										<label>Digite o salário</label>
										<input type="text" name="salario" id="salario" class="form-control">
									</div>
									<button class="btn btn-success">Enviar</button>
									<input type="reset" value="Limpar" class="btn btn-info">
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
								<form action="controle/Alteracao/Funcionario/alterarNumeroLogin.php" method="post" class="form">
								<input type="hidden" name="crfs" value="<?=$id1?>">
								<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
									<input type="hidden" name="numero_login" value="0" id="numero_login2"> 
									<div class="form-group">
										<label>Digite o número login</label>
										<input type="number" name="numero_login_novo" id="numero_login_novo" class="form-control">
									</div>
									<button class="btn btn-success">Enviar</button>
									<input type="reset" value="Limpar" class="btn btn-info">
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
								<form action="controle/Alteracao/Funcionario/alterarCargo.php" method="post" class="form">
								<input type="hidden" name="crfs" value="<?=$id1?>">
								<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
									<input type="hidden" name="numero_login" value="0" id="numero_login3"> 
									<div class="form-group">
										<label>Digite o cargo</label>
										<input type="text" name="cargo" id="cargo" class="form-control">
									</div>
									<button class="btn btn-success">Enviar</button>
									<input type="reset" value="Limpar" class="btn btn-info">
								</form>
							</div>				
				  
			  			</div>
				</div>
			</div>
		</div>

		<div class="modal" id="myModal4">
		    <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h4 class="modal-title">Alterar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  		<div class="modal-body">
							<div class="card-body">				
								<form action="controle/Alteracao/Funcionario/alterarNivel.php" method="post" class="form">
								<input type="hidden" name="crfs" value="<?=$id1?>">
								<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
									<input type="hidden" name="numero_login" value="0" id="numero_login4"> 
									<div class="form-group">
										<label for="nivel">Nível Hierarquico</label>
										<select class="form-control" name="nivel" id="nivel" required>
											<option value="">---</option>
											<option value="1">Funcionário Comum</option>
											<option value="2">Administrador Básico</option>
											<option value="3">Administrador RH</option>
											<option value="4">Administrador Supervisor</option>
										</select>
									</div>
									<button class="btn btn-success">Enviar</button>
									<input type="reset" value="Limpar" class="btn btn-info">
								</form>
							</div>								  
			  			</div>
				</div>
			</div>
		</div>