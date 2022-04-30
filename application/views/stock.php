<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link href="<?php echo css_loader("bootstrap.min"); ?>" rel="stylesheet">
</head>
<body>
<div class="container">   
        <div class="row">
            <div class="col-md-1"></div>
			<div class="col-md-10">
                <h1>Etat de stock du jour</h1>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Matière prémiers</th>
                        <th>Quantite restant</th>
                        <th>Sueil minimum</th>
                        <th>Date</th>
                    </tr>
                <?php foreach($tabStockRestant as $stockRestant) { ?>
                    <tr>
                        <td><?php echo $stockRestant->getNomMatierePremiers(); ?></td>
                        <td><?php echo number_format($stockRestant->getQuantiteStockRestant(), 2); ?> Kg</td>
                        <td><?php echo $stockRestant->getSueilMinimum(); ?> Kg</td>
                        <td><?php echo $stockRestant->getDateStockRestant(); ?></td>
                    </tr>
                <?php } ?>
                </table>
                <h1>Liste des achat à faire</h1>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Matière prémiers</th>
                        <th>Commentaire</th>
                    </tr>
                <?php foreach($listeAchat as $achat) { ?>
                    <tr>
                        <td><?php echo $achat->getNomMatierePremiers(); ?></td>
                        <td>Insuffisant</td>
                    </tr>
                <?php } ?>
                </table>
                <p><a href="#">Export en cv</a></p>
                <p><a href="<?php echo base_url(); ?>CtrlUtilisateur/pageRetour">Retour</a></p>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</body>
</html>