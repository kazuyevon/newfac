$(document).ready(function() {
	value = 'Ce jour';
	$( 'button[id=frequency]' ).click(function() {
		value = $(this).val();
		$('button[id=frequency]').removeClass('active');
		$(this).addClass('active');
		
		$('span[id=titleweek]').replaceWith('<span id="titleweek">'+value+'</span>');
		
		switch(value){
			case 'Cette jour':
				$('div[id=alertbox]').replaceWith('<div class="alert alert-info" role="alert" id="alertbox">'+
					'<h3>Journalier</h3>'+
					'<ul class="list-group">'+
						'<li class="list-group-item"><h6>Nombre Clients<span class="badge badge-info float-right"><?php echo $nbClients ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Nouvelles Factures<span class="badge badge-info float-right"><?php echo $totaFacturesJour ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Somme des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $sommeTotalFacturesJour ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Minimum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $minSommeTotalJour ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Maximum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $maxSommeTotalJour ?></span></h6></li>'+
					'</ul>'+
					'<h4>Label</h4>'+
					'<div class="text-muted">Something else</div>'+
				'</div>');
				break;
			case 'Cette semaine':
				$('div[id=alertbox]').replaceWith('<div class="alert alert-info" role="alert" id="alertbox">'+
					'<h3>Hebdomadaire</h3>'+
					'<ul class="list-group">'+
						'<li class="list-group-item"><h6>Nombre Clients<span class="badge badge-info float-right"><?php echo $nbClients ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Nouvelles Factures<span class="badge badge-info float-right"><?php echo $totaFacturesSemaine ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Somme des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $sommeTotalFacturesSemaine ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Minimum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $minSommeTotalSemaine ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Maximum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $maxSommeTotalSemaine ?></span></h6></li>'+
					'</ul>'+
					'<h4>Label</h4>'+
					'<div class="text-muted">Something else</div>'+
				'</div>');
				break;
			case 'Ce mois':
				$('div[id=alertbox]').replaceWith('<div class="alert alert-info" role="alert" id="alertbox">'+
					'<h3>Mensuel</h3>'+
					'<ul class="list-group">'+
						'<li class="list-group-item"><h6>Nombre Clients<span class="badge badge-info float-right"><?php echo $nbClients ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Nouvelles Factures<span class="badge badge-info float-right"><?php echo $totaFacturesMois ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Somme des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $sommeTotalFacturesMois ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Minimum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $minSommeTotalMois ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Maximum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $maxSommeTotalMois ?></span></h6></li>'+
					'</ul>'+
					'<h4>Label</h4>'+
					'<div class="text-muted">Something else</div>'+
				'</div>');
				break;
			case 'Ce trimestre':
				$('div[id=alertbox]').replaceWith('<div class="alert alert-info" role="alert" id="alertbox">'+
					'<h3>Trimestriel</h3>'+
					'<ul class="list-group">'+
						'<li class="list-group-item"><h6>Nombre Clients<span class="badge badge-info float-right"><?php echo $nbClients ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Nouvelles Factures<span class="badge badge-info float-right"><?php echo $totaFacturesTrimestre ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Somme des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $sommeTotalFacturesTrimestre ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Minimum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $minSommeTotalTrimestre ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Maximum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $maxSommeTotalTrimestre ?></span></h6></li>'+
					'</ul>'+
					'<h4>Label</h4>'+
					'<div class="text-muted">Something else</div>'+
				'</div>');
				break;
			case 'Cette année':
				$('div[id=alertbox]').replaceWith('<div class="alert alert-info" role="alert" id="alertbox">'+
					'<h3>Annuel</h3>'+
					'<ul class="list-group">'+
						'<li class="list-group-item"><h6>Nombre Clients<span class="badge badge-info float-right"><?php echo $nbClients ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Nouvelles Factures<span class="badge badge-info float-right"><?php echo $totaFacturesAnnee ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Somme des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $sommeTotalFacturesAnnee ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Minimum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $minSommeTotalAnnee ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Maximum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $maxSommeTotalAnnee ?></span></h6></li>'+
					'</ul>'+
					'<h4>Label</h4>'+
					'<div class="text-muted">Something else</div>'+
				'</div>');
				break;
		}
	});
});