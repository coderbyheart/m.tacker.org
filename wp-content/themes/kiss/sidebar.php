<div id="sidebar">

<div class="side-sec search">
<h3>Search</h3>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
</div>

<div class="side-sec subscribe">
<h3>Subscribe</h3>
<ul>
<li><a href="feed:<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
</ul>
</div>

<div class="side-sec categories">
<h3>Categories</h3>
<ul>
<?php /* wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); */ ?>
<?php wp_list_cats('hierarchical=1&children=1&feed=RSS'); ?>
</ul>
</div>

<!-- div class="side-sec pages">
<h3>Pages</h3>
<ul>
<?php wp_list_pages('title_li='); ?>
</ul>
</div -->


<div class="side-sec links">
<h3>Links</h3>
<ul>
<?php get_links(11, '<li>', '</li>', '<br />', FALSE, 'name', TRUE, TRUE, -1, TRUE); ?>
</ul>
<h3>Andere Blogs</h3>
<ul>
<?php get_links(12, '<li>', '</li>', '<br />', FALSE, 'name', TRUE,  TRUE, -1, TRUE); ?>
</ul>
<h3>Meine Scrapes</h3>
<ul>
<?php get_links(13, '<li>', '</li>', '<br />', FALSE, 'name', TRUE,  TRUE, -1, TRUE); ?>
</ul>
</div>





<div class="side-sec archives">
<h3>Archives</h3>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</div>

<div class="side-sec misc">
<h3>Meta</h3>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
<?php wp_meta(); ?>
</ul>
</div>

<div class="side-sec misc">
<p><?php bloginfo('name'); ?> is proudly powered by <a href="http://wordpress.org/">WordPress</a>.
</p>
</div>

</div>
