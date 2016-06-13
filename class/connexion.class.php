<?php
class Connexion
{
    private $username;
    private $password;
    public $status;
    
    function setUsername($username)
    {
        $this->username = $username;
    }
    
    function setPassword($password)
    {
        $this->password = $password;
    }
    
    function connect()
    {
        global $bdd;
        
        if($this->username != NULL && $this->password != NULL)
        {
            $password = hash('ripemd160', 'si tu aimes la wac tape dans tes mains'. $this->password);
            $select = $bdd->prepare("SELECT id_user,username FROM users WHERE username = :username AND password = :password OR email = :username AND password = :password");
            $select->bindParam(':username', $this->username);
            $select->bindParam(':password', $password);
            $select->execute();
            
            $result = $select->fetch();
            if($result['username'] != NULL)
            {
                $_SESSION['user'] = $result['id_user'];
                $this->status = "ok";
            }
            else
                $this->status = "Utilisateur inconnus";
        }
        else
            $this->status = "Des champs sont vide .";
    }
}