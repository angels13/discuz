<?php
$data = array (
  'exp' => 1524654660,
  'data' => 
  array (
    'styleid' => '98',
    'blockclass' => 'portal_article',
    'name' => '[内置]文章封面列表（竖线分隔）',
    'template' => 
    array (
      'raw' => '<div class="module cl ml">
<ul>
[loop]
<li style="width: {picwidth}px;">
	<a href="{url}"><img src="{pic}" width="{picwidth}" height="{picheight}" alt="{title}" /></a>
	<p><a href="{url}" title="{title}"{target}>{title}</a></p>
</li>
[/loop]
[order=odd]
<li style="margin-right: 18px; padding-right: 24px; border-right: 1px solid #EEE; width: {picwidth}px;">
	<a href="{url}"><img src="{pic}" width="{picwidth}" height="{picheight}" alt="{title}" /></a>
	<p><a href="{url}" title="{title}"{target}>{title}</a></p>
</li>
[/order]
</ul>
</div>',
      'footer' => '',
      'header' => '',
      'indexplus' => 
      array (
      ),
      'index' => 
      array (
      ),
      'orderplus' => 
      array (
      ),
      'order' => 
      array (
        'odd' => '<li style="margin-right: 18px; padding-right: 24px; border-right: 1px solid #EEE; width: {picwidth}px;">
	<a href="{url}"><img src="{pic}" width="{picwidth}" height="{picheight}" alt="{title}" /></a>
	<p><a href="{url}" title="{title}"{target}>{title}</a></p>
</li>',
      ),
      'loopplus' => 
      array (
      ),
      'loop' => '<li style="width: {picwidth}px;">
	<a href="{url}"><img src="{pic}" width="{picwidth}" height="{picheight}" alt="{title}" /></a>
	<p><a href="{url}" title="{title}"{target}>{title}</a></p>
</li>',
    ),
    'hash' => '6b653acb',
    'getpic' => '1',
    'getsummary' => '0',
    'makethumb' => '1',
    'settarget' => '1',
    'fields' => 
    array (
      0 => 'url',
      1 => 'pic',
      2 => 'title',
    ),
    'moreurl' => '0',
  ),
);
