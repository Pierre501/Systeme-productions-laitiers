<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>achat</title>
    <link href="<?php echo css_loader("bootstrap.min"); ?>" rel="stylesheet">
</head>
<body>
<div class="container">   
        <div class="row">
            <div class="col-md-4"></div>
			<div class="col-md-4">
                <h1>Achat matière prémiers</h1>
                <form action="<?php echo base_url(); ?>CtrlUtilisateur/valideAchat" method="post">
                    <p>
                        <label>Matière prémiers </label>
                        <select name="id" class="form-control">
                            <option>Choix</option>
                        <?php foreach($tabMatierePremiers as $matierePremiers) { ?>
                            <option value="<?php echo $matierePremiers->getIdMatierePremiers(); ?>"><?php echo $matierePremiers->getNomMatierePremiers(); ?></option>
                        <?php } ?>
                        </select>
                    </p>
                    <p><label>Quantité </label><input type="number" name="quantite" class="form-control" /></p>
                    <p><label>Date d'achat </label><input type="date" name="date" class="form-control" /></p>
                    <p><input type="submit" value="Valider" class="btn btn-success btn-block" /></p>
                </form>
                <p><a href="<?php echo base_url(); ?>CtrlUtilisateur/pageRetour">Retour</a></p>
            </div>
        <div class="col-md-4"></div>
    </div>
</div>
</body>
</html>