 <?php 
  session_start(); 
  require("includes/init.php"); 
  include('filters/auth_filter.php'); 


  if(!empty($_GET['id'])){

    if(!user_has_already_liked_the_micropost($_GET['id'])){
     like_micropost($_GET['id']);

    }
  	} 

 redirect('profile.php?id='.get_session('user_id').'#micropost'.$_GET['id']);
