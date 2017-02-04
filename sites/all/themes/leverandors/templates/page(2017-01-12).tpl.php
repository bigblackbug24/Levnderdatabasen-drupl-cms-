<?php include('header.php'); ?>
	<?php if(drupal_is_front_page()) { ?>
		<?php global $base_url; global $user; ?>
		
		<div style="text-align: center;">
			<img class="home-banner" src="../drupal/sites/all/themes/leverandors/images/banner_1600px.jpg" alt="">						
		</div>

<div class="container">

			
			<section>
					<h1>Den mest komplette oversikten over leverandører til kommunal sektor</h1>
					<p class="ingress">Se hvilke leverandører som har fakturert hvilke kommuner og fylker. For hvor mye og når.<br>Få oversikt over markedet. Søk blant rundt 149.000 leverandører fra over 750 bransjer!</p>

				<div style="text-align: center;">
					<input type="button" name="download" value="Logg inn"  class="submit-btn2" onclick="window.location = '/user';" >
					<input  type="button" name="download" value="Få et tilbud"  class="submit-btn2" onclick="window.location = '/';" >
					<input type="button" name="download" value="Søk gratis"  class="submit-btn2" onclick="window.location = '/groupdata';" >
				</div>
			</section>			

				<section>
					<div>
						<div class="e-book-imgdiv">
						<a href="../ebook">
									<img class="e-book-img" src="../drupal/sites/all/themes/leverandors/images/e_bok_cover_1x.jpg" alt=""></a> 
						</div>

						<div class="e-book">
							<h1>Gratis e-bok:</h1>
							<p class="ingress">Få oversikt over de viktigste bransjene og markedets omfang gratis.</p>
							<input type="button" name="download" value="Last ned"  class="submit-btn" onclick="window.location = '/ebook';" >
						</div>
					</div>
				</section>



				<!-- Previous code for search omn front page
				<section class="kam-bottom-widget2">
					<div class="container">
						<div class="kam-search">
							<h2>Søk i databasen gratis</h2>
							<p>Søk på Kommuner/Fylker
							<?php echo drupal_render(drupal_get_form('fylkekommune_filter_form')); ?>
							</p>
							<p>Søk på leverandør</p>
							<?php echo drupal_render(drupal_get_form('supplier_filter_form')); ?>
							<p>Søk på bransjer</p>
							<?php echo drupal_render(drupal_get_form('groupdata_filter_form')); ?>
						</div>
					</div>-->
				<section>
					<img  src="../drupal/sites/all/themes/leverandors/images/sok_i_databas_1x.png" alt="">
					<h1>Søk i databasen gratis</h1>
						<p class="ingress">Få oversikt over de viktigste bransjene og markedets omfang gratis.</p>	

						<div class="form-field">
					
							<p>Søk på Kommuner/Fylker</p>
								<form action="search.php" method="get">
								<div class="form-field">
  								<input name="op" value="Søk" class="submit-btn3" type="submit">
  									<div class="kam-search">
    								<input type="text" name="term" />
   									</div>
   								</div>
							</form>


							<p>Søk på leverandør</p>
							<form action="search.php" method="get">
								<div class="form-field">
  								<input name="op" value="Søk" class="submit-btn3" type="submit">
  									<div class="kam-search">
    								<input type="text" name="term" />
   									</div>
   								</div>
							</form>
							
						<p>Søk på bransjer</p>
							<form action="search.php" method="get">
								<div class="form-field">
  								<input name="op" value="Søk" class="submit-btn3" type="submit">
  									<div class="kam-search">
    								<input type="text" name="term" />
   									</div>
   								</div>
							</form>

							</div>


				</section>

				<section>

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
		</div>
	<?php } ?>
	
<?php include('footer.php'); ?>

<script>
		jQuery(document).ready(function(){ jQuery("#sidebar").stickySidebar({ sidebarTopMargin: 20, footerThreshold: 100 }); });
	</script>
	