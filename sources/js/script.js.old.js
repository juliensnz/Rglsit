/* Author: 

*/


var file = "";


var dropbox = document.getElementById("cacheDropbox");






// init event handlers
dropbox.addEventListener("dragenter", dragEnterBox, false);
dropbox.addEventListener("dragleave", dragExitBox, false);
dropbox.addEventListener("dragover", dragOverBox, false);
dropbox.addEventListener("drop", dropBox, false);




function dragEnterBox(evt)
{
	evt.stopPropagation();
	evt.preventDefault();
	
	
	$("#arrowBox").css({
		webkitAnimationName:"rotateArrow",
		webkitTransform:"rotate(180deg)"
	});
	
	console.log("dragEnter");
}

function dragExitBox(evt)
{
	evt.stopPropagation();
	evt.preventDefault();
	$("#arrowBox").css({
		webkitAnimationName:"rotateArrowBack",
		webkitTransform:"rotate(0deg)"
	});
	console.log("dragExit");
}

function dragOverBox(evt)
{
	evt.stopPropagation();
	evt.preventDefault();
}





function handleFiles(file) {

	var reader = new FileReader();

	reader.onprogress = handleReaderProgress;
	reader.onloadend = handleReaderLoadEnd;
	
	
	
	reader.readAsText(file);
	
}

function handleReaderProgress(evt) {
	if (evt.lengthComputable) {
		var loaded = (evt.loaded / evt.total);
	}
}

function handleReaderLoadEnd(evt) {
	sendToServer(evt.target.result,file.fileName);
}

function dropBox(evt)
{
	evt.stopPropagation();
	evt.preventDefault();
	
	var files = evt.dataTransfer.files;
	file = files[0];
	
	handleFiles(file);
	
	
}

function sendToServer(file,name)
{
	$("#droplabelBox").animate({
			opacity:0
		},
		500,
		function(){
			$(this).text("Processing...");
			$(this).animate({
				opacity:1
				},
				500,
				function(){
					
				});
		});
		file = file.replace(/(\r\n|\r|\n)/g, "\n");
	$.post(
			"upload.php", 
			{ file: file, name: name },
			function(data){
					
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
									$("#urlPath").val(data);
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
						
			
				
		});
}


















