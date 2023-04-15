<?php
require_once "../BaseDeDados/Connectar.php";

class Sessao
{
  private $tabela = "sessao";
  //Adiciona uma sesao a base de dados 
 public function adicionarSessao($token, $seValido, $adminId)
  {
    $sql = "insert into $this->tabela (token, se_valido, administrador_id) values (:token ,:seValido,:adminId)";
    $statement = Connect_db::prepare($sql);
    $statement->bindParam(":token", $token);
    $statement->bindParam(":seValido", $seValido);
    $statement->bindParam(":adminId", $adminId);
    return $statement->execute();
  }

//Este método sera responsável por retornar os dados da sessao 
  public function selecionarSesao($token,$se_valido){
    $sql = " select * from $this->tabela where token = :token and se_valido = :se_valido";
    $statement = Connect_db::prepare($sql);
    $statement->bindParam(":token", $token);
    $statement->bindParam(":se_valido", $se_valido);
    return $statement->execute();
  }

  public function terminarSessao(){

    
  }
}

?>