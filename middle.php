		<div id="mid_accueil" class="left">
			<?php
			if(isset($_POST['search']) && !empty($_POST['search']))
            {

				?> <div id="search_margin"> <?php
				foreach ($results as $user)
				{
					?>
					<div id="search_profil">
						<div id="search_banniere"><img alt="banniere" src="<?php if($user['cover'])
                        {
                            echo 'upload/'.$user['cover'];
                        }
                        else
                        {
                            echo 'images/banniere.png';
                        } ?>"/></div>
						<div id="search_avatar">
							<div id="avatar_img"><img alt="avatar" src="upload/<?php  if($user['avatar']){ echo $user['avatar'];} else{ echo "void.png";} ?>"/></div> <!-- Récupérer l'avatar de l'utilisateur -->
							<?php
							?></div>
							<a href="#"><?php echo $user['username']; ?></a> <!-- Récupérer le pseudo de l'utilisateur -->
							<a id="link_pseudo" href="#">@<?php echo $user['nickname']; ?></a> <!-- Récupérer le pseudo de l'utilisateur -->
						</div>
						<?php
					} ?>
				</div>
				<?php
			}
            elseif(isset($_GET['tweet']) && $_GET['tweet'] == "1")
            {
                ?>
                    <form action="tweet.php" method="GET" enctype="multipart/form-data">
                       <input type="hidden" name="tweet" value="1" />
					   <textarea class="create_tweet" maxlength="140" name="content" placeholder="Votre tweet..."></textarea>
					   <input type="submit" class="bouton" name="subTweet" value="Envoyer">
				    </form>
                <?php
            }
            else {
				?>
				<?php foreach($c->getTimeLine() as $v) { ?>
				<div class="tweet">
					<img class="avatar_tweet left" alt="avatar" src="upload/<?= $c->getAvatar($v->id_user)->avatar ?>" />
					<span class="left">
						<a href="#"><?=$v->nickname ?></a>
						<a href="#">@<?=$v->username ?></a>
					</span>
					<p class="hashtag_link"><?=$c->parseTweet($v->content) ?></p>
					<div class="clear"></div>
				</div>
				<?php } 
			}
			?>
		</div>