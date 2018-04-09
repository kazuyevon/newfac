/* Envoie la saisie en recherche sql */
$(document).ready(function() {
    /* Contrôle la searchbox en fonction du checkbox choisit avec datepicker actif juste pour le checkbox date */
    var category = 'nom'; //par défaut
    var idsearchbox = document.getElementById('searchbox');
    var query = '';
	$('input[name=category]').change(function() {
        if ($(this).is(':checked')) {
            category = $(this).val();
			switch (category) {
            case 'nom':
				$(idsearchbox).attr('placeholder', 'Nom');
				break;
            case 'prenom':
				$(idsearchbox).attr('placeholder', 'Prénom');
                break;
            case 'num':
				$(idsearchbox).attr('placeholder', 'Numéro de facture');
				break;
            case 'somme':
				$(idsearchbox).attr('placeholder', 'Montant');
                break;
            case 'date':
				$(idsearchbox).attr('placeholder', 'Date aaaa-mm-jj');
                break;
            default:
                break;
            }
			/* On vide la searchbox */
            if ($('input[name=searchbox]').val()) {
                $('input[name=searchbox]').val('');
            }
        }
    });
    // Charge le framework typeahead
    $(idsearchbox).typeahead({
		theme: "bootstrap4",
		// themes: {     
			// bootstrap4: {
				// menu: '<div class="typeahead dropdown-menu"></div>',
				// item: '<a class="dropdown-item" role="option" href="#"></a>',
				// itemContentSelector: '.dropdown-item',
				// headerHtml: '<h6 class="dropdown-header"></h6>',
				// headerDivider: '<div class="dropdown-divider"></div>'
			// } 
		// },
		/* nb d'items max à afficher */
		items: 100,
		source: function(query, process) {
			clients = [];
			factures = [];
			var view;
			var selectedId = '0';
			var selectedAnnee = '0';
			map = {};
            $.ajax({
                url: 'inc/searchengine.php',
                data: 'query=' + query + '&category=' + category,
                dataType: 'json',
                type: 'POST',
                success: function(data) {
                    if (category == 'nom' || category == 'prenom') {
                        $.each(data, function(i, client) {
							switch (category) {
                            case 'nom':
								/* bug si 2 noms pareil */
                                /* map[clé] = valeur ou ici object*/
								/* Muret est deja present comme clé, alors le 2eme ecrase le premier */
								/* alors on rajoute le prenom avec le nom comme clé */
								map[client.nom + ' ' + client.prenom] = client;
                                clients.push(client.nom + ' ' + client.prenom);
                                break;
                            case 'prenom':
                                map[client.prenom + ' ' + client.nom] = client;
                                clients.push(client.prenom + ' ' + client.nom);
								break;
                            default:
                                break;
                            }
                        });
						process(clients);
                    } else {
                        $.each(data, function(i, facture) {
                            switch (category) {
                            case 'num':
                                map[facture.num + ' ' + facture.somme + ' ' + facture.date] = facture;
                                factures.push(facture.num + ' ' + facture.somme + ' ' + facture.date);
                                break;
                            case 'somme':
                                map[facture.somme + ' ' + facture.num + ' ' + facture.date] = facture;
                                factures.push(facture.somme + ' ' + facture.num + ' ' + facture.date);
                                break;
                            case 'date':
                                map[facture.date + ' ' + facture.num + ' ' + facture.somme] = facture;
                                factures.push(facture.date + ' ' + facture.num + ' ' + facture.somme);
                                break;
                            default:
                                break;
                            }
                        });
                        process(factures);
                    }
                }
            })
        },
        /* Renvoie le terme correspondant de la BDD. */
        matcher: function(item) {
            /* pour que Mélanie apparaisse même si 'me' est tapé alors que 'Mé' est stocké en BDD, */
			/* on supprime toLowerCase . */
            // if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) { 
				return true;
            // } 
        },
        /* Les range pas ordre ASC. */
        sorter: function(items) {
            return items.sort();
        },
        /* Met en surbrillance lettre par lettre recherchée, */
        /* la liste des suggestions et rajoute la suite de caratères proposée par la suggestion */
        highlighter: function(item) {
            switch (category) {
			case 'nom':
				var regex = new RegExp('(' + this.query + ')','gi');
				var replace = item.replace(regex, '<font style="color:dark"><strong>$1</strong></font>');
				return replace;
                break;
            case 'prenom':
				var regex = new RegExp('(' + this.query + ')','gi');
				var replace = item.replace(regex, '<font style="color:dark"><strong>$1</strong></font>');
                return replace;
                break;
            case 'num':
				var regex = new RegExp('(' + this.query + ')','gi');
				/* recupère le premier mots avant l'espace de la chaine de caractères item et rajoute la suite du texte */
				var replace = item.split(' ')[0].replace(regex, '<font style="color:dark"><strong>$1</strong></font>');
                return 'N° : ' + replace + '<br>' + map[item].somme + ' Euros<br>' + map[item].date;
				break;
            case 'somme':
				var regex = new RegExp('(' + this.query + ')','gi');
				var replace = item.split(' ')[0].replace(regex, '<font style="color:dark"><strong>$1</strong></font>');
                return replace + ' Euros <br> N° :' + map[item].num + '<br>' + map[item].date;
				break;
            case 'date':
				var regex = new RegExp('(' + this.query + ')','gi');
				var replace = item.split(' ')[0].replace(regex, '<font style="color:dark"><strong>$1</strong></font>');
                return replace + ' <br> N° :' + map[item].num + '<br>' + map[item].somme + ' Euros';
				break;
            default:
                break;
            }
        },
        /* Une fois sélectionné, affiche nom et prénom ou inversement dans la zone de saisie.
			ou num somme date en fonction de la category choisit*/
        updater: function(item) {
            switch (category) {
            case 'nom':
                selectedId = map[item].id;
                view = item;
                break;
            case 'prenom':
                selectedId = map[item].id;
                view = item;
				break;
            case 'num':
                selectedId = map[item].idclient;
				/* Recupère juste l'année */
				selectedAnnee = map[item].date.slice(0, 4);
                view = 'N° : ' + item.split(" ")[0] + ' ' + map[item].somme + ' Euros ' + map[item].date;
				$('#searchboxannee ').val(selectedAnnee);
                break;
            case 'somme':
                selectedId = map[item].idclient;
				selectedAnnee = map[item].date.slice(0, 4);
                view = item.split(" ")[0] + ' Euros N° : ' + map[item].num + ' ' + map[item].date;
				$('#searchboxannee ').val(selectedAnnee);
                break;
            case 'date':
                selectedId = map[item].idclient;
				selectedAnnee = map[item].date.slice(0, 4);
                view = item.split(" ")[0] + ' N° : ' + map[item].num + ' ' + map[item].somme + ' Euros';
				$('#searchboxannee ').val(selectedAnnee);
                break;
            default:
                break;
            }
			/* Envoie valeur id ou valeur num en input hidden #searchboxid*/
            $('#searchboxid ').val(selectedId);
            return view;
        }
    });
});
