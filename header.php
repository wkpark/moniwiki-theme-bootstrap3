<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
/**
 * MoniWiki Theme by wkpark@gmail.com
 *
 * @since 1.2.5p1
 * @since 2016/01/05
 * @license MIT/GPLv2
 */

echo $self->header_html;
if ($self->_load_jquery)
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>',"\n";
echo '<script src="'.$self->themeurl.'/js/bootstrap.min.js"></script>',"\n";
if ($self->_load_fa)
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>';
echo '<link rel="stylesheet" href="'.$self->themeurl.'/css/bootstrap.min.css" />',"\n";
echo '<link rel="stylesheet" href="'.$self->themeurl.'/css/compat.css" />',"\n";
echo $self->css_html;
//echo '<link rel="stylesheet" href="'.$self->themeurl.'/css/dark.css" />',"\n";

if (file_exists(dirname(__FILE__).'/css/local.css'))
    echo '<link rel="stylesheet" href="'.$self->themeurl.'/css/local.css" />',"\n";

if (function_exists('local_check_mobile')) {
    $is_mobile = local_check_mobile();
} else {
    $is_mobile = $options['is_mobile'];
}

$self->_is_mobile = $is_mobile; // save

// setup banner flag
$bannerFlag = $self->_use_banner;
if ($bannerFlag && function_exists('local_use_banner'))
   $bannerFlag = local_use_banner($self, $options);
$self->bannerFlag = $bannerFlag;

// login/logout URLs
if (function_exists('local_login_urls')) {
    list($login_url, $logout_url) = local_login_urls($self);
} else {
    $login_url = '?action=login';
    $logout_url = '?action=login';
}
$self->_login_url = $login_url;
$self->_logout_url = $logout_url;

// check robot to show sidbar conditionally
$is_robot = $options['is_robot'];
$use_sidebar = $self->_use_sidebar;
if ($use_sidebar)
    $use_sidebar = !$is_mobile && !$is_robot;

$buttons = '';
$is_show = empty($options['action']) || $options['action'] == 'show';

// setup default search action
$mainsearch = !empty($self->_mainsearch) ? $self->_mainsearch : 'titlesearch';
// setup fullsearch action
$fullsearch = !empty($self->_fullsearch) ? $self->_fullsearch : 'fullsearch';

// save is_show
$self->_is_show = $is_show;
// navbar style
$navbar_style = !empty($self->_navbar_style) ? 'navbar-'.$self->_navbar_style : 'navbar-default';

if ($self->_no_urlicons == 1)
  echo <<<EOF
<style type='text/css'>
img.url { /* display: none; /* */ }

a.externalLink.unnamed {
  background: url($self->themeurl/imgs/http.png) no-repeat 0 center;
  padding: 0 0 0 14px;
  opacity: .8;
  filter: alpha(opacity=80);
}

a.externalLink.unnamed[target="_blank"]:after {
  content: "";
  background: url($self->themeurl/imgs/external.png) no-repeat 0 center;
  display: inline-block;
  width: 14px;
  height: 14px;
  vertical-align: middle;
  margin: -2px 0 0 1px;
  opacity: .7;
  filter: alpha(opacity=70);
}

img.externalLink { display: none; }
</style>\n
EOF;
else if ($self->_no_urlicons == 2)
  echo <<<EOF
<style type='text/css'>
img.url { /* display: none; /* */ }

a.externalLink:before {
  padding: 0 0.1em;
  background: #008000;
  color: #FFF;
  content: "外";
  border-radius: 1px;
  opacity: .7;
  filter: alpha(opacity=70);
  margin-right: 0.1em;
}

#wikiMenu a.externalLink.named:before {
  content: '';
  padding: 0;
  background: none;
}

a.externalLink.source:before {
  content: '本';
}

</style>\n
EOF;
else if ($self->_no_urlicons == 3)
  echo <<<EOF
<style type='text/css'>
img.url { /* display: none; /* */ }

a.externalLink:before {
  padding: 0 0.1em;
  background: #008000; /* */
  /* color: #080; /* */
  color: #fff; /* */
  font-family: 'Glyphicons Halflings';
  font-size:0.8rem;
  content: "\\e144"; /* link */
  /* content: "\\e135"; /* globe */
  border-radius: 2px;
  opacity: .7;
  filter: alpha(opacity=70);
  margin-right: 0.1em;
  top: 3px;
}

