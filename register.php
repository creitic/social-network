<?php
session_start();
require('includes/init.php');
include('filters/guest_filter.php');

//si le formulaire a ete soumis
 if (isset($_POST['register'])) {
 	//Si tous les champs ont ete remplis
 	if (not_empty(['nom','pseudo','email','password','password_confirm'])) {
 		# code...
 		$errors=[];
 		#$errors[]="TToto"; //declare tableu avec sa valeure
 		extract($_POST);

 		if (mb_strlen($pseudo)<3) {
 			$errors[]="Pseudo trop court !(Minimum 3 caractères)";
 			# code...
 		}

 		if (! filter_var($email,FILTER_VALIDATE_EMAIL)) {
 			$errors[]="Adresse email invalide!";
 			# code...
 		}

 		if (mb_strlen($password)<6) {
 			$errors[]="Mot de passe trop court !(Minimum 6 caractères)";
 			# code...
 		}
 		else{
 			if ($password!=$password_confirm) {
 				# code...
 				$errors[]="Les deux mots de passe ne concordent pas!";
 			}
 		}

 		if (is_already_in_use('email',$email,'users')) {
 			# code...
 			$errors[]="Adresse email déjà utilisé!";
 		}

 		if (is_already_in_use('pseudo',$pseudo,'users')) {
 			# code...
 			$errors[]="Pseudo déjà utilisé!";
 		}

 		if(count($errors)==0){
 			//Envoi d'un Email d'activation
 			$to=$email;
 			$subject=WEBSITE_NAME."-ACTIVATION DE COMPTE";
 			$password=bcrypt_hash_password($password);//blowfish
 			$token=sha1($pseudo.$email.$password);
 			ob_start();

 			require('templates/emails/activation.tmpl.php');
 			$content=ob_get_clean();
 			
 			$headers='MIME-Version: 1.0' ."\r\n";
 			$headers.='content-type:text/html; charset= iso-8859-1' ."\r\n";
 			mail($to, $subject, $content,$headers);
 			//Informer l'utilisateurs pour qu'il verifie sa boite de reception
 			set_flash("Mail d'activation envoyé!",'success');

 			$q=$db->prepare('INSERT INTO users(name,pseudo,email,password)
 							VALUES (:name,:pseudo,:email,:password)
 				');
 			$q->execute([
 				'name'=> $nom,
 				'pseudo'=>$pseudo,
 				'email'=>$email,
 				'password'=>$password
 			]);

 			redirect('index.php');
 		}
 		else{
 			save_input_data();
 		}

 	}

 	else{
 		$errors[]="Veuillez S'il vous plait remplir tous les champs!";
 		save_input_data();
 	}
 }else{
 	clear_input_data();
 }
?>


<?php
require('views/register.view.php');