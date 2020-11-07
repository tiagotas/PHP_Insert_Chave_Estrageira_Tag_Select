<?php

try {

    /**
     * Obtendo as categorias.
     */
    include '../../DAO/CategoriaDAO.php';
    $categoria_dao = new CategoriaDAO();
    $lista_categorias = $categoria_dao->getAllRows();
    $total_categorias = count($lista_categorias);


    /**
     * Obtendo as marcas
     */
    include '../../DAO/MarcaDAO.php';
    $marca_dao = new MarcaDAO();
    $lista_marcas = $marca_dao->getAllRows();
    $total_marcas = count($lista_marcas);


    /**
     * Salvando um produto no MySQL
     */
    if(isset($_GET['salvar']))
    {
        include '../../DAO/ProdutoDAO.php';

        $produto_dao = new ProdutoDAO();

        $dados_para_salvar= array(
            'id_marca' => $_POST["id_marca"],
            'id_categoria' => $_POST["id_categoria"],
            'descricao' => $_POST["descricao"],
            'preco' => $_POST["preco"],
        );

        if(isset($_POST['id'])) {

            $dados_para_salvar['id'] = $_POST["id"];

            $produto_dao->update($dados_para_salvar);

            echo "Atualizado.";

        } else {

            $produto_dao->insert($dados_para_salvar);

            echo "Inserido.";
        }    
    }

    /**
     * Exclui um produto
     */
    if(isset($_GET['excluir']))
    {
        include '../../DAO/ProdutoDAO.php';

        $produto_dao = new ProdutoDAO();

        $produto_dao->delete($_GET['id']);

        header("Location: listar_produtos.php");
    }


    /**
     * Obtém um produto
     */
    if(isset($_GET['id']))
    {
        include '../../DAO/ProdutoDAO.php';

        $produto_dao = new ProdutoDAO();

        $dados_produto = $produto_dao->getById($_GET['id']);
    }

} catch(Exception $e) {

    echo $e->getMessage();
}
?>
<html>
    <head>
        <title>Cadastro de Produtos</title>


        <style>
            label, input, select { display: block; padding: 5px  }
        </style>

        <style>
            label, input, select { padding: 15px }
        </style>

    </head>

    <body>
        <?php include '../../includes/cabecalho.php' ?>

        <main>
            <form method="post" action="cadastrar_produto.php?salvar=true">

                <label>Descrição (Nome) do produto:
                    <input name="descricao" type="text" value="<?= isset($dados_produto) ? $dados_produto->descricao : "" ?>" />
                </label>

                <label style="padding:1px !important">Preço:
                    <input name="preco" type="number" value="<?= isset($dados_produto) ? $dados_produto->preco : "" ?>" />
                </label>

                <label>Categoria:
                    <select name="id_categoria">
                        <option>Selecione a categoria</option>

                        <?php 
                        
                            for($i=0; $i<$total_categorias; $i++):
                                
                                $selecinado = "";

                                if(isset($dados_produto->id))
                                    $selecinado = ($lista_categorias[$i]->id == $dados_produto->id_categoria) ? "selected" : "";
                            ?>

                        <option value="<?= $lista_categorias[$i]->id ?>" <?= $selecinado ?> >
                            <?= $lista_categorias[$i]->descricao  ?> 
                        </option>

                        <?php endfor ?>

                    </select>
                </label>

                <label>Marca
                    <select name="id_marca">
                        <option>Selecione a marca</option>

                        <?php for($i=0; $i<$total_marcas; $i++): 
                             
                             $selecinado = "";

                             if(isset($dados_produto->id))
                                 $selecinado = ($lista_marcas[$i]->id == $dados_produto->id_marca) ? "selected" : "";
                            
                        ?>
                        <option value="<?= $lista_marcas[$i]->id ?>" <?= $selecinado ?>> 
                            <?= $lista_marcas[$i]->descricao  ?> 
                        </option>
                        <?php endfor ?>
                    </select>
                </label>

                <?php if(isset($dados_produto)): ?>
                        <input name="id" type="hidden" value="<?= $dados_produto->id ?>" />

                        <a href="cadastrar_produto.php?excluir=true&id=<?= $dados_produto->id ?>">
                            EXCLUIR
                        </a>

                    <?php endif ?>

                <button type="submit">Salvar</button>

            </form>
        </main>


        <?php include '../../includes/rodape.php' ?>

    </body>

</html>