<?php
require_once('config/config.php');
require_once("TweetModel.class.php");
require_once("Model.class.php");
class Tweet extends TweetModel{

	public function __construct(){}

	public function defaultAction()
	{		
		$tweet = new TweetModel();
		$tweet->setAtt("content", "hello world  @blackrose @jer #2espaces #yolo");
		$content = $tweet->getAtt("content");
		//var_dump($this->getAvatar(5));
	}

	public function parseTweet($content)
	{
		$words = explode(" ", $content);
		$str = $content;
		foreach ($words as $v) 
		{
			if(!empty($v))
			{
				if($v[0] == "#" && strlen($v) > 1)
				{
					$str = str_replace($v, '<a href="accueil.php?search='.$v.'" title="'.$v.'"> ' .$v. ' </a>', $str);
				}
				elseif($v[0] == "@" && strlen($v) > 1)
				{
					if ($this->userExists(substr($v, 1)) !== false)
					{
						$str = str_replace($v, '<a href="profil.php?id='.$this->userExists(substr($v, 1)).'" title="'.$v.'"> ' .$v. ' </a>', $str);
					}
				}
			}
		}
		return $str;
	}
}
$c = new Tweet();
$c->defaultAction();
?>