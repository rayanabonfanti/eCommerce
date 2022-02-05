<ul class="nav flex-column">	
	<center><p>Administrador RH</p></center>
	<li class="nav-item">
		<a class="nav-link" href="index.php?p=0">Altera Salário de Funcionários</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="index.php?p=1">Cadastrar Funcionários</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="index.php?p=2">Altera Dados Pessoais</a>
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
