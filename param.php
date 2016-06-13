<?php
require_once('userinfo.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link href="images/bird.ico" rel="shortcut icon" />
	<title>Tweet_Academie</title>
</head>
<body id="bodyaccueil">
	<header id="headaccueil">
		<div id="opacity"></div>
		<nav>
			<a href="accueil.php"><img class="left" alt="logo" src="images/bird.ico"/></a>
			<ul id="navaccueil">
				<li class="liaccueil"><a class="linkaccueil" href="accueil.php">ACCUEIL</a></li>
				<li class="liaccueil"><a class="linkaccueil" href="#">NOTIFICATIONS</a></li>
				<li class="liaccueil"><a class="linkaccueil" href="#">MESSAGES</a></li>
				<li class="liaccueil"><a class="linkaccueil" href="profil.php">PROFIL</a></li>
			</ul>
		</nav>
		<div class="deconnexion"><a class="linkaccueil" href="logout.php">SE DECONNECTER</a></div>
		<div class="clear"></div>
	</header>
	<div id="container">
		<div id="aff_left" class="left">
			<div id="param_profil" class="left">
                <?php
                if($user->getCover() != '')
                {
                    ?>
                    <div id="param_banniere"><img alt="banniere" src="upload/<?php echo $user->getCover(); ?>"/></div>
                    <?php
                }
                else
                {
                    ?>
                    <div id="param_banniere"><img alt="banniere" src="images/banniere.png"/></div>
                    <?php
                }
				if($user->getAvatar() != "")
				{
					?>
					<div class="param_avatar"><img alt="avatar" src="upload/<?php echo $user->getAvatar(); ?>"/></div>
					<?php
				}
				else
				{
					?>
					<div class="param_avatar"><img alt="avatar" src="images/yagura.jpg"/></div>
					<?php
				}
				?>
				<a href="#"><?php echo $user->getNickname(); ?></a> <!-- Récupérer le pseudo de l'utilisateur -->
				<a id="link_pseudo" href="#">@<?php echo $user->getUsername(); ?></a> <!-- Récupérer le pseudo de l'utilisateur -->
			</div>
			<div id="param_options" class="left">
				<div id="aside_options">
					<ul>
						<li><a href="param.php">Compte</a></li>
						<li><a href="#">Notifications par mail</a></li>
						<li><a href="#">Comptes bloqués</a></li>
						<li><a href="?mode=disgn">Design</a></li>
					</ul>
				</div>
			</div>
		</div>
		<?php
		if(isset($_GET['mode']) && $_GET['mode'] == 'disgn')
		{
			?>
			<div id="mid_design" class="left">
				<div id="param_design">
					<h3>Design</h3>
					<p>Modifiez votre image de profil, votre bannière ou encore votre thème parmi ceux proposés, ou personnalisez le votre !</p>
				</div>
				<div id="design_choice">
					<form action="#" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000"> <!-- Definir la taille max d'un fichier -->
						<p><label for="avatar">Avatar :</label>
							<input class="file" id="avatar" type="file" name="avatar"/>
							<input type="hidden" name="MAX_FILE_SIZE" value="100000000"></p>
                        <input name="edition_design" type="submit" class="bouton" value="Enregistrer" onclick="return(confirm('Ces informations vous conviennent-elles ?'));" />
                    </form>
                    <form action="#" method="POST" enctype="multipart/form-data">
							<p><label for="cover">Arrière plan :</label></p>
							<input class="file" id="cover" type="file" name="cover"/>
                            <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
							<input type="text" name="backgroundcolor"/>
							<input name="cover_edit" type="submit" class="bouton" value="Enregistrer" onclick="return(confirm('Ces informations vous conviennent-elles ?'));" />
						</form>
						<?php
                        // bannière
						if(isset($_POST['cover_edit']))
						{
							$extension = array('jpg','jpeg','png','gif');
							if((!empty($_FILES["cover"])) && ($_FILES['cover']['error'] == 0))
							{
								$filename = basename($_FILES['cover']['name']);
								$checkbackdoor = explode(".", $filename);
								if(count($checkbackdoor) - 1 > 1)
								{
									echo "Problem dans le fichier";
								}
								else
								{
									$ext = substr($filename, strrpos($filename, '.') + 1);
									if (in_array($ext, $extension) && ($_FILES["cover"]["type"] == "image/jpeg") && ($_FILES["cover"]["size"] < 350000))
									{
										$newname = dirname(__FILE__).'/upload/'.$filename;
										if (!file_exists($newname))
										{
											if ((move_uploaded_file($_FILES['cover']['tmp_name'],$newname)))
											{
												$user->setCover($filename);
												$user->update();
												echo "Couverture bien modifier";
											}
											else
											{
												echo "Impossible d'upload le fichier .";
											}
										}
										else
										{
                              // existe deja
											$user->setCover($filename);
											$user->update();
											echo "Photo de couv bien modifié";
										}
									}
									else
									{
										echo "Fichier pas au bon format";
									}
								}
							}
							else
							{
								echo "Error: No file uploaded";
							}
						}
            
                        // profil
						if(isset($_POST['edition_design']))
						{
							$extension = array('jpg','jpeg','png','gif');
							if((!empty($_FILES["avatar"])) && ($_FILES['avatar']['error'] == 0))
							{
								$filename = basename($_FILES['avatar']['name']);
								$checkbackdoor = explode(".", $filename);
								if(count($checkbackdoor) - 1 > 1)
								{
									echo "Problem dans le fichier";
								}
								else
								{
									$ext = substr($filename, strrpos($filename, '.') + 1);
									if (in_array($ext, $extension) && ($_FILES["avatar"]["type"] == "image/jpeg") && ($_FILES["avatar"]["size"] < 350000))
									{
										$newname = dirname(__FILE__).'/upload/'.$filename;
										if (!file_exists($newname))
										{
											if ((move_uploaded_file($_FILES['avatar']['tmp_name'],$newname)))
											{
												$user->setAvatar($filename);
												$user->update();
												echo "Photo de profil bien modifié";
											}
											else
											{
												echo "Impossible d'upload le fichier .";
											}
										}
										else
										{
                              // existe deja
											$user->setAvatar($filename);
											$user->update();
											echo "Photo de profil bien modifié";
										}
									}
									else
									{
										echo "Fichier pas au bon format";
									}
								}
							}
							else
							{
								echo "Error: No file uploaded";
							}
						}
						?>
					</div>
					<div id="param_perso" class="clear">
						<h3>Personnaliser votre thème</h3>
						<p>Envie d'un thème personnalisé ? Choisissez vos propres codes couleurs et faites vous votre propre profil unique !</p>
					</div>
					<div id="design_perso">
						<form action="#" method="POST" enctype="multipart/form-data">
							<p><span>Rajouter le choix de thèmes préconçus quand possibilité.</span></p>
							<p><span>Rajouter le choix de thèmes préconçus quand possibilité.</span></p>
							<input name="design_perso" type="submit" class="bouton" value="Enregistrer" onclick="return(confirm('Ces informations vous conviennent-elles ?'));" />
						</form>
					</div>
				</div>




				<?php
			}
			else
			{
				?>
				<div id="mid_param" class="left">
					<div id="param_account">
						<h3>Compte</h3>
						<p>Changez les informations de base de votre compte, ou rajoutez en en plus de celles déjà enregistrées.</p>
					</div>
					<div id="infos_account">
						<form action="#" method="POST" enctype="multipart/form-data">
							<p><label for="username">Nom d'utilisateur :</label>
								<input type="text" id="username" maxlength="30" name="username" placeholder="Ex: julien988" /></p>
								<p><label for="nickname">Nom complet :</label>
									<input type="text" id="nickname" maxlength="30" name="nickname" placeholder="Ex: Julien Klein" /></p>
									<p><label for="phone">Téléphone :</label>
										<input type="tel" id="phone" name="phone" maxlength="10" placeholder="06/07..." /></p>
										<p><label for="email">Email :</label>
											<input type="email" id="email" name="email" maxlength="30" placeholder="prenom.nom@epitech.eu" /></p>
											<p><label for="website">Site web :</label>
												<input type="text" id="website" name="website" maxlength="30" placeholder="https://campus.samsung.fr/" /></p>
												<p><label for="biography">Bio (max : 140) :</label>
													<textarea name="biography" id="biography" maxlength="140" placeholder="Etudiant Samsung Campus, membre de l'association pour la défense des poneys..."></textarea></p>
													<input name="edition_account" type="submit" class="bouton" value="Enregistrer" onclick="return(confirm('Ces informations vous conviennent-elles ?'));" />
												</form>
											</div>
											<div id="param_mdp" class="clear">
												<h3>Mot de passe</h3>
												<p>Modifiez votre mot de passe si vous le souhaitez. Nous vous conseillons de le renouveler tous les 3mois environ, pour plus de sécurité.</p>
											</div>
											<div id="infos_mdp">
												<form action="action.php" method="POST" enctype="multipart/form-data">
													<p><label for="password">Mot de passe actuel :</label>
														<input id="password" type="password" name="password" maxlength="32"></p>
														<p><label for="newpassword">Nouveau mot de passe :</label>
															<input id="newpassword" type="password" name="newpassword" maxlength="32"></p>
															<p><label for="newpassword2">Confirmer nouveau mot de passe :</label>
																<input id="newpassword2" type="password" name="newpassword2" maxlength="32"></p>
																<input name="edition_account" type="submit" class="bouton" value="Enregistrer" onclick="return(confirm('Vous êtes sur le point de changer votre mot de passe, veuillez confirmer.'));">
															</form>
														</div>
														<div class="clear">
															<input name="edition_account" type="submit" class="bouton" value="Enregistrer tout" onclick="return(confirm('Tout enregistrer ?'));"></div>
														</div>
														<?php
													}
													require_once('right.php');
													?>
												</div>
											</body>
											</html>