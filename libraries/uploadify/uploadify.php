<?php
require('../../config/database.php');


$targetFolder='/uploads/'.$_SESSION['user_id'];//relative to the root
$verifyToken=md5('unique_salt' . $_POST['timestamp']);
if(!empty($_FILES)&& $_POST['token']==$verifyToken){
	$tempFile=$_FILES['avatar']['tmp_name'];
	$targetPath=$_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	
	if (!file_exists($targetPath)) {
		mkdir($targetPath, 0755, true);
	}

	//validate the file type
	$fileTypes= array('jpg','jpeg','gif','png');//File extension
	$fileParts = pathinfo($_FILES['avatar']['name']);

	$randomFileName=md5(uniqid(rand())) . '.' .$fileParts['extension'];
	//$targetFile=rtrim($targetPath,'/') . '/' .$_FILES['avatar']['name'];
	$targetFile=rtrim($targetPath,'/') . '/' .$randomFileName;

	if (in_array($fileParts['extension'], $fileTypes)) {
		if (move_uploaded_file($tempFile, $targetFile)) {
			$q=$db->prepare('UPDATE users SET avatar=? WHERE id=?');
			//$q->execute(['uploads/'.$_FILES['avatar']['name'], $_POST['user_id']]);
			$q->execute([$targetFolder.'/'.$randomFileName, $_POST['user_id']]);
			$_SESSION['avatar']=$targetFolder.'/'.$randomFileName;
		}
		echo "1";
	}else{
		echo "Type de fichier invalide.";
	}
}