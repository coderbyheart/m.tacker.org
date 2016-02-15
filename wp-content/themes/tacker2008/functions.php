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
