<?php

//echo $_POST['action'];echo $_POST['micropost_id'];
session_start();
require('../config/database.php');
require('../includes/functions.php');
extract($_POST);

if ($action=='like') {
	if(!user_has_already_liked_the_micropost($micropost_id)){
        like_micropost($micropost_id);
      }

}else{
	if(user_has_already_liked_the_micropost($micropost_id)){
	     unlike_micropost($micropost_id);
	    }
}