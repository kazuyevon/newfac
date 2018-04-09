<?php
namespace newfac\devtools\view;
/*
 * #src\devtools\view\viewHeader.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	
	<!-- Required meta tags -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">
        
    <title>View Factures</title>

	<!-- Bootstrap core CSS-->
	<link href="../../vendor/twitter/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<!-- Custom Css -->
	<link href="../css/style.css" rel="stylesheet">

 
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">

	<!-- Brand and toggle get grouped for better mobile display -->
		
		<a class="navbar-brand" href="../index.php">View Factures
			<!--<img alt="Brand" src="...">-->
		</a>
		<button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
		</button>
		
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<div class="btn-group-vertical">
				<div class="form-inline"> 
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">Link</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navBarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Dropdown
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
								<div class="dropdown-divider">
									<a class="dropdown-item" href="#">One more separated link</a>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
								Dropdown
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown2">
								<a class="dropdown-item" href="addclient.php">Ajouter des clients</a>
								<a class="dropdown-item" href="addfacture.php">Ajouter des factures</a>
								<a class="dropdown-item" href="#">Something else here</a>
								<div class="dropdwon-divider">
									<a class="dropdown-item" href="#">Separated link</a>
								</div>
							</div>
						</li>
					</ul>		
					<form class="my-2 my-lg-0 ml-auto" action="" method="post">
						<div class="btn-group" role="group" aria-label="Default button group">
							<input type="text" id="searchbox" class="form-control typeahead" name="searchbox" placeholder="Rechercher">
							<div class="input-group-append">
								<button type="submit" class="btn btn-outline-succes">Ok</button>
							</div>
						</div><!-- /.btn-group -->
					</form>
				</div><!-- /.form-inline -->
				<div class="my-2 my-lg-0 ml-auto text-right">
					<a class="btn btn-light" id="searchOptionsBtn" role="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseExample" style=" width: -webkit-fill-available;">
						Options de recherche
					</a>
				</div>
				<form class="collapse ml-auto" id="collapseSearch" method="POST" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
					<div class="form-check input-group-text text-right">
						<input class="form-check-input " type="radio" name="category" checked value="nom" id="defaultCheck1">
						<label class="form-check-label" for="defaultCheck1">
							Nom de Client
						</label>
					</div>
					<div class="form-check input-group-text text-right">
						<input class="form-check-input" type="radio" name="category" value="prenom" id="defaultCheck2">
						<label class="form-check-label" for="defaultCheck2">
							Prénom de Client
						</label>
					</div>
					<div class="form-check input-group-text text-right">
						<input class="form-check-input" type="radio" name="category" value="num" id="defaultCheck3">
						<label class="form-check-label" for="defaultCheck3">
							Numéro de Facture
						</label>
					</div>
					<div class="form-check input-group-text text-right">
						<input class="form-check-input" type="radio" name="category" value="somme" id="defaultCheck4">
						<label class="form-check-label" for="defaultCheck4">
							Montant de Facture
						</label>
					</div>
					<div class="form-check input-group-text text-right">
						<input class="form-check-input" type="radio" name="category" value="date" id="defaultCheck5">
						<label class="form-check-label" for="defaultCheck5">
							Date de Facture
						</label>
					</div>
				</form><!-- /#collapseSearch -->
			</div><!-- /.btn-group-vertical -->
			</div><!-- /.navbar-collapse -->
	</nav>
	
	<!-- container -->
	<div class="container-fluid">
		<div class="row">
			<!-- sidebar -->
			
			<nav class="col-sm-3 col-md-2 hidden-xs d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<ul class="nav nav-pills flex-column">
						<li class="nav-item">
							<a class="nav-link text-left active" href="../index.php">
								<img src="../img/glyphicons-21-home.png" alt="">
								Tableau de Bord
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-left" href="../clients.php">
								<img src="../img/glyphicons-44-group.png" alt="">
								Clients
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-left" href="#sec1">
								<img src="../img/glyphicons-539-invoice.png" alt="">
								Factures
							</a>
						</li>
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#sec2"> -->
								<!-- <img src="img/glyphicons-59-truck.png" alt=""> -->
								<!-- Fournisseurs -->
							<!-- </a> -->
						<!-- </li> -->
						<li class="nav-item">
							<a class="nav-link text-left" href="#sec3">
								<img src="../img/glyphicons-41-stats.png" alt="">
								Rapports
							</a>
						</li>
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#sec4" class=""> -->
								<!-- <img src="img/glyphicons-526-user-key.png" alt=""> -->
								<!-- Collaborateurs -->
							<!-- </a> -->
						<!-- </li> -->
					</ul>
					<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
						<span>Papports enregistrés</span>
						<a class="d-flex align-items-center text-muted" href="#">
							<img src="../img/glyphicons-703-file-plus.png" alt="">
						</a>
					</h6>
					<!-- <ul class="nav flex-column mb-2"> -->
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#"> -->
								<!-- <img src="../img/glyphicons-685-article.png" alt=""> -->
								<!-- Current month -->
							<!-- </a> -->
						<!-- </li> -->
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#"> -->
								<!-- <img src="../img/glyphicons-685-article.png" alt=""> -->
								<!-- Last quarter -->
							<!-- </a> -->
						<!-- </li> -->
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#"> -->
								<!-- <img src="../img/glyphicons-685-article.png" alt=""> -->
								<!-- Social engagement -->
							<!-- </a> -->
						<!-- </li> -->
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#"> -->
								<!-- <img src="../img/glyphicons-685-article.png" alt=""> -->
								<!-- Year-end sale -->
							<!-- </a> -->
						<!-- </li> -->
					<!-- </ul> -->
					<!-- <ul class="nav nav-pills flex-column"> -->
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#sec0" class="">Section</a> -->
						<!-- </li> -->
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#sec1" class="">section1</a> -->
						<!-- </li> -->
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#sec2" class="">Section 2</a> -->
						<!-- </li> -->
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#sec3" class="">Section 3</a> -->
						<!-- </li> -->
						<!-- <li class="nav-item"> -->
							<!-- <a class="nav-link text-left" href="#sec4" class="">Section 4</a> -->
						<!-- </li> -->
					<!-- </ul> -->
				</div>
				<!-- /.sidebar-sticky -->
			</nav><!-- / nav sidebar -->
			
			<!-- Main-->
			<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">