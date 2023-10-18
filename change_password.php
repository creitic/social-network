<?php
session_start();
require('includes/init.php');
include('filters/auth_filter.php');

if (isset($_POST['change_password'])) {

 	 $errors=[];

 	//Si tous les champs ont ete remplis
 	if (not_empty(['current_password','new_password','new_password_confirmation'])) {
 		
 		extract($_POST);
 		if (mb_strlen($new_password)<6) {
 			$errors[]="Mot de passe trop court !(Minimum 6 caractères)";
 			# code...
 		}
 		else{
 			if ($new_password!=$new_password_confirmation) {
 				# code...
 				$errors[]="Les deux mots de passe ne concordent pas!";
 			}
 		}
		if (count($errors)==0) {
			$q=$db->prepare("SELECT password AS hashed_password FROM users 
 			WHERE (id=:id) AND active='1'
 			");
 		$q->execute([
 			'id' => get_session('user_id')
 		]);

 
 		$user=$q->fetch(PDO::FETCH_OBJ);

 		if($user && bcrypt_verify_password($current_password,$user->hashed_password)){
			$q=$db->prepare('UPDATE users 
			 			SET password=:password 
			 			WHERE id=:id');
			 		$q->execute([
			 			'password'=>$password=bcrypt_hash_password($new_password),
			 			'id'=>get_session('user_id')
			 		]);
			 		
			 		set_flash("Félicitations,Votre mot de pass a été mis à jour!");
			 		redirect('profile.php?id='.get_session('user_id'));
 		}else{
 			save_input_data();
 			$errors[]="Le mot de passe indiqué est incorrect!";
 		
 		}

		}

 		
 		
 	}else{
 		save_input_data();
 		$errors[]="Veuillez remplir tous les champs marqués (*)";
 	}


 }else{
 	clear_input_data();//s'il vient d'arriver fraichement sur la page ,il n'y aucune raison que les
 	//champs soient pre-remplis
 }
 require('views/change_password.view.php');