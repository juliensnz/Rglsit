<?php

include("config.php");
include("function.php");





// Destination folder for downloaded files
$upload_folder = './files';

// If the browser supports sendAsBinary () can use the array $ _FILES
if(count($_FILES)>0) {
	$tmpName = $_FILES['upload']['tmp_name'];
	
	
	
	$content = fopen($tmpName,"r");
	$md5 = md5(fread($content,filesize($tmpName)));
	fclose($content);
	
	if(!($hash = notOnBdd($md5)))
	{
		if(move_uploaded_file($tmpName,'./files/'.$md5))
		{
			echo "http://".$SERVER_URL."/".addBdd(basename($_FILES['upload']['name']), $md5);
			exit();
		}
	}
	else
	{
		$bdd = bddConnect();
		$bdd->exec("UPDATE reg_rglsit SET name='".basename($_FILES['upload']['name'])."' WHERE hash='".$hash."'");
		echo "http://".$SERVER_URL."/".$hash;
	}
		
	
	
	
} else if(isset($_GET['up'])) {
	// If the browser does not support sendAsBinary ()
	if(isset($_GET['base64'])) {
		$content = base64_decode(file_get_contents('php://input'));
	} else {
		$content = file_get_contents('php://input');
	}

	$headers = getallheaders();
	$headers = array_change_key_case($headers, CASE_UPPER);
	$md5 = md5($content);
	if(!($hash = notOnBdd($md5)))
	{
		if(file_put_contents($upload_folder.'/'.$md5, $content)) {
			echo "http://".$SERVER_URL."/".addBdd($headers['UP-FILENAME'], $md5);
			
		}
	}
	else
	{
		$bdd = bddConnect();
		$bdd->exec("UPDATE reg_rglsit SET name='".$headers['UP-FILENAME']."' WHERE hash='".$hash."'");
		echo "http://".$SERVER_URL."/".$hash;
	}
	exit();
}

?>