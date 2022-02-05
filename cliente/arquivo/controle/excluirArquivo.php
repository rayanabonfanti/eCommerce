<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/cliente/auxiliares.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
$id_arquivo = $_GET['id'];
$id_cliente = $_GET['id_cliente'];
$arquivo = ArquivoDAO::buscarArquivoPorId($id_arquivo);
ArquivoClienteDAO::excluirArquivoCliente1($id_arquivo,$id_cliente);
ArquivoClienteDAO::excluirArquivoCliente2($id_arquivo);
unlink("../arquivos/".$arquivo->getEndereco());
unlink("../arquivos/icones/".$arquivo->getIcone());
header("location: ../../index.php?p=5");
?>

