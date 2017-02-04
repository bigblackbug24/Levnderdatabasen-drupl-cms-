<style>
	div.Tokenize{ display:block; }
	div.Tokenize ul.TokensContainer li.Token, div.Tokenize ul.TokensContainer li.TokenSearch{ height:auto; }
</style>
<?php

	print drupal_render($form['form_build_id']);
	print drupal_render($form['form_id']);
	print drupal_render($form['form_token']);

	$datayear = drupal_render($form['datayear']);
	$fkdropdown = drupal_render($form['fkdropdown']);
	$suppliername = drupal_render($form['suppliername']);	
	$groupclass = drupal_render($form['groupclass']);	
	$subsectorclass = drupal_render($form['subsectorclass']);	
	$minravenu = drupal_render($form['minravenu']);	
	$maxravenu = drupal_render($form['maxravenu']);	
	
	
	$actions = drupal_render($form['submit']);
	$resetbtn = drupal_render($form['reset']);
	
	$results_table = drupal_render($form['results_table']);
	/*
	$suppids = $form['suppids']['#value'];
	
	
	$options = array();
	if(!empty($suppids))
	{
		// Change Database
		db_set_active('kommunaldata');
	
		$query = db_select('leverandor_info', 's');
		$query->fields('s', array('lev_org_orgnr', 'lev_org_orgnavn'));
		$query->condition('s.lev_org_orgnr', ($suppids), 'IN');
		$results = $query->execute();
		
		foreach ($results as $result) 
		{
			$options[$result->lev_org_orgnr] = $result->lev_org_orgnavn;
		}
	
		// Set Default Database 
		db_set_active();
	}	
	*/	
?>	

	<section class="login-form" id="advanceSection"> 

		<div class="row">
			<div class="col-sm-4">

				<div class="sidebar-stickable-container">
					<div class="stick-point"></div>
					<div class="sidebar-stickable">
						<div class="sidebar-sticky-content">

							<div class="login-box kommunaldata clearfix">
								<form class="main-form" >
									
									<label><?php echo $datayear; ?></label>
									
									<label><?php echo $fkdropdown; ?></label>
									
									<label><?php echo $suppliername; ?></label>
									
									<label><?php echo $groupclass; ?></label>
									
									<label><?php echo $subsectorclass; ?></label>
									
									<label><?php echo $minravenu; ?> <?php echo $maxravenu; ?> </label>
									
									<?php echo $actions; ?>
									<?php echo $resetbtn; ?>				
									
								</form>
							</div>

						</div><!-- /sidebar-sticky-content -->
					</div><!-- /.sidebar-stickable -->
				</div><!-- /.sidebar-stickable-container -->
			
			</div>
			<div class="col-sm-8">
			
				<div class="kommunalresult-right" id="kommunalresult">

					<div id="error_div" class="alert alert-danger" style="display:none;">Minst ett filter b&oslash;r velges</div>

					<?php if(empty($results_table)): ?>

						<div class="resultdata">

							<strong><i>P&aring; denne siden kan du s&oslash;ke fritt p&aring; de parameterne du &oslash;nsker.</i></strong>
							<br /><br />
							
							<h3>&Aring;r</h3>
							<p>Velg det &aring;ret du &oslash;nsker &aring; utforske. Du kan kun velge ett &aring;r av gangen.</p>
							<h3>Fylke / Kommune</h3>
							<p>La feltet st&aring; &aring;pent eller velg opp til 10 kommuner/fylker du &oslash;nsker &aring; utforske.</p>
							<h3>Leverand&oslash;r</h3>
							<p>La feltet st&aring; &aring;pent eller velg opp til 10 leverand&oslash;rer du &oslash;nsker &aring; utforske.</p>
							<h3>Hovedbransjer</h3>
							<p>La feltet st&aring; &aring;pent eller velg opp til 10 hovedbransjer du &oslash;nsker &aring; utforske.</p>
							<h3>Bransje</h3>
							<p>La feltet st&aring; &aring;pent eller velg opp til 10 bransjer du &oslash;nsker &aring; utforske.</p>
							<h3>Minst Kj&oslash;pt</h3>
							<p>La feltet st&aring; &aring;pent eller sett et minimumsbel&oslash;p for &aring; sortere bort de minste bel&oslash;pene.</p>					
						</div>
					<?php else: ?>
						<?php echo $results_table; ?>
					<?php endif; ?>
				</div>
			
			</div>
		</div>
		
	</section>
	
	
	<script> 
	
		$('#tokenize').tokenize();	
		$(document).ready(function(){  
			$('#error_div').hide();
			$("#fktokenize").tokenize({
				maxElements: 10,
				displayDropdownOnFocus: true
			}); 
			
			$("#supplierids").tokenize({
				maxElements: 10,
                                displayDropdownOnFocus: true,
				nbDropdownElements: 10
			    /*datas: "kommunaldata/suppliers",
			    displayDropdownOnFocus: true*/
			});
			$("#groupctokenize").tokenize({
				maxElements: 10,
				displayDropdownOnFocus: true
			}); 
			$("#subctokenize").tokenize({
				maxElements: 10,
				displayDropdownOnFocus: true
			}); 
			
			<?php foreach($options as $key=>$value): ?>
				$('#supplierids').tokenize().tokenAdd('<?php echo $key; ?>', '<?php echo $value; ?>');
			<?php endforeach; ?>

			$("[data-toggle='tooltip']").tooltip();
			
			$( "#resetbtn" ).click(function() {
			  	$('#fktokenize').tokenize().clear();
				$('#supplierids').tokenize().clear();
				$('#groupctokenize').tokenize().clear();
				$('#subctokenize').tokenize().clear();
				$('#edit-minravenu').val("");
				$('#edit-maxravenu').val("");
				$('#edit-datayear').val("");
			});

			$( "#advance-search-filter-form" ).submit(function( event ) {
			  	
			  	if ( 
			  		( $( "#fktokenize").val() == '' || $( "#fktokenize").val() == null) &&
			  		( $( "#supplierids").val() == '' || $( "#supplierids").val() == null) &&
			  		( $( "#groupctokenize").val() == '' || $( "#groupctokenize").val() == null) &&
			  		( $( "#subctokenize").val() == '' || $( "#subctokenize").val() == null) 
			  	
			  	) {
			    	$('#error_div').show();
		    	    $(window).scrollTop(0);
			    	return false;
			 	}
    			$('.page-load-lock-screen').show();

    			return true;	
			});

			$(document).keypress(function(e) {
			    if(e.which == 13) {
			        $( "#advance-search-filter-form" ).submit();
			    }
			});

		});

		(function($) {
			Drupal.behaviors.DisableInputEnter = {
			  attach: function(context, settings) {
			    $('input', context).once('disable-input-enter', function() {
			      $(this).keypress(function(e) {
			        if (e.keyCode == 13) {
			          e.preventDefault();
			        }
			      });
			    });
			  }
			}
		})(jQuery);
	</script>