<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

foreach (C::t('#mogu_lottery#mogu_lottery_activity')->fetch_all() as $value) {
	
	unlink($_G['setting']['attachdir'].'common/'.$value['activitypic']);
}

foreach(C::t('#mogu_lottery#mogu_lottery_goods')->fetch_all() as $val){
	
	unlink($_G['setting']['attachdir'].'common/'.$goods['pic']);
}


DB::query("DROP TABLE IF EXISTS ".DB::table('mogu_lottery_activity')."");
DB::query("DROP TABLE IF EXISTS ".DB::table('mogu_lottery_goods')."");
DB::query("DROP TABLE IF EXISTS ".DB::table('mogu_lottery_stats')."");
DB::query("DROP TABLE IF EXISTS ".DB::table('mogu_lottery_user')."");
DB::query("DROP TABLE IF EXISTS ".DB::table('mogu_lottery_hasuse')."");
DB::query("DROP TABLE IF EXISTS ".DB::table('mogu_lottery_userdata')."");

$finish = TRUE;
?>