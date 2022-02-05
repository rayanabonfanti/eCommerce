<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
if($cliente->getNivel() != "cliente" ){
	header("location: ../index.php");
}
?>
		<form action="usuario/controle/alterarCliente.php"
		  method="post">
			<p>
				<label for="nome">Nome: </label>
				<input type="text" name="nome" id="nome"
				placeholder="<?=$cliente->getNome()?>"
				>
			</p>	
			<p>
				<label for="cpf">Cpf: </label>
				<input type="number_format" name="cpf" id="cpf"
				placeholder="<?=$cliente->getCpf()?>"
				>
			</p>
			<p>
				<label for="email">email: </label>
				<input type="email" name="email" id="email"
				placeholder="<?=$cliente->getEmail()?>"
				>
			</p>
			<p>
				<label for="senha">Senha: </label>
				<input type="password" name="senha" id="senha"
				placeholder="nova senha"
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
				 placeholder="<?=$cliente->getEndereco()->getRua()?>"
				>
			</p>
				<p>
				<label for="numero">Numero: </label>
				<input type="number_format" name="numero" id="numero"
				   placeholder="<?=$cliente->getEndereco()->getNumero()?>"
				>
			</p>
			<p>
				<label for="cidade">Cidade: </label>
				<input type="text" name="cidade" id="cidade"
				   placeholder="<?=$cliente->getEndereco()->getCidade()?>"
				>
			</p>
			<p>
				<label for="estado">Estado: </label>
				<input type="text" name="estado" id="estado"
				   placeholder="<?=$cliente->getEndereco()->getEstado()?>"
				>
			</p>
			<p>
				<label for="cep">Cep: </label>
				<input type="text" name="cep" id="cep"
				   placeholder="<?=$cliente->getEndereco()->getCep()?>"
				>
			</p>
			<input type="hidden" name="id" 
			    value="<?=$cliente->getId()?>">
			<button>Salvar Alterações</button>
		</form>
		
			<?php if(isset($_GET['msg']) ) { ?>
			<p> <?=$$msgCadastro[ $_GET['msg'] ]?> </p>
			<?php } ?>
