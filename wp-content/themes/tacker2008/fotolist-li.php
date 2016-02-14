<?php
	
	$id = $post->ID;
	$content = $post->post_content;

	if (preg_match('/<img[^>]+>/', $content, $match)) {
		$img = $match[0];
		if (!preg_match('/src=["\']([^"\']+)["\']/', $img, $src_match)) continue;
		$src = str_ireplace('.jpg', '.png', $src_match[1]);
		if ( strstr( $src_match[1], FOTO_URL ) ) {
			$foto_path = str_replace( FOTO_URL, '', $src_match[1] );
			$target = $src_match[1];
			$src = FOTO_URL . dirname( $foto_path ) . '/polaroid.' . basename( $src );
		} else {
			$target = FOTO_URL . basename( $src_match[1] );
			$src = FOTO_URL . 'polaroid.' . basename( $src );
		}
	}
	
?>
<li class="thumbnail">
	<a href="<?php echo $target; ?>" rel="lightbox[fotos]" title="<?php echo htmlspecialchars($post->post_title); ?>">
		<img src="<?php echo $src; ?>" alt="<?php echo htmlspecialchars($post->post_title); ?>" longdesc="<?php echo $post->guid; ?>" />
	</a>
    <ul class="thumblinks">
    	<?php if ( 'open' == $post->comment_status ): ?>
        <li><a href="<?php echo $post->guid; ?>#respond" title="<?php echo _('Add a comment'); ?>"><?php comments_number('<img src="' . THEME_IMAGE_DIR. '/silk_red/comment_add.png" alt="' . _('Add a comment') . '" width="16" height="16" />', '<img src="' . THEME_IMAGE_DIR. '/silk_red/comments.png" alt="' . _('Comments') . '" width="16" height="16" /> 1', '<img src="' . THEME_IMAGE_DIR . '/silk_red/comments.png" alt="' . _('Comments') . '" width="16" height="16" /> %'); ?>
	    </a></li>
		<?php endif; /* end of ( 'open' == $post->comment_status ) */ ?>
        <li><a href="<?php echo $post->guid; ?>" rel="bookmark" title="<?php echo htmlspecialchars($post->post_title); ?>"><img src="<?php echo THEME_IMAGE_DIR; ?>/silk_red/link.png" alt="<?php echo _('Permalink'); ?>" width="16" height="16" /></a></li>
        <?php edit_post_link('<img src="' . THEME_IMAGE_DIR. '/silk/pencil.png" alt="' . _('Edit post') . '" width="16" height="16" />','<li>','</li>'); ?>
    </ul>
</li>
<!-- EOF: $Id: fotolist-li.php 410 2008-07-21 21:26:22Z m $ -->