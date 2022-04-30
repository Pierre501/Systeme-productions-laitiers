<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vente</title>
    <link href="<?php echo css_loader("bootstrap.min"); ?>" rel="stylesheet">
</head>
<body>
<div class="container">   
        <div class="row">
			<div class="col-md-4">
                <h1>Vente des produits</h1>
                <form action="<?php echo base_url(); ?>CtrlVenteProduitsFini/venteProduitsFini" method="post">
                    <p>
                        <label>Produits</label>
                        <select name="produits" class="form-control">
                            <option>Choix produits</option>
                            <?php foreach($tabProduitsFini as $produitsFini) { ?>
                                <option value="<?php echo $produitsFini->getIdProduit(); ?>"><?php echo $produitsFini->getNomProduit(); ?></option>
                            <?php } ?>
                        </select>
                    </p>
                    <p><label>Quantité</label><input type="number" name="quantite" class="form-control" /></p>
                    <p><input type="submit" value="Valider" class="btn btn-success btn-block" /></p>
                </form>
                <p><a href="<?php echo base_url(); ?>CtrlUtilisateur/pageRetour">Retour</a></p>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <h1>Historiques des ventes effectuées</h1>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Nom produits</th>
                            <th>Quantité</th>
                            <th>Date</th>
                        </tr>
                    <?php foreach($tabStockSortant as $stockSortant) { ?>
                        <tr>
                            <td><?php echo $stockSortant->getNomProduit(); ?></td>
                            <td><?php echo $stockSortant->getQuantiteSortant(); ?> Kg</td>
                            <td><?php echo $stockSortant->getDateStock(); ?></td>
                        </tr>
                    <?php } ?>
                    </table>
            </div>
        </div>
</div>
</body>
</html>