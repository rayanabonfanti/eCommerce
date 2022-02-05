<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
?>
<form action="arquivo/controle/uploadArquivo.php?id=<?=$cliente->getId()?>"
	method="post"
	enctype="multipart/form-data">
	
		<div class="form-group">				
			<label for="nome">Nome do arquivo</label>
			<input type="text" name="nome" id="nome">
		</div>
		<div class="form-group">
			<label for="arquivo">Arquivo</label>
			<input type="file" name="arquivo"
			id="arquivo" accept=".png">
		</div>		
		<button>Enviar</button>		
</form>

	<ul>
	<?php
		$arquivos = ArquivoClienteDAO::buscarPorIdCliente($cliente->getId());
		foreach($arquivos as $ar)
		{
	?>
			<li>				
				<a href="arquivo/arquivos/<?=$ar->getEndereco()?>" target="_blank">
					<img src="arquivo/arquivos/icones/<?=$ar->getIcone()?>">
				</a>
				<a href="arquivo/controle/excluirArquivo.php?id=<?=$ar->getId()?>&id_cliente=<?=$cliente->getId()?> ">
					Excluir
				</a>
				<a href="controle/DefinirFotoPerfil.php?icone=<?=$ar->getEndereco()?>">
					Definir foto perfil
				</a>
			</li>
	<?php
		}			
	?>
	<a class="nav-link" href="index.php?p=4">Voltar as compras</a>		
	</ul>