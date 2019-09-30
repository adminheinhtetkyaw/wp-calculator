<?php /**
 * Izračun stroškov kajenja
 */?>
<div id="isk" class="wrapper">
	<p>
        <label for="cpr" class="itm-label">Cena škatlice</label> <input type="text" id="cpr" class="itm-input" value="" required> EUR
    </p>
    <p>
        <label for="cpp" class="itm-label">Število cigaret v škatlici </label> <input type="text" id="cpp" class="itm-input" value="20" required>
    </p>
    <p>
        <label for="cpd" class="itm-label">Število dnevno pokajenih cigaret</label> <input type="text" id="cpd" class="itm-input" value="" required>
    </p>
    <p>
        <label for="age" class="itm-label">Starost v letih</label> <input type="text" id="age" class="itm-input" value="" required>
    </p>
    <p>
        <label for="cst" class="itm-label">Koliko let že kadite</label> <input type="text" id="cst" class="itm-input" value="" required>
    </p>
    <p>
    	<span class="radio-label">Sem</span> <input type="radio" name="sex" value="m" class="sex-input" required> <span class="radio-label">Moški</span> <input type="radio" name="sex" value="z" class="sex-input"> <span class="radio-label">Ženska</span>
    </p>
    <p>
    	 <button class="itm-input">Izračunaj</button>
    </p>
    <div class="isk-results">
    	<div class="error" style='display:none;'></div>
    	<div class="resultbox"><span>Tedenski strošek</span><div class="currency" id="wcc"></div></div>
    	<div class="resultbox"><span>Mesečni strošek</span><div class="currency" id="mcc"></div></div>
    	<div class="resultbox"><span>Letni strošek</span><div class="currency" id="ycc"></div></div>
    	<div class="resultbox"><span>Do sedaj ste zapravili</span><div class="currency" id="ctd"></div></div>
    	<div class="resultbox"><span>Do konca življenja boste zapravili še<sup>*</sup></span><div class="currency" id="ccc"></div></div>
    	<div class="resultbox"><span>Skupen strošek od začetka do smrti<sup>*</sup></span><div class="currency" id="lsc"></div></div>
    	<div class="sidenotes" style="">
    		<p>* Izračun temelji na pričakovani povprečni življenjski dobi v Sloveniji (ženske 84 let, moški 78 let). Pričakovani strošek kajenja velja glede na trenutni ceno in ne upošteva povprečne 2,5% letna stopnja rasti cen.</p>
    	</div>
    </div>
</div>
<script>
(function($){
	$("#isk button").click(function(e){
		$(".isk-results .error").hide();
		var err,wcc,mcc,ycc,ctd,ccc;
		var cpr = Number($("#cpr").val().replace(',','.'));
		var cpp = Number($("#cpp").val().replace(',','.'));
		var cpd = Number($("#cpd").val().replace(',','.'));
		var age = Number($("#age").val().replace(',','.'));
		var cst = Number($("#cst").val().replace(',','.'));
		var sex = $(".sex-input:checked").val();
		var exp = sex === 'm'?78:84;
		
		
		$('#cpr')[0].setCustomValidity(cpr?'':'Vnesite ceno zavojčka cigaret ali tobaka v evrih.<br>');
		$('#cpp')[0].setCustomValidity(cpp?'':'Vnesite število cigaret v škatlici.<br>');
		$('#cpd')[0].setCustomValidity(cpd?'':'Vnesite povprečno število dnevno pokajenih cigaret!<br>');
		$('#age')[0].setCustomValidity(age?'':'Vnesite vašo trenutno starost v letih!<br>');
		$('#cst')[0].setCustomValidity(cst?'':'Vnesite število let, ki je preteklo odkar ste zaćeli redno kaditi!<br>');
		$('input[type=radio]')[0].setCustomValidity(sex?'':'Izberite svoj biološki spol!');

		if( $('#cpr')[0].checkValidity() && 
			$('#cpp')[0].checkValidity() && 
			$('#cpd')[0].checkValidity() && 
			$('#age')[0].checkValidity() && 
			$('#cst')[0].checkValidity() &&
			$('input[type=radio]')[0].checkValidity() ) {
			var cost = (cpr / cpp) * cpd;
			wcc = cost * 7;
			mcc = cost * 30;
			ycc = cost * 356;
			ctd = ycc * cst;
			ccc = ycc * (exp - age + cst);
			lsc = ccc + ctd;
			$("#wcc").text(toCurrency(wcc));
			$("#mcc").text(toCurrency(mcc));
			$("#ycc").text(toCurrency(ycc));
			$("#ctd").text(toCurrency(ctd));
			$("#ccc").text(toCurrency(ccc));
			$("#lsc").text(toCurrency(lsc));
		} else {
			err = $('#cpr')[0].validationMessage + 
				$('#cpp')[0].validationMessage + 
				$('#cpd')[0].validationMessage + 
				$('#age')[0].validationMessage + 
				$('#cst')[0].validationMessage + 
				$('input[type=radio]')[0].validationMessage;
			$(".isk-results .error").html("<p>" + err + "</p>").show();
		}
	});
	// cpr && cpp && cpd && age && cst && sex
})(jQuery)

function toCurrency(val) {
	val = val.toFixed(2).split(".");
	val[0] = val[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	return val[0] + "," + val[1] + " EUR";


}
</script>