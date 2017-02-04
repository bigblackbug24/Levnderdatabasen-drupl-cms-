<?php

	print drupal_render($form['form_build_id']);
	print drupal_render($form['form_id']);
	print drupal_render($form['form_token']);
	
	$groupclass = drupal_render($form['groupclass']);
	$actions = drupal_render($form['submit']);
?>	
				
	<label>
		<?php echo $groupclass; ?>
		<?php echo $actions; ?>
	</label>
		
	<script>
		$(document).ready(function(){  
			$("#groupctokenize").tokenize({
				maxElements: 1,
				displayDropdownOnFocus: true
			}); 
			$("#groupctokenize").tokenize().clear();
		});
	</script>