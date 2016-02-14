<?php

    @session_start();

    $map = array(
        'viewlevel plugin wordpress' => '389.viewlevel-plugin-fixed.html',
        'maxdome qualität' => '540.maxdome-maxpixel.html'
    );

    $url = parse_url($_SERVER['HTTP_REFERER']);
    parse_str($url['query'], $query);
    if (!isset($query['q'])) {
        header('Location: '
        . ((isset($_SERVER['HTTPS']) and strtolower($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://')
        . $_SERVER['HTTP_HOST']
        . dirname($_SERVER['REQUEST_URI']) . '/', true, 307);
        return;
    }

    if (isset($map[$query['q']])) {
        header('Location: '
        . ((isset($_SERVER['HTTPS']) and strtolower($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://')
        . $_SERVER['HTTP_HOST']
        . dirname($_SERVER['REQUEST_URI']) . '/'
        . $map[$query['q']], true, 307);
        return;
    }

    $_SESSION['from_feed'] = $query['q'];
    header('Location: '
     . ((isset($_SERVER['HTTPS']) and strtolower($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://')
     . $_SERVER['HTTP_HOST']
     . dirname($_SERVER['REQUEST_URI']) . '/'
     . '?s=' . urlencode($query['q']), true, 307);

?>