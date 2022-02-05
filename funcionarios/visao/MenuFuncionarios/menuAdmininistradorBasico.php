<ul class="nav flex-column">	
	<center><p>Administrador Básico</p></center>
	<li class="nav-item">
		<a class="nav-link" href="index.php?p=0">Cadastra Funcionários</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="index.php?p=1">Cadastra Produtos</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="index.php?p=2">Altera/Exclui Funcionários</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="index.php?p=3">Atualiza Pedidos</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="index.php?p=4">Responde Atendimentos</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="index.php?p=5">Altera Dados Pessoais</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="index.php?p=6">***Visualizar Compra Itens</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="controle/sair.php">Sair</a>
	</li>
	<br>
</ul>

<?php
	$funcionarios = FuncionarioDAO::todos();	
	$pedidos = PedidoDAO::todos();
	$produtos = ProdutoDAO::todos();
	$atendimentos = AtendimentoDAO::todos();
?>
