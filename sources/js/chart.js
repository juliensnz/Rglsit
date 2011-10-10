$(document).ready(function(){
	// on ajuste dynamiquement la hauteur des barres en fonction de l'attribut number
	var charts = $('dl#weekchart > dd > span.bar');
    nombreMax = 0;
    charts.each(function(index) {
	number = parseInt($(this).attr('number'));
        if (number > nombreMax)
            nombreMax = number;
	number = 0;
    });


	charts.each(function(index) {
		$(this).css('height', '0px');
	  var $nombresBarre = $(this).attr('number');
	  var $couleurFondBarre = $(this).css('backgroundColor');
	  var $hauteurTableau = $('dl#weekchart').height();
	//  (x / (nombreMax / barHeight * 100)) * 100
	  var $pourcentage = ($nombresBarre / (nombreMax / $hauteurTableau * 100)) * 100;
	  var i = index+1;
		// utiliser nombreMax ou tu veut la : p
	
	$(this).css({
	  "-webkit-box-shadow": 'inset 0 1px 0 ' + $couleurFondBarre + ", inset 0 2px 0 rgba(255,255,255,.5)",
	  "-moz-box-shadow": 'inset 0 1px 0 ' + $couleurFondBarre + ", inset 0 2px 0 rgba(255,255,255,.5)",
	  "box-shadow": 'inset 0 1px 0 ' + $couleurFondBarre + ", inset 0 2px 0 rgba(255,255,255,.5)",
	});
	

	
	$(this).delay(100*i).queue(function() {
		$(this).css({height: $pourcentage + "px"});
		if ($nombresBarre <= 10) {
			$(this).css({height: "10px"});
		}
	});
	
	$(this).children("strong").html("<span class='liens'><span class='pictos'>A</span> "+$nombresBarre/2 + "</span> | <span class='fichiers'>" + $nombresBarre/2 +" <span class='pictos'>{</span></span>");
	$(this).parent().children("span.total").html($nombresBarre); 	
	$(this).children('em, strong').delay(250*i).queue(function() {
		$(this).css('opacity', 1); 
	});
	$(this).parent().children('span.total').css('top', "-"+($pourcentage+60)+"px").delay(100*i).queue(function() {
		$(this).css('opacity', .1); 
	});
	});
});