<?php 
  require_once("../model/session.php");
  require_once('../model/models.php');
  $controllerCalled = 1;
  $tours = new Tours();
  $model = new Model();

  $list = "";

  if(isset($_GET["page"])){

    $page = strip_tags(htmlspecialchars($_GET["page"]));

    switch ($page) {

      case 'post':
        # code...
        $list = $model->_list("poste", "*");
        $_SESSION['page'] = "Post";

        break;
      
      case 'guard':
        # code...
        $_SESSION['page'] = "Guard";
        $list = $model->_list("guard", "*");

        break;

      case 'guardTours':
        # code...
        $list = $model->_list("guardtours", "*");
        $_SESSION['page'] = "Guard tours";
        break;
      
      case 'tours':
        # code...
        $list = $model->_list("tours", "*");
        $_SESSION['page'] = "Tours";
        break;

      case 'users':
        # code...
        $list = $model->_list("admin", "*");
        $_SESSION['page'] = "Users";
        break;

      case 'signature':
        # code...
        $list = $model->_list("signature", "*");
        $_SESSION['page'] = "Signature";
        break;

      case 'docs':
        # code...
        $list = $model->_list("report", "*");
        $_SESSION['page'] = "Docs";
        break;

      case 'company':
        # code...
        $list = $model->_list("company", "*");
        $_SESSION['page'] = "Company Info";
        break;

      default:
        # code...
        header("Location: error.php");
        break;
  }
  
}else{
    header("Location: error.php");
}

  include("../vue/post.php");

 ?>