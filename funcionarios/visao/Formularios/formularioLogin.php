<?php
$_SESSION['crfs'] = md5(time());
$id1 = $_SESSION['crfs'];
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Acesso ao sistema</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br>
		<div class="container-fluid">
			<div class="card mx-auto">
			  <div class="card-header">
				<p>Sistema de Funcionários</p>
			  </div>
			  <div class="card-body">				
				<form action="controle/logar.php" method="post" class="form">
					<input type="hidden" name="crfs" value="<?=$id1?>">
					<div class="form-group">
						<label for="numero_login">Login</label>
						<input type="number" name="numero_login" id="numero_login" class="form-control">
					</div>
					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="password" name="senha" id="senha" class="form-control">
					</div>
					<button class="btn btn-success">Logar</button>
					<input type="reset" value="Limpar" class="btn btn-info">
				</form>
				<?php
					require_once("importacoes.php");
					$funcionarios = FuncionarioDAO::todos();
						if($funcionarios==NULL)
						{ 
				?>
					<div class="form-group">
						<a href="#" data-toggle="modal" data-target="#myModal">Cadastrar</a>
					</div>
				<?php		
						}
				?>
				
				</div>
						<?php if(isset($_SESSION["mensagemLoginFuncionario"])){ ?>
						<div class="card-footer">
							<div class="alert alert-danger">
								<?=$msgLogar[$_SESSION["mensagemLoginFuncionario"]]?>
							</div>
						</div>
						<?php 
							unset($_SESSION["mensagemLoginFuncionario"]);
						} 
						?>	
						
						<?php if(isset($_SESSION["mensagemCadastroSupervisorFuncionario"])){ ?>
						<div class="card-footer">
							<div class="alert alert-danger">
								<?=$mensagemCadastroSupervisorFuncionario[$_SESSION["mensagemCadastroSupervisorFuncionario"]]?>
							</div>
						</div>
						<?php 
							unset($_SESSION["mensagemCadastroSupervisorFuncionario"]);
						} 
						?>			  
				</div>
		   <br>
		</div>

		<div class="modal" id="myModal">
		  <div class="modal-dialog">
				<div class="modal-content">

				  <div class="modal-header">
					<h4 class="modal-title">Cadastro</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  <div class="modal-body">
							<div class="card-body">				
						<form action="controle/Cadastro/FuncionarioSupervisor/cadastrarPrimeiroFuncionario.php" method="post" class="form">
							<input type="hidden" name="crfs" value="<?=$id1?>">
							<input type="hidden" name="nivel" value="4" class="form-control">
							<input type="hidden" name="senha" value="" class="form-control">
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
								<label for="numero_login">Número Login</label>
								<input type="number" name="numero_login" id="numero_login" class="form-control">
							</div>
							<button class="btn btn-success">Enviar</button>
						</form> 
						</div>				
				  </div>
			  </div>
		  </div>
		</div>


	</body>
</html>



