<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabrication</title>
    <link href="<?php echo css_loader("bootstrap.min"); ?>" rel="stylesheet">
</head>
<body>
<div class="container">   
        <div class="row">
            <div class="col-md-4"></div>
			<div class="col-md-4">
                <h1>Fabrication des produits laitiers</h1>
                <form action="<?php echo base_url(); ?>CtrlFabrication/fabricationProduitsFini" method="post">
                    <p>
                        <label>Nom du produit </label>
                        <select name="produits" class="form-control">
                            <option>Choix</option>
                        <?php foreach($tabProduitsFini as $produitsFini) { ?>
                            <option value="<?php echo $produitsFini->getNomProduit(); ?>"><?php echo $produitsFini->getNomProduit(); ?></option>
                        <?php } ?>
                        </select>
                    </p>
                    <p><label>Quantité </label><input type="number" name="quantite" class="form-control" /></p>
                    <p><input type="submit" value="Valider" class="btn btn-success btn-block" /></p>
                </form>
                <p><a href="<?php echo base_url(); ?>CtrlUtilisateur/pageRetour">Retour</a></p>
                <?php if(isset($exception)) { echo "Les matières premières existantes permettrent seulement d'en fabriquer ".$exception." Kg de ".$produits; } ?>
            </div>
            <div class="col-md-4"></div>
        </div>
</div>
</body>
</html>