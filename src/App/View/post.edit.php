<?php ob_start(); ?>
<h2><?= $post->title; ?></h2>
<p><?= $post->intro; ?></p>
<span><?= $post->created_at; ?></span>
<a href="/posts/<?= $post->id; ?>">Voir plus</a>
<?php $content = ob_get_clean(); ?>

<?= self::render('common.base', ['content' => $content, 'title' => 'Courou']); ?>