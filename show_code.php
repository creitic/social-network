<?php 
session_start();
require('includes/init.php');
include('filters/auth_filter.php');

 	//Si tous les champs ont ete remplis
 	if (!empty($_GET['id'])) {
 		
 			$data=find_code_by_id($_GET['id']);

 			if (!$data) {
 				redirect('share_code.php');
 			}
 		}else{
 	redirect('share_code.php');
 }


 require('views/show_code.view.php'); 
 