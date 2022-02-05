<?php
$_SESSION['crfs'] = md5(time());
$id1 = $_SESSION['crfs'];
	$numero_login = $funcionario->getNumeroLogin();
	$funcionarios = FuncionarioDAO::todos();	
	$pedidos = PedidoDAO::todos();
	$produtos = ProdutoDAO::todos();
	$atendimentos = AtendimentoDAO::todos();
?>

		<div class="container-fluid">
			<div class="card mx-auto">
			  	<div class="card-header">
					<p>Cadastro de Funcionários</p>
			  	</div>
			  	<div class="card-body">				
					<form action="controle/Cadastro/Funcionarios/cadastrarFuncionario.php" method="post" class="form">
					<input type="hidden" name="crfs" value="<?=$id1?>">
						<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
						
						<div class="form-group">
							<label for="nome">Nome</label>
							<input type="text" name="nome" id="nome" class="form-control">
						</div>
						<div class="form-group">
							<label for="cpf">CPF</label>
							<input type="number" name="cpf" id="cpf" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" class="form-control">
						</div>
						<div class="form-group">
							<label for="cargo">Cargo</label>
							<input type="text" name="cargo" id="cargo" class="form-control">
						</div>
						<div class="form-group">
							<label for="nivel">Nível Hierárquico</label>
							<select class="form-control" name="nivel" id="nivel" required>
								<option value="">---</option>
								<option value="1">Funcionário Comum</option>
								<option value="2">Administrador Básico</option>
								<option value="3">Administrador RH</option>
								<option value="4">Administrador Supervisor</option>
							</select>
						</div>
						<div class="form-group">
							<label for="numero_login">Número Login</label>
							<input type="number" name="numero_login" id="numero_login" class="form-control">
						</div>
						<button class="btn btn-success">Cadastrar</button>
						<input type="reset" value="Limpar" class="btn btn-info">
					</form>	

						<!-- DIRECIONAR PARA A MESMA PÁGINA PARA MOSTRAR A MENSAGEM A SEGUIR -->
						<?php if(isset($_SESSION["mensagemCadastroFuncionario"])){ ?>							
								<div class="alert alert-danger">
									<?=$msgCadastroFuncionario[$_SESSION["mensagemCadastroFuncionario"]]?>
								</div>
							<?php 
								unset($_SESSION["mensagemCadastroFuncionario"]);
							} 
						?>

				</div>
		   	</div>
		</div>
		<br><br>

		<?php
			//require_once("importacoes.php");
			$funcionarios = FuncionarioDAO::todos();	
			$pedidos = PedidoDAO::todos();
			$produtos = ProdutoDAO::todos();
			$atendimentos = AtendimentoDAO::todos();
			$msg = array("Cadastrado","Não cadastrado");
		?>
		
		<?php
			if(isset($_GET['msg']))
			{
		?>
		<p> <?=$msg[($_GET['msg'])]?> </p>
		<?php
			}
		?>

		<div class="container">
		<table class="table table-bordered">
			<tr>
				<th>Número Login</th>
				<th>CPF</th>
				<th>Nome</th>
				<th>Email</th>
				<th>Nível Hierarquico</th>
				<th>Cargo</th>
				<th>Salário</th>	
			</tr>
			<?php
				foreach($funcionarios as $f)
				{
			?>
			<tr>
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
		<br>		
		</div>