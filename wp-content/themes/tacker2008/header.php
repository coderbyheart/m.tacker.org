<?php echo '<?xml version="1.0" encoding="utf-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta name="ROBOTS" content="index,follow,noodp" />
        <meta http-equiv="Content-Language" content="de-de" />
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/slimbox/de/css/slimbox.css" type="text/css" media="screen" />
	<?php if(D_MTACKERORG): ?>
        <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/m.tacker.org/fav.ico" />
	<?php elseif(D_CODERBYHEARTDE): ?>
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/coderbyheart.de/fav.ico" />
	<?php endif; ?>
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css?<?php echo SVNREV; ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/tacker.css?<?php echo SVNREV; ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/print.css?<?php echo SVNREV; ?>" type="text/css" media="print" />
        <?php if ( !is_single() && !is_category(44) ): ?><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/index.css?<?php echo SVNREV; ?>" type="text/css" media="screen" /><?php endif; ?>
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<link rel="openid.server" href="http://m.tacker.org/phpMyID/MyID.config.php" />
		<link rel="openid.delegate" href="http://m.tacker.org/phpMyID/MyID.config.php" />
		<?php wp_head(); ?>
        <title>
            <?php wp_title(''); ?><?php if ( is_single() or is_archive() or is_page() ) { ?> :: <?php } ?><?php bloginfo('name'); ?>
        </title>
    </head>
    <body>

        <h1>
			<a href="<?php echo get_settings('home'); ?>/">
				<?php if(D_MTACKERORG): ?>
				<img src="<?php bloginfo('template_directory'); ?>/m.tacker.org/tacker.org_logo.png" width="205" height="100" alt="tacker.org" />
				<?php elseif(D_CODERBYHEARTDE): ?>
				<img src="<?php bloginfo('template_directory'); ?>/coderbyheart.de/coder-by-heart.jpg" width="300" height="67" alt="coder::by(&#9829;);" title="coder::by(&#9829;);" />
				<?php endif; ?>
			</a>
        </h1>
