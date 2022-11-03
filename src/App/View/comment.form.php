<h2>Nouveau commentaire</h2>
<form action="/posts/<?= $post->id; ?>/comment" method="POST">
	<label for="comment">Commentaire</label><br>
	<input type="text" id="comment" name="comment" value=""><br>
	<input type="submit" value="Valider">
</form>