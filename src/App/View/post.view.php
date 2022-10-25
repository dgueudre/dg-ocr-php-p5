<?php ob_start(); ?>
<h2><?php echo $post->title; ?></h2>
<p><?php echo $post->intro; ?></p>
<p><?php echo $post->content; ?></p>
<span>Créé le <?php echo $post->created_at->format('d/m/Y H:i:s'); ?></span> par 
<span><?php echo $post->edited_at; ?></span>
<span><?php echo $author->firstname; ?></span>
<?php $content = ob_get_clean(); ?>

<?php echo self::render('base', ['content' => $content, 'title' => 'Courou']); ?>