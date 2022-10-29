<?php ob_start(); ?>

<h1>Login</h1>
<form action="/register" method="POST">
	<label for="firstname">Prénom</label><br>
	<input type="text" id="firstname" name="firstname" value="<?= $form->firstname; ?>"><br>
	<label for="lastname">Nom</label><br>
	<input type="text" id="lastname" name="lastname" value="<?= $form->lastname; ?>"><br>
	<label for="email">email</label><br>
	<input type="text" id="email" name="email" value="<?= $form->email; ?>"><br>
	<label for="password">password</label><br>
	<input type="password" id="password" name="password" value="<?= $form->password; ?>"><br><br>
	<label for="confirm">confirm password</label><br>
	<input type="password" id="confirm" name="confirm" value="<?= $form->confirm; ?>"><br><br>
	<input type="submit" value="Valider">
</form>
<a href="/login">login</a>
<?php $content = ob_get_clean(); ?>


<?= self::render('common.base', [
    'content' => $content,
    'title' => 'Courou',
]); ?>