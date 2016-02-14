<?php
/*
Template Name: Kontakt-Seite
*/
?>
<?php get_header();?>
<?php if (have_posts()) : ?>
<div id="postarea">
    <div id="posts">
        <hr class="noprint" />
<?php while (have_posts()) : the_post(); ?>
<?php $title = get_the_title(); ?>
<div class="post">
    <div class="content vcard">
       	<h2>
            <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $title; ?></a>
        </h2>

        <?php the_content(_('more ...')); ?>

    </div><!-- end of div.content -->

	<div class="meta noprint"><!-- --></div><!-- enf of div.meta -->

    <div class="clear">
    </div>

</div><!-- end of div.post -->

<?php endwhile; ?>
    </div> <!-- end of <div id="posts"> -->
    <div id="posts-footer"></div>
</div> <!-- end of <div id="postarea"> -->
<?php endif; ?>
<!-- EOF: $Id: kontakt.php 420 2008-09-03 12:18:37Z m $ -->
<?php get_footer(); ?>
