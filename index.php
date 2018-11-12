<?php 
   
      require_once('class/user.class.php');
      
      

      $user = new User();
      if(isset($_POST['save'])){
            if($user->insert($_POST) == "OK"){
               // $success = "Salvo com sucesso";
              // echo '<script type="text/javascript">alert("Salvo com sucesso");</script>';
               header('location:index.php');
            }else{
                header('location:index.php');
               // $erro = "Ocorreu um erro";
               // echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
            }       
      }

      if(isset($_POST['update'])){
          if($user->update($_POST) == "OK"){
           // echo '<script type="text/javascript">alert("Salvo com sucesso");</script>';
            header('location:index.php');
          }else{
            header('location:index.php');
            //echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
          }
      }

      if(isset($_GET['action'])){
            switch($_GET['action']){
                case 'edit': $employee = $user->getOne($_GET['func']); break;
                case 'delete': if($user->delete($_GET['func'])){
                        header('location:index.php');
                }else{
                        //echo '<script type="text/javascript" >alert("Erro em excluir");</script>';
                } break;
            }
      }
?>
<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Cadastrar Usuário!</title>
  </head>
  <body>
   <!-- Image and text -->
   <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="/docs/4.1/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Cadastro de Usuários
    </a>
    </nav>

    <?php if(isset($_SESSION['success'])){ ?>
        <div class="alert alert-primary" role="alert">
              <?=$_SESSION['success'];
                //$_SESSION['success'] = null;
              ?>  
        </div>
    <?php }else if(isset($_SESSION['erro'])){?>
        <div class="alert alert-danger" role="alert">
             <?=$_SESSION['erro'];
            // $_SESSION['erro'] = null;
             ?>
        </div>
    <?php }?>    
 
     
        <form  method='POST' class='offset-4 mt-5' action='' name='formCad' >
            
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name='name' value="<?=(isset($employee))?($employee['name']):('')?>" class="form-control w-50" id="name">
            </div>
            <div class='form-group'>
               <button type="submit" name='<?=(isset($_GET['action']) == 'edit')?('update'):('save')?>' class="btn btn-primary mt-4 offset-2 lg"><?=(isset($_GET['action']) == 'edit')?('Alterar'):('Salvar')?></button>
               <input type="hidden" name="id" value="<?=(isset($employee['id']))?($employee['id']):('')?>">
            </div>

        </form>


        <table class="table offset-2">
            <thead>
                <tr>
                <th scope="col-2">id</th>
                <th scope="col-5">Nome</th>
                <th scope="col-5"> Opções </th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                 foreach($user->getAll() as $u) {?>
                <tr>
                <th scope="row"><?= $u['id'];?></th>
                <td><?= $u['name'];?></td>
                <td><a  href="?action=edit&func=<?=$u['id']?>" class="btn btn-success sm" >Editar</a>
                <a  href="?action=delete&func=<?=$u['id']?>" class="btn btn-warning sm offset-1">Excluir</a></td>
                </tr>
                <?php
                  } ?>
            </tbody>
    </table>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>