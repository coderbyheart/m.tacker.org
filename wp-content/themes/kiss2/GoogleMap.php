<?php
/*
Template Name: Google Map
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

    ini_set('include_path', '/var/www/projects.tacker.org/htdoc/Google_Map/:' . ini_get('include_path'));
    require_once 'Google/Map.php';
    $Map = new Google_Map('ABQIAAAAKyAGN22UGBg-i1P7zOS9ehT86CnAuGp1oclWUmJCbnN4JWaa3xTI2qOjnN5Ek7lAt3h5pM3tbfDtbQ');
    $Map->addControl(GOOGLE_MAP_CONTROL_SCALE);
    $Map->addControl(GOOGLE_MAP_CONTROL_LARGE_MAP);
    $Map->addControl(GOOGLE_MAP_CONTROL_MAP_TYPE);
    $Map->map_type = GOOGLE_MAP_HYBRID_MAP;
    $Map->latitude = '50.095019';
    $Map->longitude = '8.762163';
    $Map->zoom_level = 15;
    $Map->addMarker(50.095019, 8.762163, 'Hier wohne ich');
    $Map->addMarker(50.08223267743806, 8.759300708770752, 'Garten');
    $Map->addMarker(50.08816, 8.760931, 'Ring-Center');
    $Map->addMarker(50.085009, 8.772529, 'Burger-King');
    $Map->addMarker(50.09484353211123, 8.755931854248047, 'Städtische Kliniken');
    $Map->addMarker(50.095312, 8.76724, 'Albert-Schweitzer-Schule');
    $Map->addMarker(50.106295057160516, 8.738422393798828, 'Kaiserlei-Kreisel');
    echo $Map->toHTML();

    echo '<ul>';
    foreach ($Map->getMarkers() as $marker) {
        echo '<li><a href="#" onclick="map.panTo(new GLatLng(' . $marker['latitude'] . ', ' . $marker['longitude'] . '));">' . $marker['name'] . '</a></li>';
    }
    echo '</ul>';

?>

</div>
</div>
<?php endwhile; endif; ?>

</div></div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
