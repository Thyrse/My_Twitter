<?php
require_once("Model.class.php");
class TweetModel extends Model {

	private $id=NULL;
	private $id_user;
	private $content;
	private $creation_date;
	private $media="";
	private $deleted=0;
	private $id_origin="";
	private $is_reply=0;
	private $location="";

	public function __construct($id = null) {
		parent::__construct();
		if(null !== $id) {
			$result = self::qry("SELECT * FROM tweets where id_tweet = :id"
				, ['id' => $id]);
			if(count($result) > 0) {
				$this->id = $result[0]->id_tweet;
				$this->id_user = $result[0]->id_user;
				$this->content = $result[0]->content;
				$this->creation_date = $result[0]->creation_date;
				$this->media = $result[0]->media;
				$this->deleted = $result[0]->deleted;
				$this->id_origin = $result[0]->id_origin;
				$this->is_reply = $result[0]->is_reply;
				$this->location = $result[0]->location;
			}
		}
		else if(isset($_POST["submitTweet"])) {
			$this->content = htmlentities($_POST["content"]);
			$this->creation_date = date("Y-m-d H:i:s");
			$this->id_user = $_SESSION["id"];
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getAtt($name) {
		return $this->$name;
	}

	public function setAtt($name, $value) {
		$this->$name = $value;
	}

	public function addTweet()
	{
		$b = self::$pdo->prepare("INSERT INTO tweets VALUES ('', :id_user, :content, NOW(), :media, :deleted, :id_origin, :is_reply, :location)");
		$b->execute(["id_user" => $_SESSION['user'], "content" => $this->content, "media" => $this->media, "deleted" => $this->deleted, "id_origin" => $this->id_origin, "is_reply" => $this->is_reply, "location" => $this->location]);
		$this->setAtt("id", self::$pdo->lastInsertId());
		$this->addHashtag();
	}

	public function addHashtag()
	{
		$hashtags = [];
		preg_match_all('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', $this->content, $matches, PREG_OFFSET_CAPTURE);
		for($i=0;$i<count($matches[0]);$i++)
			$hashtags[] = trim(str_replace("#","",$matches[0][$i][0]));

		foreach ($hashtags as $value) 
		{
			$r = self::qry("SELECT id_tag FROM tags where tag = :value"
				, ['value' => $value]);
			if(count($r) > 0) {
				$a = self::$pdo->prepare("INSERT INTO hashtags VALUES (:id, :id_tag)");
				$a->execute(["id" => $this->id, "id_tag" => $r[0]->id_tag]);	
			}
			else 
			{
				$a = self::$pdo->prepare("INSERT INTO tags VALUES ('', :tag)");
				$a->execute(["tag" => $value]);
				$id = self::$pdo->lastInsertId();
				//var_dump($id);
				$b = self::$pdo->prepare("INSERT INTO hashtags VALUES (:id, :id_tag)");
				$b->execute(["id" => $this->id, "id_tag" => $id]);
			}
		}
	}

	public function getProfilTimeline($id=NULL)
	{
		if(isset($_GET["id"])) $id = intval($_GET["id"]);
		else $id = $_SESSION["user"];
		$a = self::qry("SELECT * FROM tweets JOIN users ON tweets.id_user = users.id_user WHERE users.id_user = :id ORDER BY tweets.creation_date DESC"
				, ['id' =>  $id]);
		return $a;
	}

	public function userExists($username)
	{
		$a = self::qry("SELECT id_user from users where username = :username"
				, ['username' => $username]);
		if(!empty($a)) return $a[0]->id_user;
		return false;
	}

	public function getTimeLine()
	{
		$a = self::qry('SELECT * FROM (SELECT tweets.id_tweet,tweets.content,tweets.creation_date,tweets.media,users.username,users.nickname,tweets.location,users.id_user 
			FROM tweets INNER JOIN users ON tweets.id_user = users.id_user 
			WHERE users.id_user = :id_user UNION 
			SELECT tweets.id_tweet,tweets.content,tweets.creation_date,tweets.media,users.username,users.nickname,tweets.location,users.id_user 
			FROM tweets INNER JOIN users 
			ON tweets.id_user = users.id_user 
			INNER JOIN followers ON users.id_user = followers.id_user 
			WHERE followers.id_follower = :id_user
			) as t ORDER BY creation_date DESC'
				, ['id_user' => $_SESSION['user']]);
		return $a;
	}

	public function trending()
	{
		$a = self::qry("SELECT tag from hashtags 
			join tags on tags.id_tag = hashtags.id_tag  
			group by hashtags.id_tag order by count(*) desc"
				, []);
		return $a;
	}

	public function getAvatar($id=NULL)
	{
		if(is_null($id))
		{	
		if(isset($_GET["id"])) $id = intval($_GET["id"]);
		else $id = $_SESSION["user"];
		}
		$a = self::qry("SELECT avatar from users where id_user = :id_user"
				, ["id_user" => $id])[0];
		return $a;
	}

}
?>