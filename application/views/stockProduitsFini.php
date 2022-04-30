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
                <h1>Stock produits fini</h1>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Nom produit</th>
                        <th>Quantité restant</th>
                        <th>Date</th>
                    </tr>
                    <?php foreach($tabStockRestant as $stockRestant) { ?>
                        <tr>
                            <td><?php echo $stockRestant->getNomProduit(); ?></td>
                            <td><?php echo $stockRestant->getQuantiteRestant(); ?> Kg</td>
                            <td><?php echo $stockRestant->getDateStock(); ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <p><a href="<?php echo base_url(); ?>CtrlUtilisateur/pageRetour">Retour</a></p>
            </div>
            <div class="col-md-1"></div>
        </div>
</div>
</body>
</html>