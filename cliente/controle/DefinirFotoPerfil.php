<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
$icone = $_GET['icone'];
$cliente = unserialize($_SESSION["cliente"]);
$erro = UsuarioDAO::inserirFotoPerfil($icone, $cliente->getId());
$cliente->setFoto_perfil($icone);
$_SESSION['cliente'] = serialize($cliente);

header("location: ../index.php?p=5");
?>
