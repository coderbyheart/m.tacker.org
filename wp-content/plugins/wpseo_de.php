<?php
/*
Plugin Name: wpSEO
Plugin URI: http://www.wpseo.org
Description: Das Plugin schreibt Bestandteile einer Blogseite, wie z.B. Titel, Description und Keywords suchmaschinenfreundlich (SEO) um. Manuelle Zuweisung pro Beitrag ist ebenfalls möglich.
Author: Sergej Müller
Version: 2.4
Author URI: http://www.ebiene.de
*/


/* Array mit Uebersetzungen */
$GLOBALS['language'] = array(
                             /* Allgemeine Werte */
                             'wp_seo_manual'                 => '<a href="http://www.wpseo.de/manual/" target="_blank">Dokumentation</a>',
                             'wp_seo_donate'                 => '<a href="http://www.wpseo.de/donate/" target="_blank">Spenden via PayPal</a>',
                             'wp_seo_imprint'                => '<a href="http://www.wpseo.de/imprint/" target="_blank">&copy; 2007 Sergej Müller</a>',
                             'wp_seo_by'                     => 'von',
                             'wp_seo_home'                   => 'Startseite',
                             'wp_seo_single'                 => 'Beitrag',
                             'wp_seo_page'                   => 'Seite',
                             'wp_seo_category'               => 'Kategorie',
                             'wp_seo_search'                 => 'Suche',
                             'wp_seo_archive'                => 'Archiv',
                             'wp_seo_tagging'                => 'Tag',
                             'wp_seo_404'                    => 'Fehler',
                             'wp_seo_title'                  => 'Titel',
                             'wp_seo_update'                 => 'Einstellungen aktualisieren',
                             'wp_seo_update_done'            => 'Aktualisierung erfolgreich',
                             'wp_seo_update_available'       => 'Neue Plugin-Version vorhanden! Download unter <a href="http://www.wpseo.de/installation/" target="_blank">www.wpseo.de/installation/</a>.',
                             'wp_seo_please_donate'          => 'Leistet wpSEO überzeugende Arbeit? Unterstützen Sie die Weiterentwicklung doch mit einer <a href="http://www.wpseo.de/donate/" target="_blank">Spende via PayPal</a>. Danke!',
                             'wp_seo_page_teaser'            => 'wpSEO Optionen',
                             
                             /* Werte fuer Titel */
                             'wp_seo_title_warning'          => 'Vor dem Aktivieren der untenstehenden Optionen, muss sichergestellt werden, dass keine &lt;title&gt;, &lt;meta name="description"&gt; und &lt;meta name="keywords"&gt; Tags in <a href="' .get_bloginfo('wpurl'). '/wp-admin/templates.php">header.php</a> vorhanden sind. Diese würden sonst mit Neugenerierungen kollidieren. Prüfen Sie daher die Kompatibilität des Blogs mit <a href="http://www.wpseo.de/manual/#compatibility_check" target="_blank">entsprechender Funktion</a>.',
                             'wp_seo_title_convert'          => 'Titel der Seiten anpassen',
                             'wp_seo_title_enable'           => 'Formatierung des Titels aktivieren',
                             'wp_seo_title_separator'        => 'Trennzeichen',
                             'wp_seo_title_separator_info'   => '(Sonderzeichen können als HTML-Code eingegeben werden, z.B. &amp;laquo; wird zu &laquo;)',
                             'wp_seo_title_description'      => 'Bezeichnung',
                             'wp_seo_title_description_info' => '(Wird nur verwendet, wenn unter "Format" als Platzhalter ausgewählt)',
                             'wp_seo_title_format'           => 'Format',
                             'wp_seo_title_format_info'      => '(Platzhalter werden ersetzt und in ausgewählter Reihenfolge dargestellt)',
                             'wp_seo_title_count'            => 'Seitennummer',
                             'wp_seo_title_count_view'       => 'Nummerierung der Seiten einschalten',
                             'wp_seo_title_count_info'       => '(Wird nur eingeblendet, wenn Seiten im Archiv, Kategorien und Suche geblättert werden)',
                             'wp_seo_title_author'           => 'Autor eines Beitrags',
                             'wp_seo_title_author_view'      => 'Den Autor des aktuellen Beitrags zeigen',
                             'wp_seo_title_author_info'      => '(Wird nur eingeblendet, wenn Beiträge oder statische Seiten aufgerufen werden)',
                             'wp_seo_title_manually'         => 'Titel manuell zuweisen',
                             'wp_seo_title_manually_on'      => 'Den Titel direkt beim Verfassen eines Beitrags eingeben können',
                             'wp_seo_title_manually_info'    => '(Zugewiesener Titel setzt die automatische Generierung außer Kraft)',
                             'wp_seo_title_manually_only'    => 'Automatische Generierung des Titels abschalten',
                             'wp_seo_title_channel'          => array(
                                                                      '%blog%'                                      => 'Blogname',
                                                                      
                                                                      '%blog% %clip% %area%'                        => 'Blogname Trennzeichen Bezeichnung',
                                                                      '%blog% %clip% %title%'                       => 'Blogname Trennzeichen Titel',
                                                                      '%blog% %clip% %tag%'                         => 'Blogname Trennzeichen Tag',
                                                                      '%blog% %clip% %area% %clip% %title%'         => 'Blogname Trennzeichen Bezeichnung Trennzeichen Titel',
                                                                      '%blog% %clip% %area% %clip% %tag%'           => 'Blogname Trennzeichen Bezeichnung Trennzeichen Tag',
                                                                      '%blog% %clip% %keywords% %clip% %title%'     => 'Blogname Trennzeichen Keywords Trennzeichen Titel',
                                                                      '%blog% %clip% %category% %clip% %title%'     => 'Blogname Trennzeichen Kategorie Trennzeichen Titel',
                                                                      '%blog% %clip% %title% %clip% %keywords%'     => 'Blogname Trennzeichen Titel Trennzeichen Keywords',
                                                                      '%blog% %clip% %title% %clip% %category%'     => 'Blogname Trennzeichen Titel Trennzeichen Kategorie',
                                                                      
                                                                      '%title%'                                     => 'Titel',
                                                                      '%title% %clip% %blog%'                       => 'Titel Trennzeichen Blogname',
                                                                      '%title% %clip% %category%'                   => 'Titel Trennzeichen Kategorie',
                                                                      '%title% %clip% %area% %clip% %blog%'         => 'Titel Trennzeichen Bezeichnung Trennzeichen Blogname',
                                                                      '%title% %clip% %keywords% %clip% %blog%'     => 'Titel Trennzeichen Keywords Trennzeichen Blogname',
                                                                      '%title% %clip% %category% %clip% %blog%'     => 'Titel Trennzeichen Kategorie Trennzeichen Blogname',
                                                                      '%title% %clip% %category% %clip% %keywords%' => 'Titel Trennzeichen Kategorie Trennzeichen Keywords',
                                                                      
                                                                      '%tag% %clip% %blog%'                         => 'Tag Trennzeichen Blogname',
                                                                      '%tag% %clip% %area% %clip% %blog%'           => 'Tag Trennzeichen Bezeichnung Trennzeichen Blogname',
                                                                      
                                                                      '%category% %clip% %title% %clip% %blog%'     => 'Kategorie Trennzeichen Titel Trennzeichen Blogname',
                                                                      '%category% %clip% %title%'                   => 'Kategorie Trennzeichen Titel',
                                                                      
                                                                      '%area% %clip% %blog%'                        => 'Bezeichnung Trennzeichen Blogname',
                                                                      
                                                                      '%keywords% %clip% %title% %clip% %blog%'     => 'Keywords Trennzeichen Titel Trennzeichen Blogname',
                                                                      '%keywords% %clip% %category% %clip% %title%' => 'Keywords Trennzeichen Kategorie Trennzeichen Titel'
                                                                     ),
                             
                             /* Werte fuer Description */
                             'wp_seo_desc_warning'          => 'Beschreibung der aktuellen Kategorie kann unter <a href="' .get_bloginfo('wpurl'). '/wp-admin/categories.php">Kategorienverwaltung</a> sinnvoll eingegeben werden. Es wird empfohlen, die Anzahl der Wörter in der Beschreibung auf maximal 20 zu beschränken.',
                             'wp_seo_desc_convert'          => 'Description (META) anpassen',
                             'wp_seo_desc_enable'           => 'Formatierung der Description aktivieren',
                             'wp_seo_desc_default'          => 'Standard-Wert',
                             'wp_seo_desc_default_info'     => '(Wird nur verwendet, wenn dieser unter "Dynamischer Wert" ausgewählt ist)',
                             'wp_seo_desc_dynamic'          => 'Dynamischer Wert',
                             'wp_seo_desc_dynamic_info'     => '(Description wird dynamisch aus Titeln oder dem ersten Beitrag erstellt)',
                             'wp_seo_desc_counter'          => 'Anzahl der Wörter',
                             'wp_seo_desc_counter_info'     => '(Maximale Anzahl der Wörter in Description, danach wird abgeschnitten)',
                             'wp_seo_desc_manually'         => 'Description manuell zuweisen',
                             'wp_seo_desc_manually_on'      => 'Description direkt beim Verfassen eines Beitrags eingeben können',
                             'wp_seo_desc_manually_info'    => '(Zugewiesene Description setzt die automatische Generierung außer Kraft)',
                             'wp_seo_desc_home'             => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Ausschnitt aus dem ersten Beitrag',
                                                                     2 => 'Titel der aufgelisteten Beiträge'
                                                                    ),
                             'wp_seo_desc_single'           => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Titel des aktuellen Beitrags',
                                                                     2 => 'Ausschnitt aus dem aktuellen Beitrag',
                                                                     3 => 'Ausschnitt aus der optionalen Kurzfassung'
                                                                    ),
                             'wp_seo_desc_page'             => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Titel des aktuellen Beitrags',
                                                                     2 => 'Ausschnitt aus dem aktuellen Beitrag'
                                                                    ),
                             'wp_seo_desc_category'         => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Beschreibung der aktuellen Kategorie',
                                                                     2 => 'Titel der aufgelisteten Beiträge'
                                                                    ),
                             'wp_seo_desc_search'           => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Ausschnitt aus dem ersten Beitrag',
                                                                     2 => 'Titel der aufgelisteten Beiträge'
                                                                    ),
                             'wp_seo_desc_archive'          => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Ausschnitt aus dem ersten Beitrag',
                                                                     2 => 'Titel der aufgelisteten Beiträge'
                                                                    ),
                             'wp_seo_desc_tagging'          => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Ausschnitt aus dem ersten Beitrag',
                                                                     2 => 'Titel der aufgelisteten Beiträge'
                                                                    ),
                             'wp_seo_desc_404'              => array(
                                                                     0 => 'Standard-Wert'
                                                                    ),
                             
                             /* Werte fuer Keywords */
                             'wp_seo_key_convert'           => 'Keywords (META) anpassen',
                             'wp_seo_key_enable'            => 'Formatierung der Keywords aktivieren',
                             'wp_seo_key_default'           => 'Standard-Wert',
                             'wp_seo_key_default_info'      => '(Wird nur verwendet, wenn dieser unter "Dynamischer Wert" ausgewählt ist)',
                             'wp_seo_key_dynamic'           => 'Dynamischer Wert',
                             'wp_seo_key_dynamic_info'      => '(Keywords werden dynamisch aus Titeln oder dem ersten Beitrag erstellt)',
                             'wp_seo_key_dynamic_warn'      => 'STP erzeugt bereits Keywords',
                             'wp_seo_key_counter'           => 'Anzahl der Wörter',
                             'wp_seo_key_counter_info'      => '(Maximale Anzahl der Wörter in Keywords, danach wird abgeschnitten)',
                             'wp_seo_key_length'            => 'Kurze Wörter',
                             'wp_seo_key_length_chars'      => 'Anzahl der Zeichen',
                             'wp_seo_key_length_info'       => '(Wörter mit wenigen Zeichen werden aus dynamischem Wert ausgefiltert)',
                             'wp_seo_key_blacklist'         => 'Negativliste',
                             'wp_seo_key_blacklist_info'    => '(Keywords aus der Liste werden ignoriert. Leerzeichen-separiert und Case-sensitive)',
                             'wp_seo_key_completion'        => 'Vervollständigung',
                             'wp_seo_key_completion_on'     => 'Automatische Vervollständigung aktivieren',
                             'wp_seo_key_completion_info'   => '(Werden es weniger Wörter als festgelegt, so wird es aus dem "Standard-Wert" nachgefüllt)',
                             'wp_seo_key_substantive'       => 'Substantive',
                             'wp_seo_key_substantive_on'    => 'Nur Substantive als Keywords verwenden',
                             'wp_seo_key_substantive_info'  => '(Alleinstehende Hauptwörter werden als Keywords betrachtet, restliche ausgefiltert)',
                             'wp_seo_key_relevance'         => 'Relevanz',
                             'wp_seo_key_relevance_on'      => 'Relevanz für Keywords einschalten',
                             'wp_seo_key_relevance_info'    => '(Wiederholte Keywords werden nach Häufigkeit gewichtet und entsprechend vorne positioniert)',
                             'wp_seo_key_labeling'          => 'Erkennung (Manuell)',
                             'wp_seo_key_labeling_on'       => 'Manuelle Markierung im Beitragstext erkennen: &lt;span class="wpseo_keyword"&gt;...&lt;/span&gt;',
                             'wp_seo_key_labeling_info'     => '(Im Text markierte Wörter als Keywords mit höchster Relevanz interpretieren)',
                             'wp_seo_key_xhtml'             => 'Erkennung (XHTML)',
                             'wp_seo_key_xhtml_on'          => 'Folgende XHTML-Tags im Beitragstext erkennen: &lt;em&gt;...&lt;/em&gt;, &lt;strong&gt;...&lt;/strong&gt;',
                             'wp_seo_key_xhtml_info'        => '(Im Text formatierte Wörter als Keywords mit höchster Relevanz interpretieren)',
                             'wp_seo_key_manually'          => 'Keywords manuell zuweisen',
                             'wp_seo_key_manually_on'       => 'Keywords direkt beim Verfassen eines Beitrags kommasepariert eingeben können',
                             'wp_seo_key_manually_info'     => '(Zugewiesene Keywords setzen die automatische Generierung außer Kraft)',
                             'wp_seo_key_home'              => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Ausschnitt aus dem ersten Beitrag'
                                                                    ),
                             'wp_seo_key_single'            => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Ausschnitt aus dem aktuellen Beitrag',
                                                                     2 => 'Tags'
                                                                    ),
                             'wp_seo_key_page'              => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Ausschnitt aus dem aktuellen Beitrag',
                                                                     2 => 'Tags'
                                                                    ),
                             'wp_seo_key_category'          => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Titel der aufgelisteten Beiträge'
                                                                    ),
                             'wp_seo_key_search'            => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Titel der aufgelisteten Beiträge'
                                                                    ),
                             'wp_seo_key_archive'           => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Titel der aufgelisteten Beiträge'
                                                                    ),
                             'wp_seo_key_tagging'           => array(
                                                                     0 => 'Standard-Wert',
                                                                     1 => 'Titel der aufgelisteten Beiträge'
                                                                    ),
                             'wp_seo_key_404'               => array(
                                                                     0 => 'Standard-Wert'
                                                                    ),
                             
                             /* Sonstige Werte */
                             'wp_seo_misc_settings'         => 'Sonstige Einstellungen',
                             'wp_seo_misc_section'          => 'Beiträge für Google mittels &lt;!-- google_ad_section ... --&gt; hervorheben',
                             'wp_seo_misc_robots'           => 'Duplicate Content mithilfe von &lt;meta name="robots" ... /&gt; vermeiden',
                             'wp_seo_misc_noodp'            => 'Meta-Tag &lt;meta name="robots" content="noodp" /&gt; im Quelltext einfügen',
                             'wp_seo_misc_clean'            => 'HTML-Kommentare und überflüssige Leerzeichen aus Beiträgen entfernen',
                             'wp_seo_misc_feed'             => 'Indizierung des RSS-Feeds durch Suchmaschinen verhindern',
                             'wp_seo_misc_attachment'       => 'Dateien beim Upload umbenennen und den vergebenen Titel als Dateinamen verwenden',
                             
                             /* Kompatibilitaet Werte */
                             'wp_seo_compatibility_settings'=> 'Kompatibilität prüfen',
                             'wp_seo_compatibility_start'   => 'Nach doppelten Tags (title, description, keywords, robots) im Quelltext suchen',
                             'wp_seo_compatibility_error'   => 'Fehler beim Auslesen der Metadaten',
                             'wp_seo_compatibility_details' => 'Doppelte Einträge gefunden',
                             'wp_seo_compatibility_done'    => 'Prüfung erfolgreich durchgeführt',
                             
                             /* Import / Export Werte */
                             'wp_seo_export_settings'       => 'Optionen exportieren',
                             'wp_seo_export_start'          => 'Datei im XML-Format generieren und downloaden',
                             'wp_seo_import_settings'       => 'Optionen importieren',
                             'wp_seo_import_start'          => 'Datei im XML-Format einlesen und Werte übernehmen',
                             'wp_seo_import_error'          => 'Fehler beim Hochladen der XML-Datei',
                             'wp_seo_import_done'           => 'Import der Optionen erfolgreich'
                            );


