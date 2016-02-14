<?php

    // +----------------------------------------------------------------------+
    // | Embed a Web album in your website                                    |
    // +----------------------------------------------------------------------+
    // | Copyright (c) Markus Tacker <m@tacker.org>                           |
    // +----------------------------------------------------------------------+
    // | This library is free software; you can redistribute it and/or        |
    // | modify it under the terms of the GNU Lesser General Public           |
    // | License as published by the Free Software Foundation; either         |
    // | version 2.1 of the License, or (at your option) any later version.   |
    // |                                                                      |
    // | This library is distributed in the hope that it will be useful,      |
    // | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
    // | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU    |
    // | Lesser General Public License for more details.                      |
    // |                                                                      |
    // | You should have received a copy of the GNU Lesser General Public     |
    // | License along with this library; if not, write to the                |
    // | Free Software Foundation, Inc.                                       |
    // | 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA               |
    // +----------------------------------------------------------------------+

    // Some PEAR packages are required
    // Installation is out of the scope of this script. Please refer to
    // http://pear.php.net
    // XML_RSS must be version >=0.9.10
    require_once 'Cache/Lite.php';
    require_once 'XML/RSS.php';
    require_once 'AlbumEmbed/Exception.php';

    /**
    * Embed a Web album in your website
    *
    * @package AlbumEmbed
    * @author Markus Tacker <m@tacker.org>
    * @version $Id: AlbumEmbed.php 280 2007-04-06 12:59:13Z m $
    */
    abstract class AlbumEmbed
    {
        const ID_NEXT = 1;
        const ID_PREV = 2;
        const ID_RESPONSE = 3;

        /**
        * Options for PEAR::Cache_Lite
        *
        * @see http://pear.php.net/manual/en/package.caching.cache-lite.cache-lite.cache-lite.php
        */
        static $cache_options = array(
            'lifeTime' => 86400,
            'automaticSerialization' => true,
            'errorHandlingAPIBreak' => true,
        );

        protected $rss_url;
        protected $images;

        /**
        * Enable preloading of images
        *
        * @var bool
        */
        static $preload = true;

        /**
        * The location of this file, may be relative, absolute or even URL
        *
        * @var string
        */
        static $location;

        /**
        * Factory
        *
        * @param RSS url
        */
        static function factory($rss_url)
        {
            $class = false;
            if (preg_match('%^http://picasaweb\.google\.com/data/feed/base/user/%i', $rss_url)) {
                $class = 'Picasa';
            } elseif (stristr($rss_url, 'main.php?g2_view=rss.SimpleRender')) {
                $class = 'Gallery2';
            }
            if (!$class) {
                throw new AlbumEmbed_Exception('Invalid RSS feed.');
            }
            $class = __CLASS__ . '_' . $class;
            require_once $file = dirname(__FILE__) . '/' . str_replace('_', '/', $class) . '.php';
            return new $class($rss_url);
        }

        /**
        * Constructor
        */
        protected function __construct($rss_url)
        {
            $this->rss_url = $rss_url;
            if (empty(self::$location)) self::$location = ((isset($_SERVER['HTTPS']) and strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . basename(__FILE__);
        }

        abstract protected function getImagesFromRss();

        final protected function getImages()
        {
            if (!is_null($this->images)) return $this->images;
            self::$cache_options['cacheDir'] = dirname(__FILE__) . '/cache/';
            $Cache = new Cache_Lite(self::$cache_options);
            if ($images = $Cache->get($this->rss_url, 'images')) {
                $this->images = $images;
                return $images;
            }
            $images = $this->getImagesFromRss();

            if (ini_get('allow_url_fopen')) {
                foreach ($images as $k => $image) {
                    if (preg_match('/src="([^"]+)"/i', $image['img_html'], $match)) {
                        // Cache Image
                        $req = parse_url($match[1]);
                        $image_cache = '/cache/images/' . md5($match[1]) . '.' . substr(basename($req['path']), strrpos(basename($req['path']), '.') + 1);
                        $local_image_file = dirname(__FILE__) . $image_cache;
                        if (!file_exists($local_image_file)) {
                            copy($match[1], $local_image_file);
                        }
                        $images[$k]['img_html'] = str_replace($match[0], 'src="' . dirname(self::$location) . $image_cache . '"', $images[$k]['img_html']);
                        // Fix missin alt attributes
                        if (!stristr( $images[$k]['img_html'], 'alt=')) {
                            $images[$k]['img_html'] = str_replace('src=', 'alt="" src=', $images[$k]['img_html']);
                        }
                        // Calculate orientation
                        $image_size = getimagesize($local_image_file);
                        $images[$k]['orientation'] = ($image_size[0] >= $image_size[1]) ? 'landscape' : 'portrait';
                    }
                }
            }
            if (empty($images)) throw new AlbumEmbed_Exception('No images found.');
            $result = $Cache->save($images, $this->rss_url, 'images');
            if ($result !== true) {
                throw new AlbumEmbed_Exception('Cache error: ' . $result->getMessage());
            }
            return $images;
        }

        function getItemCode($current_item = 0, $static = false, $class = null)
        {
            if (is_null($class)) $class = 'albumembed';
            $class .= ' ' . strtolower(str_replace('_', '-', get_class($this)));
            try {
                $images = $this->getImages();

                $n_items = count($images);
                if (!isset($images[$current_item])) {
                    $current_item = count($images) - 1;
                }
                $image = $images[$current_item];
                $id = $this->getId();

                $url = parse_url($_SERVER['REQUEST_URI']);

                if (isset($url['query'])) {
                    parse_str($url['query'], $query);
                    if (isset($query[$id])) {
                        unset($query[$id]);
                    }
                } else {
                    $query = array();
                }
                $query[$id] = '';
                $params = array();
                foreach ($query as $k => $v) {
                    $params[] = $k . '=' . $v;
                }
                $req = '?' . join('&amp;', $params);

                // Create Div
                $return = '';
                if ($static) $return = '<div class="' . $class. '" id="' . $id . '">';
                $return .= '<div class="box ' . $image['orientation'] . '"><ul><li class="prev" id="' . $this->getId(self::ID_PREV) . '">';
                if ($current_item > 0) {
                    $return .= ($static) ? '<a href="' . $req . ($current_item - 1) . '#' . $id . '">' : '';
                    $return .= '&lt;';
                    $return .= ($static) ? '</a>' : '';
                }
                $return .= '</li>'
                . '<li class="foto"><a href="' . $image['link'] . '">' . (($image['img_html']) ? $image['img_html'] : 'No image.') . '</a></li>'
                . '<li class="next" id="' . $this->getId(self::ID_NEXT) . '">';
                if ($current_item < $n_items - 1) {
                    $return .= ($static) ? '<a href="' . $req . ($current_item + 1) . '#' . $id . '">' : '';
                    $return .= '&gt;';
                    $return .= ($static) ? '</a>' : '';
                }
                $return .= '</li></ul>'
                . '<p class="caption">' . (($image['title']) ? htmlspecialchars($image['title']) : '&nbsp;') . '</p><p class="info">' . ($current_item + 1) . ' / ' . $n_items . '</p>'
                . '</div>';
                if ($static) $return .= "</div>\n";
                return $return;
            } catch (AlbumEmbed_Exception $E) {
                return '<p>' . $E->getMessage() . '</p>';
            }
        }

        /**
        * Returns the ID for the current embedded gallery
        *
        * @param int ID type
        * @return string
        */
        function getId($type = null)
        {
            $return = 'albumembed_' . md5($this->rss_url);
            switch ($type) {
            case self::ID_NEXT:
                $return .= '_next';
                break;
            case self::ID_PREV:
                $return .= '_prev';
                break;
            case self::ID_RESPONSE:
                $return .= 'Response';
                break;
            }
            return $return;
        }

        /**
        * Returns the required javascript code
        */
        function getJsCode()
        {
            try {
                $return = '<script type="text/javascript"><!--//--><![CDATA[//><!--' . "\n"
                . 'function ' . $this->getId(self::ID_RESPONSE) . " (originalRequest) {"
                . '    $(\'' . $this->getId() . "').innerHTML = originalRequest.responseText;"
                . "    if (\$('". $this->getId(self::ID_NEXT) . "')) { \$('". $this->getId(self::ID_NEXT) . "').onclick = function () {"
                . $this->getActionJs('+')
                . "    }};"
                . "    if (\$('". $this->getId(self::ID_PREV) . "')) { \$('". $this->getId(self::ID_PREV) . "').onclick = function () {"
                . $this->getActionJs('-')
                . "    }};"
                . "};"
                . "function WindowOnload(f) {" // See http://blog.firetree.net/2005/07/17/javascript-onload/
                . "    var prev = window.onload;"
                . "    window.onload=function() { if(prev) prev(); f(); };"
                . "};"
                . "WindowOnload(function () {"
                . $this->getActionJs();
                if (self::$preload) {
                    $return .= "var ImagePreload = new Array();";
                    $n = 0;
                    foreach ($this->getImages() as $image) {
                        $url = preg_match('/src="([^"]+)"/iU', $image['img_html'], $match);
                        if (!isset($match[1])) continue;
                        $return .= "ImagePreload[$n] = new Image();"
                        . "ImagePreload[$n].src = '{$match[1]}';";
                        $n++;
                    }
                }
                $return .= "});\n";
                $return .= "//--><!]]></script>\n";
                return $return;
            } catch (AlbumEmbed_Exception $E) {
                return '';
            }
        }

        protected function getActionJs($item = 0)
        {
            return "var request= { albumembed__rss_url: '" . $this->rss_url . "',albumembed__item: '" . $item . "',albumembed__location: '" . self::$location . "'}; "
            . "var query = \$H(request);"
            . "var GridRequest = new Ajax.Request("
            . "    '" . self::$location . "',"
            . "    {"
            . "        method: 'get',"
            . "        parameters: query.toQueryString(),"
            . "        onFailure: function() { alert(msg); },"
            . "        onComplete: function(originalResponse){" . $this->getId(self::ID_RESPONSE) . "(originalResponse);}"
            . "    }"
            . ");";
        }

        /**
        * Returns the required HTML and JS
        *
        * @return string
        * @param string optional alternate class name
        */
        static function getContainer($rss_url, $class = 'albumembed')
        {
            $Embed = AlbumEmbed::factory($rss_url);
            $id = $Embed->getId();
            $item = (isset($_REQUEST[$id])) ? (int)$_REQUEST[$id] : 0;
            @session_start();
            $_SESSION[$id] = $item;
            $return = $Embed->getItemCode($item, true, $class);
            $return .= $Embed->getJSCode();

            return "<!-- <<< \n"
            . "Embedded Album created with \n"
            . 'AlbumEmbed $Rev: 280 $ by Markus Tacker ( https://m.tacker.org/ ).' . "\n"
            . "-->\n"
            . $return
            . "<!-- >>> -->\n";
        }

        /**
        * Returns the number of items
        *
        * @return int
        */
        function countImages()
        {
            return count($this->getImages());
        }

        /**
        * Main function.
        */
        static function main()
        {
            self::ajax();
        }

        protected static function ajax()
        {
            if (isset($_REQUEST['albumembed__location'])) {
                self::$location = $_REQUEST['albumembed__location'];
            }
            if (isset($_REQUEST['albumembed__rss_url'])) {
                @session_start();
                try {
                    $Embed = AlbumEmbed::factory($_REQUEST['albumembed__rss_url']);
                    $id = $Embed->getId();
                    if (!isset($_SESSION[$id])) {
                        $_SESSION[$id] = 0;
                    }
                    if (!isset($_SESSION[$id . 'max'])) {
                        $_SESSION[$id . 'max'] = $Embed->countImages();
                    }
                    switch ($_REQUEST['albumembed__item']) {
                    case '+':
                        if ($_SESSION[$id] < $_SESSION[$id . 'max'] - 1) {
                            $_SESSION[$id]++;
                        }
                        break;
                    case '-':
                        if ($_SESSION[$id] > 0) {
                            $_SESSION[$id]--;
                        }
                        break;
                    case 0:
                        $_SESSION[$id] = 0;
                        break;
                    }
                    echo $Embed->getItemCode($_SESSION[$id]);
                } catch (AlbumEmbed_Exception $E) {
                    echo '<p>' . $E->getMessage() . '</p>';
                }
            }
        }
    }

    AlbumEmbed::main();

?>
