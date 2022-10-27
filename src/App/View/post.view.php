<?php ob_start(); ?>
<h2><?= $post->title; ?></h2>
<p><?= $post->intro; ?></p>
<p><?= $post->content; ?></p>
<span>Créé le <?= $post->created_at->format('d/m/Y H:i:s'); ?></span> par 
<span><?= $post->edited_at; ?></span>
<span><?= $author->firstname; ?></span>
<?php $content = ob_get_clean(); ?>

<?= self::render('base', ['content' => $content, 'title' => 'Courou']); ?>