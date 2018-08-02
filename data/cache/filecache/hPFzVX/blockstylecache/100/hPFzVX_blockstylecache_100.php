<?php
$data = array (
  'exp' => 1496370440,
  'data' => 
  array (
    'styleid' => '100',
    'blockclass' => 'forum_thread',
    'name' => '[内置]帖子图文展示',
    'template' => 
    array (
      'raw' => '<div class="module cl xld">
[loop]
<dl class="cl">
	<dd class="m"><a href="{url}"{target}><img src="{pic}" width="{picwidth}" height="{picheight}" alt="{title}" /></a></dd>
	<dt><em class="y xg1 xw0"><a href="home.php?mod=space&uid={authorid}"{target}>{author}</a></em><a href="{url}" title="{title}"{target}>{title}</a></dt>
	<dd>{summary}</dd>
</dl>
[/loop]
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
      ),
      'loopplus' => 
      array (
      ),
      'loop' => '<dl class="cl">
	<dd class="m"><a href="{url}"{target}><img src="{pic}" width="{picwidth}" height="{picheight}" alt="{title}" /></a></dd>
	<dt><em class="y xg1 xw0"><a href="home.php?mod=space&uid={authorid}"{target}>{author}</a></em><a href="{url}" title="{title}"{target}>{title}</a></dt>
	<dd>{summary}</dd>
</dl>',
    ),
    'hash' => '881ee4a3',
    'getpic' => '1',
    'getsummary' => '1',
    'makethumb' => '1',
    'settarget' => '1',
    'fields' => 
    array (
      0 => 'url',
      1 => 'pic',
      2 => 'title',
      3 => 'authorid',
      4 => 'author',
      5 => 'summary',
    ),
    'moreurl' => '0',
  ),
);
