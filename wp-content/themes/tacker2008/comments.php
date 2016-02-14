<?php if ('open' == $post->comment_status) : ?>

<div class="comments noprint">
    <div class="meta">
        <h3 id="respond"><?php echo _('Your comment'); ?></h3>
    </div>

    <div class="content">
        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p><?php echo sprintf( _('You must be <a href="%s/wp-login.php?redirect_to=%s">logged in</a> to post a comment.'), get_option('siteurl'), get_the_permalink() ) ?></p>
        <?php else : ?>

        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

        <?php if ( $user_ID ) : ?>

        <p><?php echo sprintf( _('Logged in as <a href="%s/wp-admin/profile.php">%s</a>. <a href="%s/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a>' ), get_option('siteurl'), $user_identity, get_option('siteurl') ); ?></p>

        <?php else : ?>

        <p>
            <label for="author"><small><?php echo _('Name'); ?> <?php if ($req) echo '(' . _('required') . ')'; ?></small></label><br/>
            <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" />
        </p>

        <p>
            <label for="email"><small><?php echo _('Email address'); ?> (<?php echo _('will not be published'); ?>) <?php if ($req) echo '(' . _('required') . ')'; ?></small></label><br/>
            <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
        </p>

        <p>
            <label for="url"><small><?php echo _('Website'); ?></small></label><br/>
            <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
        </p>

        <?php endif; ?>

        <p>
            <label for="comment"><small><?php echo _('Comment'); ?></small></label><br/>
            <textarea name="comment" id="comment" cols="100" rows="10" tabindex="4"></textarea>
        </p>

        <p>
            <button type="submit" name="submit" id="submit" tabindex="5"><?php echo _( 'submit' ); ?></button>
            <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
        </p>
        <?php do_action('comment_form', $post->ID); ?>

        </form>

        <?php endif; // If registration required and not logged in ?>
    </div>

</div>
<?php endif; // If registration required and not logged in ?>

<?php if ($comments) : ?>
<div class="clear">
</div>
<div class="comments noprint">
    <div class="meta">
        <h3 id="comments"><?php echo _('Comments'); ?></h3>
        <p>
			<a class="icon irss" href="<?php echo get_post_comments_feed_link(); ?>" title="<?php echo _('Subscribe to comments by RSS feed'); ?>"><?php echo _('Comments RSS'); ?></a>
        </p>
    </div>

<?php foreach (array_reverse($comments) as $comment):
$isTrackback = ( $comment->comment_type == 'trackback' || $comment->comment_type == 'pingback' );
?>
    <div class="meta">
        <p>
    	    <?php echo get_avatar( $comment, 32 ); ?>
            <strong><?php comment_author_link() ?></strong> <a href="<?php the_permalink() ?>#comment-<?php comment_ID() ?>" title="<?php echo ($isTrackback) ? _('Trackback by') : _('Comment by'); ?> <?php comment_author() ?>"><img src="<?php echo THEME_IMAGE_DIR; ?>/silk_red/<?php echo ($isTrackback) ? 'world_link' : 'comment'; ?>.png" alt="<?php echo ($isTrackback) ? _('Trackback') : _('Comment'); ?>" width="16" height="16" /></a><?php edit_comment_link('<img src="' . THEME_IMAGE_DIR. '/silk/pencil.png" alt="' . _('Edit comment') . '" width="16" height="16" />',' | ',''); ?><a name="comment-<?php comment_ID() ?>"> </a>
        </p>

        <p>
            <?php echo utf8_encode(strftime('%e. %B %Y | %H:%M', get_comment_date('U'))); ?>
        </p>
    </div>

    <div class="content">
        <?php if ($comment->comment_approved == '0') : ?>
        <em>Your comment is awaiting moderation.</em>
        <?php endif; ?>
        <?php comment_text() ?>
    </div>

    <div class="clear">
    </div>
<?php endforeach; ?>
</div>
<?php endif; ?>

<!-- EOF: $Id: index.html 359 2007-09-07 09:47:43Z m $ -->
