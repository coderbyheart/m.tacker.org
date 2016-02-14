<ul class="fotolist">
<?php while (have_posts()): the_post(); ?>
<?php require 'fotolist-li.php'; ?>
<?php endwhile; ?>
</ul>
<!-- EOF: $Id: fotolist.php 392 2008-04-07 08:17:14Z m $ -->