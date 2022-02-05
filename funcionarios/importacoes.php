<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/modelo/Arquivo.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/modelo/ArquivoFuncionario.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/persistencia/ArquivoDAO.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/persistencia/ArquivoProdutoDAO.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/modelo/Funcionario.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/modelo/Pedido.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/modelo/Atendimento.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/modelo/Produto.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/persistencia/FuncionarioDAO.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/persistencia/PedidoDAO.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/persistencia/AtendimentoDAO.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/persistencia/ProdutoDAO.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/persistencia/Banco.php");

    function limparPost()
    {
        foreach($_POST as $i => $valor)
        {
            $_POST[$i]= strip_tags($_POST[$i]);
        }
    }
    function validarFormulario()
    {
        return $_POST['crfs']==$_SESSION['crfs'];
    }

    $msgLogar = array("Usuário e/ou senha inválidos");
    $msgCadastroFuncionario = array("Cadastrado","Não Cadastrado");
	$mensagemCadastroSupervisorFuncionario = array("Funcionário com campo nulo","Funcionário Cadastrado");
    $mensagemAlteracaoFuncionario = array("Dados de funcionário não foram alterados","Dados de Funcionário foram alterados");
    $mensagemAlteracaoProduto = array("Dados de produto não foram alterados","Dados de produto foram alterados");
    $mensagemInseridoProduto = array("Dados de produto não foram inseridos","Dados de produto foram inseridos");
	$mensagemInserirArquivoFuncionario = array("Inserção de arquivo não foi efetuado","Inserção de arquivo foi efetuado");
	$mensagemRespondeAtendimento = array("Atendimento de resposta não efetuado","Atendimento respondido com sucesso");
	$mensagemAlteracaoStatusPedido = array("Status Pedido Não Atualizado","Status Pedido Atualizado");
    
    $pagSupervisor = array(
        "menuAdministradorSupervisor/menuAdmininistradorSupervisor_CadastraFuncionario.php",
        "menuAdministradorSupervisor/menuAdmininistradorSupervisor_CadastraProduto.php",
        "menuAdministradorSupervisor/menuAdmininistradorSupervisor_AlterarFuncionario.php",
        "menuAdministradorSupervisor/menuAdmininistradorSupervisor_AtualizaPedidos.php",
        "menuAdministradorSupervisor/menuAdmininistradorSupervisor_RespondeAtendimento.php",
        "menuAdministradorSupervisor/menuAdmininistradorSupervisor_AlteraDadosPessoais.php"
    );
    $pagComum = array(
        "menuFuncionarioComum/menuFuncionarioComum_CadastraProduto.php",
        "menuFuncionarioComum/menuFuncionarioComum_VisualizarFuncionario.php",
        "menuFuncionarioComum/menuFuncionarioComum_AtualizaPedidos.php",
        "menuFuncionarioComum/menuFuncionarioComum_RespondeAtendimento.php",
        "menuFuncionarioComum/menuFuncionarioComum_AlteraDadosPessoais.php"
    );
    $pagBasico = array(
        "menuAdministradorBasico/menuAdmininistradorBasico_CadastraFuncionario.php",
        "menuAdministradorBasico/menuAdmininistradorBasico_CadastraProduto.php",
        "menuAdministradorBasico/menuAdmininistradorBasico_AlterarFuncionario.php",
        "menuAdministradorBasico/menuAdmininistradorBasico_AtualizaPedidos.php",
        "menuAdministradorBasico/menuAdmininistradorBasico_RespondeAtendimento.php",
        "menuAdministradorBasico/menuAdmininistradorBasico_AlteraDadosPessoais.php"
    );
    $pagRH = array(
        "menuAdministradorRH/menuAdmininistradorRH_AlterarSalarioFuncionario.php",
        "menuAdministradorRH/menuAdmininistradorRH_CadastraFuncionario.php",
        "menuAdministradorRH/menuAdmininistradorRH_AlteraDadosPessoais.php"
    );
?>
