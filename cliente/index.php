<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	
if(!isset($_SESSION["cliente"])){	
	$cliente = null;	
}else{
	$cliente = unserialize($_SESSION["cliente"]);		
}
if(isset($_GET['p']) && isset( $pag[ $_GET['p'] ] )){
	$pagina = $pag[ $_GET['p'] ];
}else{
	$pagina = $pag['4'];
}

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Compas</title>		
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>		
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script>
			jQuery(document).ready(function($) {
			 
				$('#myCarousel').carousel({
						interval: 5000
				});
		 
				//$('#carousel-text').html($('#slide-content-0').html());
		 
				//Handles the carousel thumbnails
			   $('[id^=carousel-selector-]').click( function(){
					var id = this.id.substr(this.id.lastIndexOf("-") + 1);
					var id = parseInt(id);
					$('#myCarousel').carousel(id);
				});
		 
		 
				// When the carousel slides, auto update the text
				$('#myCarousel').on('slid.bs.carousel', function (e) {
						 var id = $('.item.active').data('slide-number');
						//$('#carousel-text').html($('#slide-content-'+id).html());
				});
			});


        </script>
		
		
				
	</head>
	<body>	
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				  </button>
					  <a class="navbar-brand" href="#">Compras OnLine</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
				  <ul class="nav navbar-nav">
					<li class="nav-item"><a class="nav-link" href="index.php?p=4">Inicio</a></li>
					<li class="dropdown">
					  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
					  <ul class="dropdown-menu">
						<li><a href="#">Page 1-1</a></li>
						<li><a href="#">Page 1-2</a></li>
						<li><a href="#">Page 1-3</a></li>
					  </ul>
					</li>
					<li><a href="#">Page 2</a></li>
					<li><a href="#">Page 3</a></li>
				  </ul>
				  
				  <form action="index.php?p=6" method="post" class="form-inline " class="container">
					<div class="form-group">
						<label for="pesquisa"></label>
						<input type="search" name="pesquisa"
						id="pesquisa" class="form-control"
						placeholder="buscar produto"> 
					</div>
					<button class="btn btn-info">Buscar</button>
				</form>			
				  				  
				  <ul class="nav navbar-right">
					<?php
						if($cliente!=null){						
							if($cliente->getNivel()=="cliente"){ 
					?>		<div class="form-inline">								
								<li class="nav-item">
									<a class="nav-link" href="index.php?p=7"><span class="glyphicon glyphicon-shopping-cart"></span>
											<?php
											$quantidade = 0;
											$itens = CarrinhoDAO::buscarPorIdCliente($cliente->getId()); 
											foreach($itens as $i) {
												$quantidade = $quantidade+ $i->getQuantidade();
											}
											
											if($quantidade > 0){?>
												<a><?=$quantidade?> - </a>
											<?php
											}else{?>
												<a>vazio - </a>
											<?php
											}
											?>
											
									</a>
									<a class="nav-link" href="?p=5"> <?=$cliente->getNome();?> </a>
									<a class="nav-link" href="controle/sair.php"> - Sign Up</a>								
								</li>
						
					<?php
							}
						}else{ 
					?>
						<div class="form-inline ">	
							<li class="nav-item"> 
								<a class="nav-link" href="visao/loginFace.php"><span class="glyphicon glyphicon-user"></span>Login</a>
							</li>	
						</div>
					<?php
						}					
					?>					
				  </ul>
				</div>
			</div>			
		</nav>			

		<div class="row">
			<div class="col-md-2">
				<?php
					if($cliente!=null){						
						if($cliente->getNivel()=="cliente"){
							include("visao/menu_cliente.php");
						}
					}
					
				?>
			</div>
			<div class="col-md-10" class="container-fluid">			
				<?php
					if($pagina != ""){
						include("visao/".$pagina);
					}
				?>
			</div>			
		</div>	
		<div class="row">
			<?php
				include("visao/menu_vendas.php");
			?>		
		</div>	
		<div class="jumbotron mx-auto text-center">
			<h6>Copright da página</h6>
		</div>		
	</body>
</html>
