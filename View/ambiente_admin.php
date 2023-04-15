<?php
session_start();
//Chamado todos os controladores
require_once "../Controladores/controladorAluno.php";
require_once "../Controladores/controladorLista.php";
require_once "../Controladores/controlladorAdmin.php";
require_once "../Controladores/controladorSessao.php";
require_once "../Controladores/controladorPresenca.php";
require_once "../Controladores/controladorTurma.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link rel="stylesheet" href="../estilo/estilo2.css">
</head>
<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Controlador</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Controladores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                       <li class="nav-item">
                            <a class="nav-link"  id="admin" href="#" >Administrador</a>
                        </li>
                        <!-- Para estudante -->
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" id="Estudante"
                            >Estudante</a>
                        </li>

                        <!-- Para presenças -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" id='presencas'>Presenças</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" id="lista">Lista</a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link" href="#" id="turma_link">Turma</a>
                        </li>
                        <li>
                            <form method="post">
                        
                        <button type="submit" name="log_out">Terminar sessao
                        </button>
                              </form>
                        </li>
                         <?php
                  if(isset($_POST['log_out'])){

                // Como terminar a sess
                //   setcookie("administrador", "", time()-3600, '/');
                //    header("location:../View/iniciar.php");
                 }
                 ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

      
          <main>

          <section>
            <div class="card-body py-1 px-md-5 p-3 bg-dark-subtle h-auto display_hidden" id="estudante_layout">

                <div class="row d-flex justify-content-center py-4">
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-5 py-5 text-center ">Cadastrar Estudante </h2>
                        <form method="post"> 
                                  <!-- nome -->
                                    <div class="form-outline mb-2 mt-3">
                                        <input type="text" id="nome" class="form-control"  name ="nome_aluno"/>
                                        <label class="form-label" for="nome">Nome</label>
                                    </div>
                                    <!-- sobrenome -->
                                     <div class="form-outline mb-2 mt-2">
                                        <input type="text" id="Sobre_usuario" class="form-control"  name ="sobrenome_aluno"/>
                                        <label class="form-label" for="sobrenome">Sobrenome</label>
                                    </div>
                                    <div class="form-check mb-2 lg-6">
                                         <label for="sexo" class="form-label">Masculino</label>
                                        <input type="radio" id="sexo" class="form-check-label" name="sexo_aluno" value="Masculino">
                                        <label for="sexo" class="form-label">Feminino</label>
                                        <input type="radio" id="sexo" class="form-check-label" name="sexo_aluno" value="Feminino">
                                    </div>
                              <div class="form-outline mb-2 mt-3">
                                        <input type="text" id="morada" class="form-control"  name ="endereco_aluno"/>
                                        <label class="form-label" for="sobrenome">Morada do estudante</label>
                                    </div>

                             <div class="form-outline mb-2 mt-3">
                           
                            <select name="turma_aluno" id=""     class="form-select">
                                   <?php
                                   $turma = new Turma();
                                   $turmas = $turma->selecionarTurmas();
                            //  Faz um loop na base de dados para apresentar todas turmas disponíveis
                                   foreach($turmas as $key=>$t){
                                       echo "<option value='$t->id'>$t->nome</option>";
                                   }
                                     ?>
                                </select>
                                       
                              </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-1" name="cadastrar_aluno">
                               Cadastrar
                            </button>

                        </form>

                         <?php
                        // Quando os dados do formulários são submetidos o botão  cadastrar cadastrar um novo aluno na base de dados 
                       if(isset($_POST["cadastrar_aluno"])){
                          $nome_aluno = $_POST["nome_aluno"];
                          $sobrenome = $_POST["sobrenome_aluno"];
                          $sexo = $_POST["sexo_aluno"];
                          $endereco = $_POST["endereco_aluno"];
                          $numero_turma = $_POST["turma_aluno"];

                          $novoAluno = new Aluno();
                          $novoAluno->cadastrarAluno($nome_aluno, $sobrenome, $sexo, $endereco, $numero_turma);

                       }
                       ?>
                    </div>

                   
                </section>

                <!-- Parte admin -->
                 <section >
                     <div class="card-body py-5 px-md-5 display_hidden" id="admin_display">

                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-5 text-center">Criar conta </h2>
                        <form method="post"> 
                                    <div class="form-outline mb-4">
                                        <input type="text" id="nome_usuario" class="form-control"  name ="nome_admin"/>
                                        <label class="form-label" for="nome">Nome</label>
                                    </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email_admin"  class="form-control"  />
                                <label class="form-label" for="email">Email address</label>
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="pass_usuario" class="form-control" name="pass_admin" />
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4" name="criar_admin">
                                Sign up
                            </button>
                        </form>
                    </div>
                </div>

                 <!-- Funcao Php resgistado um novo admin -->
                 <?php
                      //Cria um novo admin
                        if(isset($_POST["criar_admin"])){

                        $nome = $_POST["nome_admin"];
                        $email = $_POST["email_admin"];
                        $senha = $_POST["pass_admin"];
                        $adm = new Admin();
                        $adm->criarAdmin($email, $nome, $senha);

                        }
                    ?>
                    
                 </section>

                 <!-- Parte presenças -->

                 <section >
                    <div class ="card-body py-5 " id="presenca_display">
                    <div class="row d-flex justify-content-center py-5" >
                        <div class="col-lg-7">
                      <h2 class="h2 text-center">Controlador de Presenças</h2>
                        
                      <form method="post">
                      <div class="row py-3">

                      <div class="col">
                            
                           <select class="form-select"  name="estudante_id">
                           
                            <?php

                            //Faz um foreach para puxar todos estudantes na base de dados 
                          $estudantes = new Aluno();
                            $alunos = $estudantes->selecionar();
                         foreach($alunos as $key=>$data){

                        echo "<option value='$data->id'>$data->nome</option>";
                       }
                        ?>
                          </select>
                      </div>

                            <div class="col">

                              <select name="listas" id="" class="form-select">

                           <?php
                           $listas = new Controlado_listas();
                           $lista = $listas->selectList(); 
                          // Faz um foreach de todas as lista de turmas disponíveis
                           foreach ($lista as $key=>$dados){
                            echo "<option value='$dados->id'>$dados->nome</option>";
                           }
                             ?>
                              </select>
                            </div>
                      </div>
                            <button type="submit" class="btn btn-primary btn-block mb-4" name="adicionar_Lista">
                                Adicionar a lista
                            </button>

                            <button type="submit" class="btn btn-primary btn-block mb-4" name="ver_lista" id="ver_tabela_lista">
                                 Ver tabela
                            </button>
                           
                         </form>

                        </div>
                    </div>
                     <div class ="card-body py-2 " id="turma_display">
                    <div class="container my-5 py-4 " id="tabela_presenca" >
                   <table class="table" >
                    <thead class='thead-dark'>
                     <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Estudante</th>
                    <th scope="col">Data</th>
                     </tr>
                     </thead>
               <tbody>
                 <?php
                 //Apresentas os dados da lista numa tabela 
                     $presencas = new Presenca();
                     $reading = $presencas->select();
                     foreach ($reading as $key => $x) {
                         echo "<tr>
                      <th scope='row'>$x->id</th>
                      <td>$x->nome</td>
                      <td>$x->data</td>    
                     </tr>";
                     }
                   ?>
            </tbody>
             </table>
          </div>
                    </div>
                            <?php
                            // Adiciona as presencas feitas numa lista 
                            if(isset($_POST["adicionar_Lista"])){
                              
                               
                                $id_aluno = $_POST["estudante_id"];
                                $id_admin = $_SESSION["adminId"];
                                $id_lista = $_POST["listas"];
                                $data = date('Y-m-d H:i:s');
                                $presenca_lista = new Presenca();
                               $presenca_lista->adicionarNaLista($id_admin, $id_aluno, $id_lista,$data);   
                            }
                            ?>
                 </section>

                 <!-- Parte turma -->
                 <section>

                    <div class ="card-body py-5 " >
                    <div class="row d-flex justify-content-center py-5" id="turma_display">
                        <div class="col-lg-7">
                      <h2 class="h2 text-center">Controlador Turmas</h2>
                        
                      <form method="post">
                      <div class="row py-3">
                            <div class="col">
                              <input type="text" class="form-control" placeholder="Nome da turma" name="turma_nome">
                            </div>
                           <div class="col">
                            <input type="text" class="form-control" placeholder="Turno" name="turno_turma">
                           </div>
                      </div>
                            <button type="submit" class="btn btn-primary btn-block mb-4 py-2" name="adicionar_turma" id="addTurma">
                                Adicionar a lista
                            </button>
                            <button type="submit" class="btn btn-primary btn-block mb-4 py-2" name="ver_lista" id="ver_turmas">
                                 Ver turmas
                            </button>
                             <button type="submit" class="btn btn-primary btn-block mb-4 py-2" name="apagar_turma" id="delete_turma">
                                Apagar turma
                            </button>
                        </form>
                        <?php
                     // Cria uma nova turma e adiciona essa turma na lista das  turmas 
                        if(isset($_POST["adicionar_turma"])){
                            $nome_turma = $_POST["turma_nome"];
                            $turno_turma = $_POST["turno_turma"];
                            $novaTurma = new Turma();
                            $novaTurma->criarTurma($nome_turma, $turno_turma);
                            $criarLista = new Controlado_listas();
                            $criarLista->adicionarLista($nome_turma);
                        }
                     //Apaga uma turma na based de dados 
                         if(isset($_POST["apagar_turma"])){
                            $nome = $_POST["turma_nome"];
                            $turno = $_POST["turno_turma"];
                            $apagarT = new Turma();
                            $apagarT->apagarTurma($nome, $turno);
                         }
                        ?>

                 <!-- Tabela turma -->
                        </div>
                         </div>

                        <div class ="card-body py-2 " >
                    <div class="container my-5 py-4 " id="tabela_turma"  >
                   <table class="table" >
                    <thead class='thead-dark'>
                     <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome da turma</th>
                    <th scope="col">Turno</th>
                    
                     </tr>
                     </thead>
               <tbody>
                 <?php
    
               //    Traz todas a turmas que estão na base de dados para uma tabela onde o admin pode ver as turmas existentes 
                $turmas = new Turma();
               $reading = $turmas->selecionarTurmas();
               foreach($reading as $key=>$x){
                echo "<tr>
               <th scope='row'>$x->id</th>
               <td>$x->nome</td>
               <td>$x->turno</td>  
             </tr>";}

              
             ?>
            </tbody>
             </table>
             </div>
                    </div>
                    </div>
                 </section>
     </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>


    <script>

          //Este função é responsável por ocultar os displays usando Dom
          function displayHidden(elemento,link){
            link.addEventListener("click",(e)=>{
                e.preventDefault()
                 elemento.classList.toggle("display_hidden");
                 if(link.active==true){
                     elemento.classList.add("display_hidden");
                 }
               
            })
         }
        

    //Este função é responsável por ocultar as tabelas quando clicado num botão
         const hiddenTabelas =  function (buttonTabela,tabela){

          buttonTabela.addEventListener("click",(e)=>{
            e.preventDefault();
            tabela.classList.toggle("display_hidden");
          })

       }

         //Elementos dos displays
       const estudante_display = document.querySelector("#estudante_layout");
       const link_estudante = document.querySelector("#Estudante");
       const admin_display = document.querySelector("#admin_display");
       const link_admin  = document.querySelector("#admin");
       const presenca_display = document.querySelector("#presenca_display");
       const link_presenca = document.querySelector("#presencas");
       const turma_display = document.querySelector("#turma_display");
       const link_turma = document.querySelector("#turma_link");

        // N esquece de implementa
         displayHidden(estudante_display,link_estudante)
         displayHidden(admin_display,link_admin)
         displayHidden(presenca_display,link_presenca)
         //botoes
         const buttonAdd = document.querySelector("#addTurma");
         const button_tabela_lista = document.querySelector("#ver_tabela_lista")
         const buttonDelete = document.querySelector("#apagar_turma");
        const buttonTable_turma = document.querySelector("#ver_turmas");
        //Tabelas 
        const tabela_presenca = document.querySelector("#tabela_presenca");
        const tabela_turma = document.querySelector("#tabela_turma");

      //Ocultado tabelas
        hiddenTabelas(buttonTable_turma,tabela_turma);
        hiddenTabelas(button_tabela_lista,tabela_presenca);  

        //Terminar sessao 
        // const links_sessao =document.querySelector("#Sessao")
        // links_sessao.addEventListener("click",(e)=>{
        //     e.preventDefault()
        //     alert("A terminar sessao")
           
        // })
    </script>    
</body>
</html>