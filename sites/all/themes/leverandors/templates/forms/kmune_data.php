<?php
global $base_url;
		global $user;

		$output = NULL;
		
		db_set_active('kommunaldata');	
		
		// Get kommune Basic Information;
		$query = db_select('kommune', 'A');
		$query->join('kommune_innbyggere', 'B', 'A.kommune_id = B.kommune_id AND B.innbygger_year ='.$dataYear);
		$query->fields('A', array('kommune_id', 'kommune_navn', 'kommune_ordforer', 'kommune_parti', 'kommune_periode', 'kommune_adviser', 'kommune_forretningsadr', '	kommune_forradrpostnr', 'kommune_forradrpoststed', 'kommune_postadresse', '	kommune_ppostnr', 'kommune_ppoststed', 'kummune_telefon', 'kommune_kontaktinfo', 'kommune_kontaktinfo', 'kommune_hjemmeside'));
		$query->fields('B', array('innbygger', 'kommune_group'));
		$query->condition('A.kommune_id', $kommuneId, '=');
		$kommuneData = $query->execute();
		
		db_set_active();
		
		$kommuneId = $kommuneName = $kommuneMayor = $kommuneParti = $kommunePeriod = $kommuneAdv = $kommunePhone = $kommuneEmail = $kommuneUrl = NULL;
		
		$kommuneGroup = $innbyggerTotal = 0;
		
		foreach ($kommuneData as $dataRow) 
		{
			$kommuneId = $dataRow->kommune_id;
			$kommuneName = $dataRow->kommune_navn;
			$kommuneMayor = $dataRow->kommune_ordforer;
			$kommuneParti = $dataRow->kommune_parti;
			$kommunePeriod = $dataRow->kommune_periode;
			$kommuneAdv = $dataRow->kommune_adviser;
			$kommunePhone = $dataRow->kummune_telefon;
			$kommuneEmail = $dataRow->kommune_kontaktinfo;
			$kommuneUrl = $dataRow->kommune_hjemmeside;
			$innbyggerTotal = $dataRow->innbygger;
			$kommuneGroup = $dataRow->kommune_group;	
			
			$kommuneForretningsadr = $dataRow->kommune_forretningsadr;
			$kommuneForradrpostnr = $dataRow->kommune_forradrpostnr;
			$kommuneForradrpoststed = $dataRow->kommune_forradrpoststed;
			$kommunePostadresse = $dataRow->kommune_postadresse;
			$kommunePpostnr = $dataRow->kommune_ppostnr;
			$kommunePpoststed = $dataRow->kommune_ppoststed;
		}	
				
		$logoPath = $base_url."/sites/default/files/komlogo/".$kommuneId.".gif";
		
		$output.= '<div class="right-content">';
		$output.= '	<div class="logo-widget">';
		$output.= '		<img src="'.$logoPath.'" title="'.$kommuneName.'" width="75" />';
		$output.= '		<h1>'.$kommuneName.'</h1>';
		$output.= '	</div>';

		$output.= '	<h3>Offisiell informasjon</h3>';
		
		$output.= '	<div class="info-box fylke-result">';
		
		$output.= '	  <div class="row">';
		$output.= '		<div class="col-md-6">';
		
		$output.= '		<div class="inner-box">';
		$output.= '			<label>';
		$output.= '				<span style="width:200px;"><strong>Ordf&oslash;rer:</strong></span>';
		$output.= '				<span>'.$kommuneMayor.' - '.$kommuneParti.' ( '.$kommunePeriod.' ) </span>';
		$output.= '			</label>';

		if($user->uid)
		{
			$output.= '			<label>';
			$output.= '				<span><strong>R&aring;dmann:</strong></span>';
			$output.= '				<span>'.$kommuneAdv.'</span>';
			$output.= '			</label>';
		}

		$output.= '			<label>';
		$output.= '				<span><strong>E-post:</strong></span>';
		$output.= '				<span><a href="mailto:'.$kommuneEmail.'">'.$kommuneEmail.'</a></span>';
		$output.= '			</label>';
		
		if($user->uid)
		{
			$output.= '			<label>';
			$output.= '				<span><strong>Telefon:</strong></span>';
			$output.= '				<span>'.$kommunePhone.'</span>';
			$output.= '			</label>';
		}

		$output.= '			<label>';
		$output.= '				<span><strong>Hjemmeside:</strong></span>';
		$output.= '				<span><a href="http://'.$kommuneUrl.'" target="_blank">'.$kommuneUrl.'</a></span>';
		$output.= '			</label>';
		
		$output.= '			<label>';
		$output.= '				<span><strong>Kommune nr:</strong></span>';
		$output.= '				<span>'.$kommuneId.'</span>';
		$output.= '			</label>';

		$output.= '		</div>';		
		$output.= '		</div>';		
		
		$output.= '		<div class="col-md-6">';
		$output.= '		<div class="inner-box">';
		
		$output.= '			<label>';
		$output.= '				<span style="width:200px;"><strong>Forretningsadresse: </strong></span>';
		$output.= '				<span>'.$kommuneForretningsadr.'</span>';
		$output.= '			</label>';
		
		$output.= '			<label>';
		$output.= '				<span><strong>Postnr./Poststed:</strong></span>';
		$output.= '				<span>'.$kommuneForradrpostnr.' / '.$kommuneForradrpoststed.'</span>';
		$output.= '			</label>';
		
		$output.= '			<label>';
		$output.= '				<span><strong>Postadresse:</strong></span>';
		$output.= '				<span>'.$kommunePostadresse.'</span>';
		$output.= '			</label>';
		
		$output.= '			<label>';
		$output.= '				<span><strong>Postnr./Poststed:</strong></span>';
		$output.= '				<span>'.$kommunePpostnr.' / '.$kommunePpoststed.'</span>';
		$output.= '			</label>';
		$output.= '			<label>';
		$output.= '				<span><strong>Innbyggere:</strong></span>';
		$output.= '				<span>'.$innbyggerTotal.' ('.$dataYear.')</span>';
		$output.= '			</label>';
		$output.= '			<label>';
		$output.= '				<span><strong>Kommune gruppe:</strong></span>';
		$output.= '				<span>'.$kommuneGroup.' ('.$dataYear.')</span>';
		$output.= '				<a href="#groupsize" data-toggle="collapse"><i class="fa fa-question-circle"></i></a>';
		$output.= '				<div style="position:relative;"><div id="groupsize" class="collapse" style="z-index:1000;position:absolute;left:-154px;top:-45px;border: 1px solid;max-width:250px;background-color:white;margin:5px;padding:5px;"><strong>Kommunegrupper</strong><br/><strong>Innbyggere</strong><br/>1: - under 2000<br/>2: 2.000 - 4.999<br/>3: 5.000 - 9.999<br/>4: 10.000 - 19.999<br/>5: 20.000 - 49.999<br/>6: 50.000 - 99.999<br/>7: Over 100.000</div></div>';
		$output.= '			</label>';		
		$output.= '		</div>';
		
		$output.= '		</div>';
		$output.= '	</div>';
		$output.= '</div>';
		
		$output.= '	<div class="info-box">';
		$output.= '		<div class="inner-box">';
		$output.= 'En oversikt over leverandørene gir deg bare deler av det store bilde. Om du ønsker å sjekke hvor godt kommunen driver er du nødt til å analysere en betydelig større mengde data. Den jobben har vi alt gjort for deg i form av Kommunebarometret.';
		$output.= '<br /><a href="http://kommunebarometeret.no/nav/'.$kommuneId.'" target="_blank">Sjekk '.$kommuneName.' Kommune</a>';
		$output.= '		</div>';
		$output.= '	</div>';



		db_set_active('kommunaldata');	
		
		// Get kommune Procurement Information;
		$query = db_select('fk_procurement', 'A');
		$query->fields('A', array('fk_data_year', 'fk_total_supplier', 'fk_above_mill_supplier', 'fk_total_invoice'));
		$query->condition('A.fk_kommune_id', $kommuneId, '=');
		//$query->condition('A.fk_data_year', $dataYear, '=');

		$kommuneProcurements = $query->execute();
		
		// Get Group Procurement Information;
		$query = db_select('kommune_procurement', 'A');
		$query->fields('A', array('pro_total_kommune', 'pro_total_invoice', 'pro_total_suppliers', 'pro_total_over_mill'));
		$query->condition('A.pro_group', $kommuneGroup, '=');
		$query->condition('A.pro_year', $dataYear, '=');

		$groupProcurements = $query->execute();
		
		db_set_active();
		
		$kommuneTotalSupplier = $kommuneTotalSupplierOverMill = $kommuneTotalInvoice = 0;

		foreach($kommuneProcurements as $rowData)
		{
			if($dataYear == $rowData->fk_data_year)
			{
				$kommuneTotalSupplier = $rowData->fk_total_supplier;
				$kommuneTotalSupplierOverMill = $rowData->fk_above_mill_supplier;
				$kommuneTotalInvoice = $rowData->fk_total_invoice;
			}			
			
			$xAxis.= $rowData->fk_data_year.',';
			$yAxis.= $rowData->fk_total_invoice.',';
			
		}
		
		$groupTotalSupplier = $groupTotalSupplierOverMill = $groupTotalInvoice = $groupTotalkommune = 0;

		foreach($groupProcurements as $rowData) {
			$groupTotalSupplier = $rowData->pro_total_suppliers;
			$groupTotalSupplierOverMill = $rowData->pro_total_over_mill;
			$groupTotalInvoice = $rowData->pro_total_invoice;
			$groupTotalkommune = $rowData->pro_total_kommune;
		}
			
		$output.= '<h3>Sammendrag / Oversikt</h3>';	
		$output.= '<i>Denne tabelen viser totalt innkjøp for '.$kommuneName.' i '.$dataYear.', sammenlignet med innkjøp fra kommuner i samme størrelse. (For fylker er gjennomsnittet beregnet med bakgrunn i alle fylker)</i>';
		$output.= '<table class="table-view" cellpadding="0" cellspacing="0" width="100%">';
		$output.= '		<thead>';
		$output.= '			<tr>';
		$output.= '				<th width="33%">&nbsp;</th>';

		if($user->uid) {
			$output.= '<th width="33%" class="rightalign">'.$kommuneName.' <a href="#" data-toggle="tooltip" class="tooltipwhite" title="Kj&oslash;pt i 1000"><i class="fa fa-question-circle"></i></a></th>';
		}
		
		$output.= '<th width="33%" class="rightalign"> Gj. snitt <a href="#" class="tooltipwhite" data-toggle="tooltip" title="Gj. snitt for kommuner av samme størrelse. Kjøpt i 1000"><i class="fa fa-question-circle"></i></a></th>';
		
		$output.= '			</tr>';
		$output.= '		</thead>';
		$output.= '	<tbody>';
		
		$output.= '<tr>';
		$output.= '<td>Anskaffelser totalt</td>';

		if($user->uid) {
			$output.= '<td class="rightalign"> '.round($kommuneTotalInvoice / 1000000).' mill</td>';
		}
		
		$output.= '<td class="rightalign">'.round(($groupTotalInvoice/$groupTotalkommune) / 1000000).' mill</td>';
		$output.= '</tr>';

		$output.= '<tr>';
		$output.= '<td>Antall leverandører</td>';
		
		if($user->uid)
		{
			$output.= '<td class="rightalign">'.$kommuneTotalSupplier.'</td>';
		}

		$output.= '<td class="rightalign">'.round($groupTotalSupplier/$groupTotalkommune).'</td>';
		$output.= '</tr>';

		$output.= '<tr>';
		$output.= '<td>Antall leverandører over 1 mill</td>';
		
		if($user->uid)
		{
			$output.= '<td class="rightalign">'.$kommuneTotalSupplierOverMill.'</td>';
		}

		$output.= '<td class="rightalign">'.round($groupTotalSupplierOverMill/$groupTotalkommune).'</td>';
		$output.= '		</tr>';

		$output.= '	</tbody>';
		$output.= '</table>';



		if($user->uid)
		{
			$output.= '<div class="info-colum">';
			$output.= '	<div class="graph">';				
			$output.= '<script>';
			$output.= '	$( document ).ready(function() {';
			$output.= '		$("#invoiceData").highcharts({';
			$output.= '			title: {';
			$output.= '				text: "Innkjøp '.$kommuneName.'",';
			$output.= '				x: -20';
			$output.= '			},';
			$output.= '			xAxis: {';
			$output.= '				categories: ['.$xAxis.']';
			$output.= '			},';
			$output.= '			yAxis: {';
			$output.= '				title: {';
			$output.= '					text: "Innkjøp"';
			$output.= '				},';
			$output.= '				plotLines: [{';
			$output.= '					value: 0,';
			$output.= '					width: 1,';
			$output.= '					color: "#808080"';
			$output.= '				}]';
			$output.= '			},';
			$output.= '			series: [{';
			$output.= '				name: "År",';
			$output.= '				data: ['.$yAxis.']';
			$output.= '			}]});});';
			$output.= '</script>';
		
			$output.= '<div id="invoiceData" style="min-width: 110px; height: 300px; margin: 0 auto"></div>';
			$output.= ' </div>';	
			$output.= ' <div>Kilde Levand&oslash;rdatabasen</div>';
			$output.= '<div class="info-box"><div class="inner-box">';
			$output.= 'Datatilfanget er mindre for tidligere år enn inneværende år. Du kan derfor ikke nødvendigvis sammenligne år mot år.';
			$output.= '</div></div>';
			$output.= getTopSupplierGridFormat($kommuneId, $dataYear, $supplierId, $strGroupClass, $strSubsectorClass, $kommuneName, 'kommune', $nMinRavenu, $nMaxRavenu);
			
			$output.= '<div class="graph-panel">';
			$output.= '	<h3>'.$kommuneName.' Kommunestyre ('.$kommunePeriod.')</h3>';
			$output.= '	<div class="graph-widget">';
			
			$output.= '<script>';
			$output.= '$( document ).ready(function() {';
			$output.= '	$("#container").highcharts({';
			$output.= '		chart: {';
			$output.= '			type: "pie"';
			$output.= '		},';
			$output.= '		title: {';
			$output.= '			text: "'.$kommuneName.' Kommunestyre ('.$kommunePeriod.')"';
			$output.= '		},';
			$output.= '		plotOptions: {';
	        $output.= '	    series: {';
	        $output.= '        dataLabels: {';
	        $output.= '            enabled: true,';
	        $output.= '            format: "{point.name}: {point.y}"';
	        $output.= '        }}},';
			
			$output.= '		tooltip: {';
			$output.= '			headerFormat: "",';
			$output.= '			pointFormat: "{point.name}: <b>{point.y}</b>"';
			$output.= '		},';
			$output.= '		series: [{';
			$output.= '			name: "Brands",';
			
			db_set_active('kommunaldata');	
			
			$query = db_select('kommune_members', 'A');
			$query->fields('A', array('kommune_parti', 'kommune_parti_member'));
			$query->condition('A.kommune_id', $kommuneId);
			$query->orderBy('A.kommune_parti_member', 'DESC');
			$results = $query->execute();
						
			db_set_active();		
			
			$output.= ' data: [';
			foreach($results as $result)
			{
				if($result->kommune_parti_member < 1)
					continue;
					
				$output.= ' {  name: "'.$result->kommune_parti.'", y: '.$result->kommune_parti_member.' }, ';
			}
			
			$output.= ' ]';
			$output.= ' }]';
			$output.= '	});';
			$output.= '});';
			$output.= '</script>';
		
			$output.= '<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>';

			$output.= ' <div>Kilde Levand&oslash;rdatabase</div>';	
			
			$output.= '	</div>';
			$output.= '	<h3>Utlysninger fra Doffin</h3>';
			$output.= '<i>Her vises utlysninger av offentlige anbud i '.$kommuneName.' hvor tilbudsfristen ikke er gått ut. Klikk på anbudet for å se full utlysningstekst fra Doffin.</i>';
			$output.= '	<div class="graph-widget">';
			
			db_set_active('doffindata');	
			
			$query = db_select('doffin', 'D');
			$query->fields('D', array('tittel', 'fylke', 'kommune', 'oppdragsurl', 'type', 'tilbudsfrist'));
			$query->condition('D.kommune', $kommuneName);
			$query->condition('D.tilbudsfrist', date('Y-m-d'), '>=');
			$query->orderBy('D.tilbudsfrist', 'ASC');
			
			$objDoffin = $query->execute();
						
			db_set_active();	
			
			$output.= '<table class="table-view" cellpadding="0" cellspacing="0" width="100%">';
			$output.= '		<thead>';
			$output.= '			<tr>';
			$output.= '				<th width="40%">Tittel</th>';
			$output.= '				<th width="20%">Kommune</th>';
			$output.= '				<th width="20%">Type</th>';
			$output.= '				<th width="20%">Tilbudsfrist</th>';
			$output.= '			</tr>';
			$output.= '		</thead>';
			$output.= '	<tbody>';	
			
			
			foreach($objDoffin as $rowData)
			{
				$output.= '		<tr>';
				$output.= '			<td><a href="'.$rowData->oppdragsurl.'" target="_blank">'.$rowData->tittel.'  <span class="glyphicon glyphicon-link" aria-hidden="true"></span></a></td>';
				$output.= '			<td>'.$rowData->kommune.'</td>';
				$output.= '			<td>'.$rowData->type.'</td>';
				$output.= '			<td>'.$rowData->tilbudsfrist.'</td>';
				$output.= '		</tr>';
			}
			
			$output.= '		</tbody>';
			$output.= '		</table>';
			
			$output.= '	</div>';			
		}
		else
		{
			$module_path = drupal_get_path('module', 'kommunaldata');
			
			$output.= '<div class="sammendrag-panel" id="getuserlogin">';
			$output.= '<div id="user-login-view">';
			$output.= '<div class="sam-login-widget">';
			
			$output.= '<div class="login-form-widget">';
			$output.= '<div class="left-form">';
			$output.= '<h4 class="modal-title">JEG ER ABONNENT</h4>';
			$output.= render(drupal_get_form('user_login_block'));
			$output.= '</div>';
			$output.= '<div class="right-form">';
			$output.= '<h4>JEG ER IKKE ABONNENT</h4>';
			$output.= '<a href="/abonner" class="form-submit">Kontakt oss for tilbud</a>';
			$output.= '</div>';
			$output.= '<p>Spørsmål? Kontakt oss på tlf 24 13 64 50 eller leverandor@kommunal-rapport.no</p>';
			$output.= '</div>';
						
			$output.= '</div>';
			$output.= '</div>';
			$output.= '<img src="'.$base_url.'/'.$module_path.'/img/datapreview.jpg" title="preview" />';
			$output.= '</div>'; 
		}	

		$output.= '</div>';	
		$output.= '</div>';	
				
		return $output;
	
                ?>