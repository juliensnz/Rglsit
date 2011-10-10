<?php

$md5 = (isset($_GET['md5']) && $_GET['md5'] != "") ? $_GET['md5'] : NULL;
$name = (isset($_GET['name']) && $_GET['name'] != "") ? $_GET['name'] : NULL;





include("config.php");
include("function.php");

//Récupération du nom du fichier dans la BDD

$bdd = bddConnect();

if (($name != NULL) && (file_exists($FILES_FOLDER . $md5))) 
{ 
	
	$size = filesize($FILES_FOLDER . $md5);
	
	
	header("Content-Type: application/force-download; name=\"" . $name . ".html\""); 
	header("Content-Transfer-Encoding: UTF-8"); 
	header("Content-Length: $size"); 
	header("Content-Disposition: attachment; filename=\"" . $name . ".html\""); 
	header("Expires: 0"); 
	header("Cache-Control: no-cache, must-revalidate"); 
	header("Pragma: no-cache"); 
	
	$bdd->exec("UPDATE reg_rglsit SET downloads=downloads+1 WHERE id=".$id."");
}
else
{
	$bdd->exec("UPDATE reg_rglsit SET views=views+1 WHERE id=".$id."");
}

$out = array();
exec('./markdown /Volumes/Partage/rglsit/files/' . $md5 .' 2>&1', $out);

foreach($out as $line)
{
	echo utf8_decode(stripslashes($line))."\n";
}
exit();

?>