#wikiMenu a.externalLink.named:before {
  content: '';
  padding: 0;
  background: none;
}

a.externalLink.source:before {
  font-family: 'Glyphicons Halflings';
  font-size:0.9em;
  content: "\\e065";
}

</style>\n
EOF;
?>

<style type='text/css'>
<?php if (!$use_sidebar): ?>
div#mycontent {
  margin-right: 0;
}

.main-wrapper {
  margin-right: 0;
  width: 100%;
  height: 100%;
  float: inherit;
}

aside {
  border-top:1px solid #ddd;
  float: inherit;
  width: 100%;
  margin: 0;
}

.rssChanges h3 {
  margin-top: 10px;
}

.rssChanges ul li {
  padding: 5px;
}

.rssChanges {
  margin-top: 2.0em;
}

<?php endif;?>
</style>

<script type="text/javascript">
$(function() {
$('#scrap').draggable();
var logout_url = "<?php echo $logout_url;?>";
var login_url = "<?php echo $login_url;?>";

<?php
if($self->_use_local_login && file_exists(dirname(__FILE__).'/js/local.js'))
    readfile(dirname(__FILE__).'/js/local.js');

?>
// check cookie and setup fake login status.
// it is not always correct status.
var pos = document.cookie.indexOf('MONI_ID=');
var login = null;
if (pos == -1) {
    nologin = true;
} else {
    var npos = document.cookie.indexOf(';', pos + 8);
    if (npos == -1)
        login = document.cookie.substring(pos);
    else
        login = document.cookie.substring(pos + 8, npos);
    var myid = login.substring(33);

    if (myid.length > 0) {
        $('#login-status').html("<i class='glyphicon glyphicon-off'></i>");
        $('#login-status').attr('href', logout_url);
    }
}

});
<?php if ($self->_use_scrollbuttons):?>
function scrollTop() {
    var isWebkit = /webkit/.test(navigator.userAgent.toLowerCase());
    if (isWebkit) {
        bodyelem = $("body");
    } else {
        bodyelem = $("html");
    }
    bodyelem.animate({scrollTop:0}, 300);
};

function scrollBottom() {
    var isWebkit = /webkit/.test(navigator.userAgent.toLowerCase());
    if (isWebkit) {
        bodyelem = $("body");
    } else {
        bodyelem = $("html");
    }
    bodyelem.animate({scrollTop:$(document).height()}, 300);
};
<?php endif;?>
</script>
</head>
<?php
// send header only.
if ($options['.header'])
    return;
?>
<body>
<?php
// setup sharebuttons
if ($is_show && !empty($self->_use_sharebuttons)) {
  $buttons = $self->macro_repl('ShareButtons', 'nojs');
}

// local navigation bar
if (function_exists('local_navbar'))
    echo local_navbar($self);

if ($self->_use_switch_pc && $is_mobile && !empty($_COOKIE['desktop'])) {
    echo '<div class="switch-pc-mobile">';
    echo '<a href="?mobile=1" class="switch-to-mobile">Switch to mobile version.</a>';
    echo '</div>';
}

if ($self->_use_default_navbar) {
$brand = $self->link_tag($self->frontpage,'',$DBInfo->sitename, 'class="navbar-brand hidden-desktop"');
$navbar_header = <<<HEADER
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    $brand
  </div>
HEADER;

  $navbar_bra='<div id="navbar" class="collapse navbar-collapse">';
} else {
  $navbar_header = '';
  $navbar_bra='<div>';
  $navbar_bra='<div id="navbar" class="navbar-shrink">';
}

$search_text = !empty($self->_search_placeholder) ? $self->_search_placeholder : _("Search");

