<?php

include("config.php");
include("function.php");

//Récupération du nom du fichier dans la BDD
$bdd = bddConnect();

$score = $_POST['score'];
$nom = $_POST['nom'];


$reponse = $bdd->query("SELECT * FROM snake ORDER BY scoreJeu DESC LIMIT 0,3");

while($donnees = $reponse->fetch())
{
	$tableauDeScore[] = $donnees['scoreJeu'];
	$nomDesJoueurs[] = $donnees['nom'];
}

$reponse = $bdd->query("SELECT * FROM snake WHERE nom = '".$nom."'");

while($donnees = $reponse->fetch())
{
	$highScoreJoueur = $donnees['scoreJeu'] ;
}

$highScoreJoueur = isset($highScoreJoueur) ? $highScoreJoueur  : 0;

$reponse->closeCursor();


if($highScoreJoueur == 0 && $score != 0 && $nom != "")
{
	
	$bdd->exec("INSERT INTO snake VALUES('','$score','$nom')");
	$reponse = $bdd->query("SELECT * FROM snake ORDER BY scoreJeu DESC LIMIT 0,3");

	while($donnees = $reponse->fetch())
	{
		$tableauDeScore[] = $donnees['scoreJeu'];
		$nomDesJoueurs[] = $donnees['nom'];

	}
}
else if($score > $highScoreJoueur && $score != 0 && $nom != "")
{
	
	$bdd->exec("UPDATE snake SET scoreJeu = '".$score."' WHERE nom = '".$nom."'");
	$reponse = $bdd->query("SELECT * FROM snake ORDER BY scoreJeu DESC LIMIT 0,3");

	while($donnees = $reponse->fetch())
	{
		$tableauDeScore[] = $donnees['scoreJeu'];
		$nomDesJoueurs[] = $donnees['nom'];

	}		
	
}


?><div id="topSnake"><div id="premierJoueur"><?php echo $nomDesJoueurs[0]; ?> : <span id="score<?php echo $nomDesJoueurs[0]; ?>"><?php echo $tableauDeScore[0]; ?></span></div><div id="deuxiemeJoueur"><?php echo $nomDesJoueurs[1]; ?> : <span id="score<?php echo $nomDesJoueurs[0]; ?>"><?php echo $tableauDeScore[1]; ?></span></div><div id="troisiemeJoueur"><?php echo $nomDesJoueurs[2]; ?> : <span id="score<?php echo $nomDesJoueurs[0]; ?>"><?php echo $tableauDeScore[2]; ?></span></div></div><?php

        
      		  
      		 
    
?>