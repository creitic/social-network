
<!--  requete pour inertion de colone active
	ALTER TABLE users ADD COLUMN active ENUM('0','1') DEFAULT 0';
	 -->
<?php
 //sanitizer
if (!function_exists('e')) {
	# code...
	function e($string){
		if ($string) {
			//strip_tags($string);   enlever les balises
			return htmlspecialchars($string);
			//ou || return htmlentities($string, ENT_QUOTES,'UTF-8',false);

			//permet d'enlever completement les balises : return strip_tags($string);

		}
	}
}


//Permet de creer un micropost pour l'utilisateur connecte
if (!function_exists('create_micropost_for_the_current_user')) {
	# code...
	function create_micropost_for_the_current_user($content){
		global $db;
		$q=$db->prepare('INSERT INTO microposts(content,user_id,created_at) 
			VALUES(:content,:user_id,NOW())');
			$q->execute([
			'content' => $content,
			'user_id' => get_session('user_id')
			]);
	}
}
			 



//Return the likes count of a given micropost
if (!function_exists('get_like_count')) {
	
	function get_like_count($micropost_id){
		global $db;
		$data=[];

		$q = $db->prepare('SELECT like_count FROM microposts WHERE id=:id'); 
      $q->execute(['id'=>$micropost_id]); 
      $data=$q->fetch(PDO::FETCH_OBJ);
      return intval($data->like_count);
	}
}


//Return the likes count of a given micropost
if (!function_exists('get_likers')) {
	
	function get_likers($micropost_id){
		global $db;
		$q = $db->prepare('SELECT users.id, users.pseudo FROM users 
			LEFT JOIN micropost_like 
			ON users.id=micropost_like.user_id 
			WHERE micropost_like.micropost_id=? 
			ORDER BY micropost_like.id DESC
			LIMIT 3'); 
      		
      	$q->execute([$micropost_id]); 

		return($q->fetchAll(PDO::FETCH_OBJ));
	}
}
//display likers of a given micropost
if (!function_exists('get_likers_text')) {
	
	function get_likers_text($micropost_id){
		$like_count=get_like_count($micropost_id);
		$likers=get_likers($micropost_id);


		$output='';
		if($like_count>0){

		$remaining_like_count=$like_count-3;
		$itself_like=user_has_already_liked_the_micropost($micropost_id);

			foreach ($likers as $liker) {
				if(get_session('user_id')!==$liker->id){
						$output.='<a href="profile.php?id='.$liker->id.'">'.e($liker->pseudo).'</a>, ';
					}
				}
				
				$output=$itself_like?'Vous, '.$output
									:$output;
				
				if ($like_count ==2 || $like_count ==3 && $output!="") {
					//retirer toutes les caractères virgule avec espace(", ") de la chaine $output
					$output=trim($output,', ');
					//transformer chaine de caratere separer par virgule en tableau
					$arr=explode(',', $output);
					//retourne le dernier element de la tableau $arr
					$lastItem=array_pop($arr);
					//transformer la tableau $arr en string separer par virgule
					$output=implode(',', $arr);
					$output.=' et '.$lastItem;

				}
				$output=trim($output,', ');
				switch ($like_count) {
					case 1:
						$output.=$itself_like
									?' aimez cela.' 
									:' aime cela.';
						break;
					case 2:
					case 3:
						$output.=$itself_like
									?' aimez cela.' 
									:' aiment cela.';
						break;
					case 4:
						$output.=$itself_like
									?' et 1 une autre personne aimez cela.' 
									:' et 1 une autre personne aiment cela.';
						break;
					
					default:
						$output.=$itself_like
									?' et '.$remaining_like_count.' autres personnes aimez cela.'
									:' et '.$remaining_like_count.' autres personnes aiment cela.';
						break;
				}
			}
		
		return $output;
	}
}

//like micropost
if (!function_exists('like_micropost')) {
	
	function like_micropost($micopost_id){
		global $db;
		 $q = $db->prepare('INSERT INTO micropost_like(user_id,micropost_id) VALUES 
        (:user_id,:micropost_id)'); 
      $q->execute([ 
      'user_id'=>get_session('user_id'),
      'micropost_id' => $micopost_id 
       ]); 

      $q = $db->prepare('UPDATE microposts SET like_count=like_count+1 
        WHERE id=?'); 
      $q->execute([$micopost_id]); 
	}
}

//unlike micropost
if (!function_exists('unlike_micropost')) {
	
	function unlike_micropost($micopost_id){
		global $db;
		$q = $db->prepare('DELETE FROM micropost_like WHERE 
          user_id=:user_id AND micropost_id=:micropost_id'); 
        $q->execute([ 
        'user_id'=>get_session('user_id'),
        'micropost_id' => $micopost_id 
         ]); 

        $q = $db->prepare('UPDATE microposts SET like_count=like_count-1 
          WHERE id=?'); 
        $q->execute([$micopost_id]);
	}
}

 //Check if the current user has already liked the micropost
if (!function_exists('user_has_already_liked_the_micropost')) {
	# code...
	function user_has_already_liked_the_micropost($micropost_id){
		global $db;

		$q = $db->prepare('SELECT id FROM micropost_like 
			WHERE (user_id=:user_id AND micropost_id=:micropost_id)'); 
		$q->execute([ 
			'user_id'=>get_session('user_id'),
			'micropost_id' => $micropost_id 
		]); 
		return (bool) $q->rowCount();


	}
}
//check if the current user is friend with the second user
if (!function_exists('current_user_is_friend_with')) {
	# code...
	function current_user_is_friend_with($second_user_id){
		global $db;
			$q=$db->prepare("SELECT status from friends_relationships 
			WHERE (
			(user_id1=:user_id1 AND user_id2=:user_id2) 
			OR 
			(user_id1=:user_id2 AND user_id2=:user_id1)
					)
			AND status='1' OR status='2'
			");

			$q->execute([
				'user_id1'=>get_session('user_id'),
				'user_id2'=>$second_user_id
			]);
			$count=$q->rowCount();
			$q->closeCursor();
			return (bool) $count;
	}
}

 //check if a friend request has already been sent 
if (!function_exists('if_a_friend_request_has_already_been_sent')) {
	# code...
	function if_a_friend_request_has_already_been_sent($id1,$id2){
		global $db;
			$q=$db->prepare("SELECT status from friends_relationships 
			WHERE (user_id1=:user_id1 AND user_id2=:user_id2) 
			OR (user_id1=:user_id2 AND user_id2=:user_id1)");

			$q->execute([
				'user_id1'=>$id1,
				'user_id2'=>$id2
			]);
			$count=$q->rowCount();
			$q->closeCursor();
			return (bool) $count;
	}
}

 // friend count
if (!function_exists('friends_count')) {
	# code...
	function friends_count($id){
			global $db;
			$q=$db->prepare("SELECT status from friends_relationships 
			WHERE (user_id1=:user_connected OR user_id2=:user_connected) AND 
			status='1'");

			$q->execute([
				'user_connected'=>$id
			]);
			$count=$q->rowCount();
			$q->closeCursor();
			return $count;
	}
}

 //check if a friend request has already been sent
if (!function_exists('relation_link_to_display')) {
	# code...
	function relation_link_to_display($id){
		global $db;
		$q=$db->prepare('SELECT user_id1,user_id2,status FROM friends_relationships 
			WHERE (user_id1=:user_id1 AND user_id2=:user_id2) 
			OR (user_id1=:user_id2 AND user_id2=:user_id1)');
		$q->execute([
			'user_id1'=>get_session('user_id'),
			'user_id2'=>$id
		]);
		$data=$q->fetch();
		if ($data['user_id1']==$id && $data['status']=='0') {
			//Lien pour accepter ou refuser la demande d'amitié
			return "accept_reject_relation_link";//une dmd d'amitié a déjà été envoyer
		}elseif ($data['user_id1']==get_session('user_id') && $data['status']=='0') {
			//Msg pour dire qu'une demmande a deja envoyé ,Lien pour annuler la demande
			return "cancel_relation_link";
		}elseif ($data['status']=='1') {
			//Lien pour supprimer le lien d'amitié
			return "delete_relation_link";
		}
		else{
			//lien pour ajouter la personne comme ami(e)
			return "add_relation_link";
				}
		$q->closeCursor();
	}
}

 //Permet de rendre tous les liens d'une chaine de caractères cliquables
if (!function_exists('replace_links')) {
	# code...
	function replace_links($text){
		//expression regulière
		$regex_url="/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]
		+)?(\/\S*)?/";
		/**
$regex_url="#(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]
		+)?(\/\S*)?#";
		**/

	return preg_replace($regex_url,
		"<a href=\"$0\" target=\"_blank\">$0</a>",
		$text);
	}
}

 //Cell count
//Retourne le nombre d'enregistrements trouvés respectant
//Une certaine condition
if (!function_exists('cell_count')) {
	# code...
	function cell_count($table,$field_name,$field_value){
		global $db;
		$q=$db->prepare("SELECT * FROM $table WHERE $field_name=?");
		$q->execute([$field_value]);
		return $q->rowCount();

	}
}


 //Remember me
if (!function_exists('remember_me')) {
	
	function remember_me($user_id){
		
		global $db;
		//Generer le token de maniere aleatoire
		$token=openssl_random_pseudo_bytes(24);
		//Generer le selecteur de manière aleatoire et s'assurer
		//que ce dernier est unique
		do{
			$selector=openssl_random_pseudo_bytes(9);
		}while (cell_count('auth_tokens','selector',$selector)>0);
		//Sauvez ces infos (user_id,selector,expires(14jours), token(hashed))
		//en bdd
		$q=$db->prepare("INSERT INTO auth_tokens(expires,selector,user_id,token) 
						VALUE(DATE_ADD(NOW(),INTERVAL 14 DAY),:selector,:user_id,:token)");
		$q->execute([
			'selector'=>$selector,
			'user_id'=>$user_id,
			'token'=>hash('sha256',$token)
		]);
		
		//Creer un cookie 'auth' (14 jrs expires) httpOnly => true
		//Contenu: base64_encode(selector).':'.base64_encode(token)

		setcookie(
			'auth',
			base64_encode($selector).':'.base64_encode($token),
			time()+3600*24*14,
			null,
			null,
			false,
			true);//httpOnly est à true
	}
}

 //Auto login
if (!function_exists('auto_login')) {
	# code...
	function auto_login(){
		global $db;
		//Verifier que notre cookie 'auth' existe
		if(!empty($_COOKIE['auth'])){
			$split=explode(':', $_COOKIE['auth']);
			if(count($split)!==2){
				return false;
			}
			// Recuperer via ce cookie selector, token
			
			list($selector,$token)=$split;
			//Decoder notre $selector

		//Verifier au niveau de auth_tokens qu'il y a
		//un enregistrement qui a comme selecteur $selector

			$q=$db->prepare("SELECT auth_tokens.token,auth_tokens.user_id,
				users.id,users.pseudo,users.avatar,users.email
			 FROM auth_tokens 
			 LEFT JOIN users 
			 ON auth_tokens.user_id=users.id 
			 WHERE selector=? AND expires >= CURDATE()");
			$q->execute([base64_decode($selector)]);
			$data=$q->fetch(PDO::FETCH_OBJ);

			if($data){
				//Si on trouve un enregistrement 
				//Comparer les deux tokens
				if(hash_equals($data->token, hash('sha256', base64_decode($token)))){
					//Si tout est bon
					//Enregistrer toutes nos informations en session
					//return true
					$_SESSION['user_id']=$data->id;
 					$_SESSION['user_pseudo']=$data->pseudo;
 					$_SESSION['user_avatar']=$data->avatar;
 					$_SESSION['user_email']=$data->email;
 					return true;
				}
			
			}

		}
		//Dans le cas contraire ,return false
			return false;	

	}
}


 //sanitizer
if (!function_exists('redirect_intent_or')) {
	# code...
	function redirect_intent_or($default_url){
		if ($_SESSION['forwarding_url']) {
			$url=$_SESSION['forwarding_url'];
			$_SESSION['forwarding_url']=null;
		}else{
			$url=$default_url;
		}

		redirect($url);
	}
}



//Get session value by key
if (!function_exists('get_session')) {
	# code...
	function get_session($key){
		if ($key) {
			
			return !empty($_SESSION[$key])?
			e($_SESSION[$key]) : null;
		}
	}
}

//Hash password with blowfish
if (!function_exists('bcrypt_hash_password')) {
	# code...
	function bcrypt_hash_password($value,$options=array()){
		$cost=isset($options['rounds'])? $options['rounds'] : 10;
		$hash=password_hash($value, PASSWORD_BCRYPT,array('cost'=>$cost));
		if ($hash==false) {
			throw new Exception("bcrypt hashing n'est pas supporté.");
			
		}
		return $hash;
	}
}


//Verify password
if (!function_exists('bcrypt_verify_password')) {
	 
	function bcrypt_verify_password($value,$hashedValue){
		return password_verify($value, $hashedValue);
	}
}


//Get the current locale
if (!function_exists('get_current_locale')) {
	# code...
	function get_current_locale($key){
		return $_SESSION['locale'];
	}
}

//Check if an user is connected
if (!function_exists('is_logged_in')) {
	# code...
	function is_logged_in(){
		return isset($_SESSION['user_id'])||isset($_SESSION['user_pseudo']);
	}
}


//Get avatar url
if (!function_exists('get_avatar_url')) {
	function get_avatar_url($email,$size=25){
			return "http://gravatar.com/avatar/".md5(strtolower(trim(e($email))))."?s=".
			$size.'&d=mm';
		
	}
}

//Find an user by id
if (!function_exists('find_user_by_id')) {
	function find_user_by_id($id){
		global $db;
		$q=$db->prepare('SELECT avatar,name,pseudo,email,city,country,twitter,github,sex,available_for_hiring,bio 
			FROM users WHERE id=?');	
		$q->execute([$id]);
		$data=$q->fetch(PDO::FETCH_OBJ);
		$q->closeCursor();
		return $data;

	}
}


//Find an user by id
if (!function_exists('find_code_by_id')) {
	function find_code_by_id($id){
		global $db;
		$q=$db->prepare('SELECT code FROM codes WHERE id=?');
 		$q->execute([$id]);

 		$data=$q->fetch(PDO::FETCH_OBJ);	

		$q->closeCursor();
		return $data;

	}
}

//check si tous les champs existent et ne sont pas vides
if (!function_exists('not_empty')) {
	# code...
	function not_empty($fields=[]){
		if (count($fields!=0)) {
			# code...
			foreach ($fields as $field) {
				# code...
				if(empty($_POST[$field])|| trim($_POST[$field])==""){
					return false;
				}
			}
			return true;
		}
	}
}


//verifie si une valeure pour un champ donné est déja presente
//au niveau de la base de donnée 
	if (!function_exists('is_already_in_use')) {
		# code...
		function is_already_in_use($field,$value,$table){
			global $db;
			$q=$db->prepare("SELECT id from $table where $field=?");

			$q->execute([$value]);
			$count=$q->rowCount();
			$q->closeCursor();
			return $count;
		}
	}


	if (!function_exists('set_flash')) {
	# code...
	function set_flash($message,$type='info'){

	$_SESSION['notification']['message']=$message;
	$_SESSION['notification']['type']=$type;	
	}
	
}
if (!function_exists('redirect')) {
	# code...
	function redirect($page){
		header('Location:'.$page);
		exit();
	}
}


//stock les input venant d'un formulaire stockes de manière temporaire en SESSSION
if (!function_exists('save_input_data')) {
	# code...
	function save_input_data(){
		foreach ($_POST as $key => $value) {
			# code...
			if (strpos($key, 'password')==false) {
				# code...
				$_SESSION['input'][$key]=$value;
			}
		}
	}
}

//recupère des input de formulaire stockes de manière temporaire en SESSSION
if (!function_exists('get_input')) {
	# code...
	function get_input($key){
		return !empty($_SESSION['input'][$key])
		? e($_SESSION['input'][$key])
		: null ;
	}
}

//supprimer tous les input de formulaire stockes de manière temporaire en SESSSION
if (!function_exists('clear_input_data')) {
	# code...
	function clear_input_data(){
		if(isset($_SESSION['input'])){
			$_SESSION['input']=[];
		}
		
	}
}


//gère l'actif de nos différents liens
if (!function_exists('set_active')) {
	# code...
	function set_active($file,$class='active'){
		$url_page=$_SERVER['SCRIPT_NAME'];
		$page_name=explode('/', $url_page);
		$page=array_pop($page_name);
		if($page==$file.'.php'){
			return $class;
		}else{
			return "";
		}
	}
}
