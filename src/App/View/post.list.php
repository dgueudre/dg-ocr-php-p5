<?php ob_start(); ?>

<h1>Liste des posts</h1>
<ul>
	<?php foreach ($posts as $post) { ?>
	<li>
		<div class='post'>
			<h2><?php echo $post->title; ?></h2>
			<p><?php echo $post->intro; ?></p>
			<span><?php echo $post->created_at->format('Y-m-d H:i'); ?></span>
			<a href="/posts/<?php echo $post->id; ?>">Voir plus</a>
		</div>
	</li>
	<?php } ?>
</ul>
<?php $content = ob_get_clean(); ?>


<?php echo self::render('base', ['content' => $content, 'title' => 'Courou']); ?>