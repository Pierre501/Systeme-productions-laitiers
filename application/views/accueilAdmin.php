<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil admin</title>
    <link href="<?php echo css_loader("bootstrap.min"); ?>" rel="stylesheet">
</head>
<body>
<div class="container">   
        <div class="row">
            <div class="col-md-1"></div>
			<div class="col-md-10">
                <h1>Accueil Administrateur</h1>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Nom et Prénom</th>
                        <th>Email</th>
                        <th>Options</th>
                    </tr>
                <?php foreach($tabUtilisateur as $utilisateur) { ?>
                <form action="<?php echo base_url(); ?>CtrlAdministrateur/envoyerMail" method="post">
                    <tr>
                        <p><input type="hidden" name="id" value="<?php echo $utilisateur->getIdUtilisateur(); ?>" /></p>
                        <td><?php echo $utilisateur->getNomUtilisateur(); ?> <?php echo $utilisateur->getPrenomUtilisateur(); ?></td>
                        <td><?php echo $utilisateur->getUserNameUtilisateur(); ?></td>
                        <td><input type="submit" value="Valider" class="btn btn-primary btn-block" /></td>
                    </tr>
                </form>
                <?php } ?>
                </table>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</body>
</html>