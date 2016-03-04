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
  
  if(isset($_POST['edit'])){

    $_SESSION['data'] = json_decode($_POST['edit'], true);
    
    return;
  }
  
  if(isset($_SESSION['data'])){
    $dataUpdate = $_SESSION['data'];
    $update = 1;
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

          else{
            $message = post_verify($_POST);
            if($message == "")
              $message = $form->register("poste", $_POST);
          }
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

          else{
            $message = guard_verify($_POST);
            if($message == "")
              $message = $form->register("guard", $_POST);
          }
        }

        include("../vue/register_guard.php");

        break;


      case 'Guard tours':
        # code...
        
        if(isset($_POST['register'])){
          
          $new_POST = getGuardtoursPostMethod($_POST);

          $message = (guardtours_verify($new_POST[0]) != "")?guardtours_verify($new_POST[0]):guardtours_verify($new_POST[1]);

          if($message ==""){

            if($new_POST[0]['guard_id'] != $new_POST[1]['guard_id']){
              for ($i=0; $i < sizeof($new_POST); $i++){
                $message = $form->register("guardtours", $new_POST[$i]);
              }
            
            }else{
               $message = '<span class="alert alert-danger">Please check guard uid. In your choice guard1 uid = guard2 uid.</span>';
            }
          }
        }
        
        $guardpost = $model->_list("guardtours", "poste_id, guard_id");
        $arraId = array("poste_id"=>array(), "guard_id"=>array());
        
        for ($i=0; $i < sizeof($guardpost); $i++)
          foreach ($guardpost[$i] as $key => $value)
              $arraId[$key][] = $value;
        
        $postAdress = $model->dynamicSelectAll("poste", "id NOT IN(".implode(',', $arraId['poste_id']).")", "adress");
        $guardId = $model->dynamicSelectAll("guard", "id NOT IN(".implode(',', $arraId['guard_id']).")", "uid");

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
          
          else{
            if(!$user->exist($_POST['username'], $_POST['email']))
              $message = $form->register("admin", $_POST);
          }

        }

        include("../vue/register_users.php");

        break;

      case 'Company Info':
        # code...
        if(isset($_POST['register'])){  
          $message = $form->register("company", $_POST);
        }
        include("../vue/register_company.php");
        break;

      // case 'Docs':
      //   # code...
      //   if(isset($_POST['register'])){  

      //   }
      //   include("../vue/register_company.php");
      //   break;

      case 'Signature':
        # code...
        if(isset($_POST['register'])){ 
          $chars = $chars = array(":", "/", "-", " ");
          $date = date("Y-m-d h:i:sa");
          $img = str_replace($chars, '', $date).str_replace($chars, '', basename($_FILES["signature"]["name"]));

          $target_dir = "signature/";
          $target_file = $target_dir . $img;//basename($_FILES["signature"]["name"]);
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          move_uploaded_file($_FILES["signature"]["tmp_name"], $target_file);
          $name = $_POST['nom'];
          $role = $_POST['role'];
          $new_POST = array('nom' => $name, 'role'=>$role, 'signature'=>$img);
          $message = $form->register("signature", $new_POST);
        }
        include("../vue/register_signature.php");
        break;


      default:
        # code...
        header("Location: error.php");
        break;
  

    }

  }else
    header("Location: error.php");


function getGuardtoursPostMethod($post){

  $limit = ($post['intervale_limit']<10)?"0".$post['intervale_limit']:$post['intervale_limit'];
  $limit = "00:".$limit.":00";
  
  $guard_id1 = $model->dynamicSelect("guard", "uid = ?", array($post['guard1']), "id")['id'];
  $guard_id2 = $model->dynamicSelect("guard", "uid = ?", array($post['guard2']), "id")['id'];
  $poste_id = $model->dynamicSelect("poste", "adress = ?", array($post['poste_id']), "id")['id'];

  $newpost = array(
    0 => array('intervale' =>$post['intervale'], 'intervale_limit' =>$limit, 'commence_a' =>$post['commence_a1'], 'termine_a' =>$post['termine_a1'], 'poste_id' =>$poste_id, 'guard_id' =>$guard_id1), 
    1 => array('intervale' =>$post['intervale'], 'intervale_limit' =>$limit, 'commence_a' =>$post['commence_a2'], 'termine_a' =>$post['termine_a2'], 'poste_id' =>$poste_id, 'guard_id' =>$guard_id2)
  );

  return $newpost;
}


function guardtours_verify($new_POST){
      
  $message = "";
  
  if(!strtotime($new_POST['intervale_limit']) || !strtotime($new_POST['intervale']) || !strtotime($new_POST['commence_a']) || !strtotime($new_POST['termine_a']))
        $message = '<span class="alert alert-danger">Time format error!</span>';


  elseif(strtotime($new_POST['intervale'])==strtotime("00:00:00"))
    $message = '<span class="alert alert-danger">Intervale error!</span>';

  elseif(strtotime($new_POST['intervale'])<strtotime($new_POST['intervale_limit']))
    $message = '<span class="alert alert-danger">Intervale limit most than the specified intervale!</span>';

  return $message;
}

function guard_verify($post){
  $message = "";

  $model = new Model();
  $uid = $model->dynamicSelect("guard", "uid = ?", array($post['uid']), "id");
  $nif = $model->dynamicSelect("guard", "nif = ?", array($post['nif']), "id");
  $phone = $model->dynamicSelect("guard", "phone = ?", array($post['phone']), "id");
  
  if(!empty($uid))
    $message = '<span class="alert alert-danger">Guard uid already exist!</span>';
  
  elseif(!empty($phone))
    $message = '<span class="alert alert-danger">Guard phone number already exist!</span>';
  
  elseif(!empty($nif))
    $message = '<span class="alert alert-danger">Guard nif already exist!</span>';

  return $message;
}

function post_verify($post){
  $message = "";

  $model = new Model();
  $adress = $model->dynamicSelect("poste", "adress = ?", array($post['adress']), "id");
  
  if(!empty($adress))
    $message = '<span class="alert alert-danger">A post with this adress already exist!</span>';

  return $message;
}
?>