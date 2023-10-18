<?php
session_start();
require('../config/database.php');
require('../includes/constants.php');
require('../includes/functions.php');


  	 $q = $db->prepare('INSERT INTO users(name, pseudo, email, password, active, 
  	  city, country, sex, available_for_hiring, bio) 
  	   VALUES(:name, :pseudo, :email, :password, :active,:city, :country, :sex,:available_for_hiring, :bio)'); 
  	 $q->execute([ 
  	  'name' => "RAMAHAVITA claudio", 
  	  'pseudo' => "claudio", 
  	  'email' => "claudioramahavita@gmail.com", 
  	  'password' => password_hash('123456', PASSWORD_BCRYPT), 
  	  'active' => 1, 
  	  'city' => 'Depot analakininina', 
  	  'country' => 'Tamatave', 
  	  'sex' =>  'H', 
  	  'available_for_hiring' => '1', 
  	   'bio' => 'Voluptatem velit et non nobis. Ea unde porro dolorem vel assumenda necessitatibus. Itaque sed et culpa vel quia nostrum. Quidem aut nam dolor aperiam fugit porro.'
  	]); 
  	 $id = $db->lastInsertId(); 
  	  $q = $db->prepare("INSERT INTO friends_relationships(user_id1, user_id2, status) 
  	   VALUES(?, ?, ?)"); 
  	    $q->execute([$id, $id, '2']); 
  	    
  	     echo 'claudio added!!!';
