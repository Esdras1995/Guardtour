<?php 
	require_once("../model/session.php");
	require_once('../model/models.php');
  require_once("form.php");
  require_once("controler.php");

	$tours = new Tours();
  $user = new User();
  $model = new Model();
  $form = new Form();

  $controllerCalled = 1;
  // $error = "";
  // $success = "";
  $data = "";
  $update = 0;
  $message = "";

  if(isset($_POST['edit'])){

    $_SESSION['data'] = json_decode($_POST['edit'], true);
    
    return;
  }
  
  if(isset($_SESSION['data'])){
    $data = $_SESSION['data'];
    $update = 1;
  }

  // if(isset($_GET['update'])){
  //   if($_GET['update']){
  //     $dataUpdate['page'] = $_GET['page'];
  //     print_r($dataUpdate);
  //   }
  // }
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
        $dataUpdate = ($update && $data['page'] == 'Post')?$data:""; 
        if(isset($_POST['register'])){
          if($update && $data['page'] == 'Post'){
            $message = $form->update("poste", $_POST, $dataUpdate['id']);
            if($message === 1) header("Location: post.php?page=post");
          }
          else{
              $message = $form->register("poste", $_POST);
          }
        }
        include("../vue/register_post.php");
        break;


      case 'Guard':
        # code...
        $dataUpdate = ($update && $data['page'] == 'Guard')?$data:""; 
        if(isset($_POST['register'])){
          
          if($update && $data['page'] == 'Guard'){
            $message = $form->update("guard", $_POST, $dataUpdate['id']);
            if($message === 1) header("Location: post.php?page=guard");
          }
          else{
              $message = $form->register("guard", $_POST);
          }
        }
        include("../vue/register_guard.php");
        break;


      case 'Guard tours':
        # code...
        $dataUpdate = ($update && $data['page'] == 'Guard tours')?$data:""; 
        if(isset($_POST['register'])){
          
          $limit = ($_POST['intervale_limit']<10)?"0".$_POST['intervale_limit']:$_POST['intervale_limit'];
          $limit = "00:".$limit.":00";
          $uid = explode("|", $_POST['guard_id']);
          $adress = explode("|", $_POST['poste_id']);
          $_POST['intervale_limit'] = $limit;
          $_POST['guard_id'] = $model->getBy('guard', 'id', 'uid', $uid[0]);
          $_POST['poste_id'] = $model->getBy('poste', 'id', 'adress', $adress[0]);
          
          if($update && $data['page'] == 'Guard tours'){
            $message = $form->update("guardtours", $_POST, $dataUpdate['id']);
            if($message === 1) header("Location: post.php?page=guardTours");
          }
          else{
            $message = $form->register("guardtours", $_POST);
          }
       }
        $guardId = GuardToursForm::listDataFK()['guard_id'];
        $postId = GuardToursForm::listDataFK()['poste_id'];
        include("../vue/register_guardTours.php");

        break;
        
        
      // case 'Tours':
      //   # code...
      //   if(isset($_POST['register'])){  
          

      //     $heure = $_POST['heure'];
      //     $guard_tours_id = $_POST['guardtours_id'];
      //     $mention = $tours->getMention($heure, $guard_tours_id);
      //     $_POST['mention'] = $mention;

      //     if($update){
            
      //       // $message = $form->update("tours", $_POST, $dataUpdate['id']);
            
      //       // if($message === 1){
      //       //   if(isset($_SESSION['data'])) unset($_SESSION['data']);
      //       //   header("Location: post.php?page=users");
      //       // }
      //     }
      //     else{
      //       $message = $form->register("tours", $_POST);
      //     }
      //   }
      //   $guardTours = $model->_list("guardtours", "id");
      //   include("../vue/register_tours.php"); 

      //   break;
        
      case 'Users':
        # code...

        $dataUpdate = "";
        if(!empty($data)){
          if($update && $data['page'] == 'Users'){
            $dataUpdate = $data;
            $dataUpdate['password'] = '';
          }
        }

        if(isset($_POST['register'])){
          $_POST['password'] = md5($_POST['password']);
          
          if($update && $data['page'] == 'Users'){
            $message = $form->update("admin", $_POST, $dataUpdate['id']);
            if($message === 1) header("Location: post.php?page=users");
          }
          else
              $message = $form->register("admin", $_POST);
        }
        include("../vue/register_users.php");
        break;



      case 'Company Info':
        # code...
        $dataUpdate = ($update && $data['page'] == 'Company Info')?$data:""; 
        if($update && $data['page'] == 'Company Info'){
            $message = $form->update("company", $_POST, $dataUpdate['id']);
            if($message === 1) header("Location: post.php?page=company");
          }
          else{  
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
        $dataUpdate = ($update && $data['page'] == 'Signature')?$data:""; 
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

?>