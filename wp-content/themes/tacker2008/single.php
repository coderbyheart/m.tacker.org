<?php get_header(); ?>
<?php if (have_posts()) : ?>
<div id="postarea">
    <div id="posts">
        <hr class="noprint" />
<?php while (have_posts()) : the_post(); ?>
<?php

	// Datum
	$day = utf8_encode(strftime('%e', get_the_time('U')));
	$month = utf8_encode(strftime('%m', get_the_time('U')));
	$year = utf8_encode(strftime('%Y', get_the_time('U')));

	$parent_id = $post->ID;
	$title = get_the_title();

	$adsense = (!stristr($_SERVER['HTTP_REFERER'], 'm.tacker.org') && get_post_meta($post->ID, 'noadsense', true) !== '1');
	$adsense_skyscraper = $adsense;
	$fotos = get_post_meta($post->ID, 'fotos', true);
	$flickr_pictures = trim(get_post_meta($post->ID, 'flickr_pictures', true));
	$flickr_set = trim(get_post_meta($post->ID, 'flickr_set', true));
	$flickr_set_use_description = trim(get_post_meta($post->ID, 'flickr_set_use_description', true));
	$flickr_set_large_first = trim(get_post_meta($post->ID, 'flickr_set_large_first', true));
	$hide_map = (bool)trim(get_post_meta($post->ID, 'hide_map', true));
	$flickrSetUseDescription = $flickr_set_use_description == '' || $flickr_set_use_description == '1';
	$flickrSetLargeFirst = $flickr_set_large_first == '' || $flickr_set_large_first == '1';
	$flickrPhotos = empty($flickr_pictures) ? array() : explode("\n", $flickr_pictures);
	$isFlickrSet = !empty($flickr_set);
	$isFlickr = !empty($flickrPhotos);
	$isPhotoByCat = in_category(44);
	$isPhoto = get_post_meta($post->ID, 'is_foto', true) === '1';
	$hasPhoto = ($isPhotoByCat || $isPhoto || $isFlickr || $isFlickrSet);
	if ( empty( $fotos ) ): $fotos = false; else: $adsense_skyscraper = false; endif;
	if ($isFlickrSet) $adsense_skyscraper = false;
	
	$tags = array();
	$p_tags = get_the_tags();
	if ( !empty( $p_tags ) ) foreach ( $p_tags as $tag ) $tags[] = $tag->slug;

?>