class wpSEO {
  /* Array mit Bereichen */
  var $groups = array(
                      'home',
                      'single',
                      'page',
                      'category',
                      'search',
                      'archive',
                      'tagging',
                      '404'
                     );
  
  
  /* Version des Plugins */
  var $version = '2.4';
  
  
  /* Laenge der Keywords */
  var $length = 0;
  
  
  /* Array als Cache */
  var $cache = array();
  
  
  /**
  * wpSEO
  *
  * Konstruktor der Klasse
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   07.09.2007
  * @access		public
  */
  
  function wpSEO() {
    /* ACTION | Page hinzufuegen */
    add_action('admin_menu', array($this, 'set_admin_page'));
    
    
    /* ACTION | Export starten */
    if (isset($_GET) === true && isset($_GET['page']) === true && strpos($_GET['page'], 'wpseo_') !== false && isset($_GET['action']) === true && $_GET['action'] == 'export') {
      add_action('init', array($this, 'get_export_file'));
    }
    
    
    /* ACTION | Hinweis generieren */
    add_action('wp_head', array($this, 'show_meta_comment'));
    
    /* ACTION | Robots generieren */
    if (get_option('wp_seo_misc_robots') || get_option('wp_seo_misc_noodp')) {
      add_action('wp_head', array($this, 'show_meta_robots'));
    }
    
    /* ACTION | Description generieren */
    if (get_option('wp_seo_desc_enable')) {
      add_action('wp_head', array($this, 'show_meta_description'));
    }
    
    /* ACTION | Keywords generieren */
    if (get_option('wp_seo_key_enable')) {
      add_action('wp_head', array($this, 'show_meta_keywords'));
    }
    
    /* ACTION | Titel generieren */
    if (get_option('wp_seo_title_enable')) {
      add_action('wp_head', array($this, 'show_meta_title'));
    }
    
    /* ACTION | Editfelder generieren & speichern */
    if (get_option('wp_seo_key_manually') || get_option('wp_seo_desc_manually') || get_option('wp_seo_title_manually')) {
      add_action('simple_edit_form', array($this, 'show_edit_fields'));
      add_action('edit_form_advanced', array($this, 'show_edit_fields'));
      add_action('edit_page_form', array($this, 'show_edit_fields'));
      
      add_action('edit_post', array($this, 'set_edit_fields'));
      add_action('publish_post', array($this, 'set_edit_fields'));
      add_action('save_post', array($this, 'set_edit_fields'));
      add_action('edit_page_form', array($this, 'set_edit_fields'));
    }
    
    /* ACTION | Feed sperren */
    if (get_option('wp_seo_misc_feed')) {
      add_action('rss_head', array($this, 'show_feed_noindex'));
      add_action('rss2_head', array($this, 'show_feed_noindex'));
    }
    
    
    /* FILTER | Attachments umbenennen */
    if (get_option('wp_seo_misc_attachment')) {
      add_filter('wp_handle_upload', array($this, 'set_attachment_file'));
    }
    
    /* FILTER | Content bereinigen */
    if (get_option('wp_seo_misc_clean')) {
      add_filter('the_content', array($this, 'get_cleaned_data'));
      add_filter('comment_text', array($this, 'get_cleaned_data'));
    }
    
    /* FILTER | AdSection einfuegen */
    if (get_option('wp_seo_misc_section')) {
      add_filter('the_content', array($this, 'get_selected_data'));
    }
  }
  
  
  
  
  /*#########################
  #######     GET     #######
  #########################*/
  
  
  /**
  * get_translated_string
  *
  * Uebersetzt einen String
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   02.05.2007
  * @access		public
  * @param    string  $str  String zum Uebersetzen
  * @return   string  $str  Uebersetzter String
  */
  
  function get_translated_string($str) {
    return @$GLOBALS['language'][$str];
  }
  
  
  /**
  * get_cleaned_data
  *
  * Bereinigt den Beitrag und Kommentare
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    15.04.2007
  * @change   02.05.2007
  * @access		public
  * @param    string  $data  Daten zum Bereinigen [optional]
  * @return   string  $data  Bereinigte Daten
  */
  
  function get_cleaned_data($data = '') {
  	return trim(preg_replace("/(\/\*.*?\*\/|<!--.*?-->| {2,})/", ' ', $data));
  }
  
  
  /**
  * get_selected_data
  *
  * Markiert den Beitrag mit Googles AdSection
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.04.2007
  * @change   02.05.2007
  * @access		public
  * @param    string  $data  Daten zum Selektieren
  * @return   string  $data  Selektierte Daten
  */
  
  function get_selected_data($data = '') {
    return "\n<!-- google_ad_section_start -->\n" .$data. "\n<!-- google_ad_section_end -->\n";
  }
  
  
  /**
  * get_category_data
  *
  * Gibt Kategorien des Beitrags zurueck
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    31.05.2007
  * @change   31.05.2007
  * @access		public
  * @return   string  $data  Kategorien des Beitrags
  */
  
  function get_category_data() {
    /* Kategorien auslesen */
    $categs = get_the_category();
    
    /* Keine Kategorien? */
    if (empty($categs) === true) {
      return '';
    }
    
    foreach ($categs as $v) {
      if (isset($data) === false) {
        $data = $v->cat_name;
      } else {
        $data .= ', ' .$v->cat_name;
      }
    }
    
    return $data;
  }
  
  
  /**
  * get_title_data
  *
  * Gibt Titel aller Beitraege zurueck
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   09.05.2007
  * @access		public
  * @return   string  $data  Titel der Beitraege
  */
  
  function get_title_data() {
    /* Keine Posts? */
    if (isset($GLOBALS['posts']) === false || empty($GLOBALS['posts']) === true) {
      return '';
    }
    
    foreach ($GLOBALS['posts'] as $v) {
      if (isset($data) === false) {
        $data = $v->post_title;
      } else {
        $data .= ', ' .$v->post_title;
      }
    }
    
    return $data;
  }
  
  
  /**
  * get_post_data
  *
  * Gibt Daten eines Beitrags zurueck
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   02.05.2007
  * @access		public
  * @return   string  $data  Ausgelesene Daten
  */
  
  function get_post_data() {
    return $GLOBALS['posts'][0]->post_content;
  }
  
  
  /**
  * get_excerpt_data
  *
  * Gibt Daten der Kurzbeschreibung zurueck
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   02.05.2007
  * @access		public
  * @return   string  $data  Ausgelesene Daten
  */
  
  function get_excerpt_data() {
    return $GLOBALS['posts'][0]->post_excerpt;
  }
  
  
  /**
  * get_composed_data
  *
  * Bereitet einen String fuer Ausgabe vor
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   25.10.2007
  * @access	  public
  * @param    string   $data  String zum Formatieren
  * @param    array    $args  Array mit Attributen
  * @return   string   $data  Zusammengesetzter String
  */
  
  function get_composed_data($data, $args) {
    /* Keine Daten? */
    if (empty($data) === true) {
      return '';
    }
    
    /* In HTML umwandeln */
    $data = $this->get_htmlentities_decode($data);
    
    /* Gelabelte Keywords */
    if ($args['labeling'] || $args['xhtml']) {
      /* Suche starten */
      preg_match_all(
                     sprintf(
                             "#<(?:%1\$s%2\$s%3\$s)>(.*?)</(?:%4\$s%2\$s%3\$s)>#i",
                             ($args['labeling'] ? 'span class="wpseo_keyword"' : ''),
                             ($args['labeling'] && $args['xhtml'] ? '|' : ''),
                             ($args['xhtml'] ? 'em|strong' : ''),
                             ($args['labeling'] ? 'span' : '')
                            ),
                     $data,
                     $matches,
                     PREG_PATTERN_ORDER
                    );
      
      /* Temporaer speichern */
      if (empty($matches) === false && empty($matches[1]) === false) {
        /* Ergebnisse speichern */
        $labels = $matches[1];
        
        /* Tags strippen */
        $labels = $this->get_strip_tags($labels);
        
        /* Fremdes entfernen */
        $labels = array_map(array($this, 'get_character_filter'), $labels);
        
        /* Ausreichende Laenge? */
        if (count($labels) >= $args['counter']) {
          return $this->get_converted_data($labels, $args);
        }
      }
    }
    
    /* Tags entfernen */
    $data = $this->get_strip_tags($data);
    
    /* In Array umwandeln */
    $array = preg_split('/[\s"]+/', $data, -1, PREG_SPLIT_NO_EMPTY);
    
    /* Fremdes entfernen */
    if ($args['character']) {
      $array = array_map(array($this, 'get_character_filter'), $array);
    }
    
    /* Laenge pruefen */
    if ($args['length']) {
      /* Laenge merken */
      $GLOBALS['wpSEO']->length = $args['length'];
      
      /* Ausfuehren */
      $array = array_filter($array, array($this, 'get_length_filter'));
    }
    
    /* Nur Hauptwoerter */
    if ($args['substantive']) {
      $array = array_filter($array, array($this, 'get_substantive_filter'));
    }
    
    /* Relevanz ermitteln */
    if ($args['relevance']) {
      $array = $this->get_counted_data($array);
    }
    
    /* Gelabelte zuerst */
    if (isset($labels) === true && empty($labels) === false) {
      $array = array_merge(
                           $labels,
                           $array
                          );
    }
    
    /* Unique Array bilden */
    $array = array_unique($array);
    
    /* Blackliste fuer Keywords */
    if ($args['character'] && $blacklist = stripslashes(get_option('wp_seo_key_blacklist'))) {
      $array = array_merge(
                          array_diff(
                                     $array,
                                     preg_split(
                                                '/\s/',
                                                $this->get_htmlentities_decode($blacklist),
                                                -1,
                                                PREG_SPLIT_NO_EMPTY
                                               )
                                    )
                         );
    }
    
    /* Array erweitern */
    if ($args['complete'] && count($array) < $args['counter'] && $default = stripslashes(get_option('wp_seo_key_default'))) {
      $array = array_merge(
                           $array,
                           preg_split(
                                      '/[\s\.\+\?\(\)\[\]\/\\,;&"\':!%~#_]+/',
                                      $default,
                                      -1,
                                      PREG_SPLIT_NO_EMPTY
                                     )
                          );
    }
    
    return $this->get_converted_data($array, $args);
  }
  
  
  /**
  * get_converted_data
  *
  * Konvertiert ein Array in einen String
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    02.04.2007
  * @change   05.05.2007
  * @access	  public
  * @param    array   $array  Array zum Konvertieren
  * @param    array   $args   Array mit Attributen
  * @return   string  $data   Zusammengesetzter String
  */
  
  function get_converted_data($array, $args) {
    /* String kuerzen */
    $array = array_slice($array, 0, $args['counter']);
    
    /* Array zusammenfuegen */
    $data = implode($args['separator'], $array);
    
    return $data;
  }
  
  
  /**
  * get_counted_data
  *
  * Zaehlt die Werte eines Arrays
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    26.03.2007
  * @change   02.05.2007
  * @access	  public
  * @param    array  $array      Array zum Zaehlen
  * @return   array  $ret_array  Array mit gezaehlten Werten
  */
  
