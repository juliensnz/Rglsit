
function getMarkdownPreview(md5)
{
	$("#previewButton").text("Processing...");
	$.ajax({ url: "markdown.php?md5="+md5+"", context: document.body, success: function(data){
		$("#markdownContent").html(data);
        showPreview();
      }});
}

function markdownDownload(md5,name)
{
	window.location.href = "markdown.php?md5="+md5+"&name="+name+"";
}

function showPreview()
{
	$("#cache").css({display:"block"}).animate({opacity:1},500);
}

function hidePreview()
{
	$("#previewButton").text("Preview");
	$("#cache").animate({opacity:0},500,function(){$(this).css({display:"none"});});
}

function adjustName()
{
	if(viewStats = document.getElementById("viewStats"))
	{
		var widthViews = viewStats.offsetWidth;
		if(downloads = document.getElementById("downloadStats"))
		{
			var widthDownloads = downloads.offsetWidth;
		}
		else
		{
			var widthDownloads = 0;
		}
		
		document.getElementById("statName").style.width = (400-(widthViews+widthDownloads+10))+"px";
	}
	
}

adjustName();

function previewVcf(url)
{
	if(preview = document.getElementById("previewVcf"))
	{
		$.ajax({ url: "/vcard.php?url="+url, success: function(data){
	       preview.innerHTML = data;
	     }});
	}
}


if(navigator.userAgent.toLowerCase().indexOf('chrome') > -1)
{
	if(droplet = document.getElementById("droplet"))
	{
		droplet.innerHTML = "Rgls.it";
		droplet.style.display = "block";
		droplet.style.float = "left";
		droplet.style.padding = "4px 12px";
		droplet.style.background = "#848484";
		droplet.style.textShadow= "0px 1px 0px RGBa(0,0,0,0.7)";
		droplet.style.fontWeight = "bold";
		droplet.style.fontSize = "13px";
		droplet.style.margin = "5px 0px";
		droplet.style.color = "#fff";
		droplet.style.borderRadius = "20px";
		droplet.style.textDecoration = "none";
	}	
}

if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)))
{
	window.scrollTo(0, 1);
}