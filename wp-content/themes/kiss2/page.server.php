<?php
/*
Template Name: Server
*/
?>
<?php get_header(); ?>

<div id="main"><div id="main-1">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post" id="post-<?php the_ID(); ?>">
<h2 class="post-title"><?php the_title(); ?></h2>
<div class="post-body">
<?php the_content('<p>Read the rest of this page &raquo;</p>'); ?>
<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
<p></p>
<?php

    $servers = array(
        '/var/www/m.tacker.org/var/server/' => 'Heimserver',
    );

    foreach ($servers as $dir => $server) :

?>
<h3><a name="<?php echo str_replace(' ', '_', $server); ?>"><?php echo $server; ?></a></h3>
<dl>
    <dt>Linux Kernel</dt>
    <dd><?php echo file_get_contents($dir . 'uname.txt'); ?></dd>
    <dt>CPU</dt>
    <dd><?php
        $cpu = file($dir . 'cpu.txt');
        echo substr($cpu[4], strrpos($cpu[4], ':') + 2)
        . ' (' . round(substr($cpu[6], strrpos($cpu[6], ':') + 2)) . ' MHz'
        . ' / ' . round(substr($cpu[17], strrpos($cpu[17], ':') + 2)) . ' Bogomips)';
    ?></dd>
    <dt>PHP</dt>
    <dd><?php

        $phpv = file($dir . 'php.txt');
        $phpv = explode(' ', $phpv[0]);
        echo $phpv[1];

    ?></dd>
    <dt>mysql</dt>
    <dd><?php

        $mysqlv = file($dir . 'mysql.txt');
        $mysqlv = explode(' ', $mysqlv[0]);
        echo substr($mysqlv[5], 0, -1);

    ?></dd>
</dl>
<?php

    $meminfo = file_get_contents($dir . 'meminfo.txt');
    $meminfo = str_replace(' ', '', $meminfo);
    $meminfo = explode("\n", $meminfo);
    list($k, $ram) = explode(':', $meminfo[0]);
    list($k, $ram_free) = explode(':', $meminfo[1]);
    list($k, $swap) = explode(':', $meminfo[7]);
    list($k, $swap_free) = explode(':', $meminfo[8]);

    // mem
    echo '<table><thead><tr><td>Speicher</td><td>Größe</td><td>Verfügbar</td><td>Belegt</td></tr></thead><tbody>';
    echo '<tr><td>RAM</td><td class="right">' . round($ram / 1024) . ' MB</td><td class="right">' . round($ram_free / 1024) . ' MB</td><td class="right">' . round((1 - ($ram_free / $ram)) * 100) . ' %</td></tr>';
    echo '<tr><td>SWAP</td><td class="right">' . round($swap / 1024) . ' MB</td><td class="right">' . round($swap_free / 1024) . ' MB</td><td class="right">' . round((1 - ($swap_free / $swap)) * 100) . ' %</td></tr>';
    echo '</tbody></table>';

    // df
    $data = file($dir . 'df.txt');
    $total = 0;
    $tfree = 0;
    $drives = array();
    foreach ($data as $line) {
        $line = preg_replace('/ +/', ';', $line);
        $line = explode(';', $line);
        $total += $line[1];
        $tfree += $line[3];
        if (substr($line[5], 0, 1) == '/'
        and substr($line[5], 0, 4) != '/dev') {
            $drives[trim($line[5])] = array(
                'total' => $line[1],
                'free' => $line[3],
            );
        }
    }

    echo '<table><thead><tr><td>Mount-Punkt</td><td>Größe</td><td>Verfügbar</td><td>Belegt</td></tr></thead><tbody>';
    foreach ($drives as $mount => $info) {
        echo '<tr><td>' . $mount . '</td><td class="right">' . round($info['total'] / 1024 / 1024) . ' GB</td><td class="right">' . round($info['free'] / 1024 / 1024) . ' GB</td><td class="right">' . round((1 - ($info['free'] / $info['total'])) * 100) . ' %</td></tr>';
    }
    echo '</tbody><tfoot><tr><td>Gesamt</td><td class="right">' . round($total / 1024 / 1024) . ' GB</td><td class="right">' . round($tfree / 1024 / 1024) . ' GB</td><td class="right">' . round((1 - ($tfree / $total)) * 100) . ' %</td></tr></tfoot></table>';

    endforeach;

?>

</div>
</div>
<?php endwhile; endif; ?>

</div></div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>