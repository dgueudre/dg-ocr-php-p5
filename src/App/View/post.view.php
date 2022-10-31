<?php ob_start(); ?>
<h2><?= $post->title; ?></h2>
<p><?= $post->intro; ?></p>
<p><?= $post->content; ?></p>
<p>
    <span>Créé le <?= $post->created_at->format('d/m/Y H:i:s'); ?></span>
    <span> par <?= $author->firstname; ?></span>
</p>
<?php if($post->edited_at): ?>
<p>
    <span>Edité le <?=$post->edited_at->format('d/m/Y H:i:s'); ?></span>
    <span> par <?= $author->firstname; ?></span>
</p>
<?php endif; ?>
<a href="/posts/<?= $post->id; ?>/edit">Editer</a>

<h2>Commentaires</h2>
<?php foreach($comments as $comment): ?>
<p><?= $comment->comment; ?></p>
<p><?= $comment->author_id; ?></p>
<p><?= $comment->status->name; ?></p>
<?php endforeach; ?>
<?php $content = ob_get_clean(); ?>

<?= self::render('common.base', ['content' => $content, 'title' => 'Courou']); ?>