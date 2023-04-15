<?php
require_once "../BaseDeDados/Connectar.php";
class Controlado_listas{
    //Controlador Lista controlador responsável por adicionar e selecionar a lista
    private $tabela = "lista";
//cria a lista
    public function adicionarLista($nome){
        $sql = " insert into $this->tabela (nome) values (:nome)";

        $statement = Connect_db::prepare($sql);
        $statement->bindParam(":nome", $nome);

        return $statement->execute();
    }
    // retorna os dados da lista 
    public function selectList(){
        $sql = " select * from $this->tabela";
        $statement = Connect_db::prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }
}
?>