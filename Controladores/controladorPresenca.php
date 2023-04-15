<?php
require_once "../BaseDeDados/Connectar.php";
 class Presenca {
    //Controlador Presença responsável por adicionar e selecionar
    private $tabela = "presenca";
    // Adicionar dados na lista 
public function adicionarNaLista($administrador_id,$estudante_id,$lista_id,$data){
  $sql = " insert into $this->tabela (administrador_id,estudante_id,lista_id,data) values (:administrador_id,:estudante_id,:lista_id,:data)";
        $statement = Connect_db::prepare($sql);
        $statement->bindParam(":administrador_id", $administrador_id);
        $statement->bindParam(":estudante_id", $estudante_id);
        $statement->bindParam(":lista_id", $lista_id);
        $statement->bindParam(":data", $data);
        return $statement->execute();
    }

    //Seleciona recupera os dados da lista 
     public function select (){
        $sql = " select * from (($this->tabela inner  join lista on lista.id = presenca.lista_id) inner join estudante on estudante.id = presenca.estudante_id);";
        $statement = Connect_db::prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
     }
 }
?>
