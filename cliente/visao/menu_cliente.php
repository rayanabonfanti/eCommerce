<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
if($cliente->getNivel() != "cliente" ){
	header("location: ../index.php");
}
?>
<ul >
	<div >			
		<li >		
			<a href="arquivo/arquivos/<?=$cliente->getFoto_perfil()?>" target="_blank">
				<img src="arquivo/arquivos/icones/<?=$cliente->getFoto_perfil().".jpg"?>"> 
			</a>		
			<a class="nav-link" href="index.php?p=5">Alterar foto</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?p=2">alterar cadastro</a>			
		</li> 
		<li class="nav-item">
			<a class="nav-link" href="#">fazer reclamação</a>
		</li> 
		<li class="nav-item">
			<a href="#">pedidos</a>
		</li> 
		<li class="nav-item">
			<a class="nav-link" href="index.php?p=3">excluir conta</a>			
		</li> 
		<li class="nav-item">
			<a class="nav-link" href="index.php?p=4">voltar as compras</a>			
		</li> 
	</div>
</ul>
