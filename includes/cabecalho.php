<?php
if(!isset($_SESSION)) 
    session_start();

try {

    include_once dirname(__FILE__) . '/../DAO/MySQL.php';

    $mysql = new MySQL();

    $stmt = $mysql->prepare("SELECT nome FROM usuarios WHERE id=:marcador_id ");
    $stmt->execute(array('marcador_id' => $_SESSION['usuario_logado']));

    $dados_do_usuario = $stmt->fetchObject();

} catch(Exception $e) {

    echo $e->getMessage();
}

?>

<header>
    <h1>
        SISGEN
        <small>Sistema de Gestão</small>
    </h1>

    <fieldset>
        <legend>Dados do usuário</legend>
        Bem-vindo <strong> <?= $dados_do_usuario->nome ?> </strong> | <a href="index.php?sair=true">Sair</a>
    </fieldset>

    <nav>
        <ul>
        <li> <a href="/"> Tela Inicial </a> </li>

            <li> <a href="/modulos/categoria/cadastrar_categoria.php"> Cadastrar Categoria </a> </li>
            <li> <a href="/modulos/categoria/listar_categorias.php"> Listar Categoria </a> </li>

            <li> <a href="#"> Cadastrar Marca </a> </li>
            <li> <a href="#"> Listar Marca </a> </li>

            <li> <a href="/modulos/produto/cadastrar_produto.php"> Cadastrar Produto </a> </li>
            <li> <a href="/modulos/produto/listar_produtos.php"> Listar Produto </a> </li>
        </ul>
    </nav>
    <hr />
</header>