  function get_counted_data($array) {
    /* Wert initialisieren */
    $ret_array = array();
    
    /* Werte loopen */
    foreach($array as $value) {
      foreach($ret_array as $key2 => $value2) {
        if (strtolower($key2) == strtolower($value)) {
          $ret_array[$key2] ++;
          continue 2;
        }
      }
      $ret_array[$value] = 1;
    }
    
    /* Array sortieren */
    arsort($ret_array);
    
    /* Array drehen */
    $ret_array = array_keys($ret_array);
    
    return $ret_array;
  }
  
  
  /**
  * get_substantive_filter
  *
  * Nur Hauptwoerter filtern
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    24.03.2007
  * @change   02.05.2007
  * @access	  public
  * @param    string  $data  String zum Pruefen
  * @return   string  $data  Ausgefilterter String
  */
  
  function get_substantive_filter($data) {
    if (empty($data) === false && strtolower($data) != $data) {
      return $data;
    }
  }
  
  
  /**
  * get_length_filter
  *
  * Nur bestimmte Laenge filtern
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    24.03.2007
  * @change   02.05.2007
  * @access	  public
  * @param    string  $data  String zum Pruefen
  * @return   string  $data  Ausgefilterter String
  */
  
  function get_length_filter($data) {
    if (empty($data) === false && strlen($data) > $GLOBALS['wpSEO']->length) {
      return $data;
    }
  }
  
  
  /**
  * get_character_filter
  *
  * Nur bestimmte Zeichen filtern
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    24.03.2007
  * @change   02.05.2007
  * @access	  public
  * @param    string  $data  String zum Pruefen
  * @return   string  $data  Ausgefilterter String
  */
  
  function get_character_filter($data) {
    return preg_replace(
                        '/[\.\+\?\(\)\[\]\/\\,:!%~#_"]/',
                        '',
                        $data
                       );
  }
  
  
  /**
  * get_tagging_status
  *
  * Ermittelt, ob es sich um eine Tag-Seite handelt
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    24.03.2007
  * @change   22.10.2007
  * @access		public
  * @return   boolean    TRUE wenn es sich um eine Tag-Seite handelt
  */
  
  function get_tagging_status() {
    if ((class_exists('SimpleTagging') === true && STP_IsTagView() === true) || (class_exists('UltimateTagWarriorCore') === true && is_tag() === true) || (function_exists('is_tag') === true && is_tag() === true)) {
      return true;
    }
    
    return false;
  }
  
  
  /**
  * get_strip_tags
  *
  * Entfernt HTML-Tags aus dem Array oder String
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    05.05.2007
  * @change   05.05.2007
  * @access		public
  * @param    mixed  $data  Daten zum Umwandeln
  * @return   mixed  $data  Umgewandelte Daten
  */
  
  function get_strip_tags($data) {
    if (is_array($data) === true) {
      return array_map(array($this, 'get_strip_tags'), $data);
    } else {
      /* Workaround fuer Lightbox */
      $data = strtr($data, '[]', '<>');
      
      return strip_tags($data);
    }
  }
  
  
  /**
  * get_htmlentities_decode
  *
  * Wandelt Zeichensatz in entsprechende Sonderzeichen um
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    03.05.2007
  * @change   03.05.2007
  * @access		public
  * @param    string  $data  String zum Umwandeln
  * @return   string  $data  Umgewandelter String
  */
  
  function get_htmlentities_decode($data) {
    /* Zeichensatz des Blogs */
    $charset = get_bloginfo('charset');
    
    /* Nach PHP-Version unterscheiden */
    if (version_compare(phpversion(), '5.0.0', '>=')) {
      return html_entity_decode($data, ENT_NOQUOTES, $charset);
    } else {
      if (strtolower($charset) == 'utf-8') {
        return $this->get_entity_decode_php4($data);
      } else {
        return html_entity_decode($data, ENT_NOQUOTES, $charset);
      }
    }
  }
  
  
  /**
  * get_htmlentities_encode
  *
  * Wandelt Sonderzeichen in entsprechendes Zeichensatz um
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    24.03.2007
  * @change   02.05.2007
  * @access		public
  * @param    string  $data  String zum Umwandeln
  * @return   string  $data  Umgewandelter String
  */
  
  function get_htmlentities_encode($data) {
    return htmlentities(
                        $this->get_htmlentities_decode($data),
                        ENT_NOQUOTES,
                        get_bloginfo('charset')
                       );
  }
  
  
  function get_utf8_code_php4($num) {
  	if ($num <= 0x7F) {
  		return chr($num);
  	} elseif ($num <= 0x7FF) {
  		return chr(($num >> 0x06) + 0xC0) . chr(($num & 0x3F) + 128);
  	} elseif ($num <= 0xFFFF) {
  		return chr(($num >> 0x0C) + 0xE0) . chr((($num >> 0x06) & 0x3F) + 0x80) . chr(($num & 0x3F) + 0x80);
  	} elseif ($num <= 0x1FFFFF) {
  		return chr(($num >> 0x12) + 0xF0) . chr((($num >> 0x0C) & 0x3F) + 0x80) . chr((($num >> 0x06) & 0x3F) + 0x80) . chr(($num & 0x3F) + 0x80);
  	}
    
  	return ' ';
  }
  
  
  function get_entity_decode_php4($data) {
  	$table = array (
  		'&Aacute;' => chr(195).chr(129),
  		'&aacute;' => chr(195).chr(161),
  		'&Acirc;' => chr(195).chr(130),
  		'&acirc;' => chr(195).chr(162),
  		'&acute;' => chr(194).chr(180),
  		'&AElig;' => chr(195).chr(134),
  		'&aelig;' => chr(195).chr(166),
  		'&Agrave;' => chr(195).chr(128),
  		'&agrave;' => chr(195).chr(160),
  		'&alefsym;' => chr(226).chr(132).chr(181),
  		'&Alpha;' => chr(206).chr(145),
  		'&alpha;' => chr(206).chr(177),
  		'&amp;' => chr(38),
  		'&and;' => chr(226).chr(136).chr(167),
  		'&ang;' => chr(226).chr(136).chr(160),
  		'&Aring;' => chr(195).chr(133),
  		'&aring;' => chr(195).chr(165),
  		'&asymp;' => chr(226).chr(137).chr(136),
  		'&Atilde;' => chr(195).chr(131),
  		'&atilde;' => chr(195).chr(163),
  		'&Auml;' => chr(195).chr(132),
  		'&auml;' => chr(195).chr(164),
  		'&bdquo;' => chr(226).chr(128).chr(158),
  		'&Beta;' => chr(206).chr(146),
  		'&beta;' => chr(206).chr(178),
  		'&brvbar;' => chr(194).chr(166),
  		'&bull;' => chr(226).chr(128).chr(162),
  		'&cap;' => chr(226).chr(136).chr(169),
  		'&Ccedil;' => chr(195).chr(135),
  		'&ccedil;' => chr(195).chr(167),
  		'&cedil;' => chr(194).chr(184),
  		'&cent;' => chr(194).chr(162),
  		'&Chi;' => chr(206).chr(167),
  		'&chi;' => chr(207).chr(135),
  		'&circ;' => chr(203).chr(134),
  		'&clubs;' => chr(226).chr(153).chr(163),
  		'&cong;' => chr(226).chr(137).chr(133),
  		'&copy;' => chr(194).chr(169),
  		'&crarr;' => chr(226).chr(134).chr(181),
  		'&cup;' => chr(226).chr(136).chr(170),
  		'&curren;' => chr(194).chr(164),
  		'&dagger;' => chr(226).chr(128).chr(160),
  		'&Dagger;' => chr(226).chr(128).chr(161),
  		'&darr;' => chr(226).chr(134).chr(147),
  		'&dArr;' => chr(226).chr(135).chr(147),
  		'&deg;' => chr(194).chr(176),
  		'&Delta;' => chr(206).chr(148),
  		'&delta;' => chr(206).chr(180),
  		'&diams;' => chr(226).chr(153).chr(166),
  		'&divide;' => chr(195).chr(183),
  		'&Eacute;' => chr(195).chr(137),
  		'&eacute;' => chr(195).chr(169),
  		'&Ecirc;' => chr(195).chr(138),
  		'&ecirc;' => chr(195).chr(170),
  		'&Egrave;' => chr(195).chr(136),
  		'&egrave;' => chr(195).chr(168),
  		'&empty;' => chr(226).chr(136).chr(133),
  		'&emsp;' => chr(226).chr(128).chr(131),
  		'&ensp;' => chr(226).chr(128).chr(130),
  		'&Epsilon;' => chr(206).chr(149),
  		'&epsilon;' => chr(206).chr(181),
  		'&equiv;' => chr(226).chr(137).chr(161),
  		'&Eta;' => chr(206).chr(151),
  		'&eta;' => chr(206).chr(183),
  		'&ETH;' => chr(195).chr(144),
  		'&eth;' => chr(195).chr(176),
  		'&Euml;' => chr(195).chr(139),
  		'&euml;' => chr(195).chr(171),
  		'&euro;' => chr(226).chr(130).chr(172),
  		'&exist;' => chr(226).chr(136).chr(131),
  		'&fnof;' => chr(198).chr(146),
  		'&forall;' => chr(226).chr(136).chr(128),
  		'&frac12;' => chr(194).chr(189),
  		'&frac14;' => chr(194).chr(188),
  		'&frac34;' => chr(194).chr(190),
  		'&frasl;' => chr(226).chr(129).chr(132),
  		'&Gamma;' => chr(206).chr(147),
  		'&gamma;' => chr(206).chr(179),
  		'&ge;' => chr(226).chr(137).chr(165),
  		'&harr;' => chr(226).chr(134).chr(148),
  		'&hArr;' => chr(226).chr(135).chr(148),
  		'&hearts;' => chr(226).chr(153).chr(165),
  		'&hellip;' => chr(226).chr(128).chr(166),
  		'&Iacute;' => chr(195).chr(141),
  		'&iacute;' => chr(195).chr(173),
  		'&Icirc;' => chr(195).chr(142),
  		'&icirc;' => chr(195).chr(174),
  		'&iexcl;' => chr(194).chr(161),
  		'&Igrave;' => chr(195).chr(140),
  		'&igrave;' => chr(195).chr(172),
  		'&image;' => chr(226).chr(132).chr(145),
  		'&infin;' => chr(226).chr(136).chr(158),
  		'&int;' => chr(226).chr(136).chr(171),
  		'&Iota;' => chr(206).chr(153),
  		'&iota;' => chr(206).chr(185),
  		'&iquest;' => chr(194).chr(191),
  		'&isin;' => chr(226).chr(136).chr(136),
  		'&Iuml;' => chr(195).chr(143),
  		'&iuml;' => chr(195).chr(175),
  		'&Kappa;' => chr(206).chr(154),
  		'&kappa;' => chr(206).chr(186),
  		'&Lambda;' => chr(206).chr(155),
  		'&lambda;' => chr(206).chr(187),
  		'&lang;' => chr(226).chr(140).chr(169),
  		'&laquo;' => chr(194).chr(171),
  		'&larr;' => chr(226).chr(134).chr(144),
  		'&lArr;' => chr(226).chr(135).chr(144),
  		'&lceil;' => chr(226).chr(140).chr(136),
  		'&ldquo;' => chr(226).chr(128).chr(156),
  		'&le;' => chr(226).chr(137).chr(164),
  		'&lfloor;' => chr(226).chr(140).chr(138),
  		'&lowast;' => chr(226).chr(136).chr(151),
  		'&loz;' => chr(226).chr(151).chr(138),
  		'&lrm;' => chr(226).chr(128).chr(142),
  		'&lsaquo;' => chr(226).chr(128).chr(185),
  		'&lsquo;' => chr(226).chr(128).chr(152),
  		'&macr;' => chr(194).chr(175),
  		'&mdash;' => chr(226).chr(128).chr(148),
  		'&micro;' => chr(194).chr(181),
  		'&middot;' => chr(194).chr(183),
  		'&minus;' => chr(226).chr(136).chr(146),
  		'&Mu;' => chr(206).chr(156),
  		'&mu;' => chr(206).chr(188),
  		'&nabla;' => chr(226).chr(136).chr(135),
  		'&nbsp;' => chr(194).chr(160),
  		'&ndash;' => chr(226).chr(128).chr(147),
  		'&ne;' => chr(226).chr(137).chr(160),
  		'&ni;' => chr(226).chr(136).chr(139),
  		'&not;' => chr(194).chr(172),
  		'&notin;' => chr(226).chr(136).chr(137),
  		'&nsub;' => chr(226).chr(138).chr(132),
  		'&Ntilde;' => chr(195).chr(145),
  		'&ntilde;' => chr(195).chr(177),
  		'&Nu;' => chr(206).chr(157),
  		'&nu;' => chr(206).chr(189),
  		'&Oacute;' => chr(195).chr(147),
  		'&oacute;' => chr(195).chr(179),
  		'&Ocirc;' => chr(195).chr(148),
  		'&ocirc;' => chr(195).chr(180),
  		'&OElig;' => chr(197).chr(146),
  		'&oelig;' => chr(197).chr(147),
  		'&Ograve;' => chr(195).chr(146),
  		'&ograve;' => chr(195).chr(178),
  		'&oline;' => chr(226).chr(128).chr(190),
  		'&Omega;' => chr(206).chr(169),
  		'&omega;' => chr(207).chr(137),
  		'&Omicron;' => chr(206).chr(159),
  		'&omicron;' => chr(206).chr(191),
  		'&oplus;' => chr(226).chr(138).chr(149),
  		'&or;' => chr(226).chr(136).chr(168),
  		'&ordf;' => chr(194).chr(170),
  		'&ordm;' => chr(194).chr(186),
  		'&Oslash;' => chr(195).chr(152),
  		'&oslash;' => chr(195).chr(184),
  		'&Otilde;' => chr(195).chr(149),
  		'&otilde;' => chr(195).chr(181),
  		'&otimes;' => chr(226).chr(138).chr(151),
  		'&Ouml;' => chr(195).chr(150),
  		'&ouml;' => chr(195).chr(182),
  		'&para;' => chr(194).chr(182),
  		'&part;' => chr(226).chr(136).chr(130),
  		'&permil;' => chr(226).chr(128).chr(176),
  		'&perp;' => chr(226).chr(138).chr(165),
  		'&Phi;' => chr(206).chr(166),
  		'&phi;' => chr(207).chr(134),
  		'&Pi;' => chr(206).chr(160),
  		'&pi;' => chr(207).chr(128),
  		'&piv;' => chr(207).chr(150),
  		'&plusmn;' => chr(194).chr(177),
  		'&pound;' => chr(194).chr(163),
  		'&prime;' => chr(226).chr(128).chr(178),
  		'&Prime;' => chr(226).chr(128).chr(179),
  		'&prod;' => chr(226).chr(136).chr(143),
  		'&prop;' => chr(226).chr(136).chr(157),
  		'&Psi;' => chr(206).chr(168),
  		'&psi;' => chr(207).chr(136),
  		'&radic;' => chr(226).chr(136).chr(154),
  		'&rang;' => chr(226).chr(140).chr(170),
  		'&raquo;' => chr(194).chr(187),
  		'&rarr;' => chr(226).chr(134).chr(146),
  		'&rArr;' => chr(226).chr(135).chr(146),
  		'&rceil;' => chr(226).chr(140).chr(137),
  		'&rdquo;' => chr(226).chr(128).chr(157),
  		'&real;' => chr(226).chr(132).chr(156),
  		'&reg;' => chr(194).chr(174),
  		'&rfloor;' => chr(226).chr(140).chr(139),
  		'&Rho;' => chr(206).chr(161),
  		'&rho;' => chr(207).chr(129),
  		'&rlm;' => chr(226).chr(128).chr(143),
  		'&rsaquo;' => chr(226).chr(128).chr(186),
  		'&rsquo;' => chr(226).chr(128).chr(153),
  		'&sbquo;' => chr(226).chr(128).chr(154),
  		'&Scaron;' => chr(197).chr(160),
  		'&scaron;' => chr(197).chr(161),
  		'&sdot;' => chr(226).chr(139).chr(133),
  		'&sect;' => chr(194).chr(167),
  		'&shy;' => chr(194).chr(173),
  		'&Sigma;' => chr(206).chr(163),
  		'&sigma;' => chr(207).chr(131),
  		'&sigmaf;' => chr(207).chr(130),
  		'&sim;' => chr(226).chr(136).chr(188),
  		'&spades;' => chr(226).chr(153).chr(160),
  		'&sub;' => chr(226).chr(138).chr(130),
  		'&sube;' => chr(226).chr(138).chr(134),
  		'&sum;' => chr(226).chr(136).chr(145),
  		'&sup1;' => chr(194).chr(185),
  		'&sup2;' => chr(194).chr(178),
  		'&sup3;' => chr(194).chr(179),
  		'&sup;' => chr(226).chr(138).chr(131),
  		'&supe;' => chr(226).chr(138).chr(135),
  		'&szlig;' => chr(195).chr(159),
  		'&Tau;' => chr(206).chr(164),
  		'&tau;' => chr(207).chr(132),
  		'&there4;' => chr(226).chr(136).chr(180),
  		'&Theta;' => chr(206).chr(152),
  		'&theta;' => chr(206).chr(184),
  		'&thetasym;' => chr(207).chr(145),
  		'&thinsp;' => chr(226).chr(128).chr(137),
  		'&THORN;' => chr(195).chr(158),
  		'&thorn;' => chr(195).chr(190),
  		'&tilde;' => chr(203).chr(156),
  		'&times;' => chr(195).chr(151),
  		'&trade;' => chr(226).chr(132).chr(162),
  		'&Uacute;' => chr(195).chr(154),
  		'&uacute;' => chr(195).chr(186),
  		'&uarr;' => chr(226).chr(134).chr(145),
  		'&uArr;' => chr(226).chr(135).chr(145),
  		'&Ucirc;' => chr(195).chr(155),
  		'&ucirc;' => chr(195).chr(187),
  		'&Ugrave;' => chr(195).chr(153),
  		'&ugrave;' => chr(195).chr(185),
  		'&uml;' => chr(194).chr(168),
  		'&upsih;' => chr(207).chr(146),
  		'&Upsilon;' => chr(206).chr(165),
  		'&upsilon;' => chr(207).chr(133),
  		'&Uuml;' => chr(195).chr(156),
  		'&uuml;' => chr(195).chr(188),
  		'&weierp;' => chr(226).chr(132).chr(152),
  		'&Xi;' => chr(206).chr(158),
  		'&xi;' => chr(206).chr(190),
  		'&Yacute;' => chr(195).chr(157),
  		'&yacute;' => chr(195).chr(189),
  		'&yen;' => chr(194).chr(165),
  		'&yuml;' => chr(195).chr(191),
  		'&Yuml;' => chr(197).chr(184),
  		'&Zeta;' => chr(206).chr(150),
  		'&zeta;' => chr(206).chr(182),
  		'&zwj;' => chr(226).chr(128).chr(141),
  		'&zwnj;' => chr(226).chr(128).chr(140),
  		'&gt;' => '>',
  		'&lt;' => '<'
  	);
    
  	$return = strtr($data, $table);
  	$return = preg_replace('~&#x([0-9a-f]+);~ei', '\$this->get_utf8_code_php4(hexdec("\\1"))', $return);
  	$return = preg_replace('~&#([0-9]+);~e', '\$this->get_utf8_code_php4(\\1)', $return);
    
  	return $return;
  }
  
  
  /**
  * get_plugin_version
  *
  * Holt neue Version des Plugins ab
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    22.05.2007
  * @change   22.05.2007
  * @access		public
  * @return   string  $version  Aktuelle Version des Plugins
  */
  
