<?php
session_start();
require('includes/init.php');
include('filters/auth_filter.php');


if(!empty($_GET['id']) && $_GET['id']===get_session('user_id')){
	//recuperer les infos sur l'user au bdd en utilisant son id
	$user=find_user_by_id($_GET['id']);
	if(!$user){
		redirect('index.php');
	}
}else{
	redirect('profile.php?id='.get_session('user_id'));
}

if (isset($_POST['update'])) {

 	 $errors=[];

 	//Si tous les champs ont ete remplis
 	if (not_empty(['nom','city','country','sex'])) {
 		
 		extract($_POST);
		
 		$q=$db->prepare('UPDATE users 
 			SET name=:nom, city=:city,
 			country=:country, sex=:sex,
 			twitter=:twitter, github= :github,
 			available_for_hiring= :available_for_hiring, bio= :bio 
 			WHERE id=:id');
 		$q->execute([
 			'nom'=>$nom,
 			'city'=>$city,
 			'country'=>$country,
 			'sex'=>$sex,
 			'twitter'=>$twitter,
 			'github'=>$github,
 			'available_for_hiring'=>!empty($available_for_hiring)?'1':'0',
 			'bio'=>$bio,
 			'id'=>get_session('user_id')
 		]);
 		
 		set_flash("Félicitations,Votre profile a été mis à jour!");
 		redirect('profile.php?id='.get_session('user_id'));
 		
 	}else{
 		$errors[]="Veuillez remplir tous les champs marqués (*)";
 		save_input_data();
 	}


 }else{
 	clear_input_data();//s'il vient d'arriver fraichement sur la page ,il n'y aucune raison que les
 	//champs soient pre-remplis
 }
 require('views/edit_user.view.php');