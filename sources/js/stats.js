var tab = new Array();

function refreshStats()
{
	setTimeout(function(){ stats()},10000);
}


function stats()
{
	$.ajax({ url: "statdaemon.php", context: document.body, success: function(data){
        eval(data);
        
        displayData(tab);
      }});
	refreshStats();
}

function displayData(table)
{
	var cpusys = document.getElementById("cpusys");
	var cpuuser = document.getElementById("cpuuser");
	var cpuidle = document.getElementById("cpuidle");
	var cpuusage = document.getElementById("cpuusage");
	
	var cpuusagevalue = parseInt(eval(table["cpuusage"])*33);
	
	var memwireddiv = document.getElementById("memwired");
	var memactivediv = document.getElementById("memactive");
	var meminactivediv = document.getElementById("meminactive");
	
	var memused = table["memused"];
	memused = eval(memused.substring(0,memused.length-1));
	
	var memfree = table["memfree"];
	memfree = eval(memfree.substring(0,memfree.length-1));

	var memtotal = memused+memfree;
	
	
	var memwired = table["memwired"];
	memwired = parseInt(eval(memwired.substring(0,memwired.length-1))/memtotal*100);
	
	var memactive = table["memactive"];
	memactive = parseInt(eval(memactive.substring(0,memactive.length-1))/memtotal*100);

	var meminactive = table["meminactive"];
	meminactive = parseInt(eval(meminactive.substring(0,meminactive.length-1))/memtotal*100);
	
	memused = parseInt((memused/memtotal)*100);
	
	
	
	
	cpuusage.style.width = cpuusagevalue+"%";
	
	$("#cpu>.value").text(cpuusagevalue+"%");
	
	cpusys.style.width = table["cpusys"];
	cpuuser.style.width = table["cpuuser"];
	cpuidle.style.width = table["cpuidle"];
	
	memwireddiv.style.width = memwired+"%";
	memactivediv.style.width = memactive+"%";
	meminactivediv.style.width = meminactive+"%";
	
	$("#mem>.value").text(memused+"%");
	
	$("#bandwidth>#upload").text("UP : "+tab["upload"]+"ko/s");
	$("#bandwidth>#download").text("DOWN : "+tab["download"]+"ko/s");
}