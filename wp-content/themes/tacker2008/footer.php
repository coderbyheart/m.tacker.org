        <div id="quer" class="noprint">
            <div id="boxarea">
                <div class="box">
                    <?php if (is_single() || is_page()): ?>
                	<!-- Navigation -->
                	<h3><?php echo _('Navigation'); ?></h3>

                    <ul>
                        <li><a href="https://m.tacker.org/" rel="bookmark" class="block">Startseite</a></li>
                        <li><a href="http://markusstudiert.de/" rel="me" class="block">Markus studiert!</a></li>
                        <li><a href="https://m.tacker.org/datenschutz" class="block">Datenschutz</a></li>
                        <li><a href="https://m.tacker.org/hinweise" class="block">Hinweise</a></li>
                        <li><a href="https://coderbyheart.com/" class="block" rel="author">Kontakt</a></li>
                    </ul>
                    <!-- Tasg -->
                    <h3><?php echo _('Tags'); ?></h3>
                    <div id="tagcloud-quer">
                    <?php wp_tag_cloud(''); ?>
                    </div>
                    <?php endif; /* of  (is_single()): */ ?>

               <h3><?php echo _('Tanja-Counter'); ?></h3>

					<p class="icon iheart"><a href="https://m.tacker.org/1706.10-jahre.html"><?php echo TanjaCounter(); ?></a></p>

                    <!-- Suche -->
                    <div id="sitesearch">
                        <h3><?php echo _('Search'); ?></h3>
	                    <form method="get" action="<?php echo get_settings('home'); ?>/">
                        	<p>
                            	<input type="text" name="s" id="sbi" /> <button type="submit"><?php echo _('search'); ?></button>
                            </p>
	                    </form>
                    </div>

                    <!-- Meta -->
                    <h3><?php echo _('Meta'); ?></h3>

                    <ul>

						<li class="icon irss"><a href="<?php bloginfo('rss2_url'); ?>">RSS Feed</a></li>

                        <li>Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>: Validate with
                        <a href="http://validator.w3.org/check/referer" title=
                        "This page validates as XHTML 1.0 Transitional">W3.org</a> or <a href=
                        "http://www.validome.org/referer" title=
                        "This page validates as XHTML 1.0 Transitional">validome.org</a>
                        </li>

                        <li>
                            <a href="http://jigsaw.w3.org/css-validator/check/referer" title=
                            "This page has a valid cscading style sheet">Valid <abbr title=
                            "Cascading style sheet">CSS</abbr></a>
                        </li>

                        <li>Powered by <a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a> </li>

                        <li>Icons based on Silk icons by <a href="http://www.famfamfam.com/">FAMFAMFAM</a></li>

                        <li>Font: AUdimat by <a href="http://www.smeltery.net/">SMeltery</a></li>
                    </ul>

                </div>

                <div class="box">

					<!-- Kategorien -->
					<h3><?php echo _('Categories'); ?></h3>

					<ul>
						<?php wp_list_categories('title_li=&hierarchical=1'); ?>
					</ul>

                </div>

                <div class="box">

					<?php if(D_MTACKERORG): ?>
					<!-- Andere Blogs -->
                    <h3><?php echo _('Other Blogs'); ?></h3>
					<ul>
						<?php get_links(12, '<li>', '</li>', ' ', false, 'name', false); ?>
					</ul>

                    <!-- Links -->
                    <h3><?php echo _('Links'); ?></h3>
					<ul>
						<?php get_links(11, '<li>', '</li>', ' ', false, 'name', false); ?>
					</ul>

					<?php endif; ?>

                </div>

                <div class="clear">
                </div>
            </div>
        </div>
        <p class="print"><?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?></p>

<script type="text/javascript">
/* <![CDATA[ */
var THEME_IMAGE_DIR = '<?php echo THEME_IMAGE_DIR; ?>';
/* ]]> */
</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/mootools/mootools-1.2.4-core-yc.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/mootools/mootools-1.2.4.4-more.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/slimbox/de/js/slimbox.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/slimbox/de/js/autoload.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/webtoolkit/base64.js?<?php echo SVNREV; ?>"></script>	
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/base.js?<?php echo SVNREV; ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/fotos.js?<?php echo SVNREV; ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/swfobject/swfobject.js?<?php echo SVNREV; ?>"></script>
<?php if(class_exists('GeoMashup')): ?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo get_option( 'google_api_key' ); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/map.js?<?php echo SVNREV; ?>"></script>
<?php endif; ?>

<?php /* if(D_MTACKERORG): ?>
<div id="trigami">
   <script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://ad.trigami.com/www/delivery/ajs.php':'http://ad.trigami.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=21247");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script><noscript><a href='http://ad.trigami.com/www/delivery/ck.php?n=4ac6fa6c&amp;cb=666'><img src='http://ad.trigami.com/www/delivery/avw.php?zoneid=21247&amp;n=4ac6fa6c' alt='' /></a></noscript>
</div>
<?php endif; */ ?>
<?php if(D_CODERBYHEARTDE): ?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-227203-15");
pageTracker._trackPageview();
</script>
<?php endif; ?>
<?php if(D_MTACKERORG): ?>
<!-- Google Analytics Start -->
<script type="text/javascript"><!--//--><![CDATA[//><!--
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
//--><!]]></script>
<script type="text/javascript"><!--//--><![CDATA[//><!--
var pageTracker = _gat._getTracker("UA-227203-1");
pageTracker._initData();
pageTracker._trackPageview();
//--><!]]></script>
<!-- Google Analytics End -->
<?php endif; ?>
<?php wp_footer(); ?>
        <!-- EOF: $Id: index.html 359 2007-09-07 09:47:43Z m $ -->
    </body>
</html>
