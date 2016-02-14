<?php 
	require_once("../model/session.php");
	require_once('../model/models.php');
  require_once("form.php");

  	// $post = new Post();
  	// $guard = new Guard();
  	// $guardTours = new GuardTours();
  	$tours = new Tours();
    $user = new User();
    $model = new Model();
    $form = new Form();

    $controllerCalled = 1;
    $error = "";
    $success = "";
    $dataUpdate = "";
    $update = 0;
    $message = "";

  $h = fopen("debug.txt", "a");
  
  if(isset($_POST['edit'])){

    $_SESSION['data'] = json_decode($_POST['edit'], true);
    
    return;
  }
  
  if(isset($_SESSION['data'])){
    $dataUpdate = $_SESSION['data'];
    $update = 1;
    // unset($_SESSION['data']);
  }

  if(isset($_GET['action'])){
    if($_GET['action'] == 'add'){
      
      if(isset($_SESSION['data'])){
          $dataUpdate = "";
          $update = 0;
          unset($_SESSION['data']);
      }
    }else{
      header("Location: error.php");
    }
  }
  // echo "---------------------------------------------";
  // print_r($dataUpdate);

  fclose($h);
  
/* Not set up */
  // if(isset($_GET['tours'])){

  //   if(strip_tags(htmlspecialchars($_GET["tours"])) === "add"){

  //     if(isset($_POST['date_tour']) && isset($_POST['qrcode']) && isset($_POST['description']) && isset($_POST['heure']) && isset($_POST['uid'])){
        
  //       $date_tour = securite_bdd(strip_tags($_POST['date_tour']));
  //       $qrcode = securite_bdd(strip_tags($_POST['qrcode']));
  //       $description = securite_bdd(strip_tags($_POST['description']));

  //       $heure = securite_bdd(strip_tags($_POST['heure']));
  //       $uid = securite_bdd(strip_tags($_POST['uid']));

  //       // $guard_id = $guard->getId("uid = ?", array($uid));
  //       $guard_id = $model->dynamicSelect("guard", "uid = ?", array($uid), "id")['id'];
  //       $guard_tours_id = $model->dynamicSelect("guardtours", "guard_id = ?", array($guard_id), "id")['id'];
  //       // $guard_tours_id = $guardTours->getId("guard_id = ?", array($guard_id));
        
  //       $mention = $tours->getMention($heure, $guard_tours_id);
  //     }
  //   }

  // }
/* EndComment */



	if(isset($_GET["page"])){

    $page = strip_tags(htmlspecialchars($_GET["page"]));

    switch ($page) {

      case 'Post':
        # code...      

        if(isset($_POST['register'])){
          
          if($update){
            $message = $form->update("poste", $_POST, $dataUpdate['id']);
            if($message === 1){
              if(isset($_SESSION['data'])) unset($_SESSION['data']);
              header("Location: post.php?page=post");
            }
          }

          else
            $message = $form->register("poste", $_POST);
        }

        include("../vue/register_post.php");

        break;


      case 'Guard':
        # code...
        
        if(isset($_POST['register'])){
          
          if($update){
            $message = $form->update("guard", $_POST, $dataUpdate['id']);
            if($message === 1){
              if(isset($_SESSION['data'])) unset($_SESSION['data']);
              header("Location: post.php?page=guard");
            }
          }

          else
              $message = $form->register("guard", $_POST);
        }

        include("../vue/register_guard.php");

        break;


      case 'Guard tours':
        # code...
        
        if(isset($_POST['register'])){
          
          if($update)
              $message = $form->updateGuardtours($dataUpdate['id']);
          else
              $message = $form->registerGuardtours();
        }

        $postAdress = $model->_list("poste", "adress");
        $guardId = $model->_list("guard", "uid");

        include("../vue/register_guardTours.php");

        break;
        
        
      case 'Tours':
        # code...
        
        include("../vue/register_tours.php"); 

        break;
        

      case 'Users':
        # code...
        
        if($update) $dataUpdate['password'] = '';

        if(isset($_POST['register'])){
          
          $_POST['password'] = md5($_POST['password']);
          
          if($update){
            
            $message = $form->update("admin", $_POST, $dataUpdate['id']);
            
            if($message === 1){
              if(isset($_SESSION['data'])) unset($_SESSION['data']);
              header("Location: post.php?page=users");
            }
          }
          
          else
              $message = $form->register("admin", $_POST);

        }

        include("../vue/register_users.php");

        break;


      default:
        # code...
        header("Location: error.php");
        break;
  

    }


  }else
    header("Location: error.php");



?>