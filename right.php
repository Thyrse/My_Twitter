			<div id="aff_right" class="left">
				<div id="follow_someone" class="left">
					<p>Connaissez vous...</p>
					<?php
					$req = "SELECT id_user, nickname, avatar FROM users ORDER BY RAND() LIMIT 4";
					$answer = $bdd->prepare($req);
					$answer->execute();
					$exit = $answer->fetchAll();
					foreach ($exit as $user) { ?>
					<div class="clear"><a href="profil.php?id=<?php echo $user['id_user']; ?>">@<?php echo $user['nickname']; ?></a><img class="rand_follow left" alt="avatar" src="upload/<?php  if($user['avatar']){ echo $user['avatar'];} else{ echo "base.png";} ?>"/></div>
					<?php
				}
				?>
			</div>
			<div id="infos_divers" class="left">
				<p>
					Connectez-vous à vos amis, camarades de promotion et d'autres personnes. Tenez vous informé de l'actualité en temps réel pour tout ce qui vous intéresse
				</p>
				<span>Tweet Academie Samsung Campus - © Jérome Crete, Terry Fourgeux, Tristan Granier 2016</span>
			</div>
		</div>