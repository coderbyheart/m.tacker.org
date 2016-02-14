<?php get_header(); ?>

<div id="main"><div id="main-1">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

<h3 class="post-date"><?php the_time('F jS, Y') ?></h3>
<h2 class="post-title"><?php the_title(); ?></h2>

<div class="post-body">
<?php the_content('Read the rest of this entry &raquo;'); ?>
</div>

<p class="postmetadata"><?php the_author() ?> | <?php the_category(', ') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> | <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">#</a></p>

</div>

<?php endwhile; ?>

<p class="prev-next">
<?php next_posts_link('&laquo; Previous Entries') ?> <?php previous_posts_link('Next Entries &raquo;') ?>
</p>

<?php else : ?>

<h2>Not Found</h2>
<p class="center">Sorry, but you are looking for something that isn't here.</p>
<div id="search-main">
<h3>Search</h3>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
</div>

<?php endif; ?>

</div></div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>