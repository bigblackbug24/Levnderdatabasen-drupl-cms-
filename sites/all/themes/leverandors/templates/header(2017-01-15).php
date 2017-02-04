<?php
global $user;

// First, we must set up an array
$element = array(
    '#tag' => 'meta', // The #tag is the html tag - <link />
    '#attributes' => array(// Set up an array of attributes inside the tag
        'name' => 'viewport',
        'content' => 'width=device-width, initial-scale=1',
    ),
);

drupal_add_html_head($element, 'meta_viewport');


if ($user->uid) {

    $user_data = user_load($user->uid);

    $startDate = format_date(strtotime($user_data->field_start_dato_abonnement['und'][0]['value']), 'custom', 'Y-m-d');
    $expireDate = format_date(strtotime($user_data->field_stopp_dato_abonnement['und'][0]['value']), 'custom', 'Y-m-d');
    $invoiceDate = format_date(strtotime($user_data->field_next_invoice_date['und'][0]['value']), 'custom', 'Y-m-d');

    if (isset($_POST['asubmit']) && !empty($_POST['asubmit'])) {
        db_query("INSERT INTO {agree} (agree_uid, agree_yes) VALUES ('" . $user->uid . "',  'yes')");
    }

    $result = db_query("SELECT count(agree_uid) as auid FROM {agree} WHERE agree_uid = " . $user->uid);

    $num = 0;
    foreach ($result as $record) {
        $num = $record->auid;
    }

    if ($num == 0 && !isset($_GET['pass-reset-token'])) {
        ?>
        <div style="position:absolute; width:100%; height:100%; background:#000; z-index:999; opacity: 0.7;">&nbsp;</div>
        <div style="position: absolute; top: 15%; left: 15%; width: 70%; height: 75%; z-index:9999; background:#fff; padding:20px;">
            <h2>Abonnementsvilkår</h2>
            <div style="height:60%; width:100%; overflow:scroll">
                <p>Abonnement på Kommunebarometeret (heretter kalt produktet)</p>
                <strong>1. Generelt</strong>
                <p>Et abonnement er en avtale mellom kunden og Kommunal Rapport som gir bruksrett til produktet. Når kunden har akseptert og godkjent vilkårene kan kunden ta produktet i bruk.</p>

                <p>Denne avtalen gjelder fra det tidspunkt kunden aksepterer vilkårene og gis tilgang til produktet ved hjelp av tilgangskode (brukernavn og passord). Tilgang til produktet gis ved tegning av abonnement.</p>

                <p>Avtalen gjelder inntil den skriftlig (epost/brev) blir sagt opp av kunden. Avtalen kan også sies opp av Kommunal Rapport dersom avtalen misligholdes, for eksempel ved manglende betaling. Ved oppsigelse av abonnement opphører alle rettigheter og plikter i henhold til disse abonnementsvilkårene.</p>

                <strong>2. Fakturering, betaling</strong>

                <p>Første gangs abonnementsavgift innbetales umiddelbart etter opprettelse av abonnementet og gjelder for ett år. Abonnementsavgiften faktureres deretter årlig. Innbetalt årsabonnementsavgift tilbakebetales ikke ved oppsigelse eller reduksjon i antall brukere i inneværende periode.</p>

                <p>Kommunal Rapport har rett til å endre abonnements- og lisenspriser i henhold til generell prisstigning eller etter skriftlig varsel.</p>

                <strong>3. Fornyelse, varsel om fakturering</strong>

                <p>Abonnementet blir automatisk fornyet hvert år med mindre det skriftlig (epost/brev), og innen årsfakturering, blir sagt opp av kunden. Omlag en måned før fakturering blir kunden varslet om fakturering per epost/brev. Kunden må innen en gitt frist gi beskjed om eventuell oppsigelse og andre endringer i abonnementet. Etter at faktura er sendt, er abonnementet blitt fornyet for ett år og må betales av kunden. Etter en purring og ytterligere ett varsel, blir alt utestående sendt til inkasso.</p>

                <p>Det er kundens ansvar å gi Kommunal Rapport beskjed om endringer i postadresse, e-postadresse og ved bytte av kontaktperson.</p>

                <strong>4. Bruksrett</strong>

                <p>Et abonnement tegnes som en virksomhetslisens der kunden melder inn til Kommunal Rapport hvem som skal ha tilgang fra virksomheten.
                    Den enkelte brukers konto er personlig og skal knyttes til brukerens reelle e-postadresse, fortrinnsvis med virksomhetens adresse. Det er ikke tillatt å videreselge, gi bort eller spre sin tilgangskode. Samme tilgangskode skal ikke benyttes av flere brukere.</p>

                <strong>5. Opphavsrett</strong>

                <p>Alle produkter i Kommunebarometeret er omfattet av åndsverklovens bestemmelser. Uten særskilt avtale med Kommunal Rapport er enhver eksemplarframstilling, tilgjengeliggjøring eller spredning utover privat bruk bare tillatt i den utstrekning den er hjemlet i lov. Krenkelse av rettighetene kan medføre straff og erstatningsansvar.</p>

            </div>
            <br />
            <form action="/" method="post" name="frmAgree">
                <input type="checkbox" name="agree" value="agree" /> Jeg aksepterer abbonnementsvilkårene
                <br />
                <input type="submit" name="asubmit" value="OK" class="form-submit" />
            </form>
        </div>
    <?php } ?>

    <?php if (empty($startDate) || (!empty($expireDate) && strtotime($expireDate) < strtotime(date('Y-m-d')))): ?>
        <div style="position:absolute; width:100%; height:100%; background:#000; z-index:999; opacity: 0.7;">&nbsp;</div>
        <div style="position: absolute; top: 15%; left: 15%; width: 70%; height: 75%; z-index:9999; background:#fff; padding:20px; text-align:center">
            <h3> Ditt abbonement er utløpt. <br /><br />Kontakt oss for å fornye det.</h3>
            <br /><br /><br />			
            <a href="/abonner" class="form-submit">Kontakt oss</a>
            <?php session_destroy(); ?>				
        </div>
    <?php endif;
}
?>

<div class="page-load-lock-screen">
    <div class="page-load-spinner">&nbsp;</div>
</div>

<?php $themePath = drupal_get_path('theme', 'leverandors'); ?>

<div class="header">
    <div class="top-bar">
        <div class="container">
            <div class="header-wdget">
                <a class="nav-search" href="/kommunaldata"></a>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" class="logo">
                    <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
                    <img src="/<?php echo $themePath; ?>/images/small-logo.png" class="sticky-logo" alt="">
                    <span class="header-title">Leverandørdatabasen</span>
                </a>
                <?php if ($page['header_menu']): ?>
                    <div class="user-link">
                        <?php if ($page['main_menu']): ?>
                            <?php print render($page['main_menu']); ?>
                        <?php endif; ?>
                        <div class="region region-header-menu">
                            <ul class="menu">
                                <li class="first leaf"><a title="" href="abonner">Kontakt oss</a></li>
                                <?php if ($user->uid != 0): ?>
                                    <li><a href="user">Velkommen, <?php echo $user_data->field_fullt_navn['und'][0]['value']; ?></a></li>
                                    <li class="last leaf"><a title="" href="user/logout">Logg ut</a></li>
                                <?php else: ?>
                                    <li class="last leaf"><a title="" href="user">Logg inn</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                <?php endif; ?>

                <div class="nav-btn">
                <!--	<span></span>
                        <span></span>
                        <span></span>-->
                </div>
            </div>
        </div>
    </div>

    <div class="container sub-header">
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" ><h2>Leverandørdatabasen</h2></a>
    </div>		

</div>


