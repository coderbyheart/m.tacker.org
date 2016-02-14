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

    /**
    * Embed a Picasa Web album in your website
    *
    * @package AlbumEmbed
    * @author Markus Tacker <m@tacker.org>
    * @version $Id: example.php 280 2007-04-06 12:59:13Z m $
    */

    require_once 'AlbumEmbed.php';
    require_once 'HTML/Page2.php';

    $rss_url = 'http://picasaweb.google.com/data/feed/base/user/m.tacker.org/albumid/5002578314588389393?category=photo&alt=rss';
    $rss2_url = 'http://picasaweb.google.com/data/feed/base/user/m.tacker.org/albumid/4965635415607345169?category=photo&alt=rss&hl=en_US';

    $HTML = new HTML_Page2('doctype="XHTML 1.1"');
    // The prototype library is required
    $HTML->addScript('prototype-1.4.0.js');
    $HTML->addStyleDeclaration('
        body { font-size: 0.6em; font-family: Verdana, Arial, Helvetica, sans-serif; line-height: 1.5em; color: #666666; margin: 20px; width: 550px; }
        a { color: #ff0033; }
        /* The AlbumEmbed code is plain. You may easily apply your own styles. */
        div.albumembed { float: right; clear: right; margin: 0 0 10px 10px; text-align: center; border: 1px solid #aaa; }
        div.albumembed div.box { margin: 12px 0 0 0; }
        div.albumembed img { border: 1px solid #666666; background-color: #000; padding: 0; margin: 0; }
        div.albumembed p { margin: 0 0 12px 0; clear: both; }
        div.albumembed p.caption { margin: 12px 12px 0 12px; font-style: italic; clear: both; }
        div.albumembed ul { list-style: none; margin: 0; padding: 0; }
        div.albumembed li { margin: 0; padding: 0; float: left; }
        div.albumembed li.prev, div.albumembed li.next { color: #A00000; cursor: pointer; font-weight: bold; width: 12px; margin: 0; padding: 0;  }
        div.albumembed li.prev:hover, div.albumembed li.next:hover { background-color: #f0f0f0; }
        div.albumembed-gallery2 div.portrait { width: 214px; }
        div.albumembed-gallery2 div.portrait li.prev { height: 252px; line-height: 252px; }
        div.albumembed-gallery2 div.portrait li.next { height: 252px; line-height: 252px; }
        div.albumembed-gallery2 div.portrait img { width: 188px; height: 250px; }
        div.albumembed-gallery2 div.landscape { width: 276px; }
        div.albumembed-gallery2 div.landscape li.prev { height: 190px; line-height: 190px; }
        div.albumembed-gallery2 div.landscape li.next { height: 190px; line-height: 190px; }
        div.albumembed-gallery2 div.landscape img { width: 250px; height: 188px; }
        div.albumembed-picasa div.portrait { width: 214px; }
        div.albumembed-picasa div.portrait li.prev { height: 252px; line-height: 252px; }
        div.albumembed-picasa div.portrait li.next { height: 252px; line-height: 252px; }
        div.albumembed-picasa div.portrait img { width: 188px; height: 250px; }
        div.albumembed-picasa div.landscape { width: 314px; }
        div.albumembed-picasa div.landscape li.prev { height: 218px; line-height: 218px; }
        div.albumembed-picasa div.landscape li.next { height: 218px; line-height: 218px; }
        div.albumembed-picasa div.landscape img { width: 288px; height: 216px; }
    ');

    // Add some dummy-content
    $dummy_content = '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>';

    $HTML->addBodyContent('<h1>AlbumEmbed Demo</h1>');
    $HTML->addBodyContent(AlbumEmbed::getContainer($rss_url));
    $HTML->addBodyContent($dummy_content);
    $HTML->addBodyContent($dummy_content);
    $HTML->addBodyContent(AlbumEmbed::getContainer($rss2_url));
    $HTML->addBodyContent($dummy_content);
    $HTML->addBodyContent($dummy_content);
    $HTML->display();

?>