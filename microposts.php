<?php 
session_start();
require('includes/init.php');
include('filters/auth_filter.php');

if (isset($_POST['publish'])) {

	if (!empty($_POST['content'])) {

		extract($_POST);
		if (mb_strlen($content)<3||mb_strlen($content)>140) {
			# code...
		}else{

			create_micropost_for_the_current_user($content);

			set_flash('Votre status a été mis à jour!');
		}
	}else{
		set_flash('Aucun contenu n\'a été fourni!');
	}
}
redirect('profile.php?id='.get_session('user_id'));