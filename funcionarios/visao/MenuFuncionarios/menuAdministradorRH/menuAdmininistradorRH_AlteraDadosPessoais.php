<?php
$_SESSION['crfs'] = md5(time());
$id1 = $_SESSION['crfs'];
	$numero_login = $funcionario->getNumeroLogin();
	$funcionarios = FuncionarioDAO::todos();	
	$pedidos = PedidoDAO::todos();
	$produtos = ProdutoDAO::todos();
	$atendimentos = AtendimentoDAO::todos();
?>

		<script>
			function alterar(numero_login,nome_numero_login)
			{
				campo = document.getElementById(nome_numero_login);
				campo.value = numero_login;
				return confirm('Deseja alterar?');
			}
		</script>

		<div class="container-fluid">
					<div class="card mx-auto">
						<div class="card-header">
							<p>Alterar Dados Pessoais</p>
							</div>
							<div class="card-body">				
								<div class="form-group">								
										<a href="#" onclick="return alterar(<?=$funcionario->getNumeroLogin();?>,'numero_login1')" data-toggle="modal" data-target="#myModal1">
										alterar nome
										</a>
								</div>
								<div class="form-group">								
										<a href="#" onclick="return alterar(<?=$funcionario->getNumeroLogin();?>,'numero_login2')" data-toggle="modal" data-target="#myModal2">
										alterar email
										</a>
								</div>
								<div class="form-group">								
										<a href="#" onclick="return alterar(<?=$funcionario->getNumeroLogin();?>,'numero_login3')" data-toggle="modal" data-target="#myModal3">
										alterar senha
										</a>
								</div>
								<div class="form-group">								
										<a href="#" onclick="return alterar(<?=$funcionario->getNumeroLogin();?>,'numero_login4')" data-toggle="modal" data-target="#myModal4">
										inserir/excluir foto
										</a>
								</div>
							</div>
						</div>						
					</div>
		<br>	
		
						<?php if(isset($_SESSION["mensagemAlteracaoFuncionario"])){ ?>
						<div class="card-footer">
							<div class="alert alert-danger">
								<?=$mensagemAlteracaoFuncionario[$_SESSION["mensagemAlteracaoFuncionario"]]?>
							</div>
						</div>
						<?php 
							unset($_SESSION["mensagemAlteracaoFuncionario"]);
						} 
						?>	
						<?php if(isset($_SESSION["mensagemInserirArquivoFuncionario"])){ ?>
						<div class="card-footer">
							<div class="alert alert-danger">
								<?=$mensagemInserirArquivoFuncionario[$_SESSION["mensagemInserirArquivoFuncionario"]]?>
							</div>
						</div>
						<?php 
							unset($_SESSION["mensagemInserirArquivoFuncionario"]);
						} 
						?>	
		<br>
		
		<div class="modal" id="myModal1">
		    <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h4 class="modal-title">Alterar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  		<div class="modal-body">
							<div class="card-body">				
								<form action="controle/Alteracao/Funcionario/alterarNome.php" method="post" class="form">
								<input type="hidden" name="crfs" value="<?=$id1?>">
								<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
									<input type="hidden" name="numero_login" value="0" id="numero_login1"> 
									<div class="form-group">
										<label>Digite o nome</label>
										<input type="text" name="nome" id="nome" class="form-control">
									</div>
									<button class="btn btn-success">Enviar</button>
									<input type="reset" value="Limpar" class="btn btn-info">
								</form>
							</div>								  
			  			</div>
				</div>
			</div>
		</div>

		<div class="modal" id="myModal2">
		    <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h4 class="modal-title">Alterar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  		<div class="modal-body">
							<div class="card-body">				
								<form action="controle/Alteracao/Funcionario/alterarEmail.php" method="post" class="form">
								<input type="hidden" name="crfs" value="<?=$id1?>">
								<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
									<input type="hidden" name="numero_login" value="0" id="numero_login2"> 
									<div class="form-group">
										<label>Digite o email</label>
										<input type="email" name="email" id="email" class="form-control">
									</div>
									<button class="btn btn-success">Enviar</button>
									<input type="reset" value="Limpar" class="btn btn-info">
								</form>
							</div>								
			  			</div>
				</div>
			</div>
		</div>

		<div class="modal" id="myModal3">
		    <div class="modal-dialog">
				<div class="modal-content">

				  <div class="modal-header">
					<h4 class="modal-title">Alterar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  		<div class="modal-body">
							<div class="card-body">				
								<form action="controle/Alteracao/Funcionario/alterarSenha.php" method="post" class="form">
								<input type="hidden" name="crfs" value="<?=$id1?>">
								<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
									<input type="hidden" name="numero_login" value="0" id="numero_login3"> 
									<div class="form-group">
										<label>Senha Antiga</label>
										<input type="password" name="senha_antiga" id="senha_antiga" class="form-control">
									</div>
									<div class="form-group">
										<label>Senha Nova</label>
										<input type="password" name="senha_nova" id="senha_nova" class="form-control">
									</div>
									<div class="form-group">
										<label>Senha Nova Confirmação</label>
										<input type="password" name="senha_nova_c" id="senha_nova_c" class="form-control">
									</div>
									<button class="btn btn-success">Enviar</button>
									<input type="reset" value="Limpar" class="btn btn-info">
								</form>
							</div>				
				  
			  			</div>
				</div>
			</div>
		</div>
		
		<div class="modal" id="myModal4">
		    <div class="modal-dialog">
				<div class="modal-content">

				  <div class="modal-header">
					<h4 class="modal-title">Alterar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  		<div class="modal-body">
							<div class="card-body">				
									<form action="controle/Arquivo/upload.php" method="post" class="form" enctype="multipart/form-data">
									<input type="hidden" name="crfs" value="<?=$id1?>">
									<input type="hidden" id="numero_login_s" name="numero_login_s" value="<?=$numero_login?>"> 
										<input type="hidden" name="numero_login" value="0" id="numero_login4"> 
										<div class="form-group">
											<label for="nome">Nome do arquivo</label>
											<input type="text" name="nome" id="nome" class="form-control">
										</div>
										<div class="form-group">
											<label for="arquivo">Arquivo</label>
											<input type="file" name="arquivo" id="arquivo" accept=".png">
										</div>
										<button class="btn btn-success">Enviar</button>
										<input type="reset" value="Limpar" class="btn btn-info">
									</form>
									
									<div class="container">
									<table class="table table-bordered">
										<tr>
											<th>Foto</th>
											<th>Excluir</th>
										</tr>
										<?php
											$arquivos = ArquivoDAO::buscarPorNumeroLoginFuncionario($numero_login);
											foreach($arquivos as $ar)
											{
										?>
										<tr>
											<td>
												<a class="nav-link" href="arquivos/<?=$ar->getEndereco()?>" target="_blank">
													<img src="arquivos/icones/<?=$ar->getIcone()?>">
												</a>
											</td>
											<td>
												<a class="nav-link" href="controle/Arquivo/excluir.php?&id_arquivo=<?=$ar->getId()?>&numero_login_funcionario_arquivo=<?=$numero_login?>" 
													 onclick="return confirm('Deseja excluir?')">
													Excluir
												</a>
											</td>
										</tr>
										<?php
											}
										?>
									</table>
									<br>		
									</div>
									
							</div>				
				  
			  			</div>
				</div>
			</div>
		</div>
