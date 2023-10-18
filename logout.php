<?php 
session_start();

require('config/database.php');

//Supprimer l'entrer en bdd au niveau de auth_tokens
$q=$db->prepare('DELETE FROM auth_tokens WHERE user_id=?');
$q->execute([$_SESSION['user_id']]);

//Reinitialisation de la session
$session_keys_white_list=['locale'];
$new_session=array_intersect_key($_SESSION, array_flip($session_keys_white_list));
$_SESSION=$new_session;

//Supprimer les cookies et dettruire la session
setcookie('auth','',time()-3600);

//Redirection
header('Location:login.php');

//Tu trouveras en annexe, un candidat du Madagascar, pour occuper un poste ici.

//Voir si ça peut vous intéresser.
?>