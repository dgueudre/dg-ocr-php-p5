<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $title; ?>
	</title>
</head>

<body>
	<?= self::render('common.navbar', ['user' => $_SESSION['user'] ?? false]); ?>
	<?= self::render('common.user', ['user' => $_SESSION['user'] ?? false]); ?>
	<?= self::render('common.alerts'); ?>
	<?= $content; ?>
</body>

</html>