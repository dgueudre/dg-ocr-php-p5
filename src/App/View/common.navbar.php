<ul>
	<li><a href="/">Acceuil</a></li>
	<?php if($user): ?>
	<li><a href="/logout">Se déconnecter</a></li>
	<li><a href="/posts/create">Créer un post</a></li>
	<?php else: ?>
	<li><a href="/login">Se connecter</a></li>
	<?php endif; ?>
</ul>