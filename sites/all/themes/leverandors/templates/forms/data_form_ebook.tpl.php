<?php

	print drupal_render($form['form_build_id']);
	print drupal_render($form['form_id']);
	print drupal_render($form['form_token']);
	
	$vnaven = drupal_render($form['vnaven']);
	$tittel = drupal_render($form['tittel']);	
	$arbeidsgiver = drupal_render($form['arbeidsgiver']);	
	$epost = drupal_render($form['epost']);	
	$chtype = drupal_render($form['chtype']);	
	$sendfriend = drupal_render($form['sendfriend']);	
	
	$booklink = drupal_render($form['book']);
				
	
	$actions = drupal_render($form['submit']);
	
	$nids = db_select('node', 'n')
				->fields('n', array('nid'))
				->fields('n', array('type'))
				->condition('n.type', 'e_books')
				->orderBy('n.nid', 'DESC')
				->range(0, 1)
				->execute() 
				->fetchCol(); // returns an indexed array
				
	$node = node_load($nids[0]);
	
	$filePath = file_create_url($node->field_book_image['und'][0]['uri']);

?>
	<div id="error_div" class="alert alert-danger" style="display:none;">
		Du m&aring; fylle inn skjemaet under, og akseptere nyhetsbrev, for &aring; kunne laste ned e-boken
	</div>

	<?php if (!empty($booklink)) {
		echo '<div class="alert alert-success" role="alert">Takk for at du laster ned e-boken. Trykk på knappen under for å laste den ned.</div>';
	} ?>
	
	<div class="ebook-form ebook-formbg">
		<a class="ebook-tooltip" href="#" data-toggle="tooltip" title="Gir deg et raskt overblikk over det kommunale markedet. Hvem de st&oslash;rste akt&oslash;rene og bransjene er,og hvor mye penger de henter ut fra norske kommuner og fylker hvert &aring;r."><i class="fa fa-question-circle"></i></a>

		<div class="ebook-form-top">
			<?php if (!empty($booklink)) {
				echo '<center><a href="'.$booklink.'"  target="_blank" class="form-submit btn">Klikk her for &aring; laste ned e-boken</a></center>';
				unset($_SESSION['booklink']);
			}?>
			<div class="ebook-left-form">
				<h3>F&aring; oversikt i dag, gratis</h3>
				<?php echo $vnaven; ?>
				<?php echo $kontaktperson; ?>
				<?php echo $tittel; ?>
				<?php echo $arbeidsgiver; ?>
				<?php echo $epost; ?>
				<?php echo $chtype; ?>
				<?php echo $sendfriend; ?>
			</div>

			<div class="ebook-right-image">
				<img src="<?php echo $filePath; ?>" alt="Test Image" width="280" />
			</div>
			
			<div class="submit-btn">
				<?php echo $actions; ?>
			</div>			
		
		</div>

	</div>

	<script>
		$(document).ready(function(){
			
			$('[data-toggle="tooltip"]').tooltip();
			
			var progexemail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			
			$( "#show-ebook-data-form" ).submit(function( event ) {
			  	
				var haserror = false;

			  	if ( $("#edit-vnaven").val() == '') {
			    	haserror = true;
			 	}

			 	if ( $("#edit-tittel").val() == '') {
			    	haserror = true;
			 	}

			 	if ( $("#edit-telefonnummer").val() == '') {
			    	haserror = true;
			 	}

			 	if ( $("#edit-epost").val() == '') {
			    	haserror = true;
			 	}
				
				var user_email = $("#edit-epost").val();
				
				if(!progexemail.test(user_email)) {
			    	haserror = true;
				}

			 	if(haserror == true)
			 	{
			 		$('#error_div').show();
		    	    $(window).scrollTop(0);
		    	    return false;
			 	}

    			return true;	
			});			
			
			$('input[type="text"]').val('');
			$("input:radio").removeAttr("checked");
		});			

	</script>

	
	