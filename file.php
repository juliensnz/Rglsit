<?php 
include("config.php");
include("function.php");
$hash = (isset($_GET['hash']) && $_GET['hash'] != "") ? $_GET['hash'] : NULL ; 
$id = idHash($hash);

error_log($id);


//Récupération du nom du fichier dans la BDD
$bdd = bddConnect();


$reponse = $bdd->query("select * FROM reg_rglsit WHERE id = '".$id."'");

while($donnees = $reponse->fetch()) {
	$name = $donnees['name'];
	$md5 = $donnees['md5'];
	$url = $donnees['url'];
	//$views = $donnes['views'];
}
$reponse->closeCursor();

$bdd->exec("UPDATE reg_rglsit SET views=views+1 WHERE id=".$id."");


$ext = strtolower(substr($name, strrpos($name, '.') + 1));

if($ext == "webloc")
{
	$url = getWebloc("./files/".$md5);
	$md5 = "";	
}


if($md5 != "" && $hash !=  "")
{


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
	
	
  <link rel="shortcut icon" href="/favicon.png">
  <link rel="apple-touch-icon" href="/sources/apple-touch-icon.png">
  <link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz&subset=latin' rel='stylesheet' type='text/css'>
	
	<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie&subset=latin' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/sources/css/video-js.css" type="text/css" media="screen" title="Video JS" charset="utf-8">
  <link rel="stylesheet" href="/sources/css/style.css?v=2">
  <script src="/sources/js/libs/modernizr-1.6.min.js"></script>
  <link rel="profile" href="http://microformats.org/profile/hcard"> 
</head>

<body>
	
	<?php
	/*
	if($md5 == "")
	{
		?>
		<div id="container">
			<div id="file">
				<div id="fileTitle"><div class="name" id="statName">File not Found</div></div>
			</div>
		</div>
		<?php
	}
	else
	{
		*/
	?>
	
  <div id="container">
  <div id="logo"><a href="/"><?php echo $SERVER_NAME; ?></a></div>
		<div id="file">
			<div id="fileTitle"><div class="name" id="statName"><span id="filename" data-type="<?php echo $ext ?>"><?php echo $name; ?></span></div><a class="button" id="download" href="http://<?php echo $SERVER_URL; ?>/download.php?hash=<?php echo $hash; ?>">Download</a></div>
			<?php
			if($ext == "zip")
			{
				?>
				<table id="zipList">
				<?php
				$return = "";
				exec("zipinfo -1 \"./files/".$md5."\"",$return);
				foreach($return as $ligne)
				{
					if($ligne[0] != "_")
					{
						$ext = substr($ligne, strrpos($ligne, '.') + 1);
						?>
					<tr>
						<td data-type="<?php echo $ext ?>"><?php echo basename($ligne); ?></td>
					</tr>
				
				<?php
					}
				}
				?>
				</table>
				<?php
			}
			else if($ext == "markdown")
			{
				?>
				<table id="markdown">
					<tr id="trMarkdwonPreview">
						<td class="buttonCell"><span class="button" id="previewButton" onclick="getMarkdownPreview('<?php echo $md5; ?>')">Preview</span></td><td class="labelCell"> as HTML version</td>
					</tr>
					<tr id="trMarkdwonDownload">
						<td class="buttonCell"><span class="button" onclick="markdownDownload('<?php echo $md5; ?>','<?php echo $name; ?>')">Download</span></td><td class="labelCell"> the HTML file</td>
					</tr>
				</table>
				<?php
			}
			else if($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png")
			{
				?>
				<a href="/files/<?php echo $md5 ?>"><img src="./files/<?php echo $md5; ?>" alt="<?php echo $name; ?>" id="imagePreview"/></a><div id="helpLabel"><a href="/files/<?php echo $md5 ?>">(Click to view full size)</a></div>
				<?php
			}
			else if($ext == "mp4" || $ext == "webm" || $ext == "ogv")
			{
				?>
				 <script src="/sources/js/video.js"></script>
				  <script type="text/javascript" charset="utf-8">
      				VideoJS.setupAllWhenReady();
    				</script>
				<div class="video-js-box">
				<video id="videoPreview" class="video-js" controls="controls" preload="auto" >
				<?php
				if($ext == "mp4")
				{
					?>
					 <source src="/files/<?php echo $md5; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
					<?php
				}
				else if($ext == "mov")
				{
					?>
					 <source src="/files/<?php echo $md5; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
					<?php
				}
			    else if($ext == "webm")
				{
					?>
					 <source src="/files/<?php echo $md5; ?>" type='video/webm; codecs="vp8, vorbis"' />
					<?php
				}
			    else if($ext == "ogv")
				{
					?>
					 <source src="/files/<?php echo $md5; ?>" type='video/ogg; codecs="theora, vorbis"' />
					<?php
				}
				else
				{
					?>
			      <!-- Flash Fallback. Use any flash video player here. Make sure to keep the vjs-flash-fallback class. -->
			      <object id="flash_fallback_1" class="vjs-flash-fallback" width="640" height="264" type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf">
			        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
			        <param name="allowfullscreen" value="true" />
			        <param name="flashvars" value='config={"playlist":["", {"url": "/files/<?php echo $md5; ?>","autoPlay":false,"autoBuffering":true}]}' />
			        <!-- Image Fallback. Typically the same as the poster image. -->
			      </object>
			   
				<?php	
				}
				?>
				 </video>
			    </div>
			    <?php
			}
			else if($ext == "mp3" || $ext == "aac" || $ext == "m4a")
			{
				?>
				<audio id="audioPreview" controls="controls" preload="auto" src="/files/<?php echo $md5; ?>" />
			    <?php
			}
			else if($ext == "vcf")
			{
				$_GET['url'] = $md5;
				?><div id="previewVcf"><?php
				include('./vcard.php');
				?></div><?php
			}
			?>
		</div>
		
		<div id="dropletWrapper"><a id="droplet" href="javascript:function iprl5(){var d=document,z=d.createElement('scr'+'ipt'),b=d.body,l=d.location;try{if(!b)throw(0);d.title='(Saving...) '+d.title;z.setAttribute('src','http://<?php echo $SERVER_URL; ?>/create.php?url='+encodeURIComponent(l.href)+'&from=bkmk');b.appendChild(z);}catch(e){alert('Loading');}}iprl5();void(0)" title="Rgls it !" alt="Rgls it !"><img src="/sources/images/droplet.png" title="Rgls it !" alt="Rgls it !"/></a><div id="dropletInfo">Drag this link to your bookmarks to <span>Reglisse</span> any website</div></div>
		
		
		<div id="cache" ><div id="back" onclick="hidePreview()"></div><div id="markdownPreview"><div id="closeButton" onclick="hidePreview()"</div></div><div id="markdownContent"></div></div>
		
	</div> <!-- end of #container -->
	<?php
	//}
	?>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
  <script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.2.js"%3E%3C/script%3E'))</script>
  
  
  <!-- scripts concatenated and minified via ant build script-->
  <script src="/sources/js/plugins.js"></script>
  
 
  
  <script src="/sources/js/script.js"></script>
  <!-- end concatenated and minified scripts-->
  <?php
  	 			if($ext == "vcf")
				{
					?>
  				<script>
					previewVcf("<?php echo $md5; ?>");
				</script>
				<?php
				}
  ?>
  
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
<?php
}
else if($url != "")
{
	$url = ((substr($url,0,7) != "http://") ? "http://" : "").$url;
	
	?>
	<!doctype html>
	<html>
		<head>
			<title><?php echo $name; ?></title>
			<meta http-equiv="Refresh" content="0;url=<?php echo $url ;?>">
		</head>
		<body>
		
		</body>
	</html>
	<?php
}
else
{
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
	
	
  <link rel="shortcut icon" href="/favicon.png">
  <link rel="apple-touch-icon" href="/sources/apple-touch-icon.png">
  <link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz&subset=latin' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Neucha&subset=latin' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie&subset=latin' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/sources/css/video-js.css" type="text/css" media="screen" title="Video JS" charset="utf-8">
  <link rel="stylesheet" href="/sources/css/style.css?v=2">
  <link rel="stylesheet" href="/sources/css/snake.css">
  <script src="/sources/js/libs/modernizr-1.6.min.js"></script>
  <link rel="profile" href="http://microformats.org/profile/hcard"> 
</head>

<body>
	
	
	
  <div id="container">
  <div id="logo"><a href="/"><?php echo $SERVER_NAME; ?></a></div>
  <div id="page404">
	<div id="msg404"><span>Oops !</span><br/>It seems like an error occurred...<br/>Take a break : press the space bar and enjoy a little game</div>
	<div id="snake">
		<div id="terre">
			<div id="jardin"></div>
			<div id="pommeSnake"></div>
		</div>
	</div>
	<div id="snakeScore"></div>
	<div id="yourScore"></div>
	</div>		
		
		
		<div id="dropletWrapper"><a id="droplet" href="javascript:function iprl5(){var d=document,z=d.createElement('scr'+'ipt'),b=d.body,l=d.location;try{if(!b)throw(0);d.title='(Saving...) '+d.title;z.setAttribute('src','http://<?php echo $SERVER_URL; ?>/create.php?url='+encodeURIComponent(l.href)+'&from=bkmk');b.appendChild(z);}catch(e){alert('Loading');}}iprl5();void(0)" title="Rgls it !" alt="Rgls it !"><img src="/sources/images/droplet.png" title="Rgls it !" alt="Rgls it !"/></a><div id="dropletInfo">Drag this link to your bookmarks to <span>Reglisse</span> any website</div></div>
		
		
		<div id="cache" ><div id="back" onclick="hidePreview()"></div><div id="markdownPreview"><div id="closeButton" onclick="hidePreview()"</div></div><div id="markdownContent"></div></div>
		
	</div> <!-- end of #container -->
	

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
  <script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.2.js"%3E%3C/script%3E'))</script>
  
  
  <!-- scripts concatenated and minified via ant build script-->
  <script src="/sources/js/plugins.js"></script>
  
 
  
  <script src="/sources/js/script.js"></script>
   <script src="/sources/js/snake.js"></script>
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
<?php
}
?>
