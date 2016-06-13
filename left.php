			<div id="search_something" class="left">
				<form action="#" method="POST" enctype="multipart/form-data">
					<label id="search_form">Recherche</label>
					<input id="search_input" type="text" name="search" placeholder="Rechercher...">
				</form>
				<div class="twitter left"><a class="linkfor_tweet" href="?tweet=1">Twitter</a></div>
<!--				<form action="#" method="GET" enctype="multipart/form-data">
                    <input type="hidden" name="tweet" value="1" />
					<textarea class="create_tweet" maxlength="140" name="content" placeholder="Votre tweet..."></textarea>
					<input type="submit" class="bouton" name="subTweet" value="Envoyer">
				</form>-->
			</div>
			<div id="aff_tendances" class="left">
				<p>Tendances · <a href="#">Modifier</a></p>
				<ul>
					<?php	foreach($t->trending() as $v)
					echo "<li><a href='accueil.php?search=#".$v->tag."'>#$v->tag</a></li>";
					?>	
				</ul>

			</div>