<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] != NULL)
    header('location: profil.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link href="images/bird.ico" rel="shortcut icon" />
	<title>Tweet_Academie</title>
</head>
<body id="bodyindex">
	<header id="headindex">
		<img alt="logo twitter" src="images/bird.ico"/>
		<span id="gradientheader">Bienvenue sur Tweet Academie !</span>
		<img alt="logo webac" src="images/webac.png"/>
	</header>
	<div id ="all">
		<div id="newmember">
			<span class="connect">Pas encore membre ?</span>
			<span class="connect">Inscrivez-vous !</span>
			<form action="action.php" method="POST" enctype="multipart/form-data">
				<p><label for="lastname" class="ombre">Nom d'utilisateur :</label></p>
				<input type="text" id="lastname" maxlength="30" name="username" class="box_shadow" placeholder="Ex: julien988">
				<p><label for="nickname" class="ombre">Nom complet :</label></p>
				<input type="text" id="nickname" maxlength="30" name="nickname" class="box_shadow" placeholder="Ex: Julien Klein">
				<p><label for="email" class="ombre">Email :</label></p>
				<input type="email" id="email" name="email" maxlength="30" class="box_shadow" placeholder="prenom.nom@epitech.eu">
				<p><label for="phone" class="ombre">Téléphone :</label></p>
				<input type="tel" id="phone" name="phone" maxlength="10" class="box_shadow" placeholder="06/07...">
				<p><label for="password" class="ombre">Mot de passe :</label></p>
				<input type="password" id="password" name="password" class="box_shadow" maxlength="32">
				<p><label for="password2" class="ombre">Confirmer mot de passe :</label></p>
				<input type="password" id="password2" name="password2" class="box_shadow" maxlength="32">
				<input name="create_profile" type="submit" class="bouton" value="S'inscrire" onclick="return(confirm('Etes-vous sûr de vouloir creer votre compte avec ces informations ?'));">
			</form>
		</div>
		<div id="middledesc">
			<p id="descmid">Connectez-vous à vos amis, camarades de promotion et d'autres personnes. Tenez vous informé de l'actualité en temps réel pour tout ce qui vous intéresse</p>
		</div>
		<div id="alreadymember">
			<span class="connect">Déjà inscrit ?</span>
			<form action="action.php" method="POST">
				<label for="email" class="deco">Email:</label>
				<input type="text" name="username" placeholder="prenom.nom@epitech.eu"/>
				<label for="password" class="deco">Mot de passe:</label>
				<input type="password" name="password"/>
				<div class="space"><button name="connexion" type="submit" id="connexion">Se connecter</button></div>
			</form>
		</div>
	</div>
	<footer>Tweet Academie Samsung Campus -  © Jérome Crete, Terry Fourgeux, Tristan Granier 2016</footer>
</body>
</html>