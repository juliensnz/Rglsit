<?php
$hash = (isset($_GET['hash']) && $_GET['hash'] != "") ? $_GET['hash'] : NULL;


include("config.php");
include("function.php");
$id = idHash($hash);
//Récupération du nom du fichier dans la BDD
$bdd = bddConnect();
$reponse = $bdd->query("select * FROM reg_rglsit WHERE id = '".$id."'");

while($donnees = $reponse->fetch()) {
	$name = $donnees['name'];
	$md5 = $donnees['md5'];
	$url = $donnees['url'];
	$views = $donnees['views'];
	$downloads = $donnees['downloads'];
}
$reponse->closeCursor();


$ext = substr($name, strrpos($name, '.') + 1);
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
  <link rel="apple-touch-icon" href="/sources/apple-touch-icon.png">
  <link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz&subset=latin' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Neucha&subset=latin' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="/sources/css/style.css?v=2">
  <script src="/sources/js/libs/modernizr-1.6.min.js"></script>
	<script src="/sources/js/video.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
	 VideoJS.setupAllWhenReady();
	</script>
	<link rel="stylesheet" href="/sources/css/video-js.css" type="text/css" media="screen" title="Video JS">
</head>

<body>

  <div id="container">
		<div id="stats">
			<div id="fileTitle">
			<?php
			if($md5 != "")
			{
				?>
				<div class="name" id="statName"><span id="filename" data-type="<?php echo $ext ?>"><?php echo $name; ?></span></div><div id="viewStats"><?php echo $views; ?></div><div id="downloadStats"><?php echo $downloads; ?></div>
				<?php
			}
			else if($url != "")
			{
				?>
				<div class="name" id="statName"><span id="urlname"><?php echo $url; ?></span></div><div id="viewStats"><?php echo $views; ?></div>
				<?php
			}
			?>
			
			</div>
		
		</div>
		<div id="cache" ><div id="back" onclick="hidePreview()"></div><div id="markdownPreview"><div id="closeButton" onclick="hidePreview()"</div></div><div id="markdownContent"></div></div>
		
	</div> <!-- end of #container -->


  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
  <script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.2.js"%3E%3C/script%3E'))</script>
  
  
  <!-- scripts concatenated and minified via ant build script-->
  <script src="/sources/js/plugins.js"></script>
  <script src="/sources/js/script.js"></script>
  <!-- end concatenated and minified scripts-->
  
  
  <!--[if lt IE 7 ]>
    <script src="js/libs/dd_belatedpng.js"></script>
    <script> DD_belatedPNG.fix('img, .png_bg'); </script>
  <![endif]-->

  <!-- yui profiler and profileviewer - remove for production -->
  <script src="/sources/js/profiling/yahoo-profiling.min.js"></script>
  <script src="/sources/js/profiling/config.js"></script>
  <!-- end profiling code -->


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