<?php
require_once "../BaseDeDados/Connectar.php";
//Controlador do Aluno responsável por adicionar,apagar,selecionar,atualizar
class Aluno {
   private $tabela = " estudante";
   //Cadastra o aluno na base de dados
   public function cadastrarAluno($nome,$sobrenome,$sexo,$endereco,$turma_id){
      $sql = "insert into $this->tabela (nome,sobrenome,sexo,endereco,turma_id) values(:nome,:sobrenome,:sexo,:endereco,:turma_id)";
      $statement = Connect_db::prepare($sql);
      $statement->bindParam(":nome", $nome);
      $statement->bindParam(":sobrenome", $sobrenome);
      $statement->bindParam(":sexo",$sexo);
      $statement->bindParam(":endereco", $endereco);
      $statement->bindParam(":turma_id", $turma_id);
      return $statement->execute();
   }

   // Para selecionar todos estudantes existentes na base de dados 
     public function selecionar(){
      $sql = "select * from $this->tabela";
      $statement = Connect_db::prepare($sql);
      $statement->execute();
      return $statement->fetchAll();
     }

   //Seleciona um estudante especifico
     public function select1($nome,$sobrenome){
      $sql = "select * from  $this->tabela where nome=:nome and sobrenome=:sobrenome";
      $statement = Connect_db::prepare($sql);
      $statement->bindParam(":nome",$nome);
      $statement->bindParam(":sobrenome",$sobrenome);
      $statement->execute();
      return $statement->fetch();
     }
     //Apaga o aluno da base de dados
     public function apagarAluno ($nome,$sobrenome){
      $sql = "delete from $this->tabela where nome=:nome and sobrenome=:sobrenome";
      $statement = Connect_db::prepare($sql);
      $statement->bindParam(":nome", $nome);
      $statement->bindParam(":sobrenome", $sobrenome);
      return $statement->execute();
     }
     // Atualizar dados do aluno 
     public function atualizarDados($nome,$sobrenome,$endereco){
      $sql = "update $this->tabela set nome =:nome ,sobrenome=:sobrenome,endereco =:endereco where nome=:nome and sobrenome=:sobrenome";
      $statement = Connect_db::prepare($sql);
      $statement->bindParam("nome", $nome);
      $statement->bindParam("sobrenome", $sobrenome);
      $statement->bindParam(":endereco", $endereco);
      return $statement->execute();
     }
}
?>