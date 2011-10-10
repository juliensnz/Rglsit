/*
*	Upload files to the server using HTML 5 Drag and drop the folders on your local computer
*
*	Tested on:
*	Mozilla Firefox 3.6.12
*	Google Chrome 7.0.517.41
*	Safari 5.0.2
*	Safari na iPad
*	WebKit r70732
*
*	The current version does not work on:
*	Opera 10.63 
*	Opera 11 alpha
*	IE 6+
*/

function uploader(place, status, targetPHP, show) {
	
	// Upload image files
	upload = function(file) {
		
		// Firefox 3.6, Chrome 6, WebKit
		if(window.FileReader) { 
			// Once the process of reading file
			this.loadEnd = function() {
				
				$("#droplabelBox").text("Uploading...");
				
				bin = reader.result;				
				xhr = new XMLHttpRequest();
				xhr.open('POST', targetPHP+'?up=true', true);
				var boundary = 'xxxxxxxxx';
	 			var body = '--' + boundary + "\r\n";  
				body += "Content-Disposition: form-data; name='upload'; filename='" + file.name + "'\r\n";  
				body += "Content-Type: application/octet-stream\r\n\r\n";  
				body += bin + "\r\n";  
				body += '--' + boundary + '--';      
				xhr.setRequestHeader('content-type', 'multipart/form-data; boundary=' + boundary);

				xhr.upload.addEventListener("progress", uploadProgress, false);
				
				xhr.onreadystatechange = function()
				{ 
					if(xhr.readyState == 4)
					{
						//lorsque la requete est finie :
						var reponse = xhr.responseText;
						$("#progressBar").css({opacity:"0"})
				        $("#droplabelBox").animate({
								opacity:0
							},
							500,
							function(){
								
								$("#cacheDropbox").css({display:"none"});	
								$("#droplabelBox").animate({
										opacity:0
									},
									500,
									function(){
										$("#urlPath").val(reponse);
										$("#urlPath").css({width:"320px"}).select();
										$(".drop").css({height:"90px"});
								});	
							});
							$("#arrowBox").animate({
									opacity:0
									},
									500,
									function(){
										$(this).css({display:"none"});
							});
				      
					}
				}
				// Firefox 3.6 provides a feature sendAsBinary ()
				if(xhr.sendAsBinary != null) {
				
					xhr.sendAsBinary(body);
				// Chrome 7 sends data but you must use the base64_decode on the PHP side
				} else { 
					xhr.open('POST', targetPHP+'?up=true&base64=true', true);
					xhr.setRequestHeader('UP-FILENAME', file.name);
					xhr.setRequestHeader('UP-SIZE', file.size);
					xhr.setRequestHeader('UP-TYPE', file.type);
					xhr.send(window.btoa(bin));
				}
				
				
				
				
				
				/*
				if (show) {
					var newFile  = document.createElement('div');
					newFile.innerHTML = 'Loaded : '+file.name+' size '+file.size+' B';
					document.getElementById(show).appendChild(newFile);		
				}
				
				
				
				if (status) {
					document.getElementById(status).innerHTML = 'Loaded : 100%<br/>Next file ...';
				}
				*/
			}
				
			// Loading errors
			this.loadError = function(event) {
				switch(event.target.error.code) {
					case event.target.error.NOT_FOUND_ERR:
						document.getElementById(status).innerHTML = 'File not found!';
					break;
					case event.target.error.NOT_READABLE_ERR:
						document.getElementById(status).innerHTML = 'File not readable!';
					break;
					case event.target.error.ABORT_ERR:
					break; 
					default:
						document.getElementById(status).innerHTML = 'Read error.';
				}	
			}
		
			// Reading Progress
			this.loadProgress = function(event) {
				if (event.lengthComputable) {
					var percentage = Math.round(((event.loaded * 100) / event.total)/10);
					$("#progressBarValue").css({width:""+percentage+"%"});


				}			
			}
			
				
			// Preview images
			this.previewNow = function(event) {		
				
			}

		reader = new FileReader();
		// Firefox 3.6, WebKit
		if(reader.addEventListener) { 
			reader.addEventListener('loadend', this.loadEnd, false);
			if (status != null) 
			{
				reader.addEventListener('error', this.loadError, false);
				reader.addEventListener('progress', this.loadProgress, false);
				$("#progressBar").css({opacity:"1"});
			}
		
		// Chrome 7
		} else { 
			reader.onloadend = this.loadEnd;
			if (status != null) 
			{
				reader.onerror = this.loadError;
				reader.onprogress = this.loadProgress;
				$("#progressBar").css({opacity:"1"});
			}
		}
		var preview = new FileReader();
		// Firefox 3.6, WebKit
		if(preview.addEventListener) { 
			preview.addEventListener('loadend', this.previewNow, false);
		// Chrome 7	
		} else { 
			preview.onloadend = this.previewNow;
		}
		
		// The function that starts reading the file as a binary string
     	reader.readAsBinaryString(file);
	     
    	// Preview uploaded files
    	if (show) {
	     	preview.readAsDataURL(file);
	 	}
		
  		// Safari 5 does not support FileReader
		} else {
			xhr = new XMLHttpRequest();
			xhr.open('POST', targetPHP+'?up=true', true);
			xhr.setRequestHeader('UP-FILENAME', file.name);
			xhr.setRequestHeader('UP-SIZE', file.size);
			xhr.setRequestHeader('UP-TYPE', file.type);
			xhr.send(file); 
			
			
		}				
	}

	// Function drop file
	this.drop = function(event) {
		
		event.preventDefault();
	 	var dt = event.dataTransfer;
	 	var files = dt.files;
	 	for (var i = 0; i<files.length; i++) {
	 	
			var file = files[i];
			upload(file);
	 	}
	 	
	}
	
	// The inclusion of the event listeners (DragOver and drop)

	this.uploadPlace =  document.getElementById(place);
	this.uploadPlace.addEventListener("dragover", function(event) {
		event.stopPropagation(); 
		event.preventDefault();
	}, true);
	this.uploadPlace.addEventListener("dragenter", function(event) {
		event.stopPropagation(); 
		event.preventDefault();
		$("#arrowBox").css({
			webkitAnimationName:"rotateArrow",
			webkitTransform:"rotate(180deg)"
		});
	}, false);
	this.uploadPlace.addEventListener("dragleave", function(event) {
		event.stopPropagation(); 
		event.preventDefault();
		$("#arrowBox").css({
			webkitAnimationName:"rotateArrowBack",
			webkitTransform:"rotate(0deg)"
		});
	}, false);
	this.uploadPlace.addEventListener("drop", this.drop, false); 
	
}

function uploadProgress(event) {
	if (event.lengthComputable) {
		var percentage = Math.round(((event.loaded * 100) / event.total)*0.9+10);
		$("#progressBarValue").css({width:""+percentage+"%"});
		console.log("per : "+percentage);
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

/*
if(navigator.userAgent.toLowerCase().indexOf('safari') > -1 && navigator.userAgent.toLowerCase().indexOf('chrome') < 0)
{
	
	var dropBox = document.getElementById("cacheDropbox");
	var parent = dropBox.parentNode;
	parent.removeChild(dropBox);
	var newDropBox = document.createElement('input');
	newDropBox.setAttribute("class","cache cacheSafari");
	newDropBox.setAttribute("id","cacheDropbox");
	parent.appendChild(newDropBox);
}*/