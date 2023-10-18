<?php 
session_start();
require('includes/init.php');
include('filters/auth_filter.php');

if (!empty($_GET['id'])) {
 		$data=find_code_by_id($_GET['id']);

 			if (!$data) {
 				$code="";
 			}else{
 				$code=$data->code;
 			}
 		}
 	else{
 			$code="";
 	}
 		
 

//si le formulaire a ete soumis
 if (isset($_POST['save'])) {
 	//Si tous les champs ont ete remplis
 	if (not_empty(['code'])) {
 		extract($_POST);
 		$q=$db->prepare('INSERT INTO codes(code) VALUES (?)');
 		$success=$q->execute([$code]);
 		
 		if($success){
 			$id=$db->lastInsertId();
 			$fullURL=WEBSITE_URL + '/show_code.php?id='.$id;
 			create_micropost_for_the_current_user("Je viens de publier un nouveau code source:".$fullURL);
 			redirect('show_code.php?id='.$id);
 		}else{
 			set_flash("Erreur lors de l'ajout du code source. Veuillez réessayer SVP!");
 			redirect('share_code.php');
 		}
  
 }else{
 	redirect('share_code.php');
 }
}

 require('views/share_code.view.php'); 
 