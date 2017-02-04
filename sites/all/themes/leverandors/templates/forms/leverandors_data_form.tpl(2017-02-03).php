<?php

	print drupal_render($form['form_build_id']);
	print drupal_render($form['form_id']);
	print drupal_render($form['form_token']);

	$datayear = drupal_render($form['datayear']);
	$suppliername = drupal_render($form['suppliername']);	
	$fkdropdown = drupal_render($form['fkdropdown']);

	$minravenu = drupal_render($form['minravenu']);	
	$maxravenu = drupal_render($form['maxravenu']);	
	
	$actions = drupal_render($form['submit']);
	$resetbtn = drupal_render($form['reset']);
	
	$results_table = drupal_render($form['results_table']);
	
	$suppids = $form['suppids']['#value'];
	
	$options = array();
	if(!empty($suppids))
	{
		// Change Database
		db_set_active('kommunaldata');
	
		$query = db_select('leverandor_info', 's');
		$query->fields('s', array('lev_org_orgnr', 'lev_org_orgnavn'));
		$query->condition('s.lev_org_orgnr', $suppids, '=');
		$results = $query->execute();
		
		foreach ($results as $result) {
			$options[$result->lev_org_orgnr] = $result->lev_org_orgnavn;
		}
	
		// Set Default Database 
		db_set_active();
	}	
	
?>	

	<section class="login-form">

		<div class="row">
			<div class="col-sm-4">

				<div class="sidebar-stickable-container">
					<div class="stick-point"></div>
					<div class="sidebar-stickable">
						<div class="sidebar-sticky-content">

							<div class="login-box kommunaldata clearfix">
								<form class="main-form " >
									
									<label>
										<?php echo $datayear; ?>
									</label>
									
									<label>
										<?php echo $suppliername; ?>
									</label>
									
									<label>
										<?php echo $fkdropdown; ?>
									</label>

									<label>
										<?php echo $minravenu; ?>
										<?php echo $maxravenu; ?>
									</label>

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
			
					<div id="error_div" class="alert alert-danger" style="display:none;">Leverandør m&aring; velges</div>
					<?php if(empty($results_table)  && arg(0) != 'levrandordata' ): ?>
						<div class="resultdata">
							<strong><i>P&aring; denne siden s&oslash;ker du med utgangspunkt i en leverand&oslash;r.</i></strong>
							<br /><br />
							<h3>&Aring;r</h3>
							<p>Velg det &aring;ret du &oslash;nsker &aring; utforske. Du kan kun velge ett &aring;r av gangen.</p>
							<h3>Leverand&oslash;r</h3>
							<p>Velg den leverand&oslash;ren du &oslash;nsker &aring; utforske. Du kan kun velge en virksomhet av gangen.</p>
							<h3>Fylke/kommune</h3>
							<p>La feltet st&aring; &aring;pent eller velg opp til 10 kommuner/fylker du &oslash;nsker &aring; utforske.</p>
							<h3>Minste bel&oslash;p</h3>
							<p>La feltet st&aring; &aring;pent eller sett et minimumsbel&oslash;p for &aring; sortere bort de minste kommunene.</p>					
						</div>
					<?php else: ?>
						<?php echo $results_table; ?>
					<?php endif; ?>

				</div>	

			</div>
		</div>

	</section>
	
	<script src="http://www.directlyrics.com/code/lockfixed/jquery.lockfixed.js" ></script>

	<script>
	
		$(document).ready(function(){  

			$("#supplierid").tokenize({
				maxElements: 1,
				datas: "/kommunaldata/suppliers",
				displayDropdownOnFocus: true
			});

			$("#fktokenize").tokenize({
				maxElements: 10,
				displayDropdownOnFocus: true
			}); 
			
			<?php foreach($options as $key=>$value): ?>
				$('#supplierid').tokenize().tokenAdd('<?php echo $key; ?>', '<?php echo $value; ?>');
			<?php endforeach; ?>

			$("[data-toggle='tooltip']").tooltip();
			
			if (!!$('.sticky').offset()) { // make sure ".sticky" element exists
				var stickyTop = $('.sticky').offset().top; // returns number
				$(window).scroll(function() { // scroll event
					var windowTop = $(window).scrollTop(); // returns number
			
					if (stickyTop < windowTop) {
						$('.sticky').css({ position:'fixed', top:0 });
					}
					else 
					{
						$('.sticky').css('position', 'static');
					}
				});
			}

			$(document).keypress(function(e) {
			    if(e.which == 13) {
			        $( "#levrandors-data-filter-form" ).submit();
			    }
			});

			$( "#resetbtn" ).click(function() {
			  	$('#supplierid').tokenize().clear();
				$('#fktokenize').tokenize().clear();
				$('#edit-minravenu').val("");
				$('#edit-maxravenu').val("");				
				$('#edit-datayear').val("");
			});

			$( "#levrandors-data-filter-form" ).submit(function( event ) {
			  	
			  	if ( $( "#supplierid").val() == '' || $( "#supplierid").val() == null) {
			    	
			  		$('.form-item-suppliername').addClass('user-error');	
			    	$('#error_div').show();

		    	    $(window).scrollTop(0);
			    	return false;
			 	}

    			$('.page-load-lock-screen').show();

    			return true;	
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
