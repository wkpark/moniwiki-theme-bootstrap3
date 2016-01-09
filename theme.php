<?php
$css_friendly=1; # please do not change it.
$html5=1;
$_newtheme=2;

/* theme options */
$_no_urlicons=3; # insert url icons
$_use_lastmod=1; # show last modified info
$_use_contributors=1; # show contributors link
$_use_qr=0; # show QR code
$_use_editstat=0; # show editstat bar
$_use_sharebuttons=1; # show share buttons (pin, fb, tw, g+)
$_use_sidebar=1; # show sidebar
$_use_scrollbuttons=1; # show scroll buttons
$_use_switch_pc=0; # show pc-mobile switcher
$_use_fullsearch=0; # use fullsearch
$_load_jquery=0; # load jquery
$_load_fa=0; # load font awesome
#$_use_default_navbar=1; # use default bootstrap navbar
#$_searchform_top=1; # show searchform on top of navbar
#$_navbar_style='inverse';

#$_fullsearch='csesearch'; # custom fullsearch action (default 'fullsearch')
#$_search_placeholder='Search...'; # search form placeholder

$_banners= array('moniwiki'=>array('MoniWiki', 'http://moniwiki.kldp.net'),
    'bootstrap'=>array('Bootstrap3.0', 'http://getbootstrap.com'));

$icon['create']="<i class='glyphicon glyphicon-edit' aria-hidden='true'></i>";
$icon['attach']="<i class='glyphicon glyphicon-paperclip' aria-hidden='true'></i>";

$imgdir=$themeurl."/images";

// local icon file
if (file_exists(dirname(__FILE__).'/icon.php'))
    include(dirname(__FILE__).'/icon.php');

// local config options
if (file_exists(dirname(__FILE__).'/local.php'))
    include(dirname(__FILE__).'/local.php');