<div class="post">
    <div class="content" id="post-content">
        <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $title; ?></a></h2>

        <?php if ($adsense): ?>
        <p>
            <script type="text/javascript">
            // <!--
                google_ad_client = "pub-1433491275523778";
                /* 468x60, Erstellt 08.03.08 */
                google_ad_slot = "6018807579";
                google_ad_width = 468;
                google_ad_height = 60;
            // -->
            </script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
        </p>
        <?php endif; ?>

        <p class="print"><?php echo utf8_encode(strftime('%e.%m.%Y', get_the_time('U'))); ?></p>


     	<?php if ($hasPhoto) {
			$content = get_the_content();
			$content = apply_filters('the_content', $content);
			if ($isFlickr) {
				printFlickrMainPhoto($flickrPhotos[0]);
				the_content(_('more ...'));
			} else if ($flickr_set) {
				$set = getFlickrPhotoset($flickr_set);
				if ($flickrSetLargeFirst) printFlickrMainPhoto($set->primary);
				if ($flickrSetUseDescription) {
					?><p><?php echo nl2br($set->description->_content); ?></p><?php
				} else {
					the_content(_('more ...'));
				}
			} else if ($isPhoto || $isPhotoByCat) {
				if (preg_match('/<img[^>]+>/', $content, $match)) {
					$img = $match[0];
					if (!preg_match('/src=["\']([^"\']+)["\']/', $img, $src_match)) continue;
					if ( strstr( $src_match[1], FOTO_URL ) ) {
						$foto_path = str_replace( FOTO_URL, '', $src_match[1] );
						$src = FOTO_URL . dirname( $foto_path ) . '/thumb.' . basename( $src_match[1] );
						$target = $src_match[1];
					} else {
						$src = FOTO_URL . 'thumb.' . basename( $src_match[1] );
						$target = FOTO_URL . basename( $src_match[1] );
					}
					$content = preg_replace('/<img[^>]+>/i', '<a href="' . $target . '" rel="lightbox[fotos]" title="' . get_the_title(). '" class="fotolink"><img src="' . $src . '" alt="' . get_the_title(). '" longdesc="' . get_permalink() . '" class="full" /><span class="fotoinfo noprint">' . _( 'click for full view' ) . '</span></a>', $content, 1 );
					echo $content;
				} else {
					the_content(_('more ...'));
				}
			} else {
				the_content(_('more ...'));
			}
		} else {
			the_content(_('more ...'));
		}
		?>

        <?php
			// Rating
			// See http://microformats.org/wiki/hreview
			$rating = get_post_meta( $post->ID, 'rating', true );
			if ( $rating !== '' && preg_match( '/^[0-9]+\/[0-9]+$/', $rating ) ):
				list( $therating, $max ) = explode( '/', $rating );
				?><div class="hreview">
                	<h3><?php echo _( 'Rating' ); ?></h3>
                    <p class="item"><span class="fn"><?php the_title(); ?></span></p>
                    <div class="rating">
                		<ul>
                        	<li><span class="value"><?php echo $therating; ?></span>/<span class="best"><?php echo $max; ?></span></li>
						<?php
				for ( $i = 1; $i <= $max; $i++ ): ?><li class="<?php if ( $i <= $therating ) : ?>goldstar<?php else: ?>greystar<?php endif; ?>"></li><?php endfor;
				?></ul></div>
                	<span class="version">0.3</span>

                    <span class="reviewer vcard">
                    	<a class="url fn" href="<?php bloginfo('url'); ?>"><?php the_author_firstname(); ?> <?php the_author_lastname(); ?></a>
                    </span>
                    <span class="dtreviewed"><?php echo utf8_encode(strftime('%Y-%m-%dT%H:%M', get_the_time('U'))); ?></span>
                </div><?php
			endif;
		?>

        <?php
		   if(!$hide_map && class_exists('GeoMashup')) {
				$coordinates = GeoMashup::post_coordinates();
				if (!$coordinates) {
					if ($isFlickrSet) {
						foreach($set->photo as $photo) {
							if ($photo->id !== $set->primary) continue;
							if (property_exists($photo, 'latitude')) {
								$coordinates = array(
									'lat' => $photo->latitude,
									'lng' => $photo->longitude,
								);
								break;
							}
						}
					}
				}
				if ($coordinates && $coordinates['lng'] && $coordinates['lat']): ?>
                <h3><?php echo _( 'Map' ); ?></h3>
                <div id="postmap"></div>
				<p class="geo">
                	<small>
						<?php echo _('Coordinates for this post'); ?>:
                        <a href="http://maps.google.com/maps?ll=<?php echo $coordinates['lat']; ?>,<?php echo $coordinates['lng']; ?>&amp;q=<?php echo $coordinates['lat']; ?>,<?php echo $coordinates['lng']; ?>%20(<?php echo rawurlencode($title); ?>)">
							<span class="latitude"><?php echo $coordinates['lat']; ?></span>, <span class="longitude"><?php echo $coordinates['lng']; ?></span>
                        </a>
                    </small>
				</p>
				<?php endif;
			}
        ?>

    </div><!-- end of div.content -->

	<div class="meta noprint" id="post-meta">
<?php if (!is_page()): ?>
		<div class="date">
			<div class="day"><?php echo $day; ?></div>
			<div class="month"><?php echo $month; ?></div>
			<div class="year"><?php echo $year; ?></div>
		</div>
