<?php

	print drupal_render($form['form_build_id']);
	print drupal_render($form['form_id']);
	print drupal_render($form['form_token']);
	
	$suppliername = drupal_render($form['suppliername']);
	$actions = drupal_render($form['submit']);
?>	
				
	<label>
		<?php echo $suppliername; ?>
		<?php echo $actions; ?>
	</label>
		
	<script>
		$(document).ready(function(){  
			$("#supplierid").tokenize({
				maxElements: 1,
			    datas: "/kommunaldata/suppliers",
			    displayDropdownOnFocus: true
			});
		});
	</script>
