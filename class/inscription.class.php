<?php
class Inscription
{
    private $username;
    private $email;
    private $nickname;
    private $password;
    private $confirmation_password;
    private $token;
    private $phone;
    public $status;
    
    
    function setUsername($username)
    {
        if($username != "")
            $this->username = $username;
    }
    
    function setEmail($email)
    {
        if($email != "")
            $this->email = $email;
    }
    function setPhone($phone)
    {
        if($phone != "")
        {
            $this->phone = $phone;
        }
    }
    function setNickname($nick)
    {
        if($nick != "")
            $this->nickname = $nick;
    }
    
    function setPassword($password)
    {
        if($password != "")
            $this->password = $password;
    }
    
    function setConfirmpass($confirm)
    {
        if($confirm != "")
            $this->confirmation_password = $confirm;
    }
    
    function setToken()
    {
        $token = rand('9999999','999999999999999');
        $this->token = $token;
    }
    
    function register()
    {
        global $bdd;
        if($this->username != NULL && $this->email != NULL && $this->phone != NULL && $this->nickname != NULL && $this->password != NULL && $this->confirmation_password != NULL && $this->token != NULL)
        {
            if($this->password == $this->confirmation_password)
            {
                $select_users = $bdd->prepare("SELECT username,email FROM users WHERE username = :username OR email = :email");
                $select_users->bindParam(':username', $this->username);
                $select_users->bindParam(':email', $this->email);
                $select_users->execute();
                
                $result = $select_users->fetch();
                if($result['username'] == NULL)
                {
                    $data = date("y-m-d");
                    $password = hash('ripemd160', 'si tu aimes la wac tape dans tes mains'. $this->password);
                    $insert = $bdd->prepare("INSERT INTO users(username,nickname,password,phone,email,registration_token,creation_date) VALUES(:username, :nickname, :password, :phone, :email, :token,:creation_date)");
                    $insert->bindParam(':username', $this->username);
                    $insert->bindParam(':nickname', $this->nickname);
                    $insert->bindParam(':password', $password);
                    $insert->bindParam(':phone', $this->phone);
                    $insert->bindParam(':email', $this->email);
                    $insert->bindParam(':token', $this->token);
                    $insert->bindParam(':creation_date', $data);
                    $insert->execute();
                    
                    $this->status = "ok";
                }
                else
                    $this->status = "Utilisateur déjà existant .";
            }
            else
                $this->status = "Les mots de passe ne correspondent pas !";
        }
    }
}