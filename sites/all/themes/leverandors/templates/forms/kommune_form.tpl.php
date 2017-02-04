

<?php

	print drupal_render($form['form_build_id']);
	print drupal_render($form['form_id']);
	print drupal_render($form['form_token']);
	
	$fkdropdown = drupal_render($form['fkdropdown']);
	$actions = drupal_render($form['submit']);
?>	
				
	<label>
		<?php echo $fkdropdown; ?>
		<?php echo $actions; ?>
	</label>
		
	<script>
		$(document).ready(function(){  
			$("#fktokenize").tokenize({
				maxElements: 1,
				displayDropdownOnFocus: true
			});
			$("#fktokenize").tokenize().clear();
                        

		});
	</script>

