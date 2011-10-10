/*
file name : scriptFenetres.js
Script du jeu Snake sur le site gantis.fr
Tous droits réservés Julien Sanchez- Merci de ne pas copier
Si vous souhaitez vous inspirer de notre code merci de nous envoyer un mail à mail@gantis.fr

Tout le code suivant est une création originale. Le but de gantis.fr est pédagogique. Notre volonté n'est donc pas de proposer un site disposant du plus de fonction possible, mais d'apprendre et maitriser leurs créations.
*/

//Déclaration des variables utilisés dasn le jeu : 
//variables de taille du jeu
var hauteurJardin = 216;
var largeurJardin = 348;
var tailleElementSnake = 10;
var deplacement = tailleElementSnake;
//variable liés au déplacement :
//Nous mettons la variable sur initialisation au debut du jeu :
var deplacementTeteSnake ="i";
//tableau contenant les positions de chaque élément du snake (tableau à double entrée)
var positionElementSnake = new Array();
//tableau à simple entrée de sauvegarde de la position de la dernière partie du corps pour l'ajout d'un tronçon
var sauvegardeDernier = new Array();
//Variable pour l'initialisation du jeu (pour que le snake parte vers la droite ("d")
var sauvegardeDeplacement = "d";
//la variable d'ajout d'un tronçon est sur faut par defaut
var ajoutCorps = false;
//variable d'optimisation visant à limiter l'utilisation du innerHTML gourmant en ressources
var resultatInnerHTMLSnake = "";
// variable aléatoire pour la position de la balle
var randomX;
var randomY;
//vitesse d'actualisation du jeu (definisant la vitesse de déplacement
var vitesseSnake = 150;
//variable de niveau
var niveauJeuSnake = 0;
//récuperation du score max dans les cookies

var pseudo;


var niveauMaxJeuSnake = 0;

yourScore.innerHTML = "You : "+niveauJeuSnake;

//fin déclaration variables
//mise en place tu plateau de jeu :
var terre = document.getElementById('terre');
var jardin = document.getElementById('jardin');
var pommeSnake = document.getElementById('pommeSnake');
var yourScore = document.getElementById("yourScore");

terre.style.width=largeurJardin+"px";
terre.style.height=hauteurJardin+"px";
//on affiche les scores



//on ajuste la taille de la zone de saisie
//document.getElementById('directionSnake').style.height="2px";
//document.getElementById('directionSnake').style.width="2px";
//fonction de création du serpent (création du  tableau à double entrée et du serpent graphique
function initialisation()
{
	pommeSnake.style.opacity = 1;
	//on vide la varaible de résultat
	resultatInnerHTMLSnake = "";
	//on vide le tableau de position
	positionElementSnake = new Array();
	//on remet la variable d'ajout d'un tronçon à faut
	ajoutCorps = false;
	//on scan les scores pour le tableau de résultat
	scanResultatSnake(); 
	//créatioin et renplissage d'un snake à 10 partie. la tête a la valeur 0 et les autres parties du corps 0+i
for(var i=0; i<10;i++)
{
	positionElementSnake[i] = new Array();
	for(var j = 0; j<2;j++)
	{
		//pour chaque coordonnées nous assignons une valeur horizontale et 0 en vertical. le serpent sera ainsi droit et parllèle à l'horizon.
		if(j==0)
		{
			//nous voulons la tete devant donc pour 0 nous auron (10-0)*deplacement soit la distance maximum au bord gauche.
			positionElementSnake[i][j] = (10-i)*deplacement;
		}
		else
		{
			positionElementSnake[i][j] = 0;
		}
	}
	//a chaque tour de boucle nous ajoutons à la div de résultat (pour limiter l'utilisation de innerHTML)
	resultatInnerHTMLSnake += '<div id="corps'+i+'" class="elementSerpent" style="top:'+positionElementSnake[i][1]+'px;left:'+positionElementSnake[i][0]+'px;"></div>';
	
}
//Nous modifions ensuite la div avec l'innerHTML
jardin.innerHTML = resultatInnerHTMLSnake;
// fin de la fonction
	return;
}
//éxécution de la fonction pour le début du jeu
initialisation();

//la fonction directionSnake() sera éxécutée à chaque appuis sur une touche
document.onkeydown = directionSnake;

