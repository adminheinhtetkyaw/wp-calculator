<div class="wrapper">
	<p>
        <label for="hips" class="itm-label">Vpišite obseg bokov (cm)</label> <input type="text" id="hips" class="itm-input" value="">
    </p>
    <p>
        <label for="waist" class="itm-label">Vpišite obseg pasu (cm)</label> <input type="text" id="waist" class="itm-input" value="">
    </p>
    <p>
    	<span class="radio-label">Sem</span> <input type="radio" name="sex" value="m" class="sex-input"> <span class="radio-label">Moški</span> <input type="radio" name="sex" value="z" class="sex-input"> <span class="radio-label">Ženska</span>
    </p>
    <p>
    	 <button id="calculate" class="itm-input">Izračunaj</button>
    </p>
    <div class="results">
    	<div id="error"></div>
    	<div id="ratio"></div>
    	<div id="rpb-comments"></div>
    </div>
</div>
<script>
(function($){
	$("#calculate").click(function(){

		var err, message1, message2, bg;
		var hips = $("#hips").val();
		var waist = $("#waist").val();
		var sex = $(".sex-input:checked").val();
		var ratio = Math.round(waist/hips*100)/100;
				
		if(hips && waist && sex) {
			err = "";
			if(sex == "z") {
				if(waist <= 80) {
					message1 = "Čestitamo! Obseg vaših bokov je primeren.";
					bg = "green";
				} else if ( waist > 80 && waist <= 88) {
					message1 = "Obseg pasu nad 80 cm ogroža zdravje žensk.";
					bg = "orange";
				} else if (waist > 88) {
					message1 = "Obseg pasu nad 88 cm zelo ogroža zdravje žensk.";
					bg="red";
				}
				if(ratio <= 0.7) {
					message2 = "Čestitamo! Razmerje med vašim pasom in boki je primerno."
					bg = "green";
				} else if (ratio > 0.7 && ratio <= 0.86) {
					message2 = "Razmerje pas/boki nad 0.7 ogroža zdravje žensk."
					bg = "orange";
				} else if(ratio > 0.86) {
					message2 = "Razmerje pas/boki nad 0.86 zelo ogroža zdravje žensk."
					bg="red"
				}
			} else if(sex == "m") {
				if(waist <= 94) {
					message1 = "Čestitamo! Obseg vaših bokov je primeren";
					bg = "green";
				} else if(waist > 94 && waist <= 102) {
					message1 = "Obsega pasu nad 94 cm ogroža zdravje moških.";
					bg = "orange";
				} else if(waist > 102) {
					message1 = "Obseg pasu nad 102 cm zelo ogroža zdravje moških.";
					bg="red"
				}
				if(ratio <= 0.8) {
					message2 = "Čestitamo! Razmerje med vašim pasom in boki je primerno."
					bg = "green";
				} else if (ratio > 0.80 && ratio <= 0.95 ) {
					message2 = "Razmerje pas/boki nad 0.80 ogroža zdravje moških."
					bg = "orange";
				} else if (ratio > 0.95) {
					message2 = "Razmerje pas/boki nad 0.95 zeko ogroža zdravje moških."
					bg="red";
				}
			}
			$("#ratio").text(ratio).removeAttr('class').addClass(bg).show();
			$("#rpb-comments").html("<p>" + message1 +"</p><p>" + message2 + "</p>");
		} else {
			err = "Izpolniti morate vsa polja!";
		} 
		$("#error").html("<p>" + err + "</p>");
		console.log(sex);
	})


	
	
})(jQuery)
</script>