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

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./favicon.png">
  <link rel="apple-touch-icon" href="sources/apple-touch-icon.png">
  <link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz&subset=latin' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Neucha&subset=latin' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie&subset=latin' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="sources/css/style.css?v=2">
  <script src="sources/js/libs/modernizr-1.6.min.js"></script>
	
</head>

<body onload="new uploader('cacheDropbox', 'status', 'uploader.php', 'list');">

  <div id="container">
  
    <header>
		 <h1><?php echo $SERVER_NAME; ?></h1>
    	<div id="baseline">Just reglisse it !</div>
    	
    </header>
    
    <div id="main">
   
   		<div id="droparea">
			<div id="dropbox" class="drop"><div id="arrowBox"></div><span id="droplabelBox">Drop your file here...</span><input type="text" id="urlPath" value=""/></div>
			<input type="file" class="cache" id="cacheDropbox"/>
		</div>
		<div id="progressBarWrapper"><div id="progressBar"><div id="progressBarValue"></div></div></div>
		
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
  <script src="sources/js/md5.js"></script>
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
