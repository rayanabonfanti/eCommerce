<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	$pagina = "";
	if(isset($_SESSION['funcionario']))
	{
		$funcionario = unserialize($_SESSION['funcionario']);
		if($funcionario->getNivelHierarquico() == "Administrador_Supervisor" && $pagina == "" && isset($_GET['p']) && isset( $pagSupervisor[ $_GET['p'] ] ))
		{
			$pagina = $pagSupervisor[ $_GET['p'] ];
		}
		if($funcionario->getNivelHierarquico() == "Administrador_Basico" && $pagina == "" &&  isset($_GET['p']) && isset( $pagBasico[ $_GET['p'] ] ))
		{
			$pagina = $pagBasico[ $_GET['p'] ];
		}
		if($funcionario->getNivelHierarquico() == "Funcionario_Comum" && $pagina == "" && isset($_GET['p']) && isset( $pagComum[ $_GET['p'] ] ))
		{
			$pagina = $pagComum[ $_GET['p'] ];
		}
		if($funcionario->getNivelHierarquico() == "Administrador_RH" && $pagina == "" && isset($_GET['p']) && isset( $pagRH[ $_GET['p'] ] ))
		{
			$pagina = $pagRH[ $_GET['p'] ];
		}
	}
	else
	{
		$funcionario = NULL;
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Exemplo de página</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="jumbotron">
			<h1>Comércio Eletrônico</h1>
			<p></p>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?php 
					if($funcionario==NULL)
					{ 
						include("visao/Formularios/formularioLogin.php");
					}
					else
					{
						if($funcionario->getNivelHierarquico()==Funcionario::FUNCIONARIOCOMUM)
						{
							include("visao/MenuFuncionarios/menuFuncionarioComum.php");
						}
						else if($funcionario->getNivelHierarquico()==Funcionario::ADMINISTRADORBASICO)
						{
							include("visao/MenuFuncionarios/menuAdmininistradorBasico.php");
						}
						else if($funcionario->getNivelHierarquico()==Funcionario::ADMINISTRADORRH)
						{
							include("visao/MenuFuncionarios/menuAdmininistradorRH.php");
						}
						else if($funcionario->getNivelHierarquico()==Funcionario::ADMINISTRADORSUPERVISOR)
						{
							include("visao/MenuFuncionarios/menuAdmininistradorSupervisor.php");
						}
						else
						{
							echo "<p> nenhum nível hierarquico no banco de dados encontrado </p>";
						}
					}
				?>
			</div>
			<div class="col-md-6">
				<?php 
					if($pagina != "")
					{
						include("visao/MenuFuncionarios/".$pagina);
					}
				?>
			</div>
			<div class="col-md-3">
			</div>
		</div>
		<div class="jumbotron mx-auto text-center">
			<h6>Copright da página</h6>
		</div>
	</body>
</html>