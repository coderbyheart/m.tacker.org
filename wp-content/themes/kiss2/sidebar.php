<div id="sidebar">

<div class="side-sec pages">
<h3>Navigation</h3>
<ul>
<li><a href="https://m.tacker.org/">Startseite</a></li>
<?php wp_list_pages('title_li='); ?>
<li><a href="https://m.tacker.org/0.html">Homepage (veraltet)</a></li>
</ul>
</div>

<div class="side-sec categories">
<h3>Kategorien</h3>
<ul>
<?php /* wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); */ ?>
<?php wp_list_categories(); ?>
</ul>
</div>

<div class="side-sec subscribe">
<h3>Abonnieren</h3>
<ul>
<li><a href="feed:<?php bloginfo('rss2_url'); ?>">Einträge (RSS)</a></li>
<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>">Kommentare (RSS)</a></li>
</ul>
</div>

<div class="side-sec search">
<h3>Suche</h3>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
</div>

<div class="side-sec links">
<h3>Links</h3>
<ul>
<?php get_links(11, '<li>', '</li>', ' ', false, 'name', false); ?>
</ul>
<h3>Andere Blogs</h3>
<ul>
<?php get_links(12, '<li>', '</li>', ' ', false, 'name', false); ?>
</ul>
</div>

<div class="side-sec misc">
    <h3>Kontakt</h3>
    <div id="hcard-Markus-Tacker" class="vcard">
        <a class="url fn" href="https://m.tacker.org/">Markus Tacker</a>
        <div class="adr">
            <div class="street-address">Senefelderstr. 63</div>
            <span class="postal-code">63069</span> <span class="locality">Offenbach</span>
        </div>
        <div class="tel">0 69 83 83 57 73</div>
    </div>
</div>

<div class="side-sec misc">
<h3>Meta</h3>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li>Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>: Validate with <a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">W3.org</a> or <a href="http://www.validome.org/referer" title="This page validates as XHTML 1.0 Transitional">validome.org</a></li>
<li><a href="http://jigsaw.w3.org/css-validator/check/referer" title="This page has a valid cscading style sheet">Valid <abbr title="Cascading style sheet">CSS</abbr></a></li>
<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
<?php wp_meta(); ?>
</ul>
</div>

<?php /*
<div class="side-sec archives">
<h3>Archiv</h3>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</div>
*/ ?>

</div>
