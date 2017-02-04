<?php
$url_string = $_SERVER["REQUEST_URI"];
//echo"Current URL: ".$url_string.'<br>';

if (strpos($url_string, "cross_promotion_official_information") || strpos($url_string, "cross_promotion_main_industries") ||
        strpos($url_string, "cross_promotion_municipal_council_piechart") || strpos($url_string, "cross_promotion_suppliers") ||
        strpos($url_string, "cross_promotion_summary")) {

    include('header1.php');
} else {
    include('header.php');
}
?>

<?php if (drupal_is_front_page()) { ?>
<?php
    global $base_url;
    global $user;
    global $role;
?>


<div class="main" role="main">

    <div class="home-banner-section">
    	<img class="home-banner" src="<?php echo $base_url . '/sites/all/themes/leverandors/images/banner_1600px.jpg' ?>" alt="leverandors home banner">
    </div>

    <div class="container">
        <section class="frontpage">
            <h1>Den mest komplette oversikten over leverandører til kommunal sektor</h1>
            <p class="ingress">Se hvilke leverandører som har fakturert hvilke kommuner og fylker. For hvor mye og når.<br>Få oversikt over markedet. Søk blant rundt 149.000 leverandører fra over 750 bransjer!</p>

            <div style="text-align: center;">
                <input type="button" name="download" value="Logg inn"  class="submit-btn submit-btn-light" onclick="window.location = window.location.pathname + 'user';" >
                <input  type="button" name="download" value="Få et tilbud"  class="submit-btn2" onclick="window.location = window.location.pathname + 'abonner';" >
                <input type="button" name="download" value="Søk gratis"  class="submit-btn2" onclick="window.location = window.location.pathname + 'groupdata';" >
            </div>
        </section>			

        <section class="frontpage">
            <div class="clearfix">
                <div class="e-book-imgdiv">
                    <a href="ebook">
                        <img class="e-book-img" src="<?php echo $base_url . '/sites/all/themes/leverandors/images/e_bok_cover_1x.jpg' ?>" alt="">
                    </a> 
                </div>
                <div class="e-book">
                    <h1>Gratis e-bok:</h1>
                    <p class="ingress">Få oversikt over de viktigste bransjene og markedets omfang gratis.</p>
                    <input type="button" name="download" value="Last ned"  class="submit-btn submit-btn-light" onclick="window.location = window.location.pathname + 'ebook';">
                </div>
            </div>
        </section>

        <section class="frontpage">
            <div class="sok-head">
                <img  src="<?php echo $base_url . '/sites/all/themes/leverandors/images/sok_i_databas_1x.png' ?>" alt="">
                <h1>Søk i databasen gratis</h1>
                <p class="ingress">Få oversikt over de viktigste bransjene og markedets omfang gratis.</p>	            
            </div>
            <div class="sok-forms">
                <div class="form-field">
                    <div class="kam-search">
                        <p class="kam-search-lable">Søk på Kommuner/Fylker</p>
                        <?php echo drupal_render(drupal_get_form('fylkekommune_filter_form')); ?>
                        <p class="kam-search-lable">Søk på leverandør</p>
                        <?php echo drupal_render(drupal_get_form('supplier_filter_form')); ?>
                        <p class="kam-search-lable">Søk på bransjer</p>
                        <?php echo drupal_render(drupal_get_form('groupdata_filter_form')); ?>
                    </div>
                </div>            
            </div><!-- sok-forms -->
        </section>

        <section class="frontpage">
            <div>
                <iframe class="kam-frame" src="https://player.vimeo.com/video/179031621?title=0&byline=0&portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                <h1>Video: Slik bruker du databasen</h1>
            </div>
        </section>
    </div>

<?php } else { ?>
    <div class="content-section">
        <div class="container">
            <div class="page-content-area">

                <div class="content-left">

                    <?php if (!empty($title)): ?>
                        <h1 class="page-header"><?php print $title; ?></h1>
                    <?php endif; ?>

                    <?php print render($page['content']); ?>

                </div>			


                <?php if (!empty($page['sidebar_primary'])): ?>
                    <div class="content-right" id="main">	
                        <aside class="col-sm-3" role="complementary">
                            <?php print render($page['sidebar_primary']); ?>
                        </aside>  
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>	
<?php } ?>

</div><!-- /main -->

<?php
if (strpos($url_string, "cross_promotion_official_information") || strpos($url_string, "cross_promotion_main_industries") ||
        strpos($url_string, "cross_promotion_municipal_council_piechart") || strpos($url_string, "cross_promotion_suppliers") ||
        strpos($url_string, "cross_promotion_summary")) {
       include('footer1.php');
} else {
    include('footer.php');
}?>
