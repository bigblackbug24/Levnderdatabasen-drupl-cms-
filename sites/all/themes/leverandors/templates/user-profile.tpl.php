<?php

	global $user;
	
	if($user->uid == 1){
		$user_data = user_load(arg(1));
	}else{
		$user_data = user_load($user->uid);
	}
	
	
?>
	<div class="user-profile">
		<strong>Brukernavn: </strong> <span><?php echo $user_data->name; ?></span>
		<br><br>
		
		<strong>Fullt navn: </strong> <span><?php echo $user_data->field_fullt_navn['und'][0]['value']; ?></span>
		<br><br>
		
		<strong>Telefon: </strong><span><?php echo $user_data->field_telefon['und'][0]['value']; ?></span>
		<br><br>

		<strong>E-post: </strong><span><?php echo $user_data->mail; ?></span>
		<br><br>
					
		<strong>Firma: </strong> <span><?php echo $user_data->field_firma['und'][0]['value']; ?></span>
		<br><br>
		
		<strong>Start dato abonnement: </strong> <span><?php echo format_date(strtotime($user_data->field_start_dato_abonnement['und'][0]['value']) ,'custom','d-m-Y'); ?></span>
		<br><br>
		
		<strong>Neste fakturadato: </strong> <span><?php echo format_date(strtotime($user_data->field_stopp_dato_abonnement['und'][0]['value']) ,'custom','d-m-Y'); ?></span>
		<br><br>
		
		<a href="/user/<?php echo $user_data->uid;?>/edit" class="form-submit">Oppdater profil</a> 
		
	</div>