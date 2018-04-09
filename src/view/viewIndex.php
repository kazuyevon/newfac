<?php
namespace newfac\view;
/*
 * #src\view\viewIndex.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 ?>
<section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Tableau de bord</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<button class="btn btn-sm btn-outline-secondary disabled">Partager</button>
				<button class="btn btn-sm btn-outline-secondary disabled">Exporter</button>
			</div>
			<div class="dropdown">
				<a class="btn btn-sm btn-outline-secondary dropdown-toggle" href="#" id="weekDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="img/glyphicons-685-article.png" alt="icon name">
					<span id="titleweek">Ce jour</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="weekDropdown">
					<button class="dropdown-item active" id="frequency" value="Ce jour">Ce jour</button>
					<!-- <button class="dropdown-item" id="frequency" value="Cette semaine">Cette semaine</button> -->
					<button class="dropdown-item" id="frequency" value="Ce mois">Ce mois</button>
					<!-- <button class="dropdown-item" id="frequency" value="Ce trimestre">Ce trimestre</button> -->
					<button class="dropdown-item" id="frequency" value="Cette année">Cette année</button>
				</div>
			</div>
		</div>
</section>
<section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
			</div>
			<div class="col-md-6">
				<div class="alert alert-info" role="alert" id="alertbox">
					<h3>Aujourd'hui <?php echo $dateCouranteFr ?></h3>
					<ul class="list-group">
						<li class="list-group-item"><h6>Nombre Clients ayant acheté<span class="badge badge-info float-right"><?php echo $nbClientsJour ?></span></h6></li>
						<li class="list-group-item"><h6>Nouvelles Factures<span class="badge badge-info float-right"><?php echo $totaFacturesJour ?></span></h6></li>
						<li class="list-group-item"><h6>Somme des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $sommeTotalFacturesJour ?></span></h6></li>
						<li class="list-group-item"><h6>Minimum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $minSommeTotalJour ?></span></h6></li>
						<li class="list-group-item"><h6>Maximum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $maxSommeTotalJour ?></span></h6></li>
					</ul>
					<h4>Label</h4>
					<div class="text-muted">Something else</div>
				</div>			
			</div>
		</div>
	</div>	
</section>

<script type="text/javascript" src="../vendor/components/jquery/jquery.min.js"></script>
<script type="text/javascript"><!-- src="./js/dropweek.js" -->			
$(document).ready(function() {
	value = 'Ce jour';
	$( 'button[id=frequency]' ).click(function() {
		value = $(this).val();
		$('button[id=frequency]').removeClass('active');
		$(this).addClass('active');
		
		$('span[id=titleweek]').replaceWith('<span id="titleweek">'+value+'</span>');
		
		switch(value){
			case 'Ce jour':
				$('div[id=alertbox]').replaceWith('<div class="alert alert-info" role="alert" id="alertbox">'+
					'<h3>Aujourd\'hui <?php echo $dateCouranteFr ?></h3>'+
					'<ul class="list-group">'+
						'<li class="list-group-item"><h6>Nombre Clients ayant acheté<span class="badge badge-info float-right"><?php echo $nbClientsJour ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Nouvelles Factures<span class="badge badge-info float-right"><?php echo $totaFacturesJour ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Somme des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $sommeTotalFacturesJour ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Minimum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $minSommeTotalJour ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Maximum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $maxSommeTotalJour ?></span></h6></li>'+
					'</ul>'+
					'<h4>Label</h4>'+
					'<div class="text-muted">Something else</div>'+
				'</div>');
				break;
			// case 'Cette semaine':
				// $('div[id=alertbox]').replaceWith('<div class="alert alert-info" role="alert" id="alertbox">'+
					// '<h3>Hebdomadaire  Semaine <?php echo $semaineCourante ?></h3>'+
					// '<ul class="list-group">'+
						// '<li class="list-group-item"><h6>Nombre Clients ayant acheté<span class="badge badge-info float-right"><?php echo $nbClients ?></span></h6></li>'+
						// '<li class="list-group-item"><h6>Nouvelles Factures<span class="badge badge-info float-right"><?php echo $totaFacturesSemaine ?></span></h6></li>'+
						// '<li class="list-group-item"><h6>Somme des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $sommeTotalFacturesSemaine ?></span></h6></li>'+
						// '<li class="list-group-item"><h6>Minimum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $minSommeTotalSemaine ?></span></h6></li>'+
						// '<li class="list-group-item"><h6>Maximum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $maxSommeTotalSemaine ?></span></h6></li>'+
					// '</ul>'+
					// '<h4>Label</h4>'+
					// '<div class="text-muted">Something else</div>'+
				// '</div>');
				// break;
			case 'Ce mois':
				$('div[id=alertbox]').replaceWith('<div class="alert alert-info" role="alert" id="alertbox">'+
					'<h3><?php echo $moisCourantFr ?> <?php echo $anneeCourante ?></h3>'+
					'<ul class="list-group">'+
						'<li class="list-group-item"><h6>Nombre Clients ayant acheté<span class="badge badge-info float-right"><?php echo $nbClientsMois ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Nouvelles Factures<span class="badge badge-info float-right"><?php echo $totaFacturesMois ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Somme des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $sommeTotalFacturesMois ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Minimum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $minSommeTotalMois ?></span></h6></li>'+
						'<li class="list-group-item"><h6>Maximum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $maxSommeTotalMois ?></span></h6></li>'+
					'</ul>'+
					'<h4>Label</h4>'+
					'<div class="text-muted">Something else</div>'+
				'</div>');
				break;
			// case 'Ce trimestre':
				// $('div[id=alertbox]').replaceWith('<div class="alert alert-info" role="alert" id="alertbox">'+
					// '<h3>Trimestriel</h3>'+
					// '<ul class="list-group">'+
						// '<li class="list-group-item"><h6>Nombre Clients ayant acheté<span class="badge badge-info float-right"><?php echo $nbClients ?></span></h6></li>'+
						// '<li class="list-group-item"><h6>Nouvelles Factures<span class="badge badge-info float-right"><?php echo $totaFacturesTrimestre ?></span></h6></li>'+
						// '<li class="list-group-item"><h6>Somme des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $sommeTotalFacturesTrimestre ?></span></h6></li>'+
						// '<li class="list-group-item"><h6>Minimum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $minSommeTotalTrimestre ?></span></h6></li>'+
						// '<li class="list-group-item"><h6>Maximum des Nouvelles Factures<span class="badge badge-info float-right"><?php echo $maxSommeTotalTrimestre ?></span></h6></li>'+
					// '</ul>'+
					// '<h4>Label</h4>'+
					// '<div class="text-muted">Something else</div>'+
				// '</div>');
				// break;
			case 'Cette année':
				$('div[id=alertbox]').replaceWith('<div class="alert alert-info" role="alert" id="alertbox">'+
					'<h3>Année <?php echo $anneeCourante ?></h3>'+
					'<ul class="list-group">'+
						'<li class="list-group-item"><h6>Nombre Clients ayant acheté<span class="badge badge-info float-right"><?php echo $nbClientsAnnee ?></span></h6></li>'+
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
				</script>