
	<div class="login-form-widget">
		<div class="left-form">
			<h4 class="modal-title">JEG ER ABONNENT</h4>
			<?php 
				print drupal_render($form['name']);
				print drupal_render($form['pass']);
				print drupal_render($form['form_build_id']);
				print drupal_render($form['form_id']);
				//print drupal_render($form['loginterms']);
				print drupal_render($form['links']);
				print drupal_render($form['actions']);
			?>
		</div>
		<div class="right-form">
			<h4>JEG ER IKKE ABONNENT</h4>
			<a href="/abonner" class="form-submit">Kontakt oss for tilbud</a>
		</div>
		<p>Sp&oslash;rsm&aring;l? Kontakt oss p&aring; tlf 24 13 64 50 eller leverandor@kommunal-rapport.no</p>
	</div>
	