<?php
if($usuario->getNivel()!="Cliente"){
	header("location: index.php");
}else{
	$trabalhos = NULL;
	if(isset($_POST['pesquisa'])){
		$pesquisa = $_POST['pesquisa'];
		$trabalhos = 
		TrabalhoDAO::buscar($pesquisa);
	}
}
?>
<form action="index.php?p=3" method="post"
	class="container">
	<div class="form-group">
		<label for="pesquisa">Pesquisa</label>
		<input type="search" name="pesquisa"
		id="pesquisa" class="form-control">
	</div>
	<button class="btn btn-info">Buscar</button>
</form>
<?php
	if($trabalhos!==NULL) {
		foreach($trabalhos as $t) {
?>
	<p>
		<?=$t->getTitulo()?>
		<a href="trabalhos/<?=$t->getArquivo()?>">
		Baixar
		</a>
	</p>
<?php
		}
	 if(sizeof($trabalhos)==0){
?>
	<p class="alert alter-warning">
		Nenhum trabalho encontrado
	</p>
<?php
		}
	}
?>
