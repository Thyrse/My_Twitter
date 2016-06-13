<?php
require_once('config/config.php');
if(isset($_POST['search']))
{
	$sql = "SELECT username, nickname FROM users WHERE username = :username";
	$query = $bdd->prepare($sql);
	$query->bindParam(':username', $_POST['search']);
	$query->execute();
	$result = $query->fetch();
	if($result)
	{
		echo $result['username'];
	}
		$result = header('Location: accueil.php');
}