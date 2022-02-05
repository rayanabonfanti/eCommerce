<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
if($cliente->getNivel() != "cliente" ){
	header("location: ../index.php");
}
?>
		<form action="controle/alterarCliente.php"
		  method="post">
			<p>
				<label for="nome">Nome: </label>
				<input type="text" name="nome" id="nome"
				value="<?=$cliente->getNome()?>"
				>
			</p>	
			<p>
				<label for="cpf">Cpf: </label>
				<input type="number_format" name="cpf" id="cpf"
				value="<?=$cliente->getCpf()?>"
				>
			</p>
			<p>
				<label for="email">email: </label>
				<input type="email" name="email" id="email"
				value="<?=$cliente->getEmail()?>"
				>
			</p>
			
			<p>
				<input type="hidden" name="nivel" id="nivel"
				value="<?=$cliente->getNivel()?>"
				>
			</p>
			<p>
				<label for="rua">Rua: </label>
				<input type="text" name="rua" id="rua"
				 value="<?=$cliente->getEndereco()->getRua()?>"
				>
			</p>
				<p>
				<label for="numero">Numero: </label>
				<input type="number_format" name="numero" id="numero"
				   value="<?=$cliente->getEndereco()->getNumero()?>"
				>
			</p>
			<p>
				<label for="cidade">Cidade: </label>
				<input type="text" name="cidade" id="cidade"
				   value="<?=$cliente->getEndereco()->getCidade()?>"
				>
			</p>
			<p>
				<label for="estado">Estado: </label>
				<input type="text" name="estado" id="estado"
				   value="<?=$cliente->getEndereco()->getEstado()?>"
				>
			</p>
			<p>
				<label for="cep">Cep: </label>
				<input type="text" name="cep" id="cep"
				   value="<?=$cliente->getEndereco()->getCep()?>"
				>
			</p>
			
			<input type="hidden" foto_perfil="id" value="<?=$cliente->getFoto_perfil()?>">
			
			<input type="hidden" name="id" value="<?=$cliente->getId()?>">
			
			<button>Salvar Alterações</button>
			<a class="nav-link" href="index.php?p=1">Voltar</a>
		</form>
		
			<?php if(isset($_GET['msg']) ) { ?>
			<p> <?=$$msgCadastro[ $_GET['msg'] ]?> </p>
			<?php } ?>
