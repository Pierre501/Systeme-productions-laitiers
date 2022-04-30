<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
</head>
<body>
    <h1>Modifier un composant dans la <?php echo $nomFormule; ?></h1>
    <form action="<?php echo base_url(); ?>CtrlFabrication/modificationComposant" method="post">
        <p><input type="hidden" name="encienNom" value="<?php echo $formule->getNomMatierePremiers(); ?>" /></p>
        <p><input type="hidden" name="nomFormule" value="<?php echo $nomFormule; ?>" /></p>
        <p>Matière prémiers : 
            <select name="nouveauNom">
                <option value="<?php echo $formule->getNomMatierePremiers(); ?>"><?php echo $formule->getNomMatierePremiers(); ?></option>
            <?php foreach($tabNomMatieresPremiers as $nomMatieresPremiers) { ?>
                <option value="<?php echo $nomMatieresPremiers; ?>"><?php echo $nomMatieresPremiers; ?></option>
            <?php } ?>
            </select>
        </p>
        <p>Pourcentage : <input type="number" name="pourcentage" value="<?php echo $formule->getPourcentage(); ?>" /></p>
        <p><input type="submit" value="Modifier" /></p>
    </form>
</body>
</html>