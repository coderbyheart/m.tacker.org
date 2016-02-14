<?php get_header(); ?>
<div class="postlist">
    <div class="postlist-meta meta"><p></p></div>
    <div class="postlist-content">
    <?php if (is_category()): ?>
        <h2><?php echo sprintf( _('Entries in the category %s'), single_cat_title( '', false ) ); ?></h2>
    <?php elseif (is_tag()): ?>
        <h2><?php echo sprintf( _('Entries tagged %s'), single_cat_title( '', false ) ); ?></h2>
	<?php elseif (is_search()): ?>
        <h2><?php echo _('Search results'); ?></h2>
    <?php else: ?>
        <h2><?php echo _('Blog'); ?></h2>
    <?php endif; ?>
    </div>
    <div class="clear"><!-- --></div>
    <div class="postlist-meta meta"><p></p></div>
    <div class="postlist-content"><h3><?php previous_posts_link('&laquo; ' . _('newer posts')); ?></h3></div>
    <div class="clear"><!-- --></div>

<?php if( is_home() && function_exists('twitter_messages') ): ?>
	<!-- Letzten Tweet anzeigen -->
    <div class="postlist-meta meta">
        <p>
            <a href="http://twitter.com/markustacker"><img src="<?php bloginfo('template_directory'); ?>/i/twitter_logo_16px.png" alt="twitter" /></a>
        </p>
    </div>
    <div class="postlist-content">
        <h3>
			<?php twitter_messages('markustacker', 1, false, false, false, false); ?>
        </h3>
    </div>
    <div class="clear"><!-- --></div>
<?php endif; ?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>
    <?php $thespan = getNiceSpan(get_the_time('U')); ?>
    <div class="postlist-meta meta">
        <p>
            <?php if ( $lastspan != $thespan ) echo $thespan; $lastspan = $thespan;  ?>
        </p>
    </div>
    <div class="postlist-content">
        <h3>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                <?php the_title(); ?>
            </a>
            <small>&gt; <?php the_category( ', ' ); ?></small>
        </h3>
        <?php if (has_excerpt() && $excerpt = get_the_excerpt()): ?><p><?php echo $excerpt; ?></p><?php endif; ?>
    </div>
    <div class="clear"><!-- --></div>
<?php endwhile; ?>
<?php else: ?>
    <div class="postlist-meta meta"><p></p></div>
    <div class="postlist-content">
        <h3>
        	<a href="<?php echo get_settings('home'); ?>/" title="<?php echo _('Go home.'); ?>">
				<?php echo _('WTF dude?! No posts in my database match your criteria. Dismissed.'); ?>
            </a>
        </h3>
    </div>
    <div class="clear"><!-- --></div>
<?php endif; ?>
    <div class="postlist-meta meta"><p></p></div>
    <div class="postlist-content"><h3><?php next_posts_link(_('older posts') . ' &raquo;'); ?></h3></div>
    <div class="clear"><!-- --></div>
</div>

<?php if (!is_single()): ?>
<div class="postlist">
    <div class="postlist-content">
    	<!-- Navigation -->
        <h2><?php echo _('Navigation'); ?></h2>

        <ul>
            <li><a class="block" href="<?php echo get_settings('home'); ?>/" rel="bookmark"><?php echo _('Home'); ?></a></li>
			<?php if (D_MTACKERORG): ?>
			<li><a href="http://markusstudiert.de/" rel="me" class="block">Markus studiert!</a></li>
            <li><a class="block" href="https://m.tacker.org/datenschutz">Datenschutz</a></li>
            <li><a class="block" href="https://m.tacker.org/hinweise">Hinweise</a></li>
            <?php endif; ?>
            <li><a class="block" href="https://cto.hiv/" rel="author"><?php echo _('Contact'); ?></a></li>
        </ul>

        <?php if (D_MTACKERORG): ?>
        <!-- Fotos -->
        <div class="clear"><br/></div>
        <h2>
			<a href="http://www.flickr.com/photos/tacker/sets/72157623232431871/"><?php echo _('Photos'); ?></a>
        </h2>
        <p><?php echo _('I shoot photos, too. These are the latest.'); ?><br /><a href="http://www.flickr.com/photos/tacker/sets/72157623232431871/"><?php echo _('More photos?'); ?></a></p>


        <?php
        	printFlickrPhotoList('72157623232431871', false, 9);
		?>
		<?php endif; ?>

        <!-- Tags -->
        <div class="clear"><br/></div>
        <h2><?php echo _('Tags'); ?></h2>
        <div id="tagcloud">
        <?php wp_tag_cloud(''); ?>
        </div>

        <?php if(D_MTACKERORG): ?>
        <div id="coderbyheart"><img src="<?php bloginfo('template_directory'); ?>/coderbyheart.de/coder-by-heart.jpg" alt="coder::by(&#9829;);" title="coder::by(&#9829;);" /></div>
		<?php endif; ?>

    </div>
</div>
<?php endif; /* of  (!is_single()): */ ?>
<!-- EOF: $Id: index.html 359 2007-09-07 09:47:43Z m $ -->
<?php get_footer(); ?>
