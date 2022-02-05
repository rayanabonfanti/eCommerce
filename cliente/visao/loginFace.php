 <?php

require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");

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
		<div class="jumbotron text-center">
			<h1 class="vermelho">Login Usuário</h1>
			<p>Compras OnLine</p>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-6 ">
				<p>Esquerda</p>
			</div>
			<div class="col-md-6 col-sm-6 bg-light">
				<form action="../controle/logar.php"
				method ='POST'
				>
					
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email"
						placeholder="nome@email.com"
						class="form-control" required>
					</div>
					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="password" name="senha" id="senha"
						placeholder="sua senha"
						class="form-control"required>
					</div>					
					<button class="btn btn-success">Logar</button>					
					<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Cadastre-se</a>
				</form>					
				  <a class="nav-link" href="../index.php?p=4">voltar</a>
				
			</div>
			<!--
					FORMULARIO CADASTRO CLIENTE
				-->
			<div class="modal" id="myModal">
			  <div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Cadastro</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  <!-- Modal body -->
				  <div class="modal-body">				  
						<form action= "../controle/cadastrarCliente.php"
							method ='POST'>
						
							<div class="form-group">
								<label for="nome">Nome</label>
								<input type="text" name="nome" id="nome"
								placeholder="informe o nome"
								class="form-control"required>
							</div>
							<div class="form-group">
								<label for="cpf">Cpf: </label>
								<input type="text" name="cpf" id="cpf"
								placeholder="apenas numeros"
								class="form-control"required>
							</div>
							
							<div class="form-group">
								<label for="email">email: </label>
								<input type="email" name="email" id="email"
								placeholder="nome@email.com"
								class="form-control"required>
							</div>
							<div class="form-group">
								<label for="senha">Senha</label>
								<input type="password" name="senha" id="senha"
								placeholder="sua senha"
								class="form-control"required>
							</div>
							
							<div class="form-group">
								<label for="rua">Rua: </label>
								<input type="text" name="rua" id="rua"
								 placeholder="nome da rua"
								 class="form-control"
								>
							</div>
							<div class="form-group">
								<label for="numero">Numero: </label>
								<input type="number_format" name="numero" id="numero"
								 placeholder="numero"
								 class="form-control"
								>
							</div>
							<div class="form-group">
								<label for="cidade">Cidade: </label>
								<input type="text" name="cidade" id="cidade"
								 placeholder="informe a cidade"
								 class="form-control"
								>
							</div>
							<div class="form-group">
								<label for="estado">Estado: </label>
								<input type="text" name="estado" id="estado"
								 placeholder="siga do estado"
								 class="form-control"
								>
							</div>
							<div class="form-group">
								<label for="cep">Cep: </label>
								<input type="text" name="cep" id="cep"
								 placeholder="informe o cep"
								 class="form-control"required>
							</div>
							
							<div class="custom-control custom-switch">
								<input type="checkbox" required class="custom-control-input" id="switch2">
								<label name="aceito" class="custom-control-label" for="switch2">Aceito os termos de contrato</label>
							</div>
							<button class="btn btn-success">Cadastrar</button>
					</form>
					
				  </div>

				  <!-- Modal footer 
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				  </div>
				  -->
				</div>
			  </div>
			</div>
			<div class="col-md-3 ">
				<p>Direita em construção</p>
			</div>
		</div>
		<div class="container-fluid">
			<div class="card mx-auto">			 
			  <?php if(isset($_SESSION["mensagens"])){ ?>			  
			  <div class="card-footer">				
				<div class="alert alert-danger">
					<?=$msgLogin[$_SESSION["mensagens"]]?>
				</div>
			  </div>
			  <?php 
				unset($_SESSION["mensagens"]);
			  } 
			  ?>
		   </div>
		</div>
	</body>
</html>
