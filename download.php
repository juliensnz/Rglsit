<?php

include("config.php");
include("function.php");


$hash=(isset($_GET['hash']) &&  $_GET['hash'] != NULL) ? $_GET['hash'] : NULL;


//Récupération du nom du fichier dans la BDD
$bdd = bddConnect();

$reponse = $bdd->query("select * FROM reg_rglsit WHERE hash = '".$hash."'");

while($donnees = $reponse->fetch()) {
	$name = $donnees['name'];
	$md5 = $donnees['md5'];
}
$reponse->closeCursor();

$bdd->exec("UPDATE reg_rglsit SET downloads=downloads+1 WHERE hash=".$hash."");

if (($name != "") && (file_exists($FILES_FOLDER . $md5))) 
{ 
	
	$size = filesize($FILES_FOLDER . $md5);
	
	
	header("Content-Type: application/force-download; name=\"" . $name . "\""); 
	header("Content-Transfer-Encoding: UTF-8"); 
	header("Content-Length: $size"); 
	header("Content-Disposition: attachment; filename=\"" . $name . "\""); 
	header("Expires: 0"); 
	header("Cache-Control: no-cache, must-revalidate"); 
	header("Pragma: no-cache"); 
	readfile($FILES_FOLDER . $md5); 
	exit(); 
} 
?>