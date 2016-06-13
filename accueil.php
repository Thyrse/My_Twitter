<?php
require_once('class/users.class.php');
require_once('config/config.php');
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
if(isset($_POST['search']))
{
	$sql = "SELECT username, nickname, avatar, cover FROM users WHERE username LIKE :username OR nickname LIKE :nickname";
	$query = $bdd->prepare($sql);
	$searchString = "%" . $_POST['search'] . "%";
	$query->bindParam(':username', $searchString);
	$query->bindParam(':nickname', $searchString);
	$query->execute();
	$results = $query->fetchAll();
}
//if(isset($_POST["subTweet"]))
//{
//	$tweet = new TweetModel();
//	$tweet->setAtt("content" ,$_POST["content"]);
//	if(strlen($_POST["content"]) <= 140) $tweet->addTweet();
//}	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link href="bird.ico" rel="shortcut icon" />
	<title>Tweet_Academie</title>
	<script type="text/javascript" src="grid.js"></script>
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
			<?php
			require_once('aside_profil.php');
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