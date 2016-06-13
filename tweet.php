<?php
require_once('class/users.class.php');
require_once('config/config.php');
require_once("Tweet.class.php");
if(isset($_GET["subTweet"]))
{
    $tweet = new TweetModel();
    $tweet->setAtt("content" ,$_GET["content"]);
    if(strlen($_GET["content"]) <= 140)
    {    
        $tweet->addTweet();
        header('location: accueil.php');
    }
}
?>