<?php
session_start();
require_once "../Controladores/controlladorAdmin.php";
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
</head>
<body>
    <section class="text-center">
        
        <div class="p-5 bg-image" style="
            background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
            height: 300px;
            "></div>
        <div class="card mx-4 mx-md-5 shadow-5-strong" style="
            margin-top: -100px;
            background: hsla(0, 0%, 100%, 0.8);
            backdrop-filter: blur(30px);
            ">
            <div class="card-body py-5 px-md-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-5">Iniciar sessão </h2>
                        <form method="post"> 
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email_usuario"  class="form-control"  />
                                <label class="form-label" for="email">Email address</label>
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="pass_usuario" class="form-control" name="pass_usuario" />
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mb-4" name="login">
                                Sign up
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
       <!-- PHP funcionalidades -->
     <?php
            if (isset($_POST["login"])) {  
                    $email = $_POST["email_usuario"];
                    $senha = $_POST["pass_usuario"];
                    $user = new Admin();                  
                    if(empty($email) && empty($senha)){
                   echo "<div class='alert alert-warning' role='alert'>
                     Insira todos dados no formulario
                     </div>";
                        
                    }else{
                          $admin = $user->vereficarCrendecias($email, $senha);

                    }                       
            } else {

                echo "<div class='alert alert-warning' role='alert'>
                     Insira todos dados no formulario
             </div>";
            }
            ?>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
</body>

</html>