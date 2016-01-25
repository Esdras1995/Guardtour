<?php 
  
  require_once('../model/post_model.php');

  $post = new Post();
  $guard = new Guard();
  $guardTours = new GuardTours();
  $tours = new Tours();

  $list = "";
  $currentPage = "";

  if(isset($_GET["page"])){

    $page = strip_tags(htmlspecialchars($_GET["page"]));

    if($page === "post"){
      # code...
      
      $list = $post->_list("poste", "*");
      $currentPage = "post";
      
    }elseif ($page === "guard") {
      # code...
      $currentPage = "guard";
      $list = $guard->_list("guard", "*");

    }elseif ($page === "guardTours") {
      # code...
      
      $list = $guardTours->_list("guardtours", "*");
      $currentPage = "Guard tours";

    }elseif ($page === "tours") {
      # code...
      
      $list = $tours->_list("tours", "*");
      $currentPage = "Tours";

    }else{
        header("Location: error.php");
    }
  
  }else{
    header("Location: error.php");
  }

  include("../vue/post.php");

 ?>