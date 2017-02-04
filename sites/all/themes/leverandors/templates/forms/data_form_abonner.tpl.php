	<?php
	
		print drupal_render($form['form_build_id']);
		print drupal_render($form['form_id']);
		print drupal_render($form['form_token']);
		
		$usertype = drupal_render($form['usertype']);
		$vnaven = drupal_render($form['vnaven']);
		$kontaktperson = drupal_render($form['kontaktperson']);	
		$tittel = drupal_render($form['tittel']);	
		$telefonnummer = drupal_render($form['telefonnummer']);	
		$epost = drupal_render($form['epost']);		
		$chtype = drupal_render($form['chtype']);					
		$meldingsfelt = drupal_render($form['meldingsfelt']);	
		$abbonrsuccess = drupal_render($form['asuccess']);	
		
		$actions = drupal_render($form['submit']);
		$resetbtn = drupal_render($form['reset']);
					
	?>	

	<div id="error_div" class="alert alert-danger" style="display:none;">Minst ett filter b&oslash;r velges</div>
	
	<?php if (!empty($abbonrsuccess)) {
		echo '<div class="alert alert-success" role="alert">Takk for at du kontakter oss, vil vi kontakte deg snart</div>';
	} ?>

	<div class="ebook-form ebook-formbg" style="height:500px;">
	
		<div class="ebook-form-top">
			<?php echo $usertype; ?>
		</div>
		
		<div class="ebook-form-left">

			<span>Alle feltene m&aring; fylles ut</span>
			
			<?php echo $vnaven; ?>
		
			<?php echo $kontaktperson; ?>
		
			<?php echo $tittel; ?>
		
			<?php echo $telefonnummer; ?>
		
			<?php echo $epost; ?>

			<?php echo $chtype; ?>
			
		</div>	
		
		<div class="ebook-form-right">
		
			<?php echo $meldingsfelt; ?>
			
			<textarea style="display:none;" disabled="disabled" id="edit-dumpy" name="dumpy" cols="63" rows="5" class="form-textarea" style="opacity: 1; height: 165px;">Jeg &oslash;nsker &aring; abonnere p&aring; tjenesten</textarea>

			<?php echo $actions; ?>
		
			<?php echo $resetbtn; ?>
		</div>
		
			
	</div>
	<script> 

		$(document).ready(function(){  
			
			var progexemail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

			$( "#show-abonner-data-form" ).submit(function( event ) {
			  	
				var haserror = false;

			  	if ( $("#edit-kontaktperson").val().length == 0) {
			    	haserror = true;
			 	}

			 	if ( $("#edit-tittel").val().length == 0 ){
			    	haserror = true;
			 	}

			 	if ( $("#edit-telefonnummer").val().length == 0 ){
			    	haserror = true;
			 	}

			 	if ( $("#edit-epost").val().length == 0 ){
			    	haserror = true;
			 	}
				
				var user_email = $("#edit-epost").val();
				
				if(!progexemail.test(user_email)) {
			    	haserror = true;
				}


			 	if ( $("#edit-meldingsfelt").val().length == 0 ){
			    	haserror = true;
			 	}

			 	if(haserror === true)
			 	{
			 		$('#error_div').show();
		    	    $(window).scrollTop(0);
		    	    return false;
			 	}

    			return true;	
			});	
			
			$('input[type="text"]').val('');
			$("input:radio").removeAttr("checked");
			$('textarea').val('');

					
		});			

	</script>
		