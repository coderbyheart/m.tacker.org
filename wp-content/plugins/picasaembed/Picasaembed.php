<?php

    // +----------------------------------------------------------------------+
    // | Embed a Picasa Web album in your website                             |
    // +----------------------------------------------------------------------+
    // | Copyright (C) 2006 Markus Tacker <m@tacker.org>                      |
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

    /**
    * Embed a Picasa Web album in your website
    *
    * @package Picasaembed
    * @author Markus Tacker <m@tacker.org>
    * @version $Id: Picasaembed.php 145 2007-02-05 20:38:17Z m $
    */
    class Picasaembed
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
            'cacheDir' => './cache/',
            'lifeTime' => 86400,
            'automaticSerialization' => true,
        );

        protected $rss_url;

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
        * Constructor
        */
        public function __construct($rss_url)
        {
            $this->rss_url = $rss_url;
            if (empty(self::$location)) self::$location = basename(__FILE__);
        }

        protected function getImages()
        {
            $Cache = new Cache_Lite(self::$cache_options);
            if ($images = $Cache->get($this->rss_url, 'images')) return $images;
            $RSS = new XML_RSS($this->rss_url);
            $RSS->parse();
            $items = $RSS->getItems();
            $images = array();
            foreach ($items as $item) {
                // Find Thumbnail
                $img_html = false;
                if (preg_match('%<img[^>]+>%i', $item['description'], $match))  {
                    $img_html = $match[0];
                    $img_html = preg_replace('%style="[^"]+"%iU', '', $img_html); // Remove style definition
                    $img_html = preg_replace('%border="[^"]+"%iU', '', $img_html); // Remove border attribute
                }

                // Find description
                $caption = false;
                if (preg_match('%<td valign="top"><p>(.+)</p>%iU', $item['description'], $match))  {
                    $caption = strip_tags($match[1]);
                }

                $images[] = array(
                    'img_html' => $img_html,
                    'caption' => $caption,
                    'link' => $item['link'],
                    'pubdate' => $item['pubdate'],
                    'title' => $item['title'],
                );
            }
            $Cache->save($images, $this->rss_url, 'images');
            if (empty($images)) throw new Exception('No images found.');
            return $images;
        }

        function getItemCode($current_item = 0, $static = false, $class = null)
        {
            if (is_null($class)) $class = 'picasaembed';
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
            if ($static) $return = '<div class="' . $class. '" id="' . $id . '">';
            $return .= '    <dl>'
            . '        <dt><a href="' . $image['link'] . '">' . (($image['img_html']) ? $image['img_html'] : 'No image.') . '</a></dt>'
            . '        <dd>' . (($image['caption']) ? htmlspecialchars($image['caption']) : '&nbsp;') . '</dd>'
            . '    </dl>';
            $return .= '    <p>'
            . '<span class="prev" id="' . $this->getId(self::ID_PREV) . '">';
            if ($current_item > 0) {
                $return .= ($static) ? '<a href="' . $req . ($current_item - 1) . '#' . $id . '">' : '';
                $return .= '&laquo;';
                $return .= ($static) ? '</a>' : '';
            }
            $return .= '</span>'
            . '<span class="info">' . ($current_item + 1) . ' / ' . $n_items . '</span>'
            . '<span class="next" id="' . $this->getId(self::ID_NEXT) . '">';
            if ($current_item < $n_items - 1) {
                $return .= ($static) ? '<a href="' . $req . ($current_item + 1) . '#' . $id . '">' : '';
                $return .= '&raquo;';
                $return .= ($static) ? '</a>' : '';
            }
            $return .= '</span></p>';
            if ($static) $return .= '</div>';

            return $return;
        }

        /**
        * Returns the ID for the current embedded gallery
        *
        * @param int ID type
        * @return string
        */
        function getId($type = null)
        {
            $return = 'picasaembed_' . md5($this->rss_url);
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
            $return = '<script type="text/javascript"><!--//--><![CDATA[//><!--' . "\n"
            . 'function ' . $this->getId(self::ID_RESPONSE) . " (originalRequest) {"
            . "    try {"
            . "        eval(originalRequest.responseText);"
            . "    } catch(e) {"
            . '        $(\'' . $this->getId() . "').innerHTML = originalRequest.responseText;"
            . "    };"
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
        }

        protected function getActionJs($item = 0)
        {
            return "eval('var request= { picasaembed__rss_url: \'" . $this->rss_url . "\',picasaembed__item: \'" . $item . "\'}');"
            . "var query = \$H(request);"
            . "var GridRequest = new Ajax.Request("
            . "    '" . self::$location . "',"
            . "    {"
            . "        method: 'get',"
            . "        parameters: query.toQueryString(),"
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
        public static function getContainer($rss_url, $class = 'picasaembed')
        {
            $Embed = new Picasaembed($rss_url);
            $id = $Embed->getId();
            $item = (isset($_REQUEST[$id])) ? (int)$_REQUEST[$id] : 0;
            @session_start();
            $_SESSION[$id] = $item;
            $return = $Embed->getItemCode($item, true, $class);
            $return .= $Embed->getJSCode();

            return "<!-- <<< \n"
            . "Embedded Picasaca Gallery created with \n"
            . 'Picasaembed $Rev: 145 $ by Markus Tacker ( https://m.tacker.org/ ).' . "\n"
            . "-->\n"
            . $return
            . "<!-- >>> -->\n";
        }

        /**
        * Main function.
        */
        public static function main()
        {
            self::ajax();
        }

        protected static function ajax()
        {
            if (isset($_REQUEST['picasaembed__rss_url'])) {
                @session_start();
                try {
                    $Embed = new Picasaembed($_REQUEST['picasaembed__rss_url']);
                    $id = $Embed->getId();
                    if (!isset($_SESSION[$id])) {
                        $_SESSION[$id] = 0;
                    }
                    switch ($_REQUEST['picasaembed__item']) {
                    case '+':
                        $_SESSION[$id]++;
                        break;
                    case '-':
                        $_SESSION[$id]--;
                        break;
                    case 0:
                        $_SESSION[$id] = 0;
                        break;
                    }
                    echo $Embed->getItemCode($_SESSION[$id]);
                } catch (Exception $E) {
                    echo '<p>' . $E->getMessage() . '</p>';
                }
            }
        }
    }

    Picasaembed::main();

?>
