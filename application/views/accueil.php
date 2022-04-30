<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="<?php echo css_loader("bootstrap.min"); ?>" rel="stylesheet">
</head>
<body>
<div class="container">   
        <div class="row">
            <div class="col-md-4"></div>
			<div class="col-md-4">
                    <h1 align="center">Accueil</h1>
                    <p><a href="<?php echo base_url(); ?>CtrlUtilisateur/achat" class="btn btn-success btn-block">Gestion d'achat</a></p>
                    <p><a href="<?php echo base_url(); ?>CtrlUtilisateur/stock" class="btn btn-success btn-block">Etat stock matière prémiers</a></p>
                    <p><a href="<?php echo base_url(); ?>CtrlFabrication/stockProduitsFini" class="btn btn-success btn-block">Etat stock produits fini</a></p>
                    <p><a href="<?php echo base_url(); ?>CtrlFabrication/pageFabrication" class="btn btn-success btn-block">Gestion des fabrications</a></p>
                    <p><a href="<?php echo base_url(); ?>CtrlFabrication/pageCrud" class="btn btn-success btn-block">Gestion des formules</a></p>
                    <p><a href="<?php echo base_url(); ?>CtrlVenteProduitsFini/pageVente" class="btn btn-success btn-block">Gestion des ventes</a></p>
                    <p><a href="<?php echo base_url(); ?>CtrlUtilisateur/deconnexion" class="btn btn-success btn-block">Déconnexion</a></p>
            </div>
            <div class="col-md-4"></div>
        </div>
</div>
</body>
</html>