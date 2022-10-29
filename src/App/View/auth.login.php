<?php ob_start(); ?>

<h1>Login</h1>
<form action="/login" method="POST">
	<label for="email">login</label><br>
	<input type="text" id="email" name="email" value="<?= $form->email; ?>"><br>
	<label for="password">password</label><br>
	<input type="password" id="password" name="password" value="<?= $form->password; ?>"><br><br>
	<input type="submit" value="Valider">
</form>
<a href="/register">register</a>
<?php $content = ob_get_clean(); ?>


<?= self::render('common.base', [
    'content' => $content,
    'title' => 'Courou',
]); ?>