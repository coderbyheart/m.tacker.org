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

    /**
    * Embed a Picasa Web album in your website
    *
    * @package AlbumEmbed
    * @author Markus Tacker <m@tacker.org>
    * @version $Id: Picasaembed.php 145 2007-02-05 20:38:17Z m $
    */
    class AlbumEmbed_Picasa extends AlbumEmbed
    {
        protected function getImagesFromRss()
        {
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
            return $images;
        }
    }

?>