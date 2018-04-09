<?php
namespace newfac\view;
/*
 * #src/view/viewFactures.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>
 <section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<div class="container-fluid">		
		<nav id="pagination-year" aria-label="Page navigation">
			<ul class="pagination breadcrumb">
				<!--<li class="page-item">
					<a class="page-link" href="#" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
						<span class="sr-only">Previous</span>
					</a>
				</li>-->
<?php
	foreach ($annees as $an){
		if ($annee == $an) {
			?>
				<li class="page-item active">
					<a class="page-link" href="factures.php?idclient=<?php echo $id_client ?>&annee=<?php echo $an ?>"><?php echo $an ?></a>
				</li>
<?php	
		}
		else {
			
		
?>
				<li class="page-item">
					<a class="page-link" href="factures.php?idclient=<?php echo $id_client ?>&annee=<?php echo $an ?>"><?php echo $an ?></a>
				</li>
<?php
		}
	}
?>
				<!--<li class="page-item">
					<a class="page-link" href="#" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
						<span class="sr-only">Next</span>
					</a>
				</li>-->
			</ul>
		</nav>
	</div><!-- /container-fluid -->
</section>
<!-- section graph + alert -->
<section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">	
	<div class="container-fluid">
		<div class="row">	
			<div class="col-md-8">
				<h1><?php echo $nom ?> <?php echo $prenom ?> année  <?php echo $annee ?></h1>
				<canvas id="myChart" class="chartjs-render-monitor" style="display: block; width: 500px; height: 250px;"></canvas>
				<script type="text/javascript" src="../vendor/nnnick/chartjs/dist/Chart.js"></script>
				<script type="text/javascript">
    
						var chart = new Chart(document.getElementById("myChart"),{
							"type":"line",
							"data":{
								"labels":["Janvier","Février","Mars","Avril","Mai","Juin","Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
								"datasets":[{
									"label":"Montant",
									"data": <?php echo json_encode($arraymontant) ?>,
									"fill":false,
									"borderColor":"#6b5b95",
									"lineTension":0.1},{
						
									"label":"Cumul",
									"data": <?php echo json_encode($arraycumul) ?>,
									"fill":false,
									"borderColor":"#d64161",
									"lineTension":0.1},{
					
									"label":"Moyenne",
									"data": <?php echo json_encode($arraymoyen) ?>,
									"fill":false,
									"borderColor":"#ff7b25",
									"lineTension":0.1}
								]
							},
							"options":{}
						})
				</script>
			</div><!-- /col-md-8 -->
		
			<div class="col-md-4">
				<div class="alert alert-success" role="alert">
					<ul class="list-group">
						<li class="list-group-item">
							<h6>Achats Moyen année <?php echo $annee ?><span class="badge badge-info float-right"><?php echo $arraymoyen[0] ?></span></h6>
						</li>
						<li class="list-group-item">
							<h6>Nombre d'achats <?php echo $annee ?><span class="badge badge-info float-right"><?php echo $nbAchats ?></span></h6>
						</li>
						<li class="list-group-item">
							<h6>Achat min <?php echo $annee ?><span class="badge badge-info float-right"><?php echo min(array_filter($arraymontant)) ?></span></h6>
						</li>
						<li class="list-group-item">
							<h6>Achats max <?php echo $annee ?><span class="badge badge-info float-right"><?php echo max($arraymontant) ?></span></h6>
						</li>
						<li class="list-group-item">
							<h6>Achat Total <?php echo $annee ?><span class="badge badge-info float-right"><?php echo $arraycumul[11] ?></span></h6>
							
							<span class="badge"></span>
						</li>
					</ul>
				</div>
				<div class="alert alert-info" role="alert">
					<ul class="list-group">
						<li class="list-group-item">
							Téléphone
							<span class="badge">012345678</span>
						</li>
						<li class="list-group-item">
							Adresse
							<span class="badge">1 rue des Peupliers,<br> 17000 La Rochelle</span>
						</li>
					</ul>
				</div><!-- /alert -->
			</div><!-- /col-md-4 -->
		</div><!-- /row -->
	</div><!-- /container-fluid -->
</section>

<section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">	
	<div class="container-fluid">
		<p>
			<!-- bouton pour afficher les details -->
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				Détails
			</button>
		</p>
		<div class="collapse" id="collapseExample">
			<table class="table">
				<thead class="thead-dark table-bordered">
					<tr>
						<th scope="col">Date</th>
						<th scope="col">Montant</th>
					</tr>
				</thead>
				<tbody>
<?php
	for($i=0; $i<$nbAchats; $i++){
?>
					<tr>
						<td><?php echo $dates[$i] ?></td>
						<td><?php echo $sommes[$i] ?></td>
					</tr>
<?php
	}
?>
				</tbody>
			</table>
		</div><!-- /collapse -->
	</div><!-- /container-fluid -->
</section>