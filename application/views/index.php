<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="<?php echo css_loader("bootstrap.min"); ?>" rel="stylesheet">
</head>
<body>
	<div class="container">   
        <div class="row">
            <div class="col-md-4"></div>
			<div class="col-md-4">
				<h1>Login Utilisateur</h1>
				<?php if(isset($message)) { echo $message; } ?>
				<form action="<?php echo base_url(); ?>CtrlAccueil/verifierLogin" method="post">
					<p><label>Email </label><input type="email" name="username" class="form-control" /></p>
					<p><label>Mot de passe </label><input type="password" name="mdp" class="form-control" /></p>
					<p><input type="submit" value="Connexion" class="btn btn-primary btn-block"/></p>
				</form>
				<p><a href="<?php echo base_url(); ?>CtrlAccueil/pageInscription" class="btn btn-success btn-block">Inscription</a></p>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</body>
</html>