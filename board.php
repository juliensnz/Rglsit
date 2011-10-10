<?php

include ("config.php");

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
<link rel="stylesheet" href="sources/css/pictos.css" type="text/css" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="sources/css/board.css" type="text/css" media="screen" title="no title" charset="utf-8">
  <script src="sources/js/libs/modernizr-1.6.min.js"></script>

	
</head>

<body onload="new uploader('cacheDropbox', 'status', 'uploader.php', 'list');">

  <div id="container">
  
    <header>
		 <h1><?php echo $SERVER_NAME; ?></h1>
    	<div id="baseline">Here are the stats, nigga' !</div>	
    </header>
    
    <div id="main">
   
   	<dl id="weekchart">
		
   		<dd><span class="bar" number="1200"><strong></strong><em>29 Nov.</em></span><span class="total"></span></dd>
		<dt>Lundi</dt>                                      
		                                                    
		<dd><span class="bar" number="778"><strong></strong><em>30 Nov.</em></span><span class="total"></span></dd>
		<dt>Mardi</dt>                                      
		                                                    
		<dd><span class="bar" number="256"><strong></strong><em>01 D&eacute;c.</em></span><span class="total"></span></dd>
		<dt>Mercredi</dt>                                   
		                                                    
		<dd><span class="bar" number="420"><strong></strong><em>02 D&eacute;c.</em></span><span class="total"></span></dd>
		<dt>Jeudi</dt>                                      
		                                                    
		<dd><span class="bar" number="1080"><strong></strong><em>03 D&eacute;c.</em></span><span class="total"></span></dd>
		<dt>Vendredi</dt>                                   
		                                                    
		<dd><span class="bar" number="456"><strong></strong><em>04 D&eacute;c.</em></span><span class="total"></span></dd>
		<dt>Samedi</dt>                                     
		                                                    
		<dd><span class="bar" number="98"><strong></strong><em>05 D&eacute;c.</em></span><span class="total"></span></dd>
		<dt>Dimanche</dt>

   	</dl>
    </div>

	<div id="top-domains">
		<ul id="domains">
			<li class="site"><span class="inner-top-domains"><a href="http://<?php echo $SERVER_URL; ?>" class="lien-domain"><strong>http://macgeneration.com/</strong>news/voir/179362/apercu-d-ecoute-2</a><em class="total-domaine">15 liens</em><strong class="dernier-lien">Il y a 5 heures</strong></span></li>
			<li class="site"><span class="inner-top-domains"><a href="http://<?php echo $SERVER_URL; ?>" class="lien-domain"><strong>http://www.journaldugeek.com/</strong>2010/12/06/android-2-3-gingerbread-disponible/</a><em class="total-domaine">99 liens</em><strong class="dernier-lien">Il y a 4 heures</strong></span></li>
			<li class="site"><span class="inner-top-domains"><a href="http://<?php echo $SERVER_URL; ?>" class="lien-domain"><strong>http://www.pcinpact.com/</strong>actu/news/60712-hadopi-wikileaks-dadvsi-carla-brunihadopi-wikileaks-dadvsi-carla-brunihadopi-wikileaks-dadvsi-carla-bruni.htm</a><em class="total-domaine">45 liens</em><strong class="dernier-lien">Il y a 3 heures</strong></span></li>
			<li class="site"><span class="inner-top-domains"><a href="http://<?php echo $SERVER_URL; ?>" class="lien-domain"><strong>http://www.tronsoundtrack.co.uk</strong></a><em class="total-domaine">20 liens</em><strong class="dernier-lien">Il y a 2 heures</strong></span></li>
			<li class="site"><span class="inner-top-domains"><a href="http://<?php echo $SERVER_URL; ?>" class="lien-domain"><strong>http://apple.com/</strong>lorem-ipsum</a><em class="total-domaine">20 liens</em><strong class="dernier-lien">Il y a 1 heures</strong></span></li>
		</ul>
	</div>

  </div> <!-- end of #container -->


  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
  <script src="sources/js/chart.js" type="text/javascript" charset="utf-8"></script>
  <script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.2.js"%3E%3C/script%3E'))</script>
  
  
  <!-- scripts concatenated and minified via ant build script-->
  <script src="sources/js/plugins.js"></script>
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
