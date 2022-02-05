<?php
if($usuario->getNivel()!="Administrador"){
	header("location: index.php");
}
?>
<p>
	Cadastrar Trabalho
</p>
