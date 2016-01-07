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
$_load_jquery=0; # load jquery
$_load_fa=0; # load font awesome

$_banners= array('moniwiki'=>array('MoniWiki', 'http://moniwiki.kldp.net'),
    'bootstrap'=>array('Bootstrap3.0', 'http://getbootstrap.com'));

$icon['upper']="<i class='glyphicon glyphicon-share-alt gly-rotate-270' aria-hidden='true'></i>";
$icon['create']="<i class='glyphicon glyphicon-edit' aria-hidden='true'></i>";
$icon['edit']="<i class='glyphicon glyphicon-pencil' aria-hidden='true'></i>";
$icon['diff']="<i class='glyphicon glyphicon-sunglasses' aria-hidden='true'></i>";
$icon['info']="<i class='glyphicon glyphicon-info-sign' style='color:#4069CA;' aria-hidden='true'></i>";
$icon['random']="<i class='glyphicon glyphicon-random' aria-hidden='true'></i>";
$icon['backlinks']="<i class='glyphicon glyphicon-share-alt gly-rotate-180' aria-hidden='true'></i>";
$icon['show']="<i class='glyphicon glyphicon-refresh' aria-hidden='true'></i>";
$icon['find']="<i class='glyphicon glyphicon-search' aria-hidden='true'></i>";
$icon['help']="<i class='glyphicon glyphicon-question-sign' style='color:#B94646;' aria-hidden='true'></i>";
$icon['home']="<i class='glyphicon glyphicon-home' aria-hidden='true'></i>";
$icon['user']="<i class='glyphicon glyphicon-cog' aria-hidden='true'></i>";
$icon['print']="<i class='glyphicon glyphicon-print' aria-hidden='true'></i>";
$icon['pref']="<i class='glyphicon glyphicon-cog' aria-hidden='true'></i>";
$icon['rss']="<i class='glyphicon glyphicon-cog' aria-hidden='true'></i>";
$icon['scrap']="<i class='glyphicon glyphicon-heart-empty' aria-hidden='true'></i>";
$icon['unscrap']="<i class='glyphicon glyphicon-heart' aria-hidden='true'></i>";
$icon['locked']="<i class='glyphicon glyphicon-lock' aria-hidden='true'></i>";
$icon['attach']="<i class='glyphicon glyphicon-paperclip' aria-hidden='true'></i>";
$icon['www']="<i class='glyphicon glyphicon-link' aria-hidden='true'></i>";
$icon['external']="<i class='glyphicon glyphicon-new-window' aria-hidden='true'></i>";
$icon['mailto']="<i class='glyphicon glyphicon-envelope' aria-hidden='true'></i>";
$icon['del']="<i class='glyphicon glyphicon-trash' aria-hidden='true'></i>";

$imgdir=$themeurl."/images";

// local config options
if (file_exists(dirname(__FILE__).'/local.php'))
    include(dirname(__FILE__).'/local.php');
