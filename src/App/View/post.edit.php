<?php ob_start(); ?>
<h2><?php echo $post->title; ?></h2>
<p><?php echo $post->intro; ?></p>
<span><?php echo $post->created_at; ?></span>
<a href="/posts/<?php echo $post->id; ?>">Voir plus</a>
<?php $content = ob_get_clean(); ?>

<?php echo self::render('base', ['content' => $content, 'title' => 'Courou']); ?>