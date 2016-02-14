<?php get_header(); ?>

<?php
@session_start();
if (isset($_SESSION['from_feed'])) {
    mail('m@tacker.org',
    'search 2 post',
    $_SESSION['from_feed']
     . "\n"
     . ((isset($_SERVER['HTTPS']) and strtolower($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://')
     . $_SERVER['HTTP_HOST']
     . $_SERVER['REQUEST_URI'],
     'From: "Markus Tacker" <m@tacker.org>');
     unset($_SESSION['from_feed']);
}
?>

<div id="main"><div id="main-1">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<p class="prev-next">
<?php previous_post_link('&laquo; %link') ?>
&nbsp;&nbsp;&nbsp;
<?php next_post_link('%link &raquo;') ?>
</p>

<div class="post" id="post-<?php the_ID(); ?>">
<?php if (!stristr($_SERVER['HTTP_REFERER'], 'm.tacker.org') && get_post_meta($post->ID, 'noadsense', true) !== '1' ): ?>
<script type="text/javascript"><!--
google_ad_client = "pub-1433491275523778";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text_image";
//2007-01-30: BannerContentArea
google_ad_channel = "0495149276";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<?php endif; ?>
<h3 class="post-date"><?php echo utf8_encode(strftime('%e. %B %Y', get_the_time('U'))); ?></h3>
<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

<div class="post-body">

<?php

    $diggurl = (get_post_meta($post->ID, 'DiggUrl', true)) ? get_post_meta($post->ID, 'DiggUrl', true) : false;
    if ($diggurl) {
?>
<p><a href="<?php echo $diggurl; ?>"><img alt="Digg This!" id="image153" src="https://m.tacker.org/wp-content/uploads/2006/03/digg-blue.gif" /> Digg this!</a></p>
<?php
    }
?>


<?php
    $picasaembed = (get_post_meta($post->ID, 'picasaembed_rss_url', true)) ? get_post_meta($post->ID, 'picasaembed_rss_url', true) : false;
    if ($picasaembed) {
        require_once './wp-content/plugins/albumembed/AlbumEmbed.php';
        AlbumEmbed::$location = '/blog/wp-content/plugins/albumembed/AlbumEmbed.php';
        echo AlbumEmbed::getContainer($picasaembed);
    }
?>
<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>

<?php

    // Amazon link
    echo get_post_meta($post->ID, 'amazon', true);

?>

<p class="postmetadata">
    Kategorien: <?php the_category(', ') ?><br />
    <?php the_tags('Tags: ', ', ', '<br />'); ?>
    <a href="#respond">Kommentieren</a> (<?php comments_rss_link('RSS Feed der Kommentare'); ?>)
    | <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Permalink</a>
    | <a href="<?php trackback_url(true); ?>" rel="trackback">Trackback</a>
    <?php edit_post_link('edit','<br/>',''); ?>
</p>

</div>
</div>

<?php comments_template(); ?>

<?php endwhile; else: ?>

<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

</div></div>

<div id="sidebar">

<div class="side-sec pages">
<h3>Navigation</h3>
<ul>
<li><a href="/blog/">Startseite</a></li>
<?php wp_list_pages('title_li='); ?>
</ul>
</div>

<?php if ( get_post_meta($post->ID, 'noadsense', true) !== '1' ): ?>
<div class="side-sec pages">
<script type="text/javascript"><!--
google_ad_client = "pub-1433491275523778";
google_alternate_color = "FFFFFF";
google_ad_width = 160;
google_ad_height = 600;
google_ad_format = "160x600_as";
google_ad_type = "text_image";
google_ad_channel ="9926925146";
google_color_border = "CCCCCC";
google_color_bg = "FFFFFF";
google_color_link = "000000";
google_color_url = "666666";
google_color_text = "333333";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<p>
<script type="text/javascript"><!--
google_ad_client = "pub-1433491275523778";
google_ad_width = 120;
google_ad_height = 60;
google_ad_format = "120x60_as_rimg";
google_cpa_choice = "CAAQpeGbzgEaCBNm5xUda_PTKNXA93M";
//--></script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</p>
</div>
<?php endif; ?>

<div class="side-sec subscribe">
<h3>Abonnieren</h3>
<ul>
<li><a href="feed:<?php bloginfo('rss2_url'); ?>">Einträge (RSS)</a></li>
<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>">Kommentare (RSS)</a></li>
</ul>
</div>

</div>

<?php get_footer(); ?>
