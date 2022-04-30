<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
</head>
<body>
    <h1>Gestion des formule</h1>
    <form action="<?php echo base_url(); ?>CtrlFabrication/detailsFormule" method="post">
        <p>Formule : 
            <select name="formule">
                <option>Choix formule</option>
            <?php foreach($tabFormule as $formule) { ?>
                <option value="<?php echo $formule->getNomFormule(); ?>"><?php echo $formule->getNomFormule(); ?></option>
            <?php } ?>
            </select>
        </p>
        <p><input type="submit" value="Afficher" /></p>
    </form>
    <?php if(isset($tabMatieresPremiers)) { ?>
        <h2>Détails <?php echo $nomFormule; ?></h2>
        <table border="1">
            <tr>
                <th>Matière prémiers</th>
                <th>Pourcentage</th>
                <th colspan="2">Options</th>
            </tr>
        <?php foreach($tabMatieresPremiers as $matieresPremiers) { ?>
            <tr>
                <td><?php echo $matieresPremiers->getNomMatierePremiers(); ?></td>
                <td><?php echo $matieresPremiers->getPourcentage(); ?></td>
                <td><a href="<?php echo base_url(); ?>CtrlFabrication/pageModifiantFormule?id=<?php echo $matieresPremiers->getIdMatierePremiers(); ?>&formule=<?php echo $nomFormule; ?>&nomMatieres=<?php echo $matieresPremiers->getNomMatierePremiers(); ?>">Modifier</a></td>
                <td><a href="<?php echo base_url(); ?>CtrlFabrication/suppressionComposant?id=<?php echo $matieresPremiers->getIdMatierePremiers(); ?>&formule=<?php echo $nomFormule; ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
        </table>
        <h2>Ajouter un composant dans la <?php echo $nomFormule; ?></h2>
        <table border="1">
            <tr>
                <th>Matière prémiers</th>
                <th>Pourcentage</th>
                <th>Options</th>
            </tr>
            <form action="<?php echo base_url(); ?>CtrlFabrication/insertionDetailsFormule" method="post">
                <p><input type="hidden" name="formule" value="<?php echo $nomFormule; ?>" /></p>
                <tr>
                    <td>
                        <select name="matiere">
                            <?php foreach($tabNomMatierePremiers as $nomMatierePremiers) { ?>
                                <option value="<?php echo $nomMatierePremiers->getIdMatierePremiers(); ?>"><?php echo $nomMatierePremiers->getNomMatierePremiers(); ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><input type="number" name="pourcentage" /></td>
                    <td><input type="submit" value="Ajouter" /></td>
                </tr>
            </form>
        </table>
    <?php } ?>
    <p><a href="<?php echo base_url(); ?>CtrlUtilisateur/pageRetour">Retour</a></p>
    <p><a href="<?php echo base_url(); ?>CtrlFabrication/pageAjoutantFormule">Ajouter formule</a></p>
</body>
</html>