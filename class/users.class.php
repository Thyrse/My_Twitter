<?php
class Userinfo
{
    private $id_user;
    private $username;
    private $nickname;
    private $email;
    private $avatar;
    private $phone;
    private $cover;
    private $website;
    private $birhday;
    private $privates;
    private $location;
    private $activate;
    private $biographie;
    private $date_creation;
    private $password;
    
    public function __construct($username)
    {
        global $bdd;
        $select_info = $bdd->prepare("SELECT * FROM users WHERE id_user = :username");
        $select_info->bindParam(':username', $username);
        $select_info->execute();
        
        $result = $select_info->fetch();
        if($result['username'] != NULL)
        {
            $this->id_user = $username;
            $this->username = $result['username'];
            $this->nickname = $result['nickname'];
            $this->password = $result['password'];
            $this->email = $result['email'];
            $this->avatar = $result['avatar'];
            $this->phone = $result['phone'];
            $this->cover = $result['cover'];
            $this->website = $result['website'];
            $this->birhday = $result['birthdate'];
            $this->privates = $result['private'];
            $this->location = $result['location'];
            $this->activate = $result['activated'];
            $this->biographie = $result['biography'];
            $this->date_creation = $result['creation_date'];
        }
    }
    
    function getUsername()
    {
        return $this->username;
    }
    
    function getNickname()
    {
        return $this->nickname;
    }
    
    function getEmail()
    {
        return $this->email;
    }
    
    function getAvatar()
    {
        return $this->avatar;
    }
    
    function getPhone()
    {
        return $this->phone;
    }
    
    function getCover()
    {
        return $this->cover;
    }
    
    function getWebsite()
    {
        return $this->website;
    }
    
    function getBirthdate()
    {
        return $this->$birhday;
    }
    
    function getPrivate()
    {
        return $this->privates;
    }
    
    function getActivate()
    {
        return $this->activate;
    }
    
    function getBiography()
    {
        return $this->biographie;
    }
    
    function GetCreation_date()
    {
        return $this->date_creation;
    }
    
    function setUsername($username)
    {
        $this->username = $username;
    }
    
    function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }
    
    function setEmail($email)
    {
        $this->email = $email;
    }
    
    function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }
    
    function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    function setCover($cover)
    {
        $this->cover = $cover;
    }
    
    function setWebsite($website)
    {
        $this->website = $website;
    }
    
    function setNaissance($naissance)
    {
        $this->naissance = $naissance;
    }
    
    function setPrivate($private)
    {
        $this->privates = $private;
    }
    
    function setLocation($location)
    {
        $this->location = $location;
    }
    
    function setActivated($active)
    {
        $this->activate = $active;
    }
    
    function setBiographie($biographie)
    {
        $this->biographie = $biographie;
    }
    
    function setCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }
    
    function Update()
    {
        global $bdd;
        
        $update = $bdd->prepare("UPDATE users SET username = :username, nickname = :nickname, password = :password, avatar = :avatar, email = :email, cover = :cover, phone = :phone, website = :website, birthdate = :birthdate, private = :private, location = :location, biography = :biographie WHERE id_user = :id_user");
        
        $update->bindParam(':username', $this->username);
        $update->bindParam(':nickname', $this->nickname);
        $update->bindParam(':password', $this->password);
        $update->bindParam(':avatar', $this->avatar);
        $update->bindParam(':email', $this->email);
        $update->bindParam(':cover', $this->cover);
        $update->bindParam(':phone', $this->phone);
        $update->bindParam(':website', $this->website);
        $update->bindParam(':birthdate', $this->birhday);
        $update->bindParam(':private', $this->privates);
        $update->bindParam(':location', $this->location);
        $update->bindParam(':biographie', $this->biographie);
        $update->bindParam(':id_user', $this->id_user);
        $update->execute();
        
    }

    function getFollower()
    {
        global $bdd;
        $a = $bdd->prepare("SELECT  users.id_user, username, nickname, avatar from users left join followers 
            on users.id_user = followers.id_follower  where followers.id_user = :id");
        $a->execute(["id" => $this->id_user]);
        $a = $a->fetchAll(PDO::FETCH_OBJ);
        return $a;
    }

    function getFollowing()
    {
        global $bdd;
        $a = $bdd->prepare("SELECT users.id_user, username, nickname, avatar  from users left join followers 
            on users.id_user = followers.id_user  where followers.id_follower  = :id");
        $a->execute(["id" => $this->id_user]);
         $a = $a->fetchAll(PDO::FETCH_OBJ);
        return $a;
    }

    function getTweet()
    {
        global $bdd;
        $a = $bdd->prepare("SELECT * from tweets where id_user = :id");
        $a->execute(["id" => $this->id_user]);
         $a = $a->fetchAll(PDO::FETCH_OBJ);
        return $a;
    }
}
?>