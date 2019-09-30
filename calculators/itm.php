<div id="wrapper">
    <p>
        <label for="height" class="itm-label">Vpišite vašo višino (cm)</label> <input type="text" id="height" class="itm-input" value="">
    </p>
    <p>
        <label for="weight" class="itm-label">Vpišite vašo težo (kg)</label> <input type="text" id="weight" class="itm-input" value="">
    </p>
    <p>
        <b>Vaš indeks telesne mase (ITM) je:</b>
    </p>
    <table class="itm-table">
        <tbody>
            <tr>
                <td rowspan="8" id="result"></td>
                <td></td><td></td>
            </tr>
            <tr id="itm0" class="itm-range">
                <td>do 18,49</td>
                <td>Podhranjenost</td>
            </tr>
            <tr id="itm1" class="itm-range">
                <td>18,5 - 24,9</td>
                <td>Normalna telesna masa</td>
            </tr>
            <tr id="itm2" class="itm-range">
                <td>25,0 - 29,9</td>
                <td>Prekomerna telesna masa</td>
            </tr>
            <tr id="itm3" class="itm-range">
                <td>30,0 - 34,9</td>
                <td>Debelost 1. stopnje</td>
            </tr>
            <tr id="itm4" class="itm-range">
                <td>35,0 - 39,9</td>
                <td>Debelost 2. stopnje</td>
            </tr>
            <tr id="itm5" class="itm-range">
                <td>40 - 49,5</td>
                <td>Debelost 3. stopnje</td>
            </tr>
            <tr id="itm6" class="itm-range">
                <td>50 in več</td>
                <td>Morbidna debelost</td>
            </tr>
        </tbody>
    </table>
    <p id="tip">
    </p>
</div>

<script>
(function($) {
    $(".itm-input").keyup(function(){
        var height = parseInt($("#height").val());
        var weight = parseInt($("#weight").val());
        if($.isNumeric(height) && $.isNumeric(weight)) {       
            var itm = weight/(Math.pow(height/100,2))
            $("#result").text((itm).toFixed(2)).addClass("active");
            if(itm < 18.5) { 
                ideal = (18.5*Math.pow(height/100,2))-weight;
                $(".itm-range").removeClass("active");
                $("#itm0").addClass("active");
                $("#tip").text("Za idealno telesno težo morate pridobiti " + (ideal).toFixed(2) + " kilogramov.");
            } else if (itm >= 18.5 && itm < 25) {
                 $(".itm-range").removeClass("active");
                 $("#itm1").addClass("active"); 
                 $("#tip").text("");
            } else if (itm >= 25 && itm < 30) {
                ideal =weight-(25*Math.pow(height/100,2));
                 $(".itm-range").removeClass("active");
                 $("#itm2").addClass("active"); 
                 $("#tip").text("Za idealno telesno težo morate izgubiti " + (ideal).toFixed(2) + " kilogramov.");
            } else if (itm >= 30 && itm < 35 ) {
                 ideal =weight-(25*Math.pow(height/100,2));
                 $(".itm-range").removeClass("active");
                 $("#itm3").addClass("active");
                 $("#tip").text("Za idealno telesno težo morate izgubiti " + (ideal).toFixed(2) + " kilogramov.");
            } else if (itm >= 35 && itm < 40 ) {
                 ideal =weight-(25*Math.pow(height/100,2));
                 $(".itm-range").removeClass("active");
                 $("#itm4").addClass("active");
                 $("#tip").text("Za idealno telesno težo morate izgubiti " + (ideal).toFixed(2) + " kilogramov.");
            } else if (itm >= 40 && itm < 50 ) {
                 ideal =weight-(25*Math.pow(height/100,2));
                 $(".itm-range").removeClass("active");
                 $("#itm5").addClass("active");
                 $("#tip").text("Za idealno telesno težo morate izgubiti " + (ideal).toFixed(2) + " kilogramov.");
            } else if (itm >= 50) {
                ideal =weight-(25*Math.pow(height/100,2));
                 $(".itm-range").removeClass("active");
                 $("#itm6").addClass("active"); 
                 $("#tip").text("Za idealno telesno težo morate izgubiti " + (ideal).toFixed(2) + " kilogramov.");
            }        
        } else {
            $("#result").text("").removeClass("active");
            $(".itm-range").removeClass("active");
            $("#tip").text("");
        }    
    });
})(jQuery);
</script>