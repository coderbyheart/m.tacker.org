<?php get_header(); ?>
<div id="fotos">
	<h2><?php echo _('Photos'); ?></h2>
<?php query_posts('cat=44&showposts=999'); if (have_posts()): ?>
<?php require_once 'fotolist.php'; ?>
<?php endif; ?>
	<div class="clear"><!-- --></div>
    <p><?php echo _('All Fotos &copy; Markus Tacker. All rights reserved.'); ?></p>
</div>
<!-- EOF: $Id: category-44.php 420 2008-09-03 12:18:37Z m $ -->
<?php get_footer(); ?>
