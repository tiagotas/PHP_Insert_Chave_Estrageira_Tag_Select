<?php

try {

    include '../../DAO/CategoriaDAO.php';

    $categoria_dao = new CategoriaDAO();

    $lista_categorias = $categoria_dao->getAllRows();

    $total_categorias = count($lista_categorias);


} catch(Exception $e) {

    echo $e->getMessage();
}
?>

<html>
    <head>
        <title>Sistema</title>
    </head>
    <body>
        
        <?php include '../../includes/cabecalho.php' ?>

        <main>
            <table>
                <thead>
                    <tr>
                        <th>Ações</th>
                        <th>Id</th>
                        <td>Descricao:</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<$total_categorias; $i++): ?>
                    <tr>
                        <td> 
                            <a href="cadastrar_categoria.php?id=<?= $lista_categorias[$i]->id ?>">
                                Abrir
                            </a> 
                        </td>
                        <td> <?= $lista_categorias[$i]->id ?> </td>
                        <td> <?= $lista_categorias[$i]->descricao  ?> </td>
                    </tr>
                    <?php endfor ?>
                </tbody>
            </table>
        </main>

        <?php include '../../includes/rodape.php' ?>

    </body>
</html>