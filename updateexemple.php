<?php
session_start();
require_once('config/config.php');
require_once('class/users.class.php');
if(isset($_SESSION['user']) && $_SESSION['user'] != NULL)
{
    $user = new UserInfo($_SESSION['user']);
    $user->getUsername();
    $user->setUsername('exemple_username');
    $user->Update();
}
?>