<div id="comments">
<h2>Kommentare</h2>

<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>

<p>This post is password protected. Enter the password to view comments.<p>

				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?>

<!-- You can start editing here. -->

<?php if ($comments) : ?>

<ol>
<?php foreach ($comments as $comment) : ?>
<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
<span><cite id="author-<?php comment_ID() ?>"><?php comment_author_link() ?></cite> |
<?php if ($comment->comment_approved == '0') : ?>
<em>Dein Kommentar wartet auf Genehmigung.</em>
<?php endif; ?>
<a href="#comment-<?php comment_ID() ?>" title="" id="anchor-<?php comment_ID() ?>"><?php comment_date('j. F Y') ?> | <?php comment_time() ?></a><!-- | <a href="#respond" onclick="citeComment(<?php comment_ID() ?>);">zitieren</a> --></span>
<div id="commentbody-<?php comment_ID() ?>"><?php comment_text() ?></div>
</li>

<?php /* Changes every other comment to a different class */
if ('alt' == $oddcomment) $oddcomment = '';
else $oddcomment = 'alt';
?>

<?php endforeach; /* end for each comment */ ?>
</ol>

<?php else : // this is displayed if there are no comments so far ?>

<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p>Comments are closed.</p>

<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<h2><a name="respond">Eintrag kommentieren</a></h2>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Angemeldet als <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Abmelden &raquo;</a></p>

<?php else : ?>

<p>
<label for="author">Name <?php if ($req) echo "(required)"; ?></label>
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
</p>

<p>
<label for="email">E-Mail (wird nicht veröffentlicht) <?php if ($req) echo "(required)"; ?></label>
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
</p>

<p>
<label for="url">Website</label>
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
</p>

<?php endif; ?>

<p>
<label for="comment">Kommentar</label>
<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
</p>

<p>
<input name="submit" type="submit" id="submit" tabindex="5" value="Absenden" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
</div>