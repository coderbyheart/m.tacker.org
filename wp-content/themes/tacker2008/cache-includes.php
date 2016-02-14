<?php

	// "Caches" CSS-Files
	$svnrev = str_replace( ':', '-', exec('svnversion') );
	
	file_put_contents( 'svnrev.php', '<?php define(\'SVNREV\', \'' . $svnrev . '\');' );
	
?>