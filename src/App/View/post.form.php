<?php ob_start(); ?>
<h2><?= $post->title ?? 'Nouveau post'; ?></h2>
<?php $url = 'create' === $mode ? '/posts/create' : strtr('/posts/{id}/edit', ['{id}' => $post->id]); ?>
<form action="<?= $url; ?>" method="POST">
	<label for="title">Titre</label><br>
	<input type="text" id="title" name="title" value="<?= $form->title; ?>"><br>
	<label for="intro">Introduction</label><br>
	<input type="text" id="intro" name="intro" value="<?= $form->intro; ?>"><br>
	<label for="content">Contenu</label><br>
	<input type="text" id="content" name="content" value="<?= $form->content; ?>"><br>
	<input type="submit" value="Valider">
</form>
<?php if('create' === $mode): ?>
<a href="/posts">Retour aux posts</a>
<?php else: ?>
<a href="/posts/<?= $post->id; ?>">Voir le post</a>
<?php endif; ?>
<?php $content = ob_get_clean(); ?>

<?= self::render('common.base', ['content' => $content, 'title' => 'Courou']); ?>