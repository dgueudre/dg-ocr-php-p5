<!-- 
Thanks Erik Terwan for inspiration
https://erikterwan.com
-->

<?php $user_label = $user ? sprintf('%s %s', $user->firstname, $user->lastname) : 'Déconnecté'; ?>

<nav role="navigation">
	<img src="/img/logo-davdev.png" alt="logo davdev">
	<input type="checkbox" />
	<i class="fa-solid fa-bars burger"></i>
	<i class="fa-solid fa-xmark cross"></i>
	<div class="nav-container">
		<ul>
			<li class="user-info">Blog</li>
			<li><a href="/">Acceuil</a></li>
			<li><a href="/posts">Posts</a></li>
			<hr />
			<li class="user-info"><i class="fa-solid fa-user"></i> <span><?=$user_label; ?></span></li>
			<?php if($user): ?>
			<li><a href="/posts/create">Créer un post</a></li>
			<li><a href="/comments/tovalidate">Commentaires à valider</a></li>
			<li><a href="/logout">Se déconnecter</a></li>
			<?php else: ?>
			<li><a href="/login">Se connecter</a></li>
			<?php endif; ?>
		</ul>
	</div>
</nav>