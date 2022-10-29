<?php while(count($_SESSION['alerts'])): ?>
<?php $alert = array_pop($_SESSION['alerts']); ?>
<div><?=$alert->message; ?></div>
<?php endwhile; ?>