//fonction éxécutée en boucle servant à déplacer le snake
function deplacementSnake()
{
	//nous vidons la variable de résultat pour y ajouter les nouvelles infos
	resultatInnerHTMLSnake = "";
	//nous sauvegardons la position du dernier élément au cas ou nous devrions par la suite ajouter une partie au corps du serpent
	//Nous n'avons pas conditionné cette auvegarde car son éxécution consomme moins que l'éxecution d'une conditionnelle.
	sauvegardeDernier[0] = new Array(positionElementSnake[(positionElementSnake.length-1)][0]);
		sauvegardeDernier[1] = new Array(positionElementSnake[(positionElementSnake.length-1)][1]);
	

	
	//nous entregistrons dans une variable la longueur du serpent pour la boucle for	
	var positionDernier = positionElementSnake.length-1;
	//boucle for parcourant le tableau du snake dans le sens inverse (des pied à la tete) pour pouvoir utiliser la position de l'élément précédent avant de se déplacer
for( i = positionDernier; i>=0;i--)
{
	
		
	//si i == 0 (si nous sommes sur la tete)
	if(i == 0)
	{
		//si la variable de déplacement =  haut
		if(deplacementTeteSnake == "h")
		{
			// la position de la tete sera plus haute.. (logique ^^)
			positionElementSnake[i][1] -= deplacement;
		}
		else if(deplacementTeteSnake == "b")
		{
			positionElementSnake[i][1] += deplacement;
		}
		else if(deplacementTeteSnake == "d")
		{
			positionElementSnake[i][0] += deplacement;
		}
		else if(deplacementTeteSnake == "g" )
		{
			positionElementSnake[i][0] -= deplacement;
		}
		// si la variable de déplacement est sur pause nous quittons la fonction (return)
		else if(deplacementTeteSnake == "p")
		{
			return;
		}
		
		//on controle ensuite si le snake n'est pas sortie du jardin
	if(positionElementSnake[0][0] < 0 || positionElementSnake[0][1] < 0 || positionElementSnake[0][0] > largeurJardin || positionElementSnake[0][1] > hauteurJardin)
		{
			perdu();
				return;	
		}
		
	}
	//si nous sommes sur une autre partie du corps que la tete :
	else
		{
		     // controle que le snake ne se mange pas lui même
			if(positionElementSnake[i][0] == positionElementSnake[0][0] && positionElementSnake[i][1] == positionElementSnake[0][1] && (i != 1))
			{
				//dans ce cas on éxecute la fonction perdu et on quitte la fonction
				perdu();
				return;
			}
			//sinn les éléments suivant la tete prennent la position de leur prédécesseur
			positionElementSnake[i][0] = positionElementSnake[i-1][0];
			positionElementSnake[i][1] = positionElementSnake[i-1][1];
			
		}
		
		//on stocke le tout à chaque tour de boucle dans la variable résultat
	resultatInnerHTMLSnake += '<div id="corps'+i+'" class="elementSerpent" style="top:'+positionElementSnake[i][1]+'px;left:'+positionElementSnake[i][0]+'px;"></div>';
	
	
}
// si le snake a mangé une pomme
if(positionElementSnake[0][0] == randomX && positionElementSnake[0][1] == randomY)
{
	//la variable d'ajout d'une partie du corps est mis sur vraie
	ajoutCorps = true;
	//le joueur gagne un niveau
	niveauJeuSnake++;
	//la vitesse d'actualistion de la fonction est grandie de 2%
	vitesseSnake =vitesseSnake -  vitesseSnake*0.02;
	
	yourScore.innerHTML = "You : "+niveauJeuSnake;
	
	if(niveauJeuSnake > niveauMaxJeuSnake)
	{
		niveauMaxJeuSnake = niveauJeuSnake;
		if(pseudo != "")
		{
			envoyerResultatSnake(niveauJeuSnake,pseudo);
		}
	
	}
	//scan des hight scores du serveur
	scanResultatSnake();
	
	//on actualise les information de score
	//document.getElementById('infoJeuSnake').innerHTML = "Niveau : "+niveauJeuSnake+" Niveau max : "+niveauMaxJeuSnake+"";
	
	
	//génération d'une nouvelle pomme
	positionnementBalle();

}
// on met à jour la div
jardin.innerHTML = resultatInnerHTMLSnake;
// au cas ou l'ajout d'un élément est vrai
	if(ajoutCorps)
	{
		
		//nous ajoutons un tableau à la fin du tableau qui prend la valeur de la sauvegarde
		positionElementSnake[positionElementSnake.length] =  new Array(sauvegardeDernier);
		// la variable d'ajout du corps reprend la valeur fausse
		ajoutCorps = false;
	
	
	}
	// on rééxécutera la fonction dans le prochaine (vitesseSnake) ms
	setTimeout(function() { deplacementSnake(); }, vitesseSnake); 
}
	


