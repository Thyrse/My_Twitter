			<div id="param_profil" class="left">
                <?php
                if($user->getCover() != '')
                {
                    ?>
				    <div id="param_banniere"><img alt="banniere" src="upload/<?php echo $user->getCover(); ?>"/></div>
                    <?php
                }
                else
                {
                    ?>
                    <div id="param_banniere"><img alt="banniere" src="images/banniere.png"/></div>
                    <?php
                }
                ?>
				<div class="param_avatar">
                <?php
				if($user->getAvatar() != "")
				{
					?>
					<div class="avatar_img"><img class="av_atar" alt="avatar" src="upload/<?php echo $user->getAvatar(); ?>"/></div>
					<?php
				}
				else
				{
					?>
					<div class="avatar_img"><img alt="avatar" src="images/void.png"/></div> <!-- Récupérer l'avatar de l'utilisateur -->
					<?php
				}
				?></div>
				<a href="#"><?php echo $user->getNickname(); ?></a> <!-- Récupérer le pseudo de l'utilisateur -->
				<a id="link_pseudo" href="#">@<?php echo $user->getUsername(); ?></a> <!-- Récupérer le pseudo de l'utilisateur -->
			</div>