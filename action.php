<?php
require_once('config/config.php');
require_once('class/inscription.class.php');
require_once('class/connexion.class.php');

if(isset($_POST['create_profile']))
{
    $username = $_POST['username'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $confirm = $_POST['password2'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $inscription = new Inscription;
    $inscription->setUsername($username);
    $inscription->setEmail($email);
    $inscription->setPhone($phone);
    $inscription->setNickname($nickname);
    $inscription->setPassword($password);
    $inscription->setConfirmpass($confirm);
    $inscription->setToken();
    $inscription->register();
    if($inscription->status == "ok")
        header('location: index.php');
    else
        echo $inscription->status;
}

elseif(isset($_POST['connexion']))
{
    $connexion = new Connexion;
    if($_POST['username'] != NULL && $_POST['password'] != NULL)
    {
        $connexion->setUsername($_POST['username']);
        $connexion->setPassword($_POST['password']);
        $connexion->connect();
        if($connexion->status == "ok")
            header('location: accueil.php');
        else
            echo $connexion->status;
    }
}
?>