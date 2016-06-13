<?php
require_once('config/config.php');
require_once('class/inscription.class.php');
?>
<html>
<head>
    <title>My twitter</title>
</head>
<body>
    <form action="#" method="post">
        <input type="text" name="username" placeholder="username"/>
        <input type="password" name="password" placeholder="password" />
        <input type="password" name="confirmpassword" placeholder="confirmpassword" />
        <input type="email" name="email" placeholder="email" />
        <input type="text" name="nom" placeholder="nom"/>
        <input type="text" name="prenom" placeholder="prenom" />
        <input type="submit" name="inscription" value="inscription" />
    </form>
    <?php
    if(isset($_POST['inscription']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm = $_POST['confirmpassword'];
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        
        $inscription = new inscription;
        $inscription->setUsername($username);
        $inscription->setEmail($email);
        $inscription->setPrenom($prenom);
        $inscription->setNom($nom);
        $inscription->setPassword($password);
        $inscription->setConfirmpass($confirm);
        $inscription->setToken();
        $inscription->register();
        echo $inscription->status;
    }
    ?>
</body>
</html>