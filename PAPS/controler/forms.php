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
          
          if($_POST['guard1'] != $_POST['guard2']){

            $poste_id = $model->dynamicSelect("poste", "adress = ?", array($_POST['poste_id']), "id")['id'];
            $guard_id1 = $model->dynamicSelect("guard", "uid = ?", array($_POST['guard1']), "id")['id'];
            $guard_id2 = $model->dynamicSelect("guard", "uid = ?", array($_POST['guard2']), "id")['id'];

            $exist = (empty($model->dynamicSelect("guardtours", "poste_id = ? OR guard_id = ? OR guard_id = ?", array($poste_id, $guard_id1, $guard_id2), "id")))?0:1;
            
            if(!$exist){
              $limit = ($_POST['intervale_limit']<10)?"0".$_POST['intervale_limit']:$_POST['intervale_limit'];
              $new_POST = array(
                0 => array('intervale' =>$_POST['intervale'], 'intervale_limit' =>"00:".$limit."00", 'commence_a' =>$_POST['commence_a1'], 'termine_a' =>$_POST['termine_a1'], 'poste_id' =>$poste_id, 'guard_id' =>$guard_id1), 
                1 => array('intervale' =>$_POST['intervale'], 'intervale_limit' =>"00".$limit."00", 'commence_a' =>$_POST['commence_a2'], 'termine_a' =>$_POST['termine_a2'], 'poste_id' =>$poste_id, 'guard_id' =>$guard_id2)
              );

              for ($i=0; $i < sizeof($new_POST); $i++)
                $message = $form->register("guardtours", $new_POST[$i]);
            }else
              $message = '<span class="alert alert-danger">Post id or guard1 uid or guard2 uid already exist please check the list guard tours.</span>';

          }else
            $message = '<span class="alert alert-danger">Please check guard uid. In your choice guard1 uid = guard2 uid.</span>';
        }

        $postAdress = $model->_list("poste", "adress");
        $guardId = $model->_list("guard", "uid");

        include("../vue/register_guardTours.php");

        break;
        
        
      case 'Tours':
        # code...
        if(isset($_POST['register'])){  
          

          $heure = $_POST['heure'];
          // $uid = $_POST['uid'];

          // $guard_id = $guard->getId("uid = ?", array($uid));
          // $guard_id = $model->dynamicSelect("guard", "uid = ?", array($uid), "id")['id'];
          $guard_tours_id = $_POST['guardtours_id'];
          // $model->dynamicSelect("guardtours", "guard_id = ?", array($guard_id), "id")['id'];
          // $guard_tours_id = $guardTours->getId("guard_id = ?", array($guard_id));
          
          $mention = $tours->getMention($heure, $guard_tours_id);

          if($update){
            
            // $message = $form->update("tours", $_POST, $dataUpdate['id']);
            
            // if($message === 1){
            //   if(isset($_SESSION['data'])) unset($_SESSION['data']);
            //   header("Location: post.php?page=users");
            // }
          }
          else{

            $new_POST = array('date_tour' => $_POST['date_tours'], 'qrcode' => $_POST['qrcode'], 'description' => $_POST['description'], 'heure' => $_POST['heure'], 'mention' => $mention, 'guardtours_id' =>$guard_tours_id);

            $message = $form->register("tours", $new_POST);
          }
        }
        $guardTours = $model->_list("guardtours", "id");
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