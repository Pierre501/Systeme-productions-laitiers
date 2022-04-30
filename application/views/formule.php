<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formule</title>
</head>
<body>
    <h1>Ajouter une formule</h1>
    <form action="<?php echo base_url(); ?>CtrlFabrication/ajoutantFormule" method="post">
        <p>Produits fini : 
            <select name="produits">
                <option>Choix produits</option>
            <?php foreach($tabProduitsFini as $produitsFini) { ?>
                <option value="<?php echo $produitsFini->getIdProduit(); ?>"><?php echo $produitsFini->getNomProduit(); ?></option>
            <?php } ?>
            </select>
        </p>
        <p><label>Nom de la formule : </label><input type="text" name="nomFormule" /></p>
        <p><input type="submit" value="Ajouter" /></p>
    </form>
    <p><a href="<?php echo base_url(); ?>CtrlUtilisateur/pageRetour">Retour</a></p>
</body>
</html>