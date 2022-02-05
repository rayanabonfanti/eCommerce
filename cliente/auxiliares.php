<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/modelo/Usuario.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/modelo/Cliente.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/modelo/Endereco.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/modelo/Carrinho.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/modelo/ArquivoCliente.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/modelo/CompraItens.php");

require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/persistencia/UsuarioDAO.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/persistencia/CarrinhoDAO.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/persistencia/ArquivoClienteDAO.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/persistencia/CompraItensDAO.php");

require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/persistencia/ArquivoDAO.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/persistencia/Banco.php");

$msgLogin = array(
"Usuário e/ou senha inválidos"
);

$pag = array(
"loginFace.php",//0
"menu_cliente.php",//1
"formularioAlterarCliente.php",//2
"formularioExcluirCliente.php",//3
"menu_carrocel.php",//4
"arquivo_foto.php",//5
"buscarProdutos.php",//6
"carrinhoCompra.php",//7
"fazerPedido.php",//8
"compraItens.php"//9

);

$msgCadastro = array(
"Cliente cadastrado",
"Erro ao cadastrar cliente!",
"Alterações realizadas com sucesso",
"Erro, ao alterar cliente!",
"Conta excluida com sucesso"
);

function validarNivel($nivel){
	if($cliente == null){
		return false;
	}
	if($cliente->getNivel() != "cliente"){
		return false;
	}
	
	return true;
}



?>