  function get_plugin_version() {
    /* Pro Tag einmal */
    if (time() - get_option('wp_seo_update_check') < 86400) {
      return $this->version;
    }
    
    /* XML abholen */
    $xml = @file_get_contents('http://www.wpseo.de/api/info.xml');
    
    /* XML leer? */
    if (!$xml) {
      return $this->version;
    }
    
    /* XML parsen */
    preg_match('/<version>(.*)<\/version>/', $xml, $matches);
    
    /* Check merken */
    update_option('wp_seo_update_check', time());
    
    /* Version auf dem Server */
    return $matches[1];
  }
  
  
  /**
  * get_donate_status
  *
  * Vergleicht das Datum des letzten Spende-Hinweises
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    03.11.2007
  * @change   03.11.2007
  * @access		public
  * @return   boolean  true/false  TRUE für eine Ausgabe des Hinweises
  */
  
  function get_donate_status() {
    /* Noch keine Ausgabe? */
    if (!get_option('wp_seo_donate_check')) {
      update_option('wp_seo_donate_check', time());
      return false;
    }
    
    /* Alle 15 Tage einmal */
    if ((time() - get_option('wp_seo_donate_check')) < (86400 * 15)) {
      return false;
    } else {
      update_option('wp_seo_donate_check', time());
      return true;
    }
  }
  
  
  /**
  * get_export_file
  *
  * Erzeugt ein XML mit Optionen
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    28.05.2007
  * @change   02.07.2007
  * @access		public
  * @return   string  $xml  XML als Datei
  */
  
  function get_export_file() {
    /* XML zusammensetzen */
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= "\n<options>\n";
    
    /* Werte auslesen */
    $results = $GLOBALS['wpdb']->get_results("SELECT option_name, option_value FROM " .$GLOBALS['wpdb']->options. " WHERE option_name LIKE 'wp_seo%'");
    
    /* Werte im XML */
    foreach ($results as $field) {
      $name = $field->option_name;
      $value = stripslashes($field->option_value);
      
      if (preg_match('/^[0-9]*$/', $value)) {
        $xml .= "  <" .$name. ">" .$value. "</" .$name. ">\n";
      } else {
        $xml .= "  <" .$name. "><![CDATA[" .$value. "]]></" .$name. ">\n";
      }
    }
    
    /* XML vervollstaendigen */
    $xml .= '</options>';
    
    /* Header senden */
    $this->set_download_header('wpSEO.' .date('Y-m-d'). '.xml', strlen($xml), 'text/xml');
    
    /* XML ausgeben */
    echo $xml;
    
    exit;
  }
  
  
  /**
  * get_front_page
  *
  * Prueft, ob sich um die Startseite handelt
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    22.06.2007
  * @change   22.06.2007
  * @access		public
  * @return   boolean    TRUE bei Erfolg
  */
  
  function get_front_page() {
    return (get_option('show_on_front') == 'page' && get_option('page_on_front') == $GLOBALS['post']->ID) ? true : false;
  }
  
  
  /**
  * get_meta_tags_adv
  *
  * Liest Meta-Daten einer URL aus
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    07.08.2007
  * @change   07.08.2007
  * @access		public
  * @param    string   $url      URL der Seite
  * @param    integer  $timeout  Timeout [optional]
  * @return   mixed    $data     Array mit Metadaten bei Erfolg
  */
  
  function get_meta_tags_adv($url, $timeout = 3) {
    /* Keine URL? */
    if (empty($url) === true) {
      return false;
    }
    
    /* URL splitten */
    $parsed_url = parse_url($url);
    
    /* Verbindung herstellen */
    if (!$fsock = fsockopen($parsed_url['host'], 80, $errno, $errstr, $timeout)) {
      return false;
    }
    
    fputs($fsock, 'GET ' .($parsed_url['path'] ? $parsed_url['path']. '/' : '/') .$parsed_url['query']. " HTTP/1.1\r\n");
    fputs($fsock, 'HOST: ' .$parsed_url['host']. "\r\n");
    fputs($fsock, "Connection: close\r\n\r\n");
    
    /* Werte initialisieren */
    $current = '';
    $input = '';
    $header = array();
    $data['title'] = array();
    $data['description'] = array();
    $data['keywords'] = array();
    $data['robots'] = array();
    
    while (($line=trim(fgets($fsock, 1024))) != '') {
      if (($pos=strpos($line, ':')) !== false ) {
        $current = substr($line, 0, $pos);
        $header[$current] = trim(substr($line, $pos + 1));
      }
    }
    
    if (isset($header['Transfer-Encoding']) === true && $header['Transfer-Encoding'] == 'chunked') {
      $chunk = hexdec(fgets($fsock, 1024));
    } else {
      $chunk = -1;
    }
    
    while ($chunk != 0 && !feof($fsock)) {
      if ($chunk > 0) {
        $part = fread($fsock, $chunk);
        $chunk -= strlen($part);
        $input .= $part;
        if ($chunk == 0) {
          if (fgets($fsock, 1024) != "\r\n") {
            return false;
          }
          $chunk = hexdec(fgets($fsock, 1024));
        }
        
        if (strpos(strtolower($input), '</head>') !== false || substr_count($input, "\n") >= 300) {
          break;
        }
      } else {
        $input .= fread($fsock, 1024);
      }
    }
    
    /* Verbindung schliessen */
    fclose($fsock);
    
    /* Titel */
    preg_match_all('/<title>(.*?)<\/title>/si', $input, $matches);
    $data['title'] = $matches[1];
    
    /* Meta-Description */
    preg_match_all('/description[\'"] content=[\'"](.*?)[\'"]/si', $input, $matches);
    $data['description'] = $matches[1];
    
    /* Meta-Keywords */
    preg_match_all('/keywords[\'"] content=[\'"](.*?)[\'"]/si', $input, $matches);
    $data['keywords'] = $matches[1];
    
    /* Meta-Robots */
    preg_match_all('/robots[\'"] content=[\'"](.*?)[\'"]/si', $input, $matches);
    $data['robots'] = $matches[1];
    
    return $data;
  }
  
  
  /**
  * get_compatibility_check
  *
  * Prueft auf Kompatibilitaet
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    07.08.2007
  * @change   07.08.2007
  * @access		public
  * @return   mixed    TRUE bei Erfolg
  */
  
  function get_compatibility_check() {
    /* Nicht erfolgreich? */
    if (!$data = $this->get_meta_tags_adv(get_bloginfo('url'))) {
      return $this->get_translated_string('wp_seo_compatibility_error');
    }
    
    /* Werte initialisieren */
    $errors = array();
    $counts = array();
    
    /* Bereiche loopen */
    foreach (array('title', 'description', 'keywords', 'robots') as $key) {
      /* Werte counten */
      $counts[$key] = count($data[$key]);
      
      /* Mehrfach vorhanden? */
      if ($counts[$key] > 1) {
        $errors[] = $counts[$key]. ' x ' .$key;
      }
    }
    
    /* Fehler zurueckgeben */
    if (empty($errors) === false) {
      return sprintf(
                     $this->get_translated_string('wp_seo_compatibility_details'). ': %s',
                     implode(
                             ', ',
                             $errors
                            )
                    );
    }
    
    return true;
  }
  
  
  /**
  * get_post_tags
  *
  * Gibt Tags enes Beitrags zurueck
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    22.10.2007
  * @change   22.10.2007
  * @access		public
  * @return   string  Tags als kommaseparierte Liste
  */
  
  function get_post_tags() {
    switch (true) {
      case class_exists('SimpleTagging'):
        return STP_GetMetaKeywords();
      
      case class_exists('UltimateTagWarriorCore'):
        return $GLOBALS['utw']->FormatTags(
                                           $GLOBALS['utw']->GetTagsForPost($GLOBALS['posts'][0]->ID),
                                           array(
                                                 'first' => '%tagdisplay%',
                                                 'default' => ', %tagdisplay%'
                                                )
                                          );
      
      case function_exists('the_tags'):
        return $this->get_wp_tags(', ');
      
      case class_exists('SimpleTags'):
        return $GLOBALS['simple_tags']->generateKeywords();
      
      default:
        return '';
    }
  }
  
  
  /**
  * get_current_tagset
  *
  * Gibt aktuellen Tagset zurueck
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    22.10.2007
  * @change   11.11.2007
  * @access		public
  * @return   string  Tags als kommaseparierte Liste
  */
  
