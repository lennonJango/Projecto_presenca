<?php
require_once "../BaseDeDados/Connectar.php";
class Turma {
    private $tabela = "Turma";

    //Cria uma nova turma na base de dados
    public function criarTurma($nome,$turno){

        $sql = "insert into $this->tabela (nome,turno) values (:nome,:turno)";

        $statement = Connect_db::prepare($sql);

        $statement->bindParam(":nome", $nome);
        $statement->bindParam(":turno", $turno);

        return $statement->execute();
    }
    //Seleciona todas as turmas na base de dados
    public function selecionarTurmas (){

        $sql = "select * from $this->tabela ";
        $statement = Connect_db::prepare($sql);
        $statement->execute();

      return $statement->fetchAll();
    }
//Apaga uma turma selecionada na base de dados 
    public function apagarTurma ($nome,$turno){

        $sql = "Delete from $this->tabela where nome=:nome and turno=:turno";

        $statement = Connect_db::prepare($sql);
        $statement->bindParam(":nome", $nome);
         $statement->bindParam(":turno", $turno);

        return $statement->execute();
    }
}

?>