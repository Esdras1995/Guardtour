<?php 
  require_once("../model/session.php");
  require_once('../model/models.php');

  $post = new Post();
  $guard = new Guard();
  $guardTours = new GuardTours();
  $tours = new Tours();

  $list = "";

  if(isset($_GET["page"])){

    $page = strip_tags(htmlspecialchars($_GET["page"]));

    switch ($page) {

      case 'post':
        # code...
        $list = $post->_list("poste", "*");
        $_SESSION['page'] = "Post";

        break;
      
      case 'guard':
        # code...
        $_SESSION['page'] = "Guard";
        $list = $guard->_list("guard", "*");

        break;

      case 'guardTours':
        # code...
        $list = $guardTours->_list("guardtours", "*");
        $_SESSION['page'] = "Guard tours";
        break;
      
      case 'tours':
        # code...
        $list = $tours->_list("tours", "*");
        $_SESSION['page'] = "Tours";
        break;

      case 'users':
        # code...
        $list = $tours->_list("admin", "*");
        $_SESSION['page'] = "Users";
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