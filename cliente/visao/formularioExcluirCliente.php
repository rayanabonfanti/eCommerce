<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
if($cliente->getNivel() != "cliente" ){
	header("location: ../index.php");
}
?>
	<form action="controle/excluirCliente.php"
	  method="post">
		<input type="hidden" name="id" 
		value="<?=$cliente->getId()?>">
		<button>confirmar exclusão</button>	
		<a class="nav-link" href="index.php?p=4">Cancelar Exclusão</a>
	</form>
	
<?php if(isset($_GET['msg']) ) { ?>
<p> <?=$$msgCadastro[ $_GET['msg'] ]?> </p>
<?php } ?>
