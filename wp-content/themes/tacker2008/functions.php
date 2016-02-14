<?php

	require_once 'svnrev.php';
	define('THEME_IMAGE_DIR', get_bloginfo('template_directory') . '/i');
	define('FOTO_URL', 'https://s3.eu-central-1.amazonaws.com/m.tacker.org-blog/fotos/550/' );
	define('DEVELOPER', isset($_GET['DEVELOPERON']));

	if ($_SERVER['HTTP_HOST']==='m.tacker.org') {
		define('D_MTACKERORG', true);
	} elseif ($_SERVER['HTTP_HOST']==='coderbyheart.de') {
		define('D_CODERBYHEARTDE', true);
	} else {
		define('D_OTHERDOMAIN', true);
	}
	if (!defined('D_MTACKERORG')) define('D_MTACKERORG', false);
	if (!defined('D_CODERBYHEARTDE')) define('D_CODERBYHEARTDE', false);
	if (!defined('D_OTHERDOMAIN')) define('D_OTHERDOMAIN', false);

	$gdomain = 'tacker2008';
	textdomain( $gdomain );
	bindtextdomain( $gdomain, dirname( __FILE__ ) . '/locale' );
	bind_textdomain_codeset($gdomain, 'UTF-8');
	setlocale( LC_MESSAGES, array( 'de_DE.utf8', 'de_DE', 'de' ) );

	if(DEVELOPER) {
		ini_set('display_errors', 1);
		error_reporting(E_ALL ^ E_NOTICE);
	}

    require_once 'Date.php';
    require_once 'Date/Span.php';
    $DateNow = new Date();

    require_once 'Cache/Lite.php';

    function getNiceSpan( $ts )
    {
        global $DateNow;
        $Date = new Date($ts);
        if ( $DateNow->getYear() != $Date->getYear() ) return sprintf(ngettext('last year', '%d years ago', round($DateNow->getYear()-$Date->getYear())), round($DateNow->getYear()-$Date->getYear()));
        if ( $DateNow->getMonth() != $Date->getMonth() ) return sprintf(ngettext('last month', '%d months ago', round($DateNow->getMonth()-$Date->getMonth())), round($DateNow->getMonth()-$Date->getMonth()));
        if ( $DateNow->getWeekOfYear() != $Date->getWeekOfYear() ) {
			if ( $DateNow->getWeekOfYear() < $Date->getWeekOfYear() ) {
				return sprintf(ngettext('last week', '%d weeks ago', round(52+$DateNow->getWeekOfYear()-$Date->getWeekOfYear())), round(52+$DateNow->getWeekOfYear()-$Date->getWeekOfYear()));
			} else {
				return sprintf(ngettext('last week', '%d weeks ago', round($DateNow->getWeekOfYear()-$Date->getWeekOfYear())), round($DateNow->getWeekOfYear()-$Date->getWeekOfYear()));
			}
		}
        $DateDiff = new Date_Span;
        $DateDiff->setFromDateDiff($DateNow, $Date);
        $days = $DateDiff->toDays();
        if (round($days) > 6 ) return sprintf(ngettext('last week', '%d weeks ago', round($days/7)), round($days/7));
        if (round($days) == 1) return _('yesterday');
        if (round($days) == 0) return _('today');
        return sprintf(ngettext('%d day ago', '%d days ago', round($days)), round($days));
    }

	function TanjaCounter()
	{
		$now = new DateTime();
		$then = new DateTime();
		$then->setTime( 0, 0, 0 );
		$then->setDate( 1999, 1, 3 );
		$diffyears = $now->format( 'Y' ) - $then->format( 'Y' );
		$diffmonths = $now->format( 'm' ) - $then->format( 'm' );
		$diffdays = $now->format( 'd' ) - $then->format( 'd' );
		$return = '';
		if ( $diffyears > 0 ) $return .= $diffyears . ngettext( ' Jahr', ' Jahre', $diffyears ) . ' ';
		if ( $diffmonths > 0 ) $return .= $diffmonths . ngettext( ' Monat', ' Monate', $diffmonths ) . ' ';
		if ( $diffdays > 0 ) $return .= $diffdays . ngettext( ' Tag', ' Tage', $diffdays ) . ' ';
		return $return;
	}

	define(FLICKR_API_KEY, '7b1da07cfec07256b6ab6b0c9ec7a3eb');
	$FlickrCache = new Cache_Lite(array(
		'cacheDir' => dirname(__FILE__) . '/cache/',
    	'lifeTime' => 86400,
    	'automaticSerialization' => true,
    	'pearErrorMode' => CACHE_LITE_ERROR_DIE
	));

	function getFlickrPhoto($id)
	{
		global $FlickrCache;
		$id = trim($id);
		if (!$info = $FlickrCache->get($id)) {
			$info = new stdClass;
			if (!$infoResponse = flickrApiRequest('flickr.photos.getInfo', array('photo_id' => $id))) return false;
			if (!$sizeResponse = flickrApiRequest('flickr.photos.getSizes', array('photo_id' => $id))) return false;
			$info->title = $infoResponse->photo->title->_content;
			$info->url = $infoResponse->photo->urls->url[0]->_content;
			$info->sizes = $sizeResponse->sizes->size;
			$FlickrCache->save($info, $id);
		}
		return $info;
	}

	function getFlickrPhotoset($id, $itemsPerPage = null)
	{
		if ($itemsPerPage == null) $itemsPerPage = 50;
		global $FlickrCache;
		$id = trim($id);
		if (!$setInfo = $FlickrCache->get('set-' . $id)) {
			$setInfo = new stdClass;
			if (!$setInfoResponse = flickrApiRequest('flickr.photosets.getInfo', array('photoset_id' => $id))) return false;
			if (!$setPhotoResponse = flickrApiRequest('flickr.photosets.getPhotos', array('photoset_id' => $id, 'per_page' => $itemsPerPage, 'extras' => 'url_l,url_sq,geo'))) return false;
			$setInfo = $setInfoResponse->photoset;
			$setInfo->photo = $setPhotoResponse->photoset->photo;
			$FlickrCache->save($setInfo, 'set-' . $id);
		}
		return $setInfo;
	}

	function flickrApiRequest($method, $params)
	{
		$req = 'http://api.flickr.com/services/rest/?'
		. http_build_query(array_merge($params, array(
			'method' => $method,
			'format' => 'json',
			'api_key' => FLICKR_API_KEY
		)));
		$response = json_decode(substr(file_get_contents($req), 14, -1));
		if ($response->stat !== 'ok') return false;
		return $response;
	}

	function printFlickrMainPhoto($pictureId)
	{
		$photo = getFlickrPhoto($pictureId);
		
		$medium = false;
		$large = false;
		$original = false;
		foreach($photo->sizes as $size) {
			switch ($size->label) {
			case 'Medium':
				$medium = $size;
				break;
			case 'Large':
				$large = $size;
				break;
			case 'Original':
				case 'Large':
				$original = $size;
				break;
			}
		}
		if (!$large) $large = $original;
		if ($medium && $large) {
			$landscape = $medium->width / $medium->height > 1;
			?><p><a href="<?php echo $large->source; ?>" rel="lightbox[fotos]" title="<?php echo $photo->title; ?>" class="fotolink">
				<img src="<?php echo $landscape ? $medium->source : $large->source; ?>" alt="<?php echo $photo->title; ?>" longdesc="<?php echo $photo->url; ?>" class="full" width="550" height="<?php echo round((550 / $medium->width * $medium->height)); ?>" />
				<span class="fotoinfo noprint"><?php echo _( 'click for full view' ); ?></span>
			</a></p><?php
		}
	}

	function printFlickrPhotoList($setId, $hidePrimary = false, $itemsPerPage = null)
	{
		$set = getFlickrPhotoset($setId, $itemsPerPage);
		?>
		<ul class="flickrlist">
		<?php
		$n = 0;
		foreach($set->photo as $photo):
		if ($hidePrimary && $photo->id === $set->primary) continue;
		?>
		<li class="polaroid">
			<a href="<?php echo $photo->url_l; ?>" title="<?php echo $photo->title; ?>" rel="lightbox[fotos]">
				<img src="<?php echo $photo->url_sq; ?>" alt="<?php echo $photo->title; ?>" width="75" height="75" longdesc="http://www.flickr.com/photos/tacker/<?php echo $photo->id; ?>/in/set-<?php echo $setId; ?>/" />
			</a>
		</li>
		<?php endforeach; ?>
		<li class="setinfo">
			from the set <a href="http://www.flickr.com/photos/tacker/sets/<?php echo $setId; ?>/" rel="me">&bdquo;<?php echo $set->title->_content; ?>&ldquo;</a> on <a href="http://www.flickr.com/photos/tacker/" class="icon iflickr" rel="me">flickr</a>
		</li>
		</ul>
		<?php
	}
