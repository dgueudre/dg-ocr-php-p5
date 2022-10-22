<?php ob_start() ?>
<h1>Post <?=$id?></h1>
<p><?=$tata?></p>
<?php $content = ob_get_clean() ?>

<?=self::render('base', ['content' => $content, 'title'=> 'Courou'])?>