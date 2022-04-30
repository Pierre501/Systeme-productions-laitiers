<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="<?php echo css_loader("bootstrap.min"); ?>" rel="stylesheet">
</head>
<body>
    <div class="container">   
        <div class="row">
            <div class="col-md-4"></div>
			<div class="col-md-4">
                <h1>Inscription</h1>
                <form action="<?php echo base_url(); ?>CtrlAccueil/inscription" method="post">
                    <p><label>Nom </label><input type="text" name="nom" class="form-control" /></p>
                    <p><label>Prénom </label><input type="text" name="prenom" class="form-control" /></p>
                    <p><label>Date de naissance </label><input type="date" name="naissance" class="form-control" /></p>
                    <p><label>Email </label><input type="email" name="username" class="form-control" /></p>
                    <p><label>Mot de passe </label><input type="password" name="mdp" class="form-control" /></p>
                    <p><input type="submit" value="Valider" class="btn btn-primary btn-block" /></p>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>