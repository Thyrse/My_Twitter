<?php
require_once('config/config.php');
require_once('class/users.class.php');
require_once("Tweet.class.php");
if(isset($_GET['id']) && $_GET['id'] != NULL)
{
	$user = new Userinfo($_GET['id']);
}
else
{
	$user = new Userinfo($_SESSION['user']);
}
$c = new Tweet();
$t = new TweetModel();
if(isset($_POST["subTweet"]))
{
	$tweet = new TweetModel();
	$tweet->setAtt("content" ,$_POST["content"]);
	if(strlen($_POST["content"]) <= 140) $tweet->addTweet();
}
if(isset($_POST['search']))
{
	$sql = "SELECT username, nickname, avatar FROM users WHERE username LIKE :username OR nickname LIKE :nickname";
	$query = $bdd->prepare($sql);
	$searchString = "%" . $_POST['search'] . "%";
	$query->bindParam(':username', $searchString);
	$query->bindParam(':nickname', $searchString);
	$query->execute();
	$results = $query->fetchAll();
}
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
			<a href="accueil.php"><img class="left" alt="logo" href="#" src="images/bird.ico"/></a>
			<ul id="navaccueil">
				<li class="liaccueil"><a class="linkaccueil" href="accueil.php">ACCUEIL</a></li>
				<li class="liaccueil"><a class="linkaccueil" href="#">NOTIFICATIONS</a></li>
				<li class="liaccueil"><a class="linkaccueil" href="#">MESSAGES</a></li>
				<li class="liaccueil"><a class="linkaccueil" href="profil.php">PROFIL</a></li>
			</ul>
		</nav>
		<div class="deconnexion"><a class="linkaccueil" href="logout.php">SE DECONNECTER</a></div> <!-- Rendre le bouton déconnexion fonctionnel -->
		<div id="edit_profil" class="edition"><a href="param.php" class="linkaccueil">Editer le profil</a></div> <!-- Rendre le bouton fonctionnel, au choix de l'ajax ou redirection vers une page des paramètres du profil pour tout éditer autre part -->
		<div class="clear"></div>
	</header>
    <?php
    if($user->getCover() != '')
    {
        ?>
	   <div id="banniere_profil"><img alt="banniere" src="upload/<?php echo $user->getCover(); ?>"/></div>
        <?php
    }
    else
    {
        ?>
        <div id="banniere_profil"><img alt="banniere" src="images/banniere.png"/></div>
    <?php
    }
    ?>
	<div id="toolbar" class="clear">
		<nav>
			<ul id="navtoolbar">
				<li class="litoolbar"><a class="linktoolbar" href="#"><span>Tweets</span><span><?=count($user->getTweet())?></span></a></li> <!-- Ici, afficher les bons chiffres en les récupérant -->
				<li class="litoolbar"><a class="linktoolbar" href="#"><span>Abonnements</span><span><?=count($user->getFollower())?></span></a></li> <!-- Ici, afficher les bons chiffres en les récupérant -->
				<li class="litoolbar"><a class="linktoolbar" href="#"><span>Abonnés</span><span><?=count($user->getFollowing())?></span></a></li> <!-- Ici, afficher les bons chiffres en les récupérant -->
				<li class="litoolbar"><a class="linktoolbar" href="#"><span>Favoris</span><span>42</span></a></li> <!-- Ici, afficher les bons chiffres en les récupérant -->
			</ul>
		</nav>
	</div>
	<div class="all_profil">
		<div id="avatar_view">
			<?php
			if($user->getAvatar() != "")
			{
				?>
				<div class="avatar_img"><img class="av_atar" alt="avatar" src="upload/<?php echo $user->getAvatar(); ?>"/></div>
				<?php
			}
			else
			{
				?>
				<div class="avatar_img"><img alt="avatar" src="images/Yagura.jpg"/></div> <!-- Récupérer l'avatar de l'utilisateur -->
				<?php
			}
			?>
		</div>
	</div>
	<div id="container">
		<div id="aff_left" class="left">
			<div id="aff_profil" class="left">
				<a href="#"><?php echo $user->getNickname(); ?></a> <!-- Récupérer le pseudo de l'utilisateur -->
				<a id="link_pseudo" href="#">@<?php echo $user->getUsername(); ?></a> <!-- Récupérer le pseudo de l'utilisateur -->
				<p><?php echo $user->getBiography() ?></p> <!-- Récupérer la bio de l'utilisateur (limité à 140 caractères, je ferai la limite plus tard) -->
				<a id="link_web" href="<?php echo $user->getWebsite() ?>"><?php echo $user->getWebsite() ?></a> 
				<span><?php echo $user->GetCreation_date(); ?></span>
			</div>
			<?php
			require_once('left.php');
			?>
		</div>
		<?php
		require_once('middle.php');
		require_once('right.php');
		?>
	</div>
</body>
</html>