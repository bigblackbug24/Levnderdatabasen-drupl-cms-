<div class="footer" id="footer">
    <div class="container">
        <div class="footer-widget row">
            <div class="left-footer">

                <img src="<?php print $logo; ?>" alt="" />
                <p>Leverand&oslash;rdatabasen er et redaksjonelt produkt eid av Kommunal Rapport.<br/>Sammenstillingen er opphavsrettslig beskyttet.<br/>
                    Ansvarlig redakt&oslash;r og administrerende direkt&oslash;r: <a href="mailto:bsh@kommunal-rapport.no">Britt Sofie Hestvik</a></p><br>
                <p>Boks 1940 Vika, 0125 Oslo.<br/>
                    <a href="mailto:leverandor@kommunal-rapport.no">leverandor@kommunal-rapport.no</a><br/>
                    24 13 64 50.</p>
            </div>


            <div class="footer-right">
                <p>Abonner på vårt nyhetsbrev! Du får max én e-post i måneden.</p>
                <input name="subscribe" placeholder="E-postadresse" class="footer-search"/>
                <input type="submit" name="submit" value="Abonner" class="footer-btn" />
            </div>
        </div>
    </div>

</div>
</div>

</div>
</div>
</body>


</html>

<script type="text/javascript">
    WebFontConfig = {
        google: {families: ['Exo+2:400,600,800,700,300:latin']}
    };

    (function () {
        var wf = document.createElement('script');
        wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();

    /*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
     
     ga('create', 'UA-4041367-3', 'auto');
     ga('send', 'pageview');*/
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-4041367-6', 'auto');
    ga('send', 'pageview');

    $(document).ready(function () {
        jQuery('#node-15 .submitted').hide();
        $(window).scroll(function () {
            $('body').toggleClass("sticky", ($(window).scrollTop() > 50));
        });

        $(".nav-btn").click(function () {
            $(".user-link").toggle(1000);
        });

        $("#edit-locale").css('display', 'none');
        $("#edit-timezone").css('display', 'none');
        $("#edit-picture").css('display', 'none');


        /*
         jQuery('#edit-usertype-privatperson').change(function() { 
         jQuery('.form-item-vnaven').hide();
         jQuery('.form-item-kontaktperson label').html('Navn <span class="form-required" title="This field is required.">*</span>');
         });
         
         jQuery('#edit-usertype-firma').change(function() {
         jQuery('.form-item-vnaven').show();
         jQuery('.form-item-kontaktperson label').html('Kontaktperson <span class="form-required" title="This field is required.">*</span>');
         });
         
         jQuery('#edit-usertype-kommune-fylke').change(function() {
         jQuery('.form-item-vnaven').show();
         jQuery('.form-item-kontaktperson label').html('Kontaktperson <span class="form-required" title="This field is required.">*</span>');
         });
         */

        jQuery('#edit-chtype').change(function () {
            if ($(this).is(":checked")) {
                $('#edit-meldingsfelt').val('Jeg &#248;nsker &#229; abonnere p&#229; tjenesten');
                $('#edit-meldingsfelt').prop("disabled", "disabled");

                $('.form-item-meldingsfelt').hide();
                $('#edit-dumpy').show();
            }
            else
            {
                $('#edit-meldingsfelt').val("");
                $('#edit-meldingsfelt').removeAttr("disabled");

                $('.form-item-meldingsfelt').show();
                $('#edit-dumpy').hide();
            }
        });

        $("#edit-name").attr("placeholder", "brukernavn");
        $("#edit-pass").attr("placeholder", "passord");

    });
</script>