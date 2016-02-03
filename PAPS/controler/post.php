<?php 
  require_once("../model/session.php");
  require_once('post_model.php');

  $post = new Post();
  $guard = new Guard();
  $guardTours = new GuardTours();
  $tours = new Tours();

  $list = "";

  if(isset($_GET["page"])){

    $page = strip_tags(htmlspecialchars($_GET["page"]));

    if($page === "post"){
      # code...
      
      $list = $post->_list("poste", "*");
      $_SESSION['page'] = "post";
      $toPage = "post_register.php";
      
    }elseif ($page === "guard") {
      # code...
      $_SESSION['page'] = "guard";
      $list = $guard->_list("guard", "*");

    }elseif ($page === "guardTours") {
      # code...
      
      $list = $guardTours->_list("guardtours", "*");
      $_SESSION['page'] = "Guard tours";

    }elseif ($page === "tours") {
      # code...
      
      $list = $tours->_list("tours", "*");
      $_SESSION['page'] = "Tours";

    }else{
        header("Location: error.php");
    }
  
  }else{
    header("Location: error.php");
  }

  include("../vue/post.php");

 ?>