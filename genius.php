<?php

include("config.php");
include("function.php");

//RŽcupŽration du nom du fichier dans la BDD
$bdd = bddConnect();

$reponse = $bdd->query("select * FROM reg_rglsit WHERE hash = '".$hash."'");

while($donnees = $reponse->fetch()) {
	$name = $donnees['name'];
	$id = $donnees['id'];
	$md5 = $donnees['md5'];
	$url = $donnees['url'];
	//$views = $donnes['views'];
}
$reponse->closeCursor();

?>

<!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo $SERVER_NAME; ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

 	<meta name="viewport" content=" initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /> 
	<meta name="apple-mobile-web-app-capable" content="yes" /> 
	<link rel="apple-touch-startup-image" href="./sources/images/screen.jpg"> 
  
  
  
  
  <link rel="shortcut icon" href="./favicon.png">
  <link rel="apple-touch-icon" href="sources/apple-touch-icon.png">
  <link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz&subset=latin' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Neucha&subset=latin' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie&subset=latin' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="sources/css/style.css?v=2">
  <script src="sources/js/libs/modernizr-1.6.min.js"></script>
	<link rel="apple-touch-icon" href="icon.png"> 
</head>

<body onload="stats()">

  <div id="container">
  
    <header>
		 <h1><?php echo $SERVER_NAME; ?></h1>
    	<div id="baseline">Genius</div>
    	
    </header>
    
    <div id="main">
   		<div id="genius">
   		<div id="cpu" class="statElement">
   			<div class="label">CPU :</div>
   			<div class="chart">
   				<div id="cpuusage">
   					<div id="cpusys" class="chartpart"></div>
   					<div id="cpuuser" class="chartpart"></div>
   					<div id="cpuidle" class="chartpart"></div>
   				</div>
   			</div>
   			<div class="value"></div>
   		</div>
   		<div id="mem" class="statElement">
   			<div class="label">MEM :</div>
   			<div class="chart">
   				<div id="memusage">
   					<div id="memwired" class="chartpart"></div>
   					<div id="memactive" class="chartpart"></div>
   					<div id="meminactive" class="chartpart"></div>
   				</div>
   			</div>
   			<div class="value"></div>
   		</div>
   		<div id="bandwidth"><div id="upload" class="value"></div><div id="download" class="value"></div></div>
   		</div>
    </div>
    
    <footer>
    	<div id="licence">
    		<div id="button"><a href="http://gantis.fr/2010/12/partagez-avec-rgls-it/">How it works</a></div>
    		<div id="more">more info</div>
    	</div>
    </footer>
  </div> <!-- end of #container -->
<div id="dropletWrapper"><a id="droplet" href="javascript:function iprl5(){var d=document,z=d.createElement('scr'+'ipt'),b=d.body,l=d.location;try{if(!b)throw(0);d.title='(Saving...) '+d.title;z.setAttribute('src','http://<?php echo $SERVER_URL; ?>/create.php?url='+encodeURIComponent(l.href)+'&from=bkmk');b.appendChild(z);}catch(e){alert('Loading');}}iprl5();void(0)" title="Rgls it !" alt="Rgls it !"><img src="/sources/images/droplet.png" title="Rgls it !" alt="Rgls it !"/></a><div id="dropletInfo">Drag this link to your bookmarks to <span>Reglisse</span> any website</div></div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
  <script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.2.js"%3E%3C/script%3E'))</script>
  
  
  <!-- scripts concatenated and minified via ant build script-->
  <script src="sources/js/plugins.js"></script>
  <script src="sources/js/stats.js"></script>
   <script src="sources/js/html5uploader.js"></script>
  <!--<script src="sources/js/script.js"></script>-->
  <!-- end concatenated and minified scripts-->
  
  
  <!--[if lt IE 7 ]>
    <script src="js/libs/dd_belatedpng.js"></script>
    <script> DD_belatedPNG.fix('img, .png_bg'); </script>
  <![endif]-->

  <!-- yui profiler and profileviewer - remove for production -->
  <script src="sources/js/profiling/yahoo-profiling.min.js"></script>
  <script src="sources/js/profiling/config.js"></script>
  <!-- end profiling code -->


  <!-- change the UA-XXXXX-X to be your site's ID -->
  
  <script>
   var _gaq = [['_setAccount', 'UA-704184-11'], ['_trackPageview']];
   (function(d, t) {
    var g = d.createElement(t),
        s = d.getElementsByTagName(t)[0];
    g.async = true;
    g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g, s);
   })(document, 'script');
  </script>
  
</body>
</html>