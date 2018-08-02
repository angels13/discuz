<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('mogu_lottery:default/touch/header_ajax'); ?><?php echo $script;?>
<div id="PopWindow" class="tip">
  <h3 style="overflow: hidden;"><a onclick="popup.close();" class="y" style="padding-right:6px;"><i data-id="&#x51;"></i></a></h3>
  <div class="p10">
  <?php echo $html;?>
  </div>
</div><?php include template('common/footer_ajax'); ?>