//fonction de scan du clavier
function directionSnake(event)
{
	var KeyID = (event.keyCode) ? (event.keyCode) : (event.which);
	
	/*if(navigateur == "firefox" || navigateur == "safari")
	{
		car = e.charCode;
	}
	else if(navigateur == "msie" || navigateur == "opera")
	{
		car = event.keyCode;
	}*/
	
	 //si la touche z est enfoncée et que le snake ne vas pas déja vers le haut ou le bas
	if(KeyID == 38 && (deplacementTeteSnake != "h" && deplacementTeteSnake != "b"))
	{
		//haut
		deplacementTeteSnake = "h";
	}
	else if(KeyID == 39  && (deplacementTeteSnake != "g" && deplacementTeteSnake != "d"))
	{
		//droite
		deplacementTeteSnake = "d";
	}
	else if(KeyID == 40  && (deplacementTeteSnake != "h" && deplacementTeteSnake != "b"))
	{
		
		//bas
		deplacementTeteSnake = "b";
		
		
		
	}
	else if(KeyID == 37  && (deplacementTeteSnake != "g" && deplacementTeteSnake != "d"))
	{
		//gauche
		deplacementTeteSnake = "g";
	}
	else if(KeyID == 32)
	{
		//pause
		//si le snake n'est ps en pause ou en initialisation (au début)
		if(!(deplacementTeteSnake == "p" ) && !(deplacementTeteSnake == "i") )
		{
		//on sauvegarde la direction de la tete pour la reprise de pause	
		sauvegardeDeplacement = deplacementTeteSnake;
		//et on met la variable de déplacement sur pause
		deplacementTeteSnake = "p";
		}
		//si on est en initialisation
		else if(deplacementTeteSnake == "i")
		{
			//pour l'initialisation on reprend la valeur de départ
			deplacementTeteSnake = sauvegardeDeplacement;
			//la vitesse est remise à zero
			vitesseSnake = 150;
			//lancement de la partie
			positionnementBalle();
			deplacementSnake();
			
		}
		else
		{
			//sinn on reprend le jeu
			deplacementTeteSnake = sauvegardeDeplacement;
			deplacementSnake();
		}
		
	}
	
}
//fonction perdu pour quand le joueur a perdu ^^
function perdu()
{
	alert('perdu');
	//remise à zéro de la partie
	
	if( pseudo == null || pseudo == "")
	{
		pseudo = prompt("It's a new record for you !\nPlease give us your name to write a part of history!");
	}
	envoyerResultatSnake(niveauJeuSnake,pseudo);
	
	niveauJeuSnake = 0;
	vitesseSnake = 150;
	deplacementTeteSnake = "i";
	sauvegardeDeplacement = "d";
	initialisation();
	
	
	return;
}
//positionnement aléatoir de la pomme
function positionnementBalle()
{
	//variable servant à verifier que la pomme n'est pas sur le serpent
	var surLeSnake = true;
	//boucle verifant la condition précédente
	while(surLeSnake)
	{
	//génération de deux nombres aléatoires multiple de la largeur de déplacment et dans le jardin	
	randomX = ((Math.floor(Math.random() * 100)) % Math.floor(largeurJardin/deplacement)*deplacement);
	randomY = ((Math.floor(Math.random() * 100)) % Math.floor(hauteurJardin/deplacement)*deplacement);
	// boucle de vérification
	for(var l = 0;l<(positionElementSnake.length);l++)
	{
		
		if(randomX == positionElementSnake[l][0] && 	randomY == positionElementSnake[l][1])
		{
			l = positionElementSnake.length;
			
		}
		else if((l == positionElementSnake.length-1) && (surLeSnake == true))
		{
			surLeSnake = false;
		}
		
	}
	
	}
	// on place la balle sur le terrain de jeu
	pommeSnake.style.left = randomX+"px";
	pommeSnake.style.top = randomY+"px";
}

function envoyerResultatSnake(niveau,nom)
{
	if(nom != "" && nom != null && niveau != 0)
	{
		$.post("snake.php", { nom: nom, score: niveau },
	   function(data){
	   	console.log(data);
	     document.getElementById('snakeScore').innerHTML = data;
	   });
	}
			
			
			
			
			
	
}
function scanResultatSnake()
{
	$.ajax({ url: "snake.php", success: function(data){
        document.getElementById('snakeScore').innerHTML = data;
      }});

   
}

