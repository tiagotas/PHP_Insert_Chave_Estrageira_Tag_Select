<?php

class CategoriaDAO {

    private $conexao;


    /**
     * Cria uma novo objeto para fazer o CRUD de Categorias
     */
    public function __construct()
    {
        include_once 'MySQL.php';

        $this->conexao = new MySQL();
    }


    /**
     * Retorna um registro específico da tabela Categoria
     */
    public function getById($id) {

        $stmt = $this->conexao->prepare("SELECT * FROM categoria WHERE id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject();            
    }


    /**
     * Retorna todos os registros da tabela Categoria.
     */
    public function getAllRows() {
        
        $stmt = $this->conexao->prepare("SELECT * FROM categoria");
        $stmt->execute();

        $arr_categorias = array();

        while($c = $stmt->fetchObject())
            $arr_categorias[] = $c;

        return $arr_categorias;
    }



    /**
     * Método que insere uma categoria na tabela Categoria.
     */
    public function insert($dados_categoria) {

        $sql = "INSERT INTO categoria (descricao) VALUES (?)";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_categoria['descricao']);
        $stmt->execute();
    }


    /**
     * Atualiza um registro na tabela Categoria.
     */
    public function update($dados_categoria) {

        $sql = "UPDATE categoria SET descricao = ? WHERE id = ? ";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_categoria['descricao']);
        $stmt->bindValue(2, $dados_categoria['id']);
        $stmt->execute();
    }


    /**
     * Remove um registro da tabela Categoria.
     */
    public function delete($id) {

        $sql = "DELETE FROM categoria WHERE id = ? ";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}

