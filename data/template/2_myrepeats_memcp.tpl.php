<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=plugin&amp;id=myrepeats:memcp&amp;pluginop=add">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<p class="tbmu">�������˺�</p>
<table cellspacing="0" cellpadding="0" class="tfm" style="table-layout:fixed;margin-top:10px;">
<tbody>
<tr><td class="mtm pns">
<p>
<?php if(!$singleprem) { ?>
�û���
<?php if($permusers) { ?>
<select id="userselect" onchange="$('usernamenew').value = this.value" class="ps vm">
<option value="">ѡ�����</option><?php if(is_array($permusers)) foreach($permusers as $user) { ?><option value="<?php echo $user;?>"><?php echo $user;?></option>
<?php } ?>
</select>
<?php } ?>
<input name="usernamenew" id="usernamenew" type="text" class="px vm" value="<?php echo $username;?>" style="width:100px" tabindex="1" />&nbsp;
<?php } else { ?>
�û��� <select name="usernamenew" id="usernamenew" class="ps vm"><?php if(is_array($permusers)) foreach($permusers as $user) { ?><option value="<?php echo $user;?>"<?php if($user == $username) { ?> selected="selected"<?php } ?>><?php echo $user;?></option>
<?php } ?>
</select>
<?php } ?>
���� <input type="password" name="passwordnew" class="px vm" style="width:100px" tabindex="2" />
<select name="questionidnew" tabindex="3" onchange="if(this.value > 0) {$('answernew').style.display='';} else {$('answernew').style.display='none';}" class="ps vm">
<option value="0">��ȫ����</option>
<option value="1">ĸ�׵�����</option>
<option value="2">үү������</option>
<option value="3">���׳����ĳ���</option>
<option value="4">������һλ��ʦ������</option>
<option value="5">�����˼�������ͺ�</option>
<option value="6">����ϲ���Ĳ͹�����</option>
<option value="7">��ʻִ�յ������λ����</option>
</select>
<span id="answernew" style="display:none">�ش� <input type="text" name="answernew" class="px vm" style="width:100px" class="txt" tabindex="4" /></span>
<br /><br />
<p>
����ע <input type="text" name="commentnew" class="px vm" size="40" tabindex="5" />
<button type="submit" name="adduser" class="pn vm" value="yes" ><span>���</span></button>
</p>
</td></tr>
</tbody>
</table>
</form>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=plugin&amp;id=myrepeats:memcp&amp;pluginop=update">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($repeatusers) { ?>
<table cellspacing="0" cellpadding="0" class="dt mtm">
<thead class="alt">
<tr><td width="40"></td><td width="140">�û���</td><td>��ע</td><td width="120">����л�ʱ��</td></tr>
</thead><?php if(is_array($repeatusers)) foreach($repeatusers as $user) { ?><tr>
<td><input name="delete[]" type="checkbox" class="pc" value="<?php echo $user['username'];?>" /></td>
<td><b><?php if(!$user['locked']) { ?><a href="plugin.php?id=myrepeats:switch&amp;username=<?php echo $user['usernameenc'];?>&amp;formhash=<?php echo FORMHASH;?>"><?php echo $user['username'];?></a></b><?php } else { ?><?php echo $user['username'];?> (������Ա����)<?php } ?></td>
<td><input name="comment[<?php echo $user['username'];?>]" class="px" value="<?php echo $user['comment'];?>" size="40" /></td>
<td><?php if($user['lastswitch']) { ?><?php echo $user['lastswitch'];?><?php } else { ?>��δʹ��<?php } ?></td>
</tr>
<?php } ?>
<tr class="bw0_all"><td><label for="chkall"><input class="pc" type="checkbox" id="chkall" name="chkall" onclick="checkall(this.form);" />ɾ?</label></td>
<td class="mtm pns"><button type="submit" class="pn" name="updateuser" value="yes" ><span>�ύ</span></button></td></tr>
</table>
<?php } ?>
</form>