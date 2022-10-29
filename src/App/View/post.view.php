<?php ob_start(); ?>
<h2><?= $post->title; ?></h2>
<p><?= $post->intro; ?></p>
<p><?= $post->content; ?></p>
<span>Créé le <?= $post->created_at->format('d/m/Y H:i:s'); ?></span> par
<span><?= isset($post->edited_at) && $post->edited_at->format('Y-m-d H:i'); ?></span>
<span><?= $author->firstname; ?></span>
<?php $content = ob_get_clean(); ?>

<?= self::render('common.base', ['content' => $content, 'title' => 'Courou']); ?>