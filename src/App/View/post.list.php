<?php ob_start(); ?>

<h1>Liste des posts</h1>
<ul>
	<?php foreach ($posts as $post): ?>
	<li>
		<div class='post'>
			<h2><?= $post->title; ?></h2>
			<p><?= $post->intro; ?></p>
			<span><?= $post->created_at->format('Y-m-d H:i'); ?></span>
			<a href="/posts/<?= $post->id; ?>">Voir plus</a>
		</div>
	</li>
	<?php endforeach; ?>
</ul>
<?php $content = ob_get_clean(); ?>


<?= self::render('common.base', [
    'content' => $content,
    'title' => 'Courou',
]); ?>