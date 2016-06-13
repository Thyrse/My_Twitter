<?php
require_once('config/config.php');
require_once('class/users.class.php');
if(isset($_SESSION['user']) && $_SESSION['user'] != NULL)
{
	$user = new UserInfo($_SESSION['user']);
	if(isset($_POST['edition_account']) && $_POST['edition_account'] != NULL)
	{
		$username = $_POST['username'];
		$nickname = $_POST['nickname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$biography = $_POST['biography'];
		$website = $_POST['website'];
		$avatar = $_FILES['avatar']['name'];
		$user->setUsername($username);
		$user->setNickname($nickname);
		$user->setPhone($phone);
		$user->setEmail($email);
		$user->setBiographie($biography);
		$user->setWebsite($website);
		$user->setAvatar($avatar);
		$user->Update();
	}
}