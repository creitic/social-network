<?php

session_start();
require('../config/database.php');
require('../includes/functions.php');
extract($_POST);
$q=$db->prepare('SELECT id, name, email,pseudo,avatar FROM users 
				WHERE (name LIKE :query 
				OR pseudo LIKE :query 
				OR email LIKE :query) 
				LIMIT 5
				');
$q->execute([
	'query'=>'%'.$query.'%'
]);
$users=$q->fetchAll(PDO::FETCH_OBJ);

if(count($users)>0){
	foreach ($users as $user) { ?>
	<div class="display-box-user">
		<a href="profile.php?id=<?=$user->id ?>">
			<img src="<?=$user->avatar?$user->avatar : get_avatar_url($user->email,100)?>" alt="<?=e($user->pseudo)?>" width="20" class="img-circle">&nbsp;
			<?=e($user->name) ?>
			<br><?=e($user->email) ?>
		</a>
								
	</div>

<?php						
	
}
}else{
	echo '<div class="display-box-user">Aucun utilisateur trouvé.</div>';
}