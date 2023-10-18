<?php
require('bootstrap/locale.php');
require('config/database.php');
require('includes/functions.php');
require('includes/constants.php');
if (!empty($_COOKIE['user_id'])&&!empty($_COOKIE['user_pseudo'])) {
	$_SESSION['user_id']=$_COOKIE['user_id'];
	$_SESSION['user_pseudo']=$_COOKIE['user_pseudo'];
	if (!empty($_COOKIE['user_avatar'])) {
		$_SESSION['user_avatar']=$_COOKIE['user_avatar'];
	}else{
		$_SESSION['user_avatar']=[];
	}
}
//Récupération du nombre total de notifications non lues 
$q = $db->prepare("SELECT id FROM notifications 
WHERE subject_id = ? AND seen = '0'"); 
$q->execute([get_session('user_id')]); 
$notifications_count = $q->rowCount();
auto_login();