?>
<header>
<nav class='<?php echo $navbar_style?> navbar-top navbar'>
<div class="container">
<form class="navbar-form navbar-right" id='go' action='' method='get' onsubmit="return moin_submit();">
   <div class="input-group">
      <input type='text' name='value' size='20' accesskey='s' class='form-control' placeholder="<?php echo $search_text?>" />
      <input type='hidden' name='action' value='goto' />
      <span class="input-group-btn">
         <button type='submit' name='search' value='<?php echo $mainsearch?>' class='btn btn-default'><i class="glyphicon glyphicon-search"></i></button>
         <?php if (!empty($self->_use_fullsearch)):?><button type='submit' name='search' value='<?php echo $fullsearch?>' class='btn btn-default'><i class="glyphicon glyphicon-zoom-in"></i></button><?php endif;?>
      </span>
   </div>
</form>
  <?php echo $navbar_header;?>
  <?php echo $navbar_bra;?>
<?php

// action_menu
if (!empty($action_menu)) {
  $mnu = '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="tools">'._("Tools").'</span><span class="caret"></span></a>'."\n";
  $mnu.= str_replace('<ul>', '<ul class="dropdown-menu">', $action_menu);
} else {
  $mnu = '';
}
// append action_menu
$tmp = str_replace('<div id="wikiMenu"><ul>', '<ul class="nav navbar-nav">', $menu);
echo str_replace('</ul>', $mnu.'</ul>', $tmp);
?>
</div>
</nav>
</div>
</header>
<?php
if ($bannerFlag) {
    // show banner flag
    if (function_exists('local_top_banner'))
        echo local_top_banner($self);
    else if (function_exists('local_main_banner'))
        echo local_main_banner($self);
}
?>

<div id='mainBody'>
<div class='container'>
<?php
if (!empty($msg)) {
  $tmp = str_replace('<div class="message"', '<div class="alert alert-dismissable alert-info"', $msg);
  echo str_replace('><span class=',
    '><button type="button" class="close" data-dismiss="alert">×</button><span class=', $tmp);
}
?>
<!-- ?php echo '<div id="wikiTrailer"><p><span>'.$trail.'</span></p></div>';? -->
<div class="main-wrapper">

<div id='mycontent' class='hentry'>
<div id='wikiIcon'>
<?php
#$icons = str_replace('/a> <a', '/a><a', trim($icons)); // remove spaces
echo str_replace('/a> <a', '/a><a', trim($upper_icon).$icons);?>
</div>

<div class="btn-group">
<a class="btn btn-sm btn-default" href="<?php echo $self->link_url('UserPreferences');?>"><i class="glyphicon glyphicon-cog"></i></a>
<a class="btn btn-sm btn-default" id="login-status" href="<?php echo $login_url;?>"><i class="glyphicon glyphicon-user"></i></a>
</div>

<?php echo '<div class="wikiTitle entry-title" id="wikiTitle">'.$title.'</div>';?>
<?php echo $subindex;?>
<?php
if ($is_show and !empty($lastedit) and !empty($self->_use_lastmod)):
    echo "<p class='last-modified'>".
        "<span class='glyphicon glyphicon-time'></span>".
        "<span class='i18n' lang='ko' title='last modified:'>"._("last modified:")."</span> <span class='updated'><span class='value-title' title='$datetime'>$lastedit $lasttime</span></span>";
    if ($self->_use_contributors) {
        $url = $self->link_url($self->page->urlname, '?action=contributors');
        echo ' ', sprintf(_("by %s"),
            "<span class='editors'><span class='vcard'><a class='fn nickname url' href='".$url."'>".
            "<span class='i18n' lang='ko' title='Contributors'>"._("Contributors")."</span></a></span></span>");
    }
    echo "</p>";
    echo $buttons;
endif;
?>
<div class='clearfix'></div>
<?php
if (empty($options['action']) and !empty($DBInfo->use_scrap)) {
  $scrap = $self->macro_repl('Scrap', 'js');
  if (!empty($scrap)) {
    echo "<div id='scrap'>";
    echo $scrap;
    echo "</div>";
    $js = $self->get_javascripts();
    if ($js) {
      echo $js;
    }
  }
}

if (empty($options['action']) and !empty($DBInfo->use_discuss)) {
  $discuss = $self->macro_repl('Discuss', 'js');
  if (!empty($discuss)) {
    echo "<div id='discuss'>";
    echo $discuss;
    echo "</div>";
    $js = $self->get_javascripts();
    if ($js) {
      echo $js;
    }
    echo "<div id='discuss-links'>";
    echo "</div>";
  }
}
