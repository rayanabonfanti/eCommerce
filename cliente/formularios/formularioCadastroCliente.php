<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
$clientes = ClienteDAO::todos();
?>
<html>
	<head>
		<meta charset="uft-8">
		<title> Cadastro de Cliente </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<form action="controle/cadastrarCliente.php"
		  method="post">
			<p>
				<label for="nome">Nome: </label>
				<input type="text" name="nome" id="nome"
				placeholder="informe o nome"
				>
			</p>
			<p>
				<label for="cpf">Cpf: </label>
				<input type="text" name="cpf" id="cpf"
				placeholder="apenas numeros"
				>
			</p>
			<p>
				<label for="email">email: </label>
				<input type="email" name="email" id="email"
				placeholder="nome@email.com"
				>
			</p>
			<p>
				<label for="senha">Senha: </label>
				<input type="password" name="senha" id="senha"
				placeholder="sua senha"
				>
			</p>
			<p>
				<label for="rua">Rua: </label>
				<input type="text" name="rua" id="rua"
				 placeholder="nome da rua"
				 >
			</p>
			<p>
				<label for="numero">Numero: </label>
				<input type="number_format" name="numero" id="numero"
				 placeholder="numero"
				 >
			</p>
			<p>
				<label for="cidade">Cidade: </label>
				<input type="text" name="cidade" id="cidade"
				 placeholder="informe a cidade"
				 >
			</p>
			<p>
				<label for="estado">Estado: </label>
				<input type="text" name="estado" id="estado"
				 placeholder="siga do estado"
				 >
			</p>
			<p>
				<label for="cep">Cep: </label>
				<input type="text" name="cep" id="cep"
				 placeholder="informe o cep"
				 >
			</p>
			<button>Salvar</button>
			
		</form>
		<?php if(isset($_GET['msg']) ) { ?>
			<p> <?=$msg[ $_GET['msg'] ]?> </p>
		<?php } ?>
		<table>
			<tr>
				<th>Nome</th>
				<th>Rua</th>
				<th>Ação</th>
			</tr>
			
			<?php foreach($clientes as $c) { ?><!-- codigo php para percorrer o array de clientes-->
			<tr><!-- tag inicia a escita de daddos na tabela de clientes supra descrita-->
				<td><?=$c?></td>
				<td><?=$c->getNome()?></td><!-- tag escrevi (c.getNome()) o nome clientes contidos no array-->
				<td><?=$c->getEndereco()->getRua()?></td>
				<td>
				<!-- teg <a</a> a seguir cria um butão adjunto e se referencia ao metodo
	 				excluirUsuario passando o Id do usuario da vez-->
					<a href="controle/excluirCliente.php?id=<?=$c->getId()?>"
					onclick="return confirm('Deseja excluir?')">
						excluir
					</a>
					<a href="formularioPreenchidoAlterarCliente.php?id=<?=$c->getId();?>">
							alterar
						</a>
				</td>
			</tr>	
			<?php } ?><!-- codigo php fim percorrida do array de clientes-->
		</table>
	</body>
</html>