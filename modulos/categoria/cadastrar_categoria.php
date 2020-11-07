<?php

session_start();

//Verificando se o usuário está logado.
if(!isset($_SESSION["usuario_logado"]))
    header("Location: login.php");

try {

    if(isset($_GET['salvar']))
    {
        include 'DAO/CategoriaDAO.php';

        $categoria_dao = new CategoriaDAO();

        $dados_para_salvar= array(
            'descricao' => $_POST["descricao"],
        );

        if(isset($_POST['id'])) {

            $dados_para_salvar['id'] = $_POST["id"];

            $categoria_dao->update($dados_para_salvar);

            echo "Atualizado.";

        } else {

            $categoria_dao->insert($dados_para_salvar);

            echo "Inserido.";
        }    
    }


    if(isset($_GET['excluir']))
    {
        include 'DAO/CategoriaDAO.php';

        $categoria_dao = new CategoriaDAO();

        $categoria_dao->delete($_GET['id']);

        header("Location: listar_categorias.php");
    }



    if(isset($_GET['id']))
    {
        include 'DAO/CategoriaDAO.php';

        $categoria_dao = new CategoriaDAO();

        $dados_categoria = $categoria_dao->getById($_GET['id']);
    }



} catch(Exception $e) {

    echo $e->getMessage();
}


?>
<html lang="pt-br">
    <head>
        <title>CADASTRAR CATEGORIA</title>
        <meta charset="utf8" />
    </head>
    <body>
        <div id="global">
            
            <?php include '../../includes/cabecalho.php' ?>

            <main>
                <form method="post" action="cadastrar_categoria.php?salvar=true">
                    
                    <label>Descrição (Nome) da categoria:
                        <input name="descricao" value="<?= isset($dados_categoria) ? $dados_categoria->descricao : "" ?>" type="text" />
                    </label>

                    <?php if(isset($dados_categoria)): ?>
                        <input name="id" type="hidden" value="<?= $dados_categoria->id ?>" />

                        <a href="cadastrar_categoria.php?excluir=true&id=<?= $dados_categoria->id ?>">
                            EXCLUIR
                        </a>

                    <?php endif ?>

                    <button type="submit">Salvar</button>
                </form>
            </main>

             <?php include '../../includes/rodape.php' ?>
             
        </div>
    </body>
</html>