  function get_current_tagset() {
    switch (true) {
      case class_exists('SimpleTagging'):
        return STP_GetCurrentTagSet();
      
      case class_exists('UltimateTagWarriorCore'):
        return $GLOBALS['utw']->FormatTags(
                                           $GLOBALS['utw']->GetCurrentTagSet(),
                                           $GLOBALS['utw']->GetFormat(
                                                                      'tagsettextonly',
                                                                      ''
                                                                     ),
                                           0
                                          );
      
      default:
        return wp_title('', false);
    }
  }
  
  
  /**
  * get_wp_tags
  *
  * Gibt aktuelle WP-Tags zurueck
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    22.10.2007
  * @change   22.10.2007
  * @access		public
  * @param    string  $separator  Separator fuer die Liste
  * @return   mixed   $return     Tags als Liste (Array oder String)
  */
  
  function get_wp_tags($separator) {
    /* Wert initialisieren */
    $return = array();
    
    /* Aeltere Version? */
    if (function_exists('get_the_tags') === false) {
      return false;
    }
    
    /* Tags ermitteln */
    if ($tags = get_the_tags($GLOBALS['post']->ID)) {
      foreach ($tags as $tag) {
    		$return[] = $tag->name;
    	}
    	
    	return ($separator) ? implode($separator, $return) : $return;
    } else {
      return '';
    }
  }
  
  
  
  /*#########################
  #######     SET     #######
  #########################*/
  
  
  /**
  * set_admin_page
  *
  * Legt einen Reiter unter Admin an
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   02.05.2007
  * @access		public
  */
  
  function set_admin_page() {
    /* Einstellungen setzen */
    $this->set_default_settings();
    
    /* Reiter unter Optionen */
    add_options_page('wpSEO-Plugin', 'wpSEO', 9, __FILE__, array($this, 'show_admin_page'));
  }
  
  
  /**
  * set_default_settings
  *
  * Schreibt Standard-Werte in die Datenbank
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   30.08.2007
  * @access		public
  */
  
  function set_default_settings() {
    /* Array mit Einstellungen */
    $args_array = array(
                        'wp_seo_update_check'    => 0,
                        'wp_seo_donate_check'    => 0,
                        
                        'wp_seo_title_enable'    => 0,
                        'wp_seo_title_separator' => '&raquo;',
                        'wp_seo_title_number'    => 0,
                        'wp_seo_title_author'    => 0,
                        
                        'wp_seo_desc_enable'     => 0,
                        'wp_seo_desc_default'    => '',
                        'wp_seo_desc_counter'    => 20,
                        
                        'wp_seo_key_enable'      => 0,
                        'wp_seo_key_default'     => '',
                        'wp_seo_key_counter'     => 10,
                        'wp_seo_key_length'      => 3,
                        'wp_seo_key_blacklist'   => '',
                        'wp_seo_key_complete'    => 0,
                        'wp_seo_key_substantive' => 0,
                        'wp_seo_key_relevance'   => 0,
                        'wp_seo_key_labeling'    => 0,
                        'wp_seo_key_xhtml'       => 0,
                        'wp_seo_key_manually'    => 0,
                        'wp_seo_desc_manually'   => 0,
                        'wp_seo_title_manually'  => 0,
                        
                        'wp_seo_misc_section'    => 0,
                        'wp_seo_misc_robots'     => 0,
                        'wp_seo_misc_noodp'      => 0,
                        'wp_seo_misc_clean'      => 0,
                        'wp_seo_misc_feed'       => 0,
                        'wp_seo_misc_attachment' => 0
                       );
    
    /* Beschreibungen notieren */
    foreach ($this->groups as $k) {
      $args_array['wp_seo_title_channel_' .$k] = ($k == 'home' ? '%title% %clip% %blog%' : ($k == 'tagging' ? '%tag% %clip% %area% %clip% %blog%' : ($k == '404' ? '%area% %clip% %blog%' : '%title% %clip% %area% %clip% %blog%')));
      $args_array['wp_seo_title_desc_' .$k] = $this->get_translated_string('wp_seo_' .$k);
      $args_array['wp_seo_desc_' .$k] = 0;
      $args_array['wp_seo_key_' .$k] = 0;
    }
    
    /* Einstellungen loopen */
    foreach ($args_array as $k => $v) {
      add_option($k, $v);
    }
  }
  
  
  /**
  * set_user_settings
  *
  * Schreibt User-Werte in die Datenbank
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   30.08.2007
  * @access		public
  */
  
  function set_user_settings() {
    if (isset($_POST['wp_seo_title_enable']) === true && empty($_POST['wp_seo_title_enable']) === false) {
      /* Status merken */
      update_option('wp_seo_title_enable', 1);
      
      /* Separator speichern */
      update_option('wp_seo_title_separator', (empty($_POST['wp_seo_title_separator']) === true) ? '&raquo;' : $this->get_htmlentities_decode($_POST['wp_seo_title_separator']));
      
      /* Einstellungen speichern */
      update_option('wp_seo_title_number', $_POST['wp_seo_title_number']);
      update_option('wp_seo_title_author', $_POST['wp_seo_title_author']);
      update_option('wp_seo_title_manually', $_POST['wp_seo_title_manually']);
      
      /* Felder speichern */
      foreach ($this->groups as $k) {
        update_option('wp_seo_title_channel_' .$k, $_POST['wp_seo_title_channel_' .$k]);
        update_option('wp_seo_title_desc_' .$k, $this->get_htmlentities_decode($_POST['wp_seo_title_desc_' .$k]));
      }
    } else if (isset($_POST['action']) === true) {
      /* Status merken */
      update_option('wp_seo_title_enable', 0);
    }
    
    if (isset($_POST['wp_seo_desc_enable']) === true && empty($_POST['wp_seo_desc_enable']) === false) {
      /* Einstellungen speichern */
      update_option('wp_seo_desc_enable', 1);
      update_option('wp_seo_desc_default', $this->get_htmlentities_decode($_POST['wp_seo_desc_default']));
      update_option('wp_seo_desc_counter', $_POST['wp_seo_desc_counter']);
      update_option('wp_seo_desc_manually', $_POST['wp_seo_desc_manually']);
      
      /* Felder speichern */
      foreach ($this->groups as $k) {
        update_option('wp_seo_desc_' .$k, $_POST['wp_seo_desc_' .$k]);
      }
    } else if (isset($_POST['action']) === true) {
      /* Status merken */
      update_option('wp_seo_desc_enable', 0);
    }
    
    if (isset($_POST['wp_seo_key_enable']) === true && empty($_POST['wp_seo_key_enable']) === false) {
      /* Einstellungen speichern */
      update_option('wp_seo_key_enable', 1);
      update_option('wp_seo_key_default', $this->get_htmlentities_decode($_POST['wp_seo_key_default']));
      update_option('wp_seo_key_blacklist', $this->get_htmlentities_decode($_POST['wp_seo_key_blacklist']));
      update_option('wp_seo_key_complete', $_POST['wp_seo_key_complete']);
      update_option('wp_seo_key_substantive', $_POST['wp_seo_key_substantive']);
      update_option('wp_seo_key_relevance', $_POST['wp_seo_key_relevance']);
      update_option('wp_seo_key_labeling', $_POST['wp_seo_key_labeling']);
      update_option('wp_seo_key_xhtml', $_POST['wp_seo_key_xhtml']);
      update_option('wp_seo_key_manually', $_POST['wp_seo_key_manually']);
      update_option('wp_seo_key_counter', $_POST['wp_seo_key_counter']);
      update_option('wp_seo_key_length', $_POST['wp_seo_key_length']);
      
      /* Felder speichern */
      foreach ($this->groups as $k) {
        update_option('wp_seo_key_' .$k, $_POST['wp_seo_key_' .$k]);
      }
    } else if (isset($_POST['action']) === true) {
      /* Status merken */
      update_option('wp_seo_key_enable', 0);
    }
    
    /* Sonstige Einstellungen */
    update_option('wp_seo_misc_section', $_POST['wp_seo_misc_section']);
    update_option('wp_seo_misc_robots', $_POST['wp_seo_misc_robots']);
    update_option('wp_seo_misc_noodp', $_POST['wp_seo_misc_noodp']);
    update_option('wp_seo_misc_clean', $_POST['wp_seo_misc_clean']);
    update_option('wp_seo_misc_feed', $_POST['wp_seo_misc_feed']);
    update_option('wp_seo_misc_attachment', $_POST['wp_seo_misc_attachment']);
  }
  
  
  /**
  * set_download_header
  *
  * Senden den richtigen Header an den Browser
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    28.05.2007
  * @change   28.05.2007
  * @access		public
  * @param    string   $filename  Name der Datei
  * @param    integer  $filesize  Groesse der Datei
  * @param    string   $filetype  Typ der Datei
  */
  
  function set_download_header($filename, $filesize, $filetype) {
    @ob_end_clean();
    
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' .$filename);
    header('Content-Length: ' .$filesize);
    header('Content-type: ' .$filetype. '; charset=' .get_option('blog_charset'), true);
  }
  
  
  /**
  * set_import_options
  *
  * Importiert Werte aus XML in die DB
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    29.05.2007
  * @change   29.05.2007
  * @access		public
  * @param    string   $file  Pfad der Uploaddatei
  */
  
  function set_import_options($file) {
    /* Datei auslesen */
    $data = str_replace(
                        array(
                              '<![CDATA[',
                              ']]>'
                             ),
                        '',
                        file_get_contents($file)
                       );
    
    /* XML parsen */
    preg_match_all(
                   '/<(.*?)>(.*?)<\/.*?>/',
                   $data,
                   $matches
                  );
    
    /* DB updaten */
    for ($i = 0; $i < count($matches[1]); $i ++) {
      $option_name = $matches[1][$i];
      $option_value = $matches[2][$i];
      
      if (strpos($option_name, 'wp_seo') !== false) {
        update_option($option_name, $option_value);
      }
    }
  }
  
  
  /**
  * set_edit_fields
  *
  * Speichert Editfelder in die Datenbank
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    25.06.2007
  * @change   12.01.2008
  * @access		public
  * @param    integer  $id  ID des Beitrags
  */
  
  function set_edit_fields($id) {
    /* Werte reseten */
    delete_post_meta($id, 'description');
    delete_post_meta($id, 'keywords');
    delete_post_meta($id, 'title');
    delete_post_meta($id, 'only');
    
    /* Fuer Description */
    if (isset($_POST['wp_seo_edit_description']) === true) {
      add_post_meta($id, 'description', $_POST['wp_seo_edit_description']);
    }
    
    /* Fuer Keywords */
    if (isset($_POST['wp_seo_edit_keywords']) === true) {
      add_post_meta($id, 'keywords', $_POST['wp_seo_edit_keywords']);
    }
    
    /* Fuer Title */
    if (isset($_POST['wp_seo_edit_title']) === true) {
      add_post_meta($id, 'title', $_POST['wp_seo_edit_title']);
    }
    
    /* Fuer Only */
    if (isset($_POST['wp_seo_edit_only']) === true) {
      add_post_meta($id, 'only', $_POST['wp_seo_edit_only']);
    }
  }
  
  
  /**
  * set_attachment_file
  *
  * Speichert Editfelder in die datenbank
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    25.06.2007
  * @change   28.10.2007
  * @access		public
  * @param    array  $data  Array mit originalen Upload-Parametern
  * @return   array  $data  Array mit angepassten Upload-Parametern
  */
  
