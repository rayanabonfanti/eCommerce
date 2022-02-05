<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
    $id_produto = $_GET['id'];
    $ids_arquivos_produtos = array();
    $ids_arquivos_produtos = ArquivoProdutoDAO::buscarPorProduto($id_produto);
    
    foreach($ids_arquivos_produtos as $i_ar)
    {
        $id_ar = $i_ar->getID();

        $arquivo = ArquivoDAO::buscarArquivoPorId($id_ar);
        if(ArquivoProdutoDAO::excluirArquivo($id_produto,$id_ar))
        {
            ProdutoDAO::excluir($id_produto);
            unlink("../../../arquivos/".$arquivo->getEndereco());
            unlink("../../../arquivos/icones/".$arquivo->getIcone());                
        }
    }

    $numero_login_s = $_GET['numero_login_s'];
	$func = FuncionarioDAO::buscaFuncionario($numero_login_s);
	
	if($func == null)
	{
		header("location: ../../../index.php");
	}
	if($func->getNivelHierarquico()=="Administrador_Basico")
	{
		header("location: ../../../index.php?p=1");
	}
	else if($func->getNivelHierarquico()=="Administrador_Supervisor")
	{
		header("location: ../../../index.php?p=1");
	}
	else if($func->getNivelHierarquico()=="Funcionario_Comum")
	{
		header("location: ../../../index.php?p=0");
	}    
?>
