<?php



function hashId($id)
{
	
	$conv[] = 'C';
	$conv[] = 't';
	$conv[] = 'u';
	$conv[] = 'M';
	$conv[] = 'N';
	$conv[] = 'O';
	$conv[] = 'A';
	$conv[] = 'B';
	$conv[] = '8';
	$conv[] = '9';
	$conv[] = 'm';
	$conv[] = 'n';
	$conv[] = 'e';
	$conv[] = 'f';
	$conv[] = 'h';
	$conv[] = 'i';
	$conv[] = 'j';
	$conv[] = 'G';
	$conv[] = 'Q';
	$conv[] = 'R';
	$conv[] = 'S';
	$conv[] = 'o';
	$conv[] = 'p';
	$conv[] = 'q';
	$conv[] = 'r';
	$conv[] = 's';
	$conv[] = 'J';
	$conv[] = 'K';
	$conv[] = 'L';
	$conv[] = 'y';
	$conv[] = 'v';
	$conv[] = 'w';
	$conv[] = 'x';
	$conv[] = 'k';
	$conv[] = 'l';
	$conv[] = 'H';
	$conv[] = 'I';
	$conv[] = 'X';
	$conv[] = 'Y';
	$conv[] = 'P';
	$conv[] = '5';
	$conv[] = '6';
	$conv[] = '7';
	$conv[] = '1';
	$conv[] = '2';
	$conv[] = 'z';
	$conv[] = 'D';
	$conv[] = 'Z';
	$conv[] = '0';
	$conv[] = 'T';
	$conv[] = 'U';
	$conv[] = 'V';
	$conv[] = 'E';
	$conv[] = 'a';
	$conv[] = 'b';
	$conv[] = '3';
	$conv[] = '4';
	$conv[] = 'F';
	$conv[] = 'c';
	$conv[] = 'd';
	$conv[] = 'g';
	$conv[] = 'W';
	
	$result = '';
	
	while($id >= 1)
	{
		$result = $conv[($id%62)] . $result;
		$id = $id/62;
	}
	
	return $result;
}

function idHash($hash)
{
	
	$conv['C'] = 0;
	$conv['t'] = 1;
	$conv['u'] = 2;
	$conv['M'] = 3;
	$conv['N'] = 4;
	$conv['O'] = 5;
	$conv['A'] = 6;
	$conv['B'] = 7;
	$conv['8'] = 8;
	$conv['9'] = 9;
	$conv['m'] = 10;
	$conv['n'] = 11;
	$conv['e'] = 12;
	$conv['f'] = 13;
	$conv['h'] = 14;
	$conv['i'] = 15;
	$conv['j'] = 16;
	$conv['G'] = 17;
	$conv['Q'] = 18;
	$conv['R'] = 19;
	$conv['S'] = 20;
	$conv['o'] = 21;
	$conv['p'] = 22;
	$conv['q'] = 23;
	$conv['r'] = 24;
	$conv['s'] = 25;
	$conv['J'] = 26;
	$conv['K'] = 27;
	$conv['L'] = 28;
	$conv['y'] = 29;
	$conv['v'] = 30;
	$conv['w'] = 31;
	$conv['x'] = 32;
	$conv['k'] = 33;
	$conv['l'] = 34;
	$conv['H'] = 35;
	$conv['I'] = 36;
	$conv['X'] = 37;
	$conv['Y'] = 38;
	$conv['P'] = 39;
	$conv['5'] = 40;
	$conv['6'] = 41;
	$conv['7'] = 42;
	$conv['1'] = 43;
	$conv['2'] = 44;
	$conv['z'] = 45;
	$conv['D'] = 46;
	$conv['Z'] = 47;
	$conv['0'] = 48;
	$conv['T'] = 49;
	$conv['U'] = 50;
	$conv['V'] = 51;
	$conv['E'] = 52;
	$conv['a'] = 53;
	$conv['b'] = 54;
	$conv['3'] = 55;
	$conv['4'] = 56;
	$conv['F'] = 57;
	$conv['c'] = 58;
	$conv['d'] = 59;
	$conv['g'] = 60;
	$conv['W'] = 61;
	
	$result = 0;
	$cpt = 0;
	while(strlen($hash) > 0)
	{
		$result = $result + (($conv[substr($hash,strlen($hash)-1)]) * pow(62,$cpt));
		
		$cpt++;
		$hash = substr($hash,0,strlen($hash)-1);
	}
	
	error_log("result : ".$result);
	return $result;
}




function bddConnect()
{
	include('config.php');
	//Récupération du dernier hash
	try {
		return new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $passwd);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}
}

function addBdd($name, $md5)
{
	$bdd = bddConnect();
	
	$reponse = $bdd->query("SELECT id, md5 FROM reg_rglsit order by id desc");
	
	$donnees = $reponse->fetch();
	$id = $donnees['id'];
	
	
	
	
	$newhash = hashId($id+1);
	
	
	//Enregistrement dans la BDD
	$req = $bdd->prepare("INSERT INTO reg_rglsit(id, name, hash, md5, date) VALUES('', '".$name."', '".$newhash."','".$md5."',now())");
	
	
	
	$req->execute();
	$req->closeCursor();
	//Envoi en retour du hash
	
	//$bdd = null;
	return $newhash;
}

function addUrlBdd($url,$name)
{
	$bdd = bddConnect();
	
	$reponse = $bdd->query("SELECT id, url FROM reg_rglsit order by id desc");
	
	$donnees = $reponse->fetch();
	$id = $donnees['id'];
	
	
	
	
	$newhash = hashId($id+1);
	
	
	//Enregistrement dans la BDD
	$req = $bdd->prepare("INSERT INTO reg_rglsit(id,name , hash, url, date) VALUES('', '".$name."', '".$newhash."','".$url."',now())");
	
	$req->execute();
	$req->closeCursor();
	//Envoi en retour du hash
	
	//$bdd = null;
	return $newhash;
}

function notOnBdd($md5)
{
	$bdd = bddConnect();
	
	$reponse = $bdd->query("SELECT hash FROM reg_rglsit where md5='".$md5."'");
	//$bdd = null;
	
	$donnees = $reponse->fetch();
	
	if(($hash = $donnees['hash']) != '')
	{
		return $hash;
	}
	else
	{
		return 0;
	}
	return 0;
}


function urlNotOnBdd($url)
{
	$bdd = bddConnect();
	
	$reponse = $bdd->query("SELECT hash FROM reg_rglsit where url='".$url."'");
	
	$donnees = $reponse->fetch();
	
	if(($hash = $donnees['hash']) != "")
	{
		return $hash;
	}
	else
	{
		return 0;
	}
	return 0;
}


function getWebloc($path)
{
	if($webloc = fopen($path, 'r'))
	{
		while(!feof($webloc))
		{
			$data =  trim(fgets($webloc));
			
			
			if(($begin = strpos($data,"<string>")) == "0" && ($end = strpos($data,"</string>")))
			{
				$len = strlen($data) - 17;
				return substr($data,$begin+8,$len);
			}
			
		}
	}
	return 0;
}


?>