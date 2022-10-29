<ul>
	<li><a href="/">home</a></li>
	<?php if($user): ?>
	<li><a href="/logout">logout</a></li>
	<?php else: ?>
	<li><a href="/login">login</a></li>
	<?php endif; ?>
</ul>