  function set_attachment_file($data) {
    /* Array leer? */
    if (empty($data) === true) {
      return $data;
    }
    
    /* Titel ermitteln */
    $title = strtolower(trim($_POST['post_title']));
    
    /* Kein Titel? */
    if (empty($title) === true) {
      return $data;
    }
    
    $title = strtr(
                   $title,
                   array(
                         'œ' => 'oe',
                         'à' => 'a',
                         'ô' => 'o',
                         'ď' => 'd',
                         'ḟ' => 'f',
                         'ë' => 'e',
                         'š' => 's',
                         'ơ' => 'o',
                         'ß' => 'ss',
                         'ă' => 'a',
                         'ř' => 'r',
                         'ț' => 't',
                         'ň' => 'n',
                         'ā' => 'a',
                         'ķ' => 'k',
                         'ŝ' => 's',
                         'ỳ' => 'y',
                         'ņ' => 'n',
                         'ĺ' => 'l',
                         'ħ' => 'h',
                         'ṗ' => 'p',
                         'ó' => 'o',
                         'ú' => 'u',
                         'ě' => 'e',
                         'é' => 'e',
                         'ç' => 'c',
                         'ẁ' => 'w',
                         'ċ' => 'c',
                         'õ' => 'o',
                         'ṡ' => 's',
                         'ø' => 'o',
                         'ģ' => 'g',
                         'ŧ' => 't',
                         'ș' => 's',
                         'ė' => 'e',
                         'ĉ' => 'c',
                         'ś' => 's',
                         'î' => 'i',
                         'ű' => 'u',
                         'ć' => 'c',
                         'ę' => 'e',
                         'ŵ' => 'w',
                         'ṫ' => 't',
                         'ū' => 'u',
                         'č' => 'c',
                         'ö' => 'oe',
                         'è' => 'e',
                         'ŷ' => 'y',
                         'ą' => 'a',
                         'ł' => 'l',
                         'ų' => 'u',
                         'ů' => 'u',
                         'ş' => 's',
                         'ğ' => 'g',
                         'ļ' => 'l',
                         'ƒ' => 'f',
                         'ž' => 'z',
                         'ẃ' => 'w',
                         'ḃ' => 'b',
                         'å' => 'a',
                         'ì' => 'i',
                         'ï' => 'i',
                         'ḋ' => 'd',
                         'ť' => 't',
                         'ŗ' => 'r',
                         'ä' => 'ae',
                         'í' => 'i',
                         'ŕ' => 'r',
                         'ê' => 'e',
                         'ü' => 'ue',
                         'ò' => 'o',
                         'ē' => 'e',
                         'ñ' => 'n',
                         'ń' => 'n',
                         'ĥ' => 'h',
                         'ĝ' => 'g',
                         'đ' => 'd',
                         'ĵ' => 'j',
                         'ÿ' => 'y',
                         'ũ' => 'u',
                         'ŭ' => 'u',
                         'ư' => 'u',
                         'ţ' => 't',
                         'ý' => 'y',
                         'ő' => 'o',
                         'â' => 'a',
                         'ľ' => 'l',
                         'ẅ' => 'w',
                         'ż' => 'z',
                         'ī' => 'i',
                         'ã' => 'a',
                         'ġ' => 'g',
                         'ṁ' => 'm',
                         'ō' => 'o',
                         'ĩ' => 'i',
                         'ù' => 'u',
                         'į' => 'i',
                         'ź' => 'z',
                         'á' => 'a',
                         'û' => 'u',
                         'þ' => 'th',
                         'ð' => 'dh',
                         'æ' => 'ae',
                         'µ' => 'u',
                         'ĕ' => 'e',
                         'а' => 'a',
                         'б' => 'b',
                         'в' => 'v',
                         'г' => 'g',
                         'д' => 'd',
                         'е' => 'e',
                         'ё' => 'jo',
                         'ж' => 'zh',
                         'з' => 'z',
                         'и' => 'i',
                         'й' => 'j',
                         'к' => 'k',
                         'л' => 'l',
                         'м' => 'm',
                         'н' => 'n',
                         'о' => 'o',
                         'п' => 'p',
                         'р' => 'r',
                         'с' => 's',
                         'т' => 't',
                         'у' => 'u',
                         'ф' => 'f',
                         'х' => 'x',
                         'ц' => 'c',
                         'ч' => 'ch',
                         'ш' => 'sh',
                         'щ' => 'sch',
                         'ъ' => '',
                         'Ъ' => '',
                         'ы' => 'y',
                         'ь' => '',
                         'Ь' => '',
                         'э' => 'eh',
                         'ю' => 'ju',
                         'я' => 'ja'
                        )
                  );
    
    $title = sanitize_title_with_dashes($title);
    
    /* Titel kuerzen */
    $title = substr($title, 0, 50);
    
    /* Kein Titel? */
    if (empty($title) === true) {
      return $data;
    }
    
    /* Werte initialisieren */
    $info = pathinfo($data['file']);
    $file = $title. '.' .$info['extension'];
    $path = $info['dirname']. '/' .$file;
    
    /* Datei umbenennen */
    if (@rename($data['file'], $path)) {
      return array(
                   'file' => $path,
                   'url'  => dirname($data['url']). '/' .$file,
                   'type' => $data['type']
                  );
    }
    
    return $data;
  }
  
  
  
  
  /*#########################
  #######     SHOW    #######
  #########################*/
  
  /**
  * show_meta_comment
  *
  * Vervollstaendigt den Quelltext
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    30.08.2007
  * @change   21.12.2007
  * @access		public
  */
  
  function show_meta_comment() {
    echo "\n\n" .sprintf(
                       base64_decode('PCEtLSBUaGlzIHNpdGUgaXMgU0VPIG9wdGltaXplZCBieSB3cFNFTyAlcyAoaHR0cDovL3d3dy53cHNlby5vcmcpIC0tPg=='),
                       $this->version
                      ). "\n";
  }
  
  
  /**
  * show_meta_robots
  *
  * Erzeugt einen angepassten META-Robots-Tag
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    27.04.2007
  * @change   07.09.2007
  * @access		public
  */
  
  function show_meta_robots() {
    /* Wert initialisieren */
    $content = '';
    
    /* index, follow */
    if (get_option('wp_seo_misc_robots')) {
      $content = sprintf(
                         '%s, follow',
                         (((is_home() || is_single() || is_page()) && !is_paged()) ? 'index' : 'noindex')
                        );
    }
    
    /* noodp */
    if (get_option('wp_seo_misc_noodp')) {
      if (empty($content) === false) {
        $content .= ', ';
      }
      $content .= 'noodp';
    }
    
    echo '<meta name="robots" content="' .$content. '" />'. "\n";
  }
  
  
  /**
  * show_meta_description
  *
  * Erzeugt einen angepassten META-Description-Tag
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   15.08.2007
  * @access		public
  */
  
  function show_meta_description() {
    /* String mit Description */
    $desc = '';
    
    /* Default-Wert */
    $default = stripslashes(get_option('wp_seo_desc_default'));
    
    /* Array mit Attributen */
    $attr = array(
                  'substantive' => false,
                  'separator'   => ' ',
                  'counter'     => get_option('wp_seo_desc_counter'),
                  'length'      => false,
                  'character'   => false,
                  'relevance'   => false,
                  'complete'    => false,
                  'labeling'    => false,
                  'xhtml'       => false
                 );
    
    /* Manuelle Description */
    if (get_option('wp_seo_desc_manually') && (is_single() || is_page() || $this->get_front_page()))  {
      $desc = get_post_meta($GLOBALS['post']->ID, 'description', true);
    }
    
    if (is_home()) {
      if (empty($desc) === true) {
        switch (get_option('wp_seo_desc_home')) {
          case 1:
            $desc = $this->get_composed_data(
                                             $GLOBALS['wpSEO']->cache['home']['post'] = $this->get_post_data(),
                                             $attr
                                            );
            break;
          case 2:
            $desc = $this->get_composed_data(
                                             $GLOBALS['wpSEO']->cache['home']['title'] = $this->get_title_data(),
                                             $attr
                                            );
            break;
          default:
            $desc = $default;
            break;
        }
      }
    } else if (is_single()) {
      if (empty($desc) === true) {
        switch (get_option('wp_seo_desc_single')) {
          case 1:
            $desc = wp_title('', false);
            break;
          case 2:
            $desc = $this->get_composed_data(
                                             $GLOBALS['wpSEO']->cache['single']['post'] = $this->get_post_data(),
                                             $attr
                                            );
            break;
          case 3:
            /* Excerpt zwischenspeichern */
            $excerpt = $this->get_excerpt_data();
            
            $desc = $this->get_composed_data(
                                             $GLOBALS['wpSEO']->cache['single']['post'] = (empty($excerpt) === false ? $excerpt : $this->get_post_data()),
                                             $attr
                                            );
            break;
          default:
            $desc = $default;
            break;
        }
      }
    } else if (is_page() || $this->get_front_page()) {
      if (empty($desc) === true) {
        switch (get_option('wp_seo_desc_page')) {
          case 1:
            $desc = wp_title('', false);
            break;
          case 2:
            $desc = $this->get_composed_data(
                                             $GLOBALS['wpSEO']->cache['page']['post'] = $this->get_post_data(),
                                             $attr
                                            );
            break;
          default:
            $desc = $default;
            break;
        }
      }
    } else if (is_category()) {
      switch (get_option('wp_seo_desc_category')) {
        case 1:
          $desc = category_description();
          break;
        case 2:
          $desc = $this->get_composed_data(
                                           $GLOBALS['wpSEO']->cache['category']['title'] = $this->get_title_data(),
                                           $attr
                                          );
          break;
        default:
          $desc = $default;
          break;
      }
    } else if (is_search()) {
      switch (get_option('wp_seo_desc_search')) {
        case 1:
          $desc = $this->get_composed_data(
                                           $GLOBALS['wpSEO']->cache['search']['post'] = $this->get_post_data(),
                                           $attr
                                          );
          break;
        case 2:
          $desc = $this->get_composed_data(
                                           $GLOBALS['wpSEO']->cache['search']['title'] = $this->get_title_data(),
                                           $attr
                                          );
          break;
        default:
          $desc = $default;
          break;
      }
    } else if (is_day() || is_month() || is_year()) {
      switch (get_option('wp_seo_desc_archive')) {
        case 1:
          $desc = $this->get_composed_data(
                                           $GLOBALS['wpSEO']->cache['archive']['post'] = $this->get_post_data(),
                                           $attr
                                          );
          break;
        case 2:
          $desc = $this->get_composed_data(
                                           $GLOBALS['wpSEO']->cache['archive']['title'] = $this->get_title_data(),
                                           $attr
                                          );
          break;
        default:
          $desc = $default;
          break;
      }
    } else if ($this->get_tagging_status()) {
      switch (get_option('wp_seo_desc_tagging')) {
        case 1:
          $desc = $this->get_composed_data(
                                           $GLOBALS['wpSEO']->cache['tagging']['post'] = $this->get_post_data(),
                                           $attr
                                          );
          break;
        case 2:
          $desc = $this->get_composed_data(
                                           $GLOBALS['wpSEO']->cache['tagging']['title'] = $this->get_title_data(),
                                           $attr
                                          );
          break;
        default:
          $desc = $default;
          break;
      }
    } else {
      $desc = $default;
    }
    
    /* Kein Wert? */
    if (empty($desc) === true) {
      return false;
    }
    
    /* Sonderzeichen maskieren */
    $desc = $this->get_htmlentities_encode($desc);
    
    /* Wert trimmen */
    $desc = trim($desc);
    
    echo sprintf(
                 '<meta name="description" content="%s" />',
                 $desc
                ). "\n";
  }
  
  
  /**
  * show_meta_keywords
  *
  * Erzeugt einen angepassten META-Keywords-Tag
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   22.10.2007
  * @access		public
  */
  
  function show_meta_keywords() {
    /* String mit Keywords */
    $key = '';
    
    /* Default-Wert */
    $default = stripslashes(get_option('wp_seo_key_default'));
    
    /* Array mit Attributen */
    $attr = array(
                  'substantive' => get_option('wp_seo_key_substantive'),
                  'separator'   => ', ',
                  'counter'     => get_option('wp_seo_key_counter'),
                  'length'      => get_option('wp_seo_key_length'),
                  'character'   => true,
                  'relevance'   => get_option('wp_seo_key_relevance'),
                  'complete'    => get_option('wp_seo_key_complete'),
                  'labeling'    => (is_category() || is_search() || is_day() || is_month() || is_year() || $this->get_tagging_status() ? false : get_option('wp_seo_key_labeling')),
                  'xhtml'       => (is_category() || is_search() || is_day() || is_month() || is_year() || $this->get_tagging_status() ? false : get_option('wp_seo_key_xhtml'))
                 );
    
    /* Manuelle Keywords */
    if (get_option('wp_seo_key_manually') && (is_single() || is_page() || $this->get_front_page()))  {
      $key = get_post_meta($GLOBALS['post']->ID, 'keywords', true);
    }
    
    if (is_home()) {
      if (empty($key) === true) {
        switch (get_option('wp_seo_key_home')) {
          case 1:
            $key = $this->get_composed_data(
                                            (isset($GLOBALS['wpSEO']->cache['home']['post']) === true ? $GLOBALS['wpSEO']->cache['home']['post'] : $this->get_post_data()),
                                            $attr
                                           );
            break;
          default:
            $key = $default;
            break;
        }
      }
    } else if (is_single()) {
      if (empty($key) === true) {
        switch (get_option('wp_seo_key_single')) {
          case 1:
            $key = $this->get_composed_data(
                                            (isset($GLOBALS['wpSEO']->cache['single']['post']) === true ? $GLOBALS['wpSEO']->cache['single']['post'] : $this->get_post_data()),
                                            $attr
                                           );
            break;
          case 2:
            $key = $this->get_post_tags();
            break;
          default:
            $key = $default;
            break;
        }
      }
    } else if (is_page() || $this->get_front_page()) {
      if (empty($key) === true) {
        switch (get_option('wp_seo_key_page')) {
          case 1:
            $key = $this->get_composed_data(
                                            (isset($GLOBALS['wpSEO']->cache['page']['post']) === true ? $GLOBALS['wpSEO']->cache['page']['post'] : $this->get_post_data()),
                                            $attr
                                           );
            break;
          case 2:
            $key = $this->get_post_tags();
            break;
          default:
            $key = $default;
            break;
        }
      }
    } else if (is_category()) {
      switch (get_option('wp_seo_key_category')) {
        case 1:
          $key = $this->get_composed_data(
                                          (isset($GLOBALS['wpSEO']->cache['category']['title']) === true ? $GLOBALS['wpSEO']->cache['category']['title'] : $this->get_title_data()),
                                          $attr
                                         );
          break;
        default:
          $key = $default;
          break;
      }
    } else if (is_search()) {
      switch (get_option('wp_seo_key_search')) {
        case 1:
          $key = $this->get_composed_data(
                                          (isset($GLOBALS['wpSEO']->cache['search']['title']) === true ? $GLOBALS['wpSEO']->cache['search']['title'] : $this->get_title_data()),
                                          $attr
                                         );
          break;
        default:
          $key = $default;
          break;
      }
    } else if (is_day() || is_month() || is_year()) {
      switch (get_option('wp_seo_key_archive')) {
        case 1:
          $key = $this->get_composed_data(
                                          (isset($GLOBALS['wpSEO']->cache['archive']['title']) === true ? $GLOBALS['wpSEO']->cache['archive']['title'] : $this->get_title_data()),
                                          $attr
                                         );
          break;
        default:
          $key = $default;
          break;
      }
    } else if ($this->get_tagging_status()) {
      switch (get_option('wp_seo_key_tagging')) {
        case 1:
          $key = $this->get_composed_data(
                                          (isset($GLOBALS['wpSEO']->cache['tagging']['title']) === true ? $GLOBALS['wpSEO']->cache['tagging']['title'] : $this->get_title_data()),
                                          $attr
                                         );
          break;
        default:
          $key = $default;
          break;
      }
    } else {
      $key = $default;
    }
    
    /* Kein Wert? */
    if (empty($key) === true) {
      return false;
    }
    
    /* Sonderzeichen maskieren */
    $key = $this->get_htmlentities_encode($key);
    
    /* Wert trimmen */
    $GLOBALS['wpSEO']->cache['keywords'] = $key = trim($key);
    
    echo sprintf(
                 '<meta name="keywords" content="%s" />',
                 $key
                ). "\n";
  }
  
  
  /**
  * show_meta_title
  *
  * Erzeugt einen angepassten Title-Tag
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   30.10.2007
  * @access		public
  */
  
