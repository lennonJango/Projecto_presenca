<?php
//cria sessao
require_once "../BaseDeDados/Connectar.php";
require_once "../Controladores/controladorSessao.php";
class Admin
{
private $tabela = "administrador";
    //Cria a conta do administrador
public function criarAdmin($email, $nome, $senha){
        $sql = "insert into $this->tabela (email,nome,senha) values (:email,:nome,:senha)";
        $statement = Connect_db::prepare($sql);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":nome", $nome);
        $statement->bindParam(":senha", $senha);
        return $statement->execute();
    }

    //Seleciona um Admin
    public function selecionarUmAdmin($email, $senha)
    {
        $sql = "select * from $this->tabela where email =:email and senha=:senha";
        $statement = Connect_db::prepare($sql);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":senha", $senha);
        $statement->execute();
        return $statement->fetch();
    }

    // Seleciona todos admins 
    public function selecionarTodosAdmin(){
        $sql = "select * from $this->tabela";
        $statement = Connect_db::prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    // Atualiza os dados do Admin
    public function actualizarDadosAdmin($email, $nome, $senha){
        $sql = "update $this->tabela set email = $email , set nome = $nome , set senha =$senha where email = :email and senha =:senha ";
        $statement = Connect_db::prepare($sql);
        $statement->bindParam("email", $email);
        $statement->bindParam("nome", $nome);
        $statement->bindParam("senha", $senha);
        return $statement->execute();
    }

    //Apaga um admin do sistema 
    public function apagarUmAdmin($email){
        $sql = "drop from $this->tabela where email=$email";
        $statement = Connect_db::prepare($sql);
        return $statement->execute();
    }

    //Verifica as credências do administrador que faz login e cria uma sessão e redireciona para o menu principal(ambiente_admin)
    public function vereficarCrendecias($email, $senha)
    {

        $admin = new Admin();
        $adminId = $admin->selecionarUmAdmin($email, $senha);
          
        if ($admin != null) {
        
            $token = uniqid("SSID", true);
            $seValido = true;
            $idAdmin = $adminId->id;
            print_r($adminId);
            $sessao = new Sessao();
             $resultadoSessao= $sessao->adicionarSessao($token, $seValido, $idAdmin);

            if($resultadoSessao==1){
                $sesaoSelecionada  = new Sessao();
                $idAdministrador = $sesaoSelecionada->selecionarSesao($token,$idAdmin);
                print_r($idAdministrador);
                setcookie($this->tabela,$token,time()+(86400*30),"/");
                 $_SESSION['adminId'] = $idAdmin;
                 $_SESSION['token'] = $token;
                header("location:../view/ambiente_admin.php");

               return true;

              }else{
                 echo "Passe errada";
              }
        }
    }



}
?>