<?php endif; /* end of if !is_page(): */ ?>

        <p>
			<?php if ( 'open' == $post->comment_status ): ?>
            <a href="<?php the_permalink() ?>#respond" title="<?php echo _('Add a comment'); ?>">
                <?php comments_number('<img src="' . THEME_IMAGE_DIR. '/silk_red/comment_add.png" alt="' . _('Add a comment') . '" width="16" height="16" />', '<img src="' . THEME_IMAGE_DIR. '/silk_red/comments.png" alt="' . _('Comments') . '" width="16" height="16" /> 1', '<img src="' . THEME_IMAGE_DIR . '/silk_red/comments.png" alt="' . _('Comments') . '" width="16" height="16" /> %'); ?>
            </a>
            |
            <?php endif; /* end of ( 'open' == $post->comment_status ) */ ?>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink"><img src="<?php echo THEME_IMAGE_DIR; ?>/silk_red/link.png" alt="<?php echo _('Permalink'); ?>" width="16" height="16" /></a>
             <?php edit_post_link('<img src="' . THEME_IMAGE_DIR. '/silk/pencil.png" alt="' . _('Edit post') . '" width="16" height="16" />','| ',''); ?>
        </p>

		<?php $category = get_the_category(); if (!empty($category)): ?>
		<p>
            <small><?php echo _('Categories'); ?> &gt; </small><?php the_category(' ') ?>
		</p>
		<?php endif; ?>

        <?php the_tags( '<p><small>' . _('Tags') . ' &gt; </small>', ' ', '</p>'); ?>
        
        <p>&nbsp;</p>
        <?php the_flattr_permalink() ?>

        <p>&nbsp;</p>
        <?php next_post_link('<p><small>'. _('next') . ' &gt;</small> %link</p>') ?>
        <?php previous_post_link('<p><small>'. _('previous') . ' &gt;</small> %link</p>') ?>

        </div><!-- enf of div.meta -->

        <?php comments_template(); ?>

        <div class="clear">
    </div>

</div><!-- end of div.post -->

<?php endwhile; ?>
    </div> <!-- end of <div id="posts"> -->
    <div id="posts-footer"></div>
</div> <!-- end of <div id="postarea"> -->
<?php endif; ?>

<?php

	// Suche Fotos mit dem selben Tag
	if ($isPhotoByCat) {
		$moreFotos = array();
		$fotoIds = array();
		foreach ( $tags as $tag ) {
			query_posts( 'tag='. strtolower( $tag ) );
			while ( have_posts() ) {
				the_post();
				if ( $post->ID == $parent_id ) continue;
				$cats = get_the_category();
				foreach ( $cats as $cat ) {
					if ( $cat->term_id === '44' ) {
						if ( in_array( $post->ID, $fotoIds ) ) continue;
						$fotoIds[] = $post->ID;
						$moreFotos[] = $post;
						continue;
					}
				}
			}
		}
	}

	if (!empty($moreFotos)):
?><div class="postlist">
    <div class="postlist-content">
		<h2><?php echo _('more photos from this series'); ?></h2>
		<ul class="fotolist relatedfotos">
<?php
		foreach ( $moreFotos as $post ) {
			require 'fotolist-li.php';
		}
?>
		</ul>
	</div>
</div>
<?php
	endif;

?>

<?php if ($fotos || $isFlickrSet): ?>
<div class="postlist">
    <div class="postlist-content">
        <!-- Fotos -->
        <h2><?php echo _('more photos'); ?></h2>
        <?php if($fotos): ?>
        <ul class="fotolist fotolist-post">
        	<?php foreach ( explode( "\n", $fotos ) as $entry ):
				list( $foto, $title ) = explode( ';', trim( $entry ) );
				$target   = FOTO_URL . $foto;
				$polaroid = FOTO_URL . substr( $foto, 0, strrpos( $foto, '/' ) ) . '/polaroid.' . str_ireplace( '.jpg', '.png', basename( $foto ) );
			?>
            <li class="thumbnail">
            	<a href="<?php echo $target; ?>" rel="lightbox[fotos]" title="<?php echo htmlspecialchars( $title ); ?>">
                    <img src="<?php echo $polaroid; ?>" alt="<?php echo htmlspecialchars( $title ); ?>" longdesc="<?php the_permalink() ?>" />
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php
		endif;
		if ($isFlickrSet) printFlickrPhotoList($flickr_set, $flickrSetLargeFirst);
		?>
    </div>
</div>
<?php endif; ?>

<?php if ($adsense_skyscraper): ?>
	<div id="skyscraper">
    	<div id="skyscraperclose"><!-- --></div>
		<script type="text/javascript">
		// <!--
			google_ad_client = "pub-1433491275523778";
			/* 160x600, Erstellt 08.03.08 */
			google_ad_slot = "5919890191";
			google_ad_width = 160;
			google_ad_height = 600;
		// -->
		</script>
		<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
	</div><!-- end of #skyscraper -->
<?php endif; ?>

<!-- EOF: $Id: index.html 359 2007-09-07 09:47:43Z m $ -->
<?php get_footer(); ?>