  function show_meta_title() {
    /* Wert initialisieren */
    $title = '';
    
    /* Separator der Seite */
    $separator = stripslashes(get_option('wp_seo_title_separator'));
    $separator = empty($separator) === false ? $separator : '&raquo;';
    
    /* Titel der Seite */
    $wp_title = trim(wp_title('', false));    
    $wp_title = (empty($wp_title) === true) ? get_bloginfo('description') : $wp_title;
    
    /* Manueller Titel */
    if (get_option('wp_seo_title_manually') && (is_single() || is_page() || $this->get_front_page()) && $tmp_title = get_post_meta($GLOBALS['post']->ID, 'title', true)) {
      if (get_post_meta($GLOBALS['post']->ID, 'only', true)) {
        $title = $tmp_title;
      } else {
        $wp_title = $tmp_title;
      }
    }
    
    /* Title vorhanden? */
    if (empty($title) === true) {
      /* Seitennummer einblenden */
      if (get_option('wp_seo_title_number') && is_paged()) {
        if (empty($wp_title) === true) {
          $wp_title = sprintf('%s %s', $this->get_translated_string('wp_seo_page'), $GLOBALS['paged']);
        } else {
          $wp_title .= sprintf(' %s %s %s', $separator, $this->get_translated_string('wp_seo_page'), $GLOBALS['paged']);
        }
      }
      
      /* Autor des Beitrages */
      if (get_option('wp_seo_title_author') && (is_single() || is_page())) {
        $user_info = get_userdata($GLOBALS['posts'][0]->post_author);
        $wp_title .= sprintf(' %s %s %s', $separator, ucfirst($this->get_translated_string('wp_seo_by')), $user_info->display_name); 
      }
      
      /* Erweiterte Werte */
      if (is_home()) {
        $title = str_replace(
                             array(
                                   '%area%',
                                   '%title%'
                                  ),
                             array(
                                   stripslashes(get_option('wp_seo_title_desc_home')),
                                   $wp_title
                                  ),
                             get_option('wp_seo_title_channel_home')
                           );
      } else if (is_single()) {
        $title = str_replace(
                             array(
                                   '%area%',
                                   '%title%'
                                  ),
                             array(
                                   stripslashes(get_option('wp_seo_title_desc_single')),
                                   $wp_title
                                  ),
                             get_option('wp_seo_title_channel_single')
                           );
      } else if (is_page() || $this->get_front_page()) {
        $title = str_replace(
                             array(
                                   '%area%',
                                   '%title%'
                                  ),
                             array(
                                   stripslashes(get_option('wp_seo_title_desc_page')),
                                   $wp_title
                                  ),
                             get_option('wp_seo_title_channel_page')
                           );
      } elseif (is_category()) {
        $title = str_replace(
                             array(
                                   '%area%',
                                   '%title%'
                                  ),
                             array(
                                   stripslashes(get_option('wp_seo_title_desc_category')),
                                   $wp_title
                                  ),
                             get_option('wp_seo_title_channel_category')
                           );
      } else if (is_search()) {
        $title = str_replace(
                             array(
                                   '%area%',
                                   '%title%'
                                  ),
                             array(
                                   stripslashes(get_option('wp_seo_title_desc_search')),
                                   wp_specialchars($_REQUEST['s'], 1)
                                  ),
                             get_option('wp_seo_title_channel_search')
                           );
      } else if (is_day() || is_month() || is_year()) {
        $title = str_replace(
                             array(
                                   '%area%',
                                   '%title%'
                                  ),
                             array(
                                   stripslashes(get_option('wp_seo_title_desc_archive')),
                                   $wp_title
                                  ),
                             get_option('wp_seo_title_channel_archive')
                           );
      } else if ($this->get_tagging_status()) {
        $title = str_replace(
                             array(
                                   '%area%',
                                   '%tag%'
                                  ),
                             array(
                                   stripslashes(get_option('wp_seo_title_desc_tagging')),
                                   $this->get_current_tagset()
                                  ),
                             get_option('wp_seo_title_channel_tagging')
                           );
      } else if (is_404()) {
        $title = str_replace(
                             array(
                                   '%area%',
                                   '%title%'
                                  ),
                             array(
                                   stripslashes(get_option('wp_seo_title_desc_404')),
                                   $wp_title
                                  ),
                             get_option('wp_seo_title_channel_404')
                           );
      } else {
        $title = str_replace(
                             array(
                                   '%title%'
                                  ),
                             array(
                                   $wp_title ? $wp_title : get_bloginfo('description')
                                  ),
                             get_option('wp_seo_title_channel_home')
                           );
      }
    }
    
    /* Array initialisieren */
    $replace = array();
    
    /* Platzhalter suchen */
    if (strpos($title, '%blog%') !== false) {
      $replace['%blog%'] = get_bloginfo('name');
    }
    if (strpos($title, '%clip%') !== false) {
      $replace['%clip%'] = $separator;
    }
    if (strpos($title, '%keywords%') !== false) {
      $replace['%keywords%'] = $GLOBALS['wpSEO']->cache['keywords'];
    }
    if (strpos($title, '%category%') !== false) {
      $replace['%category%'] = $this->get_category_data();
    }
    
    /* Werte umschreiben */
    if (empty($replace) === false) {
      $title = str_replace(
                           array_keys($replace),
                           array_values($replace),
                           $title
                          );
    }
    
    /* Reste bereinigen */
    $separator = '\\' .$separator;
    $title = preg_replace('/(^\s*' .$separator. '\s*' .$separator. '|\s*' .$separator. '\s*' .$separator. '\s*$|^\s*' .$separator. '|' .$separator. '$|%area% ' .$separator. ')/', '', $title);
    
    /* Sonderzeichen maskieren */
    $title = $this->get_htmlentities_encode($title);
    
    /* Wert trimmen */
    $title = trim($title);
    
    /* Titel ausgeben */
    echo sprintf(
                 "<title>%s</title>\n",
                 $title
                );
  }
  
  
  /**
  * show_feed_noindex
  *
  * Erzeugt einen FEED-META-NOINDEX-Tag
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    23.05.2007
  * @change   03.05.2007
  * @access		public
  */
  
  function show_feed_noindex() {
    echo '<xhtml:meta xmlns:xhtml="http://www.w3.org/1999/xhtml" name="robots" content="noindex" />' . "\n";
  }
  
  
  /**
  * show_edit_fields
  *
  * Erzeugt Editfelder beim Erstellen eines Beitrags
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    25.06.2007
  * @change   30.10.2007
  * @access		public
  */
  
  function show_edit_fields() { ?>
    <div id="wp_seo_edit" style="margin: 0 0 10px">
      <?php if (get_option('wp_seo_title_manually')) { ?>
        <fieldset>
          <legend><?php echo $this->get_translated_string('wp_seo_title') ?></legend>
          <div><input name="wp_seo_edit_title" type="text" size="30" id="wp_seo_edit_title" value="<?php echo stripslashes(get_post_meta($GLOBALS['post']->ID, 'title', true)) ?>" style="width: 100%" /></div>
          <div><input name="wp_seo_edit_only" type="checkbox" id="wp_seo_edit_only" value="1" <?php echo get_post_meta($GLOBALS['post']->ID, 'only', true) ? 'checked' : '' ?> /> <?php echo $this->get_translated_string('wp_seo_title_manually_only') ?></div>
        </fieldset>
      <?php }
      if (get_option('wp_seo_desc_manually')) { ?>
        <fieldset>
          <legend>Description</legend>
          <div><input name="wp_seo_edit_description" type="text" size="30" id="wp_seo_edit_description" value="<?php echo stripslashes(get_post_meta($GLOBALS['post']->ID, 'description', true)) ?>" style="width: 100%" /></div>
        </fieldset>
      <?php }
      if (get_option('wp_seo_key_manually')) { ?>
        <fieldset>
          <legend>Keywords</legend>
          <div><input name="wp_seo_edit_keywords" type="text" size="30" id="wp_seo_edit_keywords" value="<?php echo stripslashes(get_post_meta($GLOBALS['post']->ID, 'keywords', true)) ?>" style="width: 100%" /></div>
        </fieldset>
      <?php } ?>
    </div>
  <?php }
  
  
  /**
  * show_admin_page
  *
  * Generiert die Seite des wpSEO-Plugins
  *
  * @package  wpseo_de.php
  * @author   Sergej Mueller
  * @since    21.03.2007
  * @change   30.08.2007
  * @access		public
  */
  
  function show_admin_page() {
    /* XML importieren */
    if (isset($_FILES) === true && empty($_FILES) === false) {
      if ($_FILES['xml']['error'] || !$_FILES['xml']['size']) { ?>
        <div id="message" class="error">
          <p>
            <strong>
              <?php echo $this->get_translated_string('wp_seo_import_error') ?>
            </strong>
          </p>
        </div>
      <?php } else {
        /* XML parsen */
        $this->set_import_options($_FILES['xml']['tmp_name']);
        
        /* Meldung ausgeben */ ?>
        <div id="message" class="updated fade">
          <p>
            <strong>
              <?php echo $this->get_translated_string('wp_seo_import_done') ?>
            </strong>
          </p>
        </div>
      <?php }
    
    /* Speichern notwendig? */
    } else if (isset($_POST) === true && isset($_POST['action']) === true) {
      /* Werte speichern */
      $this->set_user_settings();
      
      /* Meldung ausgeben */ ?>
      <div id="message" class="updated fade">
        <p>
          <strong>
            <?php echo $this->get_translated_string('wp_seo_update_done') ?>
          </strong>
        </p>
      </div>
    <?php } else if ($this->version != $this->get_plugin_version()) { ?>
      <div id="message" class="error">
        <p>
          <strong>
            <?php echo $this->get_translated_string('wp_seo_update_available') ?>
          </strong>
        </p>
      </div>
    <?php } else if ($this->get_donate_status() === true) { ?>
      <div id="message" class="error">
        <p>
          <strong>
            <?php echo $this->get_translated_string('wp_seo_please_donate') ?>
          </strong>
        </p>
      </div>
    <?php } else if (isset($_GET) === true && isset($_GET['action']) === true && $_GET['action'] == 'compatibility') {
      /* Check durchfuehren */
      $status = $this->get_compatibility_check();
      
      /* Check erfolgreich */
      if ($status === true) { ?>
        <div id="message" class="updated fade">
          <p>
            <strong>
              <?php echo $this->get_translated_string('wp_seo_compatibility_done') ?>
            </strong>
          </p>
        </div>
      <?php 
      /* Check fehlgeschlagen */
      } else { ?>
        <div id="message" class="error">
          <p>
            <strong>
              <?php echo $status ?>
            </strong>
          </p>
        </div>
      <?php }
    } ?>
    
    <style type="text/css">
      .wrap ul {
        clear: both;
        margin: 0;
        padding: 10px 0 0 20px;
      }
      .wrap ul li {
        clear: both;
        list-style: none;
      }
      .wrap ul li div {
        float: left;
      }
      .wrap ul li .left {
        width: 150px;
        margin: 3px 0 0;
      }
      .wrap input.text {
        width: 400px;
      }
      .wrap select {
        width: 408px;
        height: 22px;
      }
      .wrap textarea {
        width: 400px;
        height: 50px;
      }
      .wrap fieldset {
        clear: both;
      }
      .wrap .helper {
        float: right;
      }
    </style>
    
    <script type="text/javascript">
      function enable_options(area, status) {
        var i = 0, name;
        var form = document.wp_seo_form;
        
        for (i; i < form.length; i ++) {
          name = form.elements[i].name;
          if (name && name != 'wp_seo_' + area + '_enable' && name.lastIndexOf('wp_seo_' + area) != -1) {
            form.elements[i].disabled = status ? false : true;
          }
        }
        
        eval('form.wp_seo_' + area + '_enable').checked = status;
      }
    </script>
    
    <div class="wrap">
      <h2>
        <?php echo $this->get_translated_string('wp_seo_page_teaser') ?>
      </h2>
      
      <p class="helper">
        <?php echo $this->get_translated_string('wp_seo_donate') ?> | <?php echo $this->get_translated_string('wp_seo_manual') ?> | <?php echo $this->get_translated_string('wp_seo_imprint') ?>
      </p>
      
      <form name="wp_seo_form" action="" method="post">
        <input type="hidden" name="action" value="edit" />
        
        <fieldset class="options">
          <legend>
            <?php echo $this->get_translated_string('wp_seo_title_convert') ?>
          </legend>
          
          <p>
            <?php echo $this->get_translated_string('wp_seo_title_warning') ?>
          </p>
          
          <label for="wp_seo_title_enable">
            <input type="checkbox" name="wp_seo_title_enable" id="wp_seo_title_enable" value="1" onchange="enable_options('title', this.checked)" />
            <?php echo $this->get_translated_string('wp_seo_title_enable') ?>
          </label>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_title_format') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_title_format_info') ?></small>
            </li>
            
