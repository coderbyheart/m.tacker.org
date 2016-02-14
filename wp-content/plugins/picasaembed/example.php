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
    * @package Picasaembed
    * @author Markus Tacker <m@tacker.org>
    * @version $Id: example.php 130 2006-11-30 11:54:13Z m $
    */

    require_once 'Picasaembed.php';
    require_once 'HTML/Page2.php';

    $rss_url = 'http://picasaweb.google.com/data/feed/base/user/m.tacker.org/albumid/5002578314588389393?category=photo&alt=rss';
    $rss2_url = 'http://picasaweb.google.com/data/feed/base/user/m.tacker.org/albumid/4965635415607345169?category=photo&alt=rss&hl=en_US';

    $HTML = new HTML_Page2('doctype="XHTML 1.1"');
    // The prototype library is required
    $HTML->addScript('prototype-1.4.0.js');
    $HTML->addStyleDeclaration('
        body { font-size: 0.6em; font-family: Verdana, Arial, Helvetica, sans-serif; line-height: 1.5em; color: #666666; margin: 20px; width: 550px; }
        a { color: #ff0033; }
        /* The Picasaembed code is plain. You may easily apply your own styles. */
        div.picasaembed { float: right; margin: 0 0 10px 10px; text-align: center; border: 1px solid #aaa; }
        div.picasaembed dl { margin: 12px 12px 0 12px; }
        div.picasaembed dd { margin: 0; font-style: italic; }
        div.picasaembed img { border: 1px solid #666666; width: 288px; background-color: #000; }
        div.picasaembed p { margin: 0 0 12px 0; }
        div.picasaembed span.prev, div.picasaembed span.next { color: #ff0033; text-decoration: underline; cursor: pointer; }
        div.picasaembed span { display: block; width: 33%; float: left; height: 24px; }
    ');

    // Add some dummy-content
    $dummy_content = '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>';

    $HTML->addBodyContent('<h1>Picasaembed Demo</h1>');
    $HTML->addBodyContent(Picasaembed::getContainer($rss_url));
    $HTML->addBodyContent($dummy_content);
    $HTML->addBodyContent($dummy_content);
    $HTML->addBodyContent(Picasaembed::getContainer($rss2_url));
    $HTML->addBodyContent($dummy_content);
    $HTML->addBodyContent($dummy_content);
    $HTML->display();

?>