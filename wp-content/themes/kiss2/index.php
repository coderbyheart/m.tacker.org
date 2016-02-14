<?php get_header(); ?>

<?php

    $benchmark = false;
    if ($_SERVER['REMOTE_ADDR'] == '192.168.1.101') {
        $benchmark = true;
    }
    if ($benchmark) {
        require_once 'Benchmark/Timer.php';
        $Timer = new Benchmark_Timer();
        $Timer->start();
    }

    if ($_SERVER['REMOTE_ADDR'] == '213.217.101.98') {
        error_reporting(E_ALL ^ E_NOTICE);
        ini_set('display_errors', 1);
        ini_set('log_errors', 0);
    }

?>

<div id="main"><div id="main-1">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php $qype = (get_post_meta($post->ID, 'syndication_feed', true) == 'http://www.qype.com/people/tacker/rss') ? true : false; ?>
<div class="post" id="post-<?php the_ID(); ?>">

<h3 class="post-date"><?php echo utf8_encode(strftime('%e. %B %Y', get_the_time('U'))); ?></h3>
<?php

    $title = get_the_title();
    if ($qype) {
        $title = str_replace(' (von tacker)', '', $title);
        $title = str_replace(' (von Markus Tacker)', '', $title);
    }

?>
<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo htmlspecialchars($title); ?>"><?php echo htmlspecialchars($title); ?></a></h2>

<div class="post-body">
<?php if ($qype) : ?>
<p class="qype">Syndiziert von <a href="http://www.qype.com/people/tacker?inviter=tacker">Qype.com</a></p>
<?php endif; ?>
<?php
    $picasaembed = (get_post_meta($post->ID, 'picasaembed_rss_url', true)) ? get_post_meta($post->ID, 'picasaembed_rss_url', true) : false;
    if ($picasaembed) {
        require_once './wp-content/plugins/albumembed/AlbumEmbed.php';
        AlbumEmbed::$location = '/blog/wp-content/plugins/albumembed/AlbumEmbed.php';
        echo AlbumEmbed::getContainer($picasaembed);
    }
?>
<?php the_content('Weiterlesen &raquo;'); ?>
</div>

<p class="postmetadata">
    Kategorien: <?php the_category(', ') ?><br />
    <?php the_tags('Tags: ', ', ', '<br />'); ?>
    <?php comments_popup_link('Kommentieren', '1 Kommentar', '% Kommentare'); ?> <?php comments_rss_link('(RSS)'); ?>
    | <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Permalink</a>
    | <a href="<?php trackback_url(true); ?>" rel="trackback">Trackback</a>
    <?php edit_post_link('edit','| ',''); ?>
</p>

</div>

<?php if ($benchmark) $Timer->setMarker(get_the_title()); ?>

<?php endwhile; ?>

<p class="prev-next">
<?php next_posts_link('&laquo; Previous Entries') ?>
<?php previous_posts_link('Next Entries &raquo;') ?>
</p>

<?php else : ?>

<h2>Not Found</h2>
<p class="center">Sorry, but you are looking for something that isn't here.</p>
<div id="search-main">
<h3>Search</h3>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
</div>

<?php endif; ?>

<?php if ($benchmark) { $Timer->stop(); $Timer->display(); } ?>

</div></div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>