            <?php foreach ($this->groups as $k) { ?>
              <li>
                <div class="left">
                  <?php echo $this->get_translated_string('wp_seo_' .$k) ?>
                </div>
                <div>
                  <select name="wp_seo_title_channel_<?php echo $k ?>" disabled="disabled">
                  <?php foreach ($this->get_translated_string('wp_seo_title_channel') as $key => $value) {
                    if (($k != 'single' && strpos($key, '%category%') !== false) || ($k == 'tagging' && strpos($key, '%tag%') === false) || ($k != 'tagging' && strpos($key, '%tag%') !== false) || ($k == '404' && strpos($key, '%keywords%') !== false)) {
                      continue;
                    } ?>
                    <option value="<?php echo $key ?>"<?php echo ($key == get_option('wp_seo_title_channel_' .$k)) ? ' selected="selected"' : '' ?>><?php echo $value ?></option>
                  <?php } ?>
                </select>
                </div>
              </li>
            <?php } ?>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_title_separator') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_title_separator_info') ?></small>
            </li>
            
            <li>
              <div class="left">
                <?php echo $this->get_translated_string('wp_seo_title_separator') ?>
              </div>
              <div>
                <input type="text" name="wp_seo_title_separator" class="text" disabled="disabled" value="<?php echo stripslashes(get_option('wp_seo_title_separator')) ?>" />
              </div>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_title_description') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_title_description_info') ?></small>
            </li>
            
            <?php foreach ($this->groups as $k) { ?>
              <li>
                <div class="left">
                  <?php echo $this->get_translated_string('wp_seo_' .$k) ?>
                </div>
                <div>
                  <input type="text" name="wp_seo_title_desc_<?php echo $k ?>" class="text" disabled="disabled" value="<?php echo stripslashes(get_option('wp_seo_title_desc_' .$k)) ?>" />
                </div>
              </li>
            <?php } ?>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_title_count') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_title_count_info') ?></small>
            </li>
            
            <li>
              <label for="wp_seo_title_number">
                <input type="checkbox" name="wp_seo_title_number" id="wp_seo_title_number" value="1"<?php echo (get_option('wp_seo_title_number')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_title_count_view') ?>
              </label>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_title_author') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_title_author_info') ?></small>
            </li>
            
            <li>
              <label for="wp_seo_title_author">
                <input type="checkbox" name="wp_seo_title_author" id="wp_seo_title_author" value="1"<?php echo (get_option('wp_seo_title_author')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_title_author_view') ?>
              </label>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_title_manually') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_title_manually_info') ?></small>
            </li>
            
            <li>
              <label for="wp_seo_title_manually">
                <input type="checkbox" name="wp_seo_title_manually" id="wp_seo_title_manually" value="1"<?php echo (get_option('wp_seo_title_manually')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_title_manually_on') ?>
              </label>
            </li>
          </ul>
        </fieldset>
        
        <p class="submit">
          <input type="submit" value="<?php echo $this->get_translated_string('wp_seo_update') ?> &raquo;" />
        </p>
        
        <?php if (get_option('wp_seo_title_enable')) { ?>
          <script type="text/javascript">
            enable_options('title', true);
          </script>
        <?php } ?>
        
        
        <fieldset class="options">
          <legend>
            <?php echo $this->get_translated_string('wp_seo_desc_convert') ?>
          </legend>
          
          <p>
            <?php echo $this->get_translated_string('wp_seo_desc_warning') ?>
          </p>
          
          <label for="wp_seo_desc_enable">
            <input type="checkbox" name="wp_seo_desc_enable" id="wp_seo_desc_enable" value="1" onchange="enable_options('desc', this.checked)" />
            <?php echo $this->get_translated_string('wp_seo_desc_enable') ?>
          </label>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_desc_default') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_desc_default_info') ?></small>
            </li>
            
            <li>
              <div class="left">
                <?php echo $this->get_translated_string('wp_seo_desc_default') ?>
              </div>
              <div>
                <input type="text" name="wp_seo_desc_default" class="text" disabled="disabled" value="<?php echo stripslashes(get_option('wp_seo_desc_default')) ?>" />
              </div>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_desc_dynamic') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_desc_dynamic_info') ?></small>
            </li>
            
            <?php foreach ($this->groups as $key) { ?>
              <li>
                <div class="left">
                  <?php echo $this->get_translated_string('wp_seo_' .$key) ?>
                </div>
                <div>
                  <select name="wp_seo_desc_<?php echo $key ?>" disabled="disabled">
                    <?php foreach ($this->get_translated_string('wp_seo_desc_' .$key) as $k => $v) { ?>
                      <option value="<?php echo $k ?>"<?php echo ($k == get_option('wp_seo_desc_' .$key)) ? ' selected="selected"' : '' ?>><?php echo $v ?></option>
                    <?php } ?>
                  </select>
                </div>
              </li>
            <?php } ?>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_desc_counter') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_desc_counter_info') ?></small>
            </li>
            
            <li>
              <div class="left">
                <?php echo $this->get_translated_string('wp_seo_desc_counter') ?>
              </div>
              <div>
                <select name="wp_seo_desc_counter" disabled="disabled">
                  <?php for ($k = 5; $k <= 50; $k = $k + 5) { ?>
                    <option value="<?php echo $k ?>"<?php echo ($k == get_option('wp_seo_desc_counter')) ? ' selected="selected"' : '' ?>><?php echo $k ?></option>
                  <?php } ?>
                </select>
              </div>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_desc_manually') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_desc_manually_info') ?></small>
            </li>
            
            <li>
              <label for="wp_seo_desc_manually">
                <input type="checkbox" name="wp_seo_desc_manually" id="wp_seo_desc_manually" value="1"<?php echo (get_option('wp_seo_desc_manually')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_desc_manually_on') ?>
              </label>
            </li>
          </ul>
        </fieldset>
        
        <p class="submit">
          <input type="submit" value="<?php echo $this->get_translated_string('wp_seo_update') ?> &raquo;" />
        </p>
        
        <?php if (get_option('wp_seo_desc_enable')) { ?>
          <script type="text/javascript">
            enable_options('desc', true);
          </script>
        <?php } ?>
        
        
        <fieldset class="options">
          <legend>
            <?php echo $this->get_translated_string('wp_seo_key_convert') ?>
          </legend>
          
          <label for="wp_seo_key_enable">
            <input type="checkbox" name="wp_seo_key_enable" id="wp_seo_key_enable" value="1" onchange="enable_options('key', this.checked)" />
            <?php echo $this->get_translated_string('wp_seo_key_enable') ?>
          </label>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_default') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_default_info') ?></small>
            </li>
            
            <li>
              <div class="left">
                <?php echo $this->get_translated_string('wp_seo_key_default') ?>
              </div>
              <div>
                <input type="text" name="wp_seo_key_default" class="text" disabled="disabled" value="<?php echo stripslashes(get_option('wp_seo_key_default')) ?>" />
              </div>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_dynamic') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_dynamic_info') ?></small>
            </li>
            
            <?php foreach ($this->groups as $key) { ?>
              <li>
                <div class="left">
                  <?php echo $this->get_translated_string('wp_seo_' .$key) ?>
                </div>
                <div>
                  <select name="wp_seo_key_<?php echo $key ?>" disabled="disabled">
                    <?php foreach ($this->get_translated_string('wp_seo_key_' .$key) as $k => $v) {
                      /* Simple Tagging Plugin am Werk? */
                      $warn = ($key == 'single' && $k == 2 && get_option('meta_autoheader')) ? (' (' .$this->get_translated_string('wp_seo_key_dynamic_warn'). ')') : '' ?>
                      <option value="<?php echo $k ?>"<?php echo ($k == get_option('wp_seo_key_' .$key)) ? ' selected="selected"' : '' ?>><?php echo $v ?><?php echo $warn ?></option>
                    <?php } ?>
                  </select>
                </div>
              </li>
            <?php } ?>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_counter') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_counter_info') ?></small>
            </li>
            
            <li>
              <div class="left">
                <?php echo $this->get_translated_string('wp_seo_key_counter') ?>
              </div>
              <div>
                <select name="wp_seo_key_counter" disabled="disabled">
                  <?php for ($k = 4; $k <= 30; $k = $k + 2) { ?>
                    <option value="<?php echo $k ?>"<?php echo ($k == get_option('wp_seo_key_counter')) ? ' selected="selected"' : '' ?>><?php echo $k ?></option>
                  <?php } ?>
                </select>
              </div>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_length') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_length_info') ?></small>
            </li>
            
            <li>
              <div class="left">
                <?php echo $this->get_translated_string('wp_seo_key_length_chars') ?>
              </div>
              <div>
                <select name="wp_seo_key_length" disabled="disabled">
                  <?php for ($k = 1; $k <= 10; $k ++) { ?>
                    <option value="<?php echo $k ?>"<?php echo ($k == get_option('wp_seo_key_length')) ? ' selected="selected"' : '' ?>><?php echo $k ?></option>
                  <?php } ?>
                </select>
              </div>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_blacklist') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_blacklist_info') ?></small>
            </li>
            
            <li>
              <div class="left">
                <?php echo $this->get_translated_string('wp_seo_key_blacklist') ?>
              </div>
              <div>
                <textarea name="wp_seo_key_blacklist" disabled="disabled"><?php echo stripslashes(get_option('wp_seo_key_blacklist')) ?></textarea>
              </div>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_completion') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_completion_info') ?></small>
            </li>
            
            <li>
              <label for="wp_seo_key_complete">
                <input type="checkbox" name="wp_seo_key_complete" id="wp_seo_key_complete" value="1"<?php echo (get_option('wp_seo_key_complete')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_key_completion_on') ?>
              </label>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_substantive') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_substantive_info') ?></small>
            </li>
            
            <li>
              <label for="wp_seo_key_substantive">
                <input type="checkbox" name="wp_seo_key_substantive" id="wp_seo_key_substantive" value="1"<?php echo (get_option('wp_seo_key_substantive')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_key_substantive_on') ?>
              </label>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_relevance') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_relevance_info') ?></small>
            </li>
            
            <li>
              <label for="wp_seo_key_relevance">
                <input type="checkbox" name="wp_seo_key_relevance" id="wp_seo_key_relevance" value="1"<?php echo (get_option('wp_seo_key_relevance')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_key_relevance_on') ?>
              </label>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_labeling') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_labeling_info') ?></small>
            </li>
            
            <li>
              <label for="wp_seo_key_labeling">
                <input type="checkbox" name="wp_seo_key_labeling" id="wp_seo_key_labeling" value="1"<?php echo (get_option('wp_seo_key_labeling')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_key_labeling_on') ?>
              </label>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_xhtml') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_xhtml_info') ?></small>
            </li>
            
            <li>
              <label for="wp_seo_key_xhtml">
                <input type="checkbox" name="wp_seo_key_xhtml" id="wp_seo_key_xhtml" value="1"<?php echo (get_option('wp_seo_key_xhtml')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_key_xhtml_on') ?>
              </label>
            </li>
          </ul>
          
          <ul>
            <li>
              <strong><?php echo $this->get_translated_string('wp_seo_key_manually') ?></strong>
              <small><?php echo $this->get_translated_string('wp_seo_key_manually_info') ?></small>
            </li>
            
            <li>
              <label for="wp_seo_key_manually">
                <input type="checkbox" name="wp_seo_key_manually" id="wp_seo_key_manually" value="1"<?php echo (get_option('wp_seo_key_manually')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_key_manually_on') ?>
              </label>
            </li>
          </ul>
        </fieldset>
        
        <p class="submit">
          <input type="submit" value="<?php echo $this->get_translated_string('wp_seo_update') ?> &raquo;" />
        </p>
        
        <?php if (get_option('wp_seo_key_enable')) { ?>
          <script type="text/javascript">
            enable_options('key', true);
          </script>
        <?php } ?>
        
        
        <fieldset class="options">
          <legend>
            <?php echo $this->get_translated_string('wp_seo_misc_settings') ?>
          </legend>
          
          <ul>
            <li>
              <label for="wp_seo_misc_section">
                <input type="checkbox" name="wp_seo_misc_section" id="wp_seo_misc_section" value="1"<?php echo (get_option('wp_seo_misc_section')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_misc_section') ?>
              </label>
            </li>
            
            <li>
              <label for="wp_seo_misc_robots">
                <input type="checkbox" name="wp_seo_misc_robots" id="wp_seo_misc_robots" value="1"<?php echo (get_option('wp_seo_misc_robots')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_misc_robots') ?>
              </label>
            </li>
            
            <li>
              <label for="wp_seo_misc_noodp">
                <input type="checkbox" name="wp_seo_misc_noodp" id="wp_seo_misc_noodp" value="1"<?php echo (get_option('wp_seo_misc_noodp')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_misc_noodp') ?>
              </label>
            </li>
            
            <li>
              <label for="wp_seo_misc_clean">
                <input type="checkbox" name="wp_seo_misc_clean" id="wp_seo_misc_clean" value="1"<?php echo (get_option('wp_seo_misc_clean')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_misc_clean') ?>
              </label>
            </li>
            
            <li>
              <label for="wp_seo_misc_feed">
                <input type="checkbox" name="wp_seo_misc_feed" id="wp_seo_misc_feed" value="1"<?php echo (get_option('wp_seo_misc_feed')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_misc_feed') ?>
              </label>
            </li>
            
            <li>
              <label for="wp_seo_misc_attachment">
                <input type="checkbox" name="wp_seo_misc_attachment" id="wp_seo_misc_attachment" value="1"<?php echo (get_option('wp_seo_misc_attachment')) ? ' checked="checked"' : '' ?> />
                <?php echo $this->get_translated_string('wp_seo_misc_attachment') ?>
              </label>
            </li>
          </ul>
        </fieldset>
        
        <p class="submit">
          <input type="submit" value="<?php echo $this->get_translated_string('wp_seo_update') ?> &raquo;" />
        </p>
      </form>
      
      <fieldset class="options">
        <legend>
          <?php echo $this->get_translated_string('wp_seo_compatibility_settings') ?>
        </legend>
        
        <ul>
          <li>
            <a href="<?php echo $_SERVER['REQUEST_URI'] ?>&action=compatibility"><?php echo $this->get_translated_string('wp_seo_compatibility_start') ?></a>
          </li>
        </ul>
      </fieldset>
      
      <fieldset class="options">
        <legend>
          <?php echo $this->get_translated_string('wp_seo_export_settings') ?>
        </legend>
        
        <ul>
          <li>
            <a href="<?php echo $_SERVER['REQUEST_URI'] ?>&action=export"><?php echo $this->get_translated_string('wp_seo_export_start') ?></a>
          </li>
        </ul>
      </fieldset>
      
      <form name="wp_seo_export" action="" method="post" enctype="multipart/form-data">
        <fieldset class="options">
          <legend>
            <?php echo $this->get_translated_string('wp_seo_import_settings') ?>
          </legend>
          
          <ul>
            <li>
              <input type="file" name="xml" />
            </li>
            <li class="submit" style="float:left">
              <input type="submit" value="<?php echo $this->get_translated_string('wp_seo_import_start') ?> &raquo;" />
            </li>
          </ul>
        </fieldset>
      </form>
    </div>
  <?php }
}


/* Klasse initialisieren */
$GLOBALS['wpSEO'] = new wpSEO();
?>