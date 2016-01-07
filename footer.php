<?php
if (function_exists('local_bottom_banner'))
    local_bottom_banner($self);
?>
<div id="wikiAction">
  <?php
  echo '<ul class="list-group list-group-horizontal"><li class="list-group-item">',
    implode('</li><li class="list-group-item">', $menus), '</li></ul>';
?>
</div>
</div>
</div>

<?php
// check savemode
if (function_exists('local_is_savemode')) {
   $savemode = local_is_savemode();
} else {
   $savemode = $options['is_robot'];
}

$self->_savemode = $savemode;

if ($self->_use_sidebar && !$savemode):
?>
<aside>
<div style='text-align:center'>
<?php if ($self->_use_qr):
  echo $self->macro_repl('QR');
endif;?>
<?php if($self->_use_editstat):
  echo '<img src="'.$self->link_url('RecentChanges', '?action=editstat').'" />';
endif;?>
</div>

<div class="rssChanges">
<p class="more"><a href="<?php echo $self->link_url("RecentChanges")?>" class="more button-small"><span lang='en' title='more...' class='i18n'>more...</span></a></p>
<h3><i class="fa fa-history"></i> <a href="<?php echo $self->link_url("RecentChanges");?>"><?php echo _("RecentChanges")?></a></h3>

<?php echo $self->macro_repl('RecentChanges', "[H:i],item=20,bookmark,list,js", array('call'=>1));?>
</div>

<?php
// RSS Sites
if (!empty($self->_rss_sites)):
foreach ($self->_rss_sites as $v) {
echo '<div class="rssChanges">';
echo '<p class="more"><a href="'.$v['link'].'" class="more button-small">'."<span lang='en' title='more...' class='i18n'>more...</span></a></p>","\n";
echo '<h3>',(isset($v['icon']) ? $v['icon'] : ''),' <a href="',$v['link'],'">',$v['title'],'</a></h3>',"\n";
echo $self->macro_repl('RSS', "[H:i],".(isset($v['item']) ? $v['item'] : 20).','.$v['url'], array('call'=>1));
echo '</div>',"\n";
}
endif;

if ($self->bannerFlag && function_exists('local_side_banner'))
    local_side_banner($self);
?>

</aside>
<?php endif;?>
<?php
if ($self->bannerFlag):
if (function_exists('local_ads_js'))
    local_ads_js($self);
endif;
?>
</div>
<footer id="wikiFooter">
<div class="container">
<?php
// setup banners
$banner = '';

if (function_exists('local_get_footer'))
    echo local_get_footer($self, $options);

foreach ($self->_banners as $k=>$v) {
    $name = $v[0];
    $site = $v[0];
    $banner .= <<<FOOT
 <a href="$site"><img
  src="$self->themeurl/images/$k-thin.png"
  style='border:0;vertical-align:baseline' width="80" height="15"
  alt="powered by $name" /></a>
FOOT;
}

?>
<?php
if (!empty($banner)) {
    echo '<div style="text-align:center" id="wikiBanner">'.$banner;
    if (!empty($self->_amungus_id)) {
        $wauid = $self->_amungus_id;
        echo <<<AMUNGUS
 <script id="_wau{$wauid[1]}">var _wau = _wau || []; _wau.push(["small", "{$wauid[0]}", "{$wauid[1]}"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="http://widgets.amung.us/small.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script>
AMUNGUS;
    }
    echo '</div>';
}
if (!empty($self->_snippet))
    echo $self->_snippet;
if (!empty($lastedit)) {
    echo '<div class="lastmodified">';
    echo "<ins><span class='i18n' lang='ko' title='last modified:'>"._("last modified:")."</span> $lastedit $lasttime</ins>";
    if (!empty($timer)) {
        $timer *= 1000;
        echo ' <ins>Processing time: '.$timer.' ms</ins>';
    }
    echo '</div>';
    //echo "<pre>".$options['timer']->Write()."</pre>";
}
?>
</div>
</footer>
<div class="bottom">
<?php
if ($self->_use_scrollbuttons) {
    echo '<div class="scroll-buttons">';
    echo '<a class="random-link" href="'.$self->link_url('?action=randompage').'"><i class="fa fa-random"></i><span style="display:none">Random</span></a>';
    $edit_url = $self->link_url($self->page->urlname, '?action=edit');
    $style = '';
    if ($self->source_site) {
        $edit_url = $self->source_site.$edit_url;
        $style = ' style="color:#00a000"';
    }
    echo '<a class="scroll-button" href="'.$edit_url.'"><i'.$style.' class="fa fa-pencil"></i></a>';
    echo '<a class="scroll-button" href="javascript:scrollTop();"><i class="fa fa-chevron-up"></i></a>';
    echo '<a class="scroll-bottom" href="javascript:scrollBottom();"><i class="fa fa-chevron-down"></i></a>';
    echo '</div>';
}

?>
    <div id="wiki-messages">
    </div>
</div>
<?php

if (function_exists('local_google_ga'))
    local_google_ga($self);

if ($self->_use_switch_pc && $self->_is_mobile && empty($_COOKIE['desktop'])) {
    echo '<div class="switch-pc-mobile">';
    echo '<a href="?mobile=0" class="switch-to-pc">Switch to desktop version.</a>';
    echo '</div>';
}
?>